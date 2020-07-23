
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<!-- start: RESPONSIVE TABLE PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading panel-green">
					<h4 class="panel-title">
						Class Teacher <span class="text-bold"> Report</span>
					</h4>
					<div class="panel-tools">
						<div class="dropdown">
							<a data-toggle="dropdown"
								class="btn btn-xs dropdown-toggle btn-transparent-grey"> <i
								class="fa fa-cog"></i>
							</a>
							<ul class="dropdown-menu dropdown-light pull-right" role="menu">
								<li><a class="panel-collapse collapses" href="#"><i
										class="fa fa-angle-up"></i> <span>Collapse</span> </a></li>
								<li><a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i>
										<span>Refresh</span>
								</a></li>
								<li><a class="panel-config" href="#panel-config"
									data-toggle="modal"> <i class="fa fa-wrench"></i> <span>Configurations</span>
								</a></li>
								<li><a class="panel-expand" href="#"> <i class="fa fa-expand"></i>
										<span>Fullscreen</span>
								</a></li>
							</ul>
						</div>
						<a class="btn btn-xs btn-link panel-close" href="#"> <i
							class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="panel-body">

					<div class="alert btn-purple">
						<button data-dismiss="alert" class="close">×</button>
						<h4 class="media-heading text-center">Welcome to Class Wise List
							Area</h4>
						<p>Here you can see all class teacher, and also you can see all
							class students on click total student.</p>
					</div>
					<div class="row">
						<div class="col-md-12 space20">
							<div class="btn-group pull-right">
								<button data-toggle="dropdown"
									class="btn btn-green dropdown-toggle">
									Export <i class="fa fa-angle-down"></i>
								</button>
								<?php if($this->session->userdata('login_type') == 'admin'){?>
								<ul class="dropdown-menu dropdown-light pull-right">
									<li><a href="#" class="export-pdf" data-table="#sample-table-2">
											Save as PDF </a></li>
									<li><a href="#" class="export-png" data-table="#sample-table-2">
											Save as PNG </a></li>
									<li><a href="#" class="export-csv" data-table="#sample-table-2">
											Save as CSV </a></li>
									<li><a href="#" class="export-txt" data-table="#sample-table-2"
										data-ignoreColumn="3,4"> Save as TXT </a></li>
									<li><a href="#" class="export-xml" data-table="#sample-table-2"
										data-ignoreColumn="3,4"> Save as XML </a></li>
									<li><a href="#" class="export-sql" data-table="#sample-table-2"
										data-ignoreColumn="3,4"> Save as SQL </a></li>
									<li><a href="#" class="export-json"
										data-table="#sample-table-2" data-ignoreColumn="3,4"> Save as
											JSON </a></li>
									<li><a href="#" class="export-excel"
										data-table="#sample-table-2"> Export to Excel </a></li>
									<li><a href="#" class="export-doc" data-table="#sample-table-2"
										data-ignoreColumn="3,4"> Export to Word </a></li>
									<li><a href="#" class="export-powerpoint"
										data-table="#sample-table-2" data-ignoreColumn="3,4"> Export
											to PowerPoint </a></li>
								</ul>
								<?php }?>
							</div>
						</div>
					</div>


					<div class="table-responsive">

						<table class="table table-striped table-bordered"
							style="width: 100%; overflow-y: scroll;" id="sample-table-2">
							<thead>
								<tr style="background-color: #1ba593; color: white;">
									<th>Sno</th>
									<th>Class</th>
									<th>Section</th>
									<th>Stream</th>
									<th>Class Teacher</th>
									<th>Total Student</th>
								</tr>
							</thead>
<?php

$sno = 1;
foreach ( $class as $data ) {
	$id = $data->id;
	$row1 = $data->section;
	$row2 = $data->stream;
	$row3 = $data->class_teacher_id;
	
	$this->db->where ( 'id', $row1 );
	$section = $this->db->get ( 'class_section' )->row ();
	$this->db->where ( 'id', $row2 );
	$stream = $this->db->get ( 'stream' )->row ();
	$this->db->where ( 'id', $row3 );
	$clteacher = $this->db->get ( 'employee_info' )->row ();
	
	$this->db->where ( 'class_id', $id );
	$this->db->where ( 'fsd', $this->session->userdata ( 'fsd' ) );
	$this->db->where ( 'status', 1 );
	$class_id = $this->db->get ( 'student_info' );
	?>
 <?php if($sno%2==0){$rowcss="warning";}else{$rowcss ="danger";}?>
	                             
<tr class="<?php echo $rowcss;?> text-uppercase">
								<td><?php echo $sno;?></td>
								<td>
<?php echo $data->class_name;?>
</td>
								<td>
<?php echo $section->section;?>
</td>
								<td>
<?php echo $stream->stream;?>
</td>
								<td><b>
<?php if($row3==0){echo "Not Define";} else{echo $clteacher->name;}?></b>
								</td>
								<td><a
									href="<?php echo base_url();?>index.php/login/findclassstudent/<?php echo $id;?>"><?php echo $class_id->num_rows(); ?></a>
								</td>
							</tr>
<?php
	$sno ++;
}

?>

</table>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
