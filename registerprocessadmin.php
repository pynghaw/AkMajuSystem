<?php
session_start();
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

// Check if the userID or username already exists
$checkQuery = "SELECT COUNT(*) as count FROM tb_user WHERE u_id = '$fid' OR u_name = '$fname'";
$result = mysqli_query($con, $checkQuery);
$row = mysqli_fetch_assoc($result);

if ($row['count'] > 0) {
    // User with the same userID or username already exists
    $_SESSION['register1_message'] = 'User not register! User with the same UserID or Username already exists! Please use other UserID or Username';
    header("Location:registeradmin.php");
} else {
    // User does not exist, proceed with registration
    $sql = "INSERT INTO tb_user(u_name, u_id, u_sex, u_email, u_pwd, u_contNo, u_type, u_status)
            VALUES('$fname', '$fid', '$fsex', '$femail', '$fpwd', '$ftel', '$ftype', '1')";
    
    // Execute SQL
    mysqli_query($con, $sql);
    $_SESSION['register_message'] = 'User registered successfully!';
    header("Location:manageuser.php");
}

// Close DB Connection
mysqli_close($con);

        
?>
