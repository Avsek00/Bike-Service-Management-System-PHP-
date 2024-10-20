<?php
session_start();
include('config/dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerId = $_POST['customerId'];
    $additionalPrice = $_POST['additionalPrice'];

    // Validate inputs
    if (empty($customerId) || !is_numeric($additionalPrice)) {
        echo json_encode(["success" => false, "message" => "Invalid input data"]);
        exit();
    }

    // Fetch the current prices
    $query = "SELECT service_price, vat FROM payment WHERE customer_id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $customerId); // Use "i" for integer customer_id
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            // Record exists, update it
            $servicePrice = $row['service_price'];
            $vat = $row['vat'];
            $totalPrice = $servicePrice + $vat + $additionalPrice;

            // Update the prices in the database
            $updateQuery = "UPDATE payment SET additional_price = ?, total_price = ? WHERE customer_id = ?";
            if ($updateStmt = $conn->prepare($updateQuery)) {
                $updateStmt->bind_param("ddi", $additionalPrice, $totalPrice, $customerId); // "d" for double, "i" for integer
                if ($updateStmt->execute()) {
                    echo json_encode(["success" => true, "additionalPrice" => $additionalPrice, "totalPrice" => $totalPrice]);
                } else {
                    echo json_encode(["success" => false, "message" => "Failed to execute update query"]);
                }
                $updateStmt->close();
            } else {
                echo json_encode(["success" => false, "message" => "Failed to prepare update query"]);
            }
        } else {
            // Record does not exist, insert a new one
            $servicePrice = 0; // Default value if service_price is not provided
            $vat = 0; // Default value if vat is not provided
            $totalPrice = $servicePrice + $vat + $additionalPrice;

            $insertQuery = "INSERT INTO payment (customer_id, service_price, vat, additional_price, total_price) VALUES (?, ?, ?, ?, ?)";
            if ($insertStmt = $conn->prepare($insertQuery)) {
                $insertStmt->bind_param("idddd", $customerId, $servicePrice, $vat, $additionalPrice, $totalPrice);
                if ($insertStmt->execute()) {
                    echo json_encode(["success" => true, "additionalPrice" => $additionalPrice, "totalPrice" => $totalPrice]);
                } else {
                    echo json_encode(["success" => false, "message" => "Failed to execute insert query"]);
                }
                $insertStmt->close();
            } else {
                echo json_encode(["success" => false, "message" => "Failed to prepare insert query"]);
            }
        }
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Failed to prepare select query"]);
    }

    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
?>
