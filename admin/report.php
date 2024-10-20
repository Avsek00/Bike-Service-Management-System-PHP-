<?php
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <?php 
            if(isset($_SESSION['reportstatus'])){
              echo "<h4>".$_SESSION['reportstatus']. "</h4>";
              unset($_SESSION['reportstatus']);
            }
          ?>
          <h1 class="m-0">Report Logs</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Report Logs</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- delete timeslot modal -->
  <div class="modal fade" id="Deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Time Slot</h1>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="code.php" method="POST">
          <div class="modal-body">
            <input type="text" name="delete_id" class="delete_user_id" hidden>
            <p>Are you sure you want to delete this data?</p>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            <button type="submit" name="DeleteTimeslotbtn" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

 <!-- add slot modal -->
<div class="modal fade" id="Addslotmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Slot</h1>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="report-code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Name">Customer ID</label>
                        <input type="number" name="cid" class="form-control" placeholder="ID" required>
                    </div>
                    <div class="form-group">
                        <label for="Ttime">Time Slot</label>
                        <input type="time" name="Ttime" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="admin_comment">Admin Comment</label>
                        <input type="text" name="admin_comment" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="statusActive" value="active" checked>
                                <label class="form-check-label" for="statusActive">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="statusInactive" value="inactive">
                                <label class="form-check-label" for="statusInactive">Inactive</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="statusPending" value="pending">
                                <label class="form-check-label" for="statusPending">Pending</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="statusCompleted" value="completed">
                                <label class="form-check-label" for="statusCompleted">Completed</label>
                            </div>
                        </div>
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
                                    echo '<option value="' . $mechanic_row['mechanic_name'] . '">' . $mechanic_row['mechanic_name'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                    <button type="submit" name="Addslot" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


  <!-- Main content -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Time Slot</h3>
      <a href="" data-toggle="modal" data-target="#Addslotmodal" class="btn btn-primary float-sm-right">Add Slot</a>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Customer ID</th>
            <th>Name</th>
            <th>TimeSlot-Date</th>
            <th>TimeSlot-Time</th>
            <th>Assigned Mechanic</th>
            <th>Status</th>
            <th>Comment</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $query = "SELECT * FROM service_requests";
          $query_run = mysqli_query($conn, $query);

          if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $row1) {
          ?>
          <tr>
            <td><?php echo $row1['id']; ?></td>
            <td><?php echo $row1['owner_name']; ?></td>
            <td><?php echo $row1['service_date']; ?></td>
            <td>
              <?php
              $customer_id = $row1['id'];
              $time_slot_query = "SELECT DATE_FORMAT(Timeslot_Time, '%h:%i %p') AS Timeslot_Time FROM time_slot WHERE id = '$customer_id'";
              $time_slot_result = mysqli_query($conn, $time_slot_query);
              
              if (mysqli_num_rows($time_slot_result) > 0) {
                while ($slot_row = mysqli_fetch_assoc($time_slot_result)) {
                  echo $slot_row['Timeslot_Time'] . "<br>";
                }
              } else {
                echo "No time slots";
              }
              ?>
            </td>

            <td>
              <?php
              $mechanic_query = "SELECT mechanic_name FROM time_slot WHERE id = '$customer_id'";
              $mechanic_result = mysqli_query($conn, $mechanic_query);

              if (mysqli_num_rows($mechanic_result) > 0) {
                  while ($mechanic_row = mysqli_fetch_assoc($mechanic_result)) {
                      echo $mechanic_row['mechanic_name'] . "<br>";
                  }
              } else {
                  echo "No mechanic assigned";
              }
              ?>
            </td>

            <td>
              <?php
              $status_query = "SELECT status FROM time_slot WHERE id = '$customer_id'";
              $status_result = mysqli_query($conn, $status_query);

              if (mysqli_num_rows($status_result) > 0) {
                while ($slot_row = mysqli_fetch_assoc($status_result)) {
                  switch ($slot_row['status']) {
                    case 'active':
                      echo '<span class="badge badge-success">Active</span><br>';
                      break;
                    case 'inactive':
                      echo '<span class="badge badge-danger">Inactive</span><br>';
                      break;
                    case 'pending':
                      echo '<span class="badge badge-warning">Pending</span><br>';
                      break;
                    case 'completed':
                      echo '<span class="badge badge-info">Completed</span><br>';
                      break;
                    default:
                      echo "Unknown";
                      break;
                  }
                }
              } else {
                echo "No status available";
              }
              ?>
            </td>
            <td>
            <?php
              $comment_query = "SELECT admin_comment FROM time_slot WHERE id = '$customer_id'";
              $comment_result = mysqli_query($conn, $comment_query);
              
              if (mysqli_num_rows($comment_result) > 0) {
                while ($slot_row = mysqli_fetch_assoc($comment_result)) {
                  echo $slot_row['admin_comment'] . "<br>";
                }
              } else {
                echo "No comments";
              }
              ?>
            </td>
            <td>
              <a href="timeslot_edit.php?id=<?php echo $row1['id']; ?>" class="btn btn-info">Edit</a>
              <button type="button" value="<?php echo $row1['id']; ?>" class="btn btn-danger btn-sm deletebtn">Delete</button>
            </td>
          </tr>
          <?php
            }
          } else {
          ?>
          <tr>
            <td colspan="10">No Record Found</td>
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
 $(document).ready(function (){ 
    $('.deletebtn').click(function (e) { 
      e.preventDefault();

      var user_id = $(this).val();
      $('.delete_user_id').val(user_id);
      $('#Deletemodal').modal('show');
    });
 });
</script>

<?php include('includes/footer.php'); ?>
