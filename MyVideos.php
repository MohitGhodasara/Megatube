<?php

require("Connection.php");
 session_start();
$userid = $_SESSION['userid'];
$query="select * from upload where userid='$userid' ORDER BY id DESC";
 $result= mysqli_query($conn,$query);
  echo "<div style='padding-left:3px;'>";
  while($row = mysqli_fetch_array($result))
  {
      //	echo '<br><a href="Playing video.php?watch='.$row[0].'">'.$row[1].'</a>';
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

?>