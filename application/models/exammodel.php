<?php class examModel extends CI_Model{
	

	
public function getExamInfo($data)
{ $this->db->where("school_code",$this->session->userdata("school_code"));
	$query1 = $this->db->get("period");
	return true;
}
function getClassRank($rowstudent,$classid,$fsd){
       $rankarray=array();
         $rankarray1=array();
       $class_id =$classid;
       $this->db->distinct();
       $this->db->select("stu_id");
       $this->db->where("class_id",$classid);
       $this->db->order_by("stu_id","ASC");
       $totstu=    $this->db->get("exam_info");
       if($totstu->num_rows()>0){
      $d2h =0.01; foreach($totstu->result() as $ts):
       $totmarks =     $this->db->query("select sum(marks) as getmarks from exam_info where out_of >0 and stu_id ='".$ts->stu_id."' and fsd = '".$fsd."'")->row();
       $tota = $totmarks->getmarks+$d2h;
       $rankarray[$ts->stu_id]=$tota;
        $rankarray1[$ts->stu_id]=$tota;

        $d2h=$d2h+0.01;
     endforeach;
       
       // print_r($rankarray);
      //krsort($rankarray);
      arsort($rankarray);
     // print_r($rankarray);
       $key = array_search($rankarray1[$rowstudent], $rankarray);
       $offset = array_search($key, array_keys($rankarray));
       return $offset+1;
       }
   }
/*function getClassRank($rowstudent,$classid,$fsd){
      $rankarray=array();
         $rankarray1=array();
		 $arrayq=array();
       $class_id =$classid;
       $this->db->distinct();
       $this->db->select("stu_id");
       $this->db->where("class_id",$classid);
       $this->db->order_by("stu_id","ASC");
       $totstu=    $this->db->get("exam_info");
       if($totstu->num_rows()>0){
		foreach($totstu->result() as $ts):
		$this->db->select_sum('marks','getmarks' );
		$this->db->select('stu_id' );
		$this->db->where('stu_id',$ts->stu_id);
		$this->db->where('fsd',$fsd);
		$xs = $this->db->get('exam_info')->row();
		$arrayq[] = $xs->getmarks;
		endforeach;
		arsort($arrayq);
		$i=0;
	  foreach ($arrayq as $k => $vall ) 
	 { "Key=" . $k . ", Value=" . $vall;
			 $i."<br>";
			$i++;
			$rankarray[$i]=$vall;
			$rankarray1[$i]=$vall;
	 }
      // print_r($rankarray);
     return $rankarray;
       }
   }*/
   function getSchoolRank($rowstudent,$fsd){
       $rankarray=array();
        $rankarray1=array();
       $this->db->distinct();
       $this->db->select("stu_id");
       $totstu=    $this->db->get("exam_info");
       if($totstu->num_rows()>0){
       $d2h =0.001; foreach($totstu->result() as $ts):
       $totmarks =     $this->db->query("select sum(marks) as getmarks from exam_info where stu_id = '$ts->stu_id' and fsd = '$fsd'")->row();
       $tota = $totmarks->getmarks+$d2h;
       $rankarray[$ts->stu_id]=$tota;
        $rankarray1[$ts->stu_id]=$tota;
        $d2h=$d2h+0.001;
       endforeach;
       krsort($rankarray);
      //print_r($rankarray);
       $key = array_search($rankarray1[$rowstudent], $rankarray);
       $offset = array_search($key, array_keys($rankarray));
       
       return $offset+1;
       }
   }
function getPeriodD()
{$this->db->where("school_code",$this->session->userdata("school_code"));
	$query1 = $this->db->get("period");
	return $query1;
}

function getExamName($fsd)
{
	$this->db->where("id",$fsd);
	$getfsdDates = $this->db->get("fsd")->row();
	$this->db->where("school_code",$this->session->userdata("school_code"));
//	$this->db->where("exam_date >=",$getfsdDates->finance_start_date);
//	$this->db->where("exam_date <=",$getfsdDates->finance_end_date);
	$query1 = $this->db->get("exam_name");
	return $query1;
}

function getExamNameForUpdate(){
	
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$query1 = $this->db->get("exam_name");
	//print_r( $query1->result());
	//exit();
	return $query1;
}
function insertexam($data)
{
	$query1 = $this->db->insert("exam_name",$data);
	return $query1;
}
function updateexam($examid,$date,$examName,$exam_mode)
{
	
    $date= array(
        'exam_name'=>$examName,
    'exam_date' =>$date,
	'exam_mode' =>$exam_mode
    );
   $this->db->where("school_code",$this->session->userdata("school_code"));   
    $this->db->where("id",$examid);
	$query1 = $this->db->update("exam_name",$date);
	return $query1;
}
function gateDate1($data)
{$this->db->where("school_code",$this->session->userdata("school_code"));   
$this->db->where("id",$data);
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
	
		$this->db->where("school_code",$data['school_code']);
		$this->db->where("fsd",$data['fsd']);
		$this->db->where("exam_id",$data['exam_id']);
		$this->db->where("class_id",$data['class_id']);
		$this->db->where("subject_id",$data['subject_id']);
		$query1 = $this->db->get("exam_info");
		//print_r($query1);
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