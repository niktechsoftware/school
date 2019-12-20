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
	
	{ 
	   if($this->session->userdata("login_type") =="admin"){
	        $var = $this->db->query("SELECT DISTINCT class_id FROM time_table Where time_thead_id='$period'");
	   
	       }else{
	            $tid= $this->session->userdata("id");
	
	        	$var = $this->db->query("SELECT DISTINCT class_id FROM time_table Where time_thead_id='$period' and teacher=$tid");
	 
	     	
	   }
		return $var;
	}
	
	function uniquePeriod($period)
	{    
	   if($this->session->userdata("login_type") =="admin" ){
	       	  $var = $this->db->query("SELECT DISTINCT period_id FROM time_table WHERE  time_thead_id='$period' ");
	 
	       }else{
	            $tid= $this->session->userdata("id");
	        	$var = $this->db->query("SELECT DISTINCT period_id FROM time_table WHERE  time_thead_id='$period' and teacher=$tid");
	       }
		return $var;
	    
	}
	
	function checkvalue($data,$time_thead_id)

	{	$data = str_replace(',','',$data);
	    $query = $this->db->query("SELECT * FROM time_table,time_table_days WHERE time_table.time_thead_id=time_table_days.time_table_id and days_id='$data'");

		return $query;
	}
	
	function deldaywise($data,$time_thead_id)
	{	
		$query = $this->db->query("DELETE FROM time_table WHERE time_thead_id='$time_thead_id'");
		return $query;
	}



function checkdaystb($day,$tbid){
	$this->db->where("time_table_id",$tbid);
			$this->db->where("days_id",$day);
		$ttd = $this->db->get("time_table_days");
		if($ttd->num_rows()>0){

		}else{
			$dayentry  = array(
				"days_id"=>$day,
				"time_table_id"=>$tbid
			);
			$this->db->insert("time_table_days",$dayentry);
		}
		return true;
}
}
?>