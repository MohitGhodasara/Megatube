<?php
require("Connection.php");
//require("find.php");
require("NavigationBar.php");
require("RedLine.php");
$query= "select * from upload WHERE category = 8 ORDER BY id DESC";
$cat8 = mysqli_query($conn, $query);
$query = "select * from upload WHERE category = 4 ORDER BY id DESC";
$cat4 = mysqli_query($conn,$query);
$query = "select * From upload WHERE category = 2 ORDER BY id DESC ";
$cat2 = mysqli_query($conn, $query);
$query = "select * From upload WHERE category = 6 ORDER BY id DESC ";
$cat6 = mysqli_query($conn, $query);
$query = "select * From upload WHERE category = 7 ORDER BY id DESC ";
$cat7 = mysqli_query($conn, $query);

function HtmlCode($row,$idleft,$idright)
{
?>
    <table id="<?php echo $idleft.$idright; ?>" style="width: 200px;display: inline-block;
    <?php
    if($idright==6)
    {
        echo "display:none";
    }
    ?>
    " >
        <tr>
            <td>
                <div onmouseover="boxhover(this.id)" onmouseout="boxout(this.id)" class="VidBox" id="<?php echo "$row[1]";//vidid ?>" onClick="clicked(this.id)" style="background-image: url(uploaded/<?php echo "$row[1]";//vidid ?>.jpg);" ></div>
            </td>

        </tr>
        <tr>
            <td>
                <div class="NameStyle" id="vidname<?php echo "$row[1]";//vidid ?>"><?php echo "$row[2]"?></div> <!--Video Name-->
            </td>
        </tr>
        <tr>
            <td>
                <p class="UploaderStyle" id="uploader<?php echo "$row[1]";?>" >By : <?php echo "$row[5]";?> &nbsp; <!--For Uploader Name-->
                    <?php echo "$row[7]";?> Views</p> <!--For UserName-->
            </td>
        </tr>
    </table>
    <div style="padding-left: 5px;display: inline;"></div>

<?php
}
?>
<html>
<head>
    <title>Megatube.com</title>
</head>
<body id="body">

<div id="HomeContainer" class="HomeContainer">
<div class="MegaDiv">
    <div id="VidBar" class="Vidbar">
        <div id="VidHolder" style="<?php
        if(isset($_SESSION['bar']))
        {
            if($_SESSION['bar']==0)
            {
                echo "margin-left:5%";
            }
            else
            {
                echo "margin-left:18%";
            }
        }
        ?>;transition:margin-left 1s ease-in-out" >     <!--margin for Fixed bar -->
        <h4 style="padding-top: 20px;"class='tagName'>Music Blockbuster</h4>
        <?php
        $i=0;
        while($row = mysqli_fetch_array($cat8) and $i < 6)
        {
            $i++; HtmlCode($row,'1',$i);
        }
        echo "<br><h4 class='tagName'>Entertenment Blockbuster</h4>";
        $i=0;
        while($row = mysqli_fetch_array($cat4) and $i < 6)
        {
             $i++;HtmlCode($row,'2',$i);
        }
        echo "<br><h4 class='tagName'>Comedy Blockbuster</h4>";
        $i=0;
        while($row = mysqli_fetch_array($cat2) and $i < 6)
            {
            $i++;HtmlCode($row,'3',$i);
            }
        echo "<br><h4 class='tagName'>Gaming Overdrive</h4>";
        $i=0;
        while($row = mysqli_fetch_array($cat6) and $i < 6)
        {
            $i++;HtmlCode($row,'4',$i);
        }
        echo "<br><h4 class='tagName'>Howto do that</h4>";
        $i=0;
        while($row = mysqli_fetch_array($cat7) and $i < 6)
        {
            $i++;HtmlCode($row,'5',$i);
        }
        ?>
        </div>
    </div>
</div>
</div>
</body>
</html>


<style type="text/css">


    .UploaderStyle{
        margin: 0;
        font-size: 10px;
        padding-left: 5px;
        padding-right: 3px;
        color: black;
        -webkit-transition: color 0.5s linear;
        transition: color 0.5s linear;
    }
    .NameStyle{
        margin: 0;
        padding-left: 5px;
        padding-right: 3px;
        font-size: 15px;
        font-weight: bold;
        text-overflow: ellipsis;
        height: 40px;
        overflow: hidden;
        word-break: break-all;
        -webkit-transition: color 0.5s linear;
        transition: color 0.5s linear;
        color: black;
    }
    .tagName{
        margin: 0;
        padding-top: 10px;
        color: #0066CC;
        padding-left: 10px;
        padding-bottom: 2px;
    }
    .HomeContainer{
        width: 100%;
        height: 100%;
        float: left;
    }
    .Vidbar{
        width: 100%;
        height: 100%;
    }
    .VidBox
    {
        -webkit-transform: perspective(600px) rotateY(0deg);
        transform: perspective(600px) rotateY(0deg);
        width: 200px;
        height: 110px;
        border-radius: 15px;
        background: no-repeat  center;
        background-size: 110%;
        display: inline-block;
        border: 1px inset black;
        -webkit-transition: -webkit-transform .3s linear 0s,background-size 3s linear,border 1s linear;
        transition: transform .3s linear 0s,background-size 3s linear,border 1s linear;
    }
    .VidBox:hover {
        border: 1px inset #C1A21B;
        -webkit-animation: zoom 1.5s infinite;
        animation: zoom 1.5s infinite;

    }
    .MegaDiv:hover .VidBox{
        background-size: 150%;
    }
    @-webkit-keyframes zoom {
        0% {
            background-size: 110%;
        }
        30%
        {
            background-size: 210%;
        }
        60%
        {
            background-size: 150%;
        }
        70%{
            background-size: 190%;
        }
        100% {
            background-size: 110%;
        }
    }
    @keyframes zoom {
        0% {
            background-size: 110%;
        }
        30%
        {
            background-size: 210%;
        }
        60%
        {
            background-size: 150%;
        }
        70%{
            background-size: 190%;
        }
        100% {
            background-size: 110%;
        }
    }
    @-webkit-keyframes imgclick {
        0% {
            -webkit-transform: perspective(600px) rotateY(-0deg) scale(1);
            transform: perspective(600px) rotateY(-0deg) scale(1);

        }
        100% {
            -webkit-transform: perspective(600px) rotateY(-360deg) scale(3);
            transform: perspective(600px) rotateY(-360deg) scale(3);
        }
    }
    @keyframes imgclick {
        0% {
            -webkit-transform: perspective(600px) rotateY(-0deg) scale(1);
            transform: perspective(600px) rotateY(-0deg) scale(1);

        }
        100% {
            -webkit-transform: perspective(600px) rotateY(-360deg) scale(3);
            transform: perspective(600px) rotateY(-360deg) scale(3);
        }
    }


</style>
<script>

    <?php
if(isset($_SESSION['bar']))
{
    if($_SESSION['bar']==0)
    {
        echo "  barbtnclick('refresh');";
    }
}
?>


    function boxhover(val) {
        document.getElementById('vidname'+val).style.color="#C1A21B";
        document.getElementById('uploader'+val).style.color="#C1A21B";
    }
    function boxout(val) {
        document.getElementById('vidname'+val).style.color="black";
        document.getElementById('uploader'+val).style.color="black";
    }
    function clicked(val) {


        document.getElementById(val).style.animation = "imgclick 1.2s linear";
        document.getElementById(val).style.zIndex="200";



        setTimeout(function(){window.open('Playing video.php?watch='+val,'_self',false);},500);


    }

</script>

