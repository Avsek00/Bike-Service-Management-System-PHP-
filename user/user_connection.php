<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs
    $name = $_POST['name'];
    $email = $_POST['email'];
    $userpassword = $_POST['password'];
    $confirmpassword = $_POST['confirm_password'];

    // Check if passwords match
    if ($userpassword !== $confirmpassword) {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
        echo "<script>window.history.back();</script>";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($userpassword, PASSWORD_DEFAULT);

    // Database connection parameters
    $servername = "localhost"; // Change this to your database server name
    $username = "root"; // Change this to your database username
    $password = ""; // Change this to your database password
    $dbname = "bscmss"; // Change this to your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if email already exists
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists, display error message
        echo "<div class='container'>";
        echo "<div class='error-box'>";
        echo "<h2>Registration Failed</h2>";
        echo "<p>The email address '$email' is already registered.</p>";
        echo "<p>Please use a different email address.</p>";
        echo "</div>";
        echo "</div>";
    } else {
        // Email does not exist, proceed with registration
        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        // Execute the query
        if ($stmt->execute()) {
            echo "<div class='container'>";
            echo "<div class='confirmation-box'>";
            echo "<h2>Registration Successful</h2>";
            echo "<p>Thank you for registering, " . htmlspecialchars($name) . ".</p>";
            echo "<p>Your account has been created successfully. You can now log in using your email and password.</p>";
            echo "<a class='btn btn-primary' href='user_login.php'>Log In</a>";
            echo "</div>";
            echo "</div>";
        } else {
            // Handle database error
            echo "<div class='container'>";
            echo "<div class='error-box'>";
            echo "<h2>Registration Failed</h2>";
            echo "<p>There was an error creating your account. Please try again later.</p>";
            echo "</div>";
            echo "</div>";
        }
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
        }
        .confirmation-box, .error-box {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        .confirmation-box h2, .error-box h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .confirmation-box p, .error-box p {
            margin-bottom: 20px;
            font-size: 16px;
            color: #555;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
</body>
</html>
