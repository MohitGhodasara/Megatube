<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $database = "android";
    $user = "root";
    $password = "";

    $conn = mysqli_connect($host, $user, $password, $database) or die(mysqli_error());
    $db = mysqli_select_db($conn, $database) or die(mysqli_error());
    $enrollment = $_POST['delete'];

    $Query = "delete from Student WHERE enrollment='$enrollment'";
    if (!$data = mysqli_query($conn, $Query)) {
        echo "not";
    }
    if(!mysqli_affected_rows($conn))  {
        echo "no recod found";
    }else{
        $recod = mysqli_affected_rows($conn);
        echo "$recod : recod deleted";
    }
    // echo "<script>window.open('index.php','_self',false);</script>";
}
?>