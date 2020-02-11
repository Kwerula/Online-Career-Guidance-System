<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
if(!isset($_SESSION)){
session_start();
}
?>
<script language="javascript">
function validate()
{
	if(document.stdform.regno.value=="")
	{
		alert("Please enter Registration Number");
		document.stdform.regno.focus();
		return false;
	}
	else if(document.stdform.password.value=="")
	{
		alert("Please enter Password ");
		document.stdform.password.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>

<script language="javascript">
function validate1()
{
	if(document.empform.loginid.value=="")
	{
		alert("Please enter Login ID");
		document.empform.loginid.focus();
		return false;
	}
	else if(document.empform.password.value=="")
	{
		alert("Please enter Password");
		document.empform.password.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>
<?php
include("header.php");
include("dbconnection.php");
$dt = date("Y-m-d h:i:s");

$dt = "";
$msg = "";
$msg1 = "";
$_POST['loginid']= strip_tags(@$_POST['loginid']);
$_POST['regno']= strip_tags(@$_POST['RegNo']);
$_POST['password']= strip_tags(@$_POST['password']);
$dt = strip_tags(@$_POST['lastlogin']);
$_SESSION['empid'] = "";
$rs['empid'] = "";
$_SESSION['regno'] = "";
$rs['RegNo'] = "";

if(isset($_SESSION['empid']))
{
	header("Location: dashboard.php");
}
if(isset($_SESSION['regno']))
{
	header("Location: studentpanel.php");
}
if(isset($_POST['submit']))
{
	$sql = mysqli_query($con,"SELECT * FROM students WHERE RegNo='$_POST[regno]' AND password='$_POST[password]' AND Status='Enabled'");
	if(mysqli_num_rows($sql) == 1)
	{
		$rs = mysqli_fetch_array($sql);
		echo "<br><strong><font color='green'>Student logged in successfully..</font></strong>";
		$_SESSION['regno']=$rs['RegNo'];
		header("Location: studentpanel.php");
	}
	else
	{
		echo "<br><strong><font color='red'>Failed to login</font></strong>";
	}
}
if(isset($_POST['submit1']))
{

$sql = mysqli_query($con,"SELECT * FROM employees WHERE loginid='$_POST[loginid]' AND password='$_POST[password]' AND Status='Enabled'");
	if(mysqli_num_rows($sql) == 1)
	{
			$sqlupd = mysqli_query($con,"UPDATE employees SET lastlogin='$dt' where loginid='$_POST[loginid]'");
			
			
		$rs = mysqli_fetch_array($sql);
		echo "<br><strong><font color='green'>Employee logged in successfully..</font></strong>";
		echo $_SESSION['empid']=$rs['empid'];
		header("Location: dashboard.php");
	}
	else
	{
		echo "<br><strong><font color='red'>Failed to login</font></strong>";
	}

}

?>
      	<div class="row space30"> <!-- row 1 begins -->
      
            <div class="col-md-6">
           	<h2>Student Login</h2>
              	<p>Please enter Registration Number and password to login..<?php $msg=""; echo $msg; ?></p>
                
                <form role="form" name="stdform" method="post" action="" onsubmit="return validate()">
                  <div class="form-group">
                    <label for="name">Registration No.:</label>
                    <input name="regno" type="text" class="form-control" id="regno" placeholder="Enter your Registration number">
                  </div>
                  <div class="form-group">
                    <label for="email">Password:</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Enter password">
                  </div>
                  <input type="submit" name="submit" value="Sign In" class="btn btn-default">
                </form>
            </div>
      
            <div class="col-md-6">
              	<h2>Employee Login Panel</h2>
              	<p>Please enter Login ID and password<?php $msg1=""; echo $msg1; ?>.</p>
                
                <form name="empform" role="form" method="post" action="" onsubmit="return validate1()">
                  <div class="form-group">
                    <label for="name">Login ID:</label>
                    <input name="loginid" type="text" class="form-control" id="loginid" placeholder="Enter your Login ID">
                  </div>
                   <div class="form-group">
                    <label for="email">Password:</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Enter password">
                  </div>
                   <input type="submit" name="submit1" value="Sign In" class="btn btn-default">
                </form>

           </div>
            
     	</div> <!-- /row 1 -->
    <?php
	include("footer.php");
	?>