<?php
class studentHWControllers extends CI_Controller{
	
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
	function studentShowHomeWork(){
		$this->load->model("homeWorkModel");
		$data['pageTitle'] = 'Show HomeWork';
		$data['smallTitle'] = 'Student HomeWork';
		$data['mainPage'] = 'Show HomeWork';
		$data['subPage'] = 'Student HomeWork';
		
	//	$res=$this->db->query("SELECT DISTINCT class_name FROM class_info");
		// $res=$this->db->query("SELECT DISTINCT section FROM class_section");
		// $data['noc'] = $res->result();
		$va=$this->homeWorkModel->getHomeWorkDetail();
		$data['var1']=$va;
		$data['title'] = 'Show HomeWork';
		$data['headerCss'] = 'headerCss/homeWorkCss';
		$data['footerJs'] = 'footerJs/showHomeWorkJs';
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
	

	
	function addHomeWork(){
	    $school_code = $this->session->userdata("school_code");
		$givenby=$this->session->userdata('username');
		$workfor=$this->input->post("homeworkfor");
		if($workfor=="students")
		{$photo_name = time().$_FILES['filehomeWork']['name'];
			$data=array(
			        "workfor"=>$this->input->post("homeworkfor"),
			        "work_name"=>$this->input->post("wsubjectname"),
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
			$this->load->library('upload');
		//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/filehomeWork');
		$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/filehomeWork';
		$config['upload_path'] = $image_path;
		$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc|txt';
		$config['max_size'] = '2096';
		$config['file_name'] = $photo_name;
		if (!empty($_FILES['filehomeWork']['name'])) {
      $a=  $this->upload->initialize($config);
		$this->upload->do_upload('filehomeWork');
		//print_r($config);exit();
		}
		else{
            echo "Somthing going wrong. Please Contact Site administrator";
		}
			
			
			$this->load->model("homeWorkModel");
			$var=$this->homeWorkModel->saveHomeWork($data);
			
			if($var)
			{
			    ////////////////////////////sms start////////////////////////////////////////
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
	////////////////////////////sms end////////////////////////////////////////
	redirect("index.php/studentHWControllers/defineHomeWork/success");
	
	
	   }
	else{redirect("index.php/studentHWControllers/defineHomeWork/success");}
	
	
	
	
	}
		    
		}else{
	    $photo_name = time().$_FILES['filehomeWork']['name'];
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
		$this->load->library('upload');
		//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/filehomeWork');
		$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/filehomeWork';
		$config['upload_path'] = $image_path;
		$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
		$config['max_size'] = '2096';
		$config['file_name'] = $photo_name;
		if (!empty($_FILES['filehomeWork']['name'])) {
            $this->upload->initialize($config);
			$this->upload->do_upload('filehomeWork');
		}
		else{echo "Somthing going wrong. Please Contact Site administrator";}
					$this->load->model("homeWorkModel");
			        $var=$this->homeWorkModel->saveHomeWork($data);
					 if($var)
					
			    ////////////////////////////sms start////////////////////////////////////////
	{	$smscount=0;
		$count=0;
		$this->load->model("smsmodel");
		$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));

	if($sender->num_rows()>0){
		$sende_Detail =$sender->row();
	$def=	$this->input->post("hwdefine");
		$sdate = $this->input->post("sdate");
		$msg =	"Dear Teacher please done your homework ".$def." before ".$sdate." given in homework section of your account .For more info visit login to you account";
	    $isSMS = $this->smsmodel->getsmsseting($this->session->userdata("school_code"));
		$fmobile=$this->session->userdata("mobile_number");
//	print_r($isSMS);exit();
	/*	if($isSMS->parent_message==1)
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
			
		}
		    */
		}
	}
	////////////////////////////sms end////////////////////////////////////////
					 
					 
				redirect("index.php/studentHWControllers/defineHomeWork/success");
		}
	}
	function submithw(){
	    $school_code = $this->session->userdata("school_code");
		$givenby=$this->session->userdata('username'); 
		$workfor=$this->input->post("homeworkfor");
		if($workfor=="students")
		{ 
		    $photo_name = time().$_FILES['filehomeWork']['name'];
			$data=array(
					"work_id"=>$this->input->post("work_id"),
					"submitted_date"=>$this->input->post("sdate"),
					"submitted_by"=>$givenby,
				//	"upload_file"=>$this->input->post("filehomeWork"),
					"upload_file"=>$photo_name,
					"status"=>1,
					"obtain_marks"=>10	
			);
			
		$this->load->library('upload');
		//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/submithomeWork');
		$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/submithomeWork';
		$config['upload_path'] = $image_path;
		$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
		$config['max_size'] = '2096';
		$config['file_name'] = $photo_name;
		if (!empty($_FILES['filehomeWork']['name'])) {
            $this->upload->initialize($config);
			$this->upload->do_upload('filehomeWork');
		}
		else{echo "Somthing going wrong. Please Contact Site administrator";}
			
			
			
			$this->load->model("homeWorkModel");
			$var=$this->homeWorkModel->submitHomeWork($data);
			if($var)
			{
			redirect("index.php/studentHWControllers/showHomeWork");
	}}else{
	    $photo_name = time().$_FILES['filehomeWork']['name'];
			$data=array(
			"work_id"=>$this->input->post("work_id"),
					"submitted_date"=>$this->input->post("sdate"),
					"submitted_by"=>$givenby,
					"upload_file"=>$photo_name,
					"status"=>1,
					"obtain_marks"=>10	);
					$this->load->library('upload');
		//$image_path = realpath(APPPATH . '../assets/'.$school_code.'/images/submithomeWork');
		$asset_name = $this->db->get('upload_asset')->row()->asset_name;
			$image_path = $asset_name.$school_code.'/images/submithomeWork';
		$config['upload_path'] = $image_path;
		$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
		$config['max_size'] = '2096';
		$config['file_name'] = $photo_name;
		
		if (!empty($_FILES['filehomeWork']['name'])) {
            $this->upload->initialize($config);
			$this->upload->do_upload('filehomeWork');
		}
		else{echo "Somthing going wrong. Please Contact Site administrator";}
					
					$this->load->model("homeWorkModel");
			        $var=$this->homeWorkModel->submitHomeWork($data);
					
				redirect("index.php/studentHWControllers/showHomeWork");
		}
		
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
							<td><a href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/filehomeWork/<?php echo $lv->upload_filename; ?>" download>
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
							<td><a href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/filehomeWork/<?php echo $lv->upload_filename; ?>" download><button class="btn btn-info"  width="104" height="142">Download</button></a>
							     <?php	if($this->session->userdata("login_type")=='admin'){ ?>
				            	<a href="<?php echo base_url(); ?>index.php/studentHWControllers/deleteHomeWork/<?php echo $lv->s_no;?>" style="color:white;"  class="btn btn-danger">Delete</a>
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
	
        function getStudentWork(){
        	$this->load->model("homeWorkModel");
        	$va=$this->homeWorkModel->getHomeWorkDetailStudent();
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
			  			<td><?php echo $lv->givenby;?></td>
			  			<td><?php echo $lv->work_name;?></td>
			  		
			  			<td><?php $sub= $lv->subject_id;
			  			if($sub==0){
                            echo "N/A";
                        }else{
                           $this->db->where("id",$sub);
                           $dt1= $this->db->get("subject")->row();
                           echo $dt1->subject;
                        }
                        ?></td>
			  			<td><?php echo $lv->maximam_marks;?> ( <?php echo $lv->grade;?> )</td>
			  			<td style="max-width: 151px;"><?php echo $lv->workDiscription;?></td>
			  			<td><?php echo $lv->givenWorkDate; ?></td>
						<td><?php echo $lv->DueWorkDate; ?></td>
						<td style=" width: 30%;"><a href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/filehomeWork/<?php echo $lv->upload_filename; ?>" download>
						    <button class="btn btn-info"  width="104" height="142">Download</button></a>
						<?php	 
						if($this->session->userdata("login_type")=='admin' ||$this->session->userdata("login_type")==3)
						{ 
						?><a href="<?php echo base_url(); ?>index.php/studentHWControllers/deleteHomeWork/<?php echo $lv->s_no;?>" style="color:white;"  class="btn btn-danger">Delete</a>
						<a href="<?php echo base_url(); ?>index.php/studentHWControllers/viewHomeWork/<?php echo $lv->s_no;?>" style="color:white;" id="view<?php echo $count;?>" class="btn btn-warning">View Detail</a>
						<?php }
					/*	elseif($this->session->userdata("login_type")==3)
						{
						echo '<a href="#" style="color:white;"><button class="btn btn-danger"  width="104" height="142">Delete</button></a>';
						}*/
						else{
						?>
						<a href="<?php echo base_url(); ?>index.php/studentHWControllers/submitHomeWork/<?php echo $lv->s_no;?>" style="color:white;">
						<button class="btn btn-success"  width="104" height="142">Submit</button></a>; 
						<?php } ?>
						</td>
			  		</tr>
			  		<?php $count++; endforeach; ?>
				</tbody>
			</table>
			</div><?php 
	}
	
	else{
		echo "<div style='color:red;'>home Work not Assign.</div>";
	}
	}

	function showHomeWork1(){
	$classt=$this->input->post("classv");
	$sec=$this->input->post("section");
	$this->load->model("homeWorkModel");
	$var=$this->homeWorkModel->getSectionWise($classt,$sec);

	?>
	
	<html><head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
	<script> // alert("hii");
	    $(document).ready(function() {
    $('#sample-table-2').DataTable();
} );
	</script>
	
	</head><body>
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
                        	$var = $this->db->get("class_info")->row();
                            if($lv->class_id==0){echo "No Record Found";}else{ echo $var->class_name;}
                            ?>
                            </td>
				  			<td><?php
                        	$var1 = $this->db->get("class_section")->row();
                        	echo $var1->section;
				  			?></td>
				  			<td><?php echo $lv->maximam_marks;?> ( <?php echo $lv->grade;?> )</td>
				  			<td style="max-width: 151px;"><?php echo $lv->workDiscription;?></td>
				  			<td>
								<?php echo $lv->givenWorkDate; ?>
							</td>
							<td>
								<?php echo $lv->DueWorkDate; ?>
							</td>
							<td style=" width: 30%;"><a href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/filehomeWork/<?php echo $lv->upload_filename; ?>" download>
							        <button class="btn btn-info"  width="104" height="142">Download</button></a>
							<?php 
							  if($this->session->userdata("login_type")=='admin' || $this->session->userdata("login_type")==3)
							    { 
        						?><a href="<?php echo base_url(); ?>index.php/studentHWControllers/deleteHomeWork/<?php echo $lv->s_no;?>" style="color:white;"  class="btn btn-danger">Delete</a>
        					    <a href="<?php echo base_url(); ?>index.php/studentHWControllers/viewHomeWork/<?php echo $lv->s_no;?>" style="color:white;" id="view<?php echo $count;?>" class="btn btn-warning">View Detail</a>
        					    <?php }/*
        						elseif($this->session->userdata("login_type")==3)
        						{
        						?><button class="btn btn-danger" id="delete<?php echo $count ; ?>"  width="104" height="142" style="color:white;">Delete</button>
        					    <?php 	}*/else{
						?><a href="<?php echo base_url(); ?>index.php/studentHWControllers/submitHomeWork/<?php echo $lv->s_no;?>" style="color:white;">
							    <button class="btn btn-success"  width="104" height="142">Submit</button></a>; 
							    <?php } ?>
							    
						
						</td>
				  		</tr>
				  		<?php $count++; endforeach; ?>
					</tbody>
				</table>
				
			
				</div></body></html><?php 
	}
	
	public function deleteHomeWork(){
	  $id= $this->uri->segment(3);
		$this->db->where('school_code',$this->session->userdata('school_code'));
		$this->db->where('s_no',$id);
		$delete=$this->db->delete('homework_name');
		redirect("index.php/studentHWControllers/showHomeWork");
		
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
	
	
}