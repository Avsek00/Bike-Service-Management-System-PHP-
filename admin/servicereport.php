<?php
session_start();
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

<style>
    @media print {
        .print-content {
            display: block !important;
        }

        .col-sm-6, .content-header, .content-footer, .content-sidebar, .breadcrumb, .form-group, .btn {
            display: none !important;
        }
    }
</style>

<div class="content-wrapper">
    <div class="content-header print-content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2 class="m-0">Generate Service Report</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Service Report</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center">
                            <h1 class="card-title">Bhairab Bike Service Center</h1>
                        </div>

                        <div class="card-body">
                            <form action="servicereport.php" method="POST">
                                <div class="form-group">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="generate_report" class="btn btn-primary">Generate Report</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php
                    if (isset($_POST['generate_report'])) {
                        $start_date = $_POST['start_date'];
                        $end_date = $_POST['end_date'];

                        $query = "
                            SELECT sr.id, sr.owner_name, sr.owner_email, sr.vehicle_name, sr.date_created, sr.service_type, p.total_price, ts.status
                            FROM service_requests sr
                            LEFT JOIN payment p ON sr.id = p.customer_id
                            LEFT JOIN time_slot ts ON sr.id = ts.id
                            WHERE sr.date_created BETWEEN ? AND ?
                        ";

                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("ss", $start_date, $end_date);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            echo '<div class="card mt-4">
                                    <div class="card-header">
                                        <h3 class="card-title">Service Report from ' . htmlspecialchars($start_date) . ' to ' . htmlspecialchars($end_date) . '</h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Customer ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Vehicle Name</th>
                                                    <th>Date Created</th>
                                                    <th>Service Type</th>
                                                    <th>Total Price (including VAT)</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                            while ($row = $result->fetch_assoc()) {
                                // Fetch service price for each selected service
                                $serviceTypes = explode(", ", $row['service_type']);
                                $totalServicePrice = 0;
                                foreach ($serviceTypes as $serviceType) {
                                    $serviceQuery = "SELECT price FROM service_list WHERE service = ?";
                                    $stmtService = $conn->prepare($serviceQuery);
                                    $stmtService->bind_param("s", $serviceType);
                                    $stmtService->execute();
                                    $serviceResult = $stmtService->get_result();
                                    if ($serviceResult->num_rows > 0) {
                                        $serviceData = $serviceResult->fetch_assoc();
                                        $totalServicePrice += $serviceData['price'];
                                    }
                                    $stmtService->close(); // Close the statement after fetching results
                                }

                                // Calculate VAT (13%)
                                $vat = $totalServicePrice * 0.13;

                                // Fetch additional price from the payment table
                                $additionalPrice = isset($additionalPrices[$row['id']]) ? $additionalPrices[$row['id']] : 0;

                                // Calculate total price
                                $totalPrice = $totalServicePrice + $additionalPrice + $vat;

                                echo '<tr>
                                        <td>' . htmlspecialchars($row['id']) . '</td>
                                        <td>' . htmlspecialchars($row['owner_name']) . '</td>
                                        <td>' . htmlspecialchars($row['owner_email']) . '</td>
                                        <td>' . htmlspecialchars($row['vehicle_name']) . '</td>
                                        <td>' . htmlspecialchars($row['date_created']) . '</td>
                                        <td>' . htmlspecialchars($row['service_type']) . '</td>
                                        <td>Rs. ' . number_format($totalPrice, 2) . '</td>'; // Display total price formatted as currency

                                $status = htmlspecialchars($row['status']);
                                switch ($status) {
                                    case 'active':
                                        echo '<td><span class="badge badge-success">Active</span></td>';
                                        break;
                                    case 'inactive':
                                        echo '<td><span class="badge badge-danger">Inactive</span></td>';
                                        break;
                                    case 'pending':
                                        echo '<td><span class="badge badge-warning">Pending</span></td>';
                                        break;
                                    case 'completed':
                                        echo '<td><span class="badge badge-info">Completed</span></td>';
                                        break;
                                    default:
                                        echo '<td><span class="badge badge-secondary">' . $status . '</span></td>';
                                        break;
                                }

                                echo '</tr>';
                            }

                            echo '</tbody>
                                </table>
                            </div>
                        </div>';
                        } else {
                            echo '<div class="alert alert-warning mt-4">No records found for the selected date range.</div>';
                        }

                        $stmt->close(); // Close the main statement object after using it
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center mt-3 print-content">
    <button onclick="window.print()" class="btn btn-primary">Print Report</button>
</div>

<?php include('includes/footer.php'); ?>
