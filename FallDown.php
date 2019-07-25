<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            position: fixed;
        }

        .front {


            width: 240px;height: 130px;
            border-radius: 7px;
            display: inline-block;
            background: url(uploaded/55aa326d5f4a7.jpg) no-repeat center;
            background-size: 100%;
            transform: perspective(600px) rotateY(0deg) translateY(0px);
            transition: transform 1s linear 0s,border 1s linear;
            transition-timing-function:cubic-bezier(1.000, -0.230, 0.405, 5.425);

        }



        .front:hover {
            transform: perspective(600px) rotateY(-30deg);
        }

        @keyframes imgclick {
            0% {
                transform: perspective(600px) rotateY(-0deg) scale(1);

            }
            100% {

                transform: perspective(600px) rotateY(-360deg) scale(3);

            }
        }
        @keyframes falldown {
            0% {
                transform:rotate(-0deg) translate(0px,0px);

            }
            100% {

                transform:rotate(-30deg) translate(400px,80px);

            }
        }

    </style>
</head>
<body id="bodyid">

    <div id="1" onClick="clicked(this.id)"  class="front"></div>
    <div id="2" onClick="clicked(this.id)" class="front"></div>
    <div id="3" onClick="clicked(this.id)" class="front"></div>
<br>
<input type="button" onclick="clicked(this.id)" value="Click Me" style="margin-top: 400px;margin-left: 400px;" />
</body>
</html>

<script>
    function clicked(val) {

              //document.getElementById("1").style.animation = "falldown 1.2s linear";
      /*        document.getElementById("1").style.transform = "perspective(600px) rotateY(30deg) translateY(800px)";
        setTimeout(function(){
            document.getElementById("2").style.transform = "perspective(600px) rotateY(30deg) translateY(800px)";
        },50);
        setTimeout(function(){
            document.getElementById("3").style.transform = "perspective(600px) rotateY(30deg) translateY(800px)";
        },100);
*/
        document.getElementById("3").style.transform = "perspective(600px) rotateY(30deg) translateY(800px)";

        //      document.getElementById(val).style.animation = "imgclick 1.2s linear";
    //	document.getElementById(val).className="frontclicked";alert();
    //document.getElementById(val).style.position = "reletive";
    //setTimeout(function(){window.open('Playing video.php?watch=55a3909e09f8d','_self',false);},700);
    }
</script>
