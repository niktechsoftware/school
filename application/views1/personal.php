
<div class="col-md-12">
	<div class="panel">
		<div class="panel-heading panel-blue border-light">
			<h4 class="panel-title">Student Fee Detail</h4>
		</div>
		<div class="panel-body panel-scroll height-450" >
		<table class="table table-bordered table-hover ">
		<thead>
		<tr>
		<th class="text-center">S No.</th>
		<th class="text-center">Student Id</th>
		<th class="text-center">Total Amount</th>
		<th class="text-center">Total Paid</th>
		<th class="text-center">Current Balance</th>
		<th class="text-center">Deposit Month</th>
		<th class="text-center">Deposit Date</th>
		<th class="text-center">Activity</th>
		<!-- <th>Activity</th> -->
		</tr>
	</thead>
	<tbody>
		<?php $id = 0; ; 
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$fsd=$this->db->get("general_settings")->row()->fsd_id;?>
		<!--  <?php $fsd1=date("Y-m-d", strtotime("$fsd + 1 month")); ?>  -->
		<?php $v=1; foreach($request as $row):
		    	$this->db->where("id",$fsd);
			$fdate =	$this->db->get("fsd")->row()->finance_start_date;

								$this->db->where("student_id",$this->uri->segment(3));
								$this->db->where("fsd",$fsd);
								$fee_record = $this->db->get("deposite_months");
							// print_r($fee_record->result());
							// exit;
			               $i=1;
							foreach($fee_record->result() as $fd):
		?><tr>
		    <td class="text-center"><?php echo $i; $id=$row->student_id;?> </td>
			<td class="text-center"><?php echo $this->uri->segment(3);?></td>
			<td class="text-center"><?php echo $row->total;?></td>
			<td class="text-center"><?php echo $row->paid;?></td>
			 <?php $balance=$row->total-$row->paid;?>
			<td class="text-center"><?php echo sprintf("%.2f", $balance);?></td>
			<td class="text-center">
		 
			<?php 	
		
								
							 if($fd->deposite_month<4){
								$realm=  $fd->deposite_month-4+12;
							}else{
							 $realm= $fd->deposite_month-4;}
							 ?>
								<span class="label label-success" style="line-height:20px;">
								<?php 
								echo date('M-Y', strtotime("$realm months", strtotime($fdate)));
								?>
								 </span>
									
							<?php ?>
			</td>
		 	<td class="text-center"><?php echo date("d-M-Y", strtotime("$row->diposit_date"));?></td> 
			<!--  <td><?php echo $row->status;?></td> -->
			<td class="text-center">
			<?php if($row->invoice_no){?>
				<a href="<?php echo base_url()?>index.php/invoiceController/fee/<?php echo $row->invoice_no;?>/<?php echo $row->student_id;?>/<?php if($v == 1){echo "true"; } ?>" class="btn btn-blue">
					Print Slip
				</a>
					<?php if($this->session->userdata('login_type') == 'admin'){ ?>
				<a href="<?php echo base_url()?>index.php/feeControllers/deleteFee/<?php echo $row->invoice_no;?>/<?php echo $row->student_id;?>/<?php echo $fsdorg;?>/<?php if($v == 1){echo "true"; } ?>" class="btn btn-warning">
					Delete Fee
				</a>
				<?php }}?>
			</td>
		</tr>	<?php $i++; endforeach;   $v++; endforeach; ?>
		
		<!-- <?php // $query1 = $this->db->query("SELECT * FROM feedue2 WHERE student_id='$id'")->result();
		//foreach($query1 as $v1):?>
		<tr>
		<td><?php //echo $v;?></td>
		<td><?php //echo $row->username;?></td>
		<td><?php //echo $v1->total_due;?></td>
		<td><?php //echo $v1->paid;?></td>
		<td><?php //echo $v1->remain;?></td>
		<td>Due Fee</td>
		<td><?php //echo $v1->ddate;?></td>
		<td>Due Fee</td>
		<td>
				<a href="<?php echo base_url()?>index.php/invoiceController/printDueFee/<?php echo $v1->invoice_no;?>" class="btn btn-blue">
					Print Slip
				</a>
				<?php //if($this->session->userdata('login_type') == 'admin'){ ?>
				<a href="<?php //echo base_url()?>index.php/feeControllers/deleteFeedue2/<?php //echo $v1->invoice_no;?>/<?php //echo $v1->student_id;?>/<?php //echo $fsdorg;?>/<?php// if($v == 1){echo "true"; } ?>" class="btn btn-warning">
					Delete Fee
				</a>
				<?php //}?>
			</td></tr>
		<?php //endforeach;?> -->
			</tbody>
		</table>
		</div>
	</div>
</div>
									

