
<?php  

include 'headermain.php'; ?>
<body>
        <!--**********************************
            Content body start
        ***********************************-->
       <div class="content-body">

            
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="container mt-4">
   <div class="container">
    <form method="POST" action="AddInventoryprocess.php" >
  <fieldset>
    <legend style="text-align: center; font-size: 30px;">Add Inventory</legend>
    
     <div class="form-group">
      <label for="exampleInputPassword1" class="form-label mt-4">Product ID</label>
      <input type="text" name="InventoryNo" class="form-control" id="exampleInputPassword1" placeholder="Product ID" required>
</div>

    <div class="form-group">
      <label for="exampleInputPassword1" class="form-label mt-4">Product Name</label>
      <input type="text" name="InventoryName" class="form-control" id="exampleInputPassword1" placeholder="Product Name" required>
</div>

  <div class="form-group">
      <label for="exampleInputPassword1" class="form-label mt-4">Quantity</label>
      <input type="number" name="Quantity" class="form-control" id="exampleInputPassword1" placeholder="Quantity" required>
</div>

 <div class="form-group">
      <label for="exampleInputPassword1" class="form-label mt-4">Unit Price (RM)</label>
      <input type="number" name="UnitPrice" class="form-control" id="exampleInputPassword1" placeholder="Unit Price" step="any" required>
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
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>

        <!--**********************************
            Content body end
        ***********************************-->

        <?php include 

        'footer.php'; ?>
</body>
