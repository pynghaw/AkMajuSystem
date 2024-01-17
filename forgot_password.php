<?php 
   if(isset($_POST['reset'])){
      $email=$_POST['email'];
   }

   use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'mail/Exception.php';
require 'mail/PHPMailer.php';
require 'mail/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '';                     //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('', 'AK MAJU');
    $mail->addAddress($email);     //Add a recipient
   
   $code= substr(str_shuffle('1234567890QWERTYUIOPASDFGHJKLZXCVBNM'),0,10);
   $link = 'http://localhost/AkMajuSystem/resetPassword.php?code='. $code;

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Password Reset';
    $mail->Body    = 'To reset your password please click <a href="'.$link.'">here</a>. <br>Reset your password in a day.';

    $conn = new mySqli('localhost', 'if0_35803859', 'crypto2003', 'db_cryptoknights');

    if($conn->connect_error){
      die('Could not connect to the database.');
    }

    $verifyQuery= $conn->query("SELECT * FROM tb_user WHERE u_email='$email'");

    if($verifyQuery->num_rows){
      $codeQuery= $conn->query("UPDATE tb_user SET u_code='$code' WHERE u_email='$email'");

      $mail->send();
      echo '  Message has been sent, check your email';

    }
$conn->close();

  
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>