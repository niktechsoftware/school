<?php
class noticeModel extends CI_Model{
	function getNotice(){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$req = $this->db->get("notice");
		return $req;
	}
	
	function updateNotice($data,$id){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("id",$id);
		$req = $this->db->update("notice",$data);
		return $req;
	}
	
	function insertNotice($insertData){
		$req = $this->db->insert("notice",$insertData);
		return $req;
	}
	
	
}