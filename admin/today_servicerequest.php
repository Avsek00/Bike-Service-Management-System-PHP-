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
                    <h1 class="m-0">Service Requests for Today</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Service Requests for Today</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Service Request List for Today</h3>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Name</th>
                        <th>Vehicle Name</th>
                        <th>Services</th>
                        <th>Req Type</th>
                        <th>Description</th>
                        <th>Date Created</th>
                        <th>Service requested on</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Fetch service requests for today
                    $current_date = date('Y-m-d');
                    $query = "SELECT * FROM service_requests WHERE service_date = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $current_date);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['owner_name']; ?></td>
                                <td><?php echo $row['vehicle_name']; ?></td>
                                <td><?php echo $row['service_type']; ?></td>
                                <td><?php echo $row['request_type']; ?></td>
                                <td><?php echo $row['problem_description']; ?></td>
                                <td><?php echo $row['date_created']; ?></td>
                                <td><?php echo $row['service_date']; ?></td>
                                <td>
                                    <a href="service_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                    <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deletebtn">Delete</button>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="9">No Service Requests for Today</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('includes/script.php'); ?>
<script>
$(document).ready(function () {
    $('.deletebtn').click(function (e) {
        e.preventDefault();
        var user_id = $(this).val();
        $('.delete_user_id').val(user_id);
        $('#Deletemodal').modal('show');
    });
});
</script>
<?php include('includes/footer.php'); ?>
