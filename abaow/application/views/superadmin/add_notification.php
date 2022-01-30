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
									<h3><strong>Add Notification</strong></h3>
									
								</div>
									
								<form name="myform" id="myform" action="<?php echo base_url()?>admin/add_notification" method="post">
										<div class="form-group">
											<div class="form-control-wrapper">		
												<label for="title">Select Country:</label>
												<select name="country" id="country" class="form-control" style="width:90%">
													<option value="">--- Select Country ---</option>
													<?php
														foreach ($countrys as $value) {
															echo "<option value='".$value->id."'>".$value->country_name."</option>";
														}
													?>
												</select>
											</div><br>
											
											<div class="form-control-wrapper">		
												<label for="title">Select City:</label>
												<select name="city" id="city" class="form-control" style="width:90%"	>
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
												<textarea class="form-control" name="n_msg" id="n_msg" style="width:90%" required></textarea>
												<p id="error-message" style="color:red;"></p>
											</div>
											<!--<div class="form-control-wrapper">		
												<label for="title">Notification Status:</label>
												<select name="status" id="status" class="form-control" style="width:90%">
													<option value="">--- Select Status ---</option>					
													<option value="READ">READ</option>
													<option value="UNREAD">UNREAD</option>
												</select>
											</div><br>-->
										</div>
										<div class="form-group">
											<button type="submit" id="submit" name="add_notification" class="btn">Save</button>
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
							<table id="table-edit" class="table table-bordered table-responsive table-hover">
									<thead>
									<tr>
										<th width="1">Sr.No.</th>
										<th>Notification</th>
										<th colspan="2">Action</th>										
									</tr>
									</thead>
									
									<tbody>
										<tr><?php 
										$i=1;
									 foreach($records as $row)  
									 {  
										?><tr>  
										<td><?php echo $i;?></td>  
										<td><?php echo $row->message;?></td>  
										<!--<td><a  href="<?php echo base_url().'admin/editNotification/'.$row->id;?>">Edit</a></td>-->
										<!--<td><a  href="<?php //echo base_url().'admin/deleteInstructor/'.$row->id;?>">Delete</a></td>-->
										<td><a   onclick="all_read('<?php echo $row->message; ?>')">Delete(Read)</a></td>
										<td><a   onclick="delete_ins('<?php echo $row->message; ?>')">Delete(All)</a></td>
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
		function delete_ins(msg)        		//updated on 15 june 2018
		{
		//alert(msg);
			if(msg!="")
			{
				var conf= confirm("Are you sure you want to delete all messages ?");
				
				if(conf)
				{
					window.location.href= "<?php echo site_url('admin/deleteNotification');?>?msg="+msg;;
					
				}
			}
		}
		
		function all_read(msg)					//updated on 15 june 2018
		{
		//alert(msg);
			if(msg!="")
			{
				
				var conf= confirm("Are you sure you want to delete Read messages?");
				if(conf)
				{
					window.location.href= "<?php echo site_url('admin/deleteReadNotification');?>?msg="+msg;;
					
				}
			}
		}
		
		$(document).ready(function() {
			$("#submit").click(function() {
            $("#myform").find("#error-message").html('');
			
			
            if (!isNaN($('#n_msg').val())){
                 
                 $("#myform").find("#error-message").html('Only alphabets are allowed');
                 $('#n_msg').focus();
                 return false;
            }
            
			});        
		});
		
		 			
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
			
		$(document).ready(function() {
			

			
			
		});
	</script>
	

<script src="<?php echo base_url()?>assets/js/app.js"></script>
</body>
</html>