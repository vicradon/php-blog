<?php
include('./templates/header.php');
include('./config/db_connect.php');
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "select * from users where id = '$id'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);
}

if (isset($_POST['delete-user'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "delete from users where id = '$id_to_delete'";

    if (mysqli_query($conn, $sql)) {
        header('Location: index.php');
    } else {
        echo "Query error: " . mysqli_error($conn);
    }
}
?>

<div class="container">
    <div class="d-flex">
        <p>User ID</p><b class="ml-3"><?php echo htmlspecialchars($user['ID']) ?></b>
    </div>
    <div class="">
        <h5 class="d-flex">
            <p>Username: </p><b class="ml-1"><?php echo htmlspecialchars($user['Username']) ?></b>
        </h5>
        <div class="d-flex">
            <p>Email: </p><b class="ml-1"><?php echo htmlspecialchars($user['Email']) ?></b>
        </div>
        <div class="d-flex">
            <p>Boss: </p><b class="ml-1"><?php echo htmlspecialchars($user['Boss']) ?></b>
        </div>
        <div class="d-flex">
            <p>Created At: </p><b class="ml-1"><?php echo htmlspecialchars($user['CreatedAt']) ?></b>
        </div>
    </div>

    <form action="details.php" method="post">
        <input type="hidden" name="id_to_delete" value="<?php echo $user['ID'] ?>" />
        <button type="submit" name="delete-user" class="btn btn-danger">Delete User</button>
    </form>
</div>

<?php include('./templates/footer.php'); ?>