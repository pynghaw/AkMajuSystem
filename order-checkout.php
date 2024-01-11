<?php
include 'headermain.php';
include 'dbconnect.php';

// Check if required parameters are set in the URL
if (isset($_GET['id'], $_GET['name'], $_GET['desc'], $_GET['unitPrice'], $_GET['quantity'], $_GET['customer_id'], $_GET['discount'])) {
    $itemIds = $_GET['id'];
    $itemNames = $_GET['name'];
    $itemDescs = $_GET['desc'];
    $itemUnitPrices = $_GET['unitPrice'];
    $itemQuantities = $_GET['quantity'];
    $customer_id = $_GET['customer_id']; // Retrieve customer_id from the URL
    $discount = $_GET['discount'];
    // Validate and sanitize data
    $customer_id = mysqli_real_escape_string($con, $customer_id);

    // Display order details
    echo "<div class='content-body'>";
    echo "<div class='row page-titles mx-0'>";
    echo "<div class='col p-md-0'>";
    echo "<ol class='breadcrumb'>";
    echo "<li class='breadcrumb-item'><a href='javascript:void(0)'>Construction</a></li>";
    echo "<li class='breadcrumb-item active'><a href='javascript:void(0)'>Order Details</a></li>";
    echo "</ol>";
    echo "</div>";
    echo "</div>";

    echo "<div class='container-fluid'>";
    echo "<div class='row'>";
    echo "<div class='col-12'>";
    echo "<div class='card'>";
    echo "<div class='card-body'>";
    echo "<div class='container'>";
    echo "<h2>Order Details</h2>";
    echo "<p>Customer ID: $customer_id</p>";
    echo "<p>Discount: $discount %</p>";
    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Name</th>";
    echo "<th>Description</th>";
    echo "<th>Unit Price (RM)</th>";
    echo "<th>Quantity</th>";
    echo "<th>Total Price (RM)</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Perform the necessary operations to create new orders
    $totalPrice = 0;
    for ($i = 0; $i < count($itemIds); $i++) {
        $itemId = mysqli_real_escape_string($con, $itemIds[$i]);
        $itemName = mysqli_real_escape_string($con, $itemNames[$i]);
        $itemDesc = mysqli_real_escape_string($con, $itemDescs[$i]);
        $itemUnitPrice = mysqli_real_escape_string($con, $itemUnitPrices[$i]);
        $itemQuantity = mysqli_real_escape_string($con, $itemQuantities[$i]);

        $totalPrice += $itemUnitPrice * $itemQuantity;

        echo "<tr>";
        echo "<td>$itemId</td>";
        echo "<td>$itemName</td>";
        echo "<td>$itemDesc</td>";
        echo "<td>$itemUnitPrice</td>";
        echo "<td>$itemQuantity</td>";
        echo "<td>" . ($itemUnitPrice * $itemQuantity) . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "<tfoot>";
    echo "<tr>";
    echo "<td colspan='5' style='text-align:right;'><strong>Total Price:</strong></td>";
    echo "<td><strong>$totalPrice</strong></td>";
    echo "</tr>";

    echo "</tfoot>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

    // Insert order details into the tb_order table
    for ($i = 0; $i < count($itemIds); $i++) {
        $itemId = mysqli_real_escape_string($con, $itemIds[$i]);
        $itemQuantity = mysqli_real_escape_string($con, $itemQuantities[$i]);

        // Insert order details into the tb_order table
        $insertOrderSql = "INSERT INTO tb_order (o_ino, o_cid, o_discount, o_price, o_quantity, o_date)
                            VALUES ('$itemId', '$customer_id', '$discount', '$itemUnitPrice', '$itemQuantity', NOW())";

        $insertResult = mysqli_query($con, $insertOrderSql);

        if (!$insertResult) {
            // Handle insert error
            echo "Error creating new order: " . mysqli_error($con);
        }
    }

} else {
    // Handle missing parameters error
    echo "Missing parameters.";
}

include 'adv-generatequo-footer.php';
?>
