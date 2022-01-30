<?php include 'master/header.php'; ?>

	<div class="page-content">
		<div class="container-fluid">
		
			<section class="card">
				<div class="card-block">					
					<div class="row m-t-lg">
						<div id="main" class="col-md-12">
						<!-- Add element section -->
							<div class="section-style">
								<div class="tbl-cell">
									<h3><strong>Trainer wise User Count</strong></h3>
								</div>
									
							</div>
							
							<div class="row m-t-lg">
								
										<div class="col-md-4">	
											<label class="form-label" for="franchise">Select Trainer</label>
											<div class="form-control-wrapper">
											
												<select name="ins_name" id="ins_name" class="form-control" style="width:70%">
													<option value="">---Select---</option>
													<?php
														foreach ($records as $value) 
														{
															echo "<option value='".$value->id."'>".$value->name."</option>";
														}
													?>
												</select>
											</div><br>
										</div>
										</div>
							
								
													
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
										<th width="1">Course Name</th>
										<th width="1">Course Language</th>
										<th width="1">User Count</th>
									</tr>
									</thead>
									
									<tbody>
										<tr><?php 
										$i=1;
										
									 foreach($result as $row)  
									 {  
										$this->db->select('*');
										$this->db->from('users u');
										$this->db->join('orders o','u.id = o.user_id');
										$this->db->where('o.course_id',$row->course_id);
										$this->db->where('o.status',"Success");
										$query = $this->db->get(); 
										$arr   = $query->num_rows();
										//print_r($arr);
										//$total = $arr[0]->total;
										?><tr>  
										<td><?php echo $i;?></td>   
										<td><?php echo $row->course_name;?></td> 
										<td><?php echo $row->language;?></td> 
										<td><?php echo $arr;?></td>
										
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
		$("#ins_name").change(function(){ 
					$('tbody').hide();
                     /*dropdown post *///  
                     $.ajax({  
                        url:"<?php echo base_url();?>admin/ins_course_data",  
                        data: {id:  
                           $(this).val()},  
                        type: "POST",  
                        success:function(data){  
                        $("tbody").html(data);  
                     }  
                  }); 
				$('tbody').show();
				
				
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