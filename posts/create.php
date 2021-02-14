<?php
session_start();
include('../config/db_connect.php');

function createPost($title, $content)
{
    global $conn;

    $user_id = $_SESSION["user_id"];
    $sql = "insert into posts (title, content, user_id) values ('{$title}', '{$content}', '{$user_id}')";

    $sql_stmt = $conn->prepare("INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)");
    $sql_stmt->bind_param("sss", $title, $content, $user_id);

    $execution = $sql_stmt->execute();

    if ($execution === TRUE) {
        $_SESSION['success_flash'] = "Post created successfully";
        header("Location: /dashboard.php");
        exit();
    } else {
        $_SESSION['error_flash'] = "An error occured";
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
if ($_SESSION["isAuthenticated"] !== TRUE) {
    header("Location: /");
    exit();
}
if (isset($_POST['title'])) {
    createPost(htmlspecialchars($_POST['title']), htmlspecialchars($_POST['content']));
}
?>

<?php include('../partials/header.php') ?>

<div class="container">
    <form method="POST" action="/posts/create.php" class="my-4">
        <div class="form-group">
            <label for="inputUsername">Title</label>
            <input required min="10" type="text" name="title" class="form-control" id="inputUsername" aria-describedby="titleHelp" placeholder="Enter post title">
        </div>
        <div class="form-group">
            <label for="inputPassword">Content</label>
            <div>
                <textarea minlength="50" required class="w-100" name="content" id="content" cols="30" rows="10" placeholder="Enter post content"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<?php include('../partials/footer.php') ?>