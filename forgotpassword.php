<?php
include("dbconnection.php");
?>
<script language="javascript">
function validate()
{
	else if(document.stdform.regno.value=="")
	{
		alert("Please enter Registration Number");
		document.stdform.regno.focus();
		return false;
	}
	else if(document.stdform.NewPassword.value=="")
	{
		alert("Please enter Your New Password");
		document.stdform.NewPassword.focus();
		return false;
	}
	else if(document.stdform.NewPassword.value != document.stdform.ConfirmPassword.value)
	{
		alert("Your New Password and Confirm Password not matching");
		document.stdform.NewPassword.value ="";
		document.stdform.ConfirmPassword.value ="";
		document.stdform.NewPassword.focus();
		return false;
	}
	else if(document.stdform.emailid.value=="")
	{
		alert("Please enter your Correct Emailid");
		document.stdform.emailid.focus();
		return false;
	}
}
	</script>
<?php
if(isset($_POST["Changepassword"]))
{

	$sqllogin = mysqli_query($con,"UPDATE students SET password='$_POST[NewPassword]' WHERE EmailId='$_POST[emailid]' ")or die(mysqli_error($con));
	if(!$sqllogin)
	{
				echo "<br><font color='red'>Failed to login... Please try Again</font>";
		
	}
	else
	{
	echo "<br>Password Updated successfully... Use your New Password to Login into your Account";		
	}
}
?>
 <?php
 
include("header.php");
 
  ?>          
      	
              	<h2>Forgot your Password</h2>
		<p><font color='blue'>Please enter Registration No, Email ID and New Password </font></p>
            
      <form method="post" name="stdform" action="" onSubmit="return validate()">
	 
	  <div class="row space30"> <!-- row 1 begins -->
      
  <div class="col-xs-12 col-sm-6 col-lg-8">
  <div class="form-group">
 
<table  class="tftable" width="424" height="142" border="2">
<tr>
<th>Registration No.:</th>
<td>&nbsp;&nbsp;<input type="text" name="regno" class="form-group" size="30" id="regno" placeholder="Enter register number" /> </td>
</tr>
<tr>
<th>Email ID:</th>
<td>&nbsp;&nbsp;<input type="text" name="emailid" size="30" class="form-group" id="emailid" placeholder="Enter Email ID" /></td>
</tr>
<tr><th>New Password:</th>
<td>&nbsp;&nbsp;<input type="password" name="NewPassword"  id="Newpassword" class="form-group" size="30" placeholder="Enter New password">
</td></tr>
<tr><th>Confirm Password:</th>
<td>&nbsp;&nbsp;<input type="password" name="ConfirmPassword" id="Confirmpassword" class="form-group" size="30" placeholder="Confirm New Password">
</td></tr>
<tr>
<td colspan="2" align="center"><input name="Changepassword" type="submit"  value="Change Password" ></td>
</tr></table>
      </div>    
            
     	
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>

