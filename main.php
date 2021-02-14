<?php
session_start();
include('./config/db_connect.php');
$page = $_GET['page'] ?? 0;
$sql = "SELECT * FROM `posts` LIMIT {$page}, 10";
$result = $conn->query($sql);

if ($result !== TRUE) {
    $_SESSION['error_flash'] = "An error occured while fetching the posts";
}

$posts = $result->fetch_all();

?>

<div class="mt-4">
    <h1 class="text-center">Users</h1>
    <div class="row justify-content-center mt-3">
        <?php if ($result->num_rows > 0) { ?>
            <div class="row justify-content-center">
                <?php foreach ($posts as $post) : ?>
                    <a href="/posts/post.php?id=<?php echo htmlspecialchars($post[0]) ?>">
                        <div class="col mb-5">
                            <div class="card w-100">
                                <div class="card-header">
                                    <h3 class="card-title"> <?php echo htmlspecialchars($post[1]) ?> </h3>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"> <?php echo htmlspecialchars(substr($post[2], 0, 30)) ?>... </p>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach ?>
            </div>
        <?php } else { ?>
            <h4>No posts</h4>
        <?php } ?>
    </div>
</div>