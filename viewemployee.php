<?php
if(!isset($_SESSION)){
session_start();
}
include("dbconnection.php");
?>

<script>
    function ConfirmDelete()
	{
		var result = confirm("Are you sure want to Delete this Employee's Record?");
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
$sqldel = "DELETE FROM employees where empid='$_GET[delid]'";
$resdel = mysqli_query($con,$sqldel);
	if(!$resdel)
	{
		echo "Failed to delete... Problem in sql query". mysqli_error($con);
	}
	else
	{
		echo  "Record deleted successfully..";
	}
}

$sql="SELECT * FROM employees";
$resemployee=mysqli_query($con,$sql);
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
              	<h2>View Employee</h2>
            <p>

<table  class="tftable" width="871" border="2">
<tr>
<th width="67">Name</th>
<th width="127">Login Type</th>
<th width="93">Login Id</th>
<th width="137">Designation</th>
<th width="121">Last Login</th>
<th width="74">Status</th>
<th width="96">Action</th>
</tr>
<?php
$rs['empname'] = "";
$rs['logintype'] = "";
$rs['loginid'] = "";
$rs['designation'] = "";
$rs['lastlogin'] = "";
$rs['status'] = "";
$rs['empid']= strip_tags(@$_POST['delid']);
$rs['empid']= strip_tags(@$_POST['editid']);

while($rs = mysqli_fetch_array($resemployee))
{
	echo "<tr>";
	echo "<td>$rs[empname]</td>";
	echo "<td>$rs[logintype]</td>";
	echo "<td>$rs[loginid]</td>";
	echo "<td>$rs[designation]</td>";
	echo "<td>$rs[lastlogin]</td>";
	echo "<td>$rs[status]</td>";
	echo "<td>
	<a href='viewemployee.php?delid=$rs[empid]' onclick='return ConfirmDelete()'>Delete</a> | <a href='Employees.php?editid=$rs[empid]'>Edit</a>
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