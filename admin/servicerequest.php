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
                    <h1 class="m-0">Service Request</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Service Request</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- delete mechanic -->
        <div class="modal fade" id="Deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Service</h1>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="delete_id" class="delete_user_id">
                            <p>Are you sure you want to delete this data?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                            <button type="submit" name="DeleteUserbtn" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Service request list</h3>
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
                        $query = "SELECT * FROM service_requests";
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
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
</div>


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
