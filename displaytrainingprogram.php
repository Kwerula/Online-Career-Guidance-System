<?php
include("header.php");
include("dbconnection.php");
?>
      <div class="row space30"> <!-- row 1 begins -->
<?php

$sqltraining = mysqli_query($con,"SELECT * FROM  trainingprogram where status='Enabled' ORDER BY TPDatetime DESC ");
			while($rstraining = mysqli_fetch_array($sqltraining))
			{
?>
            <div class="col-md-4">
              	<h2><?php echo $rstraining['TrainingType']; ?></h2>
				<hr>  
                <b><font color='#0066FF'><strong>Training program Date/Time: </strong><?php echo $rstraining['TPDatetime']; ?></font></b>
              	<p><?php $rstraining['TPInfo']=""; echo $rstraining['TPInfo']; ?></p>
				
                <h4>Departments</h4>
                <ul>
                <?php
                	$tdept =$rstraining['TPDepartments'];
					$TPDepartments = str_replace('Null,','', $tdept);
                	echo $TPDepartments;
				?>
                </ul>
              <p><a class="btn btn-primary" href="trainingmoredetails.php?trainingid=<?php echo $rstraining['TrainingId']; ?>">More Info. &raquo;</a></p>
            </div>
<?php
			}
?>
      </div> <!-- /row 1 -->
      
    <?php
	include("footer.php");
	?>