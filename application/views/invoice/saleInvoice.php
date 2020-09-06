<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Sale Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/print.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/example.js'></script>
<style type="text/css">
  @media print {
    body * {
      visibility: hidden;
    }

    #printcontent * {
      visibility: visible;
    }

    #printcontent {
      position: absolute;
      top: 40px;
      left: 30px;
    }
  }
  
  .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
  cursor: pointer;
}
  
  
  .button2 {
  background-color: #008CBA; 
  color: white; 
  border: 2px solid #008CBA;
}

.button2:hover {
  background-color: #4CAF50;
  color: white;
  border: 2px solid #4CAF50;
}
  
  </style>

</head>

<body>
<div id="printcontent" class="container">
	<div id="page-wrap">
<h1><center>STOCK BILL INVOICE</center></h1>
		<!--<textarea id="header">STOCK BILL INVOICE</textarea>-->
		<?php 
		$school_code = $this->session->userdata("school_code");
		$school_info = mysqli_query($this->db->conn_id,"select * from school where id = '$school_code'");
        $info = mysqli_fetch_object($school_info);
      ?>		
		<table style="width: 100%;border:1px solid black;" >
			<tr>
				<td width="10%" style="border: none;">
					<img src="<?= base_url();?>assets/<?= $this->session->userdata('school_code') ?>/images/empImage/<?= $this->session->userdata('logo') ?>" alt="" style="width:100px; height:100px; float:right;" />
				</td>
				<td style="border: none;">
					<h1 align="center" style="text-transform:uppercase;"><?php echo $info->school_name; ?></h1>
			        <h3 align="center" style="font-variant:small-caps;">
						<?php echo $info->address1." ".$info->address2." ".$info->city; ?>
			        </h3>
			        <h3 align="center" style="font-variant:small-caps;">
						<?php echo $info->state." - ".$info->pin; ?>
			        </h3>
			        <h3 align="center" style="font-variant:small-caps;">
						<?php if(strlen($info->mobile_no > 0 )){echo "Phone : ".$info->mobile_no.", ";} ?>
			            <?php echo "Mobile : ".$info->mobile_no; ?>
			        </h3>
				</td>
			</tr>
		</table>
		
        
		<div style="clear:both"></div>
		<div style="clear:both"></div>
			<div id="customer">
        	<div style="display:inline-block;">
         <?php
 
	//$id = $this->uri->segment(3);

	$sqlb=$this->db->query("select * from sale_info where bill_no = '$id' AND school_code = '$school_code'");
	$rowb=$sqlb->row();
	//print_r($school_code);

	$category = $rowb->category;
	$valid_id = $rowb->valid_id;
	if($category == "Employee Id")
	{
		$sqlc=mysqli_query($this->db->conn_id,"select * from employee_info where id='$valid_id' AND school_code = '$school_code'");
		$rowc=mysqli_fetch_object($sqlc);
	}
		if($category == "Student Id")
	{     
		$sqlc=mysqli_query($this->db->conn_id,"select * from student_info where id='$valid_id' ");
		$rowc=mysqli_fetch_object($sqlc);
		//print_r($rowc);
		//print_r($valid_id);exit();
		if($rowc)
		{
			$this->db->where('school_code',$school_code);
			$this->db->where('id',$rowc->class_id);
			$dtt=$this->db->get("class_info");
		//	print_r($rowc->class_id);
		//	print_r($school_code);exit();
		if($dtt->num_rows()>0){
			$dt=$dtt->row();
			$sid=$dt->section;
			$this->db->where('id',$sid);
			$dt1=$this->db->get("class_section")->row();
		}
		}
	}

?>
            <table style="width: 100%;border:1px solid black;">
                    <tr><td style="border:none;"><strong>To</strong></td></tr>
                    <tr>
                    	<td style="border:none;">
                    	<?php if($category == '04'): ?>
                    		<?php echo strtoupper($rowb->valid_id); ?>
                    	<?php else: ?>
                    		<strong><?php echo strtoupper($rowc->name); ?></strong>
                    	<?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                    	<td style="border:none;">
                        	<?php
							if($category == "Employee Id")
							{
								echo '<strong>Mobile No. :</strong>'.$rowc->mobile;
							}
							if($category == "Student Id")
							{if($dtt->num_rows()>0){
								 if(strlen($dtt->row()->class_name)>0){
								echo '<strong>Class :</strong>'.strtoupper($dtt->row()->class_name).' - '.strtoupper($dt1->section); }
								 }else{ echo "N/A";}
							}
							?>
                    		
                        </td>
                    </tr>
            </table>
			</div>
            <div style="display:inline-block; float:right">
            <table style="width: 100%;border:1px solid black;">
                <tr>
                    <td class="meta-head" colspan="2"><h3>Purchase Order</h3></td>
                </tr>
                <tr>
                    <td class="meta-head">Reciept No.</td>
                    <td><?php echo $id;	?></td>
                </tr>
                <tr>
                    <td class="meta-head">
                    	<?php
							if($category == "Employee Id")
							{
								echo 'Employee ID :';
							}
							elseif($category == "Student Id")
							{
								echo 'Student ID :';
							}
							elseif($category == "04"){
								echo "Other ID";
							}
							?>
                    </td>
                    <td><?php //echo $valid_id; ?>
                   <?php if($category=="Student Id"){
						          $this->db->where('id',$valid_id);
							$sunm=$this->db->get('student_info');
                                                    }
							else if($category=="Employee ID"){
								  $this->db->where('id',$valid_id);
							$sunm=$this->db->get('employee_info');
						                                    	}else{
								  $this->db->where('id',$valid_id);
							$sunm=$this->db->get('employee_info');
						  	}
						 	if($sunm->num_rows()>0){
							echo	$sunm= $sunm->row()->username;}
						            ?>
                    </td>
                </tr>
                <tr>
                    <td class="meta-head">Date</td>
                    <td><?php echo date("d-M-Y", strtotime($rowb->date)); ?></td>
                </tr>
            </table>
            </div>
		
		</div>
		
		<table id="items" style="width: 100%;border:1px solid black;">
		 <tr>
		       <th width="5%">No.</th>
               <th width="12%">Item Code</th>
               <th width="30%">Item-Description/Size</th>
               <th width="9%">Quantity</th>
               <th width="11%">Unit Price</th>
               <th width="10%">Discount</th>
               <th width="12%">Total Price</th>
               <th width="11%">Total Pay</th>
		  </tr>
<?php $sqld=mysqli_query($this->db->conn_id,"select * from sale_info where bill_no = '$id' AND school_code = '$school_code'"); ?>
<?php $i = 1; while($s = mysqli_fetch_object($sqld)){ ?>		  
		  <tr class="item-row">
		      <td><cenetr><?php echo $i; ?></cenetr></td>
		      <td><center><?php echo strtoupper($s->item_no); $b = $s->item_no; ?></center></td>
		      <td><center>
			  	<?php 
				$sqle=mysqli_query($this->db->conn_id,"select * from enter_stock where item_no = '$b' AND school_code = '$school_code'");
				$rowe=mysqli_fetch_object($sqle);
				echo strtoupper($rowe->item_name.",".$rowe->item_cat.",".$rowe->item_size);
				 ?></center>
              </td>
		      <td><center><?php echo strtoupper($s->item_quant); ?></center></td>
		      <td><center><?php echo strtoupper($s->pries_per_item); ?></center></td>
		      <td><center><?php echo strtoupper($s->dis_rs); ?></center></td>
              <td><center><?php echo strtoupper($s->total_price); ?></center></td>
		      <td><center><?php echo strtoupper($s->sub_total); ?></center></td>
		  </tr>
        <?php $i++; } 
	$sqlb=mysqli_query($this->db->conn_id,"select SUM(dis_rs),SUM(item_quant),SUM(total_price),SUM(sub_total) from sale_info where bill_no = '$id' AND school_code = '$school_code'");
	$rowb=mysqli_fetch_array($sqlb);

    ?>		  
	 <tr>
		      <td colspan="3" align="right"><strong>Total</strong></td>
		      <td colspan="2"><?php echo $rowb['SUM(item_quant)']; ?></td>
		      <td><?php echo $rowb['SUM(dis_rs)']; ?></td>
              <td><?php echo $rowb['SUM(total_price)']; ?></td>
		      <td><?php echo $rowb['SUM(sub_total)']; ?></td>
		  </tr>
          <?php 
            $this->db->where('billno',$id);
            $sb=$this->db->get('sale_balance')->row();
          ?>
		  <tr>
		      <td class="total-line" colspan="2"><?php if($sb->paid > 0){?>
          	  					<strong>Amount Paid</strong>
          	  					<?php }else{?>
          	  					<strong>Amount Refund</strong>
          	  					<?php }?></td>
		      <td class="total-value"><div id="total"><?php echo $sb->paid; ?></div></td>
              <td class="total-line" colspan="4"><strong>Balance Due</strong></td>
		      <td class="total-value"><div id="total"><?php echo $sb->balance; ?></div></td>
		  </tr>
		</table>
		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>

	</div>
	</div>
</body>
<div class="invoice-buttons" style="text-align:center;">
    <button class="button button2" type="button"  onclick="window.print();">
      <i class="fa fa-print padding-right-sm"></i> Print Reciept
    </button>
  </div>
</html>