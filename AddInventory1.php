
<?php  
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');

include 'headernotification.php';
include 'headermainadmin.php'; ?>
<body>
        <!--**********************************
            Content body start
        ***********************************-->
       <div class="content-body">
<?php
            // Display success message
if (isset($_SESSION['success2_message'])) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            {$_SESSION['success2_message']}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";

    unset($_SESSION['success2_message']);
}

// Display error message
if (isset($_SESSION['error2_message'])) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            {$_SESSION['error2_message']}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";

    unset($_SESSION['error2_message']);
}
?>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="container mt-4">
   <div class="container">
    <form method="POST" action="AddInventoryprocess1.php" >
  <fieldset>
    <legend style="text-align: center; font-size: 30px;">Add Inventory</legend>
    
    <div class="form-group">
    <label for="exampleInputPassword1" class="form-label mt-4">Product ID</label>
    <input type="number" name="InventoryNo" class="form-control" id="exampleInputPassword1" placeholder="Product ID (max 5 digits)" required oninput="checkInputLength(this, 5)">
</div>

<script>
function checkInputLength(input, maxLength) {
    // Convert the input value to a string and remove leading zeros
    let inputValue = input.value.toString().replace(/^0+/, '');

    // Check if the length exceeds the specified maxLength
    if (inputValue.length > maxLength) {
        // Trim the input value to the maxLength
        input.value = inputValue.slice(0, maxLength);
    }
}
</script>


    <div class="form-group">
      <label for="exampleInputPassword1" class="form-label mt-4">Product Name</label>
      <input type="text" name="InventoryName" class="form-control" id="exampleInputPassword1" placeholder="Product Name" required>
</div>

  <div class="form-group">
      <label for="exampleInputPassword1" class="form-label mt-4">Quantity</label>
      <input type="number" name="Quantity" class="form-control" id="exampleInputPassword1" placeholder="Quantity" required>
</div>

 <div class="form-group">
      <label for="exampleInputPassword1" class="form-label mt-4">Cost (RM)</label>
      <input type="number" name="cost" class="form-control" id="exampleInputPassword1" placeholder="Cost" step="any" required>
</div>


 <div class="form-group">
      <label for="exampleInputPassword1" class="form-label mt-4">Mark Up Rate (%)</label>
      <input type="number" name="rate" class="form-control" id="exampleInputPassword1" placeholder="Mark Up Rate (%)" step="any" required>
</div>

 <div class="form-group">
      <label for="exampleInputPassword1" class="form-label mt-4">Product Description</label>
      <textarea name="description" class="form-control" id="exampleInputPassword1" placeholder="Description..." rows="4" cols="50" ></textarea>
      <br>
</div>
<div style="text-align: center;">
  <button type="submit" class="btn mb-1 btn-primary">Add Product</button>
  <button type="reset" class="btn mb-1 btn-dark">Reset</button>
</div>

</fieldset>
</form>

<br><br><br>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
   

</body>

        <!--**********************************
            Content body end
        ***********************************-->

        <?php include 

        'footer.php'; ?>
</body>
