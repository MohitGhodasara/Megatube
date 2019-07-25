<?php
require("Connection.php");
$vidid = $_GET['vidid'];
if(isset($_GET['status']))
{
	session_start();
	$cmnt = $_GET['cmnt'];
	$userid = $_SESSION['userid'];
	$date=date("Y/m/d");

	$queryfor_cmntupload="INSERT INTO `review` VALUES ('','$vidid', '$userid', 2, 2, '$cmnt','$date');";
	mysqli_query($conn,$queryfor_cmntupload) or die(mysql_error());
	
	$queryfor_findcmnt="Select * from `review` where `vidid`='$vidid' AND `like`=2 AND `dislike`=2 ORDER BY id DESC;";
		$result=mysqli_query($conn,$queryfor_findcmnt) or die(mysql_error());
		$row = mysqli_fetch_array($result);
		
	echo "completecmnt || $row[0]";
}	
else
{
	$queryfor_findcmnt="Select * from `review` where `vidid`='$vidid' AND `like`=2 AND `dislike`=2 ORDER BY id DESC;";
		$result=mysqli_query($conn,$queryfor_findcmnt) or die(mysql_error());
		

		//echo "<div style='padding-top:10px;' ></div>";
		while($row = mysqli_fetch_array($result))
		{
			/* userinfo table data */

			$userinfoquery="SELECT * FROM userinfo where userid='$row[2]';";
			$userinfotmp = mysqli_query($conn,$userinfoquery);
			$userinfo = mysqli_fetch_array($userinfotmp);
			$img = "data:image/jpeg;base64,".base64_encode($userinfo[13]);
			if($userinfo[13] == "")
			{
				$img = "defaultimg.jpg";
			}

			$date = date('M d, Y', strtotime($row[6]));
			echo <<<EOL
			<div id="usercmnt$row[0]" class="usercmnt" style="margin-top:5px;">
			<img src="$img"  height="50px" width="50px"  style="float:left;border-radius: 50%;margin-left:-20px" />
			<div class="cmntbox">
			<a href="#" class="link" style="color:#06C;"><h4 style="margin:0;display:inline" >$row[2]</h4></a>
			<h6 style="margin:0px;display:inline;">$date</h6>
			<pre style="white-space: pre-wrap;margin-top:0">$row[5]</pre>
			</div>
			</div>

			
EOL;

		}
}

?>