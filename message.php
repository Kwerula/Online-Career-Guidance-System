<?php
session_start();
include("dbconnection.php");
?>
        
		<script language="javascript">
function validate()
{
	if(document.form1.name.value=="")
	{
		alert("Please fill in your full Names!!");
		document.form1.name.focus();
		return false;
	}
	else if(document.form1.email.value=="")
	{
		alert("Please fill in your Email!!");
		return false;
	}
	else if(document.form1.subject.value=="")
	{
		alert("What is your inquiry About??");
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
				if(isset($_POST['submit']))
				{
					$sqlins = mysqli_query($con,"INSERT into messages(name,email,subject,message, status)VALUES('$_POST[name]','$_POST[email]','$_POST[subject]','$_POST[message]','Enabled')");
					if(!$sqlins)
			{
				echo mysqli_error($con);
			}
			else
			{
?>
		<script>
		alert("Mail sent successfully... The Counsellor Will Reply You as soon as Possible!!");
		</script>
<?php
			}
			}

				?>
                		<?php
include("header.php");
?>             
      	<div class="row space30"> <!-- row 1 begins -->
      
  <?php
  include("studentsidebar.php");
  ?>
  <div class="col-xs-12 col-sm-6 col-lg-8">
            <h2>Ask a Career Related Question!!</h2>
            <p>
<form role="form" name="form1" action="" method="post"  onSubmit="return validate()" enctype="multipart/form-data">
<table  class="tftable" width="534" height="650" border="1">

                  <div class="form-group">
                    <label for="name">Name:</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter your name">
                  </div>
                  <div class="form-group">
                    <label for="email">E-mail: </label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input name="subject" type="text" class="form-control" id="subject" placeholder="Enter your subject">
                  </div>
                  <div class="form-group">
                    <label for="message">Message:</label>
                  	<textarea name="message" rows="5" class="form-control" id="message" placeholder="Enter your message"></textarea>
				  </div>
                  <div class="checkbox">
                  
                  </div>
                  <input type="submit" name="submit" class="btn btn-default" value="Submit">
				  </table>
                </form>
				</p>
				</div>
      
     	</div> <!-- /row 1 -->
    <?php
	include("footer.php");
	?>