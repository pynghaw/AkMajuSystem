<?php 
include ('mysession.php');
if(!session_id())
{
    session_start();
}

 include ('dbconnect.php');


//Retrive data from form and session
$fid=$_POST['fid'];
$fname=$_POST['fname'];
$femail=$_POST['femail'];
$fsex=$_POST['sex'];
$fphone=$_POST['phonenumber'];
$status=$_POST['status'];


$sql="UPDATE tb_user
	  SET u_id='$fid',u_name='$fname',u_email='$femail', u_sex='$fsex', u_contNo='$fphone', u_status='$status'
	  WHERE u_id='$fid'";

$result = mysqli_query($con, $sql);
if ($result) {
    // Set a session variable to indicate successful update
    $_SESSION['update_message'] = 'User profile has been updated successfully.';
} else {
    // Set a session variable for error handling if needed
    $_SESSION['update_message'] = 'Error updating user profile.';
}
mysqli_close($con);

//Display result

header("Location:manageuser.php");
?>  


	<?php include 'footer.php';?>