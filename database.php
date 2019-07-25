<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$host = "localhost";
$database = "android";
$user = "root";
$password = "";

$conn = mysqli_connect($host, $user, $password, $database) or die(mysqli_error());
$db=mysqli_select_db($conn,$database) or die(mysqli_error());

    $id=$_POST['id'];
    $enrollment=$_POST['enrollment'];
    $password=$_POST['password'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $stream=$_POST['stream'];

    echo $Query="insert into Student VALUES('$id','$enrollment','$password','$name','$email','$mobile','$stream')";
    if(!mysqli_query($conn,$Query))  {
        echo "record alrady exist";
    }
}
?>