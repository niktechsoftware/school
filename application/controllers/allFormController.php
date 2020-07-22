<?php
class AllFormController extends CI_Controller{
    
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
    
    
	function getCity(){
		$state = $this->input->post("state");
		$this->load->model("allFormModel");
		$result = $this->allFormModel->getCity($state);
		
			echo '<option value="">-City-</option>';
		foreach ($result->result() as $row):
			echo '<option value="'.$row->city.'">'.$row->city.'</option>';
		endforeach;
	}
	
	function getArea(){
		$state = $this->input->post("state");
		$city = $this->input->post("city");
		$this->load->model("allFormModel");
		$result = $this->allFormModel->getArea($state,$city);
	
		echo '<option value="">-Area-</option>';
		foreach ($result->result() as $row):
		echo '<option value="'.$row->area.'">'.$row->area.'</option>';
		endforeach;
	}
	
	function getPin(){
		$state = $this->input->post("state");
		$city = $this->input->post("city");
		$area = $this->input->post("area");
		$this->load->model("allFormModel");
		$result = $this->allFormModel->getPin($state,$city,$area);
		
		foreach ($result->result() as $row):
		echo $row->pin;
		endforeach;
	}
	
	function getSectionByclass(){
		$className = $this->input->post("className");
		
		$this->load->model("allFormModel");
		$result = $this->allFormModel->getSectionByClass($className)->result();
			echo "<option value=''>Select Section</option>";
		foreach($result as $section):
			echo "<option value='".$section->section."'>".$section->section."</option>";
		endforeach;
	}
	
	function getSubject(){
		$data['className'] = $this->input->post("className");
		$data['section'] = $this->input->post("section");
		$data['stream'] = $this->input->post("stream");
		$this->load->view("ajax/getAdmissionSubject",$data);
	}

    function updatefsd(){
		$fsdid=$this->input->post('fsdid');
		$this->load->model("allFormModel");
		$updatefsd=$this->allFormModel->updatefsd($fsdid);
		if($updatefsd)
		{ 
        $this->session->unset_userdata();
		$this->session->sess_destroy();
	
	     //redirect(base_url()."index.php/homeController/login_check",'refresh');	
		 redirect('index.php/homeController');
		}
  //       $data['title'] = $this->session->userdata("name");
		// $this->session->set_userdata('is_lock', false);
		// $this->load->view("lockPage", $data); 

	}
	function deleteFsd(){
		$fsdid=$this->input->post('id');
		$this->db->where("fsd",$fsdid);
		$studentfsdd = $this->db->get("student_info");
		$this->db->where("finance_start_date",$fsdid);
		$fee_depositedetails = $this->db->get("fee_deposit");
		if($this->session->userdata("fsd")==$fsdid)
		{
			echo "You Can Not Delete Current Fsd.";
		}else{
			if(($studentfsdd->num_rows()>0) || ($fee_depositedetails->num_rows()>0)){
				$otp = rand(5555,5555);
				
				$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
				if($sender->num_rows()>0){
					$sende_Detail =$sender->row();
					$otp = rand(55555,99999);
					$mobilen = $this->session->userdata('mobile_number');
					$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
					$master_id=$max_id->maxid+1;
					$sms = "For Delete Fsd one Time Password is ".$otp." make sure all data of past selected fsd will be removed after fill this OTP. if you are not please change password as soon as possible.";
					$getv=  mysms($sende_Detail->auth_key,$sms,$sende_Detail->sender_id,$mobilen);
					$this->smsmodel->sentmasterRecord($sms,1,$master_id,$getv);
					echo "Please fill OTP For delete FSD";
				}
			}else{
				$this->db->where("id",$fsdid);
				if($this->db->delete("fsd")){
					echo "Deleted Successfully";
				}
			}
		}	
		}
			


function getpickup(){
		$vnum = $this->input->post("tnum");
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("v_id",$vnum);
		$rty = $this->db->get("transport_root_amount");
		echo "<option value=''>Select Pickup Ponts</option>";
		if($rty->num_rows()>0){
			foreach($rty->result() as $row):?>
			<option value="<?php echo $row->id;?>"><?php echo $row->pickup_points;?></option>
			<?php endforeach;
		}
	}
	
	function getpickupAmount(){
		$pickp = $this->input->post("pickupAmount");
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("id",$pickp);
		$rty = $this->db->get("transport_root_amount");
	
		if($rty->num_rows()>0)
		{
		    $rty=$rty->row();
			 echo $rty->transport_fee;
			
		}
	}
}