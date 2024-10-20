<?php
session_start();
include('config/dbcon.php');

if (isset($_POST['Addslot'])) {

    $cid = $_POST['cid'];
    $Ttime = $_POST['Ttime'];
    $admin_comment = $_POST['admin_comment'];
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $mechanic_name = mysqli_real_escape_string($conn, $_POST['mechanic']);

    // Check if the customer ID exists in the service_requests table
    $check_query = "SELECT id FROM service_requests WHERE id = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("i", $cid);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows == 1) {
        // Customer ID exists, proceed to insert time slot, admin comment, mechanic, and status
        $insert_query = "INSERT INTO time_slot (id, Timeslot_Time, admin_comment,  status, mechanic_name) VALUES (?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("issss", $cid, $Ttime, $admin_comment, $status, $mechanic_name); // Updated to include mechanic

        if ($insert_stmt->execute()) {
            $_SESSION['reportstatus'] = "Time slot added successfully.";
            header('Location: report.php');
            exit(); // Stop script execution after redirect
        } else {
            $_SESSION['reportstatus'] = "Error adding time slot: " . $insert_stmt->error;
            header('Location: report.php');
            exit(); // Stop script execution after redirect
        }

        $insert_stmt->close();
    } else {
        // Customer ID does not exist, redirect with error message
        $_SESSION['reportstatus'] = "Customer ID does not exist.";
        header('Location: report.php');
        exit(); // Stop script execution after redirect
    }

    $check_stmt->close();
    $conn->close();
}
?>
