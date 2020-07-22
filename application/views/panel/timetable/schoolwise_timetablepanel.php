<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-pink">
        <h4 class="panel-title">School<span class="text-bold">Timetable Report</span></h4>
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


                        


<table class="table table-striped table-bordered">
	<th>Period</th>
	<th>To</th>
	<th>From</th>

<?php 


$this->db->where("school_code",$this->session->userdata('school_code'));
$per=$this->db->get('period')->result();

foreach($per as $period)
{

?>

<tr><td><?php echo $period->period; ?></td>
<td><?php echo $period->to; ?></td>
<td><?php echo $period->from; ?></td>

</tr>

<?php

}


?>
</table>
</div>
</div>
</div>
</div>
