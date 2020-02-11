<?php
if(!isset($_SESSION)){
session_start();
$pagename = basename($_SERVER['PHP_SELF']); 
date_default_timezone_set("UTC"); 
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Career Guidance</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo_justified.css" rel="stylesheet">
  </head>

  <body>

    <div id="container" class="container">

        <a href="index.php" rel= "nofollow"></a>
        <img src="images/logo4.png" alt="Simplex Header" width="1150" height="157" class="img-responsive" />
        
        <ul class="nav nav-justified">         
           
           <li
          <?php
		  $pagename ="";
		  if($pagename == "index.php" || $pagename == "login.php" || $pagename == "dashboard.php")
		   echo "class='active'";
		  ?>>
          <?php
		  if(isset($_SESSION['regno']))
			{
			?>
			  <a href='studentpanel.php'>Student Panel</a>
			  <?php
			}
			else if(isset($_SESSION['empid']))
			{
			?>
			  <a href='dashboard.php'>Dashboard</a>	
			  <?php			
			}
			else
			{
			?>
				<a href='index.php'>Home</a>
				
				<?php
			}
		  ?>
          </li> 
          
          <li
          <?php
		  $pagename ="";
		  if($pagename == "company.php")
		   echo "class='active'";
		  ?>><a href="company.php">Companies</a></li>
          <li
          <?php
		  $pagename ="";
		  if($pagename == "job.php")
		   echo "class='active'";
		  ?>><a href="job.php">Jobs</a></li>
          <li
          <?php
		  $pagename ="";
		  if($pagename == "viewselectedcandidates.php")
		   echo "class='active'";
		  ?>><a href="viewselectedcandidates.php">Job Candidates</a></li>
          <li
          <?php
		  $pagename ="";
		  if($pagename == "displaytrainingprogram.php")
		   echo "class='active'";
		  ?>><a href="displaytrainingprogram.php">Training Program</a></li>          
          <li
		   <?php
		  $pagename ="";
		  if($pagename == "viewselectedcandidates.php")
		   echo "class='active'";
		  ?>><a href="viewselectedcandidatesadmin.php">Training Candidates</a></li>
          <li
          <?php
		  $pagename ="";
		  if($pagename == "contact.php")
		   echo "class='active'";
		  ?>><a href="contact.php">Contact</a></li>
        </ul>
