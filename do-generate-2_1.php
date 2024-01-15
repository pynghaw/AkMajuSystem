<?php
include 'headermainadmin.php';
include 'dbconnect.php';

// Initialize variables to hold customer and invoice information
$customer_id = "";
$iv_no = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve selected customer
    $customer_id = $_POST['customer_id'];
}

// Query to check if paid invoices exist for the selected customer
$checkInvoiceSql = "SELECT COUNT(*) AS invoiceCount FROM tb_quotation q
                    JOIN tb_invoice i ON q.q_no = i.iv_qno
                    WHERE q.q_cid = $customer_id AND i.iv_status = 1";  // Only include paid invoices
$checkInvoiceResult = mysqli_query($con, $checkInvoiceSql);

if (!$checkInvoiceResult) {
    // Handle query error
    echo "Error checking for invoices: " . mysqli_error($con);
    exit;
}

$invoiceCount = mysqli_fetch_assoc($checkInvoiceResult)['invoiceCount'];

if ($invoiceCount > 0) {
    // Invoices exist, proceed with fetching the paid invoice details
    $invoiceSql = "SELECT q.*, i.* FROM tb_quotation q
                   JOIN tb_invoice i ON q.q_no = i.iv_qno
                   WHERE q.q_cid = $customer_id AND i.iv_status = 1";  // Only fetch paid invoices
    $invoiceResult = mysqli_query($con, $invoiceSql);

    if (!$invoiceResult) {
        // Handle query error
        echo "Error fetching invoices: " . mysqli_error($con);
        exit;
    }

    $invoiceData = mysqli_fetch_assoc($invoiceResult);

    // Set the invoice_id from the fetched data
    $iv_no = $invoiceData['iv_no'];
} else {
    // No paid invoices exist for the selected customer
    echo "<script>
            alert('No paid invoices found for the selected customer.');
            window.location.href = 'do-generate-1.php';
          </script>";
    // The exit statement is commented out to allow the script to continue
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <?php if ($invoiceCount > 0) { ?>
                                <form method="POST" action="do-generate-3_1.php">
                                    <fieldset>
                                        <br>
                                        <h1>Step 2: Select Paid Invoice</h1>

                                        <input type="hidden" name="customer_id" value="<?= $customer_id ?>">

                                        <div class="form-group">
                                            <label for="invoiceSelect" class="form-label mt-4">Select Paid Invoice</label>
                                            <select class="form-control" name="iv_no">
                                                <?php
                                                // Fetch paid invoices for the selected customer
                                                $invoiceQuery = "SELECT iv_no FROM tb_invoice WHERE iv_qno IN (SELECT q_no FROM tb_quotation WHERE q_cid = $customer_id) AND iv_status = 1";
                                                $invoiceResult = mysqli_query($con, $invoiceQuery);

                                                if ($invoiceResult) {
                                                    while ($invoice = mysqli_fetch_assoc($invoiceResult)) {
                                                        echo '<option value="' . $invoice['iv_no'] . '">' . $invoice['iv_no'] . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="">No paid invoices found</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <br>
                                        <button type="submit" class="btn btn-primary">Next</button>
                                    </fieldset>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include 'footer.php'; ?>
