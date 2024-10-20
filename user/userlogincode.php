<?php
session_start();

include('config/dbcon.php');

if(isset($_POST['login_btn'])) {

    $email = $_POST['email'];
    $user_password = $_POST['password'];

    // Fetch user details from database
    $log_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $log_query_run = mysqli_query($conn, $log_query);

    if(mysqli_num_rows($log_query_run) > 0) {
        $row = mysqli_fetch_assoc($log_query_run);
        $stored_password = $row['password']; // Password stored in database
        
        // Verify the password
        if(password_verify($user_password, $stored_password)) {
            $_SESSION['auth'] = true;
            $_SESSION['auth_user'] = [
                'user_id' => $row['id'],
                'user_name' => $row['name'],
                'user_email' => $row['email']
            ];

            $_SESSION['status'] = "Logged in successfully";
            header('Location: index.php');
        } else {
            $_SESSION['status'] = "Invalid email or password";
            header('Location: user_login.php');
        }
    } else {
        $_SESSION['status'] = "Invalid email or password";
        header('Location: user_login.php');
    }

} else {
    $_SESSION['status'] = "Access Denied";
    header('Location: user_login.php');
}
?>
