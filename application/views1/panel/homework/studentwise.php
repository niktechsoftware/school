<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-pink">
        <h4 class="panel-title">Student Daywise <span class="text-bold">Homework Report</span></h4>
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
        <tr><th>Name</th>
        	<th>Class</th>
        	 <th>Submite Date</th>
        	<th>HomeWork</th>
        </tr>

    <?php
    $row1=$row->result();
    foreach($row1 as $data)
    { $id=$data->submitted_by;
    $this->db->where('username',$id);
    $username=$this->db->get('student_info')->row();
    $cls=$username->class_id;
    $this->db->where('id',$cls);
    $cls1=$this->db->get('class_info')->row();
    $sec=$cls1->section;
    $this->db->where('id',$sec);
    $sec1=$this->db->get('class_section')->row();
    //print_r($sec1);
    ?>
    <tr>
	<td><?php echo $username->name; ?></td>
	<td><?php echo $cls1->class_name; ?>(<?php echo $sec1->section; ?>)</td>
	<td><?php echo $data->submitted_date; ?></td>
	<td><a href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/submithomeWork/<?php echo $data->upload_file; ?>" download>
	    <button class="btn btn-info"  width="104" height="142">Download</button></a> </td>
	</tr>
 <?php }
?>
</table>