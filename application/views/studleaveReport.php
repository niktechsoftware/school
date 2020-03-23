
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<!-- start: EXPORT DATA TABLE PANEL  -->
			<div class="panel panel-white">
			    

<?php if($Warning=$this->session->flashdata("Warning")){
	echo "<div class='alert alert-danger'>".$Warning."</div>";
}?>
				<div class="panel-heading panel-red">
					<h4 class="panel-title">Student <span class="text-bold">Leave</span> Details</h4>
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
<h4 class="media-heading text-center">Welcome to Student Leave Detail Area</h4>
<p>If you want to Approve the leave of the student, then  Click on Approve Button,
or if you want to Cancel student leave then click on Cancel Button.<br>NOTE =>Student leave may be Approve By the Class Teacher </div>
				    
					<div class="row">
						<div class="col-md-12 space20">
							<div class="btn-group pull-right">
								<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
									Export <i class="fa fa-angle-down"></i>
								</button>
								<?php if($this->session->userdata('login_type') == 'admin'){?>
								<ul class="dropdown-menu dropdown-light pull-right">
									<li>
										<a href="#" class="export-pdf" data-table="#sample-table-2" >
											Save as PDF
										</a>
									</li>
									<li>
										<a href="#" class="export-png" data-table="#sample-table-2">
											Save as PNG
										</a>
									</li>
									<li>
										<a href="#" class="export-csv" data-table="#sample-table-2" >
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
										<a href="#" class="export-excel" data-table="#sample-table-2" >
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
								<?php }?>
							</div>
						</div>
					</div>
					<div class="table-responsive">
					   <?php  if($request->num_rows()>0)
                                             {?>
							<table class="table table-striped table-hover" id="sample-table-2">
								<thead>
									<tr style="background-color:#1ba593; color:white;">
										<th>SNo.</th>
										<th>Username(id)</th>
										<th>Student Name</th>
										<th>Class & Section</th>
										<th>Mobile Number</th>
										<th>Address</th>
										<th>Total Leave Days</th>
										<th>Leave Start Date</th>
										<th>Leave End Date</th>
										<th>Reason</th>
										<th>Status</th>
										<th colspan="2" class="text-center">Action</th>
										
									</tr>
								</thead>
								<tbody>
									<?php
                                            
									$sno = 1; foreach ($request->result() as $row): 
									
										$this->db->where("id",$row->stu_id);
										$snameid  = $this->db->get("student_info")->row();?>
									<?php if($sno%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
                                       <tr class="<?php echo $rowcss;?>">
										<td><?php echo $sno; ?></td>
										<td><?php echo $snameid->username; ?>
										
										</td>
										<td><?php echo strtoupper($snameid->name); ?></td>
									  <?php	$this->db->select('class_name,section');
											  $this->db->where('id',$snameid->class_id);
										      $classInfo=$this->db->get('class_info');
										      if($classInfo->num_rows()>0){

										      $this->db->select('section');
											  $this->db->where('id',$classInfo->row()->section);
											  $this->db->where("school_code",$this->session->userdata("school_code"));
										      $sectionInfo=$this->db->get('class_section')->row();?>
										<td><?php echo strtoupper($classInfo->row()->class_name."[".$sectionInfo->section."]"); ?></td>
										<td><?php echo strtoupper($snameid->mobile); ?></td>
										<td><?php echo strtoupper($snameid->address1); ?></td>
										<td><?php echo   $row->total_leave; ?></td>
										<td><?php echo   $row->start_date; ?></td>
										<td><?php echo   $row->end_date; ?></td>
										<td><?php echo  strtoupper($row->reason); ?></td>
										<?php if($row->approve=="NO"){?>
                                        <td><?php echo "NO"; ?></td>
                                        <?php } else { ?>
                                          <td><?php echo "YES"; ?></td>
                                           <?php } ?>
                                         <?php if($row->approve=="NO"){?>  
										<td><button type='submit' class="btn btn-light-blue" id="Approve<?php echo $sno ;?>">Approve</button>
										<input type="hidden" name="id" id="id<?php echo $sno ;?>" value="<?php echo $row->stu_id?>"> 
												</td>
									  <td><button type='submit' class="btn btn-light-red" id="notApprove<?php echo $sno ;?>">Cancel</button> 
									  <input type="hidden" name="id" id="id<?php echo $sno ;?>" value="<?php echo $row->stu_id?>">			
									</td>
										 <?php } else { ?>
                                         <td><button type='submit' class="btn btn-light-green" id="Approved">Approved</button> 
										</td>
										
                                           <?php } }?>
									</tr>
									
									<?php $sno++; endforeach; ?>
								
								<tr>
									<td colspan="12">
                                   
									</td>
									<tr>
								
								</tbody>
							</table>
							<?php }else{
							?>
							 <div class="alert alert-danger">
		                       <?php  echo "<h4>No leave are requested by Student</h4>";?>
			                     </div>
			                     <?php }?>
						</div>
					</div>
				</div>
			</div>
			<!-- end: EXPORT DATA TABLE PANEL -->
           

		</div>
	</div>
	<!-- end: PAGE CONTENT-->