<?php include 'headermain.php'; ?>
<?php 
include('dbconnect.php');

//retrieve data from form and session
$fno=$_POST['fno'];
$fino=$_POST['fino'];
$fdate=$_POST['fdate'];
$fqty=$_POST['fqty'];


//INSERT NEW BOOKING
$sql="  UPDATE tb_order
        SET o_ino='$fino', o_date='$fdate', o_quantity='$fqty'
        WHERE o_no='$fno'";

mysqli_query($con,$sql);
mysqli_close($con);

//DISPLAY RESULT

?>
<div class="container">
  <br>
  <h5>Your New Order Details</h5>
  <br>
  <h5>Order Number:<?php echo $fno;?></h5>
  <h5>Item ID:<?php echo $fino;?></h5>
  <h5>Quantity:<?php echo $fqty;?></h5>
  <h5>Date:<?php echo $fdate;?></h5>


</div>
<?php include 'footer.php'; ?>