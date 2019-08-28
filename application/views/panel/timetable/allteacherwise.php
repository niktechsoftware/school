<h2 style="color:green;"> Your Teacher <?php echo $name;?> Timetable is -</h2>

<table class="table table-striped table bordered">
<b><th>Period</th>
	
	<th>From</th><th>To</th>
	<th>Subject</th>
	<th>Class</th>
	
	<th>Day</th></b>


<?php    



foreach($teacher as $data)
{
$mobile=$data->mobile;
 $row1=$data->subject_id;
 $row2=$data->class_id;
 $row3=$data->period_id;
 $row4=$data->teacher;
 $row6=$data->subject_id;
 $row5=$data->day;

 $this->db->where('id',$row1);
 $sub=$this->db->get('subject')->row();
 $this->db->where('id',$row2);
$class=$this->db->get('class_info')->row();

$this->db->where('id',$row3);
$period=$this->db->get('period')->row();
print_r($period);
exit();

$this->db->where('id',$row2);
$class=$this->db->get('class_info')->row();

 ?>
	
<tr>
	<td><?php if($row3==0){echo "LUNCH"; }else{echo $period->period;} ?></td>
	<td><?php if($row3==0){echo "LUNCH"; } else{echo $period->from;}?></td>
<td><?php if($row3==0){echo "LUNCH"; } else{echo $period->to;}?></td>
	
	<td> <?php if($row1==0){echo "LUNCH"; }else{echo $sub->subject;} ?> </td>
<td> <?php if($row2==0){echo "LUNCH"; }else{echo $class->class_name;} ?> </td>


<td><?php echo $row5; ?></td></tr>

 <?php

	
}
?>
</table>
<a href="<?php echo base_url();?>index.php/timetablepanel/sendmsg_teacher/<?php echo $mobile;?>/<?php echo $id;?>"><input type="button" name="sendmsg" value="Send Sms" style="background-color:blue; height:35px; "></a>
