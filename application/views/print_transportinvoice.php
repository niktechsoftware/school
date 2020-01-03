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
      left: 10px;
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
<div id="printcontent" >
	<div id="page-wrap">
<h1><center>TRASNPORT FEE INVOICE</center></h1>
		<!--<textarea id="header">STOCK BILL INVOICE</textarea>-->
		<?php 
		$school_code = $this->session->userdata("school_code");
		$school_info = mysqli_query($this->db->conn_id,"select * from school where id = '$school_code'");

	    $info = mysqli_fetch_object($school_info);
      ?>	
      <div class="row">
           <div class="col-md-6" style="width: 100%;border:1px solid black;" >
               <h1><center>STUDENT RECEIPT</center></h1>
        
          
		<table style="width: 100%;border:1px solid black;" >
			<tr>
				<td width="10%" style="border: none;">
					  <img src="<?= $this->config->item('asset_url');?><?= $this->session->userdata('school_code') ?>/images/empImage/<?= $this->session->userdata('logo') ?>" alt="tt" style="width:100px; height:100px; float:right;" />
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

            $this->db->where("id",$stuid);
            $student=$this->db->get("student_info");
            
            $this->db->where("stu_id",$stuid);
            $this->db->where("invoice_number",$invoice);
            $transportdt=$this->db->get("transport_fee_month");
            
            ?>
            <table style="width: 100%;border:1px solid black;">
                    <tr><td style="border:none;" class="meta-head" colspan=2><strong><center>To</center></strong></td></tr>
                    <tr>
                        <td class="meta-head">Student ID</td>
                    	<td style="">
                    	<?php if($student->num_rows()>0){ ?>
                        <strong>	<?php echo strtoupper($student->row()->username); ?></strong>
                    	<?php }else{ ?>
                    		<strong><?php echo "N/A" ?></strong>
                      <?php } ?>
                        </td>
                    </tr>
                     <tr>
                        <td class="meta-head">Student Name</td>
                    	<td style="">
                    	<?php if($student->num_rows()>0){ ?>
                        <strong>	<?php echo strtoupper($student->row()->name); ?></strong>
                    	<?php }else{ ?>
                    		<strong><?php echo "N/A" ?></strong>
                      <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="meta-head">Father Name</td>
                    	<td style="">
                    	<?php if($student->num_rows()>0){ ?>
                        <strong>	<?php 
                        $this->db->where("student_id",$student->row()->id);
                        $finfo=$this->db->get("guardian_info");
                        if($finfo->num_rows()>0){
                            echo $finfo->row()->father_full_name;
                        }else{
                            echo "N/A";
                        }
                        ?></strong>
                    	<?php }else{ ?>
                    		<strong><?php echo "N/A" ?></strong>
                      <?php } ?>
                        </td>
                    </tr>
                    <tr>
                          <td class="meta-head">Class/Sec.</td>
                    	<td style="">
                        	<?php
							 
							if($student->num_rows()>0)
							{  $this->db->where("id",$student->row()->class_id);
                $dtt=$this->db->get("class_info");

                if($dtt->num_rows()>0){

                $this->db->where("id",$dtt->row()->section);
                $dt1=$this->db->get("class_section");

								 if(strlen($dtt->row()->class_name)>0){ 
                   echo strtoupper($dtt->row()->class_name);
                   if($dt1->num_rows()>0){
                 echo "[ ".strtoupper($dt1->row()->section)." ]";
                }
                else{
                 echo "[ N/A ]";
                }
             }
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
                    <td><?php echo $invoice;	?></td>
                </tr>
                
                <tr>
                    <td class="meta-head">Date</td>
                    <td><?php if($transportdt->num_rows()>0){ echo $transportdt->row()->date; }else{ echo "N/A"; }?></td>
                </tr>
            </table>
            </div>
		
		</div>
		
		<table id="items" style="width: 100%;border:1px solid black;">
		
		  <tr>
		       <th width="5%">No.</th>
               <th width="12%">Total Amount</th>
               <th width="30%">Paid Amount</th>
               <th width="9%">Month</th>
               <th width="11%">Deposite Date</th>
               
		  </tr>
	  <?php if($transportdt->num_rows()>0){ 
      $rowb=$transportdt->row(); ?>
		  <tr>

		      <td><center><?php echo 1; ?></center></td>
		      <td><center><?php echo $rowb->total_amount; ?></center></td>
		      <td><center><?php echo $rowb->paid_amount; ?></center> </td>
          <td><center><?php
          $month_name = date("F", mktime(0, 0, 0, $rowb->month, 10));
           echo strtoupper($month_name); ?></center></td>
		     
		      <td><center><?php echo $rowb->date; ?></center></td>
              
		  </tr>
        	  
		  
		  <tr>
		      <td colspan="3" align="right"><strong>Total</strong></td>
		      <td colspan="2"><?php echo $rowb->total_amount; ?></td>
		      
		  </tr>
      <tr>
		      <td colspan="3" align="right"><strong>Paid</strong></td>
		      <td colspan="2"><?php echo $rowb->paid_amount; ?></td>
		      
		  </tr>
     
		 
      <?php  } 

?>	
		</table>
		
		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>
    </div>
    </br>
    </br>
    
              <div class="col-md-6" style="width: 100%;border:1px solid black;">
                <h1><center>SCHOOL RECEIPT</center></h1>
          
		<table style="width: 100%;border:1px solid black;" >
			<tr>
				<td width="10%" style="border: none;">
					 <img src="<?= $this->config->item('asset_url');?><?= $this->session->userdata('school_code') ?>/images/empImage/<?= $this->session->userdata('logo') ?>" alt="tt" style="width:100px; height:100px; float:right;" />
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

$this->db->where("id",$stuid);
$student=$this->db->get("student_info");

$this->db->where("stu_id",$stuid);
$this->db->where("invoice_number",$invoice);
$transportdt=$this->db->get("transport_fee_month");

?>
         <table style="width: 100%;border:1px solid black;">
                    <tr><td style="border:none;" class="meta-head" colspan=2><strong><center>To</center></strong></td></tr>
                    <tr>
                        <td class="meta-head">Student ID</td>
                    	<td style="">
                    	<?php if($student->num_rows()>0){ ?>
                        <strong>	<?php echo strtoupper($student->row()->username); ?></strong>
                    	<?php }else{ ?>
                    		<strong><?php echo "N/A" ?></strong>
                      <?php } ?>
                        </td>
                    </tr>
                     <tr>
                        <td class="meta-head">Student Name</td>
                    	<td style="">
                    	<?php if($student->num_rows()>0){ ?>
                        <strong>	<?php echo strtoupper($student->row()->name); ?></strong>
                    	<?php }else{ ?>
                    		<strong><?php echo "N/A" ?></strong>
                      <?php } ?>
                        </td>
                    </tr>
                    <tr>
                         <tr>
                        <td class="meta-head">Father Name</td>
                    	<td style="">
                    	<?php if($student->num_rows()>0){ ?>
                        <strong>	<?php 
                        $this->db->where("student_id",$student->row()->id);
                        $finfo=$this->db->get("guardian_info");
                        if($finfo->num_rows()>0){
                            echo $finfo->row()->father_full_name;
                        }else{
                            echo "N/A";
                        }
                        ?></strong>
                    	<?php }else{ ?>
                    		<strong><?php echo "N/A" ?></strong>
                      <?php } ?>
                        </td>
                    </tr>
                          <td class="meta-head">Class/Sec.</td>
                    	<td style="">
                        	<?php
							 
							if($student->num_rows()>0)
							{  $this->db->where("id",$student->row()->class_id);
                $dtt=$this->db->get("class_info");

                if($dtt->num_rows()>0){

                $this->db->where("id",$dtt->row()->section);
                $dt1=$this->db->get("class_section");

								 if(strlen($dtt->row()->class_name)>0){ 
                   echo strtoupper($dtt->row()->class_name);
                   if($dt1->num_rows()>0){
                 echo "[ ".strtoupper($dt1->row()->section)." ]";
                }
                else{
                 echo "[ N/A ]";
                }
             }
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
                    <td><?php echo $invoice;	?></td>
                </tr>
                
                <tr>
                    <td class="meta-head">Date</td>
                    <td><?php if($transportdt->num_rows()>0){ echo $transportdt->row()->date; }else{ echo "N/A"; }?></td>
                </tr>
            </table>
            </div>
		
		</div>
		
		<table id="items" style="width: 100%;border:1px solid black;">
		
		  <tr>
		       <th width="5%">No.</th>
               <th width="12%">Total Amount</th>
               <th width="30%">Paid Amount</th>
               <th width="9%">Month</th>
               <th width="11%">Deposite Date</th>
               
		  </tr>
	  <?php if($transportdt->num_rows()>0){ 
      $rowb=$transportdt->row(); ?>
		  <tr>

		      <td><center><?php echo 1; ?></center></td>
		      <td><center><?php echo $rowb->total_amount; ?></center></td>
		      <td><center><?php echo $rowb->paid_amount; ?></center> </td>
          <td><center><?php
          $month_name = date("F", mktime(0, 0, 0, $rowb->month, 10));
           echo strtoupper($month_name); ?></center></td>
		     
		      <td><center><?php echo $rowb->date; ?></center></td>
              
		  </tr>
        	  
		  
		  <tr>
		      <td colspan="3" align="right"><strong>Total</strong></td>
		      <td colspan="2"><?php echo $rowb->total_amount; ?></td>
		      
		  </tr>
      <tr>
		      <td colspan="3" align="right"><strong>Paid</strong></td>
		      <td colspan="2"><?php echo $rowb->paid_amount; ?></td>
		      
		  </tr>
     
		 
      <?php  } 

?>	
		</table>
		
		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>
    </div>
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