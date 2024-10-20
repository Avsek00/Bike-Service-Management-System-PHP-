<?php
session_start();
if(!isset($_SESSION['auth'])) {
    $_SESSION['auth_status'] = "Login to access dashboard";
    header("Location: login.php");
    exit();
}

include('config/dbcon.php');

if(isset($_GET['id'])) {
    $service_id = $_GET['id'];
    $query = "SELECT * FROM service_requests WHERE id='$service_id'";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) == 1) {
        $row = mysqli_fetch_array($query_run);
    } else {
        $_SESSION['status'] = "No Record Found";
        header("Location: servicerequest.php");
        exit();
    }
}

if(isset($_POST['update_service'])) {
    $service_id = $_POST['service_id'];
    $owner_name = mysqli_real_escape_string($conn, $_POST['owner_name']);
    $vehicle_name = mysqli_real_escape_string($conn, $_POST['vehicle_name']);
    $service_type = mysqli_real_escape_string($conn, $_POST['service_type']);
    $request_type = mysqli_real_escape_string($conn, $_POST['request_type']);
    $problem_description = mysqli_real_escape_string($conn, $_POST['problem_description']);
    $service_date = mysqli_real_escape_string($conn, $_POST['service_date']);

    $query = "UPDATE service_requests SET owner_name='$owner_name', vehicle_name='$vehicle_name', service_type='$service_type', request_type='$request_type', problem_description='$problem_description', service_date='$service_date' WHERE id='$service_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run) {
        $_SESSION['status'] = "Service Request Updated Successfully";
        header("Location: servicerequest.php");
        exit();
    } else {
        $_SESSION['status'] = "Service Request Update Failed";
        header("Location: service_edit.php?id=$service_id");
        exit();
    }
}
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
                    <h1 class="m-0">Edit Service Request</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Edit Service Request</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php if(isset($_SESSION['status'])): ?>
                        <div class="alert alert-info">
                            <?php echo $_SESSION['status']; ?>
                        </div>
                        <?php unset($_SESSION['status']); ?>
                    <?php endif; ?>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Service Request Form</h3>
                        </div>

                        <form action="service_edit.php?id=<?php echo $row['id']; ?>" method="POST">
                            <input type="hidden" name="service_id" value="<?php echo $row['id']; ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="owner_name">Owner Name</label>
                                    <input type="text" name="owner_name" class="form-control" value="<?php echo $row['owner_name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_name">Vehicle Name</label>
                                    <input type="text" name="vehicle_name" class="form-control" value="<?php echo $row['vehicle_name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="service_type">Service Type</label>
                                    <input type="text" name="service_type" class="form-control" value="<?php echo $row['service_type']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="request_type">Request Type</label>
                                    <input type="text" name="request_type" class="form-control" value="<?php echo $row['request_type']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="problem_description">Problem Description</label>
                                    <textarea name="problem_description" class="form-control" required><?php echo $row['problem_description']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="service_date">Service Date</label>
                                    <input type="date" name="service_date" class="form-control" value="<?php echo $row['service_date']; ?>" required>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" name="update_service" class="btn btn-primary">Update Service Request</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<?php include('includes/footer.php'); ?>
<?php include('includes/script.php'); ?>
