<?php
session_start();
$_SESSION["isAuthenticated"] = FALSE;
$_SESSION["user_id"] = 0;

header("Location: /");
exit();
