
<div class="row">
<div class="col-sm-12">
<div class="panel panel-white">
<div class="panel-heading panel-blue">
<h4 class="panel-title">Enter <span class="text-bold"> Marks Detail</span></h4>
<div class="panel-tools">
<div class="dropdown">
<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
<i class="fa fa-cog"></i>
</a>
<ul class="dropdown-menu dropdown-light pull-right" role="menu">
<li>
<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
</li>
<li>
<a class="panel-refresh" href="#">
<i class="fa fa-refresh"></i> <span>Refresh</span>
</a>
</li>
<li>
<a class="panel-config" href="#panel-config" data-toggle="modal">
<i class="fa fa-wrench"></i> <span>Configurations</span>
</a>
</li>
<li>
<a class="panel-expand" href="#">
<i class="fa fa-expand"></i> <span>Fullscreen</span>
</a>
</li>
</ul>
</div>
<a class="btn btn-xs btn-link panel-close" href="#">
<i class="fa fa-times"></i>
</a>
</div>
</div>
<div class="panel-body">
<?php $ts=0;$os=0;
$v = $this->session->userdata('username'); 
$this->db->where("username",$v);
$dt=$this->db->get("student_info")->row();
$ids= $dt->id;
$fsd=$dt->fsd;
$this->db->where("id",$fsd);
$rsc=$this->db->get('fsd')->row();
$school_code1= $rsc->school_code;
$diExam2 = $this->db->query("SELECT  distinct * FROM exam_info WHERE  school_code='$school_code1' ORDER BY exam_id DESC LIMIT 1 ");
// print_r($diExam2);
// exit;
if($diExam2->num_rows()>0){
$diExam=$diExam2->row(); 
$this->db->where('exam_id',$diExam->exam_id);
//$this->db->where('class_id',$diExam->class_id);
$this->db->where('stu_id',$ids);
$this->db->where('school_code',$school_code1);
$diExam1=$this->db->get('exam_info');

$this->db->where("id",$diExam->exam_id);
$ename=$this->db->get("exam_name")->row();
$enm=$ename->exam_name;
 ?>
<table class="table table-striped table-hover" id="sample-table-1">
<thead>
<tr style="background-color:#1ba593; color:white;">
<th>S.No.</th>
<th class="center">Subject Name</th>
<th class="center">Max.Marks</th>
<th class="center">Marks Obtained</th>
<th class="center">Date</th>
</tr>
</thead>
<tbody>
<?php 

	if($diExam1->num_rows()>0){

$i=1; foreach ($diExam1->result() as $value):
 
  if($i%2==0){$rowcss="danger";}else{$rowcss ="warning";}

$this->db->where('id',$value->subject_id);
$this->db->where('class_id',$value->class_id);
 $subject=$this->db->get('subject');

 foreach ($subject->result() as $key){
?>
<tr class="<?php echo $rowcss;?>">
<td><?php echo $i; ?></td>
<td class="center"><?php echo $key->subject;?></td>
<?php if($value->out_of==0){ ?>
<td class="center"><?php  echo "Grade"; ?></td> 
<?php } else{ ?>
<td class="center"><?php $os=$os+$value->out_of; echo $value->out_of; ?></td>
<?php }?>
<?php if($value->out_of==0){ ?>
<td class="center"><?php echo $value->marks;?></td> 
<?php } else{ ?>
<td class="center"><?php $ts=$ts+$value->marks; echo $value->marks; ?></td>
<?php }?>
<td class="center"><?php echo $value->created; ?></td>
</tr> 
<?php  $i++;} endforeach;
} }
else{
echo "<h4 class='text-danger'>Data Not Found</h4>";
}?>
	<?php
// 		function calculateGrade($val,$classid){
			
// 			if($val >= 91 && $val < 101):
// 				return 'A1';
// 			elseif($val >= 81 && $val < 91):
// 				return 'A2';
// 			elseif($val >= 71 && $val < 81):
// 				return 'B1';
// 			elseif($val >= 61 && $val < 71):
// 				return 'B2';
// 			elseif($val >= 51 && $val < 61):
// 				return 'C1';
// 			elseif($val >= 41 && $val < 51):
// 				return 'C2';
// 			elseif($val >= 33 && $val < 41):
// 				return 'D';
// 			else:
// 				return 'E';
// 			endif;
			
		//} 
		?>

</tbody>
<tfoot><tr><td><span style="font-size:20px;">Total Percentage = <?php if($os!=0){ echo  round($ts/$os*100,2)."%";}else{echo "0.00";}?></span></td></tr></tfoot>
</table>
</div>	
</div>
</div>
</div>
