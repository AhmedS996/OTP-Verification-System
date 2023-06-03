<?php 
session_start(); // Start a new session or resume an existing session
include 'Connection.php'; // Include the database connection code

use PHPMailer\PHPMailer\PHPMailer; // Import the PHPMailer library
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php'; // Include the PHPMailer Exception class
require '../PHPMailer-master/src/PHPMailer.php'; // Include the PHPMailer class
require '../PHPMailer-master/src/SMTP.php'; // Include the SMTP class

$email = $_SESSION['Email']; // Get the client email from the session variable to send the OTP code

// Get the OTP code from the database
$search = "SELECT * FROM `otp` WHERE Email = '$email'";
$find = mysqli_query($conn,$search);
$The_code_row = mysqli_fetch_row($find);

$The_Code = $The_code_row[1]; // Get the OTP code from the database row

$mail = new PHPMailer(true); // Create a new PHPMailer object

$mail->isSMTP(); // Set the mailer to use SMTP
$mail->Host = 'smtp.gmail.com'; // Specify the SMTP server
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'cms.uhb@gmail.com'; // SMTP username (website email)
$mail->Password = 'qofiegfkneryxnbq'; // SMTP password (app password)
$mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465; // TCP port to connect to

$mail->setFrom('cms.uhb@gmail.com'); // Set the sender's email address

$mail->addAddress($email); // Add a recipient

$mail->isHTML(true); // Set email format to HTML

$mail->Subject = "The OTP CODE"; // Set the subject of the email
$mail->Body = "your code is {$The_Code}"; // Set the body of the email

$mail->send(); // Send the email

header("Location: verfication.php"); // Redirect the user back to the verification page
?>