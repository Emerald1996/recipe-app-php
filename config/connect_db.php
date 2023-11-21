<?php 
$servername = "localhost";
$username = "emerald";
$password = "";
$dbname = "recipe_app";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>