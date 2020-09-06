<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Student Profile</title>
	
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
		<table style="width: 100%" class='text-uppercase'>
			<tr>
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
			</tr>
		</table>
		
        
		<div style="clear:both"></div>
		
		<?php
 
	$id = $this->uri->segment(3);
	//$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("id",$id);
	$detail = $this->db->get("student_info")->row();
	
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("student_id",$detail->id);
	$g_detail = $this->db->get("guardian_info")->row();
?>
		
		<table id="items">
			<tr style="border: none;">
				<td  style="border: none;">
					<div style="width: 140px; height: 150px; border: 1px solid #ccc;">
						<?php if(strlen($detail->photo > 0)):?>
							<img alt="<?php echo $detail->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $detail->photo;?>" />
						<?php else:?>
							<?php if($detail->gender == '1'):?>
								<img alt="<?php echo $detail->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/stuMale.png" />	
							<?php endif;?>
							<?php if($detail->gender == '0'):?>
								<img alt="<?php echo $detail->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/stuFemale.png" />	
							<?php endif;?>
						<?php endif;?>
					</div>
				</td>

				<td colspan="2" style="border: none;">
					<div style="width: 140px; height: 150px; border: 1px solid #ccc;">
						<?php if(strlen($g_detail->f_photo > 0)):?>
							<img alt="<?php echo $g_detail->father_full_name;?>" height="148" width="138" src="<?php echo base_url()?><?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $g_detail->f_photo;?>" />
						<?php else:?>
								<img alt="<?php echo $g_detail->father_full_name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empMale.png" />	
						<?php endif;?>
					</div>
				</td>
				<td colspan="2" style="border: none;">
					<div style="width: 140px; height: 150px; border: 1px solid #ccc;">
						<?php if(strlen($g_detail->m_photo > 0)):?>
							<img alt="<?php echo $g_detail->mother_full_name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $g_detail->m_photo;?>" />
						<?php else:?>
								<img alt="<?php echo $g_detail->mother_full_name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empFemale.png" />	
						<?php endif;?>
					</div>
				</td>
			</tr>
			<tr class=" text-uppercase">
				<th>Student ID</th>
				<td><?php echo $detail->username; ?></td>
				<th>Scholar No</th>
				<td><?php if(strlen($detail->scholer_no) > 1) {echo strtoupper($detail->scholer_no); }else echo "N/A"; ?></td>
			</tr>
			<tr>
				<th>Board Register No</th>
				<td><?php $detail->board_register_no;?></td>
				<th>Admission Date</th>
				<td><?php echo date("d-M-Y", strtotime($detail->adm_date));?></td>
			</tr>
			<tr>
				<th>Student Name</th>
				<td><?php echo $detail->name;?></td>
				<th>Date of Birth</th>
				<td><?php echo date("d-M-Y", strtotime($detail->dob));?></td>
			</tr>
			<tr>
				<th>Class Section</th>
				<?php $this->db->select('class_name');
					  $this->db->where('id',$detail->class_id);
					  $this->db->where("school_code",$this->session->userdata("school_code"));
	      $classInfo=$this->db->get('class_info')->row();?>
				<td><?php echo $classInfo->class_name;?></td>
				<th>Gender</th>
				<td><?php if (strlen ($detail->gender==1)){echo "Male";}elseif(strlen ($detail->gender==0)){echo "Female";}else echo "N/A"; ?></td>
			</tr>
			<tr>
				<th>Blood Group</th>
				<td><?php if(strlen($detail->bloodgp) > 1) {echo ucwords($detail->bloodgp); }else echo "N/A"; ?></td>
				<th>Birth Place</th>
				<td><?php if(strlen($detail->birth_place) > 1) {echo ucwords($detail->birth_place); }else echo "N/A"; ?></td>
			</tr>
			<tr>
				<th>Nationality</th>
				<td><?php if(strlen($detail->nationality) > 1) {echo ucwords($detail->nationality); }else echo "N/A"; ?></td>
				<th>Mother Tongue</th>
				<td><?php if(strlen($detail->mother_tongue) > 1) {echo ucwords($detail->mother_tongue); }else echo "N/A"; ?></td>
			</tr>
			<tr>
				<th>Category</th>
				<td><?php if(strlen($detail->category) > 1) {echo ucwords($detail->category); }else echo "N/A"; ?></td>
				<th>Religion</th>
				<td><?php if(strlen($detail->religion) > 1) {echo ucwords($detail->religion); }else echo "N/A"; ?></td>
			</tr>
			<tr>
				<th>Address 1</th>
				<td><?php if(strlen($detail->address1) > 1) {echo ucwords($detail->address1); }else echo "N/A"; ?></td>
				<th>Address 2</th>
				<td><?php if(strlen($detail->religion) > 1) {echo ucwords($detail->religion); }else echo "N/A"; ?></td> 
			</tr>
			<tr>
				<th>City</th>
				<td><?php if(strlen($detail->city) > 1) {echo ucwords($detail->city); }else echo "N/A"; ?>
				<th>State</th></td>
				<td><?php if(strlen($detail->state) > 1) {echo ucwords($detail->state); }else echo "N/A"; ?></td>
				
			</tr>
			<tr>
				<th>Mobile</th>
				<td><?php if(strlen($detail->mobile) > 1) {echo ucwords($detail->mobile); }else echo "N/A"; ?></td>
				<th>Email</th>
				<td><?php if(strlen($detail->email) > 1) {echo ucwords($detail->email); }else echo "N/A"; ?></td>
			</tr>
			<tr>
				<th>Username</th>
				<td><?php echo $detail->username; ?></td>
				<th>Password</th>
				<td><?php if(strlen($detail->password) > 1) {echo ucwords($detail->password); }else echo "N/A"; ?></td>
			</tr>
			<tr>
				<th colspan="4" style="text-align: center;">-------- PARENT'S INFORMATION --------</th>
			</tr>
			<tr>
				<th>Father Name</th>
				<td><?php if(strlen($g_detail->father_full_name) > 1) {echo ucwords($g_detail->father_full_name); }else echo "N/A"; ?></td>
				<th>Mother Name</th>
				<td><?php if(strlen($g_detail->mother_full_name) > 1) {echo ucwords($g_detail->mother_full_name); }else echo "N/A"; ?></td>
			</tr>
			<tr>
				<th>Caretaker Name</th>
				<td><?php if(strlen($g_detail->caretaker_name) > 1) {echo ucwords($g_detail->caretaker_name); }else echo "N/A"; ?></td>
				<th>Caretaker Relation</th>
				<td><?php if(strlen($g_detail->caretaker_relation) > 1) {echo ucwords($g_detail->caretaker_relation); }else echo "N/A"; ?></td>
			</tr>
			<tr>
				<th>Father Education</th>
				<td><?php if(strlen($g_detail->father_education) > 1) {echo ucwords($g_detail->father_education); }else echo "N/A"; ?></td>
				<th>Mother Education</th>
				<td><?php if(strlen($g_detail->mother_education) > 1) {echo ucwords($g_detail->mother_education); }else echo "N/A"; ?></td>
			</tr>
			<tr>
				<th>Father Occupation</th>
				<td><?php if(strlen($g_detail->father_occupation) > 1) {echo ucwords($g_detail->father_occupation); }else echo "N/A"; ?></td>
				<th>Mother Occupation</th>
				<td><?php if(strlen($g_detail->mother_occupation) > 1) {echo ucwords($g_detail->mother_occupation); }else echo "N/A"; ?></td>
			</tr>
			<tr>
				<th>Family Annual Income</th>
				<td><?php if(strlen($g_detail->family_annual_income) > 1) {echo ucwords($g_detail->family_annual_income); }else echo "N/A"; ?></td>
				<th>Address</th>
				<td><?php if(strlen($g_detail->address) > 1) {echo ucwords($g_detail->address); }else echo "N/A"; ?></td>
			</tr>
			<tr>
				<th>City</th>
				<td><?php if(strlen($g_detail->city) > 1) {echo ucwords($g_detail->city); }else echo "N/A"; ?></td>
				<th>State</th>
				<td><?php if(strlen($g_detail->state) > 1) {echo ucwords($g_detail->state); }else echo "N/A"; ?></td>
			</tr>
			<tr>
				<th>Father Mobile</th>
				<td><?php if(strlen($g_detail->f_mobile) > 1) {echo ucwords($g_detail->f_mobile); }else echo "N/A"; ?></td>
				<th>Mother Mobile</th>
				<td><?php if(strlen($g_detail->m_mobile) > 1) {echo ucwords($g_detail->m_mobile); }else echo "N/A"; ?></td>
			</tr>
			<tr>
				<th>Father Email</th>
				<td><?php if(strlen($g_detail->f_email) > 1) {echo ucwords($g_detail->f_email); }else echo "N/A"; ?></td>
				<th>Mother Email</th>
				<td><?php if(strlen($g_detail->m_email) > 1) {echo ucwords($g_detail->m_email); }else echo "N/A"; ?></td>
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