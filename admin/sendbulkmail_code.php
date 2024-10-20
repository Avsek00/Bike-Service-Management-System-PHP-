<?php
session_start();
include('config/dbcon.php');

// Check if the form is submitted for sending bulk mail
if (isset($_POST['sendbulkmail_code'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $attachment = null;

    // Handle file upload if there's any
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
        $attachment = 'uploads/' . basename($_FILES['attachment']['name']);
        move_uploaded_file($_FILES['attachment']['tmp_name'], $attachment);
    }

    // Fetch emails from service_requests within the date range
    $fetch_query = "SELECT owner_email FROM service_requests WHERE date_created BETWEEN ? AND ?";
    $stmt = $conn->prepare($fetch_query);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $to_email = $row['owner_email'];

            // Insert email data into mailbox table
            $insert_query = "INSERT INTO mailbox (to_email, subject, message, attachment) VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($insert_query);
            $stmt_insert->bind_param("ssss", $to_email, $subject, $message, $attachment);
            $stmt_insert->execute();
            $stmt_insert->close();
        }
        $_SESSION['mail_status'] = "Bulk mail sent successfully.";
    } else {
        $_SESSION['mail_status'] = "No emails found in the specified date range.";
    }

    $stmt->close();
    $conn->close();

    header("Location: mailbox.php");
    exit();
}
?>
