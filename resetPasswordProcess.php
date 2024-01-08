<?php


if (isset($_GET['code'])) {
    $code = $_GET['code'];

    if($conn->connect_error){
        die('Could not connect to the databse');
    }


// Connect to DB
$conn = new mySqli('localhost', 'root', '', 'db_cryptoknights');


$fpwd = password_hash($_POST['fpwd'], PASSWORD_DEFAULT); // Hash the password

$verifyQuery = $conn->query("SELECT * FROM tb_user WHERE u_code='$code' AND u_updateTime >= NOW() - Interval 1 DAY");



if(isset($_POST['email'])){
        $email= $_POST['email'];
        $new_password = $_POST['fpwd'];
        $new_password = password_hash($_POST['fpwd'], PASSWORD_DEFAULT); // Hash the password


        $changeQuery = $conn->query("UPDATE tb_user SET u_pwd='$new_password' WHERE u_code='$code' AND updated_time >= NOW() - Interval 1 DAY");




if($changeQuery){
        header("Location: passwordchange.php");
}

$conn-close();
}else{
       header("Location: resetPassword.php"); 
}

      

// Redirect to the next page
header("Location:index.php");

} else {
    // Handle the case when $code is not set
    die("Error: Code is not set. Make sure you have the correct reset link.");
}





?>
