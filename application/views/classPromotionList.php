
		<div class="row">
							<div class="col-md-12">
								<!-- start: DYNAMIC TABLE PANEL -->
								<div class="panel panel-white">


								  <div class="panel-heading panel-purple">

										<h4 class="panel-title">Class  <span class="text-bold">Promotion Report</span></h4>

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
									<br>
									<div class="panel-body">
								<div class="alert alert-info">
								<h3 class="media-heading text-center">Welcome to Class Promotion Report Area</h3>
								<p class="media-timestamp">To know the list of class advancement for all your students,
								 choose the class given below and choose the department and you can get complete 
								 information about the class progress of all your students.</p>
								 </div>
									<div class="text-blue text-large"> </div><br><br>
									<div class="row">
										<div class="col-sm-12" id="validId"></div>
									</div>
									<div class="row space20">
						
									<div class="form-group">
					<?php 
					$school_code=$this->session->userdata('school_code');
						$detail = $this->db->query("SELECT * FROM fsd where school_code='$school_code' Order BY id");
						//$detail1 = $this->db->query("SELECT finance_start_date FROM `old_fee_deposit` where school_code='$school_code' GROUP BY finance_start_date ");
						// if(($detail->num_rows() > 0)||($detail1->num_rows() > 0))
						if(($detail->num_rows() > 0)){
							
					?>
					<label class="col-sm-1 control-label">
						Finance Start Date <span class="symbol required"></span>
					</label>
					<div class="col-sm-2">
						<select class="form-control" id="fsd1" name = "fsd" style="width: 150px;">
							<option value="">-select FSD-</option>
		                      			<?php 
		                      			
		                      			if(($detail->num_rows() > 0)){
		                      			foreach($detail->result() as $row):?>
		                      				
		                      			<option value="<?php echo $row->id;?>">
		                      			<?php echo date("d-M-y", strtotime($row->finance_start_date));?>
		                      		</option>
		                      		<?php endforeach;}?>
						</select>
					</div>
					<?php } ?>

					<label class="col-sm-1 control-label">
						Section <span class="symbol required"></span>
					</label>
					<div class="col-sm-2">
						<select class="form-control" id="classv1" name="class" style="width: 150px;">
							<option value="">-Select Section-</option>
							<?php foreach($request as $row):
								  $sectionid=$row->section;
								  $this->db->where('school_code',$school_code);
								   $this->db->where('id',$sectionid);
							 $row=$this->db->get('class_section')->row();         
								  ?>
							<option value="<?php echo $row->id;?>"><?php echo $row->section;?></option>
							<!-- <option value="all"></option> -->
							<?php endforeach; ?>
							<!-- <option value="all">All Section</option> -->
						</select>
					</div>

					<label class="col-sm-1 control-label">
						Class<span class="symbol required"></span>
					</label>
					<div class="col-sm-3"  >
						<select class="form-control" id="sectionId1" name="class">
						</select>
					</div>
				</div>

				</div>
					<div class="table-responsive" style="width:100%; overflow-y: scroll;">
							<div id="rahul1">

							</div>

					</div>


				</div>
			</div>
		</div>
		</div>



						<!-- end: PAGE CONTENT-->
