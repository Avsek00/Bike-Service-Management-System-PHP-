<?php
// Include your database connection script here
include('config/dbcon.php');

// Check if all required parameters are provided
if(isset($_POST['customerId']) && isset($_POST['servicePrice']) && isset($_POST['vat']) && isset($_POST['additionalPrice']) && isset($_POST['totalPrice'])) {
    // Extract data from the POST request
    $customerId = $_POST['customerId'];
    $servicePrice = $_POST['servicePrice'];
    $vat = $_POST['vat'];
    $additionalPrice = $_POST['additionalPrice'];
    $totalPrice = $_POST['totalPrice'];

    // Prepare and execute the INSERT query
    $query = "INSERT INTO payment (customer_id, service_price, vat, additional_price, total_price) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("idddd", $customerId, $servicePrice, $vat, $additionalPrice, $totalPrice);
    $stmt->execute();

    // Check if the insertion was successful
    if($stmt->affected_rows > 0) {
        echo json_encode(['success' => 'Payment details inserted successfully']);
    } else {
        echo json_encode(['error' => 'Failed to insert payment details']);
    }
} else {
    // Error: Required parameters not provided
    echo json_encode(['error' => 'Missing required parameters']);
}

// Close the database connection
$stmt->close();
$conn->close();
?>
