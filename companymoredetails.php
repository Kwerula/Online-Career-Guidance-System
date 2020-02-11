<?php
session_start();
include("dbconnection.php");
include("header.php");



if(isset($_GET['companyid']))
{
$sql = "SELECT * FROM companies WHERE CompanyId = '$_GET[companyid]'";
$rescompany = mysqli_query($con,$sql);
$rs = mysqli_fetch_array($rescompany);

?>

      	 <div class="row space30"> <!-- row 1 begins -->
      
      		<div class="col-sm-6 col-lg-4">
           	  <h2><?php echo $rs['CompanyName']; ?></h2>
              <?php
                if($rs['CompanyLogo'] == "")
					{
					echo "<a href='companymoredetails.php?companyid=$rs[CompanyId]'><img src='images/noimage.jpg'  height='175' width='350'  class='img-responsive img-rounded img_bottom' ></a>";		
					}
					else
					{
					echo "<a href='companymoredetails.php?companyid=$rs[CompanyId]'><img src='uploadedfiles/$rs[CompanyLogo]'  height='175' width='350'   class='img-responsive img-rounded img_bottom' ></a>";
					}
					?>
                     <h2>Contact details</h2>
              	<p>
                  <?php
                echo str_replace(",",", <br>",$rs['Address']);
			  ?>
                </p>
                    <h2>Contact No.</h2>
              	<p>
                  <?php
                echo $rs['ContactNo'];
			  ?>
                </p>   
                  
                <h2>Website</h2>
              	<p>
                  	<?php
                		echo "<a href='$rs[Website]'>$rs[Website]</a>";
			  		?>
                </p>    	
            </div>
            
          <div class="col-xs-12 col-sm-6 col-lg-8">
              	<h2>About Company</h2>
            <p><?php
            echo $rs['CompanyInfo']; 
			?></p>
            <h2>Current Jobs Available:</h2>
			<?php
			$sql = "SELECT * FROM jobs where CompanyId='$_GET[companyid]'";
			$rescompany = mysqli_query($con,$sql);

			while($rs = mysqli_fetch_array($rescompany))
			{
				
			echo "<h4>";
			echo "<strong><img src='images/bullet_red.ico' />Job Title :</strong> ".ucfirst($rs['JobTitle']);
			echo "<hr></h4>";
			}
			?>   <br /> 
			
			<h2>Current Training Programs Available:</h2>
			<?php
			$sql = "SELECT * FROM trainingprogram where CompanyId='$_GET[companyid]'";
			$rescompany = mysqli_query($con,$sql);

			while($rs = mysqli_fetch_array($rescompany))
			{
				
			echo "<h4>";
			echo "<strong><img src='images/bullet_red.ico' />Training Program :</strong> ".ucfirst($rs['Title']);
			echo "<hr></h4>";
			}
			?> <br /> <br /> 
			

            	<h2>Selected Job Candidates:</h2>
			<?php
			$sql1 = "SELECT selectedcandidate.*, students.*, jobs.* FROM  selectedcandidate LEFT OUTER JOIN jobs ON selectedcandidate.JobId = jobs.JobId LEFT OUTER JOIN students ON selectedcandidate.RegNo = students.RegNo where (jobs.CompanyId = '$_GET[companyid]')";
			$rescompany1 = mysqli_query($con,$sql1);
			while($rs1 = mysqli_fetch_array($rescompany1))
			{
            echo "<div class='col-xs-6 col-sm-3'>";
					if($rs1['stimg'] == "")
					{
					echo "<img src='images/noimage.jpg'   class='img-responsive img-rounded img_left_gallery'   height='155' width='150'  >";		
					}
					else
					{
					echo "<img src='uploadedfiles/$rs1[stimg]'   class='img-responsive img-rounded img_left_gallery'    height='155' width='150'  >";
					}
			echo "<p align='center'>";
			echo ucfirst($rs1['FirstName']). " ". ucfirst($rs1['LastName']);
			echo "</p>";
            echo "</div>";
			}
			?>  <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
			
			
				<h2>Selected Training Candidates:</h2>
			<?php
			$sql1 = "SELECT selectedCdatetraining.*, students.*, trainingprogram.* FROM  selectedCdatetraining LEFT OUTER JOIN trainingprogram ON selectedCdatetraining.TrainingId = trainingprogram.TrainingId LEFT OUTER JOIN students ON selectedCdatetraining.RegNo = students.RegNo where (trainingprogram.CompanyId = '$_GET[companyid]')";
			$rescompany1 = mysqli_query($con,$sql1);
			while($rs1 = mysqli_fetch_array($rescompany1))
			{
            echo "<div class='col-xs-6 col-sm-3'>";
					if($rs1['stimg'] == "")
					{
					echo "<img src='images/noimage.jpg'   class='img-responsive img-rounded img_left_gallery'   height='155' width='150'  >";		
					}
					else
					{
					echo "<img src='uploadedfiles/$rs1[stimg]'   class='img-responsive img-rounded img_left_gallery'    height='155' width='150'  >";
					}
			echo "<p align='center'>";
			echo ucfirst($rs1['FirstName']). " ". ucfirst($rs1['LastName']);
			echo "</p>";
            echo "</div>";
			}
			?> 

            </div>
            
     	</div> <!-- /row 1 -->
        
        <div class="row space30"> <!-- row 2 begins --> 
        
            
        </div> <!-- /row 2 -->
      
   <?php
   }
	include("footer.php");
	?>