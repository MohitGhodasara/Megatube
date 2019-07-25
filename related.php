<?php
require("Connection.php");
$q=$_GET["str"];
$query="select * from upload where category =$q";
 $result= mysqli_query($conn,$query);
  echo "<div style='padding-left:3px;'>";
  while($row = mysqli_fetch_array($result))
    {
     //	echo '<br><a href="Playing video.php?watch='.$row[0].'">'.$row[1].'</a>';
        echo <<<EOL
		<div class="boxRelated" style="background: none;"  id="div$row[1]" onClick="clicklink('$row[1]');" >
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
</div>
EOL;
    }
?>