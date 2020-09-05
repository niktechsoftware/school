<?php class examModel extends CI_Model{
	
//create by rahul
public function getExamTimeTableChartBy($exam_id,$class_id,$school_code){
	$this->db->where("exam_id",$exam_id);
	$this->db->where("class_id",$class_id);
	$exam_day=$this->db->get("exam_time_table");
	
	$this->db->distinct();
	$this->db->select("shift_id");
	$this->db->where("exam_id",$exam_id);
	$this->db->where("class_id",$class_id);
	             	$exam_shift=$this->db->get("exam_time_table");?>
				<table id="items" align="center"  style="width:100%; margin-top:8px;color:#d80707;font-size: 11px;">
						<thead>
							<th style="text-transform: uppercase;"><b>Date</b></th>
	                        <?php 
	
	if($exam_day->num_rows()){
	                        $this->db->where('exam_id',$exam_day->row()->exam_id);
	                        $date=$this->db->get('exam_day')->result();
	                        foreach($date as $ed):?>
							<th><b><?php echo date("d-m-Y",strtotime($ed->date1));?></b></th>
							<?php endforeach; }?>
						</thead>
						<tbody>
	                        <?php
	                    
	                        foreach($exam_shift->result() as $s):
	                        $this->db->where("id",$s->shift_id);
	                       $exshift =  $this->db->get("exam_shift")->row();
	                        ?>
	                        <tr>
	
	                        <td style="text-align: center;text-transform: uppercase;"><?php if($school_code==5){ ?><?php }else{ ?>
	                        <?php echo $exshift->shift;  ?>
	                        <?php //echo $s->shift;?>
	                        
	                        <?php } ?></td>
	
	                        <?php 
	                   
	                        foreach($date as $ed):
							
							$this->db->where("school_code",$this->session->userdata("school_code"));
	                        $this->db->where("exam_id",$exam_id);
	                        $this->db->where("shift_id",$s->shift_id);
	                        $this->db->where("class_id",$class_id);
	                        $this->db->where("exam_day_id",$ed->id);
							$etb = $this->db->get("exam_time_table");
							if($etb->num_rows()>0){
							    foreach($etb->result() as $ff):
	                                 if($ff->subject_id){
	                                $this->db->where('id',$ff->subject_id);
	                                $this->db->where('class_id',$ff->class_id);
	                                 $subject=$this->db->get('subject');
	                                    ?>
	                                <td style="text-align: center;text-transform: uppercase;"> <?php echo $subject->row()->subject;?></td>
	                                
								<?php }else{?> <td> </td> <?php }
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
	
	?>
	
	<div align="left"><h3>
	<!--for daffodils start-->
	<?php   $row2=$this->db->get('db_name')->row()->name;
	if(($school_code==5) && ($row2=="D")){ ?>
	
			&nbsp;Note: 1)Exam timing for Shift <?php foreach($shift->result() as $s):   echo $s->shift." - ".date('H:i A',strtotime($s->from1))." to ".date('H:i A',strtotime($s->to1))." "; endforeach; ?><br>
	
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2) Bringing this admit card during exam is compulsory.</br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3) A Student who gives or obtains unfair assistance at an examination 
			will debarred for the rest of the examination and will</br> 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;get Zero in that paper.</br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4) Attendance of the students for oral and Written exam is essential.</br>
	
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5) 28-03-2020 Result Declaration & P.T.M.
			<!--for daffodils end-->
			<!--for scholar start-->
			<?php }else if($school_code==13 && $row2=="A"){
			?>	&nbsp;Note: 1) The reporting time to school will be at <?php foreach($shift as $s):  echo date('H:i A',strtotime($s->from1)); endforeach; ?> and dispersal timing will be at <?php foreach($shift as $s):  echo date('H:i A',strtotime($s->to1)); endforeach; ?>. 
		    </br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			2) Bring this admit card and all necessary instruments (Pen, Pencil box, Geometry box etc.) during exam is compulsory. </br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			3) Unfair means or papers are strictly prohibited.</br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($school_code == 13){?>
				4) PTM and Result Declaration will be held on 22nd of March.
			    
		<?php	}else{?>
			
				4) Issuing of duplicate Admit card will charge 10 rs.
			
		<?php 	}?>
		
	
			<?php }else if(($school_code==5) && ($row2=="C")) {	?>
				&nbsp;Note: 1)Exam timing for Shift <?php foreach($shift as $s):  echo $s->shift." - ".date('H:i A',strtotime($s->from1))." to ".date('H:i A',strtotime($s->to1))." "; endforeach; ?><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2)Students reporting time is <?php foreach($shift as $s): $startt=strtotime("-30 minutes",strtotime($s->from1));
			$endt =strtotime("-00 minutes",strtotime($s->to1));
			echo $s->shift."-".date('H:i A', $startt)." "; endforeach; ?> </br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3) Bringing this admit card during exam is compulsory.</br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4) Unfair means or papers are strictly prohibited.</br>
			
			<?php }	else if($school_code==8 || $school_code==9){ ?>
			<!--for scholar end-->
			<!--for dds start--><?php $a=$class_id;if($a==108 || $a==109 || $a==110 || $a==111){?>&nbsp;Note: 1)Exam timing is - 08:00 A.M. to 12:00 P.M.<br><?php }else{ ?>
	
			&nbsp;Note: 
			<?php  } ?>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1)Students reporting time is latest by 8:30 A.M. and departure time is 01:30 P.M.
	
			<?php /*foreach($shift as $s): $startt=strtotime("-30 minutes",strtotime($s->from1));
			$endt =strtotime("-00 minutes",strtotime($s->to1));
			echo $s->shift."-".date('H:i A', $startt)." "; endforeach;*/ ?> </br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2) Bringing this admit card during exam is compulsory.</br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3) Unfair means or papers are strictly prohibited.</br>
			<?php }else{ ?><!--for dds end-->
	
			&nbsp;Note: 1)Exam timing for Shift <?php foreach($shift as $s):  echo $s->shift." - ".date('H:i A',strtotime($s->from1))." to ".date('H:i A',strtotime($s->to1))." "; endforeach; ?><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2)Students reporting time is <?php foreach($shift as $s): $startt=strtotime("-15 minutes",strtotime($s->from1));
			$endt =strtotime("-00 minutes",strtotime($s->to1));
			echo $s->shift."-".date('H:i A', $startt)." "; endforeach; ?> </br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3) Bringing this admit card during exam is compulsory.</br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4) Unfair means or papers are strictly prohibited.</br>
			<?php }?></h3>
	
		
			</div>
	<?php 		
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
{$this->db->where("school_code",$this->session->userdata("school_code"));
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
	$this->db->where("exam_date >=",$getfsdDates->finance_start_date);
	$this->db->where("exam_date <=",$getfsdDates->finance_end_date);
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