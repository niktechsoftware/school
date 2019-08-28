<form action="<?php echo base_url();?>index.php/adminc/admitCardReports1" method="post" role="form"
    class="smart-wizard form-horizontal" id="form">
    <div class="row">
        <div class="col-md-12">
            <!-- start: RESPONSIVE TABLE PANEL -->
            <div class="panel panel-white">
                <div class="panel-heading panel-orange">
                    <i class="fa fa-external-link-square"></i>
                    Download Admit Card Panel :
                    <div class="panel-tools">
                        <div class="dropdown">
                            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                                <i class="fa fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                                <li>
                                    <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i>
                                        <span>Collapse</span> </a>
                                </li>
                                <li>
                                    <a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i>
                                        <span>Refresh</span> </a>
                                </li>
                                <li>
                                    <a class="panel-config" href="#panel-config" data-toggle="modal"> <i
                                            class="fa fa-wrench"></i> <span>Configurations</span></a>
                                </li>
                                <li>
                                    <a class="panel-expand" href="#"> <i class="fa fa-expand"></i>
                                        <span>Fullscreen</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-body">


                    <div class="alert alert-info">
                        <h3 class="media-heading text-center">Welcome to Download Admit Card Area</h3>
                        <p class="media-timestamp">
                        To get admit card of all your students in a particular class,select exam ,stream, section and class.
                            Now click get admit card button.the admit cards of that class will appear and then you can print it.
                    </p>
                    </div>
                    <div id="msg"></div>
                    <div class="col-md-12">
                        <div class="panel">
                            
                            <div class="panel-body">

                            <div class="row">
										    <div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Select Exam Name
												<select name="exam_name" id="exam_name" class="form-control" required="">
													<option value="">-Select-</option>
													<?php foreach ($request as $en):?>
													<option value="<?php echo $en->id?>"><?php echo $en->exam_name?></option>
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
												
												<select name="classv" id="classv111" class="form-control" required="">
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
												<select class="form-control" id="sectionId111" name="section" style="width: 150px;" required=""></select>
											</label>
											</div>
											 <div class="col-lg-2 col-md-4 col-sm-6">
											<label>
												Class
												<select class="form-control" id="classId111" name="class" style="width: 150px;" required=""></select>
											</label>
											</div>
											 <div class="col-lg-2 col-md-4 col-sm-6">
											 <button type="submit" id="b1" class="btn btn-red">
                                                   Get Admit Card <i class="fa fa-report"></i>
                                             </button>
                                            </div>
                                           
                                        </div>
                                        
                                <div class="row space15">
                                    <div class="col-md-7">
                                        <div id="validId"></div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</form>