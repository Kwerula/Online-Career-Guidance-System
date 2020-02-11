<?php
if(!isset($_SESSION)){
session_start();
}
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
		echo "Failed to delete... Problem in sql query" . mysqli_error($con);
	}
	else
	{
		echo "Record deleted successfully..";
	}
}
?>


<p><strong><?php $msg = ""; echo $msg; ?></strong></p>

<?php
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <?php
  include("studentsidebar.php");
  ?>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>Training program details</h2>
            <p>

<table  class="tftable" width="849" border="2">
<tr>
<th width="98">Training program details</th>
<th width="179">Company Name</th>
<th width="155">Applied date</th>
<th width="104">Message</th>
<th width="85">Action</th>
</tr>
<?php

$sql=mysqli_query($con,"SELECT    companies.*, applicationform.*, trainingprogram.*, applicationform.RegNo AS Expr1, applicationform.apptype AS Expr2 FROM companies INNER JOIN trainingprogram ON companies.CompanyId = trainingprogram.CompanyId RIGHT OUTER JOIN applicationform ON trainingprogram.TrainingId = applicationform.JobId where applicationform.RegNo ='$_SESSION[regno]' AND applicationform.apptype ='Training program' ");
while($rs = mysqli_fetch_array($sql))
{
?>
	
	<tr>
    <td>
	<strong>Training type: </strong> <?php $rs['TrainingType']="";  echo $rs['TrainingType']; ?><br>
	<strong>Title: </strong> <?php $rs['Title']=""; echo $rs['Title']; ?><br>
	<strong>Venue: </strong> <?php $rs['Venue']=""; echo $rs['Venue']; ?><br>
	<a href="trainingmoredetails.php?trainingid=<?php $rs['JobId']="";  echo $rs['JobId']; ?>">View More</a>
	 </td>
    <td><?php $rs['CompanyName']="";  echo $rs['CompanyName']; ?></td>
    <td><?php $rs['AppliedDate']="";  echo $rs['AppliedDate']; ?> </td>
	<td><?php $rs['Message']="";  echo $rs['Message']; ?> </td>
	<td>
    <a href="viewapplication.php?delid=<?php $rs['AppId']="";  echo $rs['AppId']; ?>" onclick='return ConfirmDelete()'>Delete</a>
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
	