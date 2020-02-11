<?php
if(!isset($_SESSION)){
session_start();
}
?>
<script language="javascript">
function validate()
{
	if(document.empform.Name.value=="")
	{
		alert("Please enter Employee Name");
		document.empform.Name.focus();
		return false;
	}
	else if(document.empform.LoginType.value== "Select")
	{
		alert("Please Select Employee type");
		return false;
	}
	else if(document.empform.LoginID.value== "")
	{
		alert("Please enter Login id");
		document.empform.LoginID.focus();
		return false;
	}
		else if(document.empform.Password.value== "")
	{
		alert("Please enter Password");
		document.empform.Password.focus();
		return false;
	}
	else if(document.empform.Password.value != document.empform.COnfirmPassword.value)
	{
		alert("Password and confirm Password not matching");
		document.empform.Password.focus();
		return false;
	}
	else if(document.empform.Designation.value== "")
	{
		alert("Please enter designation");
		document.empform.Designation.focus();
		return false;
	}
	else if(document.empform.Status.value== "Select")
	{
		alert("Please select status");
		return false;
	}
	else
	{
		return true;
	}
	
}
</script>
<?php
include("dbconnection.php");

$msg = "";
$sqrec['empname'] = "";
$_SESSION['setid'] = "";
$res = "";
$sqrec['logintype'] = "";
$sqrec['loginid'] = "";
$sqrec['password'] = "";
$sqrec['status'] = "";
$val = "";
$sqrec['designation'] = "";
$sqrec['logintype']="";
$val ="";
$sqrec['status']="";
$val ="";
$_POST['setid'] = "";
$_SESSION['setid'] = "";


if($_POST['setid'] == $_SESSION['setid'])
{
if(isset($_POST['Submit']))
{
	
	if(isset($_GET['editid']))
	{
	$sqlupd = mysqli_query($con,"UPDATE employees SET empname='$_POST[Name]',logintype='$_POST[LoginType]',loginid='$_POST[LoginID]',password='$_POST[Password]',designation='$_POST[Designation]',status='$_POST[Status]' WHERE empid='$_GET[editid]'");
	if(mysqli_affected_rows($con) == 1)
				{
					$sqlupd =  1;
					echo "<font color='green'><h3>Record updated successfully...</h3></font>";
				}
				else
				{
					$sqlupd =  1;
					echo  "<font color='red'><h3>No records found to update...</h3></font>";	
				}
	}
	else
	{
	$sqlins=mysqli_query($con,"INSERT INTO employees(empname,logintype,loginid,password,designation,status)VALUES('$_POST[Name]','$_POST[LoginType]','$_POST[LoginID]','$_POST[Password]','$_POST[Designation]','$_POST[Status]')");	
						if(!$sqlins)
			{
				echo mysqli_error($con);
			}
			else
			{
?>
		<script>
		alert("Employee Record inserted successfully...");
		</script>
<?php 
		}
	}
}
}
$_SESSION['setid']=rand();

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
$sqldel = mysqli_query($con,"DELETE FROM employees where empid='$_GET[delid]'");
	if(!$sqldel)
	{
		echo "<font color='red'><h3>Failed to delete... Problem in sql query</h3></font>". mysqli_error($con);
	}
	else
	{
		echo "<font color='green'><h3>Record deleted successfully...</h3></font>";
	}
}
?>

<?php
$sql= mysqli_query($con,"SELECT * FROM employees");
if(isset($_GET['editid']))
{
$sqlst = mysqli_query($con,"SELECT * FROM employees WHERE empid='$_GET[editid]'");
$sqrec = mysqli_fetch_array($sqlst); 
}
?>


<?php
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <?php
  include("adminsidebar.php");
  ?>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>System Clerk</h2>
                <p><?php echo $res; ?></p>
                
<p><strong><?php $msg=""; echo $msg; ?></strong></p>
            <p>
<form name="empform" action="" method="post"  onsubmit="return validate()" enctype="multipart/form-data">
<input type="hidden" name="setid" value="<?php echo $_SESSION['setid']; ?>" />
<table  class="tftable" width="514" border="1">
<tr><th width="170" height="38">Name</th>
<td width="328">&nbsp;&nbsp;&nbsp;<input type="text" name="Name" size="30" value="<?php echo $sqrec['empname']; ?>" >
</td></tr>
<tr><th height="38">Login Type</th>
<td>&nbsp;&nbsp;&nbsp;<select name="LoginType" />
<?php

$arr = array("Select","System Clerk");
foreach($arr as $val)
{
	if($val == $sqrec['logintype'])
	{
	echo "<option value='$val' selected>$val</option>";
	}
	else
	{
	echo "<option value='$val'>$val</option>";
	}
}
?>
</select>
</td></tr>
<tr><th height="32">Login ID</th>
<td>&nbsp;&nbsp;&nbsp;<input type="text" name="LoginID" size="30" value="<?php  echo $sqrec['loginid']; ?>">
</td></tr>
<tr><th height="36">Password</th>
<td>&nbsp;&nbsp;&nbsp;<input type="password" name="Password" size="30" value="<?php echo $sqrec['password']; ?>">
</td></tr>
<tr><th height="35">Confirm Password</th>
<td>&nbsp;&nbsp;&nbsp;<input type="password" name="COnfirmPassword" size="30" value="<?php echo $sqrec['password']; ?>"></td></tr>
<tr><th height="38">Designation</th>
<td>&nbsp;&nbsp;&nbsp;<input type="text" name="Designation" size="30" value="<?php echo $sqrec['designation']; ?>">
</td></tr>
<tr><th height="34">Status</th>
<td>&nbsp;&nbsp;&nbsp;<select name="Status">
<?php


$arr = array("Select","Enabled","Disabled");
foreach($arr as $val)
{
	if($val == $sqrec['status'])
	{
	echo "<option value='$val' selected>$val</option>";
	}
	else
	{
	echo "<option value='$val'>$val</option>";
	}
}
?>
</select></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="Submit" value="Update Profile">
</td></tr></table></form>
</p>
          </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>
