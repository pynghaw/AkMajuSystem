<?php
include('mysession.php');
if (!session_id()) {
    session_start();
}

include('dbconnect.php');


// Get ID from URL
if (isset($_GET['id'])) {
    $fno = $_GET['id'];

    // Display confirmation dialog using JavaScript
    echo "<script>
            var confirmrecover = confirm('Are you sure you want to add this product back to inventory?');

            if (confirmrecover) {
                window.location.href = 'recoverConfirmed1.php?id=$fno';
            } else {
                window.location.href = 'deleteInventory1.php';
            }
          </script>";
} else {
    // Redirect if ID is not provided
    header('Location: deleteInventory1.php');
    exit();
}
?>