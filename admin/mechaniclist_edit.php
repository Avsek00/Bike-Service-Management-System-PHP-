<?php
session_start();
if (!isset($_SESSION['auth'])) {
    $_SESSION['auth_status'] = "Login to access dashboard";
    header("Location: login.php");
    exit();
}

include('config/dbcon.php');

if (isset($_GET['id'])) {
    $mechanic_id = $_GET['id'];
    $query = "SELECT * FROM mechanic_list WHERE id='$mechanic_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $row = mysqli_fetch_array($query_run);
    } else {
        $_SESSION['status'] = "No Record Found";
        header("Location: mechaniclist.php");
        exit();
    }
}

if (isset($_POST['update_mechanic'])) {
    $mechanic_id = $_POST['mechanic_id'];
    $mechanic_name = mysqli_real_escape_string($conn, $_POST['mechanic_name']);
    $mechanic_contact = mysqli_real_escape_string($conn, $_POST['mechanic_contact']);

    $query = "UPDATE mechanic_list SET mechanic_name='$mechanic_name', mechanic_contact='$mechanic_contact' WHERE id='$mechanic_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['status'] = "Mechanic Updated Successfully";
        header("Location: mechaniclist.php");
        exit();
    } else {
        $_SESSION['status'] = "Mechanic Update Failed";
        header("Location: mechaniclist_edit.php?id=$mechanic_id");
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
                    <h1 class="m-0">Edit Mechanic</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Edit Mechanic</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Mechanic</h3>
                        </div>
                        <form action="mechaniclist_edit.php" method="POST">
                            <div class="card-body">
                                <input type="hidden" name="mechanic_id" value="<?php echo $row['id']; ?>">
                                <div class="form-group">
                                    <label for="mechanic_name">Mechanic Name</label>
                                    <input type="text" name="mechanic_name" class="form-control" value="<?php echo $row['mechanic_name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="mechanic_contact">Mechanic Contact</label>
                                    <input type="text" name="mechanic_contact" class="form-control" value="<?php echo $row['mechanic_contact']; ?>" maxlength="10" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="update_mechanic" class="btn btn-primary">Update</button>
                                <a href="mechaniclist.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>
