<?php
include('config/dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the deleteId is set and not empty
    if (isset($_POST['deleteId']) && !empty($_POST['deleteId'])) {
        // Sanitize the input
        $delete_id = mysqli_real_escape_string($conn, $_POST['deleteId']);

        // Delete the service request from the database
        $delete_query = "DELETE FROM service_requests WHERE id = '$delete_id'";
        $delete_result = mysqli_query($conn, $delete_query);

        if ($delete_result) {
            // Redirect back to the main page after deletion
            header("Location: userservicereq.php");
            exit();
        } else {
            // Handle the error, if any
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    // If the request method is not POST, redirect back to the main page
    header("Location: userservicereq.php");
    exit();
}
?>
