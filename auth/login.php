<?php
session_start();
include('../config/db_connect.php');

function setAuthenticated()
{
    $_SESSION["isAuthenticated"] = TRUE;
}

function compareHashes($username, $password)
{
    global $conn;
    $sql = "SELECT password FROM users WHERE username = '{$username}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hash = password_hash($password, PASSWORD_DEFAULT);

        if (password_verify($password, $hash)) {
            setAuthenticated();
            header("Location: /dashboard.php");
            exit();
        } else {
            echo "Username or password is incorrect";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
compareHashes($_POST['username'], $_POST['password']);

?>

<?php include('../partials/header.php') ?>

<div class="container">
    <form method="POST" action="/auth/login.php" class="my-4">
        <div class="form-group">
            <label for="inputUsername">Username</label>
            <input type="text" name="username" class="form-control" id="inputUsername" aria-describedby="usernameHelp" placeholder="Enter username">
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Remember Me</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<?php include('../partials/footer.php') ?>