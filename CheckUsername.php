<?php
error_reporting(0);

	$id=$_GET['id'];
	require("Connection.php");
	if($id=='username')
	{
		$userid=$_GET['str'];
		if(strlen($userid)>=6)
		{
			$query="select * from userinfo where userid='$userid'";
			$reult = mysqli_query($conn,$query);
			if(mysqli_affected_rows($conn))
			{
				echo "<div style='color:blue'>already exists</div> || no";	
			}
			else
			{
				echo "<div style='color:green'>available</div> || yes";
			}
		}
		else
		{
			echo "<div style='color:red'>not valid</div> || no";	
		}
	}
	elseif($id=='eid')
	{
		$eid=$_GET['str'];
		if (!filter_var($eid, FILTER_VALIDATE_EMAIL)) 
		{
			echo "<div style='color:red'>not valid</div> || no";	
		}
		else
		{
			$query="select * from userinfo where emailid='$eid'";
			$reult = mysqli_query($conn,$query);
			if(mysqli_affected_rows($conn))
			{
				echo "<div style='color:blue'>already exists</div> || no";	
			}
			else
			{
				echo "<div style='color:green'>valid and available</div> || yes";
			}
		}
	}
	elseif($id=='country')
	{
		 $countryid=$_GET['str'];
	$query="Select * from state where countryid=$countryid";
		$reult = mysqli_query($conn,$query);
 	 echo '<select  class="inputclass" id="state" name="state" required onchange="showData(this.value,this.id);">';
	 echo '<option value="" disabled selected style="display:none;">Select State</option>';
		while($row = mysqli_fetch_array($reult))
		{
			echo "<option value='$row[0]' >$row[2]</option>";		

		}	 
	  echo "</select>"; 
	}
	elseif($id=='state')
	{
		$StateCountryID=$_GET['str'];
		$PART = explode(" PARTFROMHERE ", $StateCountryID);
		$stateid=$PART[0];
		$countryid=$PART[1];
	$query="Select * from city where countryid=$countryid AND stateid=$stateid";
	$reult = mysqli_query($conn,$query);
 	 echo '<select class="inputclass" id="city" name="city" required onchange="showData(this.value,this.id);">';
	 echo '<option value="" disabled selected style="display:none;">Select City</option>';
		while($row = mysqli_fetch_array($reult))
		{
			echo "<option value='$row[0]' >$row[1]</option>";		

		}	 
	  echo "</select>";  
	}

?>
