
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
					<div class="col-sm-12">
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
											<div class="row col-sm-12">
												<div class="space10" >
													<table>
													    <tr>
													    	<td><label class="panel-title">Select Exam:</label></td>
													    	<td><select name="examName2" required="required" style="width: 180px;"><option>--SELECT EXAM--</option>
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
													    	<td> <select name="sectionName" required="required" id="sectionId" style="width: 180px;">
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
													    	<td> <select name="className2"  id="classIdSet" style="width: 180px;">
															</select>
															<br><br></td>
													    </tr>
														 <tr>
													    	<td><label class="panel-title">Select Language</label></td>
													    	<td>  <select name="language" required="required" style="width: 180px;"><option>--SELECT LANGUAGE--</option><option value="1" >HINDI </option><option value="2" >ENGLISH</option><option value="3" >SANSKRIT</option></select>
															<br><br></td>
													    </tr>
														<tr>
														<td><label class="panel-title">Select Subject</label></td>
														<td>  <select name="subject" id="select_subject" style="width: 180px">
														<option value="">-select Subject-</option>
																			<?php
																					$sub = $this->db->get('subject');
																					if($sub->num_rows()>0){
																					foreach($sub->result() as $row):
																					echo '<option value="'.$row->id.'">'.$row->subject.'</option>';?>
																					<?php endforeach ;}?>
														</select>
															<br><br></td>
																	
																
															</select>
															</tr>
														<tr>
													    	<td><label class="panel-title">Select Mode</label></td>
													    	<td>  <select name="exam_mode" required="required" style="width: 180px;"><option>--SELECT MODE--</option><option value="1" >OFFLINE </option><option value="2" >ONLINE (SUBJECTIVE)</option><option value="3" >ONLINE (OBJECTIVE)</option></select>
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
											<script type="text/javascript">
												var input = document.getElementById("examName");
                                                   input.addEventListener("keyup", function () {

                                                    });

                                                   input.addEventListener("keyup", function () {
                                                     var x = document.getElementById("examName");
                                                          x.value = x.value.toUpperCase();
                                
                                                            });
				
											</script>
										
							</div>
							</br>
							</br>
							<div class="col-sm-12">
								<div class="panel panel-calendar">
									<div class="panel-heading panel-blue border-light">
										<h4 class="panel-title">Exam Mode List</h4>
									</div>
									<div class="panel-body" id="examsetting">
										<table class="table table-responsive">
											<thead>
												<tr>
													<th>#</th>
													<th>Exam Name</th>
													<th>Class Name</th>
													<th>Section Name</th>
													<th>Exam Mode</th>
													<th>Language</th>
													<th>Subject</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php $i=1;
												$getmode=$this->db->get('exam_mode');
												if($getmode->num_rows()>0){
													foreach($getmode->result() as $row):
												?>
												<tr>
													<td><?php echo $i;?></td>
													<td>	
													<?php $this->db->where('id',$row->exam_id);
													$ename=$this->db->get('exam_name')->row();
													
													?>
														<input type="text" style="width: 140px;" name="examName<?php echo $i;?>" value="<?php echo $ename->exam_name;?>" id="ename<?php echo $i;?>" disabled="disabled"/>									
														<input type="hidden" name="examName" id="rowid<?php echo $i;?>" value="<?php echo $row->id;?>"/>
													</td>
													<td>
													<?php $this->db->where('id',$row->class_id);
													$emode=$this->db->get('class_info')->row();
													?>
												
														<input type="text" style="width: 140px;" name="exam_mode<?php echo $i;?>" value="<?php echo $emode->class_name;?>" id="classid<?php echo $i;?>" disabled="disabled"/>									
													</td>
													<td>
													<?php $this->db->where('id',$row->section);
													$sec=$this->db->get('class_section')->row();
													?>
														<input type="text" style="width: 140px;" name="class<?php echo $i;?>" value="<?php echo $sec->section;?>" id="section<?php echo $i;?>" disabled="disabled"/>									
													</td>
													<td>
													<?php $this->db->where('id',$row->exam_mode);
													$getmode=$this->db->get('exam_mode_name')->row();
													?>
														<input type="text" style="width: 140px;" name="exam_mode<?php echo $i;?>" value="<?php echo $getmode->exam_mode;?>" id="exammode<?php echo $i;?>" disabled="disabled"/>									
													</td>
													<td>
													<?php $this->db->where('id',$row->language);
													$lan=$this->db->get('language')->row();
													?>
													<input type="text" style="width: 140px;" name="language<?php echo $i;?>" value="<?php echo $lan->language;?>" id="exammode<?php echo $i;?>" disabled="disabled"/>									
													</td>
													<td>
													<?php $this->db->where('id',$row->subject);
													$sub=$this->db->get('subject')->row();
													?>
														<input type="text" style="width: 140px;" name="subject<?php echo $i;?>" value="<?php echo $sub->subject;?>" id="exammode<?php echo $i;?>" disabled="disabled"/>									
													</td>
													<td>
													<?php 
														if($row->exam_mode=='3'){?>
														<a href="<?php echo base_url();?>index.php/examControllers/create_ques/<?php echo $row->exam_id;?>">
														<input type="submit" style="width:100px; height:38px;" value="OBJECTIVE" id="<?php echo $i;?>" class="btn btn-xs btn-light-blue" id="">
														</a>
														<?php }elseif($row->exam_mode=='2'){?>
														<a href="<?php echo base_url();?>index.php/login/subjective_ques">
														<input type='submit' style="width:100px; height:38px;" value="SUBJECTIVE" id="<?php echo $i;?>" class="btn btn-xs btn-light-green" id="">
														</a>
														<?php } else{ ?>
														<input type='submit' style="width:100px; height:38px;"  value="OFFLINE" class="btn btn-xs btn-light-red" id="">
														<?php }?>
													</td>
												</tr>
											
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
