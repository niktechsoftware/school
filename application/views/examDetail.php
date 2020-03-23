
<?php
    $school_code = $this->session->userdata("school_code");
    $row2=$this->db->get('db_name')->row()->name;


if($school_code == 9 && $row2 == "A" || $school_code == 6 && $row2 == "A" || $school_code == 1 && $row2 == "D" || $school_code == 2 && $row2 == "D" || $school_code == 3 && $row2 == "D" || $school_code == 4 && $row2 == "D" || $school_code == 10 && $row2 == "D"  || $school_code == 8 && $row2 == "D" ){ ?>

<style>
    .td1{
        text-transform: uppercase;
    }
</style>
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-white">
									<div class="panel-heading panel-orange">
										<h4 class="panel-title">Define <span class="text-bold"> Marks Detail</span></h4>
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
                                    <div class="alert alert-info"><h3 class="media-heading text-center">Welcome to Examination Detail Section Area.</h3>
                                    <p class="media-timestamp">In this Page We Can Enter and save Student Marks Scored in a Particular Class and Subject Please Select Following 
                                    Dropdown Options and Wait for Another Page. Fill the Marks and Click save Button to Save Students Marks.
                                    (Note : if marks are already filled in a class and subject then you can not save or update marks you can only view).</div>
										<?php if($this->uri->segment(3)){
											?>
												<div class="alert alert-success">Class Marks are save successfuly !!!!</div>

									<?php	}?>
										<div class="row">
										    <div id="validId"></div>
										    <div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Teacher ID
												<div>
													<input type="text" class="form-control" name="tname" id="teacherid"/>
												</div>
											</label>
											</div>
											<div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Select Exam Name
												<select name="exam_name" id="exam_name" class="form-control">
													<option value="01">-Select-</option>
													<?php foreach ($request as $en):?>
													<option value="<?php echo $en->id?>"><?php echo $en->exam_name?>[ <?php echo $en->term?> Term]</option>
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
												<select class="form-control" id="subjectId" name="subject" style="width:150px;"></select>
											</label>
											</div>
										</div>
										<div id="enterMarks"></div>
									</div>
								</div>
							</div>

						</div>
<?PHP }else{ ?>
<style>
    .td1{
        text-transform: uppercase;
    }
</style>
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-white">
									<div class="panel-heading panel-orange">
										<h4 class="panel-title">Define <span class="text-bold"> Marks Detail</span></h4>
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
                                    <div class="alert alert-info"><h3 class="media-heading text-center">Welcome to Examination Detail Section Area.</h3>
                                    <p class="media-timestamp">In this Page We Can Enter and save Student Marks Scored in a Particular Class and Subject Please Select Following 
                                    Dropdown Options and Wait for Another Page. Fill the Marks and Click save Button to Save Students Marks.
                                    (Note : if marks are already filled in a class and subject then you can not save or update marks you can only view).</div>
										<?php if($this->uri->segment(3)){
											?>
												<div class="alert alert-success">Class Marks are save successfuly !!!!</div>

									<?php	}?>
										<div class="row">
										    <div id="validId"></div>
										    <div class="col-lg-1 col-md-4 col-sm-6">
											<label>
												Teacher ID
												<div>
													<input type="text" class="form-control" name="tname" id="teacherid"/>
												</div>
											</label>
											</div>
											<div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Select Exam Name
												<select name="exam_name" id="exam_name" class="form-control">
													<option value="01">-Select-</option>
													<?php foreach ($request as $en):?>
													<option value="<?php echo $en->id?>"><?php echo $en->exam_name?>[ <?php echo $en->term?> Term]</option>
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
 	                                        <div class="col-lg-1 col-md-4 col-sm-6">
											<label>
												Section
												<select class="form-control" id="sectionId" name="section" style="width: 90px;"></select>
											</label>
											</div>
												<div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Class
												<select class="form-control" id="classId" name="class" style="width: 90px;"></select>
											</label>
											</div>
											<div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Subject
												<select class="form-control" id="subjectId" name="subject" style="width: 90px;"></select>
											</label>
											</div>
											
											<div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Subject Type
												<select class="form-control" id="sub_type" name="sub_type" style="width: 90px;">
													<option >--Select--</option>
													<option value="0">Oral</option>
													<option value="1">Written</option>
													<option value="2">Theory</option> 
													<option value="3">Practical</option>
												 </select> 
											</label>
											</div>
										</div>
										<div id="enterMarks"></div>
									</div>
								</div>
							</div>

						</div>
<?PHP } ?>