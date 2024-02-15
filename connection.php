<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$databasename = "sweet_store"; 
  
// CREATE CONNECTION 
$conn = new mysqli($servername, 
$username, $password, $databasename); 

// GET CONNECTION ERRORS 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 

?>