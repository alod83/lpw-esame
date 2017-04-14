<?php

$database = "ProgettiStudenti";
$password="";
$username="root";
$servername="localhost";

$conn = mysqli_connect($servername, $username, $password, $database); 
if (!$conn) die("Connection failed: ".mysqli_connect_error());
?>