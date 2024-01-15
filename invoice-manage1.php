<?php
include 'headermainadmin.php';
include 'dbconnect.php';
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Manage Invoice</a></li>
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
                            <div class="mb-3">
                                <form method="POST" action="">
                                    <label for="invoice_status">Select Invoice Status:</label>
                                    <select name="invoice_status" id="invoice_status">
                                        <option value="unpaid" <?php echo ($selectedOption == 'unpaid') ? 'selected' : ''; ?>>Unpaid</option>
                                        <option value="paid" <?php echo ($selectedOption == 'paid') ? 'selected' : ''; ?>>Paid</option>
                                    </select>
                                    <button type="submit" class="btn btn-success btn-sm padd">Filter</button>
                                </form>
                            </div>

                            <!-- Display Invoices -->
                            <legend><?php echo ucfirst($selectedOption); ?> Invoices</legend>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                            ?>
                                <table class="table fixed-table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Invoice No</th>
                                            <th>Customer Name</th>
                                            <th>Invoice Date</th>
                                            <th  style="text-align: center;">Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['iv_no']; ?></td>
                                                <td><?php echo $row['c_name']; ?></td>
                                                <td><?php echo $row['iv_date']; ?></td>
                                                <td  style="text-align: center;">
                                                    <a href="invoice-review.php?iv_no=<?php echo $row['iv_no']; ?>" class="btn btn-secondary btn-sm padd">Review</a> &nbsp;

                                                    <!-- Different operations based on invoice status -->
                                                    <?php
                                                    if ($selectedOption == 'unpaid') {
                                                    ?>
                                                        <button onclick="updateStatus(<?php echo $row['iv_no']; ?>)" class="btn btn-success btn-sm padd">Mark as Paid</button> &nbsp;
                                                        <a href="invoice-delete1.php?iv_no=<?php echo $row['iv_no']; ?>" class="btn btn-danger btn-sm padd">Delete</a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php
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
