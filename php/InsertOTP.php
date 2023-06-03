<?php 
session_start();

require 'Connection.php';

$email = $_SESSION['Email'];

// Delete any existing OTP for the email from the database
$delete_query = "DELETE FROM `otp` WHERE email = '$email'";
mysqli_query($conn, $delete_query);

// Generate a random 6-digit OTP
$otp = rand(100000, 999999);

// Insert the email and OTP into the database for verification
$insert_query = "INSERT INTO `otp` (`passcode`, `email`) VALUES ('$otp', '$email')";
mysqli_query($conn, $insert_query);

// Set a session variable to indicate that the OTP has been sent
$_SESSION['v'] = 1;

// Redirect the user to the "Sent-OTP.php" page
header('Location: Sent-OTP.php');
?>