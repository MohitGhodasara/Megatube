 <?php
require("Connection.php");  
echo "<div class='layer1' id='' style='margin-top: -20px;'>";
  $q=$_GET["q"];
  if($q!="")
  {
		$query="select * from upload where name LIKE '$q%';";
		$result= mysqli_query($conn,$query);
		while($row = mysqli_fetch_array($result))
	    {
			echo "<div class='boxbar' id='$row[0]' onClick=\"add('$row[2]');\">$row[2]</div>";
	    }
		if(!mysqli_affected_rows($conn)==0)
		{
			echo "<div class='boxbar' style='height:10px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;'> </div>";
		}
  }
?>
