<?php 
session_start();
require 'Connection.php';

// Get the user's email from the session variable
$email = $_SESSION['Email'];

// Delete the row with the user's email from the `otp` table in the database
$delete_query = "DELETE FROM `otp` WHERE email = '$email'";
mysqli_query($conn, $delete_query);

// Redirect the user to the login page
header('Location: ../login.php');
exit(); // exit the script after redirecting to prevent further execution
?>