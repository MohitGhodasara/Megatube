<?php
require("Connection.php");
$fileTmp = $_FILES['photo']['tmp_name'];
$blob = addslashes( file_get_contents($fileTmp));
session_start();
$userid = $_SESSION['userid'];
$query = "update userinfo set photo='$blob' WHERE userid='$userid'";
mysqli_query($conn,$query);
?>

