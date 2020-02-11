<?php
include("dbconnection.php");
?>
<script>
    function ConfirmDelete()
	{
		var result = confirm("Are you sure want to Delete this Selected Candidate records?");
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
$sqldel = "DELETE FROM selectedCdatetraining where SCiid='$_GET[delid]'";
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
?>

<?php
$sql="SELECT selectedCdatetraining.*,students.*,trainingprogram.* FROM selectedCdatetraining INNER JOIN students INNER JOIN trainingprogram ON selectedCdatetraining.RegNo= students.RegNo AND trainingprogram.TrainingId = selectedCdatetraining.TrainingId";
$resselectedcandidate=mysqli_query($con,$sql);
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
              	<h2>View selected candidate</h2>
            <p>

<table  class='tftable' width="868" border="2">
<tr bgcolor="#CCCCCC">
<th width="289">Student details</th>
<th width="298">Training Program details</th>
<th width="191">Date</th>
<th width="60">Action</th>
</tr>

<?php
$rs['stimg'] = "";
$rs['RegNo'] = "";
$rs['FirstName'] = "";
$rs['LastName'] = "";
$rs['TrainingId'] = "";
$rs['Title'] = "";
$rs['SelectedDate'] = "";
$rs['JoiningDate'] = "";
$rs['SCiid']= strip_tags(@$_POST['delid']);

while($rs = mysqli_fetch_array($resselectedcandidate))
{
	echo "<tr>";
	echo "<td>";
	
	if($rs['stimg'] == "")
	{
	echo "<img src='images/noimage.jpg' width='60' height='60' class='img-responsive img-rounded img_bottom'>";		
	}
	else
	{
	echo "<img src='uploadedfiles/$rs[stimg]' width='60' height='60' class='img-responsive img-rounded img_bottom'>";
	}
	
	echo "<strong>Registration No.</strong> $rs[RegNo] <br>
	<strong>Student Name:</strong> $rs[FirstName] $rs[LastName]
	  
	</td>";
	echo "<td>
	<strong>Training Type:</strong> $rs[TrainingId]<br>
	<strong>Training Program:</strong> $rs[Title]<br>
	</td>";
	echo "<td>
	<strong>Selected Date:</strong> <br>$rs[SelectedDate]<br>
	<strong>Joining Date:</strong> <br>$rs[JoiningDate]</td>";
	echo "<td>
	<a href='viewselectedcandidateadmin.php?delid=$rs[SCiid]' onclick='return ConfirmDelete()'>Delete</a>";
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
