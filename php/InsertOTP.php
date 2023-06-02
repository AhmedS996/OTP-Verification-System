<?php 
session_start(); // Start a new session or resume an existing session
require 'Connection.php'; // Include the database connection code

    $Email = $_SESSION['Email']; // Get the email from the session variable

    $dquery = "DELETE FROM `otp` WHERE email = '$Email'"; // Delete any existing OTP for the email from the database

    mysqli_query($conn,$dquery); // Execute the delete query
    $passcode= rand(100000, 999999);// Generate a random 6-digit OTP

    // Insert the email and OTP into the database for verification
    $Insert_otp = "INSERT INTO `otp` (`passcode`,`email`) VALUES ('$passcode','$Email')";                                      
    $query = mysqli_query($conn,$Insert_otp);

    $_SESSION['v']=1; // Set a session variable to indicate that the OTP has been sent
    header("Location: Sent-OTP.php"); // Redirect the user to the "Sent-OTP.php" page
?>