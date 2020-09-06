<script>
				TableExport.init();
		</script>
					<div class="col-md-12">
									<!-- start: EXPORT DATA TABLE PANEL  -->
									<div class="panel panel-white">
										<div class="panel-heading panel-green">
												<h4 class="panel-title">Expenditure Detail</h4>
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
											<div class="row">
			<div class="col-md-12 space20">
				<div class="btn-group pull-right">
					<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
						Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu dropdown-light pull-right">
						<li>
							<a href="#" class="export-excel" data-table="#sample-table-daybook" >
								Export to Excel
							</a>
						</li>
						<!--<li>-->
						<!--	<a href="#" class="export-pdf" data-table="#sample-table-daybook" >-->
						<!--		Save as PDF-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-png" data-table="#sample-table-daybook">-->
						<!--		Save as PNG-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-csv" data-table="#sample-table-daybook" >-->
						<!--		Save as CSV-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-txt" data-table="#sample-table-daybook" data-ignoreColumn ="3,4">-->
						<!--		Save as TXT-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-xml" data-table="#sample-table-daybook" data-ignoreColumn ="3,4">-->
						<!--		Save as XML-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-sql" data-table="#sample-table-daybook" data-ignoreColumn ="3,4">-->
						<!--		Save as SQL-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-json" data-table="#sample-table-daybook" data-ignoreColumn ="3,4">-->
						<!--		Save as JSON-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-doc" data-table="#sample-table-daybook" data-ignoreColumn ="3,4">-->
						<!--		Export to Word-->
						<!--	</a>-->
						<!--</li>-->
						<!--<li>-->
						<!--	<a href="#" class="export-powerpoint" data-table="#sample-table-daybook" data-ignoreColumn ="3,4">-->
						<!--		Export to PowerPoint-->
						<!--	</a>-->
						<!--</li>-->
					</ul>
				</div>
			</div>
		</div>						
								<div class="table-responsive" style="width:100%; overflow-y: scroll;">
									<table class="table table-striped table-hover" id="sample-table-daybook">
										<thead>
											<tr>
												<th>S No.</th>
												<th>Expenditure Name</th>
												<th>Department </th>
												<th>paid</th>
												<th>Cash pay Date</th>
												<th>Paid Person</th>
												<th>reason</th>
												<th>Invoice No.</th>
												</tr>
										</thead>
										<tbody>
										<?php $v=1; $totdep = 0;foreach($request as $row):
												?><tr>
												<td><?php echo $v; ?> </td>
													<td><?php echo $row->expenditure_name;?></td>
													<td><?php echo $row->exp_depart;?></td>
													<td><?php $totdep+=$row->amount;echo $row->amount;?></td>
													<td><?php echo $row->date;?></td>
													<td><?php echo $row->name." ".$row->valid_id;?></td>
													<td><?php echo $row->reason;?></td>
													
													<td>
														<a href="<?php echo base_url()?>index.php/dayBookControllers/invoiceCashPayment/<?php echo $row->receipt_no;?>/<?php if($v == 1){echo "true"; } ?>" class="btn btn-blue">
															Print <?php echo $row->receipt_no;?>
														</a>
															<?php if($this->session->userdata('login_type') == 'admin'){ ?>
														<a href="<?php echo base_url()?>index.php/dayBookControllers/deleteCashPay/<?php echo $row->receipt_no;?>/<?php echo $row->expenditure_name;?>" class="btn btn-warning">
															Delete Slip
														</a>
														<?php }?>
													</td>
												</tr>	
												
												<?php $v++; endforeach;?>
											
										</tbody>
										<tfoot>
										    	<tr>
													<td>#</td>
													<td>Total Amount</td>
													<td></td>
													<td><?php echo $totdep;?></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>