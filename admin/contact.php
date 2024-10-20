<style>
    /* Add borders to table, th, td */
    table {
        border-collapse: collapse; /* Ensure borders collapse into one another */
        width: 100%; /* Optionally, set table width */
    }
    th, td {
        border: 1px solid lightgray; /* Set border for th and td */
        padding: 8px; /* Add padding for content */
    }
</style>
<?php
session_start();
include('config/dbcon.php');

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
                    <h1 class="m-0">Enquiry form customers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Enquiries</li>
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
                            <h3 class="card-title">Enquiries</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Sender</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch emails for the authenticated user
                                        $query = "SELECT * FROM contact_messages";
                                        $query_run = mysqli_query($conn, $query);

                                        if (mysqli_num_rows($query_run) > 0) {
                                         foreach ($query_run as $row) {
                                          ?>
                                           <tr>
                                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                                    <td class="mailbox-name"><?php echo htmlspecialchars($row['email']); ?></td>
                                                    <td class="mailbox-subject"><b><?php echo htmlspecialchars($row['subject']); ?></b> </td>
                                                  <td>  <?php echo htmlspecialchars($row['message']); ?> </td>
                                                    
                                                    <td class="mailbox-date"><?php echo htmlspecialchars($row['created_at']); ?></td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>No emails found.</td></tr>";
                                        }

                                        
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
