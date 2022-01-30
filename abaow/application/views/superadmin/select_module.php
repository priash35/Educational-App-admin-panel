<?php include 'master/header.php'; ?>

	<div class="page-content">
		<div class="container-fluid">
		
			<section class="card">
				<div class="card-block">					
					<div class="row m-t-lg">
						<div class="col-md-6">
						<!-- Add element section -->
							<div class="section-style">
								<div class="tbl-cell">
									<h3>Add Course Module</h3>
									<p>Select which module you want to add:</p>
								</div>
									
								<form name="myform" id="myform" action="<?php echo base_url()?>admin/select_module" method="post">
										<div class="form-group">
											<div class="form-control-wrapper">
													  <input type = "radio" name = "module" value = "Audio"  />Audio <br>
													  <input type = "radio" name = "module" value = "Quiz" required />Quiz
												
											</div><br>
											
										
															<?php
																foreach ($course_id as $value1) 
																{
																	?>

													<input type="hidden" class="form-control" name="course_id" value=" <?php echo $value1->id; ?>" >
															<?php	} 	?>
															
											
										</div>
										<div class="form-group">
											<button type="submit" name="next" class="btn">Next</button>
										</div>
								</form>
							</div>
						</div>
						
						<div class="col-md-6">
								
			
							<table id="table-edit" class="table table-bordered table-hover">
									<thead>
									<tr>
										<th width="1">
											#
										</th>
										
										<th>Module Name</th>
										<th colspan="2">Action</th>
									</tr>
									</thead>
									<tbody>
										<tr><?php  
										$i=1;
									foreach ($module as $row)  
									 {  
										?><tr>  
										<td><?php //echo $row->id;
										echo $i;?></td>  
										<td><?php echo $row->module_name;?></td>  
																			
										<td><a  href="<?php echo base_url().'admin/edit_audiomodule/'.$row->id;?>">Edit</a></td>
										<td><a  href="#" onclick="delete_quiz(<?php echo $row->id; ?>,<?php echo $row->course_id; ?>)">Delete</a></td>
										
									 <?php 
									 $i++;
									 }  
									 ?>  
										</tr>  
										
									</tbody>
								</table>
								<br>
							<!--	<table id="table-edit" class="table table-bordered table-hover">
									<thead>
									<tr>
										<th width="1">
											#
										</th>
										
										<th>Module Name(Quiz)</th>
										<th colspan="2">Action</th>
									</tr>
									</thead>
									<tbody>
										<tr><?php  
										/* $i=1;
									foreach ($quizmodule as $row1)  
									 {   */
										?><tr>  
										<td><?php //echo $row1->id;
										//echo $i;?></td>  
										<td><?php //echo $row1->module_name;?></td>  
										<td><a  href="<?php// echo base_url().'admin/edit_quizmodule/'.$row1->id;?>">Edit</a></td>
										<td><a  href="#" onclick="delete_quiz(<?php //echo $row1->id; ?>,<?php //echo $row1->course_id; ?>)">Delete</a></td>
										
									 <?php 
									 /* $i++;
									 }   */
									 ?>  
										</tr>  
										
									</tbody>
								</table>-->
								
								
								
						</div>
						
					</div>
				</div>
			</section>				
							
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	

	
	<?php include 'master/footer.php'; ?>
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
					window.location.href= "<?php echo site_url('admin/delete_audiomodule');?>?id="+ins_id;;
					
				}
			}
		}
	function delete_quiz(q_id,c_id)
		{	
			//alert('in javascript');
			if(q_id!="")
			{
				var conf= confirm("Are you sure you want to delete?");
				
				if(conf)
				{
					window.location.href= "<?php echo site_url('admin/delete_quizmodule');?>?id=" +q_id + "&c_id=" + c_id;
					
				}
			}
		}
	
	
	
	</script>
	<script>
		//$(function() {
			/* ==========================================================================
			 Validation
			 ========================================================================== */

			/* $('#btnhello').validate({
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
		}); */
	</script>

<script src="<?php echo base_url()?>assets/js/app.js"></script>
</body>
</html>