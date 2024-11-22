<?php
$host = 'localhost';       
$port = '3307';          
$dbname = 'clinic_mgm';     
$username = 'root';        
$password = '';            

try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = new mysqli($host, $username, $password, $dbname, $port);

    
    $conn->set_charset("utf8mb4");


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {

    die("Connection failed: " . $e->getMessage());
}
?>
