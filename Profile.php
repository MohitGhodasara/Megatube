<?php
require("Connection.php");
require("NavigationBar.php");
if(!isset($_SESSION['userid']))
{
    echo "<script>window.open('index.php','_self',false);</script>";
}
$query="select * from userinfo where userid='".$_SESSION['userid']."'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_array($result);
?>

<div id="container" class="container">
    <div id="leftProfile" class="leftProfile">
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
    <div id="midProfile" class="midProfile">
        <h3 style="color: blue;">My Videos</h3>
        <span id="myVid"></span>
    </div>
    <div id="rightProfile" class="rightProfile">
        <div style="position: fixed;">
        <div id="imgpart" >
            <form id="upload_form" enctype="multipart/form-data" method="post">
            <input type="file" style="display:none" name="photo" id="selectfile" onchange="loadFile(event)"/>
        </div>
    <table align="center" cellpadding="2">
    <tr>
        <td><img id="imgid"  height="200px" width="200px" class="imgClass" onclick="document.getElementById('selectfile').click();"/></td>
    </tr>
        <tr>
            <td><div style="height: 25px;width: 100%;padding-top: 10px;"><h5 style="margin-left: 70px;margin-top: 0px;" id="status"></h5></div></td>
        </tr>
    <tr>
        <td align="center"><h3  style="color: red"><a style="margin-left: 20px;" onclick="setImg()">Set Profile Picture</a></h3></td>
    </tr>
        </table>
    <table style="padding-top: 20px">
        <tr>
            <td style="width: 15px;"></td>
            <td style="width: 70px;"><h5>Name :</h5></td>
            <td><h4><?php echo $row['name']." ".$row['sname']; ?></h4></td>
        </tr>
        <tr>
            <td></td>
            <td><h5>Email :</h5></td>
            <td><h4> <?php echo $row['emailid']; ?></h4></td>
        </tr>
        <tr>
            <td></td>
            <td><h5>Birthdate : </h5></td>
            <td><h4><?php echo date('M d, Y', strtotime($row['birthdate'])); ?></h4></td>
        </tr>
        <tr>
            <td></td>
            <td><h5>Mobile : </h5></td>
            <td><h4><?php echo $row['mobile']; ?></h4></td>
        </tr>
        <tr>
            <td></td>
            <td><h5>Join at : </h5></td>
            <td><h4><?php echo date('M d, Y', strtotime($row['createdate'])); ?></h4></td>
        </tr>
            </form>
            </table>
        </div>


    </div>
</div>
<script>
    loadMyVid();
    var vidid;
    var loadFile = function(event) {
        var output = document.getElementById('imgid');
        output.src = URL.createObjectURL(event.target.files[0]);
    };

    function setImg(){
        var file = document.getElementById("selectfile").files[0];
        if(file==null)
        {
            document.getElementById('selectfile').click();
            return;
        }
        //alert(file.name+" | "+file.size+" | "+file.type);
        var formdata = new FormData();
        formdata.append("photo", file);
        var ajax = new XMLHttpRequest();
        ajax.addEventListener("load", completeHandler, false);
        ajax.open("post", "setImg.php");
        ajax.send(formdata);
    }
    function completeHandler(event){
        document.getElementById("status").innerHTML = "Image Updated...";
        setTimeout(function(){document.getElementById("status").innerHTML = "";},1000);
    }

        function loadMyVid() {
            var xmlhttp;
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            }
            else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById('myVid').innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "MyVideos.php", true);
            xmlhttp.send();
        }
</script>
<style>
     .container{
         width: 100%;
         height: 100%;
         float: left;
     }
    .leftProfile{
        width: 25%;
        height: 1%;
        float: left;
    }
    .midProfile{
        width: 52%;
        height: 1%;
        float: left;
    }
    .rightProfile{
        width: 23%;
        height: 1%;
        float: left;
    }
     .imgClass:active{
         transform: scale(0.95);

     }
     .imgClass{
         border-radius:50%;
         box-shadow: 0 0 20px 5.5px black;
         background: url(<?php if($row['photo']!=""){ echo "data:image/jpeg;base64,".base64_encode($row['photo']);}else{echo "defaultimg.jpg";} ?>) no-repeat center;
         //background-size: cover;
         background-size: 100% 100%;
         margin-left: 20px;
     }

</style>