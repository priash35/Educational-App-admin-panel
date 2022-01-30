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
									<h3><strong>User Quiz Response</strong></h3>
								</div>
							</div>
								
							
							<form name="myform" id="myform" action="<?php //echo base_url()?>" method="post">
								<div class="form-group">
								<div class="form-control-wrapper">
								<div class="row m-t-lg">									
										
									
										<div class="col-md-6">	
											<label class="form-label" for="course">Select Course</label>
											<div class="form-control-wrapper">
												
											<select name="course" id="course" class="form-control" style="width:90%">
											<option value="0">--Select Course--</option>
															<?php
																foreach ($course as $value1) 
																{
																	echo "<option value='".$value1->id."'>".$value1->course_name."</option>";
																}
															?>
														</select>
											</div><br>
										</div>
										
										<div class="col-md-6">	
											<label class="form-label" for="user">Select User</label>
											<div class="form-control-wrapper">
												
											<select name="user" id="user" class="form-control" style="width:90%">
											<option value="">--Select Course First--</option>
															<?php
																/* foreach ($citys as $value2) 
																{
																	echo "<option value='".$value2->id."'>".$value2->city_name."</option>";
																} */
															?>
														</select>
											</div><br>
										</div>
										
									
								</div>
								
								</div>
								</div>
							</form>
							
													
						<div class="row m-t-lg">					
							
							<div class="col-md-12">	
							
							<table id="table-edit" class="table table-bordered table-hover table-responsive">
									<thead>
									<tr>
										<th width="1">Sr.No.</th>
										<th width="1">Question</th>
										<th width="1">Answer</th>
										<!--<th width="1">User Name</th>
										<th width="1">Course Language</th>
										<th width="1">Country</th>
										<th width="1">City</th>-->
										<!--<th width="1">Franchise</th> -->
										<th width="1">Date</th>
										
															
									</tr>
									</thead>
									
									<tbody>
										 <tr><?php 
										/*$i=1;
										
									 foreach($result as $row)  
									 { */  
										?><!--<tr>  
										<td><?php //echo $i;?></td>  
										<td><?php //echo $row->order_id;?></td>  
										<td><?php //echo $row->course_name;?></td> 
										<td><?php //echo $row->name;?></td> 
										<td><?php //echo $row->language;?></td> 
										<td><?php //echo $row->country_name;?></td> 
										<td><?php //echo $row->city_name;?></td> 
										<!--<td><?php //echo $row->franchise_name;?></td> -->
									<!--	<td><?php //echo $row->order_date;?></td> 
										
									 <?php// $i++;}  
									 ?>  
											
											</tr>  -->
										
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
		$('table').hide();
                $("#course").change(function(){  
                     /*dropdown post *///  
                    $.ajax({  
                        url:"<?php echo base_url();?>admin/quiz_ajax_data",  
                        data: {id:  
                           $(this).val()},  
                        type: "POST",  
                        success:function(data){  
                        $("#user").html(data);  
						}  
					}); 
				  
				  		$('table').hide();		  
					$.ajax({  
						url:"<?php echo base_url();?>admin/country_wise_count",  
						data: {id:  
						   $(this).val()},  
						type: "POST",  
						success:function(data){  
						$('#total').html(data);						
						}  
					});
					
				 });
			   
				$("#user").change(function(){  
                     
				//  $('tbody').hide();
					var course_id=document.getElementById("course").value;
					var user_id=document.getElementById("user").value;
					//var user_id=$(this).val();
					  $.ajax({  
							url:"<?php echo base_url();?>admin/quiz_view",  
							data: {c_id:course_id,  
							 u_id:user_id  },  
							type: "POST",  
							success:function(data){  
							$('tbody').html(data);
						 }  
					  });
					  
					$('table').show();
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