<?php
if(!isset($_SESSION)){
session_start();
}
include("dbconnection.php");
?>

<script>
    function ConfirmDelete()
	{
		var result = confirm("Are you sure you want to Delete this Testimony?");
		if (result==true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
</script>

<?php

if(isset($_GET['delid']))
{
$sqldel = "DELETE FROM testimonies where testimoniesid='$_GET[delid]'";
$resdel = mysqli_query($con,$sqldel);
	if(!$sqldel)
	{
		echo "Failed to delete... Problem in sql query". mysqli_error($con);
	}
	else
	{
		echo "Testimonies deleted successfully..";
	}
}

$sql="SELECT * FROM testimonials";
$restestimonials=mysqli_query($con,$sql);
?>

<p><strong><?php $msg=""; echo $msg; ?></strong></p>


<?php
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <?php
  include("adminsidebar.php");
  ?>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>View Testimonies</h2>
            <p>
<table  class="tftable" border="1">
<tr>
<th width="169">Name</th>
<th width="124">Profession Title</th>
<th width="179">Phone Contact</th>
<th width="180">Email</th>
<th width="180">Testimonial Title</th>
<th width="330">Testimonial Subject</th>
<th width="176">Status</th>
<th width="150">Action</th>
</tr>
<?php
$rs['name'] = "";
$rs['title'] = "";
$rs['phone'] = "";
$rs['email'] = "";
$rs["testimonialtitle"]="";
$rs["testimonialtext"]="";
$rs['status'] = "";
$rs['testimoniesid']= strip_tags(@$_POST['delid']);

while($rs = mysqli_fetch_array($restestimonials))
{
	echo "<tr>";
	echo "<td>$rs[name]</td>";
	echo "<td>$rs[title]</td>";
	echo "<td>$rs[phone]</td>";
	echo "<td>$rs[email]</td>";
	echo "<td>$rs[testimonialtitle]</td>";
	echo "<td>$rs[testimonialtext]</td>";
	echo "<td>$rs[status]</td>";
	echo "<td><a href='viewtestimonies.php?delid=$rs[testimoniesid]' onclick='return ConfirmDelete()'>Delete</a>
	</td>";
	echo "</tr>";
}
?>
</table>
	
</p>
          </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>
	
	
