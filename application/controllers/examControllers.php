<?php
class examControllers extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("examModel");
		$school_code = $this->session->userdata("school_code");
	}
	public function getData1()
	{
		$data=array(
		    'fsd'=>$this->session->userdata("fsd"),
    	    'term'=>$this->input->post("term"),
    		'exam_name'=>$this->input->post("examName"),
    		'exam_date'=>$this->input->post("datet"),
    		'school_code'=>$this->session->userdata("school_code")

    		  );
		 $this->load->model("examModel");
		$var=$this->examModel->insertexam($data);
		if($var)
		{
			redirect("index.php/login/examsheduling");
		}	
	}
	
	public function demoExam()
	{
	 $school_code = $this->session->userdata("school_code");
	 $stu=$this->input->post("stu_id"); 
	 $this->db->where("username",$stu);
	 $studentDetails = $this->db->get("student_info");
	 if($studentDetails->num_rows()>0){
	     
	    
		
		
        $class_id=$this->input->post("class_id");
     $subjectid=$this->input->post("subjectid");
     $fsd=$this->input->post("fsd");
     $exam_id=$this->input->post("exam_id");
        $data['school_code']=$school_code;
        $data['stu']=$stu;
        $data['class_id']= $class_id;
        $data['exam_id']=$exam_id;
        $data['pageTitle'] = 'Exam / Student';
		$data['smallTitle'] = 'Exam Details ';
		$data['mainPage'] = 'Exam Details';
		$data['subPage'] = 'Exam Students';
		$data['title'] = 'Exam/Student';
		$data['headerCss'] = 'headerCss/studentListCss';
		$data['footerJs'] = 'footerJs/simpleStudentListJs';
		$data['mainContent'] = 'demoformatexam';
		$this->load->view("includes/mainContent", $data);
	  
	 }else{
	     echo "Wrong Username" ;
	 }
                	
	} 
	
	function demoExamSubjective(){
	    $school_code = $this->session->userdata("school_code");
	    if($this->uri->segment(3)){
	        $stu=$this->uri->segment(3); 
	         $this->db->where("id",$stu);
	 $studentDetails = $this->db->get("student_info");
	    }else{
	        $stu=$this->input->post("stu_id"); 
	         $this->db->where("username",$stu);
	 $studentDetails = $this->db->get("student_info");
	    }
	 //$stu=$this->input->post("stu_id"); 
	
	 if($studentDetails->num_rows()>0){
	      if($this->uri->segment(4)){
	          $exam_mode_id=$this->uri->segment(4);
	      }else{
	          $exam_mode_id=$this->input->post("exam_mode_id");
	      }
        $data['studentD']=$studentDetails->row();
        $data['school_code']=$school_code;
        $data['stu']=$stu;
        $data['exam_mode_id']= $exam_mode_id;
        $data['pageTitle'] = 'Exam / Student';
		$data['smallTitle'] = 'Exam Details ';
		$data['mainPage'] = 'Exam Details';
		$data['subPage'] = 'Exam Students';
		$data['title'] = 'Exam/Student';
		$data['headerCss'] = 'headerCss/studentListCss';
		$data['footerJs'] = 'footerJs/simpleStudentListJs';
		$data['mainContent'] = 'demoformatexamSubjective';
		$this->load->view("includes/mainContent", $data);
	}else{
	   echo "Wrong Username" ;
	}
	
	}
	
	public function onlineExamStatus(){
	    $exam_model_name_id=$this->uri->segment(5);
	     if($exam_model_name_id==2){
	    $subject_id =$this->uri->segment(3);
	    $exam_mode_id    =$this->uri->segment(4);
	    $exam_model_name_id=$this->uri->segment(5);
	    $status = $this->uri->segment(6);
	     $attn = $this->db->query("Select distinct student_id from subjective_answer_report where exam_mode_id='$exam_mode_id' and status=0");
	     }
	    else{
	         if($exam_model_name_id==3){
	              $subject_id =$this->uri->segment(3);
            	    $exam_id    =$this->uri->segment(4);
            	    $exam_moden_id=$this->uri->segment(5);
            	    $status = $this->uri->segment(6);
            	    $exam_mode_id=$this->uri->segment(7);
	                $attn = $this->db->query("Select distinct student_id from objective_exam_result where exam_mode_id='$exam_mode_id' and status=1");
	         }else{
	             echo "Please Select Other Options.";
	         }
	    }
	    $data['exam_mode_id']=$exam_mode_id;
	    $data['var']        =$attn;
	    $data['pageTitle'] = 'Student Exam';
		$data['smallTitle'] = 'Exam Details';
		$data['mainPage'] = 'Exam Details';
		$data['subPage'] = 'Exam Students';
		$data['title'] = 'Exam/Student';
		$data['headerCss'] = 'headerCss/studentListCss';
		$data['footerJs'] = 'footerJs/simpleStudentListJs';
		$data['mainContent'] = 'resultOnlineStatus';
		$this->load->view("includes/mainContent", $data); 
	    
	}
	public function exammode(){
		
		$data=array(
			'exam_id'=>$this->input->post("examName2"),
    		'class_id'=>$this->input->post("className2"),
			'section'=>$this->input->post("sectionName"),
			'language' =>$this->input->post("language"),
			'subject' =>$this->input->post('subject'),
			'exam_mode' =>$this->input->post("exam_mode"),
    		
    		  );
			 // print_r($data);
		 $this->load->model("examModel");
		$var=$this->examModel->exam_mode($data);
		if($var)
		{
			redirect("index.php/login/exammode");
		}	
	}
	
	public function deleteexambyotp()
	{
               $otp=$this->input->post('otp');
              $mobile=$this->input->post('mobile');
             $this->db->where('school_code',$this->session->userdata('school_code'));
             $this->db->where('mobile_number',$mobile);
             $this->db->where('exam_otp',$otp);
             $row=$this->db->get('common_otp');
             if($row->num_rows()>0)
             {   
             foreach ($row->result() as  $value) 
             {
             	
             if($value->exam_otp==$otp)
              {
                    ?><br><br>
                     <div class="alert alert-success">
                                <button data-dismiss="alert" class="close">
                                    &times;
                                </button>
                                <?php 
                                       echo "Match Otp!Click On Delete Button to Delete the Exam ";?>
                                </div>
                <script>
                  $("#conform").show();
                 </script><?php
                     return true;
                 }
             }
         }
                 else
                 {   ?>
                            <div class="alert alert-danger">
                        
                                <button data-dismiss="alert" class="close">
                                    &times;
                                </button><?php 
                           echo "OTP NOT MATCH";?>
                            </div>
             <script>
                  $("#conform").hide();
                   $("#admin").show();
                  $("#student_id").show();
             </script><?php
             return false;
            }
   
     }
     
	/* function maximarks()
   {$data = array(
			     	"sub_type" => $this->input->post("subtype"),
					"exam_id" => $this->input->post("examid"),
					
					"class_id" => $this->input->post("classid"),
					"subject_id" => $this->input->post("subjectid"),
					"marks_grade" => $this->input->post("marks_grade"),
					"max_m" => $this->input->post("mark"),
					
		        	);
		    $insert=$this->db->insert("exam_max_subject",$data);
             echo "Updated Your Marks";
	}*/
	function maximarks()
   { 
   $school_code = $this->session->userdata("school_code");
    $row2=$this->db->get('db_name')->row()->name;
if($school_code == 9 && $row2 == "A" || $school_code == 6 && $row2 == "A"){ 
					$data = array(
					"exam_id" => $this->input->post("examid"),
					"class_id" => $this->input->post("classid"),
					"subject_id" => $this->input->post("subjectid"),
					"marks_grade" => $this->input->post("marks_grade"),
					"max_m" => $this->input->post("mark"));
					$insert=$this->db->insert("exam_max_subject",$data);
					echo "Updated Your Marks";
					}else{
						$data = array(
			     	"sub_type" => $this->input->post("subtype"),
					"exam_id" => $this->input->post("examid"),
					"class_id" => $this->input->post("classid"),
					"subject_id" => $this->input->post("subjectid"),
					"marks_grade" => $this->input->post("marks_grade"),
					"max_m" => $this->input->post("mark")
				);
			
				$insert=$this->db->insert("exam_max_subject",$data);
				echo "Updated Your Marks";
					}
			
		   
	}


   public  function Suceesotpdeleteexamby()

          {
               $examid=$this->input->post('exam_id');
               $this->db->where('id',$examid);
               $this->db->where('school_code',$this->session->userdata('school_code'));
               $delexamname=$this->db->delete('exam_name');
               
                $this->db->where('exam_id',$examid);
                 $deleteexamday=$this->db->delete('exam_day');
              
                $this->db->where('exam_id',$examid);
                $deleteexamshift=$this->db->delete('exam_shift');

              
                 $this->db->where('exam_id',$examid);
                   $deleteexamtimetable=$this->db->delete('exam_time_table');
                
                 
                 $this->db->where('exam_id',$examid);
                   $deleteexammaxsubject=$this->db->delete('exam_max_subject');
                      
                   $this->db->where('exam_id',$examid);
                   $deleteexaminfo=$this->db->delete('exam_info');
                if($delexamname|| $deleteexamday|| $deleteexamshift|| $deleteexamtimetable||$deleteexammaxsubject||$deleteexaminfo)
                {
                	 ?><br><br>
                     <div class="alert alert-success">
                                <button data-dismiss="alert" class="close">
                                    &times;
                                </button>
                                <?php 
                                       echo "Your Exam Detail Successfully Deleted";?>
                              <a href="<?php echo base_url();?>index.php/login/examsheduling" class="btn btn-red">
                                       <i class="fa fa-arrow-circle-right"></i>Go For Exam Scheduling </a>
                                </div>
                      <?php
                    

                }
                else
                {
                 ?>
                            <div class="alert alert-danger">
                        
                                <button data-dismiss="alert" class="close">
                                    &times;
                                </button><?php 
                                       echo "Somthing Wrong!please try after some time";?>
                        
                            </div><?php 

                }                  
             
             
    }
	public function updateData1()
	{
	    $upexam=$this->input->post("upexam");
	  $examName=$this->input->post("examName");
	  $date=$this->input->post("datet");
	  $exam_mode=$this->input->post('exam_mode');

	   $this->load->model("examModel");
		$var=$this->examModel->updateexam($examName,$date,$upexam,$exam_mode);
	if($var)
		{
			redirect("index.php/login/examsheduling");
		}	
	}
	
	 function printDate()
	{
		$this->load->model("examModel");
		
		$en = $this->input->post("examName");
		$var=$this->examModel->gateDate1($en);
	
			echo $var->row()->exam_date;
		
	} 
	
 function printMode(){
	 $this->load->model("examModel");
		$en = $this->input->post("examName");
		$var=$this->examModel->gateDate1($en);
	
	
			$em = $var->row()->exam_mode;
			?>
				<option value=1 <?php if($em==1){echo 'selected="selected"';}?>>OFFLINE </option>
				<option value=2 <?php if($em==1){echo 'selected="selected"';}?>>ONLINE (SUBJECTIVE)</option>
				<option value=3 <?php if($em==1){echo 'selected="selected"';}?>>ONLINE (OBJECTIVE)</option>
			<?php 
 }
	
	function startScheduling()
	{ 	
		$exam_name = $this->input->post("examName");
		$edate = $this->input->post("edate");
		//$exam_mode=$this->input->post('exam_mode');
	 	$this->load->model("examModel");
		$data['exam_name'] = $exam_name;
	//print_r($data);exit();
		$data['edate'] = $edate;
		$data['pageTitle'] = 'Exam Scheduling';
		$data['smallTitle'] = 'Exam Scheduling';
		$data['mainPage'] = 'Exam Scheduling';
		$data['subPage'] = 'Exam Scheduling';
		//$this->load->model("examModel");
		$fsd=$this->session->userdata("fsd");
		$var=$this->examModel->getExamName($fsd);
		//print_r($var->result());
		$data['request']=$var->result();
		$count = $this->db->count_all("exam_name");
		
		$data['i']=$count;
		
		$data['title'] = 'Configure Class/Section';
		$data['headerCss'] = 'headerCss/examCss';
		$data['footerJs'] = 'footerJs/examJs';
		$data['mainContent'] = 'startScheduling';
		$this->load->view("includes/mainContent", $data);
		
	}
             
	
function defineExam(){
	 	$num=$this->input->post("nos");
		$j = 1;
		$k = 1;
		?><div class="row">
		<?php
				$i = 1;
		?>  	<table class="table" style="width:700px;">
		                                    <tr>
		                                    	<th>#</th>
		                                        <th>Name Of Shifts (Like First,Second)</th>
		                                        <th>Time Slots</th>
		                                    </tr>
		                                <input type="hidden" name="num" value="<?php echo $num; ?>" />
		                                <?php while($num >= $i){ ?>
		                                <?php if($i%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
	                               <tr class="<?php echo $rowcss;?>">
		                                    	<td><?php echo $i; ?></td>
		                                    	<td>
		                                        	<input type="text" class="form-control" required="required" value="<?php if($i==1){echo 'FIRST'; }elseif($i==2){echo 'SECOND';}elseif($i==3){echo 'THIRD';} ?>" style="width:200px;" name="shift<?php echo $i; ?>" />
		                                        </td>
		                                        <td>
		                                        	<table>
		                                            	<tr>
		                                                	<td>
		                                                	<div class="input-group input-append bootstrap-timepicker">
		                                                    		<input type="time" class="form-control time-picker"  style="width:100px;" name="from<?php echo $i; ?>" id="from<?php echo $i; ?>"/>
																	<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
		                                                	
		                                        	
		                                            		</td>
		                                                    <td>
		                                            	 &nbsp;&nbsp;to&nbsp;&nbsp; 
		                                                 	</td>
		                                                    <td>
		                                                    	<div class="input-group input-append bootstrap-timepicker">
		                                                    	<input type="time" class="form-control time-picker" style="width:100px;" name="to<?php echo $i; ?>" id="to<?php echo $i; ?>">
																	<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
																</div>
		                                            
		                                            		</td>
		                                                 </tr>
		                                             </table>
		                                        </td>
		                                    </tr>
		                                <?php $i++; } ?>
		                            	</table>
		                            </div>
	<?php }
	
function defineExam1(){
	$num1=$this->input->post("nod");
	$j = 1;
	$k = 1;
	$i = 1;
	?> <div class="row">
	                            <table class="table" style="width:700px;">
	                                  <?php if($i%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
	                               <tr class="<?php echo $rowcss;?>">
	                                    	<th>#</th>
	                                        <th>Select Date</th>
	                                        <th>Name Of Day</th>
	                                    </tr>
	                                <input type="hidden" name="num1" value="<?php echo $num1; ?>" />
	                                <?php while($num1 >= $i){ ?>
	                                 <?php if($i%2==0){$rowcss="warning";}else{$rowcss =" danger";}?>
	                                  <tr class="<?php echo $rowcss;?>">
	                                    	<td><?php echo $i; ?>
	                                    	</td>
	                                    	<td>
												<input  type="date" data-date-format="yyyy-mm-dd"style="width:200px;" id="date<?php echo $i; ?>" name="date<?php echo $i; ?>" class="form-control date-picker"/>
										 	</td>
	                                         <td>
	                                        	<input type="text" class="form-control text-uppercase" style="width:200px;" id="day<?php echo $i; ?>" name="day<?php echo $i;?>" />
	                                        </td>
	                                    </tr>
	                                <?php $i++; } ?>
	                                	<tr>
	                                    	<td colspan="3"> <button class="btn btn-green">
                                                            Save <i class="fa fa-arrow-circle-right"></i>
                                                        </button></td>
	                                    </tr>
	                            	</table>
									<?php if(isset($_GET['i'])){
										if($_GET['i'] == 'true'){
											echo "<font color='#009900'>Data Saved Succefully.</font>";
										}
									}									
									?></div>
	<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.1.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/autosize/jquery.autosize.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/jquery-maskmoney/jquery.maskMoney.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/js/commits.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/jQuery-Tags-Input/jquery.tagsinput.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/ckeditor/adapters/jquery.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/form-elements.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CORE JAVASCRIPTS  -->
		<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
		<!-- end: CORE JAVASCRIPTS  -->
		<script>
			jQuery(document).ready(function() {
				<?php while($num1 >= $j){ ?>
					$('input#date<?php echo $j; ?>').change(
							function(){
								var d = $('#date<?php echo $j; ?>').val();
								var dArray = d.split("-");
								myDate=new Date(dArray[0],dArray[1]-1,dArray[2]);  
								var dayCode = myDate.getDay(); // dayCode 0-6
								var weekday = new Array(7);
								weekday[0]=  "Sunday";
								weekday[1] = "Monday";
								weekday[2] = "Tuesday";
								weekday[3] = "Wednesday";
								weekday[4] = "Thursday";
								weekday[5] = "Friday";
								weekday[6] = "Saturday";
								var a = weekday[dayCode];
								$('#day<?php echo $j; ?>').val(a);
							});
				
						

				<?php  $j++; } ?>
				});	
				</script>
			 
				
	<?php }

	
	function createExam()
	{
		$this->load->model("examModel");
		$exam_name=	$this->input->post("exam_name");
		$edate=$this->input->post("edate");
		$nos = 	$this->input->post("nos");
		$nod =	$this->input->post("nod");
		
		for($i=1;$i<$nos+1;$i++)
		{
		$data=array(
				'exam_id'=>$exam_name,
				'shift'=>$this->input->post("shift$i"),
				
				
				'to1'=>	$this->input->post("to$i"),
						'from1'=> $this->input->post("from$i")
						);
						$this->examModel->ensertshift($data);
		}
			
		for($i=1;$i<$nod+1;$i++)
		{
		$data1 = array(
		'exam_id'=>$exam_name,
				
		
		'date1'=>	$this->input->post("date$i")
		
		);
		$this->examModel->ensertdays1($data1);
		}
		redirect("index.php/login/createSchedule/$exam_name");
	}
	
	
	
	function fullExam(){
	$examid = $this->input->post("exam_id");
	//$edate = $this->input->post("edate");
	$edayid = $this->input->post("edayid");
	$classid= $this->input->post("classid");
	//$day1 = $this->input->post("day1");
	$shiftid=$this->input->post("shiftid");
	$subjectid=$this->input->post("subjectid");
	$school_code = $this->session->userdata("school_code");
	$this->load->model("examModel");
			$data = array(
				'exam_id' => $examid,
				'class_id'=>$classid ,
				'exam_day_id' =>$edayid ,
				'subject_id' =>$subjectid, 
				'shift_id' =>$shiftid,
				'school_code'=>$this->session->userdata("school_code")
			);
			
			$sub = $this->db->query("SELECT  * FROM exam_time_table WHERE  exam_id ='$examid' AND school_code='$school_code' AND shift_id = '$shiftid' AND exam_day_id = '$edayid'  AND class_id = '$classid'");
			
			if($sub->num_rows()>0)
			{
				$row1 = $sub->row();
				//$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where('id',$row1->id);
			$this->db->update('exam_time_table',$data); 
			}
			else {
				$this->examModel->insertExamData($data);
			}
		
			echo "Inserted";
	
	
}

   function examdonedeleteExam()
		{
	    $school_code =$this->session->userdata("school_code");
		$data['examid'] = $this->uri->segment(3);	
		$data['pageTitle'] = 'Exam Delete';
		$data['smallTitle'] = 'Exam';
		$data['mainPage'] = 'Exam';
		$data['subPage'] = 'Exam Delete';
		$data['title'] = 'Exam Delete';
	    $data['headerCss'] = 'headerCss/newAdmissionCss';
		$data['footerJs'] = 'footerJs/deleteexamjs';
		$data['mainContent'] = 'deleteexam';
		$this->load->view("includes/mainContent", $data);
		  
		}
	
	function updateSub(){
		$id = $this->input->post("id");
		$sub = $this->input->post("sub");
		$data = array(
			'subject' => $sub
		);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("id",$id);
		$this->db->update("exam_time_table",$data);
		echo "Edited";
	}

  
			

	function deleteExam(){
		$id = $this->input->post("id");
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("id",$id);
		$delete=$this->db->delete("exam_name");
		 echo "deleted";
	       ?>
	      
	       <?php
	}

	
		
	
	function enterMarks()
	{ 	
	    $this->load->model("allformmodel");
	    $studentId = $this->allformmodel->getfsdwiseStudentClassData($this->input->post("fsd"),$this->input->post("classid"));
	    $data['fsd'] =$this->input->post("fsd");
	    $data['school_code'] =$this->session->userdata("school_code");
		$data['sub_type'] =$this->input->post("sub_type");
		$data['t_id'] = $this->input->post("teacherid");
		$data['classid'] = $this->input->post("classid");
		$data['sectionid'] = $this->input->post("sectionid");
		$data['subjectid'] = $this->input->post("subjectid");
		$data['examid'] = $this->input->post("examid");
		$data['studentId']=$studentId;
	
   $this->load->view("print_obtain",$data);		
	}
	function print_obtain()
	{ 	 
	    $this->load->model("allformmodel");
/*	echo $this->uri->segment("3");
	echo $this->uri->segment("5");
	exit();*/
	    $data['studentList'] = $this->allformmodel->getfsdwiseStudentClassData($this->uri->segment("3"),$this->uri->segment("5"));
	$this->load->view("ajax/examMarksDetail",$data);		
	}

	function maxmumsubMarks()
	{ 
		 $classid = $this->input->post("classid");
		 $subjectid =$this->input->post("subjectid");
		 $examid =$this->input->post("examid");
		
		$data['subtypeid'] = $this->input->post("subtypeid");
		$data['classid'] = $this->input->post("classid");
		$data['sectionid'] = $this->input->post("sectionid");
		$data['subjectid'] = $this->input->post("subjectid");
		$data['examid'] = $this->input->post("examid");

	  $this->load->view("ajax/maximmmarks",$data);		
	}
	
	
	function editMarks()
	{
	    $school_code =$this->session->userdata("school_code");
		$data['sectionid'] = $this->input->post("sectionid");
		$data['subjectid'] = $this->input->post("subjectid");
		$data['examid'] = $this->input->post("examid");
		$data['out_of'] = $this->input->post("mm");
		$result = $this->db->query("select * from student_info where class_id='$classid'  and status =1 ORDER BY id");
		$data['class_info'] = $result;
		$data['num_row1'] = $result->num_rows();
		$this->load->view("ajax/editExamMarks",$data);
	}
	

	function resultMarks()
	{	
	    $school_code =$this->session->userdata("school_code");
	   $fsd =$this->input->post("fsd");
		$classid = $this->input->post("classid");
		$sectionid = $this->input->post("sectionid");
		$examid = $this->input->post("examid");
		$subjectid = $this->input->post("subjectid");
		$data3=array(
				'exam_id' =>$examid,
				'subject_id' =>$subjectid,
				'class_id' =>$classid,
				'school_code'=>$school_code,
				'fsd'=>$fsd
		);
		$data['classid'] = $this->input->post("classid");
		$data['sectionid'] = $this->input->post("sectionid");
		$data['subjectid'] = $this->input->post("subjectid");
		$data['examid'] = $this->input->post("examid");
		$data['fsd'] = $this->input->post("fsd");
		$data['school_code'] = $school_code;
	
	
		$this->load->model("examModel");
		$result=$this->examModel->getExamMarks($data3);
		$data['dum'] = $result->result();
		$this->load->view("ajax/examResult",$data);
	}
	public function checkIDforadmin(){
			 
			   $mobile = $this->input->post("admin_id");
			    $examid = $this->input->post("exam_id");
			    $this->load->helper('string');
			    $this->load->model("smsmodel");
			   $this->db->where('id',$this->session->userdata('school_code'));
		       $this->db->where('mobile_no',$mobile);
		       $school_name=$this->db->get('school');                 
			  if($school_name->num_rows()>0){
				$mobilenumber=$school_name->row();
				
				?>
							<div class="alert alert-success">
								<button data-dismiss="alert" class="close">
									&times;
								</button>
							ADMIN FOUND ! <strong><?php echo $mobilenumber->school_name."". " !OTP SEND ON YOUR MOBILE NUMBER"; ?></strong>
							 <?php	$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
				           if($sender->num_rows()>0){
					       $sende_Detail =$sender->row();
					       $otp = rand(1000,99999);
					       $max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		$master_id=$max_id->maxid+1;
					        $msg="Your Exam Delete OTP is ".$otp." .please share this to delete exam.";
					        $getv=  mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$mobilenumber->mobile_no);
					        $this->smsmodel->sentmasterRecord($msg,1,$master_id,$getv);
							    $data2 = array(
	                             'exam_otp' => $otp,
	                             'exam_id' => $examid,
	                              'mobile_number'=>$mobilenumber->mobile_no,
	                              'date'=>date('Y-m-d H:i:s',time()),
	                              'school_code'=>$this->session->userdata('school_code'),
	                                );
	                             $insert = $this->db->insert('common_otp', $data2);
	                            ?>
							</div>
							<script>
						  <?php if($insert){?>
							$("#b1").show();
							$("#newpassword").show();
						    <?php }?>
							</script>
							<?php 
						}}
					else{
						?>
							<div class="alert alert-danger">
						
								<button data-dismiss="alert" class="close">
									&times;
								</button>
								Sorry :( <strong><?php echo "Admin Mobile Number Not Found ! Wrong Mobile Number"; ?></strong>
							</div>
							<script>
								$("#b1").hide();
								$("#newpassword").hide();
								</script>
						<?php
						
					}
				
			}
	
	function updateSingeMarks(){
	   $marks= $this->input->post("marks");
	   $rowid =  $this->input->post("rowid");
	   $data =array(
	       'marks'=> $marks
	       );
	       $this->db->where('id', $rowid);
	       $this->db->update("exam_info",$data);
	       echo "Updated";
	       ?>
	      
	       <?php
	}

	function updatesubmaxiMarks(){
    $school_code = $this->session->userdata("school_code");
    $row2=$this->db->get('db_name')->row()->name;

if($school_code == 9 && $row2 == "A" || $school_code == 6 && $row2 == "A"){
 $marks= $this->input->post("mark");
		 $rowid =  $this->input->post("viid");
		 $examid =  $this->input->post("examid");
		 $classid =  $this->input->post("classid");
		 $subjectid =  $this->input->post("subjectid");

	   $data =array(
	       'max_m'=> $marks,
	       );
	       $this->db->where('id', $rowid);
				$updt= $this->db->update("exam_max_subject",$data);
				if($updt){
					$examinfo =array(
						'out_of'=> $marks,
					);
					$this->db->where('exam_id', $examid);
					$this->db->where('class_id', $classid);
					$this->db->where('subject_id', $subjectid);
				$dt=	$this->db->update('exam_info',$examinfo);
				if($dt){
	       echo "Updated";
				} }


	}else{
		 $marks= $this->input->post("mark");
		 $subtype= $this->input->post("subtype");
		 $rowid =  $this->input->post("viid");
		 $examid =  $this->input->post("examid");
		 $classid =  $this->input->post("classid");
		 $subjectid =  $this->input->post("subjectid");

	   $data =array(
	       'max_m'=> $marks,
	       );
	       $this->db->where('id', $rowid);
				$updt= $this->db->update("exam_max_subject",$data);
				if($updt){
					$examinfo =array(
						'out_of'=> $marks,
					);
					$this->db->where('exam_id', $examid);
					$this->db->where('class_id', $classid);
					$this->db->where('sub_type', $subtype);
					$this->db->where('subject_id', $subjectid);
				$dt=	$this->db->update('exam_info',$examinfo);
				if($dt){
	       echo "Updated";
				} }
}
	}
	
	function deletesubmaxiMarks(){
		$school_code = $this->session->userdata("school_code");
    $row2=$this->db->get('db_name')->row()->name;

if($school_code == 9 && $row2 == "A" || $school_code == 6 && $row2 == "A"){
	$marks= $this->input->post("mark");
		$rowid =  $this->input->post("viid");
		$examid =  $this->input->post("examid");
		 $classid =  $this->input->post("classid");
		 $subjectid =  $this->input->post("subjectid");
		$data =array(
				'max_m'=> $marks,
				);
				$this->db->where('id', $rowid);
			$deletedt=	$this->db->delete("exam_max_subject");
			if($deletedt){
				$this->db->where('exam_id', $examid);
				$this->db->where('class_id', $classid);
				$this->db->where('subject_id', $subjectid);
			$dt=	$this->db->delete('exam_info');
			if($dt){
				echo "Deleted";
			}
			}
	
	
}else{
		$subtype= $this->input->post("subtype");
		$marks= $this->input->post("mark");
		$rowid =  $this->input->post("viid");
		$examid =  $this->input->post("examid");
		 $classid =  $this->input->post("classid");
		 $subjectid =  $this->input->post("subjectid");
		$data =array(
				'max_m'=> $marks,
				);
				// $this->db->where('id', $rowid);
				$this->db->where('sub_type', $subtype);
				$this->db->where('exam_id', $examid);
				$this->db->where('class_id', $classid);
				$this->db->where('subject_id', $subjectid);
			$deletedt=	$this->db->delete("exam_max_subject");
			if($deletedt){
				$this->db->where('sub_type', $subtype);
				$this->db->where('exam_id', $examid);
				$this->db->where('class_id', $classid);
				$this->db->where('subject_id', $subjectid);
			$dt=	$this->db->delete('exam_info');
			if($dt){
				echo "Deleted";
			}
}}
 }
 function deletesubMarks(){
      $vrow=$this->input->post('vrow'); 
		$this->db->where('id',$vrow);
	$dt=	$this->db->delete('exam_info');
	if($dt){
				echo "Deleted Successfully please refresh the page for updation";
			}else{
			    echo "Fail To Delete";
			}
		
 }
 
function insertMarksdetail()
	{
	    	$fsd=$this->input->post('fsd'); 
	    	$stuid=$this->input->post('stuid'); 
			$marks=$this->input->post('marks');
			$mmarks=$this->input->post('mmarks');
			$classid=$this->input->post('classid');
			$subjectid=$this->input->post('subjectid');
			$sub_type=$this->input->post('sub_type');
			$examid=$this->input->post('examid');
			$term=$this->input->post('term');
			$attendence=$this->input->post('attendence');
			
		$school_code = 	$this->session->userdata("school_code");
		$row2=			$this->db->get('db_name')->row()->name;
		if($school_code == 9 && $row2 == "A" || $school_code == 6 && $row2 == "A"){
			//for ramdoot start
				/*$stuid=$this->input->post('stuid'); 
				$marks=$this->input->post('marks');
				$mmarks=$this->input->post('mmarks');
				$classid=$this->input->post('classid');
				$subjectid=$this->input->post('subjectid');
				$examid=$this->input->post('examid');
				$term=$this->input->post('term');
				$attendence=$this->input->post('attendence');*/
				
				$this->db->where('school_code' ,$this->session->userdata('school_code'));
				$this->db->where('class_id',$classid);
				$this->db->where('fsd',$fsd);
				$this->db->where('subject_id',$subjectid);
				$this->db->where('stu_id',$stuid);
				$this->db->where('exam_id',$examid);
			$v=	$this->db->get('exam_info');
			if($v->num_rows()<1){
				$data=array(
					'term'=>$term,
					'class_id'=>$classid,
					'subject_id'=>$subjectid,
					'stu_id'=> $stuid,
					 'out_of'=>$mmarks,
					 'marks'=> $marks,
					 'exam_id'=>$examid,
					 'Attendance'=>$attendence,
					 'fsd'=>$fsd,
					 'school_code'=>$this->session->userdata('school_code'),
					 "created" => date('Y-m-d'),
					);
					$this->db->insert('exam_info',$data);
					 echo "inserted";
				  } else{
					  echo "marks already given";
				  }
			//for ramdoot end
		}else{
			
			$this->db->where('fsd',$fsd);
			$this->db->where('school_code' ,$this->session->userdata('school_code'));
			$this->db->where('class_id',$classid);
			$this->db->where('sub_type',$sub_type);
			$this->db->where('subject_id',$subjectid);
			$this->db->where('stu_id',$stuid);
			$this->db->where('exam_id',$examid);
	$v=	$this->db->get('exam_info');
	if($v->num_rows()<1){
	    $data=array(
			'term'=>$term,
			'class_id'=>$classid,
			'subject_id'=>$subjectid,
			'stu_id'=> $stuid,
			'out_of'=>$mmarks,
			'sub_type'=>$sub_type,
			'marks'=> $marks,
			'exam_id'=>$examid,
			'Attendance'=>$attendence,
		        'fsd'=>$fsd,
			'school_code'=>$this->session->userdata('school_code'),
			"created" => date('Y-m-d'),
			);
	        $this->db->insert('exam_info',$data);
	         echo "inserted";
		  } else{
			  echo "marks already given";
			} 
		}
	}
	function resultRender(){
		$school_code =$this->session->userdata("school_code");
		$data['examName'] = $this->input->post("examName");
		$data['student_id'] = $this->input->post("student_id");
		$data['fsd'] = $this->input->post("fsd");
	    
		$data['pageTitle'] = 'Result';
		$data['smallTitle'] = 'Result';
		$data['mainPage'] = 'Exam';
		$data['subPage'] = 'Result';
		
		$data['title'] = 'Result';
		$data['headerCss'] = 'headerCss/generateResultCss';
		$data['footerJs'] = 'footerJs/generateResultJs';
		$data['mainContent'] = 'resultGenerate';
		$this->load->view("includes/mainContent", $data);
	}
	function resultRender_classwise(){
	    $school_code =$this->session->userdata("school_code");
		$data['examName'] = $this->input->post("examName");
		$data['student_id'] = $this->input->post("student_id");
		$data['fsd'] = $this->input->post("fsd");
		
		$data['pageTitle'] = 'Result';
		$data['smallTitle'] = 'Result';
		$data['mainPage'] = 'Exam';
		$data['subPage'] = 'Result';
		
		$data['title'] = 'Result';
		$data['headerCss'] = 'headerCss/generateResultCss';
		$data['footerJs'] = 'footerJs/generateResultJs';
		$data['mainContent'] = 'resultGenerate_classwise';
		$this->load->view("includes/mainContent", $data);
	}
	function resultRenderStu(){
	    $school_code =$this->session->userdata("school_code");
	
		$data['student_id'] = $this->uri->segment(3);
		$data['fsd'] = $this->uri->segment(4);
	
		$data['pageTitle'] = 'Result';
		$data['smallTitle'] = 'Result';
		$data['mainPage'] = 'Exam';
		$data['subPage'] = 'Result';
	
		$data['title'] = 'Result';
		$data['headerCss'] = 'headerCss/generateResultCss';
		$data['footerJs'] = 'footerJs/generateResultJs';
		$data['mainContent'] = 'resultGenerate';
		$this->load->view("includes/mainContent", $data);
	}
		function printexamreport(){
		   $examid= $this->uri->segment(3);
	       $this->load->model("examModel");
	       $shiftid = $this->examModel->getshift1($examid);
	       $data['shiftid']=$shiftid;
	        $data['examid']=$examid;
		  $this->load->view("printexamreport",$data);
	}
	function printSub()
		{
		   	$examid=$this->input->post("examName");
	    	$data['examid']=$examid;
	
		$this->load->view("examtimetablereport", $data);
		    
		    
		    
		    
		    
		
	}
		public function getClass(){
		$sectionid = $this->input->post("sectionid");
		$this->load->model("exammodel");
		
		$var = $this->exammodel->getClass($sectionid);?>
	
			<?php if($var->num_rows() > 0){
				echo '<option value="">-Select Class-</option>';
				foreach ($var->result() as $row){
					echo '<option value="'.$row->id.'">'.$row->class_name.'</option>';
				} 
				
				
			}
	}
	
	public function getSubjectByClass(){
	    $classid = $this->input->post("classid");
		$this->load->model("exammodel");
		
		$var = $this->exammodel->getsubjectClass($classid);?>
	
			<?php if($var->num_rows() > 0){
				echo '<option value="">-Select Subject-</option>';
				foreach ($var->result() as $row){
					echo '<option value="'.$row->id.'">'.$row->subject.'</option>';
				} 
				
				
			}
	}
	
	public function select_exam()
	{
		$exam_id = $this->input->post('exam_n');
		$lang_id = $this->input->post('lang_n');
		$da = $this->exammodel->select_exam_data($exam_id,$lang_id);
		if($da->num_rows()>0)
		{
			foreach($da->result() as $dx)
			{ ?>
			<option value="">--Select Test--</option>
				<option value="<?= $dx->id;?>"><?= $dx->exam_name;?></option>
			<?php }
		}
		else
		{
			?>
			<option><b style="font-color:red;">Test Not Found</b></option>
		<?php
		}
	}
//*----------------------------------------------online exam -----------------------------------------------*//
///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////


	function create_ques(){
		 $uri= $this->uri->segment("3");
		 $school_code=$this->session->userdata("school_code");
		 $this->db->where('id',$uri);
		$ex=$this->db->get('exam_mode');
	    $data['exam_mode_id']=$uri;
		$data['exam']=$ex;
		$lang_id = $ex->row()->language;
		$select_exam = $ex->row()->exam_id;
		$select_subject = $ex->row()->subject;
		$data['language'] = $ex->row()->language;
		$this->load->model('exammodel');
		$data['dt_qt'] = $this->exammodel->question_data($uri);
		$data['select_exam'] = $select_exam;
		$data['select_subject'] = $select_subject;
		$data['pageTitle'] = 'Create Questions';
		$data['smallTitle'] = 'Create Questions';
		$data['mainPage'] = 'Create Questions';
		$data['subPage'] = 'Create Questions';
		$data['title'] = 'Create Questions';
		$data['headerCss'] = 'headerCss/examCss';
		$data['footerJs'] = 'footerJs/examJs';
		$data['mainContent'] = 'create_ques';
		$this->load->view("includes/mainContent", $data);
	}
		public function insert_question()
	{	

	$this->load->model('exammodel');
		 $ques = $this->input->post('ques');
		 $ans = $this->input->post('ans');
		 $a = $this->input->post('a');
		 $b = $this->input->post('b');
		 $c = $this->input->post('c');
		 $d = $this->input->post('d');
		 $e = $this->input->post('e');
		 $exam_subject_id = $this->input->post('exam_subject_id');
		
		 $exam_mode_id = $this->input->post('exam_mode_id');
		 $exam_master_id = $this->input->post('exam_master_id');
		 $wh_val = array(
			'question'=>$ques,
			'exam_mode_id'=>$exam_mode_id,
			);
			
				$da = $this->exammodel->insert_ques($ques,$wh_val,$ans,$a,$b,$c,$d,$e);
				if($da){
				echo "1";
				}else{
					echo "0";
				}
			
		
	}
	
	function delete_q()
	{
		//echo "hii";
		$this->load->model('exammodel');
		$q_id = $this->input->post('ques_id');
		
		$chk = $this->exammodel->delete_q($q_id);
		if($chk)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	function new_ques()
	{
		$this->load->model('exammodel');
		$sel_ct = $this->input->post("sel_ct");
		$exam_mode_id = $this->input->post('exam_mode_id');
	
	
		 if($sel_ct != 0)
		{
			$ques = $this->input->post("ques1");
			$op_txt1 = $this->input->post("txt_af1");
			$op_txt2 = $this->input->post("txt_af2");
			$op_txt3 = $this->input->post("txt_af3");
			$op_txt4 = $this->input->post("txt_af4");
			$op_txt5 = $this->input->post("txt_af5");
			$qf1 = $_FILES['qf1']['name'];
			$qf2 = $_FILES['qf2']['name'];
			$qf3 = $_FILES['qf3']['name'];
			$qf4 = $_FILES['qf4']['name'];
			$af1 = $_FILES['af1']['name'];
			$af2 = $_FILES['af2']['name'];
			$af3 = $_FILES['af3']['name'];
			$af4 = $_FILES['af4']['name'];
			$af5 = $_FILES['af5']['name'];
			
			
			
			switch($sel_ct)
			{
				case 1:
				$ans = 'A';
				break;
				case 2:
				$ans = 'B';
				break;
				case 3:
				$ans = 'C';
				break;
				case 4:
				$ans = 'D';
				break;
				case 5:
				$ans = 'E';
				break;
			}
			 $dq=array();
			 $aq=array();
			for($i=1;$i<=4;$i++)
			{
			   
				$rawname = "qf".$i;
				if (!empty($_FILES['qf'.$i]['name'])) {
					$rawname = "qf".$i;
				$image_path = realpath(APPPATH . '../assets/images/question_img/');
				$photo_name = str_replace(' ','',$_FILES[$rawname]['name']);
				$config['upload_path'] = $image_path;
				//echo $image_path;
				$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
				$config['max_size'] = '4024';
				$config['file_name'] = $photo_name;
				$this->load->library('upload',$config);
				$this->upload->initialize($config);
				if($this->upload->do_upload($rawname))
				{
					$dq[$i]= $photo_name;
				}
					else{
					    $dq[$i]= 0;
						echo $this->upload->display_errors();
				}
				
			}else{
			    $dq[$i]= 0; 
			}
			}
			for($i=1;$i<=5;$i++)
			{
				if (!empty($_FILES['af'.$i]['name'])) {
					$rawname = "af".$i;
				$image_path = realpath(APPPATH . '../assets/images/question_img/');
				$photo_name = str_replace(' ','',$_FILES[$rawname]['name']);
				$config['upload_path'] = $image_path;
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '4024';
				$config['file_name'] = $photo_name;
					$this->load->library('upload',$config);
				$this->upload->initialize($config);
				if($this->upload->do_upload($rawname))
				{
				$aq[$i]=$photo_name;
				
				}
				else{
				    $aq[$i]=$photo_name;
					echo $this->upload->display_errors();
				}
			}else{
			      $aq[$i]=0;
			}
			}
			$chk = $this->exammodel->insert_img_question($ques,$exam_mode_id,$dq,$aq,$ans,$op_txt1,$op_txt2,$op_txt3,$op_txt4,$op_txt5);
			if($chk)
			{
			    echo "Question upload successfully";
			}
			else 
			{
				echo "Question Not Upload";
			}
		}
		else
		{
		    echo "Image Not Found";
// 			redirect('adminController/create_ques/0'.$exam_master_id.'/'.$exam_name_id.'/'.$exam_subject_id.'/'.$exam_language);
		} 
		
	}
	function update_question()
	{	
		$this->load->model('exammodel');
		$ques = $this->input->post("ques");
		$a = $this->input->post("a");
		$b = $this->input->post("b");
		$c = $this->input->post("c");
		$d = $this->input->post("d");
		$e = $this->input->post("e");
		$ans = $this->input->post("ans");
		$q_id = $this->input->post("q_id");
		$chk = $this->exammodel->update_ques($ques,$q_id,$ans,$a,$b,$c,$d,$e);
		if($chk)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	
	function submit_Ans(){
	   $student_id= $this->input->post("student_id");
	   $subjective =  $this->input->post("subjeciveID");
	   $school_code =  $this->input->post("school_code");
	   	$exammodeid=$this->input->post("exam_mode_id");
	   	
	   for($i=1;$i<6;$i++){
	    if (!empty($_FILES['answerSheet'.$i]['name'])) {   
	   	$photo_name = time().trim($_FILES['answerSheet'.$i]['name']);
			$photo_name=str_replace(' ', '_', $photo_name);
			$image= $this->input->post('image');
			$this->load->library('upload');
			$image_path = realpath(APPPATH . '../assets/images/question_img/');
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png|docx|doc|pdf';
			$config['max_size'] = '5048';
			$config['file_name'] = $photo_name;
		
			
		
			$this->upload->initialize($config);
			if($this->upload->do_upload('answerSheet'.$i)){
				$data=array(
				 'exam_mode_id'  =>$exammodeid,
				 'student_id'=>$student_id,
				 'subjective_ques_id'=>$subjective,
				 'upload_answers'.$i=>$photo_name,
			
        		);
        		$this->db->where("exam_mode_id",$exammodeid);
        		$this->db->where("student_id",$student_id);
        	
        		$sar = $this->db->get("subjective_answer_report");
        		if($sar->num_rows()>0){
        		    if($sar->row()->status==1){
        		        ?><script>alert("You can not change Answer After submission");</script><?php
        		    }else{
        		    $update['upload_answers'.$i]=$photo_name;
        		    $update['status']=1;
        		    $this->db->where("id",$sar->row()->id);
        		    $this->db->update("subjective_answer_report",$update);
        		    }
        		}else{
        		    $this->db->insert("subjective_answer_report",$data);
        		}
        			redirect(base_url()."examControllers/demoExamSubjective/".$student_id."/".$exammodeid);
        	
			}
		}
	   }
			
	}
	
	function submit_ques()
	{	 	$exammodeid=$this->input->post("exam_mode_id");
			$school_code = $this->session->userdata("school_code");
			//echo $_FILES['image2']['name'];
			 for($i=1;$i<6;$i++){
			     	if (!empty($_FILES['image'.$i]['name'])) {
			$photo_name = time().trim($_FILES['image'.$i]['name']);
			$photo_name=str_replace(' ', '_', $photo_name);
			
			$image= $this->input->post('image');
			$this->load->library('upload');
			$image_path = realpath(APPPATH . '../assets/images/question_img/');
			$config['upload_path'] = $image_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png|docx|doc|pdf';
			$config['max_size'] = '15048';
			$config['file_name'] = $photo_name;
			
			
	
			$this->upload->initialize($config);
			if($this->upload->do_upload('image'.$i)){
				$data=array(
				  'exam_mode_id'  =>$this->input->post("exam_mode_id"),
				 'image'.$i=>$photo_name,
				 'date'=>date("Y-m-d"),
				 'school_code'=>$school_code
        		);
				
			
				$this->db->where("exam_mode_id",$this->input->post("exam_mode_id"));
				$sqn = $this->db->get("subjective_question");
				if($sqn->num_rows()>0){
				    $updata['image'.$i]=$photo_name;
					$this->db->where("exam_mode_id",$this->input->post("exam_mode_id"));
				    $this->db->update("subjective_question",$updata);
				    
				
				}else{
        		$this->db->insert("subjective_question",$data);
        			$query =	$this->db->insert_id();
				}
			
						
					redirect(base_url()."login/subjective_ques/".$exammodeid);
			}
					else{
					    echo $this->upload->display_errors();
					 echo "Somthing going wrong. Please Contact Site administrator";
					    }}
	}
	}
function deletesheet(){
		$id = $this->input->post("id");
		$img = $this->input->post("img");
		$i = $this->input->post("rowg");
		$imgv = $img;
		$imc="image".$i;
		$update1[$imc]="";
		$this->db->where("id",$id);
		$delete=$this->db->update("subjective_question",$update1);
		// echo "deleted";
	}
	
	public function deleteExamMode(){
    if($this->session->userdata("login_type")=="admin"){
        $this->db->where("id",$this->uri->segment(3)) ;
        $this->db->delete("exam_mode");
   	    redirect(base_url()."login/exammode/");
    }else{
        echo "Please Contact to principal";
    }
}

	//-----------------------------------**********************---------------------------------------//
	///////////////////////////////////END OF ONLINE EXAM/////////////////////////////////////////
}