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
$fdescription=$_POST['description'];
$cost=$_POST['cost'];
$mrate=$_POST['rate'];
  // Calculate Selling Price
    $SellingPrice = $cost + ($cost * ($mrate / 100));


//CRUD UPDATE current new booking

$sql="UPDATE tb_inventory
	  SET i_name='$fname',i_no='$fid',i_qty='$fquantity', i_cost='$cost', i_markupRate='$mrate', i_price='$SellingPrice', i_desc='$fdescription'
	  WHERE i_no='$fid'";


mysqli_query($con,$sql);
mysqli_close($con);

//Display result
include 'headermainadmin.php';
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
	<h5>Cost:RM <?php echo $cost; ?></h5>
	<h5>Mark Up Rate: <?php echo $mrate; ?>%</h5>
	<h5>Unit price:RM <?php echo $SellingPrice; ?></h5>
	<h5 style=" word-wrap: break-word;">Description: <?php echo $fdescription; ?></h5>
	<h5>Status: <span style="color: green;">Modified</span></h5>

<br><br>
	<div style="text-align: center;">                         
	<a class="btn btn-primary" href="Inventory1.php">BACK</a>
	</div>
	<br><br>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
	<?php include 'footer.php';?>