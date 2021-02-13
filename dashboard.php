<?php
session_start();
include('./config/db_connect.php');
$user_id = $_SESSION["user_id"];
$sql = "select * from posts where user_id='{$user_id}'";
$result = $conn->query($sql);
$posts = $result->fetch_all();

?>
<?php include('./partials/header.php') ?>

<div class="container">
    <h2>Posts</h2>
    <?php include('./partials/flash-messages.php') ?>

    <?php if ($result->num_rows > 0) { ?>
        <div class="row">
            <?php for ($index = 0; $index < $result->num_rows; $index++) { ?>
                <a href="/posts/post.php?id=<?php echo $posts[$index][0] ?>">
                    <div class="col mb-5">
                        <div class="card w-100">
                            <div class="card-body">
                                <h3 class="card-title"> <?php echo ($posts[$index][1]) ?> </h3>
                                <p class="card-text"> <?php echo substr($posts[$index][2], 0, 30) ?>... </p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>

    <?php } else { ?>
        <h4>No posts</h4>
    <?php } ?>

</div>

<?php include('./partials/footer.php') ?>