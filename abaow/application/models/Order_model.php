<?php

class Order_model extends CI_Model
{
	
	
	public function __construct()
	{
		parent ::__construct();
	}

	function insert_order($order,$user,$course,$fee,$status)
	 {                
	   $data = array(
        'order_id' => $order,
        'user_id' => $user,
        'course_id' => $course,
        'amount' => $fee,
        'status' => $status,        
		);	 
		if ($this->db->insert('orders', $data)){
		 return true;
		   }else{
		   	return false;
		   }
		
	 }
	 function change_status($order,$status)
	 {              
	   $data = array(
        'status' => $status,        
		);
	    $this->db->where('order_id',$order);
	  	$this->db->update('orders',$data);
	  	if ($this->db->affected_rows() > 0)
		{
  			return TRUE;
		}
		else
		{
		  return FALSE;
		}
	}

	 

}

?>