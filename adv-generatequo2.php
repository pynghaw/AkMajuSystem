<?php
include 'headermain.php'; 
include 'dbconnect.php';

// Initialize variables to hold customer, order date, and discount information
$customer_id = "";
$order_date = "";
$discount = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve selected customer, order date, and discount
    $customer_id = $_POST['customer_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation Generation - Step 1</title>
    <!-- Add your CSS and JS links here -->
</head>
<body>

<div class="container">
    <form method="POST" action="adv-generatequo2.php" id="quotationForm">
        <div class="container">
            <fieldset>
                <br>
                <legend>Step 1: Select Customer</legend>

                <!-- Select Customer -->
                <div class="form-group">
                    <label for="customerSelect" class="form-label mt-4">Select Customer</label>
                    <select class="form-select" id="customerSelect" name="customer_id" onchange="submitForm()">
                        <option value="">Select Customer</option>
                        <?php
                        $customerSql = "SELECT * FROM tb_customer";
                        $customerResult = mysqli_query($con, $customerSql);
                        while ($customerRow = mysqli_fetch_array($customerResult)) {
                            $selected = ($customer_id == $customerRow['c_id']) ? "selected" : "";
                            echo "<option value='" . $customerRow['c_id'] . "' $selected>" . $customerRow['c_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
    </form>
                <br>
    <form method="POST" action="adv-generatequo3.php">
                <!-- Select Order Date -->
                <div class="form-group">
                    <label for="orderDateSelect" class="form-label mt-4">Select Order Date</label>
                    <select class="form-select" id="orderDateSelect" name="order_date">
                        <option value="">Select Date</option>
                        <?php
                        // If customer_id is set, fetch and populate order dates
                        if (!empty($customer_id)) {
                            $orderDateSql = "SELECT DISTINCT o_date FROM tb_order WHERE o_cid = $customer_id";
                            $orderDateResult = mysqli_query($con, $orderDateSql);
                            while ($orderDateRow = mysqli_fetch_array($orderDateResult)) {
                                $selected = ($order_date == $orderDateRow['o_date']) ? "selected" : "";
                                echo "<option value='" . $orderDateRow['o_date'] . "' $selected>" . $orderDateRow['o_date'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <br>

                <!-- Step 3: Enter Discount -->
                <div class="form-group">
                    <label for="discountInput" class="form-label mt-4">Discount (%)</label>
                    <input type="text" class="form-control" id="discountInput" name="discount" placeholder="Enter Discount" value="<?php echo $discount; ?>">
                </div>

                <br>

                <!-- Next Button -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </fieldset>
        </div>
    </form>
</div>

<script>
    function submitForm() {
        document.getElementById('quotationForm').submit();
    }
</script>

</body>
</html>

<?php include 'footer.php'; ?>
