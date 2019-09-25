<!-- start: PAGE CONTENT -->
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-white">
									<div class="panel-heading panel-orange">
										<h4 class="panel-title">Enter <span class="text-bold"> Marks Detail</span></h4>
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
										</div>
									</div>
									<div class="panel-body">

									<div class="alert alert-info">
									    <h3 class="media-heading text-center">Welcome to Subject Result Area</h3>
									    <p class="media-timestamp">Now you can update pre entered Marks details First of all select dropdown menu and wait for 
									    another page and Click Update Marks Button for update. After Clicking update button marks will be updated now you can 
									    refresh this page and check it.</div>
										<div class="row">
										    <div id="validId"></div>
										<!-- <div class="alert alert-warning"> <div class="text-blue text-large"> <strong><strong>Welcome to Marks Updation Page. Now You can update pre entered Marks details  </strong>First of all select dropdown menus and wait Click Update Marks Button for update.</strong>After Clicking update button marks will be updated now you can refresh this page and check it. </div></div> -->
										<div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Select Exam Name
												<select name="exam_name" id="exam_name" class="form-control">
													<option value="01">-Select-</option>
													<?php foreach ($request as $en):?>
													<option value="<?php echo $en->id?>"><?php echo $en->exam_name?></option>
													<?php endforeach;?>
												</select>
											</label>
											</div>
											<div class="col-lg-2 col-md-4 col-sm-6">

													<label>
												Stream
												
												<select name="classv" id="classv" class="form-control">
													<option value="01">-Select Stream-</option>
													<?php foreach ($stream as $en):
													// print_r($en);
														$streamid=$en->stream; 	?>
                                                   <?php 
                                                          $this->db->where('id',$streamid);
                                                          $Stream1=$this->db->get('stream')->result();

                                                          foreach ($Stream1 as $en1)
                                                          {

                                                   ?>
													<option value="<?php echo $en1->id?>"><?php echo $en1->stream; ?></option>
												<?php }?>
													<?php endforeach;?>
												</select>
											</label>
											</div>
											<div class="col-lg-2 col-md-4 col-sm-6">

											<label>
												Section
												<select class="form-control" id="sectionId" name="section" style="width: 130px;"></select>
											</label>
											</div>
											<div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Class
												<select class="form-control" id="classId" name="class" style="width: 130px;"></select>
											</label>
											</div>
											<div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Subject
												<select class="form-control" id="subjectIdresult" name="subject" style="width: 220px;"></select>
											</label>
											</div>
										</div>
										<div id="result123"></div>
									</div>
								</div>
							</div>
						</div>