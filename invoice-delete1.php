<?php
include('dbconnect.php');

if(isset($_GET['iv_no']))
{
    $ivno = $_GET['iv_no'];

    //CURD: Delete
    $sql = "UPDATE tb_invoice SET iv_status = '2' WHERE iv_no='$ivno'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        mysqli_close($con);

        // Redirect
        header('location:invoice-delete-success1.php');
        exit(); // Ensure that no further code is executed after the redirect
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
}
?>
