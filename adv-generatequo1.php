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
    <title>Quotation Generation</title>
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
                        $sql = "SELECT * FROM tb_customer";
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            $selected = ($row['c_id'] == $customer_id) ? "selected" : "";
                            echo "<option value='" . $row['c_id'] . "' $selected>" . $row['c_name'] . "</option>";
                        }
                        ?>
                    </select>
                    <!-- Hidden input to store selected customer ID -->
                    <input type="hidden" name="selected_customer_id" value="<?php echo $customer_id; ?>">
                </div>

                <br>

                <!-- Step 2: Select Order Date -->
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
                <button type="submit" class="btn btn-primary">Generate Quotation</button>
            </fieldset>
        </div>
    </form>
</div>

<script>
    function submitForm() {
        // Update the hidden input with the selected customer ID
        document.querySelector('input[name="selected_customer_id"]').value = document.getElementById('customerSelect').value;
        document.getElementById('quotationForm').submit();
    }
</script>

</body>
</html>

<?php include 'footer.php'; ?>
