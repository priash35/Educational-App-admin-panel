<?php
if (isset($_REQUEST['form_email']))  
{
  
  //Email information
  $admin_email = "prkadam2@gmail.com";
  $email = $_REQUEST['form_email'];
  $subject = $_REQUEST['form_subject'];
  $comment = $_REQUEST['form_message'];
  
  //send email
  mail($admin_email, $subject, $comment, "From:" . $email);
  
  //Email response
  echo "Thank you for contacting us!";
  }
  
  //if "email" variable is not filled out, display the form
  else  {
	  echo "Error in submitting...";
  }
?>
