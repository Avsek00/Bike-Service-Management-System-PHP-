<?php
session_start();
include('config/dbcon.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $query = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Your message has been sent successfully.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to send your message. Please try again.";
        $_SESSION['message_type'] = "danger";
    }

    $stmt->close();
    header("Location: contactus.php");
    exit(0);
}
?>
