<div class="row">
	 <div class="col-sm-12">
		<!-- start: INLINE TABS PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-orange">
			    <h5 class="media-heading">Exam Scheduling</h5>
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
								<a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i> <span>Refresh</span> </a>
							</li>
							<li>
								<a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a>
							</li>										
						</ul>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12 col-lg-12 col-sm-12">
						<div class="alert alert-info">
							 <h4 class="media-heading center">Welcome to Exam Scheduling Area </h4>
									<p class="media-timestamp">Here you can Schedule date and time. Please enter you exam name in exam name box like (exam type e.g. : Half yearly, Annual, Unit Test etc. ),
									and select exam starting date from select start date and click Submit Button. After clicking Submit Button you can see Scheduling process.
									and after that click on Go For Scheduling and wait for new page and Schedule your exam.
									You can also edit/delete the exam type and date from the options given in the right.  </p>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="panel  panel-calendar">
									<div class="panel-heading panel-blue border-light">
										<h3 class="panel-title">Enter Exam Mode</h3>
									</div>
									<form action="<?php echo base_url();?>index.php/examControllers/exammode"  method ="post"  id="form">
										<div class="panel-body space10">
											<div class="row col-md-12 col-lg-12 col-sm-12">
												<div class="space10" >
													<table>
													    <tr>
													    	<td><label class="panel-title">Select Exam:</label></td>
													    	<td><select name="examName2" required="required" style="width: 150px;">
															<option value="01">-Select Exam-</option>
															<?php foreach ($requestforUpdate as $row):
															$ds= $row->exam_date;
															$id=$row->id;
															$ename=$row->exam_name;
															$this->db->where("id",$this->session->userdata("fsd"));
															$getfsdDates = $this->db->get("fsd")->row();
															$cd=$getfsdDates->finance_start_date;
															if($ds>=$cd){?>
															<option  value="<?php echo $row->id?>"><?php echo $row->exam_name?></option><?php }endforeach;?>
															</select>
													    	<br><br></td>
													    </tr>
														<tr>
													    	<td><label class="panel-title">Select Section:</label></td>
													    	<td> <select name="sectionName" required="required" id="sectionId" style="width: 150px;">
															<option>--SELECT SECTION--</option>
															<?php 
															$this->db->where('school_code',$this->session->userdata('school_code'));
															$row= $this->db->get('class_section');
															if($row->num_rows()>0){
															foreach($row->result() as $res):?>
															<option value="<?php echo $res->id;?>"><?php echo $res->section;?></option>
															<?php endforeach; } ?>
															</select>
															<br><br></td>
													    </tr>
													    <tr>
													    	<td><label class="panel-title">Select Class:</label></td>
													    	<td> <select name="className2"  id="classIdSet" style="width: 150px;">
															</select>
															<br><br></td>
													    </tr>
														 <tr>
													    	<td><label class="panel-title">Select Language</label></td>
													    	<td>  <select name="language" required="required" style="width: 150px;"><option>--SELECT LANGUAGE--</option><option value="1" >HINDI </option><option value="2" >ENGLISH</option><option value="3" >SANSKRIT</option></select>
															<br><br></td>
													    </tr>
														<tr>
														<td><label class="panel-title">Select Subject</label></td>
														<td>  <select name="subject" id="select_subjectid" style="width: 150px">
														
																				
														</select>
															<br><br></td>
																	
																
															</select>
															</tr>
														<tr>
													    	<td><label class="panel-title">Select Mode</label></td>
													    	<td>  <select name="exam_mode" required="required" style="width: 150px;"><option>--SELECT MODE--</option><option value="1" >OFFLINE </option><option value="2" >ONLINE (SUBJECTIVE)</option><option value="3" >ONLINE (OBJECTIVE)</option></select>
															<br><br></td>
													    </tr>
													    <tr>
															<td><button class="btn btn-red " style="margin-left:150px; margin-top:10px;">
                                                            Submit <i class="fa fa-arrow-circle-right"></i>
															</button></td>
														</tr>
													</table>
												</div>
											</div>	
										</div>
									</form>
								</div>
										
							</div>
							</br>
							</br>
							
							<div class="col-sm-12">
								<div class="panel panel-calendar">
									<div class="panel-heading panel-blue border-light">
										<h4 class="panel-title">Exam Mode List</h4>
									</div>
									<div class="row">
						<div class="col-md-12 space20">
							<div class="btn-group pull-right">
								<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
									Export <i class="fa fa-angle-down"></i>
								</button>
								<?php if($this->session->userdata('login_type') == 'admin'){?>
								<ul class="dropdown-menu dropdown-light pull-right">
									<!--<li>-->
									<!--	<a href="#" class="export-pdf" data-table="#sample-table-2" >-->
									<!--		Save as PDF-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-png" data-table="#sample-table-2">-->
									<!--		Save as PNG-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-csv" data-table="#sample-table-2" >-->
									<!--		Save as CSV-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-txt" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as TXT-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-xml" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as XML-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-sql" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as SQL-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-json" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as JSON-->
									<!--	</a>-->
									<!--</li>-->
									<li>
										<a href="#" class="export-excel" data-table="#sample-table-2" >
											Export to Excel
										</a>
									</li>
									<!--<li>-->
									<!--	<a href="#" class="export-doc" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Export to Word-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-powerpoint" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Export to PowerPoint-->
									<!--	</a>-->
									<!--</li>-->
								</ul>
								<?php }?>
							</div>
						</div>
					</div>
									<div class="panel-body" id="examsetting">
									    	<div class="table-responsive col-md-12 col-lg-12 col-sm-12">
										<table class="table table-striped table-hover" id="sample-table-2">
											<thead>
												<tr>
													<th>#</th>
													<th>Exam Name</th>
													<th>Class Name</th>
													<th>Section Name</th>
													<th>Exam Mode</th>
													<th>Language</th>
													<th>Subject</th>
													<th>Attempted</th>
													<th>Not Attempted</th>
													<th>Click For Details</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php $i=1;
												$school_code = $this->session->userdata("school_code");
												$getmode=$this->db->query("select exam_mode.id, exam_mode.exam_id, exam_name.exam_name, exam_mode.class_id,exam_mode.section, exam_mode.subject,exam_mode.language, exam_mode.exam_mode from exam_mode join exam_name on exam_mode.exam_id = exam_name.id where exam_name.school_code='$school_code'");
												if($getmode->num_rows()>0){
													foreach($getmode->result() as $row):
													    $this->db->where('id',$row->class_id);
													    $emode=$this->db->get('class_info');
												        $this->db->where('id',$row->exam_mode);
													    $getmode=$this->db->get('exam_mode_name');
													    
												if($emode->num_rows()>0  && $getmode->num_rows()>0){
												        $emode=$emode->row();
												        $getmode= $getmode->row();
													
												?>
												<tr>
													<td><?php echo $i;?></td>
													<td>
														<input type="text" style="width: 80px;" name="examName<?php echo $i;?>" value="<?php echo $row->exam_name;?>" id="ename<?php echo $i;?>" disabled="disabled"/>									
														<input type="hidden" name="examName" id="rowid<?php echo $i;?>" value="<?php echo $row->exam_id;?>"/>
													</td>
													<td>
														<input type="text" style="width: 70px;" name="exam_mode<?php echo $i;?>" value="<?php echo $emode->class_name;?>" id="classid<?php echo $i;?>" disabled="disabled"/>									
													</td>
													<td>
													<?php $this->db->where('id',$row->section);
													$sec=$this->db->get('class_section')->row();
													?>
														<input type="text" style="width: 30px;" name="class<?php echo $i;?>" value="<?php echo $sec->section;?>" id="section<?php echo $i;?>" disabled="disabled"/>									
													</td>
													<td>	
													    <input type="text" style="width: 100px;" name="exam_mode<?php echo $i;?>" value="<?php echo $getmode->exam_mode;?>" id="exammode<?php echo $i;?>" disabled="disabled"/>									
												
													</td>
													<td>
													<?php $this->db->where('id',$row->language);
													$lan=$this->db->get('language')->row();
													?>
													    <input type="text" style="width: 80px;" name="language<?php echo $i;?>" value="<?php echo $lan->language;?>" id="exammode<?php echo $i;?>" disabled="disabled"/>									
													</td>
													<td>
													<?php $this->db->where('id',$row->subject);
													$sub=$this->db->get('subject')->row();
													?>
														<input type="text" style="width: 140px;" name="subject<?php echo $i;?>" value="<?php echo $sub->subject;?>" id="exammode<?php echo $i;?>" disabled="disabled"/>									
													</td>
													
													<td>
													    <?php 
													    $this->db->where("class_id",$row->class_id);
													        $total_student= $this->db->get("student_info");
													        if($getmode->id==3){
													     $attn = $this->db->query("Select distinct student_id from objective_exam_result where subject_id='$row->subject' and exam_id='$row->exam_id' and status=1");
													        }else{
													            if($getmode->id==2){
													                  $attn = $this->db->query("Select distinct student_id from subjective_answer_report where exam_mode_id='$row->id' and status=0");
													            }else{
													                //echo "test Offline";
													                $attn=0;
													            }
													        }
													        
													   
													    if($getmode->id==3){ if($attn->num_rows()>0){?>
													   <a href="<?php echo base_url();?>index.php/examControllers/onlineExamStatus/<?php echo $row->subject;?>/<?php echo $row->exam_id;?>/<?php echo $getmode->id;?>/1/<?php echo $row->id;?>" style="width: 50px;" class="btn btn-success">
													   <?php 
													      
													    echo $attn->num_rows();?>
													     </a>
													    <?php }}
													    if($getmode->id==2){if($attn->num_rows()>0){?>
													         <a href="<?php echo base_url();?>index.php/examControllers/onlineExamStatus/<?php echo $row->subject;?>/<?php echo $row->id;?>/<?php echo $getmode->id;?>/1" style="width: 50px;" class="btn btn-success">
													   <?php 
													      
													    echo $attn->num_rows();?>
													     </a>
													   <?php }}
													    ?>
													</td>
														<td>
														    <?php   if($getmode->id==3){?>
														<a href="<?php echo base_url();?>index.php/examControllers/onlineExamStatus/<?php echo $row->subject;?>/<?php echo $row->exam_id;?>/<?php echo $getmode->id;?>/0/<?php echo $row->id;?>" style="width: 50px;" class="btn btn-warning">
													  <?php echo $total_student->num_rows()-$attn->num_rows();
													 
													  ?>
													   </a>
													   <?php }
													    if($getmode->id==2){?>
													        <a href="<?php echo base_url();?>index.php/examControllers/onlineExamStatus/<?php echo $row->subject;?>/<?php echo $row->id;?>/<?php echo $getmode->id;?>/0" style="width: 50px;" class="btn btn-warning">
													   <?php 
													      
													     echo $total_student->num_rows()-$attn->num_rows();?>
													     </a>
													   <?php }?>
													</td>
													<td>
													<?php 
														if($row->exam_mode=='3'){?>
														<a href="<?php echo base_url();?>index.php/examControllers/create_ques/<?php echo $row->id;?>">
														    <input type="submit" style="width:80px; height:38px;" value="OBJECTIVE" id="<?php echo $i;?>" class="btn btn-xs btn-light-blue" id="">
														</a>
														<?php }elseif($row->exam_mode=='2'){?>
														<a href="<?php echo base_url();?>index.php/login/subjective_ques/<?php echo $row->id;?>">
														    <input type='submit' style="width:80px; height:38px;" value="SUBJECTIVE" id="<?php echo $i;?>" class="btn btn-xs btn-light-green" id="">
														</a>
														<?php } else{ ?>
														    <input type='submit' style="width:80px; height:38px;"  value="OFFLINE" class="btn btn-xs btn-light-red" id="">
														<?php }?>
													</td>
													<td>
													      <a href="<?php echo base_url();?>index.php/examControllers/deleteExamMode/<?php echo $row->id;?>" style="width: 80px;" class="btn btn-danger">
													          Delete
													        </a>
													</td>
												</tr>
											<?php }?>
									</div>
							
												<?php $i++; endforeach; }?>
											</tbody>
										</table>
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>		
			</div>
		</div>
	</div>
</div>
