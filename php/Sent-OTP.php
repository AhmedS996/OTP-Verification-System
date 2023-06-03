<?php 
// Start a new session or resume an existing session
session_start();

// Include the database connection code and the PHPMailer library
require 'Connection.php';
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Get the client email from the session variable to send the OTP code
$email = $_SESSION['Email'];

// Search the database for the OTP code corresponding to the client's email
$search_query = "SELECT * FROM `otp` WHERE Email = '$email'";
$search_result = mysqli_query($conn, $search_query);
$otp_row = mysqli_fetch_assoc($search_result);
$otp = $otp_row['code'];

try {
  // Create a new PHPMailer object and configure it to use SMTP
  $mail = new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'your-email@gmail.com'; // Replace with your email address
  $mail->Password = 'your-email-password'; // Replace with your email password or app password
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;
  
  // Set the sender and recipient email addresses, email format, subject, and body
  $mail->setFrom('your-email@gmail.com'); // Replace with your email address
  $mail->addAddress($email);
  $mail->isHTML(true);
  $mail->Subject = 'The OTP Code';
  $mail->Body = "Your OTP code is {$otp}.";

  // Send the email
  $mail->send();
} catch (Exception $e) {
  // Handle any exceptions that might occur while sending the email
  echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

// Redirect the user back to the verification page after sending the email
header('Location: verfication.php');
?>