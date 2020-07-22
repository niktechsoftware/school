<div class="row">
	<div class="col-md-12">
	<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading">
				<i class="fa fa-external-link-square"></i>
					Print Sale Receipt here :
			</div>
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
			<div class="panel-body">

						<div class="alert alert-info"><h3 class="media-heading text-center">Welcome to the Print Receipt Area</h3><p class="media-timestamp">Details of stuff bought or sold by a student or employee, by going to the print receipt and clicking on the print button, you get the complete stock item details..</div>
				 <?php
				 $school_code = $this->session->userdata("school_code");


				 // $check = mysqli_query($this->db->conn_id,"select * from sale_info WHERE school_code='$school_code' GROUP BY bill_no");
					// $num =$check->num_rows;
				 $this->db->where("school_code",$school_code);
				 $this->db->group_by('bill_no');
				 $dt=$this->db->get("sale_info");
						//print_r($dt );
					if($dt->num_rows()> 0){

						$saledt =$dt->result();

				   ?>
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
									<!--<li>-->
									<!--	<a href="#" class="export-csv" data-table="#sample-table-2" >-->
									<!--		Save as CSV-->
									<!--	</a>-->
									<!--</li>-->
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
										<a href="#" class="export-excel" data-table="#sample-table-2" >
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
								<?php }?>
							</div>
						</div>
					</div>
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="sample-table-2">
						<thead>
					    	<tr>
					        	<th>Student Id/Employee Id : </th>
					            <th>Receipt No : </th>
					            <th>Purchase Date : </th>

					            <th>Paid Amount : </th>

					             <th>Balance : </th>
					            <th>Action : </th>
					        </tr>
				       	</thead>
				       	<tbody>

						<?php //$dt1=mysqli_fetch_array($check);

						foreach($saledt as $row ){ 
							$bill=$row->bill_no;
							$valid_id=$row->valid_id;
							$this->db->where("billno",$bill);
							$dt2=$this->db->get("sale_balance")->row();
							if($row->category=="Student Id"){
							$this->db->where('id',$row->valid_id);
							$sunm=$this->db->get('student_info');}
							else if($row->category=="Employee ID"){
								$this->db->where('id',$row->valid_id);
							$sunm=$this->db->get('employee_info');
							}else{
								$this->db->where('id',$row->valid_id);
							$sunm=$this->db->get('employee_info');
							}
							if($sunm->num_rows()>0){
								$sunm= $sunm->row()->username;
						            ?>
							<tr>
					        	<td><?php echo $sunm; ?></td>
					            <td><?php echo $dt2->billno; ?></td>
					            <td><?php echo $dt2->date; ?></td>
					             <td><?php echo $dt2->paid; ?></td>
					            <td><?php echo $dt2->balance; ?></td>
					            <td><a href="<?php echo base_url()?>index.php/invoiceController/printSaleReciept/<?php echo $row->bill_no; ?>" target="_blank" class="btn btn-green btn-gradient">Print</a></td>
					        </tr>
					<?php 
					}else{ 
					$sunm= $row->valid_id ;
					?>
						
						<tr>
					        	<td><?php echo $sunm; ?></td>
					            <td><?php echo $dt2->billno; ?></td>
					            <td><?php echo $dt2->date; ?></td>
					             <td><?php echo $dt2->paid; ?></td>
					            <td><?php echo $dt2->balance; ?></td>
					            <td><a href="<?php echo base_url()?>index.php/invoiceController/printSaleReciept/<?php echo $row->bill_no; ?>" target="_blank" class="btn btn-green btn-gradient">Print</a></td>
					        </tr>
					<?php }
				}

						}
					?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

