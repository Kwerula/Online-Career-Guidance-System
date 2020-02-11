<?php
if(!isset($_SESSION)){
session_start();
}
include("dbconnection.php");
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <?php
  include("adminsidebar.php");
  ?>
          
		    
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>Dashboard</h2>
                <hr />
          <h3>Last Login Date: <?php echo $_SESSION['lastlogin']; ?></h3><hr />
            <div class="col-md-4">
           	  <h4>System Clerks</h4>
              	<img src="images/employees.jpg" alt="Image 1" width="204" height="100"  class="img-responsive img-rounded img_left"  />             
              	<h4>No. of Employees:- 
<?php
$dt ="";
$sql = mysqli_query($con,"SELECT * FROM employees where logintype='Employee'");
echo mysqli_num_rows($sql);
?>
                </h4>
                <hr />
            </div>
			 <div class="col-md-4">
           	  <h4>Counsellors</h4>
              	<img src="images/admin.png" alt="Image 1" width="204" height="100"  class="img-responsive img-rounded img_left"  />             
              	<h4>No. of Counsellors:- 
<?php
$dt ="";
$sql = mysqli_query($con,"SELECT * FROM employees where logintype='Counsellor'");
echo mysqli_num_rows($sql);
?>
                </h4>
                <hr />
            </div>
            
                        <div class="col-md-4">
           	  <h4>Companies</h4>
              	<img src="images/companies.jpg" alt="Image 1" width="204" height="100" class="img-responsive img-rounded img_left" />             
              	<h4>No. of Companies:-
                <?php
$sql = mysqli_query($con,"SELECT * FROM companies where status='Enabled'");
echo mysqli_num_rows($sql);
?>
              </h4>  <hr />
            </div>
            
                        <div class="col-md-4">
           	  <h4>Courses</h4>
              	<img src="images/course.jpg" alt="Image 1" width="204" height="100" class="img-responsive img-rounded img_left" />             
              	<h4>No. of Courses:-
                  <?php
$sql = mysqli_query($con,"SELECT * FROM course where status='Enabled'");
echo mysqli_num_rows($sql);
?></h4>
                <hr />
            </div>
            
                        <div class="col-md-4">
           	  <h4>Jobs</h4>
           	  <img src="images/jobs-icon.jpg" alt="Image 1 "width="204" height="100" class="img-responsive img-rounded img_left" />
           	  <h4>No. of Jobs Published:-
                <?php
$sql = mysqli_query($con,"SELECT * FROM jobs where status='Enabled'");
echo mysqli_num_rows($sql);
?></h4>
                <hr />
            </div>
            
                        <div class="col-md-4">
           	  <h4>Students</h4>
           	  <img src="images/clients.png" alt="Image 1" width="204" height="100" class="img-responsive img-rounded img_left" />
           	  <h4>No. of students:-
                <?php
$sql = mysqli_query($con,"SELECT * FROM students where status='Enabled'");
echo mysqli_num_rows($sql);
?>
        </h4>        <hr />
            </div>
            
                        <div class="col-md-4">
           	  <h4>Training Programs</h4>
              	<img src="images/jde_training_services_img.jpg" alt="Image 1" width="204" height="100" class="img-responsive img-rounded img_left" />             
              	<h4>No. of Training Programs:-
                  <?php
$sql = mysqli_query($con,"SELECT * FROM trainingprogram where status='Enabled'");
echo mysqli_num_rows($sql);
?></h4>
                <hr />
            </div>
            
                        <div class="col-md-4">
           	  <h4>Selected Job Candidates</h4>
              	<img src="images/selectedcandidates.jpg" alt="Image 1" width="204" height="100" class="img-responsive img-rounded img_left" />             
              	<h4>No. of Selected Candidates:-
                  <?php
$sql = mysqli_query($con,"SELECT * FROM selectedcandidate");
echo mysqli_num_rows($sql);
?></h4>
                <hr />
            </div>
            
			        <div class="col-md-4">
           	  <h4>Selected Training Candidates</h4>
              	<img src="images/selectedcandidates.jpg" alt="Image 1" width="204" height="100" class="img-responsive img-rounded img_left" />             
              	<h4>No. of Selected Candidates:-
                  <?php
$sql = mysqli_query($con,"SELECT * FROM selectedCdatetraining");
echo mysqli_num_rows($sql);
?></h4>
                <hr />
            </div>
            
                        <div class="col-md-4">
           	  <h4>Current Jobs</h4>
              	<img src="images/banner_2.jpg" alt="Image 1" width="204" height="100" class="img-responsive img-rounded img_left" />             
              	<h4>No. Active jobs:- 
                  <?php
				  $dt= date("Y-m-d");
$sql = mysqli_query($con,"SELECT * FROM jobs where status='Enabled' AND InterviewDate >= '$dt'");
echo mysqli_num_rows($sql);
?></h4>
                <hr />
            </div>
            
                        <div class="col-md-4">
           	  <h4>Current Training Programs</h4>
              	<img src="images/currenttrainingprogram.jpg" alt="Image 1" width="204" height="100" class="img-responsive img-rounded img_left" />             
              	<h4>No. of Active Training programs :- 
                <?php
				  $dt= date("Y-m-d");
$sql = mysqli_query($con,"SELECT * FROM trainingprogram where status='Enabled' AND TPDatetime >= '$dt'");
echo mysqli_num_rows($sql);
?>
                </h4>
                <hr />
            </div>
            
          </div>
          
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>