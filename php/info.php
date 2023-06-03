<?php 
session_start(); // Start a new session or resume an existing session
require 'Connection.php'; // Include the database connection code
if(empty($_SESSION['info_access'])){ // If the user hasn't received an OTP yet, redirect to the login page
    header("Location: ../login.php");
}
?>
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
                    <?php
                        if(isset($_POST['submit']) && $_POST['Fname'] && $_POST['Lname']){
                            $id = 0;
                            $Email = $_SESSION['Email'];
                            $_SESSION['Fname'] = $Fname = $_POST['Fname'];
                            $_SESSION['Lname'] = $Lname = $_POST['Lname'];
                            // Insert new client data into the database
                            $sqling = "INSERT INTO `student` (`Email`, `FirstName`, `LastName`) 
                                        VALUES ('$Email', '$Fname', '$Lname')";
                            $query = mysqli_query($conn,$sqling);
                            // Send the user to the "index.php" page
                            $_SESSION['id']=$_SESSION['Email'];
                            header("Location: ../index.php");
                        }
                    ?>
                    <button tabindex="3" type="submit" class="submit" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>