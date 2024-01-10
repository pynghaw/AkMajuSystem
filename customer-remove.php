<?php include 'header.php'; 
include('dbconnect.php');

if(isset($_GET['id']))
{
  $cid=$_GET['id'];
}
//CURD: Delete
$sql = "UPDATE tb_customer SET c_status = '2' WHERE c_id='$cid'";
$result = mysqli_query($con, $sql);
mysqli_close($con);

//Redirect
header('location:customer-remove-success.php');
?>
