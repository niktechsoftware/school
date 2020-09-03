<?php

class Login extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->is_login();
		$this->load->model("teacherModel");
        $this->load->model("allFormModel");
        $this->load->model("daybookmodel");
        $this->load->model("configureclassmodel");
        $this->load->model("smsmodel");
        //$this->load->model('client_model');
       
	}

	function is_login(){
		$is_login = $this->session->userdata('is_login');
		$is_lock = $this->session->userdata('is_lock');
		$logtype = $this->session->userdata('login_type');
		if(($logtype == "admin")||($logtype == "2")||($logtype == "3")||($logtype == "9")||($logtype == "1")){
			
	
		} else{
		    	redirect("index.php/homeController/index");
		}
		
	if(!$is_login){
			//echo $is_login;
			redirect("index.php/homeController/index");
		}
		elseif(!$is_lock){
			redirect("index.php/homeController/lockPage");
		}
	}

	function index(){
		$school_code=   $this->session->userdata("school_code");
		$cdate =date("Y-m-d");
		$backDate = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $cdate) ) ));
		$openingBalance=$this->daybookmodel->getClosingBalance($backDate);
		$closingBalance = $this->daybookmodel->getClosingBalance($cdate);
		$this->db->where("id",$school_code);
		$cid  = $this->db->get("school")->row()->customer_id;
		$data['totalIncome']=$closingBalance-$openingBalance;
		$this->load->model('dashboard_p');
		$data['emp_lev']=$this->dashboard_p->emp_leave($school_code);
		$data['school_code']= $this->session->userdata("school_code");
        $data['client_due_list'] = $this->client_model->list_product($cid);
        $data['openingBalance']=$openingBalance;
        $expendiAmmount =$this->daybookmodel->expenditureAmount($cdate,$school_code);
        $data['totalExpenditure']=$expendiAmmount;
        $data['closingBalance']=$closingBalance;
		$data['pageTitle'] = 'Dashboard';
		$data['smallTitle'] = 'Overview of all Section';
		$data['mainPage'] = 'Dashboard';
		$data['subPage'] = 'dashboard';
		$data['school_code'] = $school_code;
		$sender = $this->smsmodel->getsmssender($school_code)->row();
		$data['sender_Detail'] =$sender;
		$this->db->where("school_code",$school_code);
		$smsbaladd = 	$this->db->get("sms_setting")->row();
		$data['cbs']=$smsbaladd->sms_bal + checkBalSms($sender->uname,$sender->password) ;
		$data['title'] = 'Niktech School Dashboard';
		$data['headerCss'] = 'headerCss/dashboardCss';
		$data['footerJs'] = 'footerJs/dashboardJs';
		$data['mainContent'] = 'dashboard';
		$this->load->view("includes/mainContent", $data);

	}
	
	function staffcategory(){
		$data['pageTitle'] = 'Change Staff Category';
		$data['smallTitle'] = 'Change Staff Category';
		$data['mainPage'] = 'Change Staff Category';
		$data['subPage'] = 'Change Staff Category';
		$data['title'] = 'Change Staff Category';
		$data['headerCss'] = 'headerCss/staffcategory';
		$data['footerJs'] = 'footerJs/staffcategory';
		$data['mainContent'] = 'staffcategory';
		$this->load->view("includes/mainContent", $data);
	}
    function	indivisualfee(){
			$data['pageTitle'] = 'Fee Panel';
			$data['smallTitle'] = 'Collect Invisual Fee';
			$data['mainPage'] = 'Collect Individual Fee';
			$data['subPage'] = 'Collect Invdidual Fee';
			$data['title'] =   'Collect Indvidual Fee';
			$data['headerCss'] = 'headerCss/staffcategory';
			$data['footerJs'] = 'footerJs/singlefeejs';
			$data['mainContent'] = 'indivisualfee';
			$this->load->view("includes/mainContent", $data);
    		
    	}

	function classteacher()
	{
		$data['pageTitle'] = 'Class/Class Teacher';
		$data['smallTitle'] = 'Class/Class Teacher';
		$data['mainPage'] = 'Class Teacher Report';
		$data['subPage'] = 'Class Teacher';
		$data['title'] = 'Class Teacher';
		$data['headerCss'] = 'headerCss/periodTimeCss';
		$data['footerJs'] = 'footerJs/periodTimeJs';
		$data['mainContent'] = 'classteacher';
		$schoolcode=$this->session->userdata("school_code");
		$this->db->where('school_code',$schoolcode);
		$data['class']=$this->db->get('class_info')->result();

		$this->load->view("includes/mainContent", $data);
	}
	function findclassstudent()
	{
		$data['pageTitle'] = 'Class/Student';
		$data['smallTitle'] = 'Student List';
		$data['mainPage'] = 'Student';
		$data['subPage'] = 'Class Students';
		$data['title'] = 'Class/Student';
		$data['headerCss'] = 'headerCss/studentListCss';
		$data['footerJs'] = 'footerJs/simpleStudentListJs';
		$data['mainContent'] = 'classstudent';
		$data['classid']=$this->uri->segment(3);
		$this->load->view("includes/mainContent", $data);
	}
function configuredoc(){
		$data['pageTitle'] = 'Configuration';
		$data['smallTitle'] = 'Document Formate';
		$data['mainPage'] = 'Configuration';
		$data['subPage'] = 'Document Formate';
		$data['title'] = 'Configure Formate';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'configure_formate';
		$this->load->view("includes/mainContent", $data);
	}
	function configureClass(){
		$data['pageTitle'] = 'Configuration';
		$data['smallTitle'] = 'Class, Section And Subject Stream';
		$data['mainPage'] = 'Configuration';
		$data['subPage'] = 'Class, Section, Subject Stream';
		$data['title'] = 'Configure Class/Section';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'configureClass';
		$this->load->view("includes/mainContent", $data);
	}
	function updatefsd(){
		$data['fsd']=$this->allFormModel->getCurrentFsd($this->session->userdata ( 'school_code' ));
		$data['data']=$this->allFormModel->getClassInfotoFsd($this->session->userdata ('fsd'));
		$this->load->model("feemodel");
		$checkfsdfee = $this->feemodel->checkFeeoverAll($this->session->userdata ( 'school_code' ),$this->session->userdata ('fsd'));
		$data['checkfsdfee']=$checkfsdfee;
		$data['pageTitle'] = 'Update FSD';
		$data['smallTitle'] = 'FSD, And  Class fees ';
		$data['mainPage'] = 'Update FSD';
		$data['subPage'] = 'FSD, And  Class fees';
		$data['title'] = 'Admin FSD Section';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'updatefsd';
		$this->load->view("includes/mainContent", $data);
	}
	function feecategory(){
		$data['pageTitle'] = 'Fee Category';
		$data['smallTitle'] = 'Fee Category ';
		$data['mainPage'] = 'Fee Category';
		$data['subPage'] = 'Fee Category';
		$data['title'] = 'Fee Category';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'feecategory';
		 $this->load->model("configureclassmodel");
        $result = $this->configureclassmodel->getStreamList();
        $data['StreamList'] = $result->result();
		$this->load->view("includes/mainContent", $data);
	}
	
	
	function configureFee(){
		$data['pageTitle'] = 'Configuration';
		$data['smallTitle'] = 'Fee Date, Fee Head Amount, Discount, Transport And Transport Fees';
		$data['mainPage'] = 'Configuration';
		$data['subPage'] = 'Fee Date, Fee Head Amount, Discount, Transport And Transport Fees';
		$this->load->model('configurefeemodel');
		$data['title'] = 'Configure Class/Section';
		$data['headerCss'] = 'headerCss/configureFeeCss';
		$data['footerJs'] = 'footerJs/configureFeeJs';
		$data['mainContent'] = 'configureFee';
		$this->load->view("includes/mainContent", $data);
	}

	function updateClass(){
		$this->load->model('configureclassmodel');
		$res = $this->configureclassmodel->getClassList();
		$data['classList'] = $res;
		$data['pageTitle'] = 'Class Updation';
		$data['smallTitle'] = 'Update Class';
		$data['mainPage'] = 'Configuration';
		$data['subPage'] = 'Classes Update';
		$data['title'] = 'Configure Class/Section';
		$data['headerCss'] = 'headerCss/updateClassCss';
		$data['footerJs'] = 'footerJs/updateClassJs';
		$data['mainContent'] = 'updateClass';
		$this->load->view("includes/mainContent", $data);
	}

	function configureSubject(){
		$data['pageTitle'] = 'Subject Configuration';
		$data['smallTitle'] = 'Assign Subject to class';
		$data['mainPage'] = 'Configuration';
		$data['subPage'] = 'Subject Configuration';
		$data['title'] = 'Configure Class/Section';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/subjectJs';
		$data['mainContent'] = 'configureSubject';
		$this->load->model("configureclassmodel");
		$result = $this->configureclassmodel->getStreamList();
		$data['StreamList'] = $result->result();
		$this->load->view("includes/mainContent", $data);
	}

	function addemployee(){
		$data['pageTitle'] = 'Employee Section';
		$data['smallTitle'] = 'Employee Registration';
		$data['mainPage'] = 'Employee';
		$data['subPage'] = 'Employee Registration';
		$state = $this->allFormModel->getState()->result();
		$data['state'] = $state;
		$data['title'] = 'Employee Registration';
		$data['headerCss'] = 'headerCss/addEmployeeCss';
		$data['footerJs'] = 'footerJs/addEmployeeJs';
		$data['mainContent'] = 'addemployee';
		$this->load->view("includes/mainContent", $data);
	}
function updatemaximum()
	  {
		$data['pageTitle'] = 'Maximum Marks Sheduling';
		$data['smallTitle'] = 'Maximum  Marks Sheduling';
		$data['mainPage'] = 'Exam';
		$data['subPage'] = 'Maximum  Marks Sheduling';
		$this->load->model("examModel");
		$var=$this->examModel->getExamName();
		$data['request']=$var->result();
		$stream=$this->configureclassmodel->getStramforexam();
		$data['stream']=$stream->result();
		$data['title'] = 'Exam Sheduling';
		$data['headerCss'] = 'headerCss/examCss';
		$data['footerJs'] = 'footerJs/examJs';
		$data['mainContent'] = 'updatemaximum';
		$this->load->view("includes/mainContent", $data);
	}

	function advencedEmployeeList(){
		$data['pageTitle'] = 'Employee Section';
		$data['smallTitle'] = 'Employee List';
		$data['mainPage'] = 'Employee';
		$data['subPage'] = 'Employee List';

		$data['title'] = 'Employee List';
		$data['headerCss'] = 'headerCss/employeeListCss';
		$data['footerJs'] = 'footerJs/employeeListJs';
		$data['mainContent'] = 'employeeList';
		$this->load->view("includes/mainContent", $data);
	}
	function exammarksdetail()
	  {
		$data['pageTitle'] = 'Exam Marks Scheduling';
		$data['smallTitle'] = 'Exam Marks Scheduling';
		$data['mainPage'] = 'Exam';
		$data['subPage'] = 'Exam Marks Scheduling';
		$this->load->model("examModel");
		$var=$this->examModel->getExamName();
		$data['request']=$var->result();
		$stream=$this->configureclassmodel->getStramforexam();
		$data['stream']=$stream->result();
		$data['title'] = 'Exam Scheduling';
		$data['headerCss'] = 'headerCss/feeCss';
		$data['footerJs'] = 'footerJs/examJs';
		$data['mainContent'] = 'exammarksentry';
		$this->load->view("includes/mainContent", $data);
	}

	function employeeList(){
		$data['pageTitle'] = 'Employee Section';
		$data['smallTitle'] = 'Employee List';
		$data['mainPage'] = 'Employee';
		$data['subPage'] = 'Employee List';
		$data['title'] = 'Employee List';
		$data['headerCss'] = 'headerCss/employeeListCss';
		$data['footerJs'] = 'footerJs/simpleEmployeeList';
		$data['mainContent'] = 'simpleEmployeeList';
		$this->load->view("includes/mainContent", $data);
	}

	function employeeSalary(){
		$data['pageTitle'] = 'Employee Section';
		$data['smallTitle'] = 'Employee Salary details';
		$data['mainPage'] = 'Employee';
		$data['subPage'] = 'Salary';

		$this->load->model("employeeModel");
		$data['empList'] = $this->employeeModel->employeeList($this->session->userdata("school_code"))->result();

		$data['title'] = 'Employee/Section';
		$data['headerCss'] = 'headerCss/employeeSalaryCss';
		$data['footerJs'] = 'footerJs/employeeSalaryJs';
		$data['mainContent'] = 'employeeSalary';
		$this->load->view("includes/mainContent", $data);
	}

	function employeeSalaryReport(){
		$data['pageTitle'] = 'Employee Section';
		$data['smallTitle'] = 'Employee Salary Report';
		$data['mainPage'] = 'Employee';
		$data['subPage'] = 'Salary Report';

		$data['title'] = 'Employee /Section';
		$data['headerCss'] = 'headerCss/employeeSalaryCss';
		$data['footerJs'] = 'footerJs/employeeSalaryJs';
		$data['mainContent'] = 'employeeSalaryReport';
		$this->load->view("includes/mainContent", $data);
	}

	function employeeSummry(){
		$data['pageTitle'] = 'Employee Section';
		$data['smallTitle'] = 'Employee Summary';
		$data['mainPage'] = 'Employee';
		$data['subPage'] = 'Employee Summary';

		$data['title'] = 'Employee Summary';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'employeeSummry';
		$this->load->view("includes/mainContent", $data);
	}

	function employeeLeave(){
		$data['pageTitle'] = 'Employee Section';
		$data['smallTitle'] = 'Employee Leave Details';
		$data['mainPage'] = 'Employee';
		$data['subPage'] = 'Employee Leave Details';

		$data['title'] = 'Employee Leave Details';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'employeeLeave';
		$this->load->view("includes/mainContent", $data);
	}

	function updateProfile(){
		$data['pageTitle'] = 'Employee Section';
		$data['smallTitle'] = 'Update Existing Employee Details';
		$data['mainPage'] = 'Employee';
		$data['subPage'] = 'Employee Profile';

		$data['title'] = 'Employee Profile';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'updateProfile';
		$this->load->view("includes/mainContent", $data);
	}
	function oldEmployeed(){
		$data['pageTitle'] = 'Employee Section';
		$data['smallTitle'] = 'Old Employee Details';
		$data['mainPage'] = 'Configuration';
		$data['subPage'] = 'Old Employee Details';

		$data['title'] = 'Old Employee Details';
		$data['headerCss'] = 'headerCss/figureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'oldEmployeed';
		$this->load->view("includes/mainContent", $data);
	}

	function quickRegistraionStudent(){
		$data['pageTitle'] = 'Student Section';
		$data['smallTitle'] = 'Quick Admission';
		$data['mainPage'] = 'Students';
		$data['subPage'] = 'Quick Admission';
		$this->load->model("allFormModel");
		$data['className'] = $this->allFormModel->getClass()->result();
		$state = $this->allFormModel->getState()->result();
		$data['state'] = $state;
		$data['title'] = 'Quick Admission';
		$data['headerCss'] = 'headerCss/newAdmissionCss';
		$data['footerJs'] = 'footerJs/newAdmission';
		$data['mainContent'] = 'quickRegistration';
		$this->load->view("includes/mainContent", $data);

	}


	function newAdmission(){
		$data['pageTitle'] = 'Student Section';
		$data['smallTitle'] = 'New Admission';
		$data['mainPage'] = 'Students';
		$data['subPage'] = 'New Admission';


		$this->load->model("allFormModel");
		$data['className'] = $this->allFormModel->getClass()->result();
		$state = $this->allFormModel->getState()->result();

		$data['state'] = $state;
		$data['title'] = 'New Admission';
		$data['headerCss'] = 'headerCss/newAdmissionCss';
		$data['footerJs'] = 'footerJs/newAdmission';
		$data['mainContent'] = 'newAdmission';
		$this->load->view("includes/mainContent", $data);
	}

	function simpleSearchStudent(){
		$data['pageTitle'] = 'Student Section';
		$data['smallTitle'] = 'Simple Search Student';
		$data['mainPage'] = 'Student';
		$data['subPage'] = 'Simple Search Student';
		$this->load->model("searchStudentModel");
		$req=$this->searchStudentModel->getValue();
		// print_r($req);
		$data['request']=$req->result();
		$data['title'] = 'Search Student';
		$data['headerCss'] = 'headerCss/studentListCss';
		$data['footerJs'] = 'footerJs/simpleStudentListJs';

		$data['mainContent'] = 'simpleSearchStudent';
		$this->load->view("includes/mainContent", $data);
	}

	function searchStudent(){
		$data['pageTitle'] = 'Student Section';
		$data['smallTitle'] = 'Advanced Search Student';
		$data['mainPage'] = 'Student';
		$data['subPage'] = 'Advanced Search Student';
		$this->load->model("searchStudentModel");
		// $query = $this->db->select('*')
  //              		->from('student_info')
  //               		->join('guardian_info', 'guardian_info.student_id = student_info.username')
  //               		->where("student_info.school_code",$this->session->userdata("school_code"))
  //               		->get();
		$req=$this->searchStudentModel->getValue();
		$data['request']=$req->result();
		$data['title'] = 'Search Student';
		$data['headerCss'] = 'headerCss/studentListCss';
		$data['footerJs'] = 'footerJs/studentListJs';
		$data['mainContent'] = 'searchStudent';
		$this->load->view("includes/mainContent", $data);
	}

	function oldStudentsDetails(){
		$data['pageTitle'] = 'Student Section';
		$data['smallTitle'] = 'Old Students Details';
		$data['mainPage'] = 'Old Student';
		$data['subPage'] = 'Old Students Details';
		$data['title'] = 'Old Students Details';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'oldStudentsDetails';
		$this->load->view("includes/mainContent", $data);
	}
	function empolyeeleave(){
		$data['pageTitle'] = 'Employee Leave Report';
		$data['smallTitle'] = 'Employee Leave Report';
		$data['mainPage'] = 'Employee';
		$data['subPage'] = 'Employee Leave Report';
		$data['title'] = 'Leave Report';
        $this->load->model("searchStudentModel");
		$req=$this->searchStudentModel->getValueleave();
	//	$data['num']=$req->num_rows();	// print_r($req);
		$data['request']=$req;               

		$data['headerCss'] = 'headerCss/studentListCss';
		$data['footerJs'] = 'footerJs/allleavejs';
		$data['mainContent'] = 'empleaveReport';
		$this->load->view("includes/mainContent", $data);
	}
          function studentleave(){
               
             $data['pageTitle'] = 'Leave Report';
		   $data['smallTitle'] = 'Student Leave Report';
		$data['mainPage'] = 'Student';
		$data['subPage'] = 'Student Leave Report';
		$data['title'] = 'Leave Report';
        $this->load->model("searchStudentModel");
		$req=$this->searchStudentModel->getValueleave1();
		//$data['num']=$req->num_rows();
		$data['request']=$req;               
         
		$data['headerCss'] = 'headerCss/studentListCss';
		$data['footerJs'] = 'footerJs/allleavejs';
		$data['mainContent'] = 'studleaveReport';
		$this->load->view("includes/mainContent", $data);
          }

	function collectFee(){
		$this->load->model("feemodel");
		$cdate=date("Y-m-d");
		$data['stud_id']=$this->uri->segment(3);
		if($this->uri->segment(3)){
			if( $this->uri->segment(3) != "feeFalse" ){
				$fsd_id = $this->uri->segment(4);
        		$data["fsd_id"]=$fsd_id;
        		$this->db->where("school_code",$this->session->userdata("school_code"));
        		$this->db->where("id",$fsd_id);
        		$data['fsddate']=$this->db->get("fsd");

				$data['totdata'] = $this->feemodel->getstugurboth($this->uri->segment(3));
				$getfees = $this->feemodel->getFeeSlab($this->session->userdata("school_code"));
				//print_r($getfees);
				if($getfees->num_rows()>0){
				    //echo $getfees->row()->apply_method;
    				$data['feeSlab'] = $getfees->row()->apply_method;
    				$data['pageTitle']   = 'Fee collection';
    				$data['smallTitle']  = 'Student Fee Collection';
    				$data['mainPage'] 	 = 'Fee';
    				$data['subPage'] 	 = 'Fee collection';
    				$data['title'] 		 = 'Fee collection';
    				$data['headerCss'] 	 = 'headerCss/feeCss';
    				$data['footerJs'] 	 = 'footerJs/feeJs';
    				$data['mainContent'] = 'collectFee';
    			    $this->load->view("includes/mainContent", $data);
				}else{?>
<h1> Please Define your Fee Slab First or Contact to Admin</h1>
<?php	}
			}
			else{
				$data['stud_id']='0';
				$data['pageTitle'] 	 = 'Fee collection';
				$data['smallTitle']  = 'Student Fee Collection';
				$data['mainPage'] 	 = 'Fee';
				$data['subPage'] 	 = 'Fee collection';
				$data['title'] 		 = 'Fee collection';
				$data['headerCss'] 	 = 'headerCss/feeCss';
				$data['footerJs'] 	 = 'footerJs/feeJs';
				$data['mainContent'] = 'collectFee';
				$this->load->view("includes/mainContent", $data);
			}
		}
		else {
			$data['stud_id']='0';
			$data['pageTitle'] = 'Fee collection';
			$data['smallTitle'] = 'Student Fee Collection';
			$data['mainPage'] = 'Fee';
			$data['subPage'] = 'Fee collection';
			$data['title'] = 'Fee collection';
			$data['headerCss'] = 'headerCss/feeCss';
			$data['footerJs'] = 'footerJs/feeJs';
			$data['mainContent'] = 'collectFee';
			$this->load->view("includes/mainContent", $data);
		}
	}
	
	function feeStatus(){
		$data['pageTitle'] = 'Fee Status';
		$data['smallTitle'] = 'Fee Status';
		$data['mainPage'] = 'Fee';
		$data['subPage'] = 'Fee Status';
		$data['title'] = 'Fee Status';
		$data['headerCss'] = 'headerCss/feeCss';
		$data['footerJs'] = 'footerJs/feeJs';
		$data['mainContent'] = 'feeStatus';
		$this->load->view("includes/mainContent", $data);
	}
	
	

	function feeReport(){
		$data['pageTitle'] = 'Fee Report';
		$data['smallTitle'] = 'Fee Report';
		$data['mainPage'] = 'Fee';
		$data['subPage'] = 'Fee Report';
		$data['title'] = 'Fee Report';
		$this->load->model("configureclassmodel");
		$data['request'] = $this->allFormModel->getsectionfeereport()->result();
		$data['headerCss'] = 'headerCss/feeCss';
		$data['footerJs'] = 'footerJs/feeJs';
		$data['mainContent'] = 'feeReport';
		$this->load->view("includes/mainContent", $data);
	}
	function transport(){
		$data['pageTitle'] = 'Student Fee Card';
		$data['smallTitle'] = 'Student Fee Card Area';
		$data['mainPage'] = 'Fee Card';
		$data['subPage'] = ' Student Fee Card';
		$this->load->model("configureclassmodel");
		$data['request'] = $this->allFormModel->getTransportFee()->result();
	
		$data['title'] = 'Fee Card';
		$data['headerCss'] = 'headerCss/transportCss';
		$data['footerJs'] = 'footerJs/transportJs';
		$data['mainContent'] = 'transport';
		$this->load->view("includes/mainContent", $data);
	}
	function feedue(){
		$data['pageTitle'] = 'Fee Due Details';
		$data['smallTitle'] = 'Fee Details';
		$data['mainPage'] = 'Fee due Details';
		$data['subPage'] = 'Fee Details';
		$this->load->model("feeduemodel");
		$var= $this->feeduemodel->getDueDetail();
		$data['request']=$var->result();
		$data['title'] = 'Due Fee';
		$data['headerCss'] = 'headerCss/stockCss';
		$data['footerJs'] = 'footerJs/feedueJs';
		$data['mainContent'] = 'feedue';
		$this->load->view("includes/mainContent", $data);
	}

function studentAttendance(){
		$data['pageTitle'] = 'Student Attendance';
		$data['smallTitle'] = 'Attendance Sheet';
		$data['mainPage'] = 'Student';
		$data['subPage'] = 'Attendance Sheet';
		$data['v']=false;
		$data['v'] = $this->uri->segment(3);
		$data['title'] = 'Attendance Sheet';
		$data['headerCss'] = 'headerCss/studentAttendanceCss';
		$data['footerJs'] = 'footerJs/studentAttendanceJs';
		$data['mainContent'] = 'studentAttendance';
		$this->load->model("configureclassmodel");
		$data['request'] = $this->allFormModel->getClass()->result();

		$this->load->view("includes/mainContent", $data);
	}
	function studentAttendance1(){
		$data['pageTitle'] = 'Student Attendance';
		$data['smallTitle'] = 'Attendance Sheet';
		$data['mainPage'] = 'Student';
		$data['subPage'] = 'Attendance Sheet';
		$data['v']=false;
		$data['v'] = $this->uri->segment(3);
		$data['title'] = 'Attendance Sheet';
		$data['headerCss'] = 'headerCss/studentAttendanceCss';
		$data['footerJs'] = 'footerJs/studentAttendanceJs';
		$data['mainContent'] = 'studentAttendance1';
		$this->load->model("configureclassmodel");
		$data['request'] = $this->allFormModel->getSectionforAttendence()->result();
		$this->load->view("includes/mainContent", $data);
	}
	function studentAttendance2(){
		$data['pageTitle'] = 'Student Attendance';
		$data['smallTitle'] = 'Attendance Sheet';
		$data['mainPage'] = 'Student';
		$data['subPage'] = 'Attendance Sheet';
		$data['v']=false;
		$data['v'] = $this->uri->segment(3);
		$data['title'] = 'Attendance Sheet';
		$data['headerCss'] = 'headerCss/studentAttendanceCss';
		$data['footerJs'] = 'footerJs/studentAttendanceJs';
		$data['mainContent'] = 'studentAttendance2';
		$this->load->model("configureclassmodel");
		$data['request'] = $this->allFormModel->getSectionforAttendence()->result();

		$this->load->view("includes/mainContent", $data);
	}


	function empwiseattendance()
	{
		$list=$this->input->post('jobCategoryval');
		$tID1=$this->input->post('tID1');
		$radate=$this->input->post('radate');

		$date1 = date("Y-m-d");
		$data['checkval'] = $this->teacherModel->checkTeacherAtten($date1);
		
		$data['v']=false;
		$data['v'] = $this->uri->segment(3);
		
		$this->load->model("teacherModel");
		$req=$this->teacherModel->getTeacherwiseList($list);
		$data['request']=$req->result();
		$data['list']=$list;
		$data['tID1']=$tID1;
		$data['radate']=$radate;
		$data['footerJs'] = 'footerJs/studentAttendanceJs';
		
		$this->load->view("empwiseattendance",$data);	
	}

	function teacherAttendance(){
		$date1 = date("Y-m-d");
		$data['checkval'] = $this->teacherModel->checkTeacherAtten($date1);
		$data['pageTitle'] = 'Teacher Attendance';
		$data['smallTitle'] = 'Teacher Attendance';
		$data['mainPage'] = 'Teacher';
		$data['subPage'] = 'Teacher Attendance';
		$data['v']=false;
		$data['v'] = $this->uri->segment(3);
		$data['title'] = 'Teacher Attendance';
		$data['headerCss'] = 'headerCss/studentAttendanceCss';
		$data['footerJs'] = 'footerJs/studentAttendanceJs';
		$this->load->model("teacherModel");
		$req=$this->teacherModel->getTeacherList();
		$data['request']=$req->result();

		$data['mainContent'] = 'teacherAttendance';
		$this->load->view("includes/mainContent", $data);
		//print_r($data);
	}


	function defineLessonPlan(){

		$data['pageTitle'] = 'Time Schedule';
		$data['smallTitle'] = 'Time Schedule';
		$data['mainPage'] = 'Teacher Lesson Plan';
		$data['subPage'] = 'Teacher Lesson Plan';
		$data['title'] = 'Teacher Lesson Plan';
		$data['headerCss'] = 'headerCss/periodTimeCss';
		$data['footerJs'] = 'footerJs/periodTimeJs';
		$data['mainContent'] = 'defineLessonPlan';
		$this->load->view("includes/mainContent", $data);
	}


	function viewLessonPlan(){

		$data['pageTitle'] = 'Time Schedule';
		$data['smallTitle'] = 'Time Schedule';
		$data['mainPage'] = 'Teacher Lesson Plan';
		$data['subPage'] = 'Teacher Lesson Plan';
		$data['title'] = 'Teacher Lesson Plan';
		$data['headerCss'] = 'headerCss/periodTimeCss';
		$data['footerJs'] = 'footerJs/periodTimeJs';
		$data['mainContent'] = 'viewLessonPlan';
		$this->load->view("includes/mainContent", $data);
	}

	function stuAttendanceReport(){
		$data['pageTitle'] = 'Attendance Report';
		$data['smallTitle'] = 'Attendance Report';
		$data['mainPage'] = 'Student';
		$data['subPage'] = 'Attendance Report';
		$data['title'] = 'Attendance Report';
		$this->load->model("configureclassmodel");
		$data['request'] = $this->allFormModel->getSectionforAttendence()->result();
		$data['headerCss'] = 'headerCss/studentAttendanceCss';
		$data['footerJs'] = 'footerJs/studentAttendanceJs';
		$data['mainContent'] = 'stuAttendanceReport';
		$this->load->view("includes/mainContent", $data);
		//print_r($data);
	}
	function empAttendanceReport(){
		$data['pageTitle'] = 'Attendance Report';
		$data['smallTitle'] = 'Attendance Report';
		$data['mainPage'] = 'Employee';
		$data['subPage'] = 'Employee Attendance Report';
		$data['title'] = 'Attendance Reportn';
		$data['headerCss'] = 'headerCss/studentAttendanceCss';
		$data['footerJs'] = 'footerJs/empAttendanceJs';
		$data['mainContent'] = 'empAttendanceReport';
		$this->load->view("includes/mainContent", $data);
	}

function periodTimeSlot(){
		$data['pageTitle'] = 'Time Table';
		$data['smallTitle'] = 'Period Time Table';
		$data['mainPage'] = 'Time Scheduling';
		$data['subPage'] = 'Period Time Table';
		$this->load->model("periodModel");
		$req=$this->periodModel->getperiodno();
		//print_r($req->result());exit;
		$data['request']=$req->result();
		$data['v']=false;
		$data['v'] = $this->uri->segment(3);
		$data['title'] = 'Period Time Scheduling';
		$data['headerCss'] = 'headerCss/periodTimeCss';
		$data['footerJs'] = 'footerJs/periodTimeJs';
		$data['mainContent'] = 'periodTimeSlot';
		$this->load->view("includes/mainContent", $data);
	}

	function timeScheduling(){

		$data['pageTitle'] = 'Time Schedule';
		$data['smallTitle'] = 'Time Schedule';
		$data['mainPage'] = 'Period Time Scheduling';
		$data['subPage'] = 'Time Scheduling';
		$data['title'] = 'Period Time Scheduling';
		$data['headerCss'] = 'headerCss/periodTimeCss';
		$data['footerJs'] = 'footerJs/periodTimeJs';
		$data['mainContent'] = 'timeScheduling';
		$this->load->view("includes/mainContent", $data);
	}

	function tc(){

		$data['pageTitle'] = 'Transfer Certificate';
		$data['smallTitle'] = 'Transfer Certificate';
		$data['mainPage'] = 'Transfer Certificate';
		$data['subPage'] = 'Transfer Certificate';
		$data['title'] = 'Transfer Certificate';
		$data['headerCss'] = 'headerCss/tcCss';
		$data['footerJs'] = 'footerJs/tcJs';
		$data['mainContent'] = 'tc';
		$this->load->view("includes/mainContent", $data);
	}

	function charc(){

		$data['pageTitle'] = 'Character certificate';
		$data['smallTitle'] = 'Character certificate';
		$data['mainPage'] = 'Report';
		$data['subPage'] = 'Character certificate';
		$data['title'] = 'Character certificate';
		$data['headerCss'] = 'headerCss/periodTimeCss';
		$data['footerJs'] = 'footerJs/periodTimeJs';
		$data['mainContent'] = 'charc';
		$this->load->view("includes/mainContent", $data);
	}
	
		function teacherschedulingreport()
	{
	    $data['pageTitle'] = 'Schedule Report';
		$data['smallTitle'] = 'Schedule Report';
		$data['mainPage'] = 'Scheduling';
		$data['subPage'] = 'Schedule Report';
	    $teacherid=$this->session->userdata("username");
      	$this->db->where('username',$teacherid);
      	$username=$this->db->get('employee_info')->row();
      	$id=$username->id;
      	$this->db->where('teacher',$id);
        $data['time']=$this->db->get('time_table');
        $data['name']=$username->name;
     	$data['title'] = 'Schedule Report';
		$data['headerCss'] = 'headerCss/periodTimeCss';
		$data['footerJs'] = 'footerJs/periodTimeJs';
		$data['mainContent'] = 'emptimetable';
		$this->load->view("includes/mainContent", $data);
	}

	function schedulingReport(){
		$data['pageTitle'] = 'Schedule Report';
		$data['smallTitle'] = 'Schedule Report';
		$data['mainPage'] = 'Scheduling';
		$data['subPage'] = 'Schedule Report';
		$data['title'] = 'Schedule Report';
		$data['headerCss'] = 'headerCss/periodTimeCss';
		$data['footerJs'] = 'footerJs/periodTimeJs';
		$data['mainContent'] = 'schedulingReport';
		$this->load->view("includes/mainContent", $data);
	}



	function examsheduling()
	  {
	  	$fsd =$this->session->userdata("fsd");
		$data['pageTitle'] = 'Exam Scheduling';
		$data['smallTitle'] = 'Exam Scheduling';
		$data['mainPage'] = 'Exam';
		$data['subPage'] = 'Exam Scheduling';
		$this->load->model("examModel");
		$var=$this->examModel->getExamName($fsd);
		$var1=$this->examModel->getExamNameForUpdate();
		$data['request']=$var->result();
		$data['requestforUpdate']=$var1->result();
		
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$count = $this->db->count_all("exam_name");
		$data['i']=$count;
		$data['title'] = 'Exam Scheduling';
		$data['headerCss'] = 'headerCss/examCss';
		$data['footerJs'] = 'footerJs/examJs';
		$data['mainContent'] = 'examscheduling';
		$this->load->view("includes/mainContent", $data);
	}

function createSchedule()
	{
		$exam_id = $this->uri->segment(3);
		$exam_id=$exam_id;
		$this->db->where("exam_id",$exam_id);
		$shift = $this->db->get("exam_shift");
		//$data['id']=$shift1->result();
		//$shift= select id from exam_shift where ("exam_id", $exam_name);
		//$shift = $data->id;
		
		//print_r($shift);
		$this->db->where("exam_id",$exam_id);
		$day = $this->db->get("exam_day");
		$data['nos'] = $shift->num_rows();
		$data['nod'] = $day->num_rows();
		$data['msg'] = 1;
		$data['msg'] = $this->uri->segment(4);
		$this->load->model("examModel");
		$data['exam_name'] = $exam_id;
		
		$data['pageTitle'] = 'Exam Sheduling';
		$data['smallTitle'] = 'Exam Sheduling';
		$data['mainPage'] = 'Exam';
		$data['subPage'] = 'Exam Sheduling';
		// $this->load->model("examModel");
		$this->load->model("configureclassmodel");
		$classes=$this->configureclassmodel->getClassName();
		$data['classes']=$classes->result();
		
		//print_r($classes->result());exit;
		// $data['exam_name']=$exam_name;
		//$data['edate']=$edate;
		
		$data['shift']=$shift->result();
		$data['days']=$day->result();
		$data['title'] = 'Exam Sheduling';
		$data['headerCss'] = 'headerCss/examCss';
		$data['footerJs'] = 'footerJs/createExamJs';
		$data['mainContent'] = 'creatSchedule';
		$this->load->view("includes/mainContent", $data);
		//print_r($data);
	}
	
	function examTimeTable(){
		$data['pageTitle'] = 'Exam Time Table';
		$data['smallTitle'] = 'Exam Time Table';
		$data['mainPage'] = 'Exam';
		$this->load->model("examModel");
		$data['subPage'] = 'Exam Time Table';
		$res = $this->configureclassmodel->getClassName();
		$data['noc'] = $res->result(); 
		$fsd=$this->session->userdata($fsd);
		$var=$this->examModel->getExamName($fsd);
		$data['request']=$var->result();
		$data['title'] = 'Exam Time Table';
		$data['headerCss'] = 'headerCss/examTimeTableCss';
		$data['footerJs'] = 'footerJs/examTimeTableJs';
		$data['mainContent'] = 'examTimeTable';
		$this->load->view("includes/mainContent", $data);
	}
	
	
	function examDetail(){
		$data['pageTitle'] = 'Exam Details';
		$data['smallTitle'] = 'Exam Details';
		$data['mainPage'] = 'Exam';
		$data['subPage'] = 'Exam Details';
		$this->load->model("configurefeemodel");
		$this->load->model("examModel");
		$fsd=$this->session->userdata($fsd);
		$var=$this->examModel->getExamName($fsd);
		$data['request']=$var->result();
		$stream=$this->configureclassmodel->getStramforexam();
		$data['stream']=$stream->result();
		$data['title'] = 'Exam Details';
		$data['headerCss'] = 'headerCss/examCss';
		$data['footerJs'] = 'footerJs/examJs';
		$data['mainContent'] = 'examDetail';
		$this->load->view("includes/mainContent", $data);
	}
	function results(){
		$data['pageTitle'] = 'Results Summary';
		$data['smallTitle'] = 'Results Summary';
		$data['mainPage'] = 'Exam';
		$data['subPage'] = 'Results Summary';
		$this->load->model("examModel");
		$fsd=$this->session->userdata($fsd);
		$var=$this->examModel->getExamName($fsd);
		$data['request']=$var->result();
		$stream=$this->configureclassmodel->getStramforexam();
		$data['stream']=$stream->result();
		$data['title'] = 'Results Summary';
		$data['headerCss'] = 'headerCss/examCss';
		$data['footerJs'] = 'footerJs/examJs';
		$data['mainContent'] = 'results';
		$this->load->view("includes/mainContent", $data);
	}

	function editUpdateDetail(){
		$data['pageTitle'] = 'Exam Details';
		$data['smallTitle'] = 'Exam Details';
		$data['mainPage'] = 'Exam';
		$data['subPage'] = 'Exam Details';
		$this->load->model("examModel");
		$var=$this->examModel->getExamName();
		$data['request']=$var->result();
		$classes=$this->configureclassmodel->getClassName();
		$data['classes']=$classes->result();
		$data['title'] = 'Exam Details';
		$data['headerCss'] = 'headerCss/examCss';
		$data['footerJs'] = 'footerJs/examJs';
		$data['mainContent'] = 'editUpdateDetail';
		$this->load->view("includes/mainContent", $data);
	}


	function enterStock(){
		$data['pageTitle'] = 'Stock Management';
		$data['smallTitle'] = 'Enter Stock';
		$data['mainPage'] = 'Stock Section';
		$data['subPage'] = 'Enter Stock';
	    $this->load->model("enterStockModel");
	   	$var= $this->enterStockModel->getStock();
	   	$data['request']=$var->result();
		$data['title'] = 'Enter Stock';
		$data['headerCss'] = 'headerCss/stockCss';
		$data['footerJs'] = 'footerJs/stockJS';
		$data['mainContent'] = 'enterStock';
		$this->load->view("includes/mainContent", $data);
	}

    function saleStock(){
		$data['pageTitle'] = 'Stock Management';
		$data['smallTitle'] = 'Sale Stock';
		$data['mainPage'] = 'Stock';
		$data['subPage'] = 'Sale Stock';

		$data['title'] = 'Sale Stock';
		$data['headerCss'] = 'headerCss/stockCss';
		$data['footerJs'] = 'footerJs/stockJS';
		$data['mainContent'] = 'saleStock';
		$this->load->view("includes/mainContent", $data);
	}

	function printReceipt(){
		$data['pageTitle'] = 'Stock Management';
		$data['smallTitle'] = 'Stock Report';
		$data['mainPage'] = 'Stock';
		$data['subPage'] = 'Stock Report';
		$data['title'] = 'Stock Report';
		$data['headerCss'] = 'headerCss/stockCss';
		$data['footerJs'] = 'footerJs/stockJS';
		$data['mainContent'] = 'printReceipt';
		$this->load->view("includes/mainContent", $data);
	}

	function stockReport(){
		$data['pageTitle'] = 'Stock Management';
		$data['smallTitle'] = 'Stock Report';
		$data['mainPage'] = 'Stock';
		$data['subPage'] = 'Stock Report';

		$data['title'] = 'Stock Report';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'stockReport';
		$this->load->view("includes/mainContent", $data);
	}

	function noticeAlert(){
		$do=$this->uri->segment(3);
		if(strlen($do) > 0){
		$this->load->model("msgModel");
		$data['editid']=$this->msgModel->getdetail($do);
		$data['pageTitle'] = 'Notice & Message Alert';
		$data['smallTitle'] = 'notice';
		$data['mainPage'] = 'Notice';
		$data['subPage'] = 'Notice & Message Alert';
		$this->load->model("noticeModel");
		$var = $this->noticeModel->getNotice();
		$data['request']=$var->result();
		$data['title'] = 'Notice & Message Alert';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'noticeAlert';
		$this->load->view("includes/mainContent", $data);
		}
		else{
		$data['pageTitle'] = 'Notice & Message Alert';
		$data['smallTitle'] = 'notice';
		$data['mainPage'] = 'Notice';
		$data['subPage'] = 'Notice & Message Alert';
		$this->load->model("noticeModel");
		$var = $this->noticeModel->getNotice();
		$data['request']=$var->result();
		$data['title'] = 'Notice & Message Alert';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'noticeAlert';
		$this->load->view("includes/mainContent", $data);}
	}

	function message(){
		$data['pageTitle'] = 'Notice & Message Alert';
		$data['smallTitle'] = 'message';
		$data['mainPage'] = 'Message';
		$data['subPage'] = 'Notice & Message Alert';
		$data['title'] = 'Notice & Message Alert';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'message';
		$this->load->view("includes/mainContent", $data);
	}

	function mobileNotice(){
	    $sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"))->row();
		$data['sender_Detail'] =$sender;

			$this->db->where("school_code",$this->session->userdata("school_code"));
	$smsbaladd = 	$this->db->get("sms_setting")->row();
		$data['cbs']=$smsbaladd->sms_bal + checkBalSms($sender->uname,$sender->password) ;
		

		
		$data['pageTitle'] = 'SMS Panel';
		$data['smallTitle'] = 'Mobile Message And Notice';

		$data['mainPage'] = 'Message';
		$data['subPage'] = 'Mobile Notice';
		$data['title'] = 'Mobile Message And Notice';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'mobileNotice';
		$this->load->view("includes/mainContent", $data);
	}


	function smssetting(){
		$data['pageTitle'] = 'Mobile Message And Notice';
		$data['smallTitle'] = 'Sms Setting';
		$data['mainPage'] = 'SMS';
		$this->load->model("smsmodel");
		$row =	$this->smsmodel->getsmsseting($this->session->userdata("school_code"));
	//	print_r($row);exit();
		if($row){
		$data['row'] =$row;
		$data['adm'] = $row->admission;
		$data['fee_submit'] = $row->fee_submit;
		$data['purchase'] = $row->purchase;
		$data['stu_attendance'] = $row->stu_attendance;
		$data['exam_report'] = $row->exam_report;
		$data['parent_message'] = $row->parent_message;
		$data['announcement'] = $row->announcement;
		$data['greeting'] = $row->greeting;
		$data['homework'] = $row->homework;
		$data['subPage'] = 'Mobile Message And Notice';
		$data['title'] = 'Mobile Message And Notice';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'smssetting';
		$this->load->view("includes/mainContent", $data);
		}else{
		$data['subPage'] = 'Mobile Message And Notice';
		$data['title'] = 'Mobile Message And Notice';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'error';
		$this->load->view("includes/mainContent", $data);
		}
	}


    function dayBook(){
     	$school_code = $this->session->userdata("school_code");
		$v=1;
		
		$cdate =date("Y-m-d");
		$backDate = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $cdate) ) ));
		$openingBalance=$this->daybookmodel->getClosingBalance($backDate);
		$closingBalance = $this->daybookmodel->getClosingBalance($cdate);
		$data['closing'] = $closingBalance;
		$data['opening'] = $openingBalance;
		$v = $this->uri->segment(3);
		
		if($v==9)
		{
			$data['msg']="No Record Found";
			$data['pageTitle'] = 'Accounting';
			$data['smallTitle'] = 'Day Book';
			$data['mainPage'] = 'Day Book';
			$data['subPage'] = 'Accounting ';
			$cdate=date('Y-m-d');
			$data['sale'] = $this->daybookmodel->getDayTranByDate($school_code,$cdate,3,1);
			$data['salary'] = $this->daybookmodel->getDayTranByDate($school_code,$cdate,10,0);
			$data['bankTransactionw'] = $this->daybookmodel->getDayTranByDate($school_code,$cdate,6,1);
			$data['bankTransactiond'] = $this->daybookmodel->getDayTranByDate($school_code,$cdate,6,0);
			$data['directorTransactionw'] = $this->daybookmodel->getDayTranByDate($school_code,$cdate,7,1);
			$data['directorTransactiond'] = $this->daybookmodel->getDayTranByDate($school_code,$cdate,7,0);
			$data['cash'] = $this->daybookmodel->getDayTranByDate($school_code,$cdate,8,0);
			
			$this->db->select_sum('paid');
			$this->db->where("school_code",$school_code);
			$this->db->where("diposit_date",$cdate);
			$dt1=$this->db->get('fee_deposit')->row();
			$data['admin'] = $dt1->paid;

			$this->db->select_sum('paid');
			$this->db->where("school_code",$school_code);
			$this->db->where("diposit_date",$cdate);
			$this->db->where("payment_mode","online");
			$dt1=$this->db->get('fee_deposit')->row();
			$data['bt'] = $dt1->paid;

		
			$data['title'] = 'Accounting';
			$data['headerCss'] = 'headerCss/daybookCss';
			$data['footerJs'] = 'footerJs/daybookJs';
			$data['mainContent'] = 'dayBook';
			$this->load->view("includes/mainContent", $data);
			$v=1;
		}
		else{
    		$data['pageTitle'] = 'Accounting';
    		$data['smallTitle'] = 'Day Book';
    		$data['mainPage'] = 'Day Book';
    		$data['subPage'] = 'Accounting';

			$cdate=date('Y-m-d');
			$data['sale'] = $this->daybookmodel->getDayTranByDate($school_code,$cdate,3,1);
			$data['salary'] = $this->daybookmodel->getDayTranByDate($school_code,$cdate,10,0);
			$data['bankTransactionw'] = $this->daybookmodel->getDayTranByDate($school_code,$cdate,6,1);
			$data['bankTransactiond'] = $this->daybookmodel->getDayTranByDate($school_code,$cdate,6,0);
			$data['directorTransactionw'] = $this->daybookmodel->getDayTranByDate($school_code,$cdate,7,1);
			$data['directorTransactiond'] = $this->daybookmodel->getDayTranByDate($school_code,$cdate,7,0);
			$data['cash'] = $this->daybookmodel->getDayTranByDate($school_code,$cdate,8,0);

			$this->db->select_sum('paid');
			$this->db->where("school_code",$school_code);
			$this->db->where("Date(diposit_date)",$cdate);
			$dt1=$this->db->get('fee_deposit')->row();
			$data['admin'] = $dt1->paid;

			
			$data['htd'] = $dt1->paid;
			$data['msg']="";
			$data['title'] = 'Account Management';
			$data['headerCss'] = 'headerCss/daybookCss';
			$data['footerJs'] = 'footerJs/daybookJs';
			$data['mainContent'] = 'dayBook';
			$this->load->view("includes/mainContent", $data);
	}
	}
	
	function cashPayment(){
		$school_code = $this->session->userdata("school_code");
		$expinditureList = $this->daybookmodel->getExpenditureList($school_code);
		$data['expenditureList']=$expinditureList;
		$data['pageTitle'] = 'Accounting';
		$data['smallTitle'] = 'Transaction';
		$data['mainPage'] = 'Transaction';
		$data['subPage'] = 'Cash Payment';
		$data['title'] = 'cashPayment';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/transactionJs';
		$data['mainContent'] = 'cashPayment';
		$this->load->view("includes/mainContent", $data);
	}
	function newexpenditure(){
		$data['pageTitle'] = 'Add Expenditure';
		$data['smallTitle'] = 'Add Expenditure';
		$data['mainPage'] = 'Add Expenditure';
		$data['subPage'] = 'Add Expenditure';
		$data['title'] = 'Add Expenditure';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/transactionJs';
		$data['mainContent'] = 'addexpenditure';
		$this->load->view("includes/mainContent", $data);
	}

	function bankTransaction(){
		$data['pageTitle'] = 'Account Management';
		$data['smallTitle'] = 'Bank Transaction';
		$data['mainPage'] = 'Bank Transaction';
		$data['subPage'] = 'Bank Transaction / Account Management';

		$data['title'] = 'Bank Transaction / Account Management';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'bankTransaction';
		$this->load->view("includes/mainContent", $data);
	}
	function smsreport(){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$sent_report = $this->db->get("sent_sms_master");
		$data['result']  =$sent_report;
		$data['pageTitle'] = 'SMS Report Panel';
		$data['smallTitle'] = 'SMS PAnel';
		$data['mainPage'] = 'SMS Report Panel';
		$data['subPage'] = 'Get Sms Report / SMS Panel';

		$data['title'] = 'Get SMS Report / SMS Panel';
		$data['headerCss'] = 'headerCss/smsCss';
		$data['footerJs'] = 'footerJs/smsJs';
		$data['mainContent'] = 'smsreport';
		$this->load->view("includes/mainContent", $data);
	}

	function directorTransaction(){
		$data['pageTitle'] = 'Account Management';
		$data['smallTitle'] = 'Director Transaction';
		$data['mainPage'] = 'Bank Transaction';
		$data['subPage'] = 'Director Transaction';

		$data['title'] = 'irector Transaction';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'directorTransaction';
		$this->load->view("includes/mainContent", $data);
	}

	function gallery(){
		$data['pageTitle'] = 'Gallery';
		$data['smallTitle'] = 'Gallery Photo';
		$data['mainPage'] = 'Gallery';
		$data['subPage'] = 'Gallery Photo';

		$data['title'] = 'Gallery Photo';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'gallery';
		$this->load->view("includes/mainContent", $data);
	}
	function success(){
		$data['pageTitle'] = 'success';
		$data['smallTitle'] = 'Gallery Photo';
		$data['mainPage'] = 'Gallery';
		$data['subPage'] = 'Gallery Photo';

		$data['title'] = 'Gallery Photo';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/configureClassJs';
		$data['mainContent'] = 'success';
		$this->load->view("includes/mainContent", $data);
	}

	function notActiveEmployee(){
		$school_code = $this->session->userdata("school_code");
		$data['pageTitle'] = 'Employee Section';
		$data['smallTitle'] = 'Employee Status';
		$data['mainPage'] = 'Employee';
		$data['subPage'] = 'Employee Registration';
		$this->db->where("school_code",$school_code);
		$this->db->where("status",0);
		$status=$this->db->get("employee_info");
		//$state=$state->result();
		$data['status'] = $status;
		$data['title'] = 'Add Employee';
		$data['headerCss'] = 'headerCss/studentListCss';
		$data['footerJs'] = 'footerJs/simpleStudentListJs';
		$data['mainContent'] = 'notActiveEmployee';
		$this->load->view("includes/mainContent", $data);
	}
	function notActiveStudent(){
		$data['pageTitle'] = 'Student Section';
		$data['smallTitle'] = 'Student Status';
		$data['mainPage'] = 'Student';
		$data['subPage'] = 'Inactive Students List';
		$this->load->model("searchStudentModel");
		$req=$this->searchStudentModel->getValueNotActive();
		$data['request']=$req;
		$data['title'] = 'InActive Students';
		$data['headerCss'] = 'headerCss/studentListCss';
		$data['footerJs'] = 'footerJs/simpleStudentListJs';
		$data['mainContent'] = 'notActiveStudent';
		$this->load->view("includes/mainContent", $data);
	}

	function stockEdit(){
		$data['pageTitle'] = 'Edit Stock Sale';
		$data['smallTitle'] = 'Edit';
		$data['mainPage'] = 'Stock';
		$data['subPage'] = 'Edit Stock Sale';
		$data['title'] = 'Edit Stock Sale';
		$data['headerCss'] = 'headerCss/stockCss';
		$data['footerJs'] = 'footerJs/stockSaleEditJs';
		$data['mainContent'] = 'stockEdit';
		$this->load->view("includes/mainContent", $data);
	}

	function printDeuFee(){
		$data['pageTitle'] = 'Print Due Fee';
		$data['smallTitle'] = 'Print';
		$data['mainPage'] = 'Due Fee area';
		$data['subPage'] = 'Print Due Fee';

		$data['title'] = 'Print Due Fee';
		$data['headerCss'] = 'headerCss/stockCss';
		$data['footerJs'] = 'footerJs/stockSaleEditJs';
		$data['mainContent'] = 'printDeuFee';
		$this->load->view("includes/mainContent", $data);
	}
	function student_wise_icard(){

		$data['pageTitle'] = 'Student Panel';
		$data['smallTitle'] = 'Student Panel';
		$data['mainPage'] = 'Student Icard';
		$data['subPage'] = 'Student Icard';
		$data['title'] = 'Student Icard ';
		$data['headerCss'] = 'headerCss/studentCss';
		$data['footerJs'] = 'footerJs/studentJs';
		$data['mainContent'] = 'student_wise_icard';
		$this->load->view("includes/mainContent", $data);

	}

	function class_wise_icard(){

		$data['pageTitle'] = 'Student Panel';
		$data['smallTitle'] = 'Student Panel';
		$data['mainPage'] = 'Student Icard';
		$data['subPage'] = 'Student Icard';
		$data['title'] = 'Student Icard ';
		$this->load->model("allFormModel");
		$data['request'] = $this->allFormModel->getsectionfeereport()->result();
		$data['headerCss'] = 'headerCss/studentCss';
		$data['footerJs'] = 'footerJs/studentJs';
		$data['mainContent'] = 'class_wise_icard';
		$this->load->view("includes/mainContent", $data);

	}


	function generateResult(){
		$data['pageTitle'] = 'Generate Result';
		$data['smallTitle'] = 'Select Exam Name';
		$data['mainPage'] = 'Exam';
		$data['subPage'] = 'Generate Result';

		$data['title'] = 'Generate Result';
		$data['headerCss'] = 'headerCss/generateResultCss';
		$data['footerJs'] = 'footerJs/generateResultJs';
		$data['mainContent'] = 'generateResult';
		$this->load->view("includes/mainContent", $data);
	}

	function classPromotion(){

			$data['pageTitle'] = 'Student Promotion';
			$data['smallTitle'] = 'Student Promotion';
			$data['mainPage'] = 'Promotion';
			$data['subPage'] = 'Student Promotion';
			$data['title'] = 'Student Promotion';
			$this->load->model("configureclassmodel");
			$data['request'] = $this->allFormModel->getclass()->result();
			$data['headerCss'] = 'headerCss/newAdmissionCss';
			$data['footerJs'] = 'footerJs/studentAttendanceJs';
			$data['mainContent'] = 'classPromotion';
			$this->load->view("includes/mainContent", $data);


	}
	function allStudentClassPromotion(){
		$data['pageTitle'] = 'Class Promotion';
			$data['smallTitle'] = 'Class Promotion';
			$data['mainPage'] = 'Promotion';
			$data['subPage'] = 'Class Promotion';
			$data['title'] = 'Class Promotion';
			$this->load->model("configureclassmodel");
			$data['request'] = $this->allFormModel->getclass()->result();
			$data['headerCss'] = 'headerCss/newAdmissionCss';
			$data['footerJs'] = 'footerJs/studentAttendanceJs';
			$data['mainContent'] = 'allStudentClassPromotion';
			$this->load->view("includes/mainContent", $data);
	}
	function pramoted_list(){
		$data['pageTitle'] = 'Promotion List';
		$data['smallTitle'] = 'Class Promotion List';
		$data['mainPage'] = 'Promotion';
		$data['subPage'] = 'Class Promotion';
		$data['title'] = 'Class Promotion';
		$this->load->model("configureclassmodel");
		$data['request'] = $this->allFormModel->getsectionfeereport()->result();
		$data['headerCss'] = 'headerCss/feeCss';
		$data['footerJs'] = 'footerJs/feeJs';
		$data['mainContent'] = 'classPromotionList';
		$this->load->view("includes/mainContent", $data);
	}

	public function format(){
		$this->load->view('format');

	}


	public function table(){
		$data['pageTitle'] = 'Data Table';
		$data['smallTitle'] = 'Data Table';
		$data['mainPage'] = 'Data Table';
		$data['subPage'] = 'Data Table';
		$data['title'] = 'Data Table';
		$data['headerCss'] = 'headerCss/tablecss';
		$data['footerJs'] = 'footerJs/tablejs';
		$data['mainContent'] = 'table';
		$this->load->view("includes/mainContent", $data);
	}
function exammode(){
		$fsd =$this->session->userdata("fsd");
		$data['pageTitle'] = 'Exam Mode';
		$data['smallTitle'] = 'Exam Mode';
		$data['mainPage'] = 'Exam Mode';
		$data['subPage'] = 'Exam Mode';
		$data['title'] = 'Exam Mode';
		$this->load->model("examModel");
		$var=$this->examModel->getExamName($fsd);
		$var1=$this->examModel->getExamNameForUpdate();
		$data['request']=$var->result();
		$data['requestforUpdate']=$var1->result();
		
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$count = $this->db->count_all("exam_name");
		$data['i']=$count;
		$data['headerCss'] = 'headerCss/examCss';
		$data['footerJs'] = 'footerJs/examJs';
		$data['mainContent'] = 'exammode';
		$this->load->view("includes/mainContent", $data);
	}
	function subjective_ques(){
		$fsd =$this->session->userdata("fsd");
		$data['pageTitle'] = 'Subjective Question';
		$data['smallTitle'] = 'Subjective Question';
		$data['mainPage'] = 'Subjective Question';
		$data['subPage'] = 'Subjective Question';
		$data['title'] = 'Subjective Question';
		$data['headerCss'] = 'headerCss/examCss';
		$data['footerJs'] = 'footerJs/examJs';
		$data['mainContent'] = 'subjective_ques';
		$this->load->view("includes/mainContent", $data);
	}

function config_test(){
		$fsd =$this->session->userdata("fsd");
		$this->load->model('exammodel');
		$data['gt_val'] = $this->exammodel->exam_name();
		$data['dt_subject'] = $this->exammodel->subject_name();
		$data['dt_test'] =  $this->exammodel->test_data();
		$data['dt_lang'] = $this->exammodel->language();
		$data['pageTitle'] = 'Configuration Test';
		$data['smallTitle'] = 'Configuration Test';
		$data['mainPage'] = 'Configuration Test';
		$data['subPage'] = 'Configuration Test';
		$data['title'] = 'Configuration Test';
		$this->load->model("examModel");
		$var=$this->examModel->getExamName($fsd);
		$var1=$this->examModel->getExamNameForUpdate();
		$data['request']=$var->result();
		$data['requestforUpdate']=$var1->result();
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$count = $this->db->count_all("exam_name");
		$data['i']=$count;
		$data['headerCss'] = 'headerCss/examCss';
		$data['footerJs'] = 'footerJs/examJs';
		$data['mainContent'] = 'config_test';
		$this->load->view("includes/mainContent", $data);
	}
	function edit_q()
	{
		$this->load->model('exammodel');
		$q_id = $this->uri->segment(3);
		$data['q_dt'] = $this->exammodel->edit_q($q_id);
		$data['q_op'] = $this->exammodel->ques_op($q_id);
	    $data['pageTitle'] = 'Update Question';
		$data['smallTitle'] = 'Update Question';
		$data['mainPage'] = 'Update Question';
		$data['subPage'] = 'Update Question';
		$data['title'] = 'Update Question';
		$data['headerCss'] = 'headerCss/examCss';
		$data['footerJs'] = 'footerJs/examJs';
		$data['mainContent'] = 'edit_ques';
		$this->load->view("includes/mainContent", $data);	

	}
	function edit_imgques()
	{
		$this->load->model('exammodel');
		$q_id = $this->uri->segment(3);
		$data['q_dt'] = $this->exammodel->edit_q($q_id);
		$data['q_op'] = $this->exammodel->ques_op($q_id);
	    $data['pageTitle'] = 'Update Question';
		$data['smallTitle'] = 'Update Question';
		$data['mainPage'] = 'Update Question';
		$data['subPage'] = 'Update Question';
		$data['title'] = 'Update Question';
		$data['headerCss'] = 'headerCss/examCss';
		$data['footerJs'] = 'footerJs/examJs';
		$data['mainContent'] = 'edit_imgques';
		$this->load->view("includes/mainContent", $data);	

	}
	function quesScheduling()
	{
		//$period_name = $this->input->post("periodName");
	    //print_r($period_name);exit;
		//$pdate = $this->input->post("pdate");
		//$data['period_name'] = $period_name;
	 //print_r($data);exit();
	   //$data['pdate'] = $pdate;
	   $data['pageTitle'] = 'Question Scheduling';
	   $data['smallTitle'] = 'Question Scheduling';
	   $data['mainPage'] = 'Question Scheduling';
	   $data['subPage'] = 'Question Scheduling';
	   //$this->load->model("examModel");
	   //$var=$this->periodmodel->getPeriodD($period_name);
	   //print_r($var->result());
	  // $data['request']=$var->result();
	   $data['title'] = 'Question Scheduling';
	   $data['headerCss'] = 'headerCss/examCss';
	   $data['footerJs'] = 'footerJs/examJs';
	   $data['mainContent'] = 'quesScheduling';
	   $this->load->view("includes/mainContent", $data);
	}
}
?>