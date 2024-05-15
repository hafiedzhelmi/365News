<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "news";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_errno()) {
  echo "Error in DB Connection";
}

 ?>