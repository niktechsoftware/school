<?php
class AdminController extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->is_login();
		$this->load->model("teacherModel");
		$this->load->model("adminModel");
	}

	function is_login(){
		$is_login = $this->session->userdata('is_login');
		$is_lock = $this->session->userdata('is_lock');
		$logtype = $this->session->userdata('login_type');
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
	function updatesequ(){
	  $j=  $this->input->post("rownum");
	    echo $j;
	    $arr=array();
	    for($i=1;$i<$j;$i++){
	        $fn="a".$i;
	        $fr ="r".$i;
	        $ro =$this->input->post($fr);
	        echo $ro."-";
	        
	        $arr[$ro] =$this->input->post($fn);
	    }
	    ksort($arr);
	    print_r($arr);
	  
	    for($i=1;$i<$j;$i++){
	       $this->db->where("id",$arr[$i]);
	      $sbv =  $this->db->get("subject")->row();
	      $data["subject"] =$sbv->subject; 
	      $data["class_id"] =$sbv->class_id;
	       $this->db->insert("subject",$data);
	     $nid =$this->db->insert_id();
	    
	   
	    $rid['subject_id']=$nid;
	     echo "1";
	   
	      $this->db->where("class_id",$sbv->class_id);
	       $this->db->where("fsd",25);
	      $this->db->where("subject_id",$sbv->id);
	    if($this->db->update("exam_info",$rid))
	    {
	         $this->db->where("class_id",$sbv->class_id);
	         $this->db->where("subject_id",$sbv->id);
	        $this->db->update("exam_max_subject",$rid);
	         $this->db->where("class_id",$sbv->class_id);
	         $this->db->where("subject_id",$sbv->id);
	        $this->db->update("time_table",$rid);
	        echo " update success";
	    }
	      $this->db->where("id",$sbv->id);
	    if($this->db->delete("subject")){
	        echo "delete Success";
	    }
	    
	    }
	    	redirect("exampanel/home_subseq/success");
	}
	
	function adminProfile(){
		$data['pageTitle'] = 'Admin Section';
		$data['smallTitle'] = 'Admin Profile';
		$data['mainPage'] = 'Admin Profile';
		$data['subPage'] = 'Edit or Update Profile';
		$profile = $this->adminModel->adminDetail();
		$data['profile'] = $profile;
		$data['title'] = 'Admin Profile';
		$data['headerCss'] = 'headerCss/adminProfileCss';
		$data['footerJs'] = 'footerJs/adminProfileJs';
		$data['mainContent'] = 'adminProfile';
		$this->load->view("includes/mainContent", $data);
	}
	
	function appleave()
	{
		 // $id=$this->input->post('id');
			$id=$this->uri->segment(3);
		  //print_r($id);exit();
          $leave= array(
          	'approve' =>'YES', 
          );
          $this->db->where('id',$id);
         $this->db->where('school_code',$this->session->userdata('school_code'));
		  $up=$this->db->update('stu_leave',$leave);
		  //print_r($up);exit();
          $this->db->where('id',$id);
         $this->db->where('school_code',$this->session->userdata('school_code'));
		  $leave=$this->db->get('stu_leave')->row();
		  
           $this->db->where('id',$leave->stu_id);
         //$this->db->where('school_code',$this->session->userdata('school_code'));
          $stu=$this->db->get('student_info')->row();
          	$this->db->where("school_code",$this->session->userdata('school_code'));
		$sende_Detail1=$this->db->get("sms_setting")->row();
          	$msg = "Dear Student ".$stu->name.",your leave request from ".$leave->start_date." to ".$leave->end_date." for reason ".$leave->reason." is Approved.";
		//echo $msg;exit;
			sms($stu->mobile,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
			redirect("index.php/login/index");
	}
	function deleleave()
	{

		$id=$this->uri->segment(3);
       $this->db->where('id',$id);
         $this->db->where('school_code',$this->session->userdata('school_code'));
          $leave=$this->db->get('stu_leave')->row();
           $this->db->where('id',$leave->stu_id);
        // $this->db->where('school_code',$this->session->userdata('school_code'));
          $stu=$this->db->get('student_info')->row();
		  $this->db->where('id',$id);
		  $this->db->where('school_code',$this->session->userdata('school_code'));
		   $up=$this->db->delete('stu_leave');
          	$this->db->where("school_code",$this->session->userdata('school_code'));
		$sende_Detail1=$this->db->get("sms_setting")->row();
          	$msg = "Dear Student ".$stu->name.",your leave request from ".$leave->start_date." to ".$leave->end_date." for reason ".$leave->reason." is Cancelled.";
		//echo $msg;exit;
			sms($stu->mobile,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
			redirect("index.php/login/index");
	}
	function appleaveemp()
	{

          $id=$this->uri->segment(3);
          $leave= array(
          	'status' =>1, 
          );
// print_r($id);exit();
          $this->db->where('id',$id);
         $this->db->where('school_code',$this->session->userdata('school_code'));
          $up=$this->db->update('emp_leave',$leave);
         
          $this->db->where('id',$id);
         $this->db->where('school_code',$this->session->userdata('school_code'));
          $leave=$this->db->get('emp_leave')->row();
          
           $this->db->where('id',$leave->emp_id);
         $this->db->where('school_code',$this->session->userdata('school_code'));
          $emp=$this->db->get('employee_info')->row();
          
          	$this->db->where("school_code",$this->session->userdata('school_code'));
		$sende_Detail1=$this->db->get("sms_setting")->row();
		
          	$msg = "Dear ".$emp->name.",your leave request from ".$leave->start_date." to ".$leave->end_date." for reason ".$leave->reason." is Approved.";
		echo $msg;
			sms($emp->mobile,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
redirect("index.php/login/index");
	}
	function deleleaveemp()
	{

           $id=$this->uri->segment(3);
    //print_r($id);exit;
    
         $this->db->where('id',$id);
         $this->db->where('school_code',$this->session->userdata('school_code'));
          $leave=$this->db->get('emp_leave')->row();
          
          $this->db->where('id',$id);
         $this->db->where('school_code',$this->session->userdata('school_code'));
          $up=$this->db->delete('emp_leave');
          
           $this->db->where('id',$leave->emp_id);
         $this->db->where('school_code',$this->session->userdata('school_code'));
          $emp=$this->db->get('employee_info')->row();
          
          	$this->db->where("school_code",$this->session->userdata('school_code'));
		$sende_Detail1=$this->db->get("sms_setting")->row();
// 		print_r($leave->start_date);
// 			print_r($leave->end_date);
// 			exit;
          	$msg = "Dear ".$emp->name.",your leave request from ".$leave->start_date." to ".$leave->end_date." for reason ".$leave->reason." is Cancelled.";
		//echo $msg;exit;
			sms($emp->mobile,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
redirect("index.php/login/index");
	}
	
	function updateAdminProfile(){
		$data = array(
				"school_name" => $this->input->post("your_school_name"),
				"director_name" => $this->input->post("director_name"),
				"principle_name" => $this->input->post("principle_name"),
				"wise_principle_name" => $this->input->post("wise_principle_name"),
				"language" => $this->input->post("language"),
				"attendence_type" => $this->input->post("attendance_type"),
				"school_recognition" => $this->input->post("school_recognition"),
				"registration_no" => $this->input->post("collage_registration_number"),
				"address1" => $this->input->post("address_1"),
				"address2" => $this->input->post("address_2"),
				"city" => $this->input->post("city"),
				"state" => $this->input->post("state"),
				"pin" => $this->input->post("pin"),
				"nationalty" => $this->input->post("nationality"),
				"mobile_no" => $this->input->post("mobile_number"),
				"other_mobile_no" => $this->input->post("other_mobile_no"),
				"phone_no" => $this->input->post("phone_no"),
				"fax_no" => $this->input->post("fax_number"),
				"email1" => $this->input->post("email1"),
				"email2" => $this->input->post("email2")
		);
		//print_r($data); exit();
		if($this->adminModel->updateAdminProfile($data)):
			$loginData = array(
					"school_name" => $this->input->post("your_school_name"),
					"address1" => $this->input->post("address_1"),
					"address2" => $this->input->post("address_2"),
					"city" => $this->input->post("city"),
					"state" => $this->input->post("state"),
					"pin" => $this->input->post("pin"),
					
					"mobile_no" => $this->input->post("mobile_number"),
					"name" => $this->input->post("principle_name")
			);
			$this->session->set_userdata($loginData);
			echo '<div class="alert alert-success">
					<button data-dismiss="alert" class="close">
						&times;
					</button>
					<strong>Done!</strong> Admin Profile successfully updated.
				</div>';
		else:
		echo '<div class="alert alert-danger">
					<button data-dismiss="alert" class="close">
						&times;
					</button>
					<strong>Somthing goes wrong...!</strong> Contact site administator.
				</div>';
		endif;
	}
	
	function changeAdminPassword(){
		$old_password = $this->input->post("old_password");
		$password = $this->input->post("password");
		$cPassword = $this->input->post("cPassword");
	//	print_r($password);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("admin_password",md5($old_password));
		$isPasswordMatched = $this->db->get("general_settings")->num_rows();
		if($cPassword != $password):
			echo '<div class="alert alert-danger">
					<button data-dismiss="alert" class="close">
						&times;
					</button>
					<strong>Re-Password not matched...!</strong> Please correct it first.
				</div>';
		elseif((strlen($cPassword) <= 0) || (strlen($password) <= 0) || (strlen($old_password) <= 0)):
		echo '<div class="alert alert-danger">
					<button data-dismiss="alert" class="close">
						&times;
					</button>
					<strong>Any field can not be blank...!</strong> Please correct it first.
				</div>';
		elseif($isPasswordMatched > 0):
			$data = array(
					"admin_password" => md5($password)
			);
			if($this->adminModel->updateAdminPassword($data)):
			echo '<div class="alert alert-success">
						<button data-dismiss="alert" class="close">
							&times;
						</button>
						<strong>Done!</strong> Admin Password successfully updated.
					</div>';
			else:
			echo '<div class="alert alert-danger">
						<button data-dismiss="alert" class="close">
							&times;
						</button>
						<strong>Somthing goes wrong...!</strong> Contact site administator.
					</div>';
			endif;
		else:
			echo '<div class="alert alert-danger">
					<button data-dismiss="alert" class="close">
						&times;
					</button>
					<strong>Password not matched...!</strong> Please try again.
				</div>';
		endif;
	}
	
	public function uploadAdminlogo(){
		$school_code = $this->session->userdata("school_code");
		$photo_name = time().trim($_FILES['logo']['name']);
		$photo_name = str_replace(' ', '_', $photo_name);
		$new_img = array(
				"logo"=> $photo_name
		);
	    
		$old_img = $this->input->post("old_img");
		@chmod("assets/".$school_code."/images/empImage/" . $old_img, 0777);
		@unlink("assets/".$school_code."/images/empImage/" . $old_img);
		$this->db->where("id",$this->session->userdata("school_code"));
		$query = $this->db->update("school",$new_img);
	
		if($query){
			$this->load->library('upload');
			// Set configuration array for uploaded photo.
			//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/empImage');
			$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			
			$image_path = $asset_name.$school_code.'/images/empImage';
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '1160';
			$config['file_name'] = $photo_name;
			// Upload first photo and create a thumbnail of it.
			if (!empty($_FILES['logo']['name'])) {
				$this->upload->initialize($config);
				if ($this->upload->do_upload('logo')) {
					// ---------------------------------- Redirect Success Page ----------------------
					$this->session->set_userdata("logo",$photo_name);
					redirect("index.php/adminController/adminProfile/true/updateInfo");
				}else{
					redirect("index.php/errorController");	
				}
			}
		}
	}
	public function uploadprinciple_sign(){
		$school_code = $this->session->userdata("school_code");
		$photo_name = time().trim($_FILES['logo']['name']);
		$photo_name = str_replace(' ', '_', $photo_name);
		$new_img = array(
				"principle_sign"=> $photo_name
		);
		$old_img = $this->input->post("old_img");
		@chmod("assets/".$school_code."/images/empImage/" . $old_img, 0777);
		@unlink("assets/".$school_code."/images/empImage/" . $old_img);
		$this->db->where("id",$this->session->userdata("school_code"));
		$query = $this->db->update("school",$new_img);
		if($query){
			$this->load->library('upload');
			// Set configuration array for uploaded photo.
			//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/empImage');
			$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/empImage';
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '1160';
			$config['file_name'] = $photo_name;
			// Upload first photo and create a thumbnail of it.
			if (!empty($_FILES['logo']['name'])) {
				$this->upload->initialize($config);
				if ($this->upload->do_upload('logo')) {
					// ---------------------------------- Redirect Success Page ----------------------
					$this->session->set_userdata("principle_sign",$photo_name);
					redirect("index.php/adminController/adminProfile/true/updateInfo");
				}else{
					redirect("index.php/errorController");	
				}
			}
		}
	}
	
	public function uploadAdminPicture(){
		
		$photo_name = time().trim($_FILES['logo']['name']);
		$school_code = $this->session->userdata("school_code");
		$photo_name = str_replace(' ', '_', $photo_name);
		$new_img = array(
				"ico_logo"=> $photo_name
		);
		
		$old_img = $this->input->post("old_img");
		@chmod("assets/".$school_code."/images/empImage/" . $old_img, 0777);
		@unlink("assets/".$school_code."/images/empImage/" . $old_img);
		
		$this->db->where("id",$this->session->userdata("school_code"));
		$query = $this->db->update("school",$new_img);
		if($query){
			
			$this->load->library('upload');
			// Set configuration array for uploaded photo.
			//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/empImage');
			$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/empImage';
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '100';
			$config['file_name'] = $photo_name;
			// Upload first photo and create a thumbnail of it.
			if (!empty($_FILES['logo']['name'])) {
				
				$this->upload->initialize($config);
				if ($this->upload->do_upload('logo')) {
					// ---------------------------------- Redirect Success Page ----------------------
					$this->session->set_userdata("photo",$photo_name);
					redirect("index.php/adminController/adminProfile/true/updateInfo");
				}else{
					redirect("index.php/errorController");	
				}
			}
		}
	}
	
	public function defineHomeWork(){
		$school_code = $this->session->userdata("school_code");
	$data['pageTitle'] = 'Define HomeWork';
	$data['smallTitle'] = 'Employee/Teacher/Student';
	$data['mainPage'] = 'Define HomeWork';
	$data['subPage'] = 'Employee/Teacher/Student';
	$res=$this->db->query("SELECT * FROM class_section WHERE school_code='$school_code'");
	$data['noc'] = $res->result();
	$data['title'] = 'Define HomeWork';
	$data['headerCss'] = 'headerCss/homeWorkCss';
	$data['footerJs'] = 'footerJs/homeWorkJs';
	$data['mainContent'] = 'studentHomeWork';
	$this->load->view("includes/mainContent", $data);
}

function showHomeWork()
{
		$school_code=$this->session->userdata('school_code');
	$this->load->model("homeWorkModel");
	$data['pageTitle'] = 'Show HomeWork';
	$data['smallTitle'] = 'Employee/Teacher/Student';
	$data['mainPage'] = 'Show HomeWork';
	$data['subPage'] = 'Employee/Teacher/Student';
//	$res=$this->db->query("SELECT DISTINCT class_name FROM class_info");
	
	//$data['var1']=$va->result();
	$data['title'] = 'Show HomeWork';
	$data['headerCss'] = 'headerCss/homeWorkCss';
	$data['footerJs'] = 'footerJs/showHomeWorkJs';
	$data['mainContent'] = 'showHomeWork';
	$this->load->view("includes/mainContent", $data);

	
}
}