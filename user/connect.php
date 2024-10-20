<?php
// Start a session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form inputs
    $ownerName = $_POST['owner_name'];
    $ownerContact = $_POST['owner_contact'];
    $ownerEmail = $_POST['owner_email'];
    $address = $_POST['address'];
    $vehicleName = $_POST['vehicle_name'];
    $vehicleRegNumber = $_POST['vehicle_regnumber'];
    $vehicleModel = $_POST['vehicle_model'];
    $serviceTypeArray = $_POST['service_type']; // No need for sanitization since it's an array
    $serviceType = implode(", ", $serviceTypeArray);
    $servicedate = $_POST['service_date'];
    $requestType = $_POST['request_type'];
    $problemDescription = $_POST['problem_description'];

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

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO service_requests (owner_name, owner_contact, owner_email, address, vehicle_name, vehicle_regnumber, vehicle_model, service_date, service_type, request_type, problem_description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $ownerName, $ownerContact, $ownerEmail, $address, $vehicleName, $vehicleRegNumber, $vehicleModel, $servicedate, $serviceType, $requestType, $problemDescription);

    // Execute the query
    if ($stmt->execute()) {
        // Set success message in session
        $_SESSION['success_message'] = "Service request submitted successfully.";
        // Redirect to userservicereq.php
        header('Location: userservicereq.php');
        exit(); // Stop further execution
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
