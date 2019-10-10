<!-- start: PAGE CONTENT -->
<?php
$school_code = $this->session->userdata("school_code");

?>


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
          <i class="fa fa-inr fa-2x icon-big"></i><br>


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
					
					 echo $totalIncome;
					?>
                </mark>
              </div>
              <div class="col-sm-6">
                <h6 class="block no-margin">Stock</h6>
                </br>
                <mark><?php 
					$camount=0;
					 $school_code=   $this->session->userdata("school_code");
					 $this->db->select_sum("sub_total");
					 $this->db->where('school_code',$school_code);
					 $this->db->where('date(date)',date('Y-m-d'));
				//	 $this->db->where('dabit_cradit',1);
					$stocktotal=$this->db->get('sale_info')->row();
					if($stocktotal->sub_total){
           echo $stocktotal->sub_total;
          } 
          else{
            echo "0";
          }
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
					$damount=0;
					 $school_code=   $this->session->userdata("school_code");
					 $this->db->where('school_code',$school_code);
					 $this->db->where('date(pay_date)',date('Y-m-d'));
					 $this->db->where('dabit_cradit',0);
					 $debit_amount=$this->db->get('day_book');
					 foreach($debit_amount->result() as $dm){
						 $damount=$damount + $dm->amount;
					 }
					 echo $damount;
					?>
                </mark>
              </div>
              <div class="col-sm-6">
                <h6 class="block no-margin">Credit Amount</h6>
                <mark><?php 
					$camount=0;
					 $school_code=   $this->session->userdata("school_code");
					 $this->db->where('school_code',$school_code);
					 $this->db->where('date(pay_date)',date('Y-m-d'));
					 $this->db->where('dabit_cradit',1);
					 $credit_amount=$this->db->get('day_book');
					 foreach($credit_amount->result() as $cm){
						 $camount=$camount + $cm->amount;
					 }
					 echo $camount;
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
                $date=Date("Y-m-d");
						$this->db->select('opening_balance');
						$this->db->where("school_code",$school_code);
						$this->db->where("Date(closing_date)",$date);
							$data=$this->db->get('opening_closing_balance')->row();
						//	$this->db->join('class_info','class_info.id=student_info.class_id');
						
							
						
							echo $data->opening_balance ;?></mark>
              </div>
              <div class="col-sm-6">
                <h6 class="block no-margin">Closing</h6>
                </br>
                <mark> <?php  $date=Date("Y-m-d");
						$this->db->select('closing_balance');
						$this->db->where("school_code",$school_code);
						$this->db->where("Date(closing_date)",$date);
							$data1=$this->db->get('opening_closing_balance')->row();
							echo $data1->closing_balance ; ;?></mark>
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
                    <i class="fa fa-users fa-2x icon-big"></i>
                   </div>
                <a href="<?php echo base_url(); ?>index.php/login/newAdmission">
				<div class="padding-20 core-content">
				   <!-- <h4 class="title block no-margin">Student Admission</h4>-->
				   <h4 class="title block no-margin"> New Registration</h4><br>
				   <div class="row">
					   <div class="col-sm-6">
					   <h6 class="block no-margin">Total Students</h6>
						<?php //$fsd = $this->session->userdata("fsd");
						$this->db->select('*');
							$this->db->from('student_info');
							$this->db->join('class_info','class_info.id=student_info.class_id');
							$this->db->where("class_info.school_code",$school_code);
							$query=$this->db->get();
							echo $query->num_rows() ;?>
					   </div>
					   <div class="col-sm-6">
					   <h6 class="block no-margin">Current Year Students</h6>
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
   	
							<div class="col-md-5 col-lg-3 col-sm-5">
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
                                							} else{ echo "No Pending Request";}?>
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
                            							} else{ echo "No Pending Request";}?> </a>
														<a href="<?php echo base_url();?>/index.php/login/smsreport" class="btn btn-xs btn-light-blue"><i class="fa fa-check"></i> Get Report</a>
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
														<a href="<?php echo base_url();?>/index.php/login/smsreport" class="btn btn-xs btn-light-blue"><i class="fa fa-check"></i> Get Report</a>
													</div>
												</div>
												</div>
											</div>
											
										</div>
										
									</div>
								</div>
							
    
    <div class="row">
							<div class="col-md-5 col-lg-3 col-sm-5">
								<div class="panel panel-blue core-box">
									<div class="e-slider owl-carousel owl-theme">
										<div class="item">
											<div class="panel-body">
												<div class="core-box">
												<?php   $this->db->where("school_code",$school_code);
		$sender=$this->db->get("sms_setting")->row(); ?>
													<div class="text-white text-bold">
														Available SMS [<?php echo checkBalSms($sender->uname,$sender->password);?>]
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
													$this->db->where("sms_master_id",$fty->id);
													$sentsms = $this->db->get("sent_sms_details");
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
							
							
					
    
     </div>
     
    
 
    
    <div class="row" Style="margin-left:2px;">

      
  <div class="col-lg-4 col-md-12">
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

  
    
    
    <!--2nd row end-->
<div class="row">

<div class="col-md-4 col-lg-4">
      <div class="panel panel-dark">
        <div class="panel-heading">
          <h4 class="panel-title">Today Attendance Report</h4>
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
            <h4 class="no-margin">Attendance Report</h4>
          </div>
          <div id="accordion" class="panel-group accordion accordion-white no-margin">
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseOne1" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15">
                    <i class="icon-arrow"></i>

                     Today Morning Student Attendance  <span
                      class="label label-danger pull-right"></span>

                  </a></h4>
              </div>
              <div class="panel-collapse collapse in" id="collapseOne1">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                    <table class="table">
                    <thead>
                    <th>Sno.</th>
                    <th>Section </th>
                    <th>Class </th>
                    <th>Total Student</th>
                    <th>Present </th>
                    <th>Absent </th>
                    </thead>
                                 <tbody>
                        <?php $i=1;?>
                        <?php $count=0;
                        $totstu=0;
                     

                      
                      
                         $this->db->where("school_code",$school_code);
                       // $this->db->where("section",$sectiondt->id);
                       $classdt= $this->db->get("class_info");
                     if($classdt->num_rows()>0){
                        // print_r($classdt->result());
                         foreach($classdt->result() as $sectiondt):
                            //  print_r($sectiondt);
                            // exit();
                               $this->db->where("school_code",$school_code);
                        $this->db->where("id",$sectiondt->section);
                       $classsection= $this->db->get("class_section");
                           $fsd= $this->session->userdata("fsd");
                           
                           $this->db->where("fsd",$fsd);
                            $this->db->where("status",1);
                          $this->db->where("class_id",$sectiondt->id);
                          $data= $this->db->get("student_info");
                         if($data->num_rows()>0){  
                            $this->db->where("status",1);  
                         $this->db->where("class_id",$sectiondt->id);
                         $studata=$this->db->get("student_info");
                         $totstudent= $studata->num_rows();
                        // echo "<pre>";
                      //  print_r($studata->row());
                         //$totstu=$totstu+$totstudent; 
                        
                        
                       if($studata->num_rows()>0){  ?>
                           <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td> <?php  if($classsection->num_rows()>0){ echo $classsection->row()->section ; } else{ echo "Section Not define";}?>  </td>

                          <td class="center"><?php echo $sectiondt->class_name;?></td>
                          <td class="center"><?php echo $totstudent;?></td>
                          <?php  $date=Date("Y-m-d");
                             $this->db->where("date",$date);
                          $this->db->where("school_code",$school_code);
                          $this->db->where("shift_1",1);
                          $this->db->where("class_id",$sectiondt->id);
                          $school_atten= $this->db->get("school_attendance");
                          if($school_atten->num_rows()>0){
                          
                    $resultA = $this->db->query("SELECT count(stu_id) as Total_Absent FROM attendance WHERE attendance = 0 AND class_id='$sectiondt->id' AND school_code='$school_code' AND a_date = '$date' ");
        			  
                           if($resultA->num_rows()>0){
                            $absent=$resultA->row()->Total_Absent;
                          

                          $presentstu=$totstudent-$absent;
                          // print_r($count);
                         
                        ?>
                    
                       
                          <td class="center"><?php echo $presentstu;?></td>
                          <td class="center"><?php echo $absent;?></td>
                        
                        </tr>
                        <?php  } else{ ?>
                        
                          <td class="center"><?php echo $school_atten->num_rows();?></td>
                          <td class="center"><?php echo 0;?></td>
                        
                    <?php    }  } else{?>


                          <td class="center"><?php echo "N/A";?></td>
                          <td class="center"><?php echo "N/A";?></td>

                  <?php  } $i++; } }    endforeach; } ?>
                       
                       
                     
                      </tbody>
                    </table>
                  </a>
                </div>
              </div>
            </div>
                <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapsetwo2" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15 collapsed">

                    <i class="icon-arrow"></i>

                    Today Evening Student Attendance  <span
                      class="label label-danger pull-right"></span>

                  </a></h4>
              </div>
              <div class="panel-collapse collapse in" id="collapsetwo2">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                    <table class="table">
                    <thead>
                    <th>Sno.</th>
                    <th>Section </th>
                    <th>Class </th>
                    <th>Total Student</th>
                    <th>Present </th>
                    <th>Absent </th>
                    </thead>
                                 <tbody>
                        <?php $i=1;?>
                        <?php $count=0;
                        $totstu=0;
                     

                      
                      
                         $this->db->where("school_code",$school_code);
                       // $this->db->where("section",$sectiondt->id);
                       $classdt= $this->db->get("class_info");
                     if($classdt->num_rows()>0){
                        // print_r($classdt->result());
                         foreach($classdt->result() as $sectiondt):
                            //  print_r($sectiondt);
                            // exit();
                               $this->db->where("school_code",$school_code);
                        $this->db->where("id",$sectiondt->section);
                       $classsection= $this->db->get("class_section");
                           $fsd= $this->session->userdata("fsd");
                           
                           $this->db->where("fsd",$fsd);
                             $this->db->where("status",1);
                          $this->db->where("class_id",$sectiondt->id);
                          $data= $this->db->get("student_info");
                         if($data->num_rows()>0){  
                             $this->db->where("status",1);   
                         $this->db->where("class_id",$sectiondt->id);
                         $studata=$this->db->get("student_info");
                         $totstudent= $studata->num_rows();
                        // echo "<pre>";
                      //  print_r($studata->row());
                         //$totstu=$totstu+$totstudent; 
                        
                        
                       if($studata->num_rows()>0){  ?>
                           <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td> <?php  if($classsection->num_rows()>0){ echo $classsection->row()->section ; } else{ echo "Section Not define";}?>  </td>

                          <td class="center"><?php echo $sectiondt->class_name;?></td>
                          <td class="center"><?php echo $totstudent;?></td>
                          <?php  $date=Date("Y-m-d");
                             $this->db->where("date",$date);
                          $this->db->where("school_code",$school_code);
                          $this->db->where("shift_2",1);
                          $this->db->where("class_id",$sectiondt->id);
                          $school_atten= $this->db->get("school_attendance");
                          if($school_atten->num_rows()>0){
                          
                           $resultA = $this->db->query("SELECT count(stu_id) as Total_Absent FROM attendance WHERE attendance = 0 AND class_id='$sectiondt->id' AND school_code='$school_code' AND a_date = '$date' ");
        			  
                           if($resultA->num_rows()>0){
                            $absent=$resultA->row()->Total_Absent;

                        //  $count=$count+$absent;

                          $presentstu=$totstudent-$absent;
                          // print_r($count);
                         
                        ?>
                    
                       
                          <td class="center"><?php echo $presentstu;?></td>
                          <td class="center"><?php echo $absent;?></td>
                        
                        </tr>
                        <?php  } else{ ?>
                        
                          <td class="center"><?php echo $school_atten->num_rows();?></td>
                          <td class="center"><?php echo 0;?></td>
                        
                    <?php    }  } else{?>
                    


                          <td class="center"><?php echo "N/A";?></td>
                          <td class="center"><?php echo "N/A";?></td>


                  <?php  } $i++; } }    endforeach; } ?>
                       
                       
                     
                      </tbody>
                    </table>
                  </a>
                </div>
              </div>
            </div>
                 <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseTwo2" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15 collapsed">
                    <i class="icon-arrow"></i>
                      Today  Teacher Attendance <span
                      class="label label-danger pull-right"></span>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse" id="collapseTwo2">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                  <table class="table">
                    <thead style="text-align:center;">

                    <th>Sno.</th>
                    <th>Teacher Name</th>
                
                    <th>Present / Absent </th>
                    </thead>
                      <tbody>
                      <?php $i=1;
                         $count=0;
                         
                        $totpresent=0;
                        $date=Date("Y-m-d");
                        $this->db->where("school_code",$school_code);
                      //  $this->db->where("job_category",3);
                       $data= $this->db->get("employee_info");

                       foreach($data->result() as $totteacher):
                       
                        $this->db->where("emp_id",$totteacher->id);
                        $this->db->where("a_date",$date);
                       $classdt= $this->db->get("teacher_attendance");
                 //      print_r($classdt);
                      
                          // print_r($count);
                         
                        ?>
                    
                        <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td> <?php echo $totteacher->name ;?>  </td>  
                    <?php    if($classdt->num_rows()>0){?>   <td class="center"> <span style="color:green;"><?php if(($classdt->row()->attendance)==1){ echo "Present" ;?></span><?php } else{  ?><span style="color:red;"><?php  echo "Absent" ; ?></span></td><?php } } else{?>
                        <td> Today's Attendance Not Done. </td>  
                         <?php }?>
                        </tr>
               <?php     $i++;  endforeach;?>
                       
                       
                     
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



    <div class="col-md-4 col-lg-4">
      <div class="panel panel-dark">
        <div class="panel-heading">
          <h4 class="panel-title">Total Due Report</h4>
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
            <h4 class="no-margin">Due Report</h4>
          </div>
          <div id="accordion" class="panel-group accordion accordion-white no-margin">
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseOne4" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15">
                    <i class="icon-arrow"></i>
                    <?php $new = $this->db->query("SELECT * FROM cash_payment WHERE date='".date("Y-m-d")."' AND school_code='$school_code'")->num_rows();?>
                  This Month Due Report <?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse in" id="collapseOne4">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                       <table class="table">
                    <thead>
                    <th>Sno.</th>
                    <th>Class </th>
                      <th>Section </th>
                    <th>Total Fee Due</th>
                    </thead>
                      


                      <tbody>
                        <?php $k=1;
                        $feecount=0;
                        $date=Date("Y-m-d");
                        $month = date("m", strtotime($date));
                        $yearmonth= date("m-y",strtotime($date));
                       // print_r($rmo);
                    //   $this->db->distinct();
                       $this->db->select('class_name,section,id');
                        $this->db->where("school_code",$school_code);
                        $classdt= $this->db->get("class_info");
                        //  print_r($this->session->userdata("fsd"));
                       
                        //  exit();
                        foreach($classdt->result() as $data): 
                            
                            // print_r($data->id);
                            $this->db->where("status",1);
                    	 	$this->db->where("class_id",$data->id);
                    	 	$this->db->where("fsd",$this->session->userdata('fsd'));
                    	 	$student = $this->db->get("student_info");
                    	 	 if($student->num_rows() > 0){
                    	$isData = $this->db->count_all("fee_deposit"); 
                    	if($isData > 0){

                    	   // print_r($isData);
                    	   // print_r($student->num_rows());
                    	   
                    	     $count = 1;
						$tot=0.00;
						$this->db->where("id",$fsd);
						$fdate =	$this->db->get("fsd")->row()->finance_start_date;

						$sum=0;
								 //$x=0;

				    foreach($student->result() as $stuDetail):
				    	$stu_id = $stuDetail->id;
				    	//print_r($school_code);
				    	$this->db->where("student_id",$stu_id);
				    	$this->db->where("school_code",$school_code);
				    	$rows = $this->db->get("guardian_info")->row();
				    	if($this->session->userdata("fsd")){
				    		$total = $this->db->query("SELECT SUM(paid) as totalpaid, SUM(total) as totaldeposite,invoice_no from fee_deposit WHERE student_id = '$stu_id' AND finance_start_date='$fsd' AND school_code='$school_code'")->row(); 
							
							
								$this->db->where("student_id",$stu_id);
								$this->db->where("fsd",$fsd);
								$fee_record = $this->db->get("deposite_months");
							
			               $i=0;
							foreach($fee_record->result() as $fd):
							     if($fd->deposite_month<4){
								$realm=  $fd->deposite_month-4+12;
					 
							}else{
							 $realm= $fd->deposite_month-4;}
							    $i++; endforeach; 
							    
							    	$cd=0;
			  			if($this->session->userdata("fsd")){
			  				$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("student_id",$stu_id);
								$this->db->where("finance_start_date",$fsd);
							//	$this->db->where("status",1);
								$feedue = $this->db->get("fee_deposit");
								
								foreach($feedue->result() as $fd):?>
																
								<!-- <span class="label label-success" style="line-height:20px;">
								<?php //echo date("M-y",strtotime("$fd->diposit_date"));?> 
								 </span> -->
								<?php $cd=$cd+$fd->total;?>
							 <?php  endforeach; 
			  			   }
			  			   
			  			   	$depmonth=array();
            						$mbk=0;
								 	$this->db->where('invoice_no',$total->invoice_no); 
								 	$this->db->where('student_id',$stu_id);
                                  	$mbalance=$this->db->get('feedue');
								 	//print_r($mbalance->mbalance);
								 	if($mbalance->num_rows()>0){
								 	if(strlen($mbalance->row()->mbalance) > 0){
								 	    $db=$mbalance->row()->mbalance;
								 	    
								 	}}
									$cdate = date("Y-m-d");
									$cmonth = date("Y-m",strtotime($cdate));
									//print_r($stu_id);
									$this->db->where("student_id",$stu_id);
									$dipom = $this->db->get("deposite_months");
									if($dipom->num_rows()>0){
										$g=0;	
    									foreach($dipom->result() as $dip):
    										$depmonth[$g]=$dip->deposite_month;
    									//	echo $depmonth[$g];
    										$g++;	
    									
    									endforeach;
    									//	print_r($depmonth);
										$this->db->where_not_in("month_number",$depmonth);
										$this->db->where("school_code",$this->session->userdata("school_code"));
										$fcd = 	$this->db->get("fee_card_detail");
										if($fcd->num_rows()>0){
							
										$searchM[]=0;	$rt=0;$month="";	
											foreach($fcd->result() as $fcg):
											if($fcg->month_number<4){
												$roldm=$fcg->month_number-4+12;
											//	print_r($roldm);
												
											}
											else{
												$roldm=$fcg->month_number-4;
												//	print_r($roldm);
											}
									$oldm =  date('Y-m', strtotime("$roldm months", strtotime($fdate)));
										//print_r($oldm);
									if($oldm<=$cmonth){
										$searchM[$rt]=$fcg->month_number;
									 $duedate= date("M-Y",strtotime($oldm));
										$month =$month." and ".$duedate;
									
										$rt++;
									//	print_r($month);
										// $rt;
								//	echo $cmonth;
							}
							//echo $rt;
									endforeach;
									
									if($rt>0){
								  //  print_r($rt);
								//$searchM[$rt]=13;
									//$this->db->distinct();
								
									$this->db->select_sum("fee_head_amount");
									if($school_code ==1){
										$this->db->where("cat_id",3);}
									$this->db->where("fsd",$fsd);
									$this->db->where("class_id",$stuDetail->class_id);
									
								 $this->db->where_in("taken_month",13);
								 $fee_head = $this->db->get("class_fees");
								 
								//  	$this->db->select_sum("fee_head_amount");
								// 	if($school_code ==1){
								// 		$this->db->where("cat_id",3);}
								// 	$this->db->where("fsd",$fsd);
								// 	$this->db->where("class_id",$stuDetail->class_id);
									
								//  $this->db->where_in("taken_month",13);
								//  $fee_head_one = $this->db->get("class_fees")->row()->fee_head_amount;
								 
								 if($fee_head->num_rows()>0){ 
									 $fee_head =$fee_head->row()->fee_head_amount;
									 $exdate1=Date("y-m-d");
									 $dte1 = date("m",strtotime($exdate1));
									 
									 	$this->db->where("fsd",$fsd);
									$this->db->where("class_id",$stuDetail->class_id);
									
									 $this->db->where_in("taken_month",$searchM[$rt-1]);
								 
								 $examfee1 = $this->db->get("class_fees");
								 if($examfee1->num_rows()>0){
								     
								    $exfee1= $examfee1->row()->fee_head_amount;
								    
									$totfee2= $fee_head * $rt;
									$totfee=$totfee2+$exfee1;
									
								 } 
								 else{
								    
								//      print_r($stuDetail->username);
								//  	print_r($fee_head);
								// 	print_r($rt);
								 	$totfee=$fee_head * $rt;
								//  		print_r($totfee);
								 }
									 if($stuDetail->transport==1){
								     $vid=$stuDetail->vehicle_pickup;
								     $this->db->where("id",$vid);
								    $rootdt= $this->db->get("transport_root_amount");
								     if($rootdt->num_rows()>0){
								       $tfee6=  $rootdt->row()->transport_fee;
								       $tfee7=$tfee6*($rt);
								       $totfee=$totfee+ $tfee7;
								     }
								     else{
								         echo "root not define";
								     }
								     
								 } 
								 else{
								     $totfee =$totfee;
								 }
									// $feehead=$fee_head+($fee_head_one*$rt);
								 $sum=$sum + ($totfee) ;
									 
								//  echo "<br>".($totfee) ;
								 
								 }else{
									 echo "fee Not found";	}
							 }
							}else{
								
							}

							}else{
								$this->db->where("school_code",$this->session->userdata("school_code"));
								$fcd = 	$this->db->get("fee_card_detail");
								$rt=0;
									$month="";
								foreach($fcd->result() as $fcg):
									if($fcg->month_number<4){
										$roldm=$fcg->month_number-4+12;
									}else{
									$roldm=$fcg->month_number-4;
									}	$oldm =  date('Y-m', strtotime("$roldm months", strtotime($fdate)));
									if($oldm<=$cmonth){
										$searchM[$rt]=$fcg->month_number;
									 $duedate = date("M-Y",strtotime($oldm));
							 	    $month =$month." and ".$duedate;
										$rt++;
								//	echo $fcg->month_number;
								//	echo $cmonth;
									
							}
								endforeach;
									$adable_amount=0;
						  //	$searchM[$rt]=13;
								//$this->db->distinct();
								$this->db->select_sum("fee_head_amount");
								$this->db->where("fsd",$fsd);
								$this->db->where("class_id",$stuDetail->class_id);
							//	print_r($stuDetail->class_id);
							if($school_code ==1){$this->db->where("cat_id",3);}
							
							    $this->db->where_in("taken_month",$searchM[$rt-1]);
								$fee_head = $this->db->get("class_fees");
								
								if($fee_head->num_rows()>0){
								    
								     $this->db->select_sum("fee_head_amount");  
									$this->db->where("class_id",$stuDetail->class_id);
									$this->db->where("fsd",$fsd);
									$this->db->where_in("taken_month",13);
									$one_all_amount = $this->db->get("class_fees");
									if($one_all_amount->num_rows()>0){
										$one_all_amount=$one_all_amount->row()->fee_head_amount;
									
								// 	    for($ui=0;$ui<$rt;$ui++){
								// 			if($ui>0){
								// 				$adable_amount =$one_all_amount+$adable_amount;
								// 			}
								// 		}
								 $fee8=$one_all_amount*($rt);
								 
									$fee9 =$fee_head->row()->fee_head_amount;
									$fee_head=$fee8 + $fee9;
									
									if($stuDetail->transport==1){
								     $vid=$stuDetail->vehicle_pickup;
								     $this->db->where("id",$vid);
								    $rootdt= $this->db->get("transport_root_amount");
								     if($rootdt->num_rows()>0){
								       $tfee4=  $rootdt->row()->transport_fee;
								       $tfee5=$tfee4*($rt);
								       $fee_head=$fee_head+ $tfee5;
								     }
								     else{
								         echo "root not define";
								     }
								     
								 } 
								 else{
								     $fee_head =$fee_head;
								 }
									
									$sum=$sum + $fee_head;
								// echo "<br>".$fee_head;
							   	?><input type = "hidden" id="amt<?php echo $count;?>" value="<?php echo $fee_head;?>"/><?php 
								}else{ }
								}else{
									echo "fee Not found";}
									} ?>
									
										<?php $count++; ?>
			  		<?php  }else{
	
                             }  endforeach;    ?>

                        <tr>
                          <td class="center"><?php echo $k;?></td>
                          <td><?php echo $data->class_name;?></td>
                           <td><?php 
                           $this->db->where("id",$data->section);
                          $sec= $this->db->get("class_section");
                           if($sec->num_rows()>0){
                                echo $sec->row()->section;
                           }
                           else{
                           echo "Section Not Found"; }?></td>
                          <td><?php echo $sum; ?></td>
                          </tr>

                     <?php   $k++;  } } endforeach; ?>
                    </table>
                  </a>
                </div>
              </div>
            </div>
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseTwo5" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15 collapsed">
                    <i class="icon-arrow"></i>
                    <?php $new = $this->db->query("SELECT * FROM bank_transaction WHERE school_code='$school_code' AND date='".date("Y-m-d")."'")->num_rows();?>
                  This Year Due Report<?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse" id="collapseTwo5">
                <div class="panel-body no-padding partition-light-grey">
                  <a href="<?php echo base_url()?>index.php/login/dayBook">
                  <table class="table">
                    <thead>
                    <th>Sno.</th>
                    <th>Class Name</th>
                    <th>Total Fee Due</th>
                    </thead>
                    <tbody>
                        <?php $i=1;
                        $feecount=0;
                        $date=Date("Y-m-d");
                        $month = date("m", strtotime($date));

                        $this->db->where("school_code",$school_code);
                        $classdt= $this->db->get("class_info");
                        //  print_r($this->session->userdata("fsd"));
                        //  //print_r($classdt->result());
                        //  exit();
                        foreach($classdt->result() as $data):
                          $this->db->where("class_id",$data->id);
                          $studt=$this->db->get("student_info");
                          // echo "<pre>";
                          // print_r($studt->result());
                           
                          // exit();
                          if($studt->num_rows()>0){

                          $this->db->where("student_id",$studt->row()->id);
                          $this->db->where("deposite_month",$month);
                          $feedt=$this->db->get("fee_deposit");
                          if($feedt->num_rows()>0){

                          }
                          else{ 
                            $this->db->where("class_id",$data->id);
                            $this->db->where("fsd",$this->session->userdata("fsd"));
                           $classiddt= $this->db->get("class_fees");
                           if($classiddt->num_rows()>0){

                          // $this->db->where("school_code",$school_code);
                           $this->db->where("id",$classiddt->row()->class_id);
                           $classnm= $this->db->get("class_info")->row();


                            
                            $this->db->select_sum("fee_head_amount");
                            $this->db->where("class_id",$data->id);
                            $this->db->where("fsd",$this->session->userdata("fsd"));
                           $classfee= $this->db->get("class_fees")->row();
                           //$feecount=$feecount-$classfee;
                          ?>
                        <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td><?php echo $classnm->class_name;?></td>
                          <td><?php echo $classfee->fee_head_amount; ?></td>
                          </tr>

                     <?php $i++; }  }   }  endforeach; ?>
                        
                      </tbody>
                    </table>
                  </a>
                </div>
              </div>
            </div>
            <div class="panel no-radius">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a href="#collapseThree6" data-parent="#accordion" data-toggle="collapse"
                    class="accordion-toggle padding-15 collapsed">
                    <i class="icon-arrow"></i>
                    <?php $new = $this->db->query("SELECT * FROM director_transaction WHERE school_code='$school_code' AND date='".date("Y-m-d")."'")->num_rows();?>
                   Fsd Wise Due <?php if($new > 0):?> <span
                      class="label label-danger pull-right"><?php echo $new;?></span><?php endif;?>
                  </a></h4>
              </div>
              <div class="panel-collapse collapse" id="collapseThree6">
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