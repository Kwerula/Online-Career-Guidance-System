<?php
if(!isset($_SESSION)){
session_start();
}
?>
<script language="javascript">
function validate()
{
	if(document.stdform.Course.value=="Select")
	{
		alert("Please enter Select a Course");
		return false;
	}
	else if(document.stdform.RegistrationNo.value=="")
	{
		alert("Please enter Registration number");
		document.stdform.RegistrationNo.focus();
		return false;
	}
	else if(document.stdform.FirstName.value=="")
	{
		alert("Please enter FirstName");
		document.stdform.FirstName.focus();
		return false;
	}
	else if(document.stdform.LastName.value=="")
	{
		alert("Please enter LastName");
		document.stdform.LastName.focus();
		return false;
	}	
	else if(document.stdform.stimg.value=="")
	{
		alert("Please enter an Image");
		document.stdform.stimg.focus();
		return false;
	}
	else if(document.stdform.DOB.value=="")
	{
		alert("Please enter DOB");
		document.stdform.DOB.focus();
		return false;
	}
	else if(document.stdform.Address.value=="")
	{
		alert("Please enter Address");
		document.stdform.Address.focus();
		return false;
	}
	else if(document.stdform.County.value=="")
	{
		alert("Please enter your County");
		document.stdform.County.focus();
		return false;
	}
	else if(document.stdform.Town.value=="Select")
	{
		alert("Please Select your Nearest Town");
		return false;
	
	}
	else if(document.stdform.EmailID.value=="")
	{
		alert("Please enter EmailID");
		document.stdform.EmailID.focus();
		return false;
	}
	else if(document.stdform.ContactNo.value=="")
	{
		alert("Please enter ContactNo");
		document.stdform.ContactNo.focus();
		return false;
	}
	else if(document.stdform.MobileNo.value=="")
	{
		alert("Please enter MobileNo");
		document.stdform.MobileNo.focus();
		return false;
	}
	else if(document.stdform.YearofJoin.value=="Select")
	{
		alert("Please Select your Year of Joining");
		return false;
	}
	else if(document.stdform.YearofPassing.value=="Select")
	{
		alert("Please Select your Year of Passing");
		return false;
	}
	else if(document.stdform.Status.value=="Select")
	{
		alert("Please Select Status");
		return false;
	}
	else
	{
		return true;
	}
}
	</script>
	</script>
 <?php
 include("dbconnection.php");
 
 $sqrec['FirstName']="";
 $sqrec['LastName']="";
 $_POST['setid']= "";
 $sqrec['stimg']="";
 $sqrec['DOB']="";
 $sqrec['Address']="";
 $sqrec['County']="";
 $sqrec['EmailId']="";
 $recs['CourseId'] ="";
$sqrec['CourseId']="";
 $sqrec['ContactNo']="";
 $sqrec['MobileNo']="";
 $sqrec['RegNo']="";
 $sqrec['stimg'] ="";
 $sqrec['Town']="";
$val ="";
$sqrec['YOJ']="";
$i ="";
$sqrec['YOP']="";
$i ="";
$sqrec['Status'] ="";
$val = "";
$_SESSION['setid'] = "";


if($_POST['setid']==$_SESSION['setid'])
{
if(isset($_POST['Submit']))
	{
	if($_FILES['profileimage']['name'] == "")
	{
		$filename = $_POST['oldprofileimage'];
	}
	else
	{
		$filename = rand(). $_FILES['profileimage']['name'];
		move_uploaded_file($_FILES['profileimage']['tmp_name'], "uploadedfiles/".$filename);
	}
		
		if(isset($_GET['editid']))
		{
		
		$sqlupd = mysqli_query($con,"UPDATE students SET Password='$_POST[Password]',CourseId='$_POST[Course]',FirstName='$_POST[FirstName]',LastName='$_POST[LastName]',stimg='$filename',DOB='$_POST[DOB]',Address='$_POST[Address]',County='$_POST[County]',Town='$_POST[Town]',Country='$_POST[Country]',EmailId='$_POST[EmailID]',ContactNo='$_POST[ContactNo]',MobileNo='$_POST[MobileNo]',YOP='$_POST[YearofPassing]',Status='$_POST[Status]' WHERE RegNo='$_GET[editid]'");
				if(mysqli_affected_rows($con) == 1)
				{
					$qresulti =  1;
					echo "<font color='green'>Record updated successfully..</font>";
				}
				else
				{
					$qresulti =  1;
					echo "<font color='red'>No records found to update</font>";	
				}
		}
		else
		{
		$sqlins= mysqli_query($con,"INSERT into students(RegNo,Password,CourseId,FirstName,LastName,stimg,DOB,Address,County,Town,Country,EmailId,ContactNo,MobileNo,YOJ,YOP,Status)VALUES('$_POST[RegistrationNo]','$_POST[Password]','$_POST[Course]','$_POST[FirstName]','$_POST[LastName]','$filename','$_POST[DOB]','$_POST[Address]','$_POST[County]','$_POST[Town]','$_POST[Country]','$_POST[EmailID]','$_POST[ContactNo]','$_POST[MobileNo]','','$_POST[YearofPassing]','$_POST[Status]')");
		
			if(!$sqlins)
			{
				echo "<font color='red'>Failed to insert record in database...</font>".mysqli_error($con);
			}
			else
			{
				echo "<font color='green'>Student record inserted successfully..</font>";
			}
		}
	}
}
?>


<?php 

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
$sqldel = mysqli_query($con,"DELETE FROM students where RegNo='$_GET[delid]'");
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
$sql= mysqli_query($con,"SELECT * FROM students");
if(isset($_GET['editid']))
{
$sqlst = mysqli_query($con,"SELECT * FROM students WHERE RegNo='$_GET[editid]'");
$sqrec = mysqli_fetch_array($sqlst);
}

$_SESSION['setid']=rand();
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
            <h2>Edit Students</h2>
			    <p><strong><?php $qresulti=""; echo $qresulti; ?></strong></p>
            <p>
<form name="stdform" action="" method="post"  onsubmit="return validate()" enctype="multipart/form-data">
<input type="hidden" name="setid" value="<?php echo $_SESSION['setid']; ?>" />
<table  class="tftable" width="534" height="650" border="1">
<tr><th width="179">Course</th>
<td width="339">
<select name="Course">
<option value="Select">Select</option>
<?php

$sqlselcourse = "select * from course";
$sqlquerycourse = mysqli_query($con, $sqlselcourse);
while($recs = mysqli_fetch_array($sqlquerycourse))
{
	if($recs['CourseId'] == $sqrec['CourseId'])
	{
	echo "<option value='$recs[CourseId]' selected>$recs[CourseName]</option>";
	}
	else
	{		
	echo "<option value='$recs[CourseId]'>$recs[CourseName]</option>";
	}
}
?>
</select></td></tr>
<tr><th>Registration No.</th>
<td><input type="text" name="RegistrationNo" size="30" value="<?php echo $sqrec['RegNo'] ?>" >
</td></tr>
<tr><th>First Name</th>
<td><input type="text" name="FirstName" size="30" value="<?php  echo $sqrec['FirstName']; ?>">
</td></tr>
<tr><th>Last Name</th>
<td><input type="text" name="LastName" size="30" value="<?php  echo $sqrec['LastName']; ?>">
</td></tr>
<tr>
  <th>Image</th>
  <td><input type="file" name="profileimage" size="30" value="<?php   echo $sqrec['stimg']; ?>"> 
          <input type="hidden" name="oldprofileimage" value="<?php echo $sqrec['stimg']; ?>" />
<?php 
 
if(isset($_GET['editid']))     
{ 
	if($sqrec['stimg'] == "")
	{
	echo "<img src='images/noimage.jpg' width='125' height='100'>";		
	}
	else
	{
	echo "<img src='uploadedfiles/$sqrec[stimg]' width='125' height='100'>";
	}
}
?>
  </td>
</tr>
<tr><th>DOB</th>
<td><input type="date" name="DOB" size="30" value="<?php  echo $sqrec['DOB']; ?>">
</td></tr>
<tr><th>Address</th>
<td><textarea  name="Address" rows="3" cols="35"/><?php  echo $sqrec['Address']; ?></textarea></td></tr>
<tr><th>County</th>
<td><input type="text" name="County" size="30" value="<?php  echo $sqrec['County']; ?>">
</td></tr>
<tr><th>Town</th>
<td><select name="Town">
<?php

$arr = array("Select your Nearest Town","Kisumu","Nairobi", "Eldoret", "Nakuru", "Naivasha", "Mombasa");
foreach($arr as $val)
{
	if($val == $sqrec['Town'])
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
<tr><th>Country</th>
<td><input type="text" name="Country" size="30" value="Kenya">
</td></tr>
<tr>
  <th>E_Mail ID</th>
<td><input type="text" name="EmailID" size="30" value="<?php  echo $sqrec['EmailId']; ?>">
</td></tr>
<tr><th>Contact No.</th>
<td><input type="text" name="ContactNo" size="30" value="<?php  echo $sqrec['ContactNo']; ?>">
</td></tr>
<tr><th>Mobile No.</th>
<td><input type="text" name="MobileNo" size="30" value="<?php  echo $sqrec['MobileNo']; ?>">
</td></tr>
<tr><th>Year of Joining</th>
<td>
<select name="YearofJoin">
<option>Select</option>
<?php

for($i=2000; $i<=date('Y'); $i++)
{
	if($i == $sqrec['YOJ'])
	{
	echo "<option value='$i' selected>$i</option>";
	}
	else
	{
	echo "<option value='$i'>$i</option>";
	}
}
?>
</select>

</td></tr>
<tr><th>Year of Passing</th>
<td>
<select name="YearofPassing">
<option>Select</option>
<?php

for($i=2000; $i<=date('Y'); $i++)
{
	if($i == $sqrec['YOP'])
	{
	echo "<option value='$i' selected>$i</option>";
	}
	else
	{
	echo "<option value='$i'>$i</option>";
	}
}
?>
</select>

</td></tr>
<?php
if(!isset($_SESSION['regno']))
{
?>
<tr><th>Status</th>
<td><select name="Status">
<?php

$arr = array("Select","Enabled","Disabled");
foreach($arr as $val)
{
	if($val == $sqrec['Status'])
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
<?php
}
?>

<tr>
  <td colspan="2" align="center"><input type="submit" name="Submit" value="Update Profile">
</td></tr></table></form>
</p>
          </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>