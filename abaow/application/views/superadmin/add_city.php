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
									<h3><strong>Add City</strong></h3>
									
								</div>
									
								<form name="myform" id="myform" action="<?php echo base_url()?>admin/add_city" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<div class="form-control-wrapper">		
												<label for="title">Select Country:</label>
												<select name="country_id" id="country_id" class="form-control" style="width:70%"	>
													<option value="">--- Select Country ---</option>
													<?php
														foreach ($countrys as $value) {
															echo "<option value='".$value->id."'>".$value->country_name."</option>";
														}
													?>
												</select>
											</div><br>
											<div class="form-control-wrapper">		
												<label for="title">Name of City:</label>
												<input type="text" class="form-control" name="city" id="city" style="width:90%" placeholder="Enter City name" required>
												<p id="error-message" style="color:red;"></p>
											</div><br>											
										</div>
										<div class="form-group">
											<button type="submit" id="submit" name="add_city" class="btn">Save</button>
										</div>
								</form>
							</div>
						</div>
						
						<div class="col-md-6">				
							<div style="color:red;"><?php 
									/* foreach($msg as $value)
									{
										echo $value;
									} */
									echo $msg;
									echo "<br><br>";
									 ?>
							</div>
							<table id="table-edit" class="table table-bordered table-hover">
									<thead>
									<tr>
										<th width="1">Sr.No.</th>
										<th>City Name</th>
										<th colspan="2">Action</th>										
									</tr>
									</thead>
									
									<tbody>
										<tr><?php 
										$i=1;
									 foreach($citys as $row)  
									 {  
										?><tr>  
										<td><?php echo $i;?></td>  
										<td><?php echo $row->city_name;?></td>  
										<td><a  href="<?php echo base_url().'admin/editCity/'.$row->id;?>">Edit</a></td>
										<!--<td><a  href="<?php //echo base_url().'admin/deleteInstructor/'.$row->id;?>">Delete</a></td>-->
										<td><a  href="#" onclick="delete_ins(<?php echo $row->id; ?>)">Delete</a></td>
									 <?php $i++;}  
									 ?>  										
										</tr>										
									</tbody>
							</table>
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
		
			if(ins_id!="")
			{
				var conf= confirm("Are you sure you want to delete?");
				
				if(conf)
				{
					window.location.href= "<?php echo site_url('admin/deleteCity');?>?id="+ins_id;;
					
				}
			}
		}
		
		$(document).ready(function() {
			$("#submit").click(function() {
            $("#myform").find("#error-message").html('');
			
			
            if (!isNaN($('#city').val())){
                 
                 $("#myform").find("#error-message").html('Only alphabets are allowed');
                 $('#city').focus();
                 return false;
            }
            
			});        
		});
	</script>
	

<script src="<?php echo base_url()?>assets/js/app.js"></script>
</body>
</html>