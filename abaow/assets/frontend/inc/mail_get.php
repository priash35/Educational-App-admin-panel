<?php
	//if (isset($_GET["submit"])) {
		$name = $_GET['form_name'];
        $email = $_GET['form_email'];
        $subject = $_GET['form_subject'];
        $phone = $_GET['form_phone'];
        $message = $_GET['form_message'];
		$from = "From: ".$email."\r\nReturn-path: $email"; 
		$to = 'prkadam2@gmail.com'; 
		//$to = 'chetan@element45infotech.com'; 
		$subject = 'Message from Contact Demo ';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'To: '.$to."\r\n";
		
		$headers .= 'From: '.$email."\r\n";
		echo "Header ".$headers;
		$body = $message;
		echo "Message ".$message;
		// Check if name has been entered
		if (!$_GET['form_name']) {
			$errName = 'Please enter your name';
		}
		
		// Check if email has been entered and is valid
		if (!$_GET['form_email'] || !filter_var($_GET['form_email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Please enter a valid email address';
		}
		
		//Check if message has been entered
		if (!$_GET['form_message']) {
			$errMessage = 'Please enter your message';
		}
		//Check if simple anti-bot test is correct
		/*if ($human !== 5) {
			$errHuman = 'Your anti-spam is incorrect';
		}*/
 
// If there are no errors, send the email
if (!$errName && !$errEmail && !$errMessage) {
	if (mail($to, $subject, $body, $headers)) {
		//$result='<div>Thank You!! I will be in touch</div>';
               echo "Thank You!! I will be in touch";
               header('Location: http://yashallay.com/thanks.html');
	} else {
		//$result='<div>Sorry there was an error sending your message. Please try again later</div>';

	}
	echo $result;
}

//	}
?>