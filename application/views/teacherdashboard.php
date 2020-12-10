<!-- start: PAGE CONTENT -->
<style>
blink{
    animation:blinker 0.6s linear infinite;
    color:#FF0000;
}

@keyframes blinker{
    50%{ opacity:0; }
}

</style>
<?php 
$school_code = $this->session->userdata("school_code");
$is_login = $this->session->userdata('is_login');
$is_lock = $this->session->userdata('is_lock');
$logtype = $this->session->userdata('login_type');
$this->db->where("school_code",$school_code);
$this->db->where("category","All Employee");
$this->db->order_by("id limit 1");
$noticeForTeacher=$this->db->get("notice");?>
<div style="background-color: green; color: white;" class="form-control">
<marquee behavior="alternate" onmouseover="this.stop();"
		onmouseout="this.start();">

		<?php
		if($noticeForTeacher->num_rows()>0){
	echo $noticeForTeacher->row()->message;
}?>
</marquee>
</div>
<?php
if($logtype==3){?>
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
					Something going wrong contect to <strong>NIKTECH SOFTWARE SOLUTION</strong> for this.... :(
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
					Something going wrong contect to <strong>NIKTECH SOFTWARE SOLUTION</strong> for this.... :(
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
                <div class="partition-blue padding-20 text-center core-icon">
                    <i class="fa fa-tasks fa-2x icon-big"></i>
                </div>
                <a href="<?php echo base_url(); ?>index.php/login/teacherschedulingreport">
                <div class="padding-20 core-content">
                    <h4 class="title block no-margin"> Your Time Table</h4>
                    <br/>
                    <span class="subtitle"> Access Your time table. </span>
                </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-red padding-20 text-center core-icon">
                    <i class="fa fa-tasks fa-2x icon-big"></i>
                </div>
                <a href="<?php echo base_url(); ?>index.php/login/schedulingReport">
                <div class="padding-20 core-content">
                    <h4 class="title block no-margin">All Teacher Time Table</h4>
                    <br/>
                    <span class="subtitle"> Access All Teacher time table. </span>
                </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-red padding-20 text-center core-icon">
                    <i class="fa fa-tasks fa-2x icon-big"></i>
                </div>
                <a href="#">
                <div class="padding-20 core-content">
                    <h4 class="title block no-margin">Exam Duty</h4>
                    <br/>
                    <span class="subtitle"> You have no exam duty at now.</span>
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
    <?php $uname=  $this->session->userdata('username');
            $this->db->where('username',$uname);
            $data=$this->db->get('employee_info')->row();
            $this->db->where('class_teacher_id',$data->id);
              $tchid=  $this->db->get('class_info');
              if($tchid->num_rows()>0)
              {
                $date=date('y-m-d');
                $this->db->where('class_id',$tchid->row()->id);
                $this->db->where('a_date',$date);
             $atn=   $this->db->get('attendance');?>
<?php } ?>
</div>  
<div class="row">
<?php
$total=0.00;
  $uname=  $this->session->userdata('username');

    $this->db->where('username',$uname);
    $empdata=$this->db->get('employee_info')->row();
    
        $this->db->where('class_teacher_id',$empdata->id);
          $empid=  $this->db->get('class_info');
          if($empid->num_rows()>0){
            $date1=date('Y-m-d');
            $this->db->where('class_id',$empid->row()->id);
            //$this->db->where('a_date',$date);
		 $studata=$this->db->get('student_info');
		
    ?>
      <div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-orange padding-20 text-center core-icon">
                    <i class="fa fa-tasks fa-2x icon-big"></i>
                </div>
                 <div class="padding-20 core-content">
                    <h4 class="title block no-margin">Today Attendance</h4>
                    <br/>
                   <blink> <h4><?php if($atn->num_rows()>0){ echo "Done";} else{ echo "Not Done";}?></h4></blink>
                </div>
             
            </div>
        </div>
    </div>
      <div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-orange padding-20 text-center core-icon">
                   <i class="fa fa-inr fa-2x icon-big"></i>
                </div>
                 <div class="padding-20 core-content">
                    <h4 class="title block no-margin">Today Class Fee</h4>
					<br/>
					<?php 
					 foreach($studata->result() as $stuid){
						//echo $stuid->id;
						$this->db->where('student_id',$stuid->id);
						$this->db->where('DATE(diposit_date)',$date1);
						$this->db->select_sum('paid');
					 $stufee=$this->db->get('fee_deposit');
					
					 if($stufee->num_rows()>0){
					?>
					<?php  $total=$total+$stufee->row()->paid; ?>
					 <?php }else{?>
						<?php  $total=0;?>
					 <?php }}?>
					 <h4><?php echo $total.".00"; ?></h4>
                </div>
             
            </div>
        </div>
    </div>
      <div class="col-md-6 col-lg-3 col-sm-6">
      <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-purple padding-20 text-center core-icon">
                   <i class="fa fa-inr fa-2x icon-big"></i>
                </div>
                 <div class="padding-20 core-content">
                    <h4 class="title block no-margin">Leave Status</h4>
					<br/>
				
					 <h4><a href="<?php echo base_url();?>singleTeacherControllers/TeacherLeave" >Click for view</a></h4>
                </div>
                
            </div>
        </div>
    </div>
     <div class="col-md-6 col-lg-3 col-sm-6">
    <div id="notes">
        <div class="panel panel-note">
            <div class="e-slider owl-carousel owl-theme">
            <?php $this->db->limit(5);?>    
            <?php 
            $this->db->where("school_code",$this->session->userdata("school_code"));
            $this->db->where("user_id",$this->session->userdata("userid")); ?>
            <?php $res = $this->db->get("privatenote"); ?>
            
            <?php if($res->num_rows() > 0):?>            
            <?php foreach($res->result() as $row):?>
            <div class="item">
                    <div class="panel-heading">
                        <h4 class="no-margin"><?php echo $row->title; ?></h4>
                    </div>
                    <div class="panel-body space10">
                        <div class="note-short-content">
                            <?php echo implode(' ', array_slice(explode(' ', $row->note), 0, 15)); ?>...
                        </div>
                    </div>
                    <div class="panel-footer">
                        <time class="timestamp" title="<?php echo $row->date; ?>">
                            <?php echo $row->date; ?>
                        </time>
                        <div class="note-options pull-right">
                            <a href="#readNote" class="read-note" data-subviews-options='{"startFrom": "right", "onShow": "readNote(subViewElement)", "onHide": "hideNote()"}'>
                            	<i class="fa fa-chevron-circle-right"></i> Read</a>
                            	<a href="<?php echo base_url()?>index.php/msgNoticeControllers/delNotice1/<?php echo $row->id;?>" class="delete-note"><i class="fa fa-times"></i> Delete</a>
                        </div>
                    </div>
                </div>
                 <?php endforeach;?>    
            <?php else:?>
            	<div class="item">
                   <center> <h3 style="color:red">There is no any note available this time.</h3></center>
                </div>
            <?php endif;?>    
            </div>
        </div>
    </div>
</div>
<?php }?>
 
     
     </div>
<div class="row">
<div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-blue padding-20 text-center core-icon">
                    <i class="fa fa-tasks fa-2x icon-big"></i>
                </div>
                <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/TeacherLeave">
                <div class="padding-20 core-content">
                    <h4 class="title block no-margin"> Your Leave Details</h4>
                    <br/>
                <?php  if($pending){?>  <h4 class="title block no-margin"><blink>Pending Leave</blink> <?php echo "[". $pending."]";}else{?>
                <h4 class="title block no-margin"><blink> No Leave in Pending </blink><?php }
                    ?></h4>
             </div>
                </a>
            </div>
        </div>
    </div>
    <!--<div class="col-md-10 col-lg-5 col-sm-5">
        <div class="panel panel-default panel-white ">
            <div class="panel-body">
                <div class="partition-green padding-20 text-center ">
                 <b>Given Homework</b>
                </div>
               </a>
               <table class="table table-bordered table-striped">
                <thead><tr><th>Class</th>
                    <th>Subject</th>
                    <th>Work Subject Name</th>
                     <th>Remark</th>
                      <th>Define Work</th>
                     <th>Grade</th>
                  
                </tr></thead>
                    <div class="padding-0px core-content">
                     <?php $user=$this->session->userdata('username');
                        $this->db->where('username',$user);
                     $emp=   $this->db->get('employee_info')->row();
                     $id= $emp->id;
                     $date=date('y-m-d');
                     $this->db->where('DATE(DueWorkDate)>=',$date);
                     $this->db->where('givenby',$user);
                    $homework= $this->db->get('homework_name')->result();
                    foreach($homework as $home)
                    {?>
                           <?php $this->db->where('id',$home->class_id);
                           $classname=$this->db->get('class_info');
                           
                            $this->db->where('id',$home->subject_id);
                           $subjectname=$this->db->get('subject');
                          
                           ?>
                    <tr><td>   <?php if($classname->num_rows()>0){  $classname =  $classname->row();echo $classname->class_name;}?></td>
                   <td>  <?php   if($subjectname->num_rows()>0){$subjectname=$subjectname->row(); echo $subjectname->subject;}?></td>
                    <td>  <?php  echo $home->work_name;?></td>
                     <td>  <?php  echo $home->remark;?></td>
                     <td>  <?php  echo $home->workDiscription;?></td>
                    
                      <td>  <?php  echo $home->grade;?></td></tr>

                   <?php }



                        ?>
                     <h2 class="title block no-margin"></h2>
                       <br/>
                       <span class="subtitle"><strong><h3> </h3> </strong>  </span>
               </div>
           </table>
           </div>
      </div>
  </div> -->
     


 <!--<div class="col-md-6 col-lg-3 col-sm-6">-->
 <!--       <div class="panel panel-default panel-white ">-->
 <!--           <div class="panel-body no-padding">-->
 <!--             <a href="<?php echo base_url(); ?>index.php/smsAjax/smsPanel">-->
 <!--               <div class="partition-green padding-20 text-center ">-->
 <!--                   Click for SMS Panel-->
 <!--               </div>-->
 <!--              </a>-->
	<!--                <div class="padding-20 core-content">-->
	<!--                	<h2 class="title block no-margin"></h2>-->
	<!--                	<br/>-->
	<!--                	<span class="subtitle"><strong><h3> </h3> </strong>  </span>-->
	<!--                </div>-->
               
 <!--           </div>-->
 <!--       </div>-->
 <!--   </div>-->
    
     <!-- <div class="col-md-8 col-lg-4 col-sm-8">
         	<div class="panel panel-white">
         	<div class="padding-10">
											
											<h4 class="no-margin inline-block padding-5 bg-info" style="color:blue">All Classes Attendance Report <span class="block text-small text-left">Total Absent</span></h4>
											
										</div>
        	<div id="users_tab_example1" class="tab-pane padding-bottom-5 active">
													<div class="panel-scroll height-230">
														<table class="table table-striped table-hover">
															<thead>
																<tr>
																	
																	<th><span class="">Class Name</span><a href="#" class="btn"></i></a></th>
																	<th >Total
																	</th>
																	<th class="Present">Present
																	</th>
																	<th class="Absent">Absent
																	</th>
																	<th class="Leave">Leave
																	</th>
																	
																	
																</tr>
																
															
															</thead>
															<tbody>
															
															<?php $dat=date("Y-m-d") ;
															
															$this->db->distinct();
															//$this->db->select('id');
															$this->db->where("school_code",$this->session->userdata("school_code"));
															
															$dfg = $this->db->get('class_info');
															if($dfg->num_rows()>0){
															$vyt=	$dfg->result();
															  
															foreach($vyt as $t):
															
															$this->db->where("school_code",$this->session->userdata("school_code"));
															$this->db->where("DATE(a_date)",$dat);
															$this->db->where("class_id",$t->id);
															$grt = $this->db->get("attendance");
															if($grt->num_rows()>0){
																$ft = $grt->result();
																$p=0;$l=0;$a=0;
																	foreach($ft as $f):
																
																	if($f->attendance==0){
																	
																	$a=$a+1;
																	}
																	else{
																		$p=$p+1;	
																	}
																	
																	endforeach;
															?>
															<tr>
																	
																	<td><span >&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $t->class_name;?></span><a href="#" class="btn"></a></td>
																	<td class="center"><?php echo $grt->num_rows();?>
																	</td>
																	<td class="center"><?php echo $p;?>
																	</td>
																	<td class="center"><?php echo $a;?>
																	</td>
																	<td class="center"><?php echo $l;?>
																	</td>
															</tr>
															
															<?php } else{
																
															}
															endforeach;
														}
															?>
																
																
																
																
															</tbody>
														</table>
													</div>
												</div>
												</div>
        </div>-->
     <div class="col-md-8 col-lg-4 col-sm-8">
         	<div class="panel panel-white">
         	<div class="padding-10">
			  <?php $dat=date("Y-m-d") ;
															
															$this->db->distinct();
															//$this->db->select('id');
															//echo $this->session->userdata('username');
														
															$this->db->where('username',$this->session->userdata('username'));
															$emp=$this->db->get('employee_info')->row();
														 $empid=$emp->id;
													
															$this->db->where("school_code",$this->session->userdata("school_code"));
															$this->db->where('class_teacher_id',$empid);
															$dfg = $this->db->get('class_info');
															if($dfg->num_rows()>0){
															$vyt=	$dfg->result();
															  if($vyt>0)
															  {?>
											<h4 class="no-margin inline-block padding-5 bg-info" style="color:blue">Your Class Attendance Report <span class="block text-small text-left">Total Absent</span></h4>
										<br>	<br><p style="color:blue"><b>You can access only your class Attendance Report</b></p> 
											
										</div>
        						<div id="users_tab_example1" class="tab-pane padding-bottom-5 active">
													<div class="panel-scroll height-230">
														<table class="table table-striped table-hover">
															<thead>
																<tr>
																	
																	<th>Class Name</th>
																	<th >Total
																	</th>
																	<th class="Present">Present
																	</th>
																	<th class="Absent">Absent
																	</th>
																	<th class="Leave">Leave
																	</th>
																	
																	
																</tr>
																
															
															</thead>
															<tbody>
															    <?php 
															foreach($vyt as $t):
															
															$this->db->where("school_code",$this->session->userdata("school_code"));
															$this->db->where("DATE(a_date)",$dat);
															$this->db->where("class_id",$t->id);
															$grt = $this->db->get("attendance");
															if($grt->num_rows()>0){
																$ft = $grt->result();
																$p=0;$l=0;$a=0;
																	foreach($ft as $f):
																
																	if($f->attendance==0){
																	
																	$a=$a+1;
																	}
																	else{
																		$p=$p+1;	
																	}
																	
																	endforeach;
															?>
															<tr>
																	
																	<td><span >&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $t->class_name;?></span><a href="#" class="btn"></a></td>
																	<td class="center"><?php echo $grt->num_rows();?>
																	</td>
																	<td class="center"><?php echo $p;?>
																	</td>
																	<td class="center"><?php echo $a;?>
																	</td>
																	<td class="center"><?php echo $l;?>
																	</td>
															</tr>
															</tbody>
															<?php }else{ }endforeach;} } else{ ?>
															<h3 class="no-margin inline-block padding-5 bg-info" style="color:blue">All Class Attendance Report <span class="block text-small text-left">Total Absent</span></h3>
											<br><p style="color:blue"><b>You are not a class teacher of any class so you can access the Attendance Report of all class</b></p> 
											</div>
							    <div id="users_tab_example1" class="tab-pane padding-bottom-5 active">
														<div class="panel-scroll height-230">
															<table class="table table-striped table-hover">
																<thead>
																	<tr>
																		
																		<th><span class="">Class Name</span><a href="#" class="btn"></i></a></th>
																		<th >Total
																		</th>
																		<th class="Present">Present
																		</th>
																		<th class="Absent">Absent
																		</th>
																		<th class="Leave">Leave
																		</th>
																		
																		
																	</tr>
																	
																
																</thead>
																<tbody>
																    <?php
											$dat=date("Y-m-d") ;
															
											$this->db->distinct();
											//$this->db->select('id');
											$this->db->where("school_code",$this->session->userdata("school_code"));
											
											$dfg = $this->db->get('class_info');
											if($dfg->num_rows()>0){
											$vyt=	$dfg->result();
											  
											foreach($vyt as $t):
											
											$this->db->where("school_code",$this->session->userdata("school_code"));
											$this->db->where("DATE(a_date)",$dat);
											$this->db->where("class_id",$t->id);
											$grt = $this->db->get("attendance");
											if($grt->num_rows()>0){
												$ft = $grt->result();
												$p=0;$l=0;$a=0;
													foreach($ft as $f):
												
													if($f->attendance==0){
													
													$a=$a+1;
													}
													else{
														$p=$p+1;	
													}
													
													endforeach;
											?>
											<tr>
													
													<td><span >&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $t->class_name;?></span><a href="#" class="btn"></a></td>
													<td class="center"><?php echo $grt->num_rows();?>
													</td>
													<td class="center"><?php echo $p;?>
													</td>
													<td class="center"><?php echo $a;?>
													</td>
													<td class="center"><?php echo $l;?>
													</td>
											</tr>
											
											<?php }else{
												
											}
											endforeach;
										}
										
											
										}
															?>	
																
																
																
																
															</tbody>
														</table>
													</div>
												</div>
								    <div class="col-lg-3 col-md-12">
							            <div class="panel-body no-padding">
									        <div class="tabbable no-margin no-padding partition-dark">
											<div class="tab-content partition-white">
											<div id="users_tab_example2" class="tab-pane padding-bottom-5">
													<div class="panel-scroll height-230">
														<table class="table table-striped table-hover">
															<tbody>
																<tr>
																	<td class="center"><img src="assets/images/avatar-3.jpg" class="img-circle" alt="image"/></td>
																	<td><span class="text-small block text-light">Visual Designer</span><span class="text-large">Steven Thompson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																	<td class="center">
																	<div>
																		<div class="btn-group">
																			<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																				<i class="fa fa-cog"></i> <span class="caret"></span>
																			</a>
																			<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-edit"></i> Edit
																					</a>
																				</li>
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-share"></i> Share
																					</a>
																				</li>
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-times"></i> Remove
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																	</td>
																</tr>
																<tr>
																	<td class="center"><img src="assets/images/avatar-5.jpg" class="img-circle" alt="image"/></td>
																	<td><span class="text-small block text-light">Senior Designer</span><span class="text-large">Kenneth Ross</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																	<td class="center">
																	<div>
																		<div class="btn-group">
																			<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																				<i class="fa fa-cog"></i> <span class="caret"></span>
																			</a>
																			<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-edit"></i> Edit
																					</a>
																				</li>
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-share"></i> Share
																					</a>
																				</li>
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-times"></i> Remove
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																	</td>
																</tr>
																<tr>
																    <td class="center"><img src="assets/images/avatar-4.jpg" class="img-circle" alt="image"/></td>
																	<td><span class="text-small block text-light">Web Editor</span><span class="text-large">Ella Patterson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																	<td class="center">
																	<div>
																		<div class="btn-group">
																			<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																				<i class="fa fa-cog"></i> <span class="caret"></span>
																			</a>
																			<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-edit"></i> Edit
																					</a>
																				</li>
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-share"></i> Share
																					</a>
																				</li>
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-times"></i> Remove
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<div id="users_tab_example3" class="tab-pane padding-bottom-5">
													<div class="panel-scroll height-230">
														<table class="table table-striped table-hover">
															<tbody>
																<tr>
																	<td class="center"><img src="assets/images/avatar-2.jpg" class="img-circle" alt="image"/></td>
																	<td><span class="text-small block text-light">Content Designer</span><span class="text-large">Nicole Bell</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																	<td class="center">
																	<div>
																		<div class="btn-group">
																			<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																				<i class="fa fa-cog"></i> <span class="caret"></span>
																			</a>
																			<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-edit"></i> Edit
																					</a>
																				</li>
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-share"></i> Share
																					</a>
																				</li>
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-times"></i> Remove
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																	</td>
																</tr>
																<tr>
																	<td class="center"><img src="assets/images/avatar-3.jpg" class="img-circle" alt="image"/></td>
																	<td><span class="text-small block text-light">Visual Designer</span><span class="text-large">Steven Thompson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																	<td class="center">
																	<div>
																		<div class="btn-group">
																			<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																				<i class="fa fa-cog"></i> <span class="caret"></span>
																			</a>
																			<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-edit"></i> Edit
																					</a>
																				</li>
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-share"></i> Share
																					</a>
																				</li>
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-times"></i> Remove
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div></td>
																</tr>
																<tr>
																	<td class="center"><img src="assets/images/avatar-5.jpg" class="img-circle" alt="image"/></td>
																	<td><span class="text-small block text-light">Senior Designer</span><span class="text-large">Kenneth Ross</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																	<td class="center">
																	<div>
																		<div class="btn-group">
																			<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																				<i class="fa fa-cog"></i> <span class="caret"></span>
																			</a>
																			<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-edit"></i> Edit
																					</a>
																				</li>
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-share"></i> Share
																					</a>
																				</li>
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-times"></i> Remove
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div></td>
																</tr>
																<tr>
																	<td class="center"><img src="assets/images/avatar-4.jpg" class="img-circle" alt="image"/></td>
																	<td><span class="text-small block text-light">Web Editor</span><span class="text-large">Ella Patterson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
																	<td class="center">
																	<div>
																		<div class="btn-group">
																			<a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
																				<i class="fa fa-cog"></i> <span class="caret"></span>
																			</a>
																			<ul role="menu" class="dropdown-menu dropdown-dark pull-right">
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-edit"></i> Edit
																					</a>
																				</li>
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-share"></i> Share
																					</a>
																				</li>
																				<li role="presentation">
																					<a role="menuitem" tabindex="-1" href="#">
																						<i class="fa fa-times"></i> Remove
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div></td>
																</tr>
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
								</div>
								
	<?php } ?>
	<!-- start: PAGE CONTENT -->
<?php 
$school_code = $this->session->userdata("school_code");
$is_login = $this->session->userdata('is_login');
$is_lock = $this->session->userdata('is_lock');
$logtype = $this->session->userdata('login_type');


if($logtype==2){?>
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
					Something going wrong contect to <strong>NIKTECH SOFTWARE SOLUTION</strong> for this.... :(
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
					Something going wrong contect to <strong>NIKTECH SOFTWARE SOLUTION</strong> for this.... :(
			</div>
		</div>
	</div>
</div>
<?php }?>
<!-- ------------------------------------------ All alert codeing end -------------------------------------------- -->
<div class="row">
   <!-- <div class="col-md-6 col-lg-4 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-green padding-20 text-center core-icon">
                    <i class="fa fa-book fa-2x icon-big"></i>
                </div>
                <a href="<?php echo base_url(); ?>index.php/singleTeacherControllers/salarySummry">
	                <div class="padding-20 core-content">
	                	<h3 class="title block no-margin">Given Homework</h3>
	                	<br/>
	                	<span class="subtitle"><a href="<?php echo base_url();?>index.php/studentHWControllers/showHomeWork">View Details</a></span>
	                </div>
                </a>
            </div>
        </div>
    </div>-->
    <div class="col-md-6 col-lg-4 col-sm-6">
								<div class="panel panel-default panel-white core-box">
									<div class="panel-tools">
										<a href="#" class="btn btn-xs btn-link panel-close">
											<i class="fa fa-book"></i>
										</a>
									</div>
									<div class="panel-body no-padding">
										<div class="partition-green padding-20 text-center core-icon">
											<i class="fa fa-book fa-2x icon-big"></i>
										</div>
										<div class="padding-20 core-content">
											<h3 class="title block no-margin">Given Homework</h3>
											</br>
										<span class="subtitle"><a href="<?php echo base_url();?>index.php/studentHWControllers/showHomeWork">View Details</a></span>
	               
										</div>
									</div>
									<div class="panel-footer clearfix no-padding">
										<div class=""></div>
										<a href="#" class="col-xs-4 padding-10 text-center text-white tooltips partition-green" data-toggle="tooltip" data-placement="top" title="More Options"><i class="fa fa-cog"></i></a>
										<a href="#" class="col-xs-4 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="Add Content"><i class="fa fa-plus"></i></a>
										<a href="#" class="col-xs-4 padding-10 text-center text-white tooltips partition-red" data-toggle="tooltip" data-placement="top" title="View More"><i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
							</div>
     <?php /* $uname=  $this->session->userdata('username');

    $this->db->where('username',$uname);
    $data=$this->db->get('employee_info')->row();
    
        $this->db->where('class_teacher_id',$data->id);
          $tchid=  $this->db->get('class_info');
          if($tchid->num_rows()>0)
          {
            $date=date('y-m-d');
            $this->db->where('class_id',$tchid->row()->id);
            $this->db->where('a_date',$date);
         $atn=   $this->db->get('attendance');?>
          <div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-orange padding-20 text-center core-icon">
                    <i class="fa fa-tasks fa-2x icon-big"></i>
                </div>
                 <div class="padding-20 core-content">
                    <h4 class="title block no-margin">Today Attendance</h4>
                    <br/>
                   <blink> <h4><?php if($atn->num_rows()>0){ echo "Done";} else{ echo "Not Done";}?></h4></blink>
                </div>
             
            </div>
        </div>
    </div>
<?php } */?>
   <!-- <div class="col-md-4 col-lg-4 col-sm-6" style="height:auto;">
    <div class="panel panel-blue core-box">
    <div class="e-slider owl-carousel owl-theme">
         <?php 
             $school_code =$this->session->userdata("school_code");
            $unm=$this->session->userdata('username');
            $this->db->where('username',$unm);
            $emp=$this->db->get('employee_info')->row();

            $this->db->where('school_code',$school_code);
            $this->db->where('class_teacher_id',$emp->id);
             $classid1=$this->db->get('class_info');
              if($classid1->num_rows()>0){
                $classid= $classid1->row();  
             $this->db->where('class_id',$classid->id);
             $stud=$this->db->get('student_info')->result();
           foreach ($stud as $value1)
           {?>   
        <?php $dt=date('Y-m-d');?>
        <?php $leve = $this->db->query("SELECT * FROM stu_leave WHERE school_code='$school_code' AND stu_id='$value1->id' and end_date>='$dt'  ORDER BY id");?>
        <?php $is_row=$leve->num_rows();?>
        <?php if($is_row > 0):?>
        <div class="item e-slider owl-carousel owl-theme">
        <?php foreach($leve->result() as $row):?>
        	<?php $id = $row->stu_id;?>
			<?php
			//$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("id",$id); ?>
			<?php $info = $this->db->get("student_info")->row(); ?>
			<div class="item e-slider owl-carousel owl-theme">
                <div class="panel-body">
                    <div class="core-box">
                        <div class="text-light text-bold">
                            Student Leave Request
                        </div>
                        <br/>
</div>
                     <table style="width: 100%;">
                        	<tr class="text-uppercase">
                        		<td rowspan="4" width="30%">
                        		    <?php if(strlen($info->photo > 0)):?>
										<img alt="<?php echo $info->name;?>" width="80%" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $info->photo;?>" />
									<?php else:?>
										<?php if($info->gender == 'Male'):?>
											<img alt="<?php echo $info->name;?>" width="80%" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/empMale.png" />	
										<?php endif;?>
										<?php if($info->gender == 'Female'):?>
											<img alt="<?php echo $info->name;?>" width="80%" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/empFemale.png" />	
										<?php endif;?>
									<?php endif;?>
                        		</td>
                        		<td>Name :
                        			<?php echo $info->name;?>
                        		</td>
                        	</tr>
                        	<tr>
                        		<td>Start Date : <?php echo date("d-M-Y", strtotime($row->start_date)); ?></td>
                        	</tr>
                        	<tr>
                        		<td>Days : <?php echo $row->total_leave; ?></td>
                        	</tr>
                        	<tr>
                        		<td>End Date : <?php echo date("d-M-Y", strtotime($row->end_date)); ?></td>
                        	</tr>
                        	<tr class="text-uppercase">
                        		<td colspan="2"><br/>Reason : <?php echo implode(' ', array_slice(explode(' ', $row->reason), 0, 7)); ?>...</td>
                        	</tr>
                        </table>
                         </div>
                     <div class="padding-10">
                	<?php if($row->approve=='NO'){?>
                	<a href="<?php echo base_url();?>index.php/singleTeacherControllers/appove/<?php echo $row->id;?>" class="btn btn-sm btn-light-green"><i class="fa fa-check"></i> Approve</a>
                    <a href="<?php echo base_url();?>index.php/singleTeacherControllers/deleette/<?php echo $row->id;?>" class="btn btn-sm btn-light-red"><strong>x</strong> Reject</a>
                <?php } else{?>
                    <a href="#" class="btn btn-sm btn-light-yellow">
                        Approved<i  class="fa fa-check"></i>
                    </a>
                <?php }?>
                 </div>
                 </div>
                <?php endforeach; ?>
                </div>
        </div>
      <?php endif;?>
        <?php } }else{?>
         <div class="item">
                <div class="panel-body">
                    <div class="core-box">
                        <div class="text-light text-bold">
                         Sorry!You Not Assign As Class Teacher Of Any Class
                        </div>
                        <br/>
                    	<h2>You Can Not See The Leave Of Students .....</h2>
                    </div>
                </div>
            </div>
             <?php }?>
         </div>
    </div>-->
   <!--  <div class="col-md-10 col-lg-5 col-sm-5">
        <div class="panel panel-default panel-white ">
            <div class="panel-body">
                <div class="partition-green padding-20 text-center ">
                 <b>Given Homework</b>
                </div>
               </a>
               <table class="table table-bordered table-striped">
                <thead><tr><th>Class</th>
                    <th>Subject</th>
                    <th>Work Subject Name</th>
                   
                     <th>Remark</th>
                      <th>Define Work</th>
                     <th>Grade</th>
                  
                </tr></thead>
                    <div class="padding-0px core-content">
                         <?php $user=$this->session->userdata('username');
                        $this->db->where('username',$user);
                     $emp=   $this->db->get('employee_info')->row();
                     $id= $emp->id;
                     $date=date('y-m-d');
                     $this->db->where('DATE(DueWorkDate)>=',$date);
                     $this->db->where('givenby',$user);
                    $homework= $this->db->get('homework_name')->result();
                    foreach($homework as $home)
                    {?>
                           <?php $this->db->where('id',$home->class_id);
                           $classname=$this->db->get('class_info')->row();
                            $this->db->where('id',$home->subject_id);
                           $subjectname=$this->db->get('subject')->row();
                           ?>
                              <tr><td>   <?php echo $classname->class_name;?></td>
                   <td>  <?php   echo $subjectname->subject;?></td>
                    <td>  <?php  echo $home->work_name;?></td>
                     <td>  <?php  echo $home->remark;?></td>
                     <td>  <?php  echo $home->workDiscription;?></td>
                    
                      <td>  <?php  echo $home->grade;?></td></tr>

                   <?php }?>
                     <h2 class="title block no-margin"></h2>
                       <br/>
                       <span class="subtitle"><strong><h3> </h3> </strong>  </span>
               </div>
           </table>
           </div>
      </div>
  </div> -->
  
 <!--<div class="col-md-6 col-lg-3 col-sm-6">-->
 <!--       <div class="panel panel-default panel-white ">-->
 <!--           <div class="panel-body no-padding">-->
 <!--             <a href="<?php echo base_url(); ?>index.php/smsAjax/smsPanel">-->
 <!--               <div class="partition-green padding-20 text-center ">-->
 <!--                   Click for SMS Panel-->
 <!--               </div>-->
 <!--              </a>-->
	<!--                <div class="padding-20 core-content">-->
	<!--                	<h2 class="title block no-margin"></h2>-->
	<!--                	<br/>-->
	<!--                	<span class="subtitle"><strong><h3> </h3> </strong>  </span>-->
	<!--                </div>-->
               
 <!--           </div>-->
 <!--       </div>-->
 <!--   </div>-->
  <div class="col-md-6 col-lg-4 col-sm-6">
								<div class="panel panel-default panel-white core-box">
									<div class="panel-tools">
										<a href="#" class="btn btn-xs btn-link panel-close">
											<i class="fa fa-calendar"></i>
										</a>
									</div>
									<div class="panel-body no-padding">
										<div class="partition-green padding-20 text-center core-icon">
											<i class="fa fa-calendar fa-2x icon-big"></i>
										</div>
										<div class="padding-20 core-content">
											<h3 class="title block no-margin">Attendance Report</h3>
											</br>
										<span class="subtitle"><a href="<?php echo base_url();?>index.php/studentHWControllers/showHomeWork">All class attendance report</a></span>
	               
										</div>
									</div>
									<div class="panel-footer clearfix no-padding">
										<div class=""></div>
										<a href="#" class="col-xs-4 padding-10 text-center text-white tooltips partition-green" data-toggle="tooltip" data-placement="top" title="More Options"><i class="fa fa-cog"></i></a>
										<a href="#" class="col-xs-4 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="Add Content"><i class="fa fa-plus"></i></a>
										<a href="#" class="col-xs-4 padding-10 text-center text-white tooltips partition-red" data-toggle="tooltip" data-placement="top" title="View More"><i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
							</div>
							<div class="col-md-12 col-lg-4 col-sm-12">
								<div id="notes">
									<div class="panel panel-note">
										<div class="e-slider owl-carousel owl-theme">
											<div class="item">
												<div class="panel-heading">
													<h4 class="no-margin">This is a Note</h4>
												</div>
												<div class="panel-body space10">
													<div class="note-short-content">
														Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...
													</div>
													
												</div>
												<div class="panel-footer">
													<div class="avatar-note"><img src="assets/images/avatar-2-small.jpg" alt="">
													</div>
													<span class="author-note">Nicole</span>
													<time class="timestamp" title="2014-02-18T00:00:00-05:00">
														2014-02-18T00:00:00-05:00
													</time>
												</div>
											</div>
								
										
										</div>
									</div>
								</div>
							</div>
						</div>
  <!--<div class="col-md-8 col-lg-4 col-sm-8">
         	<div class="panel panel-white">
         	<div class="padding-10">
											
											<h4 class="no-margin inline-block padding-5 bg-info" style="color:blue">All Classes Attendance Report <span class="block text-small text-left">Total Absent</span></h4>
											
										</div>
        	<div id="users_tab_example1" class="tab-pane padding-bottom-5 active">
													<div class="panel-scroll height-230">
														<table class="table table-striped table-hover">
															<thead>
																<tr>
																	
																	<th><span class="">Class Name</span><a href="#" class="btn"></i></a></th>
																	<th >Total
																	</th>
																	<th class="Present">Present
																	</th>
																	<th class="Absent">Absent
																	</th>
																	<th class="Leave">Leave
																	</th>
																	
																	
																</tr>
																
															
															</thead>
																<tbody>
															
															<?php $dat=date("Y-m-d") ;
															
															$this->db->distinct();
															//$this->db->select('id');
															$this->db->where("school_code",$this->session->userdata("school_code"));
															
															$dfg = $this->db->get('class_info');
															if($dfg->num_rows()>0){
															$vyt=	$dfg->result();
															  
															foreach($vyt as $t):
															
															$this->db->where("school_code",$this->session->userdata("school_code"));
															$this->db->where("DATE(a_date)",$dat);
															$this->db->where("class_id",$t->id);
															$grt = $this->db->get("attendance");
															if($grt->num_rows()>0){
																$ft = $grt->result();
																$p=0;$l=0;$a=0;
																	foreach($ft as $f):
																
																	if($f->attendance==0){
																	
																	$a=$a+1;
																	}
																	else{
																		$p=$p+1;	
																	}
																	
																	endforeach;
															?>
															<tr>
																	
																	<td><span >&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $t->class_name;?></span><a href="#" class="btn"></a></td>
																	<td class="center"><?php echo $grt->num_rows();?>
																	</td>
																	<td class="center"><?php echo $p;?>
																	</td>
																	<td class="center"><?php echo $a;?>
																	</td>
																	<td class="center"><?php echo $l;?>
																	</td>
															</tr>
															
															<?php }else{
																
															}
															endforeach;
														}
															?>
																
																
																
																
															</tbody>
														</table>
													</div>
												</div>
												</div>
        </div>-->
 
        </div>
    <?php } ?>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-layout="in-article"
     data-ad-format="fluid"
     data-ad-client="ca-pub-5093838037340612"
     data-ad-slot="2901957365"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>