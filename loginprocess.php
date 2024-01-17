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

// Check if the user exists
if ($row) {
    // Check if the account is activated
    if ($row['u_status'] == 1) {
        // Verify password using password_verify
        if (password_verify($fpwd, $row['u_pwd'])) {
            // Password is correct

            // Redirect to corresponding page
            $_SESSION['u_name'] = session_id();
            $_SESSION['suname'] = $fname;
            $_SESSION['u_id'] = $row['u_id'];

            if ($row['u_type'] == '1') {
                $_SESSION['user_role'] = 'staff';
                header('Location: staff.php');
            } else {
                $_SESSION['user_role'] = 'admin';
                header('Location: admin.php');
            }
        } else {
            // Password is incorrect
            $_SESSION['error_message'] = 'Incorrect password.';
            header('Location: index.php');
        }
    } else {
        // Account is not activated
        $_SESSION['error_message'] = 'Your account is not activated. Please find an admin to activate your account.';
        header('Location: index.php');
    }
} else {
    // User not found
    $_SESSION['error_message'] = 'Incorrect username or password.';
    header('Location: index.php');
}


// Close DB Connection
mysqli_close($con);
?>
