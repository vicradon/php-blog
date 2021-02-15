<?php
session_start();
include('../config/db_connect.php');
$post_id = $_GET['id'];
$sql = "SELECT posts.title, posts.content, users.username FROM `posts` INNER JOIN `users` ON users.id = posts.user_id WHERE posts.id='{$post_id}'";

$result = $conn->query($sql);
$post = $result->fetch_assoc();

?>
<?php include('../partials/header.php') ?>

<div class="container">
    <?php if ($post) { ?>
        <h1><?php echo $post['title'] ?></h1>
        <p><?php echo $post['content'] ?></p>
        <p>Author <b><?php echo $post['username'] ?></p></b>
    <?php } else { ?>
        <p><?php echo "No such post exists" ?></p>
    <?php } ?>
</div>

<?php include('../partials/footer.php') ?>