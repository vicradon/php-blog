<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Blog</title>
    <link rel="stylesheet" href="../assets/bootstrap.css">
</head>

<body class="bg-light">
    <header class="bg-gray py-2 shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="/">
                <h4>PHP Blog</h4>
            </a>
            <div>
                <?php session_start(); ?>
                <?php if ($_SESSION["isAuthenticated"] === TRUE) { ?>
                    <div class="d-flex">
                        <a class="btn btn-primary text-white mr-3" href="post/create.php">Create Post</a>
                        <form action="/auth/logout.php">
                            <button class="btn btn-secondary">Logout</button>
                        </form>
                    </div>
                <?php } else { ?>
                    <div>
                        <a class="btn btn-secondary text-white" href="auth/login.php">Login</a>
                        <a class="btn btn-primary text-white" href="auth/signup.php">Signup</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </header>