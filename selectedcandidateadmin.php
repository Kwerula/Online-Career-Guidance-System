<?php
if(!isset($_SESSION)){
session_start();
}
include("dbconnection.php");
?>
<script language="javascript">
function validate()
{
	if(document.scform.Company.value=="Select")
	{
		alert("Please Select a Company");
		return false;
	}
	else if(document.scform.trainingid.value=="Select")
	{
		alert("Please Select a Training Program details");
		return false;
	}
	else if(document.scform.stregno.value=="")
	{
		alert("Please enter student registration number");
		document.scform.stregno.focus();
		return false;
	}
	else if(document.scform.Selecteddate.value=="")
	{
		alert("Please enter Selected date");
		document.scform.Selecteddate.focus();
		return false;
	}
	else if(document.scform.Joiningdate.value=="")
	{
		alert("Please enter Joining date");
		document.scform.Joiningdate.focus();
		return false;
	}
	else if(document.scform.Status.value=="select")
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
<?php
$msg = "";
$_POST['setid'] = "";
$_SESSION['setid'] = "";
$recs['CompanyId'] = "";
$recs['CompanyName'] = "";
$sqrec['CompanyId'] = "";
$recs['JobTitle'] = "";
$recs['JobId']= strip_tags(@$_POST['value']);
$recs['JobId'] = "";

if($_POST['setid'] == $_SESSION['setid'])
{
if(isset($_POST['Submit']))
{
	$sqlins=mysqli_query($con,"INSERT into selectedCdatetraining(RegNo,TrainingId,SelectedDate,JoiningDate)VALUES('$_POST[stregno]','$_POST[trainingid]','$_POST[Selecteddate]','$_POST[Joiningdate]')");

			if(!$sqlins)
			{
				echo "<font color='red'><strong>Failed to insert record into the database...</strong></font>";
			}
			else
			{
				echo "<font color='green'><strong>Selected Candidate record inserted successfully..</strong></font>";
			}
	}
	
$sql=mysqli_query($con,"SELECT * FROM selectedCdatetraining");


}
$_SESSION['setid']=rand();

?>
 
 <p><strong><?php $msg=""; echo $msg; ?></strong></p>
 
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
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->

      	  <?php
  include("adminsidebar.php");
  ?>
      	  <div class="col-xs-12 col-sm-6 col-lg-8">
           	<h2>Add Selected Training Candidate</h2>
                             <p><strong><?php
							 $qresult = "";
							  echo $qresult; ?></strong></p>
            

<form  name="scform" action="" method="post" onSubmit="return validate()">
<input type="hidden" name="setid" value="<?php echo $_SESSION['setid']; ?>" />
<table  class="tftable" width="576" height="371" border="1">
<tr>
<th width="222">Company</th>
<td width="338">
<select name="Company">
<option value="Select">Select</option>
<?php
$sqrec['CompanyId']="";
$recs['CompanyId'] ="";
$sqlselcourse = mysqli_query($con,"select * from companies");
while($recs = mysqli_fetch_array($sqlselcourse))
{
	if($recs['CompanyId'] == $sqrec['CompanyId'])
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
<tr><th>Training Program Details</th>
  <td>
  <select name="trainingid">
  <option value="Select">Select</option>
  <?php
$sqlselcourse = mysqli_query($con,"select * from trainingprogram");
while($recs = mysqli_fetch_array($sqlselcourse))
{
	echo "<option value='$recs[TrainingId]'>Training Type-$recs[TrainingId] : $recs[Title]</option>";
}
?>
  </select>
</td></tr>
<tr><th>Student Registration No.</th>
  <td><label for="stregno"></label>
    <input name="stregno" type="text" id="stregno" size="35"></td></tr>
<tr><th>Selecteddate</th>
<td><input type="date" name="Selecteddate" size="30" />
</td></tr>
<tr><th>Joiningdate</th>
  <td><input type="date" name="Joiningdate" size="30" />
</td></tr>
<tr>
  <td colspan="2" align="center"><input name="Submit" type="submit" value="Submit">
</td></tr></table></form>

          </div>
            
     	</div> <!-- /row 1 --><!-- /row 2 -->
<?php 
include("footer.php");
?>
