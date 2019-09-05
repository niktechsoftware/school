<?php
class StudentController extends CI_Controller{
	function __construct(){
		parent::__construct();
			$this->is_login();
		$this->load->model("studentModel");
		$this->load->model("allFormModel");
		$this->load->model("subjectModel");
		$school_code = $this->session->userdata("school_code");
	}
		function is_login(){
		$is_login = $this->session->userdata('is_login');
	
		if(!$is_login){
			
			redirect("index.php/homeController/index");
		}
	
	}
	    function getstudentList()
	    {
	   $data['fsd'] = $this->input->post("fsd");
		$data['cla'] = $this->input->post("classid");
		$cla = $this->input->post("classid");
	
		$school_code = $this->session->userdata("school_code");
		if($this->input->post("fsd"))
		{
			$this->db->where("status",1);
		 	$this->db->where("class_id",$cla);
		 	$student = $this->db->get("student_info");
		 	$data['student']=$student;
		    $this->load->view("panel/studentwiselist",$data);
		}
		else
		{
			echo "Something wrong!please try After Some Time";
		}
	
	    }
	
		function getClassWiseListshow(){
 		$data['pageTitle'] = 'Student Panel';
		$data['smallTitle'] = 'Student List';
		$data['mainPage'] = 'Classwise List';
		$data['subPage'] = 'Student Panel';
	    $data['title'] = 'Fee Panel Area ';
	    	$this->load->model("allFormModel");
		$data['request'] = $this->allFormModel->getsectionfeereport()->result();
	
	    
     	$data['headerCss'] = 'headerCss/stpanelCss';
		$data['footerJs'] = 'footerJs/stpanelJs';
		$data['mainContent'] = 'panel/fee/classwise_feepanel';
		$this->load->view("includes/mainContent", $data);

	}
	
	public function findtransport()
	{
	   
	   
	    $this->load->model("searchStudentModel");
		$req=$this->searchStudentModel->getValuefordriver();
		$data['request']=$req->result();
		$data['headerCss'] = 'headerCss/stpanelCss';
		$data['footerJs'] = 'footerJs/stpanelJs';
	
	//	$data['mainContent'] = 'transportList';
		$this->load->view("transportList", $data);
	   
	}
	
	public function yearwiseList()
	{
	    $data['pageTitle'] = 'Student Panel';
		$data['smallTitle'] = 'Student List';
		$data['mainPage'] = 'Session Wise Student List';
		$data['subPage'] = 'Session Wise Student List';
	    $data['title'] = 'Session Wise Student List ';
	    
     	$data['headerCss'] = 'headerCss/stpanelCss';
		$data['footerJs'] = 'footerJs/stpanelJs';
		$data['mainContent'] = 'yearwiseList';
		$this->load->view("includes/mainContent", $data);
   
	}
	
	public function yearwisestudentList()
	{
	    
	    $fsd=$this->input->post('fsd');
	    $data['fsd']=$fsd;
	      $data['pageTitle'] = 'Student Panel';
		$data['smallTitle'] = 'Student List';
		$data['mainPage'] = 'Session Wise Student List';
		$data['subPage'] = 'Session Wise Student List';
	    $data['title'] = 'Session Wise Student List ';
	    $data['headerCss'] = 'headerCss/stpanelCss';
		$data['footerJs'] = 'footerJs/stpanelJs';
		$data['mainContent'] = 'SessionwiseList';
		$this->load->view("includes/mainContent", $data);
   
	}

    public function drivertransportList()
    {
        
        $data['pageTitle'] = 'Student Panel';
		$data['smallTitle'] = 'Student List';
		$data['mainPage'] = 'Driverwise Transport List';
		$data['subPage'] = 'Driverwise Transport List';
	    $data['title'] = 'Driverwise Transport List ';
	    
     	$data['headerCss'] = 'headerCss/stpanelCss';
		$data['footerJs'] = 'footerJs/stpanelJs';
		$data['mainContent'] = 'drivertransportList';
		$this->load->view("includes/mainContent", $data);
    }
	
	public function invoice(){
		
		$data['pageTitle'] = 'Student Section';
		$data['smallTitle'] = 'Student Profile';
		$data['mainPage'] = 'Student';
		$data['subPage'] = 'Profile';

		$data['title'] = 'Student Profile';
		$data['headerCss'] = 'headerCss/admissionSuccessCss';
		$data['footerJs'] = 'footerJs/admitCardJs';
		$data['mainContent'] = 'admit';
		$this->load->view("includes/mainContent", $data);
	}

	function classwiseicard(){
	
		$data['classid'] = $this->input->post('class');
		$data['sectionid'] = $this->input->post('section');;
		$data['fsd'] = $this->input->post('fsd');
		$data['pageTitle'] = 'Student Icard';
		$data['smallTitle'] = 'Student Icard';
		$data['mainPage'] = 'Student Icard';
		$data['subPage'] = 'Student Icard';
		$data['title'] = 'Student Icard';
		$data['headerCss'] = 'headerCss/admissionSuccessCss';
		$data['footerJs'] = 'footerJs/admitCardJs';
		$data['mainContent'] = 'classwiseicard';
		$this->load->view("includes/mainContent", $data);
	
	}

	function student_wise_icard(){
		$stuid=$this->input->post('stdid');
		$this->db->where('username',$stuid);
		$data['studentid']=$this->db->get('student_info')->row()->id;
		$data['pageTitle'] = 'Student Icard';
		$data['smallTitle'] = 'Student Icard';
		$data['mainPage'] = 'Student Icard';
		$data['subPage'] = 'Student Icard';
		$data['title'] = 'Student Icard';
		$data['headerCss'] = 'headerCss/admissionSuccessCss';
		$data['footerJs'] = 'footerJs/admitCardJs';
		$data['mainContent'] = 'studenticard';
		$this->load->view("includes/mainContent", $data);

	}
	function studentPanel(){
		
		$data['pageTitle'] = 'Student Panel';
		$data['smallTitle'] = 'Student List';
		$data['mainPage'] = 'Student Panel Area';
		$data['subPage'] = 'Student Panel';
		$data['title'] = 'Student Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'studentPanel';
		$this->load->view("includes/mainContent", $data);
	}
	
	function homeWorkReport(){
		$data['pageTitle'] = 'Student Panel';
		$data['smallTitle'] = 'Student List';
		$data['mainPage'] = 'Class Wise Home Work';
		$data['subPage'] = 'Home Work Section';
		$data['title'] = 'Student Panel Area ';
		$this->load->model("configureClassModel");
		$data['request'] = $this->allFormModel->getClass()->result();
		$data['headerCss'] = 'headerCss/stpanelCss';
		$data['footerJs'] = 'footerJs/stpanelJs';
		$data['mainContent'] = 'classHomeWork';
		$this->load->view("includes/mainContent", $data);
	}
	function getHomeWorkList(){
		$data['fsd1']=$this->input->post("fsd1");
		$data['fsd2']=$this->input->post("fsd2");
		$data['classv']=$this->input->post("classv");
		$data['sec']=$this->input->post("section");
		$this->load->view("ajax/homeWorkList",$data);
		
	}
	function classWiseList(){
		$data['pageTitle'] = 'Student Panel';
		$data['smallTitle'] = 'Student List';
		$data['mainPage'] = 'Class Wise List Area';
		$data['subPage'] = 'Class Wise List';
		$data['title'] = 'Student Panel Area ';
		$this->load->model("configureClassModel");
		$data['request'] = $this->allFormModel->getClass()->result();
		
		$data['headerCss'] = 'headerCss/stpanelCss';
		$data['footerJs'] = 'footerJs/stpanelJs';
		$data['mainContent'] = 'classWiseList';
		$this->load->view("includes/mainContent", $data);
	}
	
	function getClassWiseList(){
		$data['fsd'] = $this->input->post("fsd");
		$data['cla'] = $this->input->post("classv");
		$data['sec'] = $this->input->post("section");
		$this->load->view("ajax/getClassWiseList",$data);
	}
	
	function transportList(){
		$data['pageTitle'] = 'Student Panel';
		$data['smallTitle'] = 'Student List';
		$data['mainPage'] = 'Transport List';
		$data['subPage'] = 'Transport List';
	    $this->load->model("searchStudentModel");
		$req=$this->searchStudentModel->getValuefortransport();
		$data['request']=$req->result();
		$data['title'] = 'Student Panel Area ';
		$data['headerCss'] = 'headerCss/stpanelCss';
		$data['footerJs'] = 'footerJs/stpanelJs';
		$data['mainContent'] = 'transportList';
		$this->load->view("includes/mainContent", $data);
	}

// 	function admissionSuccess(){
// 		$data['pageTitle'] = 'Student Section'; 
// 		$data['smallTitle'] = 'Student Profile';
// 		$data['mainPage'] = 'Student';
// 		$data['subPage'] = 'Profile';
// 		$studentId = $this->uri->segment(3);
// 		$this->load->model("feemodel");
// 		$stDetail = $this->studentModel->getStudentDetail($studentId);
// 		//$data['gurdianDetail'] = $this->studentModel->getGurdianDetail($stDetail->row()->username);
// 		$data['gurdianDetail'] = $this->studentModel->getGurdianDetail($stDetail->row()->id);
// 		$data['className'] = $this->allFormModel->getClass();
// 		$data['sectionName'] = $this->allFormModel->getSection();
// 		$personalInfo = $stDetail->row();
// 		$className = $personalInfo->class_id; 
// 		$data['subjectList'] = $this->subjectModel->getSubjectByClassSection($className);
// 		$data['studentProfile'] = $stDetail;
// 		$data['title'] = 'Student Profile';
// 		$data['headerCss'] = 'headerCss/admissionSuccessCss';
// 		$data['footerJs'] = 'footerJs/admissionSuccessJs';
// 		$data['mainContent'] = 'admissionSuccess'; 
// 		$this->load->view("includes/mainContent", $data);
// 	}
function admissionSuccess(){
		$data['pageTitle'] = 'Student Section'; 
		$data['smallTitle'] = 'Student Profile';
		$data['mainPage'] = 'Student';
		$data['subPage'] = 'Profile';
		$studentId1 = $this->uri->segment(3);
		$this->load->model("feemodel");
		$stDetail = $this->studentModel->getStudentDetail($studentId1);
		//$data['gurdianDetail'] = $this->studentModel->getGurdianDetail($stDetail->row()->username);
		$data['gurdianDetail'] = $this->studentModel->getGurdianDetail($studentId1);
		$data['className'] = $this->allFormModel->getClass();
		$data['sectionName'] = $this->allFormModel->getSection();
		$personalInfo = $stDetail->row();
		$className = $personalInfo->class_id; 
		$data['subjectList'] = $this->subjectModel->getSubjectByClassSection($className);
		$data['studentProfile'] = $stDetail;
		$data['title'] = 'Student Profile';
		$data['headerCss'] = 'headerCss/admissionSuccessCss';
		$data['footerJs'] = 'footerJs/admissionSuccessJs';
		$data['mainContent'] = 'admissionSuccess'; 
		$this->load->view("includes/mainContent", $data);
	}
	
	function updateTransport(){
		$student_id = $this->input->post("studid");
			$data = array(
				"student_id" => $this->input->post("studid"),
				"vehicleType" =>$this->input->post("vt"),
				"vnumnber" =>$this->input->post("vn"),
				"distance" => $this->input->post("dt"),
				"school_code"=>$this->session->userdata("school_code")
		);
	
		$val = $this->db->insert("transport",$data);
		if($val)
		{
			echo "Updated";
		}
	}
	function updateStudentImage(){
		$id = $this->input->post('c_id');
		//print_r($id);
		$this->db->where('username',$id);
		$studentid=$this->db->get('student_info')->row()->id;
		
		$school_code = $this->session->userdata("school_code");
		$photo_name = time().trim($_FILES['stuImage']['name']);
		$photo_name = str_replace(' ', '_', $photo_name);
		$new_img = array(
				"photo"=> $photo_name
				
		);
		$old_img = $this->input->post("old_stuImg");
		@chmod("assets/".$school_code."/images/stuImage/" . $old_img, 0777);
		@unlink("assets/".$school_code."/images/stuImage/" . $old_img);
		
		if($query = $this->studentModel->updateStudentInfo($new_img,$studentid)){
			$this->load->library('upload');
			// Set configuration array for uploaded photo.
		$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/stuImage';
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
			$config['max_size'] = '1024';
			$config['file_name'] = $photo_name;
			// Upload first photo and create a thumbnail of it.
			if (!empty($_FILES['stuImage']['name'])) {
				$this->upload->initialize($config);
				if ($this->upload->do_upload('stuImage')) {
					// ---------------------------------- Redirect Success Page ----------------------
					$this->session->set_userdata("photo",$photo_name);
					
				}
				redirect("index.php/studentController/admissionSuccess/$studentid/updateInfo");
			} 
			else
				{
					redirect("index.php/errorController","refresh");
				}
		}
	}
	
	function updateFatherImage(){
		$id = $this->input->post('c_id');
		//print_r($id);
		
		$this->db->where('id',$id);
		$studentid=$this->db->get('student_info')->row()->id;
		
		$school_code = $this->session->userdata("school_code");
		$photo_name = time().trim($_FILES['fatherImage']['name']);
		$photo_name = str_replace(' ', '_', $photo_name);
		$new_img = array(
				"f_photo"=> $photo_name,
				"school_code"=>$this->session->userdata("school_code")
		);
		$old_img = $this->input->post("old_f_image");
		@chmod("assets/".$school_code."/images/stuImage/" . $old_img, 0777);
		@unlink("assets/".$school_code."/images/stuImage/" . $old_img);
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		if($query = $this->studentModel->updateGurdianInfo($new_img,$studentid)){
			$this->load->library('upload');
			// Set configuration array for uploaded photo.
			//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/stuImage');
			$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/stuImage';
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '1024';
			$config['file_name'] = $photo_name;
			// Upload first photo and create a thumbnail of it.
			if (!empty($_FILES['fatherImage']['name'])) {
				$this->upload->initialize($config);
				if ($this->upload->do_upload('fatherImage')) {
					// ---------------------------------- Redirect Success Page ----------------------
					$this->session->set_userdata("photo",$photo_name);
				}
				redirect("index.php/studentController/admissionSuccess/$studentid/updateInfo");
				// echo $this->upload->display_errors('<p>', '</p>');
			}     
			else{
					redirect("index.php/errorController","refresh");
			}
		}
	}
	
	function updateMotherImage(){
		$id = $this->input->post('c_id');
		//print_r($id);
		$this->db->where('id',$id);
		$studentid=$this->db->get('student_info')->row()->id;
		$school_code = $this->session->userdata("school_code");
		$photo_name = time().trim($_FILES['motherImage']['name']);
		$photo_name = str_replace(' ', '_', $photo_name);
		$new_img = array(
				"m_photo"=> $photo_name,
				"school_code"=>$this->session->userdata("school_code")
		);
		$old_img = $this->input->post("old_m_image");
		@chmod("assets/".$school_code."/images/stuImage/" . $old_img, 0777);
		@unlink("assets/".$school_code."/images/stuImage/" . $old_img);
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		if($query = $this->studentModel->updateGurdianInfo($new_img,$studentid)){
			$this->load->library('upload');
			// Set configuration array for uploaded photo.
			//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/stuImage');
			$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/stuImage';
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '1024';
			$config['file_name'] = $photo_name;
			// Upload first photo and create a thumbnail of it.
			if (!empty($_FILES['motherImage']['name'])) {
				$this->upload->initialize($config);
				if ($this->upload->do_upload('motherImage')) {
					// ---------------------------------- Redirect Success Page ----------------------
					$this->session->set_userdata("photo",$photo_name);
				}
				redirect("index.php/studentController/admissionSuccess/$studentid/updateInfo");
				//echo $this->upload->display_errors('<p>', '</p>');
				//echo "not uploaded";
			}	
			else{
					redirect("index.php/errorController","refresh");
			}
		}
	}
	
	
	
	function updateStuInfo(){
		$id = $this->input->post('c_id');
		
	  if($this->input->post("discount")==1 || $this->input->post("discount")==2 || $this->input->post("discount")==3 || $this->input->post("discount")==4 || $this->input->post("discount")==5){
	    $studiscount = $this->input->post("discount");
	    $this->db->where('discount_head',$studiscount);
	     $this->db->where('school_code',$this->session->userdata('school_code'));
	     $sd=$this->db->get('discounttable')->row()->id;
		}else{
		    $sd=$this->input->post("discount");
		}
	     
		$this->db->where('username',$id);
		$studentid=$this->db->get('student_info')->row()->id;
		if($this->input->post("ts")!=0){
             $update_date=date("y-m-d H:i:s");
		}else{
			$update_date = "0000-00-00 00:00:00";
		}
		$datastudent = array(
		    "sno" => $this->input->post("serialNumber"),
		    "book_no" => $this->input->post("bookNumber"),
				"scholer_no" => $this->input->post("scholerNumber"),
				"adm_date" => $this->input->post("dateOfAdmission"),
				"name" => $this->input->post("firstName"),
				"dob" => $this->input->post("dob"),
				"class_id" => $this->input->post("classOfAdmission"),
				"gender" => $this->input->post("gender"),
				"bloodgp" => $this->input->post("bloodgp"),
				"birth_place" => $this->input->post("birthPlace"),
				//"nationality" => $this->input->post("nationality"),
				"mother_tongue" => $this->input->post("mothertongue"),
				"category" => $this->input->post("category"),
				"religion" => $this->input->post("religion"),
				"transport" => $this->input->post("ts"),
				"v_id" => $this->input->post("vt"),
				"address1" => $this->input->post("addLine1"),
				"area" => $this->input->post("addLine2"),
				"city" => $this->input->post("city"),
				"state" => $this->input->post("state"),
				"pin_code" => $this->input->post("pinCode"),
				"country" => $this->input->post("country"),
				"mobile" => $this->input->post("mobileNumber"),
				"email" => $this->input->post("emailAddress"),
				"status" => $this->input->post("status"),
				"height" => $this->input->post('stuheight'),
				"weight" => $this->input->post('stuweight'),
				"aadhar_number"=>$this->input->post("aadhar_number"),
				"vehicle_pickup"=>$this->input->post("pickup"),
				"discount_id"=>$sd,
				"teacher_studentid1"=>$this->input->post("id1"),
				"teacher_studentid2"=>$this->input->post("id2"),
				"teacher_studentid3"=>$this->input->post("id3"),
				"teacher_studentid4"=>$this->input->post("id4"),
				"password" =>$this->input->post("password"),
				"update_date" => $update_date,
				"house_id" =>$this->input->post("house")
		);
		if($query = $this->studentModel->updateStudentInfo($datastudent,$studentid)){
			redirect(base_url()."index.php/studentController/admissionSuccess/$studentid/updateInfo");
		}
	} 
	
	
	function updateParentInfo(){
		$id = $this->input->post('c_id');
		$this->db->where('username',$id);
		$studentid=$this->db->get('student_info')->row()->id;
		//print_r($studentid);
		//exie;
		$dataparent = array(
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
				//"phone" => $this->input->post("parentPhoneNumber"),
				"f_mobile" => $this->input->post("fatherMobileNumber"),
				"m_mobile" => $this->input->post("motherMobileNumber"),
				"f_email" => $this->input->post("fatherEmailAddress"),
				"m_email" => $this->input->post("motherEmailAddress"),
				"school_code"=>$this->session->userdata("school_code")
		);
		
		if($query = $this->studentModel->updateGurdianInfo($dataparent,$studentid)){
			redirect("index.php/studentController/admissionSuccess/$studentid/updateInfo");
		}
	}
	
	function uploadCc(){
	    $school_code = $this->session->userdata("school_code");
		$id = $this->input->post('c_id');
		$this->db->where('username',$id);
		$studentid=$this->db->get('student_info')->row()->id;
		$photo_name = time().trim($_FILES['cc']['name']);
		$photo_name = str_replace(' ', '_', $photo_name);
		$new_img = array(
				"cc"=> $photo_name,
		);
		$old_img = $this->input->post("old_cc");
		@chmod("assets/".$school_code."/images/stuImage/" . $old_img, 0777);
		@unlink("assets/".$school_code."/images/stuImage/" . $old_img);
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		if($query = $this->studentModel->updateStudentInfo($new_img,$studentid)){
			$this->load->library('upload');
			// Set configuration array for uploaded photo.
			//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/stuImage');
			$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/stuImage';
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '1024';
			$config['file_name'] = $photo_name;
			// Upload first photo and create a thumbnail of it.
			if (!empty($_FILES['cc']['name'])) {
				$this->upload->initialize($config);
				if ($this->upload->do_upload('cc')) {
					// ---------------------------------- Redirect Success Page ----------------------
					$this->session->set_userdata("photo",$photo_name);
				}else{

					//echo $this->upload->display_errors('<p>', '</p>');
				}
				redirect("index.php/studentController/admissionSuccess/$studentid/certificate");
			}
			else
				{
					redirect("index.php/errorController","refresh");
				}
		}
	}

	function uploadTc(){
		$id = $this->input->post('c_id');
		$this->db->where('username',$id);
		$studentid=$this->db->get('student_info')->row()->id;
		$school_code = $this->session->userdata("school_code");
		$photo_name = time().trim($_FILES['tc']['name']);
		$photo_name = str_replace(' ', '_', $photo_name);
		$new_img = array(
				"tc"=> $photo_name,
		);
		$old_img = $this->input->post("old_tc");
		@chmod("assets/".$school_code."/images/stuImage/" . $old_img, 0777);
		@unlink("assets/".$school_code."/images/stuImage/" . $old_img);
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		if($query = $this->studentModel->updateStudentInfo($new_img,$studentid)){
			$this->load->library('upload');
			// Set configuration array for uploaded photo.
			//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/stuImage');
			$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/stuImage';
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '1024';
			$config['file_name'] = $photo_name;
			// Upload first photo and create a thumbnail of it.
			if (!empty($_FILES['tc']['name'])) {
				$this->upload->initialize($config);
				if ($this->upload->do_upload('tc')) {
					// ---------------------------------- Redirect Success Page ----------------------
					$this->session->set_userdata("photo",$photo_name);
				}
				redirect("index.php/studentController/admissionSuccess/$studentid/certificate");
			}
			else
				{
					redirect("index.php/errorController","refresh");
				}
		}
	}

	function uploadCastCertificate(){
		$id = $this->input->post('c_id');
		$this->db->where('username',$id);
		$studentid=$this->db->get('student_info')->row()->id;
		$school_code = $this->session->userdata("school_code");
		$photo_name = time().trim($_FILES['castCertificate']['name']);
		$photo_name = str_replace(' ', '_', $photo_name);
		$new_img = array(
				"castCertificate"=> $photo_name,
		);
		$old_img = $this->input->post("old_castCertificate");
		@chmod("assets/".$school_code."/images/stuImage/" . $old_img, 0777);
		@unlink("assets/".$school_code."/images/stuImage/" . $old_img);
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		if($query = $this->studentModel->updateStudentInfo($new_img,$studentid)){
			$this->load->library('upload');
			// Set configuration array for uploaded photo.
			//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/stuImage');
			$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/stuImage';
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '1024';
			$config['file_name'] = $photo_name;
			// Upload first photo and create a thumbnail of it.
			if (!empty($_FILES['castCertificate']['name'])) {
				$this->upload->initialize($config);
				if ($this->upload->do_upload('castCertificate')) {
					// ---------------------------------- Redirect Success Page ----------------------
					$this->session->set_userdata("photo",$photo_name);
				}
				redirect("index.php/studentController/admissionSuccess/$studentid/certificate");
			}
			else
				{
					redirect("index.php/errorController","refresh");
				}
		}
	}

	function uploadDomicileCertificate(){
		$id = $this->input->post('c_id');
		$this->db->where('username',$id);
		$studentid=$this->db->get('student_info')->row()->id;
		$school_code = $this->session->userdata("school_code");
		$photo_name = time().trim($_FILES['domicileCertificate']['name']);
		$photo_name = str_replace(' ', '_', $photo_name);
		$new_img = array(
				"domicileCertificate"=> $photo_name,
		);
		$old_img = $this->input->post("old_domicileCertificate");
		@chmod("assets/".$school_code."/images/stuImage/" . $old_img, 0777);
		@unlink("assets/".$school_code."/images/stuImage/" . $old_img);
		if($query = $this->studentModel->updateStudentInfo($new_img,$studentid)){
			$this->load->library('upload');
			// Set configuration array for uploaded photo.
			//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/stuImage');
			$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/stuImage';
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '1024';
			$config['file_name'] = $photo_name;
			// Upload first photo and create a thumbnail of it.
			if (!empty($_FILES['domicileCertificate']['name'])) {
				$this->upload->initialize($config);
				if ($this->upload->do_upload('domicileCertificate')) {
					// ---------------------------------- Redirect Success Page ----------------------
					$this->session->set_userdata("photo",$photo_name);
				}
				redirect("index.php/studentController/admissionSuccess/$studentid/certificate");
			}
			else
				{
					redirect("index.php/errorController","refresh");
				}
		}
	}

	function uploadPreviousMarkSheet(){
		$school_code = $this->session->userdata("school_code");
		$id = $this->input->post('c_id');
	    $this->db->where('username',$id);
		$studentid=$this->db->get('student_info')->row()->id;
		$photo_name = time().trim($_FILES['previousMarkSheet']['name']);
		$photo_name = str_replace(' ', '_', $photo_name);
		$new_img = array(
				"previousMarkSheet"=> $photo_name,
		);
		$old_img = $this->input->post("old_previousMarkSheet");
		@chmod("assets/".$school_code."/images/stuImage/" . $old_img, 0777);
		@unlink("assets/".$school_code."/images/stuImage/" . $old_img);
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		if($query = $this->studentModel->updateStudentInfo($new_img,$studentid)){
			$this->load->library('upload');
			// Set configuration array for uploaded photo.
			//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/stuImage');
			$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/stuImage';
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '1024';
			$config['file_name'] = $photo_name;
			// Upload first photo and create a thumbnail of it.
			if (!empty($_FILES['previousMarkSheet']['name'])) {
				$this->upload->initialize($config);
				if ($this->upload->do_upload('previousMarkSheet')) {
					// ---------------------------------- Redirect Success Page ----------------------
					$this->session->set_userdata("photo",$photo_name);
				}
				redirect("index.php/studentController/admissionSuccess/$studentid/certificate");
			}
			else
				{
					redirect("index.php/errorController","refresh");
				}
		}
	}
	
	function studentList(){
		$data['result'] = $this->studentModel->studentList();
		//$data['$query'] = $this->studentModel->studentguardianList();
		$data['username'] = $this->input->post("student_id");
		$data['name'] = $this->input->post("name");
		$data['scholer_no'] = $this->input->post("scholer_no");
		$data['board_register_no'] = $this->input->post("board_register_no");
		$data['adm_date'] = $this->input->post("adm_date");
		$data['dob'] = $this->input->post("date_ob");
		$data['class_section'] = $this->input->post("class_section");
		$data['gender'] = $this->input->post("gender");
		$data['bloodgp'] = $this->input->post("bloodgp");
		$data['birth_place'] = $this->input->post("birth_place");
		$data['nationality'] = $this->input->post("nationality");
		$data['mother_tongue'] = $this->input->post("mother_tongue");
		$data['category'] = $this->input->post("category");
		$data['religion'] = $this->input->post("religion");
		$data['address1'] = $this->input->post("address1");
		$data['city'] = $this->input->post("city");
		$data['state'] = $this->input->post("state");
		$data['pin_code'] = $this->input->post("pin_code");
	//	$data['phone'] = $this->input->post("phone");
		$data['mobile'] = $this->input->post("mobile");
		$data['email'] = $this->input->post("email");
		$data['sno'] = $this->input->post("sno");
		$data['book_no'] = $this->input->post("bookno");
		$data['father_full_name'] = $this->input->post("father_full_name");
		$data['mother_full_name'] = $this->input->post("mother_full_name");
		$data['caretaker_name'] = $this->input->post("caretaker_name");
		$data['caretaker_relation'] = $this->input->post("caretaker_relation");
		$data['father_education'] = $this->input->post("father_education");
		$data['mother_education'] = $this->input->post("mother_education");
		$data['father_occupation'] = $this->input->post("father_occupation");
		$data['mother_occupation'] = $this->input->post("mother_occupation");
		$data['family_annual_income'] = $this->input->post("family_annual_income");
		$data['f_mobile'] = $this->input->post("f_mobile");
		$data['m_mobile'] = $this->input->post("m_mobile");
		$data['f_email'] = $this->input->post("f_email");
		$data['m_email'] = $this->input->post("m_email");	
		$data['disc'] = $this->input->post("disc");
        $data['transport'] = $this->input->post("transport");
	//	$data['school_code']=$this->session->userdata("school_code");
		$this->load->view("ajax/studentList",$data);
		}
		
		public function checkID(){
			$tid = $this->input->post("student_id");
			$this->load->model("teacherModel");
			$var = $this->teacherModel->checkStudID($tid);
			if($var->num_rows() > 0){
				foreach ($var->result() as $row){
					?>
							<div class="alert alert-success">
								<button data-dismiss="alert" class="close">
									&times;
								</button>
								ID Found ! <strong><?php echo $row->name; ?></strong>
							</div>
							<script>

							$("#b1").show();
							</script>
							<?php 
						}}
					else{
						?>
							<div class="alert alert-danger">
						
								<button data-dismiss="alert" class="close">
									&times;
								</button>
								Sorry :( <strong><?php echo "Student ID Not Found ! Wrong Student Id"; ?></strong>
							</div>
							<script>
								$("#b1").hide();
								</script>
						<?php
						
					}
				
			}
			
			function deleteStudent(){
				$school_code = $this->session->userdata("school_code");
				$studentId = $this->uri->segment(3);

				$deleteflag=true;
				$Warning="NOTE* Before delete the student details, you have to delete";
				$this->db->where('student_id',$studentId);
				$feecheck=$this->db->get('fee_deposit');
				if($feecheck->num_rows()>0){
					$deleteflag=false;
					$Warning .= ' fee,';
				}

				$this->db->where('paid_by',$studentId);
				$daybookcheck=$this->db->get('day_book');
				if($daybookcheck->num_rows()>0){
					$deleteflag=false;
					$Warning .= ' daybook,';
				}


				$this->db->where('stu_id',$studentId);
				$examcheck=$this->db->get('exam_info');
				if($examcheck->num_rows()>0){
					$deleteflag=false;
					$Warning .= 'exam details ';
				}

				$Warning .= 'entries';
		
				// $op1 = $this->db->query("SELECT sum(amount) as v FROM day_book WHERE school_code='$school_code' AND paid_by = '".$studentId."'")->row();
				
				if($deleteflag==false){
				// $data['pageTitle'] = 'Student Section';
				// $data['smallTitle'] = 'New Admission';
				// $data['mainPage'] = 'Students';
				// $data['subPage'] = 'Mobile Message And Notice';
				// $data['title'] = 'Mobile Message And Notice';
				// $data['headerCss'] = 'headerCss/noticeCss';
				// $data['footerJs'] = 'footerJs/noticeJs';
				// $data['mainContent'] = 'Error';
				// $this->load->view("includes/mainContent", $data);
				 $this->session->set_flashdata("Warning",$Warning);
				redirect(base_url("login/simpleSearchStudent"));
				}else{
					
				$delamountdaybook=1;
				
				
				// $this->db->where("school_code",$school_code);
				$this->db->where('id', $studentId);
				$this->db->delete('student_info');

				$this->db->where("school_code",$school_code);
				$this->db->where('student_id', $studentId);
				$this->db->delete('guardian_info');

				$this->db->where("school_code",$school_code);
				$this->db->where('stu_id', $studentId);
				$this->db->delete('attendance');

			

				$this->db->where("school_code",$school_code);
				$this->db->where('stu_id', $studentId);
				$this->db->delete('exam_info');

    			$this->db->where("school_code",$school_code);
    			$this->db->where('student_id', $studentId);
				$this->db->delete('fee_deposit');
				
				$this->db->where("school_code",$school_code);
				$this->db->where('student_id', $studentId);
				$this->db->delete('tc_certificate');

				// $this->db->where("school_code",$school_code);
				// $this->db->where('valid_id', $studentId);
				// $this->db->delete('sale_info');
				$delamountdaybook=0;
				redirect(base_url()."index.php/login/simpleSearchStudent");
				}
			
		}
			
			
		function stuAttenReport(){
			   
			    $school_code = $this->session->userdata("school_code");
				$data['school_code']=$school_code;
				$edate = $this->input->post("edate");
				$sec = $this->input->post("sectionid");
				$cla = $this->input->post("classid");
				$sdate = $this->input->post("sdate"); 
				$data['edate']=$edate;
				$data['sec']=$sec;
				$data['cla']=$cla;
				$data['sdate']=$sdate;
				$data['headerCss'] = 'headerCss/studentAttendanceCss';
	         	$data['footerJs'] = 'footerJs/studentAttendanceJs';
				
				$this->load->view("ajax/attenStuReport",$data);
			}
	
}