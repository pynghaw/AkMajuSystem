<?php
include 'headermain.php';
include('dbconnect.php');
echo "<form method='POST' action='adv-generatequoprocess.php'>"; 
// Retrieve data from page3.php
$customer_id = $_POST['customer_id'];
$order_date = $_POST['order_date'];
$discount = $_POST['discount'];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Calculate total, discount amount, grand total, and insert data into quotation database
    $sql = "SELECT o.*, i.i_name, i.i_price FROM tb_order o
            INNER JOIN tb_inventory i ON o.o_ino = i.i_no
            WHERE o.o_cid = $customer_id AND o.o_date = '$order_date'";
    $result = mysqli_query($con, $sql);

    // Initialize variables for calculations
    $total = 0;
    $inventoryData = [];

    // Check if there are orders
    if (mysqli_num_rows($result) > 0) {
        // Calculate total based on order items and collect inventory data
        while ($row = mysqli_fetch_assoc($result)) {
            $total += $row['o_quantity'] * $row['i_price'];
            $inventoryData[] = array(
                'i_name' => $row['i_name'],
                'i_price' => $row['i_price']
            );
        }

        // Calculate discount amount
        $discountAmount = ($discount / 100) * $total;

        // Calculate grand total
        $grandTotal = $total - $discountAmount;

        // Insert data into quotation database
        $insertQuotationSql = "INSERT INTO tb_quotation (q_cid, q_date, q_tAmount, q_discPercent, q_discAmount)
                               VALUES ('$customer_id', NOW(), '$grandTotal', '$discount', '$discountAmount')";
        $insertQuotationResult = mysqli_query($con, $insertQuotationSql);

        // Display quotation details
        echo "<div class='container'>";
        echo "<h3>Quotation Details</h3>";
        echo "<p>Customer ID: $customer_id</p>";
        echo "<p>Order Date: $order_date</p>";
        echo "<p>Total: RM $total</p>";
        echo "<p>Discount: $discount%</p>";
        echo "<p>Discount Amount: RM $discountAmount</p>";
        echo "<p>Grand Total: RM $grandTotal</p>";
        echo "</div>";
    } else {
        // Display message if no orders found
        echo "<div class='container'>";
        echo "<p>No orders found for the selected customer on the selected date.</p>";
        echo "</div>";
    }
}

// Form and hidden inputs

echo "<input type='hidden' name='customer_id' value='$customer_id'>";
echo "<input type='hidden' name='order_date' value='$order_date'>";
echo "<input type='hidden' name='discount' value='$discount'>";
echo "<div class='container'>";
echo "<button type='submit' class='btn btn-primary'>Generate</button>";
echo "</form>";

include 'footer.php';
?>
