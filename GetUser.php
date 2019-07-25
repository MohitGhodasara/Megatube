<?php
	
require("Connection.php");
	$userid=$_GET['userid'];
	
$query="select * from upload where userid='$userid'";
$uservid=mysqli_query($conn,$query);
$query="select active from userinfo where userid='$userid'";
$active=mysqli_query($conn,$query);
$active=mysqli_fetch_array($active);

if(!isset($active))
{
		echo "<h3> no user found..... </h3>";	
		return;
}


if($active[0]==1)
{
	?><h3 style="color:red;"><a onclick="AcDe('<?php echo $userid; ?>','<?php echo "0"; ?>')" >Deactivate</a></h3><br /><?php
}
elseif($active[0]==0)
{
	?><h3><a style="color:blue;" onclick="AcDe('<?php echo $userid;?>','<?php echo "1"; ?>')" >Activate</a></h3><br /><?php
}

while($row = mysqli_fetch_array($uservid))
{


	echo <<<EOL
		<div class="boxRelated"   id="div$row[1]" >
<table>
<tr>
	<td rowspan="5" valign="center"  align="left"><img id='searchImgRelated' src="uploaded/$row[1].jpg" height="103px" width="120px" ></td>
</tr>
<tr>
   	<td><a id="videolink$row[1]"  class="wrapRelated" href="Playing video.php?watch=$row[1]">$row[2]</a></td>
</tr>
<tr>
    <td ><p>by : $row[5]</p></td>
</tr>
<tr>
    <td><p>viwes $row[7]</p><br></td>
</tr>

 </table>
<button onclick="editVid(this.id);" id="edit$row[1]" class="editVidBtn"></button>
<button onclick="Conform(this.id);" id="del$row[1]" class="delVidBtn"></button>
</div>

EOL;

	
}
//	echo "<h3 style='display:inline;padding:0' id='$row[1]vid'>$row[2]</h3>&nbsp;&nbsp;<a onclick=\"deletevid('$row[1]')\" >delete</a><br>";
?>

