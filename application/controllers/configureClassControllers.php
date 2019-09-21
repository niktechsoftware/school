<?php
class ConfigureClassControllers extends CI_Controller{
	
function __construct()
	{
		parent::__construct();
		$this->is_login();
		
	}


	
	public function migrate_class_data(){
		echo "test is successfully";
		
		$this->db->distinct();
		$this->db->select("school_code");
		$getCode = $this->db->get("general_settings");
		if($getCode-> num_rows()>0){
			
			foreach($getCode->result() as $row):
				$data = array(
					'school_code'=>$row->school_code
				);
			$this ->db->insert("school_code", $data);
			$this ->db->where("school_code", $row->school_code);
			$schoolid= $this->db->get("school_code")->row()->id;
			
			$this->db->distinct();
			$this->db->select("section");
			$this->db->where("school_code",$row->school_code);
			$section = $this->db->get("class_section"); 

			foreach ($section ->result() as $sec ):
				$sectiondata = array (
					'section_name' => $sec->section,
					'school_code'=>$schoolid
				);
$this->db->insert("section", $sectiondata);

endforeach;
			
			$this->db->distinct();
			$this->db->select("stream");
			$this->db->where("school_code",$row->school_code);
			$stream= $this->db->get("stream_old"); 

			foreach ($stream ->result() as $str ):
				$streamdata = array (
					'stream_name' => $str->stream,
					'school_code'=>$schoolid
				);
			$this->db->insert("stream", $streamdata);
                    endforeach;

                 endforeach;
	
		      echo " Data successfully";

          }
   }

	function is_login(){
		$is_login = $this->session->userdata('is_login');
		$is_lock = $this->session->userdata('is_lock');
		$logtype = $this->session->userdata('login_type');
		if(($logtype == "admin")||($logtype == "1")){
			
		
		}else{
		    	redirect("index.php/homeController/index");
		}
		if(!$is_login){
			//echo $is_login;
			redirect("index.php/homeController/index");
		}
		elseif(!$is_lock){
			redirect("index.php/homeController/lockPage");
		}
	}
	//-------------------------------------//
	public function rep_formate_save(){
		$formate_rep=$this->input->post('formate_rep');
		$db = array(
				"format" => $formate_rep,
				"classwisereport_format"=>$formate_rep,
				"school_code"=>$this->session->userdata("school_code"),
				"created_date"=>date('Y-m-d')
		);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->get("result_format");
		if($query->num_rows() >0){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->update("result_format",$db);
		}else{
			$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->insert("result_format",$db);
		}
		
		//redirect("login/configuredoc");
	}
	public function id_formate_save(){
		$formate_id=$this->input->post('formate_id');
		$db = array(
				"classwiseicard_format" => $formate_id,
				"studenticard_format"=>$formate_id,
				"school_code"=>$this->session->userdata("school_code"),
				"created_date"=>date('Y-m-d')
		);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->get("result_format");
		if($query->num_rows() >0){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->update("result_format",$db);
		}else{
			$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->insert("result_format",$db);
		}
		
	}
	public function tc_formate_save(){
		$formate_tc=$this->input->post('formate_tc');
		$db = array(
				"tc" => $formate_tc,
				"school_code"=>$this->session->userdata("school_code"),
				"created_date"=>date('Y-m-d')
		);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->get("result_format");
		if($query->num_rows() >0){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->update("result_format",$db);
		}else{
			$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->insert("result_format",$db);
		}
		
	}
	public function cc_formate_save(){
		$formate_cc=$this->input->post('formate_cc');
		$formate_tc=$this->input->post('formate_tc');
		$db = array(
				"cc" => $formate_cc,
				"school_code"=>$this->session->userdata("school_code"),
				"created_date"=>date('Y-m-d')
		);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->get("result_format");
		if($query->num_rows() >0){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->update("result_format",$db);
		}else{
			$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->insert("result_format",$db);
		}
		
	}
//-------------------------------------//
	public function deletefeecat(){
		$id=$this->input->post('streamId');
		$this->db->where('school_code',$this->session->userdata('school_code'));
		$this->db->where('id',$id);
		$delete=$this->db->delete('fee_cat');
		if($delete){
		?>
			<script>
			        $.post("<?php echo site_url('index.php/configureClassControllers/addfeecategory') ?>", function(data){
			            $("#streamList1").html(data);
					});
			</script>
			<?php 
		}
	}
	
	public function updatecatforfee(){
		$this->load->model('configureClassModel');
		if($query = $this->configureClassModel->updatecat($this->input->post("streamId"),$this->input->post("streamName"))){
			?>
			<script>
			        $.post("<?php echo site_url('index.php/configureClassControllers/addfeecategory') ?>", function(data){
			            $("#streamList1").html(data);
					});
			</script>
			<?php 
		}	
		
	}
//-------------------------------------//
	public function addfeecategory(){
		$stream=$this->input->post('streamName');
		$this->load->model('configureClassModel');
		$streamList = $this->configureClassModel->addfeecategory($stream);
		$data['streamList'] = $streamList;
		$this->load->view("ajax/addfeecat",$data);
	}
//-------------------------------------//
	public function addStream(){
		$stream=$this->input->post('streamName');
		$this->load->model('configureClassModel');
		$streamList = $this->configureClassModel->addStream($stream);
		//print_r($streamList);
		$data['streamList'] = $streamList;
		$this->load->view("ajax/addStream",$data);
	}
	public function addfsd(){
		$startdate=$this->input->post('startdate');
		$enddate=$this->input->post('enddate');
		$this->load->model('configureClassModel');
		$fsdList = $this->configureClassModel->addfsd($startdate,$enddate);
		//print_r($streamList);
		$data['showfsd'] = $fsdList->result();
		$this->load->view("updatefsd",$data);
	}

	public function updateStream(){
		$this->load->model('configureClassModel');
		if($query = $this->configureClassModel->updateStream($this->input->post("streamId"),$this->input->post("streamName"))){
			?>
			<script>
			        $.post("<?php echo site_url('index.php/configureClassControllers/addStream') ?>", function(data){
			            $("#streamList1").html(data);
					});
			</script>
			<?php 
		}	
		
	}
	
	public function getStreamByClass(){
		$classid = $this->input->post("classid");
		$this->load->model('configureClassModel');
		$query = $this->configureClassModel->getStreamByClass($classid);

		
	    	echo '<option value="">Select Subject Stream</option>';
			foreach ($query->result() as $row){
				?>
				
					<?php   
                           $this->db->where('id',$row->stream);
				 	       $row2=$this->db->get('stream')->row();

                          ?>
					<option value="<?php echo $row2->id; ?>" ><?php echo $row2->stream; ?></option>
				<?php 
			}
	}
	public function getSection(){
		$streamid = $this->input->post("streamid");
		$this->load->model('configureClassModel');
		$query = $this->configureClassModel->getSection($streamid);
	    	echo '<option value="">--Select Section--</option>';
			foreach ($query->result() as $row){
                           $this->db->where('id',$row->section);
				 	       $row2=$this->db->get('class_section')->row();
                          ?>
					<option value="<?php echo $row2->id; ?>" ><?php echo $row2->section; ?></option>
				<?php 
			}
	}
	
	
	public function deleteStream(){
		$this->load->model('configureClassModel');
		if($query =$this->configureClassModel->deleteStream($this->input->post("streamId"))){
			?>
			<script>
			        $.post("<?php echo site_url('index.php/configureClassControllers/addStream') ?>", function(data){
			            $("#streamList1").html(data);
					});
			</script>
			<?php 
		}
		else
		{?>
		    <script>  $.post("<?php echo site_url('index.php/configureClassControllers/addStream') ?>", {streamName : ''}, function(data){
        	
            $("#streamList1").html(data);
		});</script>
	<?php	}
	
	}
	
	public function findclass(){
	   
	   $findclass=$this->input->post('findclass');
	  //echo $findclass;
	   $school_code=$this->session->userdata('school_code');
	   $this->db->where('school_code',$school_code);
	   $this->db->where('class_name',$findclass);
	 $query=  $this->db->get('class_info');
	 	$i = 1;
		     foreach ($query->result() as $row)


				 {
				 	$sectionid=$row->section;
				 	$streamid=$row->stream;
				 	$this->db->where('id',$sectionid);
				 $sectionname=	$this->db->get('class_section')->row();
				 	$this->db->where('id',$streamid);
				 $streamname=	$this->db->get('stream')->row();
				 
	//$sectionname = $this->configureClassModel->getsectionforclass($sectionid);
	//$streamname = $this->configureClassModel->getstreamforclass($streamid);
				 	
					echo '<tr>';
					echo '<th>'.$i.'</th>' ;
					echo '<th>'.$row->class_name.'</th>';
					
					echo '<th>'.$sectionname->section.'</th>';
				    
					echo '<th>'.$streamname->stream.'</th>';
			     	
					echo '</tr>';
					$i++;
			
				
			}	
	   
	}

	
	
	//-------------------------------------------------- Add Section Code Start --------------------------------------------
	
	public function addSection(){
		$this->input->post('sectionName');
		$this->load->model('configureClassModel');
		$sectionList = $this->configureClassModel->addSection($this->input->post("sectionName"));
		$data['sectionList'] = $sectionList;
		$this->load->view("ajax/configureSectionList",$data);
		
		}
		public function updateSection(){
			$this->load->model('configureClassModel');
			if($query = $this->configureClassModel->updateSection($this->input->post("sectionId"),$this->input->post("sectionName"))){
				?>
				<script>
				    jQuery(document).ready(function() {
				        $.post("<?php echo site_url('index.php/configureClassControllers/addSection') ?>", function(data){
				            $("#sectionList").html(data);
						});
				    });
				</script>
				<?php 
			}		
		}
		
		public function getSectionbyStream()
		 {
			$streamid = $this->input->post("streamid");
			//print_r($streamid);
			//$stream = $this->input->post("stream");
			$this->load->model('configureClassModel');
			$query = $this->configureClassModel->getSectionByClassStream($streamid);
			if($query->num_rows()>0)
			{
           echo   '<option value="">--Select Section--</option>';
			foreach ($query->result() as $row)
			{
				?>
				
					<?php   
                                $this->db->where('id',$row->section);
				 	           $row2=$this->db->get('class_section')->row();

                          ?>
					<option value="<?php echo $row2->id;?>"><?php echo $row2->section;?></option>
				<?php 
			}
		}
		else
		{
                echo "string";

		}
	}

      public function getclass()
		 {
			$streamid = $this->input->post("streamid");
			$sectionid = $this->input->post("sectionid");
			//print_r($streamid);
			//$stream = $this->input->post("stream");
			$this->load->model('configureClassModel');
			$query = $this->configureClassModel->getClassBySectionStream($streamid,$sectionid);
			if($query->num_rows()>0)
			{
           echo   '<option value="">--Select Class--</option>';
			foreach ($query->result() as $row)
			{
				?>
					<option value="<?php echo $row->id;?>"><?php echo $row->class_name;?></option>
				<?php 
			}
		}
		else
		{
                echo "string";

		}
	}
	public function getClasslist()
		 {
			$streamid = $this->input->post("streamid");
			$sectionid = $this->input->post("sectionid");
			//print_r($streamid);
			//$stream = $this->input->post("stream");
			$this->load->model('configureClassModel');
			$query = $this->configureClassModel->getClasslistBystreamSection($streamid,$sectionid);
			if($query->num_rows()>0)
			{
           echo   '<option value="">--Select Class--</option>';
			foreach ($query->result() as $row)
			{
				?>
					<option value="<?php echo $row->id;?>"><?php echo $row->class_name;?></option>
				<?php 
			}
		}
		else
		{
                echo "string";

		}
	}




		
		public function deleteSection(){
			$this->load->model('configureClassModel');
			if($query = $this->configureClassModel->deleteSection($this->input->post("sectionId"))){
				?>
					<script>
					        $.post("<?php echo site_url('index.php/configureClassControllers/addSection') ?>", function(data){
					            $("#sectionList").html(data);
							});
					</script>
				<?php 
			}
			else
			{?>
			
			  $.post("<?php echo site_url('index.php/configureClassControllers/addSection') ?>", function(data){
					            $("#sectionList").html(data);
							});
			    
		<?php	}
		}
		
	//-------------------------------------------- add Class Code start -------------------------------------------------------
	
		//-------------------------------------------------- Add Section Code Start --------------------------------------------
		
public function addClass(){
			$this->load->model('configureClassModel');
			$classData = array(
					"class_name" => $this->input->post("className"),
					"stream" => $this->input->post("classStream"),
					"section" => $this->input->post("classSection"),
					//"class_teacher_id" => $this->session->userdata('username'),
					"school_code" => $this->session->userdata('school_code')
			  );
			$sectionList = $this->configureClassModel->addClass($classData);

				$i = 1;
		     foreach ($sectionList as $row)


				 {
				 	$sectionid=$row->section;
				 	$streamid=$row->stream;
	$sectionname = $this->configureClassModel->getsectionforclass($sectionid);
	$streamname = $this->configureClassModel->getstreamforclass($streamid);
				 	
					echo '<tr>';
					echo '<th>'.$i.'</th>' ;
					echo '<th>'.$row->class_name.'</th>';
					
					echo '<th>'.$sectionname->section.'</th>';
				    
				    
					echo '<th>'.$streamname->stream.'</th>';
			     	
					echo '</tr>';
					$i++;
				
			}
		}
		// this method call from updateClass.php for update class detail.
public function updateClass(){
		$rowId = $this->input->post("id");
		$teacherId=$this->input->post("teacherId");
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("class_teacher_id",$teacherId);
		$teacherid = $this->db->get("class_info");
		if($teacherid->num_rows()>1){
		    
		    $data = array(
							"class_name" => $this->input->post("clName"),
					);
					$this->load->model('configureClassModel');
				if($this->configureClassModel->updateClassDetail($data,$rowId)){
						?>
								<div class="alert alert-danger">
								<button data-dismiss="alert" class="close">
									&times;
								</button>
								<strong>You can not update this class Teacher</strong> 
								because this teacher is already class teacher of  two class's  
								<a class="alert-link" href="<?php echo base_url();?>index.php/employee/employeeList">
								<strong>Employee List</strong></a>.
							</div>
						<?php } }
		 else
		     {
					
					$data = array(
							"class_teacher_id" => $teacherId,
					);
				
					$this->load->model('configureClassModel');
					if($this->configureClassModel->updateClassDetail($data,$rowId)){
						?>
							<div class="alert alert-success">
								<button data-dismiss="alert" class="close">
								&times;
								</button>
								<strong>Well done!</strong> You successfully Update <a class="alert-link" href="#">
									<?php echo $this->input->post("clName")."-".$this->input->post("section"); ?></a>
								.			
							</div>
						<?php 
					} 
					else{
						?>
							<div class="alert alert-danger">
								<button data-dismiss="alert" class="close">
									&times;
								</button>
								<strong>You can not update this class Info</strong> 
								because Teacher is not avaliable in 
								<a class="alert-link" href="<?php echo base_url();?>index.php/employee/employeeList">
								<strong>Employee List</strong></a>.
							</div>
						<?php 
				             	}	
			         	}
				}
							public function deleteClass(){
					$this->load->model('configureClassModel');
					
					
					
					$id=$this->input->post("rowId");
					$this->load->model('configureClassModel');

					$this->db->where('class_id',$id);
					$data=$this->db->get('student_info')->result();
					foreach($data as $row)
					{

						$classid=$row->class_id;
						if($classid==$id)
						{

							   echo "<script>alert('you can not delete this class because your school student is already present in this class');</script>";
               				 return false;

               				

						}

					}
					$row=$this->configureClassModel->deleteClassDetail($this->input->post("rowId"));
                    
                    
				
				}
}