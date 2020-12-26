<div class="row">
  <div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-pink">
        <h3 class="panel-title">Export <span class="text-bold">Simple Employee List</span></h3>
        <div class="panel-tools">
          <div class="dropdown">
            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
              <i class="fa fa-cog"></i>
            </a>
            <ul class="dropdown-menu dropdown-light pull-right" role="menu" style="display: none;">
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
          <!-- <a class="btn btn-xs btn-link panel-close" href="#">
          <i class="fa fa-times"></i>
        </a> -->
        </div>
      </div>
				      <div class="panel-body">
        <div class="alert alert-info">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to Simple Employee List Area</h3>
            Here you can see all the employees list, if you want to see full detail of employees, then choose employee id and click on full profile button.And you can also
            print employee Icard by click on that Employee Id.
        </div>
					<div class="row">
						<div class="col-md-12 space20">
							<!-- <button class="btn btn-orange add-row">
								Add New <i class="fa fa-plus"></i>
							</button> -->
							<div class="btn-group pull-right">
								<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
									Export <i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu dropdown-light pull-right">
									<!--<li>-->
									<!--	<a href="#" class="export-pdf" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as PDF-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-png" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as PNG-->
									<!--	</a>-->
									<!--</li>-->
									<li>
										<a href="#" class="export-csv" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as CSV
										</a>
									</li>
									<!--<li>-->
									<!--	<a href="#" class="export-txt" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as TXT-->
									<!--	</a>-->
									<!--</li>-->
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
									<!--<li>-->
									<!--	<a href="#" class="export-excel" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Export to Excel-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-doc" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Export to Word-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-powerpoint" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Export to PowerPoint-->
									<!--	</a>-->
									<!--</li>-->
								</ul>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<div class="table-responsive">
							<table class="table table-striped table-hover" id="sample-table-2">
								<thead>
									<tr>
										<th>SNo.</th>
										<th>Employee ID</th>
										<th>Full Name</th>
										<th>Job Category</th>
										<th>Mobile</th>
										<th>Address</th>
										<th>Email</th>
										<th>Settings</th>
									</tr>
								</thead>
								<?php
									$this->db->where("school_code",$this->session->userdata("school_code"));
								 	$this->db->where("status",1);
									$result = $this->db->get("employee_info");
								?>
								<tbody>
									<?php $sno = 1; foreach ($result->result() as $row): ?>
									<tr class="text-uppercase">
										<td style="color:black"><?php echo $sno; ?></td>
										<td style="color:DodgerBlue"><a href="<?php echo base_url(); ?>index.php/employeeController/empicard/<?php echo $row->id; ?>"><?php echo $row->username; ?></a></td>
										<td><?php echo $row->name?></td>
									    <td><?php  $this->db->where("id",$row->job_category);
									              $jobcat=$this->db->get('emp_category')->row();
									              echo $jobcat->Name; ?></td>
										<td><i class="fa fa-phone" aria-hidden="true"><?php echo $row->mobile; ?></i></td>
										<td><?php echo $row->address ?></td>
										<td class="text-lowercase"><?php echo $row->email; ?></td>
										<td><a href="<?php echo base_url(); ?>index.php/employeeController/employeeProfile/<?php echo $row->username;?>">
										    <?php if($row->photo){?>
										    <img  class="img-circle" height="50" width="50" src="https://schoolerp-niktech.in/a_school/9/images/empImage/<?php echo $row->photo;?>"/>
										    <?php }else{?>
										    <img src="https://www.schoolerp-niktech.in/a_school/icon/1.png" class="img-circle" style="height:50px; width:50px;" alt="">
								       <?php }?>
								        </a>
								<!--	<?php if($row->status == 0){ ?><a href="<?php echo base_url(); ?>index.php/employeeController/active_employee/<?php echo $row->username;?>" class="btn btn-red">InActive</a><?php } else{?>
									<a href="<?php echo base_url(); ?>index.php/employeeController/active_employee/<?php echo $row->username;?>" class="btn btn-green">Active</a><?php } ?>--> 
									</td>
									</tr>
									<?php $sno++; endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- end: EXPORT DATA TABLE PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->
</div>
