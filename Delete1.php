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
            var confirmDelete = confirm('Are you sure you want to delete this product?');

            if (confirmDelete) {
                window.location.href = 'deleteConfirmed1.php?id=$fno';
            } else {
                window.location.href = 'Inventory1.php';
            }
          </script>";
} else {
    // Redirect if ID is not provided
    header('Location: Inventory1.php');
    exit();
}
?>