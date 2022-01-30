<?php include 'master/header.php'; ?>

	<div class="page-content">
		<div class="container-fluid">	
			<section class="card">
				<div class="card-block">
					

					<div class="row m-t-lg">
						<div class="col-md-6">
						<div class="tbl-cell">
							<h3>Edit Module</h3>
							
						</div>
						
							<form name="myform" id="myform" action="<?php echo base_url()?>admin/update_audiomodule" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<div class="form-control-wrapper">
									<?php foreach ($records1 as $row){?>
										<!--<label class="form-label">Enter New Page Name : </label>-->
										<input type="hidden" class="form-control"  name="module_id" value="<?php echo $row->id;?>">
										<input type="hidden" class="form-control"  name="course_id" value="<?php echo $row->course_id;?>">
										
										<label class="form-label" for="signup_v1-username">Module Name:</label>
										<div class="form-control-wrapper">
											<input type="text" class="form-control" name="module_name" value="<?php echo $row->module_name;?>" required>
										</div><br>
										
										<label class="form-label" for="signup_v1-username">Audio:</label>
												<div class="form-control-wrapper">
												 
													<input type="hidden" class="form-control" name="module_audio" value="<?php echo $row->module_audio;?>">
													
													<input type="file" class="form-control" name="module_audio">
													
													<audio controls>
													 <source src="<?php echo $row->module_audio;?>" type="audio/mpeg">
													</audio>
													<?php $audio= $row->module_audio;
															//echo $audio; 
															$link= explode("/", $audio);
															$link_value= end($link);?>
													<label class="form-label" for="signup_v1-username"><?php echo $link_value;?></label>
												</div><br>	
										
																			
									
									<label class="form-label" for="signup_v1-username">Module Description:</label>
									<div class="form-control-wrapper">
										<textarea style="width:90%;"  type="text" id ="module_desc" name="module_desc" ><?php echo $row->module_desc;?></textarea>
									</div><br>	
										
									<label class="form-label" for="signup_v1-username">Duration(in minutes):</label>
											<div class="form-control-wrapper">
												<input type="text" class="form-control" name="module_dur" value="<?php echo $row->duration;?>" required>
											</div><br>
									
									<label class="form-label" for="signup_v1-username">Module After:</label>
												<div class="form-control-wrapper">
											<!--<input type="text" class="form-control" name="module_dur" value="<?php echo $row->module_after;?>" required>-->
													<select name="module_after" id="module_after" class="form-control" style="width:70%"	>
													
												
													<?php
													$val=0;
													$res=$row->course_id;
													$r_id=$row->id;
													$sql="select module_name,id , module_after from course_curriculum where course_id=$res";
													$query= $this->db->query($sql);
													$mod=$query->result();
													//print_r($mod);
													//echo	$selected = $mod[0]->module_after;
													$sql2="select * from course_curriculum where id=$r_id";
													$query2= $this->db->query($sql2);
													$mod2=$query2->result();
													//print_r($mod2);
													echo $module=$mod2[0]->module_after;
												
												if($module !=0)
												{
													$sql1="select id,module_name from course_curriculum where id=$module";
															$query1= $this->db->query($sql1);
															$res1=$query1->result();
															print_r($res1);
															echo "<option value='".$res1[0]->id."' >".$res1[0]->module_name."</option>";
												
												
														  foreach ($mod as $value) 
														{
														//	echo $value->id;
															//$value->module_after;
															//$selected = $value->module_after;
															//$sql1="select id,module_name from course_curriculum where id=$selected";
															//$query1= $this->db->query($sql1);
															//$res1=$query1->result();
															//print_r($res1);
															//echo "<option value='".$res1[0]->id."' >".$res1[0]->module_name."</option>";
															/* foreach($res1 as $row1)
															{
																echo "<option value='".$row1->id."' >".$row1->module_name."</option>";
															} */
															
															if($res1[0]->module_name!=$value->module_name)
														{
															echo "<option value='".$value->id."' >".$value->module_name."</option>";
															
														} 
															
															//echo "<option value='".$value->id."' >".$value->module_name."</option>";
														} 
														echo "<option value='".$val."' >No Module</option>";
												}
												else
												{
													echo "<option value='".$val."' >No Module</option>";
													foreach ($mod as $value) 
														{
															echo "<option value='".$value->id."' >".$value->module_name."</option>";
														}	
												}
													?>
													</select>
												</div><br>		

										<!--<select name="module_after" id="module_after" class="form-control" style="width:70%"	>
											<option value="<?php //echo $row->id;?>"><?php //echo $row->module_after;?></option>
										</select>	-->									
																		
										<?php }   ?> 
									</div>
									
								</div>
								<div class="form-group">
									<button type="submit" name="update_audiomodule" class="btn">Update Module</button>
								</div>
							</form>
						</div>
						
					
				</div>
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	


	
	
	<?php include 'master/footer.php'; ?>
	<!--.footer anre -content-->
	
	

<script src="<?php echo base_url()?>assets/js/app.js"></script>
</body>
</html>