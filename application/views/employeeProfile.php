<div class="row">
	<div class="col-sm-12">
	 <!--<div class="padding-20 core-content">-->
  <!--       				<a href="<?php //echo base_url(); ?>index.php/login/addemployee">-->
  <!--                <button class="btn btn-dark-purple">Add Another New Employee<i class="fa fa-arrow-circle-right"></i></button>-->
  <!--                  </a>-->
  <!--                  </div>-->
		<?php 
			if(isset($profile)):
				$personalInfo = $profile->row();
				$id=$personalInfo->id;
		?>
		
		<div class="tabbable">
			<ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
				<li <?php if(strlen($this->uri->segment(4)) == 0){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#panel_overview">
						Profile
					</a>
				</li>
				<li <?php if($this->uri->segment(4) == 'updateInfo'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#panel_edit_account">
						Edit Profile
					</a>
				</li>
				<li <?php if($this->uri->segment(4) == 'certificate'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#certificates">
						Certificates
					</a>
				</li>
				<li <?php if($this->uri->segment(4) == 'Attendance'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#attendance_report">
						Attendance Report
					</a>
				</li>
				<li <?php if($this->uri->segment(4) == 'Salary'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#salary_report">
						Salary Report
					</a>
				</li>
				<li <?php if($this->uri->segment(4) == 'Print Profile'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#print_report">
					Print Profile
					</a>
				</li>			
			</ul>
			<div class="tab-content">
				<div id="panel_overview" class="tab-pane fade <?php if(strlen($this->uri->segment(4)) <= 0){ echo "in active";}?>">
					<div class="row text-uppercase">
						<div class="col-sm-5 col-md-4">
							<div class="user-left">
								<div class="center">
									<h4><?php echo ucwords($personalInfo->name) ; ?></h4>
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<?php if($personalInfo->status==0){?>
											<div style="width: 140px; height: 150px; border: 1px solid #ff0026; border-radius: 50%;">								
											<?php }else{ ?>
											<div style="width: 140px; height: 150px; border: 1px solid #00ff40; border-radius: 50%">
											<?php }?>
											<?php if(strlen($personalInfo->photo > 0)){?>
												<img  class="img-circle" height="148" width="140" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $personalInfo->photo;?>" />
											
												<?php } else{ if($personalInfo->gender == 1){?>
													<img alt="<?php echo $personalInfo->name;?>" class="img-circle" height="148" width="140" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empMale.png" />	
												
												<?php }else{?>
													<img alt="<?php echo $personalInfo->name;?>" class="img-circle" height="148" width="140" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empFemale.png" />	
												
											<?php }}?>
										</div>
									</div>
								</div>
								<table class="table table-condensed table-hover">
									<thead>
										<tr>
											<th colspan="3">Professional information</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Join Date</td>
											<td>
												<?php echo date("d-M-Y", strtotime($personalInfo->join_date)); ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Job Category</td>
											<td>
											    <?php if($personalInfo->job_category==1){ echo "Accountant";}elseif($personalInfo->job_category==2){echo "Employee";}elseif($personalInfo->job_category==3){echo "Teacher";}else{echo "Principal";} ?>
											    <!--<?php //echo $personalInfo->job_category; ?>-->
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										
										<tr>
											<td>Qualification</td>
											<td>
											    <?php if(strlen($personalInfo->qualification) > 0) {echo strtoupper($personalInfo->qualification); }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Experiance</td>
											<td>
											    <?php if(strlen($personalInfo->experiance) > 1) {echo $personalInfo->experiance; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Login ID</td>
											<td>
												<?php if(strlen($personalInfo->username) > 1) {echo $personalInfo->username; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											
										</tr>
										<tr>
											<td>Password</td>
											<td>
												<?php if(strlen($personalInfo->password) > 1) {echo $personalInfo->password; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
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
										<tr>
											<th colspan="3">Personal Information</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Employee ID</td>
											<td>
											    <?php $var=$personalInfo->username;?>
											    <?php if(strlen($personalInfo->username) > 1) {echo $personalInfo->username; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											
										</tr>
										<tr>
											<td>Name</td>
											<td>
												<?php if(strlen($personalInfo->name) > 0) {echo strtoupper($personalInfo->name); }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Date Of Birth</td>
											<td>
											    <?php if(strlen($personalInfo->name) > 0) {echo date("d-M-Y", strtotime($personalInfo->dob)); }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Gender</td>
											<td>
											    <?php if (strlen ($personalInfo->gender==1)){echo "Male";}elseif(strlen ($personalInfo->gender==0)){echo "Female";}else echo '<span style="color:#ff9999">N/A</span>'; ?>
										    </td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Category</td>
											<td>
											    <?php if(strlen($personalInfo->category) > 0) {echo $personalInfo->category; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Status</td>
											<td>
											    <?php if(($personalInfo->status)== 1){ echo '<span style="color:green">Active</span>'; }elseif(($personalInfo->status)== 0){ echo '<span style="color:red">Inactive</span>'; }else '<span style="color:red">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
									</tbody>
								</table>
								<table class="table table-condensed table-hover">
									<thead>
										<tr>
											<th colspan="3">Contact information</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Address</td>
											<td>
												<?php if(strlen($personalInfo->address) > 0) {echo $personalInfo->address; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>City / State / PIN</td>
											<td>
												<?php echo $personalInfo->city." / ".$personalInfo->state." / ".$personalInfo->pin_code; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Country</td>
											<td>
												<?php if(strlen($personalInfo->country) > 0) {echo $personalInfo->country; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<!-- <tr>
											<td>Land-line Number</td>
											<td>
												<?php //if(strlen($personalInfo->phone) <= 0){ echo "N/A"; }else{ echo $personalInfo->phone; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr> -->
										<tr>
											<td>Mobile No</td>
											<td>
												<?php if(strlen($personalInfo->mobile) > 0) {echo $personalInfo->mobile; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>E-Mail</td>
											<td>
												<?php if(strlen($personalInfo->email) > 0) {echo $personalInfo->email; }else echo '<span style="color:#ff9999">N/A</span>'; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
									</tbody>
								</table>
								<?php $this->db->where('employee_id',$personalInfo->id);
								   $bankinformation=$this->db->get('bank_account_detail');
								?>
								<table class="table table-condensed table-hover">
									<thead>
										<tr>
											<th colspan="3">Bank information</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>BANK NAME</td>
											<td>
												<?php if($bankinformation->num_rows()>0){ if(strlen($bankinformation->row()->bank_name) > 0) {echo $bankinformation->row()->bank_name; }else echo '<span style="color:#ff9999">N/A</span>';}else echo '<span style="color:#ff9999">N/A</span>' ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
											<tr>
											<td>ACCOUNT NUMBER</td>
											<td>
												<?php if($bankinformation->num_rows()>0){ if(strlen($bankinformation->row()->account_number) > 0) {echo $bankinformation->row()->account_number; }else echo '<span style="color:#ff9999">N/A</span>';}else echo '<span style="color:#ff9999">N/A</span>' ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>IFSC CODE</td>
											<td>
												<?php if($bankinformation->num_rows()>0){ if(strlen($bankinformation->row()->ifsc_code) > 0) {echo $bankinformation->row()->ifsc_code; }else echo '<span style="color:#ff9999">N/A</span>';}else echo '<span style="color:#ff9999">N/A</span>' ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>BRANCH NAME</td>
											<td>
												<?php if($bankinformation->num_rows()>0){ if(strlen($bankinformation->row()->branch_name) > 0) {echo $bankinformation->row()->branch_name; }else echo '<span style="color:#ff9999">N/A</span>';}else echo '<span style="color:#ff9999">N/A</span>' ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>BANK ADDRESS</td>
											<td>
												<?php if($bankinformation->num_rows()>0){ if(strlen($bankinformation->row()->branch_address) > 0) {echo $bankinformation->row()->branch_address; }else echo '<span style="color:#ff9999">N/A</span>';}else echo '<span style="color:#ff9999">N/A</span>' ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>PAYEE NAME</td>
											<td>
												<?php if($bankinformation->num_rows()>0){ if(strlen($bankinformation->row()->bank_payee_name) > 0) {echo $bankinformation->row()->bank_payee_name; }else echo '<span style="color:#ff9999">N/A</span>';}else echo '<span style="color:#ff9999">N/A</span>' ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
									</tbody>
								</table>
						</div>
					</div>
				</div>
				
				<div id="panel_edit_account" class="tab-pane fade <?php if($this->uri->segment(4) == 'updateInfo'){ echo "in active";}?>">
				<?php $data=$this->uri->segment(3); ?>
				<div class="row">
								<div id="streamList"></div>
									<div class="col-md-6  text-uppercase">
										<div class="form-group">
											<?php if($personalInfo->status==0){?>
											<div style="width: 140px; height: 150px; border: 1px solid #ff0026; border-radius: 50%;">								
											<?php }else{ ?>
											<div style="width: 140px; height: 150px; border: 1px solid #00ff40; border-radius: 50%">
											<?php }?>
												<?php if(strlen($personalInfo->photo > 0)):?>
													<img  class="img-circle" height="148" width="140" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $personalInfo->photo;?>" />
												<?php else:?>
													<?php if($personalInfo->gender == 1):?>
														<img alt="<?php echo $personalInfo->name;?>" class="img-circle" height="148" width="140" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empMale.png" />	
													<?php endif;?>
													<?php if($personalInfo->gender == 0):?>
														<img alt="<?php echo $personalInfo->name;?>" class="img-circle" height="148" width="140" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empFemale.png" />	
													<?php endif;?>
												<?php endif;?>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<form method="post" action="<?php echo base_url(); ?>employeeController/uploadEmployeeImage" enctype="multipart/form-data">
				                                <input type="hidden" name="c_id" value="<?php echo $personalInfo->username; ?>">
				                                <input type="hidden" name="old_img" value="<?php echo $personalInfo->photo; ?>">
				                                <input type="file" id="empImage" name="empImage" multiple  onchange="GetFileSize()" class="form-control input-sm" required=>
												<span id="fp" class="text-warning"></span><br/>
				                                <input id="submit" name="submit" type="submit" class="btn btn-primary btn-sm pull-left" value="Upload Image">
												
											</form>
										</div>
									</div>
								</div>
				<!--<form action="<?php echo base_url();?>index.php/employeeController/employeeProfile/<?php echo $data;?>" method="post">-->
						<div class="row text-uppercase">
							
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
											 Name
											</label>
											<input type="hidden" id="empId" value="<?php echo $personalInfo->username; ?>"/>
											<input type="text"    minLength="2" maxLength="25"  onkeypress="return isAplha(event)" class="form-control text-uppercase" value="<?php echo $personalInfo->name;?>" id="firstname">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Date Of Birth (mm-dd-yyyy)
											</label>
											<input type="date"  min="1950-01-01" max="2001-12-31" onchange="checkDOB()" data-date-format="yyyy-mm-dd" name="dob" id="empDob" value="<?php echo date("Y-m-d", strtotime($personalInfo->dob));?>" data-date-viewmode="years" class="form-control date-picker">
										</div>
									</div>
								</div>
								
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-12 text-bold">
												Gender
											</label>
											<label class="radio-inline">
												<input type="radio" value="1" id="gender" name ="gender" class="grey" <?php if ($personalInfo->gender == "1") { echo 'checked="checked"';	}?> >
												Male
											</label>
											<label class="radio-inline">
												<input type="radio" value="0" id="gender1" name ="gender" class="grey" <?php if ($personalInfo->gender == "0") { echo 'checked="checked"';	}?> >
												Female
											</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Category
											</label>
											<input type="text"   minLength="2" maxLength="25"  onkeypress="return isAplha(event)" class="form-control text-uppercase" value="<?php echo $personalInfo->category;?>" id="category">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Job Category
											</label>
											<select minLength="2" maxLength="10"  onkeypress="return isAplha(event)" class="form-control text-uppercase" name="job_category" id="job_category">
											    <?php //$this->db->where("id",$personalInfo->job_category);
											          $jobcat= $this->db->get('emp_category');
											          foreach($jobcat->result() as $jobcat):?>
    											    <option value="<?php echo $jobcat->id;?>" <?php if($personalInfo->job_category==$jobcat->id){echo 'selected="selected"';}?>)><?php echo $jobcat->Name;?></option>
    											    <?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Qualification
											</label>
											<input type="text"    minLength="2" maxLength="10"  onkeypress="return isAplha(event)" value="<?php echo $personalInfo->qualification;?>" class="form-control text-uppercase" id="qualification">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Experiance
											</label>
											<input type="text"  minLength="2" maxLength="10"  value="<?php echo $personalInfo->experiance;?>" class="form-control" id="experiance">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-12 text-bold">
												Status
											</label>
											<label class="radio-inline">
												<input type="radio" value="1" checked="checked" name = "status" id="status" class="green" <?php if ($personalInfo->status == "1") { echo 'checked="checked"';	}?> >
												Active
											</label>
											<label class="radio-inline">
												<input type="radio" value="0" name = "status" id="status1" class="red" <?php if ($personalInfo->status == "0") { echo 'checked="checked"';	}?> >
												Inactive
											</label>
										</div>
									</div>
								</div>
					
							</div>	
	<!--  ------------------------------------------------------------------------ -->

							<div class="col-md-6">
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												City
											</label>
											<input type="text" minLength="2" maxLength="10" onkeypress="return isAplha(event)" value="<?php echo $personalInfo->city;?>" class="form-control text-uppercase" id="city">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												State
											</label>
											<input type="text"  minLength="2" maxLength="10" onkeypress="return isAplha(event)"  value="<?php echo $personalInfo->state;?>" class="form-control text-uppercase" id="state">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Pin Code
											</label>
											<input type="text" minLength="6" maxLength="6" onkeypress="return isNumber(event)" value="<?php echo $personalInfo->pin_code;?>" class="form-control" id="pincode">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Country
											</label>
											<input type="text"   value="<?php if($personalInfo->country){echo $personalInfo->country;}else{ echo "INDIA";}?>" class="form-control text-uppercase" id="country">
										</div>
									</div>
								</div>
								<div class="row">
								<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Password
											</label>
											<input type="text" value="<?php echo $personalInfo->password;?>" class="form-control" id="password">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Mobile
											</label>
											<input type="text" minLength="10" maxLength="10" onkeypress="return isNumber(event)"  value="<?php echo $personalInfo->mobile;?>" class="form-control" id="mobile">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Email
											</label>
											<input type="email" value="<?php echo $personalInfo->email;?>" class="form-control" id="email">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Address
											</label>
											<input type="text" minLength="2" value="<?php echo $personalInfo->address;?>" class="form-control text-uppercase" id="address1">
										</div>
									</div>
								</div>
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
								<p>
									click for UPDATE Profile.
								</p>
							</div>
							
							
							<div class="col-md-4">
								<input type="submit" class="btn btn-green btn-block fa fa-arrow-circle-right" id="editProfile"
									value="Update Profile" />
								
							</div>
						</div>
						<br>
<div class="row">
	<div class="col-sm-12">
		<!-- start: FORM WIZARD PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-blue">
				<h4 class="panel-title text-uppercase">Bank  <span class="text-bold text-uppercase">Information</span></h4>
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
											<label class="control-label text-bold">
												Bank Name
											</label>
											<input type="text"  minLength="2" maxLength="25" onkeypress="return isAplha(event)"  value="<?php if($bankinformation->num_rows()>0){echo $bankinformation->row()->bank_name; }else{  }?>" class="form-control text-uppercase" id="bank">
										</div>
									</div>
									<div class="col-md-6">
									<div class="form-group">
											<label class="control-label text-bold">
												Account Number
											</label>
											<input type="text"  minLength="5" maxLength="15" onkeypress="return isNumber(event)"  value="<?php if($bankinformation->num_rows()>0){echo $bankinformation->row()->account_number; }else{  }?>" class="form-control text-uppercase" id="ac">
										</div>
									</div>	
									
								</div>
									<div class="row">
								<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Branch Address  
											</label>
											<input type="text" minLength="2" maxLength="15"  value="<?php if($bankinformation->num_rows()>0){echo $bankinformation->row()->branch_address; }else{  }?>" class="form-control text-uppercase" id="bankadd">
										</div>
									</div>
									<div class="col-md-6">
									<div class="form-group">
											<label class="control-label text-bold">
												Payee Name
											</label>
											<input type="text" minLength="2" maxLength="10" onkeypress="return isAplha(event)"  value="<?php if($bankinformation->num_rows()>0){echo $bankinformation->row()->bank_payee_name; }else{  }?>" class="form-control text-uppercase" id="payee">
										</div>
									</div>	
									
								</div>
						
							
						
						</div>

<!-- --------------------------------------------------------------------------------------------------------------------- -->

						<div class="col-md-6">
							
							<div class="row">
								<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												IFSC Code
											</label>
											<input type="text" minLength="6" maxLength="20"  value="<?php if($bankinformation->num_rows()>0){echo $bankinformation->row()->ifsc_code; }else{  }?>" class="form-control text-uppercase" id="ifsc">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Branch Name
											</label>
											<input type="text"  minLength="2" maxLength="25" onkeypress="return isAplha(event)" value="<?php if($bankinformation->num_rows()>0){echo $bankinformation->row()->branch_name; }else{  }?>" class="form-control text-uppercase" id="branchname">
										</div>
									</div>	
									
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
							<input type="submit" value="Update Bank Information" id="editbank" class="btn btn-blue btn-block"/>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
					</div>
<!-- ---------------------------------------------------------------------------------------------------------------------- -->	
				<div id="certificates" class="tab-pane fade <?php if($this->uri->segment(4) == 'certificate'){ echo "in active";}?>">
					<div class="panel-body">
						<ul id="Grid" class="list-unstyled">
							<li class="col-md-3 col-sm-6 col-xs-12">
								<div class="portfolio-item" style="width: 150px; height: 150px; border: 1px solid #00ff40; ">
									<?php if(strlen($personalInfo->qualification_img > 0)):?>
										<a href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $personalInfo->qualification_img;?>">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $personalInfo->qualification_img;?>" class="img-responsive" height="150px" width="145px" >
											<!--<span class="thumb-info-title"> Educational Certificates </span>-->
										</a>
									<?php else:?>
										<a class="thumb-info" href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/Zip-File.png" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/Zip-File.png" class="img-responsive" height="150px" width="145px" alt="Zip file">
											<!--<span class="thumb-info-title"> Educational Certificates </span>-->
										</a>
									<?php endif;?>
								</div>
								<div class="form-group">
									<form  action="<?php echo base_url()?>index.php/employeeController/uploadEmployeeCertificates" method="post" enctype="multipart/form-data">
		                                <input type="hidden" name="c_id" value="<?php echo $personalInfo->username; ?>">
		                                <input type="hidden" name="old_rar" value="<?php echo $personalInfo->qualification_img; ?>">
		                                <input type="file" id="employeeCertificates" name="employeeCertificates" onchange="GetFileSize1()" class="form-control" required="" >
										<span id="fp1" class="text-warning"></span><br/>
		                                <input  type="submit" class="btn btn-primary btn-sm pull-left" value="Upload Educational Certificates">
		                            </form>
								</div>
							</li>
							<li class="col-md-3 col-sm-6 col-xs-12">
								<div class="portfolio-item" style="width: 140px; height: 150px; border: 1px solid #00ff40;">
									<?php if(strlen($personalInfo->noc_latter > 0)):?>
										<a class="thumb-info" href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $personalInfo->noc_latter;?>" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $personalInfo->noc_latter;?>" class="img-responsive"  alt="NOC Latter">
											<!--<span class="thumb-info-title"> noc latter </span>-->
										</a>
									<?php else:?>
										<a class="thumb-info" href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/noc.png" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/noc.png" class="img-responsive" alt="NOC Latter">
											<!--<span class="thumb-info-title"> noc latter </span>-->
										</a>
									<?php endif;?>
								</div>
								<div class="form-group">
									<form method="post" action="<?php echo base_url()?>index.php/employeeController/uploadEmployeeNoc" enctype="multipart/form-data">
		                                <input type="hidden" name="c_id" value="<?php echo $personalInfo->username; ?>">
		                                <input type="hidden" name="old_img" value="<?php echo $personalInfo->noc_latter; ?>">
		                                <input type="file" id="empImage1" name="empImage1" onchange="GetFileSize2()" class="form-control input-sm" required="" >
										<span id="fp2" class="text-warning"></span> <br/>
		                                <input id="submit" name="submit" type="submit" class="btn btn-primary btn-sm pull-left" value="Upload NOC Latter">
		                            </form>
								</div>
							</li>
							<li class="col-md-3 col-sm-6 col-xs-12">
								<div class="portfolio-item" style="width: 140px; height: 150px; border: 1px solid #00ff40;">
									<?php if(strlen($personalInfo->exprience_certificate > 0)):?>
										<a class="thumb-info" href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $personalInfo->exprience_certificate;?>" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $personalInfo->exprience_certificate;?>" class="img-responsive" height="150px" width="145px" alt="Experiance Certificate">
											<!--<span class="thumb-info-title"> Experience Certificate </span>-->
										</a>
									<?php else:?>
										<a class="thumb-info" href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/experience.png" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/experience.png" class="img-responsive" height="150px" width="145px" alt="Experiance Certificate">
											<!--<span class="thumb-info-title"> Experience Certificate </span>-->
										</a>
									<?php endif;?>
								</div>
								<div class="form-group">
									<form method="post" action="<?php echo base_url()?>index.php/employeeController/uploadEmployeeExperience" enctype="multipart/form-data">
		                                <input type="hidden" name="c_id" value="<?php echo $personalInfo->username; ?>">
		                                <input type="hidden" name="old_img" value="<?php echo $personalInfo->photo; ?>">
		                                <input type="file" id="empImage2" name="empImage2"  onchange="GetFileSize3()" class="form-control input-sm" required="">
										<span id="fp3" class="text-warning"></span> <br/>
		                                <input id="submit" name="submit" type="submit" class="btn btn-primary btn-sm pull-left" value="Upload Experience Certificate">
		                            </form>
								</div>
							</li>
							<li class="col-md-3 col-sm-6 col-xs-12">
								<div class="portfolio-item" style="width: 140px; height: 150px; border: 1px solid #00ff40;">
									<?php if(strlen($personalInfo->living_id > 0)):?>
										<a class="thumb-info" href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $personalInfo->living_id;?>" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $personalInfo->living_id;?>" class="img-responsive" height="150px" width="145px" alt="Address Proof">
											<!--<span class="thumb-info-title"> Address Proof </span>-->
										</a>
									<?php else:?>
										<a class="thumb-info" href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/address.png" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/address.png" class="img-responsive" height="150px" width="145px" alt="Address Proof">
											<!--<span class="thumb-info-title"> Address Proof </span>-->
										</a>
									<?php endif;?>
								</div>
								<div class="form-group">
									<form method="post" action="<?php echo base_url()?>index.php/employeeController/uploadEmployeeAddress" enctype="multipart/form-data">
		                                <input type="hidden" name="c_id" value="<?php echo $personalInfo->username; ?>">
		                                <input type="hidden" name="old_img" value="<?php echo $personalInfo->photo; ?>">
		                                <input type="file" id="empImage3" name="empImage3"  onchange="GetFileSize4()" class="form-control input-sm" required="">
										<span id="fp4" class="text-warning"></span> <br/>
		                                <input id="submit" name="submit" type="submit" class="btn btn-primary btn-sm pull-left" value="Upload Address Proof">
		                            </form>
								</div>
							</li>
							<li class="col-md-3 col-sm-6 col-xs-12">
								<div class="portfolio-item" style="width: 140px; height: 150px; border: 1px solid #00ff40;">
									<?php if(strlen($personalInfo->photo_id > 0)):?>
										<a class="thumb-info" href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $personalInfo->photo_id;?>" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $personalInfo->photo_id;?>" class="img-responsive" height="150px" width="145px" alt="Photo Id">
											<!--<span class="thumb-info-title"> Photo Id </span>-->
										</a>
									<?php else:?>
										<a class="thumb-info" href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/photo_id.png" data-lightbox="gallery" data-title="Website">
											<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/photo_id.png" class="img-responsive" height="150px" width="145px" alt="Photo Id">
											<!--<span class="thumb-info-title"> Photo Id </span>-->
										</a>
									<?php endif;?>
								</div>
								<div class="form-group">
									<form method="post" action="<?php echo base_url()?>index.php/employeeController/uploadEmployeePhoto" enctype="multipart/form-data">
		                                <input type="hidden" name="c_id" value="<?php echo $personalInfo->username; ?>">
		                                <input type="hidden" name="old_img" value="<?php echo $personalInfo->photo; ?>">
		                                <input type="file" id="empImage4" name="empImage4" multiple  onchange="GetFileSize5()" class="form-control input-sm" required="" >
										<span id="fp5" class="text-warning"></span> <br/>
		                                <input id="submit" name="submit" type="submit" class="btn btn-primary btn-sm pull-left" value="Upload Photo Id">
		                            </form>
								</div>
							</li>
							<li class="gap"></li>
							<!-- "gap" elements fill in the gaps in justified grid -->
						</ul>
					</div> <!-- End gallery div -->
				</div>
				<div id="attendance_report" class="tab-pane fade <?php if($this->uri->segment(4) == 'Attendance'){ echo "in active";}?>">
					<div class="panel-body">
					<div class="col-sm-12">
									<div class="form-group col-sm-6">
										<label class="col-sm-5 control-label" for="form-field-20">
											Start Date (yyyy-mm-dd)<span class="symbol required"></span>
										</label>
										<div class="col-sm-7">
											<input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years" id="sdate" name="startdate" class="form-control date-picker">
										</div>
									</div><?php $emp_id =$this->uri->segment(3);?>
									<input type = "hidden" value = "<?php echo $emp_id;?>" name = "empid" id = "empid"/>
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
				<div id="salary_report" class="tab-pane fade <?php if($this->uri->segment(4) == 'Salary'){ echo "in active";}?>">
					<div class="panel-body">
						<h1>Salary Report</h1>
					</div>
					<div style="width:100%; height:400px; overflow-x: scroll; overflow-y: scroll;">
								<div class="table-responsive">
								<?php  	
								$this->db->where("school_code",$this->session->userdata("school_code"));
									$this->db->where("emp_id",$personalInfo->id);
									$var = $this->db->get("emp_salary_info");
									if($var->num_rows() > 0):
								?>
									<table class="table table-striped table-hover table-bordered text-uppercase" id="sample-table-2">
										<thead>
											<tr>
												<th class="center">S.No.</th>
												<th class="center">Provide By</th>
												<th class="center">Mode</th>
												<th class="center">BS</th>
												<th class="center">DA</th>
												<th class="center">PF</th>
												<th class="center">ESI</th>
												<th class="center">MA</th>
												<th class="center">TA</th>
												<th class="center">HRA</th>
												<th class="center">SA</th>
												<th class="center">Sp.A</th>
												<th class="center">Encentieve</th>
												<th class="center">Bonus</th>
												<th class="center">Gross</th>
												<th class="center">Till Date</th>
												<th class="center">Month No</th>
											</tr>
										</thead>
									<tbody >
									<?php
									$i=1; 
									foreach ($var->result() as $v):?>
											<tr>
											<td><?php echo $i?>	</td>
											<td><?php echo $v->provide_by;?></td>
											<td><?php echo $v->pay_mode;?></td>
											<td><?php echo $v->basicSalary;?></td>
											<td><?php echo $v->dearnessAllowance;?></td>
											<td><?php echo $v->ProvidentFund;?></td>
											<td><?php echo $v->employeeStateInsurance;?></td>
											<td><?php echo $v->medicalAllowance;?></td>
											<td><?php echo $v->transportAllowance;?></td>
											<td><?php echo $v->houseRentAllowance;?></td>
											<td><?php echo $v->skillAllowance;?></td>
											<td><?php echo $v->spcialAllowance;?></td>
											<td><?php echo $v->encentieve;?></td>
											<td><?php echo $v->bonus;?></td>
											<td><?php echo $v->gross_s;?></td>
											<td><?php echo $v->till_date;?></td>
											<td><?php echo $v->monthNo;?></td>
										</tr>
											<?php $i++;
											endforeach; ?>
										</tbody>
									</table>
											<div class="col-sm-2">
											<input type="hidden" value="<?php echo $i; ?>" name="rows" />
											</div>
									<?php else:?>
										<div class="alert alert-block alert-danger fade in">
											<button data-dismiss="alert" class="close" type="button">
												&times;
											</button>
											<h4 class="alert-heading"><i class="fa fa-times"></i> Sorry!</h4>
											<p>
												You have not configured the salary of this employee. Or there is no salary report avaliable in the database. If you want to give salary to this employee please click on salary button given bellow... Thank you
											</p>
											<br/>
											<p><a href="<?php echo base_url()?>login/employeeSalary" class="btn btn-red">Salary</a>
											</p>
										</div>
										
									<?php endif;?>
										</div>
									</div>
								</div> <!-- </div> -->
										<div id="print_report" class="tab-pane fade <?php if(!$this->uri->segment(4) == 'Print Profile'){ echo "in active";}?>">
					<div class="panel-body">
						<IFRAME src="<?php echo base_url(); ?>index.php/invoiceController/printEmpProfile/<?php echo $id; ?>" width="100%" height="550px" id="iframe1" style="border: 0px;" ></IFRAME>
					</div>
				</div>
						</div>			
					
			</div>
				</div>
			</div>
		</div>
		<?php 
			endif;
		?>