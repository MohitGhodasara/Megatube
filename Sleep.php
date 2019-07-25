<?php

if(isset($_GET['cat'])){
     session_start();
    echo $_SESSION['cat'];
   $_SESSION['cat']= $_GET['cat'];
}
elseif(isset($_GET['bar']))
{
    session_start();
    $_SESSION['bar']= $_GET['bar'];
}
else{
    $n=$_GET['n'];
    sleep($n);
}
?>