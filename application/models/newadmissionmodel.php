<?php class NewAdmissionModel extends CI_Model{
	
	
	public function addInfo($datastudent){
		$query = $this->db->insert("student_info", $datastudent);
		return $query;
	}
	
	public function addInfo1($dataparent){
		$query = $this->db->insert("guardian_info", $dataparent);
		return $query;
	}
	public function addInfo2($datapreschool){
		$query = $this->db->insert("previusSchoolInfo", $datapreschool);
		return $query;
	}
	
	public function updateInfo($datastudent,$id){
		$val = array(
				"stream" => $streamName,
				"school_code"=>$this->session->userdata("school_code")
		);
		$this->db->where("id",$streamId);
		$query = $this->db->update("stream",$val);
		return $query;
	}
	public function getSection($streamid){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("id",$streamid);
		$row1=$this->db->get("class_section")->row();
		return $row1;

	}
	public function getClass($sectionid){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("id",$streamid);
		$row2=$this->db->get("class_info")->row();
		return $row2;

	}
	
	public function deleteInfo($streamId){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("id",$streamId);
		$query = $this->db->delete("stream");
		return $query;
	}
	
	//---------------------------------------- Add Section code Start Here ------------------------------------
	
	
	
	
}
?>
