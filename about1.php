<?php
if(!isset($_SESSION)){
session_start();
}
$dttim = "";
$dttim = date("Y-m-d h:i:s");

?>

<script language="javascript">
function validate1()
{
	if(document.form1.regno.value=="")
	{
		alert("Please enter Registration Number");
		document.form1.regno.focus();
		return false;
	}
	else if(document.form1.password.value=="")
	{
		alert("Please enter Password ");
		document.form1.password.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>

<script language="javascript">
function validate2()
{
	if(document.form2.loginid.value=="")
	{
		alert("Please enter Login ID");
		document.form2.loginid.focus();
		return false;
	}
	else if(document.form2.password.value=="")
	{
		alert("Please enter Password");
		document.form2.password.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>

<script language="javascript">
function validate3()
{

		if(document.form3.fname.value=="")
	{
		alert("Please enter the First Name");
		document.form3.fname.focus();
		return false;
	}
	else if(document.form3.regno.value =="")
	{
		alert("Please enter the Registration Number");
		document.form3.regno.focus();
		return false;
	}
	else if(isNaN(document.form3.regno.value) ==true)
	{
		alert("Please enter numerical value in Registration Number");
		document.form3.regno.focus();
		return false;
	}
	else if(document.form3.newpassword.value =="")
	{
		alert("Password Should not be empty..");
		document.form3.newpassword.focus();
		return false;
	}
	else if(document.form3.newpassword.value.length < 6)
	{
		alert("Password must contain atleast 6 characters");
		document.form3.newpassword.focus();
		return false;
	}
	else if(document.form3.newpassword.value!= document.form3.confirmpassword.value)
	{
		alert("Password and confirm password not matching");
		document.form3.newpassword.focus();
		return false;
	}
	else if(document.form3.course.value=="Select")
	{
		alert("Please enter Course");
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
$msg1 = "";
$_SESSION['setid'] = "";
$_POST['setid'] = "";


if(isset($_SESSION['empid']))
{
	header("Location: dashboard.php");
}
if(isset($_SESSION['regno']))
{
	header("Location: studentpanel.php");
}
if(isset($_POST['submit2']))
{
	$sql = mysqli_query($con,"SELECT * FROM students WHERE RegNo='$_POST[regno]' AND password='$_POST[password]' AND Status='Enabled'");
	if(mysqli_num_rows($sql) == 1)
	{
		$rs = mysqli_fetch_array($sql);
		echo "<br><strong><h3><font color='green'>Student logged in successfully..</font></h3></strong>";
		$_SESSION['regno']==$rs['RegNo'];
		header("Location: studentpanel.php");
	}
	else
	{
		echo "<br><strong><h3><font color='red'>Failed to login</font></h3></strong>";
	}
}
if(isset($_POST['submit1']))
{

$sql = mysqli_query($con,"SELECT * FROM employees WHERE loginid='$_POST[loginid]' AND password='$_POST[password]' AND Status='Enabled'");
	if(mysqli_num_rows($sql) == 1)
	{			
		$rs = mysqli_fetch_array($sql);
		echo "<br><strong><font color='green'><h3>Employee logged in successfully..</h3></font></strong>";
		echo $_SESSION['empid']=$rs['empid'];
		$_SESSION['logintype']=$rs['logintype'];
		$_SESSION['lastlogin'] = $rs['lastlogin'];
		
		mysqli_query($con,"UPDATE employees SET lastlogin='$dttim' where loginid='$_POST[loginid]'")or die(mysqli_error($con));
					
		header("Location: dashboard.php");
	}
	else
	{
		echo "<br><strong><font color='red'><h3>Failed to login</h3></font></strong>" . mysqli_error($con);
	}

}

include("header2.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
      		<div class="col-sm-6 col-lg-4">
            
                <img src="images/logo1.jpg" alt="Image 3" class="img-responsive img-rounded img_right" />
           	  <h2>Student Login Panel</h2>
              <p><font color='blue'>Please enter Your Registration Number and password to login...</font><?php $msg="";  echo $msg; ?></p>
                
              <form role="form" name="form1" method="post" action="" onSubmit="return validate1()">
                  <div class="form-group">
                    <label for="name">Registration No.:</label>
                    <input name="regno" type="text" class="form-control" id="regno" placeholder="Enter your Registration number">
                  </div>
                <div class="form-group">
                    <label for="email">Password:</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Enter password">
                </div>
                <input name="submit2" type="submit" class="btn btn-default" id="submit2" value="Sign In">
                </form>
                
                <a href="forgotpassword.php"> <strong>Forgot Password</strong> </a>
                  <hr />
                  <h2>Employee Login Panel</h2>
              	<p><font color='blue'>Please enter Login ID and password....</font><?php $msg1=""; echo $msg1; ?>.</p>
                
                <form name="form2" role="form" method="post" action="" onSubmit="return validate2()">
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
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2><i><b>Online Career Guidance For Graduants</b></i></h2>
				<br  />
            <p>This <i><b>Career Guidance and information cell</b></i> is in view of helping students to get useful and systematic guidance on careers open to them in their respective field of study.The members of the <b>Career Guidance Committee</b> along with various institutions carry out various enrichment programmes as well as conduct coaching classes in order to train the students to answer various competitive examinations.An attempt is made to hod campus recruitments for the benefit of those students who are pursuing professional and vocational courses of study. </p>
			 <hr />
			 <h3><b>Brief History about the Company</b></h3>
			 <br />
			 <p>Online Career Guidance System Was started in the year in 2015. The Company's CEO, Veronicah Waititu had in mind ways to solve the problem of unemployment among many graduants. In Solving this problem, she found out Companies had the problem of getting competent employees so she made their work easier by giving them competent personnel through this site.
			 <br />
			 <p>Online Career Guidance System looks critically at every information given by the Graduants and if satisfied they are linked to companies that require employees. Companies that register with this system too, don't get a smooth ride; they must produce ISO certificate to be allowed to advertise in this system. The Company also should have a good reputation and meet international standards.
			 <hr />
			 <h3><b>The Company Credibility</b></h3>
			 <br />
			 <p>Online Career Guidance System is an ISO certified Company with a well reknown reputation both locally and internationally. It has won many Awards including Internatonal Internet Hub Awards (IIHA)...
			 <br />
			  <div class="tab_item">
                    <div class="left testimonial-image"><img src="./images/key gift.jpg" alt="gift" width="120" height="120" />Intenational Internet Hub Awards</img></div>
                    </div>
			 
 
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>