<?php
class Feepanel extends CI_Controller{


	function __construct()
	 {
	 	parent::__construct();
	 	$this->is_login();
	 	$this->load->model("smsmodel");
	 	$this->load->model("employeemodel");
	 	$this->load->model("feemodel");
	 	}

	 	function is_login(){
	 		$is_login = $this->session->userdata('is_login');
	 		$is_lock = $this->session->userdata('is_lock');
	 		$logtype = $this->session->userdata('login_type');
	 		if(!$is_login){
	 			//echo $is_login;
	 			redirect("index.php/homeController/index");
	 		}
	 		
	 		elseif(!$is_lock){
	 			redirect("index.php/homeController/lockPage");
	 		}
	 	}



  public function index(){
		$data['pageTitle'] = 'Fee Panel';
		$data['smallTitle'] = 'Fee Panel';
		$data['mainPage'] = 'Fee Panel Area';
		$data['subPage'] = 'Fee Panel';
		$data['title'] = 'Fee Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/fee_panel';
		$this->load->view("includes/mainContent", $data);


  }

    public function studentwisefeepanel(){
		$data['pageTitle'] = 'Fee Panel';
		$data['smallTitle'] = 'Fee Panel';
		$data['mainPage'] = 'Fee Panel Area';
		$data['subPage'] = 'Fee Panel';
		$data['title'] = 'Fee Panel Area ';
		$this->load->model("allformmodel");
		$var= $this->allformmodel->getfsdWisestudent_id($this->session->userdata("fsd"));
		$data['request']=$var->result();
		$data['headerCss'] = 'headerCss/employeeListCss';
		$data['footerJs'] = 'footerJs/simpleEmployeeList';
		$data['mainContent'] = 'panel/fee/studentwise_feepanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function classwisefeepanel(){
		$data['pageTitle'] = 'Fee Panel';
		$data['smallTitle'] = 'Fee Panel';
		$data['mainPage'] = 'Fee Panel Area';
		$data['subPage'] = 'Fee Panel';
		$data['title'] = 'Fee Panel Area ';
		$this->load->model("allFormModel");
		$data['request'] = $this->allFormModel->getsectionfeereport()->result();
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/feedueJs';
		$data['mainContent'] = 'panel/fee/classwise_feepanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function topremainfeepanel(){
		$data['pageTitle'] = 'Fee Panel';
		$data['smallTitle'] = 'Fee Panel';
		$data['mainPage'] = 'Fee Panel Area';
		$data['subPage'] = 'Fee Panel';
		$this->load->model("allFormModel");
		$data['request'] = $this->allFormModel->getsectionfeereport()->result();
		$data['title'] = 'Fee Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/fee/topremain_feepanel';
		$this->load->view("includes/mainContent", $data);


	}
	
	function feeReport(){
		$this->load->model("feemodel");
		//$data['fsd'] = $this->db->get("general_setting");
		$data['fsd'] = $this->input->post("fsd");
		$data['cla'] = $this->input->post("classid");
		$cla = $this->input->post("classid");
	//	$data['sec'] = $this->input->post("section");
		//$sec = $this->input->post("section");
		$school_code = $this->session->userdata("school_code");
		$this->load->model("smsmodel");
		$sender = $this->smsmodel->getsmssender($school_code);
		if($sender){
			$sende_Detail =$sender;
			$data['sende_Detail']=$sender;
		}
		$data['$sende_Detail']=$sender;
		//$checkstudent="";
		if($this->input->post("fsd")==$this->session->userdata("fsd"))
		{
			$this->db->where("status",1);
		 	$this->db->where("class_id",$cla);
		 	$student = $this->db->get("student_info");
		 	$data['student']=$student;
		    $this->load->view("ajax/topfeedue_remainer",$data);
		}
		else
		{
			echo "Something wrong!please try After Some Time";
		}
	}
	
	function classDue(){
		    //print_r($this->session->userdata("fsd"));exit;
		if($this->input->post("fsd")==$this->session->userdata("fsd"))
		{
		$this->load->model("feemodel");
		$data['fsd'] = $this->input->post("fsd");
		$data['cla'] = $this->input->post("classid");
		
		$cla = $this->input->post("classid");
		$school_code = $this->session->userdata("school_code");
		$this->load->model("smsmodel");
		$sender = $this->smsmodel->getsmssender($school_code);
		if($sender){
			$sende_Detail =$sender;
			$data['sende_Detail']=$sender;
		}
		$data['$sende_Detail']=$sender;
		
		$this->db->where("status",1);
	 	$this->db->where("class_id",$cla);
	 	$student = $this->db->get("student_info");
	 	$data['student']=$student->result();
	 		//print_r($data['student']);exit;
	    $this->load->view("ajax/classDue",$data);
		}
		else
		{
			echo "Something wrong! Please try After Some Time";
		}
	}
	
		function topfeeReport(){
		$this->load->model("feemodel");
		//$data['fsd'] = $this->db->get("general_setting");
		$data['fsd'] = $this->input->post("fsd");
		$data['cla'] = $this->input->post("classid");
		$cla = $this->input->post("classid");
	//	$data['sec'] = $this->input->post("section");
		//$sec = $this->input->post("section");
		$school_code = $this->session->userdata("school_code");
		$this->load->model("smsmodel");
		$sender = $this->smsmodel->getsmssender($school_code);
		if($sender){
			$sende_Detail =$sender;
			$data['sende_Detail']=$sender;
		}
		$data['$sende_Detail']=$sender;
		//$checkstudent="";
		if($this->input->post("fsd")==$this->session->userdata("fsd"))
		{
			$this->db->where("status",1);
		 	$this->db->where("class_id",$cla);
		 	$student = $this->db->get("student_info");
		 	$data['student']=$student;
		    $this->load->view("ajax/top_fee_depositer",$data);
		}
		else
		{
			echo "Something wrong!please try After Some Time";
		}
	}

    public function topdepositorfeepanel(){
		$data['pageTitle'] = 'Fee Panel';
		$data['smallTitle'] = 'Fee Panel';
		$data['mainPage'] = 'Fee Panel Area';
		$data['subPage'] = 'Fee Panel';
		$this->load->model("allFormModel");
		$data['request'] = $this->allFormModel->getsectionfeereport()->result();
		$data['title'] = 'Fee Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/fee/topdepositor_feepanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function collectfeefeepanel(){
		$data['pageTitle'] = 'Fee Panel';
		$data['smallTitle'] = 'Fee Panel';
		$data['mainPage'] = 'Fee Panel Area';
		$data['subPage'] = 'Fee Panel';
		$data['title'] = 'Fee Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/fee/collectfee_feepanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function duefsdfeepanel(){
		$data['pageTitle'] = 'Fee Panel';
		$data['smallTitle'] = 'Fee Panel';
		$data['mainPage'] = 'Fee Panel Area';
		$data['subPage'] = 'Fee Panel';
		$data['title'] = 'Fee Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/fee/duefsd_feepanel';
		$this->load->view("includes/mainContent", $data);


  }

      public function currentmonthdue(){
		$data['pageTitle'] = 'Fee Panel';
		$data['smallTitle'] = 'Fee Panel';
		$data['mainPage'] = 'Fee Panel Area';
		$data['subPage'] = 'Fee Panel';
		$data['title'] = 'Fee Panel Area ';
		$this->load->model("allFormModel");
		$data['request'] = $this->allFormModel->getsectionfeereport()->result();
		$data['headerCss'] = 'headerCss/feeCss';
		$data['footerJs'] = 'footerJs/feeJs';
		$data['mainContent'] = 'panel/fee/duebyfsd_feepanel';
		$this->load->view("includes/mainContent", $data);


  }

      public function sendseminarfeepanel(){
		$data['pageTitle'] = 'Fee Panel';
		$data['smallTitle'] = 'Fee Panel';
		$data['mainPage'] = 'Fee Panel Area';
		$data['subPage'] = 'Fee Panel';
		$data['title'] = 'Fee Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/fee/sendseminar_feepanel';
		$this->load->view("includes/mainContent", $data);


  }

      public function viewseminarfeepanel(){
		$data['pageTitle'] = 'Fee Panel';
		$data['smallTitle'] = 'Fee Panel';
		$data['mainPage'] = 'Fee Panel Area';
		$data['subPage'] = 'Fee Panel';
		$data['title'] = 'Fee Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/fee/viewseminar_feepanel';
		$this->load->view("includes/mainContent", $data);


  }
function discountStud()
{
	$data['pageTitle'] = 'Discount List';
	$data['smallTitle'] = 'Student Discount List';
	$data['mainPage'] = 'Discount';
	$data['subPage'] = 'Student Discount';
	$data['title'] = 'Student Discount';
	$data['headerCss'] = 'headerCss/employeeListCss';
	$data['footerJs'] = 'footerJs/simpleEmployeeList';
	$data['mainContent'] = 'studentDiscount';
	$this->load->view("includes/mainContent", $data);
}



}

?>