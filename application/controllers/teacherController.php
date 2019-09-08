
<?php 
class TeacherController extends CI_Controller{
	public static $sno = 0;
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("teacherModel");
		$school_code = $this->session->userdata("school_code");
	}
	function getSubject(){
	$this->db->where("class_id",$this->input->post("classv"));
		$var = $this->db->get("subject");
			if($var->num_rows() > 0){
				echo '<option value="">-Select Subject-</option>';
				foreach ($var->result() as $row){
					echo '<option value="'.$row->id.'">'.$row->subject.'</option>';
				} 
				echo '<option value="all">All</option>';
			}
		}
		function getclass(){
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("section",$this->input->post("section"));
		$var = $this->db->get("class_info");
			if($var->num_rows() > 0){
				echo '<option value="">-Select Class-</option>';
				foreach ($var->result() as $row){
					echo '<option value="'.$row->id.'">'.$row->class_name.'</option>';
				} 
				echo '<option value="all">All</option>';
			}
		}
	 function getSection(){
		$tid = $this->input->post("classv");
		$this->load->model("teacherModel");
		$var = $this->teacherModel->getSection($tid);
			if($var->num_rows() > 0){
				echo '<option value="">-Select Class-</option>';
				foreach ($var->result() as $row){
					echo '<option value="'.$row->id.'">'.$row->class_name.'</option>';
				} 
				//echo '<option value="all">All</option>';
			}
	    }

function getclassforexam(){
		$streamid = $this->input->post("streamid");
		$sectionid = $this->input->post("sectionid");
		$this->load->model("teacherModel");
		//echo $streamid."-".$sectionid;
		$var = $this->teacherModel->getclassforexam($streamid,$sectionid);
			if($var->num_rows() > 0){
				echo '<option value="">-Select Class-</option>';
				foreach ($var->result() as $row){
					echo '<option value="'.$row->id.'">'.$row->class_name.'</option>';
				} 
				// echo '<option value="all">All</option>';
			}
	    }

	     function getSectionforexam(){
		$streamid = $this->input->post("streamid");
		$this->load->model("teacherModel");
		$var = $this->teacherModel->getSectionforexam($streamid);
			if($var->num_rows() > 0){
				echo '<option value="">-Select Section-</option>';
				foreach ($var->result() as $row){
                        $sectionid=$row->section;
                        
                      $this->db->where('id',$sectionid);
                      $section=$this->db->get('class_section')->result();
                     foreach ($section as $row1){

					echo '<option value="'.$row1->id.'">'.$row1->section.'</option>';
				} 
				// echo '<option value="all">All</option>';
			}
	    }
	}
	    
	    
	function presentiH(){
		$classid = $this->input->post("classid");
		$date1 = $this->input->post("date1");
		if(strlen($date1)==0){
			$date1=date("Y-m-d");
		  }
		  $teacherid = $this->input->post("teacherid");
		$check = $this->teacherModel->checkPresenti($classid,$date1);
		if($check->num_rows() > 0)
		{
		
		}
		else
		{
		if($check)
		{?>
			<tr>
			<td>S.No.</td>
			<td>Student ID </td>
			<!--<td> Scholer No</td>-->
			<td> Student Name</td>
				<td>Father Name</td>
			<!--<td> Mobile</td>-->
			<td> Attendance<input type="hidden" value="300001" name="tID" /></td>
			</tr>
			<?php 
		}
		}
	}
	function presentiHa2(){
	
		$classid = $this->input->post("classid");
		$date1 = $this->input->post("date1");
		if(strlen($date1)==0){
			$date1=date("Y-m-d");
		}
		$teacherid = $this->input->post("teacherid");
		$check = $this->teacherModel->checkPresentia2($classid,$date1);
		if($check->num_rows() > 0)
		{
		
		}
		else
		{
		if($check)
		{?>
			<tr>
			<td>S.No.</td>
			<td>Student ID </td>
			<!--<td> Scholer No</td>-->
			<td> Student Name</td>
			<!--<td> Mobile</td>-->
			<td> Attendance<input type="hidden" value="300001" name="tID" /></td>
			</tr>
			<?php 
		}
		}
		}
	
	function presenti(){

		$data['date1'] = $this->input->post("date1");
		$date1 = $this->input->post("date1");
		if(strlen($date1)==0){
			$date1=date("Y-m-d");
			$data['date1']=date("Y-m-d");
		}
		$data['sec'] = $this->input->post("classid");
	    $sec = $this->input->post("classid");

		//$data['cla']  = $this->input->post("classv");
		//$cla = $this->input->post("classv");
		
		$data['tid'] = $this->input->post("teacherid");
		$tid= $this->input->post("teacherid");
		
		$data['check'] = $this->teacherModel->checkPresenti($sec,$date1);

		$data['var'] = $this->teacherModel->getPresenti($sec);
		$this->load->view("ajax/studenceAtten",$data);
	}
	
	
	function presentia2(){
	
		$data['date1'] = $this->input->post("date1");
		$date1 = $this->input->post("date1");
		if(strlen($date1)==0){
			$date1=date("Y-m-d");
			$data['date1']=date("Y-m-d");
		}
		$data['sec'] = $this->input->post("classid");
		$sec = $this->input->post("classid");
		$data['tid'] = $this->input->post("teacherid");
		$tid= $this->input->post("teacherid");
		
		$data['check'] = $this->teacherModel->checkPresentia2($sec,$date1);
		$data['var'] = $this->teacherModel->getPresenti($sec);
		$this->load->view("ajax/studenceAtten2",$data);
	}
					
	    function getClassForSection(){
		$sectionid = $this->input->post("sectionid");
		if($sectionid!=0){
		$this->load->model("teacherModel");
		$var = $this->teacherModel->getClassforattendence($sectionid);
			if($var->num_rows() > 0){
		  echo '<option value="">-Select Class-</option>';
				foreach ($var->result() as $row)
				{
                       
					echo '<option value="'.$row->id.'">'.$row->class_name.'</option>';
				} 
				
			}
		}
		else{
		    
		    echo "Somthing is wrong!please try to after some time";
		  }
		
			}
			function getSectiontransport(){
				$tid = $this->input->post("sectionid");
				$this->load->model("teacherModel");

				$var1 = $this->teacherModel->getSectionTransport($tid);
				if	($var1->num_rows() > 0){
						echo '<option value="">-Select Class-</option>';
						foreach ($var1->result() as $row1){
							echo '<option value="'.$row1->id.'">'.$row1->class_name.'</option>';
						} 
						// echo '<option value="all">All</option>';
						
					}
			}


			function getClassbySectionfeeReport(){
				$sectionid = $this->input->post("sectionid");
				$this->load->model("teacherModel");
				$var = $this->teacherModel->getClassBySectionFeeReport($sectionid);
 
					if($var->num_rows() > 0){

						echo '<option value="">-Select Class-</option>';
						foreach ($var->result() as $row){
							echo '<option value="'.$row->id.'">'.$row->class_name.'</option>';
						} 

						
					}
					}
		function getSubjecforexam(){
			//$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("class_id",$this->input->post("classid"));
		
		//$this->db->where("id",$this->input->post("section"));
		$var = $this->db->get("subject");
			if($var->num_rows() > 0){
				echo '<option value="">-Select Subject-</option>';
				foreach ($var->result() as $row){
					echo '<option value="'.$row->id.'">'.$row->subject.'</option>';
				} 
				 echo '<option value="all">All</option>';
			}
		}
	
	function checkID(){
		$tid = $this->input->post("teacherid");
		$this->load->model("teacherModel");
		$var = $this->teacherModel->checkID($tid);
		//print_r($var);exit;
		if($var->num_rows() > 0){
			foreach ($var->result() as $row){
				?>
				<div class="alert alert-success">
					<button data-dismiss="alert" class="close">
						&times;
					</button>
					ID Found ! <strong><?php echo $row->name; ?></strong>
				</div>
				<?php 
			}}
		else{
			?>
				<div class="alert alert-danger">
					<button data-dismiss="alert" class="close">
						&times;
					</button>
					Sorry :( <strong><?php echo "Teacher Not Found ! Wrong teacher Id"; ?></strong>
				</div>
			<?php
			
		}
	
}

function checkIDOTP(){
	$tid = $this->input->post("discounterID");
	$discountv = $this->input->post("discountv");
	$this->load->model("teacherModel");
	$this->load->model("smsmodel");
	$var = $this->teacherModel->checkID($tid);
	//print_r($var);
	if($var->num_rows() > 0){
		$row=	$var->row()		?>
				<div class="alert alert-success">
					<button data-dismiss="alert" class="close">
						&times;
					</button>
					ID Found ! <strong><?php echo $row->name; ?></strong>
				</div>
				<?php 
				$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
				$findvalue=$this->db->where('id',$this->session->userdata('school_code'));
				$schid=$this->db->get('school')->row();
				if($sender->num_rows()>0){
					$sende_Detail =$sender->row();
					$otp = rand(1000,99999);
					$msg="Your Discount OTP id = ".$otp." please don't share this.";
					if($this->session->userdata('school_code')==1){
						sms($schid->mobile_no,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
					
					}
					else{
					sms($row->mobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
					}
					$data=array(
						"otp"=>$otp,
						"discounter_id"=>$tid,
						"discount_rupee"=>$discountv,
						"school_code"=>$this->session->userdata("school_code"),
					);
					$this->db->insert("dis_den_tab",$data);
				}
				?>
				<?php if($this->session->userdata('school_code')==1){?>
				    
				    <script>
				
				alert("An OTP is send on Admin Mobile number please enter");
				$("#discounterOTP").show();
				
				</script><?php
				    
				}else{?>
				<script>
				
				alert("An OTP is send on Teacher Mobile number please enter");
				$("#discounterOTP").show();
				
				</script>
				<?php }
				
			}
		else{
			?>
				<div class="alert alert-danger">
					<button data-dismiss="alert" class="close">
						&times;
					</button>
					Sorry :( <strong><?php echo "Teacher Not Found ! Wrong teacher Id"; ?></strong>
				</div>
				<script>
				$("#discounterOTP").hide();
				</script>
			<?php
			
		}
	
}

function checkIDOTPc(){
	
	$discounterIDv = $this->input->post("discounterIDv");
	$this->db->where("otp",$discounterIDv);
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$vrt = $this->db->get("dis_den_tab");
	if($vrt->num_rows() > 0){
		$vrt=$vrt->row();
		$itemData = array(
				"sms" =>"yes",
				"dis"=>$vrt->discount_rupee
		);
				}
			else{
				$itemData = array(
				"sms" =>"no",
						"dis"=>0
		);
				
			}
			echo (json_encode($itemData));
}

			  function teacherAtten()
			  {



			  	$teacherID = $this->input->post("teacherId");
			  	$date = $this->input->post("date");
			  	$t_ID = $this->input->post("tID");
			  	$attendance = $this->input->post("attendance");
			  	$reason = $this->input->post("reason");
			  	$intime = $this->input->post("itime");
			  	$outtime = $this->input->post("otime");
			  	$latetime = $this->input->post("ltime");
			  	

			  	$this->load->model("teacherModel");
			  	
			  	if($teacherID == '' && $date == ''):
			  	    
			  	    redirect("index.php/login/teacherAttendance");
			  	    
			  	else:
			  	    
			  	    $data = array(
			  				"taken_id" => $t_ID,
			  				"emp_id" => $teacherID,
			  				"attendance" => $attendance,
			  				"a_date" => $date,
			  				"school_code"=>$this->session->userdata("school_code"),
			  				"reason"=>$reason,
			  				"in_time"=>$intime,
			  				"out_time"=>$outtime,
			  				"late_time"=>$latetime
			  		);
			  		$this->db->where("school_code",$this->session->userdata("school_code"));
			  		$this->db->where("emp_id",$teacherID);
			  		$this->db->where("a_date",$date);
			  		$req = $this->db->get("teacher_attendance");
			  		
			  		if($req->num_rows() > 0):
			  		    $this->db->set('reason',$reason);
			  			$this->db->where("school_code",$this->session->userdata("school_code"));
			  			$this->db->where("a_date",$date);
			  			$this->db->where("emp_id",$teacherID);
			  			$query = $this->db->update("teacher_attendance",$data);
			  			if ($this->db->affected_rows() == '1'):
			  			  $response = array(
			  			      "success" => true,
			  			      "message" => "Recorde Updated."
			  			  );
			  			else:
			  			    $response = array(
			  			      "success" => false,
			  			      "message" => "NOT UPDATE"
			  			  ); 
			  			endif;
			  			
			  		else:
			  			$this->teacherModel->addEmpAttendance($data);
			  			$response = array(
    		  			      "success" => true,
    		  			      "message" => "New record inserted."
    		  			  );
			  		endif;
			  		
			  		echo json_encode($response);
			  	    
			  	endif;
			 
			  }

			    function studentAtten()
			  {
			  	$school_code = $this->session->userdata("school_code");
			  	$school_info = mysqli_query($this->db->conn_id,"select * from school WHERE id='$school_code'");
			  	$info = mysqli_fetch_object($school_info);
			  	//print_r($info);
			  	$this->load->helper("sms");
			  	$i = $this->input->post("rows");
			  	$this->load->model("teacherModel");
			  	$this->load->model("smsmodel");
			  	$this->load->model("attendancemodel");
				$school_attendance=array(
			  			//"section" => $this->input->post("section"),
			  			"class_id" => $this->input->post("section"),
			  			
			  			"date" => $this->input->post("date1"),
			  			"teacher_id" => $this->input->post("teacherid"),
			  			"school_code"=>$this->session->userdata("school_code"),
			  			"shift_1"=>1
			  			
			  	);
			  	$date=$this->input->post('date1');
			 for($j=1; $j<$i; $j++){
					
			  		if($this->input->post("gender$j")!='P'){ 
			  			if($this->input->post("gender$j")==0){
			  			
			  		$data = array(
			  				//"section" => $this->input->post("section"),
			  				"class_id" => $this->input->post("section"),
			  				//"teacher_id" => $this->input->post("teacherid"),
			  				//"scholer_number" => $this->input->post("schno$j"),
			  				"stu_id" => $this->input->post("stuID$j"),
			  				"attendance" => $this->input->post("gender$j"),
			  				"a_date" => $this->input->post("date1"),
			  				"school_code"=>$this->session->userdata("school_code"),
			  				"shift_1"=>1
			  		);
			  		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
			  		$sende_Detail =$sender;
			  		$isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
			  		$absent=$this->input->post("gender$j");
			  		$stu_id = $this->input->post("stuID$j");
			  		$this->db->where("school_code",$this->session->userdata("school_code"));
			  		$this->db->where("student_id",$stu_id);
					$var=$this->db->get("guardian_info")->row();
					$fname=$var->father_full_name;
					$fmobile=$var->f_mobile;
					$this->db->where("school_code",$this->session->userdata("school_code"));
					//$class_id = mysqli_query($this->db->conn_id,"select * from class_info WHERE school_code='$this->session->userdata('school_code')");
					$class_id = $this->db->get("class_info");
					$this->db->where("status",1);
					$this->db->where("id",$stu_id);
					$stu=$this->db->get("student_info")->row();
					//print_r($stu);
					$sname=$stu->name;
					
					$this->teacherModel->addstuAttendance($data);
					if($isSMS->stu_attendance==1)
			  		{	
			  			// if($absent==1)
			  			// {
			  					
			  			//  $sende_Detail1=$sende_Detail->row();
			  			// 	$msg="Dear parent your Child ".$sname." is present today ".date("d-M-Y H:i:s")." . Thanks ".$info->school_name;
			  			// 	sms($fmobile,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
			  			// 	//echo $sende_Detail1->sender_id."-".$sende_Detail1->password;
			  			// }
			  			if($absent==0)
			  			{
			                $sende_Detail1=$sende_Detail->row();
			  				$msg="Dear parent your Child ".$sname." is Absent on ".date("d-M-Y H:i:s").".Please make sure & let us know. Thanks ".$info->school_name;
			  				sms($fmobile,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
			  				
			  			}
						
			  		}
			  		
			  	}	
			  	} }
			  	$this->attendancemodel->insertSchoolAttendance($school_attendance);
			  	redirect("index.php/login/studentAttendance1/Attendance Done");
			  }
			  
			  
			  function studentAtten2()
			  {

			  	$school_code = $this->session->userdata("school_code");
			  	$school_info = mysqli_query($this->db->conn_id,"select * from school WHERE id='$school_code'");
			  	$info = mysqli_fetch_object($school_info);
			  	
			  $school_code = $this->session->userdata("school_code");
			  		$this->load->helper("sms");
			  	$i = $this->input->post("rows");
			  	$this->load->model("teacherModel");
			  	$this->load->model("smsmodel");
			  	$this->load->model("attendancemodel");
			  
			 $school_attendance=array(
                          //"section" => $this->input->post("section"),
                          "class_id" => $this->input->post("section"),
                          
                          "date" => $this->input->post("date1"),
                          "teacher_id" => $this->input->post("teacherid"),
                          "school_code"=>$this->session->userdata("school_code"),
                          "shift_2"=>1
                          
                  );
			  //	$this->teacherModel->updateSchoolAttendance($school_attendance,$date1,$class1);
			  	for($j=1; $j<$i; $j++){
			  		if($this->input->post("gender$j")!='P'){
			  			if($this->input->post("gender$j")==0){
			  		
			 $data = array(
                             
                              "class_id" => $this->input->post("section"),
                              "stu_id" => $this->input->post("stuID$j"),
                              "attendance" => $this->input->post("gender$j"),
                              "a_date" => $this->input->post("date1"),
                              "school_code"=>$this->session->userdata("school_code"),
                              "shift_2"=>1
                      );
			  		
			  	//	$this->teacherModel->addstuAttendancea2($data,$a_date,$stu_id);
			  		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
			  		$sende_Detail =$sender;
			  		$isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
			  		$absent=$this->input->post("gender$j");
			  		$stu_id = $this->input->post("stuID$j");
			  		$this->db->where("school_code",$this->session->userdata("school_code"));
			  		$this->db->where("student_id",$stu_id);
					$var=$this->db->get("guardian_info")->row();
					$fname=$var->father_full_name;
					$fmobile=$var->f_mobile;
					$this->db->where("school_code",$this->session->userdata("school_code"));
					$class_id = $this->db->get("class_info");
					$this->db->where("status",1);
					$this->db->where("id",$stu_id);
					$stu=$this->db->get("student_info")->row();
					$sname=$stu->name;
					$this->teacherModel->addstuAttendancea2($data);
					
			  if($isSMS->stu_attendance==1)
			  		{	
			  			// if($absent==1)
			  			// {
			  					
			  			//  $sende_Detail1=$sende_Detail->row();
			  			// 	$msg="Dear parent your Child ".$sname." is present today after lunch time ".date("d-M-Y H:i:s")." . Thanks ".$info->school_name;
			  			// 	sms($fmobile,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
			  			// 	//echo $sende_Detail1->sender_id."-".$sende_Detail1->password;
			  			// }
			  			if($absent==0)
			  			{
			                $sende_Detail1=$sende_Detail->row();
			  				$msg="Dear parent your Child ".$sname." is Absent on after lunch time".date("d-M-Y H:i:s")." without any information.Please make sure & let us know. Thanks ".$info->school_name;
			  				sms($fmobile,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
			  				
			  			}
						
			  		}
			  		
			  		
			  	}}}
			  	$this->attendancemodel->insertSchoolAttendance($school_attendance);
			  	redirect("index.php/login/studentAttendance2/Attendance Done");
			  }
			  
			
			 
				
				function teacherReport(){
					$school_code = $this->session->userdata("school_code");
					$edate = $this->input->post("edate");
					$sdate = $this->input->post("sdate");
					
					$this->load->model("singleStudentModel");
					$this->load->model("teacherModel");
					$this->load->model("searchStudentModel");
					 
					$var = $this->teacherModel->getteacherattenReport($edate,$sdate);
				
					if($var->num_rows() > 0){
						$sr = 1;
						TeacherController::$sno = $sr;?>
						
							<div class="row">
			<div class="col-md-12 space20">
				<div class="btn-group pull-right">
					<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
						Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu dropdown-light pull-right">
						<li>
							<a href="#" class="export-excel" data-table="#sample-table-2" >
								Export to Excel
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
								  			<table class="table table-striped table-hover" id="sample-table-2">
												<thead>
													<tr class="success">
														<th>S.no.</th>
														<th>Employee Id</th>
														<th>Employee Name</th>
														<th>Present</th>
														<th>Absent</th>
														<!--<th>Leave</th>-->
													
													</tr>
												</thead>
												<tbody>
													<?php $i=1;
								  			 foreach ($var->result() as $row){

								  				?><?php if($i%2==0){$rowcss="danger";}else{$rowcss ="warning";}?><tr class="<?php echo $rowcss;?>">			  		
								  					<td><?php echo TeacherController::$sno;?></td>
								  					<td><?php $stuID = $row->emp_id;
								  						$this->db->where("school_code",$school_code);
								  					$this->db->where("id",$stuID);
								  					$a=$this->db->get("employee_info");
								  					if($a->num_rows()>0){
                                                                           if($a){ echo ($a->row()->username);
                                                                       }} else { echo " not define";}
								  					
								  					?></td>
								  					<?php $empname=$this->singleStudentModel->getteacherName($stuID)->row();?>
								  					<td>
								  					  
				  										<?php
				  											if($a->num_rows()>0){
                                                                           if($a){ echo strtoupper($a->row()->name);
                                                                       }} else { echo " not define";}
								  					?>
								  					    
								  					    <!--<?php// echo $empname->name;?>-->
								  					</td>
								  					
								  				<td>
                                                          <?php
                                                              $absent = $this->teacherModel->countAttTeacher($edate,$sdate,$stuID);
                                                              echo $absent['p'];
                                                          ?>
                                                      </td>
                                                      <td><?php $resultA = $this->db->query("SELECT a_date FROM teacher_attendance WHERE attendance = '0' AND school_code='$school_code' AND emp_id='$stuID' AND a_date >= '$sdate' and a_date <='$edate'");
                                  echo "Total Absent =".$absent['a']."<br>";
                                  if($absent['a']>0){?><div class="alert alert-info"><?php foreach($resultA->result() as $row):
                                          echo "Date [".date("d-m-Y",strtotime($row->a_date))."]"."<br>";
                                          endforeach;?></div><?php }?></td>
									  			</tr>
									  			<?php 
								  			TeacherController::$sno++;	$i++;
								  			}?>
												</tbody>
											</table>
										  <?php } 

										   else{ ?>
										   	     <tr>
										   	     	<td>
                                                   <div class="alert alert-danger col-md-12">
			                          <?php echo "<h4>No Record Found!Please Take Attendance First</h4>";?>
			                               </div>
			                           </td>
			                       </tr>
								  							
										   	<?php }?>
											<script>
                     TableExport.init();
                      </script>
								  			<?php 
								  		}		
				function attenMsg(){
					$date1 = $this->input->post("radate");
					$this->db->where("school_code",$this->session->userdata("school_code"));
					$this->db->where("a_date",$date1);
					$req = $this->db->get("teacher_attendance");
					if($req->num_rows() > 0)
					{
						?><div class="alert alert-danger">
							<?php echo "Teacher Attendance is Done for Date ".$date1;?></div><?php 
																
															}
				}	
				

}
