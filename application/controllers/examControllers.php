<?php
class examControllers extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
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

	   $this->load->model("examModel");
		$var=$this->examModel->updateexam($examName,$date,$upexam);
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

	
	function startScheduling()
	{ 	
		$exam_name = $this->input->post("examName");
	
	 	$edate = $this->input->post("edate");
	 	$this->load->model("examModel");
		$data['exam_name'] = $exam_name;
	//print_r($data);exit();
		$data['edate'] = $edate;
		$data['pageTitle'] = 'Exam Scheduling';
		$data['smallTitle'] = 'Exam Scheduling';
		$data['mainPage'] = 'Exam Scheduling';
		$data['subPage'] = 'Exam Scheduling';
		//$this->load->model("examModel");
		$var=$this->examModel->getExamName();
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
		                                        <th>Name Of Sift (Like First,Second)</th>
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
	{ 	 $this->load->model("allformmodel");
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
	 $stuid=$this->input->post('stuid'); 
	    $marks=$this->input->post('marks');
	    $sub_type=$this->input->post('sub_type');
	    $mmarks=$this->input->post('mmarks');
	    $classid=$this->input->post('classid');
	    $subjectid=$this->input->post('subjectid');
	    $examid=$this->input->post('examid');
		$attendence=$this->input->post('attendence');
		$this->db->where('school_code' ,$this->session->userdata('school_code'));
		$this->db->where('class_id',$classid);
			$this->db->where('sub_type',$sub_type);
			$this->db->where('fsd',$this->input->post('fsd'));
		$this->db->where('subject_id',$subjectid);
		$this->db->where('stu_id',$stuid);
		$this->db->where('exam_id',$examid);
	$dt=	$this->db->delete('exam_info');
	if($dt){
				echo "Deleted";
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
}
