


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
														$school_code = $this->session->userdata("school_code");
														$uniquePeriod=$this->db->query("SELECT * from period where school_code ='$school_code'");
														 
														// print_r($uniquePeriod->num_rows());
														foreach($uniquePeriod->result() as $row):
														

														?>
														<th>
															<?php 
																if($row->period == ''){
																	echo "Lunch";
																} else{
																	echo $row->period;
																}
															?>
														</th>
														<?php endforeach;?>
													</tr>
													<tr>
														<th></th>
														<?php foreach($period->result() as $pdata)
																	{
																	foreach($timetable->result() as $tdata)
																	{
																		if($tdata->time_thead_id==$pdata->id)
																		{
																		
																	?>
														<th><?php echo $pdata->from; ?>&nbsp;&nbsp;&nbsp;<?php echo $pdata->to; ?>
														</th>
														<?php 	}
																	}	
																	}	?>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td></td>
														<?php foreach($period->result() as $pdata)
																	{
																	foreach($timetable->result() as $tdata)
																	{
																		if($tdata->time_thead_id==$pdata->id)
																		{
																		//   print_r($tdata);
																		// 	exit();
														 if($tdata->day == "Monday")
															{ ?>
															<?php if($tdata->teacher == ''):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php echo $tdata->class_id."<br/>".$tdata->subject_id;?></td>
															<?php endif; }?>
													<?php 	}
																	}	
																	}?>
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
														$uniquePeriod=$this->db->query("SELECT * from period where school_code='$school_code'");
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
														<th></th>
														<?php foreach($period->result() as $pdata)
																	{
																	foreach($timetable->result() as $tdata)
																	{
																		if($tdata->time_thead_id==$pdata->id)
																		{
																		
																	?>
														<th><?php echo $pdata->from; ?>&nbsp;&nbsp;&nbsp;<?php echo $pdata->to; ?>
														</th>
														<?php 	}
																	}	
																	}	?>
													</tr>
												</thead>
												<tbody>
													<tr>
															<td></td>
															<?php foreach($period->result() as $pdata)
																	{
																	foreach($timetable->result() as $tdata)
																	{
																		if($tdata->time_thead_id==$pdata->id)
																		{
														 if($tdata->day == "Tuesday")
															{ ?>
															<?php if($tdata->teacher == ''):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php echo $tdata->class_id."<br/>".$tdata->subject_id;?></td>
															<?php endif; }?>
													<?php 	}
																	}	
																	}?>
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
														$uniquePeriod=$this->db->query("SELECT * from period where school_code='$school_code'");
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
														<th></th>
														<?php foreach($period->result() as $pdata)
																	{
																	foreach($timetable->result() as $tdata)
																	{
																		if($tdata->time_thead_id==$pdata->id)
																		{
																		
																	?>
														<th><?php echo $pdata->from; ?>&nbsp;&nbsp;&nbsp;<?php echo $pdata->to; ?>
														</th>
														<?php 	}
																	}	
																	}	?>
													</tr>
												</thead>
												<tbody>
													<tr>
															<td></td>
															<?php foreach($period->result() as $pdata)
																	{
																	foreach($timetable->result() as $tdata)
																	{
																		if($tdata->time_thead_id==$pdata->id)
																		{
														 if($tdata->day == "Wednesday")
															{ ?>
															<?php if($tdata->teacher == ''):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php echo $tdata->class_id."<br/>".$tdata->subject_id;?></td>
															<?php endif; }?>
													<?php 	}
																	}	
																	}?>
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
														$uniquePeriod=$this->db->query("SELECT * from period where school_code='$school_code'");
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
														<th></th>
														<?php foreach($period->result() as $pdata)
																	{
																	foreach($timetable->result() as $tdata)
																	{
																		if($tdata->time_thead_id==$pdata->id)
																		{
																		
																	?>
														<th><?php echo $pdata->from; ?>&nbsp;&nbsp;&nbsp;<?php echo $pdata->to; ?>
														</th>
														<?php 	}
																	}	
																	}	?>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td></td>
														<?php foreach($period->result() as $pdata)
																	{
																	foreach($timetable->result() as $tdata)
																	{
																		if($tdata->time_thead_id==$pdata->id)
																		{
														 if($tdata->day == "Thursday")
															{ ?>
															<?php if($tdata->teacher == ''):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php echo $tdata->class_id."<br/>".$tdata->subject_id;?></td>
															<?php endif; }?>
													<?php 	}
																	}	
																	}?>
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
														$uniquePeriod=$this->db->query("SELECT * from period where school_code='$school_code'");
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
														<th></th>
														<?php foreach($period->result() as $pdata)
																	{
																	foreach($timetable->result() as $tdata)
																	{
																		if($tdata->time_thead_id==$pdata->id)
																		{
																		
																	?>
														<th><?php echo $pdata->from; ?>&nbsp;&nbsp;&nbsp;<?php echo $pdata->to; ?>
														</th>
														<?php 	}
																	}	
																	}	?>
													</tr>
												</thead>
												<tbody>
													<tr>
															<td></td>
															<?php foreach($period->result() as $pdata)
																	{
																	foreach($timetable->result() as $tdata)
																	{
																		if($tdata->time_thead_id==$pdata->id)
																		{
														 if($tdata->day == "Friday")
															{ ?>
															<?php if($tdata->teacher == ''):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php echo $tdata->class_id."<br/>".$tdata->subject_id;?></td>
															<?php endif; }?>
													<?php 	}
																	}	
																	}?>
													</tr>
													
												</tbody>
											</table>
										</div>
										
										<!-- end for Friday -->
										<div id="saturday" class="tab-pane">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
														$uniquePeriod=$this->db->query("SELECT * from period where school_code='$school_code'");
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
														<th></th>
														<?php foreach($period->result() as $pdata)
																	{
																	foreach($timetable->result() as $tdata)
																	{
																		if($tdata->time_thead_id==$pdata->id)
																		{
																		
																	?>
														<th><?php echo $pdata->from; ?>&nbsp;&nbsp;&nbsp;<?php echo $pdata->to; ?>
														</th>
														<?php 	}
																	}	
																	}	?>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td></td>
														<?php foreach($period->result() as $pdata)
																	{
																	foreach($timetable->result() as $tdata)
																	{
																		if($tdata->time_thead_id==$pdata->id)
																		{
														 if($tdata->day == "Saturday")
															{ ?>
															<?php if($tdata->teacher == ''):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php echo $tdata->class_id."<br/>".$tdata->subject_id;?></td>
															<?php endif; }?>
													<?php 	}
																	}	
																	}?>
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
					
					