<?php

$host = 'localhost';   
$dbname = 'ecommerce';  
$username = 'root';        
$password = '';      


$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
