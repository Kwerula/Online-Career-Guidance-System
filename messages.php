<?php
session_start(); // Developed by Amos Kwerula
$con=mysqli_connect("localhost","root","kwerula2015","chatloud");

$arr = "";
$msg = "";
$sql = "";
$rsrec['status'] = "";
$rsrec['senderid'] = "";
$rsrec['receiverid'] = "";
$rsrec['message'] = "";
$arrcommentstatus  = "";
$rsrec['conversationdate'] = "";
$_POST['senderid']= strip_tags(@$_POST['senderid']);
$_POST['receiverid']= strip_tags(@$_POST['receiverid']);
$_POST['message']= strip_tags(@$_POST['message']);
$_POST['conversationdate']= strip_tags(@$_POST['conversationdate']);
$_POST['status']= strip_tags(@$_POST['status']);
$_POST['setid'] = "";
$_SESSION['setid'] = "";

if($_POST['setid']==$_SESSION['setid'])
{
	if (isset($_POST["submit"]))
	{
		
			
			$sql="INSERT INTO messages(senderid,receiverid,message,conversationdate,status)VALUES('$_POST[senderid]','$_POST[receiverid]','$_POST[message]','$_POST[conversationdate]','$_POST[status]')";
			if(!mysqli_query($con,$sql))
			{
				die('Error:'.mysqli_error($con));
			}
			else
			{
				$msg="1 record added";
			}
		}
	}
$_SESSION['setid']=rand();

?>
<?php
include("header.php");
?>
<!-- content -->
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <section class="clear">
      <h1>&nbsp;</h1>
      <p>

<form name="comment" method="post" action="">
  

    <input type="hidden" name="setid" value="<?php echo $_SESSION['setid']; ?>" />
   
<u> <h1><center> Messages<br><?php echo $msg; ?></center></h1></u>

      <br> Sender
      <input name="senderid" type="text" size=30 value="<?php echo $rsrec['senderid'] ; ?>" />
     <br> Receiver
      <input type="text" name="receiverid" value="<?php echo $rsrec['receiverid'] ; ?>" />
    
     <br> Message
      <input type="text" name="message" value="<?php echo $rsrec['message'] ; ?>" />
     
    <br>Conversationdate
	   <input type="date" name="conversationdate" value="<?php echo $rsrec['conversationdate'] ; ?>" /> 
     
    <br /> status:
     <?php
$arrcommentstatus = array("Enabled", "Disabled");
?>
        <select name="status">
          <?php
foreach($arrcommentstatus as $arr)
{
	if($arr == $rsrec['status'])
	{
	echo "<option value='$arr' selected>$arr</option>";
	}
	else
	{
	echo "<option value='$arr'>$arr</option>";
	}
}
?>
        </select>
   <br /> <input type="submit" name="submit" value="Submit " />
    
</form>
&nbsp;</p>
</section>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<!-- Footer -->
<?php
include("footer.php");
?>
