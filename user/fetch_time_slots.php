<?php
// Start the session
session_start();
include('config/dbcon.php');

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page if not logged in
    header('Location: user_login.php');
    exit;
}

// Database connection parameters
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "bscmss"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user ID from the session
$user_id = $_SESSION['id'];

// Prepare and execute the SQL query to fetch time slots
$sql = "SELECT Timeslot_Time FROM time_slot WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch all the time slots
$time_slots = $result->fetch_all(MYSQLI_ASSOC);

// Close the statement and connection
$stmt->close();
$conn->close();
?>
