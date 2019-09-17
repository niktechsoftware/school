<div class="row">
  <div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-red">
        <h4 class="panel-title">Class Wise  <span class="text-bold">Attendance Panel</span></h4>
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
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to the Class Wise Attendance</h3>
          <p class="media-timestamp">If you want to see Attendance Report of any Class then
            select the all options and  see the Attendance Report of that class and take a print also of Attendance.
        </div>
        <!--<div class="padding-20 core-content">
          <a href="<?php echo base_url(); ?>index.php/login/studentAttendance1">
            <button class="btn btn-dark-green">Morning Attendance <i class="fa fa-arrow-circle-right"></i></button>
          </a>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="<?php echo base_url(); ?>index.php/login/studentAttendance2">
            <button class="btn btn-dark-blue">After break fast <i class="fa fa-arrow-circle-right"></i></button>
          </a>
        </div>-->
        <div class="padding-20 core-content col-md-12">
            <div class="row">

                <div class="col-sm-3">
                        <div class="panel-heading panel-blue border-light">
                          <h4 class="panel-title">Fsd</h4>
                        </div>
                         <?php $school_code = $this->session->userdata("school_code");
            $detail = $this->db->query("SELECT * FROM `fsd` WHERE school_code ='$school_code' order BY id");
            if($detail->num_rows() > 0){
          ?>
                        <div class="panel-body">
                          <div class="form-group">
                            <select id="fsd" class="form-control">
                              <option value="">Select Fsd</option>
                              
                              <?php foreach($detail->result() as $row):?>
                <option value="<?php echo $row->id;?>">
                  <?php echo date("d-M-y", strtotime($row->finance_start_date));?>
                </option>
                <?php endforeach;?>
                            </select>   <?php } ?>
                          </div>
                          
                        </div>
                      </div>

											<div class="col-sm-3">
												<div class="panel-heading panel-red border-light">
													<h4 class="panel-title">Stream Name</h4>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<select id="clnameatn" class="form-control">
															<option value="">Select Stream Name</option>
															<?php if(isset($StreamList)){?>
															<?php foreach ($StreamList as $row){
																 
																  $streamid=$row->stream;
																 $this->db->where('id',$streamid);
																$row2=$this->db->get('stream')->row(); 
                                                                ?>
															<option value="<?php echo $row2->id;?>"><?php echo $row2->stream;?></option>
															<?php } }?>
														</select>
													</div>
													
												</div>
											</div>
											<div class="col-sm-3">
												<div class="panel-heading panel-green border-light">
													<h4 class="panel-title">Section</h4>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<select id="sectionListatn" class="form-control">
															
														</select>
													</div>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="panel-heading panel-blue border-light">
													<h4 class="panel-title">Class</h4>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<select id="classlistatn" class="form-control">
														</select>
													</div>
												</div>
											</div>
											  <div class="table-responsive" style="width:100%; overflow-y: scroll;">
                        <div id="sample_rahul">
                          
                        </div>
                      
                    </div>
										</div>
          
         
         
        
        
        
      </div>
    </div>
  </div>
</div>
</div>
<!-- end: PAGE CONTENT-->