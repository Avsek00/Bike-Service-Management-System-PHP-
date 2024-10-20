<?php
session_start();
if (!isset($_SESSION['auth'])) {
    $_SESSION['auth_status'] = "Login to access dashboard";
    header("Location: login.php");
    exit();
}

include('config/dbcon.php');

if (isset($_GET['id'])) {
    $service_id = $_GET['id'];
    $query = "SELECT * FROM service_list WHERE id='$service_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $row = mysqli_fetch_array($query_run);
    } else {
        $_SESSION['status'] = "No Record Found";
        header("Location: servicelist.php");
        exit();
    }
}

if (isset($_POST['update_service'])) {
    $service_id = $_POST['service_id'];
    $service_name = mysqli_real_escape_string($conn, $_POST['service_name']);
    $service_description = mysqli_real_escape_string($conn, $_POST['service_description']);
    $servicePrice = mysqli_real_escape_string($conn, $_POST['Sprice']);

    $query = "UPDATE service_list SET service='$service_name', description='$service_description', price ='$servicePrice' WHERE id='$service_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['status'] = "Service Updated Successfully";
        header("Location: servicelist.php");
        exit();
    } else {
        $_SESSION['status'] = "Service Update Failed";
        header("Location: servicelist_edit.php?id=$service_id");
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
                    <h1 class="m-0">Edit Service</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Edit Service</li>
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
                    <?php if (isset($_SESSION['status'])): ?>
                        <div class="alert alert-info">
                            <?php echo $_SESSION['status']; ?>
                        </div>
                        <?php unset($_SESSION['status']); ?>
                    <?php endif; ?>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Service</h3>
                        </div>

                        <form action="servicelist_edit.php?id=<?php echo $row['id']; ?>" method="POST">
                            <input type="hidden" name="service_id" value="<?php echo $row['id']; ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="service_name">Service Name</label>
                                    <input type="text" name="service_name" class="form-control" value="<?php echo $row['service']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="service_description">Service Description</label>
                                    <textarea name="service_description" class="form-control" required><?php echo $row['description']; ?></textarea>
                                </div>
                                <div class="form-group">
            <label for="Sprice">Price (Rs.)</label>
            <input type="number" step="0.01" name="Sprice" class="form-control" placeholder="Price" required>
            <small class="form-text text-muted">excluded of VAT</small>
          </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" name="update_service" class="btn btn-primary">Update Service</button>
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
