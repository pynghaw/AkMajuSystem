<?php include 'header.php'; 
include('dbconnect.php');

if(isset($_GET['id']))
{
  $cid=$_GET['id'];
}
//CURD: Delete
$sql="DELETE FROM tb_customer WHERE c_id='$cid'";
$result-mysqli_query($con,$sql);
mysqli_close($con);

//Redirect
header('location:customer-manage.php');
?>
