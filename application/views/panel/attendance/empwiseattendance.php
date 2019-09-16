<div class="row">
<div class="col-md-12">
		<!-- start: DYNAMIC TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-purple">
			
				<h4 class="panel-title">Employee <span class="text-bold">Wise Attendance Report</span></h4>
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
						<h2>Employee Wise </h2>
						
					<table style="width:100%; border:1px solid teal" class="table table-bordered" id="studattendance">
	<thead>
		<tr>
			<td>S. No.</td>
			<td>Name</td>
			<td>Attendance</td>
			<!-- <td>Attendance</td> -->
			<td>Attendance Date</td>
		</tr>
	</thead>
	<tbody>
		<?php 
		$i=1;
			if($view->num_rows()>0){
				foreach($view->result() as $emp):
					$this->db->where('emp_id',$emp->id);
					$empattendance = $this->db->get('teacher_attendance');
					if($empattendance->num_rows()>0){
						foreach($empattendance->result() as $row):
						?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $emp->name;?></td>
								<?php if($row->attendance !=0){?>
								<td><?php echo "Present";?></td><?php }else {
									?><td><span style="color:red;"><?php echo "Absent";?></span></td>
									<?php
								}?>
								<td><?php echo $row->a_date;?></td>
							</tr>
						<?php
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