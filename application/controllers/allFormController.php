<?php
class AllFormController extends CI_Controller{
    
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
		?><script> window.location.reload();</script>
		<?php 
		redirect(base_url()."index.php/homeController/login_check",'refresh');	
		// redirect('index.php/homeController');
		}
  //       $data['title'] = $this->session->userdata("name");
		// $this->session->set_userdata('is_lock', false);
		// $this->load->view("lockPage", $data); 

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