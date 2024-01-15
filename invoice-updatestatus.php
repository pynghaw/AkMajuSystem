<?php
include('dbconnect.php');

if (isset($_GET['iv_no'])) {
    $iv_no = $_GET['iv_no'];

    // Update the status to 1 (paid) in tb_invoice
    $updateStatusSql = "UPDATE tb_invoice SET iv_status = 1 WHERE iv_no = $iv_no";
    mysqli_query($con, $updateStatusSql);

    // Update order status to 1 (paid) based on the corresponding invoice number
    $orderUpdateSql = "UPDATE tb_order SET o_status = 1 WHERE o_ivno = $iv_no";
    mysqli_query($con, $orderUpdateSql);

    // Fetch order details to deduct confirmed order quantity from inventory
    $orderDetailsSql = "SELECT o.*, i.i_qty AS available_qty
                        FROM tb_order o
                        INNER JOIN tb_inventory i ON o.o_ino = i.i_no
                        WHERE o.o_ivno = $iv_no";
    $orderDetailsResult = mysqli_query($con, $orderDetailsSql);

    while ($row = mysqli_fetch_assoc($orderDetailsResult)) {
        // Deduct confirmed order quantity from inventory
        $confirmedQuantity = $row['o_quantity'];
        $newAvailableQuantity = $row['available_qty'] - $confirmedQuantity;

        $inventoryUpdateSql = "UPDATE tb_inventory SET i_qty = $newAvailableQuantity WHERE i_no = {$row['o_ino']}";
        mysqli_query($con, $inventoryUpdateSql);
        $inventoryUpdateSql = "UPDATE tb_inventory SET i_qtysold = i_qtysold + $confirmedQuantity WHERE i_no = {$row['o_ino']}";
        mysqli_query($con, $inventoryUpdateSql);
    }
    
}

?>
