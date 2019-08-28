<?php
class periodModel extends CI_Model{
	
function insertperiod($data)
{ 
	$query1 = $this->db->insert("period",$data);
	return $query1;
}

function getPeriodD($period_name)
{
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("nop_id",$period_name);
	$query1 = $this->db->get("period");
	return $query1;
}

function getperiodno(){
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$query1 = $this->db->get("no_of_period");
	return $query1;
}

function getClass()
{$this->db->where("school_code",$this->session->userdata("school_code"));
	$query1 = $this->db->get("class_info");
	return $query1;
}

function getTeacherName(){
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("status","1");
	$this->db->where("job_category","3");
	$query1 = $this->db->get("employee_info");
	return $query1;
}

function getSubjectName($data)
{	//$this->db->where("school_code",$this->session->userdata("school_code"));
$this->db->where("class_id",$data);
//$this->db->where("section",$data['section']);

$query1 = $this->db->get("subject");
return $query1;
}
function periodSchedule($data)
{
$query1 = $this->db->insert("time_table",$data);
return $query1;
}

	function uniqueClass($period)
	{$school_code = $this->session->userdata("school_code");
		$var = $this->db->query("SELECT DISTINCT class_id FROM time_table Where school_code='$school_code' and time_thead_id='$period'");
		return $var;
	}
	
	function uniquePeriod($period)
	{$school_code = $this->session->userdata("school_code");
		$var = $this->db->query("SELECT DISTINCT period_id FROM time_table WHERE school_code='$school_code' and time_thead_id='$period'");
		return $var;
	}
	
	function checkvalue($data,$time_thead_id)
	{	$school_code = $this->session->userdata("school_code");
	    $query = $this->db->query("SELECT * FROM time_table WHERE school_code='$school_code' and time_thead_id='$time_thead_id' AND day LIKE '%$data%'");
		return $query;
	}
	
	function deldaywise($data,$time_thead_id)
	{	$school_code = $this->session->userdata("school_code");
		$query = $this->db->query("DELETE FROM time_table WHERE school_code='$school_code' and time_thead_id='$time_thead_id' AND day LIKE '%$data%'");
		return $query;
	}

}
?>