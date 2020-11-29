<?php class EmployeeController extends CI_Controller{
		public function __construct(){
		parent::__construct();
			$this->is_login();
		$this->load->model("employeeModel");
		$this->load->model("daybookmodel");
	}
		function is_login(){
		$is_login = $this->session->userdata('is_login');
	
		if(($is_login != true)){
			
			redirect("index.php/homeController/index");
		}
	
	}

	function employeeList(){
		$data['result'] = $this->employeeModel->employeeList($this->session->userdata("school_code"));
		$data['name'] = $this->input->post("name");
		$data['username'] = $this->input->post("username");
		$data['job_title'] = $this->input->post("job_title");
		$data['mobile'] = $this->input->post("mobile");
		$data['address'] = $this->input->post("address");
		$data['email'] = $this->input->post("email");
		$data['category'] = $this->input->post("category");
		$data['dob'] = $this->input->post("dob");
		$data['job_category'] = $this->input->post("job_category");
		$data['qualification'] = $this->input->post("qualification");
		$data['experiance'] = $this->input->post("experiance");
		$data['status'] = 1;
		$data['city'] = $this->input->post("city");
		$data['state'] = $this->input->post("state");
		$data['pin_code'] = $this->input->post("pin_code");
		$data['phone'] = $this->input->post("phone");
		$data['join_date'] = $this->input->post("join_date");
		$data['gender'] = $this->input->post("gender");
		$data['school_code'] = $this->session->userdata("school_code");
		
		
		$this->load->view("ajax/employeeList",$data);
	}
	
		public function empicard(){
		$data['pageTitle'] = 'Employee Section';
		$data['smallTitle'] = 'Employee Profile';
		$data['mainPage'] = 'Employee';
		$data['subPage'] = 'Profile';

		$data['title'] = 'Employee Profile';
		$data['headerCss'] = 'headerCss/employeeProfileCss';
		$data['footerJs'] = 'footerJs/employeeProfileJs';
		$data['mainContent'] = 'empicard';
		$this->load->view("includes/mainContent", $data);
	}
	function addemployee(){
		$data['pageTitle'] = 'Employee Section';
		$data['smallTitle'] = 'Employee Registration';
		$data['mainPage'] = 'Employee';
		$data['subPage'] = 'Employee Registration';
		$this->load->model('allFormModel');
		$state = $this->allFormModel->getState()->result();
		$data['state'] = $state;
		$data['title'] = 'Employee Registration';
		$data['headerCss'] = 'headerCss/addEmployeeCss';
		$data['footerJs'] = 'footerJs/addEmployeeJs';
		$data['mainContent'] = 'addemployee';
		$this->load->view("includes/mainContent", $data);
	}
	function addEmpInfo(){ 
	$school_code = $this->session->userdata("school_code");
			$this->db->from('employee_info');
			$id1 = $this->db->query("SELECT MAX(maxcount) as maxnumber From employee_info where school_code ='$school_code'");
			 if($id1->num_rows()>0){
			$id = $id1->row()->maxnumber;
			}else{
			
			$id=0;
		}
			$db=$this->db->get('db_name')->row()->name;
			$maxusername=$id+1;
			$eid1 = 9000+$maxusername;
			$eid=$db.$school_code.'E' .$eid1;
		
		$this->form_validation->set_error_delimiters('<div class="col-sm-12"><label class="text-danger">', '</label></div>');
	//	$this->form_validation->set_rules('jobTitle','Job Title', 'trim|required');
		$this->form_validation->set_rules('jobCategory','Job Category', 'trim|required');
		$this->form_validation->set_rules('empName','Full Name', 'trim|required');
		$this->form_validation->set_rules('standered','standered', 'trim|required');
		//$this->form_validation->set_rules('empMiddleName','Middle Name', 'trim');
		$this->form_validation->set_rules('empDob','Date Of Birth', 'trim|required');
		$this->form_validation->set_rules('gender','Gender', 'trim|required');
		$this->form_validation->set_rules('experience','Experience', 'trim|required');
		$this->form_validation->set_rules('employeeAddLine1','Address', 'trim|required');
		$this->form_validation->set_rules('empState','State', 'trim|required');		
		$this->form_validation->set_rules('empCity','City', 'trim|required');
		$this->form_validation->set_rules('empPin','PIN', 'trim|required');
		$this->form_validation->set_rules('j_date','Joining Date', 'trim|required');
		//$this->form_validation->set_rules('employeeAddLine2','Area', 'trim|required');
		$this->form_validation->set_rules('empmobileNumber','Mobile Number','trim|required|numeric|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('password','Password', 'trim|required');
		$this->form_validation->set_rules('re-password','Re-Password', 'trim|required|matches[password]');
		
		$this->form_validation->set_rules("empBnakName",'Bnak Name','trim');
		$this->form_validation->set_rules("empAccountNumber",'Account Number', 'trim');
		$this->form_validation->set_rules("empIfscCode",'Ifsc Code', 'trim');
		$this->form_validation->set_rules("empBranchName",'Branch Name', 'trim');
		$this->form_validation->set_rules("empBankAddress",'Bank Address', 'trim');
		$this->form_validation->set_rules("empPayeeName",'Payee Name', 'trim');
		
		$this->form_validation->set_rules("empemail",'Email', 'trim');
		$this->form_validation->set_rules("empQualification",'Qualification', 'trim');
		$this->form_validation->set_rules("empPhoneNumber",'Phone Number', 'trim');
		
		if($this->form_validation->run() == FALSE){
		   $this->addemployee();
			//echo validation_errors(); 
		}
		else{
			//$fsd=$this->db->get('fsd')->row()->id;
			$dataemp = array(
					//"emp_no" => $eid,
					"job_title" => $this->input->post("jobTitle"),
					"job_category" => $this->input->post("jobCategory"),
					"standered" => $this->input->post("standered"),
					"name" => $this->input->post("empName"),
					"maxcount" => $maxusername,
					//"mid_name" => $this->input->post("empMiddleName"),
					//"last_name" => $this->input->post("empLastName"),
					"dob" => $this->input->post("empDob"),
					"gender" => $this->input->post("gender"),
					"category" => $this->input->post("empCategory"),
					"qualification" => $this->input->post("empQualification"),
					"experiance" => $this->input->post("experience"),
					"join_date" => $this->input->post("j_date"),
					"address" => $this->input->post("employeeAddLine1"),
					//"address2" => $this->input->post("employeeAddLine2"),
					"city" => $this->input->post("empCity"),
					"state" => $this->input->post("empState"),
					"pin_code" => $this->input->post("empPin"),
					"country" => $this->input->post("empCountry"),
					//"phone" => $this->input->post("empPhoneNumber"),
					"mobile" => $this->input->post("empmobileNumber"),
					"status" => 1,
					"email" => $this->input->post("empemail"),
					"username" => $eid,
					"password" =>$this->input->post("password"),
					"school_code"=>$this->session->userdata("school_code"),
					"fsd"=>$this->session->userdata("fsd")
			);
			$this->load->Model("employeeModel");
			$addInfoConfirm = $this->employeeModel->addEmployeeInfo($dataemp);
			$this->db->where('username',$eid);
			$empid=$this->db->get('employee_info')->row()->id;
			$dataempbank = array(
					"employee_id" => $empid,
					"bank_name" => $this->input->post("empBnakName"),
					"account_number" => $this->input->post("empAccountNumber"),
					"ifsc_code" => $this->input->post("empIfscCode"),
					"branch_name" => $this->input->post("empBranchName"),
					"branch_address" => $this->input->post("empBankAddress"),
					"bank_payee_name" => $this->input->post("empPayeeName"),
					//"school_code"=>$this->session->userdata("school_code")
			);
		    
				$addInfoConfirm1 = $this->employeeModel->addEmployeeBankDetail($dataempbank);
		
		if($addInfoConfirm && $addInfoConfirm1 ){
					//---------------------------------------------- CHECK SMS SETTINGS -----------------------------------------
					 $this->load->model("smsmodel");
					 $sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
					 $sende_Detail =$sender->row();
					 $isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
						
					if($isSMS->admission)
					{
						
						$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
						$master_id=$max_id->maxid+1;
					 	$school = $this->session->userdata("your_school_name");
					 	$f_name=$this->input->post("empName");
					 	$username = $eid;
					 	$password = $this->input->post("password");
					 	$f_mobile = $this->input->post("empmobileNumber");
					 	$msg="Dear Employee ".$f_name." welcome to ".$school.". Your Employee ID= ".$username." and Password=".$password.". Now You can login and get manage all school updates click .".$sende_Detail->web_url." Thanks for Reliance.Principal ".$school;
						$getv=mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$f_mobile);
					 	$this->smsmodel->sentmasterRecord($msg,2,$master_id,$getv);
					 }
					//---------------------------------------------- END CHECK SMS SETTINGS -----------------------------------------
				    $rtype="employee";
					//redirect("index.php/api/common_user/$rtype");
					redirect("index.php/employeeController/employeeProfile/$eid");
				}
			}
		}
		
		function quickreg(){
			$data['pageTitle'] = 'Employee Section';
			$data['smallTitle'] = 'Employee Registration ';
			$data['mainPage'] = 'Employee Registration';
			$data['subPage'] = 'Manage or Print Profile';
			$data['title'] = 'Employee Section';
			$data['headerCss'] = 'headerCss/addEmployeeCss';
			$data['footerJs'] = 'footerJs/addEmployeeJs';
			$data['mainContent'] = 'quickempreg';
			$this->load->view("includes/mainContent", $data);
		}

		function quickreginsert()
		{
	        $school_code = $this->session->userdata("school_code");
			$this->db->from('employee_info');
			$id1 = $this->db->query("SELECT MAX(maxcount) as maxnumber From employee_info where school_code ='$school_code'");
			 if($id1->num_rows()>0){
			$id = $id1->row()->maxnumber;
			}else{
			
			$id=0;
		}
			$db=$this->db->get('db_name')->row()->name;
			$maxusername=$id+1;
			$eid1 = 9000+$maxusername;
			$eid=$db.$school_code.'E' .$eid1;
		
		$this->form_validation->set_error_delimiters('<div class="col-sm-12"><label class="text-danger">', '</label></div>');
		
		$this->form_validation->set_rules('empName','Full Name', 'trim|required');
		
		$this->form_validation->set_rules('gender','Gender', 'trim|required');
		$this->form_validation->set_rules('standered','standered', 'trim|required');
		$this->form_validation->set_rules('employeeAddLine1','Address', 'trim|required');
		$this->form_validation->set_rules('j_date','Joining Date', 'trim|required');
		$this->form_validation->set_rules('empmobileNumber','Mobile Number','trim|required|numeric|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('password','Password', 'trim|required');
		$this->form_validation->set_rules('re-password','Re-Password', 'trim|required|matches[password]');
		if($this->form_validation->run() == FALSE){
			$this->quickreg();
		}
		else
		{
			$fsd=$this->db->get('fsd')->row()->id;
            $dataemp = array(
				"name" => $this->input->post("empName"),
				"maxcount" => $maxusername,
				"gender" => $this->input->post("gender"),
				"join_date" => $this->input->post("j_date"),
				"standered" => $this->input->post("standered"),
				"address" => $this->input->post("employeeAddLine1"),
				"mobile" => $this->input->post("empmobileNumber"),
				"status" => 1,
				"username" => $eid,
                "job_category" => $this->input->post("jobCategory"),
				"password" =>$this->input->post("password"),
				"school_code"=>$this->session->userdata("school_code"),
				"fsd"=>$fsd
		);
	
	     	$this->load->Model("employeeModel");
			$addInfoConfirm = $this->employeeModel->quickEmpInfo($dataemp);

			if($addInfoConfirm){
				//---------------------------------------------- CHECK SMS SETTINGS -----------------------------------------
				 $this->load->model("smsmodel");
				 $sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
				 $sende_Detail =$sender->row();
				 $isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
					
				 if($isSMS->admission)
				 {
				 	$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
				 	$master_id=$max_id->maxid+1;
					$school = $this->session->userdata("your_school_name");
				 	$f_name=$this->input->post("empName");
					$username = $eid;
				 	$password = $this->input->post("password");
				 	$f_mobile = $this->input->post("empmobileNumber");
				 	$msg="Dear Employee ".$f_name." welcome to ".$school.". Your Employee ID= ".$username." and Password=".$password.". Now You can login and Manage all school updates click .".$sende_Detail->web_url." Thanks for Reliance.Principal ".$school;
				// 	sms($f_mobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
				 	$getv=mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$f_mobile);

				 	$this->smsmodel->sentmasterRecord($msg,2,$master_id,$getv);
				 }
				//---------------------------------------------- END CHECK SMS SETTINGS -----------------------------------------
				$rtype="employee";

				redirect("index.php/employeeController/employeeProfile/$eid");
			}
		}

		}
	
function updateSalary(){
		$emp_id =$this->input->post("empid");
		$data = array(
			
			"basicSalary" => $this->input->post("basic"),
			"ProvidentFund" => $this->input->post("pf"),
			"employeeStateInsurance" => $this->input->post("esi"),
			"medicalAllowance" => $this->input->post("ma"),
			"transportAllowance" => $this->input->post("ta"),
			"dearnessAllowance" => $this->input->post("da"),
			"houseRentAllowance" => $this->input->post("ha"),
			"skillAllowance" => $this->input->post("sa"),
			"spcialAllowance" => $this->input->post("spa"),
			"encentieve" => $this->input->post("encentieve"),
			"bonus" => $this->input->post("bonus"),
			"gross_s" => $this->input->post("gross_s"),
			"created" =>date("Y-m-d"),
			"fsd" =>$this->session->userdata('fsd'),
		  "school_code"=>$this->session->userdata("school_code")
		);
		$this->db->where("emp_id",$emp_id);
		$this->db->update("emp_salary_struct",$data);
		redirect("login/employeeSalary");
	}
	
    function empreport()
	{
            $v=$this->uri->segment(3);
		$emp_id = $this->input->post("emp_id");
			$edate = $this->input->post("edate");
			$sdate = $this->input->post("sdate");
			$school_code = $this->session->userdata("school_code");
			$this->db->where('username',$emp_id);
			$emp=$this->db->get('employee_info')->row();
			$empid=$emp->id;
			$this->db->where('school_code',$school_code);
			$this->db->where('emp_id',$empid);
			$this->db->where('a_date >=',$sdate);
			$this->db->where('a_date <=',$edate);
			$var=$this->db->get('teacher_attendance');
			// $var = $this->db->query("SELECT * FROM teacher_attendance WHERE school_code='$school_code' AND emp_id='$empid' AND  a_date >= '$sdate' and a_date <='$edate'");
	
		if($var->num_rows() > 0){
				$sr = 1;
				?>		<table class="table table-striped table-hover" id="sample_2">
											<thead>
												<tr>
													<th>S.no.</th>
													<th>Date</th>
													<th>Present/Absent</th>
												</tr>
											</thead>
											<tbody>
												<?php 
							  			 foreach ($var->result() as $row){	
							  				?><tr>
							  					<td><?php echo $sr;?></td>
							  					<td><?php echo $stuID = $row->a_date; ?></td>
							  					<td>
							  					<?php 
							  					$atten=$row->attendance;
							  							if($atten==1){
							  							?><?php echo "<span class='text-success'>Present</span>";}
							  							else { if ($atten==0){ 
							  								echo "<span class='text-danger'>Absent</span>";
							  							}else echo "<span class='text-warning'>Leave</span>";}?>
							  							</td>
								  			</tr>
								  			<?php 
							  		$sr++;	
							  			}?>
											</tbody>
										</table>
							  			<?php 
							  		}else{ echo "<label style='color:red;'>No Record Found<label>";}

							  		
	}


    function employeeProfile()
	{
		$data['pageTitle'] = 'Employee Section';
		$data['smallTitle'] = 'Employee Profile';
		$data['mainPage'] = 'Employee Profile';
		$data['subPage'] = 'Manage or Print Profile';
		$empNo = $this->uri->segment(3); 
// 		$this->db->where('username',$empNo);
// 		$empid=$this->db->get('employee_info')->row()->id;
		$this->load->model("employeeModel");
		$profile = $this->employeeModel->getEmployeProfile($empNo);
		$data['profile'] = $profile;
		$data['title'] = 'Employee/Section';
		$data['headerCss'] = 'headerCss/employeeProfileCss';
		$data['footerJs'] = 'footerJs/employeeProfileJs';
		$data['mainContent'] = 'employeeProfile';
		$this->load->view("includes/mainContent", $data);
	}
	 
	function updateProfile(){
		$empNo = $this->input->post("empId");
// 		$this->db->where('username',$empNo);
// 		$this->db->where('school_code',$this->session->userdata('school_code'));
// 		$empid=$this->db->get('employee_info')->row()->id;
		$data = array(
			'name' => $this->input->post("firstName"),
			'category' => $this->input->post("category"),
			'dob' => $this->input->post("dob"),
			'gender' => $this->input->post("gender"),
			'job_category' => $this->input->post("job_category"),
			'qualification' => $this->input->post("qualification"),
			'experiance' => $this->input->post("experiance"),
			'status' =>  $this->input->post("status"),
			'address' => $this->input->post("address1"),
			//'address2' => $this->input->post("address2"),
			'city' => $this->input->post("city"),
			'state' => $this->input->post("state"),
			'pin_code' => $this->input->post("pincode"),
			'country' => $this->input->post("country"),
			//'phone' => $this->input->post("phone"),
			'mobile' => $this->input->post("mobile"),
			'email' => $this->input->post("email"),
			//"school_code"=>$this->session->userdata("school_code"),
			'password' => $this->input->post("password")
		);
	//	print_r($data);
		$result = $this->employeeModel->updateEmployeProfile($empNo,$data);
		if($result):
			echo '<div class="alert alert-success">
					<button data-dismiss="alert" class="close">
						&times;
					</button>
					<strong><i class="fa fa-thumbs-o-up"></i> Done!</strong> You successfully Changed the profile... <i class="fa fa-smile-o"></i>
					
				</div>';
		else:
			echo '<div class="alert alert-danger">
						<button data-dismiss="alert" class="close">
							&times;
						</button>
						<strong><i class="fa fa-thumbs-o-down"></i> Oh Shit !</strong>
						Somthing is wrong ! contact your developer.... <i class="fa fa-meh-o"></i>
				 </div>';
		endif;

	}
	
		function updateBankInformation(){
		$empNo = $this->input->post("empId");
		$bankdata = array(
			'bank_name' => $this->input->post("bank"),
			'account_number' => $this->input->post("ac"),
			'ifsc_code' => $this->input->post("bankadd"),
			'branch_name' => $this->input->post("payee"),
			'branch_address' => $this->input->post("ifsc"),
			'bank_payee_name' => $this->input->post("branchname")
		);
		$data = $this->employeeModel->updateEmployeeBankProfile($empNo,$bankdata);
		if($data):
			echo '<div class="alert alert-success">
					<button data-dismiss="alert" class="close">
						&times;
					</button>
					<strong><i class="fa fa-thumbs-o-up"></i> Done!</strong> You successfully Changed the profile... <i class="fa fa-smile-o"></i>
					
				</div>';
		else:
			echo '<div class="alert alert-danger">
						<button data-dismiss="alert" class="close">
							&times;
						</button>
						<strong><i class="fa fa-thumbs-o-down"></i> Oh Shit !</strong>
						Somthing is wrong ! contact your developer.... <i class="fa fa-meh-o"></i>
				 </div>';
		endif;
	}

	//----------------------------------------------- Upload Image of Employee ----------------------------------
	
	 function uploadEmployeeImage(){
		$school_code = $this->session->userdata("school_code");
		$id = $this->input->post('c_id');
        $photo_name = time().$_FILES['empImage']['name'];
        $photo_name = str_replace(' ', '_', $photo_name);
        $new_img = array(
            "photo"=> $photo_name
        );
        $old_img = $this->input->post("old_img");
        @chmod("assets/".$school_code."/images/empImage/" . $old_img, 0777);
        @unlink("assets/".$school_code."/images/empImage/" . $old_img);
        if($query = $this->employeeModel->updateImage($new_img)){
            $this->load->library('upload');
            // Set configuration array for uploaded photo.
            //$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/empImage');
			$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/empImage';
            $config['upload_path'] = $image_path;
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '1024';
            $config['file_name'] = $photo_name;
            // Upload first photo and create a thumbnail of it.
			if (!empty($_FILES['empImage']['name'])) 
			{
                $this->upload->initialize($config);
                if ($this->upload->do_upload('empImage')) {
                    // ---------------------------------- Redirect Success Page ----------------------
                	if(($this->session->userdata("login_type") != "admin") && ($this->session->userdata("login_type") != "student")){ 
						$this->session->set_userdata("photo",$photo_name);
						
					}
					redirect("index.php/employeeController/employeeProfile/$id/updateInfo","refresh");
                   
				}
				else
				{
					redirect("index.php/errorController","refresh");
				}
            }
		}
		
	}

	function active_employee(){
	   $usernam= $this->uri->segment(3);
	   $this->db->where("username",$usernam);
	   $data=$this->db->get("employee_info");
	   if($data->num_rows()>0){
	      $row= $data->row();
	      if($row->status==0){
	          $arr = array(
	              "status" => 1
	              );
	            $this->db->where("username",$usernam);
	           $data=$this->db->update("employee_info",$arr); 
	           redirect("login/employeeList");
	      }
	      else{
	           $arr = array(
	              "status" => 0
	              );
	            $this->db->where("username",$usernam);
	           $data=$this->db->update("employee_info",$arr); 
	            redirect("login/employeeList");
	      }
	      
	   }
	   
	    
	}
	
	 function uploadEmployeeCertificates(){
		$id = $this->input->post('c_id');
		$school_code=$this->session->userdata('school_code');
		$Certificate = time().trim($_FILES['employeeCertificates']['name']);
		$Certificate = str_replace(' ', '_', $Certificate);
		$new_img = array(
				"qualification_img"=> $Certificate
		);
		$old_img = $this->input->post("old_rar");
		@chmod("assets/".$school_code."/images/empImage/" . $old_img, 0777);
		@unlink("assets/".$school_code."/images/empImage/" . $old_img);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		if($query = $this->employeeModel->updateImage($new_img)){
			$this->load->library('upload');
			$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/empImage'; 
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'jpeg|jpg|png|gif';
			$config['max_size'] = '1024';
			$config['file_name'] = $Certificate;
			// Upload first photo and create a thumbnail of it.
			if (!empty($_FILES['employeeCertificates']['name'])) {
				$this->upload->initialize($config);
				if ($this->upload->do_upload('employeeCertificates')) {
					// ---------------------------------- Redirect Success Page ----------------------
					$this->session->set_userdata("photo",$Certificate);
					redirect("index.php/employeeController/employeeProfile/$id/certificate");
				}
				
				else{
					redirect("index.php/errorController");	
				}
			}
			
		}
	}
	
	 function uploadEmployeeNoc(){
		$id = $this->input->post('c_id');
	$school_code=$this->session->userdata('school_code');
		$photo_name = time().trim($_FILES['empImage1']['name']);
		$photo_name = str_replace(' ', '_', $photo_name);
		$new_img = array(
				"noc_latter"=> $photo_name
		);
		$old_img = $this->input->post("old_img");
		@chmod("assets/".$school_code."/images/empImage/" . $old_img, 0777);
		@unlink("assets/".$school_code."/images/empImage/" . $old_img);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		if($query = $this->employeeModel->updateImage($new_img)){
			$this->load->library('upload');
			// Set configuration array for uploaded photo.
			//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/empImage');
			$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/empImage';
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '1024';
			$config['file_name'] = $photo_name;
			// Upload first photo and create a thumbnail of it.
			if (!empty($_FILES['empImage1']['name'])) {
				$this->upload->initialize($config);
				if ($this->upload->do_upload('empImage1')) {
					// ---------------------------------- Redirect Success Page ----------------------
					$this->session->set_userdata("photo",$photo_name);
					redirect("index.php/employeeController/employeeProfile/$id/certificate");
				}
				else
				{
					redirect("index.php/errorController");
				}
			}
			
		}
	}
	
	//------------------------------------------------------------------
	
	 function uploadEmployeeExperience(){
		$id = $this->input->post('c_id');
	$school_code =$this->session->userdata("school_code");
		$photo_name = time().trim($_FILES['empImage2']['name']);
		$photo_name = str_replace(' ', '_', $photo_name);
		$new_img = array(
				"exprience_certificate"=> $photo_name
		);
		$old_img = $this->input->post("old_img");
		@chmod("assets/".$school_code."/images/empImage/" . $old_img, 0777);
		@unlink("assets/".$school_code."/images/empImage/" . $old_img);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		if($query = $this->employeeModel->updateImage($new_img)){
			$this->load->library('upload');
			// Set configuration array for uploaded photo.
			//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/empImage');
			$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/empImage';
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '1024';
			$config['file_name'] = $photo_name;
			// Upload first photo and create a thumbnail of it.
			if (!empty($_FILES['empImage2']['name'])) {
				$this->upload->initialize($config);
				if ($this->upload->do_upload('empImage2')) {
					// ---------------------------------- Redirect Success Page ----------------------
					$this->session->set_userdata("photo",$photo_name);
					redirect("index.php/employeeController/employeeProfile/$id/certificate");
				}
				else
				{
					redirect("index.php/errorController");
				}
				
			}
			
		}
	}
	//------------------------------------------------------------------------------------
	 function uploadEmployeeAddress(){
		$id = $this->input->post('c_id');
	$school_code=$this->session->userdata('school_code');
		$photo_name = time().trim($_FILES['empImage3']['name']);
		$photo_name = str_replace(' ', '_', $photo_name);
		$new_img = array(
				"living_id"=> $photo_name
		);
		$old_img = $this->input->post("old_img");
		@chmod("assets/".$school_code."/images/empImage/" . $old_img, 0777);
		@unlink("assets/".$school_code."/images/empImage/" . $old_img);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		if($query = $this->employeeModel->updateImage($new_img)){
			$this->load->library('upload');
			// Set configuration array for uploaded photo.
			//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/empImage');
			$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/empImage';
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '1024';
			$config['file_name'] = $photo_name;
			// Upload first photo and create a thumbnail of it.
			if (!empty($_FILES['empImage3']['name'])) {
				$this->upload->initialize($config);
				if ($this->upload->do_upload('empImage3')) {
					// ---------------------------------- Redirect Success Page ----------------------
					$this->session->set_userdata("photo",$photo_name);
					redirect("index.php/employeeController/employeeProfile/$id/certificate");
				}
				else
				{
					redirect("index.php/errorController");
				}
			}
			
		}
	}
	//-------------------------------------------------------------------------
	function uploadEmployeePhoto(){
		$id = $this->input->post('c_id');
	$school_code=$this->session->userdata('school_code');
		$photo_name = time().trim($_FILES['empImage4']['name']);
		$photo_name = str_replace(' ', '_', $photo_name);
		$new_img = array(
				"photo_id"=> $photo_name
		);
		$old_img = $this->input->post("old_img");
		@chmod("assets/".$school_code."/images/empImage/" . $old_img, 0777);
		@unlink("assets/".$school_code."/images/empImage/" . $old_img);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		if($query = $this->employeeModel->updateImage($new_img)){
			$this->load->library('upload');
			// Set configuration array for uploaded photo.
			//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/empImage');
			$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/empImage';
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '1024';
			$config['file_name'] = $photo_name;
			// Upload first photo and create a thumbnail of it.
			if (!empty($_FILES['empImage4']['name'])) {
				$this->upload->initialize($config);
				if ($this->upload->do_upload('empImage4')) {
					// ---------------------------------- Redirect Success Page ----------------------
					$this->session->set_userdata("photo",$photo_name);
					redirect("index.php/employeeController/employeeProfile/$id/certificate");
				}
				else
				{
					redirect("index.php/errorController");
				}
			}
			
		}
	}
	
	function staff(){
		$staff_id = $this->input->post("staff_id");
		//print_r($staff_id);
		$emp=$this->employeeModel->getstaffvalue($staff_id);
		if($emp->num_rows() > 0)
		{
		 ?>
		<div class="alert alert-success">
			<button data-dismiss="alert" class="close">
				&times;
			</button>
			ID Found ! <strong><?php echo $emp->row()->name; ?>
		   </strong>
	    </div>
		<button id = "pro" class="btn btn-dark-purple">
			Get Detail <i class="fa fa-arrow-circle-right"></i>
		</button>
	    <?php 
		}else{
		?>
			<div class="alert alert-danger">
				<button data-dismiss="alert" class="close">
					&times;
				</button>
				Sorry :( <strong><?php echo "Staff Not Found ! Wrong Staff Id"; ?></strong>
			</div>
		<?php
			
		}
	}
	function editstaff(){
		$jobcat=$this->input->post('jobCategory');
		if($jobcat>0)
		{
		$uname=$this->input->post('uname');
		$data=array(
			"job_category"=>$jobcat
		);
		$this->db->where('username',$uname);
		$this->db->update('employee_info',$data);
		
// print_r($jobcat);
// print_r($uname);
 echo "Updated";
	}
	

	}

	function staffcategory(){
		$data['pageTitle'] = 'Staff Category';
		$data['smallTitle'] = 'Change Staff Category';
		$data['mainPage'] = 'Change Staff Category';
		$data['subPage'] = 'Change Staff Category';
		$data['title'] = 'Change Staff Category';
		$data['headerCss'] = 'headerCss/staffcategory';
		$data['footerJs'] = 'footerJs/staffcategory';
		$data['mainContent'] = 'ajax/staffcategory';
		$this->load->view("includes/mainContent", $data);
	}
	
	function salaryDetail(){
		$empId =$this->input->post("empId");
	}
	
      function configsalary(){
		$eid = $this->input->post("eid");
		$ename = $this->input->post("ename");
		$this->load->model("employeeModel");
		$this->load->model("teacherModel");
		$qres = $this->employeeModel->getSalaryDetail($eid);
		
		
			$data['eid'] = $eid;
			$data['ename'] = $ename;
			$data['qres'] = $qres;
		
		
			$this->load->view("ajax/isSalConfigFalse",$data);	
	}
	function salary(){
		$eid = $this->input->post("eid");
		$ename = $this->input->post("ename");
		$this->load->model("employeeModel");
		$this->load->model("teacherModel");
		$qres = $this->employeeModel->getSalaryDetail($eid);
		if($qres->num_rows()>0)
		{
			$data['eid'] = $eid;
			$data['ename'] = $ename;
			$data['qres'] = $qres;
			$this->load->view("ajax/isSalConfigTrue",$data);
			}
		else
		{	
			$data['eid'] = $eid;
			$data['ename'] = $ename;
			$data['qres'] = $qres;
			$this->load->view("ajax/isSalConfigFalse",$data);
		}		
	}
	
	function configureSalary(){
		$data = array(
			"emp_id" => $this->input->post("empid"),
			"basicSalary" => $this->input->post("basicSalary"),
			"ProvidentFund" => $this->input->post("ProvidentFund"),
			"employeeStateInsurance" => $this->input->post("employeeStateInsurance"),
			"medicalAllowance" => $this->input->post("medicalAllowance"),
			"transportAllowance" => $this->input->post("transportAllowance"),
			"dearnessAllowance" => $this->input->post("dearnessAllowance"),
			"houseRentAllowance" => $this->input->post("houseRentAllowance"),
			"skillAllowance" => $this->input->post("skillAllowance"),
			"spcialAllowance" => $this->input->post("spcialAllowance"),
			"encentieve" => $this->input->post("encentieve"),
			"bonus" => $this->input->post("bonus"),
			"gross_s" => $this->input->post("gross_s"),
			"created" =>date("Y-m-d"),
			"fsd" =>$this->session->userdata('fsd'),
		  "school_code"=>$this->session->userdata("school_code")
		);
		$this->db->insert("emp_salary_struct",$data);
		redirect("login/employeeSalary");
	}
	
	function saveSalary(){

	    $school_code=$this->session->userdata("school_code");
		$abc = $this->input->post("diposit_month");
		foreach($abc as $a){
			if($a == 'advance'){
				$diposit_month = 0;
				continue;
			}else{
				$diposit_month = sizeof($this->input->post("diposit_month"));
			}
		}
	
		$this->db->select("SUM(monthNo) as month");
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("emp_id",$this->input->post("empid"));
		$month = $this->db->get("emp_salary_info")->row()->month;
		$fsd = $this->input->post("fsd");
        $this->db->where('id',$fsd);
        $this->db->where('school_code',$this->session->userdata("school_code"));
        $fsdstart1=$this->db->get('fsd')->row();
        $fsdstart=$fsdstart1->finance_start_date;
		$totalMonth = $diposit_month + $month;
		$till_date = date("Y-m-d",strtotime("$fsdstart + $totalMonth month"));
	
		//invoice number logic start
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$invoice = $this->db->count_all("invoice_serial");
		//$invoice_number = $invoice + 1000;
			$invoice1=6000+$invoice;
		$invoice_number = $school_code."I".$invoice1;
		$invoiceDetail = array(
				"invoice_no" => $invoice_number,
				"heads" => "Employee Salary",
				"invoice_date" => date("Y-m-d"),
				"school_code"=>$this->session->userdata("school_code")
		);
		$this->db->insert("invoice_serial",$invoiceDetail);
		//invoice number logic end
	
		$data = array(
				"emp_id" => $this->input->post("empid"),
				"provide_by" => $this->session->userdata("username"),
				"pay_mode"=>"Cash",//$this->input->post("payment_mode"),
				"basicSalary" => $this->input->post("basicSalary"),
				"ProvidentFund" => $this->input->post("ProvidentFund"),
				"employeeStateInsurance" => $this->input->post("employeeStateInsurance"),
				"medicalAllowance" => $this->input->post("medicalAllowance"),
				"transportAllowance" => $this->input->post("transportAllowance"),
				"dearnessAllowance" => $this->input->post("dearnessAllowance"),
				"houseRentAllowance" => $this->input->post("houseRentAllowance"),
				"skillAllowance" => $this->input->post("skillAllowance"),
				"spcialAllowance" => $this->input->post("spcialAllowance"),
				"encentieve" => $this->input->post("encentieve"),
				"bonus" => $this->input->post("bonus"),
				"gross_s" => $this->input->post("gross_s"),
				"currentAdvance" => $this->input->post("advance_amount"),
				"previousAdvance" => $this->input->post("previous_due_advance"),
				"transactionNo" => $this->input->post("transactionNo"),
				"empAccountNo" => $this->input->post("empAccountNo"),
				"transactDate" => $this->input->post("transactDate"),
				"chequeNo" => $this->input->post("chequeNo"),
				"payeeName" => $this->input->post("payeeName"),
				"created" =>date("Y-m-d"),
				"monthNo" => $diposit_month,
				"salaryInvoice" => $invoice_number,
				"till_date" => $till_date,
				"fsd" => $this->session->userdata("fsd"),
				"school_code"=>$this->session->userdata("school_code")
		);
		$chashdata = array(
				"name"=>"SALARY",
				"exp_id"=>"TEACHING STAFF",
				"valid_id"=>$this->input->post("empid"),
				"reason"=>"Monthly Salary ".$diposit_month,
				//"amount"=>date("Y-m-d"),
				"receipt_no"=>$invoice_number,
			//	"school_code"=>$this->session->userdata("school_code")
				
		);
	$school_code=$this->session->userdata('school_code');

	
		$dayBook = array(
			"paid_to" =>$this->input->post("empid"),
			"paid_by" =>$this->session->userdata("username"),
			//"reason" => "By Salary",
			"dabit_cradit" => "Debit",
			"amount" => $this->input->post("gross_s"),
			"pay_date" => date('Y-m-d'),
			"pay_mode" => $this->input->post("payment_mode"),
			"invoice_no" => $invoice_number,
			"school_code"=>$this->session->userdata("school_code")
		);
		$this->db->insert("cash_payment",$chashdata);
		$this->db->insert("emp_salary_info",$data);
		$this->db->insert("day_book",$dayBook);
		
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("salaryInvoice",$invoice_number);
		$this->db->where("emp_id",$this->input->post("empid"));
		$empdetail = $this->db->get("emp_salary_info")->row();

        $this->db->where("school_code",$this->session->userdata("school_code"));
	//	$this->db->where("fsd",$this->session->userdata("fsd"));
		$this->db->where("id",$empdetail->emp_id);
		$empmno = $this->db->get("employee_info")->row();
// 		print_r($this->session->userdata("fsd"));
// 		exit;
		
		$school_code=  $this->session->userdata("school_code");
	    $this->db->where("school_code",$school_code);
     	$sender=$this->db->get("sms_setting");
	  	$sende_Detail =$sender->row();
	  	
	  	$this->db->where("id",$school_code);
    	$schoolname=$this->db->get("school")->row();
			
		$msg = "Dear ".$empmno->name." you recieve your salary of Rs.".$empdetail->gross_s." throw ".$empdetail->pay_mode." by admin ".$schoolname->school_name;
		sms($empmno->mobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
	
		if($schoolname->id==1){
		    $msg1 =  "Dear school principle you pay salary of Rs.".$empdetail->gross_s." to ".$empmno->name." throw ".$empdetail->pay_mode." ".$schoolname->school_name;
		sms($schoolname->mobile_no,$msg1,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
		 $msg2 =   "Dear Manager you pay salary of Rs.".$empdetail->gross_s." to ".$empmno->name." throw ".$empdetail->pay_mode." ".$schoolname->school_name;
		sms(7398863503,$msg2,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
		}
		
		redirect("invoiceController/salaryReciept/$invoice_number");
	}
	
	
	
	
	function createdSalary(){ 
		$real=$this->input->post("real");
			
		$data['emp_id'] = $this->input->post("empid");
		$data['provide_by'] = $this->input->post("provide_by");
		$data['pay_mode'] = $this->input->post("pay_mode");
		$data['basicSalary'] = $this->input->post("basicSalary");
		$data['ProvidentFund'] = $this->input->post("ProvidentFund");
		$data['employeeStateInsurance'] = $this->input->post("employeeStateInsurance");
		$data['medicalAllowance'] = $this->input->post("medicalAllowance");
		$data['transportAllowance'] = $this->input->post("transportAllowance");
		$data['dearnessAllowance'] = $this->input->post("dearnessAllowance");
		$data['houseRentAllowance'] = $this->input->post("houseRentAllowance");
		$data['skillAllowance'] = $this->input->post("skillAllowance");
		$data['spcialAllowance'] = $this->input->post("spcialAllowance");
		$data['encentieve'] = $this->input->post("encentieve");
		$data['bonus'] = $this->input->post("bonus");
		$data['gross_s'] = $this->input->post("gross_s");
		$data['is_advance'] = $this->input->post("is_advance");
		$data['advance_month'] = $this->input->post("advance_month");
		$data['next_month'] = $this->input->post("next_month");
		$data['till_date'] = $this->input->post("till_date");
		$data['created'] = $this->input->post("created");
		$data['fsd'] = $this->session->userdata("fsd");
		$data['school_code'] = $this->session->userdata("school_code");
		
		
		$this->load->model("employeeModel");
		if($real=="Update")
		{$msg="success fully updated Salary of Employee";
			$qres = $this->employeeModel->updateSalary($data);
			redirect("index.php/login/employeeSalary/$msg");
		}
		else{
			$qres = $this->employeeModel->insertSalary($data);
				if($qres)
				{	$msg="success fully created Salary of Employee";
					redirect("index.php/login/employeeSalary/$msg");
					
				}
			}
	}

	function fullDetail(){
		$v = $this->uri->segment(3);
		$fsd = $this->session->userdata("fsd");
		$this->load->model("feeModel");
		$da=$this->feeModel->fulldetail($v,$fsd);
		$data['request']=$da->result();
		$data['pageTitle'] = 'Fee Report';
		$data['smallTitle'] = 'Fee Report';
		$data['mainPage'] = 'Fee';
		$data['subPage'] = 'Fee Report';
		$data['title'] = 'Fee Report';
		$data['headerCss'] = 'headerCss/feeCss';
		$data['footerJs'] = 'footerJs/feeJs';
		$data['mainContent'] = 'personalSalaryReport';
		$this->load->view("includes/mainContent", $data);
	}
	
	function deleteSalaryReciept(){
	    $invoiceno=$this->uri->segment(3);
	    $school_code=$this->session->userdata('school_code');
	    $fsd=$this->session->userdata('fsd');
	    //print($invoice);exit;
	    
	     $this->db->where('salaryInvoice',$invoiceno);
	    $this->db->where('school_code',$school_code);
	    $this->db->where('fsd',$fsd);
	    $salary=$this->db->get('emp_salary_info')->row();
	    
	    
	    	$this->db->where("school_code",$this->session->userdata("school_code"));
		$invoice = $this->db->count_all("invoice_serial");
		//$invoice_number = $invoice + 1000;
			$invoice1=6000+$invoice;
		$invoice_number = $school_code."I".$invoice1;
		$invoiceDetail = array(
				"invoice_no" => $invoice_number,
				"reason" => "Employee Salary",
				"invoice_date" => date("Y-m-d"),
				"school_code"=>$this->session->userdata("school_code")
		);
		$this->db->insert("invoice_serial",$invoiceDetail);
		
// 		$school_code=$this->session->userdata('school_code');
		$op1 = $this->db->query("select closing_balance from opening_closing_balance where opening_date='".date('Y-m-d')."' AND school_code='$school_code'")->row();
		$balance = $op1->closing_balance;
		$close1 = $balance + $salary->gross_s;
		
		$ocb = array("closing_balance"=>$close1);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("opening_date",date('Y-m-d'));
		$this->db->update("opening_closing_balance",$ocb);
		
		$dayBook = array(
			"paid_to" =>$this->session->userdata("username"),
			"paid_by" =>$salary->emp_id,
			"reason" => "Salary Delete by Admin",
			"dabit_cradit" => 1,
			"amount" => $salary->gross_s,
			"closing_balance" => $close1,
			"pay_date" => date('Y-m-d'),
			"pay_mode" => $salary->pay_mode,
			"invoice_no" => $invoice_number,
			"school_code"=>$this->session->userdata("school_code")
		);
// 		$this->db->insert("cash_payment",$chashdata);
// 		$this->db->insert("emp_salary_info",$data);
		$this->db->insert("day_book",$dayBook);
		
	    $this->db->where('salaryInvoice',$invoiceno);
	    $this->db->where('school_code',$school_code);
	    $this->db->where('fsd',$fsd);
	    $delete=$this->db->delete('emp_salary_info');
	    
	    $emp_id=$salary->emp_id;
	    redirect('employeeController/fullDetail','refresh');
		
	}
	
		function givenSummery(){
			$enum = $this->input->post("cs");
			$ename = $this->input->post("name");
			
			$this->load->model("employeeModel");
			$qres = $this->employeeModel->getSalaryDetail($enum);
			if($qres->num_rows()>0)
			{	?> 	<table class="table table-striped table-hover table-bordered">
						  	<thead>
					 			 <tr>
					 			 <th>S.no.</th>
					 			 <th>Employee ID</th>
					    			<th>Employee Name</th>
					    			<th>Basic</th>
					    			<th>PF</th>
					    			<th>SI</th>
					    			<th>MA</th>
					    			<th>TA</th>
					    			<th>DA</th>
					    			<th>HA</th>
					    			<th>SA</th>
					    			<th>SP A</th>
					    			<th>ENCENTIVE</th>
					    			<th>BONUS</th>
					    			<th>GROSS</th>
					    			<th>IS ADVANCE</th>
					    			<th>ADVANCE MONTH</th>
					    			<th>NEXT MONTH</th>
					    			<th>TILL DATE</th>
					    			<th>CREATED</th>
					  			</tr>
					  		</thead>
					  		<tbody> 
					  		<?php foreach($qres->result() as $qs): ?>
					  		<table class="table table-striped table-hover table-bordered center">
		 	<tr>
			  			<td>1</td>
			  			<td><?php echo $enum; ?></td>
			  			<td><input type="text" name="empname" id="empname" value ="<?php echo $ename;?>"/></td>
			    			<td><input type="text" style ="width: 60px"  name="basicSalary" id="basicSalary" value ="<?php echo $qs->basicSalary;?>"/></td>
			    			<td><input type="text" style ="width: 60px"  name="ProvidentFund" id="ProvidentFund" value ="<?php echo $qs->ProvidentFund;?>"/></td>
			    			<td><input type="text"  style ="width: 60px"  name="employeeStateInsurance" id="employeeStateInsurance" value ="<?php echo $qs->employeeStateInsurance;?>"/></td>
			    			<td><input type="text" style ="width: 60px"  name="medicalAllowance" id="medicalAllowance" value ="<?php echo $qs->medicalAllowance;?>"/></td>
			    			<td><input type="text" style ="width: 60px"  name="transportAllowance" id="transportAllowance" value ="<?php echo $qs->transportAllowance;?>"/></td>
			    			<td><input type="text" style ="width: 60px"  name="dearnessAllowance" id="dearnessAllowance" value ="<?php echo $qs->dearnessAllowance;?>"/></td>
			    			<td><input type="text" style ="width: 60px" name="houseRentAllowance" id="houseRentAllowance" value ="<?php echo $qs->houseRentAllowance;?>"/></td>
			    			<td> <input type="text" style ="width: 60px" name="skillAllowance" id="skillAllowance" value ="<?php echo $qs->skillAllowance;?>"/></td>
			    			<td><input type="text" style ="width: 60px" name="spcialAllowance" id="spcialAllowance" value ="<?php echo $qs->spcialAllowance;?>"/></td>
			    			<td><input type="text"  style ="width: 60px" name="encentieve" id="encentieve" value ="<?php echo $qs->encentieve;?>"/></td>
			    			<td><input type="text" style ="width: 60px" name="bonus" id="bonus" value ="<?php echo $qs->bonus;?>"/></td>
			    			<td><input type="text" style ="width: 60px" name="gross_s" id="gross_s" value ="<?php echo $qs->gross_s;?>"/></td>
			    			<td><input type="text" style ="width: 60px" name="is_advance" id="is_advance" value ="<?php echo $qs->is_advance;?>"/></td>
			    			<td><input type="text" style ="width: 60px" name="advance_month" id="advance_month" value ="<?php echo $qs->advance_month;?>"/></td>
			    			<td><input type="text" style ="width: 80px" name="next_month" id="next_month" value ="<?php echo $qs->next_month;?>"/></td>
			    			<td><input type="text" style ="width: 80px" name="till_date" id="till_date" value ="<?php echo $qs->till_date;?>"/></td>
			    		<td><input type="text" style ="width: 80px" name="created" id="created" value ="<?php echo $qs->created;?>"/></td>
			  			</tr> 
			  			<?php endforeach;?>
					 </tbody>
			  </table>
		<?php 
		}
		}
		
		function changeApprove()
		{
			
			$data = array(
					"approve" => $this->input->post("app")
			);
			$this->load->model("employeeModel");
			$qres = $this->employeeModel->updateApprove($this->input->post("id"),$this->input->post("total_leave"),$this->input->post("end_date"),$this->input->post("start_date"),$data);
		}

}?>