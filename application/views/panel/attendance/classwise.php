
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



<table class="table table-striped table bordered" id="sample-table-2">
<thead>
	<tr>
    <th>S no.</th>
	<th>Student Name</th>
	<th>Total Present</th>
	<th>Total Absent</th>
	<th>Taken Attendance</th></tr></thead>
	
<?php

$i=1;
foreach($class->result() as $data)
{

$this->db->where('id',$data->stu_id);
$studentname=$this->db->get('student_info');
if($studentname->num_rows()>0){
							/*$this->db->where("class_id",$classid);
							$this->db->where("school_code",$this->session->userdata('school_code'));
							$dt=$this->db->get("school_attendance");
						    $atotal=$dt->num_rows();
							$this->db->where('id',$this->session->userdata('fsd'));
							$fsdval=$this->db->get('fsd')->row();
							$this->db->where('a_date >=',$fsdval->finance_start_date);
							$this->db->where('a_date <=',$fsdval->finance_end_date);
							$this->db->where('stu_id',$studentInfo->id);
							$this->db->where('attendance',0);
							$row1=$this->db->get('attendance');
							$absnt=$row1->num_rows();
							$present =$atotal-$absnt;*/
$this->db->where('stu_id',$data->stu_id);
$this->db->where('attendance',0);
$atten=$this->db->get('attendance');

$this->db->where('stu_id',$data->stu_id);
$this->db->where('attendance',1);
$atten1=$this->db->get('attendance');

$this->db->where('stu_id',$data->stu_id);
$atten1dance=$this->db->get('attendance');



 ?>

	<tbody>
<tr>
  <td><?php echo $i;?></td>
	<td><a href="<?php echo base_url()?>attendancepanel/particularstudatten/<?php echo $data->stu_id?>"><?php echo $studentname->row()->name;?></a></td>
	<td><?php echo  $atten->num_rows();?></td>
  <td><?php echo  $atten1->num_rows();?></td>
	<td><?php echo  $atten1dance->num_rows();?></td>
  
    </tr></tbody>

 <?php
$i++;

}

}
?>



</table>
</div>
</div>
</div>
</div>
