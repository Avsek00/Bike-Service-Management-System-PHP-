<?php
session_start();
if(!isset($_SESSION['auth'])) {
    $_SESSION['auth_status'] = "Login to access dashboard";
    header("Location: login.php");
    exit(); // Ensure no further code is executed after redirection
}
?>
