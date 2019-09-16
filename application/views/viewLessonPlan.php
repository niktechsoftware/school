<?php 		$logtype = $this->session->userdata('login_type');
				if($logtype == "admin"){?>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-white">
								<div class="panel-heading panel-blue">
										<i class="fa fa-external-link-square"></i>
										View Lesson Plan :
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
											<a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i> <span>Refresh</span> </a>
											</li>
											<li>
											<a class="panel-config" href="#panel-config" data-toggle="modal"> <i class="fa fa-wrench"></i> <span>Configurations</span></a>
											</li>
											<li>
											<a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a>
											</li>
											</ul>
									</div>
								</div>
							</div> <!-- End Panel Heading -->
							<div class="panel-body">
								<form action ="<?php echo base_url();?>index.php/periodTimeControllers/viewclassplan" method ="post">
													<div class="alert alert-info"><h3 class="media-heading text-center">Welcome to the Teacher Lesson Plan area</h3><p class="media-timestamp">In this section teachers fill there class work. If you find information then first select start date than end date and fill teacher id and click on define class plan button and show the results.</div>
										<strong>Note : Please Enter Date  And Teacher ID</strong>
										
									<br>
									<br>
									<br>
									
										<div class="row space15">
											<div class="col-md-12">
												<div class="col-md-6">
												<div class="col-md-6"><b>Start Date</b>
												</div>
													<div class="col-sm-6">
														<input type="date" name ="sdate"  class="form-control" required="required"/>
													</div>
												</div>
												<div class="col-md-6">
													<div class="col-md-6"><b>End Date</b>
													</div>
													<div class="col-sm-6">
														<input type="date" name ="edate" class="form-control" required="required"/>
													</div>
												</div>	
												<div class="row">
												<div class="col-md-12 space15">
												<div class="col-md-6">
												<div class="col-md-6">Teacher ID</div>
													<div class="col-sm-6">
														<select name="teacherid"  class="form-control" required="required">
																<option value="01">-Select-</option>
																<?php $this->db->where("school_code",$this->session->userdata("school_code"));
																$this->db->where("job_category",3);
																$var=$this->db->get("employee_info");

																foreach($var->result() as $v):
																print_r($v);?>
																<option value="<?php echo $v->username;?>"><?php echo $v->username;?></option>
																<?php endforeach;?>
														</select>
													</div>
													</div>
													<div class="col-sm-6">
													<div class="col-md-4">
													<select class="form-control" id="time_thead_id" name="time_thead_id">
														<option value="">-Select Time Table-</option>
															<?php $this->db->where('school_code',$this->session->userdata('school_code'));
															$time_thead_id= $this->db->get('no_of_period');
														if($time_thead_id->num_rows()>0):
																foreach($time_thead_id->result() as $thead):
																	?>
																		<option value="<?php echo $thead->id;?>"><?php echo $thead->period_name;?></option>
																	<?php
																endforeach;
														endif;?>
															<option>
														</select>
														</div>
													</div>
													
												</div>
												</div>
												</div>
												</div>
											</div>
											<div>
												<button type="submit" class="btn btn-light-purple"><i class="fa fa-arrow-circle-right"></i>Define Class Plan </button>
											</div>
										</div>
									</form>
								</div>
						</div>
					</div>
				</div>

				<?php
				}
				else{
					?>
					<div class="row">
	<div class="col-md-12">
		<div class="panel panel-white">
			<div class="panel-heading panel-blue">
				<i class="fa fa-external-link-square"></i>
					View Lession Plan :
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
								<a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i> <span>Refresh</span> </a>
							</li>
							<li>
								<a class="panel-config" href="#panel-config" data-toggle="modal"> <i class="fa fa-wrench"></i> <span>Configurations</span></a>
							</li>
							<li>
								<a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div> <!-- End Panel Heading -->
			<div class="panel-body">
			<form action ="<?php echo base_url();?>index.php/periodTimeControllers/viewclassplan" method ="post">
				<div>
					<div class="alert alert-info center">
						<h4><b>Note : Please Enter Date  </b></h4>
					</div>

					<div class="row space15">
					
						<div class="col-md-12">
							<div class="col-md-6">
							<div class="col-md-6"><h4><b>Start Date</b></h4></div>
								<div class="col-sm-6">
								<input type="date" name ="sdate"  class="form-control" required="required"/>
								</div>
							</div>
							<div class="col-md-6">
							<div class="col-md-6">End Date</div>
								<div class="col-sm-6">
								<input type="date" name ="edate"  class="form-control" required="required"/>
								</div>
							</div>
							</div>
					</div>
					<div>
							<button type="submit" class="btn btn-light-purple"><i class="fa fa-arrow-circle-right"></i>Define Class Plan </button>
					</div>
			</div>
		</form>
	</div>
</div>
</div>
</div>


					<?php
				}






