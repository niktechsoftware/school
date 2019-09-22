<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

    <title>Student ICard</title>

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
        background-color: #4CAF50;
        /* Green */
        border: none;
        color: white;
        padding: 16px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        -webkit-transition-duration: 0.4s;
        /* Safari */
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
        //   echo $fsd;
        //   echo $classid;
        //   echo $sectionid;
        $this->db->where('status',1);
            $this->db->where('class_id',$classid);
            $sid=$this->db->get('student_info');
	    foreach($sid->result() as $studentProfile){
		
            $personalInfo = $studentProfile;
            $this->db->where('student_id',$personalInfo->id);
            $guardian_info=$this->db->get('guardian_info');
            $gurdianInfo = $guardian_info->row();?>

                    <div id="page-wrap">
                        <table style="width: 54%; font-size:12px; font-weight: bold;">
                            <tr style="background-color:#188f7f; color:white;">
                                <?php $this->db->where("id",$this->session->userdata("school_code"));
				$schoolinfo = $this->db->get("school")->row();
			  $fsd=	$this->session->userdata("fsd");
			  $this->db->where("id",$fsd);
		    $tfsd =	$this->db->get("fsd")->row();
				?>
                                <td colspan="3" ><div style="background-color:#188f7f;">
                                    <!--<img style="margin-right: -80px; float: left; margin-left: 10px; margin-top: 10px; width: 50px; height: 50px; border-radius: 50%;" src="<?php echo base_url();?>assets/<?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $schoolinfo->logo;?>" alt="Logo" />-->
                                    <h2 style="text-transform:uppercase; text-align:center;color:red;">
                                        <?php echo $schoolinfo->school_name; ?></h2>
                                    <h3 style="font-variant:small-caps; text-align:center;color:#e5e75f;">
                                        <?php echo "Mobile No. : +91-".$schoolinfo->mobile_no;?></h3>
                                    <!--<h5 style="font-variant:small-caps; text-align:center;">-->
                                    <!--  <?php //echo "REG.OFFICE : ".$schoolinfo->address1.' '.$schoolinfo->city.' '.$schoolinfo->state; ?></h5>-->
                                    <!--  <h2 style="font-variant:small-caps; text-align:center;">Student ID Card-->
                                    <!--    <?php //echo date('Y',strtotime($tfsd->finance_start_date))."-".date('Y',strtotime($tfsd->finance_end_date));?>-->
                                    <!--  </h2>-->
                                    <!--  <h3 style="font-variant:small-caps; text-align:center;"></h3>-->
                                    <!--</h3>-->
                                </div></td>
                            </tr>

                            <tr>
                                <td style="padding:6px; width:220px;">Name</td>
                                <td style="width:300px;  text-transform: uppercase;">
                                    <?php echo $personalInfo->name; ?>
                                </td>
                                <td rowspan="8" align="center">
                                    <div>
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div
                                                style="width:150px; height:150px; border: 1px solid #ccc; margin:auto;">
                                                <?php if(strlen($personalInfo->photo > 0)):?>
                                                <img alt="<?php echo $personalInfo->name;?>" height="148" width="138"
                                                    src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $personalInfo->photo;?>" />
                                                <?php else:?>
                                                <?php if($personalInfo->gender == 1):?>
                                                <img alt="<?php echo $personalInfo->name;?>" height="148" width="138"
                                                    src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/stuMale.png" />
                                                <?php endif;?>
                                                <?php if($personalInfo->gender == 0):?>
                                                <img alt="<?php echo $personalInfo->name;?>" height="148" width="138"
                                                    src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/stuFemale.png" />
                                                <?php endif;?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h4 style="margin-top: 10px; text-align:center;">PRINCIPAL SIGN</h4>
                                        <?php if($this->session->userdata("school_code")==2){ ?>
                                        <img src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/images/sign.jpg" alt="" width="100" height="50"  />
                                   <?php }?>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding:6px">Class</td>
                                <?php $this->db->select('class_name,section');
					  $this->db->where('id',$personalInfo->class_id);
				      $classInfo=$this->db->get('class_info')->row();?>
                                <td><?php echo $classInfo->class_name; ?></td>
                            </tr>
                            <tr>
                                <td style="padding:6px">Student ID</td>
                                <td>
                                    <?php echo $personalInfo->username; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:6px">DOB</td>
                                <td>
                                    <?php if(strlen($personalInfo->dob) > 1) {echo $personalInfo->dob; }else echo "N/A"; ?>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding:6px">Father Name</td>
                                <td style="text-transform: uppercase;">
                                    <?php echo $gurdianInfo->father_full_name; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:6px">Mobile Number</td>
                                <td>
                                    <?php echo $personalInfo->mobile; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:6px">Address</td>
                                <td>
                                    <?php echo $personalInfo->address1; ?>
                                </td>
                            </tr>
                        </table><br><br>
                    </div> <?php 	} ?>
                </div>
            </div>


        </div>
    </div>


    <!--</div>
  </div>
  </div>-->
</body>
<div class="invoice-buttons" style="text-align:center;">
    <button class="button button2" type="button" onclick="window.print();">
        <i class="fa fa-print padding-right-sm"></i> Print
    </button>
</div>

</html>