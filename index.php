<!-- home page -->

<?php 
//this for cannot go through index.php until you need to login first
session_start();
if(empty($_SESSION['id'])){ 
  header("Location: login.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
</head>
<body>
    <h1>Hi you are in home page</h1>
    <p>Your Email is:<?php echo "{$_SESSION['Email']}";?> </p>
    <p>Your First name:<?php echo "{$_SESSION['Fname']}";?></p>
    <p>Your Last name:<?php echo "{$_SESSION['Lname']}";?></p>
    
    <p><a class="logout-a" href="php/logout.php">logout</a></p>
</body>
</html>