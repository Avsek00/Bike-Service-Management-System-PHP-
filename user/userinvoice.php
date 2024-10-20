<?php

include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');


$query = "SELECT customer_id, additional_price, service_price, vat, total_price FROM payment";
$additionalPrices = array();

$result = mysqli_query($conn, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $additionalPrices[$row['customer_id']] = $row['additional_price'];
    }
}

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">User Invoice</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">My Invoice</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Name</th>
                        <th>Chosen Services</th>
                        <th>Services Price</th>
                        <th>VAT (13%)</th>
                        <th>Additional Price</th>
                        <th>Total</th>
                        
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Get the user email from the session
                    $user_email = $_SESSION['auth_user']['user_email'];

                    $query = "SELECT * FROM service_requests WHERE owner_email = '$user_email'";
                    $query_run = mysqli_query($conn, $query);

                    if (mysqli_num_rows($query_run) > 0) {

                        foreach ($query_run as $row) {
                    ?>

                            <tr>
                                <td> <?php echo $row['id']; ?> </td>
                                <td> <?php echo $row['owner_name']; ?> </td>
                                
                                <td> <?php echo $row['service_type']; ?> </td>
                                <?php
                                    // Fetch service price for each selected service
                                    $serviceTypes = explode(", ", $row['service_type']);
                                    $totalServicePrice = 0;
                                    foreach ($serviceTypes as $serviceType) {
                                        $serviceQuery = "SELECT price FROM service_list WHERE service = ?";
                                        $stmt = $conn->prepare($serviceQuery);
                                        $stmt->bind_param("s", $serviceType);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        if ($result->num_rows > 0) {
                                            $serviceData = $result->fetch_assoc();
                                            $totalServicePrice += $serviceData['price'];
                                        }
                                        $stmt->close();
                                    }

                                    // Calculate VAT (13%)
                                    $vat = $totalServicePrice * 0.13;

                                    // Fetch additional price from the payment table
                                    $additionalPrice = isset($additionalPrices[$row['id']]) ? $additionalPrices[$row['id']] : 0;

                                    // Calculate total price
                                    $totalPrice = $totalServicePrice + $additionalPrice + $vat;
                                    ?>
                                <td>Rs. <?php echo $totalServicePrice; ?></td>
                                <td>Rs. <?php echo $vat; ?></td>
                                <td>Rs. <?php echo $additionalPrice; ?></td>
                                <td>Rs. <?php echo $totalPrice; ?></td>
                                
                                
                                
                                
                                
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



<?php
include('includes/footer.php');
?>
