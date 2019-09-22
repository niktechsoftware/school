<?php
class Attendancepanel extends CI_Controller{

	public function __construct(){
		parent::__construct();
			$this->is_login();
	
	}
	
	
		function is_login(){
		$is_login = $this->session->userdata('is_login');
	
		if((!$is_login)){
			
			redirect("index.php/homeController/index");
		}
	
	}


  public function index(){
		$data['pageTitle'] = 'Attendance Panel';
		$data['smallTitle'] = 'Attendance Panel';
		$data['mainPage'] = 'Attendance Panel Area';
		$data['subPage'] = 'Attendance Panel';
		$data['title'] = 'Attendance Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/attendance_panel';
		$this->load->view("includes/mainContent", $data);


  }

    public function studentwiseattendancepanel(){
		$data['pageTitle'] = 'Attendance Panel';
		$data['smallTitle'] = 'Attendance Panel';
		$data['mainPage'] = 'Attendance Panel Area';
		$data['subPage'] = 'Attendance Panel';
		$data['title'] = 'Attendance Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/attendance/studentwise_attendancepanel';
		$this->load->view("includes/mainContent", $data);


  }
  public function findstdattendance()
  {
  	$stdid=$this->input->post("studentid");
  	$fsd=$this->input->post("fsd");
  	$this->db->where('id',$fsd);
  	$fsdval=$this->db->get('fsd')->row();
   $this->db->where('username',$stdid);
		 $username=$this->db->get('student_info');
		 if($username->num_rows()>0){
			$username=$username->row();
	$this->db->where('a_date >=',$fsdval->finance_start_date);
	$this->db->where('a_date <=',$fsdval->finance_end_date);
    $this->db->where('stu_id',$username->id);
		$data['row']=$this->db->get('attendance');
		$data['name']=$username->name;
		$data['username']=$username->username;
		$classid=$username->class_id;
		$this->db->where('id',$classid);
		$this->db->where('school_code',$this->session->userdata('school_code'));
		$classinfo=$this->db->get('class_info')->row();
		$data['class']=$classinfo->class_name;
		$sectionid=$classinfo->section;
		$this->db->where('id',$sectionid);
		$this->db->where('school_code',$this->session->userdata('school_code'));
		$data['section']=$this->db->get('class_section')->row()->section;
        $data['headerCss'] = 'headerCss/stpanelCss';
		$data['footerJs'] = 'footerJs/stpanelJs';

  	$this->load->view('panel/attendance/studentwise',$data);
		 }else{

			?><script>alert("Please Enter Right Student Id")</script><?php
		 }

  }

  public function findteacherattendance()
  {

  	$fsd=$this->input->post("fsd");
	$this->db->where('id',$fsd);
  	$fsdval=$this->db->get('fsd')->row();
  	
  	$teacherid=$this->input->post("teacherid");
  		$this->db->where('school_code',$this->session->userdata('school_code'));
   
    $this->db->where('username',$teacherid);
		 $username=$this->db->get('employee_info');
		 if($username->num_rows()){
			$username=$username->row();

    $this->db->where('emp_id',$username->id);
    $this->db->where('a_date >=',$fsdval->finance_start_date);
	$this->db->where('a_date <=',$fsdval->finance_end_date);
		$data['row']=$this->db->get('teacher_attendance');

		$data['name']=$username->name;

  	$this->load->view('panel/attendance/particulartchwise',$data);
		 }else{

			?><script>alert("Please Enter Right Teacher Id")</script><?php
		 }

  }


    public function classwiseattendancepanel(){
		$data['pageTitle'] = 'Attendance Panel';
		$data['smallTitle'] = 'Attendance Panel';
		$data['mainPage'] = 'Attendance Panel Area';
		$data['subPage'] = 'Attendance Panel';
		$data['title'] = 'Attendance Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/attendance/classwise_attendancepanel';
			$this->load->model("configureclassmodel");
		$result = $this->configureclassmodel->getStreamList();
		$data['StreamList'] = $result->result();
		$this->load->view("includes/mainContent", $data);


  }
  public function findclasstime()
      {
         $classid=$this->input->post("classid");
          $fsd=$this->input->post("fsd");
          $this->db->where('id',$fsd);
          $fsdval=$this->db->get('fsd')->row();
          ///print_r($fsdval);
        $sdate=  $fsdval->finance_start_date;
       // $sdate;exit;
        $data['classid']=$classid;
          $this->db->where('class_id',$classid);
	$data['class'] = $this->db->query("select distinct stu_id FROM attendance WHERE class_id='$classid' AND a_date >='$fsdval->finance_start_date' AND a_date <='$fsdval->finance_end_date'");
  		$this->load->view('panel/attendance/classwise',$data);
  	}

  	public function particularstudatten()
  	{

  		$uri=$this->uri->segment(3);

  		$this->db->where('stu_id',$uri);
  		$data['uri']=$this->db->get('attendance')->result();
  		$data['pageTitle'] = 'Student Attendance Panel';
		$data['smallTitle'] = 'Student Attendance Panel';
		$data['mainPage'] = 'Student Attendance Panel Area';
		$data['subPage'] = 'Student Attendance Panel';
		$data['title'] = 'Student Attendance Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/attendance/particularattendancepanel';
		$this->load->view("includes/mainContent", $data);




  	}

    public function schoolwiseattendancepanel(){
		$data['pageTitle'] = 'Attendance Panel';
		$data['smallTitle'] = 'Attendance Panel';
		$data['mainPage'] = 'Attendance Panel Area';
		$data['subPage'] = 'Attendance Panel';
		$data['title'] = 'Attendance Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/attendance/schoolwise_attendancepanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function topprstuattendancepanel(){
		$data['pageTitle'] = 'Attendance Panel';
		$data['smallTitle'] = 'Attendance Panel';
		$data['mainPage'] = 'Attendance Panel Area';
		$data['subPage'] = 'Attendance Panel';
		$data['title'] = 'Attendance Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/attendance/topprstu_attendancepanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function topabstuattendancepanel(){
		$data['pageTitle'] = 'Attendance Panel';
		$data['smallTitle'] = 'Attendance Panel';
		$data['mainPage'] = 'Attendance Panel Area';
		$data['subPage'] = 'Attendance Panel';
		$data['title'] = 'Attendance Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/attendance/topabstu_attendancepanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function topprempstuattendancepanel(){
		$data['pageTitle'] = 'Attendance Panel';
		$data['smallTitle'] = 'Attendance Panel';
		$data['mainPage'] = 'Attendance Panel Area';
		$data['subPage'] = 'Attendance Panel';
		$data['title'] = 'Attendance Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/attendance/topprempstu_attendancepanel';
		$this->load->view("includes/mainContent", $data);


  }

      public function topabempattendancepanel(){
		$data['pageTitle'] = 'Attendance Panel';
		$data['smallTitle'] = 'Attendance Panel';
		$data['mainPage'] = 'Attendance Panel Area';
		$data['subPage'] = 'Attendance Panel';
		$data['title'] = 'Attendance Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/attendance/topabemp_attendancepanel';
		$this->load->view("includes/mainContent", $data);


  }

      public function empwiseattendancepanel(){
		$data['pageTitle'] = 'Attendance Panel';
		$data['smallTitle'] = 'Attendance Panel';
		$data['mainPage'] = 'Attendance Panel Area';
		$data['subPage'] = 'Attendance Panel';
		$data['title'] = 'Attendance Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/attendance/empwise_attendancepanel';
		$this->load->view("includes/mainContent", $data);


  }

      public function totalempwiseattendancepanel(){
		$data['pageTitle'] = 'Attendance Panel';
		$data['smallTitle'] = 'Attendance Panel';
		$data['mainPage'] = 'Attendance Panel Area';
		$data['subPage'] = 'Attendance Panel';
		$data['title'] = 'Attendance Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/attendance/totalempwise_attendancepanel';
		$this->load->view("includes/mainContent", $data);


  }
  public function categorywise(){
  	$emp= $this->input->post('emp');
  	$this->load->model('attendancepanelmodel');
  	if($emp == 'accountant'){
  	$data['view'] = $this->attendancepanelmodel->categorywiseemp($emp);
  	$this->load->view('panel/attendance/empwise_attendance',$data);
  } else if($emp == 'teacher'){
  	$data['view'] = $this->attendancepanelmodel->categorywiseemp($emp);
  	$this->load->view('panel/attendance/empwise_attendancet',$data);
  }
  else if($emp == 'employee'){
  	$data['view'] = $this->attendancepanelmodel->categorywiseemp($emp);
  	$this->load->view('panel/attendance/empwise_attendancee',$data);
  }
  else {
  	$data['view'] = $this->attendancepanelmodel->categorywiseemp($emp);
  	$this->load->view('panel/attendance/empwise_attendancep',$data);
  }
	}
	public function teacherwiseatt(){
		$empusername = $this->uri->segment(3);
		$data['pageTitle'] = 'Attendance Panel';
	 $data['smallTitle'] = 'Attendance Panel';
	 $data['mainPage'] = 'Attendance Panel Area';
	 $data['subPage'] = 'Attendance Panel';
	 $data['title'] = 'Attendance Panel Area ';
	 $data['headerCss'] = 'headerCss/noticeCss';
	 $data['footerJs'] = 'footerJs/noticeJs';
	 $data['mainContent'] = 'panel/attendance/teacherwiseattendance';
		$this->load->model('attendancepanelmodel');
		$data['view']= $this->attendancepanelmodel->teacheratt($empusername);
	 // $this->load->view('panel/attendance/teacherwiseattendance',$data);
		$this->load->view("includes/mainContent", $data);

 }
 public function principalwiseatt(){
		$empusername = $this->uri->segment(3);
		$data['pageTitle'] = 'Attendance Panel';
	 $data['smallTitle'] = 'Attendance Panel';
	 $data['mainPage'] = 'Attendance Panel Area';
	 $data['subPage'] = 'Attendance Panel';
	 $data['title'] = 'Attendance Panel Area ';
	 $data['headerCss'] = 'headerCss/noticeCss';
	 $data['footerJs'] = 'footerJs/noticeJs';
	 $data['mainContent'] = 'panel/attendance/principalwiseattendance';
		$this->load->model('attendancepanelmodel');
		$data['view']= $this->attendancepanelmodel->teacheratt($empusername);
		$this->load->view("includes/mainContent", $data);
 }
 public function employeewiseatt(){
		$empusername = $this->uri->segment(3);
		$data['pageTitle'] = 'Attendance Panel';
	 $data['smallTitle'] = 'Attendance Panel';
	 $data['mainPage'] = 'Attendance Panel Area';
	 $data['subPage'] = 'Attendance Panel';
	 $data['title'] = 'Attendance Panel Area ';
	 $data['headerCss'] = 'headerCss/noticeCss';
	 $data['footerJs'] = 'footerJs/noticeJs';
	 $data['mainContent'] = 'panel/attendance/empwiseattendance';
		$this->load->model('attendancepanelmodel');
		$data['view']= $this->attendancepanelmodel->teacheratt($empusername);
		$this->load->view("includes/mainContent", $data);
 }
 public function accountantwiseatt(){
		$empusername = $this->uri->segment(3);
		$data['pageTitle'] = 'Attendance Panel';
	 $data['smallTitle'] = 'Attendance Panel';
	 $data['mainPage'] = 'Attendance Panel Area';
	 $data['subPage'] = 'Attendance Panel';
	 $data['title'] = 'Attendance Panel Area ';
	 $data['headerCss'] = 'headerCss/noticeCss';
	 $data['footerJs'] = 'footerJs/noticeJs';
	 $data['mainContent'] = 'panel/attendance/accwiseattendance';
		$this->load->model('attendancepanelmodel');
		$data['view']= $this->attendancepanelmodel->teacheratt($empusername);
		$this->load->view("includes/mainContent", $data);
 }
}

?>