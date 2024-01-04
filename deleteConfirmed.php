<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}

include('dbconnect.php');

// Get ID from URL
if (isset($_GET['id'])) {
    $fno = $_GET['id'];

    // Perform deletion
    $sql = "DELETE FROM tb_inventory WHERE i_no='$fno'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Successful deletion
        $_SESSION['success_message'] = "Item successfully deleted.";
    } else {
        // Error in deletion
        $_SESSION['error_message'] = "Error deleting item: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);

    // Redirect back to Inventory.php
    header('Location: Inventory.php');
    exit();
} else {
    // Redirect if ID is not provided
    header('Location: Inventory.php');
    exit();
}
?>