<?php

class Notifications extends CI_Controller
{

	public function getnotifications() {
			$response = array();
			$response['notifications'] = array();
			$notifications = array();
      		$notifications_x=array();
			$notification_data = array();
			
      		$this->load->Model('Notification_model');
      		$gennot = "";
          if (isset($_POST['id']))
          {
          	$user_id = $_POST['id'];
          	//$date_from = $_POST['date_from'];
          	$notifications = $this->Notification_model->get_notifications($user_id);
          	
            if ($notifications->num_rows()) {
	            foreach ($notifications->result() as $notifications) 
	            {
		            $notification_data['notification_id'] = $notifications->id;
		            $notification_data['notification'] = $notifications->message;
		            $notification_data['creation_date'] = $notifications->created;
		            array_push($response['notifications'],$notification_data);
	            
	             }               
             }
			$response['success'] = 1;
            $response['message'] = "success";                              
            echo json_encode($response);	          	
          }
          else
          {
        	$response['success'] = 0;
        	$response['message'] = "Required field missing";
        	echo json_encode($response);
        	}     

          
  }
}

?>