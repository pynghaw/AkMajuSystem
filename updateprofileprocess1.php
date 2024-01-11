<?php 
include('mysession.php');
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


$sql="UPDATE tb_user
      SET u_name='$fname',u_email='$femail',u_sex='$fsex', u_contNo='$fphone'
      WHERE u_id='$fid'";


mysqli_query($con,$sql);
$_SESSION['profile1_message'] = 'User profile successfully updated!';
mysqli_close($con);

//Display result
header("Location:profile1.php");

?>

        

     

<?php 

include ('footer.php');?>