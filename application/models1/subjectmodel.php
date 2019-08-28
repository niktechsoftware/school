<?php
class SubjectModel extends CI_Model{
	function getSubject($classid){
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("class_id",$classid);
		
		$result = $this->db->get("subject");
		return $result;
	}
	
	function getSubjectByClassSection($classid){
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("class_id",$classid);
		//$this->db->where("section",$section);
		$result = $this->db->get("subject");
		return $result;
	}
	
	function addSubject($data){
		$result = $this->db->insert("subject",$data);
		return $result;
	}
	
	function updateSubject($data,$id){
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("id",$id);
		$result = $this->db->update("subject",$data);
		return $result;
	}
	
	function deleteSubject($id){
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("id",$id);
		$result = $this->db->delete("subject");
		return $result;
	}

	
	function isStudentSubject($classid){
	//	$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("class_id",$classid);
		$result = $this->db->get("subject");
		return $result;
	}

	
	// function isStudentSubject($studentId){
	// 	$this->db->where("school_code",$this->session->userdata("school_code"));
	// 	$this->db->where("student_id",$studentId);
	// 	$result = $this->db->get("students_subject");
	// 	return $result;
	// }

 	public function getStream()
 	{ 		
 		$sc = $this->session->userdata('school_code');
       $query = $this->db->query("SELECT DISTINCT stream from class_info where school_code = $sc ORDER BY id");
 		return $query;
 	}

// 	// function isStudentSubject($studentId){
// 	// 	$this->db->where("school_code",$this->session->userdata("school_code"));
// 	// 	$this->db->where("student_id",$studentId);
// 	// 	$result = $this->db->get("students_subject");
// 	// 	return $result;
// 	// }
	
}