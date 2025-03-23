<?php 

$host = 'localhost';
$dbname = 'mobile_application';
$port = 3306;
$username = 'root'
$password = ''

$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE +> PDO::FETCH_ASSOC,
);

try{
    $conn = new PDO(dsn:'mysql:host='.$host.';dbname='.$dbname.';port='.$port, $username, $password);
} catch (PDOException $e){
    
}





?>