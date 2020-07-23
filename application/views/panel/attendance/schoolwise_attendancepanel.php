<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-red">
        <h4 class="panel-title">School Wise <span class="text-bold">Attendance Report</span></h4>
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

  <div class="alert alert-info">
    <button data-dismiss="alert" class="close">×</button>
    <h3 class="media-heading text-center">Welcome to School Attendance Panel</h3>
Here you can see all Present , Absent day of your school month Wise.
      </div>

      <div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="sample-table-2">
								<thead>
									<tr>
										<th>Month</th>
										<th>Open Days</th>
										<th>Close Days</th>
									
									</tr>
								</thead>
								<tbody>
      <?php

$this->db->where('school_code', $this->session->userdata('school_code'));
$this->db->where('id', $this->session->userdata('fsd'));
$fsddate = $this->db->get('fsd')->row()->finance_start_date;
$scode=$this->session->userdata('school_code');
for ($j=0;$j<12;$j++){
 $actdate= date('Y-m', strtotime("$j months", strtotime($fsddate)));
$month= date('m', strtotime("$j months", strtotime($fsddate)));
if($month==04){
$day=30;
}
elseif($month==05)
{
  $day=31;
}
elseif($month==06)
{
  $day=30;
}
elseif($month == '07')
{
  $day = '31';
}
elseif($month =='08')
{
  $day='31';
}
elseif($month == '09')
{
  $day=30;
}
elseif($month==10)
{
  $day=31;
}
elseif($month==11)
{
  $day=30;
}
elseif($month==12)
{
  $day=31;
}
elseif($month==01)
{
  $day=31;
}
elseif($month==02)
{
  $day=28;
}
else{
  $day=31;
}

$this->db->where('school_code',$scode);
$class=$this->db->get('class_info')->result();
$value=0;
foreach($class as $data)
{
  $this->db->where('class_id',$data->id);
 $stdinfo= $this->db->get('student_info');
 $value=$value+$stdinfo->num_rows();
}


$ddate = $actdate.'-%';
$ab = $this->db->query("SELECT distinct date FROM school_attendance WHERE school_code = '$scode' and date like '$ddate'");

?>
<tr class="text-uppercase">
										<td><?php echo $actdate;?></td>
										<td><?php echo $ab->num_rows();?></td>
										<td><?php echo $day-$ab->num_rows();?></td>
								
									</tr>


   <?php 
 
}?>
								</tbody>
							</table>
						</div>
					</div>
</div>

          
              </div>
            
            
         
          </div>
        </div>
        </div>


