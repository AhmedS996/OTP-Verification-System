<?php 
session_start();
require 'php/Connection.php';
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
            if(isset($_POST['submit'])){
                $_SESSION['Email']= $Email = $_POST['Email'];
                $dquery = "DELETE FROM `otp` WHERE email = '$Email'";

                mysqli_query($conn,$dquery);
                $passcode= rand(100000, 999999);// create random number of OTP with 6 digit

                //? Insert email and passcode to database - for verification 
                $Insert_otp = "INSERT INTO `otp` (`passcode`,`email`) VALUES ('$passcode','$Email')";
                                        
                $query = mysqli_query($conn,$Insert_otp);

                $_SESSION['v']=1;
                header("Location: php/Sent-OTP.php");
            }
        ?>
        <button tabindex ="2" type="submit" class="submit" name="submit">Sign In</button>
    </form>
                        
   
        
</body>
</html>