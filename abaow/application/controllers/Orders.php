<?php

class Orders extends CI_Controller
{
	public function create_order()
	{
		
		$this->load->model("Order_model");
		if(isset($_POST['user_id'])&&isset($_POST['course_id'])&&isset($_POST['fee'])){
			$order = uniqid();
			$user = $_POST['user_id'];
			$course = $_POST['course_id'];
			$fee = $_POST['fee'];
			$status = 'CREATED';
			
			$result = $this->Order_model->insert_order($order,$user,$course,$fee,$status);
			if ($result){
					$response['orderid'] = $order;
					$response['success'] = 1;
		            $response['message'] = "Order Created";
	        	
	             
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
	public function update_status()
	{
		
		$this->load->model("Order_model");
		if(isset($_POST['order_id'])&&isset($_POST['status'])){
			$order = $_POST['order_id'];			
			$status = $_POST['status'];
			
			$result = $this->Order_model->change_status($order,$status);
			if ($result){
				
					$response['success'] = 1;
		            $response['message'] = "Order updated";
	        	
	             
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

}
?>