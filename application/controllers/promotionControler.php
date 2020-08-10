<?php 
class promotionControler extends CI_Controller{
	public static $sno = 0;
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("teacherModel");
		$this->load->model("allFormModel");
	}

	function promotionReport(){
		echo $fsd=$this->input->post('fsd');
		echo $fsd=$this->input->post('section');
		echo $fsd=$this->input->post('classv');

	}
	function getfeelist(){
		$fsd = $this->input->post("fsd");
		$data = $this->allFormModel->getClassInfotoFsd($fsd);
		?> 
		<div class="panel-body panel-scroll" style="overflow: auto; height: 820px;">
		<table class="table table-striped table-hover" id="sample-table-2">
					<thead>
						<tr class="text-center">
						<th class="text-center">#</th>
							<th class="text-center">FSD ID</th>
							<th class="text-center">Stream</th>
							<th class="text-center">Class-Section</th>
							<th class="text-center">Fee Head Name</th>
							<th class="text-center">Fee Amount</th>
							<th class="text-center">update Fsd</th>
							<th class="text-center">Action</th>

						</tr>
					</thead>
					<tbody>
					<?php 
					if($data->num_rows()>0){
						$ofsd = $this->allFormModel->getfsddetails($fsd)->row(); 
					$i =1;foreach($data->result() as $row1):?>
					<tr>
					<td class="text-center"><?php  echo $i;?> </td>
						<td class="text-center"><?php  echo $ofsd->finance_start_date." to ".$ofsd ->finance_end_date;?> </td>
						<?php $classinfo = $this->allFormModel->classDetailsbyId($row1->class_id);?>
							<td class="text-center"><?php echo $classinfo['stream'];?></td>
							<td class="text-center"><?php echo $classinfo['class']."-".$classinfo['section'];?></td>
							<td class="text-center"><?php echo $row1->fee_head_name;?></td>
							<td class="text-center"><input type="text" id ="famount<?php echo $i;?>" value="<?php echo $row1->fee_head_amount;?>" /></td>
							<td><?php $cfsd = $this->allFormModel->getfsddetails($this->session->userdata("school_code"))->row(); echo $cfsd->finance_start_date." to ".$cfsd->finance_end_date; ?></td>
							<td><button class ="btn btn-purple" id="update<?php echo $i;?>"> Update</button></td>
						</tr>
						<?php  $i++; endforeach;}?>
					 </tbody>
			</table>
			</div>	
			
		<?php 
	}
	
	function presenti(){

	$data['sec'] = $this->input->post("sectionid");
		//$sec = $this->input->post("sectionid");
		$data['cla']  = $this->input->post("classv");
		$cla = $this->input->post("classv");
		$cfsd = $this->input->post("cfsd");
		$this->db->where("fsd",$cfsd);
		$this->db->where("class_id",$cla);
		$this->db->where("status",1);
		$data['check'] = $this->db->get("student_info");
		$data['cfsd']=$cfsd;
		$this->load->view("ajax/classPromotion",$data);
	}
	
	function allStudentClassPromotion(){
			$cla = $this->input->post("classv");
			$fsd = $this->input->post("cfsd");
		
			$this->db->where("class_id",$cla);
			$this->db->where("status",1);
			$this->db->where("fsd",$fsd);
			$studata= $this->db->get("student_info");
			if($studata->num_rows()>0){
				$data['cfsd']	= $fsd;
			    $data['cla']  = $this->input->post("classv");
			    $data['check'] =$studata;
			    	$this->load->view("ajax/allStudentClassPromotion",$data);
			}else{
			     ?>
				   <script>alert("You can not promote this student because this student is already present in current fsd")</script>
				  <?php
			   // 	$this->load->view("allStudentClassPromotion");
			   redirect('login/allStudentClassPromotion','refresh');
			   //$this->load->view("allStudentClassPromotion");
	}

	
	}
	
	function presenti12(){
		$data['sec'] = $this->input->post("section");
		$sec = $this->input->post("section");
		$data['cla']  = $this->input->post("classv");
		$cla = $this->input->post("classv");
		
		$this->load->view("ajax/classPromotionList",$data);
	}

	function getpramoteClass()
	{
		$streamid = $this->input->post("streamid");
		$sectionid = $this->input->post("sectionid");
		//print_r($streamid);
		//$stream = $this->input->post("stream");
		$this->load->model('teacherModel');
		$query = $this->teacherModel->pramotiongetclass($sectionid,$streamid);
		if($query->num_rows()>0)
		{
			echo   '<option value="">Select Class</option>';
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
				
	   function getSection(){
		$tid = $this->input->post("classv");
		$this->load->model("teacherModel");
		$var = $this->teacherModel->getSection($tid);
			if($var->num_rows() > 0){
			    
				echo '<option value="">-Select Section-</option>';
				foreach ($var->result() as $row){
				    $this->db->where('id',$row->stream);
				     $this->db->where("school_code",$this->session->userdata("school_code"));
	            	$req = $this->db->get("stream")->row()->stream;
					echo '<option value="'.$req->id.'">'.$req->section.'</option>';
				} 
				echo '<option value="all">All</option>';
			}
	    }
	    
	    
		function getSubject(){
			$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("class_id",$this->input->post("classv"));
		$this->db->where("section",$this->input->post("section"));
		$var = $this->db->get("subject");
			if($var->num_rows() > 0){
				echo '<option value="">-Select Subject-</option>';
				foreach ($var->result() as $row){
					echo '<option value="'.$row->subject.'">'.$row->subject.'</option>';
				} 
				echo '<option value="all">All</option>';
			}
		}
	
	function getpromoteSection()
	{

		$streamid = $this->input->post("streamid");
		$this->load->model('configureClassModel');
		$query = $this->teacherModel->pramotiongetsection($streamid);
	    	echo '<option value="">Select Subject Section</option>';
			foreach ($query->result() as $row){
				 
                           $this->db->where('id',$row->section);
				 	       $row2=$this->db->get('class_section')->row();

                          ?>
					<option value="<?php echo $row2->id; ?>" ><?php echo $row2->section; ?></option>
				<?php 
			}
	}
	
function pramoteClass(){
		$student_id = $this->input->post("student_id");
		$changeClass = $this->input->post("changeClass");
		$cfsd = $this->input->post("cfsd");
		$pfsd = $this->input->post("pfsd");
		$this->db->where("fsd",$cfsd);
		$this->db->where("status",1);
		$this->db->where("id",$student_id);
		$checkcurrent = $this->db->get("student_info");
		if($checkcurrent->num_rows()>0){
			$this->db->where("fsd",$pfsd);
			$this->db->where("status",1);
			$this->db->where("id",$student_id);
			$checkold = $this->db->get("student_info");
			if($checkold->num_rows()<1){
				$dataup["fsd"] 		= $pfsd;
				$dataup["class_id"] 	= $changeClass;
				$this->db->where("status",1);
				$this->db->where("id",$student_id);
				$this->db->update("student_info",$dataup);
				
				$datastudent["fsd"] 	= $cfsd;
				$datastudent["student_id"] 	=  $student_id ;
				$datastudent["class_id"] 	=  $checkcurrent->row()->class_id;
				$datastudent['date']=date("y-m-d");
				$data=	$this->db->insert("old_student_info",$datastudent);
				echo "Promoted";
				?><script>alert("successfully Promoted")</script><?php
			}else{
				?> <script>alert("You can not promote this student because this student is already present in current fsd ")</script>
			<?php }	
		}else{?>
			<script>alert("Wrong Details are give Please check. ")</script>
		<?php }
}		
		
				
				function pramoteAllStudent(){
					$changeClass = $this->input->post("changeClass");
					$classv = $this->input->post("classv");
					$cfsd = $this->input->post("cfsd");
					$pfsd = $this->input->post("pfsd");
					$this->db->where('class_id',$classv);
				
					$this->db->where("fsd",$cfsd);
					$studata=$this->db->get("student_info");
					if(($studata->num_rows())>0)
					{
					foreach($studata->result() as $sdata){
						
						$this->db->where("fsd",$pfsd);
						$this->db->where("status",1);
						$this->db->where("id",$sdata->id);
						$checkold = $this->db->get("student_info");
						if($checkold->num_rows()<1){
							  $datastudent["fsd"] 	= $sdata->fsd;
							  $datastudent["student_id"] 	=  $sdata->id;
							  $datastudent["class_id"] 	=  $sdata->class_id;
							  $datastudent['date']=date("y-m-d");
							  $data=$this->db->insert("old_student_info",$datastudent);
							  
								$dataup['class_id'] = $changeClass;
								$dataup['fsd'] = $pfsd;
								$this->db->where("status",1);
								$this->db->where("id",$sdata->id);
								$this->db->update("student_info",$dataup);
								echo "SuccessFully Promoted";
							}else{
								 ?>
							 
							<?php
								}	
						}
						if($data)
						{
					 ?>
						<script>alert("successfully Promoted")</script>
						<?php
						}
					}
					else{
						    ?>
							 <script>alert("You can not promote this student because this student is already present in current fsd")</script>
							<?php
						}
					}

}
?>