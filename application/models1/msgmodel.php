<?php
class msgModel extends CI_Model{
    
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
	
	public function delNotice($id){
		$school_code = $this->session->userdata("school_code");
		$query = $this->db->query("DELETE FROM notice WHERE id = '$id' AND school_code='$school_code'");
		return true;
	}
	function getdetail($id){

		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("id",$id);
		$query = $this->db->get("notice");
		return $query;
	}
	function sendSms($data){
		$query = $this->db->insert("message",$data);
		return $query;
	}
}