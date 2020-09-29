<?php
class HomeController extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('loginModel');
		$this->load->model("smsmodel");
		$school_code = $this->session->userdata("school_code");
	}
	function sendEmail(){
	$userid=$this->input->post("userID");
	$email1=$this->input->post("email1");
    $this->db->where("status",1);
	$this->db->where("username",$userid);
	$var = $this->db->get('employee_info');
	if($var->num_rows()>0)
	{  $pass=  $var->row()->password;
	$school_code =  $var->row()->school_code;
	    $school_info =$this->db->query("select * from school  where id ='$school_code'");
	if($school_info->num_rows()>0){
		        $schoolname=$school_info->row()->school_name;
		         if($var->row()->email == $email1){ 
        		        if((strlen($school_info->row()->email1)>0) || (strlen($school_info->row()->email2)>0)){
        		            $ccregisterEmail= $school_info->row()->email1.",".$school_info->row()->email2;
        		            $message = "Dear Student ".$var->row()->name." Your password is ".$pass." Thanks for using E-mail to password Recovery System. ".$schoolname;
        		            $this->sendMail($email1,$schoolname,$ccregisterEmail,$message);
        		        if($var->row()->mobile){
                		    $school_code=  $school_info->row()->id;
                		    $this->db->where("school_code",$school_code);
                	     	$sender=$this->db->get("sms_setting");
                		  	$sende_Detail =$sender->row();
                		  	//print_r($school_code);
                			$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
                		    $master_id=$max_id->maxid+1;
                		    $msg = "Dear Teacher ".$var->row()->name."  your Password is successfully sent to your Register E-mail id also your Login password  is  ".$pass." ".$schoolname;
                			$getv=mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$var->row()->mobile);
            				 $this->smsmodel->sentmasterRecord1($msg,2,$master_id,$getv,$school_info->row()->id);
        			
        		    }
        		    } 
		    }else{
		        if($var->row()->mobile){
		    $school_code=  $school_info->row()->id;
		    $this->db->where("school_code",$school_code);
	     	$sender=$this->db->get("sms_setting");
		  	$sende_Detail =$sender->row();
		  	//print_r($school_code);
			$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		    $master_id=$max_id->maxid+1;
		    $msg = "Dear Teacher ".$var->row()->name." your E-mail is not registered  please contact to school and update E-mail id your Login password  is  ".$pass." ".$schoolname;
			$getv=mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$var->row()->mobile);
				// $this->smsmodel->sentmasterRecord1($msg,2,$master_id,$getv,$school_info->row()->id);
			
		    }
		    
		    }
		    	redirect("index.php/homeController/index/8");
		    }
		
	}
	else
	{
	$this->db->where("status",1);
	$this->db->where("username",$userid);
	$var = $this->db->get('student_info');
	if($var->num_rows()>0)
	{   
	      
	    $pass=  $var->row()->password;
	        $class_id=  $var->row()->class_id;
	        $school_info =$this->db->query("select school.id,school.email1,school.email2,school.school_name,school.mobile_no from school inner join class_info on school.id = class_info.school_code where class_info.id ='$class_id'");
		    if($school_info->num_rows()>0){
		        $schoolname=$school_info->row()->school_name;
		         if($var->row()->email==$email1){ 
        		        if((strlen($school_info->row()->email1)>0) || (strlen($school_info->row()->email2)>0)){
        		            $ccregisterEmail= $school_info->row()->email1.",".$school_info->row()->email2;
        		            $message = "Dear Teacher ".$var->row()->name." Your password is ".$pass." Thanks for using E-mail to password Recovery System. ".$schoolname;
        		            $this->sendMail($email1,$schoolname,$ccregisterEmail,$message);
        		        if($var->row()->mobile){
                		    $school_code=  $school_info->row()->id;
                		    $this->db->where("school_code",$school_code);
                	     	$sender=$this->db->get("sms_setting");
                		  	$sende_Detail =$sender->row();
                		  	//print_r($school_code);
                			$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
                		    $master_id=$max_id->maxid+1;
                		    $msg = "Dear Student ".$var->row()->name." your Password is successfully sent to your Register E-mail id also your Login password  is  ".$pass." ".$schoolname;
                			$getv=mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$var->row()->mobile);
            				 $this->smsmodel->sentmasterRecord1($msg,2,$master_id,$getv,$school_info->row()->id);
        			
        		    }
        		    } 
		    }else{
		        if($var->row()->mobile){
		    $school_code=  $school_info->row()->id;
		    $this->db->where("school_code",$school_code);
	     	$sender=$this->db->get("sms_setting");
		  	$sende_Detail =$sender->row();
		  	//print_r($school_code);
			$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		    $master_id=$max_id->maxid+1;
		    $msg = "Dear Student".$var->row()->name." your E-mail is not  registered by us please contact to school and update E-mail id your Login password  is  ".$pass." ".$schoolname;
			$getv=mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$var->row()->mobile);
				 $this->smsmodel->sentmasterRecord1($msg,2,$master_id,$getv,$school_info->row()->id);
			
		    }
		    }
		    	redirect("index.php/homeController/index/8");
		    }
	
	
	}
	else{
	$this->db->where("admin_username",$userid);
	$var = $this->db->get('general_settings');
		if($var->num_rows()>0)
	{   
	    $newpass = rand(111111,999999);  
	    $pass=  $newpass;
	    $school_code=  $var->row()->school_code;
	        $school_info =$this->db->query("select * from school where id ='$school_code'");
		    if($school_info->num_rows()>0){
		        $schoolname=$school_info->row()->school_name;
		         if(($school_info->row()->email1==$email1) || ($school_info->row()->email2==$email1)){ 
        		        if((strlen($school_info->row()->email1)>0) || (strlen($school_info->row()->email2)>0)){
        		            $ccregisterEmail= $school_info->row()->email1.",".$school_info->row()->email2;
        		            $message = "Dear Admin ".$school_info->row()->principle_name." Your password is ".$pass." Thanks for using E-mail to password Recovery System. ".$schoolname;
        		            $this->sendMail($email1,$schoolname,$ccregisterEmail,$message);
        		        if($school_info->row()->mobile_no){
                		    $school_code=  $school_info->row()->id;
                		    $this->db->where("school_code",$school_code);
                	     	$sender=$this->db->get("sms_setting");
                		  	$sende_Detail =$sender->row();
                		  	//print_r($school_code);
                			$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
                		    $master_id=$max_id->maxid+1;
                		    $msg = "Dear Admin ".$school_info->row()->principle_name." your Password is successfully sent to your Register E-mail id also your Login password  is  ".$pass." ".$schoolname;
                			$getv=mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$school_info->row()->mobile_no);
            				 $this->smsmodel->sentmasterRecord1($msg,2,$master_id,$getv,$school_info->row()->id);
            				 $uppassword['admin_password'] = md5($pass);
		                    $this->db->where("school_code",$school_code);
		                    $this->db->update("general_settings",$uppassword);
		                   
        			
        		    }
        		    } 
		    }else{
		        if($school_info->row()->mobile_no){
		    $school_code=  $school_info->row()->id;
		    $this->db->where("school_code",$school_code);
	     	$sender=$this->db->get("sms_setting");
		  	$sende_Detail =$sender->row();
		  	//print_r($school_code);
			$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		    $master_id=$max_id->maxid+1;
		    $msg = "Dear Admin ".$school_info->row()->principle_name." your E-mail is not  registered by us please contact to school and update E-mail id your Login password  is  ".$pass." ".$schoolname;
			$getv=mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$school_info->row()->mobile_no);
				 $this->smsmodel->sentmasterRecord1($msg,2,$master_id,$getv,$school_info->row()->id);
				$uppassword['admin_password'] = md5($pass);
		        $this->db->where("school_code",$school_code);
		        $this->db->update("general_settings",$uppassword);
		
		    }
		    }
		      redirect("index.php/homeController/index/8");
		    }
	
	
	}else{
	    	redirect("index.php/homeController/index/9");
	}
		}
	
	}
	
	}
	   function sendMail($email1,$schoolname,$ccregisterEmail,$message){
	        $this->load->library('email');
			$this->email->from('support@schoolerp-niktech.in', $schoolname);
			$this->email->to($email1);
			$this->email->cc($ccregisterEmail);
			$this->email->subject('Password Recovery');
			$this->email->message($message);
			$this->email->send();
        }


		function index(){
		if($this->session->userdata("is_login") == true){
			$this->session->unset_userdata();
			$this->session->sess_destroy();
		}
		$data['title'] = 'NIKTECH-School Login Area';
		$this->load->helper("sms");
		//sms("4947cf80573bb1b355d918ad91fe35fd","Hi pushpendra","GFINCH","7668538172");
		$this->load->view("login", $data);
	}
	
	function login_check(){
		$query = $this->loginModel->validate();
	if($query['is_login']){  //if user validation return true after validation
		//	print_r($query['login_type']);exit;
			if($query['login_type'] == "admin"):
				$this->session->set_userdata($query);
				//echo $query['login_type'];
				redirect("index.php/login/index");
			elseif($query['login_type'] == "student"):
				//echo $query['login_type'];
				$this->session->set_userdata($query);
			redirect("index.php/singleStudentControllers");
			elseif(($query['login_type'] == 3)||($query['login_type'] == 2)):
				//echo $query['login_type'];
				//echo "t";
				$this->session->set_userdata($query);
				redirect("index.php/singleTeacherControllers");
			elseif($query['login_type'] == 1):
			//print_r($query['login_type']);exit;
			$this->session->set_userdata($query);
			redirect("index.php/login/index");
			else:
				redirect("index.php/login/index");
			endif;
		}
		else{ // if user not validate the credential ....
			redirect("index.php/homeController/index/authFalse");
		}
	}
	
	function unlock(){
		$query = $this->loginModel->validateLock();
		
		if($query){  //if user Lock validation return true after validation
			$this->session->set_userdata('is_lock',true);
			redirect("index.php/login/index");
		}
		else{ // if user not validate the credential ....
			redirect("index.php/homeController/lockPage/false");
		}
	}
	
	function logout()
	{	
		$this->session->unset_userdata();
		$this->session->sess_destroy();
		redirect('index.php/homeController');
	}
	
	function lockPage(){
		if($this->session->userdata("is_login") == false){
			redirect('index.php/homeController');
		}
		$data['title'] = $this->session->userdata("name");
		$this->session->set_userdata('is_lock', false);
		$this->load->view("lockPage", $data);
	}
	
	function recoverPassword(){
		
	}
	
	function test(){
		$this->load->view("test");
	}
	
	function testsms(){
		$this->load->view("testsms");
	}

	function schoolInfo(){	
		$school_code = $this->session->userdata("school_code");	
		$id = $this->db->query("SELECT id From school order by id DESC Limit 1");
		$fsdid= $this->db->query("SELECT MAX(id) as v FROM fsd")->row();
		$fsdid=$fsdid->v+1;
		if($id->num_rows()>0){
		$id = $id->row()->id;
		}else{
		
		$id=0;
		}
		$id = 1 + $id;	
		// $this->form_validation->set_error_delimiters('<div class="col-sm-12"><label class="text-danger">', '</label></div>');
		// $this->form_validation->set_rules('schoolName','Date Of Admission', 'trim|required');
		// $this->form_validation->set_rules('principalName','Name', 'trim|required');
		// $this->form_validation->set_rules('wiseprincipalName','Date of birth', 'trim|required');
		// $this->form_validation->set_rules('mobile','Class of Admission', 'trim|required');
		// $this->form_validation->set_rules('section','Section', 'trim|required');
		// $this->form_validation->set_rules('gender','Gende', 'trim');
		// $this->form_validation->set_rules('addLine1','Address', 'trim|required');
		// $this->form_validation->set_rules('mobileNumber','Mobile Number', 'trim|required|numeric');
		// $this->form_validation->set_rules('emailAddress','', 'trim|valid_email');
		// $this->form_validation->set_rules('password','Password', 'trim|required');
		// $this->form_validation->set_rules('password_again','Re-Password', 'trim|required|matches[password]');
		// $this->form_validation->set_rules('fatherName','Father Name', 'trim|required');
		//$this->db->where('school_code',$school_code);
		//$schoolId=$this->db->get('school')->row();
		//$fsd=$this->db->get('fsd')->row()->id;
            $dataschool = array(				
				"school_name" => $this->input->post("schoolName"),
				"principle_name" => $this->input->post("principalName"),
				"wise_principle_name" => $this->input->post("wiseprincipalName"),
				"mobile_no" => $this->input->post("mobile"),
				"email1" => $this->input->post("emailAddress"),
				"created_date" => date("Y-m-d H:i:s"),
				"id"=>$id,
				"agree"=>"YES"
			);
			$this->load->model('schoolmodel');
			$SchConfirm = $this->schoolmodel->schInfo($dataschool);

			$datags = array(
				"admin_username" => $this->input->post("username"),
				"admin_password" => MD5($this->input->post("password")),
				"school_code" => $id,
				"fsd_id"=>$fsdid,
				"created"=>date("Y-m-d H:i:s")
				
			); 
			$this->load->model('schoolmodel');
			$SchConfirm1 = $this->schoolmodel->schInfo1($datags);

			$datasms = array(
				"school_code"=>$id
			);
			$this->load->model('schoolmodel');
			$SchConfirm3 = $this->schoolmodel->schInfo2($datasms);

			$datasmssetting = array(
				"sender_id" =>  $this->input->post("smsid"),
				"web_url" => $this->input->post("smsweburl"),
				"school_code" => $id
			);
			$this->load->model('schoolmodel');
			$SchConfirm4 = $this->schoolmodel->schInfo3($datasmssetting);

			$datafsd = array(
				"finance_start_date" => $this->input->post("fsdS"),
				"finance_End_date" => $this->input->post("fsdE"),
				"school_code" => $id,
				"id"=>$fsdid
			);
			$this->load->model('schoolmodel');
			$SchConfirm2 = $this->schoolmodel->schInfo4($datafsd);

			if($SchConfirm && $SchConfirm1 && $SchConfirm2 && $SchConfirm3 && $SchConfirm4 ){
				 $rtype="admin";
				   // redirect(base_url()."index.php/api/common_user/$rtype");
				redirect(base_url()."index.php/login/");
			}
			
		}

	public function schoolRegistration(){
		//echo "string";
		$this->load->view("headerCss/newschregcss");
		$this->load->view("newSchoolregistration");
		$this->load->view("footerJs/newschregjs");
		// $data['pageTitle'] = 'school Registration';
		// $data['smallTitle'] = 'school Registration';
		// $data['mainPage'] = 'newSchoolregistration';
		// $data['title'] = 'school Registration';
		// //$this->load->model("configureclassmodel");
		// //$data['request'] = $this->allFormModel->getClass()->result();
		// $data['headerCss'] = 'headerCss/schoolregistrationcss';
		// $data['footerJs'] = 'footerJs/newschoolregistration';
		// $data['mainContent'] = 'classPromotionList';
		// $this->load->view("includes/mainContent", $data);
	}
   public function duereport(){
        $uri= $this->uri->segment(3);
        $data['uri']=$uri;
      	$data['pageTitle'] = 'Due Report';
		$data['smallTitle'] = 'Due Report';
		$data['mainPage'] = 'Due Report';
		$data['subPage'] = 'Due Report';
		$data['title'] = 'Due Report';
		//$this->load->model("configureclassmodel");
		//$data['request'] = $this->allFormModel->getClass()->result();
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'duereport';
		$this->load->view("includes/mainContent", $data);
  }
	public function stufkey(){
	    $stinfo = $this->db->get("guardian_info")->result();
	    foreach($stinfo as $rt):
	        $this->db->where("id",$rt->student_id);
	        $gft = $this->db->get("student_info");
	        if($gft->num_rows()>0){
	            
	        }
	        else{
	           echo  $rt->student_id."<br>";
	        }
	        endforeach;
	}
	function testrank(){
	   $this->load->model("exammodel");
	   $this->exammodel->getClassRank('6263','216','3');
	}

	
	function updateTransportfee(){
		$schools = $this->db->get("general_settings");
	    foreach($schools->result() as $sch ):
	        $this->db->where("school_code",$sch->school_code);
	       $gettv =  $this->db->get("transport");
	       foreach($gettv->result() as $gv):
	           $this->db->where("v_id",$gv->id);
	           $amv = $this->db->get("transport_root_amount");
	           foreach($amv->result() as $am):
	               $data['root_id']=$am->id;
	               $data['fsd']     =$sch->fsd_id;
	               $data['amount']  =$am->transport_fee;
	               $this->db->insert("fsdwise_root_amount",$data);
	               endforeach;
	       endforeach;
	        
	        endforeach;

	   echo     "success"; 
	}

	function updateclassidinfeedeposite(){
		
		
		 $school_code = 2;

		
	    $query=$this->db->get("student_info");

		foreach($query->result() as $stuid):
			$updateclass['class_id']=$stuid->class_id;
		$this->db->where("student_id",$stuid->id);
		$this->db->update("fee_deposit",$updateclass);

		endforeach; 
		echo "done- ".$school_code;
		
	}

	
	function updateTranportFSD(){
		$tfm = $this->db->get("transport_fee_month");
		foreach($tfm->result() as  $row):
				$this->db->where("invoice_no",$row->invoice_number);
			$getfsd = $this->db->get("fee_deposit");
			if($getfsd->num_rows()>0){
				$data['fsd']=$getfsd->row()->finance_start_date;
				$this->db->where("invoice_number",$row->invoice_number);
				$this->db->update("transport_fee_month",$data);
				
			}else{
				$this->db->where("school_code",$row->school_code);
				$this->db->where("finance_start_date","2019-04-01");
				$fsdid = $this->db->get("fsd")->row()->id;
				$data['fsd']=$fsdid;
				$this->db->where("invoice_number",$row->invoice_number);
				$this->db->update("transport_fee_month",$data);
			}
		endforeach;
	}
	
	function sessionvalue(){
	    $ft = $this->db->get("ci_sessions")->result();
	    foreach($ft as $sv):
	        //echo "<pre>";
	        print_r($sv->user_data);
	        $mhd = unserialize($sv->user_data);
	        echo $mhd['username'];
	         echo $mhd['school_code'];
	         //echo "</pre>";
	        endforeach;
	}

	
	function updateOpeningClosing(){
		$cdate = date("Y-m-d");
		$this->load->model("daybookmodel");
		echo $this->daybookmodel->getClosingBalance($cdate);
	}
	
	function updateinvoiceHeads(){
		$this->db->distinct();
		$this->db->select("reason");
		$ish = $this->db->get("invoice_serial");
		foreach($ish->result() as $row):
		if($row->reason=="Bank Transaction"){
			$head =6;
		}
		if($row->reason=="Fee Deposit"){
			$head =5;
		}
		if($row->reason=="Fee Due"){
			$head =4;
		}
		if($row->reason=="Sale Invoice"){
			$head =3;
		}
		if($row->reason=="Cash Payment handove"){
			$head =8;
		}
		if($row->reason=="Director Transaction"){
			$head =7;
		}
		if($row->reason=="Employee Salary"){
			$head =10;
		}
		if($row->reason=="Stock Sale"){
			$head =3;
		}
		if($row->reason=="Indi. transport fee"){
			$head =11;
		}
		$headcode['reason']=$head;
		$this->db->where("reason",$row->reason);
		$this->db->update("invoice_serial",$headcode);
		endforeach;
	}
	function updateCashpayment(){
		$res1 = $this->db->get("cash_payment")->result();
		foreach($res1 as $res):
		$this->db->select("id");
		$this->db->where("expenditure_name",$res->exp_id);
		$this->db->where("school_code",$res->school_code);
		$eid = $this->db->get("expenditure");
		if($eid->num_rows()>0){
			$this->db->select("id");
			$this->db->where("exp_id",$eid->row()->id);
				$this->db->where("sub_expenditure_name",$res->sub_exp_id);
			$getsid = $this->db->get("sub_expenditure");
			if($getsid->num_rows()>0){
				$updateexp['sub_exp_id']=$getsid->row()->id;
			}
			
			$updateexp['exp_id']=$eid->row()->id;
		
			$this->db->where("school_code",$res->school_code);
			$this->db->where("receipt_no",$res->receipt_no);
			$this->db->update("cash_payment",$updateexp);
			}
		endforeach;
	}

function updateExamMode_inQuestion(){
    $this->db->distinct();
    $this->db->select('exam_subject_id,exam_master_id');
   $qm = $this->db->get("question_master");
   if($qm->num_rows()>0){
       foreach($qm->result() as $q):
       $this->db->where("exam_id",$q->exam_master_id);
       $this->db->where("subject",$q->exam_subject_id);
     $emid =  $this->db->get("exam_mode");
     if($emid->num_rows()>0){
         $update['exam_mode_id']=$emid->row()->id;
         $this->db->where("exam_master_id",$q->exam_master_id);
       $this->db->where("exam_subject_id",$q->exam_subject_id);
          $this->db->update("question_master",$update);
     }else{
         
            $this->db->where("exam_master_id",$q->exam_master_id);
            $this->db->where("exam_subject_id",$q->exam_subject_id);
            $fordeleteid = $this->db->get("question_master");
            if($fordeleteid->num_rows()>0){
                foreach($fordeleteid->result() as $fr):
                    echo $fr->id."-";
                    $this->db->where("question_master_id",$fr->id);
                    $this->db->delete("question_ans");
                        $this->db->where("question",$fr->id);
                        $this->db->delete("question_images");
                    endforeach;
            }
       
         $this->db->where("exam_master_id",$q->exam_master_id);
       $this->db->where("exam_subject_id",$q->exam_subject_id);
       $this->db->delete("question_master");
       
     
     }
     endforeach;  
   }
    
}
}