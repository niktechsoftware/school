
<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-green">
				<h4 class="panel-title">Session Wise <span class="text-bold">Student List</span></h4>
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

<table class="table table-striped table-bordered" style="width:100%; overflow-y: scroll;" id="sample-table-2">
<thead>	<tr style="background-color:#1ba593; color:white;">	<th>SNo.</th>
										<th>User Name</th>
										<th>Student Name</th>
										<th>Father Name</th>
										<th>Class</th>
										<th>Section</th>
										<th>Address</th>
										<th>Mobile</th></tr></thead>


<?php
$sno = 1; 
 $this->db->where('fsd',$fsd);
$data=$this->db->get('old_student_info');
if($data->num_rows()>0){
foreach($data->result() as $detail)
{

$this->db->where('id',$detail->student_id);
$std=$this->db->get('student_info');
if($std->num_rows()>0)
{
?><?php if($sno%2==0){$rowcss="warning";}else{$rowcss ="danger";}?>
<tr class="<?php echo $rowcss;?> text-uppercase">
	<td><?php echo $sno;?></td>
	<td><?php echo $std->row()->username;?></td>
	<td><?php echo $std->row()->name;?></td>
	<?php	$this->db->where("student_id",$std->row()->id);
		$fname  = $this->db->get("guardian_info");
		if($fname->num_rows()>0){?>
		<td><?php echo strtoupper($fname->row()->father_full_name); ?></td>
		<?php } else{
		  ?>	<td><?php echo "Please Update";?></td>
				<?php }


				  $this->db->select('class_name,section');
				  $this->db->where('id',$std->row()->class_id);
				   $classInfo=$this->db->get('class_info');

				   if($classInfo->num_rows()>0)
				   {
										

				?>
	<td><?php echo $classInfo->row()->class_name;?></td>
	<?php $this->db->select('section');
											  $this->db->where('id',$classInfo->row()->section);
											  $this->db->where("school_code",$this->session->userdata("school_code"));
										      $sectionInfo=$this->db->get('class_section');
										      if($sectionInfo->num_rows()>0){
										      ?>
										
	<td><?php echo $sectionInfo->row()->section;?></td>
	<td><?php echo $std->row()->address1;?></td>
	<td><?php echo $std->row()->mobile;?></td>
</tr>

<?php
}
}
}$sno++;
} }?>
</table>
</div>
</div></div>
</div>