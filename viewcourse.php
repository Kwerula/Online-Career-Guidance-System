<?php
if(!isset($_SESSION)){
session_start();
}
include("dbconnection.php");
?>

<script>
    function ConfirmDelete()
	{
		var result = confirm("Are you sure you want to Delete this Course?");
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
$sqldel = "DELETE FROM course where CourseId='$_GET[delid]'";
$resdel = mysqli_query($con,$sqldel);
	if(!$sqldel)
	{
		echo "Failed to delete... Problem in sql query". mysqli_error($con);
	}
	else
	{
		echo "Record deleted successfully..";
	}
}

$sql="SELECT * FROM course";
$rescourse=mysqli_query($con,$sql);
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
              	<h2>View Course</h2>
            <p>
<table  class="tftable" border="1">
<tr>
<th width="169">Course</th>
<th width="124">Course Code</th>
<th width="229">Comment</th>
<th width="171">Status</th>
<th width="169">Action</th>
</tr>
<?php
$rs['CourseName'] = "";
$rs['coursecode'] = "";
$rs['Comment'] = "";
$rs['status'] = "";
$rs['CourseId']= strip_tags(@$_POST['delid']);
$rs['CourseId']= strip_tags(@$_POST['editid']);

while($rs = mysqli_fetch_array($rescourse))
{
	echo "<tr>";
	echo "<td>$rs[CourseName]</td>";
	echo "<td>$rs[coursecode]</td>";
	echo "<td>$rs[Comment]</td>";
	echo "<td>$rs[status]</td>";
	echo "<td><a href='viewcourse.php?delid=$rs[CourseId]' onclick='return ConfirmDelete()'>Delete</a> | <a href='course.php?editid=$rs[CourseId]'>Edit</a>
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
	
	
