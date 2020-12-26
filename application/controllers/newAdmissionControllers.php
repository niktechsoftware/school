<?php class newAdmissionControllers extends CI_Controller{
    
    	function __construct(){
		parent::__construct();
			$this->is_login();
		
	}
		function is_login(){
		$is_login = $this->session->userdata('is_login');
	
		if(($is_login != true)){
			
			redirect("index.php/homeController/index");
		}
	
	}
	
	public function addinfo(){
		$school_code = $this->session->userdata("school_code");
		$id1 = $this->db->query("SELECT MAX(maxcount) as maxnumber From guardian_info where school_code =$school_code");
		 if($id1->num_rows()>0){
		$id = $id1->row()->maxnumber;
		}else{
		$id=0;
	    }
        $db=$this->db->get('db_name')->row()->name;
		$maxusername=$id+1;
		$id1 = 4000+$maxusername;
		$id= $db.$school_code.'S'.$id1;
		
		$this->form_validation->set_error_delimiters('<div class="col-sm-12"><label class="text-danger">', '</label></div>');
		$this->form_validation->set_rules('scholerNumber','Scholar Number', 'trim|required');
		$this->form_validation->set_rules('dateOfAdmission','Date Of Admission', 'trim|required');
		$this->form_validation->set_rules('firstName','Name', 'trim|required');
		//$this->form_validation->set_rules('middleName','Middle Name', 'trim');
		//$this->form_validation->set_rules('lastName','Last Name', 'trim|required');
		$this->form_validation->set_rules('dob','Date of birth', 'trim|required');
		$this->form_validation->set_rules('classOfAdmission','Class of Admission', 'trim|required');
		$this->form_validation->set_rules('section','Section', 'trim|required');
		$this->form_validation->set_rules('gender','Gende', 'trim');
		$this->form_validation->set_rules('bloodGroup','', 'trim');
		$this->form_validation->set_rules('birthPlace','', 'trim');
		$this->form_validation->set_rules('nationality','', 'trim');
		$this->form_validation->set_rules('mothertongue','', 'trim');
		$this->form_validation->set_rules('category','', 'trim');
		$this->form_validation->set_rules('religion','religion', 'trim');
		$this->form_validation->set_rules('addLine1','Address', 'trim|required');
		$this->form_validation->set_rules('addLine2','Area', 'trim|required');
		$this->form_validation->set_rules('city','City', 'trim|required');
		$this->form_validation->set_rules('state','State', 'trim|required');
		$this->form_validation->set_rules('country','Country', 'trim|required');
		//$this->form_validation->set_rules('phonenumbar','', 'trim|numeric');
		$this->form_validation->set_rules('mobileNumber','Mobile Number', 'trim|required|numeric');
		$this->form_validation->set_rules('emailAddress','', 'trim|valid_email');
		$this->form_validation->set_rules('password','Password', 'trim|required');
		$this->form_validation->set_rules('password_again','Re-Password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('fatherName','Father Name', 'trim|required');
		$this->form_validation->set_rules('motherName','Mother Name', 'trim|required');
		$this->form_validation->set_rules('guardianName','', 'trim');
		$this->form_validation->set_rules('guardianRelation','', 'trim');
		$this->form_validation->set_rules('motherEducation','', 'trim');
		$this->form_validation->set_rules('fatherEducation','', 'trim');
		$this->form_validation->set_rules('fatherOccupation','', 'trim');
		$this->form_validation->set_rules('motherOccupation','', 'trim');
		$this->form_validation->set_rules('familyAnnualIncome','', 'trim');
		$this->form_validation->set_rules('parentAddress','Address', 'trim|required');
		$this->form_validation->set_rules('parentCity','City', 'trim|required');
		$this->form_validation->set_rules('parentState','State', 'trim|required');
		$this->form_validation->set_rules('parentPin','Pin', 'trim|required|numeric');
		$this->form_validation->set_rules('parentCountry','Country', 'trim|required');
		$this->form_validation->set_rules('fatherMobileNumber','Mo', 'trim|numeric');
		$this->form_validation->set_rules('motherMobileNumber','', 'trim|required|numeric');
		$this->form_validation->set_rules('fatherEmailAddress','', 'trim|valid_email');
		$this->form_validation->set_rules('motherEmailAddress','', 'trim|valid_email');
		
		if($this->form_validation->run() == FALSE){
			$this->newAdmission();
		}
		
	 if($this->input->post("discount")==1 || $this->input->post("discount")==2 || $this->input->post("discount")==3 || $this->input->post("discount")==4 || $this->input->post("discount")==5){
	    $studiscount = $this->input->post("discount");
	    $this->db->where('discount_head',$studiscount);
	     $this->db->where('school_code',$this->session->userdata('school_code'));
	     $sd=$this->db->get('discounttable')->row()->id;
		}else{
		    $sd=$this->input->post("discount");
		}
		$datastudent = array(
				//"student_id" => $id,
				"scholer_no" => $this->input->post("scholerNumber"),
				"adm_date" => $this->input->post("dateOfAdmission"),
				"name" => $this->input->post("firstName"),
				//"midd_name" => $this->input->post("middleName"),
				//"last_name" => $this->input->post("classOfAdmission"),
				"dob" => $this->input->post("dob"),
				"class_id" => $this->input->post("classOfAdmission"),
				//"section" => $this->input->post("section"),
				"gender" => $this->input->post("gender"),
				"bloodgp" => $this->input->post("bloodgp"),
				"birth_place" => $this->input->post("birthPlace"),
				"mother_tongue" => $this->input->post("mothertongue"),
				"category" => $this->input->post("category"),
				"religion" => $this->input->post("religion"),
				"address1" => $this->input->post("addLine1"),
				"area" => $this->input->post("addLine2"),
				"city" => $this->input->post("city"),
				"state" => $this->input->post("state"),
				"transport" => $this->input->post("ts"),
				"v_id" => $this->input->post("vt"),
				"vehicle_pickup"=>$this->input->post("pickup"),
				//"amount"=>$this->input->post("pickupAmount"),
				"pin_code" => $this->input->post("pinCode"),
				"country" => $this->input->post("country"),
				//"phone" => $this->input->post("phonenumbar"),
				"mobile" => $this->input->post("mobileNumber"),
				"email" => $this->input->post("emailAddress"),
				"username" => $id,
				"password" =>$this->input->post("password"),
				"status"=>1,
				"discount_id"=>$sd,
				"teacher_studentid1"=>$this->input->post("id1"),
				"teacher_studentid2"=>$this->input->post("id2"),
				"teacher_studentid3"=>$this->input->post("id3"),
				"teacher_studentid4"=>$this->input->post("id4"),
				"aadhar_number"=>$this->input->post("aadhar_number"),
				//"school_code"=>$this->session->userdata("school_code"),
				"fsd"=>$this->input->post("fsd"),
			  	 "created"=>date("Y-m-d H:i:s"),
				"house_id"=>$this->input->post("house")
		);
		$this->load->model('newAdmissionModel'); 
		$addInfoConfirm = $this->newAdmissionModel->addInfo($datastudent);
		$this->db->where('username',$id);
		$student_id=$this->db->get('student_info')->row()->id;
		$dataparent = array(
				"student_id" =>  $student_id,
				"maxcount"=>$maxusername,
				"father_full_name" => $this->input->post("fatherName"),
				"mother_full_name" => $this->input->post("motherName"),
				"caretaker_name" => $this->input->post("guardianName"),
				"caretaker_relation" => $this->input->post("guardianRelation"),
				"father_education" => $this->input->post("fatherEducation"),
				"mother_education" => $this->input->post("motherEducation"),
				"father_occupation" => $this->input->post("fatherOccupation"),
				"mother_occupation" => $this->input->post("motherOccupation"),
				"family_annual_income" => $this->input->post("familyAnnualIncome"),
				"address" => $this->input->post("parentAddress"),
				"area" => $this->input->post("area"),
				"city" => $this->input->post("parentCity"),
				"state" => $this->input->post("parentState"),
				"pin" => $this->input->post("parentPin"),
				"country" => $this->input->post("parentCountry"),
				"f_mobile" => $this->input->post("fatherMobileNumber"),
				"m_mobile" => $this->input->post("motherMobileNumber"),
				"f_email" => $this->input->post("fatherEmailAddress"),
				"m_email" => $this->input->post("motherEmailAddress"),
				"school_code"=>$this->session->userdata("school_code")
		);
		
		$this->load->model('newAdmissionModel'); 
		$addInfoConfirm1 = $this->newAdmissionModel->addInfo1($dataparent);
		$this->db->where('username',$id);
		$student_id=$this->db->get('student_info')->row()->id;
		$datapreschool = array(
				"student_id" =>  $student_id,
				"pClass" => $this->input->post("pClass"),
				"pRoll" => $this->input->post("pRoll"),
				"pSchool" => $this->input->post("pSchool"),
				"pYear" => $this->input->post("pYear"),
				"pMarks" => $this->input->post("pMarks"),
				"pPercentage" => $this->input->post("pPercentage"),
				"pSubject" => $this->input->post("pSubject"),
				"school_code"=>$this->session->userdata("school_code")
		);
		$this->load->model('newAdmissionModel');
		$addInfoConfirm2 = $this->newAdmissionModel->addInfo2($datapreschool);
		if($addInfoConfirm && $addInfoConfirm1 && $addInfoConfirm2){

			//---------------------------------------------- CHECK SMS SETTINGS -----------------------------------------
			$this->load->model("smsmodel");
			$sender = $this->smsmodel->getsmssender($school_code);
			$sende_Detail =$sender;
			 $sende_Detail1=$sende_Detail->row();
			$isSMS = $this->smsmodel->getsmsseting($school_code);
			if($isSMS->admission)
				{
				$school = $this->session->userdata("your_school_name");
		 		$f_name=$this->input->post("fatherName");
				$username = $id;
				$password = $this->input->post("password");
					$f_mobile = $this->input->post("mobileNumber");
					$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
					$master_id=$max_id->maxid+1;
				if($school_code==8){
					    	$msg="Dear ".$f_name." welcome to ".$school.". Your Ward's Student ID= ".$username." and Password=".$password.". Now You can login and get all school updates click .".$sende_Detail1->web_url." Thanks. 9415863922, 9369771737.";	
			
					}else{
						$msg="Dear ".$f_name." welcome to ".$school.". Your Ward's Student ID= ".$username." and Password=".$password.". Now You can login and get all school updates click .".$sende_Detail1->web_url." Thanks.";	
			    
					}
					$getv=mysms($sende_Detail1->auth_key,$msg,$sende_Detail1->sender_id,$f_mobile);
				    $this->smsmodel->sentmasterRecord($msg,2,$master_id,$getv);
				    $rtype="student";
				     //redirect(base_url()."index.php/api/common_user/$rtype");
					redirect(base_url()."index.php/studentController/admissionSuccess/$student_id");
				}else{
				    $rtype="student";
				     //redirect(base_url()."index.php/api/common_user/$rtype");
				    	redirect(base_url()."index.php/studentController/admissionSuccess/$student_id");
				}
		
			//---------------------------------------------- END CHECK SMS SETTINGS -----------------------------------------
			
		}
	
		// else{
		//  $data['pageTitle'] = 'Student Section';
		// 	$data['smallTitle'] = 'New Admission';
		// 	$data['mainPage'] = 'Students';
		// 	$data['subPage'] = 'Mobile Message And Notice';
		// 	$data['title'] = 'Mobile Message And Notice';
		// 	$data['headerCss'] = 'headerCss/noticeCss';
		// 	$data['footerJs'] = 'footerJs/noticeJs';
		// 	$data['mainContent'] = 'error';
		// 	$this->load->view("includes/mainContent", $data);
		// }
	}


	function newAdmission(){
		$data['pageTitle'] = 'Student Section';
		$data['smallTitle'] = 'New Admission';
		$data['mainPage'] = 'Students';
		$data['subPage'] = 'New Admission';
	
		$this->load->model("allFormModel");
		$data['className'] = $this->allFormModel->getClass()->result();
	
		$data['title'] = 'New Admission';
		$data['headerCss'] = 'headerCss/newAdmissionCss';
		$data['footerJs'] = 'footerJs/newAdmission';
		$data['mainContent'] = 'newAdmission';
		$this->load->view("includes/mainContent", $data);
	}
function quickStureginsert(){	
		$school_code = $this->session->userdata("school_code");
		
		$id1 = $this->db->query("SELECT MAX(maxcount) as maxnumber From guardian_info where school_code =$school_code");
		 if($id1->num_rows()>0){
		$id = $id1->row()->maxnumber;
		}else{
		$id=0;
	    }
    	$db=$this->db->get('db_name')->row()->name;
		$maxusername=$id+1;
		$id1 = 4000+$maxusername;
		$id=$db.$school_code.'S'.$id1;
		$this->form_validation->set_error_delimiters('<div class="col-sm-12"><label class="text-danger">', '</label></div>');
		$this->form_validation->set_rules('dateOfAdmission','Date Of Admission', 'trim|required');
		$this->form_validation->set_rules('firstName','Name', 'trim|required');
		$this->form_validation->set_rules('dob','Date of birth', 'trim|required');
		$this->form_validation->set_rules('classOfAdmission','Class of Admission', 'trim|required');
		$this->form_validation->set_rules('section','Section', 'trim|required');
		$this->form_validation->set_rules('gender','Gende', 'trim');
		$this->form_validation->set_rules('addLine1','Address', 'trim|required');
		$this->form_validation->set_rules('mobileNumber','Mobile Number', 'trim|required|numeric');
		$this->form_validation->set_rules('emailAddress','', 'trim|valid_email');
		$this->form_validation->set_rules('password','Password', 'trim|required');
		$this->form_validation->set_rules('password_again','Re-Password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('fatherName','Father Name', 'trim|required');
		$this->form_validation->set_rules('motherName','Mother Name', 'trim|required');
		if($this->form_validation->run() == FALSE){
			$this->quickregiter();
		}else{
		 if($this->input->post("discount")==1 || $this->input->post("discount")==2 || $this->input->post("discount")==3 || $this->input->post("discount")==4 || $this->input->post("discount")==5){
	    $studiscount = $this->input->post("discount");
	    $this->db->where('discount_head',$studiscount);
	     $this->db->where('school_code',$this->session->userdata('school_code'));
	     $sd=$this->db->get('discounttable')->row()->id;
		}else{
		    $sd=$this->input->post("discount");
		}
            $datastudent = array(				
				"name" => $this->input->post("firstName"),
				"mobile" => $this->input->post("mobileNumber"),
				"dob" => $this->input->post("dob"),
				"class_id" => $this->input->post("classOfAdmission"),
				"address1" => $this->input->post("addLine1"),
				"email" => $this->input->post("emailAddress"),
				"adm_date" => $this->input->post("dateOfAdmission"),
				"username" => $id,
				"password" =>$this->input->post("password"),
				"status"=>1,
				"gender" => $this->input->post("gender"),
				"fsd"=>$this->input->post("fsd"),
				"created"=>date("Y-m-d H:i:s"),
            	"house_id"=>$this->input->post("house"),
            	"transport" => $this->input->post("ts"),
				"v_id" => $this->input->post("vt"),
				"vehicle_pickup"=>$this->input->post("pickup"),
					"discount_id"=>$sd
			);
			
			
			$this->load->model('newAdmissionModel');
			$addInfoConfirm = $this->newAdmissionModel->addInfo($datastudent);

			$this->db->where('username',$id);
			$student_id=$this->db->get('student_info')->row()->id;
			$dataparent = array(
			    "maxcount"=>$maxusername,
				"student_id" =>  $student_id,
				"father_full_name" => $this->input->post("fatherName"),
				"mother_full_name" => $this->input->post("motherName"),
				"school_code"=>$this->session->userdata("school_code")
		);

			$addInfoConfirm1 = $this->newAdmissionModel->addInfo1($dataparent);
			$this->db->where('username',$id);
			$student_id=$this->db->get('student_info')->row()->id;
			$datapreschool = array(
				"student_id" =>  $student_id,
				"school_code"=>$this->session->userdata("school_code")
		);
			$this->load->model('newAdmissionModel');
			$addInfoConfirm2 = $this->newAdmissionModel->addInfo2($datapreschool);
			if($addInfoConfirm && $addInfoConfirm1 && $addInfoConfirm2){
			    //---------------------------------------------- CHECK SMS SETTINGS -----------------------------------------
			$this->load->model("smsmodel");
			$sender = $this->smsmodel->getsmssender($school_code);
			$sende_Detail1 =$sender->row();
			$isSMS = $this->smsmodel->getsmsseting($school_code);
				$school = $this->session->userdata("your_school_name");
		 			$f_name = $this->input->post("fatherName");
		 			$username = $id;
					$password = $this->input->post("password");

				//	$f_mobile = $this->input->post("mobileNumber");
					$f_mobile = $this->input->post("mobileNumber");
			
			if($isSMS->admission)
				{
				
					$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
					$master_id=$max_id->maxid+1;
					$msg="Dear ".$f_name." welcome to ".$school.". Your Ward's Student ID= ".$username." and Password=".$password.". Now You can login and get all school updates click .".$sende_Detail1->web_url." Thanks.";	

					}else{
						$msg="Dear ".$f_name." welcome to ".$school.". Your Ward's Student ID= ".$username." and Password=".$password.". Now You can login and get all school updates click .".$sende_Detail1->web_url." Thanks.";	
			    
					}
				
					$getv=mysms($sende_Detail1->auth_key,$msg,$sende_Detail1->sender_id,$f_mobile);
				    $this->smsmodel->sentmasterRecord($msg,2,$master_id,$getv);
				    $rtype="student";
				    //redirect(base_url()."index.php/api/common_user/$rtype");
						redirect(base_url()."index.php/studentController/admissionSuccess/$student_id");
				}else{
				    $rtype="student";
				    //redirect(base_url()."index.php/api/common_user/$rtype");
				    	redirect(base_url()."index.php/studentController/admissionSuccess/$student_id");
				}

			}
		}
	
	


	function quickregiter(){
		$data['pageTitle'] = 'Student Section';
		$data['smallTitle'] = 'Quick Admission';
		$data['mainPage'] = 'Students';
		$data['subPage'] = 'Quick Admission';
	
		$this->load->model("allFormModel");
		$data['className'] = $this->allFormModel->getClass()->result();
	
		$data['title'] = 'Quick Admission';
		$data['headerCss'] = 'headerCss/newAdmissionCss';
		$data['footerJs'] = 'footerJs/newAdmission';
		$data['mainContent'] = 'quickRegistration';
		$this->load->view("includes/mainContent", $data);
	}
	
	 function changeUsernameToid(){
	    $schoolid = $this->db->get("school")->result();
	   foreach($schoolid as $scode){
	       $this->db->where("school_code",$scode->id);
	       $gc = $this->db->get("guardian_info")->result();
	       foreach($gc as $ginfo):
	           $this->db->where("username",$ginfo->student_id);
	           $sid = $this->db->get("student_info")->row();
	           $data = array(
	               'student_id'=>$sid->id
	               );
	               $this->db->where("student_id",$ginfo->student_id);
	           $this->db->update("guardian_info",$data);
	           endforeach;
	   }
	}
		
}
