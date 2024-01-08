<?php
include 'headermain.php';
include('dbconnect.php');
require 'fpdf186/fpdf.php';

// Check if the form is submitted
$selectedOption = isset($_POST['invoice_status']) ? $_POST['invoice_status'] : 'unpaid';

// Query to retrieve invoices along with customer name based on the selected status
$sql = "SELECT i.*, q.q_no, c.c_name
        FROM tb_invoice i
        INNER JOIN tb_quotation q ON i.iv_qno = q.q_no
        INNER JOIN tb_customer c ON q.q_cid = c.c_id";

if ($selectedOption == 'unpaid') {
    $sql .= " WHERE i.iv_status = 0";
} elseif ($selectedOption == 'paid') {
    $sql .= " WHERE i.iv_status = 1";
}

$sql .= " ORDER BY i.iv_no ASC";

$result = mysqli_query($con, $sql);
?>
<!--**********************************
    Content body start
***********************************-->
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
                            <h2>Manage Invoice</h2>

                            <!-- Form for Invoice Status Filter -->
                            <form method="POST" action="">
                                <label for="invoice_status">Select Invoice Status:</label>
                                <select name="invoice_status" id="invoice_status">
                                    <option value="unpaid" <?php echo ($selectedOption == 'unpaid') ? 'selected' : ''; ?>>Unpaid</option>
                                    <option value="paid" <?php echo ($selectedOption == 'paid') ? 'selected' : ''; ?>>Paid</option>
                                </select>
                                <button type="submit" class="btn mb-1 btn-outline-success btn-sm">Filter</button>
                            </form>

                            <!-- Display Invoices -->
                            <legend><?php echo ucfirst($selectedOption); ?> Invoices</legend>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                echo '<table class="table">';
                                echo '<tr>';
                                echo '<th>Invoice No</th>';
                                echo '<th>Customer Name</th>';
                                echo '<th>Invoice Date</th>';
                                echo '<th>Operation</th>';
                                echo '</tr>';

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['iv_no'] . '</td>';
                                    echo '<td>' . $row['c_name'] . '</td>';
                                    echo '<td>' . $row['iv_date'] . '</td>';
                                    echo '<td>';
                                    echo '<a href="regenerateinvoiceprocess.php?iv_no=' . $row['iv_no'] . '" class="btn btn-outline-secondary">Review</a> &nbsp;';

                                    // Different operations based on invoice status
                                    if ($selectedOption == 'unpaid') {
                                        echo '<button onclick="updateStatus(' . $row['iv_no'] . ')" class="btn btn-outline-success">Mark as Paid</button> &nbsp;';
                                        echo '<a href="invoiceremove.php?iv_no=' . $row['iv_no'] . '" class="btn btn-outline-danger">Delete</a>';
                                    }

                                    echo '</td>';
                                    echo '</tr>';
                                }

                                echo '</table>';
                            } else {
                                echo 'No ' . $selectedOption . ' invoices found.';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>

<!-- Generate JavaScript for AJAX request outside of the PHP block -->
<script>
    function updateStatus(iv_no) {
        if (confirm('Are you sure you want to mark this invoice as paid?')) {
            // AJAX request to update invoice status
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Reload the page after successful update
                    location.reload();
                }
            };
            xhttp.open('GET', 'invoice-updatestatus.php?iv_no=' + iv_no, true);
            xhttp.send();
        }
    }
</script>

<!--**********************************
    Content body end
***********************************-->
<?php include 'footer.php'; ?>
