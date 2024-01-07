<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}
include('dbconnect.php');
include 'headermain.php';
//retrieve data from form and session
$fino=$_POST['fino'];
$fcid=$_POST['fcid'];
$fdate=$_POST['fdate'];
$fqty=$_POST['fqty'];


//INSERT NEW BOOKING
$sql=" INSERT INTO tb_order(o_ino,o_cid,o_date,o_quantity)
    VALUES('$fino','$fcid','$fdate','$fqty')";

mysqli_query($con,$sql);
mysqli_close($con);
?>

<body>
<div class="content-body">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="container mt-4">
<div class="container">
  <br>

  <legend style="text-align: center; font-size: 30px;">Order Placed. Here's your order details</legend>
  <div class="form-group">
  <br>
  
  <h5>Customer ID:<?php echo $fcid;?></h5>
  <h5>Item ID:<?php echo $fino;?></h5>
  <h5>Quantity:<?php echo $fqty;?></h5>
  <h5>Date:<?php echo $fdate;?></h5>
  <button type="button" class="btn btn-primary" onclick="location.href='order-place.php';">Add Order</button>
  <button type="button" class="btn btn-primary" onclick="location.href='staff.php';">Home</button>

</div>
</div>
</body>
<?php include 'footer.php'; ?>