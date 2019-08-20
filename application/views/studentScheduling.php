		<?php $snm=$this->session->userdata('username');
			$this->db->where("username",$snm);
			$dt=$this->db->get("student_info")->row();
			$cid=$dt->class_id;
			$this->db->where("id",$cid);
			$dtf=$this->db->get("class_info")->row();
			$school_code=$dtf->school_code;

             $this->db->where("class_id",$cid);
              $this->db->where("school_code",$school_code);
			$dt1=$this->db->get("time_table")->result(); 
           // $pid= $dt1->period_id;
           // print_r($dt1);
            /* $this->db->where("id",$pid);
             $this->db->where("school_code",$school_code);
			 $dt2=$this->db->get("period")->result();*/
              


			?>
		
		<div class="row">
			<div class="col-sm-12">
					<div class="tabbable">
									<ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
										<li class="active">
											<a data-toggle="tab" href="#monday">
												Monday
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#tuesday">
												Tuesday
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#wednesday">
												Wednesday
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#thursday">
												Thursday
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#friday">
												Friday
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#saturday">
												Saturday
											</a>
										</li>
									</ul>
									<div class="tab-content">
										<div id="monday" class="tab-pane fade in active">
											
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
														$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code'");
														foreach($uniquePeriod->result() as $row):?>
														<th>
															<?php 
																if($row->period == ''){
																	echo "Lunch";
																}else{
																	echo $row->period;
																}
															?>
														</th>
														<?php endforeach;   ?>
													</tr>
													<tr>
														<th>Time Slot</th>
														
														<?php foreach($dt1 as $row): 
														
														$this->db->where("id",$row->period_id);
											             $this->db->where("school_code",$school_code);
														 $dt2=$this->db->get("period")->result();
														foreach($dt2 as $row1):

														 //print_r($row1); 
															
														 ?>
														<th><?php echo $row1->from; ?> to <?php echo $row1->to; ?></th>
														<?php endforeach;;
													endforeach;?>
														
														
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?php echo $class."-".$sec1;?></td>
														<?php foreach($dt1 as $row):
														 if($row->day == "Monday")
															{?>
															<?php if($row->teacher == ''):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php  $this->db->where("id",$row->subject_id);
																$sname=$this->db->get("subject")->row(); 
																//print_r($sname);
																$this->db->where("id",$row->teacher);
																$ename=$this->db->get("employee_info")->row(); 
																echo $ename->name."<br/>".$sname->subject;?></td>
															<?php endif;}?>
													<?php endforeach;?>
													</tr>
													
												</tbody>
											</table>
								
										</div>
										<!-- for Tuesday -->
										<div id="tuesday" class="tab-pane">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
														$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code'");
														foreach($uniquePeriod->result() as $row):?>
														<th>
															<?php 
																if($row->period == ''){
																	echo "Lunch";
																}else{
																	echo $row->period;
																}
															?>
														</th>
														<?php endforeach;?>
													</tr>
													<tr>
														<th>Time Slot</th>
														
														<?php foreach($dt1 as $row): 
														
														$this->db->where("id",$row->period_id);
											             $this->db->where("school_code",$school_code);
														 $dt2=$this->db->get("period")->result();
														foreach($dt2 as $row1):

														 //print_r($row1); 
															
														 ?>
														<th><?php echo $row1->from; ?> to <?php echo $row1->to; ?></th>
														<?php endforeach;;
													endforeach;?>
														
														
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?php echo $class."-".$sec1;?></td>
														<?php foreach($dt1 as $row):
														 if($row->day == "Tuesday")
															{?>
															<?php if($row->teacher == ''):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php  $this->db->where("id",$row->subject_id);
																$sname=$this->db->get("subject")->row(); 
																//print_r($sname);
																$this->db->where("id",$row->teacher);
																$ename=$this->db->get("employee_info")->row(); 
																echo $ename->name."<br/>".$sname->subject;?></td>
															<?php endif;}?>
													<?php endforeach;?>
													</tr>
													
												</tbody>
											</table>
										</div>
										<!-- end for Tuesday -->
										<!-- for Wednesday -->
										<div id="wednesday" class="tab-pane">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
														$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code'");
														foreach($uniquePeriod->result() as $row):?>
														<th>
															<?php 
																if($row->period == ''){
																	echo "Lunch";
																}else{
																	echo $row->period;
																}
															?>
														</th>
														<?php endforeach;?>
													</tr>
													<tr>
														<th>Time Slot</th>
														
														<?php foreach($dt1 as $row): 
														
														$this->db->where("id",$row->period_id);
											             $this->db->where("school_code",$school_code);
														 $dt2=$this->db->get("period")->result();
														foreach($dt2 as $row1):

														 //print_r($row1); 
															
														 ?>
														<th><?php echo $row1->from; ?> to <?php echo $row1->to; ?></th>
														<?php endforeach;;
													endforeach;?>
														
														
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?php echo $class."-".$sec1;?></td>
														<?php foreach($dt1 as $row):
														 if($row->day == "Wednesday")
															{?>
															<?php if($row->teacher == ''):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php  $this->db->where("id",$row->subject_id);
																$sname=$this->db->get("subject")->row(); 
																//print_r($sname);
																$this->db->where("id",$row->teacher);
																$ename=$this->db->get("employee_info")->row(); 
																echo $ename->name."<br/>".$sname->subject;?></td>
															<?php endif;}?>
													<?php endforeach;?>
													</tr>
													
												</tbody>
											</table>
										</div>
										
										<!-- end for Wednesday -->
										<!-- for thursday -->
										<div id="thursday" class="tab-pane">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
														$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code'");
														foreach($uniquePeriod->result() as $row):?>
														<th>
															<?php 
																if($row->period == ''){
																	echo "Lunch";
																}else{
																	echo $row->period;
																}
															?>
														</th>
														<?php endforeach;?>
													</tr>
													<tr>
														<th>Time Slot</th>
														
														<?php foreach($dt1 as $row): 
														
														$this->db->where("id",$row->period_id);
											             $this->db->where("school_code",$school_code);
														 $dt2=$this->db->get("period")->result();
														foreach($dt2 as $row1):

														 //print_r($row1); 
															
														 ?>
														<th><?php echo $row1->from; ?> to <?php echo $row1->to; ?></th>
														<?php endforeach;;
													endforeach;?>
														
														
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?php echo $class."-".$sec1;?></td>
														<?php foreach($dt1 as $row):
														 if($row->day == "Thursday")
															{?>
															<?php if($row->teacher == ''):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php  $this->db->where("id",$row->subject_id);
																$sname=$this->db->get("subject")->row(); 
																//print_r($sname);
																$this->db->where("id",$row->teacher);
																$ename=$this->db->get("employee_info")->row(); 
																echo $ename->name."<br/>".$sname->subject;?></td>
															<?php endif;}?>
													<?php endforeach;?>
													</tr>
													
												</tbody>
											</table>
										</div>
										
										<!-- end for Thursday -->
										<!-- for Friday -->
										<div id="friday" class="tab-pane">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
														$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code'");
														foreach($uniquePeriod->result() as $row):?>
														<th>
															<?php 
																if($row->period == ''){
																	echo "Lunch";
																}else{
																	echo $row->period;
																}
															?>
														</th>
														<?php endforeach;?>
													</tr>
													<tr>
														<th>Time Slot</th>
														
														<?php foreach($dt1 as $row): 
														
														$this->db->where("id",$row->period_id);
											             $this->db->where("school_code",$school_code);
														 $dt2=$this->db->get("period")->result();
														foreach($dt2 as $row1):

														 //print_r($row1); 
															
														 ?>
														<th><?php echo $row1->from; ?> to <?php echo $row1->to; ?></th>
														<?php endforeach;;
													endforeach;?>
														
														
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?php echo $class."-".$sec1;?></td>
														<?php foreach($dt1 as $row):
														 if($row->day == "Friday")
															{?>
															<?php if($row->teacher == ''):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php  $this->db->where("id",$row->subject_id);
																$sname=$this->db->get("subject")->row(); 
																//print_r($sname);
																$this->db->where("id",$row->teacher);
																$ename=$this->db->get("employee_info")->row(); 
																echo $ename->name."<br/>".$sname->subject;?></td>
															<?php endif;}?>
													<?php endforeach;?>
													</tr>
													
												</tbody>
											</table>										</div>
										
										<!-- end for Friday -->
										<div id="saturday" class="tab-pane">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
														$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code'");
														foreach($uniquePeriod->result() as $row):?>
														<th>
															<?php 
																if($row->period == ''){
																	echo "Lunch";
																}else{
																	echo $row->period;
																}
															?>
														</th>
														<?php endforeach;?>
													</tr>
													<tr>
														<th>Time Slot</th>
														
														<?php foreach($dt1 as $row): 
														
														$this->db->where("id",$row->period_id);
											             $this->db->where("school_code",$school_code);
														 $dt2=$this->db->get("period")->result();
														foreach($dt2 as $row1):

														 //print_r($row1); 
															
														 ?>
														<th><?php echo $row1->from; ?> to <?php echo $row1->to; ?></th>
														<?php endforeach;;
													endforeach;?>
														
														
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?php echo $class."-".$sec1;?></td>
														<?php foreach($dt1 as $row):
														 if($row->day == "Saturday")
															{?>
															<?php if($row->teacher == ''):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php  $this->db->where("id",$row->subject_id);
																$sname=$this->db->get("subject")->row(); 
																//print_r($sname);
																$this->db->where("id",$row->teacher);
																$ename=$this->db->get("employee_info")->row(); 
																echo $ename->name."<br/>".$sname->subject;?></td>
															<?php endif;}?>
													<?php endforeach;?>
													</tr>
													
												</tbody>
											</table>
										</div>
										
										<!-- for Saturday -->
									</div>
								</div>
							</div>
						</div>
						<!-- end: PAGE CONTENT-->
					
					