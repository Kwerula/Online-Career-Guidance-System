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
		

              	<h2><i><b>The Company Privacy Terms</b></i></h2>
            <h3>Privacy Policy</h3>
			<hr />
<p>At Online Career Guidance System, we know you care about your personal information, so we have prepared this privacy policy (our <strong>'Privacy Policy'</strong>) to explain how we collect, use and share it. By using or accessing the Service, you agree to the terms of this Privacy Policy. Capitalized terms not defined here have the meanings set forth in the terms and conditions (the <strong>'Terms and Conditions'</strong>), located at https://www.onlinecareerguidancesystem.com/terms. We may update our Privacy Policy to reflect changes to our information practices. If we do this and the changes are material, we will post a notice that we have made changes to this Privacy Policy on the Website for at least 7 days after the changes are made, and we will indicate the date these terms were last revised at the bottom of the Privacy Policy. Any revisions to this Privacy Policy will become effective the earlier of (i) the end of that 7-day period or (ii) the first time you access or use the Service after any such changes.</p>

<h3>USE OF INFORMATION OBTAINED BY ONLINE CAREER GUIDANCE SYSTEM</h3>
<hr />

<p>We may use your contact information to send you notifications regarding new services offered by Online Career Guidance System that we think you may find valuable. Online Career Guidance System may also send you service-related announcements from time to time through the general operation of the Service. Generally, you may opt out of such emails.<br>

Profile information is used by Online Career Guidance System to be presented back to and edited by you when you access the Service and to be presented to other users. In some cases, other users may be able to supplement your profile, including by submitting comments (which can be deleted by you).<br>

Online Career Guidance System may use or share aggregate or anonymous data collected through the Service, including Activity Data, for purposes such as understanding or improving the service.<br></p>

<h3>SHARING YOUR PERSONALLY-IDENTIFIABLE INFORMATION WITH THIRD PARTIES</h3>
<hr />

<p>Online Career Guidance System shares your personally-identifiable information only when it is reasonably necessary to offer the Service, legally required, or permitted by you. For example:

We may provide personally-identifiable information to service providers who help us bring you the Service, such as hosting the Service at a co-location facility or sending email updates. In connection with these operations, our service providers may have access to personally-identifiable information for a limited time. When we utilize service providers for processing any personally-identifiable information, we implement reasonable contractual protections limiting the use of that personally-identifiable information to the provision of services to Online Career Guidance System. <br >

We may be required to disclose personally-identifiable information in response to lawful requests, such as subpoenas or court orders, or in compliance with applicable laws. Additionally, we may share account or other personally-identifiable information when we believe it is necessary to comply with law, to protect our interests or property, to prevent fraud or other illegal activity perpetrated through the Service or using the Online Career Guidance System name, or to prevent imminent harm. This may include sharing personally-identifiable information with other companies, lawyers, agents or government agencies.<br >

Online Career Guidance System will share the complete and accurate results of Online Career Guidance System with such institutions, including universities, potential employers, or other third parties, (collectively, <strong>'Score Recipients'</strong>) as you specify when you finish an examination. We will never share examination results with any party without your direction, except that anonymized examination results may be used by Online Career Guidance System and its partners to improve the examination and for research and analysis. <br >

If the ownership of all or substantially all of the Online Career Guidance System business, or individual business units or assets owned by Online Career Guidance System that are related to the Service, were to change, your personally-identifiable information may be transferred to the new owner. In any such transfer of information, your personally-identifiable information would remain subject to this section.</p>

<h3>UPDATING OR DELETING YOUR PERSONALLY-IDENTIFIABLE INFORMATION</h3>
<hr />

<p>You have at all times the right to delete your account with Online Career Guidance System by following the instructions available through the Service. After your account is deleted we will retain aggregate or anonymous data collected through the Service, including Activity Data, which may be used by the Online Career Guidance Company and shared with third parties in any manner. Information associated with the Online Career Guidance System, including examination results and your profile details, may be collectively deleted from your Online Career Guidance System account, but anonymized examination data, including your examination results and profile details, may be kept indefinitely by Online Career Guidance System to improve the examination and for research and analysis.</p>

<h3>LINKS</h3>
<hr />
<p>The Service may contain links to other websites. We are not responsible for the privacy practices of other websites. We encourage users to be aware when they leave the Service to read the privacy statements of other websites that collect personally identifiable information. This Privacy Policy applies only to information collected by Online Career Guidance System via the Service.</p>

<h3>INFORMATION SECURITY</h3>
<hr />

<p>Online Career Guidance System has implemented administrative and technical safeguards it believes are sufficient to protect the confidentiality, integrity and availability of your Testing ID, User Photo, access credentials and Online Guidance System English Test results. However, we believe that a determined attacker with sufficient resources could defeat those safeguards and may, as a result, gain access to the information we seek to protect.</p>

<h3>DO NOT TRACK</h3>
<hr />
<p>The Service is not designed to respond to <strong>'do not track'</strong> signals sent by some browsers.</p>

<h3>CONTACT US</h3>
<hr />
<p>To understand more about our Privacy Policy, access your information, or ask questions about our privacy practices or issue a complaint, please contact us at privacy@onlinecareerguidance.com</p>
<br />
<p>Last revised on 1 November 2016 </p>
 
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>