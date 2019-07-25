<?php
require("Connection.php");
 session_start();
if(!isset($_GET["q"]))
{
	//header('Location: find.php');
	$q="";
	die();
}
else
{
	$q=$_GET["q"];
}
if(!isset($_GET["filter"]))
{
	$filter="";
}
else
{
	$filter=$_GET["filter"];
}
if(!isset($_GET["short"]))
{
	$by="";
}
else
{
	$by=$_GET["short"];
}
if($_SESSION['cat']!=0)
{
	$Cat = $_SESSION['cat'];
}
else{
	$Cat='';
}
$date=date('Y-m-d');
$short="";
$searchby="";
switch($by)
{
	case 'upload';
			$short="ORDER BY date DESC";
			$searchby="Search by <B>Upload date</B>";
	break;
	
	case 'view';
			$short="ORDER BY viewers DESC";
			$searchby="Search by <B>View count</B>";
	break;
	case 'rating';
			$searchby="Search by <B>Rating</B>";
	break;
	case 'relevance';
			$searchby="Search by <B>Relevance</B>";
	break;
	default:
			$short="";
	break;
	
}
switch($filter)
{
	case 'today':
		$query="select * from upload where name LIKE '%$q%' AND category LIKE '%$Cat%' AND date='$date' $short;";
		$filterdate="in <B>Today</B>";
	break;
	
	case 'week':
		$week=date('Y-m-d', strtotime('-1 week', strtotime($date)));
		$query="select * from upload where name LIKE '%$q%' AND category LIKE '%$Cat%' AND date BETWEEN '$week' AND '$date' $short;";
		$filterdate="in This <B>Week</B>";
	break;
	
	case 'month':
		$month=date('Y-m-d', strtotime('-1 month', strtotime($date)));
		$query="select * from upload where name LIKE '%$q%'  AND category LIKE '%$Cat%' AND date BETWEEN '$month' AND '$date' $short;";
		$filterdate="in This <B>Month</B>";
	break;
	
	case 'year':
		$year=date('Y-m-d', strtotime('-1 year', strtotime($date)));
		$query="select * from upload where name LIKE '%$q%' AND category LIKE '%$Cat%' AND date BETWEEN '$year' AND '$date' $short;";
		$filterdate="in This <B>Year</B>";
	break;
	
	default:
	$query="select * from upload where name LIKE '%$q%' AND category LIKE '%$Cat%' $short;";
	$filterdate="";
	break;
}
 $result= mysqli_query($conn,$query);
 $temp= mysqli_query($conn,$query);
// print_r(mysqli_fetch_array($result));
  echo "<div style='padding-top:5px' >";
	$conunt=mysqli_affected_rows($conn);	
	 echo "<p>$conunt Result Found $filterdate</p><hr>";
	  echo "<p align='right'>Results for <B>$q</B> $searchby </p><hr>";

		 	if($by=='rating')
			{	
			$inc=0;
				  while($row = mysqli_fetch_array($temp))
				  {			
		                $array[$inc]=$row;
						$QueryForRating="SELECT * FROM `review` WHERE `like`=1 AND vidid='$row[1]' AND comment=''";
						$resultForRating= mysqli_query($conn,$QueryForRating);
						$rating=mysqli_affected_rows($conn);
						$array[$inc]['like']=$rating;
						$inc++;
				  }
				  /////////////////////////////////////////////////////////////////////
		
						function val_sort($array,$key) 
						{
	
							foreach($array as $k=>$v) 
							{
								$b[] = strtolower($v[$key]);
							}
							asort($b);
							foreach($b as $k=>$v) 
							{
								$c[] = $array[$k];
							}
							return $c;
						}
						$sorted = val_sort($array, 'like');
						$sortedrowtemp = array_reverse($sorted, true);
						$sortedrow  = array_values($sortedrowtemp);		
				  //////////////////////////////////////////////////////////////////////////
				  
			}
	
	$inc=0;
	
  while($row = mysqli_fetch_array($result))
    {
		if($by=='rating')
		{
			$row=$sortedrow[$inc];
		}
		echo <<<EOL
		<div class="box"   id="div$row[1]" onClick="clicklink('$row[1]');" >
<table style="color:#C1A21B">
<tr>
	<td rowspan="5" valign="center"  align="left"><img id='searchImg' src="uploaded/$row[1].jpg" height="122px" width="140px" ></td>
</tr>
<tr>
   	<td><a id="videolink$row[1]"  class="wrap" href="Playing video.php?watch=$row[1]">$row[2]</a></td>
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
$inc++;
    }
?>