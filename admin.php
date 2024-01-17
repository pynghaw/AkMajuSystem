<?php
include('mysession.php');
include 'dbconnect.php';
include 'headernotification.php';
if (!session_id()) {
    session_start();
}
if (isset($_GET['id'])) {
    $fid = $_GET['id'];
}
if ($_SESSION['user_role'] != 'admin') {
    
    header('Location: unauthorized.php');
    exit();
}
include 'headermainadmin.php';
function fetchSingleValue($con, $sql)
{
    $result = mysqli_query($con, $sql);
    if ($result) {
        $row = mysqli_fetch_row($result);
        return $row[0];
    } else {
        return 0;
    }
}

// Fetch top 3 customers and their sales
$topCustomersSql = "SELECT c_name, SUM(iv_tAmount) AS totalSales 
                    FROM tb_customer 
                    JOIN tb_invoice ON tb_customer.c_id = tb_invoice.iv_cid 
                    WHERE iv_status = 1 
                    GROUP BY c_name 
                    ORDER BY totalSales DESC 
                    LIMIT 3";

$topCustomersResult = mysqli_query($con, $topCustomersSql);

// Create an associative array to hold the top customers data
$topCustomersData = array();
while ($row = mysqli_fetch_assoc($topCustomersResult)) {
    $topCustomersData[] = $row;
}

$encodedTopCustomersData = json_encode($topCustomersData);


$topCustomerSql = "SELECT c_name, SUM(iv_tAmount) AS totalSales FROM tb_customer
                   JOIN tb_invoice ON tb_customer.c_id = tb_invoice.iv_cid
                   WHERE tb_invoice.iv_status = 1
                   GROUP BY tb_customer.c_id
                   ORDER BY totalSales DESC
                   LIMIT 1";

$topCustomerResult = mysqli_query($con, $topCustomerSql);
$topCustomer = mysqli_fetch_assoc($topCustomerResult);

// Total products sold
$totalProductsSoldSql = "SELECT SUM(o_quantity) FROM tb_order WHERE o_status = 1";
$totalProductsSold = fetchSingleValue($con, $totalProductsSoldSql);

// Total profit
$totalProfitSql = "SELECT SUM(iv_tAmount) FROM tb_invoice WHERE iv_status = 1";
$totalProfit = fetchSingleValue($con, $totalProfitSql);

// Total customers
$totalCustomersSql = "SELECT COUNT(*) FROM tb_customer WHERE c_status= 1";
$totalCustomers = fetchSingleValue($con, $totalCustomersSql);

$formattedTotalProfit = number_format($totalProfit, 2);

$inventoryDataSql = "SELECT i_name, i_qtysold FROM tb_inventory";
$inventoryDataResult = mysqli_query($con, $inventoryDataSql);

$topSoldItemSql = "SELECT i_name, i_qtysold FROM tb_inventory ORDER BY i_qtysold DESC LIMIT 1";
$topSoldItemResult = mysqli_query($con, $topSoldItemSql);

if ($topSoldItemResult && mysqli_num_rows($topSoldItemResult) > 0) {
    $topSoldItem = mysqli_fetch_assoc($topSoldItemResult);
} else {
    // Handle the query error or empty result if needed
    $topSoldItem = array(); // or any default value
}

// Create an associative array to hold the data
$inventoryData = array();
while ($row = mysqli_fetch_assoc($inventoryDataResult)) {
    $inventoryData[] = $row;
}
$encodedInventoryData = json_encode($inventoryData);

$profitByDateSql = "SELECT DATE(iv_date) AS date, SUM(iv_tAmount) AS totalSales FROM tb_invoice WHERE iv_status = 1 GROUP BY DATE(iv_date)";
$profitByDateResult = mysqli_query($con, $profitByDateSql);

// Create an associative array to hold the profit data by date
$profitByDateData = array();
while ($row = mysqli_fetch_assoc($profitByDateResult)) {
    $profitByDateData[] = $row;
}
$encodedProfitByDateData = json_encode($profitByDateData);

// Fetch low stock products
$lowStockProductsSql = "SELECT * FROM tb_inventory WHERE i_qty < 5";
$lowStockProductsResult = mysqli_query($con, $lowStockProductsSql);
$lowStockProducts = mysqli_fetch_all($lowStockProductsResult, MYSQLI_ASSOC);

$totalPendingQuotationsSql = "SELECT COUNT(*) FROM tb_quotation WHERE q_status = 0";
$totalPendingQuotations = fetchSingleValue($con, $totalPendingQuotationsSql);

$totalUnpaidInvoicesSql = "SELECT COUNT(*) FROM tb_invoice WHERE iv_status = 0";
$totalUnpaidInvoices = fetchSingleValue($con, $totalUnpaidInvoicesSql);

// Count of paid and unpaid quotations
$quotationStatusCountSql = "SELECT q_status, COUNT(*) as count FROM tb_quotation GROUP BY q_status";
$quotationStatusCountResult = mysqli_query($con, $quotationStatusCountSql);

// Create an associative array to hold the count data
$quotationStatusCountData = array();
while ($row = mysqli_fetch_assoc($quotationStatusCountResult)) {
    $quotationStatusCountData[$row['q_status']] = $row['count'];
}

// Get count of paid and unpaid quotations
$paidQuotationsCount = isset($quotationStatusCountData[1]) ? $quotationStatusCountData[1] : 0;
$unpaidQuotationsCount = isset($quotationStatusCountData[0]) ? $quotationStatusCountData[0] : 0;

// Fetch paid invoices count
$totalPaidInvoicesSql = "SELECT COUNT(*) AS paidCount FROM tb_invoice WHERE iv_status = 1";
$totalPaidInvoices = fetchSingleValue($con, $totalPaidInvoicesSql);

// Fetch unpaid invoices count
$totalUnpaidInvoicesSql = "SELECT COUNT(*) AS unpaidCount FROM tb_invoice WHERE iv_status = 0";
$totalUnpaidInvoices = fetchSingleValue($con, $totalUnpaidInvoicesSql);

// Create an array for invoice pie chart data
$invoicePieData = array($totalPaidInvoices, $totalUnpaidInvoices);

// Pass this data to JavaScript
echo "<script> var invoicePieData = " . json_encode($invoicePieData) . "; </script>";


?>
<style>
    .toggled-item {
        background-color: #7874fc; /* Change this to your desired color */
        color: #fff; /* Change text color if necessary */
    }
</style>


<body>
    <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
        <div class="container-fluid mt-3">
        
        <?php if (!empty($lowStockProducts)) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="font-size: 16px;">
        <strong>Low in stock:</strong>
        <ul>
            <?php foreach ($lowStockProducts as $product) : ?>
                <li><b>Product: </b><?php echo $product['i_name']; ?> (Quantity left: <?php echo $product['i_qty']; ?>)</li>
            <?php endforeach; ?>
        </ul>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
<?php endif; ?>
            <div class="row" style="margin-bottom: 15px;">
                <div class="col-lg-9 col-sm-6">
                    <!-- Empty column-->
                </div>

                <div class="col-lg-3 col-sm-6 text-end">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="toggleDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                            Toggle Box
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="toggleDropdown1">
                            <li><a class="dropdown-item" href="#" data-boxid="box1">Product Sold</a></li>
                            <li><a class="dropdown-item" href="#" data-boxid="box2">Total Sales</a></li>
                            <li><a class="dropdown-item" href="#" data-boxid="box3">Top Item Sold</a></li>
                            <li><a class="dropdown-item" href="#" data-boxid="box4">Total Customers</a></li>
                            <li><a class="dropdown-item" href="#" data-boxid="box5">Pending Quotation</a></li>
                            <li><a class="dropdown-item" href="#" data-boxid="box6">Unpaid Invoices</a></li>
                            <li><a class="dropdown-item" href="#" data-boxid="box7">Top Customer</a></li>
                            <li><a class="dropdown-item" href="#" data-boxid="box8">Total Employees</a></li>
                        </ul>
                    </div>
                </div>

               
            </div>
            

            <div class="row">
                <div id="box1"class="col-lg-3 col-sm-6">
                    <div class="card gradient-8">
                        <div class="card-body">
                            <h3 class="card-title text-white">Product Sold</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white"><?php echo $totalProductsSold; ?></h2>
                                <p class="text-white mb-0">Total Quantity Sold</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                        </div>
                    </div>
                </div>
                <div id="box2" class="col-lg-3 col-sm-6">
                    <div  class="card gradient-8">
                        <div class="card-body">
                            <h3 class="card-title text-white">Total Sales</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white"><?php echo $formattedTotalProfit; ?></h2>
                                <p class="text-white mb-0">Total Sales Achieved</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                        </div>
                    </div>
                </div>
                <div id="box3" class="col-lg-3 col-sm-6">
                <div  class="card gradient-8 ">
                        <div class="card-body">
                            <h3 class="card-title text-white">Top Item Sold</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white"><?php echo $topSoldItem['i_name']; ?></h2>
                                <p class="text-white mb-0">Number sold:<?php echo $topSoldItem['i_qtysold']; ?></p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                        </div>
                    </div>
                </div>
            <div id="box4" class="col-lg-3 col-sm-6">
            <div class="card gradient-8 ">
                        <div class="card-body">
                            <h3 class="card-title text-white">Total Customers</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white"><?php echo $totalCustomers; ?></h2>
                                <p class="text-white mb-0">Number of Customers</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                        </div>
                    </div>
                </div>

                <div id="box5"class="col-lg-3 col-sm-6">
                <div  class="card gradient-8 ">
                        <div class="card-body">
                            <h3 class="card-title text-white">Pending Quotations</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white"><?php echo $totalPendingQuotations; ?></h2>
                                <p class="text-white mb-0">Total Pending Quotations</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-file-text"></i></span>
                        </div>
                    </div>
                </div>

                <div id="box6"class="col-lg-3 col-sm-6">
                <div  class="card gradient-8 ">
                        <div class="card-body">
                            <h3 class="card-title text-white">Unpaid Invoices</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white"><?php echo $totalUnpaidInvoices; ?></h2>
                                <p class="text-white mb-0">Total Unpaid Invoices</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-file-invoice-dollar"></i></span>
                        </div>
                    </div>
                </div>
                <div id="box7"class="col-lg-3 col-sm-6">
                <div  class="card gradient-8 ">
                        <div class="card-body">
                            <h3 class="card-title text-white">Top Customer</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $topCustomer['c_name']; ?></h2>
                                    <p class="text-white mb-0">Total Sales: <?php echo number_format($topCustomer['totalSales'], 2); ?></p>
                                </div>
                        </div>
                    </div>
                </div>
                <div id="box8" class="col-lg-3 col-sm-6">
                <div  class="card gradient-8 ">
                        <div class="card-body">
                            <h3 class="card-title text-white">Total Employees</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">8</h2> <!-- Update this number with the actual total -->
                                <p class="text-white mb-0">Number of Employees</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-bottom: 15px;">
                <div class="col-lg-9 col-sm-6">
                    <!-- Empty column-->
                </div>
                <div class="col-lg-3 col-sm-6 text-end">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="toggleDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                            Toggle Chart
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="toggleDropdown2">
                            <li><a class="dropdown-item" href="#" data-boxid="box9">Total Sales</a></li>
                            <li><a class="dropdown-item" href="#" data-boxid="box10">Items Sold</a></li>
                            <li><a class="dropdown-item" href="#" data-boxid="box11">Quotation Status</a></li>
                            <li><a class="dropdown-item" href="#" data-boxid="box12">Top 3 Customers</a></li>
                            <li><a class="dropdown-item" href="#" data-boxid="box13">Invoice Status</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="box9" class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                                <h4 class="card-title">Total Sales by Date</h4>
                                <canvas id="lineChart"  width="500" height="250"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div id="box10" class="card">
                        <div class="card-body ">
                            <h4 class="card-title">Items Sold</h4>
                            <canvas id="singleBarChart" width="500" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="box11" class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Quotations Status</h4>
                        <canvas id="quotationPieChart" width="500" height="250"></canvas>
                    </div>
                </div>
            </div>
            <div id="box12" class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Top 3 Customers and Sales</h4>
                        <canvas id="topCustomersBarChart" width="500" height="210"></canvas>
                    </div>
                </div>
            </div>
            <div id="box13" class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Invoice Status</h4>
                            <div id="invoicePieChartContainer">
                                <canvas id="invoicePieChart" width="500" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-bottom: 15px;">
                <div class="col-lg-9 col-sm-6">
                    <!-- Empty column-->
                </div>
                <div class="col-lg-3 col-sm-6 text-end">
                    <button class="btn btn-secondary" type="button" id="toggleEmployee" data-custom-boxid="box14">
                        Toggle Employee
                    </button>
                </div>
            </div>

                <div id="box14Content">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="./images/member/ceo.png" class="rounded-circle" alt="" style="width:50%; height:auto">
                                <h5 class="mt-3 mb-1">Noor Azam Bin Khalid</h5>
                                <p class="m-0">CEO</p>
                                <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="./images/member/manager.png" class="rounded-circle" alt="" style="width:50%; height:auto">
                                <h5 class="mt-3 mb-1">Siti Fatimah Binti Ali</h5>
                                <p class="m-0">Manager</p>
                                <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="./images/member/admin.png" class="rounded-circle" alt="" style="width:50%; height:auto">
                                <h5 class="mt-3 mb-1">Amirah Aida Binti Samad</h5>
                                <p class="m-0">Admin/Account Officer</p>
                                <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="./images/member/customerservice.png" class="rounded-circle" alt="" style="width:50%; height:auto">
                                <h5 class="mt-3 mb-1">Aina Nabihah Binti Roslan</h5>
                                <p class="m-0">Customer Service</p>
                                <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="./images/member/seniordesigner.png" class="rounded-circle" alt="" style="width:50%; height:auto">
                                <h5 class="mt-3 mb-1">Nor Zalila Binti Mohd Jizad</h5>
                                <p class="m-0">Senior Designer</p>
                                <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="./images/member/marketing.png" class="rounded-circle" alt="" style="width:50%; height:auto">
                                <h5 class="mt-3 mb-1">Siti Aishah Binti Paiman</h5>
                                <p class="m-0">Marketing</p>
                                <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="./images/member/seniordesigner2.png" class="rounded-circle" alt="" style="width:50%; height:auto">
                                <h5 class="mt-3 mb-1">Fauzan Bin Mohammad Khir</h5>
                                <p class="m-0">Senior Designer 2</p>
                                <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="./images/member/juniordesigner.png" class="rounded-circle" alt="" style="width:50%; height:auto">
                                <h5 class="mt-3 mb-1">Akid Anaqi Bin Noranizam</h5>
                                <p class="m-0">Junior Designer</p>
                                <!-- <a href="javascript:void()" class="btn btn-sm btn-warning">Send Message</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        <!-- #/ container -->
        <!-- Add these buttons at the top of your HTML body -->


    </div>
    <!--**********************************
            Content body end
        ***********************************-->

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        $('.dropdown-item').each(function() {
            var boxId = $(this).data('boxid');

            if ($('#' + boxId).is(':visible')) {
                $(this).addClass('toggled-item');
            } else {
                $(this).removeClass('toggled-item');
            }
        });

        $('.dropdown-item').click(function() {
            var boxId = $(this).data('boxid');

            if ($('#' + boxId).is(':visible')) {
                $('#' + boxId).hide();
                $(this).removeClass('toggled-item');
            } else {
                $('#' + boxId).show();
                $(this).addClass('toggled-item');
            }
        });
    });
</script>

<script>
        document.getElementById('toggleEmployee').addEventListener('click', function() {
            var boxId = this.dataset.customBoxid;
            // Now you can use the 'boxId' in your logic
            console.log('Box ID:', boxId);
            
            // Toggle logic
            var contentElement = document.getElementById(boxId + 'Content');
            if (contentElement) {
                contentElement.style.display = (contentElement.style.display === 'none' || contentElement.style.display === '') ? 'block' : 'none';
            }
        });
    </script>



</body>

    <?php
        
// Pass the encoded JSON data to JavaScript
echo "<script> var topCustomersData = $encodedTopCustomersData; </script>";

// Use the data in JavaScript
echo "<script>
    var customerLabels = topCustomersData.map(item => item.c_name);
    var salesData = topCustomersData.map(item => item.totalSales);

    var ctxBar = document.getElementById('topCustomersBarChart').getContext('2d');

    var topCustomersBarChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: customerLabels,
            datasets: [{
                label: 'Total Sales',
                data: salesData,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value, index, values) {
                            return '$' + value.toFixed(2); // Format the y-axis label with two decimal places
                        }
                    }
                }
            }
        }
    });
</script>";

// Pass the counts to JavaScript
echo "<script> var paidQuotationsCount = $paidQuotationsCount; </script>";
echo "<script> var unpaidQuotationsCount = $unpaidQuotationsCount; </script>";

// Pass the invoice data to JavaScript
echo "<script> var invoicePieData = " . json_encode($invoicePieData) . "; </script>";

// Use the data in JavaScript
echo "<script>
    var ctxPie = document.getElementById('quotationPieChart').getContext('2d');

    var quotationPieChart = new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ['Confirmed', 'Pending'],
            datasets: [{
                data: [paidQuotationsCount, unpaidQuotationsCount],
                backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }]
        }
    });

    // Use the data for the invoice pie chart
    var ctxInvoicePie = document.getElementById('invoicePieChart').getContext('2d');

    var invoicePieChart = new Chart(ctxInvoicePie, {
        type: 'doughnut',
        data: {
            labels: ['Paid', 'Unpaid'],
            datasets: [{
                data: invoicePieData,
                backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }],
        },
    });
</script>";

      // Pass the encoded JSON data to JavaScript
echo "<script> var inventoryData = $encodedInventoryData; </script>";
echo "<script> var profitByDateData = $encodedProfitByDateData; </script>";
// Use the data in JavaScript
echo "<script>
    var itemLabels = inventoryData.map(item => item.i_name);
    var quantitySoldData = inventoryData.map(item => item.i_qtysold);

    var ctx = document.getElementById('singleBarChart').getContext('2d');

    var singleBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: itemLabels,
            datasets: [{
                label: 'Quantity Sold',
                data: quantitySoldData,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });   </script>";

    echo "<script>
    var dateLabels = profitByDateData.map(item => item.date);
    var totalProfitData = profitByDateData.map(item => item.totalSales);

    var ctxLine = document.getElementById('lineChart').getContext('2d');

    var lineChart = new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: dateLabels,
            datasets: [{
                label: 'Total Profit',
                data: totalProfitData,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            scales: {
                x: {
                    type: 'category',
                    labels: dateLabels
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>";

     include 'footer.php'; ?>

