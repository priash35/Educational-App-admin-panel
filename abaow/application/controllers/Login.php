<?php

class Login extends CI_Controller
{

	public function index()
	{
		$this->load->view('superadmin/login');	
	}
	
	public function user_login()
	{
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		if ($this->form_validation->run()== TRUE) {
			
			$username = $_POST['username'];
			$password = $_POST['password'];

			//check data in database
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where(array('name' => $username, 'password' => $password));
			$query = $this->db->get();

			$user = $query->result();
			
			if(!empty($user)){
			
			foreach($user as $row)
			{
				$user_array=$row->role_id;
				$uname= $row->name;
			}
			//echo $user_array;
			//die();
											
				if ($user_array==1) {
				
						//temparny msg
						$this->session->set_flashdata("success","You Login success");
						
						//set session variables 
						$_SESSION['user_logged'] = TRUE;
						$_SESSION['username'] = $uname;
						
						//redirect to dashboard page
						redirect("Admin/dashboard","refresh");				
				}

				else
				{
					$this->session->set_flashdata("error","Invaled user");
					redirect("login/index","refresh");
				}
			
			}
		}
	}

	public function logout()
	{
		//$this->session->sess_destroy();
		$this->session->unset_userdata('user_logged');
		session_destroy();
		redirect("login/index","refresh");
	}
}

?>