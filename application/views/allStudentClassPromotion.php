<div class="row">
							<div class="col-md-12">
								<!-- start: DYNAMIC TABLE PANEL -->
								<div class="panel panel-white">
								  <div class="panel-heading panel-purple">
									
										<h4 class="panel-title">Class  <span class="text-bold">Promote Section</span></h4>
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
									    <div class="alert panel-pink">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to Class Promotion Area </h3> 
          <p>Here you can Promote all the student of Class to the next Class,before Promote ensure that Student passout current Class.
		   Please Select Stream , Section and Class then Press Promote Button for Promote all Student Class .</p>
        </div>
									<div class="row">
										<div class="col-sm-12" id="validId"></div>
									</div>
											<div class="row">
											<div class="col-sm-3">
												<div class="panel-heading panel-red border-light">
													<h4 class="panel-title">FSD</h4>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<select id="cfsd" name ="cfsd" class="form-control">
															<option value="">--Select FSD--</option>
                                                            <?php 
                                                            $school_code = $this->session->userdata("school_code");
                                                            $cfsdh = $this->session->userdata("fsd");
														$fsdList = $this->db->query("SELECT * from fsd where school_code='$school_code' and id !='$cfsdh' ");
														
                                                            ?>


															<?php if(isset($fsdList)){?>
															<?php foreach ($fsdList->result() as $rowf){
                                                                ?>
															<option value="<?php echo $rowf->id;?>"><?php echo $rowf->finance_start_date;?></option>
															<?php } }?>
														</select>
													</div>
													
													<div class="text-red text-small">For promote  Please select a FSD of Students.</div>
												</div>
											</div>
											
											<div class="col-sm-3">
												<div class="panel-heading panel-red border-light">
													<h4 class="panel-title">Stream</h4>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<select id="clname11" class="form-control">
															<option value="">--Select Stream--</option>
                                                            <?php 
                                                            $school_code = $this->session->userdata("school_code");
		$StreamList = $this->db->query("SELECT DISTINCT stream from class_info where school_code='$school_code' ORDER BY id");
                                                            ?>


															<?php if(isset($StreamList)){?>
															<?php foreach ($StreamList->result() as $row){
																 
																  $streamid=$row->stream;
																 $this->db->where('id',$streamid);
																$row2=$this->db->get('stream')->row(); 
                                                                ?>
															<option value="<?php echo $row2->id;?>"><?php echo $row2->stream;?></option>
															<?php } }?>
														</select>
													</div>
													<div class="text-red text-small">Please select a Stream, Section and Class will automatically come select and promote your student.</div>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="panel-heading panel-green border-light">
													<h4 class="panel-title">Section</h4>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<select id="sectionList11" class="form-control">
															
														</select>
													</div>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="panel-heading panel-blue border-light">
													<h4 class="panel-title"> Class</h4>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<select id="classlist11" class="form-control">
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="table-responsive" style="width:100%; overflow-y: scroll;">
												<div id=allStudentclassPromotion>
													
												</div>
											
										</div>
							
												
									</div>
								</div>
							</div>
							</div>
							
						
					
