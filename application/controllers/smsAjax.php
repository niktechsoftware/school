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
		
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		$sende_Detail =$sender;
		//print_r($sende_Detail->row()->password);exit;
     	$sende_Detail1=	$sende_Detail->row();
		$msg =	$this->input->post("meg");
		
		//print_r($msg);exit;
		$fmobile = $this->input->post("m_number");
		if($this->input->post("language")==1){
			 $getv =  sms($fmobile,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
		}else{
			$getv =  smshindi($fmobile,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
			
		}
			
			$a[]=0;
			foreach ($getv as $key => $rowValue) {
				
							$data=array(
								'sent_number'=>$rowValue['sent_number'],
								'msg_id'=>$rowValue['msg_id'],
								'status'=>$rowValue['status'],
								'sms'=>$rowValue['sms'],
								'date'=>$rowValue['date'],
								'school_code'=>$this->session->userdata("school_code")

							);
						$insertdata=	$this->db->insert("sent_sms_details",$data);
						if($insertdata){
								redirect("index.php/login/mobileNotice/Notice");
						}
						else{
							redirect("index.php/login/mobileNotice/Notice");
						}
							// $data=array(

							// );
						// 	$data=array(
						// 	'sent_number'=> $rowValues
						// 	// 'sent_number'=>[$key][$rowValues],
						// 	// 'sent_number'=>[$key][$rowValues],
						// );
					//	echo "<br>";
						//print_r($data);
				//}
		
			//	$values[] = "(" . implode(', ', $rowValues) . ")";
		}
			
		
		}
	
		else{
			echo smshindi($fmobile,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
		

		}
	
	}
	
	
	function sendallParent(){
		$smscount=0;
		$count=0;
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		if($sender->num_rows()>0){
		$sende_Detail =$sender->row();
		$msg =$this->input->post("meg");
		$query = $this->smsmodel->getAllFatherNumber($this->session->userdata("school_code"));
		$isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
		$fmobile=$this->session->userdata("mobile_number");
		if($isSMS->parent_message)
		{
		if($query->num_rows() > 0)
		{   
		if($fmobile){
			foreach($query->result() as $parentmobile):
			if($parentmobile->mobile){
			
			if($smscount<90){
				$fmobile =$fmobile.",".$parentmobile->mobile;
				$count=$count+1;
				$smscount++;
			}else{
				if($this->input->post("language")==1){
			$getv=	sms($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			}else{
				$getv = smshindi($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			}	
			$a[]=0;
				foreach ($getv as $key => $rowValue) {
				
								$data=array(
									'sent_number'=>$rowValue['sent_number'],
									'msg_id'=>$rowValue['msg_id'],
									'status'=>$rowValue['status'],
									'sms'=>$rowValue['sms'],
									'date'=>$rowValue['date'],
									'school_code'=>$this->session->userdata("school_code")
	
								);
								$this->db->insert("sent_sms_details",$data);
							
			}
				
			
				$fmobile="8382829593";
				$smscount=0;
			}
			
			}
			endforeach;
			}
			if($this->input->post("language")==1){
				$getv=sms($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
				}else{
					$getv= smshindi($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
				}
				
				$a[]=0;
				foreach ($getv as $key => $rowValue) {
				
								$data=array(
									'sent_number'=>$rowValue['sent_number'],
									'msg_id'=>$rowValue['msg_id'],
									'status'=>$rowValue['status'],
									'sms'=>$rowValue['sms'],
									'date'=>$rowValue['date'],
									'school_code'=>$this->session->userdata("school_code")
	
								);
								$this->db->insert("sent_sms_details",$data);
							
			}
			
		
		}
		else{
			$data['subPage'] = 'Mobile Message And Notice';
			$data['title'] = 'Mobile Message And Notice';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'norecordFound';
			$this->load->view("includes/mainContent", $data);
		}
		}
		redirect("index.php/login/mobileNotice/Parent%20Message/$count");
	}else
		{
			$data['subPage'] = 'Mobile Message And Notice';
			$data['title'] = 'Mobile Message And Notice';
			$data['headerCss'] = 'headerCss/noticeCss';
			$data['footerJs'] = 'footerJs/noticeJs';
			$data['mainContent'] = 'error';
			$this->load->view("includes/mainContent", $data);
		}
	}
	
	function sendAnnuncement(){
		$smscount=0;
		$count=0;
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		if($sender){
		$sende_Detail =$sender->row();
		$msg =$this->input->post("meg");
		$employee = $this->employeemodel->employeeList($this->session->userdata("school_code"));
	
		$isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
		
		$fmobile=$this->session->userdata("mobile_number");
		if($isSMS->announcement)
		{ 
			if($fmobile){
			foreach($employee->result() as $empmob):
			if($empmob->mobile){
			if($smscount<90){
				$fmobile =$fmobile.",".$empmob->mobile;
				$count=$count+1;
				$smscount++;
			}else{
				if($this->input->post("language")==1){
			$getv=	sms($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			}else{
				$getv= smshindi($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			}	
			$a[]=0;
				foreach ($getv as $key => $rowValue) {
				
								$data=array(
									'sent_number'=>$rowValue['sent_number'],
									'msg_id'=>$rowValue['msg_id'],
									'status'=>$rowValue['status'],
									'sms'=>$rowValue['sms'],
									'date'=>$rowValue['date'],
									'school_code'=>$this->session->userdata("school_code")
	
								);
								$this->db->insert("sent_sms_details",$data);
							
			}
			
			$fmobile="8382829593";
				$smscount=0;
			}
			
			}
			endforeach;
			}
			if($this->input->post("language")==1){
				$getv=sms($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
				}else{
				$getv=	smshindi($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
				}
				
				$a[]=0;
				foreach ($getv as $key => $rowValue) {
				
								$data=array(
									'sent_number'=>$rowValue['sent_number'],
									'msg_id'=>$rowValue['msg_id'],
									'status'=>$rowValue['status'],
									'sms'=>$rowValue['sms'],
									'date'=>$rowValue['date'],
									'school_code'=>$this->session->userdata("school_code")
	
								);
								$this->db->insert("sent_sms_details",$data);
							
			}
			
			
			redirect("index.php/login/mobileNotice/Announcement/$count");
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
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		if($sender){
		$sende_Detail =$sender->row();
		
		$msg =$this->input->post("meg");
		
		
		$employee = $this->employeemodel->employeeList($this->session->userdata("school_code"));
		$query = $this->smsmodel->getAllFatherNumber($this->session->userdata("school_code"));
		$isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
		
		$fmobile=$this->session->userdata("mobile_number");
		if($isSMS->greeting)
		{
			if($fmobile){
			foreach($employee->result() as $empmob):
			if($empmob->mobile){
			
			if($smscount<90){
				$fmobile =$fmobile.",".$empmob->mobile;
				$count=$count+1;
				$smscount++;
			}else{if($this->input->post("language")==1){
				$getv=sms($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
				}else{
				$getv=	smshindi($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
				}
				
				$a[]=0;
				foreach ($getv as $key => $rowValue) {
				
								$data=array(
									'sent_number'=>$rowValue['sent_number'],
									'msg_id'=>$rowValue['msg_id'],
									'status'=>$rowValue['status'],
									'sms'=>$rowValue['sms'],
									'date'=>$rowValue['date'],
									'school_code'=>$this->session->userdata("school_code")
	
								);
								$this->db->insert("sent_sms_details",$data);
							
			}
			$fmobile="8382829593";
				$smscount=0;
			}
			
			}
			endforeach;
			}
			if($this->input->post("language")==1){
				$getv=sms($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
				}else{
				$getv=	smshindi($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
				}
				
				$a[]=0;
				foreach ($getv as $key => $rowValue) {
				
								$data=array(
									'sent_number'=>$rowValue['sent_number'],
									'msg_id'=>$rowValue['msg_id'],
									'status'=>$rowValue['status'],
									'sms'=>$rowValue['sms'],
									'date'=>$rowValue['date'],
									'school_code'=>$this->session->userdata("school_code")
	
								);
								$this->db->insert("sent_sms_details",$data);
							
			}
			if($fmobile){
				foreach($query->result() as $parentmobile):
				if($parentmobile->mobile){
						
					if($smscount<90){
						$fmobile =$fmobile.",".$parentmobile->mobile;
						$count=$count+1;
						$smscount++;
					}else{
						if($this->input->post("language")==1){
						$getv=	sms($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
						}else{
						$getv=	smshindi($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
						}	
						$a[]=0;
							foreach ($getv as $key => $rowValue) {
							
											$data=array(
												'sent_number'=>$rowValue['sent_number'],
												'msg_id'=>$rowValue['msg_id'],
												'status'=>$rowValue['status'],
												'sms'=>$rowValue['sms'],
												'date'=>$rowValue['date'],
												'school_code'=>$this->session->userdata("school_code")
				
											);
											$this->db->insert("sent_sms_details",$data);
										
						}
						
						$fmobile="8382829593";
						$smscount=0;
					}
						
				}
				endforeach;
			}//print_r($count);exit();
			if($this->input->post("language")==1){
			$getv=	sms($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			}else{
			$getv=	smshindi($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			}	
			
			$a[]=0;
				foreach ($getv as $key => $rowValue) {
				
								$data=array(
									'sent_number'=>$rowValue['sent_number'],
									'msg_id'=>$rowValue['msg_id'],
									'status'=>$rowValue['status'],
									'sms'=>$rowValue['sms'],
									'date'=>$rowValue['date'],
									'school_code'=>$this->session->userdata("school_code")
	
								);
								$this->db->insert("sent_sms_details",$data);
							
			}
				
			
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
			//echo $fmobile;
		}
		redirect("index.php/login/mobileNotice/Greeting/$count");
	}
	function classwise(){	
		$smscount=0;
		$count=0;
		$class_id = $this->input->post("class");
	//	$section_id = $this->input->post("section");
	
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		if($sender->num_rows()>0){
		$sende_Detail =$sender->row();
		$msg =	$this->input->post("meg");
		$isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
		
		$fmobile=$this->session->userdata("mobile_number");
		if($isSMS->parent_message)
		{
			
				$query = $this->smsmodel->getClassFatherNumber($this->session->userdata("school_code"),$class_id);
				
		
			
		if($query->num_rows() > 0)
		{   
		if($fmobile){
			foreach($query->result() as $parentmobile):
			if($parentmobile->mobile){
			
			if($smscount<90){
				$fmobile =$fmobile.",".$parentmobile->mobile;
				$count=$count+1;
				$smscount++;
			}else{
				if($this->input->post("language")==1){
			$getv=	sms($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			}else{
			$getv=	smshindi($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			}	
			$a[]=0;
				foreach ($getv as $key => $rowValue) {
				
								$data=array(
									'sent_number'=>$rowValue['sent_number'],
									'msg_id'=>$rowValue['msg_id'],
									'status'=>$rowValue['status'],
									'sms'=>$rowValue['sms'],
									'date'=>$rowValue['date'],
									'school_code'=>$this->session->userdata("school_code")
	
								);
								$this->db->insert("sent_sms_details",$data);
							
			}
			
			$fmobile="8382829593";
			//echo 	$fmobile;
				$smscount=0;
			}
			
			}
			endforeach;
			}
			//echo $fmobile;
			if($this->input->post("language")==1){
			$getv=	sms($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			}else{
			$getv=	smshindi($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			}
			
			$a[]=0;
				foreach ($getv as $key => $rowValue) {
				
								$data=array(
									'sent_number'=>$rowValue['sent_number'],
									'msg_id'=>$rowValue['msg_id'],
									'status'=>$rowValue['status'],
									'sms'=>$rowValue['sms'],
									'date'=>$rowValue['date'],
									'school_code'=>$this->session->userdata("school_code")
	
								);
								$this->db->insert("sent_sms_details",$data);
							
			}
			
		
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
		
		}}
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
		$vehicle_id = $this->input->post("vehicle");
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
		if($sender->num_rows()>0){
		$sende_Detail =$sender->row();
		$msg =	$this->input->post("meg");
		$isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
		$fmobile=$this->session->userdata("mobile_number");
		if($isSMS->parent_message)
		{
		  $query = $this->smsmodel->getTransportFatherNumber($vehicle_id);
	    if($query->num_rows() > 0)
	     	{   
	     	if($fmobile){
			foreach($query->result() as $parentmobile):
			if($parentmobile->mobile){
			// print_r($parentmobile->mobile);
			// exit();
			 if($smscount<90){
				$fmobile =$fmobile.",".$parentmobile->mobile;
			// 	print_r($fmobile);
			// exit();
				$count=$count+1;
				$smscount++;
			 }else{
			 if($this->input->post("language")==1){
			$getv=	sms($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			}else{
				$getv=smshindi($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			}
				$a[]=0;
				foreach ($getv as $key => $rowValue) {
				
								$data=array(
									'sent_number'=>$rowValue['sent_number'],
									'msg_id'=>$rowValue['msg_id'],
									'status'=>$rowValue['status'],
									'sms'=>$rowValue['sms'],
									'date'=>$rowValue['date'],
									'school_code'=>$this->session->userdata("school_code")
	
								);
								$this->db->insert("sent_sms_details",$data);
							
			}
				$fmobile="8382829593";
			   echo $fmobile;
				$smscount=0;
			}
			
			 }
			endforeach;
			}
			
			 $fmobile;
	     	 if($this->input->post("language")==1){
			$getv=	sms($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			}else{
				$getv=smshindi($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			}
			
			$a[]=0;
			foreach ($getv as $key => $rowValue) {
			
							$data=array(
								'sent_number'=>$rowValue['sent_number'],
								'msg_id'=>$rowValue['msg_id'],
								'status'=>$rowValue['status'],
								'sms'=>$rowValue['sms'],
								'date'=>$rowValue['date'],
								'school_code'=>$this->session->userdata("school_code")

							);
							$this->db->insert("sent_sms_details",$data);
						
		}
			//exit;
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
						$this->db->where("sms",$msg);
						$msgdata=$this->db->get("sent_sms_details");
						if($msgdata->num_rows()>0){
							foreach($msgdata->result() as $row):
								$msg_id=$row->msg_id;
						$dt=checkDeliver($username,$password,$msg_id);
						$arr =array(
							'status' =>$dt
						);
						$this->db->where("msg_id",$msg_id);
						$updatedata=$this->db->update("sent_sms_details",$arr);
				if($updatedata){
					

				} endforeach; echo "Updated"; }

				}


	}

	function viewsmsdetail(){
		$msg=$this->uri->segment(3);
		
		$data['msg'] =$msg;
	
		$data['pageTitle'] = 'View SMS Report';
		$data['smallTitle'] = 'View SMS Report';
		$data['mainPage'] = 'View SMS Report';
		$data['subPage'] = 'View SMS Report';
		$data['title'] = 'View SMS Report ';
		$data['headerCss'] = 'headerCss/studentListCss';
		$data['footerJs'] = 'footerJs/simpleStudentListJs';
		$data['mainContent'] = 'viewsmsdetail';
		$this->load->view("includes/mainContent", $data);
	}	
}