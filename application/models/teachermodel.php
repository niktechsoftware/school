<?php
class TeacherModel extends CI_Model{
	
	function getTeacherList(){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("status",1);
		$this->db->order_by("job_category","DESC");
		$td = $this->db->get("employee_info");
		return $td;
	}
	
	function checkTeacherAtten($date1)
	{   $this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("a_date",$date1);
		$req = $this->db->get("teacher_attendance");
		return $req;
	
	}
	function getPresenti($classid){
		$this->db->where("class_id",$classid);
		//$this->db->where("section",$section);
		$this->db->where("status",1);
		$req = $this->db->get("student_info");
		return $req;
	}
	function pramotiongetsection($streamid)
	{
		$school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT DISTINCT section FROM class_info WHERE school_code='$school_code' AND id = '$streamid' order by id");
		return $query;
	}

	function getTeacherwiseList($list)
	{

			$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("status",1);
		$this->db->where("job_category",$list);
		//$this->db->order_by("job_category","DESC");
		$td = $this->db->get("employee_info");
		return $td;
	}
	
	function checkID($teacherId){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("username",$teacherId);
		$req=$this->db->get("employee_info");
		return $req;
	}
	function pramotiongetclass($sectionid,$streamid)
	{

		$school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT * from class_info where school_code='$school_code' AND section= '$sectionid' AND stream= '$streamid'  ORDER BY id");
		return $query;
	}
	
	
	function getClassBySectionFeeReport($sectionid){
		 $school_code=$this->session->userdata("school_code");
		$query = $this->db->query("SELECT * from class_info where school_code='$school_code' And section='$sectionid' ORDER BY id");
		return $query;
	}

	function getSectionTransport($classv){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("section",$classv);
		$req=$this->db->get("class_info");
		return $req;
	}
	
	function getSection($classv){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("section",$classv);
		$req=$this->db->get("class_info");
		return $req;
	}
	
	
	function getClassforattendence($sectionid){
	     $school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT * from class_info where school_code='$school_code' And section='$sectionid' ORDER BY id");
		return $query;
	}
    function getclassforexam($streamid,$sectionid){
   // echo"model";
	     $school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT * from class_info where school_code='$school_code' And section='$sectionid' And stream='$streamid' ORDER BY id");
	//	print_r($query);
		return $query;
	}
	function getSectionforexam($streamid){
	     $school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT distinct section from class_info where school_code='$school_code' And stream='$streamid' ORDER BY id");
		return $query;
	}

	function getSectionName($sectionid)
	{
		$this->db->where("school_code",$this->session->userdata("school_code"));
				 	$this->db->where('id',$sectionid);
				 	$row1=$this->db->get('class_section')->row();
				 	return $row1;

	}
	
	
	
	function addEmpAttendance($data){
		
			$query = $this->db->insert("teacher_attendance", $data);
			return $query;
	}
	function addstuAttendance($data){
		$query = $this->db->insert("attendance", $data);
		return $query;
		
	}
	
	
	function addstuAttendancea2($data){

		$query = $this->db->insert("attendance", $data);
		return $query;
	
	}
	
	function updateSchoolAttendance($school_attendance,$date1,$class1){
		
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("class_id",$class1);
	//	$this->db->where("section",$section);
		$this->db->where("date",$date1);
		$query = $this->db->update("school_attendance",$school_attendance);
	}
	
    function checkPresenti($classid,$date1){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("class_id",$classid);
		//$this->db->where("section",$sectionid);
		$this->db->where("a_date",$date1);
		$this->db->where("shift_1",1);
		$query = $this->db->get("attendance");
		return $query;
	}
	function checkPresentia2($classid,$date1){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("class_id",$classid);
		//$this->db->where("section",$sectionid);
		$this->db->where("a_date",$date1);
		$this->db->where("shift_2",1);
		$query = $this->db->get("attendance");
		return $query;
	}
/*	function checkPresentia2($sec,$cla,$date1){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("class_id",$cla);
		$this->db->where("date",$date1);
		$this->db->where("shift_2",1);
		$query = $this->db->get("school_attendance");
		return $query;
	}*/
	
	function getPramotion($sec,$cla){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("status","Active");
		$this->db->where("class_id",$cla);
		$this->db->where("section",$sec);
		$query = $this->db->get("student_info");
		return $query;
	}
	
	
	
	function getStuReport($edate,$sec,$cla,$sdate){
		$school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT DISTINCT stu_id,class FROM attendance WHERE class='$cla' AND section='$sec' AND school_code='$school_code' AND a_date >= '$sdate' and a_date <='$edate'");
		return $query;
	}
	
	
	function countAtt($edate,$sdate,$cla,$sec){
		$school_code = $this->session->userdata("school_code");
		$resultP = $this->db->query("SELECT student_id FROM student_info WHERE status = 'Active' AND class_id='$cla' AND section='$sec' AND school_code='$school_code'");
		$resultA = $this->db->query("SELECT attendance FROM attendance WHERE attendance = 'A' AND class_id='$cla' AND section='$sec' AND school_code='$school_code' AND a_date >= '$sdate' and a_date <='$edate'");
		$resultL = $this->db->query("SELECT attendance FROM attendance WHERE attendance = 'L' AND class_id='$cla' AND section='$sec' AND school_code='$school_code' AND a_date >= '$sdate' and a_date <='$edate'");
		$p = $resultP->num_rows();
		$a = $resultA->num_rows();
		$l = $resultL->num_rows();
		$res = array(
				"p" => $p,
				"a" => $a,
				"l" => $l
		);
		return $res;
	}
	function countAttTeacher($edate,$sdate,$stuID){
		$school_code = $this->session->userdata("school_code");
		$resultP = $this->db->query("SELECT attendance FROM teacher_attendance WHERE attendance = '1' AND emp_id='$stuID' AND school_code='$school_code' AND a_date >= '$sdate' and a_date <='$edate'");
		$resultA = $this->db->query("SELECT attendance FROM teacher_attendance WHERE attendance = '0' AND emp_id='$stuID' AND school_code='$school_code' AND a_date >= '$sdate' and a_date <='$edate'");
	//	$resultL = $this->db->query("SELECT attendance FROM teacher_attendance WHERE attendance = 'L' AND emp_no='$stuID' AND school_code='$school_code' AND a_date >= '$sdate' and a_date <='$edate'");
		$p = $resultP->num_rows();
		$a = $resultA->num_rows();
	//	$l = $resultL->num_rows();
		$res = array(
				"p" => $p,
				"a" => $a,
			//	"l" => $l
		);
		return $res;
	}
	
	function checkStudID($stud){
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("username",$stud);
	$req=$this->db->get("student_info");
	return $req;
	}

	// function fulldetail($studid,$fsd){

	// 	$this->db->where("school_code",$this->session->userdata("school_code"));
	// 	$this->db->where("student_id",$stud);
	// $req=$this->db->get("student_info");
	// return $req;
	// }
	
	function checkBal($stud){
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("valid_id",$stud);
		$var=$this->db->get("sale_balance");
		return $var;
	}
	
	function getteacherattenReport($edate,$sdate){
		$school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT DISTINCT emp_id FROM teacher_attendance WHERE a_date >= '$sdate' and a_date <='$edate' and school_code = '$school_code'");
		return $query;
	}
	
	
}