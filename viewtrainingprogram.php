<?php
include("dbconnection.php");
?>

<script>
    function ConfirmDelete()
	{
		var result = confirm("Are you sure you want to Delete this training Program?");
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
$sqldel = "DELETE FROM trainingprogram where trainingId='$_GET[delid]'";
$resdel = mysqli_query($con,$sqldel);
	if(!$resdel)
	{
		echo "Failed to delete... Problem in sql query";
	}
	else
	{
		echo "Record deleted successfully..";
	}
}
 
$sql = "SELECT trainingprogram.*,companies.CompanyName FROM trainingprogram INNER JOIN companies ON trainingprogram.CompanyId=companies.CompanyId";
$restrainingprogram=mysqli_query($con,$sql);
?>

<p><strong><?php $msg =""; echo $msg; ?></strong></p>

<?php
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <?php
  include("adminsidebar.php");
  ?>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>View Training Program</h2>
<p>

<?php
$rs['Title'] = "";
$rs['TrainingType'] = "";
$rs['CompanyName'] = "";
$rs['TPDatetime'] = "";
$TPDepartments = "";
$rs['Trainer'] = "";
$rs['Status'] = "";

$rs['TrainingId']= strip_tags(@$_POST['delid']);
$_GET['TrainingId']= strip_tags(@$_POST['editid']);

while($rs = mysqli_fetch_array($restrainingprogram))
{
echo "<table  class='tftable' width='900' border='1'>";
		echo "<tr>";
		echo "<td valign='top'>
		<strong>Title</strong><br>$rs[Title]<br>
		<strong>Training type</strong><br>$rs[TrainingType]<br>
		<strong>Company</strong><br>$rs[CompanyName]<br></td>";
		echo "<td valign='top'><strong>Timings</strong><br>$rs[TPDatetime]<br>
		<strong>Venue</strong><br>$rs[Venue]</td>";
		$TPDepartments = str_replace('Null,','', $rs['TPDepartments']);
		echo "<td valign='top'><strong>Departments</strong><br>$TPDepartments</td>";
		echo "<td valign='top'><strong>Trainer</strong><br>$rs[Trainer]</td>";
		echo "<td valign='top'><strong>Status: </strong>$rs[Status]<br>
		<a href='viewtrainingprogram.php?delid=$rs[TrainingId]' onclick='return ConfirmDelete()'>Delete</a> <br> 
		<a href='trainingprogram.php?editid=$rs[TrainingId]'>Edit</a>
	</td>";
	   echo "</tr>";
		echo "<tr>";
	   echo "<td colspan='8'><strong>About Training Program:</strong><br>$rs[TPInfo]</td>";
	   echo "</tr>";
		echo "</table><hr>";
}
?>

</p>
          </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>