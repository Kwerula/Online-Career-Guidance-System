<?php
include("dbconnection.php");
$_GET['q'] = "";

echo $_GET['q'];
?>

<select size=1 name="subjectid" >
 <option>Select</option>

 <?php
 if(isset($_GET['q']))
{
	$sql = mysqli_query($con,"SELECT * FROM subjects WHERE status='Enabled' and courseid='$_GET[q]'");
		if(!$sql)
		{
			echo mysqli_error($con);
		}
		else
		{
		?>
        <script type="application/javascript">
			alert("Subject Selected successfully...");
		</script>
		<?php 
        }			
}
 ?>
 <?php
	while($rs = mysqli_fetch_array($sql))
		{
			echo "<option value='$rs[subjectcode]'>$rs[subjectname]</option>";
			
		}
 ?>

 </select>