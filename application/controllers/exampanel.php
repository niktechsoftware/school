<?php
class Exampanel extends CI_Controller{


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
		$data['pageTitle'] = 'Exam Panel';
		$data['smallTitle'] = 'Exam Panel';
		$data['mainPage'] = 'Exam Panel Area';
		$data['subPage'] = 'Exam Panel';
		$data['title'] = 'Exam Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/exam_panel';
		$this->load->view("includes/mainContent", $data);


  }

  public function findstdexam()
  {

  	    $fsd=$this->session->userdata("fsd");             
  		$examid=$this->input->post("examid");
  		$this->db->where('id',$examid);
  		$data['examname']=$this->db->get('exam_info')->row();
  		$studentexamid=$this->input->post("stdexam");
  		$this->db->where('username',$studentexamid);
		$id=$this->db->get('student_info')->row();
		$data['studentid']=$id;

  		$this->db->where('id',$id->class_id);
  		$cls=$this->db->get('class_info')->row();

  		?>
		<!-- <h1 style="color:green">Your Student Class is <?php //echo $cls->class_name;?></h1> -->
		<?php
  		

  		$this->db->where('exam_id',$examid);
  		$this->db->where('stu_id',$id->id);
  		$this->db->where('fsd',$fsd);
  		$data['exam']=$this->db->get('exam_info')->result();

  		$this->load->view('panel/exam/studentwise',$data);


  }

  public function findclassexam()
	  {

	  	 $school_code=$this->session->userdata("school_code");
                              
	  	 $fsd=$this->session->userdata("fsd");                     
		  $classid=$this->input->post("classid");
		$data['classid']=$classid;
  		$data['examid']=$this->input->post("examid");
  		
  		 $this->db->where('status',1);
  		$this->db->where('class_id',$classid);
  		$data['student']=$this->db->get('student_info')->result();

  		$this->load->view('panel/exam/classwise',$data);

	  }

	  public function findclassstudentexam()

	  {

	  	$data['pageTitle'] = 'Exam Panel';
		$data['smallTitle'] = 'Exam Panel';
		$data['mainPage'] = 'Exam Panel Area';
		$data['subPage'] = 'Exam Panel';
		$data['title'] = 'Exam Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/exam_panel';

	  	  $fsd=$this->session->userdata("fsd");
	 	  $seg1= $this->uri->segment(3);

	    	$seg2= $this->uri->segment(4);
	  
	     $this->db->where('exam_id',$seg1);
  		 $this->db->where('stu_id',$seg2);
  		
  		 $this->db->where('fsd',$fsd);
  		 $data['exam']=$this->db->get('exam_info')->result();
  		
  			$this->load->view('panel/exam/classstudentexamdetail',$data);



	  }
	  
	  public function sendsms_exam()
	  {
	        	$msg=$this->input->post("msg");  
	        	
	  	  	  $school_code=$this->session->userdata("school_code");
	  	  	  $fsd=$this->session->userdata("fsd");
	  	  	  //$this->db->where('school_code',$school_code);
	  	  	    $this->db->where('fsd',$fsd);
	  	  	    $this->db->where('status',1);
	  	  	  $student=  $this->db->get('student_info')->result();
	  	  	  foreach($student as $data)
	  	  	  {
	  	  	      
	  	  	         $mobile=$data->mobile;

	  	  	         	$this->db->where("school_code",$school_code);
				$sender=$this->db->get("sms_setting");
                  //	$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
			  		$sende_Detail =$sender;
			  		$sende_Detail1=$sende_Detail->row();
			  		sms($mobile,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
			  	
	  	  	  }
	  	  	  	redirect('index.php/exampanel/smsexampanel');
			  	
	  	  	   
	  }
	  public function admitcardclass()
	  {

	  		$classid=$this->input->post("classv");
	  		$data['examid']=$this->input->post("selectExam");
	  		$this->db->where('class_id',$classid);
	  		$data['student']=$this->db->get('student_info')->result();
	  		$this->load->view('panel/exam/admitcardclasswise',$data);



	  }
	  public function admitCardReports()
	  {
	  	$data['pageTitle'] = 'Exam Panel';
		$data['smallTitle'] = 'Exam Panel';
		$data['mainPage'] = 'Exam Panel Area';
		$data['subPage'] = 'Exam Panel';
		$data['title'] = 'Exam Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/exam/admitCardReports';
		$this->load->view("includes/mainContent", $data);

	  }

	 function AdmitCardDownload(){
		   $id = $this->uri->segment(3);
			$examrow = $this->uri->segment(4);
			$this->db->where("id",$examrow);
			$exam_data = $this->db->get("exam_name")->row();
			//$data['exam_name']=$exam_data->id;
			//$data['exam_date']=$exam_data->exam_date;
		    $data['id']=$id;
		    $data['title']="Admit Card";
		    $this->load->view("invoice/printAdmit",$data);
	}	

    public function studentwiseexampanel(){
		$data['pageTitle'] = 'Exam Panel';
		$data['smallTitle'] = 'Exam Panel';
		$data['mainPage'] = 'Exam Panel Area';
		$data['subPage'] = 'Exam Panel';
		$data['title'] = 'Exam Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/exam/studentwise_Exampanel';
		$this->load->view("includes/mainContent", $data);


  }
  public function findclasssadmitcard()
  {

  	echo "hello";

  }

    public function classwiseexampanel(){
		$data['pageTitle'] = 'Exam Panel';
		$data['smallTitle'] = 'Exam Panel';
		$data['mainPage'] = 'Exam Panel Area';
		$data['subPage'] = 'Exam Panel';
		$data['title'] = 'Exam Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/exam/classwise_Exampanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function gradcardexampanel(){
		$data['pageTitle'] = 'Exam Panel';
		$data['smallTitle'] = 'Exam Panel';
		$data['mainPage'] = 'Exam Panel Area';
		$data['subPage'] = 'Exam Panel';
		$data['title'] = 'Exam Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/exam/gradcard_exampanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function topperfomertotalexampanel(){
		$data['pageTitle'] = 'Exam Panel';
		$data['smallTitle'] = 'Exam Panel';
		$data['mainPage'] = 'Exam Panel Area';
		$data['subPage'] = 'Exam Panel';
		$data['title'] = 'Exam Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/exam/topperfomertotal_exampanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function topperfomersubjectexampanel(){
		$data['pageTitle'] = 'Exam Panel';
		$data['smallTitle'] = 'Exam Panel';
		$data['mainPage'] = 'Exam Panel Area';
		$data['subPage'] = 'Exam Panel';
		$data['title'] = 'Exam Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/exam/topperfomersubject_exampanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function admitcardstudentexampanel(){
		$data['pageTitle'] = 'Exam Panel';
		$data['smallTitle'] = 'Exam Panel';
		$data['mainPage'] = 'Exam Panel Area';
		$data['subPage'] = 'Exam Panel';
		$data['title'] = 'Exam Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/exam/admitcardstudent_Exampanel';
		$this->load->view("includes/mainContent", $data);


  }

      public function admitcardclassexampanel(){
		$this->load->model("examModel");
		$this->load->model("configureclassmodel");
		$var=$this->examModel->getExamName();
		$data['request']=$var->result();
		$stream=$this->configureclassmodel->getStramforexam();
		$data['stream']=$stream->result();
		$data['pageTitle'] = 'Exam Panel';
		$data['smallTitle'] = 'Exam Panel';
		$data['mainPage'] = 'Exam Panel Area';
		$data['subPage'] = 'Exam Panel';
		$data['title'] = 'Exam Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/exam/admitCard1';
		$this->load->view("includes/mainContent", $data);


  }

      public function performancechartexampanel(){
		$data['pageTitle'] = 'Exam Panel';
		$data['smallTitle'] = 'Exam Panel';
		$data['mainPage'] = 'Exam Panel Area';
		$data['subPage'] = 'Exam Panel';
		$data['title'] = 'Exam Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/exam/performancechart_exampanel';
		$this->load->view("includes/mainContent", $data);


  }

      public function smsexampanel(){
		$data['pageTitle'] = 'Exam Panel';
		$data['smallTitle'] = 'Exam Panel';
		$data['mainPage'] = 'Exam Panel Area';
		$data['subPage'] = 'Exam Panel';
		$data['title'] = 'Exam Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/exam/sms_Exampanel';
		$this->load->view("includes/mainContent", $data);


  }
}

?>