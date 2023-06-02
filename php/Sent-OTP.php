<?php 
session_start();
include 'Connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

        $email = $_SESSION['Email']; // takes the clinet email to send the OTP code

        //get the `user` column from database 
        $search = "SELECT * FROM `otp` WHERE Email = '$email'";
        $find = mysqli_query($conn,$search);
        $The_code_row = mysqli_fetch_row($find);

        //Get the `Code` column 
        $The_Code = $The_code_row[1];

 $mail = new PHPMailer(true);

 $mail->isSMTP();
 $mail->Host = 'smtp.gmail.com';
 $mail->SMTPAuth = true;
 $mail->Username = 'cms.uhb@gmail.com'; //website email 
 $mail->Password = 'oxyzvegixyvopdlh'; //app password 
 $mail->SMTPSecure = 'ssl';
 $mail->Port = 465;

 $mail->setFrom('cms.uhb@gmail.com');

 $mail->addAddress($email);

 $mail->isHTML(true);

 $mail->Subject = "The OTP CODE"; //subject of the email 
 $mail->Body = "your code is {$The_Code}"; //the body of the email

 $mail->send();

 

 header("Location: verfication.php")
?>