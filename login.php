<?php 
session_start(); // Start a new session or resume an existing session
require 'php/Connection.php'; // Include the database connection code
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/signup page</title>   
</head>
<body>
    <form action="login.php" method="post">
        <h1>Welcome to login page</h1>
        <label>
            <label for="Email">Enter Email</label>
            <input tabindex = "1"type="email" name="Email" placeholder="email" maxlength="40" required>
        </label>
        <?php 
            if(isset($_POST['submit'])){ // If the form has been submitted
                $_SESSION['Email']= $Email = $_POST['Email']; // Store the email in a session variable
                $dquery = "DELETE FROM `otp` WHERE email = '$Email'"; // Delete any existing OTP for the email from the database

                mysqli_query($conn,$dquery); // Execute the delete query
                $passcode= rand(100000, 999999);// Generate a random 6-digit OTP

                // Insert the email and OTP into the database for verification
                $Insert_otp = "INSERT INTO `otp` (`passcode`,`email`) VALUES ('$passcode','$Email')";                                      
                $query = mysqli_query($conn,$Insert_otp);

                $_SESSION['v']=1; // Set a session variable to indicate that the OTP has been sent
                header("Location: php/Sent-OTP.php"); // Redirect the user to the "Sent-OTP.php" page
            }
        ?>
        <button tabindex ="2" type="submit" class="submit" name="submit">Sign In</button>
    </form>
</body>
</html>