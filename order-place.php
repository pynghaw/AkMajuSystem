<?php  
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');
include 'headermain.php'; ?>



<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Place Orders</a></li>
                
            </ol>
        </div>
    </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="container mt-4">
<div class="container">
<form method="POST" action="order-place-process.php">
  <div class="container">
  <fieldset>
    <legend style="text-align: center; font-size: 30px;">Place Order</legend>
    <div class="form-group">
      <label for="exampleSelect1" class="form-label mt-4">Select Customer</label>

      <?php
      $sql="SELECT * FROM tb_customer WHERE c_status= 1";
      $result=mysqli_query($con,$sql);
      echo '<select class="form-control" id="exampleSelect1" name="customer_id">';
      while($row=mysqli_fetch_array($result))
      {
        echo "<option value='".$row['c_id']."'>".$row['c_name'];
      }
        
      echo'</select>';
      ?>
    </div>
    
      <div class="form-group">
      <label for="discountInput" class="form-label mt-4">Discount (%)</label>
      <input type="text" class="form-control" id="discountInput" name="discount" placeholder="Enter Discount">
      </div>

    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-primary">Reset</button>
  </fieldset>
</div>
</form>
</div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include 'footer.php';?>