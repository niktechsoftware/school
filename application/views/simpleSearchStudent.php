
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<!-- start: EXPORT DATA TABLE PANEL  -->
			<div class="panel panel-white">
			    

<?php if($Warning=$this->session->flashdata("Warning")){
	echo "<div class='alert alert-danger'>".$Warning."</div>";
}?>
				<div class="panel-heading panel-red">
					<h4 class="panel-title"> <span class="text-bold">Student Data Panel</span></h4>
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
				    			<div class="alert btn-purple">
				    			    <button data-dismiss="alert" class="close">×</button>
<h4 class="media-heading text-center">Welcome to Simple Search Student area</h4>
<p>If you want student full details , then  Click on full profile link ,
OR if you want to delete any student record then click on Delete link.<br>NOTE => if student Pay fee of any month
then you can't Delete any record of Students.<br>
And also we get Student Icard by click on username of that Student.
</p> </div>
				    
					<div class="row">
						<div class="col-md-12 space20">
							<div class="btn-group pull-right">
								<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
									Export <i class="fa fa-angle-down"></i>
								</button>
								<?php if($this->session->userdata('login_type') == 'admin'){?>
								<ul class="dropdown-menu dropdown-light pull-right">
									<!--<li>-->
									<!--	<a href="#" class="export-pdf" data-table="#sample-table-2" >-->
									<!--		Save as PDF-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-png" data-table="#sample-table-2">-->
									<!--		Save as PNG-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-csv" data-table="#sample-table-2" >-->
									<!--		Save as CSV-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-txt" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as TXT-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-xml" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as XML-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-sql" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as SQL-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-json" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as JSON-->
									<!--	</a>-->
									<!--</li>-->
									<li>
										<a href="#" class="export-excel" data-table="#sample-table-2" >
											Export to Excel
										</a>
									</li>
									<!--<li>-->
									<!--	<a href="#" class="export-doc" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Export to Word-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-powerpoint" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Export to PowerPoint-->
									<!--	</a>-->
									<!--</li>-->
								</ul>
								<?php }?>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<div class="table-responsive">
							<table class="table table-striped table-hover" id="sample-table-2">
								<thead>
									<tr style="background-color:#1ba593; color:white;">
										<th>SNo.</th>
										<th>Username</th>
										<th>Student Name</th>
										<th>Father Name</th>
										<th>Class</th>
										<th>Section</th>
								    	<th>D.O.B</th>
										<th>Address</th>
										<th>Mobile</th>
										<th>Settings</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php

									$sno = 1; foreach ($request as $row): 
									
										$this->db->where("username",$row->username);
										$snameid  = $this->db->get("student_info")->row();?>
									<tr>
										<td><?php echo $sno; ?></td>
										<!--<td><?php echo $row->username; ?></td>-->
										<td><a href="<?php echo base_url(); ?>index.php/studentController/invoice/<?php echo $snameid->id; ?>"><?php echo $row->username; ?></a></td>
										<td><?php echo strtoupper($row->name); ?></td>
										<?php 
									
										// $this->db->where("school_code",$school_code);
										$this->db->where("student_id",$snameid->id);
										$fname  = $this->db->get("guardian_info");
										if($fname->num_rows()>0){?>
										<td><?php echo strtoupper($fname->row()->father_full_name); ?></td>
										<?php } else{
										    ?>	<td><?php echo "Please Update";?></td>
									
										<?php } $this->db->select('class_name,section');
											  $this->db->where('id',$row->class_id);
										      $classInfo=$this->db->get('class_info')->row();?>
										<td><?php //echo $row->class_id; 
										echo strtoupper($classInfo->class_name)." "."[".($row->class_id)."]"; ?></td>
										<?php $this->db->select('section');
											  $this->db->where('id',$classInfo->section);
											  $this->db->where("school_code",$this->session->userdata("school_code"));
										      $sectionInfo=$this->db->get('class_section')->row();?>
										<td><?php echo $sectionInfo->section; ?></td>
										<td><?php echo $snameid->dob; ?></td>
										<td><?php echo ucwords($row->address1); ?></td>
										<td><?php echo $row->mobile; ?></td>
										<td><a href="<?php echo base_url(); ?>index.php/studentController/admissionSuccess/<?php echo $snameid->id;?>">Full Profile</a></td>
										<td>
										<?php if($this->session->userdata('login_type') == 'admin'){ ?>

										<a href="<?php echo base_url(); ?>index.php/studentController/deleteStudent/<?php echo $snameid->id;?>">Delete</a></td>
										<?php }?>
									</tr>
									<?php $sno++; endforeach; ?>
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