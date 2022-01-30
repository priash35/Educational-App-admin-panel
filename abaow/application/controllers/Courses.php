<?php

class Courses extends CI_Controller
{

	public function course_curriculum()
	{
		
		$this->load->model("Course_model");
		if(isset($_POST['id'])&&isset($_POST['user_id'])){
			$id = $_POST['id'];
			$user_id = $_POST['user_id'];
			
			//$courses = $this->Course_model->get_curriculum($id,$user_id);
			$courses = $this->Course_model->get_module($id,$user_id);
			//if ($courses->num_rows()){
				//$response['usercourse'] = $courses->result();
				$response['usercourse'] = $courses;
				$response['success'] = 1;				
	            $response['message'] = "Success";
	             
			/*}else{
				$response['success'] = 0;
	             $response['message'] = "No Courses";
	               
			}*/
			 
		 } else{
		 	$response['success'] = 0;
            $response['message'] = "Incomplete Parameters";
		 }    
		 echo json_encode($response);
	}
	public function get_quiz()
	{
		
		$this->load->model("Course_model");
		if(isset($_POST['id'])){
			$id = $_POST['id'];	
			$userid = $_POST['userid'];	
			$courseid = $_POST['courseid'];	
			$moduleid = $_POST	['moduleid'];	
			
			$quiz = $this->Course_model->get_quiz($id);
			$answers = $this->Course_model->get_answer($id,$userid,$courseid,$moduleid);
			if ($quiz->num_rows()){
				$response['quiz'] = $quiz->result();
				$response['success'] = 1;				
	            $response['message'] = "Success";
	             
			}else{
				$response['success'] = 0;
	             $response['message'] = "No Courses";
	               
			}
			if ($answers->num_rows()){
				$response['answers'] = $answers->result();
			}
			 
		 } else{
		 	$response['success'] = 0;
            $response['message'] = "Incomplete Parameters";
		 }    
		 echo json_encode($response);
	}

	public function update_quiz()
	{
		
		$this->load->model("Course_model");
		$data = array();
		if(isset($_POST['userid'])){
			$userid = $_POST['userid'];
			$courseid = $_POST['courseid'];
			$moduleid = $_POST['moduleid'];	
			$ans = array();
			$ans = $_POST['ans'];

			
			$this->db->where('user_id',$userid);
			$this->db->where('course_id',$courseid);
			$this->db->where('module_id',$moduleid);
		   $q = $this->db->get('user_quiz');

		   if ( $q->num_rows() > 0 ) 
		   {
			    
				foreach ($ans as $key => $value) {
					$this->db->where('user_id',$userid);
					$this->db->where('course_id',$courseid);
					$this->db->where('module_id',$moduleid);
					$this->db->where('question_id',$key+1);
				/*$out["user_id"] = $userid;
				$out["course_id"] = $courseid;
				$out["module_id"] = $moduleid;*/
					//$out["question_id"] = $key+1;
					$out["answer"] = $value;
					$this->db->update('user_quiz',$out);
				}
			    
		   } else {
		      foreach ($ans as $key => $value) {
				$out["user_id"] = $userid;
				$out["course_id"] = $courseid;
				$out["module_id"] = $moduleid;
				$out["question_id"] = $key+1;
				$out["answer"] = $value;
				array_push($data, $out);

				}
		      $this->db->insert_batch('user_quiz', $data);
		   }
					
			
				

				$response['success'] = 1;
	            $response['message'] = "Done";
	               
			
			 
		 } else{
		 	$response['success'] = 0;
            $response['message'] = "Incomplete Parameters";
		 }    
		 echo json_encode($response);
	}
	public function course_details()
	{
		
		$this->load->model("Course_model");
		if(isset($_POST['course_id'])){
			$id = $_POST['course_id'];
			
			$course = $this->Course_model->get_single_course($id);
			$curr = $this->Course_model->get_curriculum_single($id);
			
				$response['coursedetail'] = $course->result();
				$response['curriculum'] = $curr->result();
				$response['success'] = 1;				
	            $response['message'] = "Success";
	             
			
		 } else{
		 	$response['success'] = 0;
            $response['message'] = "Incomplete Parameters";
		 }    
		 echo json_encode($response);
	}
	public function register_course()
	{
		
		$this->load->model("Course_model");
		if(isset($_POST['course_id'])){
			$id = $_POST['course_id'];
			$user_id = $_POST['user_id'];
			
			$course = $this->Course_model->add_usertocourse($id,$user_id);
			if ($course){
				$response['success'] = 1;
	            $response['message'] = "Course Registered";
	             
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
	public function update_curr()
	{
		
		$this->load->model("Course_model");
		if(isset($_POST['moduleid'])){
			$id = $_POST['moduleid'];	
			$userid = $_POST['userid'];	
			$courseid = $_POST['courseid'];
			
			$courses = $this->Course_model->update_module($id,$userid,$courseid);
			if ($courses){
				$response['last_module'] = $this->last_module($courseid);
				$response['success'] = 1;				
	            $response['message'] = "Success";
	             
			}else{
				$response['success'] = 0;
	             $response['message'] = "No Courses";
	               
			}
			 
		 } else{
		 	$response['success'] = 0;
            $response['message'] = "Incomplete Parameters";
		 }    
		 echo json_encode($response);
	}
	public function testquery()
	{
		$this->load->model("Course_model");
		$xx = $this->Course_model->get_courses_test();
		echo json_encode($xx->result());

	}
	public function test_update_curr()
	{
		
		$this->load->model("Course_model");
		//if(isset($_POST['moduleid'])){
			$id = 235;	
			$userid = 40;	
			$courseid = 19;
			
			$courses = $this->Course_model->update_module($id,$userid,$courseid);
			if ($courses){
				$response['last_module'] = $this->last_module($courseid);
				$response['success'] = 1;				
	            $response['message'] = "Success";
	             
			}else{
				$response['success'] = 0;
	             $response['message'] = "No Courses";
	               
			}
			 
		 /*} else{
		 	$response['success'] = 0;
            $response['message'] = "Incomplete Parameters";
		 } */   
		 echo json_encode($response);
	}
	public function test_register_course()
	{
		
		$this->load->model("Course_model");
		if(isset($_GET['course_id'])){
			$id = $_GET['course_id'];
			$user_id = $_GET['user_id'];
			
			$course = $this->Course_model->add_usertocourse($id,$user_id);
			if ($course){
				$response['success'] = 1;
	            $response['message'] = "Course Registered";
	             
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
	public function last_module($course){
	 	$start = 0;
	 	//$course = 18;

	 	while(1){
		 	$query = $this->db->query('SELECT id FROM course_curriculum where course_id = '.$course.' and module_after = '.$start)->row();
		 	if ($query) {    
		 		$start = $query->id; 
		 	}else{
		 		break;
		 	}
		 	
	 	}
	 	return $start;

	 }

	
}

?>