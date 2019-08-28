<!--  
Niktech software Solutions,niktechsoftware.com,schoolerp-niktech.in
  <meta name="description" content="Welcome to niktech software School business ERP . we proving school management erp software. we including online attendance with biometric attendance machine and tracking student with GPS technology & many other facilities in our school management erp system">
  <meta name="keywords" content="Enterprise resource planning,school,ERP,system software,attendance,biometric,online, school management,gps,niktech software solution, online result, online admit card,omr">
  <meta name="author" content="School management System software">
-->
	<?php if($fsd) 
	{?>
	              
						<!-- <div class="row"> -->
							<!-- <div class="col-md-12"> -->
								<!-- start: EXPORT DATA TABLE PANEL  -->
								<div class="panel panel-white">
									<!-- <div class="panel-heading">
										<h4 class="panel-title"><span class="text-bold"></span></h4>
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
									</div> -->
									<div class="panel-body">
									<div class="row">
						<div class="col-md-12 space20">
							
							<div class="btn-group pull-right">
								<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
									Export <i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu dropdown-light pull-right">
									<!-- <li>
										<a href="#" class="export-pdf" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as PDF
										</a>
									</li>
									<li>
										<a href="#" class="export-png" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as PNG
										</a>
									</li> -->
									<li>
										<a href="#" class="export-csv" data-table="#sample-table-2" data-ignoreColumn =''>
											Save as CSV
										</a>
									</li>
									<li>
										<a href="#" class="export-txt" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as TXT
										</a>
									</li>
									<li>
										<!-- <a href="#" class="export-xml" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as XML
										</a>
									</li> -->
									<li>
										<a href="#" class="export-sql" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as SQL
										</a>
									</li>
									<!-- <li>
										<a href="#" class="export-json" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as JSON
										</a>
									</li> -->
									<li>
										<a href="#" class="export-excel" data-table="#sample-table-2" data-ignoreColumn ="3,4">
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
							</div>
						</div>
					</div>
										<?php
										$this->db->where("class_id",$cla);
										$class_fees_head = $this->db->get("class_fees");
										if($class_fees_head->num_rows()>0){
										$i=0 ;foreach($class_fees_head->result() as $cfh):
										?>
												<th><?php $headarray[] = $cfh->fee_head_name;?></th>

											<?php $i++; endforeach;
										?> 
										
										<div class="table-responsive">
											<table class="table table-striped table-hover" id="sample-table-2">
												<thead>
													<tr>
														<th>S.no.</th>
														<th>Student Id</th>
														<th>Student Name</th>
														<?php 
														foreach($headarray as $h):
														echo '<th>'.$h.'</th>';
														endforeach;?>
														<th>Total Fee</th>
														<th>Activity</th>
													</tr>
												</thead>
											<?php 
											$count = 1;
											$this->db->where("status",1);
											$this->db->where("class_id",$cla);
											$student = $this->db->get("student_info");
											if($student->num_rows()>0){
											?>
													<tbody>
													<?php foreach($student->result() as $stuDetail): ?>
													<tr>
														<td><?php echo $count;?></td>
														<td><?php echo $stuDetail->username;?></td>
														<td><?php echo $stuDetail->name;?></td>
														
														
														<?php $tot =0 ;
														foreach($headarray as $h):
													
															 $this->db->where("class_id",$cla);
															 $this->db->where("fee_head_name",$h);
														     $classfeeamount = $this->db->get("class_fees")->row();?>
															<td><?php $tot +=$classfeeamount->fee_head_amount; echo $classfeeamount->fee_head_amount;?></td>
													   <?php endforeach;?>
														
													    <td><?php echo $tot;?></td>
														<td> <a class="btn btn-info" href="<?php echo base_url();?>index.php/feeControllers/fullstudentfeeDetail/<?php echo $stuDetail->id;?>">View Detail</a>
														 </td>
														 </tr>
														 <?php $count++; endforeach?>
													</tbody>
													
													<?php }else{ echo "Data Not Found";}?>
											</table>
										</div>
										<?php }else{ echo "Data Not Found";}?>
									</div>
								
								<!-- end: EXPORT DATA TABLE PANEL -->

						<!-- end: PAGE CONTENT-->
						<?php	} 
	else
	{  ?>
				<br/><br/>
			<div class="alert alert-block alert-danger fade in">
				<button data-dismiss="alert" class="close" type="button">
					&times;
				</button>
				<h4 class="alert-heading"><i class="fa fa-times"></i> Error! <?php echo $student->num_rows();?></h4>
				<p>
					No record found from Fee database please submit fee first of this class &amp; section... 
				</p>
			</div>

	<br/><br/>
	<div class="alert alert-block alert-danger fade in">
		<button data-dismiss="alert" class="close" type="button">
			&times;
		</button>
		<h4 class="alert-heading"><i class="fa fa-times"></i> Error! <?php echo $student->num_rows();?></h4>
		<p>
			No record found from this class and section... 
		</p>
		<p>
			Make sure students are avaliable in this class section... :)
		</p>
	</div>
	</div>

	<?php }?>
		<script>
	<?php for($i=1;$i<$count;$i++){?>
	$("#update<?php echo $i;?>").click(function(){
		var stuid = $("#stdid<?php echo $i;?>").val();
		var tutionfee = $("#tutionfee<?php echo $i;?>").val();
		var computer_fee = $("#computer_fee<?php echo $i;?>").val();
		var transport_fee = $("#tranport_fee<?php echo $i;?>").val();
		var other_fee = $("#other_fee<?php echo $i;?>").val();
		$.post("<?php echo site_url("index.php/feeControllers/updateFeeS") ?>",{stuid : stuid,tutionfee : tutionfee,computer_fee : computer_fee,transport_fee : transport_fee,other_fee : other_fee}, function(data){
			$("#update<?php echo $i;?>").html(data);
		}); 
	});
	
		<?php }?>
	TableExport.init();
</script>		
			