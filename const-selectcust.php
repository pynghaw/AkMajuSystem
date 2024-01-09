<?php
include 'headermain.php'; 
include('dbconnect.php');

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
                                    <h1>Quotation Infomation</h1>
                                    <div class="form-group">
                                    <label>Select customer:</label>
                                        <select class="form-control" id="customerSelect" name="customer_id">
                                            <option value="" disabled selected>Select customer</option>
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
                                    <div class="form-group">
                                        <label>Select state:</label>
                                        <select class="form-control" id="sel1" name="state" required>
                                            <option value="" disabled selected>Select a state</option>
                                            <option>Perlis</option>
                                            <option>Kedah</option>
                                            <option>Pulau Pinang</option>
                                            <option>Perak</option>
                                            <option>Selangor</option>
                                            <option>Negeri Sembilan</option>
                                            <option>Melaka</option>
                                            <option>Johor</option>
                                            <option>Pahang</option>
                                            <option>Terengganu</option>
                                            <option>Kelantan</option>
                                            <option>Sabah</option>
                                            <option>Sarawak</option>
                                            <option>Wilayah Persekutuan Labuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Distance from engineering office state:</label>
                                        <select class="form-control" id="sel1" name="distance" required>
                                            <option value="" disabled selected>Select distance</option>
                                            <option>less than 15km</option>
                                            <option>15 - 30km</option>
                                            <option>30 - 50km</option>
                                            <option>50 - 75km</option>
                                            <option>more than 75km</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="discountInput" class="form-label mt-4">Discount (%)</label>
                                        <input type="text" class="form-control" id="discountInput" name="discount" placeholder="Enter Discount">
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

