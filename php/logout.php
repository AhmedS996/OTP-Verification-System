<?php 

session_start();

unset($_SESSION['id']);
unset($_SESSION['v']);
header("Location: ../login.php");
?>