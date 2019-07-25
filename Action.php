<?php	
require("Connection.php");
if(isset($_GET['act']))
{
	$act = $_GET['act'];
	$userid = $_GET['userid'];
	$query="update userinfo set active=$act where userid='$userid'";
	mysqli_query($conn,$query);
}
else
{
	$vidid=$_GET['vidid'];
	$query="delete from upload where vidid='$vidid'";
	mysqli_query($conn,$query);
	$query="delete from review where vidid='$vidid'";
	mysqli_query($conn,$query);
	unlink('uploaded/'.$vidid.'.mp4');
	unlink('uploaded/'.$vidid.'.jpg');
	echo $vidid.'vid';
}

?>