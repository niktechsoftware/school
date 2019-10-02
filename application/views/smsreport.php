<div class="row">
  <div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">

      <div class="panel-heading panel-pink">
        <h3 class="panel-title">Export <span class="text-bold">Sms Report List</span></h3>
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
          <h3 class="media-heading text-center">Welcome to SMS Report Panel</h3>
Here you can see all the sent sms Detals, if you want to Download click export Buttons to export sms report. 
        </div>
					<div class="row">
						<div class="col-md-12 space20">
							<a class = "btn btn-info" href="<?php echo base_url(); ?>index.php/login/smsreport">
												Send Message
												</a>
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
									<li>
										<a href="#" class="export-excel" data-table="#sample-table-2" data-ignoreColumn ="3,4">
										Export to Excel
										</a>
									</li>
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

										<!-- <th>Sent Number</th> -->
										<!-- <th>Full Name</th>
										<th>Job Title</th>
										<th>Mobile</th>
										<th>Address</th> -->
										<th>Sms</th>
										<!-- <th>Export To Excel</th> -->
                    <th>Date</th>
										<th>Total</th>
										<th>Update Status</th>
										<th>View</th>
									</tr>
								</thead>
								<?php
								// 	$this->db->where("school_code",$this->session->userdata("school_code"));
								// //	$this->db->where("status",1);
								// 	$result = $this->db->get("sent_sms_details");
									$this->db->select('*, COUNT(id) as total');

									$this->db->where("school_code",$this->session->userdata("school_code"));
									$this->db->group_by('sms'); 
								
									$this->db->order_by('total'); 
								
									$result=$this->db->get('sent_sms_details');
								//	echo "<pre>";
									// print_r($dt);
									// exit();
								?>
								<tbody>
									<?php $sno = 1; foreach ($result->result() as $row): ?>
									<tr class="text-uppercase">
										<td><?php echo $sno; ?></td>
									 

										<!-- <td><?php echo $row->sent_number; ?></td> -->
										<td><?php echo $row->sms; ?></td>
										<!-- <td><?php// echo $row->status ?></td> -->
										<td class="text-lowercase"><?php echo $row->date; ?></td>
										<td class="text-lowercase"><?php echo $row->total; ?></td>
										<td class="text-lowercase"><input type="hidden" id="msgid<?php echo $sno;?>" value="<?php echo $row->sms;?>">
									
										<button  id="update<?php echo $sno;?>" class="btn btn-red">Update</button>
									
											<!-- <button  id="updated<?php echo $sno;?>" class="btn btn-green">Updated</button> -->
									

										</td>

                   <td><a href="<?php echo base_url();?>index.php/smsAjax/viewsmsdetail/<?php echo $row->msg_id; ?>" class="btn btn-green"> View Sms Detail</a></td> 

										
									</tr>

									<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
									<script>
									$(document).ready(function(){
										// $('#updated<?php echo $sno;?>').hide();
										// $('#update<?php echo $sno;?>').show();
										$('#update<?php echo $sno;?>').click(function(){
											var msgid=$('#msgid<?php echo $sno;?>').val();
											alert(msgid);
										  	$.post('<?php echo site_url("smsAjax/updatesms_status");?>' , {msgid : msgid } , function(data){
													// if(data){
														alert(data);
														// $('#updated<?php // echo $sno;?>').show();
													//	$('#update<?php //echo $sno;?>').hide();
														$('#update<?php echo $sno;?>').html(data);
													//}

											     }
											
										    )

										});

									});
									TableExport.init();
									</script>
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
