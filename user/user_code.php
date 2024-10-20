<?php
session_start();
include('authentication.php');
include('config/dbcon.php');

if(isset($_POST['logout_btn']))
{
    session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_admin']);
    
    $_SESSION['status'] =  "Logged out sucessfully";
    header('Location: user_login.php');
    exit(0);
}
?>