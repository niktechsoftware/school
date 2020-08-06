<?php $school_code = $this->session->userdata("school_code");?>
<?php $fsdt=$this->session->userdata('fsd');?>
<div class="row">
	<div class="col-md-12">
		<!-- start: EXPORT DATA TABLE PANEL  -->
		<div class="panel panel-white">
			<div class="panel-heading">
				<h4 class="panel-title">
					Day <span class="text-bold">Book</span> Report
				</h4>
				<div class="panel-tools">
					<div class="dropdown">
						<a data-toggle="dropdown"
							class="btn btn-xs dropdown-toggle btn-transparent-grey"> <i
							class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu dropdown-light pull-right" role="menu">
							<li><a class="panel-collapse collapses" href="#"><i
									class="fa fa-angle-up"></i> <span>Collapse</span> </a></li>
							<li><a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i>
									<span>Refresh</span>
							</a></li>
							<li><a class="panel-config" href="#panel-config"
								data-toggle="modal"> <i class="fa fa-wrench"></i> <span>Configurations</span>
							</a></li>
							<li><a class="panel-expand" href="#"> <i class="fa fa-expand"></i>
									<span>Fullscreen</span>
							</a></li>
						</ul>
					</div>
					<a class="btn btn-xs btn-link panel-close" href="#"> <i
						class="fa fa-times"></i>
					</a>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12 space20">
						<div class="btn-group pull-right">
							<button data-toggle="dropdown"
								class="btn btn-green dropdown-toggle">
								Export <i class="fa fa-angle-down"></i>
							</button>
<?php if($this->session->userdata('login_type') == 'admin'){?>
<ul class="dropdown-menu dropdown-light pull-right">
									<li><a href="#" class="export-excel"
									data-table="#sample-table-2"> Export to Excel </a></li>
								
							</ul>
<?php }?>
</div>
					</div>
				</div>

<?php $dt1=date("d-m-Y",strtotime($dt1));?>
<?php $dt2=date("d-m-Y",strtotime($dt2)); $v=1;?>
<div class="center">
					<strong>
						<h2 style='color: green'> Record From Date <?php echo $dt1;?> to <?php echo $dt2;?></h2>
					</strong>
				</div>


				<div class="table-responsive">
					<table class="table table-striped table-hover" id="sample-table-2">
						<thead>
							<tr>
								<th>#</th>
								<th>Paid To</th>
								<!--<th>Paid By Name</th>-->
								<th>Paid By</th>
								<th style="width: 250px;">Reason</th>
								<th>Discount Amount</th>

								<th>Debit</th>
								<th>Credit</th>

							<th>Closing Balance</th>

								<th>Pay Mode</th>
								<th>Pay Date</th>
								<th>Invoice Num</th>
								<th><?php if($this->session->userdata('login_type') == 'admin'){?>
								Activity
								<?php }?>
								</th>
							</tr>
						</thead>
						<tbody>
<?php
$count = 1;
	$sno = 1;
	foreach ( $a->result () as $row1 ) {
		$this->db->where("invoice_no",$row1->invoice_no);
		$dbinvoice = $this->db->get("day_book");
		$row =$dbinvoice->row();
		$dr_cr = $row->dabit_cradit;
		$unm = $row->paid_by;
		$this->db->where ( "id", $row->paid_by );
		$sinfo = $this->db->get ( "student_info" )->row ();
		// $sinfo->id;
		if ($count % 2 == 0) {
			$rowcss = "danger";
		} else {
			$rowcss = "warning";
		}
		?>
<tr class="<?php echo $rowcss;?>">
								<td><?php echo $sno; ?></td>
								<td><input type ="hidden" id ="invoiceid<?php echo $sno;?>" value="<?php echo $row->invoice_no; ?>"/><?php echo $row->paid_to; ?></td>
<?php
		$id = $this->db->query ( "SELECT name From student_info where id ='$row->paid_by'" )->row ();
		$id_4 = $this->db->query ( "SELECT name,username,class_id From student_info where id ='$row->paid_by'" );
		$id2 = $id_4->row ();
		$id_5 = $id_4->num_rows ();
		?>
	<td><?php
		if ($id2) {
			echo strtoupper ( $id2->name ) . " " . "[" . ($id2->username) . "]";
		} else {
			$eid = $this->db->query ( "SELECT username From employee_info where id ='$row->paid_by' AND school_code='$school_code'" )->row ();
			if ($eid) {
				echo $eid->username;
			} else {
				echo $row->paid_by;
			}
		}
		?>
	</td>
	<td><?php
		$this->db->where("receipt_no",$row->invoice_no);
		$cpm = $this->db->get("cash_payment")->row();

			echo $cpm->reason;
		
		?></td>
<?php
		$this->db->where ( 'school_code', $this->session->userdata ( 'school_code' ) );
		$this->db->where ( 'invoice_number', $row->invoice_no );
		$discountid = $this->db->get ( 'dis_den_tab' );
		if ($discountid->num_rows () > 0) {
			?><td><?php echo $discountid->row()->discount_rupee ; ?></td>
<?php }else{?>
<td>0.00</td>
<?php } ?>

								<td style="color: red"><?php if($dr_cr == 0 ){ $dabit = $dabit + $row->amount; echo $row->amount; } ?></td>
								<td style="color: green"><?php if($dr_cr == 1 ){ $cradit = $cradit + $row->amount; echo $row->amount; } ?></td>


<td><?php $datep = date("Y-m-d",strtotime($row->pay_date)); echo $this->daybookmodel->getClosingBalanceForDaybook($datep,$row->id); ?></td>

<td><?php if($row->pay_mode==1){ echo "Cash"; } elseif($row->pay_mode==2){ echo "Online Transfer" ;} elseif($row->pay_mode==3){ echo "Bank Chalan" ;} elseif($row->pay_mode==4){ echo "Cheque" ;}elseif($row->pay_mode==5){ echo "Swap Machine" ;}else{ echo "Cash Payment";} ?></td>
								<td><?php echo $row->pay_date; ?></td>

								<td>
<?php 
if(($row1->heads == 3)){ ?>
<a href="<?php echo base_url()?>index.php/invoiceController/printSaleReciept/<?php echo $row->invoice_no;?>" class="btn btn-blue">
<?php echo $row->invoice_no;  ?>
</a>
<?php }
if(($row1->heads == 5)){ ?>
<a href="<?php echo base_url()?>index.php/invoiceController/fee/<?php echo $row->invoice_no;?>" class="btn btn-blue">
<?php echo $row->invoice_no;  ?>
</a>
<?php }
if(($row1->heads == 6) || ($row1->heads == 7) || ($row1->heads == 8) || ($row1->heads == 10)){?>
<a href="<?php echo base_url()?>index.php/dayBookControllers/invoiceCashPayment/<?php echo $row->invoice_no;?>/<?php echo $fsdt;?>/<?php if($v == 1){echo 'true'; } ?>" class="btn btn-blue">
<?php echo $row->invoice_no;  }
if(($row1->heads == 4)){?>
<a href="<?php echo base_url()?>index.php/invoiceController/printDueFee/<?php echo $row->invoice_no;?>/<?php echo $fsdt;?>/<?php if($v == 1){echo "true"; } ?>"
		class="btn btn-blue">
		<?php echo $row->invoice_no;  } ?>
								
								</td>
								<td><?php if($this->session->userdata('login_type') == 'admin'){
									if(($row->invoice_no=="Delete Fee")||($row->invoice_no=="Delete")){}else{
								?>
								<button	id ="delb<?php echo $sno;?>" class="btn btn-red">
Delete</button>
								<?php }}?>
								<script>
								 $("#delb<?php echo $sno;?>").click(function(){ 
										var invoice_id = $("#invoiceid<?php echo $sno?>").val();
										
								$.post("<?php echo site_url("index.php/dayBookControllers/deleteBanTrans") ?>",{invoice_id : invoice_id}, function(data){
									$("#delb<?php echo $sno;?>").html(data);
											});
									});
			
								</script>
								</td>
							</tr>
<?php $sno++; $count++;} 



?>
</tbody>
						<tfoot>
							<tr>
								<td>----</td>
								<td>----------</td>
								<td align="right"><strong>Total</strong></td>
								<td>----------</td>
								<td>----------</td>
								<td>----------</td>
								<td><?php echo $dabit; ?></td>
								<td><?php echo $cradit; ?></td>
								<td>----------</td>
								<td>----------</td>
								<td>----------</td>
							</tr>
						</tfoot>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>




