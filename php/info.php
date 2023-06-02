<?php 
session_start();
require 'Connection.php';
?>
<html>
    <head>
        <title>INFORMATON PAGE</title>
        
    </head>
    <body>
        <section class= "secLogin">
            <div class="cont">
                <div class="form sign-in">
                    <form action="info.php" method="post">
                        <h2>First time here?</h2>
                        <label>
                            <span>Please povide us your name</span>
                            <input tabindex = "1"type="text" name="Fname" placeholder="First Name" maxlength="22" required>
                            <input tabindex = "2"type="text" name="Lname" placeholder="Last Name" maxlength="22" required>

                        </label>
                        <?php
                            
                            if(isset($_POST['submit']) && $_POST['Fname'] && $_POST['Lname']){
                                $id = 0;
                                $Email = $_SESSION['Email'];
                                $_SESSION['Fname'] = $Fname = $_POST['Fname'];
                                $_SESSION['Lname'] = $Lname = $_POST['Lname'];
                                //insert new client data to database 
                                $sqling = "INSERT INTO `student` (`Email`, `FirstName`, `LastName`) 
                                VALUES ('$Email', '$Fname', '$Lname')";

                                $query = mysqli_query($conn,$sqling);
                                //send user to Sent_Email.php page
                                $_SESSION['id']=$_SESSION['Email'];
                                header("Location: ../index.php");
                            }
                        ?>
                        <button tabindex = "3"type="submit" class="submit" name="submit">Submit</button>
                    </form>
                </div>
                
            </div>
        </section>

    
        <!-- <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script> -->
    </body>
</html>
