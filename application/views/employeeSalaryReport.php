<?php $school_code = $this->session->userdata("school_code");?>
<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">

			<div class="panel-heading panel-green">
				<h4 class="panel-title">Employee <span class="text-bold">Salary Report</span></h4>
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
				<form method="post">
				    		<div class="alert alert-info">
		    <button data-dismiss="alert" class="close">×</button>
                <h3 class="media-heading text-center">Welcome to Employee Salary Report</h3>
                <p class="media-timestamp">Welcome to Employee Salary Report area
                if you want to see Employee Salary Report then select FSD and Click on Get Salary Detail.You can also see Full Salary Detail of perticular Employee just click on View Detail. </div>
					<div class="row">
						<div class="col-sm-3">
							&nbsp;
						</div>
						<div class="col-sm-2">
							<strong>Finance Start Date</strong>
						</div>
						<div class="col-sm-2">
							<select class="form-controll" name="fsd">
								<option value="">-Select FSD-</option>
								<?php $f = $this->db->query("SELECT * FROM fsd WHERE school_code='$school_code'");?>
								<?php if($f->num_rows() > 0){?>
									<?php foreach($f->result() as $row):?>
										<option value="<?php echo $row->id;?>"><?php echo date("d-M-Y",strtotime($row->finance_start_date));?></option>
									<?php endforeach;?>
								<?php } ?>
							</select>
						</div>
						<div class="col-sm-3">
							<button type="submit" class="btn btn-success">Get Salary Detail</button>
						</div>
					</div>
				</form>
				<?php
// 			echo  $this->input->post("fsd");
// 			              	exit;
				if(strlen($this->input->post("fsd")) > 0):?>
				<div class="col-sm-12">
					<div class="table-responsive" id="rahul">
						<?php
						 
						  $f1=$this->input->post("fsd");
	                        $school_code=$this->session->userdata("school_code");
						   $employee=$this->db->query("SELECT distinct emp_id from emp_salary_info WHERE fsd='$f1' AND school_code='$school_code'");
						   
							if($employee->num_rows() > 0):
							$this->db->where("school_code",$school_code);
							$isData = $this->db->count_all("emp_salary_info");
								
							if($isData > 0):
						?>
								<br/><br/>
								<div class="row">
									<div class="col-md-12 space20">
										<div class="btn-group pull-right">
											<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
												Export <i class="fa fa-angle-down"></i>
											</button>
											<ul class="dropdown-menu dropdown-light pull-right">
												<li>
													<a href="#" class="export-excel" data-table="#sample-table-2" data-ignoreColumn ="3,4">
														Export to Excel
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="table-responsive">
									<table class="table table-striped table-hover" id="example">
										<thead>
											<tr  class=" text-uppercase alert alert-block alert-danger fade in">
												<th>S.no.</th>
												<th>User ID</th>
												<th>Empolyee Name</th>
												<th>Joining Date</th>
												<td class="text-bold">Job Category</td>
												<th>Address</th>
												<th>Total Paid</th>
												<th>Full Detail</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$fsd = $this->input->post("fsd");
										    $count = 1;
										    foreach($employee->result() as $empDetail):
										        
										    $emp_id = $empDetail->emp_id;
										    
										     $this->db->where('school_code',$school_code);
										       $this->db->where('id',$emp_id);
										        $this->db->where('status',1);
										    $emppp=$this->db->get('employee_info');
										    if($emppp->num_rows()>0){
										    
										    $total = $this->db->query("SELECT SUM(gross_s) as totalPaid from emp_salary_info WHERE emp_id = '$emp_id' AND fsd='$fsd' AND school_code='$school_code'")->row();
										    
										     ?>
										      <?php if($count%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
	                                        <tr class="<?php echo $rowcss;?> text-uppercase">
									  			<td><?php echo $count;?></td>
									  			<td><?php echo $emppp->row()->username;?>
									  			<td><?php echo $emppp->row()->name; ?></td>
									  			<td><?php echo date("d-M-Y",strtotime($emppp->row()->join_date));?></td>
									  			<td><?php echo $emppp->row()->job_title;?></td>
									  			<td><?php echo $emppp->row()->address;?></td>
									  			<td>
									  				<?php
									  					if($total->totalPaid > 0):
															echo $total->totalPaid;
														else:
															echo "0";
														endif;
													?>
												</td>
									  			<td>
									  				<?php 	if($total->totalPaid > 0): ?>
														<a href="<?php echo base_url()?>index.php/employeeController/fullDetail/<?php echo $emp_id;?>" target="_blank" class="btn btn-blue">
															View Detail
														</a>
													<?php else:?>
														<a href="#" class="btn btn-danger">
															Not Paid
														</a>
													<?php endif;?>
									  			</td>
									  		</tr>
									  		<?php
									  			$count++;
									  		?>
									  		<?php } endforeach;?>
										</tbody>
									</table>
								</div>
								<?php else: ?>
								<br/><br/>
									<div class="alert alert-block alert-danger fade in">
										<button data-dismiss="alert" class="close" type="button">
											&times;
										</button>
										<h4 class="alert-heading"><i class="fa fa-times"></i> Error! <?php echo $employee->num_rows();?></h4>
										<h5>
											No record found from Salary database please Pay Empolyee  Salary of Any Month &amp; Other...
										</h5>
									</div>
								<?php endif; ?>
						<?php else: // if student_info not return any value... ?>
							<br/><br/>
							<div class="alert alert-block alert-danger fade in">
								<button data-dismiss="alert" class="close" type="button">
									&times;
								</button>
								<h4 class="alert-heading"><i class="fa fa-times"></i> Error ! <?php echo $employee->num_rows();?></h4>
								<h5>
									No record found from Salary database please Pay Empolyee  Salary of Any Month &amp; Other...
								</h5>
							
							</div>
						<?php endif; ?>


						<script>
							TableExport.init();
						</script>
					</div><!-- end: table-responsive -->
				</div>
				<?php endif;?>
			</div><!-- end: panel Body -->
		</div><!-- end: panel panel-white -->

	</div><!-- end: MAIN PANEL COL-SM-12 -->
</div><!-- end: PAGE ROW-->
