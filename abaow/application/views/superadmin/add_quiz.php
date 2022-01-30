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
									
								<form name="myform" id="myform" action="<?php echo base_url()?>admin/add_question" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<?php
														foreach ($records as $value) { ?>
															
													<input type="hidden" value="<?php echo $value->quiz_id;?>" name="q_id">
												<?php		}
													?>
											
											<div class="form-control-wrapper">
												<!--<label for="title">Quiz Id:</label>-->
												
												<!--<input type="text" class="form-control" name="quiz_id" id="quiz_id" style="width:90%" value="<?php //echo $value->quiz_id; ?>" readonly>-->
											</div><br>
											
											<div class="form-control-wrapper">
												<label for="title">After which question you want to insert new question:</label>
												<select name="que_id" id="que_id" class="form-control" style="width:70%"	>
													<option value="">--- Select Question ---</option>
													 <?php
														foreach ($records as $value) { 
															 //echo "<input type='hidden' value='".$value->quiz_id."' name='quiz_id'>";
															echo "<option value='".$value->order."'>".$value->question."</option>";
														}
													?>
												</select>
											</div><br>
											
											<div class="form-control-wrapper">
												<label for="title">Enter Question:</label>
												<input type="text" class="form-control" name="que_name" id="que_name" style="width:90%" placeholder="Enter question here" required>
											</div><br>											
																					
											<div class="form-control-wrapper">
												<label for="title">Question Type</label>
												<select name="que_type" id="que_type" class="form-control" style="width:70%">
													<option value="">--- Select Question Type---</option>
													<option value="TEXT">TEXT</option>
													<option value="MCQ">MCQ</option>
												</select>
											</div><br>
												
											<!--<a href="javascript:void(0);" class="add_button" title="Add field">  <button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> Add New Question
											</button><img  src="add-icon.png"/></a>-->
											
										</div>
										
										<div class="form-group">
											<button type="submit" name="add_question" class="btn">Save</button>
										</div>
										
										
								</form>
							</div>
						</div>
						
						<div class="col-md-6">				
							<div><?php 
								
									//echo $this->input->get('msg');
									//echo $msg;
									 ?>
							</div>
							<table id="table-edit" class="table table-bordered table-hover">
									<thead>
									<tr>
										<th width="1">Sr.No.</th>
										<th>Question</th>
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
										<td><?php echo $row->question;?></td>
										<td><a  href="<?php echo base_url().'admin/editQuestion/'.$row->id;?>">Edit</a></td>
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
		
			if(ins_id!="")
			{
				var conf= confirm("Are you sure you want to delete?");
				
				if(conf)
				{
					window.location.href= "<?php echo site_url('admin/deleteQuestion');?>?id="+ins_id;;
					
				}
			}
		}
		
	$(document).ready(function(){
		var maxField = 10; //Input fields increment limitation
		var addButton = $('.add_button'); //Add button selector
		var wrapper = $('.form-group'); //Input field wrapper
		var fieldHTML = '<div><label for="title">After which question:</label><br><select name="que_id" id="que_id" class="form-control" style="width:70%"><option value="">--- Select Question ---</option><?php foreach ($records as $value) { ?><option value="<?php echo $value->id; ?>"><?php echo $value->question; ?></option><?php }?></select><br><input type="text" class="form-control" name="que_name" id="que_name" style="width:90%" placeholder="Enter question here" required><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/>Remove</a><br></div>'; //New input field html 
		var x = 1; //Initial field counter is 1
		$(addButton).click(function(){ //Once add button is clicked
			if(x < maxField){ //Check maximum number of input fields
				x++; //Increment field counter
				$(wrapper).append(fieldHTML); // Add field html
			}
		});
		$(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
			e.preventDefault();
			$(this).parent('div').remove(); //Remove field html
			x--; //Decrement field counter
		});
	});
</script>
	

<script src="<?php echo base_url()?>assets/js/app.js"></script>
</body>
</html>