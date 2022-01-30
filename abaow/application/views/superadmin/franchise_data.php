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
									<h3><strong>Franchise Details</strong></h3>
								</div>
							
							<div class="row m-t-lg">
							
								<div class="col-md-12">
								<div class="row" id="total">
									<?php  $cnt=0;										
										 foreach($records as $row)  
										 {  $cnt++;
										 }
											?>
									<h3>Total Records: <?php echo $cnt; ?></h3>
								</div>
																					
							<table id="table-edit" class="table table-bordered table-hover table-responsive">
									<thead>
									<tr>
										<th width="1">Sr.No.</th>
										<th width="1">Name</th>
										<th width="1">Mobile</th>
										<th width="1">Email</th>
										<th width="1">Franchise Id</th>
										<th width="1">Franchise URL</th>
										<th width="1">Status</th>
										<th width="1">Start Date</th> 
										<th width="1">End Date</th> 
										<th width="1">Created Date</th>
										<th width="1">No. of Users</th>
										
															
									</tr>
									</thead>
									
									<tbody>
										<tr><?php 
										$i=1;
										//$j=0;
									 foreach($records as $row)  
									 { 
									
											$this->db->select('count(*)as total');
										$this->db->from('users');
										$this->db->join('franchise','users.franchise_id = franchise.franchise_id','left');
										$this->db->where('users.franchise_id',$row->franchise_id);
										$query = $this->db->get(); 
										$arr   = $query->result(); 
										//print_r($arr);
										$total = $arr[0]->total;
										//echo $total;
										?>
										<tr>  
										<td><?php echo $i;?></td>  
										<td><?php echo $row->name;?></td>  
										<td><?php echo $row->mobile;?></td> 
										<td><?php echo $row->email;?></td> 
										<td><?php echo $row->franchise_id;?></td> 
										<td><?php echo $row->franchise_url;?></td> 
										<td><?php echo $row->status;?></td> 
										<td><?php echo $row->start_date;?></td> 
										<td><?php echo $row->end_date;?></td> 
										<td><?php echo $row->created_date;?></td> 
										<td><?php echo $total;?></td>
										
									 <?php
										$i++;
									 } 

									 ?>  	
									</tr>  
											
										
										
									</tbody>
							</table>
							<!--<a href='toExcel'>Export Data</a>-->
							
							<!--<div><?php	
										//echo $links;?></div>
						</div>-->
						</div>
						</div>
						</div>
						
					</div>
					<br>
					<div class="row" align="center">
						<button onclick="exportTableToCSV('report.csv')" class="btn btn-success">Export To Excel File</button>
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
                        url:"<?php echo base_url();?>admin/country_user_data",  
                        data: {id:  
                           $(this).val()},  
                        type: "POST",  
                        success:function(data){  
                        $("tbody").html(data);  
                     }  
                  }); 
				$('tbody').show();
               }); 
				
				$("#franchise").change(function(){ 
					$('tbody').hide();
                     /*dropdown post *///  
                     $.ajax({  
                        url:"<?php echo base_url();?>admin/franchise_user_data",  
                        data: {franchise_id:  
                           $(this).val()},  
                        type: "POST",  
                        success:function(data){  
                        $("tbody").html(data);  
                     }  
                  }); 
				$('tbody').show();
				
            }); 
				
				$("#city").change(function(){ 
					$('tbody').hide();
                     /*dropdown post *///  
                     $.ajax({  
                        url:"<?php echo base_url();?>admin/city_user_data",  
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