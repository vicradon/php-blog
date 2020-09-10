<?php
if (isset($_POST['submit'])) {
    session_start();
    $_SESSION['name'] = $_POST['username'];
    echo $_SESSION['name'];

    setcookie('gender', $_POST['gender'], time() + 86400);

}
$name = $_SESSION['name'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>stuff</title>
</head>

<body>
    <?php
        echo "Welcome {$name}" ?? "Set a name";
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="text" name="username" id="username">
        <select name="gender" id="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        <button class="btn btn-secondary">Submit</button>
    </form>
</body>

</html>