<?php
require("Connection.php");
require("Find.php");
$GLOBALS['imgid']=1;
if(!isset($_SESSION['cat'])){
    $_SESSION['cat']='0';
}
function CatName($CatName, $URL)
{
    $catID= $_SESSION['cat'];
    if(strcasecmp($catID, $URL) == 0){
        $color="red;color: white;";
    }else{
        $color="";
    }
    ?>
    <div style="padding-top: 3px;"></div>
    <div class="CatName" id="<?php echo $URL;?>" style="background: <?php echo $color;?>" onclick="CatClick(this.id)">
        <img  src="watch.png" id="img<?php echo $GLOBALS['imgid']++; ?>" alt="Channel" style="height: 10px;width: 10px;margin-top: 2px;"  > <?php echo $CatName; ?>
    </div>
<?php }
function Options($TabName, $img, $padding, $URL)
{
    $file_name =  $_SERVER["PHP_SELF"];
    $tmp = explode('/', $file_name);
    $PageName = end($tmp);
    if(strcasecmp($PageName, $URL) == 0) {
        $color="red;color: white;";
    } else  {
        $color="#2b303b";
    }
    ?>
    <div style="padding-top: <?php echo $padding;?>px;"></div>
    <div class="TabBar" style="background:<?php echo $color;?>;" onclick="window.open('<?php echo $URL;?>','_self',false);">
        <img name="option" src="<?php echo $img;?>" id="img<?php echo $GLOBALS['imgid']++; ?>" style="height: 22px;width: 22px;margin-top: 2px;" > <?php echo $TabName;?>
    </div>
<?php }
?>
<div id="HomeContainer" class="HomeContainer">
    <div id="HomeBar" class="HomeBar">
        <?php
        Options("Home","home.png","30","index.php");
        Options("My Channel","channel.png","5","profile.php");
        Options("Upload","UploadICON.png","5","Upload.php");
        Options("What to Watch","watch.png","5","Result.php");
        ?>
        <div style="padding-top: 5px;"></div>
        <?php
        CatName("All","0");
        CatName("Entertainment","4");
        CatName("Comedy","2");
        CatName("Music","8");
        CatName("Gaming","6");
        CatName("Howto & Style","7");
        CatName("Science & Technology","13");
        CatName("Sports","14");
        CatName("News & Politics","9");
        CatName("Education","3");
        CatName("Autos & Vehicles","1");
        CatName("File & Animation","5");
        CatName("People & Blogs","11");
        CatName("Travel & Events","15");
        CatName("pets & Animals","12");
        CatName("Nonprofits & Activism","10");
        ?>
    </div>
    <div class="MegaDiv">
    </div>
    <style>
        .TabBar
        {
            height: 30px;
            font-size: 18px;
            padding: 2px;
            padding-left: 35px;
            -webkit-transition: -webkit-transform 0.1s linear,background 0.5s linear;
            transition: transform 0.1s linear,background 0.5s linear;
        }
        .TabBar:hover{
            -webkit-transform:translateX(20px);
            -ms-transform:translateX(20px);
            transform:translateX(20px);
            background: red !important;
            color: black !important;
            background:#C1A21B !important;
        }
        .CatName{
            height: 20px;
            margin-left: 37px;
            background : rgba(47, 52, 64, 0.9);  /*#9c9c9c*/
            font-size: 12.5px;
            padding-left: 7px;
            padding-top: 2px;
            -webkit-transition: -webkit-transform 0.1s linear,background 0.5s linear;
            transition: transform 0.1s linear,background 0.5s linear;
        }
        .CatName:hover{
            -webkit-transform:translateX(10px);
            -ms-transform:translateX(10px);
            transform:translateX(10px);
            background: red !important;
            color: black !important;
            background:#C1A21B !important;
        }
        .HomeContainer{
            width: 100%;
            height: 100%;
            float: left;
        }
        .HomeBar{
            width: 17%;
            height: 100%;
            background: -webkit-radial-gradient(#7e7e7e, #7e7e7e, #3c4453)no-repeat 100% 100%;
            background: radial-gradient(#7e7e7e,#7e7e7e, #3c4453)no-repeat 100% 100%;
            color:#C1A21B;
            float: left;
            margin-top: -10px;
            position: fixed;
            -webkit-transform: 1s linear;
            -ms-transform: 1s linear;
            transform: 1s linear;
            -webkit-transition: -webkit-transform 0.5s ease-in-out;
            transition: transform 0.5s ease-in-out;
            z-index: 1;
        }
    </style>
        <script>

            <?php
    if(isset($_SESSION['bar']))
    {
        if($_SESSION['bar']==0)
        {
            echo "barbtnclick();";
        }
    }
    ?>


            function CatClick(val)
            {
                var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                }
                else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById(xmlhttp.responseText).style="";
                        document.getElementById(val).style.background="red";
                        document.getElementById(val).style.color="white";
                        //window.open('<?php// echo "Result.php";?>?','_self',false);
                    }
                }
                xmlhttp.open("GET", "Sleep.php?cat="+val, true);
                xmlhttp.send();
            }

        </script>