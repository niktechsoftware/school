<div class="row">
<div class="col-md-12">
		<!-- start: DYNAMIC TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-purple">
			
				<h4 class="panel-title">Top 10 <span class="text-bold">Absent Employee</span></h4>
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
               			<div class="col-md-12">
						<h2>Absent Employee List </h2>
						
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
						 $school_code= $this->session->userdata('school_code');
							$ss= $this->db->query("select `emp_id`, count(*) as totalCount FROM `teacher_attendance` where `attendance`= 0 AND `school_code` = '$school_code' GROUP BY `emp_id`, `attendance` ORDER BY COUNT(*) DESC LIMIT 10");
								if($ss->num_rows()>0){
									$emp_id= $ss->result();
									foreach($emp_id as $empID):
									$this->db->where('school_code',$this->session->userdata('school_code'));
							$this->db->where('id', $empID->emp_id);
							$emp= $this->db->get('employee_info');
						//	print_r($emp->result());
							if($emp->num_rows()>0){
								$empp= $emp->result();
								foreach($empp as $employee):
									
									// $this->db->where('id',$employee->class_id);
									// $studClass= $this->db->get('class_info');
									// if($studClass->num_rows()>0){
									// 	$studCls= $studClass->result();
									// 	foreach($studCls as $stud_class):
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $employee->username;?></td>
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
</div>
</div>
</div>
</div>
</div>
</div>