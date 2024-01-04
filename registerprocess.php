<?php 

//Connect to DB

include("dbconnect.php");

//Retrieve data from registration form

$fname=$_POST['fname'];
$fid=$_POST['fid'];
$fsex=$_POST['fsex'];
$fpwd=$_POST['fpwd'];
$femail=$_POST['femail'];
$ftel=$_POST['ftel'];
$ftel=$_POST['fpwd'];
$ftype=$_POST['ftype'];

//CRUD Operation
//Create-SQL Insert Statement
$sql="INSERT INTO tb_user(u_name, u_id, u_sex, u_email, u_pwd, u_contNo, u_type)
	  VALUES('$fname', '$fid', '$fsex','$femail','$fpwd','$ftel', '$ftype')";

//Execute SQL
mysqli_query($con,$sql);

//Close DB Connection
mysqli_close($con);

//Redirect to next page
header("Location:index.php");


?>