<div class="panel-body">
						<div class="row">
							<div class="col-sm-12">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Day</th>
											<?php 
											$lunch = 0;
											$uniquePeriod=$this->db->query("SELECT * from period WHERE nop_id ='$timeTable'");
											foreach($uniquePeriod->result() as $row):?>
											<th>
												<?php 
													if($row->period == ''){
														echo "Lunch";
													}else{
														echo $row->period;
													}
													$lunch = $row->lunch;
												?>
											</th>
											<?php endforeach;?>
										</tr>
										<tr>
											<th></th>
											<?php
												foreach($uniquePeriod->result() as $row):
											?>
											<th>
												<?php 
													echo $row->to." - ".$row->from;
												?>
											</th>
											<?php 
												endforeach;
											?>
										</tr>
									</thead>
									<tbody>									
										<tr>
											<td>Monday</td>
											<?php $i = 1;?>
											<?php $timetable = $this->db->query("SELECT * FROM time_table WHERE  teacher = '".$this->session->userdata('id')."'");?>
                                            <?php
                                            
                                             foreach($timetable->result() as $row):
                                                $this->db->where('id',$row->class_id);
                                                $class=$this->db->get('class_info')->row();
                                                $this->db->where('id',$row->subject_id);
                                                $subject= $this->db->get('subject')->row();
                                               ?>
												<?php if($lunch == $i):?>
													<td><?php echo "Lunch";?></td>
                                                    <?php 
                                                    //print_r($lunch);exit();
                                                   
                                                   ?>
													<td><?php if($class->class_name){echo $class->class_name; } else {echo "N/A";}?><br><?php if($subject->subject) {echo $subject->subject;}else{ echo "N/A";}?></td>
												<?php else:?>
													<td><?php if($class->class_name){echo $class->class_name; } else {echo "N/A";}?><br><?php if($subject->subject) {echo $subject->subject;}else{ echo "N/A";}?></td>
												<?php endif;?>
											<?php $i++; endforeach;?>
										</tr>
										<tr>
											<td>Tuesday</td>
											<?php $i = 1;?>
											<?php $timetable = $this->db->query("SELECT * FROM time_table WHERE  teacher = '".$this->session->userdata('id')."'");?>
                                            <?php foreach($timetable->result() as $row):
                                                 $this->db->where('id',$row->class_id);
                                                 $class=$this->db->get('class_info')->row();
                                                 $this->db->where('id',$row->subject_id);
                                                 $subject= $this->db->get('subject')->row();?>
												<?php if($lunch == $i):?>
													<td><?php echo "Lunch";?></td>
													<td><?php if($class->class_name){echo $class->class_name; } else {echo "N/A";}?><br><?php if($subject->subject) {echo $subject->subject;}else{ echo "N/A";}?></td>
												<?php else:?>
													<td><?php if($class->class_name){echo $class->class_name; } else {echo "N/A";}?><br><?php if($subject->subject) {echo $subject->subject;}else{ echo "N/A";}?></td>
												<?php endif;?>
											<?php $i++; endforeach;?>
										</tr>
										<tr>
											<td>Wednesday</td>
											<?php $i = 1;?>
											<?php $timetable = $this->db->query("SELECT * FROM time_table WHERE  teacher = '".$this->session->userdata('id')."' ");?>
											<?php foreach($timetable->result() as $row):?>
												<?php if($lunch == $i):?>
													<td><?php echo "Lunch";?></td>
													<td><?php if($class->class_name){echo $class->class_name; } else {echo "N/A";}?><br><?php if($subject->subject) {echo $subject->subject;}else{ echo "N/A";}?></td>
												<?php else:?>
													<td><?php if($class->class_name){echo $class->class_name; } else {echo "N/A";}?><br><?php if($subject->subject) {echo $subject->subject;}else{ echo "N/A";}?></td>
												<?php endif;?>
											<?php $i++; endforeach;?>
										</tr>
										<tr>
											<td>Thursday</td>
											<?php $i = 1;?>
											<?php $timetable = $this->db->query("SELECT * FROM time_table WHERE  teacher = '".$this->session->userdata('id')."'");?>
											<?php foreach($timetable->result() as $row):?>
												<?php if($lunch == $i):?>
													<td><?php echo "Lunch";?></td>
													<td><?php if($class->class_name){echo $class->class_name; } else {echo "N/A";}?><br><?php if($subject->subject) {echo $subject->subject;}else{ echo "N/A";}?></td>
												<?php else:?>
													<td><?php if($class->class_name){echo $class->class_name; } else {echo "N/A";}?><br><?php if($subject->subject) {echo $subject->subject;}else{ echo "N/A";}?></td>
												<?php endif;?>
											<?php $i++; endforeach;?>
										</tr>
										<tr>
											<td>Friday</td>
											<?php $i = 1;?>
											<?php $timetable = $this->db->query("SELECT * FROM time_table WHERE  teacher = '".$this->session->userdata('id')."'");?>
											<?php foreach($timetable->result() as $row):?>
												<?php if($lunch == $i):?>
													<td><?php echo "Lunch";?></td>
													<td><?php if($class->class_name){echo $class->class_name; } else {echo "N/A";}?><br><?php if($subject->subject) {echo $subject->subject;}else{ echo "N/A";}?></td>
												<?php else:?>
													<td><?php if($class->class_name){echo $class->class_name; } else {echo "N/A";}?><br><?php if($subject->subject) {echo $subject->subject;}else{ echo "N/A";}?></td>
												<?php endif;?>
											<?php $i++; endforeach;?>
										</tr>
										<tr>
											<td>Saturday</td>
											<?php $i = 1;?>
											<?php $timetable = $this->db->query("SELECT * FROM time_table WHERE  teacher = '".$this->session->userdata('id')."'");?>
											<?php foreach($timetable->result() as $row):?>
												<?php if($lunch == $i):?>
													<td><?php echo "Lunch";?></td>
													<td><?php if($class->class_name){echo $class->class_name; } else {echo "N/A";}?><br><?php if($subject->subject) {echo $subject->subject;}else{ echo "N/A";}?></td>
												<?php else:?>
													<td><?php if($class->class_name){echo $class->class_name; } else {echo "N/A";}?><br><?php if($subject->subject) {echo $subject->subject;}else{ echo "N/A";}?></td>
												<?php endif;?>
											<?php $i++; endforeach;?>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>