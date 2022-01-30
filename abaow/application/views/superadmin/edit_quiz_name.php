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
									<h3><strong>Update Quiz</strong></h3>
									
								</div>
									
								<form name="myform" id="myform" action="<?php echo base_url()?>admin/update_quiz" method="post">
										<div class="form-group">	
												<div class="form-control-wrapper">
												<?php foreach ($records->result() as $row){?> 
												<label for="title">Enter Quiz Id:</label>
												<input type="hidden" value="<?php echo $row->id;?>" name="q_id">
												<input type="text" class="form-control" name="quiz_id" id="quiz_id" style="width:90%" value="<?php echo $row->quiz_id;?>" required>
												</div><br>
												
												<div class="form-control-wrapper">
												<label for="title">Enter Quiz Name:</label>
												<input type="text" class="form-control" name="quiz_name" id="quiz_name" style="width:90%" value="<?php echo $row->quiz_name;?>" required>
											</div><?php } ?><br>											
										</div>
										<div class="form-group">
											<button type="submit" id="submit" name="update_quiz" class="btn">Update</button>
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