<?php
session_start();
if(!isset($_SESSION['auth']))
{
    $_SESSION['auth_status'] = "Login to access dashboard";
    header("Location: user_login.php");

}

?>