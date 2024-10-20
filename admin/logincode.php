<?php
session_start();

include('config/dbcon.php');

if(isset($_POST['login_btn'])){

$email = $_POST['email'];
$password = $_POST['password'];

$log_query = "SELECT * FROM admin WHERE email = '$email ' AND password = '$password' LIMIT  1";
$log_query_run= mysqli_query($conn,$log_query);

     if(mysqli_num_rows($log_query_run) > 0){
        
        foreach($log_query_run as $row){
            $admin_id = $row['id'];
            $admin_name = $row['name'];
            $admin_email = $row['email'];

        }

        $_SESSION['auth'] = true;
        $_SESSION['auth_admin'] = [
            'admin_id' => $admin_id,
            'admin_name' => $admin_name,
            'admin_email' => $admin_email

        ];

        $_SESSION['status'] = "Logged in successfully";
        header('Location: index.php');




     }

     else{
        $_SESSION['status'] = "Invalid email or password";
        header('Location: login.php');


     }


}
else{

$_SESSION['status'] = "Access Denied";
header('Location: login.php');
}
?>