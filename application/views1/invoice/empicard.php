<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

  <title>Employee Icard</title>
  <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/style.css' />
  <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/print.css'
    media="print" />
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
  <div id="printcontent">
    <div id="page-wrap">
      <div class="row">
        <div class="col-sm-12">
          <?php
			if(isset($empProfile)):
				$personalInfo = $empProfile->row();
				//$gurdianInfo = $gurdianDetail->row();?>
         
					<div id="page-wrap">
            <table style="width: 55%; font-size:14px; font-weight: bold; "class="text-uppercase">
              <tr style="background-image: linear-gradient(to bottom right, red, yellow); color:white;">
                <?php $this->db->where("id",$this->session->userdata("school_code"));
				$schoolinfo = $this->db->get("school")->row();
			  $fsd=	$this->session->userdata("fsd");
			  $this->db->where("id",$fsd);
		    $tfsd =	$this->db->get("fsd")->row();
				?>
                <td colspan="3">
                  <!--  <img style="margin-right: -80px; float: left; margin-left: 10px; margin-top: 10px; width: 120px; height: 120px; border-radius: 50%;" src="<?php echo base_url();?>assets/<?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $schoolinfo->logo;?>" alt="Logo" />-->
                  <h5 style="text-transform:uppercase; text-align:center;"><?php echo $schoolinfo->school_name; ?></h5>
                  <h6 style="font-variant:small-caps; text-align:center;">
                    <?php echo "Mobile No. : +91-".$schoolinfo->mobile_no;?></h6>
                  <h6 style="font-variant:small-caps; text-align:center;">
                    <?php echo "REG.OFFICE : ".$schoolinfo->address1.' '.$schoolinfo->city.' '.$schoolinfo->state; ?></h6>
                    <h6 style="font-variant:small-caps; text-align:center;"><?php echo $personalInfo->job_title; ?> ID Card
                      <?php echo date('Y',strtotime($tfsd->finance_start_date))."-".date('Y',strtotime($tfsd->finance_end_date));?>
                    </h6>
                    <h3 style="font-variant:small-caps; text-align:center;"></h3>
                 
                </td>
              </tr>

              <tr>
               <td style="padding:3px; width:220px;">Name</td>
                <td style="width:300px;">
                  <?php echo $personalInfo->name; ?>
                </td>
                <td rowspan="8" align="center">
                  <div>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div style="width:150px; height:170px; border: 1px solid #ccc; margin:auto; margin-top:0px;">
                        <?php if(strlen($personalInfo->photo > 0)):?>
                        <img alt="<?php echo $personalInfo->name;?>" height="170" width="120"
                          src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $personalInfo->photo;?>" />
                        <?php else:?>
                        <?php if($personalInfo->gender == 1):?>
                        <img alt="<?php echo $personalInfo->name;?>" height="148" width="120"
                          src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empMale.png" />
                        <?php endif;?>
                        <?php if($personalInfo->gender == 0):?>
                        <img alt="<?php echo $personalInfo->name;?>" height="148" width="120"
                          src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/empFemale.png" />
                        <?php endif;?>
                        <?php endif;?>
                      </div>
                    </div>
                  </div>
                  <div>
                    <h4 style="margin-top: 5px; text-align:center;">AUTHORISED SIGN</h4>
                                                            <?php if($this->session->userdata("school_code")==2){ ?>
                                        <img src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/images/sign.jpg" alt="" width="100" height="50"  />
                                   <?php }?>
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding:3px">Employee ID</td>
                <td>
                  <?php echo $personalInfo->username; ?>
                </td>
              </tr>
              <tr>
                <td style="padding:3px">Gender</td>
                <td>
                  <?php if (strlen ($personalInfo->gender==1)){echo "Male";}elseif(strlen ($personalInfo->gender==0)){echo "Female";}else echo '<span style="color:#ff9999">N/A</span>'; ?>
                </td>
              </tr>
              
               <tr>
                <td style="padding:3px">DOB</td>
                <td>
                  <?php echo $personalInfo->dob; ?>
                </td>
              </tr>
              <tr>
                <td style="padding:3px">Job Title</td>
                <td>
                  <?php  if($personalInfo->job_category==1){
                  echo "Accountant";
                  } 
                  elseif($personalInfo->job_category==2){
                       echo "Employee"; 
                  }
                elseif($personalInfo->job_category==3){
                       echo "Teacher"; 
                  }
                 elseif($personalInfo->job_category==4){
                       echo "Principal"; 
                  }
                  ?>
                </td>
              </tr>
              <tr>
                <td style="padding:3px">Mobile Number</td>
                <td>
                  <?php echo $personalInfo->mobile; ?>
                </td>
              </tr>
              <tr class="text-uppercase">
                <td style="padding:3px">Address</td>
                <td>
                  <?php echo $personalInfo->address." ".$personalInfo->city." ".$personalInfo->state; ?>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <?php	endif; ?>
    </div>
  </div>
 
  </div>
  </div>
  </div>
</body>
<div class="invoice-buttons" style="text-align:center;">
    <button class="button button2" type="button"  onclick="window.print();">
      <i class="fa fa-print padding-right-sm"></i> Print
    </button>
  </div>
</html>