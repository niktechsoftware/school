<style>
.myth{
    color:black;
    font: 15px Arial, sans-serif bold 12px;
}
</style>
<div class="row">
    <div class="col-sm-12">
	<!-- start: FORM WIZARD PANEL -->
		<div class="panel panel-white">
		    <div class="panel-heading panel-blue">
			    <h4 class="panel-title">Student Purchase  <span class="text-bold">Details</span></h4>
				    <div class="panel-tools">
					    <div class="dropdown">
						    <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
								<i class="fa fa-cog"></i>	</a>
								<ul class="dropdown-menu dropdown-light pull-right" role="menu">	<li>
									<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
										</li>
											<li>
											<a class="panel-refresh" href="#">
											<i class="fa fa-refresh"></i> <span>Refresh</span>	</a>	</li>
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
										</div>
									</div>
									<div class="panel-body">
									    <div class="alert alert-info">
                                					<button data-dismiss="alert" class="close">×</button>
                                					<h4 class="media-heading text-center">Welcome to Student Stock Report
                                						Area</h4>
                                					<p>Here Stundent  can see their Stock purchasing report.You can also take
                                						print out of that month on click Print Slip.</p>
                                				</div>
									    	<?php $v=$this->session->userdata('username'); 	
											$this->db->where('username',$v);
											$vid=$this->db->get('student_info')->row();
											$v1= $vid->id;
										$this->db->where("school_code",$this->session->userdata("school_code"));
										 $this->db->where("valid_id",$v1);
								   				 $row = $this->db->get("sale_info"); ?>
								   		    <div class="table-responsive">
								    		<table class="table table-striped table-hover" id="sample-table-2"> 
								    				<thead><tr>
								    				<th class="myth">S.No</th>
								    				<th class="myth">Item No.</th>
								    				<th class="myth">Purchase Date</th>
								    				<th class="myth">Total Balance</th>
								    				<th class="myth">Total Paid</th>
								    				<th class="myth">Bill No.</th>
								    				</tr>
								    			</thead>
								    			<tbody>	
								    		<?php		$i=1; 	
								    		foreach($row->result() as $rows):
								      		$this->db->where("bill_no",$rows->bill_no);
								      		$fee = $this->db->get("sale_info");
								      		$this->db->where("invoice_no",$rows->bill_no);
								      		$bill=$this->db->get("day_book");?>
								    				<tr>
								    				<td> <?php echo $i;?> </td>
								    				<td> <?php echo $rows->item_no;?> </td>
								    				<td> <?php echo $rows->date;?> </td>
								    				<td> <?php if($fee->num_rows()>0){ echo $fee->row()->total_price;}else{ echo "0.00";}?> </td>
								    				<td> <?php if($bill->num_rows()>0){echo $bill->row()->amount;}else{ echo "0.00";}?> </td>
								    				<td> <?php echo $fee->row()->bill_no;?> </td>
								    				</tr>
								    				<?php $i++; 
								    				endforeach; ?>
								    			</tbody>	
								    		</table>
										</div>
									</div>
								</div>
							</div>
						</div>
								