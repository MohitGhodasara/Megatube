<?php
require("Connection.php");
if(isset($_POST['name']))
{
    $name = $_POST['name'];
    $vidid = $_POST['vidid'];
    $quary = "update upload set name='$name' WHERE vidid='$vidid'";
    mysqli_query($conn,$quary);
}
else{
    $vidid = $_POST['vidid'];
    $query="delete from upload where vidid='$vidid'";
    mysqli_query($conn,$query);
    $query="delete from review where vidid='$vidid'";
    mysqli_query($conn,$query);
    unlink('uploaded/'.$vidid.'.mp4');
    unlink('uploaded/'.$vidid.'.jpg');
}
?>