<?php

class User_model extends CI_Model
{
	
	
	public function __construct()
	{
		parent ::__construct();
	}

	function insert_user($username, $password,$email,$mobile,$city,$country,$language,$pin,$franchise)
	 {
		
		
                
	   $data = array(
        'name' => ucwords($username),
        'password' => $password,
        'email' => $email,
        'mobile' => $mobile,
        'city' => $city,
        'country' => $country,
        'otp'=> $pin,
        'language' => $language,
        'franchise_id' => $franchise,
		);


	  $exists = $this->User_model->user_exists($email,$mobile);
	  $count = count($exists);
	  if(empty($count)){
		if ($this->db->insert('users', $data)){
		 return true;
		   }else{
		   	return false;
		   }
		}else{
			return false;
		}

	 }
	function user_exists($email,$mobile)
	{
	    $this->db->select('*'); 
	    $this->db->from('users');
	    $this->db->where('email', $email);	    
		$this->db->or_where('mobile', $mobile);
	    $query = $this->db->get();
	    $result = $query->result();
	    return $result;
	}
	function validate_user($email,$password)
	{
	    $this->db->select('*'); 
	    $this->db->from('users');
	    $this->db->where('email', $email);	    
		$this->db->where('password', $password);
		$this->db->where('status', 'ACTIVE');
	    $query = $this->db->get();
	    //$result = $qu;
	    return $query;
	}
	function user_otp($mobile,$otp)
	{
	    $this->db->select('*'); 
	    $this->db->from('users');
	    $this->db->where('otp', $otp);	    
		$this->db->where('mobile', $mobile);
	    $query = $this->db->get();
	    //$result = $query->result();
	    return $query;
	}
	function activate_user($mobile)
	{
	    $this->db->set('status', 'ACTIVE'); //value that used to update column  
		$this->db->where('mobile', $mobile); //which row want to upgrade  
		$this->db->update('users');
	    return true;
	}
	function user_exists_mobile($mobile)
	{
	    $this->db->select('*'); 
	    $this->db->from('users');	    
		$this->db->where('mobile', $mobile);
	    $query = $this->db->get();
	    //$result = $query->result();
	    if ($query->num_rows()) { 
	    	return true;
	    }else{
	    	return false;
	    }
	    
	}
	function reset_pin($mobile)
	{
		$pin = mt_rand(100000, 999999);		
	    $this->db->set('otp', $pin);
	    
		$this->db->where('mobile', $mobile); //which row want to upgrade  
		$this->db->update('users');
	    return $pin;
	}
	function reset_password($mobile)
	{
		$pwd = mt_rand(10000000, 99999999);		
	    //$this->db->set('otp', $pin);
	    /*$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$charactersLength = strlen($characters);
    	$pwd = '';
		for ($i = 0; $i < 8; $i++) {
				        $pwd .= $characters[rand(0, $charactersLength - 1)];
		}*/
	    $this->db->set('password', $pwd); //value that used to update column  
		$this->db->where('mobile', $mobile); //which row want to upgrade  
		$this->db->update('users');
	    return $pwd;
	}
	function getuserinfo($id)
	{
	    $this->db->select('*'); 
	    $this->db->from('users');	    
	    $this->db->where('id',$id);	 
	    $query = $this->db->get();	    
	    return $query;
	}
	function update_user($id,$username, $password,$email,$mobile,$city,$country,$language)
	 {
		
                
	   $data = array(
        'name' => $username,
        'password' => $password,
        'email' => $email,
        'mobile' => $mobile,
        'city' => $city,
        'country' => $country,
        'language' => $language              
		);
	   
	   $this->db->trans_start();
	    $this->db->where('id',$id);
	  	$this->db->update('users',$data);
	  	$this->db->trans_complete();
	  	if ($this->db->affected_rows() > 0)
		{
  			return TRUE;
		}
		elseif ($this->db->trans_status() === FALSE) {
        		return false;
		}else{
		  return TRUE;
		}
		
	}
	function getcity($id)
	{
	    $this->db->select('*'); 
	    $this->db->from('city');	    
	    $this->db->where('country_id',$id);	 
	    $this->db->order_by("city_name", "asc");
	    $query = $this->db->get();	    
	    return $query;
	}
	function getcountry()
	{
	    $this->db->select('*'); 
	    $this->db->from('country');	  
	    $this->db->order_by("country_name", "asc");  
	    $query = $this->db->get();	    
	    return $query;
	}
	function getlanguage()
	{
	    $this->db->select('*'); 
	    $this->db->from('language');	    
	    $query = $this->db->get();	    
	    return $query;
	}
	function insertmessage($id,$message)
	 {	 
	   $this->db->select('email,name'); 
	    $this->db->from('users');
	    $this->db->where('id', $id); 		
	    $query = $this->db->get();
	    
	   $data = array(
		        'user' => $id,
		        'message' => $message,     
		        'email' => $query->first_row()->email,
		        'subject' => "Message from ".ucwords($query->first_row()->name),  
		);	  
		$this->db->insert('communications', $data);
		
		return true;
	 }
	 function getEmails()
	{
	    $this->db->select('*'); 
	    $this->db->from('communications');
	    $this->db->where('status', 'NOT SENT');	    
	    $query = $this->db->get();	    
	    return $query->result();
	}
	 
	function getPhone($userid)
	{
		$this->db->select('mobile'); 
	    $this->db->from('users');
	    $this->db->where('id', $userid);	    
	    $query = $this->db->get();	    
	    return $query->result();
	}
	function getuserinfoall($id)
	{
	    $this->db->select('*'); 
	    $this->db->from('users');
	    $this->db->join('city', 'city.id = users.city');
	    $this->db->join('country', 'country.id = users.country');	    
	    $this->db->where('users.id',$id);	 
	    $query = $this->db->get();	    
	    return $query;
	}

	function get_blogs($id)									//20 mar 2018  blogs
	{											//updated 4 april 2018
		$this->db->select('blogs.id,blogs.blog_title,blogs.blog_lang,blogs.blog_img,blogs.blog_content');
		$this->db->from('blogs');
		$this->db->join('users','users.language=blogs.blog_lang');
		$this->db->where('users.id',$id);
		$this->db->order_by('blog_created','DESC');
		$query= $this->db->get();
		return $query;
		
	}
	
															//28 april 2018  url
	public function get_url()
	{
		$this->db->select('video_url');
		$this->db->from('video');
		$query = $this->db->get();  
        return $query;
	}

}

?>