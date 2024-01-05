<?php

session_start();

// Connect to DB
include("dbconnect.php");

// Retrieve data from the login form
$fname = $_POST['fname'];
$fpwd = $_POST['fpwd'];

// CRUD Operation
// RETRIEVE - SQL retrieve statement
$sql = "SELECT * FROM tb_user
        WHERE u_name = '$fname'";

// Execute SQL
$result = mysqli_query($con, $sql);

// Retrieve row/data
$row = mysqli_fetch_array($result);

// Verify password using password_verify
if ($row && password_verify($fpwd, $row['u_pwd'])) {
    // Password is correct

    // Redirect to corresponding page
    $_SESSION['u_name'] = session_id();
    $_SESSION['suname'] = $fname;
    $_SESSION['u_id'] = $row['u_id'];

    if ($row['u_type'] == '1') {
        header('Location:staff.php');
    } else {
        header('Location:admin.php');
    }
} else {
    // Password is incorrect or user not found
    // Add script to let the user know either username or password is wrong
    header('Location:index.php');
}

// Close DB Connection
mysqli_close($con);

?>
