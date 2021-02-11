<?php
// $conn = mysqli_connect('localhost', 'root', 'password', 'php_blog');
$servername = "localhost";
$username = "root";
$password = "password";
$database = "php_blog";
// if (!$conn) {
//     echo "Connection error: " . mysqli_connect_error();
// }


$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
