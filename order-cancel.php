<?php
include('dbconnect.php');

if(isset($_GET['o_no']))
{
    $fno = $_GET['o_no'];

    //CURD: Delete
    $sql = "DELETE FROM tb_order WHERE o_no='$fno'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        mysqli_close($con);

        // Redirect
        header('location:order-cancel-success.php');
        exit(); // Ensure that no further code is executed after the redirect
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
}
?>
