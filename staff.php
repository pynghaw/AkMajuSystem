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
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-0">
                            <h4 class="card-title px-4 mb-3">Todo</h4>
                            <div class="todo-list">
                                <div class="tdl-holder">
                                    <div class="tdl-content">
                                        <ul id="todo_list">
                                            <li><label><input type="checkbox"><i></i><span>Get up</span><a href='#' class="ti-trash"></a></label></li>
                                            <li><label><input type="checkbox" checked><i></i><span>Stand up</span><a href='#' class="ti-trash"></a></label></li>
                                            <li><label><input type="checkbox"><i></i><span>Don't give up the fight.</span><a href='#' class="ti-trash"></a></label></li>
                                            <li><label><input type="checkbox" checked><i></i><span>Do something else</span><a href='#' class="ti-trash"></a></label></li>
                                        </ul>
                                    </div>
                                    <div class="px-4">
                                        <input type="text" class="tdl-new form-control" placeholder="Write new item and hit 'Enter'...">
                                    </div>
                                </div>
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
                                <img src="./images/member/ceo.png" class="rounded-circle" alt="" style="width:50%; height:auto">
                                <h5 class="mt-3 mb-1">Noor Azam Bin Khalid</h5>
                                <p class="m-0">CEO</p>
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
                                <img src="./images/member/ceo.png" class="rounded-circle" alt="" style="width:50%; height:auto">
                                <h5 class="mt-3 mb-1">Noor Azam Bin Khalid</h5>
                                <p class="m-0">CEO</p>
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

    <?php include 'footer.php'; ?>
</body>
