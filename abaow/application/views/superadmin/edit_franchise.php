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
									<h3><strong>Update Franchise</strong></h3>
									
								</div>
									
								<form name="myform" id="myform" action="<?php echo base_url()?>admin/update_franchise" method="post">
										<div class="form-group">
											<div class="form-control-wrapper">
													<!--<select name="hours" onchange="this.form.submit()">-->
												<label for="title">Franchise Name:</label>
												<?php foreach($records as $row) {  ?>
												<input type="hidden" value="<?php echo $row->id;?>" name="f_id">
												<input type="text" class="form-control" name="f_name" id="<?php echo $row->id ; ?>" style="width:90%" value="<?php echo $row->name ; ?>" required>
												<p id="error-message" style="color:red;"></p>
											</div><br>
											<div class="form-control-wrapper">
												<label for="title">Mobile Number:</label>
												<input type="text" class="form-control" name="phone" id="phone" style="width:90%"  value="<?php echo $row->mobile; ?>" required>
												<p id="error-message1" style="color:red;"></p>
											</div><br>
											
											<div class="form-control-wrapper">
												<label for="title">Email Id:</label>
												<input type="email" class="form-control" name="email" id="email" style="width:90%" value="<?php echo $row->email; ?>" required>
												<p id="error-message2" style="color:red;"></p>
											</div><br>
											
											<div class="form-control-wrapper">
												<label for="title">Start Date:</label>
												<input type="date" class="form-control" name="s_date" id="s_date" style="width:90%" value="<?php echo $row->start_date; ?>" required>
											</div><br>
											
											<div class="form-control-wrapper">
												<label for="title">End Date:</label>
												<input type="date" class="form-control" name="e_date" id="e_date" style="width:90%" value="<?php echo $row->end_date; ?>" required>
											</div><br>
											
											<label class="form-label" for="signup_v1-username">Status:</label>
										<div class="form-control-wrapper">
										<select name="fr_status" id="fr_status" class="form-control" style="width:70%"	required>
										
													<option value="<?php echo $row->status; ?>"><?php echo $row->status; ?></option>
													 <?php
														 
															if($row->status=='ACTIVE')
															{
																echo "<option value='INACTIVE'>INACTIVE</option>";
															}
															else
															{
																echo "<option value='ACTIVE'>ACTIVE</option>";
															}
														
													?>	 
										
										</select>
										</div><br>
											
											
												<?php } ?>
										</div>
										<div class="form-group">
											<button type="submit" id="submit" name="update_franchise" class="btn">Save</button>
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
		
		
		$(document).ready(function() {
			$("#submit").click(function() {
            $("#myform").find("#error-message").html('');			
			$("#myform").find("#error-message1").html('');
			$("#myform").find("#error-message2").html('');
			
            if (!isNaN($('#f_name').val())){
                 
                 $("#myform").find("#error-message").html('Only alphabets are allowed');
                 $('#f_name').focus();
                 return false;
            }
			
			if ($('#phone').val().length != 10){
                 //alert("Enter 10 digit mobile number");
                 $("#myform").find("#error-message1").html('Enter a valid 10 digit mobile number');
                 $('#phone').focus();
                 return false;
            }
            if ($('#phone').val() < 0){
                 
                 $("#myform").find("#error-message1").html('Enter a valid 10 digit mobile number');
                 $('#phone').focus();
                 return false;
            }
            if (isNaN($('#phone').val())){
                 
                 $("#myform").find("#error-message1").html('Enter a valid 10 digit mobile number');
                 $('#phone').focus();
                 return false;
            }
			
			var email= $("#email").val();
			var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			
			if(!expr.test(email))
			{			
				 $("#contact_form").find("#error-message2").html('Enter a valid email id');
                 $('#email').focus();
                 return false;
            }
            
			});        
		});
		
		
		$(document).ready(function(){
			
			$("#e_date").change(function () {
				var startDate = document.getElementById("s_date").value;
				var endDate = document.getElementById("e_date").value;
			 
				if ((Date.parse(startDate) >= Date.parse(endDate))) {
					alert("End date should be greater than Start date");
					document.getElementById("e_date").value = "";
				}
			});			
		});

	</script>
	

<script src="<?php echo base_url()?>assets/js/app.js"></script>
</body>
</html>