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
<br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Your New Order Details</h5>
                    <br>
                    <h5>Order Number: <?php echo $fno;?></h5>
                    <h5>Item ID: <?php echo $fino;?></h5>
                    <h5>Quantity: <?php echo $fqty;?></h5>
                    <h5>Date: <?php echo $fdate;?></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="text-align: center;">                         
	<a class="btn btn-primary" href="order-manage.php">BACK</a>
	</div>
<br><br><br><br><br><br><br><br><br><br><br><br>
<?php include 'footer.php'; ?>
