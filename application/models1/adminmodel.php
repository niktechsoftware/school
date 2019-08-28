<?php
class Adminmodel extends CI_Model{
	function adminDetail(){
		$this->db->where("id",$this->session->userdata("school_code"));
		$result = $this->db->get("school");
		return $result;
	}
	
	function updateAdminProfile($data){
		$this->db->where("id",$this->session->userdata("school_code"));
		if($this->db->update("school",$data)){
			return true;
		}
		else{
			return false;
		}
	}
	
		function updateAdminPassword($data){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		if($this->db->update("general_settings",$data)){
			return true;
		}
		else{
			return false;
		}
	}
}