<?php
if(!isset($_SESSION)){
session_start();
}
?>
<script language="javascript">
function validate()
{
	if(document.trainingform.CompanyName.value=="Select")
	{
		alert("Please enter Company Name");
		return false;
	}
	
	else if(document.trainingform.trainingtype.value=="")
	{
		alert("Please enter training type ");
		document.trainingform.trainingtype.focus();
		return false;
	}
	else if(document.trainingform.Title.value=="")
	{
		alert("Please enter Training Title ");
		document.trainingform.Title.focus();
		return false;
	}
	else if(document.trainingform.Trainer.value=="")
	{
		alert("Please enter Trainer");
		document.trainingform.Trainer.focus();
		return false;
	}
	else if(document.trainingform.AboutTrainingProgram.value=="")
	{
		alert("Please enter AboutTrainingProgram ");
		document.trainingform.AboutTrainingProgram.focus();
		return false;
	}
	else if(document.trainingform.Date.value=="")
	{
		alert("Please enter Date ");
		document.trainingform.Date.focus();
		return false;
	}
	else if(document.trainingform.Time.value=="")
	{
		alert("Please enter Time ");
		document.trainingform.Time.focus();
		return false;
	}
	else if(document.trainingform.Venue.value=="")
	{
		alert("Please enter Venue ");
		document.trainingform.Venue.focus();
		return false;
	}
	else if(document.trainingform.Status.value=="Select")
	{
		alert("Please select Status ");
		document.trainingform.Status.focus();
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
$tpdepartments = "";
$sqrec['TPDepartments'] = "";
$isi = "";
$sqrec['CompanyId'] = "";
$recs['CompanyId'] = "";
$recs['CompanyName'] = "";
$sqrec['TrainingType'] = "";
$sqrec['Title'] = "";
$sqrec['TPInfo'] = "";
$sqrec['TPDatetime'] = "";
$sqrec['Venue'] = "";
$recs['CourseName'] = "";
$recs['coursename'] = "";
$sqrec['Status'] = "";
$val = "";
$i  ="";
$date = "";
$time = "";

$_POST['setid'] = "";
$_SESSION['setid'] = "";


if($_POST['setid']==$_SESSION['setid'])
{
	if(isset($_POST['Submit']))
{
	$chkvalues = "Null";
	$chkval = $_POST['departments'];
	for($i=0; $i < count($chkval); $i++)
	{
		$chkvalues = $chkvalues. ",".$chkval[$i];
	}

	
			$dt=$_POST['Date'] . " ". $_POST['Time'];
			if(isset($_GET['editid']))
			{
$sqlupd = "UPDATE trainingprogram SET CompanyId='$_POST[CompanyName]',TrainingType='$_POST[TrainingType]',Title='$_POST[Title]',TPInfo='$_POST[AboutTrainingProgram]',TPDatetime='$dt',Venue='$_POST[Venue]',TPDepartments='$chkvalues',Trainer='$_POST[Trainer]',Status='$_POST[Status]' WHERE TrainingId='$_GET[editid]'";
			
//	$sqlupd = "UPDATE trainingprogram SET TPDepartments='$chkvalues' WHERE TrainingId='$_GET[editid]";
				if(mysqli_affected_rows($con) == 1)
				{
					$qresulti =  1;
					echo "<font color='green'><h3>Record updated successfully...</h3></font>";
				}
				else
				{
					$qresulti =  1;
					echo  "<font color='red'><h3>No records found to update...</h3></font>";	
				}
			}
			else
			{	
			$sqlins = "INSERT into trainingprogram(CompanyId,TrainingType,Title,TPInfo,TPDatetime,Venue,TPDepartments,Trainer,Status)VALUES('$_POST[CompanyName]','$_POST[TrainingType]','$_POST[Title]','$_POST[AboutTrainingProgram]','$dt','$_POST[Venue]','$chkvalues','$_POST[Trainer]','$_POST[Status]')";
							if(!mysqli_query($con,$sqlins))
			{
				echo mysqli_error($con);
			}
			else
			{
?>
		<script>
		alert("Training Program details inserted successfully...");
		</script>
<?php 
					}
			}
}
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

$sql="SELECT * FROM trainingprogram";
$restraining=mysqli_query($con,$sql);

if(isset($_GET['editid']))
{
$sqlst = "SELECT * FROM trainingprogram WHERE TrainingId='$_GET[editid]'";
$sqquery = mysqli_query($con,$sqlst);
$sqrec = mysqli_fetch_array($sqquery);
}
$tpdepartments = explode(",",$sqrec['TPDepartments']);

$_SESSION['setid']=rand();
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
              	<h2>Add new training program</h2>
                <p><?php $qresult=""; echo $qresult ; ?></p>
            <p>
<form name="trainingform" action="" method="post"  onsubmit="return validate()" enctype="multipart/form-data">
<input type="hidden" name="setid" value="<?php echo $_SESSION['setid']; ?>" />
<table  class="tftable" width="599" border="1">
<?php
if($isi == 1)
{
echo "<tr><th height='33' colspan='2'>&nbsp;$isi</th></tr>"; 
}
?>
<tr><th width="207" height="33">CompanyName</th>
<td width="376">
<select name="CompanyName">
<option value="Select">Select</option>
<?php
$sqlselcourse = "select * from companies";
$sqlquerycourse = mysqli_query($con, $sqlselcourse);
while($recs = mysqli_fetch_array($sqlquerycourse))
{
	if($sqrec['CompanyId'] == $recs['CompanyId'] )
	{
	echo "<option value='$recs[CompanyId]' selected>$recs[CompanyName]</option>";
	}
	else
	{
	echo "<option value='$recs[CompanyId]'>$recs[CompanyName]</option>";
	}
}
?>
</select>
</td></tr>
<tr><th height="39">Training Type</th>
<td><input type="text" name="TrainingType" size="40" value="<?php echo $sqrec['TrainingType'];?>" ></td></tr>
<tr><th height="37">Title</th>
<td><input type="text" name="Title" size="40" value="<?php echo $sqrec['Title']; ?>">
</td></tr>
<tr>
  <th height="35">Trainer</th>
  <td><input type="text" name="Trainer" size="40" value="<?php $sqrec['Trainer']=""; echo $sqrec['Trainer']; ?>"></td>
</tr>
<tr><th height="82">About Training Program</th>
<td><textarea name="AboutTrainingProgram" rows="5" cols="35"><?php echo $sqrec['TPInfo'];?></textarea></td></tr>
<tr><th height="34">Date</th>
<?php
$date = date('Y-m-d', strtotime($sqrec['TPDatetime']));
$time = date('H:i:s', strtotime($sqrec['TPDatetime']));
?>
<td><input type="date" name="Date" size="30" value="<?php echo $date; ?>">
</td></tr>
<tr><th height="39">Time</th>
<td><input type="time" name="Time" size="30" value="<?php echo $time; ?>">
</td></tr>
<tr><th height="35">Venue</th>
<td><textarea name="Venue" cols="30"><?php echo $sqrec['Venue']; ?></textarea>
</td></tr>
<tr><th>Departments</th>
  <td>
<input type="checkbox" name="departments[]" value="All" > All Departments <br>
<?php

$sqlselcourse = "select * from course where status='Enabled'";
$sqlquerycourse = mysqli_query($con, $sqlselcourse);
while($recs = mysqli_fetch_array($sqlquerycourse))
{

			echo "<input type='checkbox' name='departments[]' value='$recs[CourseName]' ";
				for($i=0; $i<count($tpdepartments); $i++)
				{
					
					$recs['coursename']="";
					if($recs['coursename'] == "BCA")
					{
					echo " checked ";	
					goto a;
					}	
				}
				a:
			echo "> $recs[CourseName] <br>";
			
}

?>
</td></tr>
<tr><th height="32">Status</th>
  <td>
  <select name="Status">
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
<tr>
<td colspan="2" align="center"><input name="Submit" type="submit" value="Submit">
</td></tr></table>
</form>
</p>
          </div>
		  
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>