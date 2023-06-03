<?php 
session_start(); // Start a new session or resume an existing session
require 'Connection.php'; // Include the database connection code

if(empty($_SESSION['v'])){ // If the user hasn't received an OTP yet, redirect to the login page
    header("Location: ../login.php");
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
            <form action="verfication.php" method="post" id="verfication_form">
                <div class="FF">
                    <i class="fa-solid fa-solid fa-lock fa-3x" style="color: #000000;"></i>
                </div>
                <h2>Verfication code </h2>
                <h3 id="countdown"></h3>
                <label>
                    <span class = "codetext">Enter Code</span>
                    <input maxlength="6" tabindex="2" type="number" name="Code" min="100000" max="999999" required >
                </label>
                <button tabindex="3" type="submit" class="submit" name="submit" >Sign In</button>
            </form>
                <?php
                  
                  $Emailing = $_SESSION['Email']; // Get the client email from the session variable
                  $Enter_Code = isset($_POST['Code']) ? $_POST['Code'] : ''; // Get the verification code entered by the user
                  
                  if (isset($_POST['submit'])) { // If the form has been submitted
                      $check = "SELECT * FROM `otp` WHERE email = '$Emailing'"; // Check if the email is in the OTP table
                      $query = mysqli_query($conn, $check);
                      $code = mysqli_fetch_row($query); // Get the OTP code from the table
              
                      $dquery = "DELETE FROM `otp` WHERE email = '$Emailing'"; // Delete the OTP from the table
                      
                      if ($Enter_Code == $code[1]) { // If the verification code matches the OTP
                          $_SESSION['Email'] = $Emailing; // Store the email in a session variable
                                          
                          if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `student` WHERE email = '$Emailing'")) > 0) { // If the email is in the "student" table
                              mysqli_query($conn, $dquery); // Delete the OTP from the table
                              $_SESSION['id']=$_SESSION['Email']; // Set a session variable with the email
                              header("Location: ../index.php"); // Redirect the user to the homepage
                          } else {
                              mysqli_query($conn, $dquery); // Delete the OTP from the table
                              // Send the user to the "info.php" page to enter their information
                              header("Location: info.php");
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