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
$sqldel = "DELETE FROM messages where msgid='$_GET[delid]'";
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

$sql="SELECT * FROM messages ";
$resmsg=mysqli_query($con,$sql);
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
              	<h2>View Questions/Inquiries</h2>
            <p>
<table  class="tftable" border="1">
<tr>
<th width="169">Name</th>
<th width="124">Email</th>
<th width="250">Subject</th>
<th width="350">Question/Inquiry</th>
<th width="100">Status</th>
<th width="169">Action</th>
</tr>
<?php
$rs['name'] = "";
$rs['email'] = "";
$rs['subject'] = "";
$rs['message'] = "";
$rs['status'] = "";
$rs['msgid']= strip_tags(@$_POST['delid']);
$rs['msgid']= strip_tags(@$_POST['editid']);

while($rs = mysqli_fetch_array($resmsg))
{
	echo "<tr>";
	echo "<td>$rs[name]</td>";
	echo "<td>$rs[email]</td>";
	echo "<td>$rs[subject]</td>";
	echo "<td>$rs[message]</td>";
	echo "<td>$rs[status]</td>";
	echo "<td><a href='viewmessage.php?delid=$rs[msgid]' onclick='return ConfirmDelete()'>Delete</a> | <a href='msgreply.php?editid=$rs[msgid]'>Reply</a>
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
	
	
