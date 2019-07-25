<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $database = "android";
    $user = "root";
    $password = "";

    $conn = mysqli_connect($host, $user, $password, $database) or die(mysqli_error());
    $db = mysqli_select_db($conn, $database) or die(mysqli_error());
    $enrollment = $_POST['search'];

    $Query = "select * from Student WHERE enrollment='$enrollment'";
    if (!$data = mysqli_query($conn, $Query)) {
        echo "not";
    }
    if(!mysqli_affected_rows($conn))  {
        echo "no recod found";
    }
    while ($row = mysqli_fetch_array($data))
    {
        echo "| $row[0] |"."| $row[1] |"."| $row[2] |"."| $row[3] |"."| $row[4] |"."| $row[5] |";
    }

    // echo "<script>window.open('index.php','_self',false);</script>";
}
?>