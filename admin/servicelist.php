<?php

session_start();

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');

?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Modal -->
<!-- Add Service Modal -->
<div class="modal fade" id="Addservicemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Service</h1>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="code.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="Sname">Service Name</label>
            <input type="text" name="Sname" class="form-control" placeholder="Name" required>
          </div>
          <div class="form-group">
            <label for="Sdescription">Service Description</label>
            <input type="text" name="Sdescription" class="form-control" placeholder="Description" required>
          </div>
          <div class="form-group">
            <label for="Sprice">Price (excluded of VAT) (Rs.)</label>
            <input type="number" step="0.01" name="Sprice" class="form-control" placeholder="Price" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
          <button type="submit" name="Addservice" class="btn btn-primary">Save</button>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Service</h1>
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
        <button type="submit" name="DeleteServicelistbtn" class="btn btn-primary ">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- delete usr -->



    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

          <?php 
      if(isset($_SESSION['servicestatus'])){
        echo "<h4>".$_SESSION['servicestatus']. "</h4>";
        unset($_SESSION['servicestatus']);


      }

?>

            <h1 class="m-0">Service List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Service List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

      <div class="card">
              <div class="card-header">
                <h3 class="card-title">Service list </h3>
                <a href="" data-toggle="modal" data-target="#Addservicemodal" class="btn btn-primary float-sm-right" >Add Service</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Service ID</th>
                    <th>Service Name</th>
                    <th>Description</th>
                    <th>Price (Rs.)<br><small class="text-muted">excluded of VAT</small></th>
                    <th>Action</th>
                
                   </tr>
                  </thead>
                  <tbody>
                    <?php 
                    
                    $query = "SELECT * From service_list";
                    $query_run = mysqli_query($conn,$query);

                    if(mysqli_num_rows($query_run) > 0){

                      foreach($query_run as $row3){
                        ?>

                  <tr>
                    <td> <?php echo $row3['id']; ?> </td>
                    <td> <?php echo $row3['service']; ?></td>
                    <td><?php echo $row3['description']; ?></td>
                    <td><?php echo "Rs. " . $row3['price']; ?></td>
                    <td>
                    <a href="servicelist_edit.php?id=<?php echo $row3['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                      <button type="button" value="<?php echo $row3['id']; ?> " class="btn btn-danger btn-sm deletebtn">Delete</button>
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
    </div>
   


    </div>







 <?php include('includes/script.php'); ?>

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
