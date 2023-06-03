<?php 
session_start();

require 'Connection.php';

// If the user hasn't received an OTP yet, redirect to the login page
if (!isset($_SESSION['info_access'])) {
  header('Location: ../login.php');
  exit();
}

if (isset($_POST['submit'])) {
  // Get the user's email and name from the session and form input
  $email = $_SESSION['Email'];
  $fname = $_POST['Fname'];
  $lname = $_POST['Lname'];

  // Insert new client data into the database
  $insert_query = "INSERT INTO `student` (`Email`, `FirstName`, `LastName`) 
                   VALUES ('$email', '$fname', '$lname')";
  mysqli_query($conn, $insert_query);

  // Set session variables for the user's name and email
  $_SESSION['Fname'] = $fname;
  $_SESSION['Lname'] = $lname;
  $_SESSION['id'] = $email;

  // Redirect the user to the "index.php" page
  header('Location: ../index.php');
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Information page</title>
  <link rel="stylesheet" href="../style/info.css">
</head>
<body>
  <section class="secLogin">
    <div class="cont">
      <div class="form sign-in">
        <form action="info.php" method="post">
          <h2>First time here?</h2>
          <label>
            <span>Please provide us your name</span>
            <input tabindex="1" type="text" name="Fname" placeholder="First Name" maxlength="22" required>
            <input tabindex="2" type="text" name="Lname" placeholder="Last Name" maxlength="22" required>
          </label>
          <button tabindex="3" type="submit" class="submit" name="submit">Submit</button>
        </form>
      </div>
    </div>
  </section>
</body>
</html>