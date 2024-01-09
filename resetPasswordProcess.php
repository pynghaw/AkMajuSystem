<?php


if (isset($_POST['code'])) {
    $code = $_POST['code'];

// Connect to DB
$conn = new mySqli('localhost', 'root', '', 'db_cryptoknights');

if($conn->connect_error){
        die('Could not connect to the databse');
    }


$verifyQuery = $conn->query("SELECT * FROM tb_user WHERE u_code='$code'  ");



        $new_password = $_POST['fpwd'];
        $new_password = password_hash($_POST['fpwd'], PASSWORD_DEFAULT); // Hash the password


        $changeQuery = $conn->query("UPDATE tb_user SET u_pwd='$new_password' WHERE u_code='$code' ");




if($changeQuery){
        header("Location: passwordchange.php");
        $conn-close();
}else{
       header("Location:http://localhost/AkMajuSystem/resetPassword.php?code='. $code"); 
}

      



} else {
    // Handle the case when $code is not set
    die("Error: Code is not set. Make sure you have the correct reset link.");
}





?>
