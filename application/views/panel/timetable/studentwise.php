<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-pink">
        <h4 class="panel-title">Student Daywise<span class="text-bold">Timetable Report</span></h4>
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

<h2 style="color:green;"> Student <?php echo $name;?> is Present on <?php echo $class;?></h2>
<table class="table table-striped table bordered">
	<b><th>Period</th>
	<th>From</th>
	<th>To</th>

	<th>Subject</th>
	<th>Teacher Name</th>
	<th>Day</th></b>

<?php

foreach($row as $data)
{



 $row1=$data->subject_id;
 $row2=$data->class_id;
 $row3=$data->period_id;
 $row4=$data->teacher;
 $row5=$data->day;
 $this->db->where('id',$row1);
 $sub=$this->db->get('subject')->row();
 $this->db->where('id',$row2);
$class=$this->db->get('class_info')->row();

$this->db->where('id',$row3);
$period=$this->db->get('period')->row();

$this->db->where('id',$row4);
$teacher=$this->db->get('employee_info')->row();

 ?>

	
<tr>
	<td><?php if($row3==0){echo "LUNCH"; }else{echo $period->period;} ?></td>
		<td><?php if($row3==0){echo "LUNCH"; } else{echo $period->from;}?></td>

	<td><?php if($row3==0){echo "LUNCH"; } else{echo $period->to;}?></td>

	<td> <?php if($row1==0){echo "LUNCH"; }else{echo $sub->subject;} ?> </td>
<td> <?php if($row4==0){echo "LUNCH"; }else{echo $teacher->name;} ?> </td>


<td><?php echo $row5; ?></td>

 <?php


}



?>
</table>