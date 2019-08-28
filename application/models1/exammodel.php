<?php class examModel extends CI_Model{
	
public function getExamInfo($data)
{ $this->db->where("school_code",$this->session->userdata("school_code"));
	$query1 = $this->db->get("period");
	return true;
}

function getPeriodD()
{$this->db->where("school_code",$this->session->userdata("school_code"));
	$query1 = $this->db->get("period");
	return $query1;
}

function getExamName()
{
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$query1 = $this->db->get("exam_name");
	return $query1;
}
function insertexam($data)
{
	$query1 = $this->db->insert("exam_name",$data);
	return $query1;
}
function updateexam($examid,$date)
{
	
    $date= array(
    'exam_date' =>$date, 
    );
   $this->db->where("school_code",$this->session->userdata("school_code"));   
    $this->db->where("id",$examid);
	$query1 = $this->db->update("exam_name",$date);
	return $query1;
}
function gateDate1($data)
{$this->db->where("school_code",$this->session->userdata("school_code"));   
$this->db->where("exam_name",$data);
$query1 = $this->db->get("exam_name");
return $query1;
}
function ensertdays1($data)
{   
	$query1 = $this->db->insert("exam_day",$data);
	return $query1;

}
function ensertshift($data)
{  
	$query1 = $this->db->insert("exam_shift",$data);
	return $query1;
}

function updatedays1($data){
$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("exam_name",$data['exam_name']);
	$this->db->where("start_date",$data['start_date']);
	$query1 = $this->db->update("exam_day",$data);
	return $query1;

}
function updateshift($data)
{ 	
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("exam_name",$data['exam_name']);
	$this->db->where("start_date",$data['start_date']);
	$query1 = $this->db->update("exam_shift",$data);
	return $query1;
}


function getshift($exam_name,$edate)
{ 	$this->db->where("school_code",$this->session->userdata("school_code"));
$this->db->where("exam_name",$exam_name);
	$this->db->where("start_date",$edate);
	$query1 = $this->db->get("exam_shift");
	return $query1;
}
function getshift1($examid)
{ 	$this->db->where("exam_id",$examid);
$query1 = $this->db->get("exam_shift");
return $query1;
}
function getday($exam_name,$edate)
{ 	$this->db->where("school_code",$this->session->userdata("school_code"));
$this->db->where("exam_name",$exam_name);
$this->db->where("start_date",$edate);
$query1 = $this->db->get("exam_day");
return $query1;
}
function insertExamData($data)
{
	$query1 = $this->db->insert("exam_time_table",$data);
	return $query1;
}
function checkExam($exam_name,$edate)
{$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("exam_name",$exam_name);
$this->db->where("start_date",$edate);
$query1 = $this->db->get("exam_day");
return $query1;
}

	function getExamDetail($examName,$edate){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("exam_name",$examName);
		$this->db->where("start_date",$edate);
		$query1 = $this->db->get("exam_day");
		return $query1;
	}
	function getExamDetail1($examName,$edate){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("exam_name",$examName);
		$this->db->where("start_date",$edate);
		$query1 = $this->db->get("exam_shift");
		return $query1;
	}
	
	
	function getExamMarks($data){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$val=$this->db->get("general_settings")->row();
		$fsd = $val->fsd_id;
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("fsd",$fsd);
		$this->db->where("exam_id",$data['exam_id']);
		$this->db->where("class_id",$data['class_id']);
		$this->db->where("subject_id",$data['subject_id']);
		$query1 = $this->db->get("exam_info");
		return $query1;
	}
	
	function checkoldExam($student_id,$oldfsd){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("stu_id",$student_id);
		$this->db->where("fsd",$oldfsd);
		$cat = $this->db->get("oldexam_info");
		return $cat;
	}
	
	function checkpresentExam($student_id,$oldfsd){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("stu_id",$student_id);
		$this->db->where("fsd",$oldfsd);
		$cat = $this->db->get("exam_info");
		return $cat;
	}

}
?>