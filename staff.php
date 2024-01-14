<?php
include('mysession.php');
include 'dbconnect.php';
if (!session_id()) {
    session_start();
}
if (isset($_GET['id'])) {
    $fid = $_GET['id'];
}
include 'headermain.php';
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

// Total products sold
$totalProductsSoldSql = "SELECT SUM(o_quantity) FROM tb_order WHERE o_status = 1";
$totalProductsSold = fetchSingleValue($con, $totalProductsSoldSql);

// Total profit
$totalProfitSql = "SELECT SUM(iv_tAmount) FROM tb_invoice WHERE iv_status = 1";
$totalProfit = fetchSingleValue($con, $totalProfitSql);

// Total customers
$totalCustomersSql = "SELECT COUNT(*) FROM tb_customer";
$totalCustomers = fetchSingleValue($con, $totalCustomersSql);

$formattedTotalProfit = number_format($totalProfit, 2);

$inventoryDataSql = "SELECT i_name, i_qtysold FROM tb_inventory";
$inventoryDataResult = mysqli_query($con, $inventoryDataSql);

// Create an associative array to hold the data
$inventoryData = array();
while ($row = mysqli_fetch_assoc($inventoryDataResult)) {
    $inventoryData[] = $row;
}
$encodedInventoryData = json_encode($inventoryData);
?>


<body>
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-1">
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
                <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-2">
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
                <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-3">
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
            <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-4">
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
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body ">
                        <h4 class="card-title">Single Bar Chart</h4>
                                <canvas id="singleBarChart" width="500" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>

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
        <!-- #/ container -->
    </div>
    <!--**********************************
            Content body end
        ***********************************-->

      


    <?php
      // Pass the encoded JSON data to JavaScript
echo "<script> var inventoryData = $encodedInventoryData; </script>";

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
    });
</script>";
     include 'footer.php'; ?>
</body>
