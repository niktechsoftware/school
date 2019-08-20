<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-pink">
        <h4 class="panel-title">Student <span class="text-bold">Attendance Report</span></h4>
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
      <?php
      /*$id=$data->submitted_by;
    $this->db->where('username',$id);
    $username=$this->db->get('student_info')->row();
    $cls=$username->class_id;
    $this->db->where('id',$cls);
    $cls1=$this->db->get('class_info')->row();
    $sec=$cls1->section;
    $this->db->where('id',$sec);
    $sec1=$this->db->get('class_section')->row();*/
     // $row1=$row->result();
    //print_r($row1);
      ?>
          
          <div><label>Name:</label>&nbsp;<label><strong><?php echo $name;  ?></strong></label></div>
           <div><label>Class:</label>&nbsp;<label><strong><?php echo $class; ?></strong></label></div>
           <div><label><label>Section:</label>&nbsp;<label><strong><?php echo $section;?><strong></label></div>
        <table class="table table-striped table bordered">
        <tr><th>Date</th>
        	<th>Shift</th>
        	<th>Attendance</th>
        </tr>

    <?php
   $row1=$row->result();
   foreach($row1 as $data)
   
    { 
    ?>
    <tr>
	<td><?php echo $data->a_date; ?></td>
	<td><?php if($data->shift_1==1){echo "<strong style='color:green;'>Shift 1<strong>";}elseif($data->shift_2==1){echo "<strong style='color:green;'>Shift 2<strong>";}  ?></td>
	<td><?php if($data->attendance==1){echo "<strong style='color:green;'>Present<strong>";}else{echo "<strong style='color:red;'>Absent<strong>";} ?></td>

	</tr>
 <?php }
?>
</table>