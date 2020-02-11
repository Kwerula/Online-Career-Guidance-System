<?php
if(!isset($_SESSION)){
session_start();
}
include("dbconnection.php");
?>

<script>
    function ConfirmDelete()
	{
		var result = confirm("Are you sure want to Delete this Qualification record?");
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
$sqldel = "DELETE FROM qualification where QualId='$_GET[delid]'";
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
?>

<?php
	$sql="SELECT * FROM qualification";	

$resqualification=mysqli_query($con,$sql);
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
              	<h2>View Qualification</h2>
            <p>

<table  class='tftable' border="2">
<tr>
<th>RegNo</th>
<th>Qualification</th>
<th>Year of passing</th>
<th>Board of examination</th>
<th>Average marks</th>
<th>Action</th>
</tr>
<?php
$rs['RegNo'] = "";
$rs['Qualification'] = "";
$rs['YOP'] = "";
$rs['BoardOfExamination'] = "";
$rs['AvgMarks'] = "";

while($rs = mysqli_fetch_array($resqualification))
{
	echo "<tr>";
	echo "<td>$rs[RegNo]</td>";
	echo "<td>$rs[Qualification]</td>";
	echo "<td>$rs[YOP]</td>";
	echo "<td>$rs[BoardOfExamination]</td>";
	echo "<td>$rs[AvgMarks]</td>";
	echo "<td><a href='viewqualification.php?delid=$rs[QualId]' onclick='return ConfirmDelete()'>Delete</a>
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


