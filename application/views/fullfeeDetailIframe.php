<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

<title>Fee card Details</title>

	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/prin_result.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/example.js'></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	
	<style type="text/css">

	@media print
	{
			body * { visibility: hidden; }
			#printcontent * { visibility: visible; }
			#printcontent { position: absolute; top: 40px; }
	    }
    .nob{
    	border: none;
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
  <div id="page-wrap" class="row text-center" style="padding-top:none; width:800px; border: 1px solid black; border-bottom:none;">
<h2>Fee Details</h2>
</div>

	<div id="page-wrap" style="width:800px; border: 1px solid black; padding:1%;">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-md-4 text-center ml-2 mt-2">
                                <?php if(strlen($student->photo)>1){?>
                                <img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code"); ?>/images/stuImage/<?php echo $student->photo; ?>" style="float:left; border-radius:50%; width:100px; height:100px;" alt="<?php echo $student->name ?>">
                            <?php }else{
                            if($student->gender==1){?>
                                <img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code"); ?>/images/stuImage/stuMale.png" height="148" width="148" class="img-circle" alt="<?php echo $student->name ?>">
                           <?php }else{?>
                               <img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code"); ?>/images/stuImage/stuFemale.png" height="148" width="148" class="img-circle" alt="<?php echo $student->name ?>">
                          <?php }
                            }?>
                            </div>
                            <div class="col-md-8" >
                                <div class="table-responsive">
                                    <div>
                                        <table class="table table-responsive ">

                                            <?php $this->db->where("id", $student->class_id);
										                    	$class = $this->db->get("class_info")->row(); ?>

                                            <?php $this->db->where("id", $class->section);
											                        $sec = $this->db->get("class_section")->row(); ?>

                                            <tbody>
                                                <tr>
                                                    <td style="border:none;">
                                                        <strong>Student Id:</strong>&nbsp;<?php echo $student->username; ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="border:none;">
                                                        <strong>Student Name:</strong>&nbsp;<?php echo $student->name; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border:none;">
                                                        <strong>Class & Sec:</strong>&nbsp;<?php echo $class->class_name; ?> & <?php echo $sec->section; ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>S.no.</th>
                                    <th>Month Name</th>
                                    <th>Total Amount</th>
                                    <th> Should Deposit Date</th>
                                    <th>Deposit Date</th>
                                    <th>Staff Signature</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php 


								$this->db->where("id", $this->session->userdata("fsd"));
								$fsd  =  $this->db->get("fsd")->row()->finance_start_date; ?>
                                <?php
								$this->db->select("*");
								$this->db->where("school_code", $this->session->userdata("school_code"));
								$apm1  =  $this->db->get("late_fees");
								if ($apm1->num_rows() > 0) {
										$apm = $apm1->row()->apply_method;
										$h = 0;
										$pm = 12 / $apm;
										for ($j = 1; $j < $pm + 1; $j++) {
												$rdt = date('Y-m-d', strtotime("$h months", strtotime($fsd)));
											//	print_r($rdt);
												?>

                                  <?php
									$month = date("m", strtotime($rdt));
								//	print_r($month);
									$this->db->select_sum('fee_head_amount');
									$this->db->where("class_id", $student->class_id);
									$this->db->where("taken_month", (int)$month);
									//$this->db->where("fee_head_name",$h);
									$classfeeamount = $this->db->get("class_fees")->row();
//	print_r($classfeeamount);
									?>

                                    <?php
									$this->db->where("fsd", $student->fsd);
                                    $this->db->where("school_code", $this->session->userdata('school_code'));
                                    $this->db->where("month_number", (int)$month);
									//$this->db->where("fee_head_name",$h);
                                    $date = $this->db->get("fee_card_detail");
                                    //	print_r($date->row());
                                    ?>

                                    <?php
                                     //print_r($student->id);
                                    $this->db->where("fsd", $student->fsd);
                                    $this->db->where("student_id", $student->id);
                                    $this->db->where("deposite_month", (int)$month);
                                    $invoice1 = $this->db->get("deposite_months");
                                    if($invoice1->num_rows()>0){
                                        $invoice=$invoice1->row();
                                   
                                    //exit;
                                    $this->db->where("finance_start_date", $student->fsd);
                                    $this->db->where("school_code",$this->session->userdata('school_code'));
                                    $this->db->where("student_id",$student->id);
                                    $this->db->where("invoice_no",$invoice->invoice_no);
                                    $depositedate=$this->db->get('fee_deposit');

                                    ?>
                                <tr>
                                    <td><?php echo $j; ?></td>
                                    <td><?php echo date("M-Y", strtotime($rdt)); ?></td>
                                    <td><?php echo $classfeeamount->fee_head_amount;?></td>
                                   <?php
                                    if($date->num_rows()>0){
									?>
                                    <td><?php echo $date->row()->deposite_date;?></td>
                                    <?php }else {?>
                                    <td><?php echo "N/A";?></td>
                                    <?php }?>
                                    <?php
									if($depositedate->num_rows()>0){
                                        ?>
                                        <td><?php echo $depositedate->row()->diposit_date;?></td>
                                        <?php }else {?>
                                        <td><?php echo "N/A";?></td>
                                        <?php }?>
                                    <td></td>
                                </tr>
                                <?php
								$h = $h + $apm;
                            }
                           
                        }
					}
				?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
</body>
	<div class="invoice-buttons" style="text-align:center; margin-top:3%;">
    <button class="btn btn-primary button2" type="button"  onclick="window.print();">
      <i class="fa fa-print padding-right-sm"></i> Print
    </button>
  </div>
</html>

