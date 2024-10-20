<!-- mechanic list -->
<?php

include('authentication.php');
include('config/dbcon.php');

if(isset($_POST['logout_btn']))
{
    session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_admin']);
    
    $_SESSION['status'] =  "Logged out sucessfully";
    header('Location: login.php');
    exit(0);
}

if(isset($_POST['Addmechanic']))
{
    $Mname = $_POST['Mname'];
    $Mcontact = $_POST['Mcontact'];

    $user_query = "INSERT into mechanic_list (mechanic_name,mechanic_contact) values ('$Mname','$Mcontact')";
    $user_query_run = mysqli_query($conn,$user_query);

    if($user_query_run){

        $_SESSION['status'] = "Mechanic added successfully";
        header("Location: mechaniclist.php");



    }
    else{

        $_SESSION['status'] = "Mechanic additon failed";
        header("Location: mechaniclist.php");


    }
  
}

if(isset($_POST['DeleteMechanicbtn']))
{
    $userid = $_POST['delete_id'];
    $query = "DELETE FROM  mechanic_list WHERE id='$userid' ";
    $query_run = mysqli_query($conn,$query); 

    if($user_query_run){

        $_SESSION['status'] = "Mechanic deleted successfully";
        header("Location: mechaniclist.php");

    }
    else{

        $_SESSION['status'] = "Mechanic deleted successfully";
        header("Location: mechaniclist.php");

    }
  
}


?>





<!-- 
time slot -->

<?php
session_start();
include('config/dbcon.php');

if(isset($_POST['Addslot'])) {
    $Tdate = $_POST['Tdate']; // Assuming you add a field for the date in the modal
    $Ttime = $_POST['Ttime'];
    $cid = $_POST['cid'];
    $admin_comment = $_POST['admin_comment'];
    $status = $_POST['status']; // Added line to capture status
    $mechanic = $_POST['mechanic']; // Added line to capture mechanic

    $user_query = "INSERT into time_slot (Timeslot_Date, Timeslot_Time, id, admin_comment, status, mechanic) values ('$Tdate', '$Ttime', '$cid', '$admin_comment', '$status', '$mechanic')";
    $user_query_run = mysqli_query($conn, $user_query);

    if($user_query_run){
        $_SESSION['reportstatus'] = "Time slot added successfully";
        header("Location: report.php");
    } else {
        $_SESSION['reportstatus'] = "Time slot addition failed";
        header("Location: report.php");
    }
}

if(isset($_POST['DeleteTimeslotbtn'])) {
    $userid = $_POST['delete_id'];
    $query = "DELETE FROM time_slot WHERE id='$userid' ";
    $query_run = mysqli_query($conn, $query); 

    if($query_run){
        $_SESSION['status'] = "Time slot deleted successfully";
        header("Location: report.php");
    } else {
        $_SESSION['status'] = "Time slot deletion failed";
        header("Location: report.php");
    }
}
?>







<!-- service list -->
<?php
session_start();

include('config/dbcon.php');

if(isset($_POST['Addservice']))
{
    $Sname = $_POST['Sname'];
    $Sdesc = $_POST['Sdescription'];
    $Sprice = $_POST['Sprice'];

    // Sanitize input to prevent SQL injection
    $Sname = mysqli_real_escape_string($conn, $Sname);
    $Sdesc = mysqli_real_escape_string($conn, $Sdesc);
    $Sprice = mysqli_real_escape_string($conn, $Sprice);

    $user_query =  "INSERT INTO service_list (service, description, price) VALUES ('$Sname', '$Sdesc', '$Sprice')";
    $user_query_run = mysqli_query($conn, $user_query);

    if($user_query_run){
        $_SESSION['servicestatus'] = "Service added successfully";
        header("Location: servicelist.php");
        exit(); // Stop script execution after redirect
    }
    else{
        $_SESSION['servicestatus'] = "Service addition failed";
        header("Location: servicelist.php");
        exit(); // Stop script execution after redirect
    }
}

if(isset($_POST['DeleteServicelistbtn']))
{
    $userid = $_POST['delete_id'];
    $query = "DELETE FROM service_list WHERE id='$userid'";
    $query_run = mysqli_query($conn, $query); 

    if($query_run){
        $_SESSION['status'] = "Service deleted successfully";
        header("Location: servicelist.php");
        exit(); // Stop script execution after redirect
    }
    else{
        $_SESSION['status'] = "Failed to delete service";
        header("Location: servicelist.php");
        exit(); // Stop script execution after redirect
    }
}
?>





<!-- 
service req -->


<?php
session_start();

include('config/dbcon.php');

if(isset($_POST['Addstatusmodal']))
{
    $status = $_POST['Sname'];
    $Sdesc = $_POST['Sdescription'];

    $user_query = "INSERT into service_list (service,description) values ('$Sname','$Sdesc')";
    $user_query_run = mysqli_query($conn,$user_query);

    if($user_query_run){

        $_SESSION['servicestatus'] = "Service added successfully";
        header("Location: servicelist.php");



    }
    else{

        $_SESSION['servicestatus'] = "Service additon failed";
        header("Location: servicelist.php");


    }
  
}



if(isset($_POST['DeleteUserbtn']))
{
    $userid = $_POST['delete_id'];
    $query = "DELETE FROM  service_requests WHERE id='$userid' ";
    $query_run = mysqli_query($conn,$query); 

    if($user_query_run){

        $_SESSION['status'] = "Service deleted successfully";
        header("Location: servicerequest.php");

    }
    else{

        $_SESSION['status'] = "Service deleted successfully";
        header("Location: servicerequest.php");

    }
}


?>





