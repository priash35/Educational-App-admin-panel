<?php
	if (isset($_POST["submit"])) {
		$name = $_POST['form_name'];
        $email = $_POST['form_email'];
        $subject = $_POST['form_subject'];
        $phone = $_POST['form_phone'];
        $message = $_POST['form_message'];
		$from = "From: $name<$email>\r\nReturn-path: $email"; 
		$to = 'prkadam2@gmail.com'; 
		$subject = 'Message from Contact Demo ';
		
		$body = "From: $name\n E-Mail: $email\n Message:\n $message";
		
		// Check if name has been entered
		if (!$_POST['form_name']) {
			$errName = 'Please enter your name';
		}
		
		// Check if email has been entered and is valid
		if (!$_POST['form_email'] || !filter_var($_POST['form_email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Please enter a valid email address';
		}
		
		//Check if message has been entered
		if (!$_POST['form_message']) {
			$errMessage = 'Please enter your message';
		}
		//Check if simple anti-bot test is correct
		/*if ($human !== 5) {
			$errHuman = 'Your anti-spam is incorrect';
		}*/
 
// If there are no errors, send the email
if (!$errName && !$errEmail && !$errMessage) {
	if (mail ($to, $subject, $body, $from)) {
		$result='<div>Thank You! I will be in touch</div>';
	} else {
		$result='<div>Sorry there was an error sending your message. Please try again later</div>';
	}
}
	}
?>