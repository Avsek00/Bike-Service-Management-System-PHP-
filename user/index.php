<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');

// Query to get the number of services done in the current day
$current_date = date('Y-m-d');
$service_count_query = "SELECT COUNT(*) as service_count FROM service_requests WHERE service_date = ?";
$stmt = $conn->prepare($service_count_query);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}
$stmt->bind_param("s", $current_date);

if (!$stmt->execute()) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}

$service_count_result = $stmt->get_result();
if ($service_count_result === false) {
    die('Get result failed: ' . htmlspecialchars($stmt->error));
}

$service_count_row = $service_count_result->fetch_assoc();
$service_count = $service_count_row['service_count'];

$stmt->close();

// Query to fetch all services from the database
$services_query = "SELECT * FROM service_list";
$services_result = mysqli_query($conn, $services_query);

$services = [];
if ($services_result) {
    while ($row = mysqli_fetch_assoc($services_result)) {
        $services[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .content-wrapper {
            padding: 20px;
        }

        .content-header {
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }

        .content-header .breadcrumb {
            padding: 0;
            background: none;
            margin: 0;
        }

        .h1-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 0;
        }

        .h1-container h1 {
            margin: 0;
            font-size: 40px;
            color: #333;
        }

        .info-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 20px 0;
        }

        .info-box {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 300px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .info-box h3 {
            margin: 0;
            font-size: 24px;
            color: #007bff;
        }

        .info-box p {
            margin: 10px 0 0;
            font-size: 16px;
            color: #555;
            align-self: center;
            text-align: right;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 0;
        }

        .services-container {
            padding: 20px 0;
        }

        .service-box {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            margin: 10px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .service-box h4 {
            margin: 0 0 10px 0;
            font-size: 20px;
            color: #007bff;
        }

        .service-box p {
            margin: 0;
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0">Dashboard</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="h1-container">
            <h1>Welcome to Bhairab Bike Service Center</h1>
        </div>

        <div class="info-container">
            <div class="info-box">
                <h3>Operating Days</h3>
                <p>Sunday- Friday</p>
            </div>
            <div class="info-box">
                <h3>Operating Hours</h3>
                <p>9:30 AM - 5:00 PM</p>
            </div>
            <div class="info-box">
                <h3>Today's Services</h3>
                <p><?php echo htmlspecialchars($service_count); ?> / 12</p> 
            </div>
        </div>

        <div class="btn-container">
            <a class="btn btn-primary" href="service_request.php" role="button">Send Service Request</a>
        </div>

        <div class="services-container">
        <h2>Our Services <small>(Prices are excluded of VAT)</small></h2>
            <?php foreach ($services as $service) : ?>
                <div class="service-box">
                    <h4><?php echo htmlspecialchars($service['service']); ?></h4>
                    <p>Price: Rs. <?php echo htmlspecialchars($service['price']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

<?php
include('includes/footer.php');
?>
