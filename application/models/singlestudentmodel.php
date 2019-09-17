<?php
class singleStudentModel extends CI_Model{
	
	function getStudentName($id){
		$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("student_id",$id);
	$query=$student = $this->db->get("student_info");
	return $query;
	}
	
	function getStudentFatherName($id){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("student_id",$id);
		$query=$student = $this->db->get("guardian_info");
		return $query;
	}
	
	function getStudentFeeDetail($id){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("student_id",$id);
		$query=$student = $this->db->get("fee_deposit");
		return $query;
	}
	
	function getStuReport($edate,$sdate,$stu_id){
		$school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT * FROM attendance WHERE school_code='$school_code' AND stu_id='$stu_id' AND  a_date >= '$sdate' and a_date <='$edate'");
		return $query;
	}
	
	function getStuLeave($v){
		    $this->db->where("username",$v);
			$dt=$this->db->get("student_info")->row();
			$sid=$dt->fsd;
			$this->db->where("id",$sid);
			$dtf=$this->db->get("fsd")->row();
			$school_code=$dtf->school_code;

		$this->db->where("school_code",$school_code);
		$this->db->where("stu_id",$dt->id);
		$query= $this->db->get("stu_leave");
		return $query;
	}
	
	function insertLeave($data){
		$query=	$this->db->insert("stu_leave",$data);
		return true;
	}
	function getclassAndStu($stu_id){
$snm=$this->session->userdata('username');
			$this->db->where("username",$snm);
			$dt=$this->db->get("student_info")->row();
			$sid=$dt->fsd;
			$this->db->where("id",$sid);
			$dtf=$this->db->get("fsd")->row();
			$school_code=$dtf->school_code;
		//$this->db->where("school_code",$school_code);
		$this->db->where("username",$stu_id);
		$query= $this->db->get("student_info")->row();
		return $query;
	}
	function getTimeTable($class){
		$snm=$this->session->userdata('username');
			$this->db->where("username",$snm);
			$dt=$this->db->get("student_info")->row();
			$sid=$dt->fsd;
			$this->db->where("id",$sid);
			$dtf=$this->db->get("fsd")->row();
			$school_code=$dtf->school_code;
		
		//$this->db->where("school_code",$school_code);
		$this->db->where("class_id",$class);
		$query=$this->db->get("time_table");
		return $query;
		}
		function getteacherName($eid){
			$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("id",$eid);
			$query= $this->db->get("employee_info");
			return $query;
		}
	
}