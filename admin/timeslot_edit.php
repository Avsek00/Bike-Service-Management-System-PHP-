<?php
session_start();
if (!isset($_SESSION['auth'])) {
    $_SESSION['auth_status'] = "Login to access dashboard";
    header("Location: login.php");
    exit();
}

include('config/dbcon.php');

if (isset($_GET['id'])) {
    $timeslot_id = $_GET['id'];
    $query = "SELECT * FROM time_slot WHERE id='$timeslot_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $row = mysqli_fetch_array($query_run);
    } else {
        $_SESSION['status'] = "No Record Found";
        header("Location: report.php");
        exit();
    }
}

if (isset($_POST['update_timeslot'])) {
    $timeslot_id = $_POST['timeslot_id'];
    $time_slot = mysqli_real_escape_string($conn, $_POST['Ttime']);
    $admin_comment = mysqli_real_escape_string($conn, $_POST['admin_comment']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $mechanic_name = mysqli_real_escape_string($conn, $_POST['mechanic']);

    $query = "UPDATE time_slot SET Timeslot_Time='$time_slot', admin_comment='$admin_comment', status='$status', mechanic_name='$mechanic_name' WHERE id='$timeslot_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['status'] = "Time Slot Updated Successfully";
        header("Location: report.php");
        exit();
    } else {
        $_SESSION['status'] = "Time Slot Update Failed";
        header("Location: timeslot_edit.php?id=$timeslot_id");
        exit();
    }
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
                    <h1 class="m-0">Edit Time Slot</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Edit Time Slot</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

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
                            <h3 class="card-title">Edit Time Slot</h3>
                        </div>

                        <form action="timeslot_edit.php?id=<?php echo $row['id']; ?>" method="POST">
                            <input type="hidden" name="timeslot_id" value="<?php echo $row['id']; ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Ttime">Time Slot</label>
                                    <input type="time" name="Ttime" class="form-control" value="<?php echo $row['Timeslot_Time']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="admin_comment">Admin Comment</label>
                                    <input type="text" name="admin_comment" class="form-control" value="<?php echo $row['admin_comment']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="active" <?php echo ($row['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                                        <option value="inactive" <?php echo ($row['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                        <option value="pending" <?php echo ($row['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                        <option value="completed" <?php echo ($row['status'] == 'completed') ? 'selected' : ''; ?>>Completed</option>
                                    </select>
                                </div>
                                <!-- Mechanic selection dropdown -->
                                <div class="form-group">
                                    <label for="mechanic">Assign Mechanic</label>
                                    <select name="mechanic" class="form-control" required>
                                        <option value="">Select Mechanic</option>
                                        <!-- Populate options dynamically -->
                                        <?php
                                        // Query to fetch mechanics from the database
                                        $mechanic_query = "SELECT mechanic_name FROM mechanic_list";
                                        $mechanic_result = mysqli_query($conn, $mechanic_query);
                                        if (mysqli_num_rows($mechanic_result) > 0) {
                                            while ($mechanic_row = mysqli_fetch_assoc($mechanic_result)) {
                                                echo '<option value="' . $mechanic_row['mechanic_name'] . '"';
                                                if ($mechanic_row['mechanic_name'] == $row['mechanic_name']) {
                                                    echo ' selected';
                                                }
                                                echo '>' . $mechanic_row['mechanic_name'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">No Mechanics Found</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" name="update_timeslot" class="btn btn-primary">Update Time Slot</button>
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
