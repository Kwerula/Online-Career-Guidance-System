<?php
if(!isset($_SESSION)){
session_start();
}
include("header.php");
include("dbconnection.php");

if(isset($_POST['Submit']))
{
          
		  
		$sqlupd=mysqli_query($con,"UPDATE students SET password='$_POST[NewPassword]' WHERE RegNo='$_SESSION[regno]' AND password='$_POST[OldPassword]'") ;
		if(mysqli_affected_rows($con) == 1)
				{
					$sqlupd =  1;
					echo  "<font color='green'><h3><strong>Password updated successfully..</strong></h3></font>";
				}
				else
				{
					$sqlupd =  1;
					echo  "<font color='red'><strong>No records found to update</strong></font>";	
				}
}
?>             
      	<div class="row space30"> <!-- row 1 begins -->
<?php
  include("studentsidebar.php");
  ?>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>Change Password</h2>
                <?php $sqlupd = ""; echo $sqlupd; ?>
            <p>
            <form action="" method="post">
<table  class="tftable" border="1">
<tr><th>Registration Number</th>
<td><input type="text" name="LoginID" size="30" value="<?php echo  $_SESSION["regno"] ; ?>" >
</td></tr>
<tr><th>Old Password</th>
<td><input type="password" name="OldPassword" size="30" placeholder="Enter Old password">
</td></tr>
<tr><th>New Password</th>
<td><input type="password" name="NewPassword" size="30" placeholder="Enter New password">
</td></tr>
<tr><th>Confirm Password</th>
<td><input type="password" name="ConfirmPassword" size="30" placeholder="Confirm New Password">
</td></tr>
<tr><td colspan="2" align="center"><input type="Submit" name="Submit" value="Submit">
</td></tr></table></form>
</p>
          </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>