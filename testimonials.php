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
<script language="JavaScript">
    function function1(){
        document.all.myMarquee.stop();
    }
    function function2(){
        document.all.myMarquee.start();
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
				<hr />
				
						<script language="javascript">
function onSubmitTestimonial()
{
	if(document.testimonialform.name.value=="")
	{
		alert("Please fill in your full Names!!");
		document.testimonialform.name.focus();
		return false;
	}
	else if(document.testimonialform.email.value=="")
	{
		alert("Please fill in your Email!!");
		return false;
	}
	else if(document.testimonialform.phone.value=="")
	{
		alert("Please fill in your Numerical Number for Contacts!!");
		return false;
	}
	else if(document.testimonialform.testimonialtext.value=="")
	{
		alert("The Text box should not be left Empty!!");
		return false;
	}
	else if(document.testimonialform.imagefile.value=="")
	{
		alert("Please Upload a picture!!");
		return false;
	}
	else if(document.testimonialform.testimonialtitle.value=="")
	{
		alert("Please Enter your Testimonial Title");
		return false;
	}
	else if(document.testimonialform.title.value=="")
	{
		alert("Please put your Credentials or Your Title!!");
		return false;
	}
}
	</script>
	
	 <?php
				if(isset($_POST['submit']))
				{
					$sqlins = mysqli_query($con,"INSERT into testimonials(name,title,phone,email, testimonialtitle,imagefile,testimonialtext,status)VALUES('$_POST[name]','$_POST[title]','$_POST[phone]','$_POST[email]','$_POST[testimonialtitle]','$_POST[imagefile]','$_POST[testimonialtext]','Enabled')");
					if(!$sqlins)
			{
				echo mysqli_error($con);
			}
			else
			{
?>
		<script>
		alert("Testimonial sent successfully...!!");
		</script>
<?php
			}
			}
			else
  {

				?>
				<h3 align="left">Send Us Your Testimonial</h3>
<form action="" method="post" name="testimonialform" onsubmit="onSubmitTestimonial()">                
  <p>
                  <strong>Your Full Name <font color="red">**</font> </strong>                </p>
                    <input id="name" maxlength="50" class="form-control" name="name" type="text" placeholder="Full Names" />
                </p>
                <p>
				<strong>Field of Specialisation <font color="red">**</font>   </strong>            </p>
                    <input id="title" maxlength="50" class="form-control" name="title" type="text" placeholder="Specialisation" />
                </p>
                <p>
				<strong>Phone Contacts <font color="red">**</font>    </strong>            </p>
                    <input id="phone" maxlength="50" class="form-control"  name="phone" type="text" placeholder="Contacts" />
                </p>
                <p>
				<strong>Email <font color="red">**</font>  </strong>            </p>
                    <input id="email" maxlength="50" class="form-control" name="email"  type="text" placeholder="Testimonial Title" />
                </p>
                </p>
                <p>
				<strong>Testimonial Title <font color="red">**</font> </strong>               </p> 
                    <input id="testimonialtitle" maxlength="50" class="form-control" name="testimonialtitle"  type="text" placeholder="Testimonial Title" />
                </p>
				 <p>
                   <strong> Attach an image...<font color="red">**</font> </strong>               </p>
                <p>
                    <input id="imagefile" name="imagefile" type="file" value="" />
                </p>
                <p>
				<strong>Type your Testimonial Here..<font color="red">**</font> </strong>  </p>
                  <textarea cols="46" id="testimonialtext" maxlength="300" class="form-control" name="testimonialtext"  onkeypress="return imposeMaxLength(this, 500);" placeholder="Note: Online Career Guidance System will not display your phone number or email address on any site." rows="10">
</textarea>
                </p> 
              
                <p>
				
                    <input type="submit" name="submit" value="Send" class="btn btn-default" />
                </p>
</form>        
<?php 
}
?>         
              	
            </div>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
		  
		   <span id="Pagelayoutothersl1_MainContents1_lblContents0" class="insidecontent" style="font-family: Times New Roman">
          <span id="Pagelayoutothersl1_MainContents1_lblContents1" class="insidecontent">
			<h1>Testimonials About Our Company</h1>
        <hr />
        <div class="entry block">
                <div class="tab_item">
                    <div class="left testimonial-image"><img src="./images/baby smile.png" alt="Funny" width="144" height="88" /></div>
                    <div>
                        <h3>Testimonial from WILLIAM MBUGUA </h3>
                        <p ><marquee direction="up" height="120" scrolldelay="300" onMouseOver="function1();" OnMouseOut="function2();" id="myMarquee" width="750"><b><ul><li><span style="text-transform: capitalize"><font color="grey" size="4"><strong>My Company was in dire need to look for competent engineers to aid the company. Online Career Guidance System made my company get such a bunch of experts and the company profits are now sky rocketing...</strong></font></span></li></ul></b></marquee></p>
                        <div class="right">
                            <strong><span style="color: #505050">William Mbugua &nbsp;|&nbsp;</span>Sapart Engineers </strong></div>
                    </div>
                    <div class="clearfix">
                    </div>
                        <hr />
                </div>
                <div class="tab_item">
                    <div class="left testimonial-image"><img src="./images/happy.png" alt="smile" width="113" height="113" /></div>
                    <div>
                        <h3>Testimonial from WILLIAM GLANVILLE</h3>
                        <p><marquee direction="up" height="120" scrolldelay="300" onmouseover="function1();" onmouseout="function2();" id="myMarquee" width="750"><b><ul><li><span style="text-transform: capitalize"><font color="grey" size="4"><strong>Onlinee Career Guidance System has helped me get my dream job in a local mine firm. Thanks Online Career Guidance....</strong></font></span></li></ul></b></marquee></p>
                        <p>thank you all. </p>
                        <div class="right">
                            <strong><span style="color: #505050">William Glanville&nbsp;|&nbsp;</span>GEOPATRIAL CO. </strong></div>
                    </div>
                    <div class="clearfix">
                    </div>
                        <hr />
                </div>
                <div class="tab_item">
                    <div class="left testimonial-image"><img src="./images/i too smile.png" alt="susy" width="142" height="89" /></div>
                    <div>
                        <h3>Testimonial from SUSAN KIMOLI </h3>
                        <p><marquee direction="up" height="120" scrolldelay="300" onmouseover="function1();" onmouseout="function2();" id="myMarquee" width="750"><b><ul><li><span style="text-transform: capitalize"><font color="grey" size="4"><strong>My Career was heading to the rocks when my friendly suddenly introduced me to this marvelous site. I am now a CEO!! Life cannot not be better than this...</strong></font></span></li></ul></b></marquee></p>
                        <p>Thanks alot Online Career Guidance System. </p>
                        <div class="right">
                            <strong><span style="color: #505050">Susan Kimoli &nbsp;|&nbsp;</span>Internet spaceshull company-CEO </strong></div>
                    </div>
                    <div class="clearfix">
                    </div>
                        <hr />
                </div>
                <div class="tab_item">
                    <div class="left testimonial-image"><img src="images/richy.png" alt="hi" width="97" height="131" /></div>
                    <div>
                        <h3>Testimonial from DAVID OMONDI </h3>
                      <p><marquee direction="up" height="120" scrolldelay="300" onmouseover="function1();" onmouseout="function2();" id="myMarquee" width="750"><b><ul><li><span style="text-transform: capitalize"><font color="grey" size="4"><strong>I had previouly used many sites to look for a dream job but was not possible, but when I bumbed into Online Career Guidance my life changed dramatically. I now work as a teacher in Greenpark Group of Schools.</strong></font></span></li></ul></b></marquee></p>
                      <p>Thanks, GOD Bless. </p>
                <div class="right">
                            <strong><span style="color: #505050">David Omondi &nbsp;|&nbsp;</span>Teacher</strong></div>
                    </div>
                    <div class="clearfix">
                    </div>
            <div class="tab_item">
                <div class="right"><strong>1</strong>  | <a href="#">2</a> </div>
                <div class="right previous-next"><a href="#">Next</a> </div>
            </div>
        </div>
    </article>
</div>
<aside>
    <div class="pad">
        <div id="side-bar">
          <div id="testimonial-control" class="testimonial-short"></div>
    <div></div>
    <div class="testimonial-pager"></div>
    <div class="clearfix"></div>
</div>

        <div class="section-divider">
        </div>
        <div id="side-bar">
            
    </div>
</aside>
 
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>