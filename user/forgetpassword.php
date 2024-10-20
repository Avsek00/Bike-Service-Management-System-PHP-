<?php
session_start();
include('config/dbcon.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Check if email exists in the database
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // User exists, generate reset token
        $resetToken = bin2hex(random_bytes(16));

        // Store reset token and email in session to display on the page
        $_SESSION['reset_token'] = $resetToken;
        $_SESSION['reset_email'] = $email;
        $_SESSION['status'] = "Password reset token has been generated. Please use the token to reset your password.";
        header('Location: forgetpassword.php');
    } else {
        $_SESSION['status'] = "No account found with that email.";
        header('Location: forgetpassword.php');
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BBSC User Password Reset</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>BBSC User </b>Password Reset</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <?php
      if (isset($_SESSION['status'])) {
          echo '<div class="alert alert-info">' . $_SESSION['status'] . '</div>';
          unset($_SESSION['status']);
      }
      if (isset($_SESSION['reset_token']) && isset($_SESSION['reset_email'])) {
          $resetToken = $_SESSION['reset_token'];
          $email = $_SESSION['reset_email'];
          echo '<div class="alert alert-success">
                    Your password reset token: <strong>' . $resetToken . '</strong>
                    <br>
                    <a href="resetpassword.php?token=' . $resetToken . '&email=' . urlencode($email) . '">Reset your password here</a>
                </div>';
          unset($_SESSION['reset_token']);
          unset($_SESSION['reset_email']);
      }
      ?>

      <form action="forgetpassword.php" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login.php">Login</a>
      </p>
      <p class="mb-0">
        <a href="user_register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
