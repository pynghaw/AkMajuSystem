<?php

// Connect to DB
include("dbconnect.php");

// Retrieve data from registration form

$fpwd = password_hash($_POST['fpwd'], PASSWORD_DEFAULT); // Hash the password


// CRUD Operation
// Create - SQL Insert Statement
$sql = "UPDATE tb_user
        SET u_pwd='$fpwd'";
      

// Execute SQL
mysqli_query($con, $sql);

// Close DB Connection
mysqli_close($con);

// Redirect to the next page
header("Location:index.php");

?>
