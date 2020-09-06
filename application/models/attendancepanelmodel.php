<?php
class Attendancepanelmodel extends CI_Model{
	public function categorywiseemp($emp){
		$school_code = $this->session->userdata('school_code');
			if($emp == 'accountant'){
				$ss= $this->db->query("select `emp_id`, count(*) as totalCount FROM `teacher_attendance` where `attendance`!=0 AND `school_code` = '$school_code' GROUP BY `emp_id`, `attendance` ORDER BY COUNT(*) DESC ");
				return $ss;
			}
			else if($emp == 'teacher'){
				$ss= $this->db->query("select `emp_id`, count(*) as totalCount FROM `teacher_attendance` where `attendance`!=0 AND `school_code` = '$school_code' GROUP BY `emp_id`, `attendance` ORDER BY COUNT(*) DESC ");
				return $ss;
			}
			else if($emp == 'employee'){
				$ss= $this->db->query("select `emp_id`, count(*) as totalCount FROM `teacher_attendance` where `attendance`!=0 AND `school_code` = '$school_code' GROUP BY `emp_id`, `attendance` ORDER BY COUNT(*) DESC ");
				return $ss;
			}
			else {
				$ss= $this->db->query("select `emp_id`, count(*) as totalCount FROM `teacher_attendance` where `attendance`!=0 AND `school_code` = '$school_code' GROUP BY `emp_id`, `attendance` ORDER BY COUNT(*) DESC ");
				return $ss;
			}
			
	}
	public function teacheratt($empusername){
		$this->db->where('username',$empusername);
		$this->db->where('school_code',$this->session->userdata('school_code'));
		$query = $this->db->get('employee_info');
		return $query;
	}
}
?>