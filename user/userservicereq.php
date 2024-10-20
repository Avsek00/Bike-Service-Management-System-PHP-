<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Request</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">User Request</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">My Request</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Name</th>
                        <th>Vehicle Name</th>
                        <th>Services</th>
                        <th>Request Type</th>
                        <th>Description</th>
                        <th>Date Created</th>
                        <th>Service Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Get the user email from the session
                    $user_email = $_SESSION['auth_user']['user_email'];

                    $query = "SELECT * FROM service_requests WHERE owner_email = '$user_email'";
                    $query_run = mysqli_query($conn, $query);

                    if (mysqli_num_rows($query_run) > 0) {

                        foreach ($query_run as $row) {
                    ?>

                            <tr>
                                <td> <?php echo $row['id']; ?> </td>
                                <td> <?php echo $row['owner_name']; ?> </td>
                                <td> <?php echo $row['vehicle_name']; ?> </td>
                                <td> <?php echo $row['service_type']; ?> </td>
                                <td> <?php echo $row['request_type']; ?> </td>
                                <td> <?php echo $row['problem_description']; ?> </td>
                                <td> <?php echo $row['date_created']; ?> </td>
                                <td> <?php echo $row['service_date']; ?> </td>
                                <td>
                                    <form action="delete_service_request.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this service request?');">
                                        <input type="hidden" name="deleteId" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Cancel Service</button>
                                    </form>
                                </td>
                            </tr>

                    <?php
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="9">No Record Found</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
