<?php
if(!isset($_SESSION)){
session_start(); // Developed by Amos Kwerula
$con=mysqli_connect("localhost","root","kwerula2015","chatloud");

$resultsender = "";
$resultprofileimg = "";
$senderid = "";
$rsmsgloop['senderid'] = strip_tags(@$_POST['profileid']);
$rsmsgloop['receiverid'] = "";
$_SESSION['profileid'] = "";
$sqlmsgloop = "";
$qmsgloop = "";
$rsmsgloop['senderid'] = "";
$rsprofileimg['imagepath'] = "";
$rssender['firstname'] = "";
$rssender['lastname'] = "";
$rsmsgloop['message'] = "";
$_SESSION['chat1']= strip_tags(@$_POST['senderid']);
$_SESSION['profileid']= strip_tags(@$_POST['receiverid']);
$_SESSION['profileid']= strip_tags(@$_POST['senderid']);
$_SESSION['chat1']= strip_tags(@$_POST['recieverid']);
$rssender['imgid']= strip_tags(@$_POST['imgid']);

//$sqlmsgloop = "SELECT * FROM  messages where ((senderid='12' and reciverid='21') OR (senderid='21' and reciverid='12')) ";
$sqlmsgloop = "SELECT * FROM  messages where (senderid='$_SESSION[chat1]' and receiverid='$_SESSION[profileid]') OR (senderid='$_SESSION[profileid]' and receiverid='$_SESSION[chat1]')";
$qmsgloop = mysqli_query($con,$sqlmsgloop);
if(!$sqlmsgloop)
{
mysqli_error($con);
mysqli_close($con);
}
}
?>
<div>
<li class='one_fifth'>
<?php
$rsmsgloop['senderid'] = "";
$_SESSION['profileid'] = "";
$rsmsgloop['receiverid'] = "";
$senderid = "";
$rsmsgloop['message'] = "";
	//senderid
	if($rsmsgloop['senderid'] == $_SESSION['profileid'])
	{
		$senderid = $rsmsgloop['receiverid'];
	}
	else
	{	
		$senderid = $rsmsgloop['senderid'];
	}
//senderid ends here

//Code to retrieve sender detail		
		$resultsender = mysqli_query($con, "SELECT * FROM profile WHERE profileid ='$rsmsgloop[senderid]' ")or die(mysqli_error($con));
		$rssender  = mysqli_fetch_array($resultsender);
//Code to rettrieve sender detail ends here

//Code to display profile image starts here
		$resultprofileimg = mysqli_query($con, "SELECT * FROM images WHERE imgid ='$rssender[imgid]' ")or die(mysqli_error($con));
		$rsprofileimg  = mysqli_fetch_array($resultprofileimg);
		
		if(mysqli_num_rows($resultprofileimg) == 0)
		{	   
			echo "<div class='one_fourth'><img src='images/profiledefault.jpg' width=10 height=10  class='icon-desktop icon-3x' ></div>";
		}
		else
		{
			echo "<div class='one_fourth'><img src='uploads/$rsprofileimg[imagepath]' width=10 height=10  class='icon-desktop icon-3x' ></div>";
		}
//Code to display profile image ends here
	
		echo "</li>
		<strong><font color='red'>$rssender[firstname] $rssender[lastname]</font></strong><br>
		<font color='black'>$rsmsgloop[message]</font> <hr>";
		 ?>
</div>


  