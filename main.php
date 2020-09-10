<?php

// session_start();
// echo $_SESSION['name'];

include('./config/db_connect.php');
$sql = 'select * from users';
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($conn);
?>
<style>
    .user-card {
        width: 300px;
    }
</style>
<div class="mt-4">
    <h1 class="text-center">Users</h1>
    <div class="row justify-content-center mt-3">
        <?php
        foreach ($users as $user) :  ?>
            <div class="col mb-4">
                <div class="card user-card">
                    <div class="card-header d-flex">
                        <p>User ID</p><b class="ml-3"><?php echo htmlspecialchars($user['ID']) ?></b>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title d-flex">
                            <p>Username: </p><b class="ml-1"><?php echo htmlspecialchars($user['Username']) ?></b>
                        </h5>
                        <div class="card-text d-flex">
                            <p>Email: </p><b class="ml-1"><?php echo htmlspecialchars($user['Email']) ?></b>
                        </div>
                        <div class="card-text d-flex">
                            <p>Boss: </p><b class="ml-1"><?php echo htmlspecialchars($user['Boss']) ?></b>
                        </div>
                        <a href="./details.php?id=<?php echo date(htmlspecialchars($user['ID'])) ?>" class="btn btn-primary">More info</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>