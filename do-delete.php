<?php
include('dbconnect.php');

if(isset($_GET['d_no']))
{
    $dno = $_GET['d_no'];

    //CURD: Delete
    $sql = "DELETE FROM tb_delorder WHERE d_no='$dno'";
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
