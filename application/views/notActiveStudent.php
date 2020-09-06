<?php $this->db->where("status","0");
$result = $this->db->get("student_info");?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<!-- start: EXPORT DATA TABLE PANEL  -->
			<div class="panel panel-white">

				<div class="panel-heading panel-green">
					<h4 class="panel-title">Inactive <span class="text-bold">Student Data</span> List</h4>
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
				    <div class="alert alert-info" >
			<h3 class="media-heading text-center">Welcome to Inactive Student Area</h3>
			<p class="media-timestamp text-center"> Here you can see all your Inactive Student, If you want to see your Inactive Student Detail then click on Full Profile and
        if you want to Active this Student then click on Edit Profile and update his Status by click on Active.</div>
				    
					<div class="row">
						<div class="col-md-12 space20">
							<div class="btn-group pull-right">
								<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
									Export <i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu dropdown-light pull-right">
									<li>
										<a href="#" class="export-pdf" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as PDF
										</a>
									</li>
									<li>
										<a href="#" class="export-png" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as PNG
										</a>
									</li>
									<li>
										<a href="#" class="export-csv" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as CSV
										</a>
									</li>
									<li>
										<a href="#" class="export-txt" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as TXT
										</a>
									</li>
									<li>
										<a href="#" class="export-xml" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as XML
										</a>
									</li>
									<li>
										<a href="#" class="export-sql" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as SQL
										</a>
									</li>
									<li>
										<a href="#" class="export-json" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as JSON
										</a>
									</li>
									<li>
										<a href="#" class="export-excel" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Export to Excel
										</a>
									</li>
									<li>
										<a href="#" class="export-doc" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Export to Word
										</a>
									</li>
									<li>
										<a href="#" class="export-powerpoint" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Export to PowerPoint
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<div class="table-responsive">
						<div  class="center text-bold"><strong style="text"></div>
							<table class="table table-striped table-hover" id="sample-table-2">
								<thead>
									<tr style="background-color:#1ba593; color:white;">
										<th>SNo.</th>
										<th>Student ID</th>
										<th>Full Name</th>
										<th>Father Name</th>
										<th>Class</th> 
										<th>Section</th>
										<th>Address</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Settings</th>
									</tr>
								</thead>
								<tbody>
									<?php

									if($request->num_rows()>0){
									    $sno = 1; foreach ($request->result() as $row): ?>
									<tr>
										<td><?php echo $sno; ?></td>
										<td><?php echo $row->username; ?></td>
										<td><?php echo $row->name; ?></td>
										<?php 
										$this->db->where('school_code',$this->session->userdata('school_code'));
										$this->db->where('student_id',$row->stuid);
										$fname=$this->db->get('guardian_info');
										if($fname->num_rows()>0){
											$nm=$fname->row()->father_full_name;
										}else{
											$nm='N/A';
										}
										?>
										<td><?php echo $nm; ?></td>
										<?php $this->db->select('class_name,section');
											  $this->db->where('id',$row->class_id);
											  $this->db->where("school_code",$this->session->userdata("school_code"));
										      $classInfo=$this->db->get('class_info')->row();?>
										<td><?php echo $classInfo->class_name; ?></td>
										<?php $this->db->select('section');
											  $this->db->where('id',$classInfo->section);
											  $this->db->where("school_code",$this->session->userdata("school_code"));
										      $sectionInfo=$this->db->get('class_section')->row();?>
										<td><?php echo $sectionInfo->section; ?></td>
										<td><?php echo $row->address1; ?></td>
										<td><?php echo $row->email; ?></td>
										<td><?php echo $row->mobile; ?></td>
										
										<td><a href="<?php echo base_url(); ?>index.php/studentController/admissionSuccess/<?php echo $row->stuid ;?>">Full Profile</a></td>
									</tr>
									<?php $sno++; endforeach;
									}else{
											?>
									<?php }?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- end: EXPORT DATA TABLE PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->
</div>