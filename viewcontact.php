<?php
if(!isset($_SESSION)){
session_start();
}
include("dbconnection.php");
?>

<script>
    function ConfirmDelete()
	{
		var result = confirm("Are you sure you want to Delete this Contact information?");
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
$sqldel = "DELETE FROM contact where contactid='$_GET[delid]'";
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

$sql="SELECT * FROM contact";
$rescontact=mysqli_query($con,$sql);
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
              	<h2>View Inquiries</h2>
            <p>
<table  class="tftable" border="1">
<tr>
<th width="169">Inquirer's Name</th>
<th width="124">Email</th>
<th width="179">Subject</th>
<th width="229">Message</th>
<th width="176">Status</th>
<th width="150">Action</th>
</tr>
<?php
$rs['name'] = "";
$rs['email'] = "";
$rs['subject'] = "";
$rs['message'] = "";
$rs['status'] = "";
$rs['contactid']= strip_tags(@$_POST['delid']);
$rs['contactid']= strip_tags(@$_POST['editid']);

while($rs = mysqli_fetch_array($rescontact))
{
	echo "<tr>";
	echo "<td>$rs[name]</td>";
	echo "<td>$rs[email]</td>";
	echo "<td>$rs[subject]</td>";
	echo "<td>$rs[message]</td>";
	echo "<td>$rs[status]</td>";
	echo "<td><a href='viewcontact.php?delid=$rs[contactid]' onclick='return ConfirmDelete()'>Delete</a> | <a href='contactreply.php?editid=$rs[contactid]'>Reply</a>
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
	
	
