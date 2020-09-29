<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-blue">
				<h4 class="panel-title">
					Student <span class="text-bold">Exam Detail Class Wise</span>
				</h4>
				<div class="panel-tools">
					<div class="dropdown">
						<a data-toggle="dropdown"
							class="btn btn-xs dropdown-toggle btn-transparent-grey"> <i
							class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu dropdown-light pull-right" role="menu">
							<li><a class="panel-collapse collapses" href="#"><i
									class="fa fa-angle-up"></i> <span>Collapse</span> </a></li>
							<li><a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i>
									<span>Refresh</span>
							</a></li>
							<li><a class="panel-config" href="#panel-config"
								data-toggle="modal"> <i class="fa fa-wrench"></i> <span>Configurations</span>
							</a></li>
							<li><a class="panel-expand" href="#"> <i class="fa fa-expand"></i>
									<span>Fullscreen</span>
							</a></li>
						</ul>
					</div>
					<a class="btn btn-xs btn-link panel-close" href="#"> <i
						class="fa fa-times"></i>
					</a>
				</div>
			</div>
			<div class="panel-body">
				<div class="form-group">

					<div class="col-sm-12">

						<br />
						<br />
						<div class="row">
							<div class="col-md-12 space20">
								<div class="btn-group pull-right">
									<button data-toggle="dropdown"
										class="btn btn-green dropdown-toggle">
										Export <i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu dropdown-light pull-right">
										<li><a href="#" class="export-excel"
											data-table="#sample-table-2" data-ignoreColumn="3,4"> Export
												to Excel </a></li>
									</ul>
								</div>
							</div>
							<?php  
						
							$this->db->where("id",$exam_mode_id);
                                    $exam_mode_details = $this->db->get("exam_mode")->row();
                                    	$this->db->where("id",$exam_mode_details->exam_id);
							$en = $this->db->get("exam_name")->row();
                                     $this->db->distinct();
                                        $this->db->select("exam_day_id");
                                        $this->db->select("shift_id");
                                        $this->db->select("class_id");
                                        $this->db->where("exam_id",$exam_mode_details->exam_id);
                                        $this->db->where("subject_id",$exam_mode_details->subject);
                                        
                                        $getshiftandday = $this->db->get("exam_time_table");
                                         if($getshiftandday->num_rows()>0){
                                            $getshiftandday1=$getshiftandday->row();
                                      
                                        
                                        $this->db->where("id",$getshiftandday1->class_id);
                                       $cin =  $this->db->get("class_info")->row();
                                      /*  print_r($getshiftandday);
                                        exit();*/
                                        $this->db->where("id",$getshiftandday1->exam_day_id);
                                        $exam_date =$this->db->get("exam_day");
                                         $this->db->where("id",$getshiftandday1->shift_id);
                                        $exam_shift =$this->db->get("exam_shift");
                                        
                                         $this->db->where('exam_master_id',$exam_mode_details->exam_id);
                                        $this->db->where('exam_subject_id',$exam_mode_details->subject);
                                        $tot_ques = $this->db->get("question_master");
                                        $this->db->where("id",$exam_mode_details->subject);
                                        $subjectname = $this->db->get("subject")->row();
    
    		
                                    ?>
                            <div class="alert alert-info"><h2>Details of <?php echo $en->exam_name;?> Exam class <?php echo $cin->class_name;?> [<?php echo $subjectname->subject;?>] </h2></div>
							<div class="table-responsive">
								<table class="table table-striped table-hover" id="example">
									<thead>
										<tr>
											<th>S.no.</th>
											<th>Student ID</th>
											<th>Student Name</th>
											<th>Exam Date</th>
											<th>Time</th>
											<?php if($exam_mode_details->exam_mode==3){?>
											<th>Attempt</th>
											<td>Right</td>
											<th>Wrong</th>
											<th>Left</th>
												<th>Summary</th>
											<?php }else{?>
											<td>Given Answers</td>
											<?php }?>
										

										</tr>
									</thead>
									<tbody>
<?php
$color = array (
		"progress-bar-danger",
		"progress-bar-success",
		"progress-bar-warning",
		"progress-partition-green",
		"partition-azure",
		"partition-blue",
		"partition-orange",
		"partition-purple",
		"progress-bar-danger",
		"progress-bar-success",
		"progress-partition-green",
		"partition-purple" 
);

$count = 1;
if($var->num_rows()>0){
foreach ( $var->result () as $lv ) :
    $this->db->where("id",$lv->student_id);
    $student_Details=$this->db->get('student_info')->row();
    $this->db->where("student_id",$student_Details->id);
    $gDetails =$this->db->get("guardian_info")->row();
   
  /* echo $exam_mode_details->exam_id;
   echo "<br>".$exam_mode_details->subject;
   echo "<br>".$student_Details->class_id;*/
   
    
    $this->db->where('exam_id',$exam_mode_details->exam_id);
    $this->db->where('subject_id',$exam_mode_details->subject);
        		    $this->db->where('student_id',$lv->student_id);
        		    $result1=$this->db->get('objective_exam_result');
        		     $i=1;  $right=0; $wrong = 0;
        		    if($result1->num_rows()>0){
        		 foreach($result1->result() as $row):
                            $this->db->where('question_master_id',$row->question_id);
                            $ans=$this->db->get('right_answer');
                           
                           if($row->given_answer==$ans->row()->right_answer){?>
                           <?php
                         $right+=1;
                           }else{
                         $wrong+=1;
                           }
                          $i++; endforeach;}
                            ?> 
	
<?php if($count%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
<tr class="<?php echo $rowcss;?>">
											<td><?php echo $count;?></td>
											<td><?php echo $student_Details->username;?></td>
											<td><?php echo $gDetails->father_full_name;?></td>
											<td><?php if($exam_date->num_rows()>0){echo $exam_date->row()->date1;}?></td>
											<td><?php if($exam_shift->num_rows()>0){echo $exam_shift->row()->from1." to ".$exam_shift->row()->to1;}?></td>
											<?php if($exam_mode_details->exam_mode==3){?>
											<td><?php if($result1->num_rows()>0){echo $result1->num_rows();}?></td>
											<td><?php echo $right;?></td>
											<td><?php echo $wrong;?></td>
												<td><?php echo $tot_ques->num_rows()-$result1->num_rows();?></td>
										

											<td>	<a href="<?php echo base_url();?>index.php/singleStudentControllers/objectiveque_result/<?php echo $exam_mode_details->exam_id;?>/<?php echo $lv->student_id;?>/<?php echo $exam_mode_details->subject;?>">
											    <button type="submit" id="leavedelete"
													class="btn btn-red">View Report</button></td>
												<?php 	}else{
													$this->db->where("exam_mode_id",$exam_mode_id);
        		                        $this->db->where("student_id",$lv->student_id);
        		                        $sar = $this->db->get("subjective_answer_report");
												?>
													<td>
													    <?php if($sar->num_rows()>0){if($sar->row()->upload_answers1){?><a href="<?php echo base_url();?>assets/images/question_img/<?php echo $sar->row()->upload_answers1 ;?>">
            							                        <img src="<?php echo base_url();?>assets/images/question_img/<?php echo $sar->row()->upload_answers1 ;?>" alt="" width="100" height="150"/>
            							                        
            							                        </a><?php }
            							                        if($sar->row()->upload_answers2){?><a href="<?php echo base_url();?>assets/images/question_img/<?php echo $sar->row()->upload_answers2 ;?>">
            							                        <img src="<?php echo base_url();?>assets/images/question_img/<?php echo $sar->row()->upload_answers2 ;?>" alt="" width="100" height="150"/>
            							                        
            							                        </a><?php }
            							                        if($sar->row()->upload_answers3){?><a href="<?php echo base_url();?>assets/images/question_img/<?php echo $sar->row()->upload_answers3 ;?>">
            							                        <img src="<?php echo base_url();?>assets/images/question_img/<?php echo $sar->row()->upload_answers3 ;?>" alt="" width="100" height="150"/>
            							                        
            							                        </a><?php }
            							                        if($sar->row()->upload_answers4){?><a href="<?php echo base_url();?>assets/images/question_img/<?php echo $sar->row()->upload_answers4 ;?>">
            							                        <img src="<?php echo base_url();?>assets/images/question_img/<?php echo $sar->row()->upload_answers4 ;?>" alt="" width="100" height="150"/>
            							                        
            							                        </a><?php }
            							                        if($sar->row()->upload_answers5){?><a href="<?php echo base_url();?>assets/images/question_img/<?php echo $sar->row()->upload_answers5 ;?>">
            							                        <img src="<?php echo base_url();?>assets/images/question_img/<?php echo $sar->row()->upload_answers5 ;?>" alt="" width="100" height="150"/>
            							                        
            							                        </a><?php }
            							                       ?></td>
												<?php }}?>
												
		

</tr>
<?php $count++; endforeach; } ?>

</tbody>

								</table>
								</br>
								
							</div>
						</div>
						<?php }else{
						    echo "Update Time Table First";
						}?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
