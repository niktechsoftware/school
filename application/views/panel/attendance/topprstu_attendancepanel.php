<div class="row">
<div class="col-md-12">
		<!-- start: DYNAMIC TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-purple">
			
				<h4 class="panel-title">Top 10 <span class="text-bold">Present Student</span></h4>
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
						<h2> Attendence </h2>
						<?php 
						$school_code = $this->session->userdata('school_code');
						$rows = $this->db->query("SELECT DISTINCT stu_id FROM attendance where school_code = $school_code");
						?>
				<table style="width:100%; border:1px solid teal" class="table table-bordered" id="studattendance">
					<thead>
						<tr>
							<td>S. No.</td>
							<td>Username</td>
							<td>Name</td>
							<td>Class</td>
							<td>Present Days</td>
						</tr>
					</thead>
					<tbody>
						<?php 
						 $data=array(); $i=1; $j=0;
						 $school_code= $this->session->userdata('school_code');
						// print_r($school_code);exit();
							$ss= $this->db->query("select `stu_id`, count(*) as totalCount FROM `attendance` where `attendance` != 0 AND `school_code`= '$school_code' GROUP BY `stu_id`, `attendance` ORDER BY COUNT(*) DESC LIMIT 10");
								if($ss->num_rows()>0){
									$stud_id= $ss->result();
									foreach($stud_id as $studID):
							$this->db->where('id', $studID->stu_id);

							$stud= $this->db->get('student_info');
							if($stud->num_rows()>0){
								$studd= $stud->result();
								foreach($studd as $student1):
									$this->db->where('school_code',$this->session->userdata('school_code'));
									$this->db->where('id',$student1->class_id);
									$studClass= $this->db->get('class_info');
									if($studClass->num_rows()>0){
										$studCls= $studClass->result();
										foreach($studCls as $stud_class):
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $student1->username;?></td>
												<td><?php echo $student1->name;?></td>
												<td><?php echo $stud_class->class_name;?></td>
												<td><?php echo $studID->totalCount;?></td>
											</tr>
											
											<?php
											$i++;
										endforeach;
									}
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
