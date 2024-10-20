<?php
session_start();

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Send Mail</h1>
                </div>
                <div class="col-sm-6">
                    <!-- Modal for sending bulk emails -->
                    <div class="modal fade" id="bulkEmailModal" tabindex="-1" aria-labelledby="bulkEmailModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="bulkEmailModalLabel">Notify in Bulk </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="sendbulkmail_code.php" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="start_date">Start Date:</label>
                                            <input type="date" id="start_date" name="start_date" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="end_date">End Date:</label>
                                            <input type="date" id="end_date" name="end_date" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject">Subject:</label>
                                            <input type="text" id="subject" name="subject" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="message">Message:</label>
                                            <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="attachment">Attachment:</label>
                                            <input type="file" id="attachment" name="attachment" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="sendbulkmail_code" class="btn btn-primary">Notify in Bulk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Mail list</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <?php if(isset($_SESSION['mail_status'])): ?>
                <div class="alert alert-success">
                    <?php 
                        echo $_SESSION['mail_status']; 
                        unset($_SESSION['mail_status']);
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Service list</h3>
            <a href="#" data-toggle="modal" data-target="#bulkEmailModal" class="btn btn-primary float-sm-right">Notify in Bulk</a>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Customer Email</th>
                        <th>Send Mail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $query = "SELECT * FROM service_requests";
                    $query_run = mysqli_query($conn, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $row) {
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['owner_email']; ?></td>
                                <td>
                                    <a href="sendmail.php?email=<?php echo urlencode($row['owner_email']); ?>" class="btn btn-primary">
                                        <span class="badge badge-light">Notify User</span>
                                    </a>
                                </td>
                                <td>
                                    <a href="" class="btn btn-info btn-sm">Edit</a>
                                    <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deletebtn">Delete</button>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="4">No Record Found</td>
                        </tr>
                        <?php
                    }
                    ?>
                  </tbody>
              </table>
          </div>
      </div>
      <!-- /.content-header -->
</div>

<?php include('includes/footer.php'); ?>
