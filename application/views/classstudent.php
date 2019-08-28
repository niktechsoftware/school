<div class="container">
<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-red">
				<h4 class="panel-title">Class Student <span class="text-bold"> Report</span></h4>
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
<!--<div class="alert btn-purple">-->
<!--				    			    <button data-dismiss="alert" class="close">×</button>-->
<!--<h4 class="media-heading text-center">Welcome to Simple search Student area</h4>-->
<!--<p>If you want student full details , then  Click on full profile link ,-->
<!--OR if you want to delete any student record then click on Delete link.<br>NOTE => if student Pay fee of any month-->
<!--then you can't Delete any record of Students.<br>-->
<!--And also we get Student Icard by click on username of that Student.-->
<!--</p> </div>-->
<div class="row">
						<div class="col-md-12 space20">
							<div class="btn-group pull-right">
								<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
									Export <i class="fa fa-angle-down"></i>
								</button>
								<?php if($this->session->userdata('login_type') == 'admin'){?>
								<ul class="dropdown-menu dropdown-light pull-right">
									<!--<li>-->
									<!--	<a href="#" class="export-pdf" data-table="#sample-table-2" >-->
									<!--		Save as PDF-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-png" data-table="#sample-table-2">-->
									<!--		Save as PNG-->
									<!--	</a>-->
									<!--</li>-->
									<li>
										<a href="#" class="export-csv" data-table="#sample-table-2" >
											Save as CSV
										</a>
									</li>
									<li>
										<a href="#" class="export-txt" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as TXT
										</a>
									</li>
									<!--<li>-->
									<!--	<a href="#" class="export-xml" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as XML-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-sql" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as SQL-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-json" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as JSON-->
									<!--	</a>-->
									<!--</li>-->
									<li>
										<a href="#" class="export-excel" data-table="#sample-table-2" >
											Export to Excel
										</a>
									</li>
									<li>
										<a href="#" class="export-doc" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Export to Word
										</a>
									</li>
									<li>
										<a href="#" class="export-powerpoint" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Export to PowerPoint
										</a>
									</li>
								</ul>
								<?php }?>
							</div>
						</div>
					</div>
<div class="table-responsive">
<table class="table table-striped table-bordered" style="width:100%; overflow-y: scroll;" id="sample-table-2">
<thead><tr class="text-uppercase">
<th>Sno</th>
<th>UserName</th>
<th>Name</th>
<th>Father Name</th>
<th>Mobile Number (SMS)</th>
<th>Address</th>
</tr></thead>
<?php
$this->db->where('class_id',$classid);
$this->db->where('status',1);
$this->db->where('fsd',$this->session->userdata('fsd'));
$student=$this->db->get('student_info')->result();
$sno =1;
foreach($student as $data)
{
    $this->db->where('student_id',$data->id);
    $father_full_name=$this->db->get('guardian_info')->row()->father_full_name;
  
    ?>
    <tr class="text-uppercase">
    <td><?php echo $sno;?></td>
    <td><?php echo $data->username;?></td>
    <td><?php echo $data->name;?></td>
    <td><?php echo $father_full_name;?></td>
	  <td><?php echo $data->mobile;?></td>
	  <td><?php echo $data->address1 ." ". $data->area ." ".$data->city ." ".$data->state;?></td>
	</tr>
  
    <?php 
   $sno++;
}

?>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
