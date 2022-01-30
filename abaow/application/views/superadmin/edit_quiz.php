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
									<h3><strong>Update Question</strong></h3>
									
								</div>
									
								<form name="myform" id="myform" action="<?php echo base_url()?>admin/update_question" method="post">
										<div class="form-group">
											<?php
														//foreach ($records as $value) { ?>
															
													<!--<input type="hidden" value="<?php //echo $value->quiz_id;?>" name="q_id">-->
												<?php		//}
													?>
											
											<div class="form-control-wrapper">
												<label for="title">After which question you want to insert new question:</label>
												<?php  foreach ($records as $row){ ?> 
												<select name="que_id" id="que_id" class="form-control" style="width:70%">
													<?php if(!empty($records1)){  
													echo "<option value='".$records1['old_order']."'>".$records1['old_question']."</option>";
													}
													else 
													{
													echo "<option value='".$row['order']."'>There is no Question Before.</option>";										
													} ?>
													 <?php
														foreach ($questions as $value) { 
															if($records1['old_question']!=$value->question)
															{
															echo "<option value='".$value->order."'>".$value->question."</option>";
															}
														}
													?>
												</select>
											</div><br>
											
											<div class="form-control-wrapper">
												<label for="title">Enter Question:</label>
												<input type="hidden" value="<?php echo $row['quiz_id'];?>" name="q_id">
												<input type="hidden" value="<?php echo $row['id'];?>" name="id">
												<input type="text" class="form-control" name="que_name" id="que_name" style="width:90%" value="<?php echo $row['question']; ?>" required>
											</div><br>											
																					
											<div class="form-control-wrapper">
												<label for="title">Question Type</label>
												<select name="que_type" id="que_type" class="form-control" style="width:70%">
													<option value="<?php echo $row['question_type']; ?>"><?php echo $row['question_type']; ?></option>
													<?php
													if($row['question_type']=="TEXT")
													{
														echo "<option value='MCQ'>MCQ</option>";
													}
													else
													{
														echo "<option value='TEXT'>TEXT</option>";
													}
													?>
												</select>
											</div><br>
											<?php } ?>	
											<!--<a href="javascript:void(0);" class="add_button" title="Add field">  <button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> Add New Question
											</button><img  src="add-icon.png"/></a>-->
											
										</div>
										
										<div class="form-group">
											<button type="submit" name="update_question" class="btn">Save</button>
										</div>
										
										
								</form>
							</div>
						</div>
						
						
						
					</div>
				</div>
			</section><!-- Add meta key section -->			
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	

	
	<?php include 'master/footer.php'; ?>
	<!--.footer anre -content-->
	<script type="text/javascript">

	
</script>
	

<script src="<?php echo base_url()?>assets/js/app.js"></script>
</body>
</html>