<?php 
// Create a new database connection using mysqli_connect function
// The parameters are (hostname, username, password, database_name)
$conn = mysqli_connect('127.0.0.1:3307', 'root', '', 'cms');

// Check if the connection was successful
if (!$conn) {
    // If the connection failed, display an error message
    die("Connection failed: " . mysqli_connect_error());
}
// If the connection was successful, you can use the $conn variable to access the database
?>