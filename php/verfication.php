<?php 
session_start();
require 'Connection.php';
?>

<html>
<head>
<title>Verfication</title>
        
</head>
<body>
    <section class="secLogin">
    <div class="cont">
        <div class="form sign-in">
            <form action="verfication.php" method="post">
                <div class="FF">
                    <i class="fa-solid fa-solid fa-lock fa-3x" style="color: #000000;"></i>
                </div>
                <h2>Verfication code </h2>
                <h3 id="countdown"></h3>
                <label>
                    <span class = "codetext">Enter Code</span>
                    <input maxlength="6" tabindex="2" type="number" name="Code" min="100000" max="999999" required >
                </label>
                <?php
                    
                    if(isset($_POST['submit'])){ 
                        
                        $Emailing = $_SESSION['Email']; // get the cline email
                        $Enter_Code = $_POST['Code'];
                        
                        $check = "SELECT * FROM `otp` WHERE email = '$Emailing'";
                      
                        $query = mysqli_query($conn,$check);
                        $code = mysqli_fetch_row($query);

                        $dquery = "DELETE FROM `otp` WHERE email = '$Emailing'";
                        if($Enter_Code == $code[1]){
                            $_SESSION['Email'] = $Emailing;
                            
                            if(mysqli_num_rows(
                                mysqli_query($conn,"SELECT * FROM `student` 
                                                    WHERE email = '$Emailing'"))>0){ // if there is same email in database  (an old user)
                                
                                mysqli_query($conn,$dquery);
                                $_SESSION['id']=$_SESSION['Email'];
                                header("Location: ../index.php");
                                
                            }else{
                                mysqli_query($conn,$dquery);

                                // send user to info.php
                                header("Location: info.php");
                            }

                        }
                        else{

                            ?>
                                <span class="OTPAlert">
                                    Invalid Verification code
                                    
                                    <i class="fa-solid fa-circle-exclamation fa-fade" style="color: #ff0f0f; --fa-animation-duration: 2.0s; margin-left: 5px;"></i>
                                </span>
                            <?php
                            
                            //header(("Location: verfication.php"));
                        }

                    }

                ?>
                <button tabindex="3" type="submit" class="submit" name="submit">Sign In</button>
            </form>
        </div>
        
    </section>
    <script src="../JS/Timer.js"></script>
</body>
</html>
