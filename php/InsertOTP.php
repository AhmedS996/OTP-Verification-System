<?php 
session_start();
require 'Connection.php';

    $Email = $_SESSION['Email'];

    $dquery = "DELETE FROM `otp` WHERE email = '$Email'";

    mysqli_query($conn,$dquery);
    $passcode= rand(100000, 999999);// create random number of OTP with 6 digit

    //? Insert email and passcode to database - for verification 
    $Insert_otp = "INSERT INTO `otp` (`passcode`,`email`) VALUES ('$passcode','$Email')";
                                        
    $query = mysqli_query($conn,$Insert_otp);

    $_SESSION['v']=1;
    header("Location: Sent-OTP.php");
?>