<?php
session_start();
include('../config/db_connect.php');
$post_id = $_GET['id'];
$sql = "select title, content from posts where id='{$post_id}'";
$result = $conn->query($sql);
$post = $result->fetch_assoc();

?>
<?php include('../partials/header.php') ?>

<div class="container">
    <?php if ($post) { ?>
        <h1><?php echo $post['title'] ?></h1>
        <p><?php echo $post['content'] ?></p>
    <?php } else { ?>
        <p><?php echo "No such post exists" ?></p>
    <?php } ?>
</div>

<?php include('../partials/footer.php') ?>