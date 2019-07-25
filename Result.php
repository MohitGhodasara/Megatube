<?php
require("Connection.php");
//require("find.php");
require("NavigationBar.php");
if(isset($_POST["q"]))
{
	$q=$_POST["q"];
}
else
{
	die();
}
?>
<html>
<head>
</head>
<body>
<div class="container" >

	<div class="left"></div>
	<div class="mid">
    <button id="filtersbtn" class="btnstyle" onClick="hideshowilters()" >Filters</button>
	   	<div id="filters" class="filters" style="display:none" >
        <table border="0" align="center"  cellpadding="0" cellspacing="0" style="padding-top:25px;">
        <tr>
            <td class="td"><h5 style="padding-bottom:10px;font-size:16px"><a onClick="" id="" class="" >Upload date</a></h5></td>
            <td class="td"><h5 style="padding-bottom:10px;font-size:16px"><a onClick="" id="" class="" >Category</a></h5></td>
            <td class="td"><h5 style="padding-bottom:10px;font-size:16px"s><a onClick="" id="" class="" >Short by</a></h5></td>
        </tr>
        <tr>
            <td class="td"><h5><a onClick="findresult(this.id)" id="hour" class="" >Last hour</a></h5></td>
            <td class="td"><h5><a onClick="findresult(this.id)" id="video" class="" >Video</a></h5></td>
            <td class="td"><h5><a onClick="findresult(this.id)" id="upload" class="" >Upload date</a></h5></td>
          
        </tr>
        
		<tr>
            <td class="td"><h5><a onClick="findresult(this.id)" id="today" class="" >Today</a></h5></td>
            <td class="td"><h5><a onClick="findresult(this.id)" id="movie" class="" >Movie</a></h5></td>
            <td class="td"><h5><a onClick="findresult(this.id)" id="view" class="" >View count</a></h5></td>
           
        </tr>
        
        <tr>
            <td class="td"><h5><a onClick="findresult(this.id)" id="week" class="" >This week</a></h5></td>
            <td class="td"><h5><a onClick="findresult(this.id)" id="show" class="" >Show</a></h5></td>
            <td class="td"><h5><a onClick="findresult(this.id)" id="rating" class="" >Rating</a></h5></td>
  
        </tr>
        
	    <tr>
            <td class="td"><h5><a onClick="findresult(this.id)" id="month" class="" >This month</a></h5></td>
            <td class="td"></td>
            <td class="td"><h5><a onClick="findresult(this.id)" id="relevance" class="" >Relevance</a></h5></td>
     
        </tr>
        
		<tr>
            <td class="td"><h5><a onClick="findresult(this.id)" id="year" class="" >This year</a></h5></td>
         
        </tr>
        </table>
        <div id="resultdiv">
        </div>

	    </div>
        <span id="results" ></span>
        
    </div>
	<div class="right"></div>

</div>

</body>
</html>
<script>
function hideshowilters()
{

		if(document.getElementById("filters").className=='filters')
		{
     			document.getElementById("filters").className="filtersshow";
				document.getElementById("filters").style="";
		}
		else
		{
				document.getElementById("filters").className="filters";
				/* setTimeout(function (){
					document.getElementById("filters").style="display:none";
					},500); */

		}
}

var q = '<?php echo $q; ?>';
var short='';
findresult();
function findresult(filter)
{

	if(filter=='upload')
	{
		short='upload';
	}
	else if (filter=='view')
	{
		short='view';
	}
	else if (filter=='rating')
	{
		short='rating';	
	}
	else if (filter=='relevance')
	{
		short='relevance';
	}
var xmlhttp;
	if (q.length==0 || q ==' ')
	{ 
		  document.getElementById("txtHint").innerHTML="";
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
			    document.getElementById("results").innerHTML=xmlhttp.responseText;
	
		  }
	}
		xmlhttp.open("GET","FixSearch.php?filter="+filter+"&q="+q+"&short="+short,true);
		
	xmlhttp.send();
}
</script>

<style>
h5
    {   	
		margin:3px;
		padding-left:25px;
		padding-right:25px;
    }
.td
{
	padding-right:30px;
	padding-left:30px;
}

.filters
{

	animation: hidefilter 1s;
	overflow:hidden;
	width:100%;
	height:0.1px;
	background-color: #ecf0f1;
	border-radius: 8px;

}
.filtersshow
{ 
	animation: showfilter 1s;
	width:100%;
	height:200px;
	background-color: #ecf0f1;
	border-radius: 8px;
	overflow:hidden;
	
}
.btnstyle{
  background:#2b303b;             /*  #1abc9c loin button  */
  color: #C1A21B;
  padding: 10px;
  font-size: 20px;
  display: block;
  width: 100%;
  border: none;

  border-radius: 5px;
  margin-top:20px;
}

/* #ecf0f1; */
@keyframes hidefilter {
    from 
	{

		width:100%;
	height:200px;
    background-color:#ecf0f1;


    }
    to {	
		width:100%;
		height:0.1px;
		background-color: #666666;

    }
}

@keyframes showfilter {
    from 
	{
		width:100%;
		height:0px;
		background-color: #666666;

    }
    to {	
	width:100%;
	height:200px;
	background-color:#ecf0f1;
	
    }
}

/* body
{
  margin:0;	
} */
.container 
{
	
      width:100%;
	  height:100%;
}
.left 
{
      width:25%;
      float:left;
	  	  height:1%;

}
.mid
{
	      width:50%;
      float:left;
	  	  height:1%;

	
}
.right 
{
      width:25%;
      float:right;
	  	  height:1%;


}
</style>