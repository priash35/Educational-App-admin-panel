<?php

class Course_model extends CI_Model
{
	
	
	public function __construct()
	{
		parent ::__construct();
	}

	function get_courses($id)
	 {
	 	
	    //..new code start
	    $this->db->select('DISTINCT(course_id)');
	 	$this->db->from('course_transaction');
	 	$this->db->where('user_id', $id);
	    $this->db->where('course_transaction.status', 'Active');
	    //$this->db->or_where('course_transaction.status', 'PENDING');
		$subQuery =  $this->db->get_compiled_select();
	 	$this->db->select('SUM(if(c1.module_quiz = 0,1,0)) as max_modules, SUM(if( course_transaction.status = "DONE" and c1.module_quiz = 0,1,0)) as comp_modules,course_master.id,course_master.course_name, course_master.course_description,course_master.intro_audio,instructor.name as instructor,course_transaction.start_date,course_master.course_image'); 
	    $this->db->from('course_master');
	    $this->db->join('course_transaction', 'course_transaction.course_id = course_master.id');
	    //$this->db->join('course_curriculum as c1', 'c1.course_id = course_master.id');
	    $this->db->join('course_curriculum as c1', 'c1.id = course_transaction.course_modules');	    
	    $this->db->join('instructor', 'instructor.id = course_master.instructor');
	    $this->db->where('course_master.id IN ('.$subQuery.')',NULL,FALSE);
	    $this->db->where('course_transaction.user_id',$id);
	    $this->db->group_by('course_master.id');

	    //.. new code end
	 
	    $query = $this->db->get();
	 
	    
	    return $query;
	 }
	/* function get_completed_courses($id)
	 {
	 	$this->db->select('*'); 
	    $this->db->from('course_transaction');
	    $this->db->join('course_master', 'course_master.id = course_transaction.course_id');
	    $this->db->join('instructor', 'instructor.id = course_master.instructor');
	    $this->db->where('user_id', $id);
	    $this->db->where('course_transaction.status', 'Done');	
	    $query = $this->db->get();
	    //$result = $query->result_array();
	    return $query;
	 }*/
	 function get_other_courses($id)
	 {
	 	//echo $id." aa";
	 	/*$this->db->select('count(course_curriculum.id) as max_modules,course_master.id,course_master.course_name, course_master.course_description,course_master.intro_audio,instructor.name as instructor,course_master.fee,course_master.language'); 
	    $this->db->from('course_master');	
	    $this->db->join('instructor', 'instructor.id = course_master.instructor');   
	    $this->db->join('course_curriculum', 'course_curriculum.course_id = course_master.id');
	    $this->db->where('course_master.id NOT IN (SELECT distinct(course_id) FROM course_transaction WHERE user_id ='.$id.')', NULL,FALSE);
	    $this->db->where('course_master.language IN (SELECT language FROM users WHERE id ='.$id.')', NULL,FALSE);
	    $this->db->group_by('course_master.id');*/
	    //$this->db->where('course_master.id != course_transaction.course_id');	

	    //remove below
	    $this->db->select('SUM(if(course_curriculum.module_quiz = 0,1,0)) as max_modules,course_master.id,course_master.course_name, course_master.course_description,course_master.intro_audio,instructor.name as instructor,course_master.fee,course_master.language,course_master.course_image'); 
	    $this->db->from('course_master');	
	    $this->db->join('instructor', 'instructor.id = course_master.instructor');   
	    $this->db->join('course_curriculum', 'course_curriculum.course_id = course_master.id');	    
	    $this->db->where('course_master.id NOT IN (SELECT distinct(course_id) FROM course_transaction WHERE user_id ='.$id.')', NULL,FALSE);
	    $this->db->where('course_master.language IN (SELECT language FROM users WHERE id ='.$id.')', NULL,FALSE);
	    $this->db->where('course_master.status','ACTIVE');
	    $this->db->group_by('course_master.id');    
	    $query = $this->db->get();	    
	    return $query;
	 }
	 function get_curriculum($id,$user_id)
	 {
	 	$this->db->select('course_curriculum.course_id,course_curriculum.id,module_name, module_audio, module_quiz, module_desc,duration,course_transaction.status'); 
	    $this->db->from('course_curriculum');
	    $this->db->join('course_transaction', 'course_transaction.course_modules = course_curriculum.id');
	    $this->db->where('course_curriculum.course_id', $id);
	    $this->db->where('course_transaction.user_id', $user_id);
	    $this->db->where('course_transaction.course_id', $id);	
	    $this->db->order_by("module_after", "asc");    
	    $query = $this->db->get();

	    //$result = $query->result_array();
	    return $query;
	 }
	 public function get_module($id,$user_id)						//currently using
	{
		$flag = true;
		$ma_old = 0;
		$sorted = array();
		while($flag){
			$this->db->select('course_curriculum.course_id,course_curriculum.id,module_name, module_audio, module_quiz, module_desc,duration,course_transaction.status'); 
	    	$this->db->from('course_curriculum');
	    	$this->db->join('course_transaction', 'course_transaction.course_modules = course_curriculum.id');
	   	 	$this->db->where('course_curriculum.course_id', $id);
	    	$this->db->where('course_transaction.user_id', $user_id);
			$this->db->where('module_after',$ma_old);			
			$query = $this->db->get();
			if ($query->num_rows()){
				$res= $query->result();
				$ma_old=$res[0]->id;
				if ($res[0]->status != 'PENDING')
					array_push($sorted,$res[0]);
			}else{
				$flag = false;	
			}
			
		}
		/* echo "<pre>";
			print_r($sorted);
			echo "</pre>";
		die(); */
		return $sorted;
	}
	 function get_quiz($id)
	 {
	 	$this->db->select('order,question, question_type'); 
	 	$this->db->from('quiz');	   
	    $this->db->where('quiz_id', $id);	    
	    $this->db->order_by("order", "asc");    
	    $query = $this->db->get();
	    //$result = $query->result_array();
	    return $query;
	 }
	 function get_curriculum_single($id)
	 {
	 	$this->db->select('course_curriculum.course_id,course_curriculum.id,module_name, module_audio, module_quiz, module_desc,duration'); 
	    $this->db->from('course_curriculum');
	    
	    $this->db->where('course_curriculum.course_id', $id);	    
	    $this->db->order_by("module_after", "asc");    
	    $query = $this->db->get();
	    //$result = $query->result_array();
	    return $query;
	 }
	 function get_single_course($id)
	 {
	 	$this->db->select('course_master.id,course_master.course_name, course_master.course_description,course_master.intro_audio,course_master.fee,course_master.duration,instructor.name as instructor,instructor.profile as profile,instructor.image as image,course_master.course_image'); 
	    $this->db->from('course_master');
	    $this->db->join('instructor', 'instructor.id = course_master.instructor');
	    $this->db->where('course_master.id', $id);
	    
	    $query = $this->db->get();
	    //$result = $query->result_array();
	    return $query;
	 }
	 function add_usertocourse($id,$user_id)
	 {
	 	$data = array();
	 	$date=date("Y-m-d");
	 	
	 	$this->db->select('id'); 
	    $this->db->from('course_curriculum');	   
	    $this->db->where('course_id', $id);	    
	    $this->db->order_by('module_after', 'asc');  
	    $query = $this->db->get();
	    $min_id = $query->first_row()->id;
	    
	   foreach ($query->result() as $row) {
	   		$insert_data["user_id"] = $user_id;
      		$insert_data["course_id"] = $id;
      		$insert_data["course_modules"] = $row->id;
      		$insert_data["status"] = "PENDING";
      		$insert_data["start_date"] = date('Y-m-d',strtotime($date));
      		array_push($data, $insert_data);
		}
		$this->db->insert_batch('course_transaction',$data);
		$data = array(
        'status' => 'ACTIVE',       
		);
		$this->db->where('course_id',$id);
	    $this->db->where('user_id',$user_id);
	    $this->db->where('course_modules',$min_id);
	  	$this->db->update('course_transaction',$data);

	    return $query;
	 }
	 function update_module($moduleid,$userid,$course_id)
	 {	
                
	   $data = array(
        'status' => 'DONE',       
		);
	   $data_next = array(
        'status' => 'ACTIVE',       
		);
	    $this->db->trans_start();
	    $this->db->where('course_modules',$moduleid);
	    $this->db->where('user_id',$userid);
	  	$this->db->update('course_transaction',$data);
	  	$count = $this->db->affected_rows();
	  	$this->db->trans_complete();
	  	/*echo $count;
	  	echo $this->db->last_query();*/
	  	if ($count > 0) 
		{
			//echo "In if";
			$this->db->select('id'); 
	    	$this->db->from('course_curriculum');	   
	    	$this->db->where('course_id', $course_id);
	    	$this->db->where('module_after', $moduleid);	    
	    	$query = $this->db->get();

	    	if ($query->num_rows() > 0) {
    				$newid = $query->row()->id;
    				$this->db->where('course_modules',$newid);
	    			$this->db->where('user_id',$userid);
	  				$this->db->update('course_transaction',$data_next);	  				
	  				return TRUE;
			} else {
				$this->db->where('course_id',$course_id);
	    		$this->db->where('user_id',$userid);
	  			$this->db->update('course_transaction',$data);

    				return TRUE;
			}  			
  			return TRUE;
		}
		else
		{
			if ($this->db->trans_status() === FALSE){
		  		return FALSE;
			}else{
				return TRUE;
			}
		}
	}
	function get_completed_courses($id)
	 {
	 	//echo $id." aa";
	 	$this->db->select('SUM(if(course_curriculum.module_quiz = 0,1,0)) as max_modules,	course_master.id,course_master.course_name, course_master.course_description,course_master.intro_audio,instructor.name as instructor,course_master.fee,course_master.course_image'); 
	    $this->db->from('course_master');	
	    $this->db->join('instructor', 'instructor.id = course_master.instructor');   
	    $this->db->join('course_curriculum', 'course_curriculum.course_id = course_master.id');
	    $this->db->where('course_master.id IN (SELECT distinct(course_id) FROM course_transaction WHERE user_id ='.$id.' AND course_id not in (SELECT distinct(course_id) FROM course_transaction WHERE user_id = '.$id.' AND status != "DONE" ))', NULL,FALSE);
	    //$this->db->where('course_master.language IN (SELECT language FROM users WHERE id ='.$id.')', NULL,FALSE);
	    $this->db->group_by('course_master.id');
	    //$this->db->where('course_master.id != course_transaction.course_id');	    
	    $query = $this->db->get();	    
	    return $query;
	 }
	 function get_answer($id,$userid,$course_id,$moduleid)
	 {
	 	$this->db->select('question_id,answer'); 
	 	$this->db->from('user_quiz');	   
	    $this->db->where('user_id', $userid);
	    $this->db->where('course_id', $course_id);
	    $this->db->where('module_id', $moduleid);	    
	    $this->db->order_by("question_id", "asc");    
	    $query = $this->db->get();
	    //$result = $query->result_array();
	    return $query;
	 }
	 function get_courses_test()
	 {
	 	//subquery
	 	$id = 56;
	 	//$this->db->distinct('course_id');
	 	$this->db->select('DISTINCT(course_id)');
	 	$this->db->from('course_transaction');
	 	$this->db->where('user_id', $id);
	    $this->db->where('course_transaction.status', 'Active');
	    //$this->db->or_where('course_transaction.status', 'PENDING');
		$subQuery =  $this->db->get_compiled_select();
	 	$this->db->select('SUM(if(c1.module_quiz = 0,1,0)) as max_modules, SUM(if( course_transaction.status = "DONE" and c1.module_quiz = 0,1,0)) as comp_modules,course_master.id,course_master.course_name, course_master.course_description,course_master.intro_audio,instructor.name as instructor,course_transaction.start_date,course_master.course_image'); 
	    $this->db->from('course_master');
	    $this->db->join('course_transaction', 'course_transaction.course_id = course_master.id');
	    //$this->db->join('course_curriculum as c1', 'c1.course_id = course_master.id');
	    $this->db->join('course_curriculum as c1', 'c1.id = course_transaction.course_modules');	    
	    $this->db->join('instructor', 'instructor.id = course_master.instructor');
	    $this->db->where('course_master.id IN ('.$subQuery.')',NULL,FALSE);
	    $this->db->where('course_transaction.user_id',$id);
	    $this->db->group_by('course_master.id');
	    //$decom = $this->db->get_compiled_select();
	   
	   

	    //$this->db->where('course_transaction.status', 'Active');
	    //$this->db->or_where('course_transaction.status', 'PENDING');	
	    $query = $this->db->get();
	    	
	    //$result = $query->result_array();
	    
	    return $query;
	 }


	
}

?>