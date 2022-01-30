<?php include 'master/header.php'; ?>

	<div class="page-content">
		<div class="container-fluid">	
			<section class="card">
				<div class="card-block">
					

					<div class="row m-t-lg">
						<div class="col-md-6">
						<div class="tbl-cell">
							<h3>Edit Course</h3>
							        

							<!--<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">StartUI</a></li>
								<li><a href="#">Forms</a></li>
								<li class="active">jQuery Form Validation</li>
							</ol>-->
						</div>
						
							<!--<form name="myform" id="myform" action="/Page/register" method="post">
								<div class="form-group">
								
									<label class="form-label" for="signup_v1-username">Username</label>
									<div class="form-control-wrapper">
										<input type="text" class="form-control" name="page_name" required>
									</div>
								</div>
								<div class="form-group">
									<button type="submit" name="register" class="btn">Add Page</button>
								</div>
							</form>-->
							<form name="myform" id="myform" action="<?php echo base_url()?>admin/update_course" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<div class="form-control-wrapper">
									
										<!--<label class="form-label">Enter New Page Name : </label>-->
										<?php foreach ($records1 as $row){?> 
										<input type="hidden" class="form-control"  name="course_id" value="<?php echo $row->id;?>">
										<label class="form-label" for="signup_v1-username">Course Name:</label>
										
										<input type="text" class="form-control"  name="course_name" value="<?php echo $row->course_name;?>" required>
										
										<label class="form-label" for="signup_v1-username">Instructor Name:</label>
										<div class="form-control-wrapper">
										<select name="ins_name" id="page_ele" class="form-control" style="width:70%"	required>
										
													<option value="<?php echo $row->instructor; ?>"><?php echo $row->name; ?></option>
													 <?php
														 foreach ($ins->result() as $value) 
														{
															if($row->name!=$value->name)
															{
																echo "<option value='".$value->id."'>".$value->name."</option>";
															}
														} 
													?>	 
										
										</select>
										</div><br>
										
									<label class="form-label" for="signup_v1-username">Course Description:</label>
									<div class="form-control-wrapper">
										<!--<input type="text" class="form-control" name="page_name" placeholder="Enter course name" required>-->
										<textarea style="width:90%;"  type="text" id ="course_desc" name="course_desc" ><?php echo $row->course_description;?></textarea>
									</div><br>
										
									<label class="form-label" for="signup_v1-username">Introduction Audio:</label>
									<div class="form-control-wrapper">
										<input type="file" class="form-control" name="intro_audio">
										<input type="hidden" class="form-control" name="intro_aud" value="<?php echo $row->intro_audio;?>">
										<audio controls>
													 <source src="<?php echo $row->intro_audio;?>" type="audio/mpeg">
											</audio>
													<?php $audio= $row->intro_audio;
															//echo $audio; 
															$link= explode("/", $audio);
															$link_value= end($link);?>
												<label class="form-label" for="signup_v1-username"><?php echo $link_value;?></label>
												</div><br>	
									
									
									<div class="form-control-wrapper">
										<label for="title">Image:</label>
										<input type="file" class="form-control" name="course_image" style="width:90%">
										<input type="hidden" name="course_img" value="<?php echo $row->course_image;?>" /> <br>
										<img src="<?php echo $row->course_image;?>" style="width:200px; height:150px;"/>
									</div><br>	
										
																	
									<!--<label class="form-label" for="signup_v1-username">Course Language:</label>
									<div class="form-control-wrapper">
										<input type="text" class="form-control" name="course_lang" value="<?php //echo $row->language;?>" required>
									</div><br>-->
									
									<label class="form-label" for="signup_v1-username">Course Language:</label>
									<div class="form-control-wrapper">
										<!--<input type="text" class="form-control" name="course_lang" placeholder="Enter course Duration" required>-->
										
									<select name="course_lang" id="page_ele" class="form-control" style="width:70%"	required>
									<option value="<?php echo $row->language; ?>"><?php echo $row->language_name; ?></option>
													<?php
														foreach ($lang as $value1) 
														{
															if($row->language_name!=$value1->language)
															{
																echo "<option value='".$value1->id."'>".$value1->language."</option>";
															}
														} 
													?>
									</select>
									</div><br>
									
									<label class="form-label" for="signup_v1-username">Fee:</label>
									<div class="form-control-wrapper">
										<input type="text" class="form-control" name="course_fee" value="<?php echo $row->fee;?>" >
									</div><br>
									
									<label class="form-label" for="signup_v1-username">Course Duration(in minutes):</label>
									<div class="form-control-wrapper">
										<input type="text" class="form-control" name="course_dur" value="<?php echo $row->duration;?>" required>
									</div><br>
									
										<?php }  
									 ?> 
									</div>
									
									<!--<label class="form-label" for="signup_v1-username">Add Element</label>
									<div class="form-control-wrapper">
										<input type="text" class="form-control" name="element_name" required>
									</div>-->
								</div>
								<div class="form-group">
									<button type="submit" name="update_course" class="btn">Update Course</button>
								</div>
							</form>
						</div>
						
					
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	


	
	
	<?php include 'master/footer.php'; ?>
	<!--.footer anre -content-->
	
	<script type="text/javascript">
		 $(document).ready(function(){
			$('#btnhello').click(function(){
				var fullname = $('#fullname').val();
				if(fullname ==''){
					//alert('#bn-success');
					$('#bn-danger').html('This field is required');

				}
				else{
					$.ajax({
					type:'POST',
					data:{fullname: fullname},
					url:'<?php echo site_url('page/hello');?>',
					success: function(result){
						$('#bn-success').html(result);
					}
				});
				}
				
			});
		}); 
		
		
		$(document).on('click','.status_checks',function()
		 { 
		var status = ($(this).hasClass("btn-success")) ? '0' : '1'; 
		var msg = (status=='0')? 'Deactivate' : 'Activate'; 
		if(confirm("Are you sure to "+ msg))
		{ 
			var current_element = $(this); 
			var id = $(current_element).attr('data');
			url = "<?php echo base_url().'page/update_status'?>"; 
				$.ajax({
				  type:"POST",
				  url: url, 
				  data: {"id":id,"status":status}, 
				  success: function(data) { 
				  location.reload();
			} });
		 }  
		 });
		
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