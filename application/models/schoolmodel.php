<?php
class schoolmodel extends CI_Model{
	
	public function schInfo($dataschool){
		$query = $this->db->insert("school",$dataschool);
		return true;
	}
	public function schInfo1($datags){
		$query = $this->db->insert("general_settings", $datags);
		return true;
	}
	public function schInfo2($datasms){
		$query = $this->db->insert("sms", $datasms);
		return true;
	}
	public function schInfo3($datasmssett){
		$query = $this->db->insert("sms_setting", $datasmssett);
		return $query;
	}
	public function schInfo4($datafsd){
		$query = $this->db->insert("fsd", $datafsd);
		return $query;
	}
}
	
