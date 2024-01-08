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
    // Calculate total, discount amount, grand total, and insert data into the quotation database
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

        // Insert data into the quotation database
        $insertQuotationSql = "INSERT INTO tb_quotation (q_cid, q_date, q_tAmount, q_discPercent, q_discAmount)
                               VALUES ('$customer_id', NOW(), '$grandTotal', '$discount', '$discountAmount')";
        $insertQuotationResult = mysqli_query($con, $insertQuotationSql);
        
        ?>
        <body>
            <div class="content-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="container mt-4">
                                    <div class="container">
                                        <br>
                                        <legend style="text-align: center; font-size: 30px;">Here's your Quotation details</legend>
                                        <div class="form-group">
                                            <br>
                                            <h5>Customer ID:<?php echo $customer_id;?></h5>
                                            <h5>Order Date:<?php echo $order_date;?></h5>
                                            <h5>Total: RM:<?php echo $total;?></h5>
                                            <h5>Discount:<?php echo $discount;?>%</h5>
                                            <h5>Discount Amount: RM:<?php echo $discountAmount;?></h5>
                                            <h5>Grand Total: RM:<?php echo $grandTotal;?></h5>
                                            
                                            <!-- Generate button moved here -->
                                            <div class='container mt-3'>
                                                <button type='submit' class='btn btn-primary'>Generate</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        <?php 
        // Form and hidden inputs
        echo "<input type='hidden' name='customer_id' value='$customer_id'>";
        echo "<input type='hidden' name='order_date' value='$order_date'>";
        echo "<input type='hidden' name='discount' value='$discount'>";

        include 'footer.php';
    }
}
echo "</form>";
?>
