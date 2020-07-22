<?php if($this->uri->segment("3") == "noteTrue"){?>
<div class="row">
  <div class="col-md-6 col-lg-12 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="alert alert-success">
        <button data-dismiss="alert" class="close">
          &times;
        </button>
        <strong>Done!</strong> Your new Note successfully added <a class="alert-link" href="#">
          into database.</a>
      </div>
    </div>
  </div>
</div>
<?php } elseif($this->uri->segment("3") == "noteFalse"){?>
<div class="row">
  <div class="col-md-6 col-lg-12 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="alert alert-danger">
        <button data-dismiss="alert" class="close">
          &times;
        </button>
        <strong>Oh my god! sorry....</strong>
        Something going wrong contect to <strong>NIKTECH SOFTWARE SOLUTIONS</strong> for this.... :(
      </div>
    </div>
  </div>
</div>
<?php }?>

<?php if($this->uri->segment("3") == "noteDelTrue"){?>
<div class="row">
  <div class="col-md-6 col-lg-12 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="alert alert-success">
        <button data-dismiss="alert" class="close">
          &times;
        </button>
        <strong>Done!</strong> Your Note successfully Deleted from database.
      </div>
    </div>
  </div>
</div>
<?php } elseif($this->uri->segment("3") == "noteDelFalse"){?>
<div class="row">
  <div class="col-md-6 col-lg-12 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="alert alert-danger">
        <button data-dismiss="alert" class="close">
          &times;
        </button>
        <strong>Oh my god! sorry....</strong>
        Something going wrong contect to <strong>NIKTECH SOFTWARE SOLUTIONS</strong> for this.... :(
      </div>
    </div>
  </div>
</div>
<?php }?>

<!-- ------------------------------------------ All alert codeing end -------------------------------------------- -->

<div class="row">
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-body no-padding">
        <div class="partition-green text-center core-icon">
        <?php $date = date('Y-m-d');
		$total = $this->daybookmodel->datewiseCollecttion($date,$school_code);
		?>
          <i class="fa fa-inr fa-2x icon-big"></i><br><?php echo $total['feeTotal']+$total['stockTotal'];?>
        </div>
        <a href="<?php echo base_url(); ?>index.php/login/feeReport">
          <div class="padding-20 core-content">
            <!--	<h3 class="title block no-margin">Fee Reports</h3>-->
            <h3 class="title block no-margin">Today Collection</h3>
            <br />
            <div class="row">
              <div class="col-sm-6">
                <h6 class="block no-margin">Fees </h6>
                </br>
                <mark><?php 
					echo $total['feeTotal'];
					?>
                </mark>
              </div>
              <div class="col-sm-6">
                <h6 class="block no-margin">Stock</h6>
                </br>
                <mark><?php 
					echo $total['stockTotal'];
                    ?>
                </mark>
              </div>
            </div>

          </div>
        </a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-body no-padding">
        <div class="partition-azure text-center core-icon">
          <i class="fa fa-book fa-2x icon-big"></i>
		
        </div>
        <a href="<?php echo base_url(); ?>index.php/login/daybook">
          <div class="padding-20 core-content">
            <!-- <h4 class="title block no-margin">DayBook</h4>-->
            <h4 class="title block no-margin">Today DayBook</h4>
            <br />
            <div class="row">
              <div class="col-sm-6">
                <h6 class="block no-margin">Debit Amount</h6>
                <mark><?php 
					echo $total['dabitTotal'];
					?>
                </mark>
              </div>
              <div class="col-sm-6">
                <h6 class="block no-margin">Credit Amount</h6>
                <mark><?php 
                echo $total['creditTotal'];
                    ?>
                </mark>
              </div>
            </div>


          </div>
        </a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-body no-padding">
        <div class="partition-pink text-center core-icon">
          <i class="fa fa-users fa-2x icon-big"></i>
          <br>
          <span class="subtitle"> <?php 
						$date=Date("Y-m-d");
						$this->db->select_sum("amount");
					  //$x= $this->db->from("cash_payment");
                    	$this->db->where("school_code",$this->session->userdata("school_code"));
			            $this->db->where("date",$date); 
		                $info = $this->db->get('cash_payment')->row();
									
                    	?> </span>
        </div>
        <a href="<?php echo base_url(); ?>index.php/login/daybook">
          <div class="padding-20 core-content">
            <h4 class="title block no-margin">Today Expenditure</h4>
            <br />
            <span class="subtitle"> <mark><?php if($info->amount){ echo $info->amount; } else{ echo "0"; }?> </mark></span>
          </div>
        </a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-body no-padding">
        <div class="partition-blue text-center core-icon">
          <i class="fa fa-users fa-2x icon-big"></i>

          </span>
        </div>
        <a href="<?php echo base_url(); ?>index.php/login/daybook">
          <div class="padding-20 core-content">
            <!-- <h4 class="title block no-margin">Student Admission</h4>-->
            <h4 class="title block no-margin">Today Business</h4><br>
            <div class="row">
              <div class="col-sm-6">
                <h6 class="block no-margin">Opening</h6>
                </br>

                <mark><?php 

							echo $openingBalance ;?></mark>

              </div>
              <div class="col-sm-6">
                <h6 class="block no-margin">Closing</h6>
                </br>
                <mark> <?php  
							echo $closingBalance ;?></mark>
              </div>
            </div>

          </div>
        </a>
      </div>
    </div>
  </div>
  <!--<div class="col-md-6 col-lg-3 col-sm-6">-->
  <!--        <div class="panel panel-default panel-white core-box">-->
  <!--            <div class="panel-body no-padding">-->
  <!--                <div class="partition-red padding-20 text-center core-icon">-->
  <!--                    <i class="fa fa-tasks fa-2x icon-big"></i>-->
  <!--                </div>-->
  <!--                <a href="<?php echo base_url(); ?>index.php/login/schedulingReport">-->
  <!--                <div class="padding-20 core-content">-->
  <!--                    <h4 class="title block no-margin">Time Table</h4>-->
  <!--                    <br/>-->
  <!--                    <span class="subtitle"> Access the time table. </span>-->
  <!--                </div>-->
  <!--                </a>-->
  <!--            </div>-->
  <!--        </div>-->
  <!--    </div>-->
</div>
<!--1st row end-->
<!--2nd row start-->
<div class="row">
    <div class="col-md-6 col-lg-3 col-sm-6">
            <div class="panel panel-default panel-white core-box">
                <div class="panel-body no-padding">
                    <div class="partition-pink text-center core-icon">
                        <i class="fa fa-users fa-2x icon-big"></i>
                         <br>
                        	<span class="subtitle"> <?php 
                        	$this->db->where("school_code",$this->session->userdata("school_code"));
    			            $this->db->where("status",1); 
    			             $this->db->where("job_category",3);
    		                 $info = $this->db->get("employee_info")->num_rows();
    		                 echo $info ;
                        	?>  </span>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php/login/classteacher">
                    <div class="padding-20 core-content">
                        <h4 class="title block no-margin">Total Teachers</h4>
                        <br/>
                        <span class="subtitle"> Access To Class Teachers. </span>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    <div class="col-md-6 col-lg-3 col-sm-6">
            <div class="panel panel-default panel-white core-box">
                <div class="panel-body no-padding">
                    <div class="partition-blue text-center core-icon">
                        <i class="fa fa-users fa-2x icon-big"></i><br>
                       </div>
                    <a href="<?php echo base_url(); ?>index.php/login/newAdmission">
    				<div class="padding-20 core-content">
    				   <!-- <h4 class="title block no-margin">Student Admission</h4>-->
    				   <h4 class="title block no-margin"> New Registration</h4><br>
    				   <div class="row">
    				      
    					   <div class="col-sm-6">
    					   <h6 class="block no-margin">Total </h6>
    						<?php //$fsd = $this->session->userdata("fsd");
    						$this->db->select('*');
    							$this->db->from('student_info');
    							$this->db->join('class_info','class_info.id=student_info.class_id');
    							$this->db->where("class_info.school_code",$school_code);
    							$query=$this->db->get();
    							echo $query->num_rows() ;?>
    					   </div>
    					   <div class="col-sm-6">
    					   <h6 class="block no-margin">Current Year </h6>
    					   <?php $fsd = $this->session->userdata("fsd");
    						$this->db->select('*');
    							$this->db->from('student_info');
    							$this->db->join('class_info','class_info.id=student_info.class_id');
    							$this->db->where("class_info.school_code",$school_code);
    							$this->db->where("student_info.status",1);
    							$this->db->where("student_info.fsd",$fsd);
    							$query=$this->db->get();
    							echo $query->num_rows() ;?>
    					   </div>
    				   </div>
    				  
                    </div>
                    </a>
                </div>
            </div>
        </div>
   <!-- <div class="col-md-6 col-lg-3 col-sm-6">
            <div class="panel panel-default panel-white core-box">
                <div class="panel-body no-padding">
                    <div class="partition-pink text-center core-icon">
                        <i class="fa fa-users fa-2x icon-big"></i>
                         <br><span class="subtitle">  </span>
                    </div>
                    <a href="#">
                    <div class="padding-20 core-content">
                        <h4 class="title block no-margin">Your Due Amount</h4>
                        <br/><span class="subtitle"> <?php //if($client_due_list){echo $client_due_list->amount;}else{ echo "0";} ?> </span>
                    </div>
                    </a>
                </div>
            </div>
        </div>-->
    <div class="col-md-6 col-lg-3 col-sm-6">
            <div class="panel panel-default panel-white core-box">
                <div class="panel-body no-padding">
                    <div class="partition-blue text-center core-icon">
                        <i class="fa fa-users fa-2x icon-big"></i>
                       </div>
                    <a href="<?php echo base_url();?>/index.php/login/smsreport">
    				<div class="padding-20 core-content">
    				   <h4 class="title block no-margin">Your SMS Balance</h4><br>
    				    <span class="subtitle"><?php echo $cbs;?>  </span>
                    </div>
                    </a>
                </div>
            </div>
        </div>
        	<div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-purple padding-20 text-center core-icon">
                    <i class="fa fa-tasks fa-2x icon-big"></i>
                </div>
                <a href="#">
                <div class="padding-20 core-content">
                    <h4 class="title block no-margin">Join Chat Room</h4>
                    <br/>
                    <span class="subtitle"> 	
                    	<?php  
                    	        
								$this->db->where("chat_username",$this->session->userdata("username"));
								$chat_id = $this->db->get("chat")->row()->chat_username;
								echo $chat_id;
							?>
                            <a href="<?php echo base_url();?>singleTeacherControllers/chatBranch/<?php echo $chat_id;?>">
                        		<span class="glyphicon glyphicon-facetime-video"></span>
                        		<p> &nbsp;&nbsp;Video Call</p><span class="arrow"></span>
                        	</a></span>
                </div>
                </a>
            </div>
        </div>
    </div>

</div>
<!--2nd row end-->
<!--3rd row start-->
<div class="row">
    <div class="col-md-6 col-lg-3 col-sm-6">
    								<div class="panel panel-blue core-box">
									<div class="e-slider owl-carousel owl-theme">
										<div class="item">
											<div class="panel-body">
												<div class="core-box">
													<div class="text-white text-bold">
												<h4>	Student Attendance</h4>
													</div>
													<div class="text-white text-large pull-left">
													    	<a href="<?php echo base_url();?>/index.php/attendancepanel/todayatten/3" class="btn btn-xs btn-light-blue">
													   Morning Attendance <br>
													   </a>
													</div>
													<div class="text-white text-large pull-right">
											     		<a href="<?php echo base_url();?>/index.php/attendancepanel/todayatten/5" class="btn btn-xs btn-light-blue">
											     		      Evening Attendance <br>
												</a>
														</div>
												</div>
											</div>
										</div>
										<div class="item">
											<div class="panel-body">
													<div class="core-box">
											
													<div class="text-white text-bold">
												<h4>	Student Attendance</h4>
													</div>
													<div class="text-white text-large pull-left">
													    	<a href="<?php echo base_url();?>index.php/attendancepanel/todayatten/3" class="btn btn-xs btn-light-blue">
													   Morning Attendance <br>
													   </a>
														
													</div>
													<div class="text-white text-large pull-right">
											     		<a href="<?php echo base_url();?>index.php/attendancepanel/todayatten/5" class="btn btn-xs btn-light-blue">
											     		      Evening Attendance <br>
												</a>
														  
                                			
														</div>
												</div>
												</div>
											</div>
											
										</div>
										
									</div>
    								</div>
    <div class="col-md-6 col-lg-3 col-sm-6">
    								<div class="panel panel-blue core-box">
									<div class="e-slider owl-carousel owl-theme">
										<div class="item">
											<div class="panel-body">
												<div class="core-box">
											
													<div class="text-white text-bold">
												<h4>Fee Due (Current Fsd)</h4>
													</div>
													<div class="text-white text-large pull-left">
													    	<a href="<?php echo base_url();?>index.php/feepanel/studentwisefeepanel" class="btn btn-xs btn-light-blue">
													   Student wise Due <br>
													   </a>
													</div>
													<div class="text-white text-large pull-right">
											     		<a href="<?php echo base_url();?>index.php/login/feeReport" class="btn btn-xs btn-light-blue">
											     		     Class Wise Due <br>
												</a>
														  
                                			
														</div>
												</div>
											</div>
											
										</div>
										<div class="item">
											<div class="panel-body">
													<div class="core-box">
											
													<div class="text-white text-bold">
												<h4>Fee Due (Current Fsd)</h4>
													</div>
													<div class="text-white text-large pull-left">
													    	<a href="<?php echo base_url();?>/index.php/feepanel/studentwisefeepanel" class="btn btn-xs btn-light-blue">
													   Section wise Due <br>
													   </a>
														
													</div>
													<div class="text-white text-large pull-right">
											     		<a href="<?php echo base_url();?>/index.php/feepanel/currentmonthdue" class="btn btn-xs btn-light-blue">
											     		     Current Month Due <br>
												</a>
														  
                                			
														</div>
												</div>
												</div>
											</div>
											
										</div>
										
									</div>
    								</div>
    <div class="col-md-6 col-lg-3 col-sm-6">
    								<div class="panel panel-blue core-box">
    									<div class="e-slider owl-carousel owl-theme">
    										<div class="item">
    											<div class="panel-body">
    												<div class="core-box">
    											
    													<div class="text-white text-bold">
    												<h4>	Student Leave Request</h4>
    													</div>
    													<div class="text-white text-large pull-left">
    													    Pending <br>
    														<?php	$this->db->where("school_code",$school_code);
                                    						$this->db->where("approve","NO");
                                    						$data=$this->db->get('stu_leave');
                                    							if($data->num_rows()>0){
                                    				      	$count=0;
                                    						foreach($data->result() as $row):
                                    						  $leave= $row->total_leave;
                                    						  $count=$count+$leave;
                                    						 // echo "<pre>";
                                    						  endforeach;
                                    						  echo $count;
                                    							} else{ echo "0";}?>
    													</div>
    													<div class="text-white text-large pull-right">
    											     	Approved <br>
    												
    														  
                                    				<?php	$this->db->where("school_code",$school_code);
                                						$this->db->where("approve","YES");
                                						$data=$this->db->get('stu_leave');
                                							if($data->num_rows()>0){
                                				      	$count=0;
                                						foreach($data->result() as $row):
                                						  $leave= $row->total_leave;
                                						  $count=$count+$leave;
                                						 // echo "<pre>";
                                						  endforeach;
                                						  echo $count;
                                							} else{ echo "0";}?> </a>
    														<a href="<?php echo base_url();?>index.php/login/studentleave" class="btn btn-xs btn-light-blue"><i class="fa fa-check"></i> Get Report</a>
    													</div>
    												</div>
    											</div>
    											
    										</div>
    										<div class="item">
    											<div class="panel-body">
    														<div class="core-box">
    										
    													<div class="text-white text-bold">
    												<h4>Employee Leave Request</h4>
    													</div>
    													<div class="text-white text-large pull-left">
    													   Pending <br>
    													<?php	$this->db->where("school_code",$school_code);
                                    						$this->db->where("status",0);
                                    						$data=$this->db->get('emp_leave');
                                    							if($data->num_rows()>0){
                                    				      	$count=0;
                                    						foreach($data->result() as $row):
                                    						  $leave= $row->total_leave;
                                    						  $count=$count+$leave;
                                    						 // echo "<pre>";
                                    						  endforeach;
                                    						  echo $count;
                                    							} else{ echo "No Pending Request";}?>
                                    						</div>							
    													<div class="text-white text-large pull-right">
    											     	Approved <br>
    												
    														  
                                    				<?php		
                                                    $this->db->where("school_code",$school_code);
                            						$this->db->where("status",1);
                            						$data=$this->db->get('emp_leave');
                            							if($data->num_rows()>0){
                            				      	$count=0;
                            						foreach($data->result() as $row):
                            						  $leave= $row->total_leave;
                            						  $count=$count+$leave;
                            						 // echo "<pre>";
                            						  endforeach;
                            						  echo $count;
                            							} else{ echo "0";}?> </a>
    														<a href="<?php echo base_url();?>index.php/login/empolyeeleave" class="btn btn-xs btn-light-blue"><i class="fa fa-check"></i> Get Report</a>
    													</div>
    												</div>
    												</div>
    											</div>
    											
    										</div>
    										
    									</div>
    								</div>
    <div class="col-md-6 col-lg-3 col-sm-6">
    								<div class="panel panel-blue core-box">
    									<div class="e-slider owl-carousel owl-theme">
    										<div class="item">
    											<div class="panel-body">
    												<div class="core-box">
    												<?php   $this->db->where("school_code",$school_code);
    		$sender=$this->db->get("sms_setting")->row(); ?>
    													<div class="text-white text-bold">
    														Available SMS [<?php echo $cbs;?>]
    													</div>
    													<div class="text-white text-large pull-left">
    														<?php $datj=date("Y-m-d");echo date("d-m-Y");?>
    													</div>
    													<div class="text-white text-large pull-right">
    													<?php 
    													$this->db->where("school_code",$this->session->userdata("school_code"));
    													$this->db->where("DATE(date)",$datj);
    													$getsmsn = $this->db->get("sent_sms_master");
    													$tot = 0;$sent =0; $wrong =0;
    													if($getsmsn->num_rows()>0){
    														
    													foreach($getsmsn->result() as $fty):
    													$this->db->where("requestId",$fty->response_id);
    									$sentsms = $this->db->get("savesms");
                              if($sentsms->num_rows()>0){
                                $sent+=$sentsms->num_rows();
                              }
    													
    													$this->db->where("sms_master_id",$fty->id);
    													$wrongsms = $this->db->get("wrong_number_sms");
                              if($wrongsms->num_rows()>0){
    													$wrong +=$wrongsms->num_rows();
                          }
    													endforeach;
    													$tot=$sent+$wrong;
    													}?>
    														 Sent <?php echo $tot;?> </a>
    														<a href="<?php echo base_url();?>/index.php/login/smsreport" class="btn btn-xs btn-light-blue"><i class="fa fa-check"></i> Get Report</a>
    													</div>
    												</div>
    											</div>
    											
    										</div>
    										<div class="item">
    											<div class="panel-body">
    												<div class="core-box">
    													<div class="text-white text-large text-bold">
    														Todays Sent [<?php echo $tot;?>]
    													</div>
    													
    											
    														 Delivered =<?php echo $sent;?>
    														 Wrong = <?php echo $wrong;?>
    														 
    													</div>
    												</div>
    											</div>
    											
    										</div>
    										
    									</div>
    								</div>
</div>
<!--3rd row end-->
<!--4rth row start-->
<div class="row">
<div class="col-md-6 col-lg-6">
       <div class="panel panel-blue core-box">
									<div class="e-slider owl-carousel owl-theme">
										<div class="item">
											<div class="panel-body">
												<div class="core-box">
													<div class="text-white text-bold">
												    <h4>Homework Detail</h4>
													</div>
													<!--<div class="text-white text-large pull-left">
													    	<a href="<?php echo base_url();?>index.php/homeController/duereport/3" class="btn btn-xs btn-light-blue">
													   Section wise Due <br>
													   </a>
													</div>-->
													<div class="text-white text-large pull-right">
											     		<a href="<?php echo base_url();?>index.php/studentHWControllers/getStudentWork1/1" class="btn btn-xs btn-light-blue">
											     		   Homework  Full Detail<br>
												        </a>
											        </div>
												</div>
											</div>
										</div>
										<div class="item">
										    <div class="panel-body">
												<div class="core-box">
													<div class="text-white text-bold">
												        <h4>Homework Detail</h4>
													</div>
												<!--	<div class="text-white text-large pull-left">
													    	<a href="<?php echo base_url();?>/index.php/login/smsreport" class="btn btn-xs btn-light-blue">
													   Section wise Due <br>
													   </a>
													</div>-->
													<div class="text-white text-large pull-right">
											     		<a href="<?php echo base_url();?>index.php/studentHWControllers/getStudentWork1/1" class="btn btn-xs btn-light-blue">
											     		    Homework Full Detail <br>
											        	</a>
													</div>
											    </div>
											</div>
										</div>
									</div>
									</div>
    </div>


<div class="col-md-6 col-lg-6">
       <div class="panel panel-white">
        <div class="panel-body no-padding">
          <div class="padding-10">
            <h4 class="no-margin inline-block padding-5">Absent Teachers 
            <!-- <span class="block text-small text-left">Total Absent</span> -->
            </h4>
          </div>
          <div class="tabbable no-margin no-padding partition-dark">
            <div class="tab-content partition-white">
              <div id="users_tab_example1" class="tab-pane padding-bottom-5 active">
                <div class="panel-scroll height-230">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Teacher Name</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                        <!-- <th class="Leave">Leave</th> -->
                      </tr>
                    </thead>
                    <tbody>

                      <?php 
                          if($emp_lev->num_rows()>0){ $i=1;                
                          foreach($emp_lev->result() as $lv_data)
                          {    $this->db->where("id",$lv_data->emp_id);
                               $empname=$this->db->get("employee_info")->row()->name;
                          ?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $empname; ?></td>
                        <td>Absent</td>
                        <td><?php echo $lv_data->a_date; ?></td>
                        <td>
                           <a href="<?php echo base_url();?>index.php/timetablepanel/arrange_apsentteacher/<?php echo $lv_data->emp_id;?>" class="btn btn-danger" >Arrangement</a>
                        </td>
                      </tr>
                      <script>
                      $("#assgin<?php echo $i;?>").show();
                      //alert("3"); 
                      $("#assgined<?php echo $i;?>").hide();
                      </script>
                      
                     
                            <?php 
														$i++;	}
														}
															?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



  </div>
<!--4rth row end-->
<div class="row">

<div class="col-md-4 col-lg-4">
      <div class="panel panel-dark">
        <div class="panel-heading">
          <h4 class="panel-title">Cash Transaction</h4>
          <div class="panel-tools">
            <div class="dropdown">
              <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-white">
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
        <div class="panel-body no-padding">
          <div class="partition-green padding-15 text-center">
            <h4 class="no-margin">Last 4 Transaction</h4>
          </div>
          <div id="accordion" class="panel-group accordion accordion-white no-margin">
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15">
                    <i class="icon-arrow"></i>
                    <?php $new = $this->db->query("SELECT * FROM cash_payment WHERE date='".date("Y-m-d")."' AND school_code='$school_code'")->num_rows();?>
                    Cash Payment <?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse in" id="collapseOne">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                    <table class="table">
                      <tbody>
                        <?php $i=1;?>
                        <?php $cash = $this->db->query("SELECT * FROM cash_payment where school_code='$school_code' ORDER BY receipt_no DESC LIMIT 4");?>
                        <?php if($cash->num_rows() >= 1):?>
                        <?php foreach($cash->result() as $row):?>
                        <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td>
                            <?php
                                    		if(strlen($row->valid_id)>1):
                                    			echo $row->valid_id;
                                    		else:
                                    			echo $row->name;
                                    		endif;
                                    	?>
                          </td>
                          <td class="center"><?php echo $row->amount;?></td>
                          <td><?php echo date("d-M-Y", strtotime("$row->date"));?></td>
                        </tr>
                        <?php $i++; endforeach;?>
                        <?php else: ?>
                        <tr>
                          <td class="center">
                            <h2>No Trasaction done yet...</h2>
                          </td>
                        </tr>
                        <?php endif;?>
                      </tbody>
                    </table>
                  </a>
                </div>
              </div>
            </div>
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15 collapsed">
                    <i class="icon-arrow"></i>
                    <?php $new = $this->db->query("SELECT * FROM bank_transaction WHERE school_code='$school_code' AND date='".date("Y-m-d")."'")->num_rows();?>
                    Bank Transaction <?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse" id="collapseTwo">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                    <table class="table">
                      <tbody>
                        <?php $i=1;?>
                        <?php $cash = $this->db->query("SELECT * FROM bank_transaction WHERE school_code='$school_code' ORDER BY receipt_no DESC LIMIT 4");?>
                        <?php if($cash->num_rows() >= 1):?>
                        <?php foreach($cash->result() as $row):?>
                        <tr>
                          <td class="center">1</td>
                          <td><?php echo $row->id_name; ?></td>
                          <td class="center"><?php echo $row->amount;?></td>
                          <td><?php echo date("d-M-Y", strtotime("$row->date"));?></td>
                        </tr>
                        <?php $i++; endforeach;?>
                      </tbody>
                      <?php else: ?>
                      <tr>
                        <td class="center">
                          <h2>No Trasaction done yet...</h2>
                        </td>
                      </tr>
                      <?php endif;?>
                    </table>
                  </a>
                </div>
              </div>
            </div>
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseThree" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15 collapsed">
                    <i class="icon-arrow"></i>
                    <?php $new = $this->db->query("SELECT * FROM director_transaction WHERE school_code='$school_code' AND date='".date("Y-m-d")."'")->num_rows();?>
                    Director Transaction <?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse" id="collapseThree">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                    <table class="table">
                      <tbody>
                        <?php $i=1;?>
                        <?php $cash = $this->db->query("SELECT * FROM director_transaction WHERE school_code='$school_code' ORDER BY receipt_no DESC LIMIT 4");?>
                        <?php if($cash->num_rows() >= 1):?>
                        <?php foreach($cash->result() as $row):?>
                        <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td>
                            <?php echo $row->applicant_name; ?>
                          </td>
                          <td class="center"><?php echo $row->amount;?></td>
                          <td><?php echo date("d-M-Y", strtotime("$row->date"));?></td>
                        </tr>
                        <?php $i++; endforeach;?>
                        <?php else: ?>
                        <tr>
                          <td class="center">
                            <h2>No Trasaction done yet...</h2>
                          </td>
                        </tr>
                        <?php endif;?>
                      </tbody>
                    </table>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>
</div>

<div class="row" style="margin-left:2px;">
  <!--<div class="col-lg-4 col-md-5">-->
  <!--	<div class="panel panel-red panel-calendar">-->
  <!--		<div class="panel-heading border-light">-->
  <!--			<h4 class="panel-title">Appointments</h4>-->
  <!--			<div class="panel-tools">-->
  <!--				<div class="dropdown">-->
  <!--					<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-white">-->
  <!--						<i class="fa fa-cog"></i>-->
  <!--					</a>-->
  <!--					<ul class="dropdown-menu dropdown-light pull-right" role="menu">-->
  <!--						<li>-->
  <!--							<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>-->
  <!--						</li>-->
  <!--						<li>-->
  <!--							<a class="panel-refresh" href="#">-->
  <!--								<i class="fa fa-refresh"></i> <span>Refresh</span>-->
  <!--							</a>-->
  <!--						</li>-->
  <!--						<li>-->
  <!--							<a class="panel-config" href="#panel-config" data-toggle="modal">-->
  <!--								<i class="fa fa-wrench"></i> <span>Configurations</span>-->
  <!--							</a>-->
  <!--						</li>-->
  <!--						<li>-->
  <!--							<a class="panel-expand" href="#">-->
  <!--								<i class="fa fa-expand"></i> <span>Fullscreen</span>-->
  <!--							</a>-->
  <!--						</li>-->
  <!--					</ul>-->
  <!--				</div>-->
  <!--				<a class="btn btn-xs btn-link panel-close" href="#">-->
  <!--					<i class="fa fa-times"></i>-->
  <!--				</a>-->
  <!--			</div>-->
  <!--		</div>-->
  <!--		<div class="panel-body">-->
  <!--			<div class="height-300">-->
  <!--				<div class="row">-->
  <!--					<div class="col-xs-6">-->
  <!--						<div class="actual-date">-->
  <!--							<span class="actual-day"><?php $cdate = date("d-m-Y H:i:s"); echo date('d',strtotime($cdate));?></span>-->
  <!--							<span class="actual-month"><?php echo date('M',strtotime($cdate));?></span>-->
  <!--						</div>-->
  <!--					</div>-->
  <!--					<div class="col-xs-6">-->
  <!--						<div class="row">-->
  <!--							<div class="col-xs-12">-->
  <!--								<div class="clock-wrapper">-->
  <!--									<div class="clock">-->
  <!--										<div class="circle">-->
  <!--											<div class="face"><?php $ctimeh =  date('H',strtotime($cdate)); ?>-->
  <!--												<div id="hour" style="transform: rotate(258.55deg);"><?php echo $ctimeh." hour";?></div>-->
  <!--												<div id="minute" style="transform: rotate(222.6deg);"><?php echo date('i',strtotime($cdate));?></div>-->
  <!--												<div id="second" style="transform: rotate(36deg);"><?php echo date('s',strtotime($cdate)); ?></div>-->
  <!--											</div>-->
  <!--										</div>-->
  <!--									</div>-->
  <!--								</div>-->
  <!--							</div>-->
  <!--						</div>-->
  <!--						<div class="row">-->
  <!--							<div class="col-xs-12">-->
  <!--								<div class="weather text-light">-->
  <!--									<i class="wi-day-sunny"></i>-->
  <!--								25�-->
  <!--								</div>-->
  <!--							</div>-->
  <!--						</div>-->
  <!--					</div>-->
  <!--				</div>-->

  <!--				<div class="row">-->
  <!--					<div class="col-xs-12">-->
  <!--						<div class="row">-->
  <!--							<div class="appointments border-top border-bottom border-light space15">-->
  <!--								<a class="btn btn-sm owl-prev text-light">-->
  <!--									<i class="fa fa-chevron-left"></i>-->
  <!--								</a>-->
  <!--								<div class="e-slider owl-carousel owl-theme" data-plugin-options="{&quot;transitionStyle&quot;: &quot;goDown&quot;, &quot;pagination&quot;: false}" style="opacity: 1; display: block;">-->
  <!--									<div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 2208px; left: 0px; display: block; transition: all 0ms ease 0s; transform: translate3d(-368px, 0px, 0px); transform-origin: 552px center; perspective-origin: 552px center;"><div class="owl-item" style="width: 368px;"><div class="item">-->
  <!--										<div class="inline-block padding-10 border-right border-light">-->
  <!--											<span class="bold-text text-small"><i class="fa fa-clock-o"></i> 17:00</span>-->
  <!--											<span class="text-light text-extra-small">1 hour</span>-->
  <!--										</div>-->
  <!--										<div class="inline-block padding-10">-->
  <!--											<span class="bold-text text-small">NETWORKING</span>-->
  <!--											<span class="text-light text-small">Out to design conference</span>-->
  <!--										</div>-->
  <!--									</div></div><div class="owl-item" style="width: 368px;"><div class="item">-->
  <!--										<div class="inline-block padding-10 border-right border-light">-->
  <!--											<span class="bold-text text-small"><i class="fa fa-clock-o"></i> 18:30</span>-->
  <!--											<span class="text-light text-extra-small">30 mins</span>-->
  <!--										</div>-->
  <!--										<div class="inline-block padding-10">-->
  <!--											<span class="bold-text text-small">BOOTSTRAP SEMINAR</span>-->
  <!--											<span class="text-light text-small">Problem Solving</span>-->
  <!--										</div>-->
  <!--									</div></div><div class="owl-item" style="width: 368px;"><div class="item">-->
  <!--										<div class="inline-block padding-10 border-right border-light">-->
  <!--											<span class="bold-text text-small"><i class="fa fa-clock-o"></i> 20:00</span>-->
  <!--											<span class="text-light text-extra-small">2 hour</span>-->
  <!--										</div>-->
  <!--										<div class="inline-block padding-10">-->
  <!--											<span class="bold-text text-small">Lunch with Nicole</span>-->
  <!--											<span class="text-light text-small">Next on Tuesday</span>-->
  <!--										</div>-->
  <!--									</div></div></div></div>-->


  <!--								</div>-->
  <!--								<a class="btn btn-sm owl-next text-light"><i class="fa fa-chevron-right"></i> </a>-->
  <!--							</div>-->
  <!--						</div>-->
  <!--					</div>-->
  <!--				</div>-->
  <!--				<div class="row">-->
  <!--					<div class="col-xs-12">-->
  <!--						<div class="pull-right">-->
  <!--							<a href="#newEvent" class="btn btn-sm btn-transparent-white new-event"><i class="fa fa-plus"></i> New Event </a>-->
  <!--							<a href="#showCalendar" class="btn btn-sm btn-transparent-white show-calendar"><i class="fa fa-calendar-o"></i> Calendar </a>-->
  <!--						</div>-->
  <!--					</div>-->
  <!--				</div>-->
  <!--			</div>-->
  <!--		</div>-->
  <!--	</div>-->
  <!--</div>-->


  <!--  <div class="panel panel-dark">
        <div class="panel-heading text-center">
            <h4 class="panel-title">Class Homework</h4>
            <div class="panel-tools">
                <div class="dropdown">
                    <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-white">
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
        
      <!--   <div class="panel-body no-padding">
          
             <?php
                                $school_code=$this->session->userdata('school_code');
                                  $this->db->where('school_code',$school_code);
                                  $class_name=$this->db->get('class_info');
                                  foreach($class_name->result() as $cname){
                                      
                                      $this->db->where('id',$cname->section);
                                      $this->db->where('school_code',$school_code);
                                      $sectionname=$this->db->get('class_section')->row();
                                      
                                       $this->db->where('id',$cname->stream);
                                      $this->db->where('school_code',$school_code);
                                      $streamname=$this->db->get('stream')->row();
                                      $this->db->where('class_id',$cname->id);
                                      $this->db->where('school_code',$school_code);
                                      $homework_name=$this->db->get('homework_name');
                                      if($homework_name->num_rows() >0){
                                ?>
            <div id="accordion" class="panel-group accordion accordion-white no-margin">
                <div class="panel no-radius">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#collapseOne<?php echo $cname->id; ?>" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle padding-15">
                                <i class="icon-arrow"></i>
                               <?php echo $cname->class_name."-".$sectionname->section."-".$streamname->stream;?><span class="label label-danger pull-right"></span>
                            </a></h4>
                    </div>
                   <div class="panel-collapse collapse" id="collapseOne<?php echo $cname->id;?>">
                        <div class="panel-body no-padding partition-light-grey">
                            <table class="table">
                                <tbody>
                                <?php 
                                     
                                ?>
                                <?php ?>
                                <?php $i=1; foreach($homework_name->result() as $row):?>
                                <tr>
                                    <td class="center"><?php echo $i;?></td>
                                    <td>
                                    	<?php
                                    	  echo $row->workDiscription." in ".$row->work_name;
                                    	?>
                                    </td>
                                   
                                </tr>
                                <?php $i++; endforeach;?>
                                <?php }else{ ?>
                                <tr>
                                    <td class="center"><h2>Home Work not define ...</h2></td>
                                </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php  }?>
        </div> 
    </div>
    </div>-->
  <!-- end: PAGE CONTENT-->