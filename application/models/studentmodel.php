<?php
class StudentModel extends CI_Model{
	function studentList(){
		$school_code = $this->session->userdata("school_code");
	    $this->db->select('*');
	    $this->db->select('student_info.id as stuid');
	    $this->db->from('student_info');
	    $this->db->join('class_info','class_info.id=student_info.class_id');
	    $this->db->where("class_info.school_code",$school_code);
	    $this->db->where("student_info.status",1);
	    $result=$this->db->get();
		return $result;
	}
	// function studentguardianList(){
	// 	$school_code = $this->session->userdata("school_code");
	//     $this->db->select('*');
	//     $this->db->from('student_info');
	//     $this->db->join('guardian_info','guardian_info.student_id=student_info.id');
	//     $this->db->where("guardian_info.school_code",$school_code);
	//     $this->db->where("student_info.status",1);
	//     $query=$this->db->get()->row();
	// 	return $query;
	// }
	function getStudentDetail($studentId1){
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		//$this->db->where("status",1);
		$this->db->where("id",$studentId1);
		$result = $this->db->get("student_info");
		return $result;
		
	
	}

	function getGurdianDetail($student_id){
		
		
		$this->db->where("student_id",$student_id);
		//echo $student_id;

		return $this->db->get("guardian_info");
	} 
	
	function updateStudentInfo($datastudent,$studentid){
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("id",$studentid);
		$this->db->update("student_info",$datastudent); 
		return true;
	}

	function getSubjectByClassSection($classname)
	{
		$this->db->where("class_id",$classname);
		$id=$this->db->get('subject');
		return $id;
	}
	
	function updateGurdianInfo($dataparent,$studentid){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("student_id",$studentid);
		$this->db->update("guardian_info",$dataparent);
		return true;
	}
	function getOldStudentDetail($studentId,$fsd){
		$this->db->where("fsd",$fsd);
		$this->db->where("student_id",$studentId);
	
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		//$this->db->where("status",1);
		$result = $this->db->get("old_student_info");
		return $result;
	}
	
		function dobStudentList($school_code){
		  
		    $da = date("Y-m-d");
	$datem = date("m",strtotime($da));
		$dated = date("d",strtotime($da));
	    $this->db->select('username,mobile,name');
	    $this->db->from('student_info');
	    $this->db->join('class_info','class_info.id=student_info.class_id');
	    $this->db->where("class_info.school_code",$school_code);
	    $this->db->where("student_info.status",1);
	    $this->db->where('MONTH(student_info.dob)',$datem);
	     $this->db->where('DAY(student_info.dob)',$dated);
	    $result=$this->db->get();
		return $result;
	}
	
}