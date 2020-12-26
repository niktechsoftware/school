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
				"customer_id"=>$this->input->post("cid"),
				"principle_name" => $this->input->post("principalName"),
				"wise_principle_name" => $this->input->post("wiseprincipalName"),
				"mobile_no" => $this->input->post("mobile"),
				"email1" => $this->input->post("emailAddress"),
				"created_date" => date("Y-m-d H:i:s"),
				'address1'=>$this->input->post("address1"),
    			 'address2'=>$this->input->post("address2"),
    			 'state'=>$this->input->post("state"),
    			  "pin"=>$this->input->post("pin"),
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
            $datasmssett =array(
			         'uname'=>$this->input->post("uname"),
			         'password'=>$this->input->post("smspassword"),
			         'sender_id'=>$this->input->post("smssender_id"),
			         'auth_key'=>$this->input->post("authkey"),
			         'web_url'=>$this->input->post("smsweburl"),
			         "school_code" => $id
			         );
	/*	$datasmssetting = array(
				"sender_id" =>  $this->input->post("smsid"),
				"web_url" => $this->input->post("smsweburl"),
				"school_code" => $id
			);*/
			$this->load->model('schoolmodel');
			$SchConfirm4 = $this->schoolmodel->schInfo3($datasmssett);

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


function deleteQuestionans(){
    $qs = $this->db->get("right_answer");
    foreach($qs->result() as $r):
        $this->db->where("id",$r->question_master_id);
        $qm = $this->db->get("question_master");
        if($qm->num_rows()>0){
            
        }else{
            $this->db->where("question_master_id",$r->question_master_id);
            $this->db->delete("right_answer");
        }
        endforeach;
}

function deleteObjective(){
        $this->db->distinct();
        $this->db->select('exam_id,subject_id');
        $qm = $this->db->get("objective_exam_result");
   if($qm->num_rows()>0){
       foreach($qm->result() as $q):
       $this->db->where("exam_id",$q->exam_id);
       $this->db->where("subject",$q->subject_id);
     $emid =  $this->db->get("exam_mode");
     if($emid->num_rows()>0){
         $update['exam_mode_id']=$emid->row()->id;
         $this->db->where("exam_id",$q->exam_id);
       $this->db->where("subject_id",$q->subject_id);
          $this->db->update("objective_exam_result",$update);
     }
     endforeach;  
   }
}

function update_questiondrom2(){
    $result = $this->db->get("question_master");
    foreach($result->result() as $back):
        $this->db->where("id",$back->id);
       $getv =  $this->db->get("question_master2");
       if($getv->num_rows()>0){
           $dataup['question']= $getv->row()->question;
           $this->db->where("id",$back->id);
           $this->db->update("question_master",$dataup);
       }
        endforeach;
} 

function testResult(){
    ?> <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/style.css' />
    <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/prin_result.css'
        media="print" />
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/jquery-1.3.2.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/example.js'></script>
    <?php
$school_code =15;
$class_id =322;
$fsd_id=24;
$student_id=6391;
$totalIndicator=0;
$termTotal=1;
$term = $this->db->query("select distinct (term) as trm from exam_name where school_code='$school_code'");
if($term->num_rows()>0){
   $i=0; foreach($term->result() as $trmv):
      $termColv[$i] =  $this->db->query("select * from exam_name where school_code='$school_code' and term='$trmv->trm'");
      $termCol[$i]=$termColv[$i]->num_rows();
     $i++;   endforeach;
?>
     <table style="width:95%;text-transform: uppercase; margin-left:auto; margin-right:auto; border:1px solid black; background-color:white;">
                    <tr >
                        <th colspan="1" rowspan="2">SCHOLASTIC AREA </th>
                        <?php if($term->num_rows()>0){
                         $i=0; foreach($term->result() as $trmv): ?>
                        <th colspan="<?php if($termTotal==1){echo $termCol[$i]+1;}else{echo $termCol[$i];}?>" rowspan="2">TERM <?php echo $trmv->trm;?> (100 MARKS) </th>
                        <?php $i++; endforeach;}?>
                        <th colspan="3">OVERALL</th>

                    </tr>

                    <tr>
                        <th colspan="3">
                           
                            <?php  $ovtg = "TERM"; 
                            if($term->num_rows()>0){
                            $i=0; foreach($term->result() as $trmv): 
                             if($i>0){
                           $ovt = $ovt."+".$ovtg."-".$trmv->trm ;
                           }else{
                            $ovt = $ovtg."-".$trmv->trm ;
                           }
                          // echo $ovt."<br>";
                           $i++; endforeach;
                           echo $ovt;
                           }
                           ?> 
                           
                           </th>
                    </tr>

                    <tr>

                        <th colspan="1" rowspan="1" style="text-transform: uppercase;">Subjects</th>
                     <?php  foreach($termColv as $examCol):
                                foreach($examCol->result() as $examName):
                                    echo '<th>'.$examName->exam_name."</th>";
					            endforeach;
					            if($termTotal==1){
					                echo '<th>Total</th>';
					            }
							endforeach;
					?>
						<!--2 term exam nam end-->
                        <th style="text-transform: uppercase;">Grand<br> Total</th>
                        <th rowspan="1" style="text-transform: uppercase;">Grade</th>
                        <th rowspan="1" style="text-transform: uppercase;">Rank:</th>
                    </tr>
                  <?php 
                   ///marks print
				$subjectList = $this->db->query("select DISTINCT subject.id, subject.subject from subject join exam_max_subject on exam_max_subject.subject_id=subject.id where exam_max_subject.fsd='$fsd_id' and exam_max_subject.class_id ='$class_id' order by subject.id ASC ");
			
				if($subjectList->num_rows()>0){
				     $rankcounter=0;
				    foreach($subjectList->result() as $sl):?>
                 <tr class="wight"> 
					 <td class="subject" ><?php echo  $sl->subject;?></td>
			    <?php $m=0;
			    $subTotal =0;
			    $GrandTotal=0;
			   
			    foreach($termColv as $examCol):
			            $termsubTotal=0;
			            $termmamTotal=0;
                                foreach($examCol->result() as $examName):
                                   $exam_id= $examName->id;
                                $getsubMarks =   $this->db->query("select * from exam_info join exam_max_subject on exam_max_subject.id = exam_info.exam_max_id where exam_max_subject.exam_id ='$exam_id' and exam_max_subject.subject_id ='$sl->id' and exam_max_subject.fsd='$fsd_id' and exam_max_subject.class_id ='$class_id' and exam_info.stu_id='$student_id' ");
                                   
                                if($getsubMarks->num_rows()>0){
                                    $gtotal =$getsubMarks->row()->max_m;
                                    $subMarks = $getsubMarks->row()->marks;
                                    $termsubTotal+=$subMarks;
                                    $termmamTotal+=$subMarks;
                                     $GrandTotal+=$gtotal;
                                    $subTotal+=$subMarks;
                                }else{
                                    $subMarks="(N/A)";
                                    $gtotal="(N/A)";
                                }
                                if($totalIndicator ==1){
                                    echo '<th>'.$subMarks." / ".$gtotal."</th>";
                                }else{
                                    echo '<th>'.$subMarks."</th>";
                                }
                                   
					            endforeach;
					            if($termTotal==1){
					                if($totalIndicator ==1){
                                    echo '<th>'.$termsubTotal." / ".$termmamTotal."</th>";
                                    }else{
                                    echo '<th>'.$termsubTotal."</th>";
                                    } 
					            }
					            
					          
						$m++;	endforeach;
					?>		
				
				<th class="center bold" ><?php  
				if($totalIndicator ==1){
				echo $subTotal." / ".$GrandTotal; }
				else{
				   	echo $subTotal; 
				}?></th>
				<!--overall total & grade start-->	
				<?php 	if($GrandTotal>0){ 
				    $per=round((($subTotal*100)/$GrandTotal), 2);}
				?>
				<td class="center bold"><?php echo $this->calculateGrade($per,$class_id);?></td>
				<?php if($rankcounter < 1){?>
			    <td rowspan ="<?php echo $subjectList->num_rows();?>">Class Rank: 1 <br> School Rank: 2</td>
			    <?php }?>
					<!--overall total & grade end-->
                </tr>
               
                    <?php 
                        
                     $rankcounter++;    endforeach;}
                        ?>
                        <tr>
                   <?php $this->subjectTotal($termColv,$class_id,$student_id,$fsd_id,$totalIndicator,$termTotal);?>
                </tr> 
                </table>
                 <div style=" width:95%; margin-left:auto; margin-right:auto;font-size: 14px;">
    	                <div style="width:50%; float:left;">
    						<!--scholar,mkd,bsd,spring SCHOLASTIC start-->
    	                        
    						 <?php $this->co_ScolasticGrade($per,$class_id,$fsd_id,$student_id,$school_code);?>   
    						 <?php $this->getAttendance($class_id,$fsd_id,$student_id);?>
    	                  
    	                </div>
    	
    	
    	
    	                <div style="width:50%; float:right;">
    					
    						<!--scholar,spring,mkd,bsd DISCIPLINE start-->
    						<?php $this->discipline($per,$class_id,$fsd_id,$student_id,$school_code);?>
    	                   <!--scholar,spring,mkd,bsd DISCIPLINE end-->
    				
    	                    <table style="width:70%; border:1px solid black; background-color:white;">
    	                        <tr> 
    								<!--bsd,spring,gyanodya,sarvodya remark start-->
    								<td>Remarks:&nbsp;&nbsp;&nbsp;&nbsp;<label><?php if($per>0){echo $gradecal =$this->remarks1($per,$class_id);} ?></label></td>
    								<!--bsd,spring,gyanodya,sarvodya remark end-->									
    																	
    	                        </tr>
    	                    </table>
    	
    	                </div>
    	                   
    	            </div>
                    
                    
               
               
                <div>
                    <?php $this->gradeTable();?>
                </div>
                
                <?php
               
                
}else{
    echo "Please create Exam Schedule First  ";
}
}

function remarks1($val,$classid){
								if($val >= 91 && $val < 101):
									return 'Outstanding';
								elseif($val >= 81 && $val < 91):
									return 'Excellent';
								elseif($val >= 71 && $val < 81):
									return 'Very Good';
								elseif($val >= 61 && $val < 71):
									return 'Good';
								elseif($val >= 51 && $val < 61):
									return 'Average';
								elseif($val >= 41 && $val < 51):
									return 'Fair';
								elseif($val >= 33 && $val < 41):
									return 'Marginal';
								else:
									return 'Poor';
								endif;
							}
							
function discipline($per,$class_id,$fsd_id,$student_id,$school_code){?>
                        <table style="width:90%; border:1px solid black;">
    						<tr>
    	                        <th colspan="3" style="text-transform: uppercase;"> Discipline</th>
    	                    </tr>
    						<tr>
    	                         <th style="text-transform: uppercase;"> Element </th>
    	                           <?php  $term = $this->db->query("select distinct (term) as trm from exam_name where school_code='$school_code'");
                                    if($term->num_rows()>0){
                                        foreach($term->result() as $trmv):?>
    	                            <th>TERM <?php echo $trmv->trm;?></th>
    	                            <?php endforeach;}?>
    	                        </tr>
    	                      <?php $displName = $this->db->query("select * from exam_decipline where school_code = '$school_code'");
    	                      foreach($displName->result() as $dName):?>
    	                       <tr>
    	                            <td><?php echo $dName->name;?></td>
    	                           <?php  foreach($term->result() as $trmv):
    	                               $getRecord =  $this->db->query("select * from exam_dicipline_marks where dmaster_id='$dName->id' and term ='$trmv->trm' and fsd ='$fsd_id' and student_id='$student_id' ");
    	                                ?>
    	                            <td><?php if($getRecord->num_rows()>0){echo $getRecord->grade;}else{
    	                                echo $this->co_scolastic($per,$class_id);
    	                            }?></td>
    	                            <?php endforeach;?>
    	                        </tr>
    	                        <?php endforeach;?>
    					
    	                      
    	                    </table>
    	                    <?php
}
	function co_scolastic($val,$classid){
								if($val > 80):
									return 'A';
								elseif($val >= 61  && $val < 81 ):
									return 'A';
								else:
									return 'B';
								endif;
							}
function co_ScolasticGrade($per,$class_id,$fsd_id,$student_id,$school_code){
    ?>
    <table style="width:90%; border:1px solid black;">
    						<tr>
    	                            <th colspan="3" style="text-transform: uppercase;">Co- SCHOLASTIC Area</th>
    	                      </tr>
    							<tr>
    	                            <th style="text-transform: uppercase;"> Activity </th>
    	                           <?php  $term = $this->db->query("select distinct (term) as trm from exam_name where school_code='$school_code'");
                                    if($term->num_rows()>0){
                                        foreach($term->result() as $trmv):?>
    	                            <th>TERM <?php echo $trmv->trm;?></th>
    	                            <?php endforeach;}?>
    	                        </tr>
    	                        <!-- Dynamic -->
    							 <?php $displName = $this->db->query("select * from exam_activity where school_code = '$school_code'");
    	                      foreach($displName->result() as $dName):?>
    	                       <tr>
    	                            <td><?php echo $dName->activiy_name;?></td>
    	                           <?php  foreach($term->result() as $trmv):
    	                               $getRecord =  $this->db->query("select * from exam_activity_marks where activity_id='$dName->id' and term ='$trmv->trm' and fsd ='$fsd_id' and student_id='$student_id' ");
    	                                ?>
    	                            <td><?php if($getRecord->num_rows()>0){echo $getRecord->grade;}else{
    	                                echo $this->co_scolastic($per,$class_id);
    	                            }?></td>
    	                            <?php endforeach;?>
    	                        </tr>
    	                        <?php endforeach;?>
    					
    	                      
    	                    </table>
<?php }

function getAttendance($class_id,$fsd_id,$student_id){?>
      <table style="width:70%; border:1px solid black; background-color:white;">
    	                        <tr>
    	                            <?php
    	                            $this->db->where("class_id",$class_id);
    								$dt=$this->db->get("school_attendance");
    							    $atotal=$dt->num_rows();
    								$this->db->where('id',$fsd_id);
    								$fsdval=$this->db->get('fsd')->row();
    								$this->db->where('a_date >=',$fsdval->finance_start_date);
    								$this->db->where('a_date <=',$fsdval->finance_end_date);
    								$this->db->where('stu_id',$student_id);
    								$this->db->where('attendance',0);
    								$row1=$this->db->get('attendance');
    								$absnt=$row1->num_rows();
    								$present =$atotal-$absnt;
    								?>
    							
    	                              <td><b>Attendance:&nbsp;&nbsp;&nbsp;&nbsp;<label><?php echo $present; ?>/<?php echo $atotal; ?></label></b></td>
    	                              
    	                        </tr>
    	                    </table><?php
}

function calculateGrade($val,$classid){
                                if($val >= 91 && $val < 101):
                                    return 'A1';
                                elseif($val >= 81 && $val < 91):
                                    return 'A2';
                                elseif($val >= 71 && $val < 81):
                                    return 'B1';
                                elseif($val >= 61 && $val < 71):
                                    return 'B2';
                                elseif($val >= 51 && $val < 61):
                                    return 'C1';
                                elseif($val >= 41 && $val < 51):
                                    return 'C2';
                                elseif($val >= 33 && $val < 41):
                                    return 'D';
                                else:
                                    return 'E';
                                endif;
                                
                            }
                            function remarks($val,$classid){
                                if($val >= 91 && $val < 101):
                                    return 'Excellent';
                                elseif($val >= 81 && $val < 91):
                                    return 'Very Good';
                                elseif($val >= 71 && $val < 81):
                                    return 'Good';
                                elseif($val >= 61 && $val < 71):
                                    return 'Good';
                                elseif($val >= 51 && $val < 61):
                                    return 'Progressive';
                                else:
                                    return 'Needs Improvement';
                                endif;
                                
                            }
                            
         function subjectTotal($termColv,$class_id,$student_id,$fsd,$totalIndicator,$termTotal){
        ?>
             <th>Subject Total</th>
                   <?php 
                   $grandcoltotal=0;
                   $grandallcoltotal=0;
                   foreach($termColv as $examCol):
                       $termctotal=0;
                       $termmtotal=0;
                                foreach($examCol->result() as $examName):
                                     //print_r($examName->id);
                                        $subtotget =   $this->db->query("select sum(exam_info.marks) as totmarks from exam_info join exam_max_subject on exam_max_subject.id = exam_info.exam_max_id where exam_max_subject.exam_id ='$examName->id' and  exam_max_subject.fsd='$fsd' and exam_max_subject.class_id ='$class_id' and exam_info.stu_id='$student_id' ");
                                        $subtotMax =   $this->db->query("select sum(exam_max_subject.max_m) as totmmmarks from exam_info join exam_max_subject on exam_max_subject.id = exam_info.exam_max_id where exam_max_subject.exam_id ='$examName->id' and  exam_max_subject.fsd='$fsd' and exam_max_subject.class_id ='$class_id' and exam_info.stu_id='$student_id' ");
                              
                              if($subtotget->num_rows()>0){
                                  $columnsubTotal = $subtotget->row()->totmarks;
                                  $grandcoltotal+=$columnsubTotal;
                                  $termctotal+=$columnsubTotal;
                                 
                              }else{
                                  $columnsubTotal="(N/A)";
                              }
                              if($subtotMax->num_rows()>0){
                                  $columnGTotal = $subtotMax->row()->totmmmarks;
                                  $grandallcoltotal+=$columnGTotal;
                                   $termmtotal+=$columnGTotal;
                              }else{
                                  $columnGTotal="(N/A)";
                              }
                              
                                if($totalIndicator ==1){
                                    echo '<th>'.$columnsubTotal." / ".$columnGTotal."</th>";
                                }else{
                                    echo '<th>'.$subtotget->row()->totmarks."</th>";
                                }
					            endforeach;
					             if($termTotal==1){
					                if($totalIndicator ==1){
                                    echo '<th>'.$termctotal." / ".$termmtotal."</th>";
                                    }else{
                                    echo '<th>'.$termctotal."</th>";
                                    } 
					            }
					            
							endforeach;
					?>
						<!--2 term exam nam end-->
                        <th style="text-transform: uppercase;"><?php   if($totalIndicator ==1){ echo $grandcoltotal." / ".$grandallcoltotal; }else{ echo $grandcoltotal;}?></th>
                        <th rowspan="1" style="text-transform: uppercase;">
                           <?php if($grandallcoltotal>0){ $per=round((($grandcoltotal*100)/$grandallcoltotal), 2);};
                             echo $this->calculateGrade($per,$class_id);?></th>
                        <th rowspan="1" style="text-transform: uppercase;"></th><?php
        }      
        
        function gradeTable(){
            ?>
             <div>
    	                <center><b><label style="text-transform: uppercase;font-size: 14px; ">Instructions</label></b></center>
    	                <center><label style="font-size: 14px;">Grading Scale For Scholastic areas:Grades are awarded on a 8-point Grading Scale as Follows-</label></center>
    	            </div>
    	    <div>        
             <table style="width:95%;  margin-left:auto; margin-right:auto; border:1px solid black; background-color:white;font-size: 14px;">
    						<thead> 
    							<tr style="background-color: orange;">
    								<th>MARKS RANGE </th>
    								<th>GRADE</th>
    							
    								<!--<th>INDICATOR</th>-->
    							
    							</tr>
    						</thead>
    						<tbody>
    	                    <!-- Dynamic -->
    						<!--for scholar & mkd grade chart start-->
    	                    
    						<!--for bsd,spring grade chart start-->
    	                    <tr>
    	                        <td>91-100</td>
    	                        <td>A1</td>
    							<!--<td>Outstanding</td>-->
    	                    </tr>
    	                    <tr>
    	                        <td>81-90</td>
    	                        <td>A2</td>
    							<!--<td>Excellent</td>-->
    	                    </tr>
    	                    <tr>
    	                        <td>71-80</td>
    	                        <td>B1</td>
    							<!--<td>Very Good</td>-->
    	                    </tr>
    	                    <tr>
    	                        <td>61-70</td>
    	                        <td>B2</td>
    							<!--<td>Good</td>-->
    	                    </tr>
    	                    <tr>
    	                        <td>51-60</td>
    	                        <td>C1</td>
    							<!--<td>Average</td>-->
    	                    </tr>
    	                     <tr>
    	                        <td>41-50</td>
    	                        <td>C2</td>
    							<!--<td>Fair</td>-->
    	                    </tr>
    	                     <tr>
    	                        <td>33-40</td>
    	                        <td>D1</td>
    							<!--<td>Marginal</td>-->
    	                    </tr>
    	                     <tr>
    	                        <td>32 & Below</td>
    	                        <td>D2</td>
    							<!--<td>Poor</td>-->
    	                    </tr>
    						<!--for bsd,spring grade chart end-->
    	                   
    						</tbody>
    	                </table> 
    	           </div>      
            <?php
        }
                            
        function examFsdCopy(){
           $exam_name =  $this->db->get("exam_max_subject");
           foreach($exam_name->result() as $examDetails):
               echo $examDetails->exam_id;
               echo "p".$examDetails->class_id;
               echo "m".$examDetails->subject_id."<br>";
              $getfsdAndTerm =  $this->db->query("select distinct(fsd),term,sub_type from exam_info where exam_id = '$examDetails->exam_id' and class_id ='$examDetails->class_id' and subject_id ='$examDetails->subject_id'");
              //print_r($getfsdAndTerm->result());
             $i=0; foreach($getfsdAndTerm->result() as $csv):
                  if($csv->fsd >0 ){
                      if($i>0){
                        $insertMaxData['fsd']=$csv->fsd;
                        $insertMaxData['term']=$csv->term;
                        $insertMaxData['sub_type']=$csv->sub_type;
                        $insertMaxData['exam_id']=$examDetails->exam_id;
                        $insertMaxData['class_id']=$examDetails->class_id;
                        $insertMaxData['subject_id']=$examDetails->subject_id;
                        $insertMaxData['max_m']=$examDetails->max_m;
                        $this->db->insert("exam_max_subject",$insertMaxData);
                        //echo "insert";
                      }else{
                $updateMaxData['fsd']=$csv->fsd;
                $updateMaxData['term']=$csv->term;
                $updateMaxData['sub_type']=$csv->sub_type;
                $this->db->where("id",$examDetails->id);
                $this->db->update("exam_max_subject",$updateMaxData);
                 //echo "update";
                  }}
           $i++; endforeach;
            
               endforeach;
            
        }    
        
        function updateExamInfo(){
           $getexamInfo= $this->db->get("exam_max_subject");
           foreach($getexamInfo->result() as $ei):
              $updateDid['exam_max_id']= $ei->id;
            $this->db->where("exam_id",$ei->exam_id);
            $this->db->where("subject_id",$ei->subject_id);
            $this->db->where("class_id",$ei->class_id);
            $this->db->where("fsd",$ei->fsd);
            $this->db->where("term",$ei->term);
            $getid = $this->db->update("exam_info",$updateDid);
            endforeach;
            
        }
        
       

}