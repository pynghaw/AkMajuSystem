<?php
include('dbconnect.php');

if(isset($_GET['iv_no']))
{
    $ivno = $_GET['iv_no'];

    //CURD: Delete
    $sql = "DELETE FROM tb_invoice WHERE iv_no='$ivno'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        mysqli_close($con);

        // Redirect
        header('location:do-delete-success.php');
        exit(); // Ensure that no further code is executed after the redirect
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
}
?>
