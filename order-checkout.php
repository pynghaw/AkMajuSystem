<?php
include 'headermain.php';
include 'dbconnect.php';

// Check if required parameters are set in the URL
if (isset($_GET['id'], $_GET['name'], $_GET['desc'], $_GET['unitPrice'], $_GET['quantity'], $_GET['customer_id'])) {
    $itemIds = $_GET['id'];
    $itemNames = $_GET['name'];
    $itemDescs = $_GET['desc'];
    $itemUnitPrices = $_GET['unitPrice'];
    $itemQuantities = $_GET['quantity'];
    $customer_id = $_GET['customer_id']; // Retrieve customer_id from the URL
    $discount = $_GET['discount'];
    // Validate and sanitize data
    $customer_id = mysqli_real_escape_string($con, $customer_id);

    // Perform the necessary operations to create new orders
    for ($i = 0; $i < count($itemIds); $i++) {
        $itemId = mysqli_real_escape_string($con, $itemIds[$i]);
        $itemName = mysqli_real_escape_string($con, $itemNames[$i]);
        $itemDesc = mysqli_real_escape_string($con, $itemDescs[$i]);
        $itemUnitPrice = mysqli_real_escape_string($con, $itemUnitPrices[$i]);
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

    // Display success message or redirect to another page
    echo "Orders created successfully!";
} else {
    // Handle missing parameters error
    echo "Missing parameters.";
}

include 'const-checkoutfooter.php';
?>
