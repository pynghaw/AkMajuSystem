<?php
include 'headermainadmin.php'; 
include('dbconnect.php');
// Initialize variables to hold customer information
if (isset($_GET['q_no'])) {
    $q_no = $_GET['q_no'];
    }
?>
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Upfront Payment</a></li>
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
                            <form method="POST" action="invoice-generateprocess.php">
                                <div class="container">
                                    <h1>Upfront Payment (RM)</h1>
                                    <div class="col-lg-6">
                                    <label for="exampleInputPassword1" class="form-label mt-4">Enter Upfront Payment (If applicable)</label>
                                    <input type="text" name="upfront" class="form-control" placeholder="Enter the Amount" >
                                    </div>
                                    <br>
                                    <input type="hidden" name="q_no" value="<?php echo $q_no; ?>">
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
<?php include 'footer.php'; ?>       

 
<script src="plugins/common/common.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/settings.js"></script>
<script src="js/gleek.js"></script>
<script src="js/styleSwitcher.js"></script>


<script src="./plugins/sweetalert/js/sweetalert.min.js"></script>
<script src="./plugins/sweetalert/js/sweetalert.init.js"></script>

