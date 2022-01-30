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
									<h3><strong>Add Franchise</strong></h3>
									
								</div>
									
								<form name="myform" id="myform" action="<?php echo base_url()?>admin/add_franchise" method="post">
										<div class="form-group">
											<div class="form-control-wrapper">
													<!--<select name="hours" onchange="this.form.submit()">-->
												<label for="title">Franchise Name:</label>
												<input type="text" class="form-control" name="f_name" id="f_name" style="width:90%" placeholder="Enter Franchise name" required>
												<p id="error-message" style="color:red;"></p>
											</div><br>
											<div class="form-control-wrapper">
												<label for="title">Mobile Number:</label>
												<input type="text" class="form-control" name="phone" id="phone" style="width:90%" placeholder="Enter Mobile Number" required>
												<p id="error-message1" style="color:red;"></p>
											</div><br>
											
											<div class="form-control-wrapper">
												<label for="title">Email Id:</label>
												<input type="email" class="form-control" name="email" id="email" style="width:90%" placeholder="Enter Email Id" required>
												<p id="error-message2" style="color:red;"></p>
											</div><br>
											
											<div class="form-control-wrapper">
												<label for="title">Start Date:</label>
												<input type="date" class="form-control" name="s_date" id="s_date" style="width:90%" required>
											</div><br>
											
											<div class="form-control-wrapper">
												<label for="title">End Date:</label>
												<input type="date" class="form-control" name="e_date" id="e_date" style="width:90%" required>
											</div><br>
											
										</div>
										<div class="form-group">
											<button type="submit" id="submit" name="add_franchise" class="btn">Save</button>
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
									//echo $msg;
									echo "<br><br>";
									 ?>
							</div>
							<table id="table-edit" class="table table-bordered table-hover">
									<thead>
									<tr>
										<th width="1">Sr.No.</th>
										<th>Franchise Name</th>
										<th colspan="2">Action</th>	
										<th>Status</th>										
									</tr>
									</thead>
									
									<tbody>
										<tr><?php 
										$i=1;
									 foreach($records as $row)  
									 {  
										?><tr>  
										<td><?php echo $i;?></td>  
										<td><?php echo $row->name;?></td>  
										<td><a  href="<?php echo base_url().'admin/editFranchise/'.$row->id;?>">Edit</a></td>
										<!--<td><a  href="<?php //echo base_url().'admin/deleteInstructor/'.$row->id;?>">Delete</a></td>-->
										<td><a  href="#" onclick="delete_ins(<?php echo $row->id; ?>)">Delete</a></td>
										<td><?php echo $row->status; ?></td>
										<!--<td><button type="submit" name="franchise_status" id="f_status" class="btn" onclick="franchise_status(<?php// echo $row->id;?>)">Active</button></td>-->
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
		function delete_ins(ins_id)
		{
		
			if(ins_id!="")
			{
				var conf= confirm("Are you sure you want to delete?");
				
				if(conf)
				{
					window.location.href= "<?php echo site_url('admin/deleteFranchise');?>?id="+ins_id;;
					
				}
				
			}
		}
		
		function franchise_status(f_id)
		{	
			//alert('in javascript');
			if(f_id!="")
			{
				var conf= confirm("Do you want to change the Status?");
				
				if(conf)
				{
					window.location.href= "<?php echo site_url('admin/franchise_status');?>?id="+f_id;
					
				}
			}
			
		}  
		
		$(document).on ('click'.'.status_checks',function()
		{
			alert"in fun";
			var status=($(this).hasClass("btn"))? '0':'1';
			var msg =(status=='0')? 'Inactive':'Active';
			if(confirm("Are you sure to "+msg))
			{
				var current_element =$(this);
				var id =$(current_element).attr('data');
				url="<?php echo site_url('admin/franchise_status');?>";
				
				$.ajax({
					type:"POST",
					url:url,
					data:{"id":id,"status":status},
					success: function(data){
						location.reload();
					}
				});
			}
			
			
		});
		
		
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
			/* //$('input:button').click(function(e) {
				$("#s_date").removeClass("red");
				$("#e_date").removeClass("red");
				var fromDate = $("#s_date").datepicker('getDate');
				var toDate = $("#e_date").datepicker('getDate');

				if (toDate <= fromDate) { //here only checks the day not month and year
				  $("#s_date").addClass("red");
				  $("#e_date").addClass("red");
				  errors++;
				}

				if (errors) e.preventDefault(); */
		 // });
			/* $("#s_date").datepicker({
				minDate: 0,
				maxDate: "+60D",
				numberOfMonths: 2,
				onSelect: function(selected) {
				  $("#e_date").datepicker("option","minDate", selected)
				}
				});
			$("#e_date").datepicker({
				minDate: 0,
				maxDate:"+60D",
				numberOfMonths: 2,
				onSelect: function(selected) {
				   $("#s_date").datepicker("option","maxDate", selected)
				}
			});  */
		});

	</script>
	

<script src="<?php echo base_url()?>assets/js/app.js"></script>
</body>
</html>