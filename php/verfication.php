<?php 
// Start a new session or resume an existing session
session_start();

// Include the database connection code
require 'Connection.php';

// If the user hasn't received an OTP yet, redirect to the login page
if (empty($_SESSION['v'])) {
  header("Location: ../login.php");
  exit(); // exit the script after redirecting to prevent further execution
}

?>

<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verification</title>
  <link rel="stylesheet" href="../style/verfication.css">
</head>
<body>
  <section class="secLogin">
    <div class="cont">
      <div class="form sign-in">
        <form action="verfication.php" method="post" id="verification_form">
          <div class="FF">
            <i class="fa-solid fa-solid fa-lock fa-3x" style="color: #000000;"></i>
          </div>
          <h2>Verification code </h2>
          <h3 id="countdown"></h3>
          <label>
            <span class="codetext">Enter Code</span>
            <input maxlength="6" tabindex="2" type="number" name="Code" min="100000" max="999999" required >
          </label>
          <button tabindex="3" type="submit" class="submit" name="submit" >Sign In</button>
        </form>

        <?php
        // Get the client email from the session variable
        $email = $_SESSION['Email'];

        // Get the verification code entered by the user
        $entered_code = isset($_POST['Code']) ? $_POST['Code'] : '';

        if (isset($_POST['submit'])) { // If the form has been submitted
          // Check if the email is in the OTP table
          $check_query = "SELECT * FROM `otp` WHERE email = '$email'";
          $check_result = mysqli_query($conn, $check_query);
          $otp_code = mysqli_fetch_row($check_result); // Get the OTP code from the table
          $delete_query = "DELETE FROM `otp` WHERE email = '$email'"; // Delete the OTP from the table

          if ($entered_code == $otp_code[1]) { // If the verification code matches the OTP
            // Store the email in a session variable
            $_SESSION['Email'] = $email;

            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `student` WHERE email = '$email'")) > 0) { // If the email is in the "student" table
              mysqli_query($conn, $delete_query); // Delete the OTP from the table
              $_SESSION['id'] = $email; // Set a session variable with the email
              header("Location: ../index.php"); // Redirect the user to the homepage
              exit(); // exit the script after redirecting to prevent further execution
            } else {
              mysqli_query($conn, $delete_query); // Delete the OTP from the table
              // Send the user to the "info.php" page to enter their information
              $_SESSION['info_access'] = 2;
              header("Location: info.php");
              exit(); // exit the script after redirecting to prevent further execution
            }
          } else { // If the verification code does not match the OTP
            if (!isset($_SESSION['attemptCount'])) {
              $_SESSION['attemptCount'] = 1;
            } else {
              $_SESSION['attemptCount']++;
            }
            if ($_SESSION['attemptCount'] >= 3) { // If the user has entered an incorrect code 3 times
              ?>
              <script>
                alert("we sent you other OTP"); // Send a message to the user
                window.location.href = "InsertOTP.php"; // Redirect the user to the "InsertOTP.php" page to receive a new OTP
              </script>
              <?php
              unset($_SESSION['attemptCount']); // Reset the attempt count
              exit(); // exit the script after redirecting to prevent further execution
            } else {
              ?>
              <span class="OTPAlert">
                Invalid Verification code
                <i class="fa-solid fa-circle-exclamation fa-fade" style="color: #ff0f0f; --fa-animation-duration: 2.0s; margin-left: 5px;"></i>
              </span>
              <?php
            }
          }
        }
        ?>
      </div>
    </div>
  </section>
  <script src="JS/Wrong_OTP.js"></script>
  <script src="../JS/Timer.js"></script>
</body>
</html>