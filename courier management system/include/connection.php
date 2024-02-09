<?php
$server = "localhost";
$username ="root";
$dbpassword = "";
$dbname = "courier_management_system_db";
$connection = mysqli_connect($server,$username,$dbpassword,$dbname);
if(!$connection){
    die("Failed to connect");
}
?>