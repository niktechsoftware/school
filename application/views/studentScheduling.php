		<?php $snm=$this->session->userdata('username');
			$this->db->where("username",$snm);
			$dt=$this->db->get("student_info")->row();
			$cid=$dt->class_id;
			$this->db->where("id",$cid);
			$dtf=$this->db->get("class_info")->row();
			$school_code=$dtf->school_code;
			//$this->db->where('school_code',$school_code);
			//$pp=$this->db->get('period');
			//foreach($pp->result() as $p1){
			//$p11=$p1->id;
			//$this->db->where("period_id",$p11);
             $this->db->where("class_id",$cid);
             // $this->db->where("school_code",$school_code);
			$dt1=$this->db->get("time_table")->result();
			//print_r($dt1);
			//} exit();
           // $pid= $dt1->period_id;
           // print_r($dt1);
           
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
										<div class="table-responsive">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
														$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code' and nop_id='$period'");
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
														// print_r($row->period_id);
														foreach($dt2 as $row1):
														// print_r($row1); 
														if($row1->period == ''){ 
															?>
															<th><?php echo $row1->from; ?> to <?php echo $row1->to; ?></th>
														<?php }else{ ?>
															<th><?php echo $row1->from; ?> to <?php echo $row1->to; ?></th>
														<?php }
														 ?>
														
														<?php endforeach;
													endforeach;?>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?php echo $class."-".$sec1;?></td>
														<?php foreach($dt1 as $row):
														$this->db->where('time_table_id',$row->id);
														$days= $this->db->get('time_table_days');
														if($days->num_rows()>0){
															foreach($days->result() as $row1):
														 if($row1->days_id == "1")
															{ ?>
															<?php if(($row->teacher == '') && ($ror->subject_id == '')):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php  $this->db->where("id",$row->subject_id);
																$sname=$this->db->get("subject")->row(); 
																//print_r($sname);
																$this->db->where("id",$row->teacher);
																$ename=$this->db->get("employee_info"); 
																if($ename->num_rows()>0){
																echo $ename->row()->name."<br/>".$sname->subject;}?></td>
															<?php endif;} 
														endforeach; 
														} ?>
													<?php endforeach;?>
													</tr>
												</tbody>
											</table>
											</div>	
										</div>
										<!-- for Tuesday -->
										<div id="tuesday" class="tab-pane">
										   <div class="table-responsive">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
													$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code' and nop_id='$period'");
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
														$this->db->where('time_table_id',$row->id);
														$days= $this->db->get('time_table_days');
														if($days->num_rows()>0){
															foreach($days->result() as $row1):
														 if($row1->days_id == "2")
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
															<?php endif;}
															endforeach; } ?>
													<?php endforeach;?>
													</tr>
													
												</tbody>
											</table>
										</div>	
										</div>
										<!-- end for Tuesday -->
										<!-- for Wednesday -->
										<div id="wednesday" class="tab-pane">
										 	<div class="table-responsive">   
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
														$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code' and nop_id='$period'");
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
														$this->db->where('time_table_id',$row->id);
														$days= $this->db->get('time_table_days');
														if($days->num_rows()>0){
															foreach($days->result() as $row1):
														 if($row1->days_id == "3")
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
															<?php endif;}
															endforeach; } ?>
													<?php endforeach;?>
													</tr>
													
												</tbody>
											</table>
											</div>
										</div>
										
										<!-- end for Wednesday -->
										<!-- for thursday -->
										<div id="thursday" class="tab-pane">
										   <div class="table-responsive">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
														$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code' and nop_id='$period'");
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
														$this->db->where('time_table_id',$row->id);
														$days= $this->db->get('time_table_days');
														if($days->num_rows()>0){
															foreach($days->result() as $row1):
														 if($row1->days_id == "4")
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
															<?php endif;}
															endforeach; } ?>
													<?php endforeach;?>
													</tr>
													
												</tbody>
											</table>
										</div>
										</div>
										
										<!-- end for Thursday -->
										<!-- for Friday -->
										<div id="friday" class="tab-pane">
										   	<div class="table-responsive"> 
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
														$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code' and nop_id='$period'");
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
														$this->db->where('time_table_id',$row->id);
														$days= $this->db->get('time_table_days');
														if($days->num_rows()>0){
															foreach($days->result() as $row1):
														 if($row1->days_id == "5")
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
															<?php endif;}
															endforeach; } ?>
													<?php endforeach;?>
													</tr>
													
												</tbody>
											</table>										</div>
										</div>
									
										<!-- end for Friday -->
										<div id="saturday" class="tab-pane">
										   <div class="table-responsive">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
														$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code' and nop_id='$period'");
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
														$this->db->where('time_table_id',$row->id);
														$days= $this->db->get('time_table_days');
														if($days->num_rows()>0){
															foreach($days->result() as $row1):
														 if($row1->days_id == "6")
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
															<?php endif;}
															endforeach; } ?>
													<?php endforeach;?>
													</tr>
													
												</tbody>
											</table>
										</div>
										</div>
										<!-- for Saturday -->
									</div>
								</div>
							</div>
						</div>
						<!-- end: PAGE CONTENT-->
					
					