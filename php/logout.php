<?php 

session_start();

unset($_SESSION['id']);
unset($_SESSION['v']);
unset($_SESSION['info_access']);
header("Location: ../login.php");
?>