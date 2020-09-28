<div class="row">
	<div class="col-md-12">
	<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel">
			<div class="panel-heading panel-orange">
				<i class="fa fa-external-link-square"></i>
					Delete Invoice Window
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
								<a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i> <span>Refresh</span> </a>
							</li>
							<li>
								<a class="panel-config" href="#panel-config" data-toggle="modal"> <i class="fa fa-wrench"></i> <span>Configurations</span></a>
							</li>
							<li>
								<a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>


 <div class="panel-body">
     <div class="panel panel-white">
	<div class="alert alert-info">
					<button data-dismiss="alert" class="close">×</button>
					<h4 class="media-heading text-center">Welcome to Delete Invoice
						Area</h4>
					<p>Here you can see Delete Invoice Report Detail.</p>
				</div>
            <br/>
             <div class="table-responsive">
						<div class="table-responsive">
						<div  class="center text-bold"><strong style="text"></div>
							<table class="table table-striped table-hover" id="sample-table-2" >
			        	<thead>
						<tr class="text-center"
							style="background-color: #1ba593; color: white; height:50px;">
							<th class="text-center">S No.</th>
							<th class="text-center">Paid To </th>
							<th class="text-center">Paid By</th>
							<th class="text-center">Debit Cradit</th>
							<th class="text-center">Amount</th>
							<!-- <th class="text-center">Late Fees</th> -->
						
							<th class="text-center">Pay Date</th>
							<th class="text-center">Pay Mode</th>
							<th class="text-center">Invoice Number</th>
						
														<!-- <th>Activity</th> -->
						</tr>
					</thead>
					<tbody>
																							  												
												<?php $i=1; foreach($invoice1->result() as $row):?>													 	                             
												<tr class="danger text-uppercase" style="height:40px;">
													<td class="text-center"><?php echo $i;?> </td>
													<td class="text-center"><?php echo $row->paid_to;?></td>
						                    	<td class="text-center"><?php echo $row->paid_by;?></td>

														<td class="text-center"><?php echo $row->dabit_cradit;?></td>
														<td class="text-center"> <?php echo $row->amount;?></td>
														<!-- <td class="text-center">0.00</td>  -->
													
														<td class="text-center"><?php echo $row->pay_date;?></td>
														<td class="text-center"><?php echo $row->pay_mode;?></td>
														<td class="text-center"><?php echo $row->invoice_no;?></td>
																</tr>
																					 <?php $i++; ?>
                                                                          <?php endforeach;?>
																							 	                             
																								
													</tbody>
				</table>
            </div>
          </div>
          </div>
            </div>
          </div>
          </div>