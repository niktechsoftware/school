<?php
class CertificateController extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->is_login();
		$this->load->model("searchStudentModel");
		$this->load->model("adminModel");
	}
	function is_login(){
		$is_login = $this->session->userdata('is_login');
		$is_lock = $this->session->userdata('is_lock');
		$logtype = $this->session->userdata('login_type');
		if($is_login != "admin"){
			//echo $is_login;
			redirect("index.php/homeController/index");
		}
		elseif(!$is_login){
			//echo $is_login;
			redirect("index.php/homeController/index");
		}
		elseif(!$is_lock){
			redirect("index.php/homeController/lockPage");
		}
	}
	function addtc(){
	    $stuid = $this->input->post('stuid');
	    $renew_upto = $this->input->post('renew_upto');
	    $school_status = $this->input->post('school_status');
	     $registration_no = $this->input->post('registration_no');
	    $status = $this->input->post('status');
	     $subjectid = $this->input->post('subjectid');
	     $concession = $this->input->post('concession');
	    $ncc_cadet = $this->input->post('ncc_cadet');
	     $addmission_date = $this->input->post('addmission_date');
	    $meeting_date = $this->input->post('meeting_date');
	     $attended_day = $this->input->post('attended_day');
	     $other_remark = $this->input->post('other_remark');
	     $data= array(
	         "renewed_upto" =>$renew_upto,
	         "school_status" =>$school_status,
	         "registration_no" =>$registration_no,
	         "student_status" =>$status,
	         "subject_offered" =>$subjectid,
	         "any_fee_concession" =>$concession,
	         "ncc_cadet" =>$ncc_cadet,
	         "joining_date" =>$addmission_date,
	         "meeting_date" =>$meeting_date,
	         "pupil_attended_day" =>$attended_day,
	         "other_remarks" =>$other_remark,
	         
	         );
	         $this->db->where('student_id',$stuid);
	         $this->db->where('school_code',$this->session->userdata('school_code'));
	         $this->db->update('tc_certificate',$data);
	    echo "Saved";
	}
	public function checkTc(){
		$stud_id = $this->input->post("stud_id");
		
		$var= $this->searchStudentModel->getValue1($stud_id);
		$dub=$this->searchStudentModel->getStuInCertificate($stud_id);
		
		
			if($dub->num_rows() > 0){
				$row=$var->row();

				$val=$dub->row();
					?>
												<div class="alert alert-success">
													<button data-dismiss="alert" class="close">
														&times;
													</button>
													ID Found ! <strong><?php echo $row->name; ?><br>
													TC is already Generated and given date <?php echo $val->tc_date;?>do you want to print again it.Please click Proceed for Reprint otherwise leave it
												</strong></div>
												<button id = "pro" class="btn btn-dark-purple">
												Print Again <i class="fa fa-arrow-circle-right"></i>
												</button>
												<?php 
												
											
									//	else{
											?>
												<!--<div class="alert alert-danger">-->
												<!--	<button data-dismiss="alert" class="close">-->
												<!--		&times;-->
												<!--	</button>-->
												<!--	Sorry :( <strong><?php //echo "Student Not Found ! Wrong Student Id"; ?></strong>-->
												<!--</div>-->
											<?php
									//	}
			
	
	}	else{
			
			if($var->num_rows() > 0){
				
					?>
									<div class="alert alert-success">
										<button data-dismiss="alert" class="close">
											&times;
										</button>
										ID Found ! <strong><?php echo $var->row()->name; ?></strong>
									</div>
									<button id = "pro" class="btn btn-dark-purple">
									Get Certificate <i class="fa fa-arrow-circle-right"></i>
									</button>
									<?php 
									
								}
							else{
								?>
									<div class="alert alert-danger">
										<button data-dismiss="alert" class="close">
											&times;
										</button>
										Sorry :( <strong><?php echo "Student Not Found ! Wrong Student Id"; ?></strong>
									</div>
								<?php
								
							}
		}
	}




public function checkcc(){
		$stud_id = $this->input->post("stud_id");
		
		$var= $this->searchStudentModel->getValue1($stud_id);
		$dub=$this->searchStudentModel->getStuInCertificate($stud_id);
		
					if($dub->num_rows() > 0){
				$row=$var->row();

				$val=$dub->row();
					?>
												<div class="alert alert-success">
													<button data-dismiss="alert" class="close">
														&times;
													</button>
													ID Found ! <strong><?php echo $row->name; ?>
													CC is already Generated and given date <?php echo $val->cc_date1;?> do you want to print again it.Please click Proceed for Reprint otherwise leave it.
												</strong></div>
												<button id = "pro" class="btn btn-dark-purple">
												Print Again <i class="fa fa-arrow-circle-right"></i>
												</button>
												<?php 
												
											//}
										//else{
											?>
												<!--<div class="alert alert-danger">-->
												<!--	<button data-dismiss="alert" class="close">-->
												<!--		&times;-->
												<!--	</button>-->
												<!--	Sorry :( <strong><?php //echo "Student Not Found ! Wrong Student Id"; ?></strong>-->
												<!--</div>-->
											<?php
										//}
			
		}
		else{
			
			if($var->num_rows() > 0){
				
					?>
									<div class="alert alert-success">
										<button data-dismiss="alert" class="close">
											&times;
										</button>
										ID Found ! <strong><?php echo $var->row()->name; ?></strong>
									</div>
									<button id = "pro" class="btn btn-dark-purple">
									Get Certificate <i class="fa fa-arrow-circle-right"></i>
									</button>
									<?php 
									
								}
							else{
								?>
									<div class="alert alert-danger">
										<button data-dismiss="alert" class="close">
											&times;
										</button>
										Sorry :( <strong><?php echo "Student Not Found ! Wrong Student Id"; ?></strong>
									</div>
								<?php
								
							}
		}
	}


}