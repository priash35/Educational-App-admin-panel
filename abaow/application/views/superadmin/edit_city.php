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
									<h3><strong>Update City</strong></h3>
									
								</div>
									
								<form name="myform" id="myform" action="<?php echo base_url()?>admin/update_city" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<div class="form-control-wrapper">	
												<?php foreach ($city_records as $row1){?> 
												<label for="title">Select Country:</label>
												<select name="country_id" id="country_id" class="form-control" style="width:70%"	>
													<option value="<?php echo $row1->country_id; ?>"><?php echo $row1->country_name; ?></option>
													<?php
														foreach ($countrys as $value) {
															if($row1->country_name!=$value->country_name)
															{
															echo "<option value='".$value->id."'>".$value->country_name."</option>";
															}
														}
													?>
												</select>
											</div><br>
											<div class="form-control-wrapper">		
												<label for="title">Name of City:</label>
												<input type="hidden" value="<?php echo $row1->id;?>" name="c_id">
												<input type="text" class="form-control" name="city" id="<?php echo $row1->id;?>" style="width:90%" value="<?php echo $row1->city_name;?>" required>
											</div><br>	
												<?php } ?>
										</div>
										<div class="form-group">
											<button type="submit" id="submit" name="update_city" class="btn">Save</button>
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
		 
		
	</script>
	

<script src="<?php echo base_url()?>assets/js/app.js"></script>
</body>
</html>