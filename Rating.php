<?php

$vidid=$_GET['vidid'];
$rating=$_GET['rating'];
$userid=$_GET['userid'];
require("Connection.php");
if($rating=='like')
{
	$like=1;
	$dislike=0;
}
else
{
	$like=0;
	$dislike=1;

}
$select="select * from review where vidid='$vidid' AND userid='$userid' AND comment=''";
$result = mysqli_query($conn,$select);
if(!mysqli_affected_rows($conn))
{
	$insert="INSERT INTO `review` (`vidid`, `userid`) VALUES ('$vidid', '$userid');";
	mysqli_query($conn,$insert) or die(mysql_error());	
}
$update="UPDATE `review` SET `like`='$like',`dislike`='$dislike' WHERE vidid='$vidid' and userid='$userid' and comment=''";
mysqli_query($conn,$update) or die(mysql_error());
?>