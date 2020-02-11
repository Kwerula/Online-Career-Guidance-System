<?php
if(!isset($_SESSION)){
session_start();
}
?>     
<?php
if($_SESSION['logintype'] == "Administrator" )
{
?>
    		<div class="col-leftsidebar">
           	  <h2>Admin Menu</h2>
              <p><a href="dashboard.php">Home</a></p>  
              <p><a href="Employees.php?editid=<?php echo $_SESSION['empid']; ?>">Profile</a></p> 
              <p><a href="Employees.php">Add Employees</a></p>
              <p><a href="viewemployee.php">View Employees</a></p>              
              <p><a href="course.php">Add course</a></p>
              <p><a href="viewcourse.php">View course</a></p>  
              <p><a href="companies.php">Add Companies</a></p>
              <p><a href="viewcompanies.php">View Companies</a></p>                                     
              <p><a href="trainingprogram.php">Add Training program</a></p>
              <p><a href="viewtrainingprogram.php">View Training program</a></p>
			   <p><a href="viewtrainingformapplication.php">View Training program applicants</a></p> 
			   <p><a href="selectedcandidateadmin.php">Selected Training Candidates</a></p>
			   <p><a href="viewselectedcandidateadmin.php">View Selected Training Candidates</a></p>
              <p><a href="students.php">Add student</a></p>
              <p> <a href="viewstudents.php">View Students</a></p>
              <p><a href="jobs.php">Add Jobs</a></p>
              <p><a href="viewjobs.php">View Jobs</a></p>
              <p><a href="viewapplication.php">View Job applicants</a></p> 
			  <p><a href="viewqualificationadmin.php">View Qualifilication of the Job Applicants</a></p>      
              <p><a href="selectedcandidate.php">Selected Job Candidates</a></p>
              <p><a href="viewselectedcandidate.php">View Selected Job Candidates</a></p>   
			  <p><a href="viewcontact.php">View Inquiries</a></p> 
			   <p><a href="viewtestimonies.php">View Testimonies</a></p>            
 			  <p><a href="logout.php">Log out</a></p>
            </div>
<?php
}
else
{
?>
<?php
if($_SESSION['logintype'] == "Employee" )
{
?>
<div class="col-leftsidebar">
           	  <h2>System Clerk Menu</h2>
              <p><a href="dashboard.php">Home</a></p>  
              <p><a href="Employees_main.php?editid=<?php echo $_SESSION['empid']; ?>">Profile</a></p>                                 
              <p><a href="viewtrainingprogram.php">View training program</a></p>
			  <p><a href="viewtrainingformapplication.php">View Training program applicants</a></p> 
			  <p><a href="selectedcandidateadmin.php">Selected Training Candidates</a></p>
			   <p><a href="viewselectedcandidateadmin.php">View Selected Training Candidates</a></p>
              <p><a href="students.php">Add student</a></p>
              <p> <a href="viewstudents.php">View Students</a></p>
              <p><a href="viewjobs.php">View Jobs</a></p>
              <p><a href="viewapplication.php">View Job applicants</a></p>
              <p><a href="selectedcandidate.php">Selected Job candidates</a></p>
              <p><a href="viewselectedcandidate.php">View Selected Job candidates</a></p> 
			  <p><a href="viewcontact.php">View Inquiries</a></p>             
 			  <p><a href="logout.php">Log out</a></p>
            </div>
<?php
}
else
{
?>
<div class="col-leftsidebar">
           	  <h2>Counsellor Menu</h2>
              <p><a href="dashboard.php">Home</a></p>  
              <p><a href="Counsellors_main.php?editid=<?php echo $_SESSION['empid']; ?>">Profile</a></p>                                 
			  <p><a href="viewmessage.php">Reply Questions</a></p>             
 			  <p><a href="logout.php">Log out</a></p>
            </div>
<?php
}
}
?>