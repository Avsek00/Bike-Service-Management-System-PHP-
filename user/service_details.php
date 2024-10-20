<?php
include('config/dbcon.php');

if (isset($_GET['service_id'])) {
    $serviceId = $_GET['service_id'];

    // Fetch service details from the database
    $query = "SELECT * FROM service_list WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $serviceId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($service = $result->fetch_assoc()) {
        // Display service details
        echo "<h1>{$service['service']}</h1>";
        echo "<p>{$service['description']}</p>";
        echo "<p>Price: Rs. {$service['price']}</p>";
    } else {
        echo "Service not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
