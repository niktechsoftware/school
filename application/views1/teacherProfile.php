<?php $school_code = $this->session->userdata("school_code");?>
<div class="row">
	<div class="col-sm-12">
		
		<div class="tabbable">
			<ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
				<li<?php if(strlen($this->uri->segment(4)) <= 0){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#panel_overview">
						Profile
					</a>
				</li>
				<li <?php if($this->uri->segment(4) == 'updateInfo'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#panel_edit_account">
						Edit Profile
					</a>
				</li>
				<li<?php if($this->uri->segment(4) == 'Salary Report'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#salary_report">
						Salary Details
					</a>
				</li>
				<li<?php if($this->uri->segment(4) == 'Attendance'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#attendance_report">
						Attendance Report
					</a>
				</li>
				
				<li<?php if($this->uri->segment(4) == 'Purchase Report'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#Purchase_report">
						Purchase Report
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div id="panel_overview" class="tab-pane fade <?php if(strlen($this->uri->segment(4)) <= 0){ echo "in active";}?>">
					<div class="row">
						<div class="col-sm-5 col-md-4">
							<div class="user-left">
							
<div class="center">
                                    <h4><?php  echo $teacherProfile->name ; ?></h4>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div style="width: 140px; height: 150px; border: 1px solid #000;">
                                            <?php if(strlen($teacherProfile->photo > 0)):?>
                                                <img alt="<?php echo $teacherProfile->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $teacherProfile->photo;?>" />
                                            <?php else:?>
                                                <?php if($teacherProfile->gender == 1):?>
                                                    <img alt="<?php echo $teacherProfile->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empMale.png" />    
                                                <?php endif;?>
                                                <?php if($teacherProfile->gender == 0):?>
                                                    <img alt="<?php echo $teacherProfile->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empFemale.png" />    
                                                <?php endif;?>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
								<table class="table table-condensed table-hover">
									<thead>
										<tr>
											<th colspan="3">Employee Detail</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Job Category</td>
											<td>
											    	<!--<?php //echo $teacherProfile->job_category; ?>-->
											 <?php if($teacherProfile->job_category==1){ echo "Accountant";}elseif($teacherProfile->job_category==2){echo "Employee";}elseif($teacherProfile->job_category==3){echo "Teacher";}else{echo "Principal";} ?>
												<?php //if(strlen($teacherProfile->job_category) > 1) {echo $teacherProfile->job_category; }else echo "N/A"; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Joining Date</td>
											<td>
												<?php echo date("d-M-Y", strtotime($teacherProfile->join_date)); ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Job Title</td>
											<td>
												<?php echo $teacherProfile->job_title; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Login ID</td>
											<td>
												<?php echo $teacherProfile->username; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Password</td>
											<td>
												<?php echo $teacherProfile->password; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
											<tr>
											<td>Status</td>
											<td>
												<?php if($teacherProfile->status==1){echo "Active";} else{echo "Inactive"; }; ?>
											</td>
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
											<td>User ID</td>
											<td>
												<?php echo $teacherProfile->username; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Full Name</td>
											<td>
												<?php echo $teacherProfile->name; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Date Of Birth</td>
											<td>
												<?php echo date("d-M-Y", strtotime($teacherProfile->dob)); ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Gender</td>
											<td>
												<?php if($teacherProfile->gender==1){echo "male";}else{echo "female";}  ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										
										<tr>
											<td>Nationality</td>
											<td>
												<?php echo  "Indian"; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										
										<tr>
											<td>Category</td>
											<td>
												<?php if(strlen($teacherProfile->category) > 1) {echo $teacherProfile->category; }else echo "N/A"; ?>
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
												<?php echo $teacherProfile->address; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>City / State / PIN</td>
											<td>
												<?php echo $teacherProfile->city." / ".$teacherProfile->state." / ".$teacherProfile->pin_code; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Country</td>
											<td>
												<?php echo $teacherProfile->country; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<!--<tr>
											<td>Land-line Number</td>
											<td>
												<?php if(strlen($teacherProfile->phone) <= 0){ echo "N/A"; }else{ echo $teacherProfile->phone; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>-->
										<tr>
											<td>Cell-Number</td>
											<td>
												<?php echo $teacherProfile->mobile; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>E-Mail</td>
											<td>
												<?php if(strlen($teacherProfile->email) <= 0){ echo "N/A"; }else{ echo $teacherProfile->email; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
									</tbody>
								</table>
								
						</div>
					</div>
				</div>
				
				<!--------------------------------edit tab------------------------------------------------------------>
				<div id="panel_edit_account" class="tab-pane fade <?php if($this->uri->segment(4) == 'updateInfo'){ echo "in active";}?>">
				<?php $data=$this->uri->segment(3); ?>
				<div class="row">
								<div id="streamList"></div>
								<hr>
							
									
									<div class="col-md-6">
										<div class="form-group">
											<div style="width: 140px; height: 150px; border: 1px solid #00ff40; border-radius: 50%;">
												<?php if(strlen($teacherProfile->photo > 0)):?>
													<img alt="<?php echo $teacherProfile->name;?>" class="img-circle" height="148" width="140" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $teacherProfile->photo;?>" />
												<?php else:?>
													<?php if($teacherProfile->gender == 1):?>
														<img alt="<?php echo $teacherProfile->name;?>" class="img-circle" height="148" width="140" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empMale.png" />	
													<?php endif;?>
													<?php if($teacherProfile->gender == 0):?>
														<img alt="<?php echo $teacherProfile->name;?>" class="img-circle" height="148" width="140" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empFemale.png" />	
													<?php endif;?>
												<?php endif;?>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<form method="post" action="<?php echo base_url(); ?>employeeController/uploadEmployeeImage" enctype="multipart/form-data">
				                                <input type="hidden" name="c_id" value="<?php echo $teacherProfile->username; ?>">
				                                <input type="hidden" name="old_img" value="<?php echo $teacherProfile->photo; ?>">
				                                <input type="file" id="empImage" name="empImage" multiple  onchange="GetFileSize()" class="form-control input-sm" >
												<span id="fp" class="text-warning"></span><br/>
				                                <input id="submit" name="submit" type="submit" class="btn btn-primary btn-sm pull-left" value="Upload Image">
												
											</form>
										</div>
									</div>
								</div>
				<form action="<?php echo base_url();?>index.php/singleTeacherControllers/updateProfile" method="post">
						<div class="row">
							
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
											 Name
											</label>
											<input type="hidden" id="empId" value="<?php echo $teacherProfile->username; ?>" name="empId"/>
											<input type="text" name="firstName" class="form-control text-uppercase" value="<?php echo $teacherProfile->name;?>" id="firstname">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Date Of Birth
											</label>
											<input type="text" data-date-format="yyyy-mm-dd" name="dob" id="dob" value="<?php echo $teacherProfile->dob;?>" data-date-viewmode="years" class="form-control date-picker">
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
												<input type="radio" value="1" id="gender" name ="gender" class="grey" <?php if ($teacherProfile->gender == "1") { echo 'checked="checked"';	}?> >
												Male
											</label>
											<label class="radio-inline">
												<input type="radio" value="0" id="gender1" name ="gender" class="grey" <?php if ($teacherProfile->gender == "0") { echo 'checked="checked"';	}?> >
												Female
											</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Category
											</label>
											<input type="text" class="form-control text-uppercase" value="<?php echo $teacherProfile->category;?>" id="category" name="category">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Job Title
											</label>
											<input type="text" value="<?php echo $teacherProfile->job_title;?>" class="form-control text-uppercase" id="job_title" name="job_title">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Qualification
											</label>
											<input type="text" value="<?php echo $teacherProfile->qualification;?>" class="form-control text-uppercase" id="qualification" name="qualification">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Experiance
											</label>
											<input type="text" value="<?php echo $teacherProfile->experiance;?>" class="form-control" id="experiance" name="experiance">
											
										</div>
									</div>
									<div class="col-md-6">
									    	<div class="form-group">
											<label class="control-label text-bold">
												Address
											</label>
											<input type="text" value="<?php echo $teacherProfile->address;?>" class="form-control text-uppercase" id="address1" name="address1">
										</div>
									
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
									    	<div class="form-group">
										
												<input type="hidden" value="<?php echo $teacherProfile->status;?>" checked="checked" name ="status" id="status" class="green" >
						
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
											<input type="text" value="<?php echo $teacherProfile->city;?>" class="form-control text-uppercase" id="city" name="city">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												State
											</label>
											<input type="text" value="<?php echo $teacherProfile->state;?>" class="form-control text-uppercase" id="state" name="state">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Pin Code
											</label>
											<input type="text" value="<?php echo $teacherProfile->pin_code;?>" class="form-control" name="pincode" id="pincode">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Country
											</label>
											<input type="text" value="<?php echo $teacherProfile->country;?>" class="form-control text-uppercase" id="country" name="country">
										</div>
									</div>
								</div>
								<div class="row">
								<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Password
											</label>
											<input type="text" value="<?php echo $teacherProfile->password;?>" class="form-control" id="password" name="password">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Mobile
											</label>
											<input type="text" value="<?php echo $teacherProfile->mobile;?>" class="form-control" name="mobile" id="mobile">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label text-bold">
												Email
											</label>
											<input type="text" name="email" value="<?php echo $teacherProfile->email;?>" class="form-control" id="email">
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
								<input type="submit" class="btn btn-green btn-block fa fa-arrow-circle-right" id="editProfiletcher"
									value="Update" />
								
							</div>
						</div>
						</form>
					</div>	
				
				
<!-- ---------------------------------------------------------------------------------------------------------------------- -->	
				<div id="attendance_report" class='tab-pane fade <?php if($this->uri->segment(4) == 'Attendance'){ echo "in active";}?>'>
					<div class="panel-body">
							<div class="col-sm-12">
									<div class="form-group col-sm-6">
										<label class="col-sm-3 control-label" for="form-field-20">
											Start Date<span class="symbol required"></span>
										</label>
										<div class="col-sm-9">
											<input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years" id="sdate" name="startdate" class="form-control date-picker">
										</div>
									</div><?php $stu_id =$this->uri->segment(3);?>
									<input type = "hidden" value = "<?php echo $stu_id;?>" name = "stuid" id = "stuid"/>
									<div class="form-group col-sm-6">
										<label class="col-sm-3 control-label" for="form-field-20">
											End Date<span class="symbol required"></span>
										</label>
										<div class="col-sm-9">
											<input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years" id="edate1" name="enddate" class="form-control date-picker">
										</div>
									</div>
							</div>
							<br>
							<div class="table-responsive" id="rahul12">
							</div>
				</div>
			</div>
				<div id="salary_report" class="tab-pane fade <?php if($this->uri->segment(4) == 'Salary Report'){ echo "in active";}?>">
					<div class="panel-body">
						<div class="row">
								<div class="col-md-12">
						<!-- start: RESPONSIVE TABLE PANEL -->
						<div class="panel panel-white">
										<div class="panel-body">
											<div class="form-group">
											<div class="col-sm-12">		
										<br/><br/>
										<?php $eid = $this->session->userdata("username");
										$this->db->where("username",$eid);
										$tid=$this->db->get("employee_info");
										$id=$tid->row();
										$emp_id = $id->id;
		//$var = $this->db->query("select * from emp_salary_info where  emp_id ='$emp_id' AND school_code='$school_code' GROUP BY till_date DESC");
		$var = $this->db->query("select * from emp_salary_info where  emp_id ='$emp_id' AND school_code='$school_code'");?>
		<div style="width:100%; height:400px; overflow-x: scroll; overflow-y: scroll;">
		<div class="table-responsive">
											<table class="table table-striped table-hover table-bordered" id="sample-table-2">
										<thead>
											<tr>
												<th class="center">#</th>
												<th class="center">provide by</th>
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
												<th class="center">gross_s</th>
												<th class="center">is_advance</th>
												<th class="center">pay_month</th>
												<th class="center">till_date</th>
												<th class="center">monthNo</th>
												
											</tr>
										</thead>
									<tbody >
									<?php 	$i=1; 
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
											<?php $i++;
											endforeach; ?>
										</tbody>
									</table>
										
										</div>
									</div>	
	   </div>
      </div><!-- end: panel Body -->
    </div><!-- end: panel panel-white -->
   </div><!-- end: MAIN PANEL COL-SM-12 -->
</div><!-- end: PAGE ROW-->
</div>
</div>
</div>
				<div id="print_report" class="tab-pane fade <?php if($this->uri->segment(4) == 'Print Profile'){ echo "in active";}?>">
					<div class="panel-body">
						<h1>print Report</h1>
					</div>
				</div>
				<div id="Purchase_report" class="tab-pane fade <?php if($this->uri->segment(4) == 'Purchase Report'){ echo "in active";}?>">
					<div class="panel-body">
					<?php 	 $this->db->where("valid_id",$emp_id);
					$this->db->where("school_code",$this->session->userdata("school_code"));
			   				 $row = $this->db->get("sale_info"); ?>
			    		<table class="table table-striped table-hover" id="sample-table-2"> 
			    				<thead><tr>
			    				<th>S.no</th>
			    				<th>Item No.</th>
			    				<th>Purchase Date</th>
			    				<th>Balance</th>
			    				<th>total Paid</th>
			    				<th>Bill No.</th>
			    				</tr>
			    			</thead>
			    			<tbody>	
			    		<?php		$i=1; 	
			    		foreach($row->result() as $rows):?>
			
			    				<tr>
			    				<td> <?php echo $i;?> </td>
			    				<td> <?php echo $rows->item_no;?> </td>
			    				<td> <?php echo $rows->date;?> </td>
			    				<td> <?php echo $rows->balance;?> </td>
			    				<td> <?php echo $rows->paid;?> </td>
			    				<td> <?php echo $rows->bill_no;?> </td>
			    				</tr>
			    				<?php $i++; 
			    				endforeach; ?>
			    			</tbody>	
			    		</table>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	</div>
