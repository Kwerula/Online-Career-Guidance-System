<?php
if(!isset($_SESSION)){
session_start();
include("dbconnection.php");
}
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
$rs['AppId']= strip_tags(@$_POST['delid']);
$rs['JobId']= strip_tags(@$_POST['jobid']);
$rs['JobId'] = "";
$rs['Resume'] = "";
$rs['AppliedDate']= "";
$rs['CompanyName'] = "";
$rs['JobTitle'] = "";
$rs['InterviewDate'] = "";
$_SESSION['regno']= strip_tags(@$_POST['RegNo']);
$msg = "";

if(isset($_GET['delid']))
{
$sqldel = mysqli_query($con,"DELETE FROM applicationform where AppId='$_GET[delid]'");
	if(!$sqldel)
	{
		echo "Failed to delete... Problem in sql query". mysqli_error($con);
	}
	else
	{
		echo  "Record deleted successfully..";
	}
}
?>


<p><strong><?php $msg=""; echo $msg; ?></strong></p>

<?php
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <?php
  include("studentsidebar.php");
  ?>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>Applied job details</h2>
            <p>

<table  class="tftable" width="849" border="2">
<tr>
<th width="98">Job details</th>
<th width="179">Company Name</th>
<th width="155">Applied date</th>
<th width="104">Resume</th>
<th width="85">Action</th>
</tr>
<?php
$sql=mysqli_query($con,"SELECT applicationform.* , companies.* , jobs.* FROM applicationform INNER JOIN companies INNER JOIN jobs ON applicationform.JobId = jobs.JobId AND jobs.CompanyId = companies.CompanyId where RegNo='$_SESSION[regno]' and apptype='Job application'");
while($rs = mysqli_fetch_array($sql))
{
?>	
	 <tr>
    <td width="98"><strong>Job code: </strong><?php echo $rs['JobId']; ?><br> 
	<strong>Job Title: </strong><?php echo $rs['JobTitle']; ?><br> 
	<strong>Interview Date:</strong><?php  echo $rs['InterviewDate']; ?><br> 
	<a href="jobapplication.php?jobid=<?php  echo $rs['JobId']; ?>">View More</a>
	</td>
    <td width="179"><?php  echo $rs['CompanyName']; ?></td>
	<td width="155"><?php  echo $rs['AppliedDate']; ?></td>
	<td width="104"><a href="resume/<?php  echo $rs['Resume']; ?>">Download Resume</a></td>
	<td width="85"><a href="viewapplication.php?delid=<?php  echo $rs['AppId']; ?>" onclick='return ConfirmDelete()'>Delete</a></td>
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
	