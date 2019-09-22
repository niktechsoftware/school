<?php
class singleTeacherModel extends CI_Model{
	function getTeacherLeave($v){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("emp_id",$v);
		$this->db->order_by("id","Asc");
		$query= $this->db->get("emp_leave");
		return $query;
	}
	function insertLeave($data){
		$query=	$this->db->insert("emp_leave",$data);
		return true;
	}
	
	function time_Table($teacher_id){
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where('username',$teacher_id);
		$emp=$this->db->get('employee_info')->row();
		$emp_id= $emp->id;
		$this->db->where("teacher",$emp_id);
		$tdata = $this->db->get("time_table");

		// $this->db->where("id",$dt->time_thead_id);
		$query = $this->db->get("period");

		
return $arr= array('pr' => $query,
							'tt' => $tdata);
	}
	function getTeacherDetail($teacherID){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("status",1);
		$this->db->where("id",$teacherID);
		$query= $this->db->get("employee_info");
		return $query;
	}
	
}