<?php
class attendancemodel extends CI_Model{
	function getschoolAttendance($edate,$sec,$cla,$sdate){
		$school_code = $this->session->userdata("school_code");
		$queryString = "SELECT school_attendance.date,teacher_id FROM school_attendance WHERE class='$cla' AND section='$sec'  AND school_attendance.date >= '$sdate' and school_attendance.date <='$edate' AND school_code='$school_code'";
		echo $queryString;
		$query = $this->db->query($queryString);
		return $query;
	}
	function insertSchoolAttendance($data){
		$query = $this->db->insert("school_attendance",$data);
		return $query;
	}
}

