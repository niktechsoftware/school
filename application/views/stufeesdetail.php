<div class="row">
<div class="col-md-12">
<!-- start: RESPONSIVE TABLE PANEL -->
<div class="panel panel-white">
<div class="panel-heading panel-blue">
<h4 class="panel-title">Student <span class="text-bold">Fee Report</span></h4>
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
<div class="alert btn-purple">
    <button data-dismiss="alert" class="close">×</button>
<h4 class="media-heading text-center">Welcome to Student Fee Report Area</h4>
<p>
    Here you can see monthly Fee Report Detail.You can also take print out of that month on click Print Slip.
</p> 
</div>
 
					<div class="row">
						<div class="col-md-12 space20">
							<div class="btn-group pull-right">
								<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
									Export <i class="fa fa-angle-down"></i>
								</button>
								<?php if($this->session->userdata('login_type') == 'admin'){?>
								<ul class="dropdown-menu dropdown-light pull-right">
									<li>
										<a href="#" class="export-pdf" data-table="#sample-table-2" >
											Save as PDF
										</a>
									</li>
									<li>
										<a href="#" class="export-png" data-table="#sample-table-2">
											Save as PNG
										</a>
									</li>
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
									<li>
										<a href="#" class="export-xml" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as XML
										</a>
									</li>
									<li>
										<a href="#" class="export-sql" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as SQL
										</a>
									</li>
									<li>
										<a href="#" class="export-json" data-table="#sample-table-2" data-ignoreColumn ="3,4">
											Save as JSON
										</a>
									</li>
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
												
												<table class="table table-striped table-hover center table-responsive" id="f_tb">
												<thead>
												<tr class="text-center" style="background-color:#1ba593; color:white;">
												<th class="text-center">S No.</th>
												<th class="text-center">Student Id</th>
												
												<th class="text-center">Total Fees</th>
												<th class="text-center">Deposite Month</th>
												<th class="text-center">Payment Mode </th>
                                               <!-- <th class="text-center">Late Fees</th> -->
												<th class="text-center">Paid Amount</th>
												<th class="text-center">Pending Amount</th>
													<th class="text-center">Invoice Number</th>
													<th class="text-center">Deposit Date</th>
												<th class="text-center">Activity</th>
												<!-- <th>Activity</th> -->
												</tr>
											</thead>
											<tbody>
											<?php 
												$stuid=$this->uri->segment(3);
												$this->db->where("id",$stuid);
											//	$this->db->where("username",$this->session->userdata("username"));
												$id=$this->db->get("student_info")->row();
												// this is for getting school_code 
										     	$cid=$id->class_id;
										    	$this->db->where("id",$cid);
												$dt1=$this->db->get("class_info")->row();
												  $scd=$dt1->school_code; 
												  //echo $scd;
												  
												$this->db->where("student_id",$stuid);
												$dt=$this->db->get("fee_deposit")->result();
												
												  ?>
												  	<?php
												  	
												  	
												  	$this->db->where('school_code',$scd);
                                    				 $applymonth=$this->db->get("late_fees")->row()->apply_method;
                                    				?>
											
												<?php $v=1; foreach($dt as $row):
												?>
												 <?php if($v%2==0){$rowcss="warning";}else{$rowcss ="danger";}?>
	                             
												<tr class="<?php echo $rowcss;?> text-uppercase">
												<td class="text-center"><?php echo $v; ?> </td>
													<td class="text-center"><?php echo $id->username;?></td>
													
													<td class="text-center"><?php $dte= $row->total;
													//  if(($row->late)>0){
													// 	 $latefee=$row->late;
													// 	 $dte=$latefee+$dte1;

													//  }
													//  else{
													// 	 $dte=$dte1;
													//  }
													//  if(($row->transport)>0){
													// 	$trans= $row->transport;
													// 	$dte=$trans+$dte;
													//  }
													//  else{
													// 	 $dte=$dte;

													//  }
													
													echo $dte;?></td>
													
													<td class="text-center"><?php echo $row->deposite_month;?></td>
													<td class="text-center"> <?php if($row->payment_mode==1){ echo "Cash";} elseif($row->payment_mode==2){ echo "Online";}?></td>
												 	<!-- <td class="text-center"><?php echo $row->late;?></td>  -->
												 	<td class="text-center"><?php $pd= $row->paid; echo $pd?></td> 
												 	<td class="text-center"><?php $cr=$dte-$pd; echo $cr;?></td> 
												 		<td class="text-center"><?php  echo $row->invoice_no;?></td> 
														 <td class="text-center"><?php  echo $row->diposit_date;?></td> 
													 <td>
													<?php //$fsdt=$this->uri->segment(4);
													$this->db->where('school_code',$scd);
													$fsdt=$this->db->get('general_settings')->row()->fsd_id;
													if($row->invoice_no){
														if($row->payment_mode=='Due Print'){?>
															<a href="<?php echo base_url()?>index.php/invoiceController/printDueFee/<?php echo $row->invoice_no;?>/<?php echo $row->student_id;?>/<?php echo $fsdt;?>/<?php if($v == 1){echo "true"; } ?>" class="btn btn-blue">
															Print Slip
														</a>
													<?php	}else{?>
														<a href="<?php echo base_url()?>index.php/invoiceController/fee/<?php echo $row->invoice_no;?>/<?php echo $row->student_id;?>/<?php echo $fsdt;?>/<?php if($v == 1){echo "true"; } ?>" class="btn btn-blue">
															Print Slip
														</a>
														<?php }?>
															<?php if($this->session->userdata('login_type') == 'admin'){ ?>
														<a href="<?php echo base_url()?>index.php/feeControllers/deleteFee/<?php echo $row->invoice_no;?>/<?php echo $row->student_id;?>/<?php if($v == 1){echo "true"; } ?>" class="btn btn-warning">
															Delete Fee
														</a>
														<?php }}?>
													</td>
												</tr>	<?php $v++; endforeach; ?>
												
													</tbody>
												</table>

											</div>
										</div>
									</div>
									</div>