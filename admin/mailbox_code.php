<?php
session_start();
include('config/dbcon.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipient = mysqli_real_escape_string($conn, $_POST['recipient']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $attachment = '';

    // Handle file upload if there is any
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES['attachment']['name']);
        $targetFilePath = $targetDir . $fileName;
        
        // Check if file is a valid upload
        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $targetFilePath)) {
            $attachment = $fileName;
        } else {
            $_SESSION['status'] = "File upload failed.";
            header('Location: compose_mail.php');
            exit();
        }
    }

    $sql = "INSERT INTO mailbox (recipient, subject, message, attachment) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $recipient, $subject, $message, $attachment);

    if ($stmt->execute()) {
        $_SESSION['status'] = "Mail sent successfully.";
    } else {
        $_SESSION['status'] = "Mail sending failed.";
    }

    $stmt->close();
    $conn->close();

    header('Location: inbox.php');
    exit();
} else {
    header('Location: compose_mail.php');
    exit();
}
?>
