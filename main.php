<?php
session_start();
include('./config/db_connect.php');
$page_input = $_GET['page'] ?? 0;
$page = $page_input < 1 ? 1 : $page_input;
$offset = ($page * 10) - 10;
$sql = "SELECT posts.id, posts.title, posts.content, users.username FROM `posts` INNER JOIN `users` ON users.id = posts.user_id LIMIT {$offset}, 10";
$sql_count = "SELECT COUNT(*) as count FROM posts";

$result = $conn->query($sql);
$posts_count_result = $conn->query($sql_count);
$posts_count_array = $posts_count_result->fetch_assoc();
$posts_count = $posts_count_array['count'];

if ($result !== TRUE) {
    $_SESSION['error_flash'] = "An error occured while fetching the posts";
}

$posts = $result->fetch_all();

?>

<style>
    .post-card {
        width: 300px;
    }
</style>


<div class="mt-4">
    <h1 class="text-center">All posts</h1>
    <div class="row justify-content-center mt-3">
        <?php if ($result->num_rows > 0) { ?>
            <div class="row justify-content-center">
                <?php foreach ($posts as $post) : ?>
                    <div class="col mb-5">
                        <div class="card post-card">
                            <div class="card-header">
                                <h3 class="card-title"> <?php echo htmlspecialchars($post[1]) ?> </h3>
                            </div>
                            <div class="card-body">
                                <p class="card-text"> <?php echo htmlspecialchars(substr($post[2], 0, 100)) ?>... </p>
                                <p>Author: <b><?php echo  htmlspecialchars($post[3]) ?></p></b>
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-primary" href="/posts/post.php?id=<?php echo htmlspecialchars($post[0]) ?>">Read</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php } else { ?>
            <h4>No posts</h4>
        <?php } ?>
    </div>
    <div>
        <ul class="pagination">
            <li class="page-item <?php echo $page <= 1 ? 'disabled' : 'enabled' ?>">
                <?php if ($page > 1) { ?>
                    <a href="?page=<?php echo $page - 1 ?>"><span class="page-link">Previous</span></a>
                <?php } else { ?>
                    <span class="page-link">Previous</span>
                <?php }  ?>

            </li>
            <?php if ($page > 1) { ?>
                <li class="page-item"><a class="page-link" href="#"><?php echo $page - 1 ?></a></li>
            <?php } ?>

            <li class="page-item active" aria-current="page">
                <span class="page-link">
                    <?php echo $page ?>
                    <span class="sr-only">(current)</span>
                </span>
            </li>

            <?php if ($page * 10 < $posts_count) { ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a></li>
            <?php } ?>

            <?php if ($page * 20 < $posts_count) { ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a></li>
            <?php } ?>

            <?php if ($page * 30 < $posts_count) { ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 3 ?>"><?php echo $page + 3 ?></a></li>
            <?php } ?>

            <li class="page-item <?php echo $page * 10 < $posts_count ? 'enabled' : 'disabled' ?>">
                <?php if ($page * 10 < $posts_count) { ?>
                    <a class="page-link" href="?page=<?php echo $page + 1 ?>">Next</a>
                <?php } else { ?>
                    <span class="page-link">Next</span>
                <?php }  ?>
            </li>
        </ul>
    </div>
</div>