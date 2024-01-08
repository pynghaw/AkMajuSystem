<?php
include 'headermain.php';
include 'dbconnect.php';

$customer_id = "";
$iv_no = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve selected customer and invoice
    $customer_id = $_POST['customer_id'];
    $iv_no = $_POST['iv_no'];

    // Fetch billing address of the selected customer
    $billingAddressQuery = "SELECT c_billAdd FROM tb_customer WHERE c_id = $customer_id";
    $billingAddressResult = mysqli_query($con, $billingAddressQuery);

    if ($billingAddressResult) {
        $billingAddress = mysqli_fetch_assoc($billingAddressResult)['c_billAdd'];
    } else {
        // Handle error if unable to fetch billing address
        echo "Error fetching billing address: " . mysqli_error($con);
        exit;
    }
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

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <form method="POST" action="do-generateprocess.php">
                            
                                <br>
                                <h1>Step 3: Enter Additional Information</h1>

                                <div class="form-group">
                                    <label for="exampleInputPassword1" class="form-label mt-4">Select Delivery Date</label>
                                    <input type="date" name="deldate" class="form-control" placeholder="Date" value="<?php echo date('Y-m-d'); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleTextarea" class="form-label mt-4">Delivery Address</label>
                                    <textarea class="form-control" name="deladd" id="exampleTextarea" rows="3" required><?php echo $billingAddress; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelect1" class="form-label mt-4">Terms of Payment</label>
                                    <select class="form-select" id="exampleSelect1" name="terms">
                                        <option value="PIA">PIA</option>
                                        <option value="Net 7">Net 7</option>
                                        <option value="Net 10">Net 10</option>
                                        <option value="Net 30">Net 30</option>
                                        <option value="Net 60">Net 60</option>
                                        <option value="Net 90">Net 90</option>
                                        <option value="EOM">EOM</option>
                                        <option value="21 MFI">21 MFI</option>
                                    </select>
                                </div>

                                <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                                <input type="hidden" name="iv_no" value="<?php echo $iv_no; ?>">

                                <br>
                                <button type="submit" class="btn btn-primary">Generate DO</button>
                                <button type="reset" class="btn btn-primary">Reset</button>
                                <br><br><br>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br>
<?php include 'footer.php'; ?>
