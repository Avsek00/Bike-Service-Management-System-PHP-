<?php
session_start();
include('config/dbcon.php');

// Check if the form is submitted for sending individual mail
if (isset($_POST['send_mail'])) {
    $to_email = $_POST['to_email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $attachment = null;

    // Handle file upload if there's any
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
        $attachment = 'uploads/' . basename($_FILES['attachment']['name']);
        move_uploaded_file($_FILES['attachment']['tmp_name'], $attachment);
    }

    // Insert email data into mailbox table
    $insert_query = "INSERT INTO mailbox (to_email, subject, message, attachment) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ssss", $to_email, $subject, $message, $attachment);

    if ($stmt->execute()) {
        $_SESSION['mail_status'] = "Mail sent successfully.";
    } else {
        $_SESSION['mail_status'] = "Failed to send mail.";
    }

    $stmt->close();
    $conn->close();

    header("Location: sendmail.php");
    exit();
}
?>

<?php include('includes/header.php'); ?>
<?php include('includes/topbar.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Compose Mail</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Compose Mail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Compose New Message</h3>
            </div>
            <div class="card-body">
                <?php if (isset($_SESSION['mail_status'])): ?>
                    <div class="alert alert-success">
                        <?php 
                            echo $_SESSION['mail_status']; 
                            unset($_SESSION['mail_status']);
                        ?>
                    </div>
                <?php endif; ?>
                <form action="sendmail.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="email" name="to_email" class="form-control" placeholder="To:" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" class="form-control" placeholder="Subject:" required>
                    </div>
                    <div class="form-group">
                        <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px" required>
                            Dear Customer,

                            This is to inform you about servicing notice.
                        </textarea>
                    </div>
                    <div class="form-group">
                        <div class="btn btn-default btn-file">
                            <i class="fas fa-paperclip"></i> Attachment
                            <input type="file" name="attachment">
                        </div>
                        <p class="help-block">Max. 32MB</p>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="submit" name="send_mail" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                        </div>
                        <button type="button" onclick="window.location.href = 'userlist.php'" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
