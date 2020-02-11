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
		alert("Please enter the Registration Number");
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
		alert("Please enter First Name");
		document.form3.fname.focus();
		return false;
	}
	else if(document.form3.regno.value =="")
	{
		alert("Please enter Register Number");
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

if($_POST['setid']==$_SESSION['setid'])
{
if(isset($_POST['submit']))
{
	
$sqlins=mysqli_query($con,"INSERT into students(FirstName,LastName,RegNo,Password,CourseId,Status)VALUES('$_POST[fname]','$_POST[lname]','$_POST[regno]','$_POST[newpassword]','$_POST[course]','Enabled')"); 
if(!$sqlins)
{
	$regresi=1;
	echo "<font color='red'><strong><h3>Failed to insert records</h3></strong></font>". mysqli_error($con);
}
else
{
	$regresi=1;
	echo  "<font color='green'><strong><h3>Registered successfully</h3></strong></font>";
}
}
}
$_SESSION['setid']=rand();

include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
      		<div class="col-sm-6 col-lg-4">
            
                <img src="images/logo1.jpg" alt="Image 3" class="img-responsive img-rounded img_right" />
           	  <h2>Student Login Panel</h2>
              <p><font color='blue'>Please enter Your Registration Number and password to login...</font><?php $msg="";  echo $msg; ?></p>
                
              <form role="form" name="form1" method="post" action="" onsubmit="return validate1()">
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
                
                <form name="form2" role="form" method="post" action="" onsubmit="return validate2()">
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
              	<h2><i><b>Online Career Guidance For Graduates</b></i></h2>
				<hr  />
            <p>This <i><b>Career Guidance and information cell</b></i> is in view of helping students to get useful and systematic guidance on careers open to them in their respective field of study.The members of the <b>Career Guidance Committee</b> along with various institutions carry out various enrichment programmes as well as conduct coaching classes in order to train the students to answer various competitive examinations.An attempt is made to hod campus recruitments for the benefit of those students who are pursuing professional and vocational courses of study. </p>
			<p>For more details <strong><a href='about1.php'>Click here..</a></strong></p>
 
 <h2>Sign Up</h2>
 		
        <?php
		$regresi = "";
				if($regresi == 1)
				{
              	echo "<p><font color='green'><h2>Registered Succesfully....<br>
				Feel Free to Sign in!!</h2></font></p>";
				}
				else
				{
                echo "<p><font color='blue'><h2>Welcome our New User !! Sign up With US</h2></font></p>";
				}
        ?>   
                <form name="form3" role="form" method="post" action="" onsubmit="return validate3()">
                  <div class="form-group">
                  <input type="hidden" name="setid" value="<?php $_SESSION['setid'] = "";
				   echo $_SESSION['setid']; ?>" />

                    <label for="fname">First Name.:</label>
                    <input name="fname" type="text" class="form-control" id="fname" placeholder="Enter First name">
                  </div>
                  <div class="form-group">
                    <label for="fname">Last name.:</label>
                    <input name="lname" type="text" class="form-control" id="lname" placeholder="Enter Last name">
                  </div>                  
                  <div class="form-group">
                    <label for="fname">Registration No.:</label>
                    <input name="regno" type="text" class="form-control" id="regno" placeholder="Enter your Registration Number">
                  </div>
                  <div class="form-group">
                    <label for="email">Password:</label>
                    <input name="newpassword" type="password" class="form-control" id="newpassword" placeholder="New password">
                  </div>
                  <div class="form-group">
                    <label for="subject">Confirm Password:</label>
                    <input name="confirmpassword" type="password" class="form-control" id="confirmpassword" placeholder="Confirm password">
                  </div>
                  
                  <div class="form-group">
                    <label for="subject">Course:</label>
                    <select name="course"  class="form-control">
                    <option value="Select">Select course</option>
                    <?php
					$sql=mysqli_query($con,"SELECT * FROM course WHERE status='Enabled'");
					while($rsrec = mysqli_fetch_array($sql))
					{
						echo "<option value='$rsrec[CourseId]'>$rsrec[CourseName] | Course code: $rsrec[coursecode]</option>";
					}
					?>
                    </select>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input name="newuser" type="checkbox" id="newuser" value="new"> I am new user.
                    </label>
                  </div>
                  <input name="submit" type="submit" class="btn btn-default" id="submit" value="Register here"  onclick="if(!this.form.newuser.checked){alert('You must Select New user option.');return false}" >
                </form>

 
 </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>