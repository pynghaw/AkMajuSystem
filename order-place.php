<?php  
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');
// Display success message
if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            {$_SESSION['success_message']}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";

    unset($_SESSION['success_message']);
}

// Display error message
if (isset($_SESSION['error_message'])) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            {$_SESSION['error_message']}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";

    unset($_SESSION['error_message']);
}
include 'headernotification.php';
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
<form method="POST" action="order-placeprocess.php">
  <div class="container">
  <fieldset>
    <legend style="text-align: center; font-size: 30px;">Place Order</legend>
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

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include 'footer.php';?>