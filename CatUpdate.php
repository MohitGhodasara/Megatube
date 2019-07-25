<?php

include("Connection.php");
	
	if(isset($_GET['catupdate']))
	{
		?><select name="category" class="inputclass" required size="10" id="category" >
			 <option value="" disabled selected style='display:none;'>Select Category</option>
			 <?php 
			 
			 $query = "select * from category;";
			 $category=mysqli_query($conn,$query);
			 while($row = mysqli_fetch_array($category))
			 {
					 echo "<option value='$row[0]'>$row[1]</option>";
			 }
			 
			 ?>
			</select><?php
	}
	elseif(isset($_GET['catkey']))
	{
		 $id = $_GET['catkey'];
		$query= "select * from upload WHERE category=$id";
		mysqli_query($conn,$query);
		if(mysqli_affected_rows($conn) > 0)
		{
			echo "vid";
		}
		else{
			$query = "delete from category where id=$id;";
			mysqli_query($conn,$query);
		}


	}
	elseif(isset($_GET['catadd']))
	{		
		$cat = $_GET['catadd'];
		 $query = "insert into category values('','$cat');";	
		 mysqli_query($conn,$query);	
	}
	elseif(isset($_GET['catrename']))
	{
		$cat = $_GET['catrename'];
		$new = $_GET['newname'];
		$query = "update category set category='$new' WHERE id='$cat'";
		mysqli_query($conn,$query);
	}



?>