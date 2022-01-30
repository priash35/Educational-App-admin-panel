<?php include 'master/header.php'; ?>

	<div class="page-content">
		<div class="container-fluid">
		
			<section class="card">
				<div class="card-block">					
					<div class="row m-t-lg">
						<div class="col-md-12">
						<!-- Add element section -->
							<div class="section-style">
								<div class="tbl-cell">
									<h3><strong>Purchased Courses</strong></h3>
								</div>
									
							</div>
								
							
							<form name="myform" id="myform" action="<?php //echo base_url()?>" method="post">
								<div class="form-group">
								<div class="form-control-wrapper">
								<div class="row m-t-lg">									
										
										<div class="col-md-12">												
													<div class="col-md-6">
														<div class="form-control-wrapper">
														<label for="title">Start Date:</label>
														<input type="date" class="form-control" name="s_date" id="s_date" style="width:90%" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-control-wrapper">
														<label for="title">End Date:</label>
														<input type="date" class="form-control" name="e_date" id="e_date" style="width:90%" required>
														</div>
													</div>												
													
										</div>
										<br><br><br><br>
										<div class="col-md-3">	
											
											<div class="form-control-wrapper">
												<label class="form-label" for="language">Language</label>
												<select name="lang" id="lang" class="form-control" style="width:90%">
												<option value="0">Select Language</option>
																<?php
																	foreach ($languages as $value) 
																	{
																		echo "<option value='".$value->id."'>".$value->language."</option>";
																	}
																?>
												</select>
											</div><br>
										</div>
										
										<div class="col-md-3">	
											<label class="form-label" for="country">Country</label>
											<div class="form-control-wrapper">
												
											<select name="country" id="country" class="form-control" style="width:90%">
											<option value="0">Select Country</option>
															<?php
																foreach ($countrys as $value1) 
																{
																	echo "<option value='".$value1->id."'>".$value1->country_name."</option>";
																}
															?>
														</select>
											</div><br>
										</div>
										
										<div class="col-md-3">	
											<label class="form-label" for="city">City</label>
											<div class="form-control-wrapper">
												
											<select name="city" id="city" class="form-control" style="width:90%">
											<option value="">Select City</option>
															<?php
																/* foreach ($citys as $value2) 
																{
																	echo "<option value='".$value2->id."'>".$value2->city_name."</option>";
																} */
															?>
														</select>
											</div><br>
										</div>
										
										<div class="col-md-3">	
											
											<div class="form-control-wrapper">
												<label class="form-label" for="language">Franchise</label>
												<select name="franchise" id="franchise" class="form-control" style="width:90%">
												<option value="0">Select Franchise</option>
																<?php
																	foreach ($franchise as $value2) 
																	{
																		echo "<option value='".$value2->franchise_id."'>".$value2->name."</option>";
																	}
																?>
												<option id="abaow" value="None">GBS</option>
												</select>
											</div><br>
										</div>
										<!--<div class="col-md-3"><br>
										<div class="form-group">
											<button type="submit" name="search" class="btn">Search</button>
										</div>	
										</div>	-->
								</div>
								
								</div>
								</div>
							</form>
							
													
						<div class="row m-t-lg">					
							
							<div class="col-md-12">	
								<div class="row" id="total">
									<?php  $cnt=0;										
										 foreach($result as $row)  
										 {  $cnt++;
										 }
											?>
									<h3>Total Records: <?php echo $cnt; ?></h3>
								</div>
							<table id="table-edit" class="table table-bordered table-hover table-responsive">
									<thead>
									<tr>
										<th width="1">Sr.No.</th>
										<th width="1">Order ID</th>
										<th width="1">Course Name</th>
										<th width="1">User Name</th>
										<th width="1">Course Language</th>
										<th width="1">Country</th>
										<th width="1">City</th>
										<!--<th width="1">Franchise</th> -->
										<th width="1">Order Date</th>
										
															
									</tr>
									</thead>
									
									<tbody>
										<tr><?php 
										$i=1;
										
									 foreach($result as $row)  
									 {  
										?><tr>  
										<td><?php echo $i;?></td>  
										<td><?php echo $row->order_id;?></td>  
										<td><?php echo $row->course_name;?></td> 
										<td><?php echo $row->name;?></td> 
										<td><?php echo $row->language;?></td> 
										<td><?php echo $row->country_name;?></td> 
										<td><?php echo $row->city_name;?></td> 
										<!--<td><?php //echo $row->franchise_name;?></td> -->
										<td><?php echo $row->order_date;?></td> 
										
									 <?php $i++;}  
									 ?>  
											
											</tr>  
										
									</tbody>
							</table>
							</div>
						</div>
						</div>
												
						</div>
					</div>
					
					<div class="row" align="center">
						<button class="btn btn-success" onclick="exportTableToCSV('report.csv')">Export To Excel File</button>
					</div>
						<br>
					
			</section><!-- Add meta key section -->			
		</div>
	</div><!--.page-content-->
	
	<?php include 'master/footer.php'; ?>
	<!--.footer anre -content-->

<script src="<?php echo base_url()?>assets/js/app.js"></script>

<script type="text/javascript">

		
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
				  
				  $('tbody').hide();
				  
					$.ajax({  
                        url:"<?php echo base_url();?>admin/country_wise_view",  
                        data: {id:  
                           $(this).val()},  
                        type: "POST",  
                        success:function(data){  
                        $('tbody').html(data);						
						}  
					}); 
					
				  $('tbody').show();
				  
					$.ajax({  
						url:"<?php echo base_url();?>admin/country_wise_count",  
						data: {id:  
						   $(this).val()},  
						type: "POST",  
						success:function(data){  
						$('#total').html(data);						
						}  
					});
					
				  	$('#lang')[0].selectedIndex = 0;
					$('#e_date')[0].selectedIndex = 0;	
					$('#franchise')[0].selectedIndex = 0;				  
              		 });
			   
				$("#city").change(function(){  
                     
				  $('tbody').hide();
				  
					  $.ajax({  
							url:"<?php echo base_url();?>admin/city_wise_view",  
							data: {id:  
							   $(this).val()},  
							type: "POST",  
							success:function(data){  
							$('tbody').html(data);
						 }  
					  });
					  
					$('tbody').show();

					$.ajax({  
                        url:"<?php echo base_url();?>admin/city_wise_count",  
                        data: {id:  
                           $(this).val()},  
                        type: "POST",  
                        success:function(data){  
                        $('#total').html(data);						
						}  
					});
					
				  $('#lang')[0].selectedIndex = 0;
				  $('#e_date')[0].selectedIndex = 0;
				  $('#franchise')[0].selectedIndex = 0;
				});
			   
           
                $("#lang").change(function(){  
                     
				  $('tbody').hide();
					$.ajax({  
                        url:"<?php echo base_url();?>admin/language_wise_view",  
                        data: {id:  
                           $(this).val()},  
                        type: "POST",  
                        success:function(data){  
                        $('tbody').html(data);
						}  
					});
					
				$('tbody').show();
				
					$.ajax({  
                        url:"<?php echo base_url();?>admin/language_wise_count",  
                        data: {id:  
                           $(this).val()},  
                        type: "POST",  
                        success:function(data){  
                        $('#total').html(data);						
						}  
					});
				  
				  $('#country')[0].selectedIndex = 0;
				  $('#city')[0].selectedIndex = -1;						 
				  $('#e_date')[0].selectedIndex = 0;
				  $('#franchise')[0].selectedIndex = 0;
               });  
           
			
				$("#e_date").change(function () {
					var startDate = document.getElementById("s_date").value;
					var endDate = document.getElementById("e_date").value;
				 
					if ((Date.parse(startDate) >= Date.parse(endDate))) {
						alert("End date should be greater than Start date");
						document.getElementById("e_date").value = "";
					}
					
					$('tbody').hide();
				  $.ajax({  
                        url:"<?php echo base_url();?>admin/date_wise_view",  
                        data: {s_date:startDate,   
                           e_date:endDate},  
                        type: "POST",  
                        success:function(data){  
                        $('tbody').html(data);						
                     }  
                  }); 
				  $('tbody').show();
				  
				  $.ajax({  
                        url:"<?php echo base_url();?>admin/date_wise_count",  
                         data: {s_date:startDate,   
                           e_date:endDate},  
                        type: "POST",  
                        success:function(data){  
                        $('#total').html(data);						
                     }  
                  });
				  $('#country')[0].selectedIndex = 0;
				  $('#city')[0].selectedIndex = -1;
				  $('#lang')[0].selectedIndex = 0;
				  $('#franchise')[0].selectedIndex = 0;
				});
			});
			
			$(document).ready(function() {  
	                     /* $("#franchise").change(function(){  
	                    
						  $('tbody').hide();
						  $.ajax({  
								url:"<?php echo base_url();?>admin/franchise_wise_view",  
								data: {id:  
								   $(this).val()},  
								type: "POST",  
								success:function(data){  
								$('tbody').html(data);
							 }  
						  });
											  
						$('tbody').show();
						
						$.ajax({  
								url:"<?php echo base_url();?>admin/franchise_wise_count",  
								data: {id:  
								   $(this).val()},  
								type: "POST",  
								success:function(data){  
								$('#total').html(data);						
							 }  
						  });
						  
						  $('#country')[0].selectedIndex = 0;
						  $('#city')[0].selectedIndex = -1;
						  $('#e_date')[0].selectedIndex = 0;
						  $('#lang')[0].selectedIndex = 0;
					   }); 
	                */
		            /*  $("#abaow").change(function(){  //not working code
	                    alert("ibase_add_user");
						  $('tbody').hide();
						  $.ajax({  
								url:"<?php echo base_url();?>admin/abaow_course_data",  
								data: {id:$(this).val()},  
								type: "POST",  
								success:function(data){  
								$('tbody').html(data);
							 }  
						  });
											  
						$('tbody').show();
						
						$.ajax({  
								url:"<?php echo base_url();?>admin/abaow_course_count",  
								data: {id:  
								   $(this).val()},  
								type: "POST",  
								success:function(data){  
								$('#total').html(data);						
							 }  
						  });
						  
						  $('#country')[0].selectedIndex = 0;
						  $('#city')[0].selectedIndex = -1;
						  $('#e_date')[0].selectedIndex = 0;
						  $('#lang')[0].selectedIndex = 0;
					   });  */
					
		   });
		   
			 $(document).ready(function() {  
	                     $("#franchise").change(function(){  
	                   // alert("ibase_add_user");
						  $('tbody').hide();
						  $.ajax({  
								url:"<?php echo base_url();?>admin/abaow_course_data",  
								data: {id:$(this).val()},  
								type: "POST",  
								success:function(data){  
								$('tbody').html(data);
							 }  
						  });
											  
						$('tbody').show();
						
						$.ajax({  
								url:"<?php echo base_url();?>admin/abaow_course_count",  
								data: {id:  
								   $(this).val()},  
								type: "POST",  
								success:function(data){  
								$('#total').html(data);						
							 }  
						  });
						  
						  $('#country')[0].selectedIndex = 0;
						  $('#city')[0].selectedIndex = -1;
						  $('#e_date')[0].selectedIndex = 0;
						  $('#lang')[0].selectedIndex = 0;
					   }); 
	               
		    					
		   });
			 
			
		
			function exportTableToCSV(filename) {
				var csv = [];
				var rows = document.querySelectorAll("table tr");
				
				for (var i = 0; i < rows.length; i++) {
					var row = [], cols = rows[i].querySelectorAll("td, th");
					
					for (var j = 0; j < cols.length; j++) 
						row.push(cols[j].innerText);
					
					csv.push(row.join(","));        
				}

				// Download CSV file
				downloadCSV(csv.join("\n"), filename);
			}


			function downloadCSV(csv, filename) {
				var csvFile;
				var downloadLink;

				// CSV file
				csvFile = new Blob([csv], {type: "text/csv"});

				// Download link
				downloadLink = document.createElement("a");

				// File name
				downloadLink.download = filename;

				// Create a link to the file
				downloadLink.href = window.URL.createObjectURL(csvFile);

				// Hide download link
				downloadLink.style.display = "none";

				// Add the link to DOM
				document.body.appendChild(downloadLink);

				// Click download link
				downloadLink.click();
			}
</script>			
			
</body>
</html>