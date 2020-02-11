<?php
$con=mysqli_connect("localhost","root","kwerula2015","careerguidance");



if(isset($_POST['submit']))
{
	$result = mysqli_query($con,"INSERT INTO messages (RegNo,logintype,message,status)values('$_POST[RegistrationNo]','Counsellor','$_POST[msg]','unread')");
	if(!$result)
			{
				echo mysqli_error($con);
			}
			else
			{
?>
<script>
		alert("Message Sent Successfully");
		</script>

<?php
}
}
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <?php
  include("adminsidebar.php");
  ?>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
<?php 
if(isset($_GET['rec']))
{	$q=0;
	$mes = mysqli_query($con, "SELECT * FROM messages WHERE (RegNo='$_POST[RegistrationNo]' and logintype='Counsellor') or (RegNo='$_POST[RegistrationNo]' and logintype='Counsellor')")or die(mysqli_error($con));
	while($rs=mysqli_fetch_array($mes))
	{
		$pro = mysqli_query($con, "Select * from students where  RegNo='$_POST[RegistrationNo]'")or die(mysqli_error($con));
		$r=mysqli_fetch_array($pro);
		if($q!=$rs['RegNo'])
		{ 
		echo "<hr color='#E8C57B'>";
		echo "<b> $rs[firstname]</b>"."<br>";
		}
		if($rs['status']=='unread')
		{
		echo "<b><font color='#0000FF'>&nbsp;&nbsp;&nbsp;".$rs['message']."</font></b>"."<br>";
		}
		else
		{
			echo "&nbsp;&nbsp;&nbsp;$rs[message]<br>";
		}
		mysqli_query($con,"UPDATE messages SET status='read' WHERE msgid='$rs[msgid]'");
		$q=$rs['RegNo'];
	}
} 
?>
</font>
<form name="reply" action="" method="post">
<textarea name="reply" cols="50"></textarea>
<input type="submit" name="submit" value="Reply">
</form>
    <!-- ################################################################################################ -->
  </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
    <!-- Footer -->
<?php
include("footer.php");
?>
