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
	$this->db->where("exam_date >=",$getfsdDates->finance_start_date);
	$this->db->where("exam_date <=",$getfsdDates->finance_end_date);
	$query1 = $this->db->get("exam_name");
	return $query1;
}

function getExamNameForUpdate(){
	
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$query1 = $this->db->get("exam_name");
	//print_r($query1->result());
	//exit();
	return $query1;
}
function insertexam($data)
{
	$query1 = $this->db->insert("exam_name",$data);
	return $query1;
}
function exam_mode($data)
{
	$query1 = $this->db->insert("exam_mode",$data);
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
	
		public function getClass($sectionid){
		$query = $this->db->query("SELECT * from class_info where section='$sectionid'  ORDER BY id ASC");
		return $query;
	}
	
	//-------------------------****************************-------------------------//
	//////////////////////////////////////////////////////////////////////////////////
	//-------------------------*****Online Exam*******-------------------------------//
	public function exam_name()
		{
			 $gt = $this->db->get('exam_name');
			 return $gt;
		}
		public function subject_name()
		{
			 $gt_sub = $this->db->get('subject');
			 return $gt_sub;
		}
		public function language()
		{
			$gt = $this->db->get('language');
			return $gt;
		}
		public function test_data()
		{
			// $gt_ex_nm = $this->db->get('test_data');
			// return $gt_ex_nm;
		}
	public function insert_ques($ques,$exam_subject_id,$exam_master_id,$ans,$a,$b,$c,$d,$e)
		{
			$val1 = array(
				'question'=>$ques,
				//'exam_name_id'=>$exam_name_id,
				'exam_subject_id'=>$exam_subject_id,
				'exam_master_id'=>$exam_master_id 
				);
			$in_q1 = $this->db->insert('question_master',$val1);
			if($in_q1)
			{
				$tt=$this->db->insert_id();
				$val2 = array(
					'question_master_id'=>$tt,
					'A'=>$a,
					'B'=>$b,
					'C'=>$c,
					'D'=>$d,
					'E'=>$e);
				$in_q2 = $this->db->insert('question_ans',$val2);
				if($in_q2)
				{
					$val3 = array(
						'question_master_id'=>$tt,
						'right_answer'=>$ans,
						);
					$in_q3 = $this->db->insert('right_answer',$val3);
					return $in_q3;
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return 0;
			}
		}
function delete_q($q_id)
		{
			$this->db->where('id',$q_id);
			$dlt = $this->db->delete('question_master');
			return $dlt;
		}
		function edit_q($q_id)
		{
			$this->db->where('id',$q_id);
			return $q = $this->db->get('question_master');
		}
		function ques_op($q_id)
		{
			$this->db->where('question_master_id',$q_id);
			return $op = $this->db->get('question_ans');
		}
	function insert_img_question($ques,$exam_subject_id,$exam_master_id,$qf1,$qf2,$qf3,$qf4,$af1,$af2,$af3,$af4,$af5,$ans,$op_txt1,$op_txt2,$op_txt3,$op_txt4,$op_txt5)
		{
			$val1 = array(
				'question'=>$ques,
				//'exam_name_id'=>$exam_name_id,
				'exam_subject_id'=>$exam_subject_id,
				'exam_master_id'=>$exam_master_id );
			$in_q1 = $this->db->insert('question_master',$val1);
			if($in_q1)
			{
				$tt=$this->db->insert_id();
				$val2 = array(
					'question_master_id'=>$tt,
					'A'=>$op_txt1,
					'B'=>$op_txt2,
					'C'=>$op_txt3,
					'D'=>$op_txt4,
					'E'=>$op_txt5 );
				$in_q2 = $this->db->insert('question_ans',$val2);
				if($in_q2)
				{
					$val3 = array(
						'question_master_id'=>$tt,
						'right_answer'=>$ans,
						);
					$in_q3 = $this->db->insert('right_answer',$val3);
					if($in_q3)
					{
						$val4 = array(
						'question'=>$tt,
						'q_img1'=>$qf1,
						'q_img2'=>$qf2,
						'q_img3'=>$qf3,
						'q_img4'=>$qf4,
						'q_ans_img1'=>$af1,
						'q_ans_img2'=>$af2,
						'q_ans_img3'=>$af3,
						'q_ans_img4'=>$af4,
						'q_ans_img5'=>$af5,
						'right_answer'=>$ans
						);
						return $in_q = $this->db->insert('question_images',$val4);
					}
					else
					{
						return 0;
					}
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return 0;
			}
		}
		public function select_language($lang_id)
		{
			 //echo $lang_id;
			$this->db->where('id',$lang_id);
			return $lg = $this->db->get('language')->row();
			//print_r($lg);
		}
		public function question_data($select_exam,$select_subject)
		{
			$this->db->where('exam_subject_id',$select_subject);
			//$this->db->where('exam_name_id',$select_test);
			$this->db->where('exam_master_id',$select_exam);
			$dx_q = $this->db->get('question_master');
			return $dx_q;
		}
		public function select_exam_data($exam_id,$lang_id)
		{
			$this->db->where('exam_master_id',$exam_id);
			$this->db->where('test_language_id',$lang_id);
			$this->db->group_by('exam_name');
			$st_dt = $this->db->get('exam_name');
			return $st_dt;
		}
		function update_ques($ques,$q_id,$ans,$a,$b,$c,$d,$e)
		{
			$val1 = array('question'=>$ques);
			$this->db->where('id',$q_id);
			$up_q1 = $this->db->update('question_master',$val1);
			if($up_q1)
			{
				$val2 = array(
					'A'=>$a,
					'B'=>$b,
					'C'=>$c,
					'D'=>$d,
					'E'=>$e);
				$this->db->where('question_master_id',$q_id);
				$up_q2 = $this->db->update('question_ans',$val2);
				if($up_q2)
				{
					$val3 = array('right_answer'=>$ans);
					$this->db->where('question_master_id',$q_id);
					$up_q3 = $this->db->update('right_answer',$val3);
					return $up_q3;
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return 0;
			}
		}
		
}
?>