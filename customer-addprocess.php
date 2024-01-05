<?php
//connect to the database
include('dbconnect.php');

//retrieve data from registration form
$cname=$_POST['cname'];
$cadd=$_POST['cadd'];
$cbadd=$_POST['cbadd'];
$cemail=$_POST['cemail'];
$cphone=$_POST['cphone'];


//CRUD Operations

//Create-SQL Insert Statement
$sql=" INSERT INTO tb_customer(c_name,c_add,c_billAdd,c_email,c_cont)
		VALUES('$cname','$cadd','$cbadd','$cemail','$cphone')";

//Execute SQL
mysqli_query($con,$sql);

//Close DB Connection
mysqli_close($con);

//Redirect to Next Page
header('Location:customer-add.php');

?>