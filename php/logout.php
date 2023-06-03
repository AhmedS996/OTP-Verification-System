<?php 
session_start();

// Unset the session variables you want to clear
unset($_SESSION['id'], $_SESSION['v'], $_SESSION['info_access']);

// Redirect the user to the login page
header('Location: ../login.php');
?>