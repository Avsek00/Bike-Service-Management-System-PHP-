<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');

$user_id = $_SESSION['auth_user']['user_id'];
$query = "SELECT * FROM time_slot WHERE id = '$user_id'";
$query_run = mysqli_query($conn, $query);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Service Info</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Service Info</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Service Info</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Service ID</th>
                        <th>Service Date</th>
                        <th>Service Time</th>
                        <th>Assigned Mechanic</th>
                        <th>Admin Comment</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $row) {
                            ?>

                            <tr>
                                <td> <?php echo $row['id']; ?> </td>
                                <td> <?php
                                    // Fetch service date for this customer from the service_requests table
                                    $customer_id = $row['id'];
                                    $service_date_query = "SELECT service_date FROM service_requests WHERE id = '$customer_id'";
                                    $service_date_result = mysqli_query($conn, $service_date_query);

                                    if (mysqli_num_rows($service_date_result) > 0) {
                                        while ($date_row = mysqli_fetch_assoc($service_date_result)) {
                                            echo $date_row['service_date'] . "<br>";
                                        }
                                    } else {
                                        echo "No service date";
                                    }
                                    ?>
                                </td>
                                <td> <?php
                                    // Convert time to AM/PM format
                                    $time = new DateTime($row['Timeslot_Time']);
                                    echo $time->format('g:i A');
                                    ?> 
                                </td>


                                

<td>
    <?php
    // Fetch assigned mechanic for this customer from the time_slot table
    $customer_id = $row['id'];
    $mechanic_query = "SELECT mechanic_name FROM time_slot WHERE id = '$customer_id'";
    $mechanic_result = mysqli_query($conn, $mechanic_query);

    if (mysqli_num_rows($mechanic_result) > 0) {
        while ($mechanic_row = mysqli_fetch_assoc($mechanic_result)) {
            echo $mechanic_row['mechanic_name'] ? $mechanic_row['mechanic_name'] : "No mechanic assigned";
        }
    } else {
        echo "No mechanic assigned";
    }
    ?>
</td>
                       <td> <?php echo $row['admin_comment']; ?> </td>



                                <td>
                                    <?php
                                    switch ($row['status']) {
                                        case 'active':
                                            echo '<span class="badge badge-success">Active</span>';
                                            break;
                                        case 'inactive':
                                            echo '<span class="badge badge-danger">Inactive</span>';
                                            break;
                                        case 'pending':
                                            echo '<span class="badge badge-warning">Pending</span>';
                                            break;
                                        case 'completed':
                                            echo '<span class="badge badge-info">Completed</span>';
                                            break;
                                        default:
                                            echo 'Unknown';
                                            break;
                                    }
                                    ?>
                                </td>
                            </tr>

                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="4">
                                No Record Found
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
