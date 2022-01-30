<?php

class Users extends CI_Controller
{

	/*public function create_user()									//v1 function
	{
		
		$this->load->model("User_model");
		if(isset($_POST['name'])&&isset($_POST['password'])&&isset($_POST['email'])&&isset($_POST['mobile'])){
			$user = $_POST['name'];
			$pwd = $_POST['password'];
			$email = $_POST['email'];
			$mobile = $_POST['mobile'];
			$city = $_POST['city'];
			$country = $_POST['country'];
			$language = $_POST['language'];
			$franchise = $_POST['franchise'];
			
			
			
			$nostring="utm_source";
			if( strpos( $franchise, $nostring ) !== false ) {
    			$franchise="None";
			}
			$pin = mt_rand(100000, 999999);
			$result = $this->User_model->insert_user($user,$pwd,$email,$mobile,$city,$country,$language,$pin,$franchise);
			if ($result){
				if ($this->sendSMS($mobile,'Your pin is '.$pin)){
					$response['success'] = 1;
		            $response['message'] = "User Created";
	        	}
	             
			}else{
				$response['success'] = 0;
	             $response['message'] = "Error";
	               
			}
			 
		 } else{
		 	$response['success'] = 0;
            $response['message'] = "Incomplete Parameters";
		 }    
		 echo json_encode($response);
	}*/
	
	public function create_user()									//new v2 updated on 4 april 2018
	{		
		
		$this->load->model("User_model");
		if(isset($_POST['name'])&&isset($_POST['password'])&&isset($_POST['email'])&&isset($_POST['mobile'])){
			$user = $_POST['name'];
			$pwd = $_POST['password'];
			$email = $_POST['email'];
			$mobile = $_POST['mobile'];
			$city = $_POST['city'];
			$country = $_POST['country'];
			$language = $_POST['language'];
			$franchise = $_POST['franchise'];
			
			/*--------- enable/disable franchise----------*/
			/*if($franchise!="None"){
			$sql="select status from franchise where franchise_id='$franchise'";		//updated on 9 april and 20 april 2018
			$query= $this->db->query($sql);
			
			$row=$query->row(0);
			
			$status=$row->status;
			
			if($status=='INACTIVE'){
				$franchise="None";
			}
			}*/
			/*---------------*/
			
			$nostring="utm_source";
			if( strpos( $franchise, $nostring ) !== false ) {
    			$franchise="None";
			}
			$pin = mt_rand(100000, 999999);
			$result = $this->User_model->insert_user($user,$pwd,$email,$mobile,$city,$country,$language,$pin,$franchise);
			
			
			if ($result)
			{
				if($country==101)
				{
					if ($this->sendSMS($mobile ,'Your pin is '.$pin))
					{
						$response['success'] = 1;
			           		 $response['message'] = "User Created";
		        		}
		        		
		        		else
					{
						$response['success'] = 0;
			           		  $response['message'] = "Error:national user";
	               
					}
		            	 }
		            	 else
		            	 {
		             		if ($this->send_email_otp($email,'Your pin is '.$pin))
		             		{
						$response['success'] = 1;
			           		 $response['message'] = "User Created";
		        		}
		        		
		        		else
					{
						$response['success'] = 0;
			           		  $response['message'] = "Error:international user";
	               
					}
		              }
			}
			else
			{
				$response['success'] = 0;
	           		  $response['message'] = "Error";
	               
			}
			 
			 } else{
			 		$response['success'] = 0;
	            			$response['message'] = "Incomplete Parameters";
			 }    
		 echo json_encode($response);
	}
	
	public function login_user()
	{
		
		$this->load->model("User_model");
		$this->load->model("Course_model");
		$response['usercourse'] = array();
		if(isset($_POST['name'])&&isset($_POST['password'])){
			$email = $_POST['name'];
			$pwd = $_POST['password'];			
			$result = $this->User_model->validate_user($email,$pwd);
			if ($result->num_rows()){
				$user = $result->row();
				$courses = $this->Course_model->get_courses($user->id);
				$response['usercourse'] = $courses->result();
				$response['success'] = 1;
				$response['userdata'] = $result->row();
	            $response['message'] = "Success";
	             
			}else{
				$response['success'] = 0;
	             $response['message'] = "User does not exist";
	               
			}
			 
		 } else{
		 	$response['success'] = 0;
            $response['message'] = "Incomplete Parameters";
		 }    
		 echo json_encode($response);
	}
	public function other_courses()
	{
		$id=$_POST['userid'];
		//$id =21;
		$this->load->model("Course_model");
		$courses = $this->Course_model->get_other_courses($id);
		$response['usercourse'] = $courses->result();
		$response['success'] = 1;
		
	    $response['message'] = "Success";
		echo json_encode($response);
	}

	public function logout()
	{
		//$this->session->sess_destroy();
		$this->session->unset_userdata('user_logged');
		session_destroy();
		redirect("login/index","refresh");
	}
	public function check_otp() {
      $this->load->model("User_model");
      $response = array();    
              if (isset($_POST['mobile']) && isset($_POST['otp'])) {

                $mobile = $_POST['mobile'];
                $otp = $_POST['otp'];

                
                $user = $this->User_model->user_otp($mobile,$otp);
                if ($user->num_rows()) {                    
                    $this->User_model->activate_user($mobile);
                    $response['success'] = 1;
                    $response['message'] = "Status updated";
                    echo json_encode($response);

                }else{

                    $response['success'] = 0;
                    $response['message'] = "Incorrect mobile or otp";
                    echo json_encode($response);                  

                }

              }else{
                  $response['success'] = 0;
                  $response['message'] = "Required field missing";
                  echo json_encode($response);
              }
      // }
	}
	
	/*public function resend_pin() {								//v1 function
             //echo $this->Student->getLastInsertID();
		$this->load->model("User_model");
      $response = array();
      if (isset($_POST['mobile'])) 
      {
          $mobile = $_POST['mobile'];  
          
          if ($this->User_model->user_exists_mobile($mobile)) {               
          	   $pin = $this->User_model->reset_pin($mobile);

			   $sms_result = $this->sendSMS($mobile,'Your new pin is '.$pin);
          	   if ($sms_result){          
                     $response['success'] = 1;
                     $response['message'] = "OTP Sent";

                  }
                  else {
                     $response['success'] = 0;
                     $response['message'] = "SMS not sent";

                  }
              }else{
               //   echo "Cant delete";
                  $response['success'] = 0;
                  $response['message'] = "User not found";
                 // die();
          		}
      }else{
          $response['success'] = 0;
          $response['message'] = "Required parameter missing";
      }
      echo json_encode($response);
  }*/
  
  public function resend_pin() {								//new v2 updated on 4 april 2018
             //echo $this->Student->getLastInsertID();
		$this->load->model("User_model");
      $response = array();
      if (isset($_POST['mobile'])) 
      {
          $mobile = $_POST['mobile'];  
          
          if ($this->User_model->user_exists_mobile($mobile)) 
		  {               
          	   $pin = $this->User_model->reset_pin($mobile);

				$sql="select email,country from users where mobile=$mobile";
				$query= $this->db->query($sql);
				$array=$query->result_array();
				//$row=$query->row(0);
				//print_r($array);
				
				 $email=($array[0]['email']);
				$country=($array[0]['country']);
				//die();
						if($country==101){
					   
					   $sms_result = $this->sendSMS($mobile,'Your new pin is '.$pin);
					   if ($sms_result){          
							 $response['success'] = 1;
							 $response['message'] = "SMS OTP Sent";
						  }
						  else {
							 $response['success'] = 0;
							 $response['message'] = "SMS not sent";
						  }
					}
					else
					{
						if ($this->send_email_otp($email,'Your new pin is '.$pin))
		             		{
							 $response['success'] = 1;
			           		 $response['message'] = "Email OTP Sent";
		        		}
		        		else
						{
							$response['success'] = 0;
							$response['message'] = "Email not sent";
					   
						}
					}
	  }
			 else
			 {
               //   echo "Cant delete";
                  $response['success'] = 0;
                  $response['message'] = "User not found";
                 // die();
          	}
      }else{
          $response['success'] = 0;
          $response['message'] = "Required parameter missing";
      }
      echo json_encode($response);
  }
  
 /* public function reset_password() {								//v1 function
             //echo $this->Student->getLastInsertID();
		$this->load->model("User_model");
      $response = array();
      if (isset($_POST['mobile'])) 
      {
          $mobile = $_POST['mobile'];  
          
          if ($this->User_model->user_exists_mobile($mobile)) {               
          	   $pin = $this->User_model->reset_password($mobile);

			   $sms_result = $this->sendSMS($mobile,'Your password has been reset. You new password is '.$pin.'.');
          	   if ($sms_result){          
                     $response['success'] = 1;
                     $response['message'] = "OTP Sent";

                  }
                  else {
                     $response['success'] = 0;
                     $response['message'] = "SMS not sent";

                  }
              }else{
               //   echo "Cant delete";
                  $response['success'] = 0;
                  $response['message'] = "User not found";
                 // die();
          		}
      }else{
          $response['success'] = 0;
          $response['message'] = "Required parameter missing";
      }
      echo json_encode($response);
  }*/
  
  public function reset_password() {								//new v2 updated on 4 april 2018
             //echo $this->Student->getLastInsertID();
		$this->load->model("User_model");
      $response = array();
      if (isset($_POST['mobile'])) 
      {
          $mobile = $_POST['mobile'];  
          
          if ($this->User_model->user_exists_mobile($mobile)) 
		  {               
				   $pin = $this->User_model->reset_password($mobile);
				   
				   $sql="select email,country from users where mobile=$mobile";
				$query= $this->db->query($sql);
				$array=$query->result_array();
				//$row=$query->row(0);
				//print_r($array);
				
				 $email=($array[0]['email']);
				$country=($array[0]['country']);
				//die();
						if($country==101)
						{
						   $sms_result = $this->sendSMS($mobile,'Your password has been reset. You new password is '.$pin.'.');
						   if ($sms_result)
						   {          
								 $response['success'] = 1;
								 $response['message'] = "SMS OTP Sent";
						   }
						   else 
							{
								 $response['success'] = 0;
								 $response['message'] = "SMS not sent";
							}
						}
						else
						{
							if ($this->send_email_otp($email,'Your password has been reset. You new password is '.$pin))
							{
								 $response['success'] = 1;
								 $response['message'] = "Email OTP Sent";
							}
							
							else
							{
								$response['success'] = 0;
								$response['message'] = "Email not sent";
						   
							}
						}
			  }
			  else
			  {
               //   echo "Cant delete";
                  $response['success'] = 0;
                  $response['message'] = "User not found";
                 // die();
          	}
      }
	  else
	  {
          $response['success'] = 0;
          $response['message'] = "Required parameter missing";
      }
      echo json_encode($response);
  }
  
  public function get_user() {	
             //echo $this->Student->getLastInsertID();
		$this->load->model("User_model");
      $response = array();
      if (isset($_POST['userid'])) 
      {
          $id = $_POST['userid'];  
          
         $userinfo =  $this->User_model->getuserinfo($id);	
         
          	   
          	   if ($userinfo->num_rows()){
          	   		$response['userinfo'] = $userinfo->result();          
                     $response['success'] = 1;
                     $response['message'] = "User Found";
                  }
                  else{               
                  $response['success'] = 0;
                  $response['message'] = "User not found";
                
          		}
      }else{
          $response['success'] = 0;
          $response['message'] = "Required parameter missing";
      }
      echo json_encode($response);
  }
  public function update_user()
	{
		
		$this->load->model("User_model");
		if(isset($_POST['id'])&&isset($_POST['name'])&&isset($_POST['password'])&&isset($_POST['email'])&&isset($_POST['mobile'])){
			
			$user = $_POST['name'];
			$pwd = $_POST['password'];
			$email = $_POST['email'];
			$mobile = $_POST['mobile'];
			$city = $_POST['city'];
			$country = $_POST['country'];
			$language = $_POST['language'];
			$id = $_POST['id'];
			/*$user = 'chetan';
			$pwd = 'satyam123';
			$email ='cj@gmail.com';
			$mobile = '9561235305';
			$city = '1';
			$country = '1';
			$language = '1';
			$id = '3';*/

			$result = $this->User_model->update_user($id,$user,$pwd,$email,$mobile,$city,$country,$language);
			if ($result){
				$response['success'] = 1;
	            $response['message'] = "User Updated";
	             
			}else{
				$response['success'] = 0;
	             $response['message'] = "Error";
	               
			}
			 
		 } else{
		 	$response['success'] = 0;
            $response['message'] = "Incomplete Parameters";
		 }    
		 echo json_encode($response);
	}
	public function curr_courses()
	{
		$id=$_POST['userid'];
		//$id = 26;
		$this->load->model("Course_model");
		$courses = $this->Course_model->get_courses($id);
		$response['usercourse'] = $courses->result();
		$response['success'] = 1;		
	    $response['message'] = "Success";
		echo json_encode($response);
	}
	public function getcity()
	{
	    $id=$_POST['countryid'];
	    $this->db->select('*'); 
	    $this->db->from('city');	    
	    $this->db->where('country_id',$id);	 
	    $this->db->order_by("city_name", "asc");
	    $query = $this->db->get();	   
	    $response['city'] = $query->result();
		$response['success'] = 1;		
	    $response['message'] = "Success";
		echo json_encode($response);
	}
	public function getcountry()
	{
	    /*$this->db->select('*'); 
	    $this->db->from('country');	    
	    $query = $this->db->get();	    */
	    $this->load->model("User_model");
	    $query = $this->User_model->getcountry();
	    $response['country'] = $query->result();
		$response['success'] = 1;		
	    $response['message'] = "Success";
		echo json_encode($response);
	}
	public function getlanguage()
	{
	    $this->db->select('*'); 
	    $this->db->from('language');	    
	    $query = $this->db->get();	    
	    $response['language'] = $query->result();
		$response['success'] = 1;		
	    $response['message'] = "Success";
		echo json_encode($response);
	}
   /* public function addFeedbackapp() {							//v1 function
             //echo $this->Student->getLastInsertID();
		$this->load->model("User_model");
      $response = array();
      if (isset($_GET['userid'])) 
      {
          $id = $_GET['userid']; 
          $message = $_GET['message']; 
          
         $userinfo =  $this->User_model->insertmessage($id,$message);	 
          	   
          	   if ($userinfo){
          	   		$this->send_email();          	   		      
                     $response['success'] = 1;
                     $response['message'] = "Success";
                  }
                  else{               
                  $response['success'] = 0;
                  $response['message'] = "Error";
                
          		}
      }else{
          $response['success'] = 0;
          $response['message'] = "Required parameter missing";
      }
      echo json_encode($response);
  }*/
  
  public function addFeedbackapp() {							//new v2 updated on 4 april 2018
             //echo $this->Student->getLastInsertID();
		$this->load->model("User_model");
      $response = array();
     if (isset($_POST['userid'])) 
     
     {
          $id = $_POST['userid']; 
          
         // echo"$id";
          $message = $_POST['message']; 
          
         $userinfo =  $this->User_model->insertmessage($id,$message);	 
          	   
          	   if ($userinfo){
          	   		$this->send_email();          	   		      
                     $response['success'] = 1;
                     $response['message'] = "Success";
                  }
                  else{               
                  $response['success'] = 0;
                  $response['message'] = "Error";
                
          		}
          		
          		
          	//print_r( $userinfo);
          	//die();
      }else{
         $response['success'] = 0;
          $response['message'] = "Required parameter missing";
    }
      echo json_encode($response);
  }

  public function completedcourses()
	{
		$id=$_POST['userid'];
		//$id = 3;
		$this->load->model("Course_model");
		$courses = $this->Course_model->get_completed_courses($id);
		$response['usercourse'] = $courses->result();
		$response['success'] = 1;
		
	    $response['message'] = "Success";
		echo json_encode($response);
	}
	
	public function send_email(){							//new v2 updated on 4 april 2018
		$this->load->model("User_model");
		$this->load->library('email');
		//$config['protocol']    = 'smtp';
		/*$config['smtp_host']    = 'ssl://smtp.gmail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'chetandjoshi@gmail.com';
		$config['smtp_pass']    = 'satyam123';*/
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'text'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not 
		$this->email->initialize($config);
		$email_list = $this->User_model->getEmails();
		
		
		$semi_rand = md5(time());
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

		foreach ($email_list as $row)
		{
			$userid=$row->user;
			$from_email= $row->email;
			$phone= $this->User_model->getPhone($userid);
			
			$mobile= $phone[0]->mobile;		
			$message= $row->message;
			
			$message.="\r\n My Email id: ".$from_email;
			$message.="\r\n and Mobile Number: ".$mobile;
			
		//$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n"."Content-Transfer-Encoding: 7bit\n\n" . $row->message. "\n\n";
		$this->email->from($from_email, 'Customer');
		$this->email->to('support@abaow.com'); 
		//$this->email->to('development@punegravity.com'); 
		$this->email->subject($row->subject);
		$this->email->message($message);
		
		if ($this->email->send()){
			$data = array(
        	'status' => 'SENT',        
			);
			$this->db->where('id',$row->id);
	  		$this->db->update('communications',$data);	  		
			}
		}
		//echo $this->email->print_debugger();
	}
	function sendSMS($mobileNumber, $text)
    {
    /*Send SMS using PHP*/    
    
    //Your authentication key
    $authKey = "187669ADLIuXTsTYiD5a2e8d17";
    
    //Multiple mobiles numbers separated by comma
   // $mobileNumber = "9561235305";
    
    //Sender ID,While using route4 sender id should be 6 characters long.
    $senderId = "ABAOWS";
    
    //Your message to send, Add URL encoding here.
    $message = urlencode($text);
    
    //Define route 
    $route = "4";
    //Prepare you post parameters
    $postData = array(
        'authkey' => $authKey,
        'mobiles' => $mobileNumber,
        'message' => $message,
        'sender' => $senderId,
        'route' => $route
    );
    
    //API URL
    $url="https://control.msg91.com/api/sendhttp.php";
    
    // init the resource
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData
        //,CURLOPT_FOLLOWLOCATION => true
    ));
    

    //Ignore SSL certificate verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    
    //get response
    $output = curl_exec($ch);
    
    //Print error if any
    if(curl_errno($ch))
    {
        echo 'error:' . curl_error($ch);
        return 0;
    }
    
    curl_close($ch);
    return 1;

    
  //  echo $output;
}
public function get_user_info() {	
             //echo $this->Student->getLastInsertID();
		$this->load->model("User_model");
      $response = array();
      if (isset($_POST['userid'])) 
      {
          $id = $_POST['userid'];  
          
         $userinfo =  $this->User_model->getuserinfoall($id);	
         
          	   
          	   if ($userinfo->num_rows()){
          	   		$response['userinfo'] = $userinfo->result();          
                     $response['success'] = 1;
                     $response['message'] = "User Found";
                  }
                  else{               
                  $response['success'] = 0;
                  $response['message'] = "User not found";
                
          		}
      }else{
          $response['success'] = 0;
          $response['message'] = "Required parameter missing";
      }
      echo json_encode($response);
  }


//7 feb 2018
	public function create_user_isd()
	{
		
		$this->load->model("User_model");
		if(isset($_GET['name'])&&isset($_GET['password'])&&isset($_GET['email'])&&isset($_GET['mobile'])){
			$user = $_GET['name'];
			$pwd = $_GET['password'];
			$email = $_GET['email'];
			$mobile = $_GET['mobile'];
			$city = $_GET['city'];
			$country = $_GET['country'];
			 $language = $_GET['language'];
			 $franchise = $_GET['franchise'];
			$nostring="utm_source";
			if( strpos( $franchise, $nostring ) !== false ) {
    			$franchise="None";
			}
			 $pin = mt_rand(100000, 999999);
			$result = $this->User_model->insert_user($user,$pwd,$email,$mobile,$city,$country,$language,$pin,$franchise);
			
			//7 feb
			
			/*$sql="select country_ISD from country where id=$country";
			$query= $this->db->query($sql);
			//$mod=$query->result_array();
			$row=$query->row(0);
			
			$isd=$row->country_ISD;
			$mob=$isd.$mobile;
			/* echo $mob;
			die(); */
			
			if ($result){
				if ($this->sendSMS($mobile,'Your pin is '.$pin)){
					$response['success'] = 1;
		            $response['message'] = "User Created";
	        	}
	             
			}else{
				$response['success'] = 0;
	             $response['message'] = "Error";
	               
			}
			 
		 } else{
		 	$response['success'] = 0;
            $response['message'] = "Incomplete Parameters";
		 }    
		 echo json_encode($response);
	}
	
	
	
	function sendSMS_test($mobileNumber, $text)				//unused
    {
    /*Send SMS using PHP*/    
    
    //Your authentication key
    $authKey = "187669ADLIuXTsTYiD5a2e8d17";
    
    //Multiple mobiles numbers separated by comma
   // $mobileNumber = "9561235305";
    
    //Sender ID,While using route4 sender id should be 6 characters long.
    $senderId = "ABAOWS";
    
    //Your message to send, Add URL encoding here.
    $message = urlencode($text);
    
    //Define route 
    $route = "4";
    //Prepare you post parameters
    $postData = array(
        'authkey' => $authKey,
        'mobiles' => $mobileNumber,
        'message' => $message,
        'sender' => $senderId,
        'route' => $route
    );
    
    //API URL
    $url="https://control.msg91.com/api/sendhttp.php";
    
    // init the resource
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData
        //,CURLOPT_FOLLOWLOCATION => true
    ));
    

    //Ignore SSL certificate verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    
    //get response
    $output = curl_exec($ch);
    
    //Print error if any
    if(curl_errno($ch))
    {
        echo 'error:' . curl_error($ch);
        return 0;
    }
    
    curl_close($ch);
    return 1;

    
  //  echo $output;
}

	public function send_email_otp($email,$text){											//19_mar
		$this->load->model("User_model");									//updated on 4 april 2018
		$this->load->library('email');
		//$config['protocol']    = 'smtp';
		/*$config['smtp_host']    = 'ssl://smtp.gmail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'chetandjoshi@gmail.com';
		$config['smtp_pass']    = 'satyam123';*/
		
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'text'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not 
		$this->email->initialize($config);
		//$email_list = $this->User_model->getEmails();
		//$email='snehaliburade@gmail.com'; 
		//$text='Your pin is 111111';
	
		
		$semi_rand = md5(time());
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

		
			
		//$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n"."Content-Transfer-Encoding: 7bit\n\n" . $row->message. "\n\n";
		$this->email->from('support@abaow.com','Rich n Happy App');
		$this->email->to($email); 
		$this->email->subject('Rich N Happy App registration OTP');
		$this->email->message($text);
		$this->email->send();
		
		 return 1;
	}

	/*--------------------Blogs---------------------*/					//20_mar_2018
												// updated on 4 april 2018
	 public function getblogs()
	{
		//$id=$_GET['userid'];
		$id=$_POST['userid'];
		//$id = 3;
		$this->load->model("User_model");
		$courses = $this->User_model->get_blogs($id);
		$response['blogs'] = $courses->result();
		$response['success'] = 1;
		
	    $response['message'] = "Success";
		echo json_encode($response);
	}
	
/*--------------------video Url---------------------*/					//20_mar_2018

	public function get_video_url()
	{
		$this->load->model("User_model");
		$courses = $this->User_model->get_url();
		$response['url'] = $courses->result();
		$response['success'] = 1;
		
	    $response['message'] = "Success";
		echo json_encode($response);
	}


}

?>