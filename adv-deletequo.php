<?php
include('dbconnect.php');

if(isset($_GET['q_no']))
{
    $qno = $_GET['q_no'];

    //CURD: Update status to '2' instead of deleting
    $sql = "UPDATE tb_quotation SET q_status = '2' WHERE q_no='$qno'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        mysqli_close($con);

        // Redirect
        header('location:adv-deletequo-success.php');
        exit(); // Ensure that no further code is executed after the redirect
    } else {
        echo "Error updating record status: " . mysqli_error($con);
    }
}
?>
