<?php
include("dbconnection.php");
?>

<script>
    function ConfirmDelete()
	{
		var result = confirm("Are you sure want to delete this record?");
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
$sqldel = mysqli_query($con,"DELETE FROM applicationform where AppId='$_GET[delid]'");
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
$sql=mysqli_query($con,"SELECT * FROM applicationform WHERE apptype='Job application'");

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
              	<h2>View Job applicants</h2>
            <p>

<table  class="tftable" border="2">
<tr>
<th>RegNo</th>
<th>Name</th>
<th>Job Details</th>
<th>Applied date</th>
<th>Resume</th>
<th>Message</th>
<th>Status</th>
<th>Action</th>
</tr>
<?php
$rs['RegNo'] = strip_tags(@$_POST['RegNo']);
$rs['JobId'] = strip_tags(@$_POST['JobId']);

while($rs = mysqli_fetch_array($sql))
{
	$sql1=mysqli_query($con,"SELECT * FROM students where RegNo='$rs[RegNo]'");
	$rs1 = mysqli_fetch_array($sql1);
	
	$sql2=mysqli_query($con,"SELECT * FROM jobs where JobId='$rs[JobId]'");
	$rs2 = mysqli_fetch_array($sql2);
	?>
	
	<tr>
    <td><?php $rs['Regno']=""; echo $rs['Regno'];?></td>
    <td><?php echo $rs1['FirstName']; ?> <?php echo $rs1['LastName']; ?></td>
    <td> Job Code: <?php  echo $rs2['JobId']; ?> <br>
	     Job Title: <?php echo $rs2['JobTitle']; ?></td>
    <td><?php echo $rs['AppliedDate'];?></td>
    <td><?php echo $rs['Resume']; ?></td>
	<td><?php echo $rs['message']; ?></td>
	<td><?php  echo $rs['Status']; ?></td>
    <td> 
    <a href="viewapplication.php?delid=<?php echo $rs['AppId']; ?>" onclick='return confirmDelete()'>Delete</a>
    </td>
  </tr>  
	<?php
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
	