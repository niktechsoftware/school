

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-white">
			<div class="panel-heading panel-yellow">
				<h4 class="panel-title">Update  <span class="text-bold">Class Panel</span></h4>
				<div class="panel-tools">
					<div class="dropdown">
						<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
							<i class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu dropdown-light pull-right" role="menu">
							<li>
								<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
							</li>
							<li>
								<a class="panel-refresh" href="#">
									<i class="fa fa-refresh"></i> <span>Refresh</span>
								</a>
							</li>
							<li>
								<a class="panel-config" href="#panel-config" data-toggle="modal">
									<i class="fa fa-wrench"></i> <span>Configurations</span>
								</a>
							</li>
							<li>
								<a class="panel-expand" href="#">
									<i class="fa fa-expand"></i> <span>Fullscreen</span>
								</a>
							</li>
						</ul>
					</div>
					<a class="btn btn-xs btn-link panel-close" href="#">
						<i class="fa fa-times"></i>
					</a>
				</div>
			</div>
		
			
			<div class="alert alert-info">
			<h3 class="media-heading text-center"><b>Welcome to Class Update  Section</b></h3>
		    This Panel where we can Edit and Delete Class one by one <strong>  make sure that Admission 
			entry has not done in any case </strong> because it may affect Student info. 
			You have to Edit and Delete Class info before Admission of Student.
			<strong>  Press Update Button for Update a single Class and Delete for Delete a single Class.</strong> </div><br><br>
				<div>
					<table class="table table-striped table-hover center table-responsive" style="border:3px solid green;" >
						<thead class="text-blue text-large" style="border:3px solid green;">
							<tr style="background-color:#ffa366; color:white;">
								<th style="border:1px solid green;">SNo.</th>
								<th style="border:1px solid green;">Class Name</th>
								<th style="border:1px solid green;">Class Code</th>
								<th style="border:1px solid green;">Section</th>
								<th style="border:1px solid green;">Class Stream</th>
								<th style="border:1px solid green;">Class Teacher</th>
								<!-- <th style="border:1px solid green;">Teacher Id</th> -->
								<th style="border:1px solid green;">Action</th>
							</tr>
						</thead>
						<tbody style="border:3px solid green;">
							<?php if(isset($classList)): ?>
							<?php $i = 1; foreach($classList->result() as $row):


                                $abcd=$row->id;
								$abc=$row->section;
								$ab=$row->stream;
								$teacher=$row->class_teacher_id;
								$this->db->where('id',$teacher);
								$teacher1=$this->db->get('employee_info')->row();

								$this->db->where('id',$abc);
								$a= $this->session->userdata('school_code');
								$this->db->where('school_code',$a);
								$data1=$this->db->get('class_section')->row();

									$this->db->where('id',$ab);
								$a= $this->session->userdata('school_code');
								$this->db->where('school_code',$a);
								$data2=$this->db->get('stream')->row();

								$scl= $this->session->userdata('school_code');
								$fsd= $this->session->userdata('fsd');
								
								$this->db->where('school_code',$scl);
							    //	$this->db->where('fsd',$fsd);
							    	$this->db->where('status',1);
								$this->db->where('job_category',3);
								$emp=$this->db->get('employee_info')


							 ?> <?php if($i%2==0){$rowcss="warning";}else{$rowcss ="danger";}?>
							<tr class="<?php echo $rowcss;?> text-uppercase"><span id="name4" style="color:red;"></span>
							<td style="border:1px solid green;">
								<b><?php echo $i;?></b><input type="hidden" id="id<?php echo $i;?>" value="<?php echo $row->id; ?>"/>
							</td>
								<td style="border:1px solid green;">
								<input type="text"  onkeypress="return isAlpha(event)" maxlength="10" id="clName<?php echo $i; ?>" value="<?php echo $row->class_name;?>" size="10">
								<!-- <input type="hidden"  id="clName<?php echo $i; ?>" value="<?php echo $row->class_name;?>"> -->
							</td>
								<td style="border:1px solid green;">
								<input type="text" id="ccode<?php echo $i; ?>" value="<?php echo $row->id;?>" size="2"  readonly >
							</td>
								<td style="border:1px solid green;">
								<input type="text" id="section<?php echo $i; ?>" value="<?php echo $data1->section;?>" size="2"  readonly >
							</td>
								<td style="border:1px solid green;">
								<input type="text" id="stream<?php echo $i; ?>" value="<?php echo $data2->stream;?>"  readonly>
							</td>			

								 <td style="border:1px solid green;">
								 	<select id="teacherId<?php echo $i; ?>">
								 	<option value="0" >---Select---</option>
								 	<?php 
								 	if($emp->num_rows()>0){
								 	foreach($emp->result() as $dt):?>
								 	 <option value="<?php echo $dt->id;?>"<?php if($dt->id==$row->class_teacher_id):echo'selected="selected"'; endif;?>>
                                      <?php if($dt){echo $dt->name;?>&nbsp;<?php echo "[".$dt->username."]";}else{echo "Not Found";}?></option>
								 
								 	<?php endforeach;}?>
								 </select>
								 	<!-- <input type="text"  value="<?php echo $row->class_teacher_id;?>" size="5">< --></td> 
								<td style="border:1px solid green;">
									<button class="btn btn-purple btn-sm" id="editClass<?php echo $i; ?>">
			                    		<i class="fa fa-edit"></i> &nbsp;Update
			                    	</button>
			                        <button class="btn btn-red btn-sm" id="deleteClass<?php echo $i; ?>">
			                    		<i class="fa fa-trash-o"></i> &nbsp;Delete
			                    	</button>
								</td>

							</tr>
							<script>
							$("#editClass<?php echo $i; ?>").click(function(){
								var id = $("#id<?php echo $i; ?>").val();
								var clName = $("#clName<?php echo $i; ?>").val();
								var stream = $("#stream<?php echo $i; ?>").val();
								var section = $("#section<?php echo $i; ?>").val();
								var teacherId = $("#teacherId<?php echo $i; ?>").val();
								//alert(id +" , "+ clName +" , "+ stream +" , "+ section +" , "+ teacherId);
								$.post("<?php echo site_url('index.php/configureClassControllers/updateClass')?>",
										{
											id : id,
											clName : clName,
											stream : stream,
											section : section,
											teacherId : teacherId
										},
										function(data){
											$("#success").html(data);
											
										}
								);
							});

							$("#deleteClass<?php echo $i; ?>").click(function(){
								var id = $("#id<?php echo $i; ?>").val();
								var clName = $("#clName<?php echo $i; ?>").val();
								var section = $("#section<?php echo $i; ?>").val();
								//alert(id +" , "+ clName +" , "+ section);
								$.post("<?php echo site_url('index.php/configureClassControllers/deleteClass')?>",
										{
											rowId : id,
											//clName : clName,
											//section : section
										},
										function(data){
											$("#success").html(data);
										});
							});
							</script>
							<?php $i++; endforeach; endif;?>
						</tbody>
					</table>
				</div>
				<script>
				function isAlpha(evt) {
					evt = (evt) ? evt : window.event;
					var charCode = (evt.which) ? evt.which : evt.keyCode;
					if (charCode > 31 && (charCode < 48 || charCode > 57)) {
						return true;
					}
					return false;

					}
				</script>
			</div>
		
