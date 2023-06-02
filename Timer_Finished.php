<!-- 
    
when timer finish delete the row of the user to restart again 

-->
<?php 
session_start();
require 'php/Connection.php';

$Emailing = $_SESSION['Email'];
$dquery = "DELETE FROM `otp` WHERE email = '$Emailing'";

mysqli_query($conn,$dquery);

header("Location: login.php");
?>