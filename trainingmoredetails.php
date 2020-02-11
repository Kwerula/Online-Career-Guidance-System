<?php
if(!isset($_SESSION)){
session_start();
}
include("dbconnection.php");
include("header.php");


if(isset($_POST['submit2']))
{
	$sql = mysqli_query($con,"SELECT * FROM students WHERE RegNo='$_POST[regno]' AND password='$_POST[password]' AND Status='Enabled'");
	if(mysqli_num_rows($sql) == 1)
	{
		$rs = mysqli_fetch_array($sql);
		$msg = "<br><strong><font color='green'>Student logged in successfully..</font></strong>";
		$_SESSION['regno'] == $rs['RegNo'];
		//header("Location: jobsapplication.php?jobid=$_GET[jobid]");
	}
	else
	{
		$msg = "<br><strong><font color='red'>Failed to login</font></strong>";
	}
}
$_POST['setid']= "";
$_SESSION['setid'] ="";


if($_POST['setid']==$_SESSION['setid'])
{
	if(isset($_POST['Submit']))
	{	
			$filename = rand(). $_FILES['file']['name'];
			move_uploaded_file($_FILES['file']['tmp_name'], "resume/".$filename);
			
			$dt = date("Y-m-d");
			
				$sqlins=mysqli_query($con,"INSERT into applicationform(RegNo,JobId,AppliedDate,Resume,message,Status,apptype) VALUES('$_SESSION[regno]','$_GET[trainingid]','$dt','$filename','$_POST[message]','Enabled','Training program')");
				if(!$sqlins)
				{
					echo mysqli_error($con);
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

$_SESSION['setid']=rand();


if(isset($_GET['trainingid']))
{
$sql = mysqli_query($con,"SELECT trainingprogram.*, companies.* FROM trainingprogram INNER JOIN companies ON companies.CompanyId=trainingprogram.CompanyId WHERE (trainingprogram.TrainingId='$_GET[trainingid]')");
$rs = mysqli_fetch_array($sql);

if(isset($_SESSION['regno']))
{
$sql = mysqli_query($con,"SELECT * FROM students WHERE RegNo='$_SESSION[regno]'");
$rsst = mysqli_fetch_array($sql);

?>
<script language="javascript">
function validate1()
{
	if(document.stdform.regno.value=="")
	{
		alert("Registration Number should not be empty!!");
		document.stdform.regno.focus();
		return false;
	}
	else if(document.stdform.password.value=="")
	{
		alert("Please enter Password!!");
		return false;
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
	else if(document.form1.message.value=="")
	{
		alert("Message box should not be left empty!!");
		return false;
	}
}
	</script>

<div class="row space30"> <!-- row 1 begins -->
      
      		<div class="col-sm-6 col-lg-4">
           	  					 <h2>Company Name</h2>
              	<p>
                 <h1><b> <?php
                echo ucfirst($rs['CompanyName']);
			  ?></b></h1>
              <hr />
                </p>
               <?php
                if($rs['CompanyLogo'] == "")
					{
					?>
			<a href='trainingmoredetails.php?trainingid=<?php echo $rs['TrainingId'];?>'><img src='images/noimage.jpg'  height='175' width='350'  class='img-responsive img-rounded img_bottom' ></a>	
					<?php	
					}
					else
					{
					?>
<a href='trainingmoredetails.php?trainingid=<?php echo $rs['TrainingId'];?>'><img src='uploadedfiles/<?php echo $rs['CompanyLogo'];?>'  height='175' width='350'   class='img-responsive img-rounded img_bottom' ></a>
					<?php
					}
					?> 
   	           
               <h2>About company</h2>
              	<p>
					<h3><a href="companymoredetails.php?companyid=<?php echo  $rs['CompanyId'];?>">Click here</a></h3>
                </p>
    
            </div>
 
             <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>Program Title :</h2>
				<p>
				<h1><?php echo $rs['Title']; 
				?></h1></p>
                
            <p><strong>Date & Time :</strong> 
			<?php
            echo $rs['TPDatetime']; 
			?></p>
            <p><?php
			$rs['TPInfo']="";
            echo $rs['TPInfo']; 
			?></p>
            
            <h2>Training Type:</h2>
              	<p>
                  <?php
                echo $rs['TrainingType'];
			  ?>
                </p>  
                     
					 <h2>Venue :</h2>
              	<p>
                  <?php
                echo $rs['Venue'];
			  ?>
                </p> 
					    
            	<h2>Departments:</h2>
                 <p><?php
            echo $rs['TPDepartments']; 
			?></p>
			
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

                      $_SESSION['regno'] = strip_tags(@$_POST['RegNo']);
					  $_GET['trainingid'] = strip_tags(@$_POST['JobId']);
					$sql=mysqli_query($con,"SELECT * from applicationform WHERE RegNo='$_SESSION[regno]' AND JobId='$_GET[trainingid]' AND apptype='Training program'");					 
					$sqlqueryfetch = mysqli_fetch_array($sql);
					if(mysqli_num_rows($sql) == 0)
					{
				 ?>             
                 <h2>Apply to this training program: </h2>
                <form role="form" method="post" action="" enctype="multipart/form-data" name="form1" onsubmit="return validate2()">
                <input type="hidden" name="setid" value="<?php echo $_SESSION['setid']; ?>" />
                  <div class="form-group">
                    <label for="name">Name:</label>
                    <input name="name" type="text" class="form-control" id="name"  readonly value="<?php echo $rsst['FirstName']. " " . $rsst['LastName']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="email">Registration No.:</label>
                    <input name="registrationno" type="text" class="form-control" id="registrationno" readonly value="<?php echo $rsst['RegNo']; ?>">
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
                  <form role="form" name="stdform" method="post" action="" onsubmit="return validate1()">
                  <div class="form-group">
                    <label for="name">Registration No. :</label>
                    <input name="regno" type="text" class="form-control" id="regno" placeholder="Enter your Registration number">
                  </div>
                  <div class="form-group">
                    <label for="email">Password :</label>
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
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
      
   <?php
   }
   }
	include("footer.php");
	?>