<?php

class Admin_model extends CI_Model
{
	
	
	public function __construct()
	{
		parent ::__construct();
			
	}
	
	public function user_count()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('role_id', 0);
		$query = $this->db->get();
		//return $query->result(); 
		//$res= $query->result();
		return $query->num_rows();
	}
	
	public function course_count()
	{
		//$this->db->distinct('course_id');
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('orders.status','Success');
		$this->db->group_by('course_id');
		$query = $this->db->get();
		//$res= $query->result();
		/* print_r($res);
		die(); */
		return $query->num_rows();
	}
	
	public function course_data()
	{
		$this->db->select('o.order_id, u.name, c.country_name, ct.city_name, cm.course_name, lg.language, o.order_date');
		$this->db->from('orders o');
		$this->db->join('users u', 'o.user_id=u.id');
		$this->db->join('country c', 'u.country=c.id');
		$this->db->join('city ct', 'u.city=ct.id');
		$this->db->join('course_master cm', 'o.course_id=cm.id');
		$this->db->join('language lg', 'cm.language=lg.id');
		$this->db->where('o.status','Success');
		$this->db->or_where('o.status','TXN_SUCCESS');
		$this->db->order_by('o.order_date','DESC');
		$query = $this->db->get();
		return $query->result();
		//$res= $query->result();
		/*  print_r($res);
		die();  */
	}
	public function franchise_count()
	{
		$this->db->select('*');
		$this->db->from('franchise');
		$query = $this->db->get();		
		return $query->num_rows();
	}
	public function edit_Instructor($id)
	{
		/* $update = array(
            'name' => $this->input->post('page_name'),
            ); */
		$this->db->select("id, name, image, profile");
		$this->db->from('instructor');
        $this->db->where('id',$id);
		$query = $this->db->get();
		return $query;
        //return $this->db->update('page', $update);
	}
	
	public function update_ins($id,$name,$new_photo,$profile)
	{
		//$this->db->set('id', $id);
		$this->db->set('name', $name);
		$this->db->set('image', $new_photo);
		$this->db->set('profile', $profile);
		$this->db->where('id', $id);
		$this->db->update('instructor'); 
        //return $this->db->update('page', $update);
	}
	
		
	public function getInstructor()	// currently using
	{
		
		$query = $this->db->get('instructor');  
        return $query->result();            
	}
	
	
	public function addElement($ins_id,$ins_name,$ins_desc)		//currently working
		{
			
			$data = array('name' => $ins_id,
						'image' => $ins_name,
						'profile' => $ins_desc,
						// 'created' => date('Y-m-d H:i:s',now())
					); 					 
					
					$result=$this->db->insert('instructor',$data);
				
					return $result;				
	}
	
	public function delete_Instructor($id)
	{
		$q = $this->db->query("Select * from course_master where instructor=$id");
		$res= $q->result();
		/* echo "<pre>";
		print_r($res);
		echo "</pre>";
		die(); */
		
		if(!empty($res))
		{
			$msg= "This Instructor is already assigned in course. To delete this instructor, delete the course first.";				
				return $msg;
		}
		else
		{
			$this->db->select('image');
			$query = $this->db->get_where('instructor', array('id' => $id));
					
					if($query->num_rows()>0)
					{                   
							$result=$query->result_array();  
							$image_name=$result[0]['image'];
							if($image_name!="")
							{
								if(file_exists("./uploads/images/".$image_name))
								{
									unlink("./uploads/images/".$image_name);
								
								}						
							}
					}
					
				
			$this->db->delete('instructor', array('id' => $id));
		}
	}
	
	public function getCountry()
	{
		$query = $this->db->get('country');  
        return $query->result();
	}
	
	public function getCity()
	{
		$query = $this->db->get('city');  
        return $query->result();
	}
	
	public function addCountry($c_name)
	{
		$query= $this->db->query("Insert into country (country_name) values ('".$c_name."')");
		return $query;
	}
	public function edit_Country($id)
	{
		$this->db->select("id, country_name");
		$this->db->from('country');
        $this->db->where('id',$id);
		$query = $this->db->get();
		return $query;
	}
	
	public function updateCountry($id,$c_name)
	{		
		$this->db->set('country_name', $c_name);		
		$this->db->where('id', $id);
		$this->db->update('country');         
	}
	
	public function delete_Country($id)
	{
		$q = $this->db->query("Select * from users,city where users.country=$id and city.country_id=$id");
		$res= $q->result();
		/* echo "<pre>";
		print_r($result);
		echo "</pre>";
		die(); */
		if(!empty($res))
		{
			$msg= "This country is already assigned to user and city. You can not delete this country.";
			return $msg;
		}
		else
		{
			$this->db->delete('country', array('id' => $id));
		}
	}
	
	public function addCity($c_id,$c_name)
	{
		$query= $this->db->query("Insert into city (country_id, city_name) values ('".$c_id."','".$c_name."')");
		return $query;
	}
	public function edit_City($id)
	{
		$this->db->select("city.id, country_id, city_name, country_name");
		$this->db->from('city');
		$this->db->join('country','city.country_id=country.id');		
        $this->db->where('city.id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function updateCity($id,$country_id,$c_name)
	{		
		$this->db->set('country_id', $country_id);
		$this->db->set('city_name', $c_name);		
		$this->db->where('id', $id);
		$this->db->update('city');         
	}
	public function delete_City($id)
	{
		$q = $this->db->query("Select * from users where city=$id");
		$res= $q->result();
		/* echo "<pre>";
		print_r($res);
		echo "</pre>";
		die(); */
		
		if(!empty($res))
		{
			$msg= "This city is already assigned to user. You can not delete this city.";
			return $msg;
		}
		else
		{
			$this->db->delete('city', array('id' => $id));
		}
	}
	
	public function get_languages()
	{
		$query = $this->db->get('language');  
        return $query->result();
	}
	public function addLanguage($l_name)
	{
		$query= $this->db->query("Insert into language (language) values ('".$l_name."')");
		return $query;
	}
	public function edit_Language($id)
	{
		$this->db->select("id, language");
		$this->db->from('language');
        $this->db->where('id',$id);
		$query = $this->db->get();
		return $query;
	}
	
	public function updateLanguage($id,$l_name)
	{		
		$this->db->set('language', $l_name);		
		$this->db->where('id', $id);
		$this->db->update('language');         
	}
	
	public function delete_Language($id)
	{
		$q = $this->db->query("Select * from users,course_master where users.language=$id and course_master.language=$id");
		$res= $q->result();
		/* echo "<pre>";
		print_r($result);
		echo "</pre>";
		die(); */
		
		if(!empty($res))
		{
			$msg= "This language is already assigned to user and course. You can not delete this language.";
				return $msg;
		}
		else
		{
			$this->db->delete('language', array('id' => $id));
		}
	}
	
	public function getUsers()
	{
		$query = $this->db->get('users');  
        return $query->result();
	}
	
	public function addNotification($country,$city,$message)
	{
		$where= "country=".$country." OR city=".$city;
		$this->db->select("id, name");
		$this->db->from('users');
		$this->db->where($where);
		//$this->db->where('city', $city);
		$query= $this->db->get();
		$users= $query->result();
		
		/* echo "<pre>";
		print_r($users);
		echo "</pre>";
		die();
		 */
		foreach($users as $value){
			
			$query1= $this->db->query("Insert into notifications (userid, message) values ('".$value->id."','".$message."')");
		
		}
		return $query1;
	}
	
	
	
	function get_city($country='')
     {
        $this -> db -> select('*');
        $this -> db -> where('country_id', $country);
        $query = $this -> db -> get('city');
        return $query->result();
     }
	public function getNotifications()
	{
		$this->db->group_by('message');	
		$query = $this->db->get('notifications');  
        return $query->result();
	}
	
	public function getstatus()
	{
		$this->db->group_by('status');		
		$query= $this->db->get('notifications');
		return $query->result();
	}
	
	public function edit_Notification($id)
	{
		$this->db->select("notifications.id, userid, message, notifications.status, name, city, country");
		$this->db->from('notifications');
		$this->db->join('users','notifications.userid=users.id','left');
		/* $this->db->join('country','users.country=country.id','left');
		$this->db->join('city','users.city=city.id','left');
		$this->db->join('city c', 'country.id=c.country_id','left'); */		
        	$this->db->where('notifications.id',$id);
		$query = $this->db->get();
		return $query->result();
		
		/* $query1= $this->db->query("select country_name from country where id=".$res[0]->country);
		$res1= $query1->result();
		
		$query2= $this->db->query("select city_name from city where country_id=".$res[0]->country." and id=".$res[0]->city);
		$res2= $query2->result();
		
		foreach($res1 as $row)
		{
			array_push($res,$row);
		}
		foreach($res2 as $row1)
		{
			array_push($res,$row1);
		} */
		
		//return $res;
	}
	
	public function updateNotification($n_id,$country,$city,$message)
	{		
		
		$where= "country=".$country." AND city=".$city;
		$this->db->select("id, name");
		$this->db->from('users');
		$this->db->where($where);
		//$this->db->where('city', $city);
		$query= $this->db->get();
		$users= $query->result();
		
		/* echo "<pre>";
		print_r($users);
		echo "</pre>";
		die();
		 */
		$this->db->delete('notifications', array('id' => $n_id));	
		foreach($users as $value){
			
			/* $this->db->set('userid', $value->id);
			$this->db->set('message', $message);
			$this->db->set('status', 'UNREAD');		
			$this->db->where('id', $n_id);
			$this->db->update('notifications'); */

			$query1= $this->db->query("Insert into notifications (userid, message) values ('".$value->id."','".$message."')");
		}
		//return $query1;
		
		/* $this->db->set('userid', $value->id);
		$this->db->set('message', $message);
		//$this->db->set('status', $status);		
		$this->db->where('id', $n_id);
		$this->db->update('notifications');   */     
	}
	public function delete_Notification($msgg) 							//updated on 15 june 2018
	{
		$this->db->delete('notifications', array('message' => $msgg));	
	}
	
	public function deleteRead_Notification($msgg)						//updated on 15 june 2018
	{
		$this->db->delete('notifications', array('message' => $msgg, 'status'=> 'READ' ));	
	}
	
	
	public function getQuiz()
	{
		$this->db->group_by('quiz_id');
		$query= $this->db->get('quiz'); 
		return $query->result();
	}
	public function getQuizData($id)
	{		
		
		$this->db->select("*");
		$this->db->from('quiz');
        $this->db->where('quiz_id',$id);
		$this->db->order_by('order');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function edit_Quiz($id)
	{
		$this->db->select("id, quiz_id, quiz_name");
		$this->db->from('quiz');
        $this->db->where('id',$id);
		$query = $this->db->get();
		return $query;
	}
	public function updateQuiz($id,$q_id,$q_name)
	{		
		$this->db->set('quiz_id', $q_id);
		$this->db->set('quiz_name', $q_name);		
		$this->db->where('id', $id);
		$this->db->update('quiz');         
	}
	public function delete_Quiz($id)
	{
		$q = $this->db->query("Select * from course_curriculum");
		$res= $q->result();
		/* echo "<pre>";
		print_r($result);
		echo "</pre>";
		die(); */
		foreach($res as $row)
		{
			if($row->module_quiz!=$id)
			{	
				$this->db->delete('quiz', array('id' => $id));				
			}
			else
			{
				$msg= "This quiz is already assigned to course. You can not delete this quiz.";
				return $msg;
			}
		}
	}
	public function addquestion($quiz_id,$que_id,$que_name,$que_type)
	{
		
		$this->db->select("id, quiz_name, quiz_id, question, order");
		$this->db->from('quiz');
        $this->db->where('quiz_id',$quiz_id);
		$this->db->order_by("order", "asc");
		$query = $this->db->get();
		$res= $query->result();
		//print_r($res);
		//die();
		$array_postion= $this->search_position($res,"order",$que_id);
		//echo $array_postion;
		$new_record=(object)array('id'=>'', 
								 'quiz_id' => $quiz_id,
								'quiz_name' => $res[0]->quiz_name,
								'order' => 0,
								'question' => $que_name,
								'question_type' => $que_type
						); 
		//print_r($new_record);
		//die();
		$query1=$this->db->insert('quiz',$new_record);
		
		$new_record->id=$this->db->insert_id();
		
		array_splice( $res, $array_postion+1, 0, [$new_record]);
		
		
		foreach($res as $key=>$row){
			$this->db->set('order', $key+1);	
			$this->db->where('id', $row->id);
			$this->db->update('quiz');
		}
		return $query1;
		
		
		//$order= array();
		
		
		/* foreach($res as $row)
		{ */
			//$q_id= max($order);
			//if(!empty($row->question))
			/* $this->db->where('order >', $que_id);
			$this->db->delete('quiz'); */
			/* if(!empty($row->question))
			{
			$data = array( 'quiz_id' => $quiz_id,
							'quiz_name' => $row->quiz_name,
							'order' => $que_id+1,
							'question' => $que_name,
							'question_type' => $que_type
						); 					 
						
						 $query1=$this->db->insert('quiz',$data);
					
						return $query1;
						//$this->db->where('quiz_id', $quiz_id);
						//$this->db->update('quiz', $data);						
			}
			 else
			{
				// if($row->quiz_id==$quiz_id && empty($row->question))
				//{ 
					$this->db->set('order', $que_id+1);
					$this->db->set('question', $que_name);	
					$this->db->set('question_type', $que_type);
					$this->db->where('quiz_id', $quiz_id);
					$this->db->update('quiz');
				//}
			} 
		} */
		
		 
		
			/* $this->db->set('order',$que_id+1);
			$this->db->where('quiz_id', $quiz_id);
			$this->db->where('order >', $que_id);
			$this->db->update('quiz'); */
		
		
	}
	
	public function edit_Question($id)
	{
		$this->db->select("id, quiz_id, quiz_name, question, order, question_type");
		$this->db->from('quiz');
        $this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array();
		
	}

	public function get_previous_que($quiz_id,$old_ord)
	{
		$this->db->select("question as old_question, order as old_order");
		$this->db->from('quiz');
		$this->db->where('quiz_id',$quiz_id);
        $this->db->where('order < ',$old_ord);
		$this->db->order_by('order', "desc");
		$query1 = $this->db->get();
		$res1= $query1->result();
		$cur_order = array_shift($res1);
		
		$res_array= json_decode(json_encode($cur_order), true);
		/* echo "<pre>";
		print_r($res_array);
		echo "</pre>";
		die(); */
		return $res_array;

		//return $query->result();
	}
	public function find_quiz_id($id)
	{
		$this->db->select("quiz_id");
		$this->db->from('quiz');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_questions($quiz_id)
	{
		$this->db->select("*");
		$this->db->from('quiz');
		$this->db->where('quiz_id',$quiz_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function find_quiz($quiz_id)
	{
		$this->db->distinct();
		$this->db->select("quiz_name");
		$this->db->from('quiz');
		$this->db->where('quiz_id',$quiz_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function updateQuestion($id,$quiz_id,$quiz_name,$que_id,$que_name,$que_type)
	{		
		//echo $que_name;
		$this->db->select("id, quiz_name, quiz_id, question, order, question_type");
		$this->db->from('quiz');
        $this->db->where('quiz_id',$quiz_id);
		$this->db->order_by("order", "asc");
		$query = $this->db->get();
		$res= $query->result();
		//print_r($res);
		//die();
		$array_postion= $this->search_position($res,"order",$que_id);
		
		$old_rec= $this->search_position($res,"id",$id);
		
		unset($res[$old_rec]);
		
		/* echo "<pre>";
		print_r($res);
		echo "</pre>";
		//die(); */
		//echo $array_postion;
		$this->db->select("id, quiz_name, quiz_id, question, order, question_type");
		$this->db->from('quiz');
        $this->db->where('quiz_id',$quiz_id);
		$this->db->where('order <',$que_id);		
		$query1 = $this->db->get();
		$res1= $query1->result();
		/* echo "<pre>";
		print_r($res1);
		echo "</pre>";
		die(); */ 
		 
		if(empty($res1))
		{
			$new_record=(object)array('id'=>$id, 
								 'quiz_id' => $quiz_id,
								'quiz_name' => $quiz_name,
								'order' => $que_id,
								'question' => $que_name,
								'question_type' => $que_type
						); 
			
			array_splice($res, $array_postion, 0, [$new_record]);			
		}
		else
		{ 
			$new_record=(object)array('id'=>$id, 
								 'quiz_id' => $quiz_id,
								'quiz_name' => $quiz_name,
								'order' => $que_id+1,
								'question' => $que_name,
								'question_type' => $que_type
						); 
			
			array_splice($res, $array_postion+1, 0, [$new_record]);
			
		}
		//print_r($new_record);
		//die();
		//$query1=$this->db->insert('quiz',$new_record);
		
		//$new_record->id=$this->db->insert_id();
		
		
		/* echo "<pre>";
		print_r($res);
		echo "</pre>";
		die(); */
			
		//$this -> db -> where('id', $id);
		//$this -> db -> delete('quiz');
		
		/* $this->db->select("id, quiz_name, quiz_id, question, order");
		$this->db->from('quiz');
        $this->db->where('quiz_id',$quiz_id);
		//$this->db->where('order >=',$que_id);
		$this->db->order_by("order", "asc");
		$query1 = $this->db->get();
		$res1= $query1->result(); */
		 /* echo "<pre>";
		print_r($res1);
		echo "</pre>";
		die();	 */ 
		
		foreach($res as $key=>$row){			
			$this->db->set('quiz_name', $row->quiz_name);	
			$this->db->set('quiz_id', $row->quiz_id);
			$this->db->set('question', $row->question);
			$this->db->set('question_type', $row->question_type);
			$this->db->set('order', $key+1);	
			$this->db->where('id', $row->id);
			$this->db->update('quiz');
		}
		
		/* echo "<pre>";
		print_r($res);
		echo "</pre>";
		die(); */
			
	}
	
	public function delete_Question($id,$quiz_id)
	{
		$this->db->delete('quiz', array('id' => $id));	
		
		$this->db->select("id, quiz_name, quiz_id, question, order");
		$this->db->from('quiz');
        $this->db->where('quiz_id',$quiz_id);
		$this->db->order_by("order", "asc");
		$query = $this->db->get();
		$res= $query->result();
		
		foreach($res as $key=>$row){
			$this->db->set('order', $key+1);	
			$this->db->where('id', $row->id);
			$this->db->update('quiz');
		}
	}
	
	public function addquiz($quiz_id,$quiz_name)
	{
		$data = array('quiz_id' => $quiz_id,
						'quiz_name' => $quiz_name
					); 					 
					
					$result=$this->db->insert('quiz',$data);
				
					return $result;	
	}
	
	
	
	
	public function edit_course($id)					//currently using
	{
		
		$this->db->select('course_master.id,course_name,instructor,course_description,intro_audio,course_image,course_master.language,fee,duration,name,language.language as language_name');
		$this->db->from('course_master');
		$this->db->join('instructor','course_master.instructor = instructor.id');
		$this->db->join('language','course_master.language = language.id');
		$this->db->where('course_master.id',$id);
		$query = $this->db->get();
		return $query->result(); 
	}
	
	public function edit_module($id)
	{
		$this->db->select('course_curriculum.id,course_id,module_name,module_quiz,module_desc,module_after,quiz.quiz_name');
		$this->db->from('course_curriculum');
		$this->db->join('quiz','course_curriculum.module_quiz=quiz.id');
		$this->db->where('course_curriculum.id',$id);
		$query = $this->db->get();
		return $query->result();
	} 
	
	
	public function edit_audiomodule($id)
	{
		$this->db->select('id,course_id,module_name,module_after,module_audio,module_desc,duration');
		$this->db->from('course_curriculum');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function select_id($id)					//currently using
	{
		$this->db->select('*');
		$this->db->from('course_master');
		$this->db->where('id', $id);
		$query = $this->db->get(); 
		return $query->result();
		
	}
	
	public function delete_course($id)						//currently using
	{
		$this->db->select('*');
		$this->db->from('course_master');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if($query->result()>0)
		{
			$this->db->select('course_image');
			$query = $this->db->get_where('course_master', array('id' => $id));
					
					if($query->num_rows()>0)
					{                   
							$result=$query->result_array();  
							
							$image_name=$result[0]['course_image'];
							/*echo "<pre>";
							print_r($image_name);
							echo "<pre>";
							die();*/
							$img_array= explode("/",$image_name);
							$image= end($img_array);
							
							if($image!="")
							{
								if(file_exists("./uploads/images/".$image))
								{
									unlink("./uploads/images/".$image);
								
								}						
							}
					} 
			$this->db->select('intro_audio');
			$query = $this->db->get_where('course_master', array('id' => $id));
					
					if($query->num_rows()>0)
					{                   
							$result=$query->result_array();  
							
							$intro_audio=$result[0]['intro_audio'];
							
							$aud_array= explode("/",$intro_audio);
							$audio= end($aud_array);
							/* echo $audio;
							die(); */
							if($intro_audio!="")
							{
								if(file_exists("./uploads/".$audio))
								{
									unlink("./uploads/".$audio);
								
								}						
							}
					}
					
			$this -> db -> where('id', $id);
			$this -> db -> delete('course_master');
		}
		
	}		
	
	
	public function delete_audiomodule($id)						//currently using
	{
		$this->db->select('*');
		$this->db->from('course_curriculum');
		$this->db->where('id',$id);
		$query = $this->db->get();
		
		if($query->result()>0)
		{
			$this -> db -> where('id', $id);
			$this -> db -> delete('course_curriculum');
		}
		
	}	
	
	public function delete_quizmodule($id,$course_id)						//currently using
	{	
			$this->db->select('module_audio');
			$query = $this->db->get_where('course_curriculum', array('id' => $id));
			$res=$query->result();	
			 
						if($res!="NULL")
					{                   
							$module_audio=$res[0]->module_audio;
							$aud_array= explode("/",$module_audio);
							$audio= end($aud_array);
							if($audio!="")
							{
								if(file_exists("./uploads/".$audio))
								{
									unlink("./uploads/".$audio);
								}						
							}
					}
			$this->db->select('*');
			$this->db->from('course_curriculum');
			$this->db->where('course_id',$course_id);
			$this->db->where('id',$id);
			$query1 = $this->db->get();
			$res1= $query1->result();
			
			$module=$res1[0]->module_after;
			
			$sql1="select id,module_name from course_curriculum where module_after=$id";
			$query1= $this->db->query($sql1);
			$res2=$query1->result();
			
			if(!empty($res2))
		{
			$m_id=$res2[0]->id;
			$this->db->set('module_after', $module);
			$this->db->where('id', $m_id);
			$this->db->update('course_curriculum'); 
			
			$this->db->delete('course_curriculum', array('id' => $id));
		}
		else
		{
			$this->db->delete('course_curriculum', array('id' => $id));
		} 
	}
		
	public function get_instructor()						//currently using
	{
		$query = $this->db->get('instructor');  
        return $query; 
	}
	
	public function get_quiz()								//currently using
	{
		$this->db->select('*');
		$this->db->from('quiz');
		$this->db->group_by('quiz_id');
		$query = $this->db->get();
		return $query->result(); 
	}
	
	public function get_modulename($course_id)						//currently using
	{
		$this->db->select('*');
		$this->db->from('course_curriculum');
		$this->db->where('course_id', $course_id);
		$query = $this->db->get();  
		return $query->result(); 
	}
	
	
	
	public function get_audiomodule($id)								//currently using
	{
		$this->db->select('*');
		$this->db->from('course_curriculum');
		$this->db->where('module_quiz', 0);
		$this->db->where('course_id',$id);
		$query = $this->db->get();  
		return $query->result(); 
	}
	
	public function get_module($id)						//currently using
	{
		/* $this->db->select('*');
		$this->db->from('course_curriculum');
		$this->db->where('course_id', $course_id);
		
		$query = $this->db->get();  
		return $query->result();  */
		$flag = true;
		$ma_old = 0;
		$sorted = array();
		while($flag){
			$this->db->select('*');
			$this->db->from('course_curriculum');
			$this->db->where('course_id',$id);
			$this->db->where('module_after',$ma_old);			
			$query = $this->db->get();
			if ($query->num_rows()){
				$res= $query->result();
				$ma_old=$res[0]->id;
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
	
	public function get_quizmodule($id)								//currently using
	{
		$this->db->select('*');
		$this->db->from('course_curriculum');
		$this->db->where('module_audio',"NULL");
		$this->db->where('course_id',$id);
		$query = $this->db->get();  
		return $query->result(); 
	}
	
	public function update_course($id,$course_name,$instructor,$course_description,$audio_url,$img_url,$language,$fee,$duration)		//currently using
	{
		 
		$this->db->set('course_name', $course_name);
		$this->db->set('instructor', $instructor);
		$this->db->set('course_description', $course_description);
		$this->db->set('intro_audio', $audio_url);
		$this->db->set('course_image', $img_url);
		$this->db->set('language', $language);
		$this->db->set('fee', $fee);
		$this->db->set('duration', $duration);
		$this->db->where('id', $id);
		$this->db->update('course_master'); 
        //return $this->db->update('page', $update);
	}
	
	public function getCourse(){					//to display course name
			
		$query = $this->db->get('course_master');  
        return $query;  
           
	}
		
	public function getlang()				//to display language 
	{
		$query = $this->db->get('language');  
        return $query;
	}
	
	public function addCourse($course_name,$instructor,$course_description,$audio_url,$img_url,$language,$fee,$duration)   //currenlty using
		{
																																//to add course
			$data = array(
					'course_name'=> $course_name,
					'instructor'=> $instructor,
					'course_description'=> $course_description,
					'intro_audio'=> $audio_url,
					'course_image'=> $img_url,
					'language'=> $language,
					'fee'=> $fee,
					'duration'=> $duration,
					); 
		
				$result= $this->db->insert('course_master',$data);
				
		/* $data = array(
				'page_name' => $_POST['page_name']
			);
			$this->db->insert('page',$data);
			redirect("page/add_page","refresh"); */
		
				return $result;  
			}
			
	public function add_quizmodule($course_id,$module_name,$module_audio,$module_quiz,$module_desc,$duration,$module_after,$res)																	//currently using
	{																					//updated on 18 may 2018
		$data = array(
					'course_id'=> $course_id,
					'module_name'=> $module_name,
					'module_audio'=> $module_audio ,
					'module_quiz'=> $module_quiz,
					'module_desc'=> $module_desc,
					'duration'=> $duration,
					'module_after'=> $module_after,
					);
		$result= $this->db->insert('course_curriculum',$data);
		$last_id=$this->db->insert_id();								//to get last inserted module id
		
		if(!empty($res))
		{
			$id=$res[0]->id;
			$this->db->set('module_after', $last_id);	
			$this->db->where('id', $id);
			$this->db->update('course_curriculum');
		}
	}	

	public function add_audiomodule($course_id,$module_name,$audio_url,$module_desc,$module_dur,$module_after,$module_quiz,$res)												//updated on 18 may 2018
	{
		$data=array(
					'course_id'=>$course_id,
					'module_name'=>$module_name,
					'module_audio'=>$audio_url,
					'module_desc'=>$module_desc,
					'duration'=>$module_dur,
					'module_after'=>$module_after,
					'module_quiz'=>$module_quiz,
					);
		$result= $this->db->insert('course_curriculum',$data);
		$last_id=$this->db->insert_id();								//to get last inserted module id
		//$data=$this->get_data($id);
		//print_r($data);
		//$mod=$data[0]->module_after;
		
		//$res=$this->get_module_after($module_after);
		/* echo $res;
		die(); */
		/* print_r($res);
		 */
	
			//echo $id;
		if(!empty($res))
		{
			$id=$res[0]->id;
			$this->db->set('module_after', $last_id);	
			$this->db->where('id', $id);
			$this->db->update('course_curriculum');
		}
		
		
	}
	
	public function update_audiomodule($id,$course_id,$module_name,$audio_url,$module_desc,$module_dur,$module_after)		//currently using
	{
		$flag = true;
		$ma_old = 0;
		$sorted = array();
		while($flag){
			$this->db->select('*');
			$this->db->from('course_curriculum');
			$this->db->where('course_id',$course_id);
			$this->db->where('module_after',$ma_old);			
			$query = $this->db->get();
			if ($query->num_rows()){
				$res= $query->result();
				$ma_old=$res[0]->id;
				array_push($sorted,$res[0]);
			}else{
				$flag = false;	
			}
		}
		$array_postion = $this->search_position($sorted,"module_after",$module_after);
		$old_rec = $this->search_position($sorted,"id",$id);
		unset($sorted[$old_rec]);		
		$new_record=(object)array('id'=>$id, 
							'course_id' => $course_id,
								'module_name' => $module_name,
								'module_audio' => $audio_url,
								'module_desc' => $module_desc,
								'duration' => $module_dur,
								'module_after' => $module_after
						); 
		array_splice($sorted,$array_postion,0,[$new_record]);	
		$ma_old = 0;
		foreach($sorted as $key=>$row){
			$this->db->set('course_id', $row->course_id);
			$this->db->set('module_name', $row->module_name);
			$this->db->set('module_audio', $row->module_audio);
			$this->db->set('module_desc', $row->module_desc);
			$this->db->set('duration', $row->duration);
			$this->db->set('module_after', $ma_old);	
			$this->db->where('id', $row->id);
			$this->db->update('course_curriculum');
			$ma_old =  $row->id;
		}
	 }
	 
	 public function update_quizmodule($id,$course_id,$module_name,$module_quiz,$module_desc,$module_after)//currently using
	{
		$flag = true;
		$ma_old = 0;
		$sorted = array();
		while($flag){
			$this->db->select('*');
			$this->db->from('course_curriculum');
			$this->db->where('course_id',$course_id);
			$this->db->where('module_after',$ma_old);			
			$query = $this->db->get();
			if ($query->num_rows())
			{
				$res= $query->result();
				$ma_old=$res[0]->id;
				array_push($sorted,$res[0]);
			}
			else
			{
				$flag = false;	
			}
		}
		$array_postion = $this->search_position($sorted,"module_after",$module_after);
		$old_rec = $this->search_position($sorted,"id",$id);
		unset($sorted[$old_rec]);		
		$new_record=(object)array('id'=>$id, 
								 'course_id' => $course_id,
								'module_name' => $module_name,
								'module_quiz' => $module_quiz,
								'module_desc' => $module_desc,
								'module_after' => $module_after,
						); 
		array_splice($sorted,$array_postion,0,[$new_record]);
		$ma_old = 0;
		foreach($sorted as $key=>$row)
		{
			$this->db->set('course_id', $row->course_id);
			$this->db->set('module_name', $row->module_name);
			$this->db->set('module_quiz', $row->module_quiz);
			$this->db->set('module_desc', $row->module_desc);			
			$this->db->set('module_after', $ma_old);	
			$this->db->where('id', $row->id);
			$this->db->update('course_curriculum');
			$ma_old =  $row->id;
		}	
	}
	 
	public function get_info_course_curriculum($id)
	{
		$this->db->select('*');
		$this->db->from('course_curriculum');
		$this->db->where('id',$id);
		$query = $this->db->get();  
		return $query->result(); 
	}
	
	public function search_position($products, $field, $value)
	{
	   foreach($products as $key => $product)
	   {
		  if ( $product->$field === $value )
			 return $key;
	   }
		return false;
	}
	 
	public function addFranchise($name,$phone,$email,$new_franchise,$franchise_url,$start,$end)
	{
		$data = array('name' => $name,
						'mobile' => $phone,
						'email' => $email,
						'franchise_id' => $new_franchise,
						'franchise_url' => $franchise_url,
						'start_date' => $start,
						'end_date' => $end
					); 					 
					
					$result=$this->db->insert('franchise',$data);
				
					return $result;
	}
	
	public function getFranchise()
	{
		$query = $this->db->get('franchise');  
        return $query->result();
	}
	
	public function edit_Franchise($id)
	{
		$this->db->select("*");
		$this->db->from('franchise');
        $this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function updateFranchise($id,$name,$phone,$email,$start,$end,$status)     //updated on 9 april and 20 april
	{		
		$this->db->set('name', $name);
		$this->db->set('mobile', $phone);
		$this->db->set('email', $email);
		$this->db->set('start_date', $start);
		$this->db->set('end_date', $end);
		$this->db->set('status', $status);
		$this->db->where('id', $id);
		
		$this->db->update('franchise');         
	}
	
	public function delete_Franchise($id)
	{
		$this->db->delete('franchise', array('id' => $id));
	
	}
	
	public function update_course_status($id)
	{
		$this->db->set('status',"ACTIVE");
		$this->db->where('id',$id);
		$this->db->update('course_master');
	}
	
	public function getCityByCountry($id_country)  
	   {  
	      $this->db->select('id,city_name');  
	      $this->db->from('city');  
	      $this->db->where('country_id',$id_country);  
	      $query = $this->db->get();  
	      return $query->result();  
	   }  
   
	public function getDataByCountry($id_country)
	{
		$this->db->select('o.order_id, u.name, c.country_name, ct.city_name, cm.course_name, lg.language, o.order_date');
		$this->db->from('orders o');
		$this->db->join('users u', 'o.user_id=u.id');
		$this->db->join('country c', 'u.country=c.id');
		$this->db->join('city ct', 'u.city=ct.id');
		$this->db->join('course_master cm', 'o.course_id=cm.id');
		$this->db->join('language lg', 'cm.language=lg.id');
		$this->db->where('c.id', $id_country);
		$this->db->group_start();
		$this->db->where('o.status','Success');
		$this->db->or_where('o.status','TXN_SUCCESS');
		$this->db->group_end();
		$this->db->order_by('o.order_date','DESC');
		$query = $this->db->get();
		return $query->result();
	}
	public function getCountByCountry($id_country)
	{
		$this->db->select('o.order_id, u.name, c.country_name, ct.city_name, cm.course_name, lg.language, o.order_date');
		$this->db->from('orders o');
		$this->db->join('users u', 'o.user_id=u.id');
		$this->db->join('country c', 'u.country=c.id');
		$this->db->join('city ct', 'u.city=ct.id');
		$this->db->join('course_master cm', 'o.course_id=cm.id');
		$this->db->join('language lg', 'cm.language=lg.id');
		$this->db->where('c.id', $id_country);
		$this->db->group_start();
		$this->db->where('o.status','Success');
		$this->db->or_where('o.status','TXN_SUCCESS');
		$this->db->group_end();
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function getDataByCity($city_id)
	{
		$this->db->select('o.order_id, u.name, c.country_name, ct.city_name, cm.course_name, lg.language, o.order_date');
		$this->db->from('orders o');
		$this->db->join('users u', 'o.user_id=u.id');
		$this->db->join('country c', 'u.country=c.id');
		$this->db->join('city ct', 'u.city=ct.id');
		$this->db->join('course_master cm', 'o.course_id=cm.id');
		$this->db->join('language lg', 'cm.language=lg.id');
		$this->db->where('ct.id', $city_id);
		$this->db->group_start();
		$this->db->where('o.status','Success');
		$this->db->or_where('o.status','TXN_SUCCESS');
		$this->db->group_end();
		$this->db->order_by('o.order_date','DESC');
		$query = $this->db->get();
		return $query->result();
	}
	public function getCountByCity($city_id)
	{
		$this->db->select('o.order_id, u.name, c.country_name, ct.city_name, cm.course_name, lg.language, o.order_date');
		$this->db->from('orders o');
		$this->db->join('users u', 'o.user_id=u.id');
		$this->db->join('country c', 'u.country=c.id');
		$this->db->join('city ct', 'u.city=ct.id');
		$this->db->join('course_master cm', 'o.course_id=cm.id');
		$this->db->join('language lg', 'cm.language=lg.id');
		$this->db->where('ct.id', $city_id);
		$this->db->group_start();
		$this->db->where('o.status','Success');
		$this->db->or_where('o.status','TXN_SUCCESS');
		$this->db->group_end();
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getDataByDate($start, $end)
	{
		$this->db->select('o.order_id, u.name, c.country_name, ct.city_name, cm.course_name, lg.language, o.order_date');
		$this->db->from('orders o');
		$this->db->join('users u', 'o.user_id=u.id');
		$this->db->join('country c', 'u.country=c.id');
		$this->db->join('city ct', 'u.city=ct.id');
		$this->db->join('course_master cm', 'o.course_id=cm.id');
		$this->db->join('language lg', 'cm.language=lg.id');
		$this->db->where('o.order_date >=',$start);
		$this->db->where('o.order_date <=',$end);
		$this->db->group_start();
		$this->db->where('o.status','Success');
		$this->db->or_where('o.status','TXN_SUCCESS');
		$this->db->group_end();
		$this->db->order_by('o.order_date','DESC');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getCountByDate($start, $end)
	{
		$this->db->select('o.order_id, u.name, c.country_name, ct.city_name, cm.course_name, lg.language, o.order_date');
		$this->db->from('orders o');
		$this->db->join('users u', 'o.user_id=u.id');
		$this->db->join('country c', 'u.country=c.id');
		$this->db->join('city ct', 'u.city=ct.id');
		$this->db->join('course_master cm', 'o.course_id=cm.id');
		$this->db->join('language lg', 'cm.language=lg.id');
		$this->db->where('o.order_date >=',$start);
		$this->db->where('o.order_date <=',$end);
		$this->db->group_start();
		$this->db->where('o.status','Success');
		$this->db->or_where('o.status','TXN_SUCCESS');
		$this->db->group_end();
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function getDataByLanguage($lang_id)
	{
		$this->db->select('o.order_id, u.name, c.country_name, ct.city_name, cm.course_name, lg.language, o.order_date');
		$this->db->from('orders o');
		$this->db->join('users u', 'o.user_id=u.id');
		$this->db->join('country c', 'u.country=c.id');
		$this->db->join('city ct', 'u.city=ct.id');
		$this->db->join('course_master cm', 'o.course_id=cm.id');
		$this->db->join('language lg', 'cm.language=lg.id');
		$this->db->where('lg.id', $lang_id);
		$this->db->group_start();
		$this->db->where('o.status','Success');
		$this->db->or_where('o.status','TXN_SUCCESS');
		$this->db->group_end();
		$this->db->order_by('o.order_date','DESC');
		$query = $this->db->get();
		return $query->result();
	}
	public function getCountByLanguage($lang_id)
	{
		$this->db->select('o.order_id, u.name, c.country_name, ct.city_name, cm.course_name, lg.language, o.order_date');
		$this->db->from('orders o');
		$this->db->join('users u', 'o.user_id=u.id');
		$this->db->join('country c', 'u.country=c.id');
		$this->db->join('city ct', 'u.city=ct.id');
		$this->db->join('course_master cm', 'o.course_id=cm.id');
		$this->db->join('language lg', 'cm.language=lg.id');
		$this->db->where('lg.id', $lang_id);
		$this->db->group_start();
		$this->db->where('o.status','Success');
		$this->db->or_where('o.status','TXN_SUCCESS');
		$this->db->group_end();
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getDataByFranchise($franchise_id)
	{
		$this->db->select('o.order_id, u.name, c.country_name, ct.city_name, cm.course_name, lg.language, o.order_date');
		$this->db->from('orders o');
		$this->db->join('users u', 'o.user_id=u.id');	
		$this->db->join('franchise f', 'f.franchise_id= u.franchise_id');	
		$this->db->join('country c', 'u.country=c.id');
		$this->db->join('city ct', 'u.city=ct.id');
		$this->db->join('course_master cm', 'o.course_id=cm.id');
		$this->db->join('language lg', 'cm.language=lg.id');			
		$this->db->where('f.franchise_id', $franchise_id);
		$this->db->group_start();
		$this->db->where('o.status','Success');
		$this->db->or_where('o.status','TXN_SUCCESS');
		$this->db->group_end();
		$this->db->order_by('o.order_date','DESC');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getCountByFranchise($franchise_id)
	{
		$this->db->select('o.order_id, u.name, c.country_name, ct.city_name, cm.course_name, lg.language, o.order_date');
		$this->db->from('orders o');
		$this->db->join('users u', 'o.user_id=u.id');	
		$this->db->join('franchise f', 'f.franchise_id= u.franchise_id');	
		$this->db->join('country c', 'u.country=c.id');
		$this->db->join('city ct', 'u.city=ct.id');
		$this->db->join('course_master cm', 'o.course_id=cm.id');
		$this->db->join('language lg', 'cm.language=lg.id');			
		$this->db->where('f.franchise_id', $franchise_id);
		$this->db->group_start();
		$this->db->where('o.status','Success');
		$this->db->or_where('o.status','TXN_SUCCESS');
		$this->db->group_end();
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function getUsers_Data()
	{
		$this->db->select('users.name,users.mobile,users.email,city.city_name,country.country_name,language.language,franchise.name as franchise_name, users.created');
		$this->db->from('users');
		$this->db->join('city','users.city = city.id');
		$this->db->join('country','users.country = country.id');
		$this->db->join('language','users.language = language.id');
		$this->db->join('franchise','users.franchise_id = franchise.franchise_id','left');
		$this->db->where('role_id',0);
		$this->db->order_by('users.created','DESC');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getUserByCountry($id_country)  
   {  
     $this->db->select('users.name,users.mobile,users.email,city.city_name,country.country_name,language.language,franchise.name as franchise_name, users.created');
		$this->db->from('users');
		$this->db->join('city','users.city = city.id');
		$this->db->join('country','users.country = country.id');
		$this->db->join('language','users.language = language.id');
		$this->db->join('franchise','users.franchise_id = franchise.franchise_id','left');
		$this->db->where('country',$id_country);
		$this->db->order_by('users.created','DESC');
		$query = $this->db->get();
		return $query->result();
   }  	
   public function getUserCountByCountry($id_country) 
   {  
     $this->db->select('users.name,users.mobile,users.email,city.city_name,country.country_name,language.language,franchise.name as franchise_name, users.created');
		$this->db->from('users');
		$this->db->join('city','users.city = city.id');
		$this->db->join('country','users.country = country.id');
		$this->db->join('language','users.language = language.id');
		$this->db->join('franchise','users.franchise_id = franchise.franchise_id','left');
		$this->db->where('country',$id_country);
		$query = $this->db->get();
		return $query->num_rows();
   }
   public function getUserByCity($id_city) 
   {  
     $this->db->select('users.name,users.mobile,users.email,city.city_name,country.country_name,language.language,franchise.name as franchise_name, users.created');
		$this->db->from('users');
		$this->db->join('city','users.city = city.id');
		$this->db->join('country','users.country = country.id');
		$this->db->join('language','users.language = language.id');
		$this->db->join('franchise','users.franchise_id = franchise.franchise_id','left');
		$this->db->where('city',$id_city);
		$this->db->order_by('users.created','DESC');
		$query = $this->db->get();
		return $query->result();
   }  
   public function getUserCountByCity($id_city)
   {  
     $this->db->select('users.name,users.mobile,users.email,city.city_name,country.country_name,language.language,franchise.name as franchise_name, users.created');
		$this->db->from('users');
		$this->db->join('city','users.city = city.id');
		$this->db->join('country','users.country = country.id');
		$this->db->join('language','users.language = language.id');
		$this->db->join('franchise','users.franchise_id = franchise.franchise_id','left');
		$this->db->where('city',$id_city);
		$query = $this->db->get();
		return $query->num_rows();
   } 
   public function getUserByFranchise($id_franchise)
   {  
     $this->db->select('users.name,users.mobile,users.email,city.city_name,country.country_name,language.language,franchise.name as franchise_name, users.created');
		$this->db->from('users');
		$this->db->join('city','users.city = city.id');
		$this->db->join('country','users.country = country.id');
		$this->db->join('language','users.language = language.id');
		$this->db->join('franchise','users.franchise_id = franchise.franchise_id','left');
		$this->db->where('users.franchise_id',$id_franchise);
		$this->db->order_by('users.created','DESC');
		$query = $this->db->get();
		return $query->result();
   }  
   public function getUserCountByFranchise($id_franchise)
   {
	   $this->db->select('users.name,users.mobile,users.email,city.city_name,country.country_name,language.language,franchise.name as franchise_name, users.created');
		$this->db->from('users');
		$this->db->join('city','users.city = city.id');
		$this->db->join('country','users.country = country.id');
		$this->db->join('language','users.language = language.id');
		$this->db->join('franchise','users.franchise_id = franchise.franchise_id','left');
		$this->db->where('users.franchise_id',$id_franchise);
		$query = $this->db->get();
		return $query->num_rows();
   }
   public function getfranchise_Data()
   {
   		$this->db->order_by('created_date','DESC');
		$query = $this->db->get('franchise');
		 
		return $query->result();
		
   }
	
	public function franchise_user()   //not using
	{
		 $query = $this->db->get('franchise');  
      // return $query->result();
		$arr=$query->result();
		//$id=$arr[0]->franchise_id;
	//	$count=$this->getUsers_Data($id);
		foreach($arr as $row)
		{
			
			$this->db->select('count(*)as total');
			$this->db->from('users');
			$this->db->join('franchise','users.franchise_id = franchise.franchise_id','left');
			$this->db->where('users.franchise_id',$row->franchise_id);
			$query = $this->db->get(); 
			$arr   = $query->row_array(); 
			$total[] = $arr['total'];  
		}
		return $total;
		/* //array_push($row,$total);
	  echo "<pre>";
	  print_r($total);
	  echo "</pre>";
		//echo $total;
	  die(); */
	}
	
	 public function getUserByAbaow($id)					//19 jan 2018
  	 {
	 
	   /* echo $var;
	   die(); */
	   $this->db->select('users.name,users.mobile,users.email,city.city_name,country.country_name,language.language,users.created');
		$this->db->from('users');
		$this->db->join('city','users.city = city.id');
		$this->db->join('country','users.country = country.id');
		$this->db->join('language','users.language = language.id');
		//$this->db->join('franchise','users.franchise_id = franchise.franchise_id','left');
		$this->db->where('users.franchise_id',$id);
		$this->db->order_by('users.created','DESC');
		$query = $this->db->get();
		return $query->result();
  	 }
   
   public function getCountByAbaow($id)					//22 jan 2018
   {
	 
	   /* echo $var;
	   die(); */
	   $this->db->select('users.name,users.mobile,users.email,city.city_name,country.country_name,language.language,users.created');
		$this->db->from('users');
		$this->db->join('city','users.city = city.id');
		$this->db->join('country','users.country = country.id');
		$this->db->join('language','users.language = language.id');
		//$this->db->join('franchise','users.franchise_id = franchise.franchise_id','left');
		$this->db->where('users.franchise_id',$id);
		$query = $this->db->get();
		//return $query->result();
		return $query->num_rows();
   }
   
   public function getCoursesByAbaow($id)
   {
	  
		$this->db->select('o.order_id, u.name, c.country_name, ct.city_name, cm.course_name, lg.language, o.order_date');
		$this->db->from('orders o');
		$this->db->join('users u', 'o.user_id=u.id');
		$this->db->join('country c', 'u.country=c.id');
		$this->db->join('city ct', 'u.city=ct.id');
		$this->db->join('course_master cm', 'o.course_id=cm.id');
		$this->db->join('language lg', 'cm.language=lg.id');
		$this->db->group_start();
		$this->db->where('o.status','Success');
		$this->db->or_where('o.status','TXN_SUCCESS');
		$this->db->group_end();
		$this->db->where('u.franchise_id',$id);
		$this->db->order_by('o.order_date','DESC');
		$query = $this->db->get();
		return $query->result();
	   }
      public function getCourseCountByAbaow($id)
   {
   	$this->db->select('o.order_id, u.name, c.country_name, ct.city_name, cm.course_name, lg.language, o.order_date');
		$this->db->from('orders o');
		$this->db->join('users u', 'o.user_id=u.id');
		$this->db->join('country c', 'u.country=c.id');
		$this->db->join('city ct', 'u.city=ct.id');
		$this->db->join('course_master cm', 'o.course_id=cm.id');
		$this->db->join('language lg', 'cm.language=lg.id');
		$this->db->group_start();
		$this->db->where('o.status','Success');
		$this->db->or_where('o.status','TXN_SUCCESS');
		$this->db->group_end();
		$this->db->where('u.franchise_id',$id);
		$this->db->order_by('o.order_date','DESC');
		$query = $this->db->get();
		return $query->num_rows();
   }
   public function getCourse_user_data()
	{
		$this->db->select('o.course_id, cm.course_name, lg.language');
		$this->db->from('orders o');
		$this->db->join('course_master cm', 'o.course_id=cm.id');
		$this->db->join('language lg','cm.language = lg.id');
		$this->db->group_by('cm.course_name');
		$this->db->group_start();
		$this->db->where('o.status','Success');
		$this->db->or_where('o.status','TXN_SUCCESS');
		$this->db->group_end();
		$query = $this->db->get();
		return $query->result();
	}
	public function get_instructor_count()						//23 jan 2018
	{
		$query = $this->db->get('instructor');  
        //return $query; 
		return $query->num_rows();
	}
	
	public function getCourse_trainer_data($id)					//23 jan 2018
	{
		$this->db->select('o.course_id, cm.course_name, lg.language');
		$this->db->from('orders o');
		$this->db->join('course_master cm', 'o.course_id=cm.id');
		$this->db->join('language lg','cm.language = lg.id');
		$this->db->join('instructor ins', 'cm.instructor=ins.id');
		$this->db->group_by('cm.course_name');
		$this->db->group_start();
		$this->db->where('o.status','Success');
		$this->db->or_where('o.status','TXN_SUCCESS');
		$this->db->group_end();
		$this->db->where('ins.id',$id);
		$query = $this->db->get();
		return $query->result();
		//$array=$query->result();
	/* print_r($array);
	die(); */
	}
	
	public function getUserCount($id)							//23 jan 2018
	{
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->join('orders o','u.id = o.user_id');
		$this->db->where('o.course_id',$id);
		$this->db->group_start();
		$this->db->where('o.status','Success');
		$this->db->or_where('o.status','TXN_SUCCESS');
		$this->db->group_end();
		$query = $this->db->get(); 
		return $query->num_rows();
	}
	
	
	public function get_course_name()						//31 jan 2018
	{
		$query= $this->db->get('course_master');
		return $query->result();
		
	}
	
	public function getUserByCourse($id_course)  					//31 jan 2018
	   {  
	      $this->db->select('u.id,u.name');  
	      $this->db->from('users u');  
		  $this->db->join('orders o','o.user_id=u.id');
	      $this->db->where('o.course_id',$id_course); 
		$this->db->group_start();
		$this->db->where('o.status','Success');
		$this->db->or_where('o.status','TXN_SUCCESS');
		$this->db->group_end();		  
	      $query = $this->db->get();  
	      return $query->result();  
	   } 
	   
	  /* public function getQuiz_Data($course_id,$user_id)						//31 jan 2018
	  {
		  $this->db->select('uq.answer, uq.created');
		  $this->db->from('user_quiz uq');
		  $this->db->where('uq.course_id',$course_id);
		  $this->db->where('uq.user_id',$user_id);
		  $query = $this->db->get();
		  return $query->result();
		  } */
		  
		  public function getQuiz_Data($course_id,$user_id)						//1 feb 2018
	  {
		  $this->db->select('uq.id,uq.answer, uq.created,qz.question');
		  $this->db->from('user_quiz uq');
		  $this->db->join('course_curriculum cc','cc.course_id=uq.course_id','cc.id=uq.module_id');
		  $this->db->join('quiz qz','qz.order=uq.question_id');
		  $this->db->join('course_curriculum ccc','ccc.module_quiz=qz.quiz_id','left');
		  $this->db->where('uq.course_id',$course_id);
		  $this->db->where('uq.user_id',$user_id);
		  $this->db->where('qz.quiz_id=cc.module_quiz');
		  $this->db->group_by('uq.id');
		  $query = $this->db->get();
		  return $query->result();
		 		  
		  }
		  
	public function getUserByDate($start, $end)							//14 feb 2018
	{
		$this->db->select('users.name,users.mobile,users.email,city.city_name,country.country_name,language.language,franchise.name as franchise_name, users.created');
		$this->db->from('users');
		$this->db->join('city','users.city = city.id');
		$this->db->join('country','users.country = country.id');
		$this->db->join('language','users.language = language.id');
		$this->db->join('franchise','users.franchise_id = franchise.franchise_id','left');
		$this->db->where('users.created >=',$start);
		$this->db->where('users.created <=',$end);
		$this->db->order_by('users.created','DESC');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getUserCountByDate($start, $end)							//14 feb 2018
	{
		$this->db->select('users.name,users.mobile,users.email,city.city_name,country.country_name,language.language,franchise.name as franchise_name, 	users.created');
		$this->db->from('users');
		$this->db->join('city','users.city = city.id');
		$this->db->join('country','users.country = country.id');
		$this->db->join('language','users.language = language.id');
		$this->db->join('franchise','users.franchise_id = franchise.franchise_id','left');
		$this->db->where('users.created >=',$start);
		$this->db->where('users.created <=',$end);
		$this->db->order_by('users.created','DESC');
		$query = $this->db->get();
		//return $query->result();
		return $query->num_rows();
	}
	
	/*  ----------- Blog Coding ----------- */								//20 march 2018
	
	 public function getBlogs()										//updated 4 april 2018
	 {
		 $query = $this->db->get('blogs');
		 return $query;
	 }
	 
	 public function add_blog_data($title,$lang,$img_url,$content)
	 {
		 $query= $this->db->query("Insert into blogs (blog_title,blog_lang,blog_img,blog_content) values ('".$title."','".$lang."','".$img_url."','".$content."')");
		return $query;
	 }
	 
	 public function edit_blog($id)
	 {
		$this->db->select('blogs.id,blog_title,blog_lang,blog_img,blog_content,language.language as language_name');
		$this->db->from('blogs');
		$this->db->join('language','blogs.blog_lang = language.id');
		$this->db->where('blogs.id',$id);
		$query = $this->db->get();
		return $query->result(); 
	 }
	
	public function update_blog_data($id,$title,$lang,$img_url,$content)
	{
		$this->db->set('blog_title', $title);
		$this->db->set('blog_lang', $lang);
		$this->db->set('blog_content', $content);
		$this->db->set('blog_img', $img_url);
		$this->db->where('id', $id);
		$this->db->update('blogs'); 
	}
	
	public function delete_blogdata($id)						
	{
		$this->db->select('*');
		$this->db->from('blogs');
		$this->db->where('id',$id);
		$query = $this->db->get();
		
		if($query->result()>0)
		{
			$this->db->select('blog_img');
			$query = $this->db->get_where('blogs', array('id' => $id));
					
					if($query->num_rows()>0)
					{                   
							$result=$query->result_array();  
							
							$image_name=$result[0]['blog_img'];
							/*echo "<pre>";
							print_r($image_name);
							echo "<pre>";
							die();*/
							$img_array= explode("/",$image_name);
							$image= end($img_array);
							
							if($image!="")
							{
								if(file_exists("./uploads/images/".$image))
								{
									unlink("./uploads/images/".$image);
								
								}						
							}
					} 
			
			
			$this -> db -> where('id', $id);
			$this -> db -> delete('blogs');
		}
		
	}
	
	public function update_franchise_status($id,$status)					//9 april 2018 & 20 april 
	{
		$this->db->set('status',"ACTIVE");
		$this->db->where('id',$id);
		$this->db->update('franchise');
		
	}	
	
	/*-----------add video url------------*/									//28 april 2018
	public function get_url()
	{
		$query = $this->db->get('video');  
        return $query->result();
	}
	public function addURL($url)
	{
		$query= $this->db->query("Insert into video (video_url) values ('".$url."')");
		return $query;
	}
	
	public function edit_video_url($id)
	{
		$this->db->select("video_id, video_url");
		$this->db->from('video');
        $this->db->where('video_id',$id);
		$query = $this->db->get();
		return $query;
	}
	
	public function updateUrl($id,$url)
	{		
		$this->db->set('video_url', $url);		
		$this->db->where('video_id', $id);
		$this->db->update('video');         
	}
	
	public function delete_Url($id)
	{
		$this->db->select('*');
		$this->db->from('video');
		$this->db->where('video_id',$id);
		$query = $this->db->get();
		
		if($query->result()>0)
		{
			$this -> db -> where('video_id', $id);
			$this -> db -> delete('video');
		}
	}
	//updated on 18 may 2018
	function get_module_after($module_after)
	{
		$this->db->select('*');
		$this->db->from('course_curriculum');
		$this->db->where('module_after',$module_after);
		$query =$this->db->get();
		return $query->result();
		
	}
	
		  
}	

?>