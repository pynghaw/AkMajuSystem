<?php
include 'headermain.php'; 
include('dbconnect.php');

// Initialize variables to hold customer information
$customer_name = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve selected customer
    $customer_name = $_POST['customer_name'];
}
?>

<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
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
                            <form method="POST" action="const-matlist.php">
                                <div class="container">
                                    <h1>Select Customer</h1>
                                    <div class="form-group">
                                        <label for="customerSelect" class="form-label mt-4">Customer: </label>
                                        <select class="form-select" id="customerSelect" name="customer_name">
                                            <option value="">Select Customer</option>
                                            <?php
                                            $sql = "SELECT * FROM tb_customer";
                                            $result = mysqli_query($con, $sql);
                                            while ($row = mysqli_fetch_array($result)) {
                                                $selected = ($row['c_id'] == $customer_id) ? "selected" : "";
                                                echo "<option value='" . $row['c_id'] . "' $selected>" . $row['c_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Next</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div><br><br><br><br>
<!--**********************************
    Content body end
***********************************-->
<?php include 'customer-footer.php'; ?>       

 
<script src="plugins/common/common.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/settings.js"></script>
<script src="js/gleek.js"></script>
<script src="js/styleSwitcher.js"></script>


<script src="./plugins/sweetalert/js/sweetalert.min.js"></script>
<script src="./plugins/sweetalert/js/sweetalert.init.js"></script>

