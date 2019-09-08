<?php
class Homeworkpanel extends CI_Controller{


	// function __construct()
	// {
	// 	parent::__construct();
	// 	$this->is_login();
	// 	$this->load->model("smsmodel");
	// 	$this->load->model("employeemodel");
	// 	}

	// 	function is_login(){
	// 		$is_login = $this->session->userdata('is_login');
	// 		$is_lock = $this->session->userdata('is_lock');
	// 		$logtype = $this->session->userdata('login_type');
	// 		if($is_login != "admin"){
	// 			//echo $is_login;
	// 			redirect("index.php/homeController/index");
	// 		}
	// 		elseif(!$is_login){
	// 			//echo $is_login;
	// 			redirect("index.php/homeController/index");
	// 		}
	// 		elseif(!$is_lock){
	// 			redirect("index.php/homeController/lockPage");
	// 		}
	// 	}



  public function index(){
		$data['pageTitle'] = 'HomeWork Panel';
		$data['smallTitle'] = 'HomeWork Panel';
		$data['mainPage'] = 'HomeWork Panel Area';
		$data['subPage'] = 'HomeWork Panel';
		$data['title'] = 'HomeWork Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/homework_panel';
		$this->load->view("includes/mainContent", $data);


  }

    public function studentwisehomeworkpanel(){
		$data['pageTitle'] = 'HomeWork Panel';
		$data['smallTitle'] = 'HomeWork Panel';
		$data['mainPage'] = 'HomeWork Panel Area';
		$data['subPage'] = 'HomeWork Panel';
		$data['title'] = 'HomeWork Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/homework/studentwise_homeworkpanel';
		$this->load->view("includes/mainContent", $data);


  }
  public function findstdhw(){
  	$stdid=$this->input->post("studentid");
    $this->db->where('username',$stdid);
 	$username=$this->db->get('student_info')->row();
    $this->db->where('submitted_by',$username->username);
  	$data['row']=$this->db->get('homework');
  $this->load->view('panel/homework/studentwise',$data);
  }

    public function classwisehomeworkpanel(){
		$data['pageTitle'] = 'HomeWork Panel';
		$data['smallTitle'] = 'HomeWork Panel';
		$data['mainPage'] = 'HomeWork Panel Area';
		$data['subPage'] = 'HomeWork Panel';
		$data['title'] = 'HomeWork Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/homework/classwise_homeworkpanel';
		$this->load->view("includes/mainContent", $data);


  }
    public function findclasstime()
      {
    
			 $data['cls']=$this->input->post("classid");
			
			//	$this->db->where('class_id',$classid);
				
      		$data['class']=$this->db->get('homework')->result();
      			$this->load->view('panel/homework/classwise',$data);
    
    
    
      }
    public function teacherwisehomeworkpanel(){
		$data['pageTitle'] = 'HomeWork Panel';
		$data['smallTitle'] = 'HomeWork Panel';
		$data['mainPage'] = 'HomeWork Panel Area';
		$data['subPage'] = 'HomeWork Panel';
		$data['title'] = 'HomeWork Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/homework/teacherwise_homeworkpanel';
		$this->load->view("includes/mainContent", $data);


  }
public function findteacherhw()
  {	
 	$teacherid=$this->input->post("teacherid");
  	$this->db->where('username',$teacherid);
  	$username=$this->db->get('employee_info')->row();
  	$id=$username->username;
    $this->db->where('submitted_by',$id);
    $data['hw']=$this->db->get('homework')->result();
  	$this->load->view('panel/homework/teacherwise',$data);

  }
    public function topperfstdhomeworkpanel(){
			$data['class']= $this->homeworkmodel->getHomeWorkList();
		$data['pageTitle'] = 'HomeWork Panel';
		$data['smallTitle'] = 'HomeWork Panel';
		$data['mainPage'] = 'HomeWork Panel Area';
		$data['subPage'] = 'HomeWork Panel';
		$data['title'] = 'HomeWork Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/homework/topperfstd_homeworkpanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function toplosstdhomeworkpanel(){
		$data['pageTitle'] = 'HomeWork Panel';
		$data['smallTitle'] = 'HomeWork Panel';
		$data['mainPage'] = 'HomeWork Panel Area';
		$data['subPage'] = 'HomeWork Panel';
		$data['title'] = 'HomeWork Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/homework/toplosstd_homeworkpanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function homestatushomeworkpanel(){
		$data['pageTitle'] = 'HomeWork Panel';
		$data['smallTitle'] = 'HomeWork Panel';
		$data['mainPage'] = 'HomeWork Panel Area';
		$data['subPage'] = 'HomeWork Panel';
		$data['title'] = 'HomeWork Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/homework/homestatus_homeworkpanel';
		$this->load->view("includes/mainContent", $data);


  }

      public function hworkteachhomeworkpanel(){
		$data['pageTitle'] = 'HomeWork Panel';
		$data['smallTitle'] = 'HomeWork Panel';
		$data['mainPage'] = 'HomeWork Panel Area';
		$data['subPage'] = 'HomeWork Panel';
		$data['title'] = 'HomeWork Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/homework/hworkteach_homeworkpanel';
		$this->load->view("includes/mainContent", $data);


  }

      public function notsubmitstdhomeworkpanel(){
		$data['pageTitle'] = 'HomeWork Panel';
		$data['smallTitle'] = 'HomeWork Panel';
		$data['mainPage'] = 'HomeWork Panel Area';
		$data['subPage'] = 'HomeWork Panel';
		$data['title'] = 'HomeWork Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/homework/notsubmitstd_homeworkpanel';
		$this->load->view("includes/mainContent", $data);


  }

      public function notsubmitteachhomeworkpanel(){
		$data['pageTitle'] = 'HomeWork Panel';
		$data['smallTitle'] = 'HomeWork Panel';
		$data['mainPage'] = 'HomeWork Panel Area';
		$data['subPage'] = 'HomeWork Panel';
		$data['title'] = 'HomeWork Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/homework/notsubmitteach_homeworkpanel';
		$this->load->view("includes/mainContent", $data);


  }



}

?>