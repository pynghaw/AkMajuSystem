<?php include 'headermain.php'; 
include('dbconnect.php');
?>

<div class="container">
<form method="POST" action="order-placeprocess.php">
  <div class="container">
  <fieldset>
    <br>
    <legend>Place Order</legend>
    <div class="form-group">
      <label for="exampleSelect1" class="form-label mt-4">Select Customer</label>

      <?php
      $sql="SELECT * FROM tb_customer";
      $result=mysqli_query($con,$sql);
      echo '<select class="form-select" id="exampleSelect1" name="fcid">';
      while($row=mysqli_fetch_array($result))
      {
        echo "<option value='".$row['c_id']."'>".$row['c_name'];
      }
        
      echo'</select>';
      ?>
    </div>
    
     <div class="form-group">
      <label for="exampleSelect1" class="form-label mt-4">Select Item</label>
      <?php
      $sql="SELECT * FROM tb_inventory";
      $result=mysqli_query($con,$sql);
      echo '<select class="form-select" id="exampleSelect1" name="fino">';
      while($row=mysqli_fetch_array($result))
      {
        echo "<option value='".$row['i_no']."'>".$row['i_name'].", RM ".$row['i_price']."</option>";
      }
        
      echo'</select>';
      ?>
    </div>
  
     <div>
    <label for="exampleInputPassword1" class="form-label mt-4">Quantity</label>
      <input type="text" name="fqty" class="form-control" placeholder="Enter Quantity" required>
    </div>

    <div class="form-group">
    <label for="exampleInputPassword1" class="form-label mt-4">Select Order Date</label>
    <input type="date" name="fdate" class="form-control" placeholder="Enter Password" value="<?php echo date('Y-m-d'); ?>" required>
  </div>

    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-primary">Reset</button>
  </fieldset>
</div>
</form>
</div>
<?php include 'footer.php';?>