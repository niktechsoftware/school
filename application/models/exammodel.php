<?php class examModel extends CI_Model{
	
	
public function getOrgQuestion($qid){
    $this->db->where("id",$qid);
   $data_q= $this->db->get("question_master")->row();
    $sgring=$data_q->question;
    for($i=1; $i<5; $i++){
        	$word = '<='.$i.'!>';
                $this->db->where("question",$data_q->id);
					$quesImage=$this->db->get("question_images");
					if($quesImage->num_rows()>0){
					if(strpos($sgring, $word) !== false){
					    $qname = "q_img".$i;
					    if($quesImage->row()->$qname){
					$rep = '  <img src='.base_url().'assets/images/question_img/'.$quesImage->row()->$qname.' alt="Question Image" width="90" height="70">  ';
                    $sgring  =str_replace($word,$rep,$sgring);
                      } 	
					}
    }
    										
	}
	return $sgring;
}	

public function getOrgAnswer($qid,$ansno,$num){
   
    $sgring=$ansno;
   
        	$word = '<='.$num.'!>';
                $this->db->where("question",$qid);
					$quesImage=$this->db->get("question_images");
					if($quesImage->num_rows()>0){
					if(strpos($sgring, $word) !== false){
					    $qname = "q_ans_img".$num;
					    if($quesImage->row()->$qname){
					$rep = '  <img src='.base_url().'assets/images/question_img/'.$quesImage->row()->$qname.' alt="Question Image" width="50" height="40">  ';
                    $sgring  =str_replace($word,$rep,$sgring);
                      } 	
					}
    
    										
	}
	return $sgring;
}	


//create by rahul
public function getExamTimeTableChartBy($exam_id,$class_id,$school_code,$student_id,$indicator){
   // echo $class_id;
	$this->db->where("exam_id",$exam_id);
	$this->db->where("class_id",$class_id);
	$exam_day=$this->db->get("exam_time_table");
	//echo $exam_id;
	//echo $shift_id;
	$this->db->distinct();
	$this->db->select("shift_id");
	$this->db->where("exam_id",$exam_id);
	$this->db->where("class_id",$class_id);
	             	$exam_shift=$this->db->get("exam_time_table");?>
				<table id="items" align="center"  border="1" style="width:100%; margin-top:8px;color:#d80707;font-size: 15px;">
						<thead>
						    <tr>
							<th style="text-align: center; text-transform: uppercase;"><b>Date</b></th>
	                        <?php 
	
	if($exam_day->num_rows()){
	                        $this->db->where('exam_id',$exam_day->row()->exam_id);
	                        $dated=$this->db->get('exam_day')->result();
	                        foreach($dated as $ed):?>
							<th style="text-align: center; text-transform: uppercase;"><b><?php echo date("d-m-Y",strtotime($ed->date1));?></b></th>
							<?php endforeach; }?>
							</tr>
						</thead>
						<tbody>
	                        <?php
	                    
	                        foreach($exam_shift->result() as $s):
	                        $this->db->where("id",$s->shift_id);
	                       $exshift =  $this->db->get("exam_shift")->row();
	                        ?>
	                        <tr>
	
	                           <td style="text-align: center;text-transform: uppercase;"><?php 
	                             echo $exshift->shift."<br>[".$exshift->from1."] to [".$exshift->to1."]";  ?>
	                        
	                      </td>
	
	                        <?php 
	                   $school_code =$this->session->userdata("school_code");
	                        foreach($dated as $ed):
						
							$this->db->where("school_code",$this->session->userdata("school_code"));
	                        $this->db->where("exam_id",$exam_id);
	                        $this->db->where("shift_id",$s->shift_id);
	                        $this->db->where("class_id",$class_id);
	                        $this->db->where("exam_day_id",$ed->id);
							$etb = $this->db->get("exam_time_table");
							if($etb->num_rows()>0){
							    foreach($etb->result() as $ff):
							        	$etype="";
	                                 if($ff->subject_id){
	                                $this->db->where('id',$ff->subject_id);
	                                $this->db->where('class_id',$ff->class_id);
	                                 $subject=$this->db->get('subject');
	                                 
	                                  $this->db->where("exam_id",$exam_id);
	                                       $this->db->where("class_id",$class_id);
	                                      $this->db->where("subject",$ff->subject_id);
	                                      $mode = $this->db->get("exam_mode");
	                                      if($mode->num_rows()>0){
	                                          $modev = $mode->row();
	                                          if($modev->exam_mode==3){
	                                              $etype = "objective";
	                                          }
	                                          if($modev->exam_mode==2){
	                                               $etype ="subjective";
	                                          }
	                                      }
	                                      
	                                      
	                                    ?>
	                                <td style="text-align: center;text-transform: uppercase;"> <?php echo $subject->row()->subject;?><br>
	                                <?php if($etype){  
	                                    $this->db->where("id",$ff->exam_day_id);
	                                    $examDate = $this->db->get("exam_day")->row();
	                                    $datagh = " ".date("Y-m-d");
	                                    $date2 = " ".$examDate->date1;
	                                     
	                                    if($indicator==0){
	                                   if($modev->exam_mode==3){    
	                                        
	                                ?>
	                               
	                              <a href="<?php echo base_url();?>singleStudentControllers/objectivePaper/<?php echo $school_code;?>/<?php echo $ff->id;?>/<?php echo $student_id;?>">
                        	
                        		<p> Click For Start</p><span class="arrow"></span>
                        	</a>  <?php 
	                                    }else{
	                                        if($modev->exam_mode==2){ ?>
	                                            
	                              <a href="<?php echo base_url();?>examControllers/demoExamSubjective/<?php echo $student_id;?>/<?php echo $mode->row()->id;?>">
                        	
                        		<p> Click For Start</p><span class="arrow"></span>
                        	</a>   
	                                     <?php   }else{
	                                            echo "OffLine Paper";
	                                        }
	                                        }}else{
	                                     
	                                    if($date2 == $datagh){
	                                         $ctimee= date("H:i:s");
                                                if(($ctimee >= $exshift->from1) && ($ctimee <= $exshift->to1)){
	                                       // echo $student_id;
	                                        if($student_id>0){
	                                             if($modev->exam_mode==3){ 
	                                ?>
	                               
	                              <a href="<?php echo base_url();?>singleStudentControllers/objectivePaper/<?php echo $school_code;?>/<?php echo $ff->id;?>/<?php echo $student_id;?>">
                        	
                        		<p> Click For Start</p><span class="arrow"></span>
                        	</a>  <?php 
	                                        }else{ if($modev->exam_mode==2){ ?>
	                                            <a href="<?php echo base_url();?>examControllers/demoExamSubjective/<?php echo $student_id;?>/<?php echo $mode->row()->id;?>">
	                                                	<p> Click For Start</p><span class="arrow"></span>
                        	</a> 
	                                         <?php    
	                                        }else{
	                                            echo "OffLine Paper";
	                                        }
                        	    
                        	}}
                        	
                        	}}}}?>
	                                </td>
	                                
								<?php 
	                                     
	                                     
	                                 }else{?> <td> </td> <?php }
							endforeach;?>
	                        <?php }else{ ?>
	                            <td>-</td>
	                            <?php } endforeach;?>
							</tr>
						<?php endforeach;?>
						</tbody>
				
	            </table><?php 
}


public function getExamTimeNoticebySchool($exam_id,$class_id,$school_code){
	$this->db->distinct();
	$this->db->where("exam_id",$exam_id);
	$this->db->where("class_id",$class_id);
	$exam_shift=$this->db->get("exam_time_table");
	
	$this->db->where("school_code",$school_code);
	$ens = $this->db->get("exam_notice_setting");
	if($ens->num_rows()>0){
	?>
	<div align="left"><h3>
	<!--for daffodils start-->
	<?php  
	$i=1;	foreach($ens->result() as $enotice ):
	?><h2 style="text-transform:uppercase; text-align:left;line-height:22px; margin-left:30px; padding-top:3px; padding-bottom:0px;">
		<?php echo $i.")&nbsp;&nbsp;".$enotice->notice."<br>";
			
		$i++;  endforeach; ?>
			</h2></div>
	<?php 	}	
}
public function getExamMode($exam_id,$class_id){
	
	$this->db->where("exam_id",$exam_id);
	$this->db->where("class_id",$class_id);
	$emode=$this->db->get("exam_mode");
	//print_r($emode);
	return $emode;
	
	
	
}
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
{
    $this->db->where("school_code",$this->session->userdata("school_code"));
	$query1 = $this->db->get("period");
	return $query1;
}
function exam_schedule($class_id)
{
$this->db->where("class_id",$class_id);
$exam = $this->db->get("exam_mode")->row();

	//print_r($exam);
	return $exam;
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

	   /* $this->db->where("school_code",$this->session->userdata("school_code"));
        $query=	$this->db->get("exam_head");
	    return $query;*/
	 }

	// this is khushbu 
   /* function getFsdForUpdate(){
    $this->db->where("school_code",$this->session->userdata("school_code"));
                $query=	$this->db->get("fsd");
        	    return $query;
          }
        function getExamName()
        {
            $this->db->where("school_code",$this->session->userdata("school_code"));
                $query=	$this->db->get("exam_head");
        	    return $query;
         	
        }*/
function getExamNameForUpdate($exam_id){
	
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$query1 = $this->db->get("exam_name");
	/*print_r( $query1->result());
	exit();*/
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

function updateexam1($examName,$date,$upexam)
{
    $date= array(
        'exam_name'=>$upexam,
    'exam_date' =>$date
    );
    
   
   $this->db->where("school_code",$this->session->userdata("school_code")); 
   $this->db->where("fsd",$this->session->userdata("fsd")); 
    $this->db->where("id",$examName);
    
	$query1 = $this->db->update("exam_name",$date);
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
	
	
	function getExamMarks($data3){
	    $school_code=$data3['school_code'];
	    $exam_id=$data3['exam_id'];
	    $class_id=$data3['class_id'];
	    $subject_id=$data3['subject_id'];
	  	/*$this->db->where("school_code",$data['school_code']);
		$this->db->where("fsd",$data['fsd']);*/
		//$this->db->where("exam_max_id",$data3['exam_id']);
	/*	$this->db->where("class_id",$data['class_id']);
		$this->db->where("subject_id",$data['subject_id']);*/
	//	$query1 = $this->db->get("exam_info");
		//print_r($query1);
		$stur = $this->db->query("select * from exam_info join exam_max_subject on exam_info.exam_max_id = exam_max_subject.id where  exam_max_subject.class_id='$class_id' and exam_max_subject.subject_id='$subject_id'"); 
		return $stur;
	//	print_r($stur);
	//	exit();
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
		public function getsubjectClass($classid){
		   $school_code = $this->session->userdata('school_code');
		$sub=	$this->db->query("select subject.subject, subject.id from subject join class_info on subject.class_id = class_info.id where class_info.id ='$classid' and school_code = '$school_code'");
		return $sub;
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
	public function insert_ques($ques,$wh_val,$ans,$a,$b,$c,$d,$e)
		{
		    $in_q1 = $this->db->insert('question_master',$wh_val);
		    
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
	function insert_img_question($ques,$exam_mode_id,$dq,$aq,$ans,$op_txt1,$op_txt2,$op_txt3,$op_txt4,$op_txt5)
		{
			$val1 = array(
				'question'=>$ques,
				'exam_mode_id'=>$exam_mode_id );
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
						'q_img1'=>$dq[1],
						'q_img2'=>$dq[2],
						'q_img3'=>$dq[3],
						'q_img4'=>$dq[4],
						'q_ans_img1'=>$aq[1],
						'q_ans_img2'=>$aq[2],
						'q_ans_img3'=>$aq[3],
						'q_ans_img4'=>$aq[4],
						'q_ans_img5'=>$aq[5],
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
		public function question_data($uri)
		{
		   	$this->db->where('exam_mode_id',$uri);
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
		
		///exam result code start by rahul
function testResult($school_code,$class_id,$fsd_id,$student_id,$totalIndicator,$termTotal){
    ?> <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/style.css' />
    <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/prin_result.css'
        media="print" />
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/jquery-1.3.2.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/example.js'></script>
    <?php
/*$school_code =15;
$class_id =322;
$fsd_id=24;
$student_id=6391;
$totalIndicator=0;
$termTotal=1;*/
$term = $this->db->query("select distinct (term) as trm from exam_name where school_code='$school_code'");
if($term->num_rows()>0){
   $i=0; foreach($term->result() as $trmv):
      $termColv[$i] =  $this->db->query("select * from exam_name where school_code='$school_code' and term='$trmv->trm'");
      $termCol[$i]=$termColv[$i]->num_rows();
     $i++;   endforeach;
?>
     <table style="width:95%;text-transform: uppercase; margin-left:auto; margin-right:auto; border:1px solid black; background-color:white;">
                    <tr >
                        <th colspan="1" rowspan="2">SCHOLASTIC AREA </th>
                        <?php if($term->num_rows()>0){
                         $i=0; foreach($term->result() as $trmv): ?>
                        <th colspan="<?php if($termTotal==1){echo $termCol[$i]+1;}else{echo $termCol[$i];}?>" rowspan="2">TERM <?php echo $trmv->trm;?> (100 MARKS) </th>
                        <?php $i++; endforeach;}?>
                        <th colspan="3">OVERALL</th>

                    </tr>

                    <tr>
                        <th colspan="3">
                           
                            <?php  $ovtg = "TERM"; 
                            if($term->num_rows()>0){
                            $i=0; foreach($term->result() as $trmv): 
                             if($i>0){
                           $ovt = $ovt."+".$ovtg."-".$trmv->trm ;
                           }else{
                            $ovt = $ovtg."-".$trmv->trm ;
                           }
                          // echo $ovt."<br>";
                           $i++; endforeach;
                           echo $ovt;
                           }
                           ?> 
                           
                           </th>
                    </tr>

                    <tr>

                        <th colspan="1" rowspan="1" style="text-transform: uppercase;">Subjects</th>
                     <?php  foreach($termColv as $examCol):
                                foreach($examCol->result() as $examName):
                                    echo '<th>'.$examName->exam_name."</th>";
					            endforeach;
					            if($termTotal==1){
					                echo '<th>Total</th>';
					            }
							endforeach;
					?>
						<!--2 term exam nam end-->
                        <th style="text-transform: uppercase;">Grand<br> Total</th>
                        <th rowspan="1" style="text-transform: uppercase;">Grade</th>
                        <th rowspan="1" style="text-transform: uppercase;">Rank:</th>
                    </tr>
                  <?php 
                   ///marks print
				$subjectList = $this->db->query("select DISTINCT subject.id, subject.subject from subject join exam_max_subject on exam_max_subject.subject_id=subject.id where exam_max_subject.fsd='$fsd_id' and exam_max_subject.class_id ='$class_id' order by subject.id ASC ");
			
				if($subjectList->num_rows()>0){
				     $rankcounter=0;
				    foreach($subjectList->result() as $sl):?>
                 <tr class="wight"> 
					 <td class="subject" ><?php echo  $sl->subject;?></td>
			    <?php $m=0;
			    $subTotal =0;
			    $GrandTotal=0;
			   
			    foreach($termColv as $examCol):
			            $termsubTotal=0;
			            $termmamTotal=0;
                                foreach($examCol->result() as $examName):
                                   $exam_id= $examName->id;
                                $getsubMarks =   $this->db->query("select * from exam_info join exam_max_subject on exam_max_subject.id = exam_info.exam_max_id where exam_max_subject.exam_id ='$exam_id' and exam_max_subject.subject_id ='$sl->id' and exam_max_subject.fsd='$fsd_id' and exam_max_subject.class_id ='$class_id' and exam_info.stu_id='$student_id' ");
                                   
                                if($getsubMarks->num_rows()>0){
                                    $gtotal =$getsubMarks->row()->max_m;
                                    $subMarks = $getsubMarks->row()->marks;
                                    $termsubTotal+=$subMarks;
                                    $termmamTotal+=$subMarks;
                                     $GrandTotal+=$gtotal;
                                    $subTotal+=$subMarks;
                                }else{
                                    $subMarks="(N/A)";
                                    $gtotal="(N/A)";
                                }
                                if($totalIndicator ==1){
                                    echo '<th>'.$subMarks." / ".$gtotal."</th>";
                                }else{
                                    echo '<th>'.$subMarks."</th>";
                                }
                                   
					            endforeach;
					            if($termTotal==1){
					                if($totalIndicator ==1){
                                    echo '<th>'.$termsubTotal." / ".$termmamTotal."</th>";
                                    }else{
                                    echo '<th>'.$termsubTotal."</th>";
                                    } 
					            }
					            
					          
						$m++;	endforeach;
					?>		
				
				<th class="center bold" ><?php  
				if($totalIndicator ==1){
				echo $subTotal." / ".$GrandTotal; }
				else{
				   	echo $subTotal; 
				}?></th>
				<!--overall total & grade start-->	
				<?php 	if($GrandTotal>0){ 
				    $per=round((($subTotal*100)/$GrandTotal), 2);}
				?>
				<td class="center bold"><?php echo $this->calculateGrade($per,$class_id);?></td>
				<?php if($rankcounter < 1){?>
			    <td rowspan ="<?php echo $subjectList->num_rows();?>">Class Rank: 1 <br> School Rank: 2</td>
			    <?php }?>
					<!--overall total & grade end-->
                </tr>
               
                    <?php 
                        
                     $rankcounter++;    endforeach;}
                        ?>
                        <tr>
                   <?php $this->subjectTotal($termColv,$class_id,$student_id,$fsd_id,$totalIndicator,$termTotal);?>
                </tr> 
                </table>
                 <div style=" width:95%; margin-left:auto; margin-right:auto;font-size: 14px;">
    	                <div style="width:50%; float:left;">
    						<!--scholar,mkd,bsd,spring SCHOLASTIC start-->
    	                        
    						 <?php $this->co_ScolasticGrade($per,$class_id,$fsd_id,$student_id,$school_code);?>   
    						 <?php $this->getAttendance($class_id,$fsd_id,$student_id);?>
    	                  
    	                </div>
    	
    	
    	
    	                <div style="width:50%; float:right;">
    					
    						<!--scholar,spring,mkd,bsd DISCIPLINE start-->
    						<?php $this->discipline($per,$class_id,$fsd_id,$student_id,$school_code);?>
    	                   <!--scholar,spring,mkd,bsd DISCIPLINE end-->
    				
    	                    <table style="width:70%; border:1px solid black; background-color:white;">
    	                        <tr> 
    								<!--bsd,spring,gyanodya,sarvodya remark start-->
    								<td>Remarks:&nbsp;&nbsp;&nbsp;&nbsp;<label><?php if($per>0){echo $gradecal =$this->remarks1($per,$class_id);} ?></label></td>
    								<!--bsd,spring,gyanodya,sarvodya remark end-->									
    																	
    	                        </tr>
    	                    </table>
    	
    	                </div>
    	                   
    	            </div>
                    
                    
               
               
                <div>
                    <?php $this->gradeTable();?>
                </div>
                
                <?php
               
                
}else{
    echo "Please create Exam Schedule First  ";
}
}

function remarks1($val,$classid){
								if($val >= 91 && $val < 101):
									return 'Outstanding';
								elseif($val >= 81 && $val < 91):
									return 'Excellent';
								elseif($val >= 71 && $val < 81):
									return 'Very Good';
								elseif($val >= 61 && $val < 71):
									return 'Good';
								elseif($val >= 51 && $val < 61):
									return 'Average';
								elseif($val >= 41 && $val < 51):
									return 'Fair';
								elseif($val >= 33 && $val < 41):
									return 'Marginal';
								else:
									return 'Poor';
								endif;
							}
							
function discipline($per,$class_id,$fsd_id,$student_id,$school_code){?>
                        <table style="width:90%; border:1px solid black;">
    						<tr>
    	                        <th colspan="3" style="text-transform: uppercase;"> Discipline</th>
    	                    </tr>
    						<tr>
    	                         <th style="text-transform: uppercase;"> Element </th>
    	                           <?php  $term = $this->db->query("select distinct (term) as trm from exam_name where school_code='$school_code'");
                                    if($term->num_rows()>0){
                                        foreach($term->result() as $trmv):?>
    	                            <th>TERM <?php echo $trmv->trm;?></th>
    	                            <?php endforeach;}?>
    	                        </tr>
    	                      <?php $displName = $this->db->query("select * from exam_decipline where school_code = '$school_code'");
    	                      foreach($displName->result() as $dName):?>
    	                       <tr>
    	                            <td><?php echo $dName->name;?></td>
    	                           <?php  foreach($term->result() as $trmv):
    	                               $getRecord =  $this->db->query("select * from exam_dicipline_marks where dmaster_id='$dName->id' and term ='$trmv->trm' and fsd ='$fsd_id' and student_id='$student_id' ");
    	                                ?>
    	                            <td><?php if($getRecord->num_rows()>0){echo $getRecord->grade;}else{
    	                                echo $this->co_scolastic($per,$class_id);
    	                            }?></td>
    	                            <?php endforeach;?>
    	                        </tr>
    	                        <?php endforeach;?>
    					
    	                      
    	                    </table>
    	                    <?php
}
	function co_scolastic($val,$classid){
								if($val > 80):
									return 'A';
								elseif($val >= 61  && $val < 81 ):
									return 'A';
								else:
									return 'B';
								endif;
							}
function co_ScolasticGrade($per,$class_id,$fsd_id,$student_id,$school_code){
    ?>
    <table style="width:90%; border:1px solid black;">
    						<tr>
    	                            <th colspan="3" style="text-transform: uppercase;">Co- SCHOLASTIC Area</th>
    	                      </tr>
    							<tr>
    	                            <th style="text-transform: uppercase;"> Activity </th>
    	                           <?php  $term = $this->db->query("select distinct (term) as trm from exam_name where school_code='$school_code'");
                                    if($term->num_rows()>0){
                                        foreach($term->result() as $trmv):?>
    	                            <th>TERM <?php echo $trmv->trm;?></th>
    	                            <?php endforeach;}?>
    	                        </tr>
    	                        <!-- Dynamic -->
    							 <?php $displName = $this->db->query("select * from exam_activity where school_code = '$school_code'");
    	                      foreach($displName->result() as $dName):?>
    	                       <tr>
    	                            <td><?php echo $dName->activiy_name;?></td>
    	                           <?php  foreach($term->result() as $trmv):
    	                               $getRecord =  $this->db->query("select * from exam_activity_marks where activity_id='$dName->id' and term ='$trmv->trm' and fsd ='$fsd_id' and student_id='$student_id' ");
    	                                ?>
    	                            <td><?php if($getRecord->num_rows()>0){echo $getRecord->grade;}else{
    	                                echo $this->co_scolastic($per,$class_id);
    	                            }?></td>
    	                            <?php endforeach;?>
    	                        </tr>
    	                        <?php endforeach;?>
    					
    	                      
    	                    </table>
<?php }

function getAttendance($class_id,$fsd_id,$student_id){?>
      <table style="width:70%; border:1px solid black; background-color:white;">
    	                        <tr>
    	                            <?php
    	                            $this->db->where("class_id",$class_id);
    								$dt=$this->db->get("school_attendance");
    							    $atotal=$dt->num_rows();
    								$this->db->where('id',$fsd_id);
    								$fsdval=$this->db->get('fsd')->row();
    								$this->db->where('a_date >=',$fsdval->finance_start_date);
    								$this->db->where('a_date <=',$fsdval->finance_end_date);
    								$this->db->where('stu_id',$student_id);
    								$this->db->where('attendance',0);
    								$row1=$this->db->get('attendance');
    								$absnt=$row1->num_rows();
    								$present =$atotal-$absnt;
    								?>
    							
    	                              <td><b>Attendance:&nbsp;&nbsp;&nbsp;&nbsp;<label><?php echo $present; ?>/<?php echo $atotal; ?></label></b></td>
    	                              
    	                        </tr>
    	                    </table><?php
}

function calculateGrade($val,$classid){
                                if($val >= 91 && $val < 101):
                                    return 'A1';
                                elseif($val >= 81 && $val < 91):
                                    return 'A2';
                                elseif($val >= 71 && $val < 81):
                                    return 'B1';
                                elseif($val >= 61 && $val < 71):
                                    return 'B2';
                                elseif($val >= 51 && $val < 61):
                                    return 'C1';
                                elseif($val >= 41 && $val < 51):
                                    return 'C2';
                                elseif($val >= 33 && $val < 41):
                                    return 'D';
                                else:
                                    return 'E';
                                endif;
                                
                            }
                            function remarks($val,$classid){
                                if($val >= 91 && $val < 101):
                                    return 'Excellent';
                                elseif($val >= 81 && $val < 91):
                                    return 'Very Good';
                                elseif($val >= 71 && $val < 81):
                                    return 'Good';
                                elseif($val >= 61 && $val < 71):
                                    return 'Good';
                                elseif($val >= 51 && $val < 61):
                                    return 'Progressive';
                                else:
                                    return 'Needs Improvement';
                                endif;
                                
                            }
                            
         function subjectTotal($termColv,$class_id,$student_id,$fsd,$totalIndicator,$termTotal){
        ?>
             <th>Subject Total</th>
                   <?php 
                   $grandcoltotal=0;
                   $grandallcoltotal=0;
                   foreach($termColv as $examCol):
                       $termctotal=0;
                       $termmtotal=0;
                                foreach($examCol->result() as $examName):
                                     //print_r($examName->id);
                                        $subtotget =   $this->db->query("select sum(exam_info.marks) as totmarks from exam_info join exam_max_subject on exam_max_subject.id = exam_info.exam_max_id where exam_max_subject.exam_id ='$examName->id' and  exam_max_subject.fsd='$fsd' and exam_max_subject.class_id ='$class_id' and exam_info.stu_id='$student_id' ");
                                        $subtotMax =   $this->db->query("select sum(exam_max_subject.max_m) as totmmmarks from exam_info join exam_max_subject on exam_max_subject.id = exam_info.exam_max_id where exam_max_subject.exam_id ='$examName->id' and  exam_max_subject.fsd='$fsd' and exam_max_subject.class_id ='$class_id' and exam_info.stu_id='$student_id' ");
                              
                              if($subtotget->num_rows()>0){
                                  $columnsubTotal = $subtotget->row()->totmarks;
                                  $grandcoltotal+=$columnsubTotal;
                                  $termctotal+=$columnsubTotal;
                                 
                              }else{
                                  $columnsubTotal="(N/A)";
                              }
                              if($subtotMax->num_rows()>0){
                                  $columnGTotal = $subtotMax->row()->totmmmarks;
                                  $grandallcoltotal+=$columnGTotal;
                                   $termmtotal+=$columnGTotal;
                              }else{
                                  $columnGTotal="(N/A)";
                              }
                              
                                if($totalIndicator ==1){
                                    echo '<th>'.$columnsubTotal." / ".$columnGTotal."</th>";
                                }else{
                                    echo '<th>'.$subtotget->row()->totmarks."</th>";
                                }
					            endforeach;
					             if($termTotal==1){
					                if($totalIndicator ==1){
                                    echo '<th>'.$termctotal." / ".$termmtotal."</th>";
                                    }else{
                                    echo '<th>'.$termctotal."</th>";
                                    } 
					            }
					            
							endforeach;
					?>
						<!--2 term exam nam end-->
                        <th style="text-transform: uppercase;"><?php   if($totalIndicator ==1){ echo $grandcoltotal." / ".$grandallcoltotal; }else{ echo $grandcoltotal;}?></th>
                        <th rowspan="1" style="text-transform: uppercase;">
                           <?php if($grandallcoltotal>0){ $per=round((($grandcoltotal*100)/$grandallcoltotal), 2);};
                             echo $this->calculateGrade($per,$class_id);?></th>
                        <th rowspan="1" style="text-transform: uppercase;"></th><?php
        }      
        
        function gradeTable(){
            ?>
             <div>
    	                <center><b><label style="text-transform: uppercase;font-size: 14px; ">Instructions</label></b></center>
    	                <center><label style="font-size: 14px;">Grading Scale For Scholastic areas:Grades are awarded on a 8-point Grading Scale as Follows-</label></center>
    	            </div>
    	    <div>        
             <table style="width:95%;  margin-left:auto; margin-right:auto; border:1px solid black; background-color:white;font-size: 14px;">
    						<thead> 
    							<tr style="background-color: orange;">
    								<th>MARKS RANGE </th>
    								<th>GRADE</th>
    							
    								<!--<th>INDICATOR</th>-->
    							
    							</tr>
    						</thead>
    						<tbody>
    	                    <!-- Dynamic -->
    						<!--for scholar & mkd grade chart start-->
    	                    
    						<!--for bsd,spring grade chart start-->
    	                    <tr>
    	                        <td>91-100</td>
    	                        <td>A1</td>
    							<!--<td>Outstanding</td>-->
    	                    </tr>
    	                    <tr>
    	                        <td>81-90</td>
    	                        <td>A2</td>
    							<!--<td>Excellent</td>-->
    	                    </tr>
    	                    <tr>
    	                        <td>71-80</td>
    	                        <td>B1</td>
    							<!--<td>Very Good</td>-->
    	                    </tr>
    	                    <tr>
    	                        <td>61-70</td>
    	                        <td>B2</td>
    							<!--<td>Good</td>-->
    	                    </tr>
    	                    <tr>
    	                        <td>51-60</td>
    	                        <td>C1</td>
    							<!--<td>Average</td>-->
    	                    </tr>
    	                     <tr>
    	                        <td>41-50</td>
    	                        <td>C2</td>
    							<!--<td>Fair</td>-->
    	                    </tr>
    	                     <tr>
    	                        <td>33-40</td>
    	                        <td>D1</td>
    							<!--<td>Marginal</td>-->
    	                    </tr>
    	                     <tr>
    	                        <td>32 & Below</td>
    	                        <td>D2</td>
    							<!--<td>Poor</td>-->
    	                    </tr>
    						<!--for bsd,spring grade chart end-->
    	                   
    						</tbody>
    	                </table> 
    	           </div>      
            <?php
        }
		///exam result code end by rahul
		
}
?>