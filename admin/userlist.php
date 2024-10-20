<?php
session_start();
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
            <h1 class="m-0">Customers </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Customers </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customers who have used our services</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>VehicleName</th>
                    <th>VehicleReg</th>
                    <th>VehicleModel</th>
                   </tr>
                  </thead>
                  <tbody>
                    <?php 
                    
                    $query = "SELECT * From service_requests";
                    $query_run = mysqli_query($conn,$query);

                    if(mysqli_num_rows($query_run) > 0){

                      foreach($query_run as $row){
                        ?>

                        

                  <tr>
                    
                    <td><?php echo $row['owner_name']; ?></td>
                    <td><?php echo $row['owner_contact']; ?></td>
                    <td> <?php echo $row['owner_email']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['vehicle_name']; ?></td>
                    <td><?php echo $row['vehicle_regnumber']; ?> </td>
                    <td><?php echo $row['vehicle_model']; ?></td>
                    
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

<?php

include('includes/footer.php');
?>
