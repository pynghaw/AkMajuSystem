<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}

include('dbconnect.php');

// Get ID from URL
if (isset($_GET['id'])) {
    $fno = $_GET['id'];

    // Perform status update
    $sql = "UPDATE tb_inventory SET i_status = 2 WHERE i_no='$fno'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Successful status update
        $_SESSION['success2_message'] = "Item successfully deleted.";
    } else {
        // Error in status update
        $_SESSION['error2_message'] = "Error updating item status: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);

    // Redirect back to Inventory.php
    header('Location: Inventory1.php');
    exit();
} else {
    // Redirect if ID is not provided
    header('Location: Inventory1.php');
    exit();
}
?>
