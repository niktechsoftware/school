<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Character Certificate</title>
	
	
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/print.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/example.js'></script>
	
</head>
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




<style type="text/css">
.header {
	border: 3px solid #000;
	margin-bottom: 30px;
}

table h1, h2, h3 {
	font-family: Arial, Helvetica, sans-serif;
	line-height: 20px;
	margin: 10px;
}

.tcbody {
	font-family: Verdana, Geneva, sans-serif;
	font-style: italic;
	font-stretch: expanded;
	line-height: 30px;
	text-align: justify;
}

.main {
	width: 800px;
	margin: auto;
}
</style>

<body>		
<div id="printcontent" class="container">
	<div id="page-wrap" class="row">
	<div class="col-md-10">
		<?php 
	$school_code = $this->session->userdata("school_code");
	$school_info = mysqli_query($this->db->conn_id,"select * from school where id= '$school_code'");
	$info = mysqli_fetch_object($school_info);
?>	

 <!--<input type="hidden" value="<?php echo $id;?>" id="stuid"/>-->
			<table style="width: 100%; padding-top:10px; padding-bottom:10px;margin-bottom: 15px; ">
			<tr style="color:#002D65;">
				<td width="10%" style="border: none;margin-left: 50px;">
					<img src="<?php echo base_url();?>assets/<?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $info->logo;?>" alt="" width="80" />
				</td>
				<td style="border: none;">
					<h2 align="center" style="text-transform:uppercase;"><b><?php echo $info->school_name; ?></b></h2>
				
			        <h4 align="center" style="font-variant:small-caps;">
						<?php echo $info->address1." ".$info->address2." ".$info->city; ?>
			        </h4>
			        <h4 align="center" style="font-variant:small-caps;">
						<?php if(strlen($info->mobile_no > 0 )){echo $info->state." - ".$info->pin.", Phone : ".$info->mobile_no.", ";} ?>
			            
			        </h4>
				</td>
			</tr>
			
		</table>
		<div class="row"> 
	<div class="col-md-12"><center><span style="font-size:20px;letter-spacing: 2px;border-radius: 25px;border: 2px solid #002D65;padding: 10px;width: 250px;color:white;background-color:#002D65;">
	    <b>CHARACTER CERTIFICATE</b></span></center></div>	
    </div>
		
		<!--<table style="width: 100%; padding:20px;margin-bottom: 30px;">-->
		<!--	<tr>-->
		<!--		<td width="10%" style="border: none;">-->
		<!--			<img src="<?php echo base_url();?>assets/images/empImage/<?php echo $this->session->userdata("logo");?>" alt="" width="100" />-->
		<!--		</td>-->
		<!--		<td style="border: none;">-->
		<!--			<h2 align="center" style="text-transform:uppercase;"><?php echo $info->school_name; ?></h2>-->
		<!--	        <h3 align="center" style="font-variant:small-caps;">-->
		<!--				<?php echo $info->address1." ".$info->address2." ".$info->city; ?>-->
		<!--	        </h3>-->
		<!--	        <h3 align="center" style="font-variant:small-caps;">-->
		<!--				<?php echo $info->state." - ".$info->pin; ?>-->
		<!--	        </h3>-->
		<!--	        <h3 align="center" style="font-variant:small-caps;">-->
		<!--				<?php if(strlen($info->mobile_no> 0 )){echo "Phone : ".$info->mobile_no.", ";} ?>-->
			            
		<!--	        </h3>-->
		<!--		</td>-->
		<!--	</tr>-->
		<!--	<tr><td style="border: none;"></td><td style="border: none;"></td></tr>-->
		<!--	<tr><td style="border: none;"></td><td style="border: none;"><h2 align="center" style="text-transform:uppercase;">Character Certificate</h2></td></tr>-->
		<!--</table>-->
		
		
		<!--<div style="clear:both"></div>-->
		
		<!--<div id="customer">-->
  <!--      	<div >-->
<?php
	$id = $this->uri->segment(3);
	
	$rowb = $this->db->query("select * from student_info where username = '$id' ")->row();
	$sid=$rowb->id;
	$gdetail = $this->db->query("select * from guardian_info where student_id = '$sid' AND school_code='$school_code'")->row();
	$fname = $gdetail->father_full_name;
	$add= $gdetail->address;
	$stuname=$rowb->name;
?>
          
	</br></br>
		
		
			<div class="tcbody">
			<div>
				This is to certify that <strong><?php echo $stuname; ?></strong>, S/O / D/O <strong><?php echo $fname;?></strong>
				 of <strong><?php echo $add;?></strong>. He had
				been studying in this school. So for as I know, he is a child of moral and character . He did not take part in any activity subversive to the state. I wish him every success.
				
			</div>
			<div>
				<br />
			</div>
			<div>a. His moral character :   Good</div>
			<div>b. Behavior                  :   Good</div>
			<div>c. Progress                   :   Satisfactory</div>
			<div>
				<br />
			</div>

			<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td valign="top" width="275"><div align="center">
								<br />
							</div></td>
						<td valign="top" width="369"><div align="center"></div>
							<div align="center">Principal</div>
							<div align="center"></div>
							</td>
					</tr>
				</tbody>
			</table>
		</div>
	
		
	
	</div>

    </div>
    
    </div>
</div>
</div>
</body>
	<div class="invoice-buttons" style="text-align:center;">
    <button class="button button2" type="button"  onclick="window.print();">
      <i class="fa fa-print padding-right-sm"></i> Print CC
    </button>
  </div>
</html>