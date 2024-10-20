
<?php
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');

// Query to fetch additional prices from the payment table
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
                    <h1 class="m-0">Payment Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Payment Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Customers who have used our services</h3>
        </div>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * From service_requests";
                    $query_run = mysqli_query($conn, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $row) {
                    ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['owner_name']; ?></td>
                                <td class="chosen-services-column"><?php echo $row['service_type']; ?></td>

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
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="openAdditionalPriceModal('<?php echo $row['id']; ?>')">Enter Additional Price</button>
                                    <!-- <button type="button" class="btn btn-info btn-sm" onclick="editAdditionalPrice('<?php echo $row['id']; ?>')">Edit</button> -->
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="8">No Record Found</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Additional Price Modal -->
<div class="modal fade" id="additionalPriceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter Additional Price</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="additionalPriceForm">
                    <div class="form-group">
                        <label for="additionalPriceInput">Additional Price:</label>
                        <input type="number" class="form-control" id="additionalPriceInput" name="additionalPrice" step="0.01">
                    </div>
                    <input type="hidden" id="customerId" name="customerId">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal HTML -->
<div id="editAdditionalPriceModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Additional Price</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editAdditionalPriceForm">
                    <div class="form-group">
                        <label for="editAdditionalPriceInput">New Additional Price:</label>
                        <input type="number" class="form-control" id="editAdditionalPriceInput" name="newAdditionalPrice" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="editServicePriceInput">Service Price:</label>
                        <input type="number" class="form-control" id="editServicePriceInput" name="servicePrice" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="editVATInput">VAT (13%):</label>
                        <input type="number" class="form-control" id="editVATInput" name="vat" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="editTotalPriceInput">Total Price:</label>
                        <input type="number" class="form-control" id="editTotalPriceInput" name="totalPrice" step="0.01">
                    </div>
                    <input type="hidden" id="editCustomerId" name="customerId">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    function openAdditionalPriceModal(customerId) {
        $('#customerId').val(customerId);
        $('#additionalPriceModal').modal('show');
    }

    function editAdditionalPrice(customerId) {
        var $row = $('table tbody tr').filter(function() {
            return $(this).find('td:first').text() == customerId;
        });

        var servicePrice = parseFloat($row.find('td:eq(3)').text().replace('Rs. ', ''));
        var vat = parseFloat($row.find('td:eq(4)').text().replace('Rs. ', ''));
        var additionalPrice = parseFloat($row.find('td:eq(5)').text().replace('Rs. ', ''));
        var totalPrice = parseFloat($row.find('td:eq(6)').text().replace('Rs. ', ''));

        $('#editAdditionalPriceInput').val(additionalPrice);
        $('#editServicePriceInput').val(servicePrice);
        $('#editVATInput').val(vat);
        $('#editTotalPriceInput').val(totalPrice);
        $('#editCustomerId').val(customerId);

        $('#editAdditionalPriceModal').modal('show');
    }

    $('#additionalPriceForm').on('submit', function(e) {
        e.preventDefault();
        var customerId = $('#customerId').val();
        var additionalPrice = parseFloat($('#additionalPriceInput').val());

        $.post('save_additional_price.php', {
            customerId: customerId,
            additionalPrice: additionalPrice
        }, function(response) {
            if (response.success) {
                var $row = $('table tbody tr').filter(function() {
                    return $(this).find('td:first').text() == customerId;
                });

                var servicePrice = parseFloat($row.find('td:eq(3)').text().replace('Rs. ', ''));
                var vat = parseFloat($row.find('td:eq(4)').text().replace('Rs. ', ''));
                var totalPrice = servicePrice + vat + additionalPrice;

                $row.find('td:eq(5)').text('Rs. ' + additionalPrice.toFixed(2));
                $row.find('td:eq(6)').text('Rs. ' + totalPrice.toFixed(2));

                $('#additionalPriceModal').modal('hide');
                $('#additionalPriceForm')[0].reset();
            } else {
                alert('Failed to save additional price.');
            }
        }, 'json');
    });

    $('#editAdditionalPriceForm').on('submit', function(e) {
        e.preventDefault();
        var customerId = $('#editCustomerId').val();
        var newAdditionalPrice = parseFloat($('#editAdditionalPriceInput').val());
        var newServicePrice = parseFloat($('#editServicePriceInput').val());
        var newVAT = parseFloat($('#editVATInput').val());
        var newTotalPrice = parseFloat($('#editTotalPriceInput').val());

        $.post('update_additional_price.php', {
            customerId: customerId,
            additionalPrice: newAdditionalPrice,
            servicePrice: newServicePrice,
            vat: newVAT,
            totalPrice: newTotalPrice
        }, function(response) {
            if (response.success) {
                var $row = $('table tbody tr').filter(function() {
                    return $(this).find('td:first').text() == customerId;
                });

                $row.find('td:eq(3)').text('Rs. ' + newServicePrice.toFixed(2));
                $row.find('td:eq(4)').text('Rs. ' + newVAT.toFixed(2));
                $row.find('td:eq(5)').text('Rs. ' + newAdditionalPrice.toFixed(2));
                $row.find('td:eq(6)').text('Rs. ' + newTotalPrice.toFixed(2));

                $('#editAdditionalPriceModal').modal('hide');
                $('#editAdditionalPriceForm')[0].reset();
            } else {
                alert('Failed to update additional price.');
            }
        }, 'json');
    });
</script>

<?php
include('includes/footer.php');
?>