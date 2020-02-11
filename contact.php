<?php
if(!isset($_SESSION)){
session_start();
}
include("header.php");
include("dbconnection.php");
?>
      	<div class="row space30"> <!-- row 1 begins -->
      
            <div class="col-md-6">
           	  <h2>Career Guidance Company</h2>
              	<p>It is a portal where graduated students from colleges and universities can apply for jobs and the companies which have registered with this portal can select suitable candidates according with their credentials.</p>
              	<p>It is a recognized company that has helped thousands of graduates to get their Dream Jobs. 
                
              	<h3>Office Addresss</h3>
               P.B.No.513,Eldoret,<br>
               Eldoret-575 002,<br >
               TEL:0222-221844,<br>
               E-mail:careerguidance@gmail.com<br >
               Website:www.careerguidance.org</p>
                
                <h3>Career Guidance Cell</h3>
                <p><br>
				Contact No:+254703455678</p>
            </div>
        
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
            <div class="col-md-6">
              	<h2>Contact Us</h2>
              	<p>You may send us a message!!</p>
                <?php
				if(isset($_POST['submit']))
				{
					$sqlins = mysqli_query($con,"INSERT into contact(name,email,subject,message, status)VALUES('$_POST[name]','$_POST[email]','$_POST[subject]','$_POST[message]','Enabled')");
					if(!$sqlins)
			{
				echo mysqli_error($con);
			}
			else
			{
?>
		<script>
		alert("Mail sent successfully... The Admin Will Reply You as soon as Possible!!");
		</script>
<?php
			}
			}
				?>
                <form role="form" name="form1" action="" method="post"  onsubmit="return validate()">
                  <div class="form-group">
                    <label for="name">Name:</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter your name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email: (Your Mail will not be published)</label>
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
                </form>
           </div>
      
     	</div> <!-- /row 1 -->
    <?php
	include("footer.php");
	?>