<?php
include('dbconnect.php');

if(isset($_GET['q_no']))
{
    $qno = $_GET['q_no'];

    //CURD: Delete
    $sql = "DELETE FROM tb_quotation WHERE q_no='$qno'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        mysqli_close($con);

        // Redirect
        header('location:adv-deletequo-success.php');
        exit(); // Ensure that no further code is executed after the redirect
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
}
?>
