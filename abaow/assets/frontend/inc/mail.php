<?php

		$name = $_POST['form_name'];
        $email = $_POST['form_email'];
        $subject = $_POST['form_subject'];
        $phone = $_POST['form_phone'];
        $message = $_POST['form_message'];
		$from = "From: ".$email."\r\nReturn-path: $email"; 
        $to = "suhas@yashallay.com, harsha@yashallay.com, ashish@yashallay.com";
		//$to = 'prkadam2@gmail.com'; 
	//$to ="prkadam2@gmail.com, snehaliburade@gmail.com";
                  // $to = 'snehaliburade@gmail.com'; 
		//$to = 'chetan@element45infotech.com'; 
		$subject = $subject;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		//$headers .= 'To: '.$to."\r\n";
		
		$headers .= 'From: '.$email."\r\n";
		
		$body = 'You have new enquiry. <br>
                               Name: '.$name.', <br>
                               Email id: '.$email.',<br> 
                               Phone No.: '.$phone.', <br>
                               Message: '.$message;
		
		// Check if name has been entered
		/*if (!$_POST['form_name']) {
			$errName = 'Please enter name';
		}
		
		// Check if email has been entered and is valid
		if (!$_POST['form_email'] || !filter_var($_POST['form_email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Please enter a valid email';
		}
		
		//Check if message has been entered
		if (!$_POST['form_message']) {
			$errMessage = 'Please enter your msg';
		}*/
		//Check if simple anti-bot test is correct
		/*if ($human !== 5) {
			$errHuman = 'Your anti-spam is incorrect';
		}*/
 
	// If there are no errors, send the email
	//if (!$errName && !$errEmail && !$errMessage) 
	//{
		if(mail($to, $subject, $body, $headers))
                //header('Location: http://yashallay.com/index.html');
		{
			//$result='Thank You!! I will be in touch';
			echo "Thank You!! We will be in touch with you soon. ";           
			
		        exit;

		}
		else
		{
			//$result='Sorry there was an error sending your message. Please try again later';
			echo "Sorry there was an error sending your message. Please try again later";
		}
		//echo $result;

	//}


