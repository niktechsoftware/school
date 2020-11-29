<?php
class Exampanel extends CI_Controller{
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
	
		if(!$is_login){
			//echo $is_login;
			redirect("index.php/homeController/index");
		}
		elseif(!$is_lock){
			redirect("index.php/homeController/lockPage");
		}
	}

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
        $fsd=$this->input->post("fsd");             
  		$examid=$this->input->post("examid");
  		$student_id=$this->input->post("stdexam");
  	    //$this->db->distinct();
        //$this->db->select('subject_id','out_of','marks');
		$this->db->where('exam_id',$examid);
  		$this->db->where('stu_id',$student_id);
  		$this->db->where('fsd',$fsd);
  		$exam=$this->db->get('exam_info')->result();
  		$data['exam']=$exam;
  		$this->load->view('panel/exam/studentwise',$data);
      }

  public function findclassexam()
	  {
		$school_code=$this->session->userdata("school_code");
        // $fsd=$this->session->userdata("fsd");                     
	    $classid=$this->input->post("classid");
		$data['classid']=$classid;
  		$data['examid']=$this->input->post("examid");
  		$data['fsd']=$this->input->post("fsd");
  		if($this->input->post("fsd")==$this->session->userdata("fsd")){
  		    
  		   	            $this->db->select("id");
						 $this->db->where('status',1);
						 $this->db->where('class_id',$classid);
	    $data['student_id']=$this->db->get('student_info')->result();
  		}else{
  		   	 
  		   	            $this->db->select("student_id as id");
						 $this->db->where('fsd',$this->input->post("fsd"));
						 $this->db->where('class_id',$classid);
	    $data['student_id']=$this->db->get('old_student_info')->result();       
  		}
  	

  		$this->load->view('panel/exam/classwise',$data);

	  }

	  public function findclassstudentexam()
        {
        $data['pageTitle'] = 'Exam Panel';
		$data['smallTitle'] = 'Exam Panel';
		$data['mainPage'] = 'Exam Panel Area';
		$data['subPage'] = 'Exam Panel';
		$data['title'] = 'Exam Panel Area';
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
            //  $sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
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
	  
	  public function home_subseq(){
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
		$data['mainContent'] = 'panel/exam/home_subseq';
		$this->load->view("includes/mainContent", $data);


  }
	   public function subseq()
	  {
            $fsd=$this->input->post("fsd");
            $fsd=25;
	  		$classid=$this->input->post("clname");
	  		$examTypeResult1 = $this->db->query("select DISTINCT subject.id from subject join exam_info on subject.id= exam_info.subject_id where exam_info.fsd='$fsd' and exam_info.class_id='$classid' order by subject.id ASC ");
	  		
	  	if($examTypeResult1->num_rows()>0)
	  	{
	  	    ?>
	  	     
        <form action="<?php echo base_url();?>index.php/adminController/updatesequ" method="post" role="form"
          class="form-horizontal" id="form">
	  	        <table>
	  	            <tr><td>Subject </td><td>Current Position</td><td>Reorder Position</td></tr>
	  	            <?php $i =1; foreach($examTypeResult1->result() as $row):?>
	  	            <tr><td><?php $this->db->where("id",$row->id);
	  	           $sname=  $this->db->get("subject")->row();echo $sname->subject;?></td>
	  	           <td><?php echo $i;?></td><td>
	  	               <input type="text" name="a<?php echo $i;?>" value=<?php echo $row->id;?> />
	  	               <input type="number" name="r<?php echo $i;?>" required="required"/> </td></tr>
	  	            <?php $i++; endforeach;?>
	  	            <input type ="hidden" name ="rownum" value ="<?php echo $i;?>"/>
	  	        </table>
	  	        <button type="submit" >Submit</button>
	  	        </form>
	  	    <?php
	  	}else{
	  	    echo "First you have to fill exam marks.";
	  	}

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
  public function classwisereport(){
		$data['pageTitle'] = 'Exam Panel';
		$data['smallTitle'] = 'Exam Panel';
		$data['mainPage'] = 'Exam Panel Area';
		$data['subPage'] = 'Exam Panel';
		$data['title'] = 'Exam Panel Area ';
		$data['headerCss'] = 'headerCss/noticeCss';
		$data['footerJs'] = 'footerJs/noticeJs';
		$this->load->model("allFormModel");
		$data['request'] = $this->allFormModel->getsectionfeereport()->result();
		$data['mainContent'] = 'panel/exam/classwisereport';
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