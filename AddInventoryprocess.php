<?php
include('mysession.php');
include('dbconnect.php');

if (!session_id()) {
    session_start();
}

// Retrieve data from form and session
$InventoryName = $_POST['InventoryName'];
$InventoryNo = $_POST['InventoryNo'];
$Quantity = $_POST['Quantity'];
$UnitPrice = $_POST['UnitPrice'];
$Description = $_POST['description'];

// Check if Product ID already exists in the database
$sqlCheck = "SELECT * FROM tb_inventory WHERE i_no = '$InventoryNo'";
$resultCheck = mysqli_query($con, $sqlCheck);

if (mysqli_num_rows($resultCheck) > 0) {
    // Product ID already exists, display an error message and redirect back to the form
    $_SESSION['error_message'] = "Product ID already exists. Please choose a different Product ID.";
    header("Location: AddInventory.php");
    exit();
} else {
    // Product ID is unique, proceed with insertion
    $sql = "INSERT INTO tb_inventory(i_no, i_name, i_qty, i_price, i_desc)
            VALUES('$InventoryNo', '$InventoryName','$Quantity','$UnitPrice','$Description')";

    mysqli_query($con, $sql);
    mysqli_close($con);

    // Display success message (optional)
    $_SESSION['success_message'] = "Product added successfully.";

}

include 'headermain.php';
?>


<br><br>
        <div class="content-body">

            
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="container mt-4">
<div class="container">
    
    <h5>Successfully added the inventory. Here is the detail:</h5>
    <h5>Product ID: <?php echo $InventoryNo; ?></h5>
    <h5>Inventory Name: <?php echo $InventoryName; ?></h5>
    <h5>Quantity: <?php echo $Quantity; ?></h5>
    <h5>Unit price: <?php echo $UnitPrice; ?></h5>
    <h5 style=" word-wrap: break-word;">Description: <?php echo $Description; ?></h5>
    <h5>Status: Added</h5>

<br><br>
    <div style="text-align: center;">                         
    <a class="btn btn-primary" href="AddInventory.php">BACK</a>
    <a class="btn btn-success" href="Inventory.php">Go to Inventory</a><br>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
    <?php include 'footer.php';?>