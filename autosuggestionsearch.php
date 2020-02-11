<?php
session_start(); // Developed by Amos Kwerula
$con=mysqli_connect("localhost","root","kwerula2015","chatloud");

 $_POST['searchword'] = "";
 $fname ="";
 $lname ="";
 $final_fname ="";
 $q ="";
 $row['firstname'] ="";
 $row['city'] ="";
 $city = "";
 $row['lastname'] ="";
 $row['0']="";
 $rsprofileimg['imagepath']="";
 
if($_POST)
{

$q=$_POST['searchword'];

$sql_res=mysqli_query($con,"SELECT * FROM profile WHERE firstname like '%$q%' or lastname like '%$q%' order by profileid LIMIT 5")or die(mysqli_error($con));
while($row=mysqli_fetch_array($sql_res))
{
$profileid = $row[0];	
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
<a href="#"  onclick="showUser(<?php $profileid=""; echo $profileid; ?>)">
<img src="<?php echo $img; ?>" style="width:25px; float:left; margin-right:6px" /><?php echo $final_fname; ?>&nbsp;<?php echo $final_lname; ?><br/>
<span style="font-size:9px; color:#999999"><?php echo $city; ?></span>
</a>
</div>



<?php
}

}
else
{

}


?>
