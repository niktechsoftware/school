
<?php
class SmsAjax extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->is_login();
		$this->load->model("smsmodel");
		$this->load->model("employeemodel");
		}
		
		function is_login(){
			$is_login = $this->session->userdata('is_login');
			$is_lock = $this->session->userdata('is_lock');
			$logtype = $this->session->userdata('login_type');
			if(($logtype == 1)){
			}else{

			if($logtype != "admin"){
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
		}
	
	function smsSetting(){
		$msg = $this->input->post("message");
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$val = $this->db->get("sms")->row();
		
		$val1 = $val->$msg;
		
		if($val1){
			$data = array(
				"$msg" => 0
			);
			?>
				<script>
					$("#<?php echo $msg;?>").removeClass("btn btn-sm btn-light-green").addClass("btn btn-sm btn-light-red");
					$("#<?php echo $msg;?>").removeClass("fa fa-check").addClass("fa fa-times fa fa-white");
					$("#<?php echo $msg;?>").html(" NO");
				</script>
			<?php
		}else{
			$data = array(
				"$msg" => 1
			);
			?>
				<script>
					$("#<?php echo $msg;?>").removeClass("btn btn-sm btn-light-red").addClass("btn btn-sm btn-light-green");
					$("#<?php echo $msg;?>").removeClass("fa fa-times fa fa-white").addClass("fa fa-check");
					$("#<?php echo $msg;?>").html(" YES");
				</script>		
			<?php
		}
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->update("sms",$data);
	}
	
	function sendNotice(){
	$count=0;
		$smsc =0;
		$smscount=0;
		$school=$this->session->userdata("school_code");
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		$sende_Detail =$sender->row();
		print_r($sende_Detail);
		$msg =	$this->input->post("meg");
	
		$fmobile1 = $this->input->post("m_number");
		$str_arr=explode(",",$fmobile1);
		$totnumb =  sizeof($str_arr);
		$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		$master_id=$max_id->maxid+1;
		
		$fmobile = $this->smsmodel->getMobile($str_arr,$msg,$master_id,1);
	
				if($this->input->post("language")==1){
				  $getv=  mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				  
				}else{
				  $getv= mysmsHindi($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				     }	
		 $this->smsmodel->sentmasterRecord($msg,$totnumb,$master_id,$getv);
			

			redirect("index.php/login/mobileNotice/Notice");
		
}

			function sendallParent(){
		$smscount=0;
		$count=0;
		$smsc =0;
		$totsmssent = $this->input->post("totsmsv");
		$totbal = $this->input->post("totbal");
	
		if($totbal > $totsmssent){
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		if($sender->num_rows()>0){
		$sende_Detail =$sender->row();
		$msg =$this->input->post("meg");
		
		$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		$master_id=$max_id->maxid+1;
		$query = $this->smsmodel->getAllFatherNumber($this->session->userdata("school_code"));
		$isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
		$fmobile=$this->session->userdata("mobile_number");
		if($isSMS->parent_message)
		{
		if($query->num_rows() > 0)

		{   $totnumb=$query->num_rows();
		    $i=1;	$fmobile = $this->smsmodel->getMobile($query->result(),$msg,$master_id,2);
				if($this->input->post("language")==1){
				  $getv=  mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				  

				}else{
				  $getv= mysmsHindi($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				     }	
		        $this->smsmodel->sentmasterRecord($msg,$totnumb,$master_id,$getv);

			}
			redirect("index.php/login/mobileNotice/Parent%20Message/$count");
		}
		
		else{
			$data['subPage'] = 'Mobile Message And Notice';
			$data['title'] = 'Mobile Message And Notice';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'norecordFound';
			$this->load->view("includes/mainContent", $data);
		} 
	}else{
	    	redirect("index.php/login/mobileNotice/Parent%20Message/$count/7");
	   // echo "this message already sent for resend  plz try after some time ";
	}	}else{ ?>
	    <script>alert("You have not sufficient Balance Please Contact Admin or purchase. SMS not sent");</script>
	    <?php 
	     redirect("index.php/login/mobileNotice/Parent%20Message/$count/9");
	}
	}
	
	
	function sendAnnuncement(){
		$smscount=0;
		$count=0;
		$smsc =0;
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		if($sender){
		$sende_Detail =$sender->row();
		$msg =$this->input->post("meg");
		
		$totsmssent = $this->input->post("totsmsv");
		$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		$master_id=$max_id->maxid+1;
	
		$employee = $this->employeemodel->employeeList($this->session->userdata("school_code"));
	
		$isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
		
		if($isSMS->announcement)
		{ 
	
		    $totnumb=$employee->num_rows();
		    $i=1;	$fmobile = $this->smsmodel->getMobile($employee->result(),$msg,$master_id,2);
	
				if($this->input->post("language")==1){

				  $getv=  mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				  
				}else{
				  $getv= mysmsHindi($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				     }	
		        $this->smsmodel->sentmasterRecord($msg,$totnumb,$master_id,$getv);
			
			redirect("index.php/login/mobileNotice/Announcement/$count/7");
		}
		else{
		    	$data['pageTitle'] = 'SMS Panel';
		$data['smallTitle'] = 'Mobile SMS error in table';
		$data['mainPage'] = 'SMS Panel Area';
			$data['subPage'] = 'Mobile Message And Notice';
			$data['title'] = 'Mobile Message And Notice';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'error';
			$this->load->view("includes/mainContent", $data);
		}
	
		}
	else{
	    	$data['subPage'] = 'Mobile Message And Notice';
			$data['title'] = 'Sender ID Not Approved Error Please Contact Administrator';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'error';
			$this->load->view("includes/mainContent", $data);
	}
	
		    
	}	
	
	function sendGreeting(){
		$smscount=0;
		$count=0;
		$smsc =0;
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		if($sender){
		$sende_Detail =$sender->row();
		
		$msg =$this->input->post("meg");
	
		$totsmssent = $this->input->post("totsmsv");
		$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		$master_id=$max_id->maxid+1;
		$employee = $this->employeemodel->employeeList($this->session->userdata("school_code"));
		$query = $this->smsmodel->getAllFatherNumber($this->session->userdata("school_code"));
		$isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
    	$fmobile1=$this->session->userdata("mobile_number");
		if($isSMS->greeting)
		{  
			
		    $totnumb=$employee->num_rows();
		    $i=1;	$fmobile = $this->smsmodel->getMobile($employee->result(),$msg,$master_id,2);
	
				if($this->input->post("language")==1){

				  $getv=  mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				  
				}else{
				  $getv= mysmsHindi($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				     }	
		        $this->smsmodel->sentmasterRecord($msg,$totnumb,$master_id,$getv);
				$master_id =$master_id+1;
		
			 $totnumb=$query->num_rows();
		    $i=1;	$fmobile = $this->smsmodel->getMobile($query->result(),$msg,$master_id,2);
	
				if($this->input->post("language")==1){
				  $getv=  mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				  
				}else{
				  $getv= mysmsHindi($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				     }	
		        $this->smsmodel->sentmasterRecord($msg,$totnumb,$master_id,$getv);

		redirect("index.php/login/mobileNotice/Greeting/$count");
			}	else{
			    	$data['pageTitle'] = 'SMS Panel';
					$data['smallTitle'] = 'Mobile SMS';
					$data['mainPage'] = 'SMS Panel Area';
				$data['subPage'] = 'Mobile Message And Notice';
				$data['title'] = 'Mobile Message And Notice';
				$data['headerCss'] = 'headerCss/noticeCss';
				$data['footerJs'] = 'footerJs/noticeJs';
				$data['mainContent'] = 'norecordFound';
				$this->load->view("includes/mainContent", $data);
			}
			//echo $fmobile;
		
	
		}
		redirect("index.php/login/mobileNotice/Greeting/$count");
	}
	function classwise(){	
		$smscount=0;
		$count=0;
		$smsc =0;
		$fmobile=0;
		$class_id = $this->input->post("class");
	//	$section_id = $this->input->post("section");
	
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		if($sender->num_rows()>0){
		$sende_Detail =$sender->row();
		$msg =$this->input->post("meg");
		
		$totsmssent = $this->input->post("totsmsv");
		$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		$master_id=$max_id->maxid+1;
	
		$isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
		$fmobile=$this->session->userdata("mobile_number");
		if($isSMS->parent_message)
		{
			$query = $this->smsmodel->getClassFatherNumber($this->session->userdata("school_code"),$class_id);
		if($query->num_rows() > 0)
		{   
		 $totnumb=$query->num_rows();
		    $i=1;	$fmobile = $this->smsmodel->getMobile($query->result(),$msg,$master_id,2);
	
				if($this->input->post("language")==1){

				  $getv=  mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				  
				}else{
				  $getv= mysmsHindi($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				     }	
		        $this->smsmodel->sentmasterRecord($msg,$totnumb,$master_id,$getv);
		}
			redirect("index.php/login/mobileNotice/classwise/$totsmssent");
		
		}
		else{	$data['pageTitle'] = 'SMS Panel';
		$data['smallTitle'] = 'Mobile SMS';
		$data['mainPage'] = 'SMS Panel Area';
			$data['subPage'] = 'Mobile Message And Notice';
			$data['title'] = 'Mobile Message And Notice';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'norecordFound';
			$this->load->view("includes/mainContent", $data);
		
		}
	redirect("index.php/login/mobileNotice/classwise/$count");
	
	
		}else
		{	$data['pageTitle'] = 'SMS Panel';
		$data['smallTitle'] = 'Mobile SMS';
		$data['mainPage'] = 'SMS Panel Area';
			$data['subPage'] = 'Mobile Message And Notice';
			$data['title'] = 'Mobile Message And Notice';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'Error';
			$this->load->view("includes/mainContent", $data);
		}
	   
	}
	
	function transportwise(){	
		$smscount=0;
		$count=0;
		$smsc =0;
		$vehicle_id = $this->input->post("vehicle");
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		if($sender->num_rows()>0){
		$sende_Detail =$sender->row();
		$msg =	$this->input->post("meg");
		
		$totsmssent = $this->input->post("totsmsv");
		$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		$master_id=$max_id->maxid+1;
	
		if($isSMS->parent_message)
		{
		  $query = $this->smsmodel->getTransportFatherNumber($vehicle_id);
	    if($query->num_rows() > 0)
	     	{   
	     	
            $totnumb=$query->num_rows();
		    $i=1;	$fmobile = $this->smsmodel->getMobile($query->result(),$msg,$master_id,2);
	
				if($this->input->post("language")==1){
				  $getv=  mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				  
				}else{
				  $getv= mysmsHindi($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				     }	
		        $this->smsmodel->sentmasterRecord($msg,$totnumb,$master_id,$getv);
		}
		redirect("index.php/login/mobileNotice/transportwise/$count");
	    }
		else{	
			$data['pageTitle'] = 'SMS Panel';
			$data['smallTitle'] = 'Mobile SMS';
			$data['mainPage'] = 'SMS Panel Area';
			$data['subPage'] = 'Mobile Message And Notice';
			$data['title'] = 'Mobile Message And Notice';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'norecordFound';
			$this->load->view("includes/mainContent", $data);
		
		}
	
	redirect("index.php/login/mobileNotice/transportwise/$count");
	
		}else
		{	
			$data['pageTitle'] = 'SMS Panel';
			$data['smallTitle'] = 'Mobile SMS';
			$data['mainPage'] = 'SMS Panel Area';
			$data['subPage'] = 'Mobile Message And Notice';
			$data['title'] = 'Mobile Message And Notice';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'Error';
			$this->load->view("includes/mainContent", $data);
		}
	   
	}
	
	function smsPanel(){
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"))->row();
		
		$data['sender_Detail'] =$sender;
		$data['cbs']=checkBalSms($sender->uname,$sender->password);
		$data['pageTitle'] = 'SMS Panel';
		$data['smallTitle'] = 'Mobile SMS';
		$data['mainPage'] = 'SMS Panel Area';
		$data['subPage'] = 'SMS Panel';
		$data['title'] = 'SMS Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'smsPanel';
		$this->load->view("includes/mainContent", $data);
	}	
	function updatesms_status(){
				 $msg=	$this->input->post("msgid");
				 
				$school_code =$this->session->userdata("school_code");
				$this->db->where("school_code",$school_code);
			  $msgdata=$this->db->get("sms_setting");
			  	if($msgdata->num_rows()>0){
						$sender_detail=$msgdata->row();
						$username=$sender_detail->uname;
						$password=$sender_detail->password;
						
						$dt=checkDeliver($username,$password,$msg);
						echo $dt;
				}


	}
	function viewsmsdetail(){
			$data['pageTitle'] = 'View SMS Report';
		$data['smallTitle'] = 'View SMS Report';
		$data['mainPage'] = 'View SMS Report';
		$data['subPage'] = 'View SMS Report';
		$data['title'] = 'View SMS Report ';
		$data['headerCss'] = 'headerCss/smsCss';
		$data['footerJs'] = 'footerJs/smsJs';
		$data['mainContent'] = 'viewsmsdetail';
		$this->load->view("includes/mainContent", $data);
	}	
	function wrongsmsdetail(){
		$data['pageTitle'] = 'View SMS Report';
		$data['smallTitle'] = 'View SMS Report';
		$data['mainPage'] = 'View SMS Report';
		$data['subPage'] = 'View SMS Report';
		$data['title'] = 'View SMS Report ';
		$data['headerCss'] = 'headerCss/smsCss';
		$data['footerJs'] = 'footerJs/smsJs';
		$data['mainContent'] = 'wrongsmsdetail';
		$this->load->view("includes/mainContent", $data);
}

}