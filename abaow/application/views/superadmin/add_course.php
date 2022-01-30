<?php include 'master/header.php'; ?>

	<div class="page-content">
		<div class="container-fluid">	
			<section class="card">
				<div class="card-block">
					<div class="row">
					
					</div><!--.row-->

					<div class="row m-t-lg">
						<div class="col-md-6">
						<div class="tbl-cell">
							<h3>Add Course</h3>
							        

							<!--<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">StartUI</a></li>
								<li><a href="#">Forms</a></li>
								<li class="active">jQuery Form Validation</li>
							</ol>-->
						</div>
							
							<form name="myform" id="myform" action="<?php echo base_url()?>admin/add_coursedata" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label class="form-label" for="signup_v1-username">Course Name:</label>
									<div class="form-control-wrapper">
										<input type="text" class="form-control" name="course_name" placeholder="Enter course name" required>
									</div><br>
									
									<label class="form-label" for="signup_v1-username">Instructor Name:</label>
									<div class="form-control-wrapper">
										<select name="ins_name" id="page_ele" class="form-control" style="width:70%"	required>
													<!--<option value="">--- Select Page ---</option>-->
													<?php
														foreach ($records as $value) 
														{
															echo "<option value='".$value->id."'>".$value->name."</option>";
														}
													?>
												</select>
												
												
										<!--<input type="text" class="form-control" name="page_name" placeholder="Enter Instructor name" required>-->
									</div><br>
									
									<label class="form-label" for="signup_v1-username">Course Description:</label>
									<div class="form-control-wrapper">
										<!--<input type="text" class="form-control" name="page_name" placeholder="Enter course name" required>-->
										<textarea style="width:90%;"  type="text" id ="course_desc" name="course_desc" placeholder="  Enter course Desciption"></textarea>
									</div><br>
									
									<label class="form-label" for="signup_v1-username">Introduction Audio:</label>
									<div class="form-control-wrapper">
										<input type="file" class="form-control" name="intro_audio" required>
									</div><br>
									
									<label class="form-label" for="signup_v1-username">Image:</label>
									<div class="form-control-wrapper">
										<input type="file" class="form-control" name="course_image" required>
									</div><br>
									
									<label class="form-label" for="signup_v1-username">Course Language:</label>
									<div class="form-control-wrapper">
										<!--<input type="text" class="form-control" name="course_lang" placeholder="Enter course Duration" required>-->
										
									<select name="course_lang" id="page_ele" class="form-control" style="width:70%"	required>
													<?php
														foreach ($lang->result() as $value1) 
														{
															echo "<option value='".$value1->id."'>".$value1->language."</option>";
														}
													?>
												</select>
									</div><br>
									
									<label class="form-label" for="signup_v1-username">Course Fee:</label>
									<div class="form-control-wrapper">
										<input type="text" class="form-control" name="course_fee" placeholder="Enter course Fee" required>
									</div><br>
									
									<label class="form-label" for="signup_v1-username">Course Duration(in minutes):</label>
									<div class="form-control-wrapper">
										<input type="text" class="form-control" name="course_dur" placeholder="Enter course Duration" required>
									</div><br>
									
									
								</div>
								<div class="form-group">
									<button type="submit" name="add_course" class="btn">Save</button>
								</div>
							</form>
							
							<!--<form name="myform" id="myform" action="<//?php echo base_url()?>Page/test" method="post">
								<div class="form-group">
									<label class="form-label" for="signup_v1-username">Username</label>
									<div class="form-control-wrapper">
										<span id="bn-success"><//?php //echo validation_errors(); ?></span>
										<input type="text" class="form-control" name="page_name">
									</div>
								</div>
								<div class="form-group">
									<button type="submit" name="register" class="btn">Add Page</button>
								</div>
							</form>-->
							<!--<div class="form-group">
								
									<label class="form-label" for="signup_v1-username">Username</label>
									<div class="form-control-wrapper">
										<input type="text" class="form-control"  id="fullname" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<button type="submit" name="register" value="hello" id="btnhello" class="success btn btn-success">Add Page</button>
									<span id="bn-success"></span>
									  

								</div>-->
							
							
						</div>
						
						<div class="col-md-6">
								
			
							<table id="table-edit" class="table table-bordered table-hover">
									<thead>
									<tr>
										<th width="1">
											#
										</th>
										
										<th>Course Name</th>
										<th colspan="3">Action</th>
										<th>Status</th>
									</tr>
									</thead>
									<tbody>
										<tr><?php 
									$i=1;	
									foreach ($courses->result() as $row)  
									 {  
										?><tr>  
										<td><?php //echo $row->id; 
										echo $i;?></td>  
										<td><?php echo $row->course_name;?></td>  
										<td><a  href="<?php echo base_url().'admin/edit_course/'.$row->id;?>">Edit</a></td>
										<!--<td><a  href="<?php //echo base_url().'admin/delete_course/'.$row->id;?>">Delete</a></td>-->
										<td><a  href="#" onclick="delete_ins(<?php echo $row->id; ?>)">Delete</a></td>
										<td><a  href="<?php echo base_url().'admin/select_module/'.$row->id;?>">Add Module</a></td>
										<td><button type="submit" name="course_status" id="c_status" class="btn" onclick="course_status(<?php echo $row->id;?>)">Publish</button></td>
									 <?php 
									 $i++;
									 }  
									 
									 ?>  
											
											</tr>  
										
									</tbody>
								</table>
						</div>
						
					</div><!--.row-->
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	

	<?php include 'master/footer.php'; ?>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js"></script>
	<script src="<?php echo base_url()?>assets/js/lib/bootstrap-notify/bootstrap-notify.min.js"></script>
	<script src="<?php echo base_url()?>assets/js/lib/bootstrap-notify/bootstrap-notify-init.js"></script>
	<!--.footer anre -content-->
	<script type="text/javascript">
	
	function delete_ins(ins_id)
		{	
			//alert('in javascript');
			if(ins_id!="")
			{
				var conf= confirm("Are you sure you want to delete?");
				
				if(conf)
				{
					window.location.href= "<?php echo site_url('admin/delete_course');?>?id="+ins_id;;
					
				}
			}
		}
		
	 function course_status(c_id)
		{	
			//alert('in javascript');
			if(c_id!="")
			{
				var conf= confirm("Do you want to publish this course?");
				
				if(conf)
				{
					window.location.href= "<?php echo site_url('admin/course_status');?>?id="+c_id;;
					
				}
			}
			
		}  
		
	</script>
	<script>
		$(function() {
			/* ==========================================================================
			 Validation
			 ========================================================================== */

			$('#btnhello').validate({
				submit: {
					settings: {
						inputContainer: '.form-group'
					}
				}
			});

			$('#form-signin_v2').validate({
				submit: {
					settings: {
						inputContainer: '.form-group',
						errorListClass: 'form-error-text-block',
						display: 'block',
						insertion: 'prepend'
					}
				}
			});

			$('#btnhello').validate({
				submit: {
					settings: {
						inputContainer: '.form-group',
						errorListClass: 'form-tooltip-error'
					}
				}
			});

			$('#form-signup_v2').validate({
				submit: {
					settings: {
						inputContainer: '.form-group',
						errorListClass: 'form-tooltip-error'
					}
				}
			});
		});
	</script>

<script src="<?php echo base_url()?>assets/js/app.js"></script>
</body>
</html>