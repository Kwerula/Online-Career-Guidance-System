<?php
if(!isset($_SESSION)){
session_start();
}
include("dbconnection.php");
?>
<script language="javascript">
function validate1()
{
	if(document.stdform.regno.value=="")
	{
		alert("Please enter Registration Number");
		document.stdform.regno.focus();
		return false;
	}
	else if(document.stdform.password.value=="")
	{
		alert("Please enter password ");
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
function validate2()
{
	if(document.form1.registrationno.value=="")
	{
		alert("Registration Number should not be empty!!");
		document.form1.registrationno.focus();
		return false;
	}
	else if(document.form1.name.value=="")
	{
		alert("Please fill in your Names!!");
		return false;
	}
	else if(document.form1.file.value=="")
	{
		alert("Please upload a file before your Application!!");
		return false;
	}
	else if(document.form1.message.value=="")
	{
		alert("Message box should not be left empty!!");
		return false;
	}
}
	</script>
<?php

if(isset($_POST['submit2']))
{
	$sql = mysqli_query($con,"SELECT * FROM students WHERE RegNo='$_POST[regno]' AND password='$_POST[password]' AND Status='Enabled'");
	if(mysqli_num_rows($sql) == 1)
	{
		$rs = mysqli_fetch_array($sql);
		echo "<br><strong><font color='green'>Student logged in successfully..</font></strong>";
		$_SESSION['regno'] == $rs['RegNo'];
		//header("Location: jobsapplication.php?jobid=$_GET[jobid]");
	}
	else
	{
		echo "<br><strong><font color='red'>Failed to login</font></strong>";
	}
}
include("header.php");
$_POST['setid']= "";
$_SESSION['setid'] = "";



if($_POST['setid']==$_SESSION['setid'])
{
	if(isset($_POST['Submit']))
	{	
			$filename = rand(). $_FILES['file']['name'];
			move_uploaded_file($_FILES['file']['tmp_name'], "resume/".$filename);
			
			$dt = date("Y-m-d");
			
			
			$sqlins=mysqli_query($con,"INSERT into applicationform(RegNo,JobId,AppliedDate,Resume,message,Status,apptype) VALUES ('$_SESSION[regno]','$_GET[jobid]','$dt','$filename','$_POST[message]','Enabled','Job application')");
				if(!$sqlins)
				{
					$qresulti = 1;
					echo "<font color='red'><strong>Failed to insert record into the database...</strong></font>". mysqli_query($con);
				}
				else
				{
					$qresulti = 1;
					echo "<font color='green'><strong>Application submitted successfully...</strong></font>";
					$sqlins = $sqlins . "<br> Your Application Reference Number is: ". mysqli_insert_id($con);
					$sqlins = $sqlins . "<br> <a href='studentpanel.php'>Click here </a>";
				}
	}
}

if(isset($_SESSION['regno']))
{
$sql = mysqli_query($con,"SELECT * FROM students where RegNo='$_SESSION[regno]'");
$rsst = mysqli_fetch_array($sql);


if(isset($_GET['jobid']))
{
$sql = mysqli_query($con,"SELECT jobs.*, companies.* FROM jobs INNER JOIN companies ON jobs.CompanyId=companies.CompanyId where jobs.JobId='$_GET[jobid]'");
$rs = mysqli_fetch_array($sql);

$_SESSION['setid']=rand();
?>
      	<div class="row space30"> <!-- row 1 begins -->
      
            <div class="col-md-6">
           	  <h2><?php echo $rs['JobTitle']; ?></h2>
              <h4>Job Code: <?php echo $rs['JobId']; ?></h4>
              	<p>
                <?php
                if($rs['CompanyLogo'] == "")
					{
					?>		
					<a href="companymoredetails.php?companyid=<?php echo $rs['CompanyId']; ?>"><img src='images/noimage.jpg'  class='img-responsive img-rounded img_bottom' height='200' width='350' ></a>	
					<?php
					}
					else
					{
					?>
					<a href="companymoredetails.php?companyid=<?php echo $rs['CompanyId']; ?>"><img src="uploadedfiles/<?php  echo $rs['CompanyLogo']; ?>"  class='img-responsive img-rounded img_bottom' height='200' width='350' ></a>
					<?php
					}
				?>
				</p>
                <p><strong><u>Company</u> : </strong> <?php echo ucfirst($rs['CompanyName']); ?> </p>
              	<p><strong><u>Job Location</u> :</strong></u> <?php echo ucfirst($rs['JobLocation']); ?></p>
                <p><strong><u>Job Responsibility</u> : </strong><br><?php echo ucfirst($rs['JobResponsibility']); ?></p>
                <p><strong><u>Eligibility</u> : </strong> <?php echo  str_replace("Null,","",$rs['Eligibility']); ?></p>                
                
                <p><strong><u>Selection Process</u> : </strong>
                <br><?php echo $rs['SelectionProcess']; ?></p>
                
                <p><strong><u>Compensation</u> : </strong><?php echo $rs['Compensation']; ?></p>
                

            </div>
        
            <div class="col-md-6">
              	<h2><u>Interview details</u></h2>
              	<p>
                <strong>Interview Date:</strong> <?php echo $rs['InterviewDate']; ?><br>
                <strong>Last Date for Registration:</strong> <?php  echo $rs['RegistrationTime']; ?><br>
                <strong>Documents required :</strong> <?php echo $rs['DocReq']; ?><br>
                <strong>Venue :</strong> <br><?php echo str_replace(",",", <br>",$rs['Venue']); ?><br>
               </p>
                
              
                <?php
				$qresulti = "";
				if($qresulti == 1)
				{
					echo "<h1>$qresult</h1>";
				}
				else
				{
				?>
                 <?php
				 if(isset($_SESSION['regno']))
				 {
					$sql= mysqli_query($con,"SELECT * from applicationform where RegNo='$_SESSION[regno]' AND JobId='$_GET[jobid]'");					 
					$sqlqueryfetch = mysqli_fetch_array($sql);
					if(mysqli_num_rows($sql) == 0)
					{
				 ?>             
                 <h2>Apply to this Job: </h2>
                <form role="form" method="post" action="" enctype="multipart/form-data" onsubmit="return validate2()" name="form1">
                <input type="hidden" name="setid" value="<?php echo $_SESSION['setid']; ?>" />
                  <div class="form-group">
                    <label for="name">Name:</label>
             <input name="name" type="text" class="form-control" id="name"  readonly value="<?php echo $sqlqueryfetch['FirstName']. " " . $sqlqueryfetch['LastName']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="email">Registration No.:</label>
                  <input name="registrationno" type="text" class="form-control" id="registrationno" readonly value="<?php echo $sqlqueryfetch['RegNo']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="subject">Upload Resume:</label>
                    <input name="file" type="file" class="form-control" id="file">
                  </div>
                  <div class="form-group">
                    <label for="message">Message:</label>
                  	<textarea name="message" rows="3" class="form-control" id="message" placeholder="Enter your message"></textarea>
				  </div>
              
                  <input type="submit" name="Submit" class="btn btn-default" value="Apply...">
                </form>
                <?php
					}
					else
					{
						echo "<font color='green'><strong>Your Application Reference Number is:</strong> ". $sqlqueryfetch['AppId']. "</font>";
					}
				 }
				else if(isset($_SESSION['empid']))
				{
						
				}
				 else
				 {
				?>
                <h2>Sign In to apply: </h2>
                <?php $msg=""; echo $msg ; ?>
                  <form role="form" name="stdform" method="post" action="" onsubmit="return validate1()" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="name">Registration No.:</label>
                    <input name="regno" type="text" class="form-control" id="regno" placeholder="Enter your Registration number">
                  </div>
                  <div class="form-group">
                    <label for="email">Password:</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Enter password">
                  </div>
                  <input type="submit" name="submit2" value="Sign In" class="btn btn-default">
                </form>
                <?php
				 }
				}
				?>
           </div>
            
     	</div> <!-- /row 1 -->
    <?php
	}
	}
	include("footer.php");
	?>