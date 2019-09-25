<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<style type="text/css">

	/*@media print
	{
			body * { visibility: hidden; }
			#printcontent * { visibility: visible; }
			#printcontent { position: absolute; top: -20px; left: 30px; }
	    }*/
	    @media print
		{
		    body * { visibility: visible; }
		    .non-printable { display: none; }
		    .printcontent * { visibility: visible; }
		    
		    @page
		   {
		   	height: 645px;
		   	width: 873px;
		   	margin-left:350px;
		   	margin-right:350px;
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

    .nob{
    	border: none;
    }
   
	</style>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Cash Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/print.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/example.js'></script>
	
</head>
<?php $school_code = $this->session->userdata("school_code");?>
<body>
<div id="printcontent" >
	<div id="page-wrap" style="border:1px solid black; ">

		<?php 
		$this->db->where("id",$school_code);
	$school_info = $this->db->get("school");// mysql_query("select * from general_settings where school_code = '$school_code'");
	$info = $school_info->row();
?>		
		<table style="width: 100%; border-bottom: 1px solid black; margin-bottom:2px;">
			<tr>
				<td width="10%" style="border: none;">
					<img src="<?php echo base_url();?>assets/<?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $this->session->userdata("logo");?>" alt="" style="width:100px; height:100px; border-radius:50%; " />
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
						<?php if(strlen($info->mobile_no > 0 )){ echo "Mobile : ".$info->mobile_no;}?>
			            
			        </h3>
				</td>
				<td style="width:10%; border:none;"></td>
			</tr>
		</table>
		
		
		<div style="clear:both"></div>
		
		<div id="customer">
        	<div style="display:inline-block;">
<?php
	$id = $this->uri->segment(3);
	//echo $id;
	$rowb = $this->db->query("select * from feedue where invoice_no = '$id' and school_code = '$school_code'")->row();
	$this->db->where("id",$rowb->student_id);
	$studetail=$this->db->get("student_info");
	if($studetail->num_rows()>0)
	{
		$stuname=$studetail->row();
?>
            <table style=" border:1px solid black; margin-left:2px;">
                    <tr><td style=""><strong>Student Details</strong></td></tr>
                    <tr>
                    	<td style=";">
						<strong>	Student Name :-</strong>
                    		<?php echo $stuname->name; ?>
                        </td>
                    </tr>
                    <tr>
                    	<td style=""><strong>Student Id :-</strong>
					<?php echo $stuname->username; ?>
                        </td>
                    </tr>
                    <tr>
                    	<td style=""><strong>Class :-</strong>
					<?php 
            					   $this->db->where('school_code',$school_code);
            					   $this->db->where('id',$stuname->class_id);
					    $classname=$this->db->get('class_info');
					   $classdf=$classname->row();
					                $this->db->where("id",$classdf->section);
					    $secname = $this->db->get("class_section")->row()->section;
					 echo $classdf->class_name."-".$secname; ?>
                        </td>
                    </tr>
            </table>
	<?php }?>
			</div>
            <div style="display:inline-block; float:right">
            <table style="margin-right:2px;">
                <tr>
                    <td class="meta-head" colspan="2"><h3>Cash Payment</h3></td>
                </tr>
                <tr>
                    <td class="meta-head">
                    	<?php
							echo 'Reciept No. :';
						?>
                    </td>
                    <td><?php echo $id; ?></td>
                </tr>
                <tr>
                    <td class="meta-head">Date</td>
                    <td><?php echo $rowb->depositedate; ?></td>
                </tr>
            </table>
            </div>
		
		</div>
		
		<table id="items" style="margin-left:2px; margin-right:2px; margin-top:20px; width:auto;">
		
		  <tr>
		       <th width="5%">No.</th>
               <th width="30%">Descriptions Of Fee</th>
               <th width="12%">Paid Amount</th>
               <th width="12%">Remain Amount</th>
               <th width="11%">date</th>
		  </tr>
		 <?php $this->db->where('invoice_no',$rowb->invoice_no);
		  $amount=$this->db->get('day_book');

		  ?>
		  <tr style="text-align:center;">
		      <td><?php echo 1; ?></td>
		      <td><?php echo $rowb->description; ?></td>
		      <td><?php if($amount->num_rows()>0){ echo $amount->row()->amount;}else{echo "0.00";}  ?></td>
		      <td><?php echo $rowb->mbalance;?></td>
		      <td><?php echo $rowb->depositedate; ?></td>
		  </tr>
		</table>
		
		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>
	
	</div>
	
	</div>
	<div class="invoice-buttons" id ="non-printable" style="text-align:center;">
    <button class="button button2" type="button"  onclick="window.print();">
      <i class="fa fa-print padding-right-sm"></i> Print Reciept
    </button>
  </div>
</body>
 
</html>