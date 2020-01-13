<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Transfer Certificate</title>
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/print.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/example.js'></script>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	
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
  
  .disable {
      border : none;
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
	border: 1px solid #000;
	margin-bottom: 13px;
}

table h1, h2, h3, h4 {
	font-family: Arial, Helvetica, sans-serif;
	line-height: 10px;
	margin: 8px;
}

.tcbody {
	font-family: Verdana, Geneva, sans-serif;
	font-style: none;
	font-size : 12px;
	line-height: 16px;
	
}

.main {
	width: 750px;
	margin: auto;
}
</style>
	<?php 
		$id = $this->uri->segment(3);
		$this->db->where("school_code",$this->session->userdata("school_code"));
				$this->db->where("student_id",$id);
			$vl=$this->db->get("tc_certificate")->row();
			$school_code = $this->session->userdata("school_code");
	       $school_info = mysqli_query($this->db->conn_id,"select * from school where id = '$school_code'");
	      $info = mysqli_fetch_object($school_info);
	
	        $this->db->where('student_id',$id);
	         $this->db->where('school_code',$this->session->userdata('school_code'));
	        $tccerti= $this->db->get('tc_certificate')->row();
?>		
<body>
<div id="printcontent" class="container">
	<div id="page-wrap">

	
     <input type="hidden" value="<?php echo $id;?>" id="stuid"/>
		<!--<table style="width: 100%; padding-top:10px; padding-bottom:10px;margin-bottom: 15px; ">-->
		<!--	<tr style="color:#002D65;">-->
		<!--		<td width="10%" style="border: none;">-->
		<!--			<img src="<?php echo base_url();?>assets/<?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $info->logo;?>" alt="" width="80" />-->
		<!--		</td>-->
		<!--		<td style="border: none; float:center;">-->
		<!--			<h2 align="center" style="text-transform:uppercase;"><b><?php echo $info->school_name; ?></b></h2>-->
				
		<!--	        <h4 align="center" style="font-variant:small-caps;padding:10px;">-->
		<!--				<?php echo $info->address1." ".$info->address2." ".$info->city; ?>-->
		<!--	        </h4>-->
		<!--	        <h4 align="center" style="font-variant:small-caps;padding-bottom:10px;">-->
		<!--				<?php if(strlen($info->mobile_no > 0 )){echo $info->state." - ".$info->pin.", Phone : ".$info->mobile_no.", ";} ?>-->
			            
		<!--	        </h4>-->
		<!--		</td>-->
		<!--		<td>-->
		<!--		    &nbsp;-->
		<!--		</td>-->
		<!--	</tr>-->
			
		<!--</table>-->
<!--<div class="row">      
    <div class="col-md-2">
        <img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $info->logo;?>" alt="" width="80" />
    </div>
	<div class="col-md-8">
        <h2 align="center" style="text-transform:uppercase;"><b><?php echo $info->school_name; ?></b></h2>
        <h4 align="center" style="font-variant:small-caps;padding:10px;">
        	<?php echo $info->address1." ".$info->address2." ".$info->city; ?>
        </h4>
        <h4 align="center" style="font-variant:small-caps;padding-bottom:10px;">
        	<?php if(strlen($info->mobile_no > 0 )){echo $info->state." - ".$info->pin.", Phone : ".$info->mobile_no.", ";} ?>
        </h4>
	</div>
	<div class="col-md-2"></div>
</div>-->
<table>
    <thead>
        <th><img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $info->logo;?>" alt="" width="80" /></th>
        <th style="align:center;"><h2 align="center" style="text-transform:uppercase;"><b><?php echo $info->school_name; ?></b></h2>
        <h4 align="center" style="font-variant:small-caps;padding:10px;">
        	<?php echo $info->address1." ".$info->address2." ".$info->city; ?>
        </h4>
        <h4 align="center" style="font-variant:small-caps;padding-bottom:10px;">
        	<?php if(strlen($info->mobile_no > 0 )){echo $info->state." - ".$info->pin.", Phone : ".$info->mobile_no.", ";} ?>
        </h4></th>
    </thead>
</table>
		
<?php
	$id = $this->uri->segment(3);
	
	$rowb = $this->db->query("select * from student_info where username = '$id'")->row();
	$sid=$rowb->id;
	$gdetail = $this->db->query("select * from guardian_info where student_id = '$sid' AND school_code = '$school_code'")->row();
	$fname = $gdetail->father_full_name;
	$mname = $gdetail->mother_full_name;
	$add= $gdetail->address;
	$stuname=$rowb->name;
?><br>
    <div class="row">      
    <div class="col-md-2"></div>
	<div class="col-md-7"><center><span style="font-size:20px;letter-spacing: 2px;border-radius: 25px;border: 2px solid #002D65;font-family:arial; padding: 10px; width: 250px; color:white; background-color:#002D65;"><b>TRANSFER CERTIFICATE</b></span></center></div>
	<div class="col-md-3"></div>
    </div>	
	<tr><td>&nbsp;</td></tr>
	<div class="tcbody">
	 <div class="row">  
	 <table>
	     <tr>
	        <td>
            <div class="" style="padding-top:8px; padding-bottom:8px;"><span style="color:#002D65; font-size:15px;">विद्यालय  स.  /School No : 
            <strong style="color:black;">
                <?php if($info->school_recognition){echo $info->school_recognition;}else{} ?>
                </strong></span>
            </div>
            </td>
            <td>
        	<div class="" style="padding-top:8px; padding-bottom:8px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        	</td>
        	<td>
        	<div class="" style="padding-top:8px; padding-bottom:8px;"><span style="color:#002D65; font-size:15px;">Affiliation No : 
            <strong style="color:black;">
        	    <?php if($info->registration_no){echo $info->registration_no;}else{} ?>
        	    </strong></span>
    	    </div>
    	    </td>
	    </tr>
	    </table>
    </div>
    <div class="row">  
     <table>
        <tr>
            <td>
    <div class="" style="padding-top:8px; padding-bottom:8px;"><span style="color:#002D65; font-size:15px;">पुस्तक स./  Book No : <strong style="color:black;"><?php echo $rowb->book_no;?> </strong></span></div>
            </td>
            <td>
            <div class="" style="padding-top:8px; padding-bottom:8px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
            </td>
            <td>
                <div class="" style="padding-top:8px; padding-bottom:8px;"><span style="color:#002D65; font-size:15px;">क्र.स./  S.No. : <strong style="color:black;"><?php echo $rowb->sno;?> </strong></span></div>
		    </td>
		    <td>
            <div class="" style="padding-top:8px; padding-bottom:8px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
            </td>
		    <td>
		        <div class=" " style="padding-top:8px; padding-bottom:8px;"><span style="color:#002D65; font-size:15px;">प्रवेश स./ Admission No : <strong style="color:black;"><?php echo $rowb->scholer_no;?> </strong></span></div>
            </td>
        </tr>
   </table>
    </div>
 
    <div class="row tcbody">      
    <div class="col-md-6" style="padding-top:8px; padding-bottom:8px;"><span style="color:#002D65; font-size:15px;">Renewed upto : </span></div>
	<div class="col-md-6" style="padding-top:8px; padding-bottom:8px; font-size:15px;"><strong style="color:black;text-transform:uppercase;"><input type="text" id="renew_upto" value="<?php if(strlen($tccerti->renewed_upto)>1){echo $tccerti->renewed_upto;}else{ echo "N/A";};?>" class="renewed text-uppercase disable"/></strong></div>
    </div>
    <div class="row">      
    <div class="col-md-6" style="padding-top:8px; padding-bottom:8px; color:#002D65; font-size:15px;">Status of school:Secondary/Sr.Secondary : </div>
	<div class="col-md-6" style="padding-top:8px; padding-bottom:8px; font-size:15px;"><strong style="color:black;text-transform:uppercase;"><input type="text" id="renew_upto" value="<?php if(strlen($tccerti->school_status)>1){echo $tccerti->school_status;}else{ echo "Sr.Secondary";};?>" class="renewed text-uppercase disable"/></strong></div>
    </div>
     <div class="row">      
    <div class="col-md-6" style="padding-top:8px; padding-bottom:8px; color:#002D65; font-size:13px;">Registration No. of the candidate ( in case Class IX to XII ) : </div>
	<div class="col-md-6" style="padding-top:8px; padding-bottom:8px; font-size:15px;"><strong style="color:black;text-transform:uppercase;"><input type="text" value="<?php if(strlen($tccerti->registration_no)>1){echo $tccerti->registration_no;}else{ echo "N/A";};?>" id="registration_no" class="renewed text-uppercase disable"/></strong></div>
    </div>
    </div>
		    
	<div class="tcbody" style="color:#002D65;">
	<div class="row">
	<div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">1.  विद्यार्थी का नाम/  Name of Pupil : <strong style="color:black;text-transform:uppercase;"><?php echo $stuname; ?></strong></div>

	</div>
	<div class="row">
	<div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">2. पिता का नाम / Father's Name : <strong style="color:black;text-transform:uppercase;"><?php echo $fname;?></strong></div>

	</div>
	<div class="row">
	<div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;" >3. माता का नाम / Mother's Name : <strong style="color:black;text-transform:uppercase;"><?php echo $mname;?></strong></div>
	
	</div>
	<div class="row">
	<div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">4. राष्ट्रीयता/ Nationality :<strong style="color:black; text-transform:uppercase">Indian </strong> </div>

	</div>
	<div class="row">
	<div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">5. क्या अनु . जाति  / जन. जा. /  पिछड़ा वर्ग से संबंधित है: Whether the pupil belongs to SC/ST/OBC Category :<strong style="color:black; text-transform:uppercase"><?php echo $rowb->category;?> </strong> </div>

	</div>
	<div class="row">
	<div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">6. प्रवेश पुस्तिका के अनुसार जन्म तिथि / Date of Birth according to the Admission Register :(अंको में / in figure)
	</br></br>&nbsp;&nbsp;&nbsp;&nbsp;<strong style="color:black; text-transform:uppercase"><?php echo $rowb->dob;?> </strong>(शब्दों में / in words ) </div>

	</div>
	<div class="row">
	<div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">7.क्या विद्यार्थी का परीक्षा परिणाम अनुतीर्ण है /  Whether the student is failed : <strong style="color:black;text-transform:uppercase;"><input type="text" value="<?php if(strlen($tccerti->student_status)>1){echo $tccerti->student_status;}else{ echo "N/A";};?>" id="status" class="renewed text-uppercase disable"/></strong></div>

	</div>
	<div class="row">
	<div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">8.  प्रस्तावित विषय/  Subject Offered : <strong style="color:black;text-transform:uppercase;"><input type="text"style='width:950px;' value="<?php if(strlen($tccerti->subject_offered)>1){echo $tccerti->subject_offered;}else{ echo "&nbsp;&nbsp;&nbsp; N/A";};?>" id="subjectid" class="renewed text-uppercase disable"/></strong></div>

	<?php 
// 	$i=1;
// 	$this->db->where("class_id",$rowb->class_id);
// 	$sub=$this->db->get("subject")->result();
// 	foreach ($sub as $s){
	  ?>
 <!--<strong style="color:black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $i;?>.&nbsp;&nbsp;<?php echo $s->subject;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> -->
<?php
// 	$i++; };
	?>

	</div>
	<?php $this->db->where("id",$rowb->class_id);
	$class=$this->db->get("class_info")->row()->class_name;
	?>
	<div class="row">
	<div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">9. पिछली कक्षा  जिसमे विद्यार्थी अध्यनरत था : (अंको में )Class in which the pupil last studied(in words) :<strong style="color:black; text-transform:uppercase"> <?php echo $class;?></strong></div>

	</div>
	<div class="row">
	<div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">10.पिछले विद्यालय / बोर्ड परीक्षा एवं  परिणाम / School/Board/Annual Examination last taken with result : <strong style="color:black; text-transform:uppercase">Passed </strong></div>

	</div>
	<div class="row">
	 
	   <div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">11.क्या उच्च कक्षा में पदोन्नति का अधिकारी है :  Whether Qualified for promotion to the next higher class :<strong style="color:black; text-transform:uppercase"> Yes</strong> </div>
    
  
    </div>
    <?php $this->db->where('school_code',$this->session->userdata('school_code'));
    $fsd=$this->db->get('general_settings')->row()->fsd_id;
    
    $this->db->where('id',$fsd);
    $endfsd=$this->db->get('fsd')->row()->finance_end_date;
    
    ?>
    <!--<?php //echo date("M-Y", strtotime($endfsd));?>-->
    <div class="row">
    	<div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">12.क्या विद्यार्थी ने विद्यालय की सभी देय राशि का भुगतान कर दिया है : Whether the pupil has paid all dues to 
    	the vidyalaya</br></br>&nbsp;&nbsp; :
    	<strong style="color:black; text-transform:uppercase">YES</strong></div>

	</div>
	<div class="row">
	    <div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">13.क्या विद्यार्थी को कोई शुल्क रियायत प्रदान की गयी थी , यदि हाँ , तो उसकी प्रकृति : Whether the pupil was in reciept of any 
	    </br></br>&nbsp;&nbsp;&nbsp;fee concession,if so the nature of the such concession : <strong style="color:black;text-transform:uppercase;"><input type="text" value="<?php if(strlen($tccerti->any_fee_concession)>1){echo $tccerti->any_fee_concession;}else{ echo "N/A";};?>" id="concession" class="renewed text-uppercase disable"/></strong></div>

	</div>
	<div class="row">
	    <div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">14.क्या विद्यार्थी  एन . सी . सी कैडेट / स्कॉउट के विवरण दे : Whether the pupil is NCC Cadet,Boy/Girl Scout (give details)</br></br>&nbsp;&nbsp;&nbsp; : <strong style="color:black;text-transform:uppercase;"><input type="text" value="<?php if(strlen($tccerti->ncc_cadet)>1){echo $tccerti->ncc_cadet;}else{ echo "N/A";};?>" id="ncc_cadet" class="renewed text-uppercase disable"/></strong></div>

	</div>
	<div class="row">
	    <div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">15. विद्यालय से विद्यार्थी के नाम कटे जाने की तिथि :Date of which pupil name was struck off the rolls of the vidyalaya : <strong style="color:black;text-transform:uppercase;"><input type="text" value="<?php if($tccerti->joining_date){echo date("Y-m-d", strtotime($tccerti->joining_date));}else{ echo "N/A";};?>" id="addmission_date" class="renewed text-uppercase disable"/></strong></div>

	</div>
	<div class="row">
	    <div class="col-md-12" style="padding-top:6px; padding-bottom:6px; font-size:13px;">16.विद्यालय छोड़ने का कारण / Reason for leaving the School : <strong style="color:black; text-transform:uppercase">Another Admission </strong></div>

	</div>
	<div class="row">
	    <div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">17.अंतिम तिथि तक उपस्थितियो की कुल संख्या / No. of meeting up to date : <strong style="color:black;text-transform:uppercase;"><input type="text" value="<?php if(strlen($tccerti->meeting_date)>1){echo $tccerti->meeting_date;}else{ echo "N/A";};?>" id="meeting_date" class="renewed text-uppercase disable"/></strong></div>

	</div>
	<div class="row">
	    <div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">18. विद्यार्थी की विद्यालय दिवसों की कुल उपस्थितियॉ /No. of school days the pupil attended :<strong style="color:black;text-transform:uppercase;"><input type="text" value="<?php if(strlen($tccerti->pupil_attended_day)>1){echo $tccerti->pupil_attended_day;}else{ echo "N/A";};?>" id="attended_day" class="renewed text-uppercase disable"/></strong> </div>

	</div>
	<div class="row">
	    <div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">19.सामान्य आचरण / General conduct :<strong style="color:black; text-transform:uppercase">Good </strong> </div>

	</div>
	<div class="row">
	    <div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">20.विद्यालय का वर्ग सरकारी / माइनोरिटी / स्ववित्तपोषी के  अंतर्गत  Whether School is under Govt./Minority/Independent</br></br>&nbsp;&nbsp;&nbsp; category : <strong style="color:black; text-transform:uppercase">Independent </strong></div>

	</div>
	<div class="row">
	    <div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">21. कोई अन्य टिप्पणी /Any other remarks : <strong style="color:black;"><input type="text" value="<?php if(strlen($tccerti->other_remarks)>1){echo $tccerti->other_remarks;}else{ echo "N/A";};?>" id="other_remark" class="renewed text-uppercase disable"/></strong></div>
	
	 </div>
	<div class="row">
	    
	    <div class="col-md-12" style="padding-top:8px; padding-bottom:8px; font-size:13px;">22. प्रमाण - पत्र जारी करने की तिथि /Date of issue of certificate : <strong style="color:black; text-transform:uppercase"><?php echo date('Y-m-d');?> </strong></div>

	
	</div>
	</br></br></br></br></br>
	<div>
			<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tbody>
					<tr style="padding-top:8px; padding-bottom:8px; font-size:17px;">
						<td valign="top" width="275"><div align="left">
								<strong>तैयारकर्ता /Prepared by</strong><br><br>
						<!--		(Name & Designation)-->
							</div></td>
							<td valign="top" width="275"><div align="left">
								<strong>जांचकर्ता /Checked by</strong><br><br>
							<!--	(Name & Designation)-->
							</div></td>
						  <td valign="top" width="275"><div align="left">
								<strong>ह . प्रचार्य / कार्यालय  मोहर Sign. of Principal</strong><br><br>
							<!--	(Official Seal)-->
							</div></td>
					</tr>
				</tbody>
			</table>
		</div>
		</div>
	<br/><br/>

    </div>
    
    
</div>
<div class="row">
   <table><tr><td>
    <div class="col-md-4" style="text-align:center;">
    <button class="button button2" type="button" id="edit">
       Edit
    </button>
  </div>
  </td><td>
  <div class="col-md-4" style="text-align:center;">
    <button class="button button2" type="button" id="save">
      </i> Save
    </button>
  </div>
  </td><td>
<div class="invoice-buttons col-md-4" style="text-align:center;">
    <button class="button button2" type="button"  onclick="window.print();">
      <i class="fa fa-print padding-right-sm"></i> Print Reciept
    </button>
  </div>
</td> </tr> </table>
  </div>
  </div>
</div>
</body>
<script>
jQuery(document).ready(function() {
   // alert("hi");
    $(".renewed").hide();
    $("#edit").click(function(){
    		$('.renewed').show();
        });
         $("#save").click(function(){
        	var stuid = $('#stuid').val();
    		var renew_upto = $('#renew_upto').val();
    		var school_status = $('#school_status').val();
    		var registration_no = $('#registration_no').val();
    		var status = $('#status').val();
    		var subjectid = $('#subjectid').val();
    		var concession = $('#concession').val();	
    		var ncc_cadet = $('#ncc_cadet').val();
    		var addmission_date = $('#addmission_date').val();
    		var meeting_date = $('#meeting_date').val();
    		var attended_day = $('#attended_day').val();	
    		var other_remark = $('#other_remark').val();
    	//	alert("Fee Category successfully created");
    		$.post("<?php echo site_url('index.php/certificateController/addtc') ?>", {
    		    stuid : stuid,
    		    renew_upto : renew_upto,
    		    school_status : school_status,
    		    registration_no : registration_no,
    		    status : status,
    		    subjectid : subjectid,
    		    concession : concession,
    		    ncc_cadet : ncc_cadet,
    		    addmission_date : addmission_date,
    		    meeting_date : meeting_date,
    		    attended_day : attended_day,
    		    other_remark : other_remark,
    		    
    		}, function(data){
    		    //alert(data);
                $("#save").html(data);
                
    		});
        });
});
</script>
</html>