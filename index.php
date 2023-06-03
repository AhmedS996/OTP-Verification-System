<?php 
// Start a new session or resume an existing session
session_start();

// If the user is not logged in, redirect to the login page
if (empty($_SESSION['id'])) { 
  header("Location: login.php");
  exit(); // exit the script after redirecting to prevent further execution
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link rel="stylesheet" href="style/home.css">
</head>
<body>
  <h1>Welcome to the Home Page</h1>
  <p>Your Email is: <?php echo "{$_SESSION['Email']}";?></p>
  <p>Your First name is: <?php echo "{$_SESSION['Fname']}";?></p>
  <p>Your Last name is: <?php echo "{$_SESSION['Lname']}";?></p>

  <p><a class="logout-a" href="php/logout.php">Logout</a></p>
</body>
</html>