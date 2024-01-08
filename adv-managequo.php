<?php
include 'headermain.php';
include('dbconnect.php');
require 'fpdf186/fpdf.php';

// Query to retrieve invoices along with customer name
$sql = "SELECT q.*, c.c_name
        FROM tb_quotation q
        INNER JOIN tb_customer c ON q.q_cid = c.c_id";
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
                            <?php
                            // Check if there are invoices
                            if (mysqli_num_rows($result) > 0) {
                                echo '<table class="table">';
                                echo '<tr>';
                                echo '<th>Quotation No</th>';
                                echo '<th>Customer Name</th>';
                                echo '<th>Quotation Date</th>';
                                echo '<th>Status</th>';
                                echo '<th>Operation</th>';
                                echo '</tr>';

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['q_no'] . '</td>';
                                    echo '<td>' . $row['c_name'] . '</td>';
                                    echo '<td>' . $row['q_date'] . '</td>';
                                    echo '<td>' . $row['q_status'] . '</td>';
                                    echo '<td><a href="upfrontpayment.php?q_no=' . $row['q_no'] . '" class="btn btn-outline-secondary">Generate Invoice</a> &nbsp;';
                                    echo '<a href="regeneratequotationprocess.php?q_no=' . $row['q_no'] . '" class="btn btn-outline-secondary">Review</a> &nbsp;';
                                    echo '<a href="quotationremove.php?q_no=' . $row['q_no'] . '" onclick="return confirmDelete();" class="btn btn-outline-danger">Delete</a></td>';
                                    echo '</tr>';
                                }

                                echo '</table>';
                            } else {
                                echo 'No quotation found.';
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
