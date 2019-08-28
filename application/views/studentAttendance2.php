	<form  action="<?php echo base_url();?>index.php/teacherController/studentAtten2" method="post">
		<div class="row">
							<div class="col-md-12">
								<!-- start: DYNAMIC TABLE PANEL -->
								<div class="panel panel-white">
									<div class="panel-heading panel-pink">
										<h4 class="panel-title">Attendance <span class="text-bold">Table</span></h4>
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
									<div class="row container">
	            <div class="alert alert-info">
	              <button data-dismiss="alert" class="close">×</button>
	              Note:- Please Select Date of Attendance for back Attendance otherwise it will take current date.</div>
	            <div class="row">
	              <div class="col-sm-12" id="validId"></div>
	            </div>


	            <?php 		if($v){
										?><div class="alert alert-success">
	              <?php echo "Successfully Attendance Done";?></div><?php
									}

									$v=0;?>
	            <div class="row space20">
	              <div class="col-sm-3">
	                <div class="form-group">
	                  <div class="col-sm-5">
	                    <label class="control-label">
	                      Teacher ID<span class="symbol required"></span>
	                    </label>
	                  </div>
	                  <div class="col-sm-7">
	                    <input type="text" size="20" class="form-control" id="teacherid" name="teacherid"
	                      required="required" placeholder="Text Field">
	                  </div>
	                </div>
	              </div>
								
	              <div class="col-sm-3">
	                <div class="form-group">
	                  <div class="col-sm-3">
	                    <label class="control-label">
	                      Select Date
	                    </label>
	                  </div>

										<?php 
										$fsdid =$this->session->userdata('fsd');
										$this->db->where('id',$fsdid );
										$this->db->select('finance_start_date');
									  $dat =	$this->db->get('fsd');
										if($dat->num_rows()){
											$date= $dat->row()->finance_start_date;
										}
										?>
	                  <div class="col-sm-9">
	                    <input type="date" class="form-control" min='<?php echo $date;?>' id="date1" name="date1" required="required"
	                      placeholder="Text Field">
	                  </div>
	                </div>
	              </div>    
	              <div class="col-sm-3">
	                <div class="form-group">
	                  <div class="col-sm-4">
	                    <label class=" control-label">
	                      Section <span class="symbol required"></span>
	                    </label>
	                  </div>
	                  <div class="col-sm-7">
	                    <select class="form-control" id="classva2" name="class" style="width: 160px;">
	                      <option value="no">-Select Section-</option>
	                      <?php foreach($request as $row):?>
	                      <option value="<?php echo $row->id;?>"><?php echo $row->section;?></option>
	                      <?php endforeach; ?>
	                    </select>

	                  </div>
	                </div>
	              </div>
	              <div class="col-sm-3">
	                <div class="form-group">
	                  <div class="col-sm-4">
	                    <label class=" control-label">
	                      Class <span class="symbol required"></span>
	                    </label>
	                  </div>
	                  <div class="col-sm-7">
	                    <select class="form-control" id="sectionId2" name="section" style="width: 140px;">

	                    </select>
	                  </div>
	                </div>
	              </div>
	            </div>
										<div class="table-responsive" style="width:100%; overflow-y: scroll;">
									<table class="table table-striped table-hover" id="sample-table-2">
								<thead>
												<thead id="sample_rahul1">
												</thead>
												<tbody id=sample_rahul>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							</div>
							</form>
						<!-- end: PAGE CONTENT-->

						<script>
	
	date1.max = new Date().toISOString().split("T")[0];
	</script>
