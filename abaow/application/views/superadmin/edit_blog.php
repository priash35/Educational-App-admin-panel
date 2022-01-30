<?php include 'master/header.php'; ?>

	<div class="page-content">
		<div class="container-fluid">	
			<section class="card">
				<div class="card-block">
					

					<div class="row m-t-lg">
						<div class="col-md-6">
						<div class="tbl-cell">
							<h3>Edit Blog</h3>
							        

							</div>
						
							
							<form name="myform" id="myform" action="<?php echo base_url()?>admin/update_blog" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<div class="form-control-wrapper">
									
										<!--<label class="form-label">Enter New Page Name : </label>-->
										<?php foreach ($records1 as $row){?> 
										<input type="hidden" class="form-control"  name="blog_id" value="<?php echo $row->id;?>">
										<label class="form-label" for="blog_title">Title:</label>
										
										<input type="text" class="form-control"  name="blog_title" value="<?php echo $row->blog_title;?>" required>
								
								<br>
									<label class="form-label" for="blog_lang">Language:</label>
									<div class="form-control-wrapper">
																	
									<select name="blog_lang" id="blog_lang" class="form-control" style="width:70%"	required>
									<option value="<?php echo $row->blog_lang; ?>"><?php echo $row->language_name; ?></option>
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
									
									<div class="form-control-wrapper">
										<label for="title">Image:</label>
										<input type="file" class="form-control" name="blog_img" style="width:90%">
										<input type="hidden" name="blog_img" value="<?php echo $row->blog_img;?>" /> <br>
										<img src="<?php echo $row->blog_img;?>" style="width:200px; height:150px;"/>
									</div><br>	
									
									
									<label class="form-label" for="blog_content">Content:</label>
									<div class="form-control-wrapper">
										
										<textarea rows="4" style="width:90%;"  type="text" id ="blog_content" name="blog_content" > 
										<?php echo $row->blog_content; ?> </textarea>
									</div><br>
									
									
										<?php } 
									 ?> 
									</div>
									
								</div>
								<div class="form-group">
									<button type="submit" name="update_blog" class="btn">Update Blog</button>
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
	<script>
		
	</script>

<script src="<?php echo base_url()?>assets/js/app.js"></script>
</body>
</html>