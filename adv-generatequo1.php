<?php
if (!session_id()) {
    session_start();
}
include 'headermain.php';
include('dbconnect.php');

// Initialize variables to hold customer information
$customer_id = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve selected customer
    $customer_id = $_POST['customer_id'];
}
?>

<div class="container">
    <form method="POST" action="adv-generatequo2.php">
        <div class="container">
            <fieldset>
                <br>
                <legend>Step 1: Select Customer</legend>

                <!-- Select Customer -->
                <div class="form-group">
                    <label for="customerSelect" class="form-label mt-4">Select Customer</label>
                    <select class="form-select" id="customerSelect" name="customer_id">
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
                </div>
                <br>

                <!-- Next Button -->
                <button type="submit" class="btn btn-primary">Next</button>
            </fieldset>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>
