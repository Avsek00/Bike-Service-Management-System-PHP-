<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBSC User Registration</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background-color: #f2f2f2; /* Fallback color */
    background-image: url('../images/ThanitApril_58.jpg'); /* Path to your background image */
    background-size: 125%; /* Zoom in by 10% to fill the page more */
    background-position: center;
    background-repeat: no-repeat;
    
}

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: aqua; /* Dark text color */
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.1); /* Text shadow for contrast */
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333; /* Dark text color */
        }
        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1>BBSC User Registration</h1>

<div class="container">
    <h2>User Registration</h2>
    <form action="user_connection.php" method="post">
        <label for="name">Username:</label>
        <input type="text" id="name" name="name" pattern="[a-zA-Z ]+" title="Name should only contain letters and spaces" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" pattern="^(?=.*[a-zA-Z])(?=.*\d).+$" 
               title="Password must contain at least one letter and one number" required>
        
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <input type="submit" value="Register">
    </form>
    <p class="mb-0">
        <a href="user_login.php" class="text-center">Login page</a>
      </p>

</div>

</body>
</html>
