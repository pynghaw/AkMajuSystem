<?php 
include('mysession.php');
if(!session_id())
{
	session_start();
}
 include ('dbconnect.php');


//Retrive data from form and session
$fname=$_POST['InventoryName'];
$fid=$_POST['InventoryNo'];
$fquantity=$_POST['Quantity'];
$fprice=$_POST['UnitPrice'];
$fdescription=$_POST['description'];


//CRUD UPDATE current new booking

$sql="UPDATE tb_inventory
	  SET i_name='$fname',i_no='$fid',i_qty='$fquantity', i_price='$fprice', i_desc='$fdescription'
	  WHERE i_no='$fid'";


mysqli_query($con,$sql);
mysqli_close($con);

//Display result
include 'headermain.php';
?>  
<div class="content-body">

            
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="container mt-4">
<br><br>
<div class="container">
	<h5 style="color: green;"><b>Successfully modified the inventory. Here is the detail:</b></h5>
	<h5>Product Name: <?php echo $fname; ?></h5>
	<h5>Product ID: <?php echo $fid; ?></h5>
	<h5>Quantity: <?php echo $fquantity; ?></h5>
	<h5>Unit price: <?php echo $fprice; ?></h5>
	<h5 style=" word-wrap: break-word;">Description: <?php echo $fdescription; ?></h5>
	<h5>Status: Modified</h5>

<br><br>
	<div style="text-align: center;">                         
	<a class="btn btn-primary" href="Inventory.php">BACK</a>
	</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
	<?php include 'footer.php';?>