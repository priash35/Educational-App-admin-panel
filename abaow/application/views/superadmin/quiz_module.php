<?php include 'master/header.php'; ?>

	<div class="page-content">
		<div class="container-fluid">
		
			<section class="card">
				<div class="card-block">					
					<div class="row m-t-lg">
						<div class="col-md-9">
						<!-- Add element section -->
							<div class="section-style">
								<div class="tbl-cell">
									<h3>Add Quiz</h3>
									
								</div>
									
								<form name="myform" id="myform" action="<?php echo base_url()?>admin/add_quizmodule" method="post">
										<div class="form-group">
											<div class="form-control-wrapper">
												
												<!--<label class="form-label" for="signup_v1-username">Course Id:</label>-->
												<div class="form-control-wrapper">
												
												<input type="hidden" class="form-control" name="course_id" Value="<?php echo $c_id; ?>"  readonly>
												
												</div><br>
															
												<label class="form-label" for="signup_v1-username">Module Name:</label>
												<div class="form-control-wrapper">
													<input type="text" class="form-control" name="module_name" placeholder="Enter module name" required>
												</div><br>
												
												<label class="form-label" for="signup_v1-username">Select Quiz:</label>
												<div class="form-control-wrapper">
																				
													<select name="module_quiz" id="quiz" class="form-control" style="width:70%"	required>
																								
													<?php
														
														 foreach ($quizdata as $quizvalue) 
														{
															echo "<option value='".$quizvalue->quiz_id."'>".$quizvalue->quiz_name."</option>";
														} 
													?>
													
													</select>
												</div><br>
												
												<label class="form-label" for="signup_v1-username">Module Description:</label>
												<div class="form-control-wrapper">
													<textarea style="width:90%;"  type="text" id ="module_desc" name="module_desc" placeholder="  Enter Module Desciption"></textarea>
												</div><br>
												
																								
												<label class="form-label" for="signup_v1-username">Module After:</label>
												<div class="form-control-wrapper">
																				
													<select name="module_after" id="module_after" class="form-control" style="width:70%"	>
													
											
													<?php
														 foreach ($moduledata as $value) 
														{
															echo "<option value='".$value->id."'>".$value->module_name."</option>";
														} 
													?>
													</select>
												</div><br>
											
												<div class="form-group">
													<button type="submit" name="add_quizmodule" class="btn">Save</button>
												</div>	
												
											</div>	
									</div>
								</form>
						</div>
				</div>		
			</div>	
		</div>	
	</section>
													<!--<select name="hours" onchange="this.form.submit()">-->
												<!--<label for="title">Select Page:</label>
												<select name="post_id" id="page_ele" class="form-control" style="width:70%"	required>
													<!--<option value="">--- Select Page ---</option>-->
													<?php
														/* foreach ($records->result() as $value) {
															echo "<option value='".$value->page_id."'>".$value->page_name."</option>";
														} */
													?>
												<!--	</select>
												
											</div><br>
											<div class="form-control-wrapper">
												<label for="title">Enter element name:</label>
												<input type="text" class="form-control" name="element_name" style="width:70%" placeholder="Enter element name" required>
											</div>
										</div>
										<div class="form-group">
											<button type="submit" name="add_elements" class="btn">Save Element</button>
										</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>				
							<!-- Add meta key section -->
			<!--<section class="card">
				<div class="card-block">					
					<div class="row m-t-lg">
						<div class="col-md-9">
							<div class="section-style">
								<div class="tbl-cell">
									<h3>Add Metakey</h3>
									<p>(Add keys for elements. For example, for slider we will have title, image and content as metakeys. You can also edit or remove already added metakey. The name should be only alphabets and should not contain any space in between.)</p>
								</div>
								
								<form name="myform" id="myform" action="<?php //echo base_url()?>Page/add_elementKey" method="post">
									<div class="field_wrapper">
										<label for="title">Select Page:</label>
										<select name="page_id" id="page_drp" class="form-control" style="width:70%"	>
											<option value="">--- Select Page ---</option>
											<?php
												/* foreach ($records->result() as $value) {
													echo "<option value='".$value->page_id."'>".$value->page_name."</option>";
												} */
											?>
										</select>
										<br>
										<label for="title">Select Element:</label>
										<select name="element_id" id="element_drp" class="form-control" style="width:70%">
											<option value="">--- Select element ---</option required>
										</select>
										<br>
										<div class="form-group">
											<label for="title" name="gbs_values" id="gbs_values"></label>
										</div>
											<!--<input type="text" id="meta_input" name="qqq[meta_key][]" value="" required />
														<select id="meta_input" name="qqq[meta_key][]" >
															<option value="single">Single</option>
															<option value="multiple">Multiple</option>
														</select>
														<select id="meta_input" name="qqq[meta_key][]" >
															<option value="text">Text</option>
															<option value="file">Image</option>
														</select>-->
										<!--	<a href="javascript:void(0);" class="add_button" title="Add field">  <button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> Add New Meta Key
											</button><img  src="add-icon.png"/></a>
									</div>
									</br>
									<div class="form-group">
										<button type="submit" name="btnmetakey" class="btn">Save Metakey</button>
									</div>
								</form>
							</div>	
						</div>		
					</div>
				</div>		
			</section>

			<section class="card">
				<div class="card-block">					
					<div class="row m-t-lg">
						<div class="col-md-8">
							<div class="section-style">
								<div class="tbl-cell">
									<h3>Add Element Data</h3>
									<p>(Add data for elements. You can also edit or remove already added data.)</p>
								</div>
								
								<form name="myform" id="myform" action="<?php// echo base_url()?>Page/meta_value_data_files" method="post" enctype="multipart/form-data">
										
									<div class="form-group">
										<label for="title">Select Page:</label>
										<select name="page_id" id="element_name" class="form-control" style="width:80%"	>
											<option value="">--- Select Page ---</option>
											<?php
												/* foreach ($records->result() as $value) {
													echo "<option value='".$value->page_id."'>".$value->page_name."</option>";
												} */
											?>
											
										</select>
									</div>

									<div class="form-group">
										<label for="title">Select Element:</label>
										<select name="element_id" id="province" class="form-control" style="width:80%">
										<option value="">--- Select element ---</option required>
										
										</select>
									</div>
									
									<div class="form-group">										
											<label for="title" name="province1" id="province1">Select Element Meta:</label>
											<!--<select name="province1" id="province1" class="form-control" style="width:350px">
											<option value="">--- Select element ---</option required>
											</select>-->
									<!--</div>								
									<button type="submit" name="btnmetavalue" class="btn">Save Element Data</button>
								</form>	
							</div>
						</div>
					</div>
				</div>
			</section>
		</div><!--.container-fluid-->
	<!--</div><!--.page-content-->
	

	
	<?php include 'master/footer.php'; ?>
	<!--.footer anre -content-->
	<script type="text/javascript">
	var index = '';
	var fields = '';
	var fields_type = '';
	
	//featch meta key and vvalues
	$(document).ready(function(){
		 $('#element_drp').on('change', function(){
			 	var id = $('#page_drp').val();
				var e_id= $('#element_drp').val();
			 	if(id=='')
				{
					//$('#element_drp').prop('disabled', true);
					 
				}
				else
				{
					//$('#element_drp').prop('disabled', false);
					$.ajax({
					type:'POST',
					data:{id:id,e_id:e_id},
					dataType: "json",
					//dataType: 'json',
					url:'<?php echo site_url('page/getPage_Element');?>',
					success: function(data){
						//alert(id);
						$('#gbs_values').html(data);
						//$('#discounta').html(data);
						
					}
					
					});
				}
		});
	});
	
	/* //featch meta key and vvalues
	$(document).ready(function(){
		 $('#element_drp').on('change', function(){
				
			 	var id = $('#page_drp').val();
				var e_id= $('#element_drp').val();
				//alert(e_id);
			 	if(id=='')
				{
					//$('#element_drp').prop('disabled', true);
					 
				}
				else
				{
					//$('#element_drp').prop('disabled', false);
					$.ajax({
					type:'POST',
					data:{id:id,e_id:e_id},
					dataType: "json",
					//dataType: 'json',
					url:'<?php echo site_url('page/getPage_Element');?>',
					success: function(data){
						//alert(id);
						$('#gbs_values').html(data);
						//$('#discounta').html(data);
					}
					
					});
				}
		});
	}); */

	
	$(document).ready(function(){
		 $('#page_ele').on('change', function(){
			 var id = $('#page_ele').val();
			 	if(id=='')
				{
					//$('#element_drp').prop('disabled', true);
					 
				}
				else
				{
					//$('#element_drp').prop('disabled', false);
					$.ajax({
					type:'POST',
					data:{id:id},
					dataType: "json",
					//dataType: 'json',
					url:'<?php echo site_url('page/getPage_Element');?>',
					success: function(data){
						//alert(id);
						$('#element_hello').html(data);
						//$('#discounta').html(data);
					}
					
					});
				}
		});
	});
	
	
	$(document).ready(function(){
			 $('#page_drp').on('change', function(){
				var id = $('#page_drp').val();
				//var id = $(this).val();	
				//alert(id);
				if(id=='')
				{
					$('#element_drp').prop('disabled', true);
					 
				}
				else
				{
					$('#element_drp').prop('disabled', false);
					$.ajax({
					type:'POST',
					data:{id:id},
					dataType: "json",
					//dataType: 'json',
					url:'<?php echo site_url('page/getPage_drp');?>',
					success: function(data){
						//alert(id);
						$('#element_drp').html(data);
						//$('#discounta').html(data);
					}
					
					});
				}
			});
	});
	/* $(document).ready(function(){
		$('#element_name').on('change',function(){
			var page_id = $(this).val();
			if(page_id =='')
			{
				$('#province').prop('disabled', true);
			}
			else
			{
				$('#province').prop('disabled', false);
				  $.ajax({
					url:'<?php echo base_url('page/getMetakyId');?>',
					//url:'<?php echo site_url('Page/getMetakyId');?>',
					type:"POST",
					data:{'page_id': page_id},
					//dataType: 'json',
					success: function(data){
						//alert('ok');
						$('#province').html(data);
					}
					error: function(){
						alert('error');
					}
				});  
			}
		});
	});
	 */
	 
	/* $(document).ready(function() {
	  $('#discount').on('change', function() {
		var id = ($('#discount').val());
		// alert( $(this).find(":selected").val() );
		//	var e = document.getElementById($('#discount').val());
		//alert(id);
		$.ajax({
				data:id,
				type:'POST',
				url:'<?php echo base_url('page/getMetakyValue');?>',
				success: function(result){
					$('#bn-success').html(result);
				}
			});
	  });
	});  */
	
		$(document).ready(function(){
			 $('#element_name').on('change', function() {
				//var id = $('#element_name').val();
				var id = $(this).val();		
				if(id ==''){
					//alert('#bn-success');
					//$('#bn-danger').html('This field is required');
					$('#province').prop('disabled', true);
				}
				else{
					$('#province').prop('disabled', false);
					$.ajax({
					type:'POST',
					data:{id:id},
					dataType: "json",
					//dataType: 'json',
					url:'<?php echo site_url('page/getMetakyId');?>',
					success: function(data){
						//alert(id);
						$('#province').html(data);
						//$('#discounta').html(data);
					}
					
				});
				}
			});
			
			$('#province').on('change', function() {
				var e_id = $(this).val();
				var pg_id = $('#element_name').val();
				
				if(e_id ==''){
					//alert('#bn-success');
					//$('#bn-danger').html('This field is required');
					$('#province1').prop('disabled', true);
				}
				else{
					$('#province1').prop('disabled', false);
					$.ajax({
					type:'POST',
					data:{e_id:e_id,pg_id:pg_id},
					dataType: "json",
					//dataType: 'json',
					url:'<?php echo site_url('page/getMetaky');?>',
					success: function(data){
						
						$('#province1').html(data[0]);
						index = data[1];
						fields = data[2][0];
						fields_type= data[2][1];
						//alert(fields);
						//alert(fields_type);
						//alert("Index "+index);
						
						//$('#discounta').html(data);
					}
					
				});
				}
			});
		}); 
	
	/* 
	function fetchfromMysqlDatabase() {
                  $.ajax({
                    type: "GET",
                    dataType: "html",
                    //url: '/Page/getMetakyValue',
					url:'<?php echo base_url("/Page/getMetakyValue"); ?>',
					url:'<?php echo site_url('page/getMetakyValue');?>',
                    cache: false,
                    beforeSend: function() {
                       $('#res3').html('loading please wait...');
                    },
                    success: function(htmldata) {
                       $('#res3').html(htmldata);
                    }
                  });
                }
	 */
	 
	$(document).ready(function(){
		var maxField = 20; //Input fields increment limitation
		var addButton = $('.add_button'); //Add button selector
		var wrapper = $('.field_wrapper'); //Input field wrapper
		
		var x = 1;
		//var fieldHTML = '<div><select name="field_name['+x+'][element_id]"><?php foreach($records2->result() as $bank){ ?><option  value="<?php echo $bank->element_id ?>"><?php echo $bank->element_name ?></option><?php } ?></select><input type="text" name="field_name['+x+'][meta_key]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a><select name="field_name['+x+'][frequency]" ><option value="single">Single</option><option value="multiple">Multiple</option></select></div>'; //New input field html 
		//var fieldHTML = '<div><select name="field_name[]" ><option value="single">Single</option><option value="multiple">Multiple</option></select></div>'; //New input field html 
		 //Initial field counter is 1
		$(addButton).click(function(){ //Once add button is clicked
			if(x < maxField){ //Check maximum number of input fields
			var e = document.getElementById("page_drp");
			var pageid = e.options[e.selectedIndex].value;
			var fieldHTML = '<div><input type="text" name="qqq['+x+'][]" value="" required>&nbsp<select name="qqq['+x+'][]" ><option value="single">Single</option><option value="multiple">Multiple</option></select>&nbsp<select name="qqq['+x+'][]" ><option value="text">Text</option><option value="file">Image</option></select>&nbsp<a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-trash" aria-hidden="true"></i></a><br><br></div>'; //New input field html 
		
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
	function myFunction() {
		
		var fields_array = fields.split(',');
		var type_array= fields_type.split(',');
		
		//alert(fields_array);
		//var e_type= type;
		//alert(e_type);
		//alert(type_array);
		
		var province = document.getElementById("province1");
		var buts = document.getElementById("insbut");
		province.removeChild(buts);
		for (var i=0; i<fields_array.length;i++){
			//fields_type[i]
			//province.appendChild(document.createElement("br"));
			if(type_array[i]=="text")
			{
				var addlabel= document.createElement("input");
        		addlabel.setAttribute("type", "text");
        		var a = +index + +1;
        		addlabel.setAttribute("value", fields_array[i]+a);
        		addlabel.setAttribute("id","xx"+fields_array[i]+a);
        		addlabel.setAttribute("readonly", true);
        		province.appendChild(addlabel);				
			
				var addtext= document.createElement("input");
        		addtext.setAttribute("type", "text");
        		addtext.setAttribute("name", "abc["+fields_array[i]+a+"]");
        		addtext.setAttribute("id","yy"+fields_array[i]+a);
        		province.appendChild(addtext);				
			}
			else
			{
				var addlabel= document.createElement("input");
        		addlabel.setAttribute("type", "text");
        		var a = +index + +1;
        		addlabel.setAttribute("value", fields_array[i]+a);
        		addlabel.setAttribute("id","xx"+fields_array[i]+a);
        		addlabel.setAttribute("readonly", true);
        		province.appendChild(addlabel);
				
				var addtext= document.createElement("input");
        		addtext.setAttribute("type", "file");
        		addtext.setAttribute("name", "abc["+fields_array[i]+a+"]");
        		addtext.setAttribute("id","yy"+fields_array[i]+a);
        		province.appendChild(addtext);
			}
		}
				var butn= document.createElement("button");
        		butn.setAttribute("type", "button");
        		butn.setAttribute("name", "remove");
        		butn.setAttribute("id","rembut"+a);
        		butn.setAttribute("class","btn fa fa-trash");
        		butn.setAttribute("onclick","myFunctionRem(\"multi\",\""+a+"\")");
        		//butn.innerHTML = 'Remove';
        		province.appendChild(butn);    
		
		index++;
		//alert("Index again"+index);
		province.appendChild(buts);
		
	}

		function myFunctionRem(type,id) {
		var fields_array = fields.split(',');
		var type_array= fields_type.split(',');
		//alert(fields_array.length);
		//alert(type_array);
		var c = 0;
		var province = document.getElementById("province1");
		
		for (var j=0; j<fields_array.length; j++)
		{
			if(type_array[j]=="text")
			{
				//alert(j);
				var label = document.getElementById("xx"+fields_array[j]+id);
				var text = document.getElementById("yy"+fields_array[j]+id);
				//var photo = document.getElementById("zz"+fields_array[j]+id);
				
					province.removeChild(label);			
					province.removeChild(text);	
					//province.removeChild(photo);
				//var btn = document.getElementById("rembut"+id);	
				//province.removeChild(btn);
			}
			else
			{
				//alert(j);
				var label = document.getElementById("xx"+fields_array[j]+id);
				var text = document.getElementById("yy"+fields_array[j]+id);
				var photo = document.getElementById("zz"+fields_array[j]+id);
				var hide = document.getElementById("ww"+fields_array[j]+id);
					province.removeChild(label);			
					province.removeChild(text);	
					province.removeChild(photo);
					province.removeChild(hide);
				//var btn = document.getElementById("rembut"+id);	
				//province.removeChild(btn);
			}
			
		}
		
		var btn = document.getElementById("rembut"+id);	
		province.removeChild(btn); 
		var buts = document.getElementById("insbut");
		province.removeChild(buts);
		
			var start = +id + +1;
			
			var end = index; 		
		
			for (var i=start; i<=end; i++){
				
				c = i-1;
				for (var j=0; j<fields_array.length;j++)
				{
					if(type_array[j]=="text")
					{
						//alert(i);
						var addlabel = document.getElementById("xx"+fields_array[j]+i);
						province.removeChild(addlabel);
						var value = addlabel.value.slice(-1);
						var text = addlabel.value.slice(0,-1);
						addlabel.setAttribute("type", "text");
						addlabel.setAttribute("value", text+c);
						addlabel.setAttribute("id","xx"+text+c);
						addlabel.setAttribute("readonly", true);
						province.appendChild(addlabel);
						var addtext = document.getElementById("yy"+fields_array[j]+i);
						var val = addtext.value;
						province.removeChild(addtext);
						addtext.setAttribute("type", "text");
						addtext.setAttribute("name", "abc["+text+c+"]");
						addtext.setAttribute("id","yy"+text+c);
						addtext.setAttribute("value",val);
						province.appendChild(addtext);
					}
					else
					{
					
						var addlabel = document.getElementById("xx"+fields_array[j]+i);
						province.removeChild(addlabel);
						var value = addlabel.value.slice(-1);
						var text = addlabel.value.slice(0,-1);
						addlabel.setAttribute("type", "text");
						addlabel.setAttribute("value", text+c);
						addlabel.setAttribute("id","xx"+text+c);
						addlabel.setAttribute("readonly", true);
						province.appendChild(addlabel);
						
						var addtext = document.getElementById("yy"+fields_array[j]+i);
						var val = addtext.value;
						//alert(val);
						province.removeChild(addtext);
						addtext.setAttribute("type", "file");
						addtext.setAttribute("name", "abc["+text+c+"]");
						addtext.setAttribute("id","yy"+text+c);
						addtext.setAttribute("value",val);
						province.appendChild(addtext);
						
						var addimg = document.getElementById("zz"+fields_array[j]+i);						
						//var addimg = document.getElementById("zz"+fields_array[j]+i).src;
						
						//alert(addimg);
						var val1 = addimg.src;
						//alert(val1);
						//document.write(addimg);
						//document.write(val1);
						province.removeChild(addimg);
						//addimg.src= val1;
						
						addimg.setAttribute("src", val1);
						//addtext.setAttribute("name", "abc["+text+c+"]");
						addimg.setAttribute("id","zz"+text+c);
						addimg.setAttribute("style", "width:150px; height:100px;");
						//addimg.setAttribute("value",addimg); 
						province.appendChild(addimg);
						
						var addhidden = document.getElementById("ww"+fields_array[j]+i);
						var val2 = addhidden.value;
						//alert(val2);
						province.removeChild(addhidden);
						addhidden.setAttribute("type", "hidden");
						addhidden.setAttribute("name", "abc["+text+c+"]");
						addhidden.setAttribute("id","ww"+text+c);
						addhidden.setAttribute("value",val2);
						province.appendChild(addhidden);
					}
	        	}
	        	var butn  = document.getElementById("rembut"+i);
	        	province.removeChild(butn);
	        	butn.setAttribute("type", "button");
        		butn.setAttribute("name", "remove");
        		butn.setAttribute("id","rembut"+c);
        		butn.setAttribute("class","btn fa fa-trash");
        		butn.setAttribute("onclick","myFunctionRem(\"multi\",\""+c+"\")");
        		//butn.innerHTML = 'Remove';
        		province.appendChild(butn);

			}
			/* for (var i=start; i<=end; i++){
				
				c = i-1;
				for (var j=0; j<fields_array.length;j++){
				var addlabel = document.getElementById("xx"+fields_array[j]+i);
				province.removeChild(addlabel);
				var value = addlabel.value.slice(-1);
				var text = addlabel.value.slice(0,-1);
				addlabel.setAttribute("type", "text");
	        	addlabel.setAttribute("value", text+c);
	        	addlabel.setAttribute("id","xx"+text+c);
	        	addlabel.setAttribute("readonly", true);
	        	province.appendChild(addlabel);
	        	var addtext = document.getElementById("yy"+fields_array[j]+i);
	        	var val = addtext.value;
				province.removeChild(addtext);
				addtext.setAttribute("type", "text");
	        	addtext.setAttribute("name", "abc["+text+c+"]");
	        	addtext.setAttribute("id","yy"+text+c);
	        	addtext.setAttribute("value",val);
	        	province.appendChild(addtext);
	        	
	        	}
	        	var butn  = document.getElementById("rembut"+i);
	        	province.removeChild(butn);
	        	butn.setAttribute("type", "button");
        		butn.setAttribute("name", "remove");
        		butn.setAttribute("id","rembut"+c);
        		butn.setAttribute("class","btn fa fa-trash");
        		butn.setAttribute("onclick","myFunctionRem(\"multi\",\""+c+"\")");
        		//butn.innerHTML = 'Remove';
        		province.appendChild(butn);

			} */
				/* for (var i=start; i<=end; i++)
			{
				
				c = i-1;
				if(type_array[i]=="text")
				{
					for (var j=0; j<fields_array.length;j++)
					{
					var addlabel = document.getElementById("xx"+fields_array[j]+i);
					province.removeChild(addlabel);
					var value = addlabel.value.slice(-1);
					var text = addlabel.value.slice(0,-1);
					addlabel.setAttribute("type", "text");
					addlabel.setAttribute("value", text+c);
					addlabel.setAttribute("id","xx"+text+c);
					addlabel.setAttribute("readonly", true);
					province.appendChild(addlabel);
					var addtext = document.getElementById("yy"+fields_array[j]+i);
					var val = addtext.value;
					province.removeChild(addtext);
					addtext.setAttribute("type", "text");
					addtext.setAttribute("name", "abc["+text+c+"]");
					addtext.setAttribute("id","yy"+text+c);
					addtext.setAttribute("value",val);
					province.appendChild(addtext);					
					}					
				}
				else
				{
					for (var j=0; j<fields_array.length;j++)
					{
					var addlabel = document.getElementById("xx"+fields_array[j]+i);
						province.removeChild(addlabel);
						var value = addlabel.value.slice(-1);
						var text = addlabel.value.slice(0,-1);
						addlabel.setAttribute("type", "text");
						addlabel.setAttribute("value", text+c);
						addlabel.setAttribute("id","xx"+text+c);
						addlabel.setAttribute("readonly", true);
						province.appendChild(addlabel);
						var addtext = document.getElementById("yy"+fields_array[j]+i);
						var val = addtext.value;
						province.removeChild(addtext);
						addtext.setAttribute("type", "file");
						addtext.setAttribute("name", "abc["+text+c+"]");
						addtext.setAttribute("id","yy"+text+c);
						addtext.setAttribute("value",val);
						province.appendChild(addtext);
						
						var addimg = document.getElementById("zz"+fields_array[j]+i).src;
						//var val1 = addimg.value;
						//document.write(addimg);
						//document.write(val1);
						//province.removeChild(addimg);
						//addimg.src= val1;
						addimg.setAttribute("src", addimg);
						//addtext.setAttribute("name", "abc["+text+c+"]");
						addimg.setAttribute("id","zz"+text+c);
						addimg.setAttribute("style", "width:100px; height:100px;");
						//addimg.setAttribute("value",addimg); 
						province.appendChild(addimg);
					}
				}
				var butn  = document.getElementById("rembut"+i);
					province.removeChild(butn);
					butn.setAttribute("type", "button");
					butn.setAttribute("name", "remove");
					butn.setAttribute("id","rembut"+c);
					butn.setAttribute("class","btn fa fa-trash");
					butn.setAttribute("onclick","myFunctionRem(\"multi\",\""+c+"\")");
					//butn.innerHTML = 'Remove';
					province.appendChild(butn);
			} */
			
			if (c>0){
				index = c;
			}else{
				index--;
				}
			//alert("Index rem"+index);

			province.appendChild(buts);
		
		
		//index++;
		//province.appendChild(buts);
		
	}

	
	/*function myFunctionRem(type,id) {
		
		alert(type + id);
		var xx = id.slice(-1);
		alert(xx);
		var province = document.getElementById("province1");
		var label = document.getElementById("xx"+id);
		var text = document.getElementById("yy"+id);
		var btn = document.getElementById("rembut"+id);

		var buts = document.getElementById("insbut");
		var c = 0;
			province.removeChild(label);
			province.removeChild(buts);
			province.removeChild(text);
			province.removeChild(btn);
			var start = +xx + +1;

			var end = index; 
			alert("Start"+start);
			alert("End"+end);
			for (var i=start; i<=end; i++){
				alert("In  for");
				c = i-1;
				var addlabel = document.getElementById("xx"+id);
				province.removeChild(addlabel);
				var value = addlabel.value.slice(-1);
				var text = addlabel.value.slice(0,-1);
				addlabel.setAttribute("type", "text");
	        	addlabel.setAttribute("value", text+c);
	        	addlabel.setAttribute("id","xx"+text+c);
	        	addlabel.setAttribute("readonly", true);
	        	province.appendChild(addlabel);
	        	var addtext = document.getElementById("yy"+id);
	        	var val = addtext.value;
				province.removeChild(addtext);
				addtext.setAttribute("type", "textarea");
	        	addtext.setAttribute("name", "abc["+text+c+"]");
	        	addtext.setAttribute("id","yy"+text+c);
	        	addtext.setAttribute("value",val);
	        	province.appendChild(addtext);
	        	var butn  = document.getElementById("rembut"+id);
	        	province.removeChild(butn);
	        	butn.setAttribute("type", "button");
        		butn.setAttribute("name", "remove");
        		butn.setAttribute("id","rembut"+text+c);
        		butn.setAttribute("class","btn");
        		butn.setAttribute("onclick","myFunctionRem(\"multi\",\""+text+c+"\")");
        		butn.innerHTML = 'Remove';
        		province.appendChild(butn);

			}
			index = c;
			alert(index);

			province.appendChild(buts);
		
		
		//index++;
		//province.appendChild(buts);
		
	}*/
    

	
	/* 	 $(document).ready(function(){
			$('#btnhello').click(function(){
				var fullname = $('#fullname').val();
				if(fullname ==''){
					//alert('#bn-success');
					$('#bn-danger').html('This field is required');

				}
				else{
					$.ajax({
					type:'POST',
					data:{fullname: fullname},
					url:'<?php echo site_url('page/hello');?>',
					success: function(result){
						$('#bn-success').html(result);
					}
				});
				}
				
			});
		}); */ 
	function RemElement(ele,count)
	{
		 //var nameValue = document.getElementById("xxtitle").value
		//alert('in javascript');
		//var meta = ele.id;
		var meta_array = ele.split('_');
		//var meta_array = meta.split('_');
		 
		  // alert(meta_array[0]);
		 // alert(meta_array[1]);
		 // alert(meta_array[2]); 
		 
		 var p_id= meta_array[0];
		 var e_id= meta_array[1];
		 var lable= meta_array[2];	
		 

		var r = window.confirm("Are you sure you want to delete?");
		if(r)
		{
		 	//alert('in if');
			var element = document.getElementById("gbs_values");
	
			//alert(element);
			var text = document.getElementById("xx"+count);
			//text.parentElement.removeChild(text);
			var select = document.getElementById("yy"+count);
			var select1 = document.getElementById("zz"+count);
			//select.parentElement.removeChild(select);
			var button = document.getElementById("rembut"+count);
			//button.parentElement.removeChild(button);
			element.removeChild(text);
			element.removeChild(select);
			element.removeChild(select1);
			element.removeChild(button); 

		$.ajax({
					type:'POST',
					data:{e_id:e_id,p_id:p_id,lable:lable},
					dataType: "json",
					url:'<?php echo site_url('page/remove_meta_key');?>',
					success: function(data){
						location.reload();
						//alert(p_id);
				}
					
				});  
		}
	}
	</script>
	<script>
		//$(function() {
			/* ==========================================================================
			 Validation
			 ========================================================================== */

			/* $('#btnhello').validate({
				submit: {
					settings: {
						inputContainer: '.form-group'
					}
				}
			});

			$('#form-signin_v2').validate({
				submit: {
					settings: {
						inputContainer: '.form-group',
						errorListClass: 'form-error-text-block',
						display: 'block',
						insertion: 'prepend'
					}
				}
			});

			$('#btnhello').validate({
				submit: {
					settings: {
						inputContainer: '.form-group',
						errorListClass: 'form-tooltip-error'
					}
				}
			});

			$('#form-signup_v2').validate({
				submit: {
					settings: {
						inputContainer: '.form-group',
						errorListClass: 'form-tooltip-error'
					}
				}
			});
		}); */
	</script>

<script src="<?php echo base_url()?>assets/js/app.js"></script>
</body>
</html>