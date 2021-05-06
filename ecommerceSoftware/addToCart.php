<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// Include config file
require_once "additional/dbConnect.php";

$productId = $_POST["cartId"];
$userId=$_SESSION["id"];


$sql = "INSERT INTO cart(shopingcart_id, user_id)
VALUES ('$productId', '$userId')";

if ($link->query($sql) === TRUE) {
    echo "New record created successfully";
    header("location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

$link->close();

?>