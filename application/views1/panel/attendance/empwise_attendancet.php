<?php ?>
<table style="width:100%; border:1px solid teal" class="table table-bordered" id="studattendance">
					<thead>
						<tr>
							<td>S. No.</td>
							<td>Username</td>
							<td>Name</td>
							<td>Profession</td>
							<td>Present Days</td>
						</tr>
					</thead>
					<tbody>
						<?php 
					 	$data=array(); $i=1; $j=0;
							
								if($view->num_rows()>0){
									$emp_id= $view->result();
									foreach($emp_id as $empID):
									$this->db->where('school_code',$this->session->userdata('school_code'));
								$this->db->where('job_title','teacher');		
							$this->db->where('id', $empID->emp_id);
							$emp= $this->db->get('employee_info');
						//	print_r($emp->result());
							if($emp->num_rows()>0){
								$empp= $emp->result();
								foreach($empp as $employee):
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><a href="<?php echo base_url()?>/index.php/attendancepanel/teacherwiseatt/<?php echo $employee->username;?>"><?php echo $employee->username;?></a></td>
												<td><?php echo $employee->name;?></td>
												<td><?php echo $employee->job_title;?></td>
												<td><?php echo $empID->totalCount;?></td>
											</tr>
											
											<?php
											$i++;
										//endforeach;
									//}
								endforeach;
							}
						endforeach;
						}
						?>
					</tbody>
				</table>
				<?php $this->load->view('footerjs/noticejs');?>