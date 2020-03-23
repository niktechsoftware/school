<?php
class InvoiceController extends CI_Controller{
    function __construct()
    {
        parent::__construct();
          $this->is_login();
        $this->load->model("exammodel");
        $school_code = $this->session->userdata("school_code");
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
    
    function obtn_marks(){
		$data['sectionid'] = $this->uri->segment(4);
		$data['subjectid'] = $this->uri->segment(5);
		$data['examid'] = $this->uri->segment(6);
		$data['classid']=$this->uri->segment(3);
		$this->load->view("invoice/obtn_marks",$data);
	}
    
    
    	function printempiCard(){
			
		$data['pageTitle'] = 'Employee Section';
		$data['smallTitle'] = 'Employee Profile';
		$data['mainPage'] = 'Employee';
		$data['subPage'] = 'Profile';
		$empId = $this->uri->segment(3);
		$this->load->model("employeemodel");
		$empDetail = $this->employeemodel->getStudentDetail($empId);
		$data['empProfile'] = $empDetail;
		$data['title'] = 'Employee Profile';
		$this->load->view("invoice/empicard", $data);
	}
	
		function onlinefeesubmit(){
		 $school_code = $this->session->userdata("school_code");
// 		 print_r($school_code);
// 		 exit();
		 $invoice_number = $this->uri->segment(3);
         $student_id = $this->uri->segment(4);
         $fsd = $this->uri->segment(5);
		 
		 $this->db->where("school_code",$school_code);
        $this->db->where("invoice_no",$invoice_number);
        $this->db->where("student_id",$student_id);
        $fsd =$this->db->get("fee_deposit")->row();
        
        //  $this->db->where("school_code",$school_code);
        // $this->db->where("invoice_no",$invoice_number);
         $this->db->where("id",$student_id);
        $student =$this->db->get("student_info")->row();
        $this->load->model("smsmodel");
	     $sende_Detail = $this->smsmodel->getsmssender($school_code);
		 $sende_Detail1=$sende_Detail->row();
				
		$this->db->where("school_code",$school_code);
			$this->db->where("student_id",$student_id);
			$this->db->where("invoice_no",$invoice_number);
			$current_balance =$this->db->get("feedue")->row()->mbalance;
			
		$this->db->where("school_code",$school_code);
			$this->db->where("student_id",$student_id);
			$var=$this->db->get("guardian_info")->row();
			$fmobile=$student->mobile;
			
		  //get fee details
	         	    $this->db->where("invoice_no",$invoice_number);
                    //$this->db->where("school_code",$this->session->userdata("school_code"));
					$rty = 	$this->db->get("deposite_months");
					$monthmk=array();
					$this->db->where('id',$fsd->finance_start_date);
					$fsd1=$this->db->get('fsd')->row();
					$demont = $rty->num_rows();
                    $i=0;$printMonth=""; foreach($rty->result() as $tyu):
                    $ffffu= $tyu->deposite_month-4;
					
						$printMonth= $printMonth."".date('M-Y', strtotime("$ffffu months", strtotime($fsd1->finance_start_date))).", ";
						$monthmk[$i]=$tyu->deposite_month;
                    	//echo date("d-M-y", $rdt); 
				    	$i++; endforeach;	
			//end get fee details
			
			
			$stuname=$student->name;
			$msg = "Dear Parent your child ".$stuname.",Fee of Month ".$printMonth.",is deposited of Rs.".$fsd->paid."/-with due balance Rs.".$current_balance."/-.For more info visit: ".$sende_Detail1->web_url;
		//echo $msg;exit;
			sms($fmobile,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
			$this->db->where("id",$school_code);
		    $admin_mobile = $this->db->get('school')->row();
		    if($admin_mobile->id==1){
			$msg1 = "Dear School Manager your Student ".$stuname.",Fee of Month ".$printMonth.",is deposited of Rs.".$fsd->paid."/-with due balance Rs.".$current_balance."/-.For more info visit: ".$sende_Detail1->web_url;
			sms($admin_mobile->mobile_no,$msg1,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
				$msg2 = "Dear School Principle your Student ".$stuname.",Fee of Month ".$printMonth.",is deposited of Rs.".$fsd->paid."/-with due balance Rs.".$current_balance."/-.For more info visit: ".$sende_Detail1->web_url;
			sms(7398863503,$msg2,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
		    }
			$this->db->where("school_code",$school_code);
			$this->db->where("student_id",$this->input->post('stuId'));
			$this->db->where("invoice_no",$invoice_number);
		    $mode = $this->db->get('fee_deposit')->row()->payment_mode;
		    
		   redirect("index.php/invoiceController/fee/$invoice_number/$student_id/$fsd/yes");
		    //print_r($mode);exit;
			
	}


     function onlinefee(){
         
    $invoice_number = $this->uri->segment(3);
    $student_id = $this->uri->segment(4);
    $fsd = $this->uri->segment(5);
    
   // print_r($invoice_number);
    //print_r($invoice_number1);
   
    
    $school_code=$this->session->userdata("school_code");
   //  print_r($school_code);
   // exit();
    $this->db->where("school_code",$school_code);
    $this->db->where("invoice_no",$invoice_number);
    $this->db->where("student_id",$student_id);
    $feerow =$this->db->get("fee_deposit");
    
    if($feerow->num_rows()>0){
        
    $paidamount= $feerow->row()->paid;
  	$op1 = $this->db->query("select closing_balance from opening_closing_balance where opening_date='".date('Y-m-d')."' AND school_code='$school_code'")->row();
	$balance = $op1->closing_balance;
	$close1 = $balance - $paidamount;
	$bal = array(
			"closing_balance" => $close1
	);
	$this->db->where("school_code",$school_code);
	$this->db->where("opening_date",date('Y-m-d'));
	$this->db->update("opening_closing_balance",$bal);
   
    
    $this->db->where("school_code",$school_code);
    $this->db->where("invoice_no",$invoice_number);
    $this->db->where("student_id",$student_id);
    $ab =$this->db->delete("feedue");
    //print_r($ab);
    
    $this->db->where("fsd",$fsd);
    $this->db->where("invoice_no",$invoice_number);
    $this->db->where("student_id",$student_id);
    $ab1 =$this->db->delete("deposite_months");
    //print_r($ab1);
    
    $this->db->where("school_code",$school_code);
    $this->db->where("invoice_no",$invoice_number);
    $this->db->where("student_id",$student_id);
    $ab2 =$this->db->delete("fee_deposit");
    //print_r($ab2);
    
      $this->db->where("school_code",$school_code);
    $this->db->where("invoice_no",$invoice_number);
   
    $ab3 =$this->db->delete("invoice_serial");
    //print_r($ab3);
    
     $this->db->where("school_code",$school_code);
    $this->db->where("invoice_no",$invoice_number);
    $this->db->where("paid_by",$student_id);
    $ab4 =$this->db->delete("day_book");
   // print_r($ab4);exit;
    
    redirect("login/collectFee/feeFalse");
    
    }
	
}

	function fee(){
		$data['pageTitle'] = 'Fee Invoice';
		$data['smallTitle'] = 'Fee Invoice';
		$data['mainPage'] = 'invoice';
		$data['subPage'] = 'Print Fee';	
		$data['title'] = 'Print Fee Invoice';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'feeInvoice';
		$this->load->view("includes/mainContent", $data);
	}
		function printAdmitCard(){
			
		$data['pageTitle'] = 'Student Section';
		$data['smallTitle'] = 'Student Profile';
		$data['mainPage'] = 'Student';
		$data['subPage'] = 'Profile';
	
		$studentId = $this->uri->segment(3);
	
		$this->load->model("studentModel");
		$this->load->model("allFormModel");
		$this->load->model("subjectModel");
		$stDetail = $this->studentModel->getStudentDetail($studentId);
		$stid  =$stDetail->row()->id;
		$data['gurdianDetail'] = $this->studentModel->getGurdianDetail($stid);
		$data['className'] = $this->allFormModel->getClass();
		$data['sectionName'] = $this->allFormModel->getSection();
	
		$personalInfo = $stDetail->row();
	
		$className = $personalInfo->class_id;
		//$section = $personalInfo->section;
	
	//	$data['subjectList'] = $this->subjectModel->getSubjectByClassSection($className,$section);
	
		$data['studentsSubject'] = $this->subjectModel->isStudentSubject($className);
	
		$data['studentProfile'] = $stDetail;
		$data['title'] = 'Student Profile';
	//////////////////
		$this->db->select("studenticard_format");
			$this->db->where("school_code",$this->session->userdata("school_code"));			
		    $val=$this->db->get("result_format");
		  
           if($val->num_rows()>0)
            {
			$val=	$val->row()->studenticard_format;
			$callview = "Admit_".$val;
			$this->load->view("invoice/$callview",$data);
		     }
		/////////////////////
		//$this->load->view("invoice/Admit", $data);
	}
    function feeInvoice(){
		$invoiceNo = $this->uri->segment(3);
		$studentId = $this->uri->segment(4);
		$isAdmission = $this->uri->segment(5);
		$this->db->where("id",$studentId);
		$sinfo = $this->db->get("student_info")->row();
		$cid=$sinfo->class_id;
		$this->db->where("id",$cid);
		$school_code = $this->db->get("class_info")->row()->school_code;
		$this->db->where("school_code",$school_code);
		$this->db->where("invoice_no",$invoiceNo);
		$fee_deposit = $this->db->get("fee_deposit");
		if($fee_deposit->num_rows()>0)
		{
		$fee_deposite=$fee_deposit->row();
		$this->db->where("school_code",$school_code);
		$this->db->where("invoice_no",$invoiceNo);
		$recieved_by = $this->db->get("day_book");
		if($recieved_by->num_rows() > 0){
			$emp = $recieved_by->row()->paid_by;
			$this->db->where("id",$emp);
			$this->db->where("school_code",$school_code);
			$temp = $this->db->get("employee_info");
			if($temp->num_rows() > 0){
				$reciever_name = $temp->row()->name;
			}else{
				$reciever_name = $this->db->get("general_settings")->row()->school_code;
			}
	 }
			else{
			$reciever_name = $this->session->userdata("name");
		}
		
		$this->db->where("id",$studentId);
		$stuInfo = $this->db->get("student_info")->row();
		
		
		$this->db->where("student_id",$studentId);
		$pInfo = $this->db->get("guardian_info")->row();
		$data['rowb'] = $fee_deposite;
		//$data['fee_bank_detail'] = $fee_bank_detail;
		
		$data['isAdmission'] = $isAdmission;
		$data['reciever_name'] = $reciever_name;
		$data['rowc'] = $stuInfo;
		$data['pInfo'] = $pInfo;
		$data['school_code'] = $school_code;
	//	print_r($data1);
		$data['title'] = "Fee reciept invoice";
		$this->load->view("invoice/feeInvoice",$data);
		}else{?>
		    <h1> This invoice is deleted by Admin</h1>
	<?php	}
	}
	function printSaleReciept(){
		$data['pageTitle'] = 'Sale Invoice';
		$data['smallTitle'] = 'Sale Invoice';
		$data['mainPage'] = 'invoice';
		$data['subPage'] = 'Print Sale Invoice';
		
		$data['title'] = 'Print Sale Invoice';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'printSaleReciept';
		$this->load->view("includes/mainContent", $data);
	}
	function marksSlip(){
		$class = $this->input->post("classv");
		$section = $this->input->post("section");
		$data['t_id'] = $this->input->post("teacherid");
		$data['class_section'] = $this->input->post("classv");
		$data['section'] = $this->input->post("section");
		$data['subject'] = $this->input->post("subject");
		$data['exam_name'] = $this->input->post("exam_name");
		$data['out_of'] = $this->input->post("mm");
		$school_code = $this->session->userdata("school_code");
		$result = $this->db->query("select * from student_info where class_id='$class' and section='$section' and status = 'Active' AND school_code='$school_code' ORDER BY first_name");		
		$data['class_info'] = $result;
		$data['num_row1'] = $result->num_rows();
		$this->load->view("printSlip",$data);
	}
	function salaryReciept(){
		$data['pageTitle'] = 'Sale Invoice';
		$data['smallTitle'] = 'Sale Invoice';
		$data['mainPage'] = 'invoice';
		$data['subPage'] = 'Print Sale Invoice';
		$data['title'] = 'Print Sale Invoice';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'salaryReciept';
		$this->load->view("includes/mainContent", $data);
	}
	
	function printSlipf(){
		$this->load->view("invoice/printSlipf");
	}
	function salaryInvoice(){
		$data['title'] = "Fee reciept invoice";
		$this->load->view("invoice/salaryInvoice",$data);
	}
	
	function saleInvoice(){
		$data['id']=$this->uri->segment(3);
		//print_r($id);
		$data['title'] = "Fee reciept invoice";
		$this->load->view("invoice/saleInvoice",$data);
	}
	
	function invoiceCashPayment(){
		$data['title'] = "Fee reciept invoice";
		$this->load->view("invoice/invoiceCashPayment",$data);
	}

	function ttprint(){

	$teacherid=$this->uri->segment('3');
  	$this->db->where('username',$teacherid);
  	$username=$this->db->get('employee_info')->row();
  	$id=$username->id;
  	$this->db->where('teacher',$id);
	$data['time']=$this->db->get('time_table');
	$data['name']=$username->name;
  	$this->load->view('panel/timetable/teacherwise',$data);

	}
	
	function invoiceOnlinePayment(){
		$data['title'] = "Fee reciept invoice";
		$this->load->view("invoice/invoiceOnlinePayment",$data);
	}
	
	function printProfile(){
		$data['title'] = "Student Profile";
		$this->load->view("invoice/printProfile",$data);
	}
		
	function printEmpProfile(){
		$data['title'] = "Employee Profile";
		$this->load->view("invoice/printEmpProfile",$data);
	}
	function printstuProfile(){
		$data['title'] = "Student Profile";
		//$this->load->view("invoice/printstuprofile",$data);
	}
	function classwise_icard(){
		$data['pageTitle'] = 'Student Section';
		$data['smallTitle'] = 'Student Profile';
		$data['mainPage'] = 'Student';
		$data['subPage'] = 'Profile';
		$data['fsd'] = $this->uri->segment(3);
		$data['classid'] = $this->uri->segment(4);
		$data['sectionid'] = $this->uri->segment(5);
        $data['title'] = 'Student Profile';
	//////////////////
		$this->db->select("classwiseicard_format");
			$this->db->where("school_code",$this->session->userdata("school_code"));			
		    $val=$this->db->get("result_format");
           if($val->num_rows()>0)
            {
			$val=	$val->row()->classwiseicard_format;
			$callview = "class_wise_icard_".$val;
			$this->load->view("invoice/$callview",$data);
		     }
	/////////////////////
	
	}
	function classwise_reports(){
		
		$data['pageTitle'] = 'Student Section';
		$data['smallTitle'] = 'Student Profile';
		$data['mainPage'] = 'Student';
		$data['subPage'] = 'Profile';
		$data['classid'] = $this->uri->segment(4);
		$data['sectionid'] = $this->uri->segment(5);
        $data['title'] = 'Student Profile';
/////////////////////////////////////
$fsd1=$this->uri->segment(3);
				$this->db->where("id",$this->uri->segment(3));
		$fsd = 	$this->db->get("fsd")->row();
            $futureDate=date('Y-m-d', strtotime('+1 year', strtotime($fsd->finance_start_date )) );
    		$data['fsd']=$this->uri->segment(3);
    		$data['futureDate'] = $futureDate;
		//for 1st term
	       $this->db->Distinct();
	      $this->db->select("exam_id,term");
		  $this->db->where("school_code",$this->session->userdata("school_code"));
		   $this->db->where("class_id", $this->uri->segment(4));
		  $this->db->where("fsd",$this->uri->segment(3) );
		  $this->db->where("term",1 );
		 $examTypeResult2 = $this->db->get("exam_info");
		 //for 2nd term
		 $this->db->Distinct();
	      $this->db->select("exam_id,term");
		  $this->db->where("school_code",$this->session->userdata("school_code"));
		   $this->db->where("class_id", $this->uri->segment(4));
		  $this->db->where("fsd",$this->uri->segment(3) );
		  $this->db->where("term",2 );
		 $examTypeResult2_2 = $this->db->get("exam_info");
		 //for 3rd term
		 $this->db->Distinct();
	      $this->db->select("exam_id,term");
		  $this->db->where("school_code",$this->session->userdata("school_code"));
		   $this->db->where("class_id", $this->uri->segment(4));
		  $this->db->where("fsd",$this->uri->segment(3) );
		  $this->db->where("term",3 );
		 $examTypeResult2_3 = $this->db->get("exam_info");
		 
		 
            	     /* $this->db->Distinct();
            	      $this->db->select("exam_id");
            		  $this->db->where("school_code",$this->session->userdata("school_code"));
            		  $this->db->where("fsd",$this->uri->segment(3));
            		  $this->db->where("class_id", $this->uri->segment(4));
    $examTypeResult2 =$this->db->get("exam_info")->result();*/
                      $this->db->where("fsd",$this->uri->segment(3) );
    $examTypeResult = $this->db->get("exam_info")->result();
		
    		 $classid = $this->uri->segment(4);
    		 //echo $this->uri->segment(4);
	            	/*	$this->db->Distinct();
                		$this->db->select("subject_id");
                		$this->db->where("fsd",$this->uri->segment(3) );
                		$this->db->order_by("subject_id","Asc");
	 $examTypeResult1 = $this->db->get("exam_info")->result();*/
		$examTypeResult1 = $this->db->query("select DISTINCT subject.id from subject join exam_info on exam_info.subject_id=subject.id where exam_info.fsd='$fsd1' and exam_info.class_id ='$classid' order by subject.id ASC ")->result();

		$subject = Array();
		$subject5 = Array();
		foreach($examTypeResult as $val):
			$subject[] = $val->subject_id;
		endforeach;
		foreach($examTypeResult1 as $val):
			$subject5[] = $val->id;
		endforeach;
		$subject = array_unique($subject);
		$subject5 = array_unique($subject5);
		$formatedResult = array();
		foreach($subject5 as $subVal):
			$subject = array();
			foreach($examTypeResult as $val):
				$count = 1;
				$marks = array();
				if($subVal == $val->subject_id):
					if($count == 1){
                         $subject['subject'] = $subVal;
                                	}
					$marks['Attendance'] = $val->Attendance;
                	$marks['examType'] = $val->exam_id;
					$marks['out_of'] = $val->out_of;
					$marks['marks'] = $val->marks;
					$marks['created'] = $val->created;
					$subject["marks"][] = $marks;
				endif;
				$count++;
			endforeach;
			
			$formatedResult[] = $subject;
			 
		endforeach;      
		$this->db->select("classwisereport_format");
			$this->db->where("school_code",$this->session->userdata("school_code"));			
		    $val=$this->db->get("result_format");
             
		     if($val->num_rows()>0)
            {
		      if($examTypeResult){
                $val=	$val->row()->classwisereport_format;
		if($examTypeResult){
		    $data['fsd']=$this->uri->segment(3);
			//$data['classid']=$classid;
			$data['title'] = "Mark Sheet";
			$data['futureDate'] = $futureDate;
			$data['resultData'] = $formatedResult;
			$data['examid']=$examTypeResult2;
			$data['examid_2']=$examTypeResult2_2;
			$data['examid_3']=$examTypeResult2_3;
			$callview = "class_wise_report_".$val;
			$this->load->view("invoice/$callview",$data);
		}
		else{
			 echo "<div class='alert alert-warning'> .
					 Please ensure that you have select the result formate form the Setting Section.   
					<br>If Yes then Contact to  Admin. 
					<br>If Not then goto setting and Select Your Specific Result formate. 
					<br>Thanku You;
					<br>All the best;
					 !!!!!!!!!</div>";
		    }
								}
		   else
		       {
					 echo "<div class='alert alert-warning'> No Record Found Please Select Valid FSD and Student ID.
					Please insure possible mistakes.<br>1. Selected Financial Start Date have no exam conducted in current date.
					<br>2.You have inserted wrong student ID please check it befoure generating Exam result.<br>
					3. May be Student is Inactive so please conform it...
					<br>
					<br>
					<br>
					Sorry !!!!!!!!!</div>";
                 }
            }
/////////////////////////////////
	}
	
function result(){
		$id = $this->uri->segment(3);
		$fsd1 = $this->uri->segment(4);
		$examId = $this->uri->segment(5);
		//echo $examid;
		//exit();
		// echo $id;

		$resultData = array();
		/**
		 * this code block get persional information about a student by given studentID.
		 */
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("id",$id);
		$stuDetail = $this->db->get("student_info");
		$data['studentInfo'] = $stuDetail->row();
		$studg = $stuDetail->row();
		/**
		 * get student's parents information by given studentID.
		 */
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("student_id",$id);
		$stuDetail = $this->db->get("guardian_info");
		$data['parentInfo'] = $stuDetail->row();
		$this->db->where("id",$fsd1);
		 $fsd =   $this->db->get("fsd")->row();
		$futureDate=date('Y-m-d', strtotime('+1 year', strtotime($fsd->finance_start_date )) );
		$data['fsd']=$fsd1;
		$data['futureDate'] = $futureDate;
		
		
		/**
		 * [$futureDate defines end of finatial satrt date.]
		 * @var [Date]
		 */
		  //for 1st term

	       $this->db->Distinct();
	      $this->db->select("exam_id,term");
		  $this->db->where("school_code",$this->session->userdata("school_code"));
		  $this->db->where("stu_id", $id);
		
		  $this->db->where("term",1);
		 $examTypeResult2 = $this->db->get("exam_info");
		// print_r($examTypeResult2);
		
		 //for 2nd term
		 $this->db->Distinct();
	      $this->db->select("exam_id,term");
		  $this->db->where("school_code",$this->session->userdata("school_code"));
		  $this->db->where("stu_id", $id);
		  $this->db->where("fsd",$fsd1 );
		  $this->db->where("term",2 );
		 $examTypeResult2_2 = $this->db->get("exam_info");
		 //print_r($examTypeResult2_2);
		 //for 3rd term
		 $this->db->Distinct();
	      $this->db->select("exam_id,term");
		  $this->db->where("school_code",$this->session->userdata("school_code"));
		  $this->db->where("stu_id", $id);
		  $this->db->where("fsd",$fsd1 );
		  $this->db->where("term",3 );
		 $examTypeResult2_3 = $this->db->get("exam_info");

		$this->db->where("stu_id", $id);
		$this->db->where("fsd",$fsd1 );
		$examTypeResult = $this->db->get("exam_info")->result();
		
		$this->db->Distinct();
		$this->db->select("class_id");
		$this->db->where("stu_id", $id);
		$this->db->where("fsd",$fsd1 );
		$classid = $this->db->get("exam_info")->row();
		
		$examTypeResult1 = $this->db->query("select DISTINCT subject.id from subject join exam_info on exam_info.subject_id=subject.id where exam_info.fsd='$fsd1' and exam_info.stu_id='$id' order by subject.id ASC ")->result();
	
	
		/*$this->db->Distinct();
		$this->db->select("subject_id");
		//$this->db->where("school_code",$this->session->userdata("school_code"));
	//	$this->db->where("class_id", $studg->class_id);
		$this->db->where("stu_id", $id);
		$this->db->where("fsd",$fsd1 );
		$this->db->order_by("subject_id","Asc");
		$examTypeResult1 =  $this->db->get("exam_info")->result();*/
		
		$subject = Array();
		$subject5 = Array();
		foreach($examTypeResult as $val):
		    $subject[] = $val->subject_id;
			
		endforeach;
		foreach($examTypeResult1 as $val):
		
			$subject5[] = $val->id;
			
		endforeach;
		$subject = array_unique($subject);
		$subject5 = array_unique($subject5);
		
		$formatedResult = array();
		foreach($subject5 as $subVal):
			$subject = array();
			foreach($examTypeResult as $val):
				$count = 1;
				$marks = array();
				
				if($subVal == $val->subject_id):
					
					if($count == 1){


				 $subject['subject'] = $subVal;

					}
					$marks['Attendance'] = $val->Attendance;

					$marks['examType'] = $val->exam_id;
					$marks['out_of'] = $val->out_of;
					$marks['marks'] = $val->marks;
					$marks['created'] = $val->created;
					$subject["marks"][] = $marks;
				endif;
				$count++;
			endforeach;
			
			$formatedResult[] = $subject;
			 
		endforeach;

		   $this->db->select("format");
			$this->db->where("school_code",$this->session->userdata("school_code"));			
		    $val=$this->db->get("result_format");
           if($val->num_rows()>0)
            {//echo $examTypeResult;
		      if($examTypeResult){
		      $val=	$val->row()->format;
		//echo $val;
		if($examTypeResult){
		//print_r($examTypeResult);
			$data['fsd']=$fsd1;
			$data['classid']=$classid;
			$data['title'] = "Mark Sheet";
			$data['futureDate'] = $futureDate;
			$data['resultData'] = $formatedResult;
			$data['examid']=$examTypeResult2;
			$data['examid_2']=$examTypeResult2_2;
			$data['examid_3']=$examTypeResult2_3;

			$val=$this->session->userdata("school_code");

			$callview = "format_".$val;
			
			/**
			 * echo "<pre>";
			 * print_r($data);
			 * echo "</pre>";
			 */


			$this->load->view("invoice/si1/$callview",$data);


		}
		else{
			 echo "<div class='alert alert-warning'> .
					 Please ensure that you have select the result formate form the Setting Section.   
					<br>If Yes then Contact to  Admin. 
					<br>If Not then goto setting and Select Your Specific Result formate. 
					<br>Thanku You;
					<br>All the best;
					 !!!!!!!!!</div>";
			
		         }}
		   else
		       {
			
					 echo "<div class='alert alert-warning'> No Record Found Please Select Valid FSD and Student ID.
					Please insure possible mistakes.<br>1. Selected Financial Start Date have no exam conducted in current date.
					<br>2.You have inserted wrong student ID please check it befoure generating Exam result.<br>
					3. May be Student is Inactive so please conform it...
					<br>
					<br>
					<br>
					Sorry !!!!!!!!!</div>";
		  	       
                 }
			
            }
	
}
	function result_extra(){
		$id = $this->uri->segment(3);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("student_id",$id);
		$this->db->where("status","Active");
		$stuDetail = $this->db->get("student_info");
		$data['rowc'] = $stuDetail->row();
	
		$id = $this->uri->segment(3);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("student_id",$id);
		$stuDetail = $this->db->get("guardian_info");
		$data['pInfo'] = $stuDetail->row();
	
		$data['title'] = "Mark Sheet";
		$this->load->view("invoice/result_extra",$data);
	}
	
	function invoiceCashDueFee(){
		$data['invoiceId']=$this->uri->segment(3);
		$data['title'] = "Fee reciept invoice";
		$this->load->view("invoice/invoiceCashDue",$data);
	}
	
	function printDueFee(){
		$data['pageTitle'] = 'Due Fee Invoice';
		$data['smallTitle'] = 'Due Fee Invoice';
		$data['mainPage'] = 'invoice';
		$data['subPage'] = 'Print Due Fee Invoice';
	
		$data['title'] = 'Due Fee Invoice';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'printDueFee';
		$this->load->view("includes/mainContent", $data);
	}
	function printTC(){
		$stud_id = $this->input->post("stud_id");
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("student_id",$stud_id);
		$tc=$this->db->get("tc_certificate");
		//print_r($tc->num_rows());exit;
		if($tc->num_rows()>0)
		{
		    if($tc->row()->count==10){
		        ?>
		<script>
		    alert("You can not Generate Transfer Certificate More then 3 Time");
		</script>
		
      	<?php
	
		    redirect('login/tc','refresh');
		    }else{
		 if($tc->row()->count==1){
			 $p1 = array(
			     'count'=>2,
			        'tc_date'=>$tc->row()->tc_date,
			 		'tc_date2' =>date('Y-m-d'),
			 		'tc_date3'=>'0000-00-00'
			 );
			 $this->db->where("tc_number",$tc->row()->tc_number);
			 $this->db->where("student_id",$stud_id);
			 $this->db->where("school_code",$this->session->userdata("school_code"));
			 $this->db->update("tc_certificate",$p1);
		 }elseif($tc->row()->count==2){
		      $p1 = array(
		            'count'=>3,
			        'tc_date'=>$tc->row()->tc_date,
			 		'tc_date2' =>$tc->row()->tc_date2,
			 		'tc_date3'=>date('Y-m-d')
			 );
			 $this->db->where("tc_number",$tc->row()->tc_number);
			 $this->db->where("student_id",$stud_id);
			 $this->db->where("school_code",$this->session->userdata("school_code"));
			 $this->db->update("tc_certificate",$p1);
		 }
			 
// 		    $this->db->where("school_code",$this->session->userdata("school_code"));
// 			$v=$this->db->get("tc_certificate")->row();
			$data['tcnumber'] = $tc->row()->tc_number;
			$data['tcdate'] = $tc->row()->tc_date;
		$data['pageTitle'] = 'Transfer Certificate';
		$data['smallTitle'] = 'Transfer Certificate';
		$data['mainPage'] = 'Transfer Certificate';
		$data['subPage'] = 'Transfer Certificate';
		$data['title'] = 'printTC';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'printTC';
		$this->load->view("includes/mainContent", $data);
		    }
		
		}
		else {
		    	$this->db->where("school_code",$this->session->userdata("school_code"));
			 $value=$this->db->count_all("tc_certificate");
			 $number = 100+$value;
			 $tcnum = "TC".$number;
			 $data['tcnumber'] = $tcnum;
			 $this->db->where("username",$stud_id);
			 //$this->db->where("school_code",$this->session->userdata("school_code"));
			 $var= $this->db->get("student_info")->row();
			 $p1 = array(
			        'count'=>1,
			 		'tc_number' =>$tcnum,
			 		'tc_date' =>date('Y-m-d'),
			 		'tc_date2' =>'0000-00-00',
			 		'tc_date3' =>'0000-00-00',
			 		'book_no' =>2,
			 		'student_id'=> $stud_id,
			 		'school_code'=>$this->session->userdata("school_code")
			 );
			 $this->db->insert("tc_certificate",$p1);
			
			 
		    $this->db->where("school_code",$this->session->userdata("school_code"));
			$v=$this->db->get("tc_certificate")->row();
			$data['tcnumber'] = $v->tc_number;
			$data['tcdate'] = $v->tc_date;
		$data['pageTitle'] = 'Due Fee Invoice';
		$data['smallTitle'] = 'Due Fee Invoice';
		$data['mainPage'] = 'invoice';
		$data['subPage'] = 'Print Due Fee Invoice';
		$data['title'] = 'printTC';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'printTC';
		$this->load->view("includes/mainContent", $data);
		}
		
			
	}

	function printcert1(){
		$stud_id = $this->input->post("stud_id");
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("student_id",$stud_id);
		$cc=$this->db->get("cc_certificate");
		if($cc->num_rows()>0)
		{
		if($cc->row()->count==3){
		        ?>
		<script>
		    alert("You can not Generate Transfer Certificate More then 3 Time");
		</script>
		
      	<?php
	
		    redirect('login/charc','refresh');
		    }else{
		 if($cc->row()->count==1){
			 $p1 = array(
			     'count'=>2,
			        'cc_date1'=>$cc->row()->cc_date1,
			 		'cc_date2' =>date('Y-m-d'),
			 		'cc_date3'=>'0000-00-00'
			 );
			 $this->db->where("cc_number",$cc->row()->cc_number);
			 $this->db->where("student_id",$stud_id);
			 $this->db->where("school_code",$this->session->userdata("school_code"));
			 $this->db->update("cc_certificate",$p1);
		 }elseif($cc->row()->count==2){
		      $p1 = array(
		            'count'=>3,
			        'cc_date1'=>$cc->row()->cc_date1,
			 		'cc_date2' =>$cc->row()->cc_date2,
			 		'cc_date3'=>date('Y-m-d')
			 );
			 $this->db->where("cc_number",$cc->row()->cc_number);
			 $this->db->where("student_id",$stud_id);
			 $this->db->where("school_code",$this->session->userdata("school_code"));
			 $this->db->update("cc_certificate",$p1);
		 }
			 
// 		    $this->db->where("school_code",$this->session->userdata("school_code"));
// 			$v=$this->db->get("tc_certificate")->row();
			$data['tcnumber'] = $cc->row()->cc_number;
			$data['tcdate'] = $cc->row()->cc_date1;
		
		$data['pageTitle'] = 'Character Certificate';
		$data['smallTitle'] = 'Character Certificate';
		$data['mainPage'] = 'Certificate';
		$data['subPage'] = 'Print Due Fee Invoice';
		$data['title'] = 'print CC';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'printcC';
		$this->load->view("includes/mainContent", $data);
		    }
		}
		else {
			$this->db->where("school_code",$this->session->userdata("school_code"));
			 $value=$this->db->count_all("cc_certificate");
			 $number = 100+$value;
			 $ccnum = "CC".$number;
			 $data['ccnumber'] = $ccnum;
			 $this->db->where("username",$stud_id);
			 //$this->db->where("school_code",$this->session->userdata("school_code"));
			 $var= $this->db->get("student_info")->row();
			 $p1 = array(
			        'count'=>1,
			 		'cc_number' =>$ccnum,
			 		'cc_date1' =>date('Y-m-d'),
			 		'cc_date2' =>'0000-00-00',
			 		'cc_date3' =>'0000-00-00',
			 		'book_no' =>2,
			 		'student_id'=> $stud_id,
			 		'school_code'=>$this->session->userdata("school_code")
			 );
			 $this->db->insert("cc_certificate",$p1);
			
			 
		    $this->db->where("school_code",$this->session->userdata("school_code"));
			$v=$this->db->get("cc_certificate")->row();
			$data['ccnumber'] = $v->cc_number;
			$data['ccdate'] = $v->cc_date1;
			
		$data['pageTitle'] = 'Character Certificate';
		$data['smallTitle'] = 'Character Certificate';
		$data['mainPage'] = 'Certificate';
		$data['subPage'] = 'Print Due Fee Invoice';
		$data['title'] = 'print CC';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'printcC';
		$this->load->view("includes/mainContent", $data);
		}
		
	
	}
	function printcer(){
		$data['stud_id']=$this->uri->segment(3);
		$data['title'] = "printTcFinal";
		$this->load->view("invoice/printcCFinal",$data);
	}
	function printTC1(){
		$data['stud_id']=$this->uri->segment(3);
		$data['title'] = "printTcFinal";
		$this->load->view("invoice/printTCFinal",$data);
	}
	function printcC(){
		$data['pageTitle'] = 'Due Fee Invoice';
		$data['smallTitle'] = 'Due Fee Invoice';
		$data['mainPage'] = 'invoice';
		$data['subPage'] = 'Print Due Fee Invoice';
	
		$data['title'] = 'print Character Certificate';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'printcC';
		$this->load->view("includes/mainContent", $data);
	}
	function printcC1(){
		$data['stud_id']=$this->uri->segment(3);
		$data['title'] = "printccFinal";
		$this->load->view("invoice/printcCFinal",$data);
	}
}