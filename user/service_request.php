<?php
session_start();

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');

if (!isset($_SESSION['auth'])) {
    $_SESSION['auth_status'] = "Login to access dashboard";
    header("Location: login.php");
    exit();
}

include('config/dbcon.php');

// Fetch services from the database
$services_query = "SELECT service FROM service_list";
$services_result = mysqli_query($conn, $services_query);

// Get owner's name and email from session
$owner_name = $_SESSION['auth_user']['user_name'];
$owner_email = $_SESSION['auth_user']['user_email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Request Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1, h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        h3 {
            color: blue;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select[multiple] {
            height: 100px;
        }

        button[type="submit"],
        button[type="button"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        button[type="submit"]:hover,
        button[type="button"]:hover {
            background-color: #45a049;
        }

        button[type="submit"] {
            float: right;
        }

        button[type="button"] {
            float: left;
        }

        textarea {
            resize: vertical;
        }
    </style>
</head>
<body>
    <h1>Bhairab Bike Service Center</h1>
    <h3>Please fill this form to request a service for your bike.</h3>

    <form action="connect.php" method="post">
        <label for="owner_name">Owner Fullname:</label><br>
        <input type="text" id="owner_name" name="owner_name" value="<?php echo htmlspecialchars($owner_name); ?>" required><br><br>

        <label for="owner_contact">Owner Contact #:</label><br>
<input type="text" id="owner_contact" name="owner_contact" maxlength="10" pattern="(97|98)\d{8}" title="Please enter a 10-digit phone number starting with 97 or 98" required><br><br>


        <label for="owner_email">Owner Email:</label><br>
        <input type="email" id="owner_email" name="owner_email" value="<?php echo htmlspecialchars($owner_email); ?>" required><br><br>

        <label for="address">Address:</label><br>
        <input type="text" id="address" name="address" required><br><br>

        <label for="vehicle_name">Vehicle Name:</label><br>
        <input type="text" id="vehicle_name" name="vehicle_name" required><br><br>

        <label for="vehicle_regnumber">Vehicle Registration Number:</label><br>
        <input type="text" id="vehicle_regnumber" name="vehicle_regnumber" required><br><br>

        <label for="vehicle_model">Vehicle Model:</label><br>
        <input type="text" id="vehicle_model" name="vehicle_model" required><br><br>

        <label for="service_date">Service Date:</label><br>
        <input type="date" id="service_date" name="service_date" required><br><br>
        


       <!-- Updated services selection to checkboxes -->
<label for="service_type">Services:</label><br>
<?php
if (mysqli_num_rows($services_result) > 0) {
    while ($service = mysqli_fetch_assoc($services_result)) {
        echo '<input type="checkbox" id="service_' . htmlspecialchars($service['service']) . '" name="service_type[]" value="' . htmlspecialchars($service['service']) . '">';
        echo '<label for="service_' . htmlspecialchars($service['service']) . '">' . htmlspecialchars($service['service']) . '</label><br>';
    }
} else {
    echo '<p>No services available</p>';
}
?>
<br>




        <label for="request_type">Request Type:</label><br>
        <select id="request_type" name="request_type" required>
            <option value="Drop Off">Drop Off</option>
            <option value="Pick Up">Pick Up</option>
        </select><br><br>

        <label for="problem_description">Problem Description:</label><br>
        <textarea id="problem_description" name="problem_description" rows="4" cols="50" required></textarea><br><br>

        <button type="submit">Submit Service Request</button>
        <button type="button" onclick="window.history.back();">Go Back</button>
    </form>
</body>
</html>



<?php include('includes/footer.php'); ?>
