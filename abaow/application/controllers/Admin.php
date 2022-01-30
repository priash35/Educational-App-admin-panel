<?php

class Admin extends CI_Controller
{
	public function __construct()
	{
		
		parent::__construct();
		if (!isset($_SESSION['user_logged'])) {
			
			//$this->session->set_flashdata("error", "plese login first view of page");
			//redirect("login/index","refresh");
			
		}
		$this->load->library('form_validation');
		$this->load->model('Admin_model');		
	}
	
	public function index()
	{		
		//$this->load->view("superadmin/dashboard");
	}
	
	public function dashboard()
	{	
		$this->load->model('Admin_model');
		$data['purchase']= $this->Admin_model->course_data();					//30 jan 2018
		$data['result']= $this->Admin_model->user_count();
		$data['courses']= $this->Admin_model->course_count();
		$data['franchise']= $this->Admin_model->franchise_count();
		$data['result1'] = $this->Admin_model->get_instructor_count();
		//print_r($data);
		//die();
		$this->load->view("superadmin/dashboard", $data);
		
	}
	
	
	/* -----   Course fuctions   ------ */
	public function add_coursedata() 							//to add course
	{
			 	if(isset($_POST['add_course']))
				{
					//$name=$_POST['ins_name'];
					$course_name= $_POST['course_name'];
					$instructor= $_POST['ins_name'];
					$course_description= $_POST['course_desc'];
					//$intro_audio= $_POST['intro_audio'];
					//$image=$_POST['course_image'];
					$language= $_POST['course_lang'];
					$fee= $_POST['course_fee'];
					$duration= $_POST['course_dur'];
					
					if($_FILES['intro_audio']['tmp_name']!="")
					{
						$filename=$_FILES['intro_audio']['name'];
						$source=$_FILES['intro_audio']['tmp_name'];
						$dest="./uploads/".$filename;
						$name="uploads/".$filename;
						$audio_url=base_url().$name;
						
						
						
						move_uploaded_file($source,$dest);
					}	
					
					if($_FILES['course_image']['tmp_name']!="")
					{
				
						$file_name = $_FILES['course_image']['name'];			 
						$file_tmp =$_FILES['course_image']['tmp_name'];
				  		$dest1= "./uploads/images/".$file_name;
						$img="uploads/images/".$file_name;
						$img_url=base_url().$img;
						move_uploaded_file($file_tmp, $dest1);
			    	}
						
					$this->load->model('admin_model');		
					//$result= $this->admin_model->addCourse($data);
					$result= $this->admin_model->addCourse($course_name,$instructor,$course_description,$audio_url,$img_url,$language,$fee,$duration);
					
					redirect("admin/add_course","refresh");
					
				 }
				else
				{
					echo'fail';
				} 
			
		$this->load->model("admin_model");
		$data['courses'] = $this->admin_model->getCourse();
		$data['records'] = $this->admin_model->getInstructor();
		$data['lang'] = $this->admin_model->getlang();
		$this->load->view("superadmin/add_course",$data);
								
	}
	
	public function add_course()						{
		//$this->load->view("superadmin/add_course");
		$this->load->model("admin_model");
		$data['courses'] = $this->admin_model->getCourse();
		$data['records'] = $this->admin_model->getInstructor();
		$data['lang'] = $this->admin_model->getlang();
		$this->load->view("superadmin/add_course",$data);
		
	}
	
	public function edit_course()						//currently using
	{
		$id = $this->uri->segment('3');
		$this->load->model('Admin_model');
		//$data['records'] = $this->admin_model->getInstructor();
        $data['records1'] = $this->Admin_model->edit_course($id);
		$data['lang'] = $this->Admin_model->get_languages();
		$data['ins'] = $this->Admin_model->get_instructor();
		 /* echo'<pre>';
		   print_r($data);
		 echo'</pre>';
		die();  */
		//$data['records'] = $this->admin_model->getInstructor();	
		
		$this->load->view("superadmin/edit_course",$data);
	}
	
	public function update_course()						//currently using
	{
		if(isset($_POST['update_course']))
		{						
					$id=$_POST['course_id'];
					$course_name= $_POST['course_name'];
					$instructor= $_POST['ins_name'];
					$course_description= $_POST['course_desc'];
					//$intro_audio= $_POST['intro_audio'];
					$language= $_POST['course_lang'];
					$fee= $_POST['course_fee'];
					$duration= $_POST['course_dur'];
					
					if($_FILES['intro_audio']['tmp_name']!="")
					{
						$filename=$_FILES['intro_audio']['name'];
						$source=$_FILES['intro_audio']['tmp_name'];
						$dest="./uploads/".$filename;
						$name="uploads/".$filename;
						$audio_url=base_url().$name;
						move_uploaded_file($source,$dest);
						
					}	
					
					else
					{
						$audio_url=$_POST['intro_aud'];
					}
					
					
					if($_FILES['course_image']['tmp_name']!="")
					{
				
						$file_name = $_FILES['course_image']['name'];			 
						$file_tmp =$_FILES['course_image']['tmp_name'];
				  		$dest1= "./uploads/images/".$file_name;
						$img="uploads/images/".$file_name;
						$img_url=base_url().$img;
						move_uploaded_file($file_tmp, $dest1);
			    
					}
					
					else
					{
						$img_url=$_POST['course_img'];
					}
					
					
			$this->load->model('Admin_model');
			$this->Admin_model->update_course($id,$course_name,$instructor,$course_description,$audio_url,$img_url,$language,$fee,$duration);
			redirect("admin/add_course/add_course","refresh");
		}
		else
		{
			echo'fail';
		}
				
	}
	
	public function delete_course()
	{
		//$id=$this->uri->segment('3');
		$id= $_REQUEST['id'];
		$this->load->model('Admin_model');
		$data['records'] = $this->Admin_model->delete_course($id);
		 /* echo'<pre>';
		   print_r($data);
		 echo'</pre>';
		die();   */
		redirect("admin/add_course/add_course","refresh");
	}
	
	public function course_status()
	{
		$id=$_REQUEST['id'];
		$this->load->model('Admin_model');
		$this->Admin_model->update_course_status($id);
		redirect("admin/add_course/add_course","refresh");
	}
	
	/* -----   Course_curriculum fuctions   ------ */
	public function add_quizmodule()								//updated on 18 may 2018
	{
		if(isset($_POST['add_quizmodule']))
		{
			if(isset($_POST['module_after']))
			{
				$module_after=$_POST['module_after'];
			}
			else
			{
				$module_after=0;
			}
			
			$res=$this->Admin_model->get_module_after($module_after);
			
			$course_id=$_POST['course_id'];
			$module_name=$_POST['module_name'];
			$module_quiz=$_POST['module_quiz'];
			$module_desc=$_POST['module_desc'];
			//$module_after=$_POST['module_after'];
			$module_audio="NULL";
			$duration=0;
			
			
			/* $data = array(
					'course_id'=> $course_id,
					'module_name'=> $module_name,
					'module_audio'=> $module_audio ,
					'module_quiz'=> $module_quiz,
					'module_desc'=> $module_desc,
					'duration'=> $duration,
					'module_after'=> $module_after,
					);
					 */
			
			$this->load->model("admin_model");
			$result= $this->admin_model->add_quizmodule($course_id,$module_name,$module_audio,$module_quiz,$module_desc,$duration,$module_after,$res);
			$data['courses'] = $this->admin_model->getCourse();
			$data['records'] = $this->admin_model->getInstructor();
			$data['lang'] = $this->admin_model->getlang();
			//$this->load->view("superadmin/add_course/add_course",$data);
			redirect("admin/add_course","refresh");
		}
		else
		{
			echo'fail';
		}  
	}
	
	public function add_audiomodule()										//updated on 18 may 2018
	{
		if(isset($_POST['add_audiomodule']))	
		{
			
			if(isset($_POST['module_after']))
			{
				$module_after=$_POST['module_after'];
			}
			else
			{
				$module_after=0;
			}
			
			$res=$this->Admin_model->get_module_after($module_after);
			/*  print_r($res);
			die(); */
			/* if($res)
			{
				
			}
			else
			{ */
				$course_id=$_POST['course_id'];
				$module_name=$_POST['module_name'];
				//$module_audio=$_POST['module_audio'];
				$module_desc=$_POST['module_desc'];
				$module_dur=$_POST['module_dur'];
				//$module_after=$_POST['module_after'];
				$module_quiz="NULL";
				/* print_r($_FILES['module_audio']);
				die(); */
				if($_FILES['module_audio']['tmp_name']!="")
					{
						$filename=$_FILES['module_audio']['name'];
						$source=$_FILES['module_audio']['tmp_name'];
						$dest="./uploads/".$filename;
						$name="uploads/".$filename;
						$audio_url=base_url().$name;
						
						
						move_uploaded_file($source,$dest);
					}	
				/* $data=array(
					'course_id'=>$course_id,
					'module_name'=>$module_name,
					'module_audio'=>$audio_url,
					'module_desc'=>$module_desc,
					'duration'=>$module_dur,
					'module_after'=>$module_after,
					'module_quiz'=>$module_quiz,
					); */
			
				 /* echo'<pre>';
				   print_r($data);
				 echo'</pre>';
				die();   
					 */
				$this->load->model("admin_model");
				//$result= $this->admin_model->add_audiomodule($data);
				$result= $this->admin_model->add_audiomodule($course_id,$module_name,$audio_url,$module_desc,$module_dur,$module_after,$module_quiz,$res);
				
				$data['courses'] = $this->admin_model->getCourse();
				$data['records'] = $this->admin_model->getInstructor();
				$data['lang'] = $this->admin_model->getlang();
				$this->load->view("superadmin/add_course",$data);
			//}
			
		}
		else
		{
			echo'fail';
		}  
	}
	public function edit_quizmodule()						//currently using
	{
		$id = $this->uri->segment('3');
		$this->load->model('Admin_model');
		$data['records1'] = $this->Admin_model->edit_module($id);
		$data['quizdata'] = $this->Admin_model->get_quiz();
		
		//$data['moduledata'] = $this->Admin_model->get_modulename($course_id);
		/*  echo'<pre>';
		   print_r($data);
		 echo'</pre>';
		die(); */ 
		
		$this->load->view("superadmin/edit_module",$data);
		
	}
	
	
	public function edit_audiomodule()
	{
		$id = $this->uri->segment('3');
		$this->load->model('Admin_model');
		//$course_id = $_POST['course_id'];
		
		
		$this->db->select('*');
		$this->db->from('course_curriculum');
		$this->db->where('module_quiz', 0);
		$this->db->where('id',$id);
		$query = $this->db->get();
		$res=$query->result();		
		/* print_r($res);
		die(); */
		if(!empty($res))
		{
			//echo"audio";
			$data['records1'] = $this->Admin_model->edit_audiomodule($id);
			$this->load->view("superadmin/edit_audiomodule",$data);
		}
		else
		{
			
			$data['records1'] = $this->Admin_model->edit_module($id);
			$data['quizdata'] = $this->Admin_model->get_quiz();
						
			$this->load->view("superadmin/edit_module",$data);
			
		}
		
		/* $data['records1'] = $this->Admin_model->edit_audiomodule($id);
		$this->load->view("superadmin/edit_audiomodule",$data); */
	}
	
	public function update_audiomodule()
	{
		if(isset($_POST['update_audiomodule']))
		{
			$id=$_POST['module_id'];
			$course_id=$_POST['course_id'];
			$module_name=$_POST['module_name'];
			//$module_audio=$_POST['module_audio'];
			$module_desc=$_POST['module_desc'];
			$module_dur=$_POST['module_dur'];
			$module_after=$_POST['module_after'];
			if($_FILES['module_audio']['tmp_name']!="")
					{
						$filename=$_FILES['module_audio']['name'];
						$source=$_FILES['module_audio']['tmp_name'];
						$dest="./uploads/".$filename;
						$name="uploads/".$filename;
						$audio_url=base_url().$name;
						
						move_uploaded_file($source,$dest);
					}	
					
					else
					{
						$audio_url=$_POST['module_audio'];
					}
				
			$this->load->model('Admin_model');
			$this->Admin_model->update_audiomodule($id,$course_id,$module_name,$audio_url,$module_desc,$module_dur,$module_after);
		
			redirect("admin/add_course","refresh");
			//redirect("admin/select_module","refresh");
		}
	}
	
	public function update_quizmodule()
	{
		if(isset($_POST['add_quizmodule']))
		{
			
			if(isset($_POST['module_after']))
			{
				$module_after=$_POST['module_after'];
			}
			else
			{
				$module_after=0;
			}
			$id=$_POST['module_id'];
			$course_id=$_POST['course_id'];
			$module_name=$_POST['module_name'];
			$module_quiz=$_POST['module_quiz'];
			$module_desc=$_POST['module_desc'];
			//$module_after=$_POST['module_after'];
			//$module_audio="NULL";
			//$duration=0;
			
			
			/* $data = array(
					'course_id'=> $course_id,
					'module_name'=> $module_name,
					'module_audio'=> $module_audio ,
					'module_quiz'=> $module_quiz,
					'module_desc'=> $module_desc,
					'duration'=> $duration,
					'module_after'=> $module_after,
					); */
				
			$this->load->model('Admin_model');
			$this->Admin_model->update_quizmodule($id,$course_id,$module_name,$module_quiz,$module_desc,$module_after);
			
			redirect("admin/add_course/add_course","refresh");
			//redirect("admin/select_module","refresh");
		}
	}
	
	public function delete_audiomodule()
	{
		//$id=$this->uri->segment('3');
		$id= $_REQUEST['id'];
		$this->load->model('Admin_model');
		$data['records'] = $this->Admin_model->delete_audiomodule($id);
		
		redirect("admin/add_course/add_course","refresh");
	}
	
	public function delete_quizmodule()
	{
		$id=$_REQUEST['id'];
		$course_id=$_REQUEST['c_id'];
		/* echo $course_id;
		die(); */ 
		$this->load->model('Admin_model');
		$data['records']=$this->Admin_model->delete_quizmodule($id,$course_id);
			/* echo'<pre>';
			 print_r($data);
			 echo'</pre>';
			die();   */
		redirect("admin/add_course/add_course","refresh");
	}
		
	public function select_module()
	{
		$id = $this->uri->segment('3');
		$this->load->model('Admin_model');
		$data['audiomodule'] = $this->Admin_model->get_audiomodule($id);
		$data['quizmodule'] = $this->Admin_model->get_quizmodule($id);
		$data['module'] = $this->Admin_model->get_module($id);
		$data['course_id'] = $this->Admin_model->select_id($id);
		
		if(isset($_POST['next']))
		{
			
			$module = $this->input->post('module');
			$course_id = $_POST['course_id'];
			$data['c_id'] = $course_id;

			
			if($module=="Audio")
			{
				$course_id = $_POST['course_id'];
				
				$data['course_id']= $_POST['course_id'];
				$data['moduledata'] = $this->Admin_model->get_modulename($course_id);
				
				$this->load->view("superadmin/audio_module",$data);
			}
			else 
			{
				$data['course_id']= $_POST['course_id'];
				$data['quizdata'] = $this->Admin_model->get_quiz();
				$data['moduledata'] = $this->Admin_model->get_modulename($course_id);
														
				$this->load->view("superadmin/quiz_module",$data);
			}
		}
		$this->load->view('superadmin/select_module',$data);
	}
	
	
	
	/* -----   Instructor fuctions   ------ */
	
	public function add_instructor()	//currently using
	{
		if(isset($_POST['add_instructor'])){
			$ins_id= $_POST['ins_id'];
			$ins_desc= $_POST['ins_desc'];
			//$ins_name = $_POST['add_photo'];			
			if($_FILES['add_photo']['tmp_name']!=""){
				
			  $file_name = $_FILES['add_photo']['name'];			 
			  $file_tmp =$_FILES['add_photo']['tmp_name'];
			  
			  $dest= "./uploads/images/".$file_name;
			  $img="uploads/images/".$file_name;
			  $img_url=base_url().$img;
			  move_uploaded_file($file_tmp, $dest);
			    
			}
			//die();
			$this->load->model("Admin_model");
			$result = $this->Admin_model->addElement($ins_id,$img_url,$ins_desc);
			redirect("admin/add_instructor","refresh");
			
		}else
		{
			echo"fail";
		}
		$this->load->model("Admin_model");
		$data['records'] = $this->Admin_model->getInstructor();
		$data['msg']= "";
		$this->load->view("superadmin/add_instructor",$data);
	}
	
	public function editInstructor()
	{
		$id = $this->uri->segment('3');
		$this->load->model('Admin_model');
        $data['records'] = $this->Admin_model->edit_Instructor($id);
		$this->load->view("superadmin/edit_instructor",$data);	
				
	}
	
	public function update_ins_name()
	{
		if(isset($_POST['update_page'])){						
			
			$name= $_POST['ins_name'];
			$id= $_POST['page_id'];			
			$profile= $_POST['ins_desc'];
			
			if($_FILES['add_photo']['tmp_name']!="")
			{				
			  $new_photo = $_FILES['add_photo']['name'];			 
			  $file_tmp =$_FILES['add_photo']['tmp_name'];
			  
			  $dest= "./uploads/images/".$new_photo;
			  $img="uploads/images/".$file_name;
			  $img_url=base_url().$img;
			  move_uploaded_file($file_tmp, $dest);			    
			}
			else
			{
				$img_url= $_POST['ins_image'];
			}
			
			$this->load->model('Admin_model');
			$this->Admin_model->update_ins($id,$name,$img_url,$profile);			
			redirect("admin/add_instructor","refresh");
		}
		else
		{
			echo'fail';
		}
				
	}
	
	public function deleteInstructor()
	{
		//$id = $this->uri->segment('3');
		$id= $_REQUEST['id'];
		$this->load->model('Admin_model');
        $data['msg'] = $this->Admin_model->delete_Instructor($id);		
		$data['records'] = $this->Admin_model->getInstructor();
		/* echo "<pre>";
		print_r($data);
		echo "</pre>";
		die(); */ 
		//$alert=$msg;
		$this->load->view("superadmin/add_instructor",$data,"refresh");	
	}
	
	/* -----   Quiz fuctions   ------ */
	
	public function add_quiz()
	{
		if(isset($_POST['add_quiz']))
		{
			
			$quiz_id= $_POST['quiz_id'];
			$quiz_name= $_POST['quiz_name'];
			//$que_id= $_POST['que_id'];
			
			$this->load->model("Admin_model");
			$result = $this->Admin_model->addquiz($quiz_id,$quiz_name);
			redirect("admin/add_quiz","refresh");
			
		}else
		{
			echo"fail";
		}
		
		$this->load->model("Admin_model");
		$data['records'] = $this->Admin_model->getQuiz();
		$data['msg']= "";
		/* echo "<pre>";
		print_r($data);
		echo "</pre>";
		die(); */
		$this->load->view("superadmin/add_quiz_name",$data);
	}
	
	public function editQuiz()
	{
		$id = $this->uri->segment('3');
		$this->load->model('Admin_model');
        $data['records'] = $this->Admin_model->edit_Quiz($id);
		$this->load->view("superadmin/edit_quiz_name",$data);	
	}
	public function update_quiz()
	{
		if(isset($_POST['update_quiz'])){						
			
			$q_name= $_POST['quiz_name'];
			$q_id= $_POST['quiz_id'];			
			$id= $_POST['q_id'];
			
			$this->load->model('Admin_model');
			$this->Admin_model->updateQuiz($id,$q_id,$q_name);
			
			redirect("admin/add_quiz","refresh");
		}
		else
		{
			echo'fail';
		}				
	}
	public function deleteQuiz()
	{
		$id= $_REQUEST['id'];
		$this->load->model('Admin_model');
        $data['msg'] = $this->Admin_model->delete_Quiz($id);
		/* echo "<pre>";
			print_r($data);
			echo "</pre>";
			die(); */
		$data['records'] = $this->Admin_model->getQuiz();
		
		$this->load->view("superadmin/add_quiz_name",$data,"refresh");
	}
	
	public function add_question()
	{
		/*
		$q_id= $id; */
		if(isset($_POST['add_question']))
		{
			$quiz_id= $_POST['q_id'];
			$que_name= $_POST['que_name'];
			$que_id= $_POST['que_id'];
			$que_type= $_POST['que_type'];
			
			
			$this->load->model("Admin_model");
			$data = $this->Admin_model->addquestion($quiz_id,$que_id,$que_name,$que_type);
			/* echo "<pre>";
			print_r($data);
			echo "</pre>";
			die(); */
			redirect("admin/add_quiz","refresh");
			
			
		}else
		{
			echo"fail";
		}
		
		$id = $this->uri->segment('3');
		$this->load->model("Admin_model");
		$data['records'] = $this->Admin_model->getQuizData($id);
		/* echo "<pre>";
		print_r($data);
		echo "</pre>";
		die(); */	
		$this->load->view("superadmin/add_quiz",$data);
	}
	
	public function editQuestion()
	{
		$id = $this->uri->segment('3');
		$this->load->model('Admin_model');
		$q_id = $this->Admin_model->find_quiz_id($id);
		$quiz_id= $q_id[0]->quiz_id;
		/* echo "<pre>";
		echo $quiz_id;
		echo "</pre>";
		die(); */
        $data['records'] = $this->Admin_model->edit_Question($id);
		
		$quiz_id= $data['records'][0]['quiz_id'];
		$old_ord= $data['records'][0]['order'];
		//echo $data['records'][0]['quiz_id'];
		//echo $data['records'][0]['order'];
		$data['records1'] = $this->Admin_model->get_previous_que($quiz_id,$old_ord);
		/* echo "<pre>";
		print_r($data);
		echo "</pre>";
		die(); */
		$data['questions'] = $this->Admin_model->get_questions($quiz_id);
		
		$this->load->view("superadmin/edit_quiz",$data);
	}
	
	public function update_question()
	{
		if(isset($_POST['update_question'])){						
			
			$quiz_id= $_POST['q_id'];
			$que_name= $_POST['que_name'];
			$que_id= $_POST['que_id'];
			$que_type= $_POST['que_type'];
			$id= $_POST['id'];
			
			
			//echo $que_name;
			//die();
			$this->load->model('Admin_model');
			$q_name = $this->Admin_model->find_quiz($quiz_id);
			//print_r($q_id);
			//die();
			$quiz_name= $q_name[0]->quiz_name;
			$this->Admin_model->updateQuestion($id,$quiz_id,$quiz_name,$que_id,$que_name,$que_type);
			
			redirect("admin/add_quiz","refresh");
		}
		else
		{
			echo'fail';
		}				
	}
	
	public function deleteQuestion()
	{
		$id= $_REQUEST['id'];
		$q_id = $this->Admin_model->find_quiz_id($id);
		$quiz_id= $q_id[0]->quiz_id;
		$this->load->model('Admin_model');
        $data['msg'] = $this->Admin_model->delete_Question($id,$quiz_id);
		/* echo "<pre>";
			print_r($data);
			echo "</pre>";
			die(); */
		
		/* echo "<pre>";
		echo $quiz_id;
		echo "</pre>";
		die(); */        
		$data['records'] = $this->Admin_model->get_questions($quiz_id);
		/* echo "<pre>";
			print_r($data);
			echo "</pre>";
			die(); */
		$this->load->view("superadmin/add_quiz",$data,"refresh");
	}
	/* -----   Country fuctions   ------ */
	
	public function show_country()
	{
		$this->load->model("Admin_model");
		$data['countrys'] = $this->Admin_model->getCountry();
		$data['msg']= "";
		$this->load->view("superadmin/add_country",$data);
	}
	
	public function add_country()
	{
		if(isset($_POST['add_country'])){
			
			$c_name= $_POST['country'];	
			$this->load->model("Admin_model");			
			$result = $this->Admin_model->addCountry($c_name);
			redirect("admin/show_country","refresh");
			
		}else
		{
			echo"fail";
		}
	}
	public function editCountry()
	{
		$id = $this->uri->segment('3');
		$this->load->model('Admin_model');
        $data['records'] = $this->Admin_model->edit_Country($id);
		$this->load->view("superadmin/edit_country",$data);	
	}
	
	public function update_country()
	{
		if(isset($_POST['update_country'])){						
			
			$c_name= $_POST['country'];
			$id= $_POST['c_id'];			
			
			$this->load->model('Admin_model');
			$this->Admin_model->updateCountry($id,$c_name);
			
			redirect("admin/show_country","refresh");
		}
		else
		{
			echo'fail';
		}
				
	}
	public function deleteCountry()
	{
		
		$id= $_REQUEST['id'];
		$this->load->model('Admin_model');
        $data['msg'] = $this->Admin_model->delete_Country($id);
		$data['countrys'] = $this->Admin_model->getCountry();
		
		$this->load->view("superadmin/add_country",$data,"refresh");	
	}
	
	/* -----   City fuctions   ------ */
	
	public function show_city()
	{
		$this->load->model("Admin_model");
		$data['countrys'] = $this->Admin_model->getCountry();
		$data['citys'] = $this->Admin_model->getCity();
		$data['msg']= "";
		$this->load->view("superadmin/add_city",$data);
	}
	
	public function add_city()
	{
		if(isset($_POST['add_city'])){
			
			$c_id= $_POST['country_id'];
			$c_name= $_POST['city'];	
			$this->load->model("Admin_model");			
			$result = $this->Admin_model->addCity($c_id,$c_name);
			redirect("admin/show_city","refresh");
			
		}else
		{
			echo"fail";
		}
	}
	public function editCity()
	{
		$id = $this->uri->segment('3');
		$this->load->model('Admin_model');
        $data['city_records'] = $this->Admin_model->edit_City($id);
		
		$data['countrys'] = $this->Admin_model->getCountry();
		$this->load->view("superadmin/edit_city",$data);	
	}
	
	public function update_city()
	{
		if(isset($_POST['update_city'])){						
			
			$country_id= $_POST['country_id'];
			$c_name= $_POST['city'];
			$id= $_POST['c_id'];			
			
			$this->load->model('Admin_model');
			$this->Admin_model->updateCity($id,$country_id,$c_name);
			
			redirect("admin/show_city","refresh");
		}
		else
		{
			echo'fail';
		}
				
	}
	public function deleteCity()
	{
		//$id = $this->uri->segment('3');
		$id= $_REQUEST['id'];
		$this->load->model('Admin_model');
        $data['msg'] = $this->Admin_model->delete_City($id);
		$data['citys'] = $this->Admin_model->getCity();
		
		$this->load->view("superadmin/add_city",$data,"refresh");	
	}
	
	/* -----   Languages fuctions   ------ */
	
	public function show_language()
	{
		$this->load->model("Admin_model");
		$data['languages'] = $this->Admin_model->get_languages();
		//$data['citys'] = $this->Admin_model->getCity();
		$data['msg']= "";
		$this->load->view("superadmin/add_language",$data);
	}
	
	public function add_language()
	{
		if(isset($_POST['add_language'])){
			
			$l_name= $_POST['language'];	
			$this->load->model("Admin_model");			
			$result = $this->Admin_model->addLanguage($l_name);
			redirect("admin/show_language","refresh");
			
		}else
		{
			echo"fail";
		}
	}
	public function editLanguage()
	{
		$id = $this->uri->segment('3');
		$this->load->model('Admin_model');
        $data['records'] = $this->Admin_model->edit_Language($id);
		$this->load->view("superadmin/edit_language",$data);	
	}
	
	public function update_language()
	{
		if(isset($_POST['update_language'])){						
			
			$l_name= $_POST['language'];
			$id= $_POST['l_id'];			
			
			$this->load->model('Admin_model');
			$this->Admin_model->updateLanguage($id,$l_name);
			
			redirect("admin/show_language","refresh");
		}
		else
		{
			echo'fail';
		}
				
	}
	public function deleteLanguage()
	{
		
		$id= $_REQUEST['id'];
		$this->load->model('Admin_model');
        $data['msg'] = $this->Admin_model->delete_Language($id);
		$data['languages'] = $this->Admin_model->get_languages();
		
		$this->load->view("superadmin/add_language",$data,"refresh");	
	}
	
	
	public function add_notification()
	{
		if(isset($_POST['add_notification'])){
			
			$country= $_POST['country'];
			$city= $_POST['city'];
			$message= $_POST['n_msg'];
			//$status= $_POST['status'];
			
			$this->load->model("Admin_model");			
			$result = $this->Admin_model->addNotification($country,$city,$message);
			redirect("admin/add_notification","refresh");
			
		}else
		{
					
			$this->load->model("Admin_model");
			$data['countrys'] = $this->Admin_model->getCountry();
			$data['citys'] = $this->Admin_model->getCity();
			//$data['users'] = $this->Admin_model->getUsers();
			$data['records'] = $this->Admin_model->getNotifications();		
			$data['msg']= "";
			$this->load->view("superadmin/add_notification",$data);
		}
	}
	
	public function editNotification()
	{
		$id = $this->uri->segment('3');
		$this->load->model('Admin_model');
        $data['records'] = $this->Admin_model->edit_Notification($id);
		$data['countrys'] = $this->Admin_model->getCountry();
		//$data['citys'] = $this->Admin_model->getCity();
		
		/* echo "<pre>";
		print_r($data);
		echo "</pre>";
		die(); */
		$this->load->view("superadmin/edit_notification",$data);	
	}
	
	public function update_notification()
	{
		if(isset($_POST['update_notification'])){						
			
			$city= $_POST['city'];
			$country= $_POST['country'];
			$message= $_POST['n_msg'];
			//$status= $_POST['status'];			
			$n_id= $_POST['n_id'];
			
			$this->load->model('Admin_model');
			$this->Admin_model->updateNotification($n_id,$country,$city,$message);
			
			redirect("admin/add_notification","refresh");
		}
		else
		{
			echo'fail';
		}
				
	}
	
	public function deleteNotification()				//updated on 15 june 2018
	{
		//$id = $this->uri->segment('3');
		//$id= $_REQUEST['id'];
		$msgg= $_REQUEST['msg'];
		$this->load->model('Admin_model');
        $data['msg'] = $this->Admin_model->delete_Notification($msgg);
		$data['records'] = $this->Admin_model->getNotifications();
		
		//$this->load->view("superadmin/add_notification",$data,"refresh");	
		redirect("admin/add_notification","refresh");
	}
	
	public function deleteReadNotification()				//updated on 15 june 2018
	{
		//$id = $this->uri->segment('3');
		//$id= $_REQUEST['id'];
		$msgg= $_REQUEST['msg'];
		$this->load->model('Admin_model');
        $data['msg'] = $this->Admin_model->deleteRead_Notification($msgg);
		$data['records'] = $this->Admin_model->getNotifications();
		
		//$this->load->view("superadmin/add_notification",$data,"refresh");	
		redirect("admin/add_notification","refresh");
	}

	
   /*  ----------- Franchise ----------- */
	
	public function add_franchise()
	{
		if(isset($_POST['add_franchise'])){
			
			$name= $_POST['f_name'];
			$phone= $_POST['phone'];
			$email= $_POST['email'];
			$start= $_POST['s_date'];
			$end= $_POST['e_date'];
			//$status= $_POST['status'];
			
			//echo $phone;
			//die();
			//$franchise_id= random_string('alnum', 10);
			$f_id= uniqid();
			/* echo $franchise_id."<br>";
			echo $f_id;
			die(); */
			
			$query= $this->db->query("select franchise_id from franchise where franchise_id='$f_id'");
			$result= $query->result();
			if(!empty($result))
			{ 
				//$new_franchise= random_string('alnum', 10);
				$new_franchise= uniqid();
			}
			else
			{
				$new_franchise= $f_id;
			}
			
			$franchise_url= "https://play.google.com/store/apps/details?id=com.abaow&referrer=".$new_franchise;
			
			$this->load->model("Admin_model");			
			$result = $this->Admin_model->addFranchise($name,$phone,$email,$new_franchise,$franchise_url,$start,$end);
			
			$curr_id= $this->db->insert_id();
			$query1= $this->db->query("select email, franchise_url from franchise where id='$curr_id'");
			$result1= $query1->result();
			/* print_r($result1);
			die(); */
			$mail= "support@abaow.com";
			$from = "From: ".$mail."\r\nReturn-path: $mail"; 
			$to = $result1[0]->email;
			$subject = "ABAOW franchise link";
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//$headers .= 'To: '.$to."\r\n";
			
			$headers .= 'From: '.$mail."\r\n";
			
			$body = 'This is your franchise link. Please click on the below link.<br> '.$result1[0]->franchise_url;
			mail($to, $subject, $body, $headers);					   
								   
			redirect("admin/add_franchise","refresh");
			
		}
		else
		{
			echo"fail";
		}
		
		$this->load->model("Admin_model");
		$data['records'] = $this->Admin_model->getFranchise();
		/* echo "<pre>";
		print_r($data);
		echo "</pre>";
		die(); */
		//$data['msg']= "";
		$this->load->view("superadmin/add_franchise",$data);
	}		
 
	public function editFranchise()
	{
		$id = $this->uri->segment('3');
		$this->load->model('Admin_model');
        $data['records'] = $this->Admin_model->edit_Franchise($id);		
		$this->load->view("superadmin/edit_franchise",$data);	
	}
	
	public function update_franchise()						//updated 9 april & 20 april 2018
	{
		if(isset($_POST['update_franchise'])){						
			
			$id= $_POST['f_id'];
			$name= $_POST['f_name'];
			$phone= $_POST['phone'];
			$email= $_POST['email'];
			$start= $_POST['s_date'];
			$end= $_POST['e_date'];
			$status= $_POST['fr_status'];
			
			$this->load->model('Admin_model');
			$this->Admin_model->updateFranchise($id,$name,$phone,$email,$start,$end,$status);
			
			redirect("admin/add_franchise","refresh");
		}
		else
		{
			echo'fail';
		}
				
	}
	
	public function deleteFranchise()
	{
		$id= $_REQUEST['id'];
		$this->load->model('Admin_model');
        $this->Admin_model->delete_Franchise($id);
		$data['records'] = $this->Admin_model->getFranchise();		
		//$this->load->view("superadmin/add_franchise",$data);
		redirect("admin/add_franchise","refresh");
	}
	
	 /*  ----------- Ajax Coding ----------- */
	public function ajax_data()
	{
		  echo $id_country = $this->input->post('id',TRUE);
		  
		  //run the query for the cities we specified earlier  
		  $this->load->model('Admin_model');
		  $data['city']=$this->Admin_model->getCityByCountry($id_country);  
		  $output = null;  
		  foreach ($data['city'] as $row)  
		  {  
			 //here we build a dropdown item line for each  query result  
			 $output .= "<option value='".$row->id."'>".$row->city_name."</option>";  
		  }  
		  echo $output;  
	}  
   
	public function get_courses()
	{
		//$id_country = $this->input->post('id',TRUE);
		$this->load->model('Admin_model');
		$data['result']= $this->Admin_model->course_data();
		$data['countrys'] = $this->Admin_model->getCountry();
		$data['citys'] = $this->Admin_model->getCity();
		$data['languages'] = $this->Admin_model->get_languages();
		$data['franchise'] = $this->Admin_model->getFranchise();
		/* echo "<pre>";
		print_r($data);
		echo "</pre>";
		die(); */
		$this->load->view("superadmin/course_details", $data);
	}
	
	public function country_wise_view()
	{
		$id_country = $this->input->post('id',TRUE);  
		  //run the query for the cities we specified earlier  
		  $this->load->model('Admin_model');
		  $data['result']=$this->Admin_model->getDataByCountry($id_country); 
		  $count= $this->Admin_model->getCountByCountry($id_country);
		  $output = null; 
			$i=1;
		  foreach ($data['result'] as $row)  
		  {  
			
			 //here we build a dropdown item line for each  query result  
			 $output .= "<tr><td>".$i."</td>  
										<td>".$row->order_id."</td>  
										<td>".$row->course_name."</td> 
										<td>".$row->name."</td> 
										<td>".$row->language."</td> 
										<td>".$row->country_name."</td> 
										<td>".$row->city_name."</td>
										<td>".$row->order_date."</td> "; 
			$i++;
		  }  
		  echo $output;  
	}
	
	public function country_wise_count()
	{
		$id_country = $this->input->post('id',TRUE);		
		  $this->load->model('Admin_model');
		  $count= $this->Admin_model->getCountByCountry($id_country);
		  
		  $output = null;
		  $output.="<h3>Total Records: ".$count."</h3>";
		  echo $output;
	}
	public function city_wise_view()
	{
		$city_id = $this->input->post('id',TRUE);  
		  //run the query for the cities we specified earlier  
		  $this->load->model('Admin_model');
		  $data['result']=$this->Admin_model->getDataByCity($city_id);  
		  $output = null; 
			$i=1;
		  foreach ($data['result'] as $row)  
		  {  
			 //here we build a dropdown item line for each  query result  
			 $output .= "<tr><td>".$i."</td>  
										<td>".$row->order_id."</td>  
										<td>".$row->course_name."</td> 
										<td>".$row->name."</td> 
										<td>".$row->language."</td> 
										<td>".$row->country_name."</td> 
										<td>".$row->city_name."</td>
										<td>".$row->order_date."</td> "; 
			$i++;
		  }  
		  echo $output;  
	}
	public function city_wise_count()
	{
		$city_id = $this->input->post('id',TRUE);		
		  $this->load->model('Admin_model');
		  $count= $this->Admin_model->getCountByCity($city_id);
		  
		  $output = null;
		  $output.="<h3>Total Records: ".$count."</h3>";
		  echo $output;
	}
	public function language_wise_view()
	{
		$lang_id = $this->input->post('id',TRUE);  
		  //run the query for the cities we specified earlier  
		  $this->load->model('Admin_model');
		  $data['result']=$this->Admin_model->getDataByLanguage($lang_id);  
		  $output = null; 
			$i=1;
		  foreach ($data['result'] as $row)  
		  {  
			 //here we build a dropdown item line for each  query result  
			 $output .= "<tr><td>".$i."</td>  
										<td>".$row->order_id."</td>  
										<td>".$row->course_name."</td> 
										<td>".$row->name."</td> 
										<td>".$row->language."</td> 
										<td>".$row->country_name."</td> 
										<td>".$row->city_name."</td>
										<td>".$row->order_date."</td> "; 
			$i++;
		  }  
		  echo $output;
	}
	
	public function language_wise_count()
	{
		$lang_id = $this->input->post('id',TRUE);		
		  $this->load->model('Admin_model');
		  $count= $this->Admin_model->getCountByLanguage($lang_id);
		  
		  $output = null;
		  $output.="<h3>Total Records: ".$count."</h3>";
		  echo $output;
	}
	
	public function date_wise_view()
	{
		$start = $this->input->post('s_date',TRUE); 
		$end = $this->input->post('e_date',TRUE); 		
		  //run the query for the cities we specified earlier  
		  $this->load->model('Admin_model');
		  $data['result']=$this->Admin_model->getDataByDate($start, $end);  
		  $output = null; 
			$i=1;
		  foreach ($data['result'] as $row)  
		  {  
			 //here we build a dropdown item line for each  query result  
			 $output .= "<tr><td>".$i."</td>  
										<td>".$row->order_id."</td>  
										<td>".$row->course_name."</td> 
										<td>".$row->name."</td> 
										<td>".$row->language."</td> 
										<td>".$row->country_name."</td> 
										<td>".$row->city_name."</td>
										<td>".$row->order_date."</td> "; 
			$i++;
		  }  
		  echo $output;  
	}
	public function date_wise_count()
	{
		$start = $this->input->post('s_date',TRUE); 
		$end = $this->input->post('e_date',TRUE); 	
		  $this->load->model('Admin_model');
		  $count= $this->Admin_model->getCountByDate($start, $end);
		  
		  $output = null;
		  $output.="<h3>Total Records: ".$count."</h3>";
		  echo $output;
	}
	public function franchise_wise_view()
	{
		$franchise_id = $this->input->post('id',TRUE); 
			//echo $franchise_id;
		  //run the query for the cities we specified earlier  
		  $this->load->model('Admin_model');
		  $data['result']=$this->Admin_model->getDataByFranchise($franchise_id);
			/* echo "<pre>";
		print_r($data);
		echo "</pre>";
		die(); */
		  $output = null; 
			$i=1;
		  foreach ($data['result'] as $row)  
		  {  
			 //here we build a dropdown item line for each  query result  
			 $output .= "<tr><td>".$i."</td>  
										<td>".$row->order_id."</td>  
										<td>".$row->course_name."</td> 
										<td>".$row->name."</td> 
										<td>".$row->language."</td> 
										<td>".$row->country_name."</td> 
										<td>".$row->city_name."</td>
										<td>".$row->order_date."</td> "; 
			$i++;
		  }  
		  echo $output;
	}
	public function franchise_wise_count()
	{
		$franchise_id = $this->input->post('id',TRUE);		
		  $this->load->model('Admin_model');
		  $count= $this->Admin_model->getCountByFranchise($franchise_id);
		  
		  $output = null;
		  $output.="<h3>Total Records: ".$count."</h3>";
		  echo $output;
	}
	
	public function get_user()
	{
		$this->load->library('pagination');
		$this->load->model('Admin_model');
		
		$data['records'] = $this->Admin_model->getUsers_Data();
		$data['franchise'] = $this->Admin_model->getFranchise();
		$data['countrys'] = $this->Admin_model->getCountry();
		//$data['citys'] = $this->Admin_model->getCity();
		/* echo "<pre>";
		print_r($data);
		echo "</pre>";
		die();   */
		$this->load->view("superadmin/reg_user_data",$data);
	}
		
	public function country_user_data()
	{
		 $id_country = $this->input->post('id',TRUE);  
		  //run the query for the cities we specified earlier  
		  $this->load->model('Admin_model');
		  $data['country']=$this->Admin_model->getUserByCountry($id_country);  
		  $i=1;
		  $output = null;  
		  foreach ($data['country'] as $row)  
		  {  
			 //here we build a dropdown item line for each  query result  
			 $output .= "<tr> <td>".$i."</td>  
										<td>".$row->name."</td>  
										<td>".$row->mobile."</td> 
										<td>".$row->email."</td> 
										<td>".$row->city_name."</td> 
										<td>".$row->country_name."</td> 
										<td>".$row->language."</td> 
										<td>".$row->franchise_name."</td> 
										<td>".$row->created."</td> ";  
			$i++;
		  }  
		  //$output.="<a href='admin/toExcel'>Export Data</a>";
		  echo $output;  
	} 
	public function country_user_count()
	{
		$id_country = $this->input->post('id',TRUE);		
		  $this->load->model('Admin_model');
		  $count= $this->Admin_model->getUserCountByCountry($id_country);
		  
		  $output = null;
		  $output.="<h3>Total Records: ".$count."</h3>";
		  echo $output;
	}
	public function city_user_data()
	{
		 $id_city = $this->input->post('id',TRUE);  
		  //run the query for the cities we specified earlier  
		  $this->load->model('Admin_model');
		  $data['city']=$this->Admin_model->getUserByCity($id_city);  
		  $i=1;
		  $output = null;  
		  foreach ($data['city'] as $row)  
		  {  
			 //here we build a dropdown item line for each  query result  
			 $output .= "<tr> <td>".$i."</td>  
										<td>".$row->name."</td>  
										<td>".$row->mobile."</td> 
										<td>".$row->email."</td> 
										<td>".$row->city_name."</td> 
										<td>".$row->country_name."</td> 
										<td>".$row->language."</td> 
										<td>".$row->franchise_name."</td> 
										<td>".$row->created."</td> ";  
			$i++;
		  }  
		  echo $output;  
	} 
	public function city_user_count()
	{
		$id_city = $this->input->post('id',TRUE);		
		  $this->load->model('Admin_model');
		  $count= $this->Admin_model->getUserCountByCity($id_city);
		  
		  $output = null;
		  $output.="<h3>Total Records: ".$count."</h3>";
		  echo $output;
	}
	public function franchise_user_data()
	{
		  $id_franchise = $this->input->post('franchise_id',TRUE);  
		  //run the query for the cities we specified earlier  
		  $this->load->model('Admin_model');
		  $data['franchise']=$this->Admin_model->getUserByFranchise($id_franchise);  
		 /*  echo "<pre>";
		print_r($data);
		echo "</pre>";
		die(); */
		  $i=1;
		  $output = null;  
		  foreach ($data['franchise'] as $row)  
		  {  
			 //here we build a dropdown item line for each  query result  
			 $output .= "<tr> <td>".$i."</td>  
										<td>".$row->name."</td>  
										<td>".$row->mobile."</td> 
										<td>".$row->email."</td> 
										<td>".$row->city_name."</td> 
										<td>".$row->country_name."</td> 
										<td>".$row->language."</td> 
										<td>".$row->franchise_name."</td> 
										<td>".$row->created."</td> ";  
			$i++;
		  }  
		  echo $output;  
	} 
	public function franchise_user_count()
	{
		$id_franchise = $this->input->post('id',TRUE);		
		  $this->load->model('Admin_model');
		  $count= $this->Admin_model->getUserCountByFranchise($id_franchise);
		  
		  $output = null;
		  $output.="<h3>Total Records: ".$count."</h3>";
		  echo $output;
	}
	/* public function toExcel()
  {
    $data['records'] = $this->Admin_model->getUsers_Data();
	$this->load->view("superadmin/spreadsheet_view",$data);
	/* header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=exceldata.xls");
	header("Pragma: no-cache");
	header("Expires: 0"); */
 // } 
  
	public function get_franchise()
	{
		
		$this->load->model('Admin_model');
		$data['records'] = $this->Admin_model->getfranchise_Data();
		
		/* echo "<pre>";
		print_r($data);
		echo "</pre>";
		die();   */
		$this->load->view("superadmin/franchise_data",$data);
	}
	
	public function abaow_user_data()						//19 jan 2018
	{
		 $id = $this->input->post('id',TRUE);
			
		 $this->load->model('Admin_model');
		 $data['abaow']=$this->Admin_model->getUserByAbaow($id);  
		 /*  echo "<pre>";
		print_r($data);
		echo "</pre>";
		die();  */
		  $i=1;
		  $output = null;  
		  foreach ($data['abaow'] as $row)  
		  {  
			 //here we build a dropdown item line for each  query result  
			 $output .= "<tr> <td>".$i."</td>  
										<td>".$row->name."</td>  
										<td>".$row->mobile."</td> 
										<td>".$row->email."</td> 
										<td>".$row->city_name."</td> 
										<td>".$row->country_name."</td> 
										<td>".$row->language."</td> 
										<td>".$row->franchise_name."</td> 
										<td>".$row->created."</td></tr> ";  
			$i++;
		  }  
		  echo $output;  
		
	}
	
	public function abaow_user_count()							//22 jan 2018
	{
		$id = $this->input->post('id',TRUE);		
		  $this->load->model('Admin_model');
		  $count= $this->Admin_model->getCountByAbaow($id);
		  
		  $output = null;
		  $output.="<h3>Total Records: ".$count."</h3>";
		  echo $output;
	}
	
	public function abaow_course_data()						//19 jan 2018
	{
		 $id = $this->input->post('id',TRUE); 
		 
		 $this->load->model('Admin_model');
		  $data['abaow']=$this->Admin_model->getCoursesByAbaow($id);  
		   /* echo "<pre>";
		print_r($data);
		echo "</pre>";
		die(); */
		  $i=1;
		  $output = null;  
		  foreach ($data['abaow'] as $row)  
		  {  
			 //here we build a dropdown item line for each  query result  
			 $output .= "<tr><td>".$i."</td>  
										<td>".$row->order_id."</td>  
										<td>".$row->course_name."</td> 
										<td>".$row->name."</td> 
										<td>".$row->language."</td> 
										<td>".$row->country_name."</td> 
										<td>".$row->city_name."</td>
										<td>".$row->order_date."</td></tr> ";
			$i++;
		  }  
		  echo $output;  
		
	}
	
	public function abaow_course_count()							//22 jan 2018
	{
		 $id = $this->input->post('id',TRUE);		
		  $this->load->model('Admin_model');
		  $count= $this->Admin_model->getCourseCountByAbaow($id);
		  
		  $output = null;
		  $output.="<h3>Total Records: ".$count."</h3>";
		  echo $output;
	}
	
	public function course_user_count()
	{
		$this->load->model('Admin_model');
		$data['result'] = $this->Admin_model->getCourse_user_data();
/* echo "<pre>";
		print_r($data);
		echo "</pre>";
		die(); */		
		$this->load->view("superadmin/course_user_count",$data);
	}
	
	public function instructor_count()								//23 jan 2018
	{
		
		$this->load->model('Admin_model');
		$data['records'] = $this->Admin_model->getInstructor();
		$data['result'] = $this->Admin_model->getCourse_user_data();
		
		$this->load->view("superadmin/instructor_count",$data);
	} 
	
	public function ins_course_data()								//23 jan 2018
	{
		
		 $id = $this->input->post('id',TRUE);  
		 
		  //run the query for the cities we specified earlier  
		   $this->load->model('Admin_model');
		  $data['ins']=$this->Admin_model->getCourse_trainer_data($id); 

		  $i=1;
		  $output = null;  
		  foreach ($data['ins'] as $row)  
		  {  
			 $c_id= $row->course_id;
			 $cnt= $this->Admin_model->getUserCount($c_id); 
			echo $cnt;
			
			 //here we build a dropdown item line for each  query result  
			 $output .= "<tr> <td>".$i."</td>  
										<td>".$row->course_name."</td>  
										<td>".$row->language."</td> 
										<td>".$cnt."</td> 
										</tr>";  
			$i++;
		  }  
		  echo $output;   
	} 
	
	
	public function get_quiz_results()										//31 jan 2018
	{
		//$id_country = $this->input->post('id',TRUE);
		$this->load->model('Admin_model');
		//$data['result']= $this->Admin_model->course_data();
		$data['course'] = $this->Admin_model->get_course_name();
		//$data['citys'] = $this->Admin_model->getCity();
		//$data['languages'] = $this->Admin_model->get_languages();
		//$data['franchise'] = $this->Admin_model->getFranchise();
		/* echo "<pre>";
		print_r($data);
		echo "</pre>";
		die(); */
		$this->load->view("superadmin/quiz_respose", $data);
	}
	
	
	public function quiz_ajax_data()										//31 jan 2018
	{
		   $id_course = $this->input->post('id',TRUE);
		  
		  //run the query for the cities we specified earlier  
		  $this->load->model('Admin_model');
		  $data['user']=$this->Admin_model->getUserByCourse($id_course);  
			
		  $output = null;  
		  $output .= "<option>--Select User--</option>"; 
		  foreach ($data['user'] as $row)  
		  {  
			 //here we build a dropdown item line for each  query result  
			 $output .= "<option value='".$row->id."'>".$row->name."</option>";  
		  }  
		  echo $output;  
	}  
	
	public function quiz_view()											//31 jan 2018
	{
		$course_id = $this->input->post('c_id',TRUE); 
		$user_id = $this->input->post('u_id',TRUE); 
		  //run the query for the cities we specified earlier  
		  $this->load->model('Admin_model');
		  $data['result']=$this->Admin_model->getQuiz_Data($course_id,$user_id);  
		  	 
		  $output = null; 
			$i=1;
		  foreach ($data['result'] as $row)  
		  {  
			 //here we build a dropdown item line for each  query result  
			 $output .= "<tr><td>".$i."</td>  
										 <td>".$row->question."</td> 
										<td>".$row->answer."</td> 
										<td>".$row->created."</td> </tr>"; 
			$i++;
		  }  
		  echo $output;  
	}
	
	
																					//14 feb 2018
	public function date_wise_User_view()
	{
		 $start = $this->input->post('s_date',TRUE); 
	    	$end = $this->input->post('e_date',TRUE); 		
		  //run the query for the cities we specified earlier  
		  $this->load->model('Admin_model');
		  $data['result']=$this->Admin_model->getUserByDate($start, $end);  
		 /*  print_r($data);
		  die();  */
		  $output = null; 
			$i=1;
		  foreach ($data['result'] as $row)  
		  {  
			 //here we build a dropdown item line for each  query result  
			$output .= "<tr> <td>".$i."</td>  
										<td>".$row->name."</td>  
										<td>".$row->mobile."</td> 
										<td>".$row->email."</td> 
										<td>".$row->city_name."</td> 
										<td>".$row->country_name."</td> 
										<td>".$row->language."</td> 
										<td>".$row->franchise_name."</td> 
										<td>".$row->created."</td></tr> ";  
			$i++;
		  }  
		  echo $output;  
	}
	
	public function date_wise_User_count()
	{
		$start = $this->input->post('s_date',TRUE); 
		$end = $this->input->post('e_date',TRUE); 	
		  $this->load->model('Admin_model');
		  $count= $this->Admin_model->getUserCountByDate($start, $end);
		  
		  $output = null;
		  $output.="<h3>Total Records: ".$count."</h3>";
		  echo $output;
	}
	
	/*  ----------- Blog Coding ----------- */								//20 march 2018
	
	public function add_blog()										//updated 4 april 2018	
	{
		if(isset($_POST['add_blog']))
		{
			$title=$_POST['blog_title'];
			$lang=$_POST['blog_lang'];
			$content=$_POST['blog_content'];
			
			if($_FILES['blog_img']['tmp_name']!="")
					{
				
						$file_name = $_FILES['blog_img']['name'];			 
						$file_tmp =$_FILES['blog_img']['tmp_name'];
				  		$dest1= "./uploads/images/".$file_name;
						$img="uploads/images/".$file_name;
						$img_url=base_url().$img;
						move_uploaded_file($file_tmp, $dest1);
			    	}
					else
					{
						$img_url="NULL";
					}
			
			$this->load->model("Admin_model");
			$this->Admin_model->add_blog_data($title,$lang,$img_url,$content);
			//die();
			redirect("admin/add_blog","refresh");
			
		}
		else
		{
			$this->load->model("Admin_model");	
			$data['lang'] = $this->Admin_model->getlang();
			$data['blog'] = $this->Admin_model->getBlogs();
			$this->load->view("superadmin/add_blog",$data);
		}
	}
	
	public function edit_blog()
	{
		$id = $this->uri->segment('3');
		$this->load->model('Admin_model');
	
        $data['records1'] = $this->Admin_model->edit_blog($id);
		/*  echo "<pre>";
		print_r($data);
		echo "</pre>";
		die(); */
		
		$data['lang'] = $this->Admin_model->get_languages();
		 
		$this->load->view("superadmin/edit_blog",$data);
	}
	
	public function update_blog()
	{
		if(isset($_POST['update_blog']))
		{
			$id= $_POST['blog_id'];
			$title=$_POST['blog_title'];
			$lang=$_POST['blog_lang'];
			$content=$_POST['blog_content'];
			
			if($_FILES['blog_img']['tmp_name']!="")
					{
				
						$file_name = $_FILES['blog_img']['name'];			 
						$file_tmp =$_FILES['blog_img']['tmp_name'];
				  		$dest1= "./uploads/images/".$file_name;
						$img="uploads/images/".$file_name;
						$img_url=base_url().$img;
						move_uploaded_file($file_tmp, $dest1);
			    	}
					
					else
					{
						$img_url=$_POST['blog_img'];
					}
			
			$this->load->model("Admin_model");
			$this->Admin_model->update_blog_data($id,$title,$lang,$img_url,$content);
			redirect("admin/add_blog","refresh");
		}
	}
	
	public function delete_blog()
	{
		
		$id= $_REQUEST['id'];
		$this->load->model('Admin_model');
		$data['records'] = $this->Admin_model->delete_blogdata($id);
		redirect("admin/add_blog","refresh");
	}
	
	public function privacy_policy()						//19_April_2018
	{
		$this->load->view("superadmin/privacy_policy");
	}
	
	public function franchise_status()											//9 april 2018 and 20 april 2018
	{
		$id=$_REQUEST['id'];
		$this->load->model('Admin_model');
		$this->Admin_model->update_franchise_status($id);
		redirect("admin/add_franchise","refresh");
	}
	
	/*-----------add video url------------*/									//28 april 2018
	
	public function add_video()
	{
		
		if(isset($_POST['add_url']))
		{
			
			$url= $_POST['url'];	
			$this->load->model("Admin_model");			
			$result = $this->Admin_model->addURL($url);
			redirect("admin/add_video","refresh");
			
		}
		else
		{
			$this->load->model("Admin_model");	
			$data['url'] = $this->Admin_model->get_url();
			$this->load->view("superadmin/video_url",$data);
		}
	}
	
	public function editVideo()
	{
		$id = $this->uri->segment('3');
		$this->load->model('Admin_model');
        $data['records'] = $this->Admin_model->edit_video_url($id);
		$this->load->view("superadmin/edit_video_url",$data);	
	}
	
	public function update_url()
	{
		if(isset($_POST['update_url'])){						
			
			$url= $_POST['url'];
			$id= $_POST['video_id'];			
			
			$this->load->model('Admin_model');
			$this->Admin_model->updateUrl($id,$url);
			
			redirect("admin/add_video","refresh");
		}
		else
		{
			echo'fail';
		}
				
	}
	public function deleteurl()
	{
		
		$id= $_REQUEST['id'];
		$this->load->model('Admin_model');
		$this->Admin_model->delete_Url($id);
		redirect("admin/add_video","refresh");
		
		
	}	

	
}
