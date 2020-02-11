<?php
if(!isset($_SESSION)){
session_start();
}
include("dbconnection.php");
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <?php
 
  include("studentsidebar.php");
  ?>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>Home</h2>
            <p>&nbsp;</p>
          </div>
          
           <div class="col-md-4">
       	    <h4>Qualification</h4>
              	<img src="images/qualification.jpg" alt="Image 1" width="204" height="100"  class="img-responsive img-rounded img_left"  />  <br  /><br  /><br  /><br  /><br  /><br  />	
                <h4>No. of Qualification: 
                       <?php
$sql = mysqli_query($con,"SELECT * FROM qualification ");
echo mysqli_num_rows($sql);
?>
                </h4>  <hr />
                </div>
          
          <div class="col-md-4">
       	    <h4>Applied job details</h4>
              	<img src="images/appliedjobdetails.gif" alt="Image 1" width="204" height="100"  class="img-responsive img-rounded img_left"  /><br  /><br  /><br  /><br  /><br  /><br  />      
                 <h4> No. of applied jobs: 
<?php
$dt= date("Y-m-d");
$sql = mysqli_query($con,"SELECT * FROM applicationform where status='Enabled' AND RegNo='$_SESSION[regno]'");
echo mysqli_num_rows($sql);
?>
                </h4>
                <hr />
          </div>
          
            <div class="col-md-4">
           	  <h4>Applied Training Program</h4>
              	<img src="images/jde_training_services_img.jpg" alt="Image 1" width="204" height="100" class="img-responsive img-rounded img_left" /> 
                <br/>   <br/> <br/>   <br/>   <br/>   <br/>              
              	<h4>No. of applied training program:-
                  <?php
$sql = mysqli_query($con,"SELECT * FROM trainingprogram where status='Enabled'");
echo mysqli_num_rows($sql);
?></h4>
                <hr />
            </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
<?php 
include("footer.php");
?>