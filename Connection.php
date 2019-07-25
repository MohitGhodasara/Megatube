<?php
$host = "localhost";
$database = "megatube";
$user = "root";
$password = "";

$conn = mysqli_connect($host, $user, $password, $database) or die(mysqli_error());
$db=mysqli_select_db($conn,$database) or die(mysqli_error());
?>