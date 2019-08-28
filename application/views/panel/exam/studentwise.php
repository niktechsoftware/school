
<table id="student_wise" class="table table-striped table-bordered" style="width:100%">
	<thead><th>Subject Name</th>
		<th>Obtain Marks</th>
		<th>Total Marks</th>
	</thead>
<?php

foreach($exam as $data)
{

$row1=$data->subject_id;
$this->db->where('id',$row1);
$sub=$this->db->get('subject')->row();
?>
<tr>
	<td><?php echo $sub->subject;?></td>
	<td><?php echo $data->marks;?></td>
	<td><?php if($data->out_of==0){ echo "GRADE"; } else{echo $data->out_of;}?></td>
</tr>
<?php
}
 ?>
 </table>