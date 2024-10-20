<?php
session_start();
include('config/dbcon.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $resetToken = $_POST['token'];
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        $_SESSION['status'] = "Passwords do not match.";
        header('Location: resetpassword.php?token=' . $resetToken . '&email=' . urlencode($email));
        exit();
    }

    // Check if email and token are correct
    $query = "SELECT * FROM users WHERE email='$email' AND reset_token='$resetToken'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // User exists, update the password
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $query = "UPDATE users SET password='$hashedPassword', reset_token=NULL WHERE email='$email'";
        mysqli_query($conn, $query);

        $_SESSION['status'] = "Your password has been successfully reset.";
        header('Location: login.php');
    } else {
        $_SESSION['status'] = "Invalid email or token.";
        header('Location: resetpassword.php?token=' . $resetToken . '&email=' . urlencode($email));
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
      <p class="login-box-msg">Reset your password</p>

      <?php
      if (isset($_SESSION['status'])) {
          echo '<div class="alert alert-info">' . $_SESSION['status'] . '</div>';
          unset($_SESSION['status']);
      }
      ?>

      <form action="resetpassword.php" method="post">
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="New Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Reset Password</button>
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
