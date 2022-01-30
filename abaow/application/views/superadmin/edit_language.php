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
									<h3><strong>Update Language</strong></h3>
									
								</div>
									
								<form name="myform" id="myform" action="<?php echo base_url()?>admin/update_language" method="post">
										<div class="form-group">
											<div class="form-control-wrapper">
												<?php foreach ($records->result() as $row){?> 
												<label for="title">Language Name:</label>
												<input type="hidden" value="<?php echo $row->id;?>" name="l_id">
												<input type="text" class="form-control" name="language" id="<?php echo $row->id;?>" style="width:90%" value="<?php echo $row->language;?>" required>												
												<?php } ?>
											</div><br>											
										</div>
										<div class="form-group">
											<button type="submit" id="submit" name="update_language" class="btn">Save Update</button>
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