<?php
session_start();
$_SESSION["isAuthenticated"] = FALSE;

header("Location: /");
exit();
