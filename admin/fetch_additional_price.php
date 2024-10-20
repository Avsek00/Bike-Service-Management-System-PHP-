<?php
// Include your database connection file
include('config/dbcon.php');

// Check if all necessary fields are set and not empty
if (isset($_POST['customerId'], $_POST['additionalPrice']) && !empty($_POST['customerId']) && !empty($_POST['additionalPrice'])) {
    // Sanitize input to prevent SQL injection
    $customerId = mysqli_real_escape_string($conn, $_POST['customerId']);
    $additionalPrice = mysqli_real_escape_string($conn, $_POST['additionalPrice']);

    // You might also want to validate other input fields here

    // Prepare and execute SQL query to insert additional price data into the database
    $query = "INSERT INTO payment (customer_id, additional_price) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sd", $customerId, $additionalPrice);

    if ($stmt->execute()) {
        // Insert successful
        echo json_encode(array('success' => 'Additional price data inserted successfully.'));
    } else {
        // Insert failed
        echo json_encode(array('error' => 'Error inserting additional price data into the database.'));
    }

    // Close database connection
    $stmt->close();
    $conn->close();
} else {
    // Not all necessary fields are set or empty
    echo json_encode(array('error' => 'Missing or empty required fields.'));
}
?>
