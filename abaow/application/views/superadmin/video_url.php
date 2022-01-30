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
									<h3><strong>Add App Video URL</strong></h3>
									
								</div>
									
								<form name="myform" id="myform" action="<?php echo base_url()?>admin/add_video" method="post">
										<div class="form-group">
											<div class="form-control-wrapper">
												<label for="url">Video URL:</label>
												<input type="text" class="form-control" name="url" id="url" style="width:90%" placeholder="Enter Video URL" required>
												<p id="error-message" style="color:red;"></p>
											</div><br>											
										</div>
										<div class="form-group">
											<button type="submit" id="submit" name="add_url" class="btn" disabled>Save</button>
										</div>
								</form>
							</div>
						</div>
						
						<div class="col-md-6">				
							<div style="color:red;">
							</div>
							<table id="table-edit" class="table table-bordered table-hover table-responsive">
									<thead>
									<tr>
										<th width="1">Sr.No.</th>
										<th>Video URL</th>
										<th colspan="2">Action</th>										
									</tr>
									</thead>
									
									<tbody>
										<tr><?php 
										$i=1;
									 foreach($url as $row)  
									 {  
										?><tr>  
										<td><?php echo $i;?></td>  
										<td><?php echo $row->video_url;?></td>  
										<td><a  href="<?php echo base_url().'admin/editVideo/'.$row->video_id;?>">Edit</a></td>
										<!--<td><a  href="<?php //echo base_url().'admin/deleteInstructor/'.$row->id;?>">Delete</a></td>-->
										<td><a  href="#" onclick="deleteurl(<?php echo $row->video_id; ?>)">Delete</a></td>
									 <?php $i++;}  
									 ?>  										
										</tr>										
									</tbody>
							</table>
						</div>
						
					</div>
				</div>
			</section><!-- Add meta key section -->	

		</div><!--.container-fluid-->
	</div><!--.page-content-->
	

	
	<?php include 'master/footer.php'; ?>
	<!--.footer anre -content-->
	<script type="text/javascript">
		function deleteurl(url_id)
		{
		
			if(url_id!="")
			{
				var conf= confirm("Are you sure you want to delete?");
				
				if(conf)
				{
					window.location.href= "<?php echo site_url('admin/deleteurl');?>?id="+url_id;;
					
				}
			}
		}
		
		$(document).ready(function() {
			$("#submit").click(function() {
            $("#myform").find("#error-message").html('');
			
			
            if (!isNaN($('#language').val())){
                 
                 $("#myform").find("#error-message").html('Only alphabets are allowed');
                 $('#language').focus();
                 return false;
            }
            
			});        
		});
	</script>
	

<script src="<?php echo base_url()?>assets/js/app.js"></script>
</body>
</html>