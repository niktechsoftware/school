<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Employee Profile</title>
	
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/print.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/example.js'></script>

	<style type="text/css">
		table tr th{
			text-align: left;
		}
	</style>
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

	<div id="printcontent" id="page-wrap" style="border: 1px solid #FFF; width:1000px;">
		<?php 
	$school_code = $this->session->userdata("school_code");
	$school_info = mysqli_query($this->db->conn_id,"SELECT * from school WHERE id = '$school_code'");
	$info = mysqli_fetch_object($school_info);
?>		
		
		<div style="clear:both"></div>
		
		<?php
 
	$id = $this->uri->segment(3);
	//print_r($id);exit;
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("id",$id);
	$detail = $this->db->get("employee_info")->row();
	
?>
		
		<table id="items">
			<tr style="border: none;text-transform:uppercase;">
				<td  style="border: none;">
					<div style="width: 140px; height: 150px; border: 1px solid #ccc;">
						<?php if(strlen($detail->photo > 0)):?>
							<img alt="<?php echo $detail->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $detail->photo;?>" />
						<?php else:?>
							<?php if($detail->gender == '1'):?>
								<img alt="<?php echo $detail->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empMale.png" />	
							<?php endif;?>
							<?php if($detail->gender == '0'):?>
								<img alt="<?php echo $detail->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empFemale.png" />	
							<?php endif;?>
						<?php endif;?>
					</div>
				</td>
				
				<td width="10%" style="border: none;">
					<img src="<?php echo base_url();?>assets/images/empImage/<?php echo $this->session->userdata("logo");?>" alt="" width="100" />
				</td>
				<td style="border: none;">
					<h1 align="center" style="text-transform:uppercase;"><?php echo $info->school_name; ?></h1>
			        <h2 align="center" style="font-variant:small-caps;">
						<?php echo $info->address1." ".$info->address2." ".$info->city; ?>
			        </h2>
			        <h2 align="center" style="font-variant:small-caps;">
						<?php echo $info->state." - ".$info->pin; ?>
			        </h2>
			        <h2 align="center" style="font-variant:small-caps;">
						<?php if(strlen($info->mobile_no > 0 )){ echo "Mobile : ".$info->mobile_no;} ?>
			        </h2>
				</td>
				
				
					<td  style="border: none;float:right;">
			<!--		<div style="width: 140px; height: 150px; border: 1px solid #ccc;">
						<?php if(strlen($info->logo > 0)):?>
							<img alt="<?php echo $info->school_name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $info->logo;?>" />
						<?php else:?>
								<img alt="<?php echo $info->school_name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/<?php echo $info->logo;?>" />	
						<?php endif;?>-->
					</div>
				</td>
				
			</tr>
			<tr class=" text-uppercase" style="text-transform:uppercase;">
			    <th>Employee Name</th>
				<td><?php echo $detail->name; ?></td>
				<th>Employee ID</th>
				<td><?php echo $detail->username; ?></td>
			
			</tr>
			<tr style="text-transform:uppercase;">
			    <th>Date of Birth</th>
				<td><?php echo date("d-M-Y", strtotime($detail->dob));?></td>
				<th>Job Category</th>
				<td><?php if($detail->job_category==1){ echo "Accountant";}elseif($detail->job_category==2){echo "Employee";}elseif($detail->job_category==3){echo "Teacher";}else{echo "Principal";} ?></td>
			
			</tr>
		<!--	<tr style="text-transform:uppercase;">
				<th>Job Title</th>
				<td><?php //if(strlen($detail->job_title) > 1) {echo ucwords($detail->job_title); }else echo "N/A"; ?></td>
				<th>Gender</th>
				<td><?php //if ($detail->gender==1){echo "Male";}else{echo "Female";} ?></td>
			</tr>-->
			<tr style="text-transform:uppercase;">
				<th>Category</th>
				<td><?php if(strlen($detail->category) > 1) {echo ucwords($detail->category); }else echo "N/A"; ?></td>
				<th>Qualification</th>
				<td><?php if(strlen($detail->qualification) > 1) {echo ucwords($detail->qualification); }else echo "N/A"; ?></td>
			</tr>
			<tr style="text-transform:uppercase;">
				<th>Experiance</th>
				<td><?php if(strlen($detail->experiance) > 1) {echo ucwords($detail->experiance); }else echo "N/A"; ?></td>
				<th>Address</th>
				<td><?php if(strlen($detail->address) > 1) {echo ucwords($detail->address); }else echo "N/A"; ?></td>
			</tr>
			<tr style="text-transform:uppercase;">
				<th>City</th>
				<td><?php if(strlen($detail->city) > 1) {echo ucwords($detail->city); }else echo "N/A"; ?></td>
				<th>State</th>
				<td><?php if(strlen($detail->state) > 1) {echo ucwords($detail->state); }else echo "N/A"; ?></td>
			</tr>
			<tr style="text-transform:uppercase;">
				<th>Pin Code</th>
				<td><?php if(strlen($detail->pin_code) > 1) {echo ucwords($detail->pin_code); }else echo "N/A"; ?></td>
				<th>Country</th>
				<td><?php if(strlen($detail->country) > 1) {echo ucwords($detail->country); }else echo "N/A"; ?></td>
			</tr>
			<tr style="text-transform:uppercase;">
				<th>Mobile Number</th>
				<td><?php if(strlen($detail->mobile) > 1) {echo ucwords($detail->mobile); }else echo "N/A"; ?></td>
				<th>Email</th>
				<td><?php if(strlen($detail->email) > 1) {echo ucwords($detail->email); }else echo "N/A"; ?></td> 
			</tr>
		</table>
		<div>
			<br>
		</div>
		
		

	</div>
	
</body>
<div class="invoice-buttons" style="text-align:center;">
    <button class="button button2" type="button"  onclick="window.print();">
      <i class="fa fa-print padding-right-sm"></i> Print Profile
    </button>
  </div>
</html>