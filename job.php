<?php
session_start();
include("header.php");
include("dbconnection.php");
?>

      	<div class="row space30"> <!-- row 1 begins -->
      
      		<div class="col-sm-6 col-lg-4">
           	  <h2>Jobs by Qualification</h2>
			 <?php
			$sql = mysqli_query($con,"SELECT * FROM course where Status='Enabled'");

			while($rs = mysqli_fetch_array($sql))
			{
				
			echo "<h4>";
			echo "<strong><img src='images/bullet_red.ico' /></strong> <a href='job.php?course=$rs[CourseName]'>".strtoupper($rs['CourseName'])."</a>";
			echo "<hr></h4>";
			}
			?>            	
            </div>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
          <?php
		  if(isset($_GET['companyid']))
		  {
			$sqljobs = mysqli_query($con,"SELECT jobs.*,companies.* FROM jobs INNER JOIN companies ON companies.CompanyId=jobs.CompanyId where jobs.Status='Enabled' and jobs.CompanyId='$_GET[companyid]'");
		  }
		  else if(isset($_GET['course']))
		  {
			$sqljobs = mysqli_query($con,"SELECT jobs.*,companies.* FROM jobs INNER JOIN companies ON companies.CompanyId=jobs.CompanyId where jobs.Status='Enabled' and jobs.Eligibility LIKE '%$_GET[course]%'");
		  }
		  else
		  {
			$sqljobs = mysqli_query($con,"SELECT jobs.*,companies.* FROM jobs INNER JOIN companies ON companies.CompanyId=jobs.CompanyId where jobs.Status='Enabled'");
		  }
			
		  ?>
              	<h2><?php echo mysqli_num_rows($sqljobs); ?> Jobs available</h2>
                <hr>
                <?php
				while($rsjobs = mysqli_fetch_array($sqljobs))
				{
				echo "
                <h3>$rsjobs[JobTitle]</h3>
				<p><strong>Job Code:</strong> $rsjobs[JobId] | <strong>Company:</strong> $rsjobs[CompanyName] | <strong>Eligibility:</strong>";
				echo  str_replace("Null,","",$rsjobs['Eligibility']) ."</p>";
            	echo "<p>$rsjobs[JobResponsibility]</p>
				<p><a class='btn-sm btn-success' href='jobsapplication.php?jobid=$rsjobs[JobId]'>View Job details and Apply for job &raquo;</a></p>
           		<hr>
				";
				}
				?>
            </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
      

   <?php
   include("footer.php");
   ?>