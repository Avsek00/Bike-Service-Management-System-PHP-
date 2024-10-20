<?php

session_start();

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');

?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Modal -->
<div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Mechanic</h1>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" "></button>
      </div>
      <form action="code.php" method="POST">
      <div class="modal-body">
        <div class="form-group">
          <label for="Name">Mechanic Name</label>
          <input type="text" name="Mname" class="form-control" placeholder="Name">
        </div>

        <div class="form-group">
          <label for="Name">Mechanic Contact</label>
          <input type="text" name="Mcontact" class="form-control" placeholder="Contact" maxlength="10">
        </div>

      </div>
      

      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary" ">Close</button>
        <button type="submit" name="Addmechanic" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>



<!-- delete mechanic -->
<div class="modal fade" id="Deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Mechanic</h1>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" "></button>
      </div>
      <form action="code.php" method="POST">
      <div class="modal-body">
        <input type="text" name="delete_id"class="delete_user_id" value="<?php echo $row['id']; ?>">
        <p>
          Are you sure. you want to delete this data?
        </p>
       

      </div>
      

      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary" ">Close</button>
        <button type="submit" name="DeleteMechanicbtn" class="btn btn-primary ">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>




<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
<?php 
      if(isset($_SESSION['status'])){
        echo "<h4>".$_SESSION['status']. "</h4>";
        unset($_SESSION['status']);


      }

?>

            <h1 class="m-0">Mechanic List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Mechanic List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

      <div class="card">
              <div class="card-header">
                <h3 class="card-title">Mechanic list</h3>
                <a href="" data-toggle="modal" data-target="#AddUserModal" class="btn btn-primary float-sm-right" >Add Mechanic</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Mechanic ID</th>
                    <th>Mechanic Name</th>
                    <th>Contact</th>
                    <th>Action</th>
                
                   </tr>
                  </thead>
                  <tbody>
                    <?php 
                    
                    $query = "SELECT * From mechanic_list";
                    $query_run = mysqli_query($conn,$query);

                    if(mysqli_num_rows($query_run) > 0){

                      foreach($query_run as $row){
                        ?>

                  <tr>
                    <td> <?php echo $row['id']; ?> </td>
                    <td> <?php echo $row['mechanic_name']; ?></td>
                    <td><?php echo $row['mechanic_contact']; ?></td>
                    <td>
                    <a href="mechaniclist_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                      <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deletebtn">Delete</button>
                    </td>
                    
                  </tr>



                        <?php



                      }

                    }
                    else{
                      ?>
                      <tr>
                        <td>
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
    <!-- /.content-header -->







</div>







<script>
 $(document).ready(function (){ 
    $('.deletebtn').click(function (e) { 
      e.preventDefault();

      var user_id = $(this).val();
      // console.log(user_id);
      $('.delete_user_id').val(user_id);
      $('#Deletemodal').modal('show');
      
    });

 });


</script>


<?php include('includes/footer.php'); ?> 

