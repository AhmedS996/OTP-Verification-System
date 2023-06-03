<?php 
// Start a new session or resume an existing session
session_start();

// Include the database connection code
require 'php/Connection.php';

// Check if the login form has been submitted
if(isset($_POST['submit'])) {
  // Store the email in a session variable
  $_SESSION['Email'] = $Email = $_POST['Email'];

  // Delete any existing OTP for the email from the database
  $dquery = "DELETE FROM `otp` WHERE email = '$Email'";
  mysqli_query($conn, $dquery);

  // Generate a random 6-digit OTP
  $passcode = rand(100000, 999999);

  // Insert the email and OTP into the database for verification
  $Insert_otp = "INSERT INTO `otp` (`passcode`, `email`) VALUES ('$passcode', '$Email')";
  $query = mysqli_query($conn, $Insert_otp);

  // Set a session variable to indicate that the OTP has been sent
  $_SESSION['v'] = 1;

  // Redirect the user to the "Sent-OTP.php" page
  header("Location: php/Sent-OTP.php");
  exit(); // exit the script after redirecting to prevent further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login/Signup Page</title>
  <link rel="stylesheet" href="style/login.css">
</head>
<body>
  <form action="login.php" method="post">
    <h1>Welcome to the Login Page</h1>
    <label>
      <label for="Email">Enter Email</label>
      <input tabindex="1" type="email" name="Email" placeholder="Email" maxlength="40" required>
    </label>
    <button tabindex="2" type="submit" class="submit" name="submit">Sign In</button>
  </form>
</body>
</html>