<?php
 session_start();
	require("Connection.php");
if(isset($_SERVER['HTTP_REFERER'])) {

	if (strpos($_SERVER['HTTP_REFERER'], '.php') !== false) {
		$file_name = $_SERVER['HTTP_REFERER'];
	}
	else
	{
		$file_name ='index.php';
	}
}
else{
	$file_name ='index.php';
}


	$tmp = explode('/', $file_name);
	$file_login_name = end($tmp);
	if(isset($_GET['check']))
	{
	 $userid=$_REQUEST['userid'];
	 $password=$_REQUEST['password'];
	 $query="select * from userinfo where userid='$userid' AND password='$password'";
	 $result= mysqli_query($conn,$query) or die();
		if(mysqli_affected_rows($conn)==1)
		 {
			 $row=mysqli_fetch_array($result);
		 }
		 else
		 {
			
			 echo "no";
		 }
		 if($row['active']==0)
		 {
			 echo "noactive";
		 }
	}
	if(isset($_POST['login']))
	{
		
			$userid=$_POST['userid'];
			$password=$_POST['password'];
			$query="select * from userinfo where userid='$userid' AND password='$password'";
			$result= mysqli_query($conn,$query) or die();
            $row=mysqli_fetch_array($result);
		    $_SESSION['userid']=$row[3];
			header('Location: '.$file_login_name);
	}
	elseif(isset($_POST['logout']))
	{

		$bar = $_SESSION['bar'];
		session_destroy();
		 session_start();
		$_SESSION['bar'] = $bar;

		header('Location: '.$file_login_name);
		//header('Location: index.php');
	}
	
?>