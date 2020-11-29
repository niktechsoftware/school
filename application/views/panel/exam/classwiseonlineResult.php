<form action="<?php echo base_url();?>index.php/exampanel/classWiseonlineResult" method="post" role="form">
<?php $school_code = $this->session->userdata("school_code");?>
<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-pink">
				<h4 class="panel-title">Class Wise <span class="text-bold">Exam Report</span></h4>
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
					<a class="btn btn-xs btn-link panel-close" href="#">
						<i class="fa fa-times"></i>
					</a>
				</div>
			</div>
      <div class="panel-body">
                  <!-- <div class="alert panel-green">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to Fees Report Area </h3>
          Please select FSD, class and section then show all fees report in new form. if you saw all fees detail 
          then click on view detail button. if you want to send a sms then click on send sms button.
              
        </div> -->
          
				<div class="form-group">
					<?php 
						$detail = $this->db->query("SELECT * FROM fsd where school_code='$school_code' Order BY id");
						//$detail1 = $this->db->query("SELECT finance_start_date FROM `old_fee_deposit` where school_code='$school_code' GROUP BY finance_start_date ");
						// if(($detail->num_rows() > 0)||($detail1->num_rows() > 0))
						if(($detail->num_rows() > 0)){
							
					?>
					<label class="col-sm-2 control-label">
						Finance Start Date <span class="symbol required"></span>
					</label>
					<div class="col-sm-2">
						<select class="form-control" id="fsd" name = "fsd" style="width: 150px;">
							<option value="">-select FSD-</option>
		                      			<?php 
		                      			
		                      			if(($detail->num_rows() > 0)){
		                      			foreach($detail->result() as $row):?>
		                      				
		                      			<option value="<?php echo $row->id;?>">
		                      			<?php echo date("d-M-y", strtotime($row->finance_start_date));?>
		                      		</option>
		                      		<?php endforeach;
		                      				
		                      			}
		                      			?>
						</select>
					</div>
					<?php } ?>

					<label class="col-sm-1 control-label">
						Section <span class="symbol required"></span>
					</label>
					<div class="col-sm-2">
						<select class="form-control" id="classv" name="section" style="width: 150px;">
							<option value="">-Select Section-</option>
							<?php foreach($request as $row):
								  $sectionid=$row->section;
								  $this->db->where('school_code',$school_code);
								   $this->db->where('id',$sectionid);
							 $row=$this->db->get('class_section')->row();         
								  ?>
							<option value="<?php echo $row->id;?>"><?php echo $row->section;?></option>
							<!-- <option value="all"></option> -->
							<?php endforeach; ?>
						</select>
					</div>

					<label class="col-sm-1 control-label">
						Class<span class="symbol required"></span>
					</label>
					<div class="col-sm-3"  >
						<select class="form-control" id="sectionId" name="class">
						</select>
					</div>

				</div>
				<div class="col-sm-12">				
                    <button type="submit" id="button" class="btn btn-red">
                        Get Report <i class="fa fa-report"></i>
                    </button>
				</div>
			</div><!-- end: panel Body -->
		</div><!-- end: panel panel-white -->
		
	</div><!-- end: MAIN PANEL COL-SM-12 -->
</div><!-- end: PAGE ROW-->
</form>
<?php if($result){?>
<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-pink">
				<h4 class="panel-title">Class Wise <span class="text-bold">Exam Report</span></h4>
				<div class="panel-tools">
				
					<a class="btn btn-xs btn-link panel-close" href="#">
						<i class="fa fa-times"></i>
					</a>
				</div>
			</div>
			<?php $this->db->where("id",$class_id);
		$cil = 	$this->db->get("class_info");?>
      <div class="panel-body">
          <div class="alert alert-info"> <h2>Details of Online Exam class <?php echo $cil->row()->class_name;?> </h2></div>
          	<div class="table-responsive" style="width:100%; overflow-y: scroll;">
				<table class="table table-striped table-hover" id="sample-table-daybook">
                <thead><tr>
                        <td>#</td>
                        <td>Exam Name</td>
                        <td>Exam Mode</td>
                        <td>Subject</td>
                        <td>Total Student</td>
                        <td>Present Student</td>
                        <td>Absent Student</td>
                      
                        </tr>
                </thead>
                <tbody>
                    <?php 
                        $this->db->where("class_id",$class_id);
                        $tots=  $this->db->get("student_info");
                        $i=1; foreach($result as $row):
                       
                        ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $row->exam_name;?></td>
                        <td><?php echo $row->exam_mode;?></td>
                        <td><?php 
                       
                            $this->db->where('id',$row->subject);
							$sub=$this->db->get('subject')->row();
							echo $sub->subject;?></td>
						<td><?php echo $tots->num_rows();?></td>
                        <td>
                       <?php if($row->exam_mode==3){
                            $this->db->distinct();
                            $this->db->select("student_id");
                            $this->db->where("exam_mode_id",$row->id);
                            $pstudent = $this->db->get("objective_exam_result");
                           ?>
                            <a href="<?php echo base_url();?>index.php/examControllers/onlineExamStatus/<?php echo $sub->subject;?>/<?php echo $row->exam_id;?>/<?php echo $row->exam_mode;?>/1/<?php echo $row->id;?>" style="width: 50px;" class="btn btn-success">
                      <?php  echo $pstudent->num_rows();?></a>
                      <?php }else{
                           $this->db->distinct();
                            $this->db->select("student_id");
                                $this->db->where("exam_mode_id",$row->id);
                            $pstudent = $this->db->get("subjective_answer_report"); 
                           ?>
                            <a href="<?php echo base_url();?>index.php/examControllers/onlineExamStatus/<?php echo $sub->subject;?>/<?php echo $row->id;?>/<?php echo $row->exam_mode;?>/1" style="width: 50px;" class="btn btn-success">
                                <?php  echo $pstudent->num_rows();?>
                                </a>
                      <?php  }
                        ?></td>
                        <td>
                          <?php if($row->exam_mode==3){?>
                        	<a href="<?php echo base_url();?>index.php/examControllers/onlineExamStatus/<?php echo $sub->subject;?>/<?php echo $row->exam_id;?>/<?php echo $row->exam_mode;?>/0/<?php echo $row->id;?>" style="width: 50px;" class="btn btn-warning">
                            <?php echo $tots->num_rows() - $pstudent->num_rows();;?>	</a>
                        	<?php } 
                        	else{ ?><a href="<?php echo base_url();?>index.php/examControllers/onlineExamStatus/<?php echo $sub->subject;?>/<?php echo $row->id;?>/<?php echo $row->exam_mode;?>/0" style="width: 50px;" class="btn btn-warning">
                            <?php echo $tots->num_rows() - $pstudent->num_rows();;?>
                            </a>
                        <?php }?>
                        </td>
                        
                    </tr>
                    <?php $i++; endforeach;?>
                </tbody>
                
            </table>
          </div>
          </div>
         </div>
        </div>
    </div>
<?php }?>
					