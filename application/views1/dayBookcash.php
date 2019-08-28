<?php $school_code = $this->session->userdata("school_code");
?>

<script>
				TableExport.init();
		</script>
					<div class="col-md-12">
									<!-- start: EXPORT DATA TABLE PANEL  -->
									<div class="panel panel-white">
										<div class="panel-heading panel-green">
												<h4 class="panel-title">Day <span class="text-bold">Book</span> Report</h4>
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
												<?php $dts=date("d-m-Y",strtotime($dt1));?>
				<?php $dte=date("d-m-Y",strtotime($dt2));?>
				<div class = "center"><strong>
					<h2 style = 'color: green'> Record From Date <?php echo $dts;?> to <?php echo $dte;?></h2></strong>
				</div>
								<div class="table-responsive" style="width:100%; overflow-y: scroll;">
									<table class="table table-striped table-hover" id="sample-table-daybook">
										<thead>
												<tr>
		                    	<th>#</th>
		                    	<th>Expenditure Name</th>
		                    	<th>Total Amount</th>
		                        <th>View Details</th>
		                    </tr>
										</thead>
										<tbody>
									<?php $sno = 1; $altot = 0;foreach($a->result() as $row): 
		                	?>
		                	<tr>
		                    	<td><?php echo $sno; ?></td>
		                        <td><?php echo $row->expenditure_name; ?></td>
		                       <?php $totsum = $this->db->query("SELECT SUM(amount) as tot FROM cash_payment where expenditure_name ='$row->expenditure_name' and date >= '$dt1' AND date <= '$dt2' AND school_code='$school_code'")->row();?>
		                       <td><?php $altot +=$totsum->tot; echo $totsum->tot;?></td>
		                       <td width = "25%">
							<a href="<?php echo base_url()?>index.php/dayBookControllers/fullDetail/<?php echo $row->expenditure_name;?>/<?php echo $dt1;?>/<?php echo $dt2;?>" target="_blank" class="btn btn-blue">
								View Detail
							</a>
							
							
							
			  			</td>
		              </tr>
		                <?php $sno++; endforeach; ?>
		                	
		                </tbody>
		                <tfoot>
		                    <tr>
		                	<td></td>
		                    	<td>Total Amount</td>
		                       
		                        <td><?php echo $altot.'.00';?></td>
		                        <td></td>
		                    </tr>
		                </tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
			
