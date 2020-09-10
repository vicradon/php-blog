<?php
$conn = mysqli_connect('localhost', 'admin', 'password', 'dogs_as_bosses');
if (!$conn) {
    echo "Connection error: " . mysqli_connect_error();
}