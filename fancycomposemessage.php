<?php
session_start(); // Developed by Amos Kwerula
$con=mysqli_connect("localhost","root","kwerula2015","chatloud");
include("autosuggestion.php");

$_SESSION['setid']  = rand();
?>
<link href="layout/styles/main.css" rel="stylesheet" type="text/css" media="all">
<link href="layout/styles/mediaqueries.css" rel="stylesheet" type="text/css" media="all">
<link href="layout/scripts/responsiveslides.js-v1.53/responsiveslides.css" rel="stylesheet" type="text/css" media="all">
<div id="respond">
          <h2>Compose Message</h2>
          
<form class="rnd5" action="viewmessage.php" method="post">
 <input type="hidden" name="setid" value="<?php echo $_SESSION['setid']; ?>" />

<div class="form-input clear">
<label class="one_half first" for="author">Send to </label><br>
<div style=" width:300px; " >

<div id="txtHint">
<input type="text" class="search" id="searchbox" /><br />
<div id="display">
</div>
</div>

</div>



              
       
            </div>
            <div class="form-message">
              <textarea name="msg" id="msg" cols="45" rows="10"></textarea>
            </div>
            <p>
              <input type="submit" value="Submit" name="submit">
              &nbsp;
              <input type="reset" value="Reset">
            </p>
          </form>
        </div>
        
<script>
function showUser(str)
{
if (str=="")
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
xmlhttp.open("GET","fancycomposemessageajax.php?q="+str,true);
xmlhttp.send();
}
</script>