<?php 

$dbsever ="localhost";
$dbuser = "root";
$dbpass = "Root$123";
$dbname = "demo";

$conn = new mysqli($dbsever,$dbuser,$dbpass,$dbname);

/*
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
 }
echo "Connection Done ";
*/
?>