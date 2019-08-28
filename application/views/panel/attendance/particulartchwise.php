<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-pink">
        <h4 class="panel-title">Teacher <span class="text-bold">Attendance Report</span></h4>
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
       
          <div><label>Name:</label>&nbsp;<label><strong><?php echo $name;  ?></strong></label></div>
            <table class="table table-striped table bordered">
        <tr><th>Date</th>
        	<th>In Time</th>
          <th>Out Time</th>
          <th>Late Time</th>
        	<th>Attendance</th>
        </tr>

    <?php
   $row1=$row->result();
   foreach($row1 as $data)
   
    { 
    ?>
    <tr>
	<td><?php echo $data->a_date; ?></td>

	<td><?php echo $data->in_time; ?></td>
  <td><?php echo $data->out_time; ?></td>
  <td><?php echo $data->late_time; ?></td>
	<td><?php if($data->attendance==1){echo "<strong style='color:green;'>Present<strong>";}else{echo "<strong style='color:red;'>Absent<strong>";} ?></td>

	</tr>
 <?php }
?>
</table>