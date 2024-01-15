<?php
include 'headermain.php';
include('dbconnect.php');
require 'fpdf186/fpdf.php';

$sql = "SELECT r.r_id, r.r_name, r.r_date, r.r_desc FROM tb_salesreport r ORDER BY CAST(r_id AS UNSIGNED) ASC";
$result = mysqli_query($con, $sql);

?>
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Reporting</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Manage Report</a></li>
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
                        <h2 class="mb-4">Manage Report</h2>
                            <?php
                            // Check if there are reports
                            if (mysqli_num_rows($result) > 0) {
                                echo '<table class="table fixed-table table-bordered">';
                                echo '<thead class="thead-dark">';
                                echo '<tr>';
                                echo '<th>Report No</th>';
                                echo '<th>Report Name</th>';
                                echo '<th>Report Date</th>';
                                echo '<th>Description</th>';
                                echo '<th style="text-align: center;">Action</th>';
                                echo '</tr>';
                                echo '</thead>';

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $r_id = $row['r_id'];
                                    $query = $con->prepare("SELECT r_filepath FROM tb_salesreport WHERE r_id = ?");
                                    $query->bind_param("i", $r_id);
                                    $query->execute();
                                    $pathResult = $query->get_result();
                                    $pathRow = $pathResult->fetch_assoc();
                                    $pdfPath = $pathRow['r_filepath'];

                                    echo '<tr>';
                                    echo '<td>' . $row['r_id'] . '</td>';
                                    echo '<td>' . $row['r_name'] . '</td>';
                                    echo '<td>' . $row['r_date'] . '</td>';
                                    echo '<td>' . $row['r_desc'] . '</td>';
                                    echo "<td style='text-align: center;'><a href='$pdfPath' class='btn btn-secondary btn-sm padd'>View</a> &nbsp;";
                                    echo '<a href="report-tomanagerprocess.php?r_id=' . $row['r_id'] . '" class="btn btn-success btn-sm padd">Send to Manager</a></td>';
                                    echo '</tr>';
                                }
                                echo '</table>';
                            } else {
                                echo 'No reports found.';
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
        