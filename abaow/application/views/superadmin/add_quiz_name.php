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
									<h3><strong>Add Quiz</strong></h3>
									
								</div>
									
								<form name="myform" id="myform" action="<?php echo base_url()?>admin/add_quiz" method="post">
										<div class="form-group">
											
											<div class="form-control-wrapper">
												<label for="title">Enter Quiz Id:</label>
												<input type="text" class="form-control" name="quiz_id" id="quiz_id" style="width:90%" placeholder="Enter quiz id" required>
											</div><br>											
											
											
											<div class="form-control-wrapper">
												<label for="title">Enter Quiz Name:</label>
												<input type="text" class="form-control" name="quiz_name" id="quiz_name" style="width:90%" placeholder="Enter quiz name" required>
											</div><br>							
											
										</div>
										<div class="form-group">
											<button type="submit" name="add_quiz" class="btn">Save</button>
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
										<th>Quiz Name</th>
										<th colspan="3">Action</th>										
									</tr>
									</thead>
									
									<tbody>
										<?php 
										$i=1;
									 foreach($records as $row)  
									 {  
										?><tr>  
										<td><?php echo $i;?></td>  
										<td><?php echo $row->quiz_name;?></td>
										<td><a  href="<?php echo base_url().'admin/add_question/'.$row->quiz_id;?>">Add/Edit Questions</a></td>
										<td><a  href="<?php echo base_url().'admin/editQuiz/'.$row->id;?>">Edit</a></td>
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
			</section><!-- Add meta key section -->			
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	

	
	<?php include 'master/footer.php'; ?>
	<!--.footer anre -content-->
	<script type="text/javascript">

	function delete_ins(ins_id)
		{	
			//alert('in javascript');
			if(ins_id!="")
			{
				var conf= confirm("Are you sure you want to delete?");
				
				if(conf)
				{
					window.location.href= "<?php echo site_url('admin/deleteQuiz');?>?id="+ins_id;;
					
				}
			}
		}
		
	
</script>
	

<script src="<?php echo base_url()?>assets/js/app.js"></script>
</body>
</html>