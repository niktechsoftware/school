<style>
blink{
    animation:blinker 0.6s linear infinite;
    color:#FF0000;
}
@keyframes blinker{
    50%{ opacity:0; }
}

</style>
<!-- start: PAGE CONTENT -->
<?php

$this->db->where("school_code",$school_code);
$this->db->where("category","All Student");
$this->db->order_by("id limit 1");
$noticeForStudent=$this->db->get("notice");

$is_login = $this->session->userdata ( 'is_login' );
$is_lock = $this->session->userdata ( 'is_lock' );
$logtype = $this->session->userdata ( 'login_type' );
?>

<div style="background-color: green; color: white;" class="form-control">
	<marquee behavior="alternate" onmouseover="this.stop();"
		onmouseout="this.start();">

<?php 
if($noticeForStudent->num_rows()>0){
echo $noticeForStudent->row()->message;
}?>
</marquee>
</div>
<br>
<?php if($this->uri->segment("3") == "noteTrue"){?>
<div class="row">
	<div class="col-md-6 col-lg-12 col-sm-6">
		<div class="panel panel-default panel-white core-box">
			<div class="alert alert-success">
				<button data-dismiss="alert" class="close">&times;</button>
				<strong>Done!</strong>Your new Note successfully added <a
					class="alert-link" href="#"> into database.</a>
			</div>
		</div>
	</div>
</div>
<?php } elseif($this->uri->segment("3") == "noteFalse"){?>
<div class="row">
	<div class="col-md-6 col-lg-12 col-sm-6">
		<div class="panel panel-default panel-white core-box">
			<div class="alert alert-danger">
				<button data-dismiss="alert" class="close">&times;</button>
				<strong>Oh my god! sorry....</strong> Something going wrong contect
				to <strong>Niktech Software Solutions</strong> for this.... :(
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
				<button data-dismiss="alert" class="close">&times;</button>
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
				<button data-dismiss="alert" class="close">&times;</button>
				<strong>Oh my god! sorry....</strong> Something going wrong contect
				to <strong>Niktech Software Solutions</strong> for this.... :(
			</div>
		</div>
	</div>
</div>
<?php }?>

<!-- ------------------------------------------ All alert codeing end -------------------------------------------- -->

<div class="row col-md-12" >
	<div class="col-md-6 col-lg-4 col-sm-6">
		<div class="panel panel-default panel-white core-box">
			<div class="panel-body no-padding">
				<div class="partition-green padding-20 text-center core-icon">
					<i class="fa fa-inr fa-2x icon-big"></i>
				</div>
				<a
					href="<?php echo base_url()?>index.php/feeControllers/stuattendence/<?php echo $stuid_id;?>">
					<div class="padding-20 core-content">
						<h3 class="title block no-margin">Attendance Report</h3>
						<br /> <span class="subtitle"> Find Out Detailed Attendance
							Reports </span>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-4 col-sm-6">
		<div class="panel panel-default panel-white core-box">
		<div class="panel-body no-padding">
	                <div class="partition-green text-center core-icon">
	                    <i class="fa fa-inr fa-2x icon-big"></i><br>
	                    <?php 
	                    $totAmount =$this->feeModel->totFee_due_by_id($stuid_id,0);

	                    $student_id =$this->session->userdata("id");
	                   
	                    ?>
	                 
	                  
	                  <?php 
	                  if($this->session->userdata("school_code")==6 && $this->session->userdata("school_code")==4 && $this->session->userdata("school_code")==9){ ?>
               <a href="  <?php echo base_url();?>index.php/singleStudentControllers/payFee/<?php echo $student_id;?>/<?php echo $totAmount;?>" class="btn btn-warning" >Click To Pay</a>
	               <?php	}else{ ?>
	                  <a href="#" class="btn btn-warning" >Click To Pay</a>
	                  <!-- <?php echo base_url();?>index.php/singleStudentControllers/payFee/<?php // echo $student_id;?>/<?php //echo $totAmount;?>-->
					<?php   } ?>
	                   <span class="subtitle">

							
	                    </span>
	                </div>
	                <a href="">
		                <div class="padding-20 core-content">
		                <!--	<h3 class="title block no-margin">Fee Reports</h3>-->
		                <h3 class="title block no-margin"><blink>Due Fee Status</blink></h3>
		                	<br/>
							<?php echo $this->feeModel->totFee_due_by_id($stuid_id,1);
							//echo $stuid_id;
							?>
		                	<span class="subtitle">  <h3><blink ></blink></h3>   </span>
	                        
		                </div>
	                </a>
	            </div>
   </div>
   </div>
   <?php
			
			$unm = $this->session->userdata ( "username" );
			$this->db->where ( 'username', $unm );
			$dt = $this->db->get ( 'student_info' )->row ();
			//$stud_id = $dt->id;
			?>
    <div class="col-md-6 col-lg-4 col-sm-6">
		<div class="panel panel-default panel-white core-box">
			<div class="panel-body no-padding">
				<div class="partition-azure padding-20 text-center core-icon">
					<i class="fa fa-book fa-2x icon-big"></i>
				</div>
				<a
					href="<?php echo base_url(); ?>index.php/singleStudentControllers/feesDetail/<?php echo $stuid_id;?>">
					<div class="padding-20 core-content">
						<h4 class="title block no-margin">Deposit Fee Details</h4>
						<br /> <span class="subtitle"> Click For Details</span>
					</div>
				</a>
			</div>
		</div>
	</div>
   </div>
   <div class="row col-md-12">
   
	<div class="col-md-6 col-lg-4 col-sm-6">
		<div class="panel panel-default panel-white core-box">
			<div class="panel-body no-padding">
				<div class="partition-azure padding-20 text-center core-icon">
					<i class="fa fa-book fa-2x icon-big"></i>
				</div>
				<a
					href="<?php echo base_url(); ?>index.php/studentHWControllers/studentShowHomeWork">
					<div class="padding-20 core-content">
						<h4 class="title block no-margin">Home Work</h4>
						<br /> <span class="subtitle">Home Work And Project Details. </span>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-4 col-sm-6">
		<div class="panel panel-default panel-white core-box">
			<div class="panel-body no-padding">
				<div class="partition-red padding-20 text-center core-icon">
					<i class="fa fa-tasks fa-2x icon-big"></i>
				</div>

				<a
					href="<?php echo base_url(); ?>index.php/singleStudentControllers/leave">
					<div class="padding-20 core-content">
						<h4 class="title block no-margin">Leave</h4>
						<br /> <span class="subtitle"> Application. </span>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-4 col-sm-6">
		<div class="panel panel-default panel-white core-box">
			<div class="panel-body no-padding">
				<div class="partition-red padding-20 text-center core-icon">
					<i class="fa fa-tasks fa-2x icon-big"></i>
				</div>
				<a href="<?php echo base_url(); ?>index.php/singleStudentControllers/examResult/<?php echo $stuid_id;?>">
					<div class="padding-20 core-content">
						<h4 class="title block no-margin">Marks</h4>
						<br /> <span class="subtitle"> Current Exam Marks </span>
					</div>
				</a>
			</div>
		</div>
	</div>

    	<div class="col-md-6 col-lg-4 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-purple padding-20 text-center core-icon">
                    <i class="fa fa-tasks fa-2x icon-big"></i>
                </div>
                <a href="#">
                <div class="padding-20 core-content">
                    <h4 class="title block no-margin">Join On Line Class</h4>
                    <br/>
                    <span class="subtitle"> 	
                    
                            <a href="<?php echo base_url();?>singleTeacherControllers/chat">
                        		<span class="glyphicon glyphicon-facetime-video"></span>
                        		<p> &nbsp;&nbsp;Video Class</p><span class="arrow"></span>
                        	</a></span>
                </div>
                </a>
            </div>
        </div>
    </div>
	<div class="col-md-4 col-lg-8 col-sm-8">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-purple padding-20 text-center core-icon">
                    <i class="fa fa-tasks fa-2x icon-big"></i>
                </div>
              <a href="#">
                <div class="padding-20 core-content">
                    <h4 class="title block no-margin"><blink>Exam SCHEDELE</blink></h4>
                  <br /> <span class="subtitle"> Current Exam Schedule </span>
				  </a>
 <?php
			
			$unm = $this->session->userdata ( "username" );
			$this->db->where ( 'username', $unm );
			$dt = $this->db->get ( 'student_info' )->row ();
			$stud_id = $dt->id;
			$class_id=$dt->class_id;
			 $exam =$this->examModel->exam_schedule($class_id);
			//print_r($exam);
			 $exam_id=$exam->exam_id;
			 $this->db->where("exam_id", $exam_id);
			$ex = $this->db->get ( 'exam_shift' )->row ();
			//print_r($ex);
			 $this->db->where("exam_id", $exam_id);
			$dat=$this->db->get ( 'exam_day' )->row ();
//print_r($dat);
	$student_id =$this->session->userdata("id");
			$class_id=$dt->class_id;
			 $this->db->where("id",$class_id);
			$class = $this->db->get ( 'class_info' )->row ();
			//print_r($class);
			?>				 
		<div class="table-responsive">
<?php 	
		$this->examModel->getExamTimeTableChartBy($exam_id,$class_id,$school_code);?>
		

										</div>
 </div>
 </div>
        </div>
    </div>
	<div class="col-md-6 col-lg-4 col-sm-6">
        <div class="panel panel-default panel-white core-box">
            <div class="panel-body no-padding">
                <div class="partition-purple padding-20 text-center core-icon">
                    <i class="fa fa-tasks fa-2x icon-big"></i>
                </div>
                <a href="#">
                <div class="padding-20 core-content">
                    <h4 class="title block no-margin">Exam Mode</h4>
                    <br/>
                    <span class="subtitle"> 	
                    
                        <?php 	
		$this->db->where("exam_id",$exam_id);
	$this->db->where("class_id",$class_id);
	$emode=$this->db->get("exam_mode");?>
		<p>	Subjective  <a href="/images/myw3schoolsimage.jpg" download>
  <img src="/images/myw3schoolsimage.jpg" alt="W3Schools" width="104" height="142">
</a></p>
			<p>
		<a href="<?php echo base_url();?>index.php/singleStudentControllers/objectivePaper/<?php echo $exam_id;?>/<?php echo $class_id;?>/">	Objecive</a></p>			
                                        					
                </div>
                </a>
            </div>
        </div>
    </div>


</div>



</div>
<!-- end: PAGE CONTENT-->