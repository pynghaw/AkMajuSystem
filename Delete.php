<?php 
include('mysession.php'); 
if(!session_id())
{
	session_start();
}

//Get ID from URL
if(isset($_GET['id']))
{
 $fno=$_GET['id'];
}


 include ('dbconnect.php');

 $sql="DELETE FROM tb_inventory WHERE i_no='$fno'";
 $result=mysqli_query($con,$sql);
 mysqli_close($con);

 //Redirect
 header('Location:Inventory.php');
?>