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
									<h3><strong>Update Notification</strong></h3>
									
								</div>
									
								<form name="myform" id="myform" action="<?php echo base_url()?>admin/update_notification" method="post">
										<div class="form-group">
											
											<div class="form-control-wrapper">		
												<label for="title">Select Country:</label>
												<?php	foreach ($records as $row) {   
													//print_r($row);
													//echo "<br>";
												?>
												<select name="country" id="country" class="form-control" style="width:90%">
													<!--<option value="<?php //echo $row->country; ?>"><?php //echo $row->country_name; ?></option>-->
													<?php
														foreach ($countrys as $value) {
															echo "<option value='".$value->id."'>".$value->country_name."</option>";
														}
													?>
												</select>
											</div><br>
											
											<div class="form-control-wrapper">		
												<label for="title">Select City:</label>
												<select name="city" id="city" class="form-control" style="width:90%">
													<option value="">--- Select City ---</option>
													<?php
														/* foreach ($citys as $value1) {
															echo "<option value='".$value1->id."'>".$value1->city_name."</option>";
														} */
													?>
												</select>
											</div><br>
											<div class="form-control-wrapper">		
												<label for="title">Notification Message:</label>
												<input type="hidden" value="<?php echo $row->id;?>" name="n_id">
												<input type="text" class="form-control" name="n_msg" id="n_msg" style="width:90%" value="<?php echo $row->message; ?>" required>
												<p id="error-message" style="color:red;"></p>
											</div>
											
										</div>
												<?php } ?>
										<div class="form-group">
											<button type="submit" id="submit" name="update_notification" class="btn">Update</button>
										</div>
								</form>
							</div>
						</div>						
					</div>
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	


	
	
	<?php include 'master/footer.php'; ?>
	<!--.footer anre -content-->
	
	<script type="text/javascript">
		 $(document).ready(function() {  
                     $("#country").change(function(){  
                     /*dropdown post *///  
                     $.ajax({  
                        url:"<?php echo base_url();?>admin/ajax_data",  
                        data: {id:  
                           $(this).val()},  
                        type: "POST",  
                        success:function(data){  
                        $("#city").html(data);  
                     }  
                  });  
               });  
            }); 
		
	</script>
	

<script src="<?php echo base_url()?>assets/js/app.js"></script>
</body>
</html>