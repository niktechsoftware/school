<?php
class studentHWControllers extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
			$this->is_login();
	$this->load->model("smsmodel");
	}
	
	
		function is_login(){
		$is_login = $this->session->userdata('is_login');
	
		if(($is_login != true)){
			
			redirect("index.php/homeController/index");
		}
	
	}

	function studentShowHomeWork(){
		$this->load->model("homeWorkModel");
		$data['pageTitle'] = 'Show HomeWork';
		$data['smallTitle'] = 'Student HomeWork';
		$data['mainPage'] = 'Show HomeWork';
		$data['subPage'] = 'Student HomeWork';
		$va=$this->homeWorkModel->getHomeWorkDetail();
		$data['var1']=$va;
		$data['title'] = 'Show HomeWork';
		$data['headerCss'] = 'headerCss/feeCss';
		$data['footerJs'] = 'footerJs/feeJs';
		$data['mainContent'] = 'studentHW';
		$this->load->view("includes/mainContent", $data);

	}
	public function submitHomeWork(){
	    $school_code = $this->session->userdata("school_code");
		$data['pageTitle'] = 'HomeWork Section';
		$data['smallTitle'] = 'Employee/Teacher/Student';
		$data['mainPage'] = 'HomeWork Section';
		$data['subPage'] = 'Employee/Teacher/Student';
		$res=$this->db->query("SELECT DISTINCT section FROM class_section WHERE school_code='$school_code'");
		$data['noc'] = $res->result();
		$data['title'] = 'HomeWork Section';
		$data['headerCss'] = 'headerCss/homeWorkCss';
		$data['footerJs'] = 'footerJs/homeWorkJs';
		$data['mainContent'] = 'HomeWorksubmit';
		$this->load->view("includes/mainContent", $data);
	}
	
	
	public function hwSms(){
		$smscount=0;
		$count=0;
		 $class_id = $this->input->post("classid");
		
		 
		 $fmobile=$this->session->userdata("mobile_number");
		 $school_code=$this->session->userdata("school_code");
		 
		 $date=Date("Y-m-d");
		 
		 $this->db->select("homework_name.workDiscription,subject.subject");
		 $this->db->where("workfor","students");
		 $this->db->where("school_code",$school_code);
		 $this->db->where("homework_name.class_id",$class_id);
		 $this->db->where("Date(givenWorkDate)",$date);
		// $this->db->where("class_id",$class_id);
		 $this->db->from("homework_name");
 	  
		$this->db->join("subject","homework_name.subject_id = subject.id");
	   $cdt=$this->db->get()->result();
	
	   foreach($cdt as $row1){
	      $array1[]= $row1->subject." - ".$row1->workDiscription;
	   }
	   $mss = implode(',',$array1);
	   

	   $msg="Dear Student please done your homework which is assigned today in Subjects:".$mss."For more info visit login to you account";
	  
	  	$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
	if($sender->num_rows()>0){
		$sende_Detail =$sender->row();
		$date=date("y-m-d");
		$isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
		$fmobile1=$this->session->userdata("mobile_number");
	  if($isSMS->homework){
		$tt = $this->smsmodel->smstest($msg,$date);
	     $smsc=0;
		if($tt=="true"){
		   $query = $this->smsmodel->getClassFatherNumber($this->session->userdata("school_code"),$class_id);
		 
    		if($query->num_rows() > 0)
    		{   
        		 $max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
        		$master_id=$max_id->maxid+1;
        // 		$getresultm = $this->smsmodel->sentmasterRecord($msg,$query->num_rows(),$master_id);
        // 		if($getresultm){
        		   
        		  foreach($query->result() as $parentmobile):
        			$checknum = $this->smsmodel->checknum($parentmobile->mobile,$msg,$master_id);
        			if($checknum){
        			  
        			if($smscount<90){
        				if($smsc==0){
        					$fmobile =$checknum;
        				
        				}else{
        					$fmobile=$fmobile.",".$checknum;
        				
        				}
        				$smscount++;
        				$smsc++;
        				$count=$count+1;
				
            			}else{
            				if($this->input->post("language")==1){
            				   
            				    
            				     	mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile1);
            				
            					$getv=	mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
            				}else{
            				    	
            				     	mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile1);
            				
            					$getv = smshindi($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
            				}	
            			$a[]=0;
            		
            // 			$this->smsmodel->sendReport($getv,$master_id);
            $this->smsmodel->sentmasterRecord($msg,$query->num_rows(),$master_id,$getv);
            				$fmobile=$checknum;
            				$smscount=0;
            
            			
            			}
            			
            		}
			endforeach;
		
				if($this->input->post("language")==1){
				//echo $fmobile;
				mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				
				$getv=	mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				}else{
				    // 	sms($fmobile1,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
				
					$getv = smshindi($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
				}	
			$a[]=0;
// 		$smsdt=	$this->smsmodel->sendReport($getv,$master_id);
         $smsdt =$this->smsmodel->sentmasterRecord($msg,$query->num_rows(),$master_id);
		if($smsdt){
		    	echo  "Sms Sent .";
		}
	        	
	        
	    	} 
	    		else{
	           echo "student number not found .";
        	}
		    
		}
		else{
	           echo "this sms already sent .";
    	}
		
	  }
     	else{
	    echo "home work setting is off .";
	   }
	}
	else{
	    echo "sender id not approve .";
	}

  }
	
	function addHomeWork(){
	  
	    	$rawName ='filehomeWork';
	    $school_code = $this->session->userdata("school_code");
		$givenby=$this->session->userdata('username');
		$workfor=$this->input->post("homeworkfor");
		$photo_name = time().$_FILES['filehomeWork']['name'];
		$photo_name = str_replace(' ', '_', $photo_name);
		 
		if($workfor=="students")
		{

			$data=array(
			        "workfor"=>$this->input->post("homeworkfor"),
			        "work_name"=>$this->input->post("wsubjectname"),
				
					"maximam_marks"=>$this->input->post("mm"),
					"class_id"=>$this->input->post("classv"),
					"subject_id"=>$this->input->post("subject"),
					"givenby"=>$givenby,
					"givenWorkDate"=>$this->input->post("gdate"),
					"DueWorkDate"=>$this->input->post("sdate"),
					"workDiscription"=>$this->input->post("hwdefine"),
					//"upload_filename"=>$this->input->post("filehomeWork"),
					"upload_filename"=>$photo_name,
					"remark"=>$this->input->post("hwremark"),
					"grade"=>$this->input->post("grade"),
					"school_code"=>$school_code,
					"status"=>1
					
			);
		}else{
		    	$data=array( 
			    "workfor"=>$this->input->post("homeworkfor"),
					"work_name"=>$this->input->post("wsubjectname"),
					"maximam_marks"=>0,
					"class_id"=>"NotForSubject",
					"subject_id"=>"NotForSubject",
					"givenby"=>$givenby,
					"givenWorkDate"=>$this->input->post("gdate"),
					"DueWorkDate"=>$this->input->post("sdate"),
					"workDiscription"=>$this->input->post("hwdefine"),
					"upload_filename"=>$photo_name,
					"remark"=>$this->input->post("hwremark"),
					"grade"=>0,
					"school_code"=>$school_code,
					"status"=>1
					);
		}
		$var=0;
			$this->load->library('upload');
        	$this->load->model("homeWorkModel");
       $this->load->library('image_lib');
        if (!empty($_FILES['filehomeWork']['name'])) {
    		$this->load->model("imageupload");
    		$status=$this->imageupload->imageUploadHomeWork($rawName,$photo_name,$school_code,1);
    			
    		if($status=="success"){
        	   	$var=$this->homeWorkModel->saveHomeWork($data);
        	   	
        	//	redirect("index.php/studentHWControllers/showHomeWork");
    		}else{
    		    //echo $status;
    		   // redirect("index.php/errorController");
    		}
			}else{
			$var=$this->homeWorkModel->saveHomeWork($data);
	
			}
        if($var){
      	$smscount=0;
		$count=0;
		$class_id = $this->input->post("classv");
		$section = $this->input->post("section");
		//print_r($this->session->userdata("school_code"));exit();
		$this->load->model("smsmodel");
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
	    $isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
	    $hwsms	=$isSMS->homework;
	   // print_r($hwsms);exit();
	   if($isSMS->homework==1){
	   
	   
		if($sender->num_rows()>0){
		if($workfor=="students"){   
		$sende_Detail =$sender->row();
	$def=	$this->input->post("hwdefine");
		$sub =$this->input->post("subject");
		$this->db->where("id",$sub);
		 $dt= $this->db->get("subject")->row()->subject;
		$workfor=$this->input->post("homeworkfor");
		$sdate = $this->input->post("sdate");
	$msg =	"Dear Student please done your homework before ".$sdate." given in homework section of ".$workfor." subject ".$dt."-".$def."For more info visit login to you account";
	
		$isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
	
		$fmobile=$this->session->userdata("mobile_number");
		//print_r($this->session->userdata);
		if($isSMS->parent_message==1)
		{$section==0;
			$query = $this->smsmodel->getClassFatherNumber($this->session->userdata("school_code"),$class_id,$section);
		if($query->num_rows() > 0)
		{  
		if($fmobile){
			foreach($query->result() as $parentmobile):
			//print_r($fmobile);
			if($parentmobile->mobile){
			if($smscount<90){
				$fmobile =$fmobile.",".$parentmobile->mobile;
				$count=$count+1;
				$smscount++;
				//echo $fmobile;
			}else{
				sms($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
				$fmobile="8382829593";
				$smscount=0;
			}
			}
			endforeach;
			}
			sms($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			
		}}
	}
	else{
	    	$sende_Detail =$sender->row();
	$def=	$this->input->post("hwdefine");
		$sdate = $this->input->post("sdate");
	$msg =	"Dear Teacher please done your homework ".$def." before ".$sdate." given in homework section of your account .For more info visit login to you account";
	   
	    $isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
		$fmobile=$this->session->userdata("mobile_number");

	}}}
	////////////////////////////sms end////////////////////////////////////////
	redirect("index.php/studentHWControllers/defineHomeWork/success");
	   }
     }
			
			
		
		
			
		
	function submithw(){
	    $school_code = $this->session->userdata("school_code");
		$givenby=$this->session->userdata('username'); 
		$workfor=$this->input->post("homeworkfor");
		$this->load->model("homeWorkModel");
		 $photo_name = time().$_FILES['filehomeWork']['name'];
		 $photo_name = str_replace(' ', '_', $photo_name);
		
	
		    	$data=array(
			        "work_id"=>$this->input->post("work_id"),
					"submitted_date"=>$this->input->post("sdate"),
					"submitted_by"=>$givenby,
					"upload_file"=>$photo_name,
					"status"=>1,
					"obtain_marks"=>10	);
	    	$rawName ='filehomeWork';
		   
		    $this->load->library('upload');
		
		if (!empty($_FILES['filehomeWork']['name'])) {
    		$this->load->model("imageupload");
    		$status=$this->imageupload->imageUploadHomeWork($rawName,$photo_name,$school_code,2);
    		if($status=="success"){
        	    $var=$this->homeWorkModel->submitHomeWork($data);
        		redirect("index.php/studentHWControllers/studentShowHomeWork");
    		}else{
    		    //echo $status;
    		    redirect("index.php/errorController");
    		}
			}else{
			 $var=$this->homeWorkModel->submitHomeWork($data);
			if($var)
			{
			redirect("index.php/studentHWControllers/studentShowHomeWork");
	        }
			}

		}
		
	
	
function showHomeWork()
	{

		$this->load->model("homeWorkModel");
		$data['pageTitle'] = 'Show HomeWork';
		$data['smallTitle'] = 'Employee/Teacher/Student';
		$data['mainPage'] = 'Show HomeWork';
		$data['subPage'] = 'Employee/Teacher/Student';
		$scode=$this->session->userdata('school_code');
	//	$res=$this->db->query("SELECT DISTINCT class_name FROM class_info");
		$res=$this->db->query("SELECT DISTINCT section,id FROM class_section where school_code = $scode ");
		$data['noc'] = $res->result();
		$va=$this->homeWorkModel->getHomeWorkDetail();
		$data['var1']=$va->result();
		$data['title'] = 'Show HomeWork';
		$data['headerCss'] = 'headerCss/homeWorkCss';
		$data['footerJs'] = 'footerJs/showHomeWorkJs';
		$data['mainContent'] = 'showHomeWork';
		$this->load->view("includes/mainContent", $data);
		}
	
	function getTeacherWork()
	{	
		$this->load->model("homeWorkModel");
		$va=$this->homeWorkModel->getHomeWorkDetailTeacher();
		if($va->num_rows()>0){
		$var1=$va->result();
		
	?>
		<div class="table-responsive" id ="normal">
		<table class="table table-striped table-hover" id="sample-table-2">
		<thead>
		<tr>
		<th>S.no.</th>
		<th>Given By</th>
		<th>Assignment Title</th>
		<th>Work Description</th>
		<th>Given Date</th>
		<th>Submission Date</th>
		<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$count = 1;
					foreach($var1 as $lv): ?>
						<tr>
				  			<td><?php echo $count;?></td>
				  			<td><?php echo $lv->givenby;?></td>
				  			<td><?php echo $lv->work_name;?></td>
				  			<td><?php echo $lv->workDiscription;?></td>
				  			<td><?php echo $lv->givenWorkDate; ?></td>
							<td><?php echo $lv->DueWorkDate; ?></td>
							<td><a href="<?php echo $this->config->item("asset_url"); ?><?php echo $this->session->userdata("school_code");?>/images/filehomeWork/<?php echo $lv->upload_filename; ?>" download>
							    <button class="btn btn-info"  width="104" height="142">Download</button></a>
							   <?php	if($this->session->userdata("login_type")=='admin'){ ?>
							   <a href="<?php echo base_url(); ?>index.php/studentHWControllers/deleteHomeWork/<?php echo $lv->s_no;?>" style="color:white;"  class="btn btn-danger">Delete</a>
							  <!-- <a href="#" style="color:white;" id="view<?php echo $count;?>" class="btn btn-warning">View Detail</a>-->
							   <a href="<?php echo base_url(); ?>index.php/studentHWControllers/viewHomeWork/<?php echo $lv->s_no;?>" style="color:white;" id="view<?php echo $count;?>" class="btn btn-warning">View Detail</a>
        					   
							    <?php
						}else{
						?><a href="<?php echo base_url(); ?>index.php/studentHWControllers/submitHomeWork/<?php echo $lv->s_no;?>" style="color:white;">
							    <button class="btn btn-success"  width="104" height="142">Submit</button></a>; 
							    <?php } ?>
						   </td>
				  		</tr>
				  		<?php $count++; endforeach; ?>
					</tbody>
				</table>
				</div>
			
	<?php 
		}
	
	else{
		echo "<div style='color:red;'>home Work not Assign.</div>";
	}
		}
	
	function getempWork()
	{	
		$this->load->model("homeWorkModel");
		$va=$this->homeWorkModel->getHomeWorkDetailemp();
		if($va->num_rows()>0){
		$var1=$va->result();
		
	?>
		<div class="table-responsive" id ="normal">
		<table class="table table-striped table-hover" id="sample-table-2">
		<thead>
		<tr>
		<th>S.no.</th>
		<th>Given By</th>
		<th>Assignment Title</th>
		<th>Work Description</th>
		<th>Given Date</th>
		<th>Submission Date</th>
		<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$count = 1;
					foreach($var1 as $lv): ?>
						<tr>
				  			<td><?php echo $count;?></td>
				  			<td><?php echo $lv->givenby;?></td>
				  			<td><?php echo $lv->work_name;?></td>
				  			<td><?php echo $lv->workDiscription;?></td>
				  			<td><?php echo $lv->givenWorkDate; ?></td>
							<td><?php echo $lv->DueWorkDate; ?></td>
							<td><a href="<?php echo $this->config->item("asset_url"); ?><?php echo $this->session->userdata("school_code");?>/images/filehomeWork/<?php echo $lv->upload_filename; ?>" download><button class="btn btn-info"  width="104" height="142">Download</button></a>
							     <?php	if($this->session->userdata("login_type")=='admin'){ ?>
				            	<a href="<?php echo base_url(); ?>index.php/studentHWControllers/deleteHomeWork/<?php echo $lv->s_no;?>" style="color:white;"  class="btn btn-danger">Delete</a>
							<a href="<?php echo base_url(); ?>index.php/studentHWControllers/viewHomeWork/<?php echo $lv->s_no;?>" style="color:white;" id="view<?php echo $count;?>" class="btn btn-warning">View Detail</a>
        					   <?php
							     }else{
						?><a href="<?php echo base_url(); ?>index.php/studentHWControllers/submitHomeWork/<?php echo $lv->s_no;?>" style="color:white;">
							    <button class="btn btn-success"  width="104" height="142">Submit</button></a>
							    <?php } ?>
						   </td>
				  		</tr>
				  		<?php $count++; endforeach; ?>
					</tbody>
				</table>
				</div>
	<?php
	}
	else{
		echo "<div style='color:red;'>home Work not Assign.</div>";
	}
	}
	
	
	  public function getStudentWork1(){
		  /* $this->load->model("subjectmodel");
					$classid=$this->uri->segment(4);
    	$data['va']=$this->subjectmodel->getSubjectByClassSection($classid);
		print_r($data);exit();*/
		$uri= $this->uri->segment(3);
		$data['classid']=$this->uri->segment(4);
        $data['uri']=$uri;
		$schoolcode=$this->session->userdata("school_code");
		$this->db->where('school_code',$schoolcode);
		$data['class']=$this->db->get('class_info')->result();
      	$data['pageTitle'] = 'Homework Report';
		$data['smallTitle'] = 'Homework Report';
		$data['mainPage'] = 'Homework Report';
		$data['subPage'] = 'Homework Report';
		$data['title'] = 'Homework Report';
		$data['headerCss'] = 'headerCss/studentListCss';
		$data['footerJs'] = 'footerJs/simpleStudentListJs';
		$data['mainContent'] = 'hw_full_detail';
		$this->load->view("includes/mainContent", $data);
  }
  
  
  
        function getStudentWork(){
        	$this->load->model("homeWorkModel");
        	$va=$this->homeWorkModel->getHomeWorkDetailStudent();
    		if($va->num_rows()>0){
			$var1=$va->result();
			//print_r($var1);exit();
        	?>
    	<div class="table-responsive" id ="normal">
    	<table class="table table-striped table-hover" id="sample-table-2">
    	<thead>
    	<tr>
        	<th>S.no.</th>
        	<th>Given By</th>
    		<th>Class</th>
        	<th>Assignment Title</th>
        	<th>Subject</th>
        	<th>Marks & Grade</th>
        	<th>Work Description</th>
        	<th>Given Date</th>
        	<th>Submission Date</th>
        	<th>Action</th>
    	</tr>
    	</thead>
    	<tbody>
    	<?php
	      $count = 1;
				foreach($var1 as $lv):
				?>
					<tr>
			  			<td><?php echo $count;?></td>
			  			<td><?php $this->db->where("username",$lv->givenby);
			  			$emp_p = $this->db->get("employee_info");
			  			if($emp_p->num_rows()>0){
			  			    	echo $emp_p->row()->name."[".$emp_p->row()->username."]";
			  			}else{
			  			    	echo "Admin";
			  			}
			  		?></td>
			  	    	<td><?php 
			  	    		$this->db->where("id",$lv->class_id);
                        	$var =  $this->db->get("class_info");
                        	if($var->num_rows()>0){
                        	    $var=$var->row();
                            if($lv->class_id==0){echo "No Record Found";}else{ echo $var->class_name;}
                            $this->db->where("id",$var->section);
                        	$var1 = $this->db->get("class_section")->row();
                        	echo "[".$var1->section."]";
                        	}
			  	    	?></td>
			  			<td><?php echo $lv->work_name;?></td>
			  		
			  			<td><?php $sub= $lv->subject_id;
			  			if($sub==0){
                            echo "N/A";
                        }else{
                           $this->db->where("id",$sub);
						   $dt1= $this->db->get("subject")->row();
						   if($dt1){echo $dt1->subject;} else{ echo "N/A";}
                           
                        }
                        ?></td>
			  			<td><?php echo $lv->maximam_marks;?> ( <?php echo $lv->grade;?> )</td>
			  			<td style="max-width: 151px;"><?php echo $lv->workDiscription;?></td>
			  			<td><?php echo $lv->givenWorkDate; ?></td>
						<td><?php echo $lv->DueWorkDate; ?></td>
						<td style=" width: 30%;"><a href="<?php echo $this->config->item("asset_url"); ?><?php echo $this->session->userdata("school_code");?>/images/filehomeWork/<?php echo $lv->upload_filename; ?>" >
						    <button class="btn btn-info"  width="104" height="142">Download</button></a>
						<?php	 
						if($this->session->userdata("login_type")=='admin' ||$this->session->userdata("login_type")==3)
						{ 
						?><a href="<?php echo base_url(); ?>index.php/studentHWControllers/deleteHomeWork/<?php echo $lv->s_no;?>" style="color:white;"  class="btn btn-danger">Delete</a>
						<a href="<?php echo base_url(); ?>index.php/studentHWControllers/viewHomeWork/<?php echo $lv->s_no;?>" style="color:white;" id="view<?php echo $count;?>" class="btn btn-warning">View Detail</a>
						<?php }
						else{
						?>
						<a href="<?php echo base_url(); ?>index.php/studentHWControllers/submitHomeWork/<?php echo $lv->s_no;?>" style="color:white;">
						<button class="btn btn-success"  width="104" height="142">Submit</button></a> 
						<?php } ?>
						</td>
			  		</tr>
			  		<?php $count++; endforeach; ?>
				</tbody>
			</table>
			</div>
<?php		
		 
	}
	
	else{
		echo "<div style='color:red;'>home Work not Assign.</div>";
	}
		?>	<script>
	TableExport.init();
</script>
<?php	}

	function showHomeWork1(){
	$classt=$this->input->post("classv");
	$sec=$this->input->post("section");
	$this->load->model("homeWorkModel");
	$var=$this->homeWorkModel->getSectionWise($classt,$sec);
	

	?>

		<div class="table-responsive" id ="normal">
		
		<table class="table table-striped table-hover" id="sample-table-2">
		<thead>
    		<tr>
        		<th>S.No.</th>
        		<th>Given By</th>
        		<th>Assignment Title</th>
        		<th>Class</th>
        		<th>Section</th>
        		<th>Marks & Grade</th>
        		<th>Work Description</th>
        		<th>Given Date</th>
        		<th>Submission Date</th>
        		<th>Action</th>
    		</tr>
		</thead>
		<tbody>
		<?php
		$count = 1;
					foreach($var->result() as $lv):
					?>
						<tr>
				  			<td><?php echo $count;?></td>
				  			<td><?php echo $lv->givenby;?></td>
				  			<td><?php echo $lv->work_name;?></td>
				  			<td><?php
				  		        	$this->db->where("id",$lv->class_id);
                        	$var =  $this->db->get("class_info")->row();
                            if($lv->class_id==0){echo "No Record Found";}else{ echo $var->class_name;}
                            
                            
                            ?>
                            </td>
				  			<td><?php
				  			        $this->db->where("id",$var->section);
                        	$var1 = $this->db->get("class_section")->row();
                        	echo $var1->section;
                        // echo $var->section;
				  			?></td>
				  			<td><?php echo $lv->maximam_marks;?> ( <?php echo $lv->grade;?> )</td>
				  			<td style="max-width: 151px;"><?php echo $lv->workDiscription;?></td>
				  			<td>
								<?php echo $lv->givenWorkDate; ?>
							</td>
							<td>
								<?php echo $lv->DueWorkDate; ?>
							</td>
							<td style=" width: 30%;"><a href="<?php echo $this->config->item("asset_url"); ?>/<?php echo $this->session->userdata("school_code");?>/images/filehomeWork/<?php echo $lv->upload_filename; ?>" 
							        <button class="btn btn-info"  width="104" height="142">Download</button></a>
							<?php 
							  if($this->session->userdata("login_type")=='admin' || $this->session->userdata("login_type")==3)
							    { 
        						?><a href="<?php echo base_url(); ?>index.php/studentHWControllers/deleteHomeWork/<?php echo $lv->s_no;?>" style="color:white;"  class="btn btn-danger">Delete</a>
        					    <a href="<?php echo base_url(); ?>index.php/studentHWControllers/viewHomeWork/<?php echo $lv->s_no;?>" style="color:white;" id="view<?php echo $count;?>" class="btn btn-warning">View Detail</a>
        					    <?php }else{
						?><a href="<?php echo base_url(); ?>index.php/studentHWControllers/submitHomeWork/<?php echo $lv->s_no;?>" style="color:white;">
							    <button class="btn btn-success"  width="104" height="142">Submit</button></a>
							    <?php } ?>
							    
						
						</td>
				  		</tr>
				  		<?php $count++; endforeach; ?>
					</tbody>
				</table>
		
				</div>
				
		<?php 
	}
	
	public function deleteHomeWork(){
	  $id= $this->uri->segment(3);
	//	$this->db->where('school_code',$this->session->userdata('school_code'));
		$this->db->where('work_id',$id);
		$delete=$this->db->delete('homework');
		redirect("index.php/studentHWControllers/studentShowHomeWork");
		
	}
public function viewHomeWork(){
	  $a= $this->uri->segment(3);
	  //	$this->load->model("homeWorkModel");
		$data['pageTitle'] = 'HomeWork Full Detail';
		$data['smallTitle'] = 'Employee/Teacher/Student';
		$data['mainPage'] = 'HomeWork Full Detail';
		$data['subPage'] = 'Employee/Teacher/Student';
		$data['title'] = 'HomeWork Full Detail';
		$data['headerCss'] = 'headerCss/homeWorkCss';
		$data['footerJs'] = 'footerJs/showHomeWorkJs';
		$data['mainContent'] = 'viewhwdetail';
		$this->load->view("includes/mainContent", $data);
	}
	public function defineHomeWork(){
	    $school_code = $this->session->userdata("school_code");
		$data['pageTitle'] = 'Define HomeWork';
		$data['smallTitle'] = 'Employee/Teacher/Student';
		$data['mainPage'] = 'Define HomeWork';
		$data['subPage'] = 'Employee/Teacher/Student';
		$res=$this->db->query("SELECT DISTINCT section ,id FROM class_section WHERE school_code='$school_code'");
		
		$data['noc'] = $res->result();
		$data['title'] = 'Define HomeWork';
		$data['headerCss'] = 'headerCss/homeWorkCss';
		$data['footerJs'] = 'footerJs/homeWorkJs';
		$data['mainContent'] = 'studentHomeWork';
		$this->load->view("includes/mainContent", $data);
	}
	
	
}