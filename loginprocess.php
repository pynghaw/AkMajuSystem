<?php 
session_start();

//Connect to DB

include("dbconnect.php");

//Retrieve data from registration form

$fname=$_POST['fname'];
$fpwd=$_POST['fpwd'];


//CRUD Operation
//RETRIEVE -SQL retrieve statement
$sql="SELECT * FROM tb_user
	  WHERE u_name='$fname' AND u_pwd='$fpwd'";

//Execute SQL
$result=mysqli_query($con,$sql);

//Retrive row/data
$row=mysqli_fetch_array($result);

//Redirect to corresponding page
$count=mysqli_num_rows($result);  //count data
if($count==1)
{
   
	$_SESSION['u_name']=session_id();
	$_SESSION['suname']=$fname;
	$_SESSION['u_id'] = $row['u_id'];
	//user available
	if($row['u_type']=='1') 
	{
		header('Location:staff.php');
	}
	else
	{
		header('Location:admin.php');
	}
}
else
{
	//user not available
	//Add script to let the user know either username or password wrong
	header('Location:login.php');
}

//Close DB Connection
mysqli_close($con);




?>