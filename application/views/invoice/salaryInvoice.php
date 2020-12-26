
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title><?php echo $title;?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/print.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/example.js'></script>
    <script>
        function convert_number(number){
            if ((number < 0) || (number > 999999999)){
                return "Number is out of range";
            }
            var Gn = Math.floor(number / 10000000);  /* Crore */
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
                if (!(res=="")){
                    res += " and ";
                }
                if (tn < 2){
                    res += ones[tn * 10 + one];
                }
                else{
                    res += tens[tn];
                    if (one>0){
                        res += ("-" + ones[one]);
                    }
                }
            }
            if (res==""){
                res = "zero";
            }
            return res;
        }
    </script>
    <style>
    .btnn_primary{
        color: #fff;
    background-color: #244969;
    border-color: #10212f;
}
    
    </style>
</head>

<body>

	<div id="page-wrap" style="border: 0px solid #000000;" id='printcontent' >
        <?php 
	$school_code = $this->session->userdata("school_code");
	          $this->db->where('id',$school_code);
	         $info=$this->db->get('school')->row();
	//print_r($info);

   ?>		
		<table style="width: 100%">
			<tr class="text-uppercase">
				<td width="10%" style="border: none;">
				 <img src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/images/empImage/<?= $this->session->userdata('logo') ?>" alt="" style="width:100px; height:100px; float:right;" />
				</td>
				
				<td style="border: none;">
					<h2 align="center" style="text-transform:uppercase;  color:#D83E1D;"><?php echo $info->school_name; ?></h2>
			        <h4 align="center" style="font-variant:small-caps;  color:#1365A5;">
						<?php if($info->address1){echo $info->address1; }else{echo $info->address2; } 
						echo ",".$info->city; ?>
						<?php echo $info->state." - ".$info->pin; ?>
			        </h4>
			        <h4 align="center" style="font-variant:small-caps;">
						Phone:<span style="color:#D83E1D;"><?php if(strlen($info->fax_no > 0 )){echo $info->fax_no.", ";} ?></span>
			            Mobile:<span style="color:#D83E1D;"><?php echo $info->mobile_no; ?></span>
			        </h4>
				</td>
			</tr>
		</table>
		<div style="clear:both; padding: 10px;"><hr style=" border: 1px solid #000000;"/></div>
		<div id="customer">
        	<div style="display:inline-block;">
        	
<?php 
//------------------------------------ Fetch Employee data by emp ID -----------------------------
$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("salaryInvoice",$this->uri->segment(3));
	$row = $this->db->get("emp_salary_info")->row();
	
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("id",$row->emp_id);
	$empDetail = $this->db->get("employee_info")->row();

//------------------------------------ END Fetch Employee data by emp ID -------------------------
?>
        	
                <table>
                   <!-- <tr class="text-uppercase"><td style="border:none;"><strong><h2>EMPLOYEE DETAIL</h2></strong></td></tr>-->
                    <tr class="text-uppercase">
                        <td style="border:none; line-height: 20px;">
                            <label>
                                <div style="width: 140px; height: 150px; margin-left:50%;" >
                                    <?php if($empDetail->photo){?>
									<img  height="148" width="140" src="https://schoolerp-niktech.in/a_school/9/images/empImage/<?php echo $empDetail->photo; ?>" />
								<?php }else{?>
								<img  height="148" width="140" src="https://schoolerp-niktech.in/a_school/icon/maleteacher.png" >
								<?php } ?>
								</div>
                                
                            </label>
                        </td>
                    </tr>
                </table>
			</div>
            <div style="display:inline-block; float:right; padding-right: 50px;">
                <table>
                    <tr class="text-uppercase">
                        <td style="border:none; line-height: 20px;">
                            <label>
                                <STRONG><span style="color:#1365A5;">Employee ID : </span></STRONG><span style="color:#F98056;"><?PHP echo strtoupper($empDetail->username); ?></span></BR>
                            </label>
                        </td>
                    </tr>
                    <tr class="text-uppercase">
                        <td style="border:none; line-height: 20px;">
                            <label>
                               <STRONG><span style="color:#1365A5;">Name : </span></STRONG><span style="color:#F98056;"><?PHP echo strtoupper($empDetail->name); ?></span></BR>
                            </label>
                        </td>
                    </tr>
                    <tr class="text-uppercase">
                        <td style="border:none; line-height: 20px;">
                            <label>
                               <STRONG><span style="color:#1365A5;">Designation. : </span></STRONG><span style="color:#F98056;"><?PHP echo strtoupper($empDetail->job_title); ?></span></BR>
                            </label>
                        </td>
                    </tr>
                    <tr class="text-uppercase">
                        <td style="border:none; line-height: 20px;">
                            <label>
                                 <STRONG><span style="color:#1365A5;">Invoice No : </span></STRONG><span style="color:#F98056;"><?PHP echo $this->uri->segment(3); ?></span></BR>
                            </label>
                        </td>
                    </tr>
                   <!-- <tr class="text-uppercase">
                        <td style="border:none; line-height: 20px;">
                            <label>
                                <STRONG><span style="color:#1365A5;">Pay Mode : </span></STRONG><span style="color:#F98056;"><?PHP echo $row->pay_mode; ?></span></BR>
                            </label>
                        </td>
                    </tr>-->
                    <tr class="text-uppercase">
                        <td style="border:none; line-height: 20px;">
                            <label>
                                <STRONG><span style="color:#1365A5;">Salary for Month : </span></STRONG>
                                <?php $dt = $row->till_date;?>
                                <?php if($row->monthNo == '0'){ ?>
                                	Advance Salary
                                <?php }else{ ?>
	                                <?PHP for($i = $row->monthNo; $i > 0; $i--): ?>
	                                	<?php echo date("M",strtotime("$dt - $i month"))?>
	                                <?php endfor;?>
	                           <?php } ?>
                            </label>
                        </td>
                        
                    </tr>
                    <tr class="text-uppercase">
                        <td style="border:none; line-height: 20px;">
                            <label>
                               <!-- <STRONG><span style="color:#1365A5;">Pay Date :</span> </STRONG><span style="color:#F98056;"><?PHP $newdate = date('l : d-M-Y', strtotime($row->created)); echo $newdate; ?></BR></span>
                           --> </label>
                        </td>
                    </tr>
                </table>
            </div>
		</div>
		<table id="items">
              <tr class="text-uppercase">
                  <th width="5%"><label>No.</label></th>
                  <th><label>Payment Type</label></th>
                  <th><label>Amount</label></th>
              </tr>
              <tr class="item-row text-uppercase">
              	  <td><label>1</label></td>
                  <td><label><span style="color:#1365A5;">Basic Salary :</span></label></td>
                  <th><label><span style="color:#F98056;"><?PHP echo $row->basicSalary; ?></span></label></th>
              </tr>
              <tr class="item-row text-uppercase">
              		<td><label>2</label></td>
                  <td><label><span style="color:#1365A5;">Medical Allowance :</span></label></td>
                  <th><label><?PHP echo $row->medicalAllowance; ?></label></th>
              </tr>
              <tr class="item-row text-uppercase">
              		<td><label>3</label></td>
                  <td><label><span style="color:#1365A5;">Transport Allowance :</span></label></td>
                  <th><label><?PHP echo $row->transportAllowance; ?></label></th>
              </tr>
              <tr class="item-row text-uppercase">
              		<td><label>4</label></td>
                  <td><label><span style="color:#1365A5;">Dearness Allowance :</span></label></td>
                  <th><label><?PHP echo $row->dearnessAllowance; ?></label></th>
              </tr>
              <tr class="item-row text-uppercase">
              		<td><label>5</label></td>
                  <td><label><span style="color:#1365A5;">House Rent Allowance :</span></label></td>
                  <th><label><?PHP echo $row->houseRentAllowance; ?></label></th>
              </tr>
             
             
              <tr class="item-row text-uppercase">
              		<td><label>6</label></td>
                  <td><label><span style="color:#1365A5;">Incentieve :</span></label></td>
                  <th><label><?PHP echo $row->encentieve; ?></label></th>
              </tr>
              <tr class="item-row text-uppercase">
              		<td><label>7</label></td>
                  <td><label><span style="color:#1365A5;">Bonus :</span></label></td>
                  <th><label><?PHP echo $row->bonus; ?></label></th>
              </tr>
               <tr class="item-row text-uppercase">
              		<td><label>8</label></td>
                  <td><label><span style="color:#1365A5;">Advance Salary :</span></label></td>
                  <th><label><?PHP echo $row->currentAdvance; ?></label></th>
              </tr>
              <tr class="item-row text-uppercase">
              		<td><label>9</label></td>
                  <td><label><span style="color:#1365A5;">Total :</span></label></td>
                  <th><label><span style="color:#F98056;"><?PHP echo $row->basicSalary + $row->medicalAllowance + $row->transportAllowance + $row->dearnessAllowance + $row->houseRentAllowance  + $row->encentieve + $row->bonus + $row->currentAdvance; ?></span></label></th>
              </tr>
              <tr >
                  <th align="center" colspan="3"><label>------------ DEDUCTION ------------</label></th>
              </tr>
               <tr class="item-row text-uppercase">
              		<td><label>10</label></td>
                  <td><label><span style="color:#1365A5;">Absent Deduction :</span></label></td>
                  <th><label><?PHP echo $row->spcialAllowance; ?></label></th>
              </tr>
              <tr class="item-row text-uppercase">
              		<td><label>11</label></td>
                  <td><label><span style="color:#1365A5;">Provident Fund:</span></label></td>
                  <th><label><?PHP echo $row->ProvidentFund; ?></label></th>
              </tr>
              <tr class="item-row text-uppercase">
              		<td><label>12</label></td>
                  <td><label><span style="color:#1365A5;">Employee State Insurance</span></label></td>
                  <th><label><?PHP echo $row->employeeStateInsurance; ?></label></th>
              </tr>
              <tr class="item-row text-uppercase">
              		<td><label>13</label></td>
                  <td><label><span style="color:#1365A5;">Previous Advance</span></label></td>
                  <th><label><?PHP echo $row->previousAdvance; ?></label></th>
              </tr>
              <tr class="item-row text-uppercase">
              		<td><label>14</label></td>
                  <td><label><span style="color:#1365A5;">TOLAL DEDUCTION:</span></label></td>
                  <th><label><?PHP echo $row->ProvidentFund + $row->employeeStateInsurance + $row->previousAdvance + $row->spcialAllowance; ?></label></th>
              </tr>
              <tr>
                  <th align="center" colspan="3"><label>------------ PAYBLE ------------</label></th>
              </tr>
              <tr class="item-row text-uppercase">
              		<td><label>15</label></td>
                  <td><label><span style="color:#D5400C;">NET AMOUNT PAYABLE:</span></label></td>
                  <th><label><span style="color:#F98056;"><?PHP echo $row->gross_s; ?></span></label></th>
              </tr>
          
              <tr>
                  <td colspan="4" rowspan="6" valign="bottom">
                      <table width="100%" height="100%">
                          <tr>
                              <td style="border: 1px;" colspan="2">
                                  <strong><span style="color:#1365A5;">Net Amount Payble (in words)</span></strong><br/><span style="color:#EB4910;"><script> document.write(convert_number(<?php echo $row->gross_s; ?>)); </script> Rupee Only/-</span>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
		</table>
		<!--
		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>
	    -->
	</div>
   <!-- <center>This is Computer generated Invoice</center>-->
   </br>
   </br>
    <center><button id="non-printable" type="button" class="btn btnn_primary"  onclick="window.print();">Print</button></center>
	
</body>
</html>