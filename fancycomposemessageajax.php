<?php
session_start(); // Developed by Amos Kwerula
$con=mysqli_connect("localhost","root","kwerula2015","chatloud");

$_GET['q']= strip_tags(@$_POST['profileid']);
$profileid = "";
$fname ="";
$lname = "";
$rsprofileimg['imagepath'] ="";
$row['firstname'] = "";
$row['lastname'] = "";
$img = "";


$sql_res=mysqli_query($con,"select * from profile where profileid='$_GET[q]'")or die(mysqli_error($con));

while($row=mysqli_fetch_array($sql_res))
{
$profileid = $row['1'];	
$fname=$row['firstname'];
$lname=$row['lastname'];
//$img=$row['img'];
	
	$row['imgid'] = strip_tags(@$_POST['imgid']);
	//Coding to retrieve images
	$resultprofileimg = mysqli_query($con, "SELECT * FROM images WHERE imgid ='$row[imgid]' ")or die(mysqli_error($con));
	$rsprofileimg  = mysqli_fetch_array($resultprofileimg);
	if(mysqli_num_rows($resultprofileimg) == 0)
	{	   
		$img = "images/profilepic.jpg";
	}
	else
	{
		$img = "uploads/$rsprofileimg[imagepath]";
	}
	//Retrieve image code ends here

$city=$row['city'];

$re_fname='<b>'.$q.'</b>';
$re_lname='<b>'.$q.'</b>';

$final_fname = str_ireplace($q, $re_fname, $fname);

$final_lname = str_ireplace($q, $re_lname, $lname);


?>

<div class="display_box" align="left" >
<img src="<?php echo $img; ?>" style="width:25px; float:left; margin-right:6px" /><?php $final_fname=""; echo $final_fname; ?>&nbsp;<?php echo $final_lname; ?><br/>
<span style="font-size:9px; color:#999999"><?php echo $city; ?></span>
</div>

<input type="hidden" name="sendto" value="<?php $profileid= ""; echo $profileid; ?>">

<?php
}

?>
