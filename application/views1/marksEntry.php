
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-white">
									<div class="panel-heading">
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
                                    <div class="alert alert-info"><h3 class="media-heading text-center">Welcome to Examination Detail Section Area.</h3><p class="media-timestamp">In this page we can enter and save Student marks scored in a particular class and subject Please select following Dropdown options and wait for another page. Fill the marks and click save button to save students marks.
                                    (Note : if marks are already filled in a class and subject then you can not save or update marks you can only view).</div>
									<h4>Define Marks ClassWise</h4>
										<?php if($this->uri->segment(3)){
											?>
												<div class="alert alert-success">Class Marks are save successfuly !!!!</div>

									<?php	}?>
										<div><div id="validId"></div>
											<label>
												Teacher ID
												<div>
													<input type="text" name="tname" id="teacherid"/>
												</div>
											</label>
											<label>
												Select Exam Name
												<select name="exam_name" id="exam_name" class="form-control">
													<option value="01">-Select-</option>
													<?php foreach ($request as $en):?>
													<option value="<?php echo $en->id?>"><?php echo $en->exam_name?></option>
													<?php endforeach;?>
												</select>
											</label>

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

											<label>
												Section
												<select class="form-control" id="sectionId" name="section" style="width: 130px;"></select>
											</label>
											<label>
												Class
												<select class="form-control" id="classId" name="class" style="width: 130px;"></select>
											</label>
											<label>
												Subject
												<select class="form-control" id="subjectId" name="subject" style="width:150px;"></select>
											</label>
										</div>
										<div id="enterMarks"></div>
									</div>
								</div>
							</div>

						</div>