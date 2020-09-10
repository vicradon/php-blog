<?php
include('./config/db_connect.php');
include('./templates/header.php');
?>

<style>
    .add-form {
        width: 600px;
        margin: 0 auto;
    }
</style>


<?php
$usernameError = "";
$emailError = "";

$userData = ['username' => null, 'email' => null];

function validateEmail($email)
{
    $errors = "";
    if (empty($email)) {
        $errors .= "Email is empty";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors .= " Email is invalid";
    }
    return $errors;
}
function validateUsername($username)
{
    $errors = "";
    if (empty($username)) {
        $errors .= "username is empty";
    }
    return $errors;
}

if (isset($_POST['submit'])) {
    $userData['username'] = htmlspecialchars($_POST['username']);
    $userData['email'] = htmlspecialchars($_POST['email']);

    $usernameError = validateUsername($_POST['username']);
    $emailError = validateEmail($_POST['email']);

    if (!$usernameError && !$emailError) {
        $email = mysqli_real_escape_string($conn, $userData['email']);
        $username = mysqli_real_escape_string($conn, $userData['username']);
        $sql = "insert into users(email, username) values('$email', '$username');";

        if(mysqli_query($conn, $sql)){
            header('Location: index.php');
        } else {
            echo "Query error: " . mysqli_error($conn);
        }
    }
}
?>


<div class="container mt-5">
    <form class="add-form row" method="POST" action="add.php">

        <div class="form-row justify-content-between">

            <div class="mb-3">
                <label for="username">Username</label>
                <div class="input-group d-flex flex-column">
                    <input value="<?php echo $userData['username'] ?>" type="text" class="form-control w-100" id="username" name="username" placeholder="Username"><br />
                    <div class="text-danger">
                        <?php echo $usernameError ?>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="email">email</label>
                <div class="input-group  d-flex flex-column">
                    <input value="<?php echo $userData['email'] ?>" type="text" class="form-control w-100" id="email" name="email" placeholder="email" aria-describedby="inputGroupPrepend">
                    <div class="text-danger">
                        <?php echo $emailError ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-12">
            <button class="btn btn-primary" name="submit" type="submit">Submit</button>
        </div>
    </form>

    <div class="mt-5">
        <h3>Your data capitalized</h3>
        <div class="d-flex justify-content-between align-items-center">
            <p>username</p>
            <b><?php echo $userData['username'] ?></b>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <p>email</p>
            <b><?php echo $userData['email'] ?></b>
        </div>
    </div>
</div>

<?php include('./templates/footer.php') ?>