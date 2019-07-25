<?php
 session_start();
require("Connection.php");
require("RedLine.php");

if(!isset($_SESSION['bar']))
{
    $_SESSION['bar']=1;
}
if(isset($_SESSION['userid']))
{
	$query="select * from userinfo where userid='".$_SESSION['userid']."'";
	$result=mysqli_query($conn,$query);
	$row=mysqli_fetch_array($result);

}
?>
<script type="text/javascript">
    var bar = 1;
/* Log in javascript */
window.onload=<?php if(isset($_SESSION['userid'])){ echo "clickonlogout"; }else{ echo "clickonlogin"; } ?>

    function barClick(val)
    {
        var xmlhttp;
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        }
        else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.open("GET", "Sleep.php?bar="+val, true);
        xmlhttp.send();
    }
    function barbtnclick(val) {
        if(val=='refresh')
        {
            for(i=1;i<6;i++)
            {
                var vidbox = document.getElementById(i+'6');
                if(vidbox!=null)
                {
                    vidbox.style.display="inline-block";
                }
            }
        }
        else
        {

                if(bar==1)
                {

                    document.getElementById("HomeBar").style.transform="translateX(-82%)";
                    var vidbox = document.getElementById("VidHolder");
                    barClick(0);
                    if(vidbox!=null)
                    {
                        vidbox.style.marginLeft="5%";
                        setTimeout( function(){
                            for(i=1;i<6;i++)
                            {
                                var vidbox = document.getElementById(i+'6');
                                if(vidbox!=null)
                                {
                                    vidbox.style.display="inline-block";
                                }
                            }
                        },900);
                    }
                    for(i=1;i<=20;i++)
                    {
                        if(i<5) {
                            document.getElementById('img' + i).style.transform="translateX(160px)";
                            document.getElementById('img' + i).style.transition="all 0.5s cubic-bezier(1.000, -0.530, 0.405, 1.825) 0."+i+"s";
                        }
                        else {
                            document.getElementById('img' + i).style.transform = "translateX(158px)";
                            document.getElementById('img' + i).style.transition = "all 1s cubic-bezier(1.000, -0.530, 0.405, 1.425) " + (Math.random()+0.5) + "s";
                        }
                    }
                    bar = 0;
                }
                else
                {
                    document.getElementById("HomeBar").style.transform="translateX(0%)";
                    var vid = document.getElementById("VidHolder");
                    barClick(1);
                    if(vid!=null)
                    {
                        vid.style.marginLeft="18%";
                        for(i=1;i<6;i++)
                        {
                            var vidbox = document.getElementById(i+'6');
                            if(vidbox!=null)
                            {
                                vidbox.style.display="none";
                            }
                        }
                    }
                    for(i=1;i<=20;i++)
                    {
                            document.getElementById('img' + i).style.transform="translateX(0px)";
                    }
                    bar = 1;

                }
        }

    }

function clickonlogout()
{

		 document.onclick = function() {
						var l = document.getElementById("login");

             l.style.display="none";

    };

    document.getElementById('logoutclick').onclick = function(e)
    {

        if (e) { e.stopPropagation(); }
        else { window.event.cancelBubble = true; }

				var l = document.getElementById("login");
        l.style.display="inline";
    };

	 document.getElementById('logout').onclick = function(e) {

        if (e) { e.stopPropagation(); }
        else { window.event.cancelBubble = true; }

				var l = document.getElementById("login");
         l.style.display="inline";

    };
}

function clickonlogin()
{

    document.onclick = function() {
        var l = document.getElementById("login");
        l.style.display="none";
    };

    document.getElementById('loginclick').onclick = function(e) {

        if (e) { e.stopPropagation(); }
        else { window.event.cancelBubble = true; }

				var l = document.getElementById("login");
				l.style.display="inline";

    };

    document.getElementById('formholder').onclick = function(e) {

        if (e) { e.stopPropagation(); }
        else { window.event.cancelBubble = true; }

        var l = document.getElementById("login");
        l.style.display="inline";
    };


    document.getElementById('upload').onclick = function(e) {

        if (e) { e.stopPropagation(); }
        else { window.event.cancelBubble = true; }

        var l = document.getElementById("login");
        l.style.display="inline";
    };

    document.getElementById('like').onclick = function(e) {

        if (e) { e.stopPropagation(); }
        else { window.event.cancelBubble = true; }

        var l = document.getElementById("login");
        l.style.display="inline";
    };
    document.getElementById('dislike').onclick = function(e) {

        if (e) { e.stopPropagation(); }
        else { window.event.cancelBubble = true; }

        var l = document.getElementById("login");
        l.style.display="inline";
    };
    document.getElementById('login').onclick = function(e) {

        if (e) { e.stopPropagation(); }
        else { window.event.cancelBubble = true; }

        var l = document.getElementById("login");
        l.style.display="inline";

    };
    document.getElementById('textarea').onclick = function(e) {

        if (e) { e.stopPropagation(); }
        else { window.event.cancelBubble = true; }

        var l = document.getElementById("login");
        l.style.display="inline";
    };
}
/* Other javascript */
function showHint(str,e)
{
		e = e || window.event;
        if (e.keyCode == 13)
        {
            document.getElementById('btnclick').click();
			return;
        }
	if (str.length==0)
	  {
	  document.getElementById("txtHint").innerHTML="";
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
	    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
	    }
	  }

			xmlhttp.open("GET","gethint.php?q="+str,true);
	xmlhttp.send();
}
function add(name)
{
		document.getElementById("search").value= name;
		document.getElementById("btnclick").click();
}
function clicklink(id)
{
	document.getElementById('videolink'+id).click();
}

function checkuser(userid,password)
{

	  xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == 'no') {
                var pass = document.getElementById('passid');
                pass.setAttribute('class', 'error');
            }
            else if (xmlhttp.responseText == 'noactive') {
                alert("Your Account was Deactivated");
            }
            else {

                document.getElementById('submitid').click();
            }
        }
    };

			xmlhttp.open("get","login.php?userid="+userid+"&password="+password+"&check="+'check',true);
	xmlhttp.send();
}
function uploadpage(userid)
{
	if(userid=='notuser')
	{
		var btn = document.getElementById('loginclick');
		var box = document.getElementById('formholder');
		//box.style="-webkit-animation:formholder 1s step-end 2;animation: formholder 1s step-end 2;";
        box.style.animation="animation: formholder 1s step-end 2";
		btn.click();
		return;
	}
	else
	{
			window.open('Upload.php','_self',false);
	}
}

    /*//////////////////////////////////////Profile////////////////////////////////////////////*/


    function Conform(val)
    {
        val = val.slice(3);
        vidid=val;
        document.getElementById('ConformDiv').style.visibility="visible";
        document.getElementById('ConformDiv').style.opacity="1";
        document.getElementById('ConformDiv').style.marginLeft="-160px";

    }
    function closeConform()
    {
        document.getElementById('ConformDiv').style.visibility="hidden";
        document.getElementById('ConformDiv').style.opacity="0";
        document.getElementById('ConformDiv').style.marginLeft="200px";
    }
    function ForgotClick()
    {
        document.getElementById('Forgot').style.visibility="visible";
        document.getElementById('Forgot').style.opacity="1";
        document.getElementById('Forgot').style.marginLeft="-210px";
    }
    function closeForgot()
    {
        document.getElementById('Forgot').style.visibility="hidden";
        document.getElementById('Forgot').style.opacity="0";
        document.getElementById('Forgot').style.marginLeft="200px";
    }
    function closeOk()
    {
        document.getElementById('ForgotSent').style.visibility="hidden";
        document.getElementById('ForgotSent').style.opacity="0";
        document.getElementById('ForgotSent').style.marginLeft="-400px";
    }
    function okForgot()
    {
        document.getElementById('ForgotSent').style.visibility="visible";
        document.getElementById('ForgotSent').style.opacity="1";
        document.getElementById('ForgotSent').style.marginLeft="-160px";
        document.getElementById('Forgot').style.visibility="hidden";
        document.getElementById('Forgot').style.opacity="0";
        document.getElementById('Forgot').style.marginLeft="200px";

    }
    function deleteVid()
    {
        var ajax = new XMLHttpRequest();
        ajax.open("POST", "EditMyVideo.php", true);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.send("vidid="+vidid);
        document.getElementById('ConformDiv').style.visibility="hidden";
        document.getElementById('ConformDiv').style.opacity="0";
        document.getElementById('ConformDiv').style.marginLeft="200px";
        setTimeout(function(){ loadMyVid(); },200)
    }
    function editVid(val)
    {
        val = val.slice(4);
        vidid=val;
        document.getElementById('editDiv').style.visibility="visible";
        document.getElementById('editDiv').style.opacity="1";
        document.getElementById('editDiv').style.marginTop="-80px";
        var name = document.getElementById('videolink'+val).innerHTML;
        document.getElementById('vidNameProfile').value=name;
    }
    function closeName()
    {
        document.getElementById('editDiv').style.visibility="hidden";
        document.getElementById('editDiv').style.opacity="0";
        document.getElementById('editDiv').style.marginTop="200px";
    }
    function saveName()
    {
        var name = document.getElementById('vidNameProfile').value;
        if(!name.match(/\S/))
        {
            return;
        }
        var ajax = new XMLHttpRequest();
        ajax.open("POST", "EditMyVideo.php", true);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.send("name="+name+"&vidid="+vidid);
        document.getElementById('editDiv').style.visibility="hidden";
        document.getElementById('editDiv').style.opacity="0";
        document.getElementById('editDiv').style.marginTop="200px";
        setTimeout(function(){ loadMyVid(); },200)
    }

    /*//////////////////////////////////////Profile////////////////////////////////////////////*/


</script>
<html>
 <head>
     <link rel="shortcut icon" href="MegatubeIcon.ico">
</head>
 <body>
<div class="findbar">
<div class="containerpart">
<div class="leftpart">
<!-- div left -->
    <div  style="padding: 3px 10px" >
    <img src="megatube.png" height="45" width="250" id="megatube" onclick="window.open('index.php','_self',false);">
    </div>
    <div class="bodyname">
        <label style="font-size: 12px;" id="labelname">Developed by : Mohit M. Ghodasara</label>
    </div>
    <div id="Forgot" class="Forgot">
        <label style="font-size: 18px;color:#C1A21B;">Enter Your Registered Phone number.</label>
        <div style="height: 5px;"></div>
        <input type="number" placeholder="Number" class="vidNameProfile" maxlength="10" >
        <button id="ok" class="save" onclick="okForgot()"> OK </button>
        <button id="closeDiv" class="save"  onclick="closeForgot()"> Close </button>
    </div>
    <div id="ForgotSent" class="ForgotSent">
        <label style="font-size: 18px;color:#C1A21B;">Enter Code.</label>
        <div style="height: 5px;"></div>
        <input type="text" placeholder="Code....." class="vidNameProfile" >
        <button id="ok" class="save" onclick=""> OK </button>
        <button id="closeDiv" class="save"  onclick="closeOk()"> Close </button>
    </div>
</div>
<!-- div mid -->
<div class="midpart">
	<div class="SearchBox">
	  <div class="container-4">
 <table>
 <tr>

     <td >
         <button class='barView' id = 'barbtn' onClick = 'barbtnclick()'
         <?php
         $file_name =  $_SERVER["PHP_SELF"];
         $tmp = explode('/', $file_name);
         $PageName = end($tmp);
         if($PageName == 'Playing video.php')
         {
             echo "style='visibility:hidden'";
         }
         ?>

         " ></button >

     </td>
     <td>
         <button class="icon2" id="upload" onClick="uploadpage('<?php if(isset($_SESSION['userid'])){ echo $_SESSION['userid'];}else{ echo 'notuser';} ?>');"></button>
     </td>
     <td>
     <form action="Result.php" method="post" enctype="multipart/form-data" id="serchform">
   		<input  type="Search" id="search" name="q" onKeyUp="showHint(this.value,event)" size="20" required>
		<button class="icon" id="btnclick" onClick="serchform.submit();"><i class="fa fa-search"></i></button>
	 </form>
	 </td>
  </tr>
  </table>
  <span id="txtHint"></span>
  </div>
</div>
</div>
<div class="rightpart">
    <?php
    $file_name =  $_SERVER["PHP_SELF"];
    $tmp = explode('/', $file_name);
    $PageName = end($tmp);
    if($PageName == 'Playing video.php')
    {
        echo "<button class='barVidView' id='barvidbtn' onClick='barvidbtnclick()''></button>";
    }
    ?>


<!-- div right -->
	<div align="right">

    <?php
	if(isset($_SESSION['userid']))
	{
		echo '<input type="button"  id="logoutclick" class="logoutbtm" onClick="clickonlogout()" value="" >';
	}
	else
	{
		echo '<input type="button"  id="loginclick" class="loginbtm" onClick="clickonlogin()" value="Login" >';
	}

	?>

      </div>
    <div class="login" id="login" style="display: none;width: 350px; position: relative;"  align="right">
      <div class="arrow-up"></div>
      <div id="formholder" class="formholder">
        <div class="randompad">
           <form action="login.php" method="post"  enctype="multipart/form-data" >  <!-- onSubmit="return checkuser(userid.value,passid.value)"-->
           <?php
           if(isset($_SESSION['userid']))
		   {
			   ?>
               <div align="center">
                   <table align="center">
                       <tr>
                                <td><div class="circle"></div></td>
                       </tr>
				<tr>
                    <td align="center" style="padding-top: 8px"><label   name='username'><?php echo $row['name']." ".$row['sname'];?></label><br></td>
                </tr>
                       <tr>
                            <td align="center"><a href='Profile.php' style="text-decoration:none;">My Profile</a></td>
                       </tr>
                       </table>


			<input type="submit"  class="btnclass" value="Logout" name="logout" style="margin-top:5px;" />
                   </table>
            </div>
            <?php
		   }
			else{?>
           <div align="left">
             <label name="username">Username</label>
             <input type="text" value="" name="userid" id="userid" class="textclass" placeholder="Username" required/>
             <label name="password">Password</label>
             <input type="password" name="password" class="textclass" id="passid" required/>

             <input type="button" class="btnclass" onClick="checkuser(userid.value,passid.value)"  value="Login" id="loginbtnid">
             <input type="submit"  name="login" style="display:none" id="submitid" value="login"/>
             <input type="button"  class="btnclass" style="margin-top:5px;" value="Registration" onclick=" window.open('Registration.php','_self',false);" name="Register" />
               <div align="center" >
                           <!--<a onclick="ForgotClick()" style="font-size: 10px;" >Forgot password</a>-->
               </div>

             </div>
             <?php } ?>
			</form>
        </div>
      </div>
    </div>
  </div>


</div>

</div>
        <div style="padding-top:70px;"> <!-- BarSpace Div --></div>
</body>
</html>
<style>
    .circle{
        border-radius: 50%;
        width: 160px;
        height: 160px;
        background: url(<?php if($row['photo']!=""){ echo "data:image/jpeg;base64,".base64_encode($row['photo']);}else{echo "defaultimg.jpg";} ?>) no-repeat center;
        background-size: 100% 100%;
        margin-top:-10px;
        box-shadow: 0 0 3px 2px black;
    }
    .loginbtm:hover {
        background: rgba(255, 0, 0, 0.67);
    }
    .logoutbtm{
        background: red;             /* loin button  */
        padding: 5px;
        font-size: 18px;
        display: block;
        border: none;
        color: #bebebe; /*#fff;*/
        border-radius: 50%;
        margin-right:32px;
        width: 40px;
        height: 40px;
        margin-top:7px;
        background: url(<?php if($row['photo']!=""){ echo "data:image/jpeg;base64,".base64_encode($row['photo']);}else{echo "defaultimg.jpg";} ?>) no-repeat center;
        background-size: 100% 100%;
        box-shadow: 0 0 15px 1px black;
    }


    /* ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^Code for divide^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ */
    .containerpart
    {
        width:100%;
        height:100%;
        z-index:2;

    }
    .leftpart
    {
        width:20%;
        height:100%;
        float:left;
    }
    .rightpart
    {
        width:20%;
        height:100%;
        float:left;
    }
    .midpart
    {
        width:60%;
        height:100%;
        float:left;

    }

    /* ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ */


    h2 {
        padding: 20px;
        color: #ecf0f1;
    }

    fieldset {
        border: none;
    }

    .login {
        position: relative;
        width: 350px;
        display: none;
    }

    .arrow-up {
        width: 0;
        height: 0;
        border-left: 20px solid transparent;
        border-right: 20px solid transparent;
        border-bottom: 15px solid red;
        right: 10%;
        position: absolute;
        margin-right:-238px;
        margin-top:10px;
        /*      margin-top:-10px;  #ECF0F1*/

        z-index:11;
    }

    .formholder {
        background: #ecf0f1;
        width: 200px;
        border-radius: 5px;
        padding-top: 5px;
        margin-right:20px;
        height:280px;
        margin-top:25px;
        box-shadow: 0 0 1px 1px #666;

    }
    @-webkit-keyframes formholder {
        from, to
        {
            box-shadow: 0 0 1px 1px red;
        }
        50%
        {
            box-shadow: 0px 0px 100000000px 0.5px #C30;
        }

    }
    @keyframes formholder {
        from, to
        {
            box-shadow: 0 0 1px 1px red;
        }
        50%
        {
            box-shadow: 0px 0px 100000000px 0.5px #C30;
        }

    }
    .textclass{
        padding: 7px 5px;
        margin: 10px 0;
        width: 96%;
        display: block;
        font-size: 18px;
        border-radius: 5px;
        border: none;
        -webkit-transition: 0.3s linear;
        transition: 0.3s linear;
    }
    .error{
        padding: 7px 5px;
        margin: 10px 0;
        width: 96%;
        display: block;
        font-size: 18px;
        border-radius: 5px;
        border: none;
        -webkit-transition: 0.3s linear;
        transition: 0.3s linear;
        outline: none;
        box-shadow: 0 0 2px 2px #F00;
    }
    .textclass:focus {
        outline: none;
        box-shadow: 0 0 1px 1px red;
    }

    .btnclass{
        background: red;             /* loin button  */
        padding: 10px;
        font-size: 18px;
        display: block;
        width: 100%;
        border: none;
        color: #fff;
        border-radius: 5px;
    }

    .btnclass:hover {
        background: rgba(255, 0, 0, 0.67);
    }

    .randompad {
        padding: 15px;
    }

    .green {
        color: red;
    }

    a{
        color: black;
        text-decoration: none;
        cursor:pointer;
    }
    h1

    {

        cursor:vertical-text;

    }

    h2

    {

        cursor:no-drop;

    }

    h3

    {

        cursor:cell;

    }

    h4

    {

        cursor:pointer;

    }

    p

    {

        cursor:progress;

    }

    div

    {

        cursor:pointer;

    }

    a:hover {
        color: red;
    }

    .loginbutton{
        background: red;             /* loin button  */
        padding: 10px;
        font-size: 18px;
        display: block;
        width: 100%;
        border: none;
        color: #fff;
        border-radius: 5px;
    }

    .loginbtm{
        background: red;             /* loin button  */
        padding: 5px;

        font-size: 18px;
        display: block;
        width: 70px;
        border: none;
        color: #bebebe; /*#fff;*/
        border-radius: 3px;
        margin-right:20px;
        margin-top:10px;
    }

    .logoutbtm:hover {
        box-shadow: 0 0 20px 0.5px red;
    }


    .box:hover > table a
    {
        color: black;
    }
    .box:hover > table
    {
        color: black !important;
    }
    .box{
        color:white;
        padding-left:2px;
        height:130px;
        margin: 5px;
        text-decoration: none;
        border-radius:15px;
        background-color: #2b303b;
        z-index: 1;
        -webkit-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
    }
    #searchImg
    {
        border-radius:15px;
        padding-right: 8px;
    }
    .box:hover
    {
        background-color: rgba(179, 149, 27, 1);
        color: black;
        -webkit-transform: translateX(10px);
        -ms-transform: translateX(10px);
        transform: translateX(10px);
        /*    background: linear-gradient(to left,#3c4453,#C1A21B)no-repeat 100% 100%;*/
    }
    .wrap {

        padding-top: 5px;
        display: inline-block;
        width: 500px;
        white-space:nowrap;
        text-overflow:ellipsis;
        color:black;
        text-decoration: none !important;
        overflow: hidden;
        word-break: break-all;
        font-size: 19px;
        color: #C1A21B;
    }
    p{
        font-size: 12px;
    }

    /* Search Box */

    .container-4 input#search{


        width: 565px;
        height: 50px;
        background: #2b303b;
        border: none;
        font-size: 10pt;
        float: left;
        color: #fff;
        padding-left: 15px;
        border-radius: 5px;
        font-size:18px;
        border:0;


    }
    .container-4 input#search::-webkit-input-placeholder {
        color: #65737e;

    }

    .container-4 input#search:-moz-placeholder { /* Firefox 18- */
        color: #65737e;
    }

    .container-4 input#search::-moz-placeholder {  /* Firefox 19+ */
        color: #65737e;
    }

    .container-4 input#search:-ms-input-placeholder {
        color: #65737e;
    }
    .container-4 button.icon{
        -webkit-border-top-right-radius: 5px;
        -webkit-border-bottom-right-radius: 5px;
        -moz-border-radius-topright: 5px;
        -moz-border-radius-bottomright: 5px;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
        border: none;
        background: #232833; /*  Button Color  */
        height: 50px;
        width: 50px;
        color: #4f5b66;
        opacity: 0;
        filter:alpha(opacity=0);
        font-size: 10pt;
        -webkit-transition: all .55s ease;
        transition: all .55s ease;

    }
    .icon2
    {
        -webkit-border-top-left-radius: 5px;
        -webkit-border-bottom-left-radius: 5px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-bottomleft: 5px;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
        border: none;
        height: 50px;
        width: 50px;
        color: #4f5b66;
        font-size: 10pt;
        -webkit-transition: all .55s ease;
        transition: all .55s ease;
        color: #4f5b66;
        background:#232833;  /* Buttton hover Color */
        background-image:url("upload.png");
        margin-top:-16px;
        margin-left: 20px;
        -webkit-transform: translateX(15px);
        -ms-transform: translateX(15px);
        transform: translateX(15px);

    }
    .icon2:hover
    {
        background:white;
        background-image:url("upload.png");
    }

    .barView
    {
        border-radius: 15px;
        border: none;
        height: 50px;
        width: 50px;
        color: #4f5b66;
        font-size: 10pt;
        -webkit-transition: all .55s ease;
        transition: all .55s ease;
        color: #4f5b66;
        background: no-repeat  center;
        background-image:url("menu.png");
        background-size: 80%;
        margin-top:-16px;
        /*transform : rotate(180deg);*/
    }
    .barView:hover
    {
        /*background:white;*/
        background-image:url("menu.png");
    }
    .barView:active
    {
        -webkit-transform: scale(0.90);
        -ms-transform: scale(0.90);
        transform: scale(0.90);
    }


    .barVidView
    {
        /*border-radius: 15px;*/
        border: none;
        height: 50px;
        width: 50px;
        color: #4f5b66;
        position: fixed;
        font-size: 10pt;
        -webkit-transition: all .55s ease;
        transition: all .55s ease;
        color: #4f5b66;
        background:#fff;  /* Buttton hover Color */
        margin-top: 3px;
        background: no-repeat  center;

        background-image:url("Fullscreen.png");
        background-size: 70%;

        /*transform : rotate(180deg);*/
    }
    .barVidView:active
    {
        -webkit-transform: scale(0.90);
        -ms-transform: scale(0.90);
        transform: scale(0.90);
    }

    .container-4:hover button.icon, .container-4:active button.icon, .container-4:focus button.icon{

        outline: none;
        opacity: 1;
        filter:alpha(opacity=100);
        margin-left: -51px;
        background-image:url("search.png");
    }


    .container-4:hover button.icon:hover{
        background:white;  /* Buttton hover Color */
        background-image:url("search.png");
    }
    .boxbar{
        width:538px;
        height:25px;
        box-shadow:0 0 5px 0.2px #000;
        padding:10px;
        padding-left:5px;
        vertical-align: middle;
        font-size:18px;
        background: #2b303b;
        float: left;
        margin-left:142px;
        border: none;
        color: #C1A21B;
        -webkit-transition: all 0.2s linear;
        transition: all 0.2s linear;

        z-index: 2;

        overflow: hidden;
        overflow: hidden;
        white-space: nowrap;
        text-overflow:ellipsis;
    }
    .boxbar:hover
    {
        z-index: 10;
        background:#C1A21B;
        color: black;
    }

    .findbar
    {
        width:100%;
        height:55px;
        background:#666;
        /*  background:#2b303b;*/
        background:-webkit-linear-gradient(right, #7e7e7e, #2b303b)no-repeat 100% 100%;
        background:linear-gradient(to left,#7e7e7e, #2b303b)no-repeat 100% 100%;
        padding:5px;
        position:fixed;
        z-index:10;
    }
    .back,body
    {
        margin: 0;
        padding: 0;
        font-family: Sans-serif;
        /*background-color:#CCC;*/

        background:-webkit-linear-gradient(225deg, #e3e3e3, #666666)no-repeat fixed 100% 100%;
        background:linear-gradient(225deg, #e3e3e3,#666666)no-repeat fixed 100% 100%;
    }


    /*/////////////////////////////////////////Profile//////////////////////////////////////////////////////////*/



    .delVidBtn{
        float:left;
        margin-top: -35px;
        margin-left: 620px;
        height: 25px;
        width: 25px;
        border: none;
        background: no-repeat  center;
        background-image: url("Delete.png");
        opacity: 0.3;
        filter:alpha(opacity=30);
        background-size: 100%;

    }
    .delVidBtn:hover{
        opacity: 1;
        filter:alpha(opacity=100);
    }
    .editVidBtn
    {
        float:left;
        margin-top: -33px;
        margin-left: 585px;
        height: 25px;
        width: 25px;
        border: none;
        background: no-repeat  center;
        background-image: url("Edit.png");
        background-size: 85%;
        opacity: 0.3;
        filter:alpha(opacity=30);
    }
    .editVidBtn:hover{
        opacity: 1;
        filter:alpha(opacity=100);
    }
    .vidNameProfile
    {
        padding: 5px;
        margin: 10px 0;
        width: 100%;
        display: block;
        font-size: 15px;
        border-radius: 5px;
        border: 1px inset #fb9a16;;
        -webkit-transition: 0.3s linear;;
        transition: 0.3s linear;
        box-shadow: 0 0 50px 5px black;
        z-index: 100;
    }
    .editDiv
    {
        padding: 20px;
        height: 120px;
        width: 400px;
        top:50%;
        left:50%;
        margin-top: 200px;
        margin-left: -220px;
        background: #2b303b;
        z-index: 600;
        position: fixed;
        border-radius: 10px;
        box-shadow: 0 0 100px 10px red;
        visibility: hidden;
        opacity: 0;
        filter:alpha(opacity=0);
        -webkit-transition: all 0.5s cubic-bezier(1.000, -0.530, 0.405, 1.425);
        transition: all 0.5s cubic-bezier(1.000, -0.530, 0.405, 1.425);
    }
    .editDiv:focus{
        outline: none;
        box-shadow: 0 0 5px 1px red;
    }
    .Forgot
    {
        padding: 20px;
        height: 120px;
        width: 400px;
        top:50%;
        left:50%;
        margin-top: -70px;
        margin-left: 210px;
        background: #2b303b;
        z-index: 600;
        position: fixed;
        border-radius: 10px;
        box-shadow: 0 0 100px 10px red;
        visibility: hidden;
        opacity: 0;
        filter:alpha(opacity=0);
        -webkit-transition: all 0.5s cubic-bezier(1.000, -0.530, 0.405, 1.425);
        transition: all 0.5s cubic-bezier(1.000, -0.530, 0.405, 1.425);
    }
    .ForgotSent
    {
        padding: 20px;
        height: 120px;
        width: 300px;
        top:50%;
        left:50%;
        margin-top: -70px;
        margin-left: -400px;
        background: #2b303b;
        z-index: 600;
        position: fixed;
        border-radius: 10px;
        box-shadow: 0 0 100px 10px red;
        visibility: hidden;
        opacity: 0;
        filter:alpha(opacity=0);
        -webkit-transition: all 0.5s cubic-bezier(1.000, -0.530, 0.405, 1.425);
        transition: all 0.5s cubic-bezier(1.000, -0.530, 0.405, 1.425);
    }
    .bodyname{
        padding: 20px;
        height: 10px;
        width: 300px;
        top:100%;
        left:100%;
        margin-top: -50px;
        margin-left: -230px;
        z-index: 20000;
        position: fixed;
        opacity: 0.5;
        filter:alpha(opacity=0.5);
        -webkit-transition: all 0.5s cubic-bezier(1.000, -0.530, 0.405, 1.425);
        transition: all 0.5s cubic-bezier(1.000, -0.530, 0.405, 1.425);
    }
    #labelname:hover
    {
        color: red;
    }
    .ConformDiv{
        padding: 20px;
        height: 80px;
        width: 300px;
        top:50%;
        left:50%;
        margin-top: -50px;
        margin-left: 200px;
        margin-left: 0px;
        background: #2b303b;
        z-index: 600;
        position: fixed;
        border-radius: 10px;
        box-shadow: 0 0 100px 10px red;
        visibility: hidden;
        opacity: 0;
        filter:alpha(opacity=0);
        -webkit-transition: all 0.5s cubic-bezier(1.000, -0.530, 0.405, 1.425);
        transition: all 0.5s cubic-bezier(1.000, -0.530, 0.405, 1.425);
    }
    .save{
        background: red;             /* loin button  */
        padding: 3px;
        font-size: 15px;
        width: 70px;
        border: none;
        color: white; /*#fff;*/
        border-radius: 3px;
        margin-top: 10px;
        float: right;
        margin-left:10px;
    }
    .save:hover {
        background: rgba(255, 0, 0, 0.67);
    }



    /*/////////////////////////////////////////Profile//////////////////////////////////////////////////////////*/



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
        width: 660px;
        height:110px;
        text-decoration: none;
        /*background-color: #2b303b;*/
        z-index: 1;
        -webkit-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
        border-radius:15px;
        margin-bottom: 5px;
        background: #8f8f8f;
    }
    #searchImgRelated
    {
        border-radius:15px;
        padding-right: 8px;
    }
    .boxRelated:hover
    {
        background-color: rgba(179, 149, 27, 1);
        background-color: #2b303b  !important;
        color: black;
        /*	transform: translateX(5px);
            background: linear-gradient(to left,#3c4453,#C1A21B)no-repeat 100% 100%;*/
    }
    .wrapRelated {

        padding-top: 5px;
        display: inline-block;
        width: 510px;
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

</style>