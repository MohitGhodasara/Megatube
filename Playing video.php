<?php

require("Connection.php");
require("find.php");

if(!isset($_GET['watch']))  // go to home page
{
	echo "<script>window.open('index.php','_self',false);</script>";
}
else
{
	$vidid=$_GET['watch'];
}

if(isset($_SESSION['userid']))
{
	$userid=$_SESSION['userid'];

}
else
{
	$userid="notuser";
}
$viewers="UPDATE upload SET viewers = (viewers + 1) where vidid='$vidid'";
mysqli_query($conn,$viewers);
$query="select * from upload where vidid='$vidid'";
$result = mysqli_query($conn,$query) or die(mysqli_error());

if(mysqli_affected_rows($conn) < 1)
{
	echo "<script>window.open('index.php','_self',false);</script>";
}
$row = mysqli_fetch_array($result);
/* searching for like or dislike */

$select="select * from review where vidid='$vidid' AND userid='$userid' AND comment=''";
$reviewresult = mysqli_query($conn,$select);
$reviewrow = mysqli_fetch_array($reviewresult);

/* find likers and disliker */
$findliker="SELECT * FROM `review` WHERE `like`=1 AND vidid='$vidid' AND comment=''";
$reviewliker = mysqli_query($conn,$findliker);
$likecount = mysqli_affected_rows($conn);
/* find dislikers and disliker */
$finddisliker="SELECT * FROM `review` WHERE `dislike`=1 AND vidid='$vidid' AND comment=''";
$reviewdisliker = mysqli_query($conn,$finddisliker);
$dislikecount = mysqli_affected_rows($conn);

/* Finding Category */
$categoryfind="SELECT * FROM `category` WHERE id='$row[4]'"; //catagory
$categorytmp = mysqli_query($conn,$categoryfind);
$categoryname = mysqli_fetch_array($categorytmp);

/* userinfo table data */

$userinfoquery="SELECT * FROM userinfo where userid='$userid';";
$userinfotmp = mysqli_query($conn,$userinfoquery);
$userinfo = mysqli_fetch_array($userinfotmp);

/* count all comment */

$queryfor_findcmnt="Select * from `review` where `vidid`='$vidid' AND `like`=2 AND `dislike`=2 ORDER BY id DESC;";
mysqli_query($conn,$queryfor_findcmnt);
$allcmnt=mysqli_affected_rows($conn);



if(isset($_SESSION['userid']))
{
	$userid=$_SESSION['userid'];
	if($reviewrow['like']==1)
	{
		$likeimg = "LikeW.png";
	}
	else
	{
		$likeimg = "Like.png";
	}
	if($reviewrow['dislike']==1)
	{
		$dislikeimg = "dislikeW.png";
	}
	else
	{
		$dislikeimg = "dislike.png";
	}
}
else
{
	$likeimg = "Like.png";
	$dislikeimg = "dislike.png";
}

?>
<html lang="en">

<head>

<div class="container" >
 <div class="left">

	<!--meta charset="utf-8" / -->

    <title> <?php echo $row['name']; ?> </title>

 </head>
 <body id="body">

 <div id="videoplayer" class="videoplayer" style="border-radius: 5px;">
   <video style="border-radius: 5px;border:#FF0;" id="runvid" width="800" height="440" autoplay controls  poster="uploaded/<?php echo $vidid; ?>.jpg">
    <source src="uploaded/<?php echo $vidid; ?>.mp4" type="video/mp4" />
	   <source type="video/webm" src="uploaded/<?php echo $vidid; ?>.mp4" />
	   <source type="video/ogg" src="uploaded/<?php echo $vidid; ?>.mp4" />
	   <source src="uploaded/<?php echo $vidid; ?>.mp4"  type="video/quicktime">
	   <source type="video/m4v" src="uploaded/<?php echo $vidid; ?>.mp4" />
	   <source type="video/x-m4v" src="uploaded/<?php echo $vidid; ?>.mp4" />
	   Video element not suported by your browser.
   </video>
   </div>
   <div>

   <table style="padding-left:20px">
   <tr>
	   <td class="vidname" colspan="2"> <b class="VidNameBtag"><?php echo $row['name']; ?> </b></td>

   </tr>
   <tr>
	    <td style="padding-left:5px;font-size:20px;">by: <?php echo $row['userid']; ?></td>
                <td style="padding-left:480px;padding-top:7px">Viewers :<div style="font-size:20px;display: inline;"> <?php echo $row['viewers']; ?></div></td>
   </tr>
   <tr>
	    <td style="padding-left:5px;font-size:15px;">Uploaded on : <?php $date=$row['date']; echo date('M d, Y', strtotime($date)); ?></td>
   </tr>
	</table>
    <div style="padding-left:680px;display:inherit;">
<input style="margin-top:-35px;" id="like" type="image" src="
<?php echo $likeimg; ?>" height="30" width="30"
onMouseOver="like('w');"
onMouseOut="like('g')"
onClick="rating(this.id,'<?php echo $vidid; ?>','<?php echo $userid; ?>');">
<input style="margin-top:-30px;padding-left:20px"id="dislike" type="image" src="
<?php echo $dislikeimg; ?>" height="30" width="30"
onMouseOver="dislike('w')"
onMouseOut="dislike('g')"
onClick="rating(this.id,'<?php echo $vidid; ?>','<?php echo $userid; ?>');">
</div>
<table style="margin-top:-10px">
<tr>
<td style="padding-left:685px"><div id="likecount"><?php echo $likecount; ?></div></td><td><div" id="dislikecount" style="padding-left:45px"><?php echo $dislikecount; ?></div></td>
</tr>
</table>
</div>
<!--Desctiption-->
<div class="wrapdes" id="divid">
<Pre style="white-space: pre-wrap;"><?php
	echo $row['descriptions'];
	echo "<br><h4>Category :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' class='link'>".$categoryname[1]."</a></h4>";
?></Pre>
</div>
<div align="center" id="desdiv">
<a id="description" onClick="wrapdes(this.innerHTML);">Show more</a>
</div>

<!-- VVVVVVVVVVVVVVVV  Comment code  VVVVVVVVVVVV-->
<div class="maindivofcmnt" style="margin-top:55px;" >
		<div style="margin-left:30px;width:150;">
			<a href="" class="link"><h5>All Comments (<temp id="allcmntcount"><?php echo $allcmnt; ?></temp>) </h5></a>
		</div>
	<div class="cmntcircle" ></div>
		<div id="cmnt" class="cmnt">
					<textarea placeholder="Share your thoughts..." class="textarea" id="textarea"
						onFocus="cmntfocus('<?php if(isset($_SESSION['userid'])){ echo $_SESSION['userid'];  }else{ echo 'notuser';} ?>')"
						onBlur="outfocus();" ></textarea>
					<button id="postbtn" class="postbtn" >Post</button>
		</div>
</div>
<!-- ^^^^^^^^^^^^^^^^^^Comment code^^^^^^^^^^^^^^^^^^ -->

 <div style="height:100px" style=""></div>
<span id="cmntspanview"></span>

<div style="height:200px" style=""></div>


</div>
<div class="right" id="right">
<span id="relatedHint" ></span>
</div>

</div>

                                                </div>
 <span id="Sleep"></span>
 </body>
</html>
<?php


if($reviewrow['like']==1 && $reviewrow['dislike']==0)
{
	$val='like';
}
elseif($reviewrow['dislike']==1 && $reviewrow['like']==0)
{
	$val='dislike';
}
else
{
	if(isset($_SESSION['userid']))
	{
		$val="notset";
	}
	else
	{
		$val="notset";
	}

}
?>

<script>
var likeon=<?php if(isset($_SESSION['userid'])){if($reviewrow['like']==1){echo '0';}else{ echo '1';}}else{echo '1';} ?>;
var dislikeon=<?php if(isset($_SESSION['userid'])){if($reviewrow['dislike']==1){echo '0';}else{ echo '1';}}else{echo '1';}?>;
var val='<?php echo $val; ?>';
related('<?php echo $row['category']; ?>');
postcmnt('loadcmnt');

var vidbar=1;
function barvidbtnclick() {

	if(vidbar==1)
	{
		document.getElementById("videoplayer").style.transition="all 0.5s cubic-bezier(1.000, -0.530, 0.405, 1.425) 0.5s";
		document.getElementById("runvid").style.transition="all 0.5s cubic-bezier(1.000, -0.530, 0.405, 1.425) 0.5s";
		document.getElementById("right").style.transition="all 0.5s cubic-bezier(1.000, -0.530, 0.405, 1.425)";
		document.getElementById("right").style.transform="translateY(570px)";
		document.getElementById("runvid").style.height="560";
		document.getElementById("runvid").style.width="920";
		document.getElementById("videoplayer").style.width="1330";
		document.getElementById("runvid").style.transform="translateX(22.5%)";
		document.getElementById("barvidbtn").style.backgroundImage="url(Exitfullscreen.png)";

		vidbar=0;
	}
	else
	{
		document.getElementById("videoplayer").style.transition="all 0.5s cubic-bezier(1.000, -0.530, 0.405, 1.425)";
		document.getElementById("runvid").style.transition="all 0.5s cubic-bezier(1.000, -0.530, 0.405, 1.425)";
		document.getElementById("right").style.transition="all 0.5s cubic-bezier(1.000, -0.530, 0.405, 1.425) 0.5s";
		document.getElementById("right").style.transform="translateY(0px)";
		document.getElementById("runvid").style.height="440";
		document.getElementById("runvid").style.width="800";
		document.getElementById("videoplayer").style.width="800";
		document.getElementById("runvid").style.transform="translateX(0%)";
		document.getElementById("barvidbtn").style.backgroundImage="url(Fullscreen.png)";

		vidbar=1;
	}
}
function sleep(n)
{
	var request = new XMLHttpRequest();
	request.open('GET', '/sleep.php?n=' + n, false);
	request.send(null);
}

function postcmnt(textarea)
{
var xmlhttp;

     if (textarea==0)
	 {
		    return;
	 }
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
				var res = xmlhttp.responseText.split(" || ");
			//	alert(res[1]);
				if(res[0]=='completecmnt')
				{
					postcmnt('loadcmnt');
					document.getElementById('textarea').value="";

					if(navigator.userAgent.indexOf("Firefox") != -1 )
					{
						while(!document.getElementById('usercmnt'+res[1]))
						{
							sleep(5);
						}
						document.getElementById('usercmnt'+res[1]).style.animation="cmntboxlight 1s cubic-bezier(1.000, -0.530, 0.405, 1.425)";

					}
					else
					{
						setTimeout(function(){
							document.getElementById('usercmnt'+res[1]).style.visibility="visble";
							document.getElementById('usercmnt'+res[1]).style.animation="cmntboxlight 1s cubic-bezier(1.000, -0.530, 0.405, 1.425)";

						},1000)

					}

					document.getElementById('usercmnt'+res[1]).style.marginTop="5px";
					var val = parseInt(document.getElementById("allcmntcount").innerHTML);
					document.getElementById("allcmntcount").innerHTML=val+1;

				}
				else
				{
				    document.getElementById("cmntspanview").innerHTML=res[0];
				}
		    }
	 };
	 if(textarea=='loadcmnt')
	 {
			xmlhttp.open("GET","cmnt.php?vidid=<?php echo $vidid;  ?>",true);
	 }
	 else
	 {
			xmlhttp.open("GET","cmnt.php?cmnt="+textarea+"&vidid=<?php echo $vidid;  ?>&status=cmntupload",true);
	 }

	xmlhttp.send();
}
function wrapdes(val)
{
	 var desdiv = document.getElementById('desdiv').offsetHeight;
	if(val == 'Show more')
	{
		var show = document.getElementById('description');
		show.innerHTML="Show less";
		var divid = document.getElementById('divid');
		divid.style.height="auto";
	}
	else
	{
		var show = document.getElementById('description');
		show.innerHTML="Show more"
		;var divid = document.getElementById('divid');
		divid.style.height="60px";

	}

}
function onMouseOver(id,over)
{
	if(over=='over')
	{
		document.getElementById(id).style.paddingLeft="15px";
	}
	else
	{
		document.getElementById(id).style.paddingLeft="20px";
	}
}
function related(str)
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

    document.getElementById("relatedHint").innerHTML=xmlhttp.responseText;
 }
}
xmlhttp.open("GET","related.php?str="+str,true);
xmlhttp.send();
}
function like(flag)
{

		var like =document.getElementById('like');
		if(likeon==1)
		{
			if(flag=='w')
			{
				like.setAttribute('src','likew.png');
			}
			else
			{
				like.setAttribute('src','like.png');
			}
		}
}
function dislike(flag)
{

		var dislike =document.getElementById('dislike');
		if(dislikeon==1)
		{
			if(flag=='w')
			{
				dislike.setAttribute('src','dislikew.png');
			}
			else
			{
				dislike.setAttribute('src','dislike.png');
			}
		}
}


function rating(str,vidid,userid)
{
	if(userid=='notuser')
	{
		var btn = document.getElementById('loginclick');
		var box = document.getElementById('formholder');
		box.style.animation="formholder 1s step-end 2";
		btn.click();
		return;
	}
	if(str=='like')
	{
		var like =document.getElementById('like');
		var dislike =document.getElementById('dislike');
		var likecount =document.getElementById('likecount');
		var dislikecount =document.getElementById('dislikecount');
		dislike.setAttribute('src',"dislike.png");
		dislikeon=1;
		likeon=0;

		if(val=='dislike' || val=='notset')
		{
			var a = parseInt(likecount.innerHTML,10);
			likecount.innerHTML=a+1;
			if(val!='notset')
			{
				var b = parseInt(dislikecount.innerHTML,10);
				dislikecount.innerHTML=b-1;
			}
			val='like';

		}


	}
	else
	{

		var like =document.getElementById('like');
		var dislike =document.getElementById('dislike');
		var likecount =document.getElementById('likecount');
		var dislikecount =document.getElementById('dislikecount');
		like.setAttribute('src',"like.png");
		dislikeon=0;
		likeon=1;
		if(val=='like' || val=='notset')
		{
			if(val!='notset')
			{
			 	var a = parseInt(likecount.innerHTML,10);
				likecount.innerHTML=a-1;
			}
			var b = parseInt(dislikecount.innerHTML,10);
			dislikecount.innerHTML=b+1;
			val='dislike';
		}

	}

	if(window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","Rating.php?rating="+str+"&vidid="+vidid+"&userid="+userid,true);
	xmlhttp.send();
}
function cmntfocus(userid)
{

 	if(userid=='notuser')
	{
		var btn = document.getElementById('loginclick');
		var box = document.getElementById('formholder');
		box.style.animation="formholder 1s step-end 2;";
		btn.click();
		return;
	}
	else
	{
		//document.getElementById('textarea').className='bigtextarea';
		//document.getElementById('postbtn').className='postbtnshow';
		document.getElementById('textarea').style.height="80px";
		document.getElementById('textarea').style.borderColor="red";
		document.getElementById('postbtn').style.display="block";
		document.getElementById('postbtn').style.transform="translateX(435px)";
		document.getElementById('postbtn').style.opacity="1";

	}
}
function outfocus()
{
	document.onclick = function()
	{
		document.getElementById('textarea').style.height="50px";
		document.getElementById('textarea').style.borderColor="#666";
		//document.getElementById('postbtn').style.display="hidden";
		document.getElementById('postbtn').style.transform="translateX(0px)";
		document.getElementById('postbtn').style.opacity="0";
		//	 document.getElementById('textarea').className='textarea';
			 //document.getElementById('postbtn').className='postbtn';
			 var l = document.getElementById("login");
		l.style.display="none";
    };

	document.getElementById('postbtn').onclick = function(e) {

        if (e) { e.stopPropagation(); }
        else { window.event.cancelBubble = true; }

				/* Post btn press */

				var textarea=document.getElementById('textarea').value;
				postcmnt(textarea);


    };
	document.getElementById('textarea').onclick = function(e) {

        if (e) { e.stopPropagation(); }
        else { window.event.cancelBubble = true; }

    };



}

</script>


<style>
	.link
	{
		text-decoration: none;
		color:#000;

	}
	.layer1 {
		position:absolute;
		z-index: 2;
	}

	.layer2 {
		position:absolute;
		z-index: 1;
	}

	.container
	{
		width:100%;
		padding-left: 5px;

	}
	.left
	{
		width:60%;
		float:left;
	}
	.right
	{
		width:40%;
		float:right;

	}
	.vidname
	{
		padding-top:10px;
		font-size:26px;
		color:#232833;
	}
	.videoplayer
	{
		background-color:black;
		width:800px;
	}
	.boxplay{
		color:white;
		padding-left:2px;
		height:105px;
		width:500px;
		text-decoration: none;
	}
	.boxplay:hover
	{
		background-color:#333;
	}
	.wrapplay {
		padding-left:3px;
		display: block;
		width: 345px;
		overflow: hidden;
		white-space: nowrap;
		text-overflow:ellipsis;
		color:#000;
		text-decoration: none !important;
		font-size:16px;

	}

	.wrapdes{
		margin-top:10px;
		width: 780px;
		height:60px;
		overflow:hidden;
		word-wrap: break-word;
		text-overflow:ellipsis;
		margin-left:10px;
		-webkit-transition: height 6s cubic-bezier(1.000, -0.530, 0.405, 1.425);
		transition: height 6s cubic-bezier(1.000, -0.530, 0.405, 1.425);
		/* 	 box-shadow: 0 0 5px 1px #232833; */

	}

	.textarea
	{
		border:1px solid #666;/* #333333; */
		border-left: 10px solid #666;
		height:50px;
		width: 590px;
		-webkit-transition: -webkit-transform 0.5s linear,border 0.5s linear,border-left 0.5s linear,height 0.5s  cubic-bezier(1.000, -0.530, 0.405, 1.425);
		transition: transform 0.5s linear,border 0.5s linear,border-left 0.5s linear,height 0.5s  cubic-bezier(1.000, -0.530, 0.405, 1.425);
		/* 	border-radius: 8px; */

	}

	.postbtn
	{

		background: red; /* loin button  */
		padding: 5px;
		font-size: 15px;
		opacity: 0;
		filter: alpha(opacity=0);
		width: 50px;
		height: 35px;
		border: none;
		color: #bebebe; /*#fff*/
		border-radius: 3px;
		margin-top: 5px;
		margin-left: 100px;
		/*transform translateX(100px);*/
		-webkit-transition: -webkit-transform 0.6s cubic-bezier(1.000, -0.530, 0.405, 1.425),display 0.6s linear,opacity 0.6s linear;
		transition: transform 0.6s cubic-bezier(1.000, -0.530, 0.405, 1.425),display 0.6s linear,opacity 0.6s linear;
	}
	.cmnt
	{
		display:inline;
		float: left;
		padding-left:30px;
		width:400px;
		margin-left:-20px;

	}

.cmntcircle {
	border-radius: 50%;
	width: 100px;
	height: 100px;
	/* background: #06C; #1abc9c; */
	 float: left;
	 margin-top:-5px;
	 margin-left:35px;
	 background: url(<?php if($userinfo['photo']!=""){ echo "data:image/jpeg;base64,".base64_encode($userinfo['photo']);}else{echo "defaultimg.jpg";} ?>) no-repeat;
	background-size: 100% 100%;
	box-shadow: 0 0 0.5px 0.5px #666666;
}
.cmntbox
{
	display:inline;
	float:left;
	width: 530px;
	word-wrap: break-word;
	text-overflow:ellipsis;
	margin-left:10px;
}
.usercmnt
{
	background-color:#bebebe;
	float:left;
	margin-left:165px;
	z-index:0;
	position:relative;
	border-radius: 5px;
	-webkit-transition: -webkit-transform 0.2s linear,background 0.2s linear;
	transition: transform 0.2s linear,background 0.2s linear;
}
.usercmnt:hover{
	-webkit-transform: translateX(20px);
	-ms-transform: translateX(20px);
	transform: translateX(20px);
	background: #CC9;
}


@-webkit-keyframes cmntboxlight {
	50%,from {
		background-color:white;
		box-shadow:0 0 100px  #CC9;
		position: absolute;
		z-index:10;
		margin-top:-100px;



	}
	to {
		background-color:#BFBBB9;
		position: absolute;
		z-index:10;
		margin-top:10px;

	}
}


@keyframes cmntboxlight {
	50%,from {
		background-color:white;
		box-shadow:0 0 100px  #CC9;
		position: absolute;
		z-index:10;
		margin-top:-100px;



	}
	to {
		background-color:#BFBBB9;
		position: absolute;
		z-index:10;
		margin-top:10px;

	}
}

/*////////////////////////////Related//////////////////////////////////*/

.boxRelated:hover > table a
{
	color: #C1A21B;
}
.boxRelated:hover > table
{
	color: #C1A21B !important;
}
.boxRelated{
	color:white;
	width: 520px;
	height:110px;
	text-decoration: none;
	/*background-color: #2b303b;*/
	z-index: 1;
	-webkit-transition: all 0.5s ease-in-out;
	transition: all 0.5s ease-in-out;
	border-radius:15px;
	margin-bottom: 5px;
}
#searchImgRelated
{
	border-radius:15px;
	padding-right: 8px;
}
.boxRelated:hover
{
	background-color: rgba(179, 149, 27, 1);
	background-color: #2b303b;
	color: black;
	/*transform: translateX(5px);*/
	/* background: linear-gradient(to left,#3c4453,#C1A21B)no-repeat 100% 100%;*/
}
.wrapRelated {

	padding-top: 5px;
	display: inline-block;
	width: 380px;
	white-space:nowrap;
	text-overflow:ellipsis;
	color:black;
	text-decoration: none !important;
	overflow: hidden;
	word-break: break-all;
	font-size: 16px;
	/*color: #C1A21B;*/
}
p{
	font-size: 12px;
}

/*////////////////////////////Related//////////////////////////////////*/
.VidNameBtag{
	padding-top: 5px;
	display: inline-block;
	width: 760px;
	white-space:nowrap;
	text-overflow:ellipsis;
	overflow: hidden;
	word-break: break-all;
}
</style>