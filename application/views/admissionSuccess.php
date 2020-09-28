

<script>
    function autoResize(id){
        var newheight;
        var newwidth;

        if(document.getElementById){
            newheight=document.getElementById(id).contentWindow.document .body.scrollHeight;
            newwidth=document.getElementById(id).contentWindow.document .body.scrollWidth;
        }

        document.getElementById(id).height= (newheight) + "px";
        document.getElementById(id).width= (newwidth) + "px";
    }
</script>
<div class="row">
    <?php $school_code=$this->session->userdata("school_code");?>
	<div class="col-sm-12">
	 <!-- <div class="padding-20 core-content">
        		<a href="<?php //echo base_url(); ?>index.php/login/newAdmission">
                  <button class="btn btn-dark-purple">Take Another New Admission right now <i class="fa fa-arrow-circle-right"></i></button>
                    </a>
  </div> -->
		<?php
			if(isset($studentProfile)):
				$personalInfo = $studentProfile->row();
				$gurdianInfo = $gurdianDetail->row();
		?>
		<div class="tabbable">
			<ul class="nav nav-tabs tab-padding tab-space-3 tab-blue text-uppercase" id="myTab4">
				
				
			
				<li<?php if(strlen($this->uri->segment(4)) <= 0){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#panel_overview">
						Profile
					</a>
				</li>
					<?php if($this->session->userdata('login_type') == '3'){ ?><?php }else{ ?>
				<li<?php if($this->uri->segment(4) == 'updateInfo'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#panel_edit_account">
						Edit Profile
					</a>
				</li><?php } ?>
				
				<?php if($personalInfo->status){?>
				<li<?php if($this->uri->segment(4) == 'certificate'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#certificates">
						Certificates
					</a>
				</li><?php } ?>
				<!--
				<li<?php // if($this->uri->segment(4) == 'Subject'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#subject_area">
						Subject
					</a>
				</li>
				-->
				
				<li<?php if($this->uri->segment(4) == 'Fee Report'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#fee_report">
						Fee Report
					</a>
				</li>
				<?php if($personalInfo->status){?>
				<li<?php if($this->uri->segment(4) == 'Attendance'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#attendance_report">
						Attendance  Report
					</a>
				</li><?php } ?>
				<li<?php if($this->uri->segment(4) == 'Print Profile'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#print_report">
						print Profile
					</a>
				</li>
				<?php if($personalInfo->status){?>
				<li<?php if($this->uri->segment(4) == 'Purchase Report'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#Purchase_report">
						Purchase Report
					</a>
				</li><?php } ?>
			</ul>
			<div class="tab-content">
			    
				<div id="panel_overview" class="tab-pane fade <?php if(strlen($this->uri->segment(4)) <= 0){ echo "in active";}?>">
					<div class="row">
						<div class="col-sm-5 col-md-4">
							<div class="user-left">
								<div class="center">
									<h4 class='text-uppercase'><?php echo $personalInfo->name; ?></h4>
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div style="width: 140px; height: 150px; border: 1px solid #ccc;">
											<?php if(strlen($personalInfo->photo > 0)):?>
												<img alt="<?php echo $personalInfo->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $personalInfo->photo;?>" />
											<?php else:?>
												<?php if($personalInfo->gender == '1'):?>
													<img alt="<?php echo $personalInfo->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/stuMale.png" />
												<?php endif;?>
												<?php if($personalInfo->gender == '0'):?>
													<img alt="<?php echo $personalInfo->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/stuFemale.png" />
												<?php endif;?>
											<?php endif;?>
										</div>
									</div>
								</div>
								<table class="table table-condensed table-hover">
									<thead>
										<tr class='text-uppercase'>
											<th colspan="3">School information</th>
										</tr>
									</thead>
									<tbody>
										<tr class='text-uppercase'>
											<td>Scholar No.</td>
											<td>
												<?php if(strlen($personalInfo->scholer_no) > 1) {echo strtoupper($personalInfo->scholer_no); }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Serial No.</td>
											<td>
												<?php if(strlen($personalInfo->sno) > 1) {echo $personalInfo->sno; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
											<tr class='text-uppercase'>
											<td>Book No.</td>
											<td>
												<?php if(strlen($personalInfo->book_no) > 1) {echo $personalInfo->book_no; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Admission Date</td>
											<td>
												<?php echo date("d-M-Y", strtotime($personalInfo->adm_date)); ?>
											</td>
											<td><a href="#" class="show-tab"></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Class</td>
											<?php $this->db->select('class_name');
											  $this->db->where('id',$personalInfo->class_id);
											  $this->db->where("school_code",$this->session->userdata("school_code"));
										      $classInfo=$this->db->get('class_info')->row();?>
										<td><?php echo $classInfo->class_name; ?></td>
											<!-- <td>
												<?php //echo $personalInfo->class_id; ?>
											</td> -->
											<td><a href="#" class="show-tab"></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>House Name</td>
											<td>
												<?php 
												
												if(strlen($personalInfo->house_id)>0) { 
												    $this->db->where("id",$personalInfo->house_id);
												$get_house=$this->db->get("house");
												if($get_house->num_rows()>0){
												$get_house=$get_house->row()->house_name;
												echo $get_house; }}
												else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#" class="show-tab"></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Login ID</td>
											<td>
												<?php if(strlen($personalInfo->username) > 1) {echo $personalInfo->username; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#" class="show-tab"></a></td>
										</tr>
										<tr>
											<td class='text-uppercase'>Password</td>
											<td>
												<?php echo $personalInfo->password; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-sm-6 col-md-8">
								<table class="table table-condensed table-hover">
									<thead>
										 <tr class='text-uppercase'>
                                        <th colspan="2">Personal Information</th>
                                        <th><a href="<?php echo base_url();?>index.php/login/quickRegistraionStudent" class="btn btn-info">New Registration</a></th>
                                    </tr>
									</thead>
									<tbody>
										<tr class='text-uppercase'>
											<td>Student ID</td>
											<td>
												<?php if(strlen($personalInfo->username) > 1) {echo $personalInfo->username; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#" class="show-tab"></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Full Name</td>
											<td>
												<?php if(strlen($personalInfo->name) > 1) {echo ucwords($personalInfo->name); }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Date Of Birth</td>
											<td>
												<?php echo date("d-M-Y", strtotime($personalInfo->dob)); ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Gender</td>
											<td>
												<?php if (strlen ($personalInfo->gender==1)){echo "Male";}elseif(strlen ($personalInfo->gender==0)){echo "Female";}else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Blood Group</td>
											<td>
												<?php if(strlen($personalInfo->bloodgp) > 1) {echo $personalInfo->bloodgp; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Birth Place</td>
											<td>
												<?php if(strlen($personalInfo->birth_place) > 1) {echo ucwords($personalInfo->birth_place); }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<!-- <tr>
											<td>Nationality</td>
											<td>
												<?php // if(strlen($personalInfo->nationality) > 1) {echo $personalInfo->nationality; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr> -->
										<tr class='text-uppercase'>
											<td>Mother Tongue</td>
											<td>
												<?php if(strlen($personalInfo->mother_tongue) > 1) {echo $personalInfo->mother_tongue; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Category</td>
											<td>
												<?php if(strlen($personalInfo->category) > 1) {echo $personalInfo->category; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>

										<tr class='text-uppercase'>
											<td>Religion</td>
											<td>
												<?php if(strlen($personalInfo->religion) > 1) {echo $personalInfo->religion; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Status</td>
											<td>
											    <?php if(($personalInfo->status)== 1){ echo '<span style="color:green">Active</span>'; }elseif(($personalInfo->status)== 0){ echo '<span style="color:red">Inactive</span>'; }else '<span style="color:red">N/A</span>'; ?>
												<?php //if(($personalInfo->status)== 1){ echo "Active"; }elseif(($personalInfo->status)== 0){ echo "Inactive"; }else "N/A" ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Transport Status</td>
											<td>
												<?php if($personalInfo->transport == 0){ echo '<span style="color:#ff9999">NO</span>'; }else{  echo '<span style="color:#004000">YES</span>'; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Discount Type</td>
											<td>
												<?php 
												$this->db->where('id',$personalInfo->discount_id);
												$disc_id=$this->db->get('discount_head');
												
												$this->db->where('id',$personalInfo->discount_id);
											    $disid=$this->db->get('discounttable');
											    if($disid->num_rows()>0){
											   if($disid->row()->discount_head==1) {echo "STAFF DISCOUNT";}elseif($disid->row()->discount_head==2){echo "BROTHER/SISTER DISCOUNT (ONE CHILD)";}elseif($disid->row()->discount_head==3){echo "BROTHER/SISTER DISCOUNT (TWO CHILD)";}elseif($disid->row()->discount_head==4){echo "MORE THEN TWO BROTHER/SISTER DISCOUNT";}elseif($disid->row()->discount_head==5){echo "OTHER DISCOUNT";} 
											}elseif($disc_id->num_rows()>0){
												  echo $disc_id->row()->disc_head; 
											}else{
												echo '<span style="color:#ff9999">N/A</span>';
											} ?>
											
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<?php	if(strlen($personalInfo->teacher_studentid1)>0){ ?>
										<tr class='text-uppercase'>
											<td>Discounter Id1</td>
											<td>
												<?php if(strlen($personalInfo->teacher_studentid1) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $personalInfo->teacher_studentid1; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<?php }?>
										<?php	if(strlen($personalInfo->teacher_studentid2)>0){ ?>
										<tr class='text-uppercase'>
											<td>Discounter Id1</td>
											<td>
												<?php if(strlen($personalInfo->teacher_studentid1) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $personalInfo->teacher_studentid1; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
									
										<tr class='text-uppercase'>
											<td>Discounter Id2</td>
											<td>
												<?php if(strlen($personalInfo->teacher_studentid2) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $personalInfo->teacher_studentid2; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<?php }?>
										<?php	if(strlen($personalInfo->teacher_studentid3)>0){ ?>
										<tr class='text-uppercase'>
											<td>Discounter Id1</td>
											<td>
												<?php if(strlen($personalInfo->teacher_studentid1) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $personalInfo->teacher_studentid1; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
									
										<tr class='text-uppercase'>
											<td>Discounter Id2</td>
											<td>
												<?php if(strlen($personalInfo->teacher_studentid2) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $personalInfo->teacher_studentid2; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Discounter Id3</td>
											<td>
												<?php if(strlen($personalInfo->teacher_studentid3) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $personalInfo->teacher_studentid3; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<?php }?>
									<?php	if(strlen($personalInfo->teacher_studentid4)>0){ ?>
										<tr class='text-uppercase'>
											<td>Discounter Id1</td>
											<td>
												<?php if(strlen($personalInfo->teacher_studentid1) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $personalInfo->teacher_studentid1; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
									
										<tr class='text-uppercase'>
											<td>Discounter Id2</td>
											<td>
												<?php if(strlen($personalInfo->teacher_studentid2) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $personalInfo->teacher_studentid2; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Discounter Id3</td>
											<td>
												<?php if(strlen($personalInfo->teacher_studentid3) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $personalInfo->teacher_studentid3; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Discounter Id4</td>
											<td>
												<?php if(strlen($personalInfo->teacher_studentid4) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $personalInfo->teacher_studentid4; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<?php }?>
										<tr class='text-uppercase'>
											<td>Height& Weight</td>
											<td>
												<?php if(strlen($personalInfo->height) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $personalInfo->height; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<!-- <tr class='text-uppercase'>
											<td>Height& Weight(Term-2)</td>
											<td>
												<?php if(strlen($personalInfo->weight) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $personalInfo->weight; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr> -->
									</tbody>
								</table>
								<table class="table table-condensed table-hover">
									<thead>
										<tr class='text-uppercase'>
											<th colspan="3">Contact information</th>
										</tr>
									</thead>
									<tbody>
										<tr class='text-uppercase'>
											<td>Address</td>
											<td>
												<?php if(strlen($personalInfo->address1) > 1) {echo ucwords($personalInfo->address1); }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Area</td>
											<td>
												<?php if(strlen($personalInfo->area) > 1) {echo ucwords($personalInfo->area); }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>City / State / PIN</td>
											<td>
												<?php echo $personalInfo->city." / ".$personalInfo->state." / ".$personalInfo->pin_code; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Country</td>
											<td>
												<?php if(strlen($personalInfo->country) > 1) {echo ucwords($personalInfo->country); }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>

										<tr class='text-uppercase'>
											<td>Mobile Number</td>
											<td>
												<?php echo $personalInfo->mobile; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>E-Mail</td>
											<td>
												<?php if(strlen($personalInfo->email) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $personalInfo->email; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
									</tbody>
								</table>
								<table class="table table-condensed table-hover">
									<thead>
										<tr class='text-uppercase'>
											<th colspan="3">Guardian information</th>
										</tr>
									</thead>
									<tbody>
										<tr class='text-uppercase'>
											<td>Father Name</td>
											<td>

												<?php if(strlen($gurdianInfo->father_full_name) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo ucwords($gurdianInfo->father_full_name); } ?>

											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Mother Name</td>
											<td>
												<?php if(strlen($gurdianInfo->mother_full_name) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo ucwords($gurdianInfo->mother_full_name); } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Caretaker Name</td>
											<td>
												<?php if(strlen($gurdianInfo->caretaker_name) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo ucwords($gurdianInfo->caretaker_name); } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Caretaker Relation</td>
											<td>
												<?php if(strlen($gurdianInfo->caretaker_relation) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo ucwords($gurdianInfo->caretaker_relation); } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Father Education</td>
											<td>
												<?php if(strlen($gurdianInfo->father_education) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo ucwords($gurdianInfo->father_education); } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Mother Education</td>
											<td>
												<?php if(strlen($gurdianInfo->mother_education) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo ucwords($gurdianInfo->mother_education); } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Father Occupation</td>
											<td>
												<?php if(strlen($gurdianInfo->father_occupation) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo ucwords($gurdianInfo->father_occupation); } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Mother Occupation</td>
											<td>
												<?php if(strlen($gurdianInfo->mother_occupation) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo ucwords($gurdianInfo->mother_occupation); } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Family Annual Income</td>
											<td>
												<?php if(strlen($gurdianInfo->family_annual_income) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $gurdianInfo->family_annual_income; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Address</td>
											<td>
												<?php if(strlen($gurdianInfo->address) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo ucwords($gurdianInfo->address); } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
											<tr class='text-uppercase'>
											<td>Area</td>
											<td>
												<?php if(strlen($gurdianInfo->area) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo ucwords($gurdianInfo->area); } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>City / State / PIN</td>
											<td>
												<?php echo $gurdianInfo->city." / ".$gurdianInfo->state." / ".$gurdianInfo->pin; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Country</td>
											<td>
												<?php if(strlen($gurdianInfo->country) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo ucwords($gurdianInfo->country); } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>

										<tr class='text-uppercase'>
											<td>Father Mobile Number</td>
											<td>
												<?php if(strlen($gurdianInfo->f_mobile) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $gurdianInfo->f_mobile; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Mother Mobile Number</td>
											<td>
												<?php if(strlen($gurdianInfo->m_mobile) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $gurdianInfo->m_mobile; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Father E-Mail</td>
											<td>
												<?php if(strlen($gurdianInfo->f_email) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $gurdianInfo->f_email; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr class='text-uppercase'>
											<td>Mother E-Mail</td>
											<td>
												<?php if(strlen($gurdianInfo->m_email) <= 0){ echo '<span style="color:#ff9999">N/A</span>'; }else{ echo $gurdianInfo->m_email; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
									</tbody>
								</table>
						</div>
					</div>
				</div>
				<?php if($this->session->userdata('login_type') == '3'){ ?><?php }else{ ?>
				<div id="panel_edit_account" class="tab-pane fade <?php if($this->uri->segment(4) == 'updateInfo'){ echo "in active";}?>">
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<div style="width: 140px; height: 150px; border: 1px solid #ccc;">
												<?php if(strlen($personalInfo->photo > 0)):?>
													<img alt="<?php echo $personalInfo->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $personalInfo->photo;?>" />
												<?php else:?>
													<?php if($personalInfo->gender == 1):?>
														<img alt="<?php echo $personalInfo->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/stuMale.png" />
													<?php endif;?>
													<?php if($personalInfo->gender == 0):?>
														<img alt="<?php echo $personalInfo->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/stuFemale.png" />
													<?php endif;?>
												<?php endif;?>
											</div>
										</div>

									</div>
									<div class="col-md-12 space20">
										<div class="form-group">
											<form method="post" action="<?php echo base_url(); ?>index.php/studentController/updateStudentImage" enctype="multipart/form-data">
				                                <input type="hidden" name="c_id" value="<?php echo $personalInfo->username; ?>">
				                                <input type="hidden" name="old_stuImg" value="<?php echo $personalInfo->photo; ?>">
				                                Only png, jpg File less then 100 kB.
				                                <input type="file" name="stuImage" id="stuImage" class="form-control input-sm" multiple  onchange="GetFileSize('stuImage')"><br/>
				                                <span id="fs" class="text-warning"></span><br/>
				                                <input id="submit" name="submit" type="submit" class="btn btn-red btn-sm pull-left" value="Upload Student Image">
				                                <span id="worning"></span>
				                            </form>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<div style="width: 140px; height: 150px; border: 1px solid #ccc;">
												<?php if(strlen($gurdianInfo->f_photo > 0)):?>
													<img alt="<?php echo $gurdianInfo->father_full_name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $gurdianInfo->f_photo;?>" />
												<?php else:?>
														<img alt="<?php echo $gurdianInfo->father_full_name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empMale.png" />
												<?php endif;?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<form method="post" action="<?php echo base_url(); ?>index.php/studentController/updateFatherImage" enctype="multipart/form-data">
				                                <input type="hidden" name="c_id" value="<?php echo $gurdianInfo->student_id; ?>">
				                                <input type="hidden" name="old_f_image" value="<?php echo $gurdianInfo->f_photo; ?>">
				                                Only png,jpg File lessthen 100 kB.
				                                <input type="file" name="fatherImage" class="form-control input-sm" ><br/>
				                                <input id="submit" name="submit" type="submit" class="btn btn-green btn-sm pull-left" value="Upload Father Image">
				                                <span id="worning"></span>
				                            </form>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<div style="width: 140px; height: 150px; border: 1px solid #ccc;">
												<?php if(strlen($gurdianInfo->m_photo > 0)):?>
													<img alt="<?php echo $gurdianInfo->mother_full_name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $gurdianInfo->m_photo;?>" />
												<?php else:?>
														<img alt="<?php echo $gurdianInfo->mother_full_name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empFemale.png" />
												<?php endif;?>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<form method="post" action="<?php echo base_url(); ?>index.php/studentController/updateMotherImage" enctype="multipart/form-data">
				                                <input type="hidden" name="c_id" value="<?php echo $gurdianInfo->student_id; ?>">
				                                <input type="hidden" name="old_m_photo" value="<?php echo $gurdianInfo->m_photo; ?>">
				                                Only png,jpg File lessthen 100 kB.
				                                <input type="file" name="motherImage" class="form-control input-sm" ><br/>
				                                <input id="submit" name="submit" type="submit" class="btn btn-blue btn-sm pull-left" value="Upload Mother Image">
				                                <span id="worning"></span>
				                            </form>
										</div>
									</div>
								</div>
							</div>

						</div>

<!-- ------------------------------ Student Profile -------------------------------------------- -->
<form action="<?php echo base_url(); ?>index.php/studentController/updateStuInfo" method="post" id="form">
<div class="row">
	<div class="col-sm-12">
		<!-- start: FORM WIZARD PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-yellow">
				<h4 class="panel-title text-uppercase">Student  <span class="text-bold">Information</span></h4>
				<div class="panel-tools">
					<div class="dropdown">
						<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
							<i class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu dropdown-light pull-right text-uppercase" role="menu">
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
				</div>
			</div> <!-- End Heading panel -->
			<div class="panel-body">
			<!-- --------------------------------------------Test Form Start ---------------------------------------- -->
				<div class="row">
					<div class="col-md-12">
						<div class="errorHandler alert alert-danger no-display">
							<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
						</div>
						<div class="successHandler alert alert-success no-display">
							<i class="fa fa-ok"></i> Your form validation is successful!
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Scholar Number <span class="symbol required"></span>
									</label>
									<input type="hidden" name="c_id" value="<?php echo $personalInfo->username; ?>">
									<input type="text" value="<?php echo $personalInfo->scholer_no; ?>" class="form-control text-uppercase" id="scholerNumber" onkeyup="alphanum(scholerNumber);"  name="scholerNumber">
								</div>
							</div>
						<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Serial Number <span class="symbol required"></span>
									</label>
									<input type="number" value="<?php echo $personalInfo->sno; ?>" class="form-control text-uppercase" id="serialNumber" name="serialNumber">
								</div>
							</div>
						</div>

					</div>
						<div class="col-md-6">
						<div class="row">
							
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Book Number <span class="symbol required"></span>
									</label>
									<input type="text" value="<?php echo $personalInfo->book_no; ?>" class="form-control text-uppercase" id="bookNumber" name="bookNumber">
								</div>
							</div>
								<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Name <span class="symbol required"></span>
									</label>
									<input type="text" value="<?php echo $personalInfo->name; ?>" class="form-control text-uppercase" id="firstName" name="firstName">
								</div>
							</div>
						</div>

					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Date Of Birth (yyyy-mm-dd)<span class="symbol required"></span>
									</label>
									<input type="text" data-date-format="yyyy-mm-dd" name="dob" id="dob" value="<?php echo date("Y-m-d", strtotime($personalInfo->dob));?>" data-date-viewmode="years" class="form-control date-picker">
									<!--<input type="text" value="<?php echo date("d-M-Y", strtotime($personalInfo->dob)); ?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years" min="1990-01-01" max="2017-12-31" onkeyup="checkDOB()" name="dob" id="dob" class="form-control date-picker">-->
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Date Of Admission <span class="symbol required"></span>
									</label>
									<input type="text" value="<?php echo date("Y-m-d", strtotime($personalInfo->adm_date)); ?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years" name="dateOfAdmission" id="doa" class="form-control date-picker">
								</div>
							</div>
						</div>
						<!-- <div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">
										Class Of Admission <span class="symbol required"></span>
									</label>
									<select class="form-control" id="classOfAdmission" name="classOfAdmission" readonly>
										<option value="">--Select Class--</option>
										<?php //if(isset($className)):?>
											<?php //foreach ($className->result() as $row):?>
										<option value="<?php //echo $row->class_name;?>" <?php //if($row->class_name == $personalInfo->class_id): echo 'selected="selected"'; endif; ?> >
											<?php //echo $row->class_name;?>
										</option>
											<?php //endforeach;?>
										<?php //endif;?>
									</select>
								</div>
							</div>

						</div> -->
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Gender  <span class="symbol required"></span>
									</label>
									<div>
									   <label class="radio-inline">
											<input type="radio" checked="checked" class="grey text-uppercase" value="1" <?php if("1" == $personalInfo->gender): echo 'checked="checked"'; endif; ?> name="gender"  id="gender_male">
											Male
										</label>
										<label class="radio-inline">
											<input type="radio" class="grey text-uppercase" value="0" <?php if("0" == $personalInfo->gender): echo 'checked="checked"'; endif; ?> name="gender" id="gender_female" >
											Female
										</label>

									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Blood Group <span class="symbol"></span>
									</label>
									<select class="form-control text-uppercase" name="bloodgp" id="bloodgp" >
	                                      <option value="" <?php if("N/A" == $personalInfo->bloodgp): echo 'selected="selected"'; endif; ?>>N/A</option>
	                                      <option value="A+" <?php if("A+" == $personalInfo->bloodgp): echo 'selected="selected"'; endif; ?>>A+</option>
	                                      <option value="A-" <?php if("A-" == $personalInfo->bloodgp): echo 'selected="selected"'; endif; ?>>A-</option>
	                                      <option value="B+" <?php if("B+" == $personalInfo->bloodgp): echo 'selected="selected"'; endif; ?>>B+</option>
	                                      <option value="B-" <?php if("B-" == $personalInfo->bloodgp): echo 'selected="selected"'; endif; ?>>B-</option>'<span style="color:#ff9999">N/A</span>'
	                                      <option value="O+" <?php if("O+" == $personalInfo->bloodgp): echo 'selected="selected"'; endif; ?>>O+</option>
	                                      <option value="O-" <?php if("O-" == $personalInfo->bloodgp): echo 'selected="selected"'; endif; ?>>O-</option>
	                                      <option value="AB+" <?php if("AB+" == $personalInfo->bloodgp): echo 'selected="selected"'; endif; ?>>AB+</option>
	                                      <option value="AB-" <?php if("AB-" == $personalInfo->bloodgp): echo 'selected="selected"'; endif; ?>>AB-</option>
                                	</select>
								</div>
							</div>
						</div>
						</div>
						<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Birth Place <span class="symbol"></span>
									</label>
									<input type="text" value="<?php echo $personalInfo->birth_place; ?>" class="form-control text-uppercase" id="birthPlace" name="birthPlace">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Mother Tongue <span class="symbol"></span>
									</label>
									<select class="form-control text-uppercase" id="mothertongue" name="mothertongue">
										<option value="" <?php if("N/A" == $personalInfo->mother_tongue): echo 'selected="selected"'; endif; ?>>N/A</option>
										<option value="HINDI" <?php if("HINDI" == $personalInfo->mother_tongue): echo 'selected="selected"'; endif; ?>>HINDI</option>
										<option value="ENGLISH" <?php if("ENGLISH" == $personalInfo->mother_tongue): echo 'selected="selected"'; endif; ?>>ENGLISH</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Transport Status <span class="symbol"></span>
									</label>
									<?php if($this->session->userdata("login_type")=="1"){ ?>
									<input type="hidden" name ="ts" value="<?php echo $personalInfo->transport ;?>"  >
									
									<input type="text"  value="<?php  if($personalInfo->transport==1){ echo "YES";}else{ echo "NO" ;} ;?>" readonly >
										
									<?php } else{?>
									<select class="form-control text-uppercase"  name="ts" id="ts">
											<option value="">SELECT</option>
											<option value="1" <?php if($personalInfo->transport==1){echo 'selected="selected"';}?>>YES</option>
											<option value="0" <?php if($personalInfo->transport==0){echo 'selected="selected"';}?>>NO</option>
										</select>
										<?php }?> 
										</div>
							</div>
							<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Aadhar Number <span class="symbol"></span>
										</label>
										<input type="text"  class="form-control" data-type="adhaar-number" maxLength="14" value ="<?php echo $personalInfo->aadhar_number;?>" name="aadhar_number">
									</div>
								</div>
						</div>
					</div>
					<div class="col-md-6">
							<div class="row" id ="jsdiv">
							<div class="col-md-12" >
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Vehicle Name <span class="symbol"></span>
											</label>
											<select class="form-control text-uppercase"  name="vt" id="vt" >
											<option value="">SELECT VEHICLE</option>
											<?php
											$this->db->distinct();
											$this->db->where("school_code",$this->session->userdata("school_code"));
										
											$rts = $this->db->get("transport");
											if($rts->num_rows()>0){
											foreach($rts->result() as $row):?>

											<option value="<?php echo $row->id;?>" <?php if($personalInfo->v_id == $row->id){echo 'selected="selected"';} ?>><?php echo $row->vehicle_name ."[". $row->vehicle_numnber. "]";?></option>
										<?php endforeach; }?></select></div>
									</div>
										<?php $this->db->where('v_id',$personalInfo->v_id);
									     	$this->db->where('id',$personalInfo->vehicle_pickup);
											$amount=$this->db->get('transport_root_amount');
											?>
								 	 <div class="col-md-4">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Pickup Points  <span class="symbol"></span>
											</label>

										<select class="form-control text-uppercase"  name="pickup" id="pickup" >
										<option value="<?php echo $personalInfo->vehicle_pickup;?>" ><?php if($amount->num_rows()>0){echo $amount->row()->pickup_points;}else{echo "N/A";}?></option>

										</select>
										</div>
									</div> 
									 <div class="col-md-4">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Amount <span class="symbol required"></span>
											</label>
										
										
	                                <input type="text" value="<?php if($amount->num_rows()>0){ echo $amount->row()->transport_fee;}else{echo "N/A";} ?>" class="form-control" id="pickupAmount" name="pickupAmount" />
										
										</div>
									</div>

								</div>
							</div>
						</div>


<!-- --------------------------------------------------------------------------------------------------------------------- -->

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Category <span class="symbol"></span>
									</label>
									<select class="form-control text-uppercase" id="category" name="category" >
										<option value="" <?php if("N/A" == $personalInfo->category): echo 'selected="selected"'; endif; ?>>N/A</option>
										<option value="GEN" <?php if("GEN" == $personalInfo->category): echo 'selected="selected"'; endif; ?>>GEN</option>
										<option value="OBC" <?php if("OBC" == $personalInfo->category): echo 'selected="selected"'; endif; ?>>OBC</option>
										<option value="SC" <?php if("SC" == $personalInfo->category): echo 'selected="selected"'; endif; ?>>SC</option>
										<option value="ST" <?php if("ST" == $personalInfo->category): echo 'selected="selected"'; endif; ?>>ST</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Religion <span class="symbol"></span>
									</label>
									<select class="form-control text-uppercase" id="religion" name="religion" >
										<option value="" <?php if("N/A" == $personalInfo->religion): echo 'selected="selected"'; endif; ?>>N/A</option>
										<option value="HINDUISM" <?php if("HINDUISM" == $personalInfo->religion): echo 'selected="selected"'; endif; ?>>HINDUISM</option>
										<option value="ISLAM" <?php if("ISLAM" == $personalInfo->religion): echo 'selected="selected"'; endif; ?>>ISLAM</option>
										<option value="CHRISTIANITY" <?php if("CHRISTIANITY" == $personalInfo->religion): echo 'selected="selected"'; endif; ?>>CHRISTIANITY</option>
										<option value="BUDDISM" <?php if("BUDDISM" == $personalInfo->religion): echo 'selected="selected"'; endif; ?>>BUDDISM</option>
										<option value="JAINISM" <?php if("JAINISM" == $personalInfo->religion): echo 'selected="selected"'; endif; ?>>JAINISM</option>
										<option value="OTHER" <?php if("OTHER" == $personalInfo->religion): echo 'selected="selected"'; endif; ?>>OTHER</option>
									</select>

								</div>
							</div>
						</div>
					</div>
						<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Address <span class="symbol required"></span>
									</label>
									<input type="text" value="<?php echo $personalInfo->address1; ?>" class="form-control text-uppercase" id="addLine1" name="addLine1" />
								</div>
							</div>
							 <div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Area <span class="symbol"></span>
									</label>
									<input type="text" value="<?php echo $personalInfo->area; ?>" class="form-control text-uppercase" id="addLine2" name="addLine2" />
								</div>
							</div> 
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										City <span class="symbol required"></span>
									</label>
									<input type="text" value="<?php echo $personalInfo->city; ?>" class="form-control text-uppercase" id="city" name="city" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										State <span class="symbol required"></span>
									</label>
									<input type="text" value="<?php echo $personalInfo->state; ?>" class="form-control text-uppercase" id="state" name="state">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Pin Code <span class="symbol required"></span>
									</label>
									<input type="text" value="<?php echo $personalInfo->pin_code; ?>" class="form-control text-uppercase" id="pinCode" name="pinCode">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Country <span class="symbol"></span>
									</label>
									<input type="text" value="<?php echo $personalInfo->country; ?>" class="form-control text-uppercase" id="country" name="country">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<!-- <div class="col-md-6">
								<div class="form-group">
									<label class="control-label">
										Phone Number <span class="symbol"></span>
									</label>
									<input type="text" value="<?php //echo $personalInfo->phone; ?>" class="form-control" id="phonenumbar" name="phonenumbar">
								</div>
							</div> -->
					
						</div>
					</div>
												


					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										E-mail Address <span id="stuemail" style="color:red" class="symbol"></span>
									</label>
									<input type="email" value="<?php echo $personalInfo->email; ?>" class="form-control" id="email" name="emailAddress" onkeyup="checkEmail('email','stuemail')" >
								</div>
							</div>
							<div class="col-md-6">
										<div class="form-group text-uppercase">
											<label class="control-label col-md-12 text-bold">
												Status
											</label>
											<label class="radio-inline text-uppercase">
												<input type="radio" value="1" name = "status" id="status" class="green" <?php if ($personalInfo->status == "1") { echo 'checked="checked"';	}?> >
												Active
											</label>
											<label class="radio-inline text-uppercase">
												<input type="radio" value="0" name = "status" id="status1" class="red" <?php if ($personalInfo->status == "0") { echo 'checked="checked"';	}?> >
												Inactive
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
							<div class="row">
							
								<div class="col-md-6">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Mobile Number <span class="symbol required"></span>
									</label>
									<input type="text" value="<?php echo $personalInfo->mobile; ?>" class="form-control" id="mobileNumber" name="mobileNumber">
								</div>
							</div>
								<div class="col-md-6">
						<div class="form-group">
											<label class="control-label text-uppercase">
												Discount Type <span class="symbol required"></span>
											</label>
											<select class="form-control text-uppercase" id="discount" name="discount" required ="required">
												<option> SELECT DISCOUNT TYPE</option>
												<?php
												$sub = $this->db->query("SELECT * FROM discounttable WHERE school_code='$school_code'")->result();
												foreach($sub as $row):
													if(strlen($row->discount_head)<3){
														$this->db->where('id',$row->discount_head);
														$head=$this->db->get('discount_head')->row();
														?><option value="<?php echo $head->id;?>" <?php if($head->id==$personalInfo->discount_id){echo 'selected="selected"';}?> ><?php echo $head->disc_head; ?></option>
														<?php 
													}else{
														//$head=$row->discount_head;
														?>
														<!-- <option value="<?php echo $row->id;?>"><?php echo $row->discount_head; ?></option> -->
												
										<option value="<?php echo $row->id ;?>" <?php if($row->id==$personalInfo->discount_id){echo 'selected="selected"';}?> ><?php echo $row->discount_head;?></option>
										<?php 
													}?><?php	endforeach;
												?>
											</select>
										</div>
										</div>

						</div>
					</div>
					<div class="row">
<div class="col-md-3">
	<div class="form-group text-uppercase" id="disc_div1">
		<label class="control-label ">
			Teacher/Student Id1 <span class="symbol required"></span>
		</label>
		<input type="text" value="<?php echo $personalInfo->teacher_studentid1; ?>" class="form-control text-uppercase" id="id1" name="id1"/>
	</div>
</div>

<div class="col-md-3">
	<div class="form-group text-uppercase" id="disc_div2">
		<label class="control-label">
		Teacher/Student Id2 <span id="error" Style="color:red;" class="symbol required"></span>
		</label>
		<input type="text" value="<?php echo $personalInfo->teacher_studentid2; ?>" class="form-control text-uppercase" id="id2" name="id2"/>
	</div>
</div>

<div class="col-md-3">
	<div class="form-group text-uppercase" id="disc_div3">
		<label class="control-label ">
		Teacher/Student Id3 <span class="symbol required"></span>
		</label>
		<input type="text" value="<?php echo $personalInfo->teacher_studentid3; ?>" class="form-control text-uppercase" id="id3" name="id3"/>
	</div>
</div>

<div class="col-md-3">
	<div class="form-group text-uppercase" id="disc_div4">
		<label class="control-label ">
		Teacher/Student Id4 <span class="symbol required"></span>
		</label>
		<input type="text" value="<?php echo $personalInfo->teacher_studentid4; ?>" class="form-control text-uppercase" id="id4" name="id4"/>
	</div>
</div>
</div>
						
					<div class="col-md-12">
								<div class="row">
								    	<div class="col-md-3">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Height& Weight <span class="symbol"></span>
									</label>
									<input type="text" value="<?php echo $personalInfo->height; ?>" class="form-control" id="stuweight" name="stuheight">
								</div>
							</div>
								<?php $school_code=$this->session->userdata('school_code');?>
								
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Stream <span class="symbol required"></span>
											</label>
											
										<?php if($this->session->userdata("login_type")=="1"){ ?>
												<?php
												$sub = $this->db->query("SELECT DISTINCT stream FROM class_info WHERE school_code='$school_code'");
												if($sub->num_rows()>0){
												foreach($sub->result() as $row):
												$this->db->where("id",$row->stream);
												$sname = $this->db->get("stream")->row();
												echo '<input type="hidden" id="stream" name ="stream" value=" '. $row->stream  .'"  >';
												endforeach;}
												?>
												<input type="text" class="form-control" value="<?php  echo $sname->stream ;?>" readonly >
												
											<!--<select class="form-control text-uppercase" id="stream" name="stream" readonly>
												<option> SELECT STREAM</option>
												<?php
												$sub = $this->db->query("SELECT DISTINCT stream FROM class_info WHERE school_code='$school_code'");
												if($sub->num_rows()>0){
												foreach($sub->result() as $row):
												$this->db->where("id",$row->stream);
												$sname = $this->db->get("stream")->row();
												echo '<option value="'.$row->stream.'">'.$sname->stream.'</option>';
												endforeach;}
												?>
											</select>-->
										
									<?php } else{?>
									<select class="form-control text-uppercase" id="stream" name="stream" required>
												<option> SELECT STREAM</option>
												<?php
												$sub = $this->db->query("SELECT DISTINCT stream FROM class_info WHERE school_code='$school_code'");
												if($sub->num_rows()>0){
												foreach($sub->result() as $row):
												$this->db->where("id",$row->stream);
												$sname = $this->db->get("stream")->row(); ?>
												<option value="<?php echo $row->stream; ?>" <?php if($row->stream){echo 'selected="selected"';} ?> ><?php echo $sname->stream; ?></option>
												<?php
												//echo '<option value="'.$row->stream.'">'.$sname->stream.'</option>';
												endforeach;}
												?>
											</select>
										<?php }?> 
											
											
											
										</div>
									</div>

								
									<?php $this->db->where("id",$personalInfo->class_id);
								$clname=	$this->db->get("class_info");
                                if($clname->num_rows()>0){
                                $clfg  = $clname->row();
                                
                                $this->db->where("id",$clfg->section);
                                $section = $this->db->get("class_section")->row()->section;?>
                                	<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Section <span id="error" Style="color:red;" ></span>
											</label>            
											<?php if($this->session->userdata("login_type")=="1"){ ?>
											<input type="hidden" id="section1" name ="section" value="<?php  echo $clfg->section ;?>"  >
											<input type="text" class="form-control" value="<?php  echo $section ;?>" readonly >
											<!--<select class="form-control text-uppercase" id="section1" name="section" readonly>
										     <?php	echo '<option value="'.$clfg->section.'">'.$section.'</option>';?>
										    </select>-->
											<?php }else{ ?>
											<select class="form-control text-uppercase" id="section1" name="section" required>
										     <?php	echo '<option value="'.$clfg->section.'">'.$section.'</option>';?>
										    </select>
											<?php } ?>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Class Of Admission <span class="symbol required"></span>
											</label>
											<?php if($this->session->userdata("login_type")=="1"){ ?>
											<input type="hidden" id="classOfAdmission1" name ="classOfAdmission" value="<?php  echo $personalInfo->class_id;?>"  >
											<input type="text" class="form-control" value="<?php  echo $clfg->class_name ;?>" readonly >
										<!--	<select class="form-control text-uppercase" id="classOfAdmission1" name="classOfAdmission" readonly>
										    <?php	echo '<option value="'.$personalInfo->class_id.'">'.$clfg->class_name.'</option>';?>
										    </select>-->
											<?php }else{ ?>
											<select class="form-control text-uppercase" id="classOfAdmission1" name="classOfAdmission" required>
										    <?php	echo '<option value="'.$personalInfo->class_id.'">'.$clfg->class_name.'</option>';?>
										    </select>
										    <?php } ?>
											
										</div>
									</div>
									<?php }?>
								</div>
							</div>
	                        <div class="col-md-12">
								<div class="row">
								    	<div class="col-md-3">
								<div class="form-group">
									<label class="control-label text-uppercase">
										Password <span class="symbol"></span>
									</label>
									<input type="text" value="<?php echo $personalInfo->password; ?>" class="form-control" id="password" name="password">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label text-uppercase">
										House/Team <span class="symbol"></span>
									</label>
									<select class="form-control" id="house" name="house" >
									<option value ="">Select House</option>
									<?php 
									$this->db->where("school_code",$this->session->userdata("school_code"));
												$get_house=$this->db->get("house");
												if($get_house->num_rows()>0){
												foreach($get_house->result() as $ty):
												?>
									<option value="<?php echo $ty->id;?>" <?php if($ty->id==$personalInfo->house_id){echo 'selected="selected"';}?> ><?php echo $ty->house_name; ?></option>
								<?php endforeach;}?>
								</select>
								</div>
							</div>
							</div>
							</div>
							
							
									
				</div>
				
					<div class="row">
						<div class="col-md-8 text-uppercase">
							<p>
								click for UPDATE Profile.
							</p>
						</div>
						<div class="col-md-4 text-uppercase">
							<button class="btn btn-yellow btn-block text-uppercase" id="editProfile">
								Update Profile <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</form>
<!-- ------------------------------ Parent Profile -------------------------------------------- -->
<form action="<?php echo base_url(); ?>index.php/studentController/updateParentInfo" method="post" id="form">
<div class="row">
	<div class="col-sm-12">
		<!-- start: FORM WIZARD PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-blue">
				<h4 class="panel-title text-uppercase">Parents  <span class="text-bold text-uppercase">Information</span></h4>
				<div class="panel-tools">
					<div class="dropdown">
						<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
							<i class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu dropdown-light pull-right text-uppercase" role="menu">
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
				</div>
			</div> <!-- End Heading panel -->
			<div class="panel-body">
			<!-- --------------------------------------------Test Form Start ---------------------------------------- -->
					<div class="row">
						<div class="col-md-12">
							<div class="errorHandler alert alert-danger no-display">
								<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
							</div>
							<div class="successHandler alert alert-success no-display">
								<i class="fa fa-ok"></i> Your form validation is successful!
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Father Name <span class="symbol required"></span>
										</label>
										<input type="hidden" name="c_id" value="<?php echo $personalInfo->username; ?>">
										<input type="text" value="<?php echo $gurdianInfo->father_full_name; ?>" class="form-control text-uppercase" id="fatherName" name="fatherName" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Mother Name <span class="symbol required"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->mother_full_name; ?>" class="form-control text-uppercase" id="motherName" name="motherName" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Caretaker Name <span class="symbol"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->caretaker_name; ?>" class="form-control text-uppercase" id="guardianName" name="guardianName" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Caretaker Relation <span class="symbol"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->caretaker_relation; ?>" class="form-control text-uppercase" id="guardianRelation" name="guardianRelation" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Father's Education <span class="symbol"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->father_education; ?>" class="form-control text-uppercase" id="fatherEducation" name="fatherEducation" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Mother's Education <span class="symbol"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->mother_education; ?>" class="form-control text-uppercase" id="motherEducation" name="motherEducation" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Father's Occupation <span class="symbol"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->father_occupation; ?>" class="form-control text-uppercase" id="fatherOccupation" name="fatherOccupation" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Mother's Occupation <span class="symbol"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->mother_occupation; ?>" class="form-control text-uppercase" id="motherOccupation" name="motherOccupation" />
									</div>
								</div>
								
							</div>
							<div class="row">

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Address <span class="symbol required"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->address; ?>" class="form-control text-uppercase" id="parentAddress" name="parentAddress" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Area <span class="symbol required"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->area; ?>" class="form-control text-uppercase" id="area" name="area" />
									</div>
								</div>
							</div>
						</div>

<!-- --------------------------------------------------------------------------------------------------------------------- -->

						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											city  <span class="symbol required"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->city; ?>" class="form-control text-uppercase" id="parentCity" name="parentCity" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											State <span class="symbol required"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->state; ?>" class="form-control text-uppercase" id="parentState" name="parentState" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Pin  <span class="symbol required"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->pin; ?>" class="form-control text-uppercase" id="parentPin" name="parentPin" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Country  <span class="symbol required"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->country; ?>" class="form-control text-uppercase" id="parentCountry" name="parentCountry" />
									</div>
								</div>
							</div>
							<div class="row">
							<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Father's Email Address  <span class="symbol"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->f_email; ?>" class="form-control" id="motherEmailAddress" name="motherEmailAddress" />
									</div>
								</div>
								<!-- <div class="col-md-6">
									<div class="form-group">
										<label class="control-label">
											Phone Number  <span class="symbol"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->phone; ?>" class="form-control" id="parentPhoneNumber" name="parentPhoneNumber" />
									</div>
								</div> -->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Father's Mobile Number <span class="symbol required"></span>
											<input type="checkbox" id="sameMobile" /> if same.
										</label>
										<input type="text" value="<?php echo $gurdianInfo->f_mobile; ?>" class="form-control" id="fatherMobileNumber" name="fatherMobileNumber" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Mother's Mobile Number <span class="symbol"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->m_mobile; ?>" class="form-control" id="motherMobileNumber" name="motherMobileNumber" />
									</div>
								</div>
								<!-- <div class="col-md-6">
									<div class="form-group">
										<label class="control-label">
											Father's Email Address  <span class="symbol"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->f_email; ?>" class="form-control" id="fatherEmailAddress" name="fatherEmailAddress" />
									</div>
								</div> -->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Family Annual Income  <span class="symbol"></span>
										</label>
										<input type="text" value="<?php echo $gurdianInfo->family_annual_income; ?>" class="form-control" id="familyAnnualIncome" name="familyAnnualIncome" />
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div>
								<span class="symbol required text-uppercase"></span>Required Fields
								<hr>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<p>
								By clicking Updation, you are update the your profile.
							</p>
						</div>
						<div class="col-md-4">
							<input type="submit" value="Update Gurdian Information" class="btn btn-blue btn-block  text-uppercase"/>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
</form>

					</div>
				<?php }?>
<!-- ---------------------------------------------------------------------------------------------------------------------- -->
				<div id="certificates" class="tab-pane fade <?php if($this->uri->segment(4) == 'certificate'){ echo "in active";}?>">
					<div class="panel-body">
						<ul id="Grid" class="list-unstyled">
							<li class="col-md-3 col-sm-6 col-xs-12">
								<div class="portfolio-item">
									<?php if(strlen($personalInfo->photo)>0):?>
										<a class="thumb-info" href="<?php echo base_url(); ?>assets/images/stuImage/<?php echo $personalInfo->cc;?>" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $personalInfo->cc;?>" height="200" class="img-responsive" alt="">
											<span class="thumb-info-title"> Character Certificates </span>
										</a>
									<?php else:?>
										<a class="thumb-info" href="<?php echo base_url(); ?>assets/images/stuImage/cc.png" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/cc.png" class="img-responsive" alt=" Character Certificates ">
											<span class="thumb-info-title"> Character Certificates </span>
										</a>
									<?php endif;?>
								</div>
								<div class="form-group">
									<form method="post" action="<?php echo base_url()?>index.php/studentController/uploadCc" enctype="multipart/form-data">
		                                <input type="hidden" name="c_id" value="<?php echo $personalInfo->username; ?>">
		                                <input type="hidden" name="old_cc" value="<?php echo $personalInfo->cc; ?>">
		                                Only png, jpg File less then 100 kB.
		                                <input type="file" name="cc" class="form-control input-sm" ><br/>
		                                <input id="submit" name="submit" type="submit" class="btn btn-dark-red btn-sm pull-left" value="Upload Character Certificates">
		                            </form>
								</div>
							</li>
							<li class="col-md-3 col-sm-6 col-xs-12">
								<div class="portfolio-item">
									<?php if(strlen($personalInfo->tc > 0)):?>
										<a class="thumb-info" href="<?php echo base_url(); ?>assets/images/stuImage/<?php echo $personalInfo->tc;?>" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $personalInfo->tc;?>" height="200" class="img-responsive" alt="">
											<span class="thumb-info-title"> Transfer Certificate </span>
										</a>
									<?php else:?>
										<a class="thumb-info" href="<?php echo base_url(); ?>assets/images/stuImage/tc.png" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/tc.png" class="img-responsive" alt="Transfer Certificate">
											<span class="thumb-info-title"> Transfer Certificate </span>
										</a>
									<?php endif;?>
								</div>
								<div class="form-group">
									<form method="post" action="<?php echo base_url()?>index.php/studentController/uploadTc" enctype="multipart/form-data">
		                                <input type="hidden" name="c_id" value="<?php echo $personalInfo->username; ?>">
		                                <input type="hidden" name="old_tc" value="<?php echo $personalInfo->tc; ?>">
		                                Only png, jpg File less then 100 kB.
		                                <input type="file" name="tc" class="form-control input-sm" ><br/>
		                                <input id="submit" name="submit" type="submit" class="btn btn-primary btn-sm pull-left" value="Upload Transfer Certificates">
		                            </form>
								</div>
							</li>
							<li class="col-md-3 col-sm-6 col-xs-12">
								<div class="portfolio-item">
									<?php if(strlen($personalInfo->castCertificate > 0)):?>
										<a class="thumb-info" href="<?php echo base_url(); ?>assets/images/stuImage/<?php echo $personalInfo->castCertificate;?>" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $personalInfo->castCertificate;?>" height="200" class="img-responsive" alt="Cast Certificate">
											<span class="thumb-info-title"> Cast Certificate </span>
										</a>
									<?php else:?>
										<a class="thumb-info" href="<?php echo base_url(); ?>assets/images/stuImage/castCertificate.png" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/castCertificate.png" class="img-responsive" alt="">
											<span class="thumb-info-title"> Cast Certificate </span>
										</a>
									<?php endif;?>
								</div>
								<div class="form-group">
									<form method="post" action="<?php echo base_url()?>index.php/studentController/uploadCastCertificate" enctype="multipart/form-data">
		                                <input type="hidden" name="c_id" value="<?php echo $personalInfo->username; ?>">
		                                <input type="hidden" name="old_castCertificate" value="<?php echo $personalInfo->castCertificate; ?>">
		                                Only png, jpg File less then 100 kB.
		                                <input type="file" name="castCertificate" class="form-control input-sm" ><br/>
		                                <input id="submit" name="submit" type="submit" class="btn btn-dark-orange btn-sm pull-left" value="Upload Cast Certificates">
		                            </form>
								</div>
							</li>
							<li class="col-md-3 col-sm-6 col-xs-12">
								<div class="portfolio-item">
									<?php if(strlen($personalInfo->domicileCertificate > 0)):?>
										<a class="thumb-info" href="<?php echo base_url(); ?>assets/images/stuImage/<?php echo $personalInfo->domicileCertificate;?>" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $personalInfo->domicileCertificate;?>" height="200" class="img-responsive" alt="">
											<span class="thumb-info-title"> Domicile Certificate </span>
										</a>
									<?php else:?>
										<a class="thumb-info" href="<?php echo base_url(); ?>assets/images/stuImage/domicileCertificate.png" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/domicileCertificate.png" class="img-responsive" alt="">
											<span class="thumb-info-title"> Domicile Certificate </span>
										</a>
									<?php endif;?>
								</div>
								<div class="form-group">
									<form method="post" action="<?php echo base_url()?>index.php/studentController/uploadDomicileCertificate" enctype="multipart/form-data">
		                                <input type="hidden" name="c_id" value="<?php echo $personalInfo->username; ?>">
		                                <input type="hidden" name="old_domicileCertificate" value="<?php echo $personalInfo->domicileCertificate; ?>">
		                                Only png, jpg File less then 100 kB.
		                                <input type="file" name="domicileCertificate" class="form-control input-sm" ><br/>
		                                <input id="submit" name="submit" type="submit" class="btn btn-success btn-sm pull-left" value="Upload Domicile Certificates">
		                            </form>
								</div>
							</li>
							<li class="col-md-3 col-sm-6 col-xs-12">
								<div class="portfolio-item">
									<?php if(strlen($personalInfo->previousMarkSheet > 0)):?>
										<a class="thumb-info" href="<?php echo base_url(); ?>assets/images/stuImage/<?php echo $personalInfo->previousMarkSheet;?>" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $personalInfo->previousMarkSheet;?>" height="200" class="img-responsive" alt="">
											<span class="thumb-info-title"> Previous Marksheet </span>
										</a>
									<?php else:?>
										<a class="thumb-info" href="<?php echo base_url(); ?>assets/images/stuImage/previousMarkSheet.png" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/previousMarkSheet.png" class="img-responsive" alt="">
											<span class="thumb-info-title"> Previous Marksheet </span>
										</a>
									<?php endif;?>
								</div>
								<div class="form-group">
									<form method="post" action="<?php echo base_url()?>index.php/studentController/uploadPreviousMarkSheet" enctype="multipart/form-data">
		                                <input type="hidden" name="c_id" value="<?php echo $personalInfo->username; ?>">
		                                <input type="hidden" name="old_previousMarkSheet" value="<?php echo $personalInfo->previousMarkSheet; ?>">
		                                Only png, jpg File less then 100 kB.
		                                <input type="file" name="previousMarkSheet" class="form-control input-sm" ><br/>
		                                <input id="submit" name="submit" type="submit" class="btn btn-dark-grey btn-sm pull-left" value="Upload Previous Certificates">
		                            </form>
								</div>
							</li>
							<li class="gap"></li>
							<!-- "gap" elements fill in the gaps in justified grid -->
						</ul>
					</div> <!-- End gallery div -->
				</div>
				<!--
				<div id="subject_area" class="tab-pane fade <?php if($this->uri->segment(4) == 'Subject'){ echo "in active";}?>">
					<div class="panel-body">
						<form action="<?php echo base_url(); ?>index.php/studentController/updateStuInfo" method="post" id="form">
						<div class="row">
							<div class="col-sm-12">
								<!-- start: FORM WIZARD PANEL
								<div class="panel panel-white">
									<div class="panel-heading panel-yellow">
										<h4 class="panel-title">Student  <span class="text-bold">Information</span></h4>
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
										</div>
									</div> <!-- End Heading panel
									<div class="panel-body">
									<!-- --------------------------------------------Test Form Start ----------------------------------------
										<div class="row">
										<input type="hidden" name="c_id" value="<?php //echo $personalInfo->username; ?>">
										<?php// $subjectId = $subjectList->num_rows(); ?>
										<?php //for($i = 1; $i<=$subjectId; $i++):?>
											<div class="col-md-3">
												<div class="form-group">
													<label class="control-label">
														Subject <?php// echo $i; ?> <span class="symbol required"></span>
													</label>
													<select class="form-control" id="stuSubject<?php echo $i; ?>" name="stuSubject">
														<option value="">-Select Subject-</option>
														<?php //$j=1; foreach($subjectList->result() as $subject): ?>
														<option value="<?php// echo $subject->subject; ?>" id="subId<?php echo $i.$j; ?>">
															<?php //echo $subject->subject; ?>
														</option>
														<?php //$j++; endforeach;?>
													</select>
												</div>
											</div>
										<?php// endfor; ?>

											<div class="row">
												<div class="col-md-8">
													<p>
														click for UPDATE Profile.
													</p>
												</div>
												<div class="col-md-4">
													<button class="btn btn-yellow btn-block" id="editProfile">
														Update <i class="fa fa-arrow-circle-right"></i>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						</form>
					</div>
				</div>
				-->
				
				<div id="attendance_report" class='tab-pane fade <?php if($this->uri->segment(4) == 'Attendance'){ echo "in active";}?>'>
						<div class="panel-body">
							<div class="col-sm-12">
									<div class="form-group col-sm-6">
										<label class="col-sm-5 control-label" for="form-field-20">
											Start Date (yyyy-mm-dd)<span class="symbol required"></span>
										</label>
										<div class="col-sm-7">
											<input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years" id="sdate" name="startdate" class="form-control date-picker">
										</div>
									</div><?php $stu_id =$this->uri->segment(3);?>
									<input type = "hidden" value = "<?php echo $stu_id;?>" name = "stuid" id = "stuid"/>
									<div class="form-group col-sm-6">
										<label class="col-sm-5 control-label" for="form-field-20">
											End Date (yyyy-mm-dd)<span class="symbol required"></span>
										</label>
										<div class="col-sm-7">
											<input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years" id="edate" name="enddate" class="form-control date-picker">
										</div>
									</div>
							</div>
						<div class="table-responsive" id="rahul">
					</div>
				</div>
			</div>
	<!---------------------------------------Fees Reports------------------------------------------------------->		
	<div id="fee_report" class="tab-pane fade <?php if($this->uri->segment(4) == 'Fee Report'){ echo "in active";}?>">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-12">
						<!-- start: RESPONSIVE TABLE PANEL -->
					<div class="panel panel-white">
						<div class="panel-body">
							<div class="form-group">
								<div class="col-sm-12">
								<br/><br/>
							<div class="table-responsive">

								<table class="table table-striped table-hover center table-responsive" id="f_tb">
												<thead>
												<tr class="text-center" style="background-color:#1ba593; color:white;">
												<th class="text-center">S No.</th>
												<th class="text-center">Student Id</th>
												
												<th class="text-center">Total Fees</th>
												<th class="text-center">Deposite Month</th>
												<th class="text-center">Payment Mode </th>
                                             
												<th class="text-center">Paid Amount</th>
												<th class="text-center">Pending Amount</th>
												   <th class="text-center">Deposite Date</th>
													<th class="text-center">Invoice Number</th>
												<th class="text-center">Activity</th>
												<!-- <th>Activity</th> -->
												</tr>
											</thead>
											<tbody>
											<?php 
												$stuid=$this->uri->segment(3);
												$this->db->where("id",$stuid);
											//	$this->db->where("username",$this->session->userdata("username"));
												$id=$this->db->get("student_info")->row();
												// this is for getting school_code 
										     	$cid=$id->class_id;
										    	$this->db->where("id",$cid);
												$dt1=$this->db->get("class_info")->row();
												  $scd=$dt1->school_code; 
												  //echo $scd;
												  
												$this->db->where("student_id",$stuid);
												$dt=$this->db->get("fee_deposit")->result();
												
												  ?>
												  	<?php
												  	
												  	
												  	$this->db->where('school_code',$scd);
                                    				 $applymonth=$this->db->get("late_fees")->row()->apply_method;
                                    				?>
											
												<?php $v=1; foreach($dt as $row):
												?>
												 <?php if($v%2==0){$rowcss="warning";}else{$rowcss ="danger";}?>
	                             
												<tr class="<?php echo $rowcss;?> text-uppercase">
												<td class="text-center"><?php echo $v; ?> </td>
													<td class="text-center"><?php echo $id->username;?></td>
													
													<td class="text-center"><?php $dte= $row->total; echo $dte;?></td>
													
													<td class="text-center"><?php echo $row->deposite_month;?></td>
													<td class="text-center"> <?php if($row->payment_mode==1){ echo "Cash";} elseif($row->payment_mode==2){ echo "Online";}?></td>
												 	<!-- <td class="text-center"><?php echo $row->late;?></td>  -->
												 	<td class="text-center"><?php $pd= $row->paid; echo $pd?></td> 
												 	<td class="text-center"><?php $cr=$dte-$pd; echo $cr;?></td> 
												 		<td class="text-center"><?php  echo $row->diposit_date;?></td> 
												 		<td class="text-center"><?php  echo $row->invoice_no;?></td> 
													 <td>
													<?php //$fsdt=$this->uri->segment(4);
													$this->db->where('school_code',$scd);
													$fsdt=$this->db->get('general_settings')->row()->fsd_id;
													if($row->invoice_no){
														if($row->payment_mode=='Due Print'){?>
															<a href="<?php echo base_url()?>index.php/invoiceController/printDueFee/<?php echo $row->invoice_no;?>/<?php echo $row->student_id;?>/<?php echo $fsdt;?>/<?php if($v == 1){echo "true"; } ?>" class="btn btn-blue">
															Print Slip
														</a>
													<?php	}else{?>
														<a href="<?php echo base_url()?>index.php/invoiceController/fee/<?php echo $row->invoice_no;?>/<?php echo $row->student_id;?>/<?php echo $fsdt;?>/<?php if($v == 1){echo "true"; } ?>" class="btn btn-blue">
															Print Slip
														</a>
														<?php }?>
															<?php if($this->session->userdata('login_type') == 'admin'){ ?>
														<a href="<?php echo base_url()?>index.php/feeControllers/deleteFee/<?php echo $row->invoice_no;?>/<?php echo $row->student_id;?>/<?php if($v == 1){echo "true"; } ?>" class="btn btn-warning">
															Delete Fee
														</a>
														<?php }}?>
													</td>
												</tr>	<?php $v++; endforeach; ?>
												
													</tbody>
												</table>

	</div>
</div>
	</div><!-- end: panel Body -->
	</div><!-- end: panel panel-white -->
	</div><!-- end: MAIN PANEL COL-SM-12 -->
</div><!-- end: PAGE ROW-->
</div>
</div>
</div>

<?php $stu_id =$this->uri->segment(3);?>
<div id="print_report" class="tab-pane fade <?php if($this->uri->segment(4) == 'Print Profile'){ echo "in active";}?>">
	<div class="panel-body">
		<iframe src="<?php echo base_url(); ?>index.php/invoiceController/printProfile/<?php echo $stu_id; ?>" width="100%" height="900px" id="iframe1" style="border:50px;" onload="autoResize()"></iframe>


	</div> 
</div>
<!-- Sale Info Code -->
<div id="Purchase_report" class="tab-pane fade <?php if($this->uri->segment(4) == 'Purchase Report'){ echo "in active";}?>">
					<div class="panel-body">
					 <?php 	 
					 $school_code = $this->session->userdata("school_code");
			         $this->db->where("id",$stu_id);
		            //$this->db->where("status",1);
		            $stunameid=$this->db->get("student_info")->row();
					 
					//$dt= $this->db->get("student_info")->row();
                    $fsd= $stunameid->fsd;
                    $id= $stunameid->id;
                    $this->db->where("id",$fsd);
                    $dt1= $this->db->get("fsd")->row();
                    $school_code=$dt1->school_code;
					$this->db->where("school_code",$school_code);
					$this->db->where("valid_id",$id);
			   				 $row = $this->db->get("sale_info"); ?> 
			    		<table class="table table-striped table-hover" id="sample-table-2"> 
			    				<thead><tr class='text-uppercase'>
			    				<th>S.no</th>
			    				<th>Item No.</th>
			    				<th>Purchase Date</th>
			    				<th>Balance</th>
			    				<th>total Paid</th>
			    				<th>Bill No.</th>
			    				</tr>
			    			</thead>
			    			<tbody>	
			    		<!-- <?php		//$i=1; 	
			    		//foreach($row->result() as $rows):?> -->
			
			    				<!-- <tr>
			    				<td> <?php //echo $i;?> </td>
			    				<td> <?php //echo $rows->item_no;?> </td>
			    				<td> <?php //echo $rows->date;?> </td>
			    				<td> <?php //echo $rows->balance;?> </td>
			    				<td> <?php //echo $rows->paid;?> </td>
			    				<td> <?php //echo $rows->bill_no;?> </td>
			    				</tr>
			    				<?php //$i++; 
			    				//endforeach; ?> -->
			    			</tbody>	
			    		</table>
					</div>
				</div>
		</div>
		</div>
		<?php
		endif;
		?>
	</div>
	</div>



	 <?php
	if($this->uri->segment(5) == "yes"){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$val = $this->db->get("sms_setting")->row();
		if($val->count1 == "2"):
				$msg = "Hi ".$personalInfo->name.". Your admission is confirmed with us. Your login id : ".$personalInfo->username." and password : ".$personalInfo->password.". For more information logon to our website : ".$val->web_url;
		?>
			<iframe height="0" width="0" frameBorder="0" src="http://sms1.hwebs.in/api/sendmsg.php?user=<?php echo $val->uname; ?>&pass=<?php echo $val->password; ?>&sender=<?php echo $val->sender_id; ?>&phone=<?php echo $personalInfo->mobile; ?>&text=<?php echo $msg; ?>&priority=ndnd&stype=normal" ></iframe>
			        <?php
			        $count1 = array("count1"=>'1');
			        $this->db->where("school_code",$this->session->userdata("school_code"));
			        $this->db->update("sms_setting",$count1);
		endif;
	}

	?>