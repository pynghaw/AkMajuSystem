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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Manage Quotation</a></li>
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
                            <h2>Manage Quotation - Advertising</h2>

                            <!-- Form for selecting quotation status -->
                            <form method="POST" action="">
                                <label for="quotation_status">Select Quotation Status:</label>
                                <select name="quotation_status" id="quotation_status">
                                    <option value="0" <?php echo ($selectedOption == 0) ? 'selected' : ''; ?>>Pending</option>
                                    <option value="1" <?php echo ($selectedOption == 1) ? 'selected' : ''; ?>>Confirmed</option>
                                </select>
                                <button type="submit" class="btn btn-success btn-sm padd">Filter</button>
                            </form>

                            <!-- Display Quotations based on selected status -->
                            <?php
                            if (mysqli_num_rows($statusResult) > 0) {
                            ?>
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Quotation No</th>
                                            <th>Customer Name</th>
                                            <th>Quotation Date</th>
                                            <th style="text-align: center;">Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($statusResult)) {
                                        ?>
                                            <tr>
                                                <?php if ($row['q_type'] == 1) { ?>
                                                <td><?php echo $row['q_no']; ?></td>
                                                <td><?php echo $row['c_name']; ?></td>
                                                <td><?php echo $row['q_date']; ?></td>
                                                <td style="text-align: center;">
                                                    <?php
                                                    if ($row['q_status'] == 0) {
                                                        // Pending Quotation Operations
                                                    ?>
                                                        <a href="adv-reviewquo.php?q_no=<?php echo $row['q_no']; ?>" class="btn btn-secondary btn-sm padd">Review</a> &nbsp;
                                                        <a href="invoice-upfront.php?q_no=<?php echo $row['q_no']; ?>" class="btn btn-success btn-sm padd">Generate Invoice</a> &nbsp;
                                                        <a href="adv-deletequo.php?q_no=<?php echo $row['q_no']; ?>" onclick="return confirmDelete();" class="btn btn-danger btn-sm padd">Delete</a>
                                                    <?php
                                                    } elseif ($row['q_status'] == 1) {
                                                        // Confirmed Quotation Operations
                                                    ?>
                                                        <a href="adv-reviewquo.php?q_no=<?php echo $row['q_no']; ?>" class="btn btn-secondary">Review</a> &nbsp;
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php
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
