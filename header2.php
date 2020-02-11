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
		  if($pagename == "index2.php" || $pagename == "login.php" || $pagename == "dashboard.php")
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
		  if($pagename == "testimonials.php")
		   echo "class='active'";
		  ?>><a href="testimonials.php">Testimonials</a></li>
          <li
          <?php
		  $pagename ="";
		  if($pagename == "about.php")
		   echo "class='active'";
		  ?>><a href="about1.php">About the Company</a></li>
          <li
          <?php
		  $pagename ="";
		  if($pagename == "privacy.php")
		   echo "class='active'";
		  ?>><a href="privacy.php">Privacy</a></li>
        </ul>
