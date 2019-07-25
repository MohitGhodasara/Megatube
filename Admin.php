<?php

require("Connection.php");
require("NavigationBar.php");
$query = "select * from userinfo;";
$users= mysqli_query($conn,$query);

$userid=$_SESSION['userid'];
$query = "select * from userinfo where userid='$userid';";
$AdminCheck=mysqli_query($conn,$query);
$AdminCheck=mysqli_fetch_array($AdminCheck);
if($AdminCheck['active']!='2')
{
	echo "<script>window.open('index.php','_self',false);</script>";
}
?>
<div class="containerForAdmin">
<div class="leftpartForAdmin">
	<div id="editDiv" class="editDiv">
		<label style="font-size: 18px;color:#C1A21B;">Video Name</label>
		<input type="text" id="vidNameProfile" required class="vidNameProfile">
		<button id="closeName" class="save"  onclick="closeName()"> Close </button>
		<button id="save" class="save" onclick="saveName()"> Save </button>
	</div>
	<div id="ConformDiv" class="ConformDiv">
		<label style="font-size: 18px;color:#C1A21B;">Are you sure you want to delete?</label>
		<div style="height: 20px;"></div>
		<button id="ok" class="save" onclick="deleteVid()"> OK </button>
		<button id="closeDiv" class="save"  onclick="closeConform()"> Close </button>
	</div>
</div>
<div class="midpartForAdmin">
<div id="catdiv">



    <button id="filtersbtn" class="btnstyle" onClick="hideshowcat()" > Menage Category</button>
<div id="cat" class="cat" style="display:none;" >

<table style="margin-top:12px;margin-left:12px;">
<tr>
     <td rowspan="2"><span id="catlist" /> </td>
     <td valign="top" ><button class="save" onclick="catupdate('add')"> Add </button></td>
     <td valign="top" ><input  type="text" id="newcat" class="inputclass" placeholder="Category Name" /></td>
	<td valign="top" ><button style="margin-left: 0px;" class="save" onclick="catupdate('rename')"> Rename </button></td>
	<td><p style="margin-left: -250px;color: red;" id="vidcant"></p></td>
 </tr>
 <tr>
     <td valign="bottom"><button  style="margin-top: -40px"  class="save" onclick="catupdate('delete')"> Delete </button></td>
   </tr>
</table>

</div>


</div>
<div id="userdiv">

<button id="filtersbtn" class="btnstyle" onClick="hideshowuserbox()" >Menage User</button>
<div id="userbox" class="userbox" style="display:none;padding-left:50px;" >
<table style="margin:12px;">
<tr>
	<td><select id="selectbox" class="inputclass" name="userlist" required onChange="UserSet(this.value)"  >
	<option value="" disabled selected style='display:none;'>Select User</option>
<?php

while($row = mysqli_fetch_array($users))
{

	echo "<option value='".$row['userid']."'>".$row['userid']."</option>";
	
}

?>

</select>&nbsp;
		<input type="text" placeholder="Username" id="text" class="inputclass" >&nbsp;
		<button id="send" class="save" onClick="UserSet(text.value)" >Get</button>
	</td>
</tr>
</table>
</div>
</div>
	<div style="padding-top:30px;width:100%;width:1%"></div>
<div>
<table align="center">
	<tr>
	<td></td><span id="userinfoSpan"  ></span></td>
	</tr>
</table>
</div>

</div>
<div class="rightpartForAdmin">
</div>

<script>
var userid;
	function UserSet(val) {
		userid=val;
		loadMyVid();
	}
function catupdate(val)
{
	 if (window.XMLHttpRequest)
	 {
			xmlhttp=new XMLHttpRequest();
	 }
	 else
	 {
	  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	 }
	 xmlhttp.onreadystatechange=function()
	 {
	 		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
				if(xmlhttp.responseText == 'vid')
				{
					document.getElementById("vidcant").innerHTML = 'There is some videos in this category.....';
					setTimeout(function(){
						document.getElementById("vidcant").innerHTML = '';
					},2000)
				}
					if(val=='update')
					{
						document.getElementById("catlist").innerHTML = xmlhttp.responseText;
					}
					else
					{
						catupdate('update');
					}

		    }
	 }
	if(val=='update')
	{
		xmlhttp.open("GET","CatUpdate.php?catupdate='update'",true);
	}
	else if(val=='delete')
	{
		var key= document.getElementById("category").value;
		if(key=='')
		{
			return;	
		}
		document.getElementById("category").value="";
		xmlhttp.open("GET","CatUpdate.php?catkey="+key,true);		
	}
	else if(val=='add')
	{
		var add= document.getElementById("newcat").value;
		if(add=='')
		{
			return;	
		}
		document.getElementById("newcat").value="";
		xmlhttp.open("GET","CatUpdate.php?catadd="+add,true);
	}
	else if(val=='rename')
	{

		var key= document.getElementById("category").value;
		var add= document.getElementById("newcat").value;
		if(key=='')
		{
			return;
		}
		document.getElementById("category").value="";
		xmlhttp.open("GET","CatUpdate.php?catrename="+key+"&newname="+add,true);
	}

	xmlhttp.send();	
}
function AcDe(userid,act)
{
//	alert(userid+act);
var xmlhttp;
	 if (window.XMLHttpRequest)
	 {
			xmlhttp=new XMLHttpRequest();
	 }
	 else
	 {
	  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	 }
	 xmlhttp.onreadystatechange=function()
	 {
	 		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
//				document.getElementById("userinfoSpan").innerHTML=xmlhttp.responseText;	
				loadMyVid(document.getElementById("selectbox").value);

		    }
	 }
	
			xmlhttp.open("GET","Action.php?userid="+userid+"&act="+act,true);

	xmlhttp.send();	
}


function loadMyVid(val)
{
	val=userid;
var xmlhttp;
	 if (window.XMLHttpRequest)
	 {
			xmlhttp=new XMLHttpRequest();
	 }
	 else
	 {
	  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	 }
	 xmlhttp.onreadystatechange=function()
	 {
	 		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
				 document.getElementById("userinfoSpan").innerHTML=xmlhttp.responseText;	
		    }
	 }
	
			xmlhttp.open("GET","GetUser.php?userid="+val,true);

	xmlhttp.send();	
}

function hideshowcat()
{
catupdate('update');

		if(document.getElementById("cat").className=='cat')
		{
     			document.getElementById("cat").className="catshow";
				document.getElementById("cat").style="";
		}
		else
		{
				document.getElementById("cat").className="cat";
				/* setTimeout(function (){
					document.getElementById("filters").style="display:none";
					},500); */

		}
}
function hideshowuserbox()
{

		if(document.getElementById("userbox").className=='userbox')
		{
     			document.getElementById("userbox").className="userboxshow";
				document.getElementById("userbox").style="";
		}
		else
		{
				document.getElementById("userbox").className="userbox";
				/* setTimeout(function (){
					document.getElementById("filters").style="display:none";
					},500); */

		}
}
</script>
<style>
.containerForAdmin{
      width:100%;
	  height:1%;
	//  position:fixed;
	  z-index:2;
}
.leftpartForAdmin
{
      width:25%;
 	  height:1%;
      float:left;
}
.rightpartForAdmin
{
      width:25%;
 	  height:1%;
      float:left;
}
.midpartForAdmin
{
      width:50%;
	   	  height:1%;
	        float:left;
			
	
}
.btnstyle{
  /* background: #1abc9c;             loin button  */
	background:#2b303b;             /*  #1abc9c loin button  color: #fff;*/
	color: #C1A21B;
  padding: 10px;
  font-size: 20px;
  display: block;
  width: 100%;
  border: none;

  border-radius: 5px;
  margin-top:20px;
}
.cat
{

	animation: hidecat 1s;
	overflow:hidden;
	width:100%;
	height:0.1px;
	background-color: #ecf0f1;
	border-radius: 8px;

}
.catshow
{ 
	animation: showcat 1s;
	width:100%;
	height:265px;
	background-color: #ecf0f1;
	border-radius: 8px;
	overflow:hidden;
	
}
@keyframes hidecat {
    from 
	{

		width:100%;
	height:268px;
    background-color:#ecf0f1;


    }
    to {	
		width:100%;
		height:0.1px;
		background-color:#666;

    }
}

@keyframes showcat {
    from 
	{
		width:100%;
		height:0px;
		background-color:#666;

    }
    to {	
	width:100%;
	height:265px;
	background-color:#ecf0f1;
	
    }
}



.userbox
{

	animation: hideuserbox 1s;
	overflow:hidden;
	width:100%;
	height:0.1px;
	background-color: #ecf0f1;
	border-radius: 8px;

}
.userboxshow
{ 
	animation: showuserbox 1s;
	width:100%;
	height:200px;
	background-color: #ecf0f1;
	border-radius: 8px;
	overflow:hidden;
	height:85px;
	
}
@keyframes hideuserbox {
    from 
	{

		width:100%;
	height:85px;
    background-color:#ecf0f1;


    }
    to {	
		width:100%;
		height:0.1px;
		background-color:#666;

    }
}

@keyframes showuserbox {
    from 
	{
		width:100%;
		height:0px;
		background-color:#666;

    }
    to {	
	width:100%;
	height:85px;
	background-color:#ecf0f1;
	
    }
}
.inputclass{
	padding: 5px;
	margin: 10px 0;
	width: 200px;
	display: inline-block;
	font-size: 15px;
	border-radius: 5px;
//border: none;
	border: 1px inset #fb9a16;
	transition: 0.3s linear;
	z-index: 100;

}
.inputclass:focus {
	outline: none;
	box-shadow: 0 0 1px 1px red;
}
</style>