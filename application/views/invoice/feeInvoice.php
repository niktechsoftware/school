
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>Fee Invoice</title>
<link rel='stylesheet' type='text/css'
	href='<?php echo base_url(); ?>assets/css/invoice_css/style.css' />
<link rel='stylesheet' type='text/css'
	href='<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css' />
<link rel='stylesheet' type='text/css'
	href='<?php echo base_url(); ?>assets/css/invoice_css/print.css'
	media="print" />
<script type='text/javascript'
	src='<?php echo base_url(); ?>assets/js/invoice_js/jquery-1.3.2.min.js'></script>
<script type='text/javascript'
	src='<?php echo base_url(); ?>assets/js/invoice_js/example.js'></script>
<style type="text/css">
.highlight {
	margin-top: 10px;
}

@media print {
	body * {
		visibility: hidden;
	}
	#printcontent * {
		visibility: visible;
	}
	#printcontent {
		position: absolute;
	}
	.half_slip {
		width: 50%;
	}
	.top_shift {
		margin-top: -700px;
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
<script>
        function convert_number(number)
        {
            if ((number < 0) || (number > 999999999))
            {
                return "Number is out of range";
            }
            var Gn = Math.floor(number / 10000000);  
            number -= Gn * 10000000;
            var kn = Math.floor(number / 100000);     /* lakhs */
            number -= kn * 100000;
            var Hn = Math.floor(number / 1000);      /* thousand */
            number -= Hn * 1000;
            var Dn = Math.floor(number / 100);       /* Tens (deca) */
            number = number % 100;               /* Ones */
            var tn= Math.floor(number / 10);
            var one=Math.floor(number % 10);
            var res = "";

            if (Gn>0){
                res += (convert_number(Gn) + " Crore");
            }
            if (kn>0){
                res += (((res=="") ? "" : " ") +
                    convert_number(kn) + " Lakhs");
            }
            if (Hn>0){
                res += (((res=="") ? "" : " ") +
                    convert_number(Hn) + " Thousand");
            }

            if (Dn){
                res += (((res=="") ? "" : " ") +
                    convert_number(Dn) + " hundred");
            }


            var ones = Array("", "One", "Two", "Three", "Four", "Five", "Six","Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen","Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen","Nineteen");
            var tens = Array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty","Seventy", "Eigthy", "Ninety");

            if (tn>0 || one>0)
            {
                if (!(res==""))
                {
                    res += " and ";
                }
                if (tn < 2)
                {
                    res += ones[tn * 10 + one];
                }
                else
                {

                    res += tens[tn];
                    if (one>0)
                    {
                        res += ("-" + ones[one]);
                    }
                }
            }

            if (res=="")
            {
                res = "zero";
            }
            return res;
        }

    </script>
</head>

<body>

	<div id="printcontent" style="width: 95%;">
		<div class="col-md-12 row">
			<table id="items">
				<tbody>
<?php 
for($nop=1;$nop <= $numberofReciept;$nop++ ){
	$school_code=$this->session->userdata("school_code");
	$tdiscount=0;
	$this->db->where("id",$school_code);
	$info =$this->db->get("school")->row();

	$size =$numberofReciept/$numberofRecieptRow;
	$font = $font1;
	if($nop%2==0){
		$receiptname = "School Copy";
	}else{
		$receiptname = "Student Copy";
	}
	if($size > 1){
		echo "<td>";
		$font = $font1-$size;
	}else{
		echo '<tr class ="highlight" style="border:5px solid wight; width: 100%; margin: 0 auto; ">';
		echo '<td style="border:5px solid wight; width: 100%; margin: 0 auto; ">';
	}
	?>
	<div style="width: 100%;">
						<h3 class="text-danger text-center text-uppercase"><?php echo "<br>".$receiptname;?></h3>
						<div id="page-wrap"
							style="border: 1px solid #333; width: 100%; margin-top: 10px;">
							<div style="margin: 5px;">
								<table style="width: 100%; border: 1px solid black;">
									<tbody>
										<tr style="background-color: #a1d657" class='text-uppercase'>
											<td width="10%" style="border: none; text-align: center;"><img
												src="<?php echo $this->config->item('asset_url'); ?><?= $school_code ?>/images/stuImage/<?php echo $rowc->photo; ?>"
												alt="" style="width: 60px; height: 60px; padding: 2px;" /></td>
											<td style="border: none; text-align: center;"><span style="text-transform:uppercase; margin-top:0; margin-bottom:0; font-size:<?php echo $font+8;?>px;"><b><?php echo $info->school_name; ?></b></span><br>
													<span style="font-variant:small-caps; margin-top:0; margin-bottom:0; font-size:<?php echo $font+4;?>px"><?php echo $info->address1." ,".$info->city; ?></span>
													<span style="font-variant:small-caps; margin-top:0; margin-bottom:0;font-size:<?php echo $font+4;?>px">,<?php echo $info->state." - ".$info->pin; ?></span><br>
				        <?php if(strlen($info->fax_no > 0 )){ $mno=$info->fax_no;}else{ $mno=" ";}?>
				        <span style="font-variant:small-caps; margin-top:0; margin-bottom:0;font-size:<?php echo $font+4;?>px">
				            <?php echo "Contact No. : " ;
										if(strlen($info->mobile_no > 0 )){echo $info->mobile_no ;}

									if(strlen($info->other_mobile_no > 0 )){echo ", ".$info->other_mobile_no ;}
									?>
			           </span></td>
											<td width="10%" style="border: none; text-align: center"><img
												src="<?php echo $this->config->item('asset_url'); ?><?php echo $school_code;?>/images/empImage/<?= $this->session->userdata('logo') ?>"
												alt="" style="width: 60px; height: 60px; padding: 2px;" /></td>
										</tr>
									</tbody>
								</table>
							</div>
							<hr style="margin-top: 5px; margin-bottom: 0;">
								<div style="clear: both"></div>
								<div id="customer" style="margin: 5px;">
									<div style="display: inline-block; background-color: #e5952d;">
										<table>
											<tbody style="">
												<tr class='text-uppercase'>
													<td class="meta-head" style="padding:5px; font-size:<?php echo $font+1;?>px;">
														<b>Student Name</b>
														<td style="padding:5px; font-size:<?php echo $font;?>px;"><?php echo $rowc->name; ?></td>
													</td>
												</tr>
												<tr class='text-uppercase'>
													<td class="meta-head" style="padding:5px; font-size:<?php echo $font+1;?>px;">
														<strong>Father's Name</strong>
													<td style="padding:5px; font-size:<?php echo $font;?>px;"> <?php echo $pInfo->father_full_name; ?></td>
													</td>
												</tr>
												<tr class='text-uppercase'>
					<?php $this->db->where('id',$classname->section);
					$this->db->where('school_code',$this->session->userdata('school_code'));
					$section=$this->db->get('class_section')->row();
					?>
                    	<td class="meta-head" style="padding:5px; font-size:<?php echo $font+1;?>px;">
														<strong>Class & Sec. </strong>
													<td style="padding:5px; font-size:<?php echo $font;?>px;"><?php echo $classname->class_name ;?> - <?php echo $section->section ;?> 
						</td>
													</td>
												</tr>
												<tr class='text-uppercase'>
													<td class="meta-head" style="padding:5px; font-size:<?php echo $font+1;?>px;">
														<strong> Address </strong>
														<td style="padding:5px; font-size:<?php echo $font;?>px;"><?php echo $rowc->address1.'<br> '.$rowc->city.' - '.$rowc->pin_code;	?></td>
													</td>
												</tr>
											</tbody>
										</table>
									</div>

									<div
										style="display: inline-block; float: right; background-color: #e5952d">
										<table>
											<tbody>
												<tr class='text-uppercase'>
													<td class="meta-head" style="padding: 0 5px 0 5px; font-size:<?php echo $font+1;?>px;"><b>Receipt
															No.</b></td>
													<td style="padding: 0 5px 0 5px; font-size:<?php echo $font;?>px;"><?php echo $feeRecord->invoice_no; ?></td>
												</tr>
												<tr class='text-uppercase'>
													<td class="meta-head" style="padding: 0 5px 0 5px; font-size:<?php echo $font+1;?>px;">
														<b>Student ID </b>
													</td>
													<td style="padding: 0 5px 0 5px; font-size:<?php echo $font;?>px;" ><?php echo $rowc->username; $id = $rowc->id; ?></td>
												</tr>
												<tr class='text-uppercase'>
													<td class="meta-head" style="padding: 0 5px 0 5px; font-size:<?php echo $font+1;?>px;">
														<b> Mode </b>
													</td>
													<td style="padding: 0 5px 0 5px; font-size:<?php echo $font;?>px;"><?php if($feeRecord->payment_mode=="1"){echo "Cash Payment";}elseif($feeRecord->payment_mode=="2"){ echo "Online Transfer";}elseif($feeRecord->payment_mode=="3"){ echo "Bank Challan";}elseif($feeRecord->payment_mode=="4"){ echo "Cheque";}elseif($feeRecord->payment_mode=="5"){ echo "Swap Machine";}else{ echo "Cash Payment";} ?></td>
												</tr>
				<?php $this->db->where('school_code',$school_code);
				 $applymonth=$this->db->get("late_fees")->row()->apply_method;
				?>
                <tr class='text-uppercase'>
													<td class="meta-head"  style="padding: 0 5px 0 5px; font-size:<?php echo $font+1;?>px;">
														<b>No. of Month </b>
													</td>
													<td style="padding: 0 5px 0 5px; font-size:<?php echo $font;?>px;">

														<script> document.write(convert_number(<?php echo ($feeRecord->deposite_month)*($applymonth); ?>)); </script>

													</td>
												</tr>

												<tr class='text-uppercase'>
													<td class="meta-head" style="padding: 0 5px 0 5px; font-size:<?php echo $font+1;?>px;">
														<b>Deposit Date </b>
													</td>
													<td style="padding: 0 5px 0 5px; font-size:<?php echo $font;?>px;">
                    	<?php 
                    	echo date("d-M-y",  strtotime($feeRecord->diposit_date));
						?>					</td>
												</tr>
												<tr class='text-uppercase'>
													<td class="meta-head" style="padding: 0 5px 0 5px; font-size:<?php echo $font+1;?>px;">
														<b>Fee For </b>
													</td>
													<td style="padding: 0 5px 0 5px; font-size:<?php echo $font;?>px;">

                    	<?php 
                    	$i=1;foreach($printMonthDate as $mprint):
                    	
                    	echo $mprint;
                    	if($i%3==0){
                    		echo "<br>";
                    	}
                    	$i++; endforeach;
					?>
                </td>
												</tr>
											</tbody>
										</table>
									</div>

								</div>
							
							
							<div style="margin: 5px;">
								<table id="items" style="margin: 5px 0 0 0;">
									<tbody style="background-color: #ffff99">
										<tr class='text-uppercase'>
											<td colspan="3" align="center"
												style="background-color: green; color: white;"><b>Student
													Fee Details</b></td>
										</tr>
										<tr class='text-uppercase'>
											<th class="col-sm-1 text-center">No.</th>
											<th class="col-sm-8">PARTICULARS</th>
											<th class="col-sm-3 text-center">Amount</th>
										</tr>
			<?php 
				  $total=0;
				  if($fee_head->num_rows()>0)
				  { $i=1;
		  		    foreach($fee_head->result() as $feeh):
		  		    if($feeh->fee_head_name!= NULL){?>		  				  			
		  		<tr class='text-uppercase'>
											<td class="col-sm-1 text-center"><b> <?php echo $i;?></b></td>
											<td class="col-sm-8"><b><?php echo $feeh->fee_head_name;?></b></td>
											<td class="col-sm-3 text-center"><?php  if($feeh->taken_month==13){ $total+=$feeh->fee_head_amount*$demont; echo $feeh->fee_head_amount*$demont;}else{ $total+=$feeh->fee_head_amount; echo $feeh->fee_head_amount;}?></td>
										</tr>
		  		<?php $i++; }
		  		 endforeach;}?>	  				  				  				  				  				  				  				  				  				  		<tr>
											<tr class='text-uppercase'>
												<td class="text-center"><b><?php echo $i;?></b></td>
												<td class="col-sm-8"><b><?php echo "TRANSPORT FEE"; ?></b></td>
												<td class="text-center"><?php echo $feeRecord->transport; $i++?></td>
											</tr>
			
		<?php

				 if($feeRecord->late>0){?>

		  	     <tr class='text-uppercase'>
												<td class="col-sm-1 text-center"><b><?php echo $i;?></b></td>
												<td class="col-sm-8"><b><?php echo "LATE FEE"; ?></b></td>
												<td class="col-sm-3  text-center"><?php echo $lfee=$feeRecord->late; $i++;?></td>
											</tr>
				 <?php }	?> 
				<tr class='text-uppercase'>
												<td class="col-sm-1 text-center"><b><?php echo $i;?></b></td>
												<td class="col-sm-8"><b><?php echo "PREVIOUS MONTH BALANCE, IF ANY"; ?></b></td>
												<td class="col-sm-3 text-center"><?php  echo $prbalanace=$feeRecord->previous_balance; $i++;?></td>
											</tr>
                    <?php 
		
				$totdisc=$this->feemodel->getDiscount($feeRecord->invoice_no,$i);
				$totdisc=$totdisc+$tdiscount;?>
											<!--<hr style="margin-top:5px; margin-bottom:0;">-->
									
									</tbody>
								</table>

							<table
								style="width: 100%; margin-top: 2px; background-color: #4286f4">

								<tr class='text-uppercase'>

									<td class="col-sm-7" rowspan="3" style="color:white; font-size:<?php echo $font;?>px;" ><?php if(	strlen($feeRecord->description)>0){ if($feeRecord->description=="As Per Govt.Order Fee Of Months Apr, May and Jun are  remitted. "){}else{echo "Discription: ".$feeRecord->description."<br>";}}?>
				  	<strong> Received by :</strong><?php echo $info->school_name; ?> &nbsp <strong>Paid
											By :</strong> <?php echo $rowc->username;?><br> <strong>Paid
												Amount in Words : </strong><script> document.write(convert_number(<?php echo $feeRecord->paid; ?>)); </script>
											Only /-<br> This is computer generated invoice and verified
												by accountant. </td>

									<td class="col-sm-2 text-center"  style="background-color:#caf441; font-size:<?php echo $font;?>px;" >
										<strong>Total</strong>
									</td>
									<td class="col-sm-3 text-center"
										style="background-color: #caf441;"><?php echo sprintf('%0.2f',$feeRecord->total); ?> </td>
								</tr>

								<tr class='text-uppercase'>
									<td class="text-center text-nowrap"  style="background-color:#caf441; font-size:<?php echo $font;?>px;" >
										<strong>Amount Paid</strong>
									</td>
									<td class="text-center" style="background-color: #caf441"><?php echo $feeRecord->paid; ?></td>
								</tr>
								<tr class='text-uppercase'>
									<td class="text-center text-nowrap"
										style="background-color: #caf441; font-size: 10px;"><strong>Balance
											Due</strong></td>
									<!--<td class="text-center"  style="background-color:#caf441" ><?php //if($mbalance->num_rows()>0) { echo sprintf('%0.2f',$mbalance->row()->mbalance);}else{ echo '0.00';} ?></td>-->

									<td class="text-center" style="background-color: #caf441;"><?php $pd=$feeRecord->total - $feeRecord->paid;  echo $pd;  ?></td>
								</tr>
							</table>

						</div>
					</div>
					</div>
	<?php if($size > 1){
		echo "</td>";
	}else{
		echo "</td>";
		echo "</tr>";
	}
	if($nop%2==0){
		echo "</td>";
		echo "</tr>";
		echo '<tr class ="highlight">';
		
	}
	?>
	<!-- student copy-->
<?php }?>	
</tbody>
			</table>

		</div>
	</div>

</body>
<div class="invoice-buttons" style="text-align: center;">
	<button class="button button2" type="button" onclick="window.print();">
		<i class="fa fa-print padding-right-sm"></i> Print Receipt
	</button>
</div>