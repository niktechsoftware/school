<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-pink">
        <h4 class="panel-title">Class Wise <span class="text-bold">Attendance Panel</span></h4>
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

<table class="table table-striped table bordered">

	<tr>
    <th>S no.</th>
	<th>Student Name</th>
	<th>Present/Absent</th>
	<th>Date</th></tr>
	
<?php

$i=1;
foreach($uri as $data)
{

$this->db->where('id',$data->stu_id);
$studentname=$this->db->get('student_info');
if($studentname->num_rows()>0){

// $this->db->where('id',$data->id);
// $atten=$this->db->get('attendance')->row();
// foreach($atten as $val)
// {
 ?>

	
<tr>
  <td><?php echo $i;?></td>
	<td><?php echo $studentname->row()->name;?></td>
	<td><?php if($data->attendance==1){ echo "Present";} else{echo "Absent";}?></td>
   <td><?php echo  $data->a_date;?></td>
    </tr>

 <?php


//}

}$i++;
}
?>


</table>
</div>
</div>
</div>
</div>

