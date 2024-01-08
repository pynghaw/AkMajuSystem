<?php
include('dbconnect.php');

if (isset($_GET['iv_no'])) {
    $iv_no = $_GET['iv_no'];

    // Update the status to 1 (paid)
    $updateStatusSql = "UPDATE tb_invoice SET iv_status = 1 WHERE iv_no = $iv_no";
    mysqli_query($con, $updateStatusSql);
}
?>
