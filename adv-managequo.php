<?php
include 'headermain.php';
include 'dbconnect.php';
require 'fpdf186/fpdf.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check the selected option
    $selectedOption = $_POST['quotation_status'];
    
    // Query to retrieve quotations based on the selected status
    $statusSql = "SELECT q.*, c.c_name
                  FROM tb_quotation q
                  INNER JOIN tb_customer c ON q.q_cid = c.c_id
                  WHERE q.q_status = $selectedOption";
    $statusResult = mysqli_query($con, $statusSql);
} else {
    // Default to pending quotations if no option is selected
    $selectedOption = 0;

    // Query to retrieve pending quotations along with customer name
    $statusSql = "SELECT q.*, c.c_name
                  FROM tb_quotation q
                  INNER JOIN tb_customer c ON q.q_cid = c.c_id
                  WHERE q.q_status = $selectedOption";
    $statusResult = mysqli_query($con, $statusSql);
}
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
                            <h2>Manage Quotation</h2>

                            <!-- Form for selecting quotation status -->
                            <form method="POST" action="">
                                <label for="quotation_status">Select Quotation Status:</label>
                                <select name="quotation_status" id="quotation_status">
                                    <option value="0" <?php echo ($selectedOption == 0) ? 'selected' : ''; ?>>Pending</option>
                                    <option value="1" <?php echo ($selectedOption == 1) ? 'selected' : ''; ?>>Confirmed</option>
                                </select>
                                <button type="submit" class="btn mb-1 btn-outline-success  btn-sm">Filter</button>
                            </form>

                            <!-- Display Quotations based on selected status -->
                            <?php
                            if (mysqli_num_rows($statusResult) > 0) {
                                echo '<table class="table">';
                                echo '<tr>';
                                echo '<th>Quotation No</th>';
                                echo '<th>Customer Name</th>';
                                echo '<th>Quotation Date</th>';
                                echo '<th>Operation</th>';
                                echo '</tr>';

                                while ($row = mysqli_fetch_assoc($statusResult)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['q_no'] . '</td>';
                                    echo '<td>' . $row['c_name'] . '</td>';
                                    echo '<td>' . $row['q_date'] . '</td>';
                                    echo '<td>';
                                    if ($row['q_status'] == 0) {
                                        // Pending Quotation Operations
                                        echo '<a href="adv-reviewquo.php?q_no=' . $row['q_no'] . '" class="btn btn-outline-secondary">Review</a> &nbsp;';
                                        echo '<a href="invoice-upfront.php?q_no=' . $row['q_no'] . '" class="btn btn-outline-success">Generate Invoice</a> &nbsp;';
                                        echo '<a href="adv-deletequo.php?q_no=' . $row['q_no'] . '" onclick="return confirmDelete();" class="btn btn-outline-danger">Delete</a>';
                                    } elseif ($row['q_status'] == 1) {
                                        // Confirmed Quotation Operations
                                        echo '<a href="adv-reviewquo.php?q_no=' . $row['q_no'] . '" class="btn btn-outline-secondary">Review</a> &nbsp;';
                                    }
                                    echo '</td>';
                                    echo '</tr>';
                                }

                                echo '</table>';
                            } else {
                                echo 'No quotations found.';
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
<!-- Add this script at the end of your HTML body -->
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this quotation?");
    }
</script>

<!--**********************************
    Content body end
***********************************-->
<?php include 'footer.php'; ?>
