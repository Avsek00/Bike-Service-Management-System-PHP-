<?php
session_start();
include('config/dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerId = $_POST['customerId'];
    $newAdditionalPrice = $_POST['additionalPrice'];
    $newServicePrice = $_POST['servicePrice'];
    $newVAT = $_POST['vat'];
    $newTotalPrice = $_POST['totalPrice'];

    // Update the payment record in the database
    $updateQuery = "UPDATE payment SET additional_price = ?, service_price = ?, vat = ?, total_price = ? WHERE customer_id = ?";
    if ($stmt = $conn->prepare($updateQuery)) {
        $stmt->bind_param("ddddd", $newAdditionalPrice, $newServicePrice, $newVAT, $newTotalPrice, $customerId);
        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to execute update query"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Failed to prepare update query"]);
    }

    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
?>
