<?php include 'master/header.php'; ?>

	<div class="page-content">
		<div class="container-fluid">	
			<section class="card">
				<div class="card-block">
					

					<div class="row m-t-lg">
						<div class="col-md-6">
						<div class="tbl-cell">
							<h3>Update Instructor</h3>
							        

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
							<form name="myform" id="myform" action="<?php echo base_url()?>admin/update_ins_name" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<div class="form-control-wrapper">
									
										
										<div class="form-control-wrapper">
													<!--<select name="hours" onchange="this.form.submit()">-->
												<label for="title">Name of Instructor:</label>
												<?php foreach ($records->result() as $row){?> 
												<input type="hidden" value="<?php echo $row->id;?>" name="page_id">
												<input type="text" class="form-control" name="ins_name" id="<?php echo $row->id;?>" style="width:90%" value="<?php echo $row->name;?>" required>
												
											</div><br>
											<div class="form-control-wrapper">
												<label for="title">Photo:</label>
												<input type="file" class="form-control" name="add_photo" style="width:90%">
												<input type="hidden" name="ins_image" value="<?php echo $row->image;?>" /><br>
												<img src="<?php echo $row->image;?>" style="width:200px; height:150px;"/>
											</div><br>
											
											<div class="form-control-wrapper">
												<label for="title">Profile:</label>
												<textarea style="width:90%;"  type="text" id ="ins_desc" name="ins_desc"><?php echo $row->profile;?></textarea>
											</div>
										<?php }  
									 ?> 
									</div>
									
									<!--<label class="form-label" for="signup_v1-username">Add Element</label>
									<div class="form-control-wrapper">
										<input type="text" class="form-control" name="element_name" required>
									</div>-->
								</div>
								<div class="form-group">
									<button type="submit" name="update_page" class="btn">Update Page</button>
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
		 
		
	</script>
	

<script src="<?php echo base_url()?>assets/js/app.js"></script>
</body>
</html>