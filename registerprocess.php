<?php

// Connect to DB
include("dbconnect.php");

// Retrieve data from registration form
$fname = $_POST['fname'];
$fid = $_POST['fid'];
$fsex = $_POST['fsex'];
$fpwd = password_hash($_POST['fpwd'], PASSWORD_DEFAULT); // Hash the password
$femail = $_POST['femail'];
$ftel = $_POST['ftel'];
$ftype = $_POST['ftype'];


// CRUD Operation
// Create - SQL Insert Statement
$sql = "INSERT INTO tb_user(u_name, u_id, u_sex, u_email, u_pwd, u_contNo, u_type, u_status)
        VALUES('$fname', '$fid', '$fsex', '$femail', '$fpwd', '$ftel', '$ftype', '1')";

// Execute SQL
mysqli_query($con, $sql);

// Close DB Connection
mysqli_close($con);

// Redirect to the next page
header("Location:index.php");

?>
