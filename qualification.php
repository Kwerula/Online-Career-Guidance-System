<?php
if(!isset($_SESSION)){
session_start();
}
?>
<script language="javascript">
function validate()
{
	if(document.quform.RegNo.value=="")
	{
		alert("Please enter registration number");
		document.quform.RegNo.focus();
		return false;
	}
	else if(document.quform.Qualification.value=="")
	{
		alert("Please enter Qualification");
		document.quform.Qualification.focus();
		return false;
	}
	else if(document.quform.YOP.value=="")
	{
		alert("Please enter Year of passing");
		document.quform.YOP.focus();
		return false;
	}
	else if(document.quform.BoardOfExamination.value=="")
	{
		alert("Please enter Board Of Examination");
		document.quform.BoardOfExamination.focus();
		return false;
	}
	else if(document.quform.AvgMarks.value=="")
	{
		alert("Please enter your Average Marks");
		document.quform.AvgMarks.focus();
		return false;
	}
	else if(document.quform.Status.value=="Select")
	{
		alert("Please enter Status");
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


$sqrec['Qualification']="";
$sqrec['YOP']="";
$sqrec['BoardOfExamination']="";
$sqrec['AvgMarks']="";
$_POST['setid'] ="";
$qrst = "";
$_SESSION['setid']="";



if($_POST['setid'] == $_SESSION['setid'])
{
	if(isset($_POST['Submit']))
	{
		if(isset($_GET['editid']))
		{
		$sqlupd = mysqli_query($con,"UPDATE qualification SET RegNo='$_POST[RegNo]', Qualification='$_POST[Qualification]',YOP='$_POST[YOP]',BoardOfExamination='$_POST[BoardOfExamination]',AvgMarks='$_POST[AvgMarks]'  WHERE QualId='$_GET[editid]'");
		if(!$sqlupd)
					{
					echo "<font color='red'><h3>Failed to update record in database...</h3></font>".mysqli_error($con);
					}
					else
					{
						echo "<font color='green'><h3><strong>Qualification record Updated successfully...</strong></h3></font>";
					}
		}
		else		
		{			
			$sqlins=mysqli_query($con,"INSERT into qualification(RegNo,Qualification,YOP,BoardOfExamination,AvgMarks)VALUES('$_SESSION[regno]','$_POST[Qualification]','$_POST[YOP]','$_POST[BoardOfExamination]','$_POST[AvgMarks]')");
							if(!$sqlins)
			{
				echo mysqli_error($con);
			}
			else
			{
?>
		<script>
		alert("Qualification inserted successfully...");
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
$sqldel = mysqli_query($con,"DELETE FROM qualification where QualId='$_GET[delid]'");
	if(!$sqldel)
	{
		echo "<font color='red'><h3>Failed to delete... Problem in sql query</h3></font>" . mysqli_error($con);
	}
	else
	{
		echo "<font color='green'><h3>Record deleted successfully...</h3></font>";
	}
}

$sql=mysqli_query($con,"SELECT * FROM qualification");

$_GET['editid'] = strip_tags(@$_POST['QualId']);
$sqlst = mysqli_query($con,"SELECT * FROM qualification WHERE QualId='$_GET[editid]'");
$sqrec = mysqli_fetch_array($sqlst);
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
              	<h2>Add Qualification</h2>
                <h5><?php  echo $qrst; ?></h5>
            <p>

<form name="quform" method="post" action="" onsubmit="return validate()">
<input type="hidden" name="setid" value="<?php echo $_SESSION['setid']; ?>" />
<table  class="tftable" width="576" height="234" border="1">
<tr>
<th width="199" height="38">&nbsp; Registration Number</th>
<td><input name="RegNo"  value="<?php echo $_SESSION['regno']; ?>"  >
</td></tr>
<tr>
  <th width="199" height="38">&nbsp; Qualification</th>
  <td width="361"><input name="Qualification" type="text"  value="<?php echo $sqrec['Qualification']; ?>" size="25">
</td></tr>
<tr>
<th height="33">&nbsp; Year Of Passing</th>
<td><input type="Date" name="YOP" value="<?php echo $sqrec['YOP']; ?>">
</td></tr>
<tr>
<th height="36">&nbsp; Board Of Examination</th>
<td><input type="text" name="BoardOfExamination" value="<?php echo $sqrec['BoardOfExamination']; ?>">
</td></tr>
<tr>
<th height="37">&nbsp; AvgMarks</th>
<td><input name="AvgMarks" type="text"  value="<?php echo $sqrec['AvgMarks']; ?>" >
</td></tr>
<tr>
<td height="39" colspan="2" align="center"><input name="Submit" type="submit" value="Submit">
</td></tr></table></form>
</p>
          </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>
