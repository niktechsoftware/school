<!--  
Niktech software Solutions,niktechsoftware.com,schoolerp-niktech.in
  <meta name="description" content="Welcome to niktech software School business ERP . we proving school management erp software. we including online attendance with biometric attendance machine and tracking student with GPS technology & many other facilities in our school management erp system">
  <meta name="keywords" content="Enterprise resource planning,school,ERP,system software,attendance,biometric,online, school management,gps,niktech software solution, online result, online admit card,omr">
  <meta name="author" content="School management System software">
-->				
				<script>
				TableExport.init();
		</script>
					<div class="col-md-12">
									<!-- start: EXPORT DATA TABLE PANEL  -->
									<div class="panel panel-white">
										<div class="panel-heading panel-green">
											<h4 class="panel-title">List of all Students &amp; <span class="text-bold">Export Student Data List</span></h4>
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
										<div class="panel-body">
											<div class="row">
												<div class="col-md-12 space20">
												<?php if($this->session->userdata('login_type') == 'admin'){?>
													<div class="btn-group pull-right">
															<a href="#" class="export-excel btn btn-green" data-table="#sample-table-2" >
																	Export to Excel
															</a>
															<a href="#" class="export-pdf btn btn-green" data-table="#sample-table-2" >
																	Save as PDF
															</a>
															<a href="#" class="export-txt btn btn-green" data-table="#sample-table-2" >
																Save as TXT
															</a>
															<a href="#" class="export-sql btn btn-green" data-table="#sample-table-2" data-ignoreColumn ="3,4">
																Save as SQL
															</a>
															<a href="#" class="export-doc btn btn-green" data-table="#sample-table-2" >
																Export to Word
															</a>
													</div>
													<?php }?>
												</div>
											</div>									
								<div class="table-responsive" style="width:100%; overflow-y: scroll;">
									<table class="table table-striped table-hover" id="sample-table-2">
										<thead>
											<tr>
												<th>SNo.</th>
												
												<?php if(strlen($username) > 1):?>
												<th>Student ID</th>
												<?php endif; ?>
												
												<?php if(strlen($scholer_no) > 1):?>
												<th>Scholer No</th>
												<?php endif; ?>
												
												<?php if(strlen($name) > 1):?>
												<th>Full Name</th>
												<?php endif; ?>
												
												<?php if(strlen($board_register_no) > 1):?>
												<th>Board Register No</th>
												<?php endif; ?>
												
												<?php if(strlen($adm_date) > 1):?>
												<th>Admission Date</th>
												<?php endif; ?>
												
												<?php if(strlen($dob) > 1):?>
												<th>Date Of Birth</th>
												<?php endif; ?>
												
												<?php if(strlen($class_section) > 1):?>
												<th>Class Section</th>
												<?php endif; ?>
												
												<?php if(strlen($gender) > 1):?>
												<th>Gender</th>
												<?php endif; ?>
												
												<?php if(strlen($bloodgp) > 1):?>
												<th>Blood Group</th>
												<?php endif; ?>
												
												<?php if(strlen($birth_place) > 1):?>
												<th>Birth Place</th>
												<?php endif; ?>
												
												<?php if(strlen($nationality) > 1):?>
												<th>Nationality</th>
												<?php endif; ?>
												
												<?php if(strlen($mother_tongue) > 1):?>
												<th>Mother Tongue</th>
												<?php endif; ?>
												
												<?php if(strlen($category) > 1):?>
												<th>Category</th>
												<?php endif; ?>
												
												<?php if(strlen($religion) > 1):?>
												<th>Religion</th>
												<?php endif; ?>
												
												<?php if(strlen($address1) > 1):?>
												<th>Address</th>
												<?php endif; ?>
												
												<?php if(strlen($city) > 1):?>
												<th>City</th>
												<?php endif; ?>
												
												<?php if(strlen($state) > 1):?>
												<th>State</th>
												<?php endif; ?>
												
												<?php if(strlen($pin_code) > 1):?>
												<th>Pin Code</th>
												<?php endif; ?>
												
												<?php if(strlen($mobile) > 1):?>
												<th>Mobile No.</th>
												<?php endif; ?>
												
												<?php if(strlen($email) > 1):?>
												<th>Email</th>
												<?php endif; ?>
												
												<!--<?php if(strlen($sno) > 1):?>-->
												<!--<th>Serial No.</th>-->
												<!--<?php endif; ?>-->
												
												<?php if(strlen($book_no) > 1):?>
												<th>Book No.</th>
												<?php endif; ?>
												
												<?php if(strlen($father_full_name) > 1):?>
												<th>Father Name</th>
												<?php endif; ?>
												
												<?php if(strlen($mother_full_name) > 1):?>
												<th>Mother Name</th>
												<?php endif; ?>
												
												<?php if(strlen($caretaker_name) > 1):?>
												<th>Caretaker Name</th>
												<?php endif; ?>
												
												<?php if(strlen($caretaker_relation) > 1):?>
												<th>Caretaker Relation</th>
												<?php endif; ?>
												
												<?php if(strlen($father_education) > 1):?>
												<th>Father Education</th>
												<?php endif; ?>
												
												<?php if(strlen($mother_education) > 1):?>
												<th>Mother Education</th>
												<?php endif; ?>
												
												<?php if(strlen($father_occupation) > 1):?>
												<th>Father Occupation</th>
												<?php endif; ?>
												
												<?php if(strlen($mother_occupation) > 1):?>
												<th>Mother Occupation</th>
												<?php endif; ?>
												
												<?php if(strlen($family_annual_income) > 1):?>
												<th>Family Annual Income</th>
												<?php endif; ?>
												
												<?php if(strlen($f_mobile) > 1):?>
												<th>Father Mobile</th>
												<?php endif; ?>
												
												<?php if(strlen($m_mobile) > 1):?>
												<th>Mother Mobile</th>
												<?php endif; ?>
												
												<?php if(strlen($f_email) > 1):?>
												<th>Father Email</th>
												<?php endif; ?>
												
												<?php if(strlen($m_email) > 1):?>
												<th>Mother Email</th>
												<?php endif; ?>

												<?php if(strlen($disc) > 1):?>
												<th>Staff Children</th>
												<?php endif; ?>
												
												<?php if(strlen($transport) > 1):?>
												<th>Transport List</th>
												<?php endif; ?>
												
												<th>Settings</th>
											</tr>
										</thead>
										<tbody>
									<?php $sno = 1; foreach ($result->result() as $row): ?>
									<?php 
        							
											$stuId = $row->stuid; 
											$this->db->where("student_id",$stuId);
											$pInfo = $this->db->get("guardian_info")->row();?>
											
											<tr class="text-uppercase">
												<td><?php echo $sno; ?></td>

												<?php if(strlen($username) > 1):?>
												<td><?php echo $row->username; ?></td>
												<?php endif; ?>
												
												<?php if(strlen($scholer_no) > 1):?>
												<td><?php echo $row->scholer_no; ?></td>
												<?php endif; ?>
												
												
												<?php if(strlen($name) > 1):?>
												<td><?php echo $row->name; ?></td>
												<?php endif; ?>											
												
												<?php if(strlen($board_register_no) > 1):?>
												<td><?php  echo $row->board_register_no; ?></td>
												<?php endif; ?>
												
												<?php if(strlen($adm_date) > 1):?>
												<td><?php echo date("d-M-Y", strtotime($row->$adm_date)); ?></td>
												<?php endif; ?>
												
												<?php if(strlen($dob) > 1):?>
												<td><?php echo date("d-M-Y", strtotime($row->dob)); ?></td>
												<?php endif; ?>
												
											 <?php if(strlen($class_section) > 1):?>
                                              <?php $this->db->select('class_name,section');
											  		$this->db->where('id',$row->class_id);
                                                    $classInfo=$this->db->get('class_info')->row();
                                                   
                                                   
                                                    $this->db->where("id",$classInfo->section);
                                                    $sectionid = $this->db->get("class_section")->row();
                                                   ?>
                                            <td><?php echo $classInfo->class_name." & ".$sectionid->section; ?></td>
                                            <?php endif; ?>
												
												<?php if(strlen($gender) > 1):?>
												  <?php if($row->gender==1){?>
												<td><?php echo "MALE"; ?></td>
												<?php } else{?>
												    <td><?php echo "FEMALE"; ?></td>
										        	<?php }?>
												<?php endif; ?>
												
												<?php if(strlen($bloodgp) > 1):?>
												<td><?php echo $row->bloodgp; ?></td>
												<?php endif; ?>
												
												<?php if(strlen($birth_place) > 1):?>
												<td><?php echo $row->birth_place; ?></td>
												<?php endif; ?>
												
												<?php if(strlen($nationality) > 1):?>
												<td><?php echo $row->nationality; ?></td>
												<?php endif; ?>
												
												<?php if(strlen($mother_tongue) > 1):?>
												<td><?php echo $row->mother_tongue; ?></td>
												<?php endif; ?>
												
												<?php if(strlen($category) > 1):?>
												<td><?php echo $row->category; ?></td>
												<?php endif; ?>
												
												<?php if(strlen($religion) > 1):?>
												<td><?php echo $row->religion; ?></td>
												<?php endif; ?>
												
												<?php if(strlen($address1) > 1):?>
												<td><?php echo $row->address1; ?></td>
												<?php endif; ?>
												
												<?php if(strlen($city) > 1):?>
												<td><?php echo $row->city; ?></td>
												<?php endif; ?>
												
												<?php if(strlen($state) > 1):?>
												<td><?php echo $row->state; ?></td>
												<?php endif; ?>
												
												<?php if(strlen($pin_code) > 1):?>
												<td><?php echo $row->pin_code; ?></td>
												<?php endif; ?>
												
												
												<?php if(strlen($mobile) > 1):?>
												<td><?php echo $row->mobile; ?></td>
												<?php endif; ?>
												
												<?php if(strlen($email) > 1):?>
												<td><?php echo $row->email; ?></td>
												<?php endif;  ?>
												
												<!--<?php if(strlen($sno) > 1){?>-->
												<!--<td><?php echo $row->sno; ?></td>-->
												<!--<?php }?>-->
											 
												
												<?php if(strlen($book_no) > 1){?>
										     	<td><?php echo $row->book_no; ?></td>
												<?php } ?>
											 
												
												<?php if(strlen($father_full_name) > 1):?>
												<td><?php echo $pInfo->father_full_name; ?></td>
												<?php endif;  ?>
												
												<?php if(strlen($mother_full_name) > 1):?>
												<td><?php echo $pInfo->mother_full_name; ?></td>
												<?php endif;  ?>
												
												<?php if(strlen($caretaker_name) > 1):?>
												<td><?php echo $pInfo->caretaker_name; ?></td>
												<?php endif;  ?>
												
												<?php if(strlen($caretaker_relation) > 1):?>
												<td><?php echo $pInfo->caretaker_relation; ?></td>
												<?php endif;  ?>
												
												<?php if(strlen($father_education) > 1):?>
												<td><?php echo $pInfo->father_education; ?></td>
												<?php endif;  ?>
												
												<?php if(strlen($mother_education) > 1):?>
												<td><?php echo $pInfo->mother_education; ?></td>
												<?php endif;  ?>
												
												<?php if(strlen($father_occupation) > 1):?>
												<td><?php echo $pInfo->father_occupation; ?></td>
												<?php endif;  ?>
												
												<?php if(strlen($mother_occupation) > 1):?>
												<td><?php echo $pInfo->mother_occupation; ?></td>
												<?php endif;  ?>
												
												<?php if(strlen($family_annual_income) > 1):?>
												<td><?php echo $pInfo->family_annual_income; ?></td>
												<?php endif;  ?>
												
												<?php if(strlen($f_mobile) > 1):?>
												<td><?php echo $pInfo->f_mobile; ?></td>
												<?php endif;  ?>
												
												<?php if(strlen($m_mobile) > 1):?>
												<td><?php echo $pInfo->m_mobile; ?></td>
												<?php endif;  ?>
												
												<?php if(strlen($f_email) > 1):?>
												<td><?php echo $pInfo->f_email; ?></td>
												<?php endif;  ?>
												
												<?php if(strlen($m_email) > 1):?>
												<td><?php echo $pInfo->m_email; ?></td>
												<?php endif;  ?>

												<?php if(strlen($disc) > 1):?>
												<td>
												<?php if(strlen($row->teacher_studentid1)>0){ echo ($row->teacher_studentid1).",";}else{echo "";} ?>
												<?php if(strlen($row->teacher_studentid1)>0){ echo ($row->teacher_studentid2)."<br>";}else{echo " ";} ?>
												<?php if(strlen($row->teacher_studentid1)>0){ echo ($row->teacher_studentid3)." ";}else{echo " ";} ?>
												<?php if(strlen($row->teacher_studentid1)>0){ echo $row->teacher_studentid4;}else{echo " ";} ?>
											</td>
												<?php endif;  ?>
												
											<?php if(strlen($transport) > 1):?>
												<td><?php if($row->transport>0){echo "YES";}else{echo "NO";} ?></td>
												<?php endif;  ?>
												
												<td><a href="<?php echo base_url(); ?>index.php/studentController/admissionSuccess/<?php echo $row->stuid;?>">Full Profile</a></td>
											</tr>
											<?php $sno++; endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
			