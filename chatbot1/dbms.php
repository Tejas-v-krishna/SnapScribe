<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "localhost"; 
$username = "root";  
$password = "";      
$database = "chatbot"; 

$conn = new mysqli($host, $username, $password, $database);
$conn->set_charset("utf8mb4"); 

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}
?>
