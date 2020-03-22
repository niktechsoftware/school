<?php
    $school_code = $this->session->userdata("school_code");
    $row2=$this->db->get('db_name')->row()->name;

if($school_code == 9 && $row2 == "A" || $school_code == 6 && $row2 == "A" || $school_code == 1 && $row2 == "D" || $school_code == 2 && $row2 == "D" || $school_code == 3 && $row2 == "D" || $school_code == 4 && $row2 == "D" || $school_code == 10 && $row2 == "D"  || $school_code == 9 && $row2 == "D" || $school_code == 8 && $row2 == "D"){ ?>
<!-- start: PAGE CONTENT -->
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-white">
									<div class="panel-heading panel-orange">
										<h4 class="panel-title">Define  Maximum <span class="text-bold">Marks, Subject Wise</span></h4>
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
										    <h3 class="media-heading text-center">Welcome to Maximum Marks Detail Of Subject  Area.</h3>
										    <p class="media-timestamp">In this page we can enter the maximum marks of a particular  subject Please select following Dropdown 
										    options and wait for another page. Fill the Maximum marks and click save button to save Maximum  marks.
                                        (Note : if maximum marks are already filled of a  subject then you can not save or update Maximum marks and you can only view).</p>
                                        </div>
										<?php if($this->uri->segment(3)){
											?>
												<div class="alert alert-success">Maximum Marks Of Subject are save successfuly !!!!</div>

									<?php	}?>
										<div class="row">
										    <div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Select Exam Name
												<select name="exam_name" id="exam_name" class="form-control" required="">
													<option value="">-Select-</option>
													<?php foreach ($request as $en):?>
													<option value="<?php echo $en->id?>"><?php echo $en->exam_name?>[ <?php echo $en->term?> Term]</option>
													<?php endforeach;?>
												</select>
											</label>
											</div>
											<!-- <label>
												Maximam Marks
												<div>
												<input type="number"   class="form-control" name="mm" id="mm" style="width: 150px;" placeholder="Maximum Marks"  required="" />
												</div>
											</label> -->
											<!-- <label>
												Grade Or Marks
												<div>
											      <select id="select" class="form-control" name="gradmarks" style="width: 150px;" required="">
											      	<option class="form-control" value="">--Select--</option>
											      	<option class="form-control" value="0">Grade</option>
											      	<option class="form-control" value="1">Marks</option>
											      	
											      </select>
												</div>
											</label> -->
                                               <div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Stream
												
												<select name="classv" id="classv" class="form-control" required="">
													<option value="">-Select Stream-</option>
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
												<select class="form-control" id="sectionId" name="section" style="width: 150px;" required=""></select>
											</label>
											</div>
											 <div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Class
												<select class="form-control" id="classId" name="class" style="width: 150px;" required=""></select>
											</label>
											</div>
											 <div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Subject
												<select class="form-control" id="subjectIdmarks" name="subject" style="width: 220px;" required=""></select>
											</label>
											</div>
										</div>
										<div id="showMarks"></div>
									</div>
								</div>
							</div>
						</div>
<?PHP }else{ ?>

<!-- start: PAGE CONTENT -->
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-white">
									<div class="panel-heading panel-orange">
										<h4 class="panel-title">Define  Maximum <span class="text-bold">Marks, Subject Wise</span></h4>
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
										    <h3 class="media-heading text-center">Welcome to Maximum Marks Detail Of Subject  Area.</h3>
										    <p class="media-timestamp">In this page we can enter the maximum marks of a particular  subject Please select following Dropdown 
										    options and wait for another page. Fill the Maximum marks and click save button to save Maximum  marks.
                                        (Note : if maximum marks are already filled of a  subject then you can not save or update Maximum marks and you can only view).</p>
                                        </div>
										<?php if($this->uri->segment(3)){
											?>
												<div class="alert alert-success">Maximum Marks Of Subject are save successfuly !!!!</div>

									<?php	}?>
										<div class="row">
										    <div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Select Exam Name
												<select name="exam_name" id="exam_name" class="form-control" required="">
													<option value="">-Select-</option>
													<?php foreach ($request as $en):?>
													<option value="<?php echo $en->id?>"><?php echo $en->exam_name?>[ <?php echo $en->term?> Term]</option>
													<?php endforeach;?>
												</select>
											</label>
											</div>
											<!-- <label>
												Maximam Marks
												<div>
												<input type="number"   class="form-control" name="mm" id="mm" style="width: 150px;" placeholder="Maximum Marks"  required="" />
												</div>
											</label> -->
											<!-- <label>
												Grade Or Marks
												<div>
											      <select id="select" class="form-control" name="gradmarks" style="width: 150px;" required="">
											      	<option class="form-control" value="">--Select--</option>
											      	<option class="form-control" value="0">Grade</option>
											      	<option class="form-control" value="1">Marks</option>
											      	
											      </select>
												</div>
											</label> -->
                                               <div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Stream
												
												<select name="classv" id="classv" class="form-control" required="">
													<option value="">-Select Stream-</option>
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
												<select class="form-control" id="sectionId" name="section" style="width: 150px;" required=""></select>
											</label>
											</div>
											 <div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Class
												<select class="form-control" id="classId" name="class" style="width: 150px;" required=""></select>
											</label>
											</div>
											 <div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Subject
												<select class="form-control" id="subjectIdmarks" name="subject" style="width: 180px;" required=""></select>
											</label>
											</div>
											 <div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Subject Type
												<select class="form-control" id="subjecttypem" name="subject" style="width: 180px;" required="">
												<option >Select</option>
												<option value="1">Written</option>
												<option value="0">Oral</option>
												<option value="2">Theory</option>
												<option value="3">Practical</option>
												</select>
											</label>
											</div>
										</div>
										<div id="showMarks"></div>
									</div>
								</div>
							</div>
						</div>
<?PHP } ?>