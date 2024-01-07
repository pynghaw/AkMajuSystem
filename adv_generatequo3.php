<?php
include 'headermain.php'; 
include('dbconnect.php');

// Initialize variables to hold customer, order date, and additional information
$customer_id = "";
$order_date = "";
$discount = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve selected customer and order date
    $customer_id = $_POST['customer_id'];
    $order_date = $_POST['order_date'];
}
?>

<div class="container">
    <form method="POST" action="generatequotation_4.php">
        <div class="container">
            <fieldset>
                <br>
                <legend>Step 3: Additional Information</legend>

                <div class="form-group">
                    <label for="discountInput" class="form-label mt-4">Discount (%)</label>
                    <input type="text" class="form-control" id="discountInput" name="discount" placeholder="Enter Discount">
                </div>
                    <br>
                <button type="submit" class="btn btn-primary">Next</button>
            </fieldset>
        </div>
        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
        <input type="hidden" name="order_date" value="<?php echo $order_date; ?>">
    </form>
</div>
<?php include 'footer.php'; ?>
