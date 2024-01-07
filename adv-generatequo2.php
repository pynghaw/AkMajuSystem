<?php
include 'headermain.php'; 
include('dbconnect.php');

// Initialize variables to hold customer and order date
$customer_id = "";
$order_date = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve selected customer
    $customer_id = $_POST['customer_id'];
}
?>

<div class="container">
    <form method="POST" action="generatequotation_3.php">
        <div class="container">
            <fieldset>
                <br>
                <legend>Step 2: Select Order Date</legend>

                <div class="form-group">
                    <label for="orderDateSelect" class="form-label mt-4">Select Order Date</label>
                    <select class="form-select" id="orderDateSelect" name="order_date">
                        <option value="">Select Date</option>
                        <?php
                        // Check if a customer is selected
                        if (!empty($customer_id)) {
                            // Query to get unique order dates for the selected customer
                            $orderDateSql = "SELECT DISTINCT o_date FROM tb_order WHERE o_cid = $customer_id";
                            $orderDateResult = mysqli_query($con, $orderDateSql);
                            // Check if the query was successful
                            if ($orderDateResult) {
                                while ($orderDateRow = mysqli_fetch_array($orderDateResult)) {
                                    $selected = ($order_date == $orderDateRow['o_date']) ? "selected" : "";
                                    echo "<option value='" . $orderDateRow['o_date'] . "' $selected>" . $orderDateRow['o_date'] . "</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
<br>
                <button type="submit" class="btn btn-primary">Next</button>
            </fieldset>
        </div>
        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
    </form>
</div>
<?php include 'footer.php'; ?>
