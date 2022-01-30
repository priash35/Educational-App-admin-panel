<?php include 'master/header.php'; ?>

	<div class="page-content">
		<div class="container-fluid">	
			<section class="card">
				<div class="card-block">
					

					<div class="row m-t-lg">
						<div class="col-md-6">
						<div class="tbl-cell">
							<h3>Edit Module</h3>
							        

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
							<form name="myform" id="myform" action="<?php echo base_url()?>admin/update_quizmodule" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<div class="form-control-wrapper">
									
										<!--<label class="form-label">Enter New Page Name : </label>-->
										<?php foreach ($records1 as $row){?> 
										
										<input type="hidden" class="form-control"  name="module_id" value="<?php echo $row->id;?>">
										<input type="hidden" class="form-control"  name="course_id" value="<?php echo $row->course_id;?>">
										
										<!--<label class="form-label" for="signup_v1-username">Course Id:</label>
										<div class="form-control-wrapper">
												
											<input type="text" class="form-control" name="course_id" Value="<?php //$row->id; ?>"  readonly>
												
										</div><br>-->
										
										<label class="form-label" for="signup_v1-username">Module Name:</label>
										<div class="form-control-wrapper">
											<input type="text" class="form-control" name="module_name" value="<?php echo $row->module_name;?>" required>
										</div><br>
										
										<label class="form-label" for="signup_v1-username">Select Quiz:</label>
												<div class="form-control-wrapper">
																				
													<select name="module_quiz" id="quiz" class="form-control" style="width:70%"	required>
													<option value="<?php echo $row->module_quiz; ?>"><?php echo $row->quiz_name; ?></option>											
													<?php
														
														 foreach ($quizdata as $quizvalue) 
														 if($row->quiz_name!=$quizvalue->quiz_name)
														{
															echo "<option value='".$quizvalue->quiz_id."'>".$quizvalue->quiz_name."</option>";
														} 
													?>
													
													</select>
												</div><br>
										
									<label class="form-label" for="signup_v1-username">Module Description:</label>
												<div class="form-control-wrapper">
													<textarea style="width:90%;"  type="text" id ="module_desc" name="module_desc" ><?php echo $row->module_desc;?></textarea>
												</div><br>
												
																								
												<label class="form-label" for="signup_v1-username">Module After:</label>
												<div class="form-control-wrapper">
																				
													<select name="module_after" id="module_after" class="form-control" style="width:70%"	required>
													
											
													
													<?php
													$val=0;
													$res=$row->course_id;
													$r_id=$row->id;
													$sql="select module_name,id , module_after from course_curriculum where course_id=$res";
													$query= $this->db->query($sql);
													$mod=$query->result();
													//print_r($mod);
													//echo	$selected = $mod[0]->module_after;
													$sql2="select * from course_curriculum where id=$r_id";
													$query2= $this->db->query($sql2);
													$mod2=$query2->result();
													//print_r($mod2);
													echo $module=$mod2[0]->module_after;
												
												if($module !=0)
												{
													$sql1="select id,module_name from course_curriculum where id=$module";
															$query1= $this->db->query($sql1);
															$res1=$query1->result();
															print_r($res1);
															echo "<option value='".$res1[0]->id."' >".$res1[0]->module_name."</option>";
												
												
														  foreach ($mod as $value) 
														{
														//	echo $value->id;
															//$value->module_after;
															//$selected = $value->module_after;
															//$sql1="select id,module_name from course_curriculum where id=$selected";
															//$query1= $this->db->query($sql1);
															//$res1=$query1->result();
															//print_r($res1);
															//echo "<option value='".$res1[0]->id."' >".$res1[0]->module_name."</option>";
															/* foreach($res1 as $row1)
															{
																echo "<option value='".$row1->id."' >".$row1->module_name."</option>";
															} */
															
															if($res1[0]->module_name!=$value->module_name)
														{
															echo "<option value='".$value->id."' >".$value->module_name."</option>";
															
														} 
															
															//echo "<option value='".$value->id."' >".$value->module_name."</option>";
														} 
														echo "<option value='".$val."' >No Module</option>";
												}
												else
												{
													echo "<option value='".$val."' >No Module</option>";
													foreach ($mod as $value) 
														{
															echo "<option value='".$value->id."' >".$value->module_name."</option>";
														}	
												}
													?>
													
													</select>
												</div><br>
										<?php } ?>
												<div class="form-group">
													<button type="submit" name="add_quizmodule" class="btn">Save</button>
												</div>	
									
									</div>
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