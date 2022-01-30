<?php

class Notification_model extends CI_Model
{
	
	
	public function __construct()
	{
		parent ::__construct();
	}

	
	function get_notifications($userid)
	{
	    /*$this->db->select('max(Notification.created) as dcreated'); 
	    $this->db->from('notifications');
	    $this->db->where('userid', $userid);
	    $this->db->where('status', 'READ');
	    $search_date =  $this->db->get_compiled_select();
	    if ($search_date==""){ $search_date = 0;}*/

	    $this->db->select('*'); 
	    $this->db->from('notifications');
	    $this->db->where('userid', $userid);
	    $this->db->where('status', 'UNREAD');
	    $query=$this->db->get();
	    $data = array(
        'status' => 'READ',       
		);
		$this->db->where('userid', $userid);
	    $this->db->where('status', 'UNREAD');
	  	$this->db->update('notifications',$data); 
	    
	    return $query;
	}
	
	 

}

?>