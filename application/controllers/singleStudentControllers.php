<?php
class singleStudentControllers extends CI_Controller{
	function __construct()
		{
			parent::__construct();
			$this->is_login();
			$this->load->model("subjectModel");
			$this->load->model("singleStudentModel");
			$this->load->model("feeModel");
		}
		
		function is_login(){
			$is_login = $this->session->userdata('is_login');
			$is_lock = $this->session->userdata('is_lock');
			$logtype = $this->session->userdata('login_type');
			if(!$is_login){
				//echo $is_login;
				redirect("index.php/homeController/index");
			}
			elseif(!$is_lock){
				redirect("index.php/homeController/lockPage");
			}
		}
	/*	function payFee(){
			$student_id=$this->uri->segment("3");
			$school_code = $this->session->userdata("school_code");
			$this->db->where("id",$student_id);
			$sinfo = $this->db->get("student_info")->row();
			$fsdobject=$this->feeModel->getFsdByStudentId($sinfo->username);
			$totAmount= $this->feeModel->totFee_due_by_id($student_id,9);
			$amt_paid=$this->input->post('paid');
			
			/* $fsd_id = $fsdobject->row()->id;
			$monthDeposit =  $this->db->query("select deposite_months.deposite_month from deposite_months join fee_deposit on fee_deposit.invoice_no = deposite_months.invoice_no where fee_deposit.status=1 and fee_deposit.finance_start_date='$fsd_id' and deposite_months.student_id='$student_id' order by deposite_months.id ASC");
				
				$this->db->select("*");
				$this->db->where("school_code",$this->session->userdata("school_code"));
				$apm1  =  $this->db->get("late_fees");
				if($monthDeposit->num_rows()>0){
				if($apm1->num_rows()>0){
					$apm=$apm1->row()->apply_method;
					$h=0; $pm=12/$apm;
				for($j=1;$j<$pm+1;$j++){
					if($j > $monthDeposit->num_rows()){
															                                        
						echo $ft;
					  $h=$h+$apm; $i++;}}}}//endforeach;
						else{
							if($apm1->num_rows()>0){
									$apm =$apm1->row()->apply_method;
										$h=0; $pm=12/$apm;
										for($j=1;$j<$pm+1;$j++){
				
										$rdt = date('Y-m-d', strtotime("$h months", strtotime($fsddate)));
												$ft=$h+4;
												if($ft>12){
												$ft=$ft-12;}
												$h=$h+$apm;
												echo $ft;
										}
							}
				 }
					
		}*/
		
		function stuattendence(){
		$studid = $this->uri->segment(3);
		$fsd = $this->uri->segment(4);
		$data['fsdorg']=$fsd;
		$this->load->model("feeModel");
		$da=$this->feeModel->fulldetail($studid,$fsd);
		$data['request']=$da->result();
		$data['pageTitle'] = 'Attendance Report';
		$data['smallTitle'] = 'Attendance Report';
		$data['mainPage'] = 'Attendance';
		$data['subPage'] = 'Attendance Report';
		$data['title'] = 'Attendance Report';
		$data['headerCss'] = 'headerCss/feeCss';
		$data['footerJs'] = 'footerJs/feeJs';
		$data['mainContent'] = 'attendence';
		$this->load->view("includes/mainContent", $data);
		}	
		
		function getChatId(){
		   $username= $this->input->post("id");
		   $this->db->where("chat_username",$username);
		   $chatrow = $this->db->get("chat");
		    if($chatrow->num_rows()>0){
		   if($chatrow->row()->chat_id){
		    echo $chatrow->row()->chat_id;
		   }else{
		      echo "0";
		   }
		}else{
		     echo "0";
		}
		}
		function index(){
		$school_code=$this->session->userdata("school_code");
		$this->db->where("school_code",$school_code);
		$this->db->where("DATE(opening_date)",date("Y-m-d"));
		$checkopeningclo  = $this->db->get("opening_closing_balance");
		if($checkopeningclo->num_rows()>0){
			$cr_date = date('Y-m-d H:i:s');
				$balance = array(
						"closing_date" => $cr_date,
				);
				$this->db->where("school_code",$school_code);
				$this->db->where("opening_date",date("Y-m-d"));
				$this->db->update('opening_closing_balance',$balance);
			
		}else{
			$clo = $this->db->query("select * from opening_closing_balance where school_code = '$school_code'  ORDER BY id DESC LIMIT 1")->row();
	
			$cl_date = $clo->closing_date;
			$cl_balance = $clo->closing_balance;
			$cr_date = date('Y-m-d');
			if($cl_date != $cr_date)
			{
				$balance = array(
						"opening_balance" => $cl_balance,
						"closing_balance" => $cl_balance,
						"opening_date" => $cr_date,
						"closing_date" => $cr_date,
						"school_code"=>$school_code
				);
				$this->db->insert('opening_closing_balance',$balance);
				//echo $cl_date;
			}
		}	
		$data['stuid_id']=$this->session->userdata("id");
		$data['school_code']=$school_code;
			$data['pageTitle'] = 'Dashboard';
			$data['smallTitle'] = 'Overview of all Section';
			$data['mainPage'] = 'Dashboard';
			$data['subPage'] = 'dashboard';
			$data['title'] = 'Student Dashboard';
			$data['headerCss'] = 'headerCss/dashboardCss';
			$data['footerJs'] = 'footerJs/dashboardJs';
			$data['mainContent'] = 'dashboardStudent';
			$this->load->view("includes/mainContent", $data);
		
		}
		function feesDetail(){
		
		$data['pageTitle'] = 'Fee Report';
		$data['smallTitle'] = 'Student Fee Report';
		$data['mainPage'] = ' Fee Report';
		$data['subPage'] = 'Fee Report';
		$data['title'] = 'Student Fee Report';
		$data['headerCss'] = 'headerCss/feeCss';
		$data['footerJs'] = 'footerJs/feeJs';
		$data['mainContent'] = 'stufeesdetail';
		$this->load->view("includes/mainContent", $data);
		}
		
		function studentProfile(){
			$this->load->model("allFormModel");
			$this->load->model("studentModel");
			$studentId = $this->session->userdata('username');
			$this->db->where("username",$studentId);
			$dt= $this->db->get("student_info")->row();
			$sid=$dt->id;
			$data['stu_id']=$studentId;
			$stDetail = $this->studentModel->getStudentDetail($sid);
			$data['gurdianDetail'] = $this->studentModel->getGurdianDetail($sid);
			$data['className'] = $this->allFormModel->getClass();
			$data['sectionName'] = $this->allFormModel->getSection();
			$personalInfo = $stDetail->row();
			$classid = $personalInfo->class_id;
			//$section = $personalInfo->section;
			$data['subjectList'] = $this->subjectModel->getSubjectByClassSection($classid);
			$data['studentsSubject'] = $this->subjectModel->isStudentSubject($studentId);
			$data['studentProfile'] = $stDetail;
			$data['pageTitle'] = 'Student Profile';
			$data['smallTitle'] = 'Student Personal Detail';
			$data['mainPage'] = 'Student Profile';
			$data['subPage'] = 'Student Personal Detail';
			$data['title'] = 'Student Personal Detail';
			$data['headerCss'] = 'headerCss/studentCss';
			$data['footerJs'] = 'footerJs/studentJs';
			$data['mainContent'] = 'studentProfile';
			$this->load->view("includes/mainContent", $data);
		}
		
		function feeReport(){
			$user = $this->session->userdata('username');
			$data['stu_id']=$user;
			$data['stuname']=$this->singleStudentModel->getStudentName($user)->row();
			
			$stuFatherName = $this->singleStudentModel->getStudentFatherName($user);
			$data['stuFatherName']=$stuFatherName->result();
			$stuFee = $this->singleStudentModel->getStudentFeeDetail($user);
			$data['stuFee']=$stuFee->result();
			
			$data['pageTitle'] = 'Fee Report';
			$data['smallTitle'] = 'Student Personal fee Detail';
			$data['mainPage'] = 'Fee';
			$data['subPage'] = 'Student Personal fee Detail';
			
			$data['title'] = 'Student Personal fee Detail';
			$data['headerCss'] = 'headerCss/studentCss';
			$data['footerJs'] = 'footerJs/studentJs';
			$data['mainContent'] = 'studentFeeReport';
			$this->load->view("includes/mainContent", $data);
		}
		
		
		function fullDetail()
		{
			$v = $this->uri->segment(3);
			$this->load->model("feeModel");
			$da=$this->feeModel->fulldetail($v);
			$data['request']=$da->result();
			$data['pageTitle'] = 'Fee Report';
			$data['smallTitle'] = 'Fee Report';
			$data['mainPage'] = 'Fee';
			$data['subPage'] = 'Fee Report';
			$data['title'] = 'Fee Report';
			$data['headerCss'] = 'headerCss/feeCss';
			$data['footerJs'] = 'footerJs/feeJs';
			$data['mainContent'] = 'personal';
			$this->load->view("includes/mainContent", $data);
		}
		
		function attendanceReport(){
			$user = $this->session->userdata('username');
			$data['stu_id']=$user;
			$data['pageTitle'] = 'Attendance Panel';
			$data['smallTitle'] = 'Student Attendance Report';
			$data['mainPage'] = 'Student';
			$data['subPage'] = 'Student  Attendance Report';
			
			$data['title'] = 'Student Personal Attendance Report';
			$data['headerCss'] = 'headerCss/studentCss';
			$data['footerJs'] = 'footerJs/studentJs';
			$data['mainContent'] = 'studentAttenReport';
			$this->load->view("includes/mainContent", $data);
		}
		function stuReport(){
			$stu_id = $this->session->userdata('username');
			$edate = $this->input->post("edate");
			$sdate = $this->input->post("sdate");
			$this->load->model("teacherModel");
			$var = $this->singleStudentModel->getStuReport($edate,$sdate,$stu_id);
			if($var->num_rows() > 0){
				$sr = 1;
				?>		<table class="table table-striped table-hover" id="sample_2">
									<thead>
										<tr>
											<th>S.no.</th>
											<th>Date</th>
											<th>Present/Absent/Leave</th>
										</tr>
									</thead>
									<tbody>
										<?php 
					  			 foreach ($var->result() as $row){	
					  				?><tr>
					  					<td><?php echo $sr;?></td>
					  					<td><?php $stuID = $row->a_date;  echo $stuID;?></td>
					  					
					  					<td>
					  					<?php 
					  					$atten=$row->attendance;
					  							if($atten=='P'){
					  							?><td><?php echo "Present";}
					  							else { if ($atten=='A'){ 
					  								echo "Absent";
					  							}else echo "Leave";}?></td>
						  			</tr>
						  			<?php 
					  		$sr++;	
					  			}?>
									</tbody>
								</table>
					  			<?php 
					  		}			  		
	}	
	
		function leave(){
		   
			$data['pageTitle'] = 'Student Leave';
			$data['smallTitle'] = 'Student  Leave Detail';
			$data['mainPage'] = 'Student';
			$data['subPage'] = 'Student  Leave Detail';
			$data['title'] = 'Student  Leave Detail';
			$data['headerCss'] = 'headerCss/studentCss';
			$data['footerJs'] = 'footerJs/studentJs';
			$data['mainContent'] = 'studentLeave';
			$this->load->view("includes/mainContent", $data);
		}
		function deleteleave()
	    {


         $id=$this->input->post('leaveid');
          $this->db->where('id',$id);
         $this->db->where('approve',"NO");
         $this->db->where('school_code',$this->session->userdata('school_code'));
          $up=$this->db->delete('stu_leave');
          echo "Deleted";
	  }
		
			function timeScheduling(){
			$data['pageTitle'] = 'Exam Panel';
			$data['smallTitle'] = 'Personal Exam Result';
			$data['mainPage'] = 'Student';
			$data['subPage'] = 'Personal Exam Result';
			$data['title'] = 'Personal Exam Result';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'studentTimeResult';
			$this->load->view("includes/mainContent", $data);
		}
		
		function timeScheduling1(){
			$stu_id = $this->input->post("stdexam");
			$var = $this->singleStudentModel->getclassAndStu($stu_id);
			$class = $var->class_id;
            $this->db->where("id",$class);
        	$dte=$this->db->get("class_info")->row();
        	$sec=$dte->section;
        	$class=$dte->class_name;
        	$this->db->where("id",$sec);
        	$dts=$this->db->get("class_section")->row();
        	$sec1=$dts->section;
			$data['sec1']=$sec1;
			$data['class']=$class;
			$data['period']=$this->input->post("ttmid");
			$var1 = $this->singleStudentModel->getTimeTable($class);
			$data['timetable']=$var1->result();
			$this->load->view("studentScheduling", $data);
		}
		
		function examResult(){
			$data['pageTitle'] = 'Exam Panel';
			$data['smallTitle'] = 'Personal Exam Result';
			$data['mainPage'] = 'Student';
			$data['subPage'] = 'Personal Exam Result';
			$data['title'] = 'Personal Exam Result';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'studentExamResult';
			$this->load->view("includes/mainContent", $data);
		}
		
		function stock(){
			$data['pageTitle'] = 'Stock Detail';
			$data['smallTitle'] = 'Stock purchasing detail';
			$data['mainPage'] = 'Student';
			$data['subPage'] = 'Stock purchasing detail';
			
			$data['title'] = 'Stock purchasing detail';
			$data['headerCss'] = 'headerCss/studentCss';
			$data['footerJs'] = 'footerJs/studentJs';
			$data['mainContent'] = 'studentStock';
			$this->load->view("includes/mainContent", $data);
		}
		
		function insertLeave(){
			$snm=$this->session->userdata('username');
			$this->db->where("username",$snm);
			$dt=$this->db->get("student_info");
		
			if($dt->num_rows()>0){
			    $dt=$dt->row();
			
			$sid=$dt->fsd;
			$this->db->where("id",$sid);
			$dtf=$this->db->get("fsd")->row();
			$school_code=$dtf->school_code;
			$this->db->where("id",$dt->class_id);
		$class_details=	$this->db->get("class_info")->row();
$totl = $this->input->post("totalLeave");
$sdate= $this->input->post("sdate");
$edate = $this->input->post("edate");
			$data =array(
		'stu_id'=>$dt->id,
		'start_date'=>$this->input->post("sdate"),
		'end_date'=>$this->input->post("edate"),
		'total_leave'=>$this->input->post("totalLeave"),
		'reason'=>$this->input->post("reason"),
		'approve'=>"NO",
		'school_code'=>$school_code
		);
			$var=$this->singleStudentModel->insertLeave($data);
			if($var)
			{
			    //sms setting code
    			    $this->load->model("smsmodel");
            		$sender = $this->smsmodel->getsmssender($school_code);
            		$sende_Detail =$sender;
            		$isSMS = $this->smsmodel->getsmsseting($school_code);
            		$sende_Detail1=$sende_Detail->row();
		        //sms setting code end
		     $max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		    $master_id=$max_id->maxid+1;

			    $this->db->where("id",$dt->class_id);
			  $dataci= $this->db->get("class_info")->row()->class_teacher_id;
			  if($dataci){
			      $this->db->where("id",$dataci);
			      $this->db->where("status",1);
			     $val = $this->db->get("employee_info");
			      if($val->num_rows()>0){
			          $val = $val->row();
			          $mobile = $val->mobile;
			          $msg="Dear ".$val->name." A student of Class".$class_details->class_name." want to ".$totl." Day Leave from ".$sdate." to ".$edate." .Please Approve It.";
			         
			          //echo $msg;
			           $getv=mysms($sende_Detail1->auth_key,$msg,$sende_Detail1->sender_id,$mobile);
		                $this->smsmodel->sentmasterRecord($msg,2,$master_id,$getv);
			      }
			  }else{
			      $this->db->where("id",$this->session->userdata("school_code"));
			        $adminmo =   $this->db->get("school")->row();
			        
			       $mobile = $adminmo->mobile_no ;
			       
			          $msg="Dear ".$adminmo->principle_name." A student of Class".$class_details->class_name." want to ".$totl." Day Leave from ".$sdate." to ".$edate." .Please Approve It.";
			           // echo $msg;
			           $getv=mysms($sende_Detail1->auth_key,$msg,$sende_Detail1->sender_id,$mobile);
		                $this->smsmodel->sentmasterRecord($msg,2,$master_id,$getv);
			  }
				$msg="success";
				redirect("index.php/singleStudentControllers/leave/$msg");
			}
		}else{
		   	redirect("index.php/homeController/index");
		}
		}
		
		function stuReport1(){
			$stu_id = $this->input->post("stu_id");
			$edate = $this->input->post("edate");
			$sdate = $this->input->post("sdate");
			$this->load->model("singleStudentModel");
			$var = $this->singleStudentModel->getStuReport($edate,$sdate,$stu_id);
			if($var->num_rows() > 0){
				$sr = 1;
				?>		<table class="table table-striped table-hover" id="sample_2">
											<thead>
												<tr>
													<th>S.no.</th>
													<th>Date</th>
													<th>Present/Absent/Leave</th>
												
												</tr>
											</thead>
											<tbody>
												<?php 
							  			 foreach ($var->result() as $row){	
							  				?><tr>
							  					<td><?php echo $sr;?></td>
							  					<td><?php $stuID = $row->a_date;  echo $stuID;?></td>
							  					
							  					<td>
							  					<?php 
							  					$atten=$row->attendance;
							  							if($atten==1){
							  							?><?php echo "Present";}
							  							else { if ($atten==0){ 
							  								echo "Absent";
							  							}else echo "Leave";}?></td>
								  			</tr>
								  			<?php 
							  		$sr++;	
							  			}?>
											</tbody>
										</table>
							  			<?php 
							  		}	  		
			}

}