<?php 
include 'headermain.php';
include('dbconnect.php');

$customer_id = $_POST['customer_id'];
$discount = $_POST['discount'];

$sql = "SELECT * FROM tb_matlist";
$result = mysqli_query($con, $sql);

$totalPrice = 0; // Initialize total price
?>
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Construction</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Check Out Summary</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <div class="container">
                        <h2>Check Out Summary</h2>
                        <?php echo "<p>Customer: $customer_id</p>";?>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Unit Price (RM)</th>
                                    <th>Quantity</th>
                                    <th>Material Price (RM)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysqli_fetch_array($result)) { 
                                    $materialPrice = $row['m_price'] * $row['m_qty'];
                                    $totalPrice += $materialPrice; // Add to total
                                    if ($row['m_qty'] > 0) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['m_id']; ?></td>
                                        <td><?php echo $row['m_name']; ?></td>
                                        <td><?php echo $row['m_type']; ?></td>
                                        <td><?php echo $row['m_desc']; ?></td>
                                        <td><?php echo $row['m_price']; ?></td>
                                        <td><?php echo $row['m_qty']; ?></td>
                                        <td><?php echo $materialPrice; ?></td>
                                    </tr>
                                <?php }} ?> 
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" style="text-align:right;"><strong>Total Price:</strong></td>
                                    <td><strong><?php echo $totalPrice; ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
<!--**********************************
    Content body end
***********************************-->
<?php 
$discountAmount = ($discount / 100) * $totalPrice;

// Calculate grand total
$grandTotal = $totalPrice - $discountAmount;

// Insert data into the quotation database
$insertQuotationSql = "INSERT INTO tb_quotation (q_cid, q_date, q_tAmount, q_discPercent, q_discAmount, q_type)
                       VALUES ('$customer_id', NOW(), '$grandTotal', '$discount', '$discountAmount', '1')";
$insertQuotationResult = mysqli_query($con, $insertQuotationSql);

include 'const-generatequofooter.php'; ?>       

