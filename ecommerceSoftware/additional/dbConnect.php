<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$host='localhost';
$user='root';
$password='';
$database='ecommerce_software';
define('DB_SERVER', $host);
define('DB_USERNAME', $user);
define('DB_PASSWORD', $password);
define('DB_NAME', $database);

 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>