<?php
session_start();
include('config/dbcon.php');

// Ensure the user is authenticated (assuming you have a similar authentication check as in the admin panel)
if (!isset($_SESSION['auth_user'])) {
    header("Location: login.php");
    exit();
}

// Get the authenticated user's email
$user_email = $_SESSION['auth_user']['user_email'];
?>

<?php include('includes/header.php'); ?>
<?php include('includes/topbar.php'); ?>
<?php include('includes/sidebar.php'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Inbox</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Inbox</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Inbox</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Star</th>
                                            <th>Sender</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th>Attachment</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch emails for the authenticated user
                                        $query = "SELECT * FROM mailbox WHERE to_email = ?";
                                        $stmt = $conn->prepare($query);
                                        $stmt->bind_param("s", $user_email);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
 
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td>
                                                    <td class="mailbox-name">BBSC Admin</td>
                                                    <td class="mailbox-subject"><b><?php echo htmlspecialchars($row['subject']); ?></b> </td>
                                                  <td>  <?php echo htmlspecialchars($row['message']); ?> </td>
                                                    <td class="mailbox-attachment"><?php if ($row['attachment']) echo '<i class="fas fa-paperclip"></i>'; ?></td>
                                                    <td class="mailbox-date"><?php echo htmlspecialchars($row['created_at']); ?></td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>No emails found.</td></tr>";
                                        }

                                        $stmt->close();
                                        $conn->close();
                                        ?>
                                    </tbody>
                                </table>
                                <!-- /.table -->
                            </div>
                            <!-- /.mail-box-messages -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php include('includes/footer.php'); ?>
