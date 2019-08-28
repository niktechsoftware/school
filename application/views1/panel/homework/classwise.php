
<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-pink">
        <h4 class="panel-title">class Daywise <span class="text-bold">HomeWork Report</span></h4>
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
	<th>Student Name</th>
	<th>UserName</th>
	<th>Submitted Date</th>
	<th>HomeWork</th>
	</tr>
<?php
foreach($class as $data)
{
    $a=$data->submitted_by;
    $this->db->where("username",$a);
    $dt1= $this->db->get("student_info")->row();
   
 ?>
<tr>
	<td><?php if($dt1==null){ echo "N/A";}else{echo $dt1->name;} ?></td>
	<td><?php if($data->submitted_by==null){ echo "N/A";}else{echo $data->submitted_by;} ?></td>
	<td><?php if($data->submitted_date==null){ echo "N/A";}else{echo $data->submitted_date;} ?></td>
	<td><a href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/submithomeWork/<?php echo $data->upload_file; ?>" download>
	    <button class="btn btn-info"  width="104" height="142">Download</button></a> </td>
</tr>
 <?php
}?>


</table>
</table>
</div>
</div>
</div>
</div>
