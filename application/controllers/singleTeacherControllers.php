<?php class singleTeacherControllers extends CI_Controller{
	function __construct()
	{
		parent::__construct();
			$this->is_login();
		$this->load->model("singleTeacherModel");
		$this->load->model("subjectModel");
		$this->load->model("singleStudentModel");
		$school_code = $this->session->userdata("school_code");
	}
	

		function is_login(){
		$is_login = $this->session->userdata('is_login');
	
		if((!$is_login)){
			
			redirect("index.php/homeController/index");
		}
	
	}
	
	function index(){

			$school_code=$this->session->userdata("school_code");

		$data['pageTitle'] = 'Dashboard';
		$data['smallTitle'] = 'Overview of all Section';
		$data['mainPage'] = 'Dashboard';
		$data['subPage'] = 'dashboard';
		$data['title'] = 'School Dashboard';
		$data['headerCss'] = 'headerCss/dashboardCss';
		$data['footerJs'] = 'footerJs/dashboardJs';
		$data['mainContent'] = 'teacherdashboard';
		$this->load->view("includes/mainContent", $data);
	
	}
		function chat() {
		 
		$data['subPage'] = 'Video Chat';
		$data['smallTitle'] = 'Chat';
		$data['pageTitle'] = 'Video Chat';
		$data['mainPage'] = 'Dashboard';
		$data['title'] = 'Teacher | Dashboard';
	    $data['footerJs'] = 'footerJs/dashboardJs';
		$data['headerCss'] = 'headerCss/dashboardCss';
		$data['mainContent'] = 'googleChat';
		$this->load->view("includes/mainContent", $data);
	}
	function chatBranch() {
	       
		$data['subPage'] = 'Video Chat';
		$data['smallTitle'] = 'Chat';
		$data['mainPage'] = 'Dashboard';
		$data['pageTitle'] = 'Video Chat';
		$data['title'] = 'Teacher | Dashboard';
		$data['headerCss'] = 'headerCss/dashboardCss';
	    $data['footerJs'] = 'footerJs/dashboardJs';
		$data['mainContent'] = 'googleChatBranch';
		$this->load->view("includes/mainContent", $data);
	}
	
	
		function updateProfile()
	{

		$empNo = $this->input->post("empId");
		$data = array(
			'name' => $this->input->post("firstName"),
			'category' => $this->input->post("category"),
			'dob' => $this->input->post("dob"),
			'gender' => $this->input->post("gender"),
			'job_title' => $this->input->post("job_title"),
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
			'status' =>1,
			//"school_code"=>$this->session->userdata("school_code"),
			'password' => $this->input->post("password")
		);
		//print_r($data);
		$this->load->model('employeeModel');
		$result = $this->employeeModel->updateEmployeProfile($empNo,$data);
		 if($result)
		 {
			redirect('index.php/singleTeacherControllers/viewProfile');
		 }
		
	}

	function appove()
	{
    
          $id=$this->uri->segment('3');
       
          $leave= array(
          	'approve' =>'YES', 
          );
        
         $this->db->where('id',$id);
         $this->db->where('school_code',$this->session->userdata('school_code'));
          $up=$this->db->update('stu_leave',$leave);
         if($up)
		{
		    $msg="success";
			redirect("index.php/singleTeacherControllers/index/$msg");
		}

	}

	function deleette()
	{


         $id=$this->uri->segment('3');
          $this->db->where('id',$id);
         $this->db->where('school_code',$this->session->userdata('school_code'));
          $up=$this->db->delete('stu_leave');
        if($up)
		{
		    $msg="success";
			redirect("index.php/singleTeacherControllers/index/$msg");
		}
	}
	

	
	function viewProfile(){
		$this->load->model("allFormModel");
		$tID = $this->session->userdata('username');
		$this->db->where("username",$tID);
		$tid=$this->db->get("employee_info");
		$id= $tid->row();
		$teacherID=$id->id;
		$stDetail = $this->singleTeacherModel->getTeacherDetail($teacherID);
		$data['teacherProfile'] = $stDetail->row();
		$data['pageTitle'] = 'Teacher Profile';
		$data['smallTitle'] = 'Teacher Personal Detail';
		$data['mainPage'] = 'Teacher';
		$data['subPage'] = 'Teacher Personal Detail';
		$data['title'] = 'Teacher Personal Detail';
		$data['headerCss'] = 'headerCss/singleTeacherCss';
		$data['footerJs'] = 'footerJs/singleTeacherJs';
		$data['mainContent'] = 'teacherProfile';
		$this->load->view("includes/mainContent", $data);
	}
	
	
	
       function salarySummry(){
        $emp_id = $this->session->userdata("username");
        $school_code = $this->session->userdata("school_code");
        $data['var'] = $this->db->query("select * from emp_salary_info where school_code='$school_code' AND emp_id ='$emp_id'")->result();
        $data['pageTitle'] = 'Teacher Section';
        $data['smallTitle'] = 'Teacher Summary';
        $data['mainPage'] = 'Teacher';
        $data['subPage'] = 'Teacher Salary Summary';
        $data['title'] = 'Teacher Salary Summary';
        $data['headerCss'] = 'headerCss/singleTeacherCss';
        $data['footerJs'] = 'footerJs/singleTeacherJs';
        $data['mainContent'] = 'salarySummry';
        $this->load->view("includes/mainContent", $data);
    }
	
	function teacherLeave(){
		$data['pageTitle'] = 'Teacher Section';
		$data['smallTitle'] = 'Teacher Leave Details';
		$data['mainPage'] = 'Teacher';
		$data['subPage'] = 'Teacher Leave Details';
		$data['title'] = 'Teacher Leave Details';
		$data['headerCss'] = 'headerCss/singleTeacherCss';
		$data['footerJs'] = 'footerJs/singleTeacherJs';
		$data['mainContent'] = 'teacherLeave';
		$this->load->view("includes/mainContent", $data);
	}
	function deleleaveemp()
	{

           $id=$this->input->post('id');
    //print_r($id);exit;
    
        
          
          $this->db->where('id',$id);
         $this->db->where('school_code',$this->session->userdata('school_code'));
          $up=$this->db->delete('emp_leave');
          
       

	}
	
	function classTaken(){
		$teacher_username = $this->session->userdata('username');
		$data1  = $this->singleTeacherModel->time_Table($teacher_username);
		$data['timetable']= $data1['tt'];
		$data['period']= $data1['pr'];
		// print_r($data['timetable']);
		// echo "<br><br><br>";
		// print_r($data['period']);
		// exit;
		$data['pageTitle'] = 'Teacher Section';
		$data['smallTitle'] = 'Teacher Class Detail';
		$data['mainPage'] = 'Teacher';
		$data['subPage'] = 'Teacher Class Detail';
		$data['title'] = 'Teacher Class Detail';
		$data['headerCss'] = 'headerCss/singleTeacherCss';
		$data['footerJs'] = 'footerJs/singleTeacherJs';
		$data['mainContent'] = 'classTaken';
		$this->load->view("includes/mainContent", $data);
	}
	
	function marksEntry(){
	   	$data['pageTitle'] = 'Exam Details';
		$data['smallTitle'] = 'Exam Details';
		$data['mainPage'] = 'Exam';
		$data['subPage'] = 'Exam Details';
			$this->load->model("configureclassmodel");
			$this->load->model("configurefeemodel");
		$this->load->model("examModel");
		$var=$this->examModel->getExamName($this->session->userdata("fsd"));
		$data['request']=$var->result();
		$stream=$this->configureclassmodel->getStramforexam();
		$data['stream']=$stream->result();
		$data['title'] = 'Exam Details';
		$data['headerCss'] = 'headerCss/examCss';
		$data['footerJs'] = 'footerJs/examJs';
		$data['mainContent'] = 'examDetail';
		$this->load->view("includes/mainContent", $data);
	}
	
	function feeReport(){
		$data['pageTitle'] = 'Teacher Section';
		$data['smallTitle'] = 'Fee Report';
		$data['mainPage'] = 'Teacher';
		$data['subPage'] = 'Fee Report';
		$data['title'] = 'Fee Report';
		$this->load->model("configureClassModel");
	//	$req=$this->configureClassModel->getClassList();
		$sc = $this->session->userdata('school_code');
		$data['request'] = $this->db->query("select distinct section FROM class_info WHERE school_code='$sc'")->result();
	//	$data['request']=$this->configureClassModel->getClassList()->result();
		//	print_r($data1);exit;
		$data['headerCss'] = 'headerCss/singleTeacherCss';
		$data['footerJs'] = 'footerJs/singleTeacherJs';
		$data['mainContent'] = 'feeReport';
		$this->load->view("includes/mainContent", $data);
	}
	
	function teacherStudentAttendance(){
	    $this->load->model("allFormModel");
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
	
	function teacherStuAttendanceReport(){
		$data['pageTitle'] = 'Teacher Section';
		$data['smallTitle'] = 'Attendance Report';
		$data['mainPage'] = 'Teacher';
		$data['subPage'] = 'Attendance Report';
		$data['title'] = 'Attendance Report';
		$this->load->model("configureClassModel");
		$req=$this->configureClassModel->getClassName();
		$data['request']=$req->result();
		$data['headerCss'] = 'headerCss/singleTeacherCss';
		$data['footerJs'] = 'footerJs/singleTeacherJs';
		$data['mainContent'] = 'teacherStuAttendanceReport';
		$this->load->view("includes/mainContent", $data);
	}
	
	function teacherClasstimeTable(){
		$stu_id = $this->session->userdata('username');

		$var1 = $this->singleTeacherModel->time_Table($stu_id);
		//print_r($var1);exit();
		//$data['timetable']=$var1->result();
		$data['pageTitle'] = 'Teacher Section';
		$data['smallTitle'] = 'Class Time Table';
		$data['mainPage'] = 'Teacher';
		$data['subPage'] = 'Class Time Table';
		$data['title'] = 'Class Time Table';
		$data['headerCss'] = 'headerCss/singleTeacherCss';
		$data['footerJs'] = 'footerJs/singleTeacherJs';
		$data['mainContent'] = 'teacherClasstimeTable';
		$this->load->view("includes/mainContent", $data);
	}
	function getperiod(){
		$data['timeTable']=$this->input->post('thead');
		//print_r($timeTable);
		$this->load->view('ajax/teacherTimeTable',$data);
	}
	function teacherExamDuty(){
		$data['pageTitle'] = 'Teacher Section';
		$data['smallTitle'] = 'Teacher Exam Duty';
		$data['mainPage'] = 'Teacher';
		$data['subPage'] = 'Teacher Exam Duty';
		$data['title'] = 'Teacher Exam Duty';
		$data['headerCss'] = 'headerCss/singleTeacherCss';
		$data['footerJs'] = 'footerJs/singleTeacherJs';
		$data['mainContent'] = 'teacherExamDuty';
		$this->load->view("includes/mainContent", $data);
	}
	
	function teacherTimeTable(){
		$data['pageTitle'] = 'Teacher Section';
		$data['smallTitle'] = 'Teacher Time Table';
		$data['mainPage'] = 'Teacher';
		$data['subPage'] = 'Teacher Time Table';
		$data['title'] = 'Teacher Time Table';
		$data['headerCss'] = 'headerCss/singleTeacherCss';
		$data['footerJs'] = 'footerJs/singleTeacherJs';
		$data['mainContent'] = 'teacherTimeTable';
		$this->load->view("includes/mainContent", $data);
	}
	
	function teacherExamDetail(){
		$data['pageTitle'] = 'Teacher Section';
		$data['smallTitle'] = 'Teacher Exam Duty';
		$data['mainPage'] = 'Teacher';
		$data['subPage'] = 'Teacher Exam Duty';
		$data['title'] = 'Teacher Exam Duty';
		$data['headerCss'] = 'headerCss/singleTeacherCss';
		$data['footerJs'] = 'footerJs/singleTeacherJs';
		$data['mainContent'] = 'teacherExamDetail';
		$this->load->view("includes/mainContent", $data);
	}
	
	function teacherResults(){
		$data['pageTitle'] = 'Teacher Section';
		$data['smallTitle'] = 'Teacher Results Summry';
		$data['mainPage'] = 'Teacher';
		$data['subPage'] = 'Teacher Results Summry';
		$data['title'] = 'Teacher Results Summry';
		$data['headerCss'] = 'headerCss/singleTeacherCss';
		$data['footerJs'] = 'footerJs/singleTeacherJs';
		$data['mainContent'] = 'teacherResults';
		$this->load->view("includes/mainContent", $data);
	}
	
	function teacherStockDetail(){
		$data['pageTitle'] = 'Teacher Section';
		$data['smallTitle'] = 'Stock Detail';
		$data['mainPage'] = 'Teacher';
		$data['subPage'] = 'Stock Detail';
		$data['title'] = 'Stock Detail';
		$data['headerCss'] = 'headerCss/singleTeacherCss';
		$data['footerJs'] = 'footerJs/singleTeacherJs';
		$data['mainContent'] = 'teacherStockDetail';
		$this->load->view("includes/mainContent", $data);
	}
	function teacherNoticeAlert(){
		$data['pageTitle'] = 'Teacher Section';
		$data['smallTitle'] = 'Teacher Notice Alert';
		$data['mainPage'] = 'Teacher';
		$data['subPage'] = 'Teacher Notice Alert';
		$data['title'] = 'Teacher Notice Alert';
		$data['headerCss'] = 'headerCss/singleTeacherCss';
		$data['footerJs'] = 'footerJs/singleTeacherJs';
		$data['mainContent'] = 'teacherNoticeAlert';
		$this->load->view("includes/mainContent", $data);
	}
	function teacherMessage(){
		$data['pageTitle'] = 'Teacher Section';
		$data['smallTitle'] = 'Teacher Message';
		$data['mainPage'] = 'Teacher';
		$data['subPage'] = 'Message';
		$data['title'] = 'Message';
		$data['headerCss'] = 'headerCss/singleTeacherCss';
		$data['footerJs'] = 'footerJs/singleTeacherJs';
		$data['mainContent'] = 'teacherMessage';
		$this->load->view("includes/mainContent", $data);
	}
	
	function insertLeave(){
	    $eidd=$this->session->userdata('username');
         $this->db->where("username",$eidd);
        $eid=$this->db->get("employee_info");
        $id= $eid->row();
        $emp_id = $id->id;
		$data =array(
				'emp_id'=>$emp_id,
				'start_date'=>$this->input->post("sdate"),
				'end_date'=>$this->input->post("edate"),
				'total_leave'=>$this->input->post("totalLeave"),
				'reason'=>$this->input->post("reason"),
				//'approve'=>"NO",
				"school_code"=>$this->session->userdata("school_code")
		);
		$var=$this->singleTeacherModel->insertLeave($data);
		if($var)
		{
			$msg="success";
			redirect("index.php/singleTeacherControllers/teacherLeave/$msg");
		}
	}
	
	function studentAtten()
	{
		$i = $this->input->post("rows");
		$this->load->model("teacherModel");
		$this->load->model("teacherModel");
		for($j=1; $j<$i; $j++){
			$data = array(
					//"section" => $this->input->post("section"),
					"class_id" => $this->input->post("class"),
				//	"teacher_id" => $this->session->userdata("userid"),
				//	"scholer_number" => $this->input->post("schno$j"),
					"stu_id" => $this->input->post("stuID$j"),
					"attendance" => $this->input->post("gender$j"),
					"a_date" => date("Y-m-d"),
					"school_code"=>$this->session->userdata("school_code")
			);
			
			$this->teacherModel->addstuAttendance($data);
		}
		redirect("index.php/singleTeacherControllers/teacherStudentAttendance/Attendance Done");
	}
	
	function teacherAReport(){
		$v=$this->session->userdata('username');
		$start_date=$this->input->post("sdate");
		$end_date=$this->input->post("edate");
		$school_code=$this->session->userdata('school_code');
		$fsd=$this->session->userdata('fsd');
		//print_r($fsd);
		$this->db->where('username',$v);
		$this->db->where('school_code',$school_code);
		$this->db->where('fsd',$fsd);
		$this->db->where('status',1);
		$empid=$this->db->get('employee_info')->row()->id;
		$this->db->where('school_code',$school_code);
			$this->db->where('emp_id',$empid);
			$this->db->where('a_date >=',$start_date);
			$this->db->where('a_date <=',$end_date);
			$var=$this->db->get('teacher_attendance');
//		$request=$this->db->query("SELECT * FROM teacher_attendance WHERE emp_id = '$empid' AND a_date >'$start_date' AND a_date < '$end_date' AND school_code='$school_code'");
		
		    	?>
		    	<br><br>
		    	<hr>
		    	<div class="panel-body">
      <div class="alert alert-info">
        <button data-dismiss="alert" class="close">×</button>
        <h3 class="media-heading text-center"> Welcome to Attendence Report Area</h3>
       <p class="media-timestamp"> 
       Here you can see all attendence of you class from starting date to end date which are you selected.
       </p>
      </div>
                    <div class="row">
						<div class="col-md-12 space20">
							<div class="btn-group pull-right">
								<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
									Export <i class="fa fa-angle-down"></i>
								</button>
								<?php if($this->session->userdata('login_type') == 'admin'){?>
								<ul class="dropdown-menu dropdown-light pull-right">
									<!--<li>-->
									<!--	<a href="#" class="export-pdf" data-table="#sample-table-2" >-->
									<!--		Save as PDF-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-png" data-table="#sample-table-2">-->
									<!--		Save as PNG-->
									<!--	</a>-->
									<!--</li>-->
									<li>
										<a href="#" class="export-csv" data-table="#sample-table-2" >
											Save as CSV
										</a>
									</li>
									<li>
										<a href="#" class="export-txt" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as TXT
										</a>
									</li>
									<!--<li>-->
									<!--	<a href="#" class="export-xml" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as XML-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-sql" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as SQL-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-json" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as JSON-->
									<!--	</a>-->
									<!--</li>-->
									<li>
										<a href="#" class="export-excel" data-table="#sample-table-2" >
											Export to Excel
										</a>
									</li>
									<li>
										<a href="#" class="export-doc" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Export to Word
										</a>
									</li>
									<li>
										<a href="#" class="export-powerpoint" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Export to PowerPoint
										</a>
									</li>
								</ul>
								<?php }?>
							</div>
						</div>
					</div>
      <div class="table-responsive" style="width:100%; overflow-y: scroll;">

	<table class="table table-striped table-hover" id="sample-table-2">
							<thead>
								<tr>
									<th>S.No.</th>
									<!--<th>Attendance</th>-->
									<th>Attendance Date</th>
									<th>Present/Absent</th>
									<!-- <th>Detail</th>  -->
								</tr>
							</thead>
							<tbody>
								<?php $i=1;
			  			 foreach ($var->result() as $row){	
			  				?><tr>
			  					<td><?php echo $i;?></td>
			  					<!--<td><?php //echo $row->attendance; ?></td>-->
			  					
				  				<td><?php echo $row->a_date;?></td>
				  				<td>
				  				   	<?php 
				  				        	$atten=$row->attendance;
				  							if($atten==1){
				  							?><?php echo "Present";}
				  							else { if ($atten==0){ 
				  								echo "Absent";
				  							}else echo "Leave";}?>
				  				</td>
				  				<!-- <td>
				  					<button data-target=".bs-example-modal-basic1" data-toggle="modal" class="btn btn-blue">
										View Detail
									</button>
				  				</td>
				  				-->
				  			</tr>
				  			<?php 
			  			}?>
							</tbody>
						</table>
						</div>
						</div>
						<?php
	}
	/*	public function defineHomeWork(){
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
}*/

function showHomeWork()
{
		$school_code=$this->session->userdata('school_code');
	$this->load->model("homeWorkModel");
	$res=$this->db->query("SELECT DISTINCT section,id FROM class_section where school_code = $school_code ");
		$data['noc'] = $res->result();
		$va=$this->homeWorkModel->getHomeWorkDetail();
		$data['var1']=$va->result();
	$data['pageTitle'] = 'Show HomeWork';
	$data['smallTitle'] = 'Employee/Teacher/Student';
	$data['mainPage'] = 'Show HomeWork';
	$data['subPage'] = 'Employee/Teacher/Student';
	$data['title'] = 'Show HomeWork';
	$data['headerCss'] = 'headerCss/homeWorkCss';
	$data['footerJs'] = 'footerJs/showHomeWorkJs';
	$data['mainContent'] = 'showHomeWork';
	$this->load->view("includes/mainContent", $data);

	
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


	
}

