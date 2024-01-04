<?php
include 'headermain.php';
include('dbconnect.php');
require 'fpdf186/fpdf.php';

// Query to retrieve invoices along with customer name
$sql = "SELECT i.*, q.q_no, c.c_name
        FROM tb_invoice i
        INNER JOIN tb_quotation q ON i.iv_qno = q.q_no
        INNER JOIN tb_customer c ON q.q_cid = c.c_id
        ORDER BY i.iv_no ASC";
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
                                    echo '<td><a href="regenerateinvoiceprocess.php?iv_no=' . $row['iv_no'] . '" class="btn btn-outline-secondary">Review</a> &nbsp;';
                                    echo '<a href="invoiceremove.php?iv_no=' . $row['iv_no'] . '" class="btn btn-outline-danger">Delete</a></td>';
                                    echo '</tr>';
                                }

                                echo '</table>';
                            } else {
                                echo 'No invoices found.';
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
<!--**********************************
    Content body end
***********************************-->
<?php include 'footer.php'; ?>       

