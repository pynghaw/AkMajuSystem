<?php
include ('dbconnect.php');

// Assuming you're getting r_id as a GET parameter
$r_id = isset($_GET['r_id']) ? $_GET['r_id'] : null;

// Initialize the file path variable
$r_filepath = '';

// Check if r_id is not null
if ($r_id) {
    // Prepare a SQL statement to fetch the file path
    $stmt = $con->prepare("SELECT r_filepath FROM tb_salesreport WHERE r_id = ?");
    $stmt->bind_param("i", $r_id);

    // Execute the query
    $stmt->execute();

    // Bind the result to the $r_filepath variable
    $stmt->bind_result($r_filepath);

    // Fetch the value
    $stmt->fetch();

    // Close the statement
    $stmt->close();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = 0;                                       // disable debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'pynghaw5@gmail.com';               // SMTP username
    $mail->Password   = 'tmvr baic rgjj qugn';                        // SMTP password 16 character app password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    // Recipients
    $mail->setFrom('pynghaw5@gmail.com', 'Chen');
    $mail->addAddress('chenhaw@graduate.utm.my', 'Manager');     // Add a recipient


     // Check if $r_filepath is not empty and file exists
    if (!empty($r_filepath) && file_exists($r_filepath)) {
        // Attach the file
        $mail->addAttachment($r_filepath);  
    }

    // Content
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = 'AK MAJU Monthly Sales Report';
    $mail->Body    = "Dear Manager, <br><br>Please find attached the sales report for [Month, Year]. It highlights our team's performance and areas for improvement. <br><br>Feel free to reach out for any clarification or details. <br><br>Thank you";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '<h1>Message has been sent</h1>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// header("Location: report-email1.php");
// exit;

?>