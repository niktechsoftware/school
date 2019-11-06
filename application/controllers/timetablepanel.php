<?php
class Timetablepanel extends CI_Controller{


		public function __construct(){
		parent::__construct();
			$this->is_login();
	
	}
	
	
		function is_login(){
		$is_login = $this->session->userdata('is_login');
	
		if(($is_login != true)){
			
			redirect("index.php/homeController/index");
		}
	
	}


  public function index(){
		$data['pageTitle'] = 'Timetable Panel';
		$data['smallTitle'] = 'Timetable Panel';
		$data['mainPage'] = 'Timetable Panel Area';
		$data['subPage'] = 'Timetable Panel';
		$data['title'] = 'Timetable Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/timetable_panel';
		$this->load->view("includes/mainContent", $data);


  }

    public function studentwisetimetablepanel(){
		$data['pageTitle'] = 'Timetable Panel';
		$data['smallTitle'] = 'Timetable Panel';
		$data['mainPage'] = 'Timetable Panel Area';
		$data['subPage'] = 'Timetable Panel';
		$data['title'] = 'Timetable Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/timetablejs';
		$data['mainContent'] = 'panel/timetable/studentwise_timetablepanel';
		$this->load->view("includes/mainContent", $data);


  }
  
  
   public function findstdtime()
  {

  	$stdid=$this->input->post("studentid");
  	$this->db->where('username',$stdid);
  	$username=$this->db->get('student_info')->row();
  	$stdtime= $username->class_id;
  	$this->db->where('id',$stdtime);
  	$class=$this->db->get('class_info')->row();
  	$data['class']=$class->class_name;
  	$data['name']=$username->name;

  	$this->db->where('class_id',$stdtime);
  	$data['row']=$this->db->get('time_table')->result();


  	$this->load->view('panel/timetable/studentwise',$data);


  }
    public function arrange_apsentteacher()
  { 

 	$data['pageTitle'] = 'Timetable Panel';
		$data['smallTitle'] = 'Timetable Panel';
		$data['mainPage'] = 'Timetable Panel Area';
		$data['subPage'] = 'Timetable Panel';
		$data['title'] = 'Timetable Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/timetablejs';
		$data['mainContent'] = 'panel/timetable/arrange_apsentteacher';
		$this->load->view("includes/mainContent", $data);



  }
  public function findclasstime()
  {

  		$classid=$this->input->post("classid");
  		$this->db->where('class_id',$classid);
  		$data['class']=$this->db->get('time_table');
  			$this->load->view('panel/timetable/classwise',$data);



  }
    
     public function findteachertime()
  {

  	$teacherid=$this->input->post("teacherid");
  	$this->db->where('username',$teacherid);
  	$var=$this->db->get('employee_info');
  if($var->num_rows() > 0){
				
	?>
					<div class="alert alert-success">
						<button data-dismiss="alert" class="close">
							&times;
						</button>
						ID Found ! <strong><?php echo $var->row()->name; ?></strong>
					</div>
					<button id = "pro" class="btn btn-dark-purple">
					Submit <i class="fa fa-arrow-circle-right"></i>
					</button>
					<?php 
					
				}
			else{
				?>
					<div class="alert alert-danger">
						<button data-dismiss="alert" class="close">
							&times;
						</button>
						Sorry :( <strong><?php echo "Teacher Not Found ! Wrong Teacher Id"; ?></strong>
					</div>
				<?php
				
			}

  		//$this->load->view('panel/timetable/teacherwise',$data);



  }

   public function findallteachertime()
  {
	 $teacherid=$this->input->post("teacherid");
	 $this->db->where('id',$teacherid);
  	$username=$this->db->get('employee_info')->row();
  	 $data['name']=$username->name;
  	 $data['mobile']=$username->mobile;
  	  $data['id']=$username->id;
	 $this->db->where('teacher',$teacherid);
  $dt=	$this->db->get('time_table');
  if($dt->num_rows>0){
  	$data['teacher']=$dt->row();
  }
   	$this->load->view('panel/timetable/allteacherwise',$data);

  }
   public function sendmsg_teacher()
  {
	
  	 $id=$this->uri->segment(4);
  $data['mobile']=$this->uri->segment(3);

  	 $this->db->where('teacher',$id);
  	$data['data1']=$this->db->get('time_table')->result();

   	$this->load->view('panel/timetable/teacherwisemsg',$data);

 

  }



    public function classwisetimetablepanel(){
		$data['pageTitle'] = 'Timetable Panel';
		$data['smallTitle'] = 'Timetable Panel';
		$data['mainPage'] = 'Timetable Panel Area';
		$data['subPage'] = 'Timetable Panel';
		$data['title'] = 'Timetable Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/timetablejs';
		$data['mainContent'] = 'panel/timetable/classwise_timetablepanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function schoolwisetimetablepanel(){
		$data['pageTitle'] = 'Timetable Panel';
		$data['smallTitle'] = 'Timetable Panel';
		$data['mainPage'] = 'Timetable Panel Area';
		$data['subPage'] = 'Timetable Panel';
		$data['title'] = 'Timetable Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/timetable/schoolwise_timetablepanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function topperftimetablepanel(){
		$data['pageTitle'] = 'Timetable Panel';
		$data['smallTitle'] = 'Timetable Panel';
		$data['mainPage'] = 'Timetable Panel Area';
		$data['subPage'] = 'Timetable Panel';
		$data['title'] = 'Timetable Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/timetable/topperf_timetablepanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function toplostimetablepanel(){
		$data['pageTitle'] = 'Timetable Panel';
		$data['smallTitle'] = 'Timetable Panel';
		$data['mainPage'] = 'Timetable Panel Area';
		$data['subPage'] = 'Timetable Panel';
		$data['title'] = 'Timetable Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$data['mainContent'] = 'panel/timetable/toplos_timetablepanel';
		$this->load->view("includes/mainContent", $data);


  }

    public function viewlesstimetablepanel(){
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

  //     public function topabemptimetablepanel(){
	// 	$data['pageTitle'] = 'Attendance Panel';
	// 	$data['smallTitle'] = 'Attendance Panel';
	// 	$data['mainPage'] = 'Attendance Panel Area';
	// 	$data['subPage'] = 'Attendance Panel';
	// 	$data['title'] = 'Attendance Panel Area ';
	// 	$data['headerCss'] = 'headerCss/noticeCss';
	// 	$data['footerJs'] = 'footerJs/noticeJs';
	// 	$data['mainContent'] = 'panel/timetable/topabemp_timetablepanel';
	// 	$this->load->view("includes/mainContent", $data);


  // }

      public function empwisetimetablepanel(){
		$data['pageTitle'] = 'Timetable Panel';
		$data['smallTitle'] = 'Timetable Panel';
		$data['mainPage'] = 'Timetable Panel Area';
		$data['subPage'] = 'Timetable Panel';
		$data['title'] = 'Timetable Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/timetablejs';
		$data['mainContent'] = 'panel/timetable/empwise_timetablepanel';
		$this->load->view("includes/mainContent", $data);


  }

  public function ttableprint(){
	$data['teacherid'] = $this->input->post('teacherid');
	$data['pageTitle'] = 'Timetable Panel';
	$data['smallTitle'] = 'Timetable Panel';
	$data['mainPage'] = 'Timetable Panel Area';
	$data['subPage'] = 'Timetable Panel';
	$data['title'] = 'Timetable Panel Area ';
	$data['headerCss'] = 'headerCss/noticeCss';
	$data['footerJs'] = 'footerJs/timetablejs';
	$data['mainContent'] = 'teacherTimeTablePrint';
	$this->load->view("includes/mainContent", $data);


}

	public function totalempwisetimetablepanel(){
	$data['pageTitle'] = 'Timetable Panel';
	$data['smallTitle'] = 'Timetable Panel';
	$data['mainPage'] = 'Timetable Panel Area';
	$data['subPage'] = 'Timetable Panel';
	$data['title'] = 'Timetable Panel Area ';
	$data['headerCss'] = 'headerCss/noticeCss';
	$data['footerJs'] = 'footerJs/timetablejs';
	$data['mainContent'] = 'panel/timetable/totalempwise_timetablepanel';
	$this->load->view("includes/mainContent", $data);
  }



}

?>