<style>
/* Upload page CSS */
.inputWrapper0 {
    height: 32px;
    width: 80px;
    overflow: hidden;
    position: relative;
    cursor: pointer;

    background-color: #DDF;
}
.Uploadclass{
    background: red;             /* loin button  */
    padding: 8px;
    font-size: 15px;
    width: 120px;
    display:  inline-block;

    border: none;
    color: #fff;
    border-radius: 3px;
    box-shadow: 0 0 50px 1px black;
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
.inputclass:focus {
    outline: none;
    box-shadow: 0 0 1px 1px red;
}

.fileinput
{
    content: 'Select Video';
    display: inline-block;
    background: linear-gradient(top, #f9f9f9, #e3e3e3);
    border-radius: 3px;
    font-weight: 700;
    font-size: 10pt;
}
.O1{
    border-radius:50%;
    width: 80px;
    height: 80px;
   animation: boxs 7s cubic-bezier(1.000, -0.530, 0.405, 1.425) 1s infinite;

}
.O2{
    border-radius:50%;
    width: 80px;
    height: 80px;
    margin-top: -80px;
    margin-left: 150px;
    animation: boxs 7s cubic-bezier(1.000, -0.530, 0.405, 1.425) 2s infinite;
}
.O3{
    border-radius:50%;
    width: 80px;
    height: 80px;
    margin-top: 70px;
    margin-left: 75px;
    animation: boxs 7s cubic-bezier(1.000, -0.530, 0.405, 1.425) 2.5s  infinite;
}

@keyframes boxs {
    from, to
    {
        transform: scale(1) translateX(700px);
        box-shadow: 0 0 50px 10px red;
    }
    50%
    {
        transform: scale(-0.5)translateX(0px);
        box-shadow: 0 0 50px 10px black;
    }

}
.rotate{
    position: fixed;
    margin-left: 1000px;
    margin-top: 250px;
    animation: rotate 5s linear infinite;
}
@keyframes rotate{
    0%
    {
        transform: rotate(0deg);
    }
    100%
    {
        transform: rotate(360deg);
    }

}
</style>
<?php
require("Connection.php");
//require("Find.php");
require("NavigationBar.php");
if(!isset($_SESSION['userid']))
{	
	echo "<script>window.open('index.php','_self',false);</script>";
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["userfile"])) {
	$vidpath = $_FILES["userfile"]["tmp_name"];
	$vidname=$_FILES["userfile"]["name"]; // ffmpeg
	$name=$_POST['name'];
	$des=$_POST['des'];
	$category=$_POST['category'];
	$vidid=uniqid();
	$userid=$_SESSION['userid'];
	$date=date("Y/m/d");
	$query = "insert into upload values('','$vidid','$name','$des','$category','$userid','$date','')";


	 // ffmpeg
	 
	//$ffmpeg = "C:\\wamp\\www\\Video\\ffmpeg\\bin\\ffmpeg";
    $ffmpeg = ".\\ffmpeg\\bin\\ffmpeg";
	$imgfile= "uploaded/$vidid.jpg";
	$size = "840x460";
	$second= rand(5,100);
	$cmd ="$ffmpeg -i $vidpath -an -ss $second -s $size $imgfile";
	shell_exec($cmd);
	
	
   move_uploaded_file($vidpath,"./uploaded/"."$vidid.mp4");
   mysqli_query($conn,$query) or die(mysqli_erro());
}
?>
<html>
 <head>
  <title>Upload Video</title>
  <link rel="stylesheet" type="text/css" href="style.css">
 </head>
 <body>
 <br>
 <div class="rotate">
     <div id="o1" class="o1"></div>
     <div id="o2" class="o2"></div>
     <div id="o3" class="o3"></div>
 </div>
<table align="center" cellpadding="5" style="table-layout:fixed;">
	<tr>
    	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" id="myForm" enctype="multipart/form-data" 
    target="hidden_iframe">
		<td colspan="2" align="center"><font size="+2" >Video Details</font></td><td></td>
   </tr>
   <tr><td><br></td></tr>
   <tr>
	<td><input style="width: 370px;" placeholder="Name" class="inputclass" type="text" name="name" id="name" size="35" required></td>
   </tr>
   <tr>
		<td><textarea class="inputclass" rows="5" cols="32" name="des"  placeholder="Descriptions..."></textarea></td>
   </tr>
   <tr>
        <td>
         <select class="inputclass" name="category" required>
         <option value="" disabled selected style='display:none;'>Select Category</option>
         <?php 
		 
		 $query = "select * from category;";
		 $category=mysqli_query($conn,$query);
		 while($row = mysqli_fetch_array($category))
		 {
				 echo "<option value='$row[0]'>$row[1]</option>";
		 }
		 
		 ?>
		</select> 
        </td>
   </tr>
	
   <input type="hidden" value="myForm" name="<?php echo ini_get("session.upload_progress.name"); ?>">
    <tr>

    </tr>
    <tr>
    	<td>
            <div id="bar_blank">
                <div id="bar_color">
                </div>
            </div>
            <div id="status"><br>
            </td>
        <td>

        </td>
  	</tr>
   <tr>
       <td>
           <input type="button" class="uploadclass"  style="background: #2b303b;margin-right: 120px;"  onclick="document.getElementById('file').click()" value="Select Video">
           <input type="file" style="display: none;" name="userfile" id="file" onChange="Checkfiles();" required>

            <input type="submit" id="submit" class="Uploadclass" value="Start Upload" >
        </td>
       </form><iframe id="hidden_iframe" name="hidden_iframe" src="about:blank"></iframe>
    </tr>
</table>
 </body>
</html>

<script type="text/javascript">

    function Checkfiles()
    {
        var file = document.getElementById("file").files[0];
        var fup = document.getElementById('file');
        var fileName = fup.value;
        if(file.size>800000000)
        {
            document.getElementById('file').value = "";
            alert("file is bigger than 700mb");
            return false;
        }
        var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
    	if(ext =="MP4" || ext=="mp4")
    	{
			var name = document.getElementById('name').value;
			if(name == "")
			{

					document.getElementById('name').value =fileName.substr(0, 60);;
			}
			
        	return true;
    	}
    	else
    	{
			document.getElementById('file').value = "";
       	 alert("Upload MPEG only");
       	 return false;
    	}
	}
  
  
  
  
  function toggleBarVisibility() {
    var e = document.getElementById("bar_blank");
    e.style.display = (e.style.display == "block") ? "none" : "block";
}
 
function createRequestObject() {
    var http;
    if (navigator.appName == "Microsoft Internet Explorer") {
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    else {
        http = new XMLHttpRequest();
    }
    return http;
}
 
function sendRequest() {

    var http = createRequestObject();
    http.open("GET", "progress.php");
    http.onreadystatechange = function () { handleResponse(http); };
    http.send(null);
}
 
function handleResponse(http) {
    var response;
    if (http.readyState == 4) {
        response = http.responseText;
        document.getElementById("bar_color").style.width = response + "%";
        document.getElementById("status").innerHTML = response + "%";
 
        if (response < 100) {
            setTimeout("sendRequest()", 1000);
        }
        else {
           	toggleBarVisibility();
            document.getElementById("status").innerHTML = "Done.";
			document.getElementById("status").style = "color:green";
			window.open('index.php','_self',false);

        }
    }
}
 
function startUpload() {
    toggleBarVisibility();
    setTimeout("sendRequest()", 1000);
}
 
(function () {
    document.getElementById("myForm").onsubmit = startUpload;
})();
</script>
