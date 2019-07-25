<?php
require("find.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	require("Connection.php");
	$name=$_POST['first'];
	$sname=$_POST['last'];
	$userid=$_POST['username'];
	$dob=$_POST['birthday'];
	$password=$_POST['password'];
	$emailid=$_POST['eid'];
	$gender=$_POST['gender'];
	$mobile=$_POST['mobile'];
	$country=$_POST['country'];
	$state=$_POST['state'];
	$city=$_POST['city'];
	$createdate=date("y/m/d");
	$photo=$_FILES["photo"]["tmp_name"];
	$blobphoto='';
	if($photo!=''){
		$blobphoto = addslashes(file_get_contents($photo));

	}

	//session_start();
	
	//$time=time()
	$userinfoQuery="insert into userinfo values('','$name','$sname','$userid','$emailid','$password','$gender','$dob','$mobile','$country','$state','$city','$createdate','$blobphoto','1');";
	mysqli_query($conn,$userinfoQuery);
	$_SESSION['userid']=null;
	echo "<script>window.open('index.php','_self',false);</script>";
}

?>
<body id="body">
<div class="container">
	<h1 style="font-size: 32px;text-shadow: 0 0px 10px black;margin: 8px;" align="center"> Create your <p>M</p>egatube Account </h1>
<div class="left">

<div  align="center" >
<img id="imgid" src="defaultimg.jpg" height="200px" width="200px" class="imgClass" "
onclick="document.getElementById('selectfile').click();"/>
</div>
	<div id="imgdiv" ></div>
</div>



<div class="mid" >
<form method="post" action=""<?php echo $_SERVER["PHP_SELF"]; ?>"" enctype="multipart/form-data" onsubmit="return tosubmit();">

<table align="center" >
<tr>
	<td><input type="text" class="inputclass" id="first" name="first"   placeholder="First Name"  onblur="values(this)" required pattern="[a-zA-Z]*" ></td>
    <td style="padding-left: 10px;"><input type="text" class="inputclass" id="last" name="last" placeholder="Last Name" onblur="values(this)" required  pattern="[a-zA-Z]*"></td>
</tr>
<tr>
	<td><input type="text" class="inputclass" id="username" name="username"  placeholder="Username (6 or more)" onkeyup="showData(this.value,this.id)" onblur="values(this)" required ></td>
    <td><div id="checkusername" class="Validation"></div></td>
</tr>
<tr>
	<td><input type="text" class="inputclass" id="eid" name="eid" placeholder="you@domian.com" onkeyup="showData(this.value,this.id)" onblur="values(this)" required></td>
        <td><div id="checkeid" class="Validation"></div></td>
    
</tr>
<tr>
	<td><input type="password" placeholder="Create a password" class="inputclass" id="password" name="password" onblur="values(this)" required></td>
</tr>
<tr>
	<td><input type="password" id="confirm" placeholder="Confirm your password" class="inputclass" name="confirm" onkeyup="checkpass()" onblur="values(this)" required></td>
    <td><div id="checkpass" class="validation"></div></td>
</tr>
<tr>
	<td><input type="text" id="birthday" onblur="checkTodayDate()" name="birthday" class="inputclass" placeholder="YYYY-MM-DD" maxlength="10" onkeyup="checklenth(this)" onkeypress="return checkdate(this,event);" onblur="values(this)" required></td>
    <td><div id="checkdob"  class="Validation"></div></td>
</tr>
<tr>
	<td><input pattern=".{10,10}"  placeholder="Mobile number" class="inputclass" id="mobile" name="mobile"  maxlength="10" onblur="values(this)" required></td>
</tr>
<tr>
	<td><select id="gender" class="inputclass" name="gender" required>
  <option value="" disabled selected style='display:none;'>I am...</option>
  <option value="female" >
  Female</option>
  <option value="male" >
  Male</option>
  <option value="other" >
  Other</option>
  </select></td>
</tr>
<tr>
	<td colspan="3">
    <select class="inputclass"  style="display:inline-block;width: 150px" id="country" name="country" required onchange="showData(this.value,this.id);">
	<option value="" disabled selected style='display:none;'>Select Country</option>
    <?php 
	require("Connection.php");
	$query="Select * from country";
	$reault=mysqli_query($conn,$query);
	while($row = mysqli_fetch_array($reault))
	{
		echo "<option value='$row[0]' >$row[1]</option>";		
	}	
	?>
    </select>
    <span  id="checkcountry" style="display:inline-block;width: 150px"></span> <spanv id="checkstate" style="display:inline-block;width: 150px;"></spanv></td>
  </td>
</tr>
<tr>
	<td><input  type="submit" class="submitclass" id"submit" name="sub"></td>
</tr>
</table>

</div>
<div class="right">
	<!--<img src="" alt="" class="backimg" id="backimg">-->
	<div id="o1" class="o1"></div>
	<div id="o2" class="o2"></div>
	<div id="o3" class="o3"></div>
</div>
</div>
<input type="file" style="display:none" name="photo" id="selectfile" onchange="loadFile(event)"/>
</form>
</body>
<script type="text/javascript">
var username,eid,dob,pass;

  var loadFile = function(event) {
    var output = document.getElementById('imgid');
    output.src = URL.createObjectURL(event.target.files[0]);
//	  var backimg = document.getElementById('backimg');
//	  backimg.src= URL.createObjectURL(event.target.files[0]);
  };

function checkpass()
{
	pass = document.getElementById('password');
	con = document.getElementById('confirm');
	if(pass.value == con.value)
	{
		var date = document.getElementById('checkpass');
			date.style="color:green";
			date.innerHTML="password match";
			pass='yes';
	}
	else
	{
		var date = document.getElementById('checkpass');
			date.style="color:red";
			date.innerHTML="password not match";
			pass='no';
			document.getElementById('checkpass').style.animation="moveError 0.1s 5";
	}
}
function tosubmit()
{
	if(username=='no' || eid=='no' || dob=='no' || pass=='no')
	{
		return false;
	}
	else
	{
		return true;
	}
}
function checkTodayDate() {
	var EnteredDate = document.getElementById("birthday").value;
	/*mm-dd-yyyy*/
	var month = EnteredDate.substring(5, 7);
	var date = EnteredDate.substring(8, 10);
	var year = EnteredDate.substring(0, 4);
	var myDate = new Date(year,  month -1 ,date);
	var today = new Date();
	if (myDate > today) {
		alert("Entered date is greater than today's date ");
		document.getElementById("birthday").value='';
	}
}
function checklenth(val)
{
		date = /^[12][90][0-9][0-9]\-[01]?[0-9]\-[0-3]?[0-9]$/;
		if(val.value.match(date))
		{
			dob='yes';
			var date = document.getElementById('checkdob');
			date.style="color:green";
			date.innerHTML="valid";
		}else{
			dob='no';
			var date = document.getElementById('checkdob');
			date.style="color:red";
			date.innerHTML="not valid";
			document.getElementById('checkdob').style.animation="moveError 0.1s 5";
		}
}
function checkdate(val,e)
{

 var key = e.which || e.keyCode;
	if(key>=47 && key<=57 || key==8 || key==45 || key==9)
	{
		if(key!=8 && key!=45 && key!=47)
		{
			if(val.value.length==4 || val.value.length==7)
			{
				val.value=val.value+'-';
						}
		}
	}
	else
	{
		return false;
	}
}
function values(val)
{
	if(val.value=='')
	{
		val.style='border:0.5px inset red;';
	}
	else
	{
		val.style='';
	}
}
function showData(str,id)		
{
	if(id=='state')
	{
		var countryid = document.getElementById('country').value;
		str=str+" PARTFROMHERE "+countryid;
	}
if (str.length==0)
{ 
	document.getElementById("txtHint"+id).innerHTML="";
	return;
}

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
  
xmlhttp.onreadystatechange=function()
{
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
  {
	  var result=xmlhttp.responseText.split(" || ");
	  var error=result[0];
	  var valid=result[1];
	  
    document.getElementById("check"+id).innerHTML=error;

	  document.getElementById("check"+id).style.animation="moveError 0.1s 5";
	
		  if(id=='username')
		  {  
			username = valid;
		  }
		  if(id=='eid')
		  {
			eid = valid;
		  }
  }
}
xmlhttp.open("GET","CheckUsername.php?str="+str+"&id="+id,true);
xmlhttp.send();
}
</script>

<style>
.container
{
      width:100%;
	  height:100%;
	  z-index:2;
}
.left
{
      width:30%;
 	  height:1%;
      float:left;
}
.right
{
      width:30%;
 	  height:1%;
      float:left;

}
.mid
{
      width:40%;
	   	  height:1%;
	        float:left;
			
	
}
.backimg{
	content : "";
	display: block;
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	opacity : 0.5 !important;
	z-index: -1;

	transition: transform 20s cubic-bezier(1.000, -0.530, 0.405, 1.425);
	animation: zxc 20s cubic-bezier(1.000, -0.530, 0.405, 1.425) infinite;

}

.inputclass{
	padding: 5px;
	margin: 10px 0;
	width: 100%;
	display: block;
	font-size: 15px;
	border-radius: 5px;
	//border: none;
	border: 1px inset #fb9a16;;
	transition: 0.3s linear;
	box-shadow: 0 0 50px 5px black;
	z-index: 100;

}

p{
	color:red;
	font-size: 38px;
	display: inline-block;
	margin: 0;
	padding: 0;
}
.inputclass:focus {
	outline: none;
	box-shadow: 0 0 1px 1px red;
}
	.imgClass{
		margin-top:20px;
		border-radius:50%;
		box-shadow: 0 0 20px 5.5px black;
	}
	.imgClass:hover ~ #imgdiv{
	//	box-shadow: 0 0 20px 5.5px red;
		animation: asd 400ms linear infinite;
	}
	.imgClass:active{
		transform: scale(0.95);

	}

.O1{
	border-radius:50%;
	width: 80px;
	height: 80px;
	margin-top: 250px;
	margin-left: 50px;
	animation: boxs 5s cubic-bezier(1.000, -0.530, 0.405, 1.425)infinite;

}
.O2{
	border-radius:50%;
	width: 80px;
	height: 80px;
	margin-top: -100px;
	margin-left: 200px;
	animation: boxs 7s cubic-bezier(1.000, -0.530, 0.405, 1.425)infinite;

}
.O3{
	border-radius:50%;
	width: 80px;
	height: 80px;
	margin-top: 70px;
	margin-left: 130px;
	animation: boxs 9s cubic-bezier(1.000, -0.530, 0.405, 1.425) infinite;
}

@keyframes boxs {
	from, to
	{
		transform: scale(1) ;
		box-shadow: 0 0 50px 10px red;
	}
	50%
	{
		transform: scale(-0.5) ;
		box-shadow: 0 0 50px 10px black;
	}

}
/*

#imgdiv{
	width: 205px;
	height: 205px;
	box-sizing: border-box;
	margin-top: -200px;
	margin-left: 600px;
	border: solid 2px transparent;
	border-top-color: red;
	border-left-color: red;
	border-radius: 50%;
	z-index: 0;
	//animation: asd 2s  cubic-bezier(1.000, -0.530, 0.405, 1.425) infinite;



}
*/

@keyframes asd {
	0%   { transform: rotate(0deg); }
	100% { transform: rotate(360deg); }
}

	body{
//		background: linear-gradient(#CCC, #666666);
	}
	.submitclass{
		background: red;             /* loin button  */
		padding: 10px;
		font-size: 18px;
		display: block;
		width: 100%;
		border: none;
		color: #fff;
		border-radius: 5px;
		margin-left: -355px;
		margin-top: -200px;
		box-shadow: 0 0 20px 5.5px black;
	}
	.Validation{
		font-size: 20px;
		text-shadow: 0 0px 2px black;
		margin-left: 10px;
	}
@keyframes moveError {
	0%   { transform: translateX(0px); }
	100% { transform: translateX(10px); }
}
</style>