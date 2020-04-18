<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <title><?php echo $title; ?></title>
    <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/style.css' />
    <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/prin_result.css' media="print" />
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
            top: -20px;
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

    .nob {
        border: none;
    }
    </style>
    <script>
    function convert_number(number) {
        if ((number < 0) || (number > 999999999)) {
            return "Number is out of range";
        }
        var Gn = Math.floor(number / 10000000); /* Crore */
        number -= Gn * 10000000;
        var kn = Math.floor(number / 100000); /* lakhs */
        number -= kn * 100000;
        var Hn = Math.floor(number / 1000); /* thousand */
        number -= Hn * 1000;
        var Dn = Math.floor(number / 100); /* Tens (deca) */
        number = number % 100; /* Ones */
        var tn = Math.floor(number / 10);
        var one = Math.floor(number % 10);
        var res = "";

        if (Gn > 0) {
            res += (convert_number(Gn) + " Crore");
        }
        if (kn > 0) {
            res += (((res == "") ? "" : " ") +
                convert_number(kn) + " Lakhs");
        }
        if (Hn > 0) {
            res += (((res == "") ? "" : " ") +
                convert_number(Hn) + " Thousand");
        }

        if (Dn) {
            res += (((res == "") ? "" : " ") +
                convert_number(Dn) + " hundred");
        }


        var ones = Array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven",
            "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
        var tens = Array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");

        if (tn > 0 || one > 0) {
            if (!(res == "")) {
                res += " and ";
            }
            if (tn < 2) {
                res += ones[tn * 10 + one];
            } else {

                res += tens[tn];
                if (one > 0) {
                    res += ("-" + ones[one]);
                }
            }
        }

        if (res == "") {
            res = "zero";
        }
        return res;
    }
    </script>

    <style>
    table,
    tr,
    th {

        border: 1px solid black;
        border-collapse: collapse;
    }
    </style>
</head>

<body>
    <div id="printcontent" align="center">
	<?php 
				$school=$this->session->userdata('school_code');
				$row2=$this->db->get('db_name')->row()->name;		
			?>

		<!--other size start-->
	 <div id="page-wrap" style="margin-top: 70px;height: 1330px;width:960px; border:1px solid #333;">
		<div style="width:100%; height:1330px;margin-left:auto; margin-right:auto; border:1px  solid blue;">
		<!--other size end-->
                <div style="width:95%; margin-left:auto; margin-right:auto; border:1px  solid yellow; height:auto;">
                    <?php
						$school_code = $this->session->userdata("school_code");
						$this->db->where("id",$school_code);
						$info =$this->db->get("school")->row();
					?>
                    <table style="width: 100%;"> 
					<tr style="background-color: #b38cb1;">
                           <td  style="border: none;width: 250px;">
                               <img src="<?php echo base_url(); ?>assets/images/cbse_logo.png" alt="" style="height: 110px;width: 120px;">
                             
                                </br><label style="font-size: 13px;">CBSE Aff.No. - <?php echo $info->registration_no;?></label>
                            </td>
                            
                            <td  style="border: none;" >
                                <h1 style="font-size: 30px; font-family: Algerian;">
                                    <?php echo $info->school_name;?></h1>
                            </td>
                            <td style="border: none;">
                                   <img src="<?php echo $this->config->item('asset_url'); ?><?php echo $school_code;?>/images/empImage/<?php echo $info->logo;?>"
                                    alt="" style="height: 100px;width: 100px;" />
                                <br /><label style="font-size: 13px;">School Code - 70462</label>
                            </td>
                           
						</tr>
						 <tr class="wight" style="font-size: 14px;">
							<td 
								<span style="text-transform: uppercase;">Scholar ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span><span style="text-transform: uppercase;color:red;"> <?= $studentInfo->username."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?></span><br>
							
							   <?php
										   $this->db->where('school_code',$school_code);
										   $this->db->where('id',$classid->class_id);
										   $classname=$this->db->get('class_info');
										  
											?>
								  <?php if($classname->num_rows()>0){
								  $classdf=$classname->row();
								  $this->db->where("id",$classdf->section);
								  $secname = $this->db->get("class_section")->row()->section;
								  ?>
								<span style="text-transform: uppercase;">Class&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span><span style="text-transform: uppercase;color:red;">  <?php  echo $classdf->class_name."-".$secname; ?></span>
								 <?php } else { echo "something wrong please try again";  }?>
							
							</td>
							<td >
							    	<span style="text-transform: uppercase;">Student's Name &nbsp;&nbsp;: </span><span style="text-transform: uppercase;color:red;"> <?= strtoupper($studentInfo->name);?> </span><br>
						        <span style="text-transform: uppercase;">Mother's Name&nbsp;&nbsp;&nbsp;&nbsp;:</span><span style="text-transform: uppercase;color:red;">  <?= strtoupper($parentInfo->mother_full_name); ?></span><br>
								<span style="text-transform: uppercase;">Father's Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </span><span style="text-transform: uppercase;color:red;"> <?= strtoupper($parentInfo->father_full_name); ?></span><br>
							</td>
							<td >
								<img src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/images/stuImage/<?php echo $studentInfo->photo; ?>"  alt="" width="90" height="105" />
							</td>
						</tr>
						<tr>
						
							<td style="border: none;" colspan="3">
								<center><h2 style="border: 2px solid #000; padding: 5px; width: 209px; ">
									Progress Report [ <?php 
									        $this->db->where('school_code',$school_code);
                                            $this->db->where('id',$fsd);
                                     $fsd2= $this->db->get('fsd')->row()->finance_end_date;
									echo (date('Y', strtotime('-1 year', strtotime($fsd2)) )."-". date('Y', strtotime($fsd2))) ;?>]<br>
									<?php 
									$this->db->where("school_code",$school_code);
								   $this->db->where("fsd",$this->session->userdata('fsd'));
									$this->db->where("stu_id",$studentInfo->id);
									$result= $this->db->get("exam_info")->result();
									$c="";$d="";
									foreach($result as $d12):
									$c = $d12->class_id;
					  
									break;
									endforeach;
									if(strlen($c)>0){	
								}else{
									echo " There are no marks entry for this Student";
								} 
									?>
								</h2></center>
							</td>
							
						</tr>
                </table>
            
            <br>
             <!-- scholar & mkd accademy start -->
            <div>
                <table
                    style="width:95%;text-transform: uppercase; margin-left:auto; margin-right:auto; border:1px solid black; background-color:white;font-weight:bold;font-size: 14px;">
                    <tr>
                        <?php if($classid->class_id == 260 || $classid->class_id == 314){?>
                        <th colspan="1" rowspan="2" style="background-color:#9dfa5b;">SCHOLASTIC AREA </th>
						<th colspan="1" rowspan="2" style="background-color: #efef70;">TERM 1 </th>
						<th colspan="2" rowspan="2" style="background-color: #efef70;">Term 2  </th>
						<th colspan="3" style="background-color: #efef70;">OVERALL</th>
						<?php }else{?>
                        <th colspan="1" rowspan="2" style="background-color:#9dfa5b;">SCHOLASTIC AREA </th>
						<th colspan="3" rowspan="2" style="background-color: #efef70;">TERM 1 (100 MARKS) </th>
						<th colspan="3" rowspan="2" style="background-color: #efef70;">Term 2 (100 Marks) </th>
						<th colspan="2" style="background-color: #efef70;">OVERALL</th>
					<?php }?>
					</tr>
                    <tr>
                       <!-- <th colspan="3">Term 1 (50)+ Term 2(50)</th>-->
                    </tr>
                    <tr>
                        <th colspan="1" rowspan="1" style="text-transform: uppercase;background-color:#9dfa5b;">Subjects</th>
                        <!--1st term exam name start-->
						<?php  if($examid->num_rows()==0){?>
							
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"></td>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"></td>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"></td>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"></td>
													<?php }else if($examid->num_rows()==1){ ?>
						<?php 
							$i=1;
							
							//print_r($examid);
							 foreach ($examid->result() as $value):
							     
							  echo  $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							    $this->db->where('term',1);
							   $examname=$this->db->get('exam_name');   
							   if ($examname->num_rows()>0){
							   $examname=$examname->row();
						?> 
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"><?php echo $examname->exam_name;
						$this->db->where('exam_id',$value->exam_id);
						$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
						echo "[".$exammm."]";
						?></td>
                        <?php 
						}
						$i++;
						endforeach ; ?>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"></td>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"></td>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"></td>		
			    <?php }else if($examid->num_rows()==2){ ?>
						<?php 
							$i=1;
							 foreach ($examid->result() as $value):
							   $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							    $this->db->where('term',1);
							   $examname=$this->db->get('exam_name');   
							   if ($examname->num_rows()>0){
							   $examname=$examname->row();
							   if($i==2){
							   
							   }else{
						?> 
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"><?php echo $examname->exam_name;
						$this->db->where('exam_id',$value->exam_id);
						$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
						//echo "[".$exammm."]";
						?></td>
                        <?php 
						}}
						$i++;
						endforeach ; ?>
					
						<?php }else if($examid->num_rows()==3){ ?>
						<?php 
							$i=1;
							 foreach ($examid->result() as $value):
							  $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							    $this->db->where('term',1);
							   $examname=$this->db->get('exam_name');   
							   if ($examname->num_rows()>0){
							   $examname=$examname->row();
						?> 
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"><?php echo $examname->exam_name;
						$this->db->where('exam_id',$value->exam_id);
						$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
						echo "[".$exammm."]";
						?></td>
                        <?php 
						}
						$i++;
						endforeach ; ?>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;" ></td>
						<?php  }else{ ?>
						<?php 
							$i=1;
							 foreach ($examid->result() as $value):
							   $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							    $this->db->where('term',1);
							   $examname=$this->db->get('exam_name');   
							   if ($examname->num_rows()>0){
							   $examname=$examname->row();
						?> 
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"><?php echo $examname->exam_name;
									$this->db->where('exam_id',$value->exam_id);
						$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
						echo "[".$exammm."]";
						?></td>
                        <?php 
						}
						$i++;
						endforeach ; ?>
																							<?php } ?>
						<?php
						if(!$i%2==0){ 
						if($classid->class_id == 260 || $classid->class_id==314){}else{?>
						<td class="center bold" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;">Total</td> 
							<!--<td class="center bold" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;">Grade</td> -->
						<?php }} ?>
						<!--1st term exam name end-->
						<!--2nd term exam name start-->
						<?php  if($examid_2->num_rows()==0){?>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"></td>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"></td>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"></td>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"></td>
													<?php }else if($examid_2->num_rows()==1){ ?>
						<?php 
							$i=1;
							 foreach ($examid_2->result() as $value):
							   $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							    $this->db->where('term',2);
							   $examname=$this->db->get('exam_name');   
							   if ($examname->num_rows()>0){
							   $examname=$examname->row();
						?> 
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"><?php echo $examname->exam_name;
						$this->db->where('exam_id',$value->exam_id);
						$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
						echo "[".$exammm."]";
						?></td>
                        <?php 
						}
						$i++;
						endforeach ; ?>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;" ></td>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;" ></td>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"></td>		
													<?php }else if($examid_2->num_rows()==2){ ?>
						<?php 
							$i=1;
							 foreach ($examid_2->result() as $value):
							   $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							    $this->db->where('term',2);
							   $examname=$this->db->get('exam_name');   
							   if ($examname->num_rows()>0){
							   $examname=$examname->row();
						?> 
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"><?php echo $examname->exam_name;
						$this->db->where('exam_id',$value->exam_id);
						$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
					//	echo "[".$exammm."]";
						?></td>
                        <?php 
						}
						$i++;
						endforeach ; ?>
						
						<?php }else if($examid_2->num_rows()==3){ ?>
						<?php 
							$i=1;
							 foreach ($examid_2->result() as $value):
							   $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							    $this->db->where('term',2);
							   $examname=$this->db->get('exam_name');   
							   if ($examname->num_rows()>0){
							   $examname=$examname->row();
						?> 
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"><?php echo $examname->exam_name;
						$this->db->where('exam_id',$value->exam_id);
						$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
						echo "[".$exammm."]";
						?></td>
                        <?php 
						}
						$i++;
						endforeach ; ?>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;" ></td>
						<?php  }else{ ?>
						<?php 
							$i=1;
							 foreach ($examid_2->result() as $value):
							   $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							    $this->db->where('term',2);
							   $examname=$this->db->get('exam_name');   
							   if ($examname->num_rows()>0){
							   $examname=$examname->row();
						?> 
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;"><?php echo $examname->exam_name;
									$this->db->where('exam_id',$value->exam_id);
						$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
						echo "[".$exammm."]";
						?></td>
                        <?php 
						}
						$i++;
						endforeach ; ?>
																							<?php } ?>
						<?php
						if(!$i%2==0){ ?>
						<td class="center bold" style="text-transform: uppercase; font-weight:bold;background-color:#efef70;">Total</td> 
						<?php } ?>
						<!--2nd term exam name start-->
						  <?php if($classid->class_id ==260 || $classid->class_id==314){}else{?>
						<th style="text-transform: uppercase;background-color: #efef70;">Grand Total<br> </th>
						<?php } ?>
                        <th  style="text-transform: uppercase;background-color: #efef70;">Grade</th>
                       <!-- <th rowspan="1" style="text-transform: uppercase;">Rank</th>-->
                    </tr>

                    <?php 
                    $dhtm=0;
                        $htotal = 0;  
                    	$ctotal =array();
                        $ctotal[0]=0;
                        $ctotal[1]=0;
                        $ctotal[2]=0;
                        $ctotal[3]=0;
                        $ctotal[4]=0;
                        $ctotal["tot2"]=0;
                        $ctotal["tot4"]=0;
						$ctotal["tot5"]=0;
                        $ctotal["tot6"]=0;
                        $cumulativetotal=0;
					   $totalp= 0;   
					  // $pi=1;
					   $grandtotal=0;
					   $grandtotal_2=0;
				foreach($resultData as $sub){
				$this->db->where('class_id',$classid->class_id);
				$this->db->where('id',$sub['subject']);
				$subjectname=$this->db->get('subject'); 
				if($subjectname->num_rows()>0){
					$subjectname=$subjectname->row();
					$totalp+=200;?>
                 <tr class="wight"> 
					 <td class="subject" style="background-color:#9dfa5b;"><?php echo  $subjectname->subject;?></td>
			     <?php 
					$ttal=0;
					$ttal_2=0;
					$gtptal=0;
					$gtptal_2=0;
					$i=1; $t=0;?>
					<!--1st term marks start-->
					<?php  if($examid->num_rows()==0){ ?>
						<td colspan="1" style="background-color: #efef70;"></td>
						<td colspan="1" style="background-color: #efef70;"></td>
						<td colspan="1" style="background-color: #efef70;"></td>
						<td colspan="1" style="background-color: #efef70;" ></td>
					<?php }else if($examid->num_rows()==1){ ?>
					<?php
					foreach ($examid->result() as $value):?>
					<td class="center" style="background-color: #efef70;">	
					<?php
					$this->db->where("term", 1);
					$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid->class_id);
					$this->db->where('stu_id',$studentInfo->id);
					$this->db->where('exam_id',$value->exam_id);
					$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();	
					if(is_numeric($marks->marks)){
					  $gtptal= $gtptal+$marks->marks;
					}else{ $gtptal= $gtptal;}
					
							echo $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid->class_id);
					$this->db->where('exam_id',$value->exam_id);
			$exammm_row=	$this->db->get('exam_max_subject')->row();
				$exammm=	$exammm_row->max_m;
			            
			if(is_numeric($exammm)){
					  $ttal=$ttal+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal= $ttal;
					 $dhtm= $dhtm;   
					}
						}else if($marks->num_rows()==0){ $exammm=" "; }?><?php //echo "/" .$exammm;
						if(is_numeric($exammm)){ echo "/" .$exammm; } ?>
					</td> 
				<?php $i++; $t++;endforeach; ?>
					<td colspan="1" style="background-color: #efef70;"></td>
					<td colspan="1" style="background-color: #efef70;"></td>
					<td colspan="1" style="background-color: #efef70;"></td>
					<?php }
					else if($examid->num_rows()==2){ 
					
				
					foreach ($examid->result() as $value):
					   if($i==2){}else{?>
					<td class="center" style="background-color: #efef70;">	
					<?php
					$this->db->where("term", 1);
					$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid->class_id);
					$this->db->where('stu_id',$studentInfo->id);
					$this->db->where('exam_id',$value->exam_id);
					$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();	
					if(is_numeric($marks->marks)){
					  $gtptal= $gtptal+$marks->marks;
					}else{ $gtptal= $gtptal;}
					
							echo $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid->class_id);
					$this->db->where('exam_id',$value->exam_id);
			$exammm_row=	$this->db->get('exam_max_subject')->row();
				$exammm=	$exammm_row->max_m;
			            
			if(is_numeric($exammm)){
					  $ttal=$ttal+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal= $ttal;
					 $dhtm= $dhtm;   
					}
						}else if($marks->num_rows()==0){ $exammm=" "; }?><?php //echo "/" .$exammm;
						if(is_numeric($exammm)){ echo "/" .$exammm; } ?>
					</td> 
				<?php } $i++; $t++;endforeach; ?>
			
				<?php }else if($examid->num_rows()==3){ ?>
												<?php
					foreach ($examid->result() as $value):?>
					<td class="center" style="background-color: #efef70;">	
					<?php
					$this->db->where("term", 1);
					$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid->class_id);
					$this->db->where('stu_id',$studentInfo->id);
					$this->db->where('exam_id',$value->exam_id);
					$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();	
					if(is_numeric($marks->marks)){
					  $gtptal= $gtptal+$marks->marks;
					}else{ $gtptal= $gtptal;}
					
							echo $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid->class_id);
					$this->db->where('exam_id',$value->exam_id);
			$exammm_row=	$this->db->get('exam_max_subject')->row();
				$exammm=	$exammm_row->max_m;
			            
			if(is_numeric($exammm)){
					  $ttal=$ttal+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal= $ttal;
					 $dhtm= $dhtm;   
					}
						}else if($marks->num_rows()==0){ $exammm=" "; }?><?php //echo "/" .$exammm;
						if(is_numeric($exammm)){ echo "/" .$exammm; } ?>
					</td> 
				<?php $i++; $t++;endforeach; ?>
			
				<?php }else{ ?>
					<?php foreach ($examid->result() as $value):?>
					<td class="center" style="background-color: #efef70;">	
					<?php
					$this->db->where("term", 1);
					$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid->class_id);
					$this->db->where('stu_id',$studentInfo->id);
					$this->db->where('exam_id',$value->exam_id);
					$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();	
					if(is_numeric($marks->marks)){
					  $gtptal= $gtptal+$marks->marks;
					}else{ $gtptal= $gtptal;}
					
							echo $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid->class_id);
					$this->db->where('exam_id',$value->exam_id);
			$exammm_row=	$this->db->get('exam_max_subject')->row();
				$exammm=	$exammm_row->max_m;
			            
			if(is_numeric($exammm)){
					  $ttal=$ttal+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal= $ttal;
					 $dhtm= $dhtm;   
					}
						}else if($marks->num_rows()==0){ $exammm=" "; } ?><?php //echo "/" .$exammm;
						if(is_numeric($exammm)){ echo "/" .$exammm; } ?>
					</td> 
				<?php $i++; $t++;endforeach; ?>
																						<?php }
																						if($classid->class_id==260 || $classid->class_id ==314){}else{?>
				<td class="center bold" style="background-color: #efef70;"><?php  $grandtotal=$grandtotal+$gtptal; echo $gtptal;  ?>/<?php print_r($ttal);?>
			   <?php }?></td>
			    <!--1st term marks end-->
				<!--2nd term marks start-->
				<?php  if($examid_2->num_rows()==0){ ?>
						<td colspan="1" style="background-color: #efef70;"></td>
						<td colspan="1" style="background-color: #efef70;"></td>
						<td colspan="1" style="background-color: #efef70;"></td>
						<td colspan="1" style="background-color: #efef70;"></td>
											<?php }else if($examid_2->num_rows()==1){ ?>
				<?php foreach ($examid_2->result() as $value):?>
					<td class="center" style="background-color: #efef70;">	
					<?php
								$this->db->where("term", 2);
								$this->db->where('subject_id',$sub['subject']);
								$this->db->where('class_id',$classid->class_id);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();	
					if(is_numeric($marks->marks)){
					  $gtptal_2= $gtptal_2+$marks->marks;
					}else{ $gtptal_2= $gtptal_2;}
							echo $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid->class_id);
					$this->db->where('exam_id',$value->exam_id);
			$exammm_row=	$this->db->get('exam_max_subject')->row();
				$exammm=	$exammm_row->max_m;
			if(is_numeric($exammm)){
					  $ttal_2=$ttal_2+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal_2= $ttal_2;
					 $dhtm= $dhtm;   
					}
						}else if($marks->num_rows()==0){ $exammm=" "; }?><?php //echo "/" .$exammm;
						if(is_numeric($exammm)){ echo "/" .$exammm; } ?>
					</td> 
				<?php $i++; $t++;endforeach; ?>
				<td colspan="1" style="background-color: #efef70;"></td>
				<td colspan="1" style="background-color: #efef70;"></td>
				<td colspan="1" style="background-color: #efef70;"></td>
				<?php }else if($examid_2->num_rows()==2){ ?>
				<?php foreach ($examid_2->result() as $value):?>
					<td class="center" style="background-color: #efef70;">	
					<?php
								$this->db->where("term", 2);
								$this->db->where('subject_id',$sub['subject']);
								$this->db->where('class_id',$classid->class_id);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();	
					if(is_numeric($marks->marks)){
					  $gtptal_2= $gtptal_2+$marks->marks;
					}else{ $gtptal_2= $gtptal_2;}
							echo $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid->class_id);
					$this->db->where('exam_id',$value->exam_id);
			$exammm_row=	$this->db->get('exam_max_subject')->row();
				$exammm=	$exammm_row->max_m;
			if(is_numeric($exammm)){
					  $ttal_2=$ttal_2+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal_2= $ttal_2;
					 $dhtm= $dhtm;   
					}
						}else if($marks->num_rows()==0){ $exammm=" "; }?><?php //echo "/" .$exammm;
						if(is_numeric($exammm)){ echo "/" .$exammm; } ?>
					</td> 
				<?php $i++; $t++;endforeach; ?>
				
				<?php }else if($examid_2->num_rows()==3){ ?>
				<?php foreach ($examid_2->result() as $value):?>
					<td class="center" style="background-color: #efef70;">	
					<?php
								$this->db->where("term", 2);
								$this->db->where('subject_id',$sub['subject']);
								$this->db->where('class_id',$classid->class_id);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();	
					if(is_numeric($marks->marks)){
					  $gtptal_2= $gtptal_2+$marks->marks;
					}else{ $gtptal_2= $gtptal_2;}
							echo $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid->class_id);
					$this->db->where('exam_id',$value->exam_id);
			$exammm_row=	$this->db->get('exam_max_subject')->row();
				$exammm=	$exammm_row->max_m;
			if(is_numeric($exammm)){
					  $ttal_2=$ttal_2+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal_2= $ttal_2;
					 $dhtm= $dhtm;   
					}
						}else if($marks->num_rows()==0){ $exammm=" "; }?><?php //echo "/" .$exammm;
						if(is_numeric($exammm)){ echo "/" .$exammm; } ?>
					</td> 
				<?php $i++; $t++;endforeach; ?>
				<td colspan="1" style="background-color: #efef70;"></td>
																				<?php }else{ ?>
				<?php foreach ($examid_2->result() as $value):?>
					<td class="center" style="background-color: #efef70;">	
					<?php
								$this->db->where("term", 2);
								$this->db->where('subject_id',$sub['subject']);
								$this->db->where('class_id',$classid->class_id);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();	
					if(is_numeric($marks->marks)){
					  $gtptal_2= $gtptal_2+$marks->marks;
					}else{ $gtptal_2= $gtptal_2;}
							echo $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid->class_id);
					$this->db->where('exam_id',$value->exam_id);
			$exammm_row=	$this->db->get('exam_max_subject')->row();
				$exammm=	$exammm_row->max_m;
			if(is_numeric($exammm)){
					  $ttal_2=$ttal_2+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal_2= $ttal_2;
					 $dhtm= $dhtm;   
					}
						}else if($marks->num_rows()==0){ $exammm=" "; }?><?php //echo "/" .$exammm;
						if(is_numeric($exammm)){ echo "/" .$exammm; } ?>
					</td> 
				<?php $i++; $t++;endforeach; ?>
																						<?php } ?>
				<!--2nd term marks end-->
				  <?php if($classid->class_id ==260 || $classid->class_id==314){}else{?>
					<td class="center bold" style="background-color: #efef70;"><?php  $grandtotal_2=$grandtotal_2+$gtptal_2; echo $gtptal_2;  ?>/<?php print_r($ttal_2);?></td>
				<?php }?>
				<!--overall total & grade start-->	
					<td class="center bold" style="background-color: #efef70;"><?php   echo $overall= $gtptal_2+$gtptal;  ?>/<?php echo $overall_tot=$ttal_2+$ttal;
					if($overall_tot>0){ $per=round((($overall*100)/$overall_tot), 2);}
					?></td>
					<td class="center bold" style="background-color: #efef70;"><?php echo calculateGrade($per,$classid->class_id);?></td>
					<!--overall total & grade end-->
				</tr>
                <?php } }?>
                </table>
            </div>
            <br>
            <div>
                <table
                    style="width:95%; margin-left:auto; margin-right:auto; border:1px solid black; background-color:orange;font-size: 14px;">
                     <tr>
                        <td> Overall Marks : <?php echo $overall_g= $grandtotal+$grandtotal_2; ?>/<?php echo $dhtm;?> </td>
                        <td> Percentage: <?php if($dhtm>0){echo $per=round((($overall_g*100)/$dhtm), 2);}?>%  </td>
                       <!-- <td >
                             Grade: <label style="text-transform: uppercase;"><?php if($dhtm>0){echo $gradecal =calculateGrade($per,$classid->class_id);}?></label>
                        </td>
                        <td>
                            Rank
                        </td>-->
                    </tr>
                </table>
            </div>
            <br>

            <div style=" width:95%; margin-left:auto; margin-right:auto;font-size: 14px;">
                <div style="width:50%; float:left;">
					<?php if($school == 14 && $row2=="C"){ ?>
					<!--gyanodya SCHOLASTIC start-->
					<table style="width:90%; border:1px solid black;">
						<tr>
                            <th colspan="3" style="text-transform: uppercase;">Co- SCHOLASTIC Area</th>
                        </tr>
						<tr>
                            <th style="text-transform: uppercase;"> Activity </th>
                            <th>Grade/Remarks</th>
                        </tr>
                        <!-- Dynamic -->
						<tr>
                            <td>Thinking Skills</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
                        </tr>
						<tr>
                            <td>social skills</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>   
                        </tr>
						<tr>
                            <td>Emotional Skills</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
                        </tr>
						<tr>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    </table>
					<!--gyanodya SCHOLASTIC end-->
					<?php }else if($school == 10 && $row2=="D"){ ?>
					<!--sarvodya SCHOLASTIC start-->
					<table style="width:90%; border:1px solid black;">
						<tr>
                            <th colspan="3" style="text-transform: uppercase;">Co- SCHOLASTIC Area</th>
                        </tr>
						<tr>
                            <th style="text-transform: uppercase;"> Activity </th>
                            <th>Term 1</th>
							<th>Term 2</th>
                        </tr>
                        <!-- Dynamic -->
						<tr>
                            <td>Work Education</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
							<td><?php //if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
                        </tr>
						<tr>
                            <td>Art Education</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td> 
							<td><?php //if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>							
                        </tr>
						<tr>
                            <td>Conversion & Moral Science </td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
							<td><?php //if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
                        </tr>
						<tr>
                            <td>Thinking Skills</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
							<td><?php //if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
                        </tr>
						<tr>
                            <td>Regularity & Punctuality</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td> 
							<td><?php //if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>  
                        </tr>
						<tr>
                            <td>Behaviour & Values</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
							<td><?php //if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
                        </tr>
						<tr>
                            <td>Sincerity</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
							<td><?php //if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>   
                        </tr>
						<tr>
                            <td>Attitude Towards Teachers</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
							<td><?php //if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
                        </tr>
						<tr>
                            <td>Leadership</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
							<td><?php //if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
                        </tr>
						<tr>
                            <td>Co-Operation</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
							<td><?php //if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>   
                        </tr>
						
                    </table>
					<!--sarvodya SCHOLASTIC end-->
					<?php }else{ ?>
					<!--scholar,mkd,bsd,spring SCHOLASTIC start-->
                    <table style="width:90%; border:1px solid black;">
				
						<tr style="background-color:#9dfa5b;">
                            <th colspan="3" style="text-transform: uppercase;">Co- SCHOLASTIC Area</th>
                        </tr>
					
						<tr style="background-color:#9dfa5b;">
                            <th style="text-transform: uppercase;"> Activity </th>
                            <th>TERM 1</th>
                        </tr>
                        <!-- Dynamic -->
					
						<tr style="background-color: #c3c3f5;">
                            <td >Work Education</td>
                            <td><?php  if($per >= 61 && $per < 81 ){ echo "B";}else{if($dhtm>0){echo $gradecal =co_scolastic($per,$classid);}}  ?></td>      
                        </tr>
					
                        <tr style="background-color: #c3c3f5;">
                            <td>Art Education</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>   
                        </tr>
					
                        <tr style="background-color: #c3c3f5;">
                            <td>Health & Physical Education</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
                        </tr>
					
                        <tr style="background-color: #c3c3f5;">
                            <td>Thinking Skills</td>
                            <td><?php  if($per >= 61 && $per < 81 ){ echo "B";}else{if($dhtm>0){echo $gradecal =co_scolastic($per,$classid);}}  ?></td>
                        </tr>
					
                        <tr style="background-color: #c3c3f5;">
                            <td>Sports</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>   
                        </tr>
                         
                    </table>
					
					<!--scholar,mkd,bsd,spring SCHOLASTIC end-->
					<?php } ?>
                    <table style="width:70%; border:1px solid black; background-color:white;">
                        <tr>
                            <?php
                            $this->db->where("class_id",$classid->class_id);
							$this->db->where("school_code",$this->session->userdata('school_code'));
							$dt=$this->db->get("school_attendance");
						    $atotal=$dt->num_rows();
							$this->db->where('id',$this->session->userdata('fsd'));
							$fsdval=$this->db->get('fsd')->row();
							
							$this->db->where('a_date >=',$fsdval->finance_start_date);
							$this->db->where('a_date <=',$fsdval->finance_end_date);
							$this->db->where('stu_id',$studentInfo->id);
							$this->db->where('attendance',0);
							$row1=$this->db->get('attendance');
							$absnt=$row1->num_rows();
							$present =$atotal-$absnt;
							?>
						
                            <td style="background-color:orange;"><label> <?php $this->db->where("username",$studentInfo->username);
                            $getattendancer = $this->db->get("sttenreportscho");
                            if($getattendancer->num_rows()>0){
                                echo "Attendance : ".$getattendancer->row()->attendance."/".$getattendancer->row()->total;		
                            }else{
                                echo "N/A";
                            }
                            ?></label></td>
                       
                           
                        </tr>
                    </table>
                </div>



                <div style="width:50%; float:right;">
					
					<!--scholar,spring,mkd,bsd DISCIPLINE start-->
                    <table style="width:90%; border:1px solid black;">
					
                        <tr style=" background-color:#9dfa5b;">
                            <th colspan="3" style="text-transform: uppercase;"> Discipline</th>
                        </tr>
					
                        <tr style="background-color:#9dfa5b;">
                            <th style="text-transform: uppercase;"> Element </th>
                            <th>TERM 1</th>
                        </tr>
                        <!-- Dynamic -->
					
                        <tr style="background-color: #c3c3f5;">
                            <td>Regularity & Punctuality</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
                        </tr>
					
                        <tr style="background-color: #c3c3f5;">
                            <td>Behaviour & Values</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
                        </tr>
						
                        <tr style="background-color: #c3c3f5;">
                            <td>Attitude Towards Teachers</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
                        </tr>
					
                        <tr style="background-color: #c3c3f5;">
                            <td>Attitude Towards School Mates</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
                        </tr>
					
                        <tr style="background-color: #c3c3f5;">
                            <td>Respectfulness For Rules & Regulations</td>
                            <td><?php if($dhtm>0){echo $gradecal =co_scolastic($per,$classid->class_id);} ?></td>
                        </tr>
                       
                    </table><!--scholar,spring,mkd,bsd DISCIPLINE end-->
			
                    <table style="width:70%; border:1px solid black; background-color:white;">
                        <tr> 
					
							<!--scholar & mkd remark start-->
							<td style="background-color:orange;">Remarks:&nbsp;&nbsp;&nbsp;&nbsp;<label><?php if($dhtm>0){echo $gradecal =remarks($per,$classid->class_id);} ?></label></td>
							<!--scholar  & mkd remark end-->							
													
                        </tr>
                    </table>

                </div>

            </div>
            </br>
          
            <div>
                <p><b><label style="text-transform: uppercase;font-size: 14px;">Instructions</label></b></p>
                <p><label style="font-size: 14px;">Grading Scale For Scholastic areas:Grades are awarded on a 8-point Grading Scale as Follows-</label></p>
            </div>
       
            
            </br>
            <div><?php if($school == 10 && $row2=="D"){ ?><?php }else{ ?>
                <table
                    style="width:95%;  margin-left:auto; margin-right:auto; border:1px solid black; background-color:white;font-size: 14px;">
					<thead> 
						<tr style="background-color: orange;">
							<th>MARKS RANGE </th>
							<th>GRADE</th>
							<?php if($school == 13 && $row2=="A1" || $school == 7 && $row2=="D" || $school == 9 && $row2=="D"){ ?>
							<!--for scholar & mkd title grade chart start-->
							<!--for scholar & mkd title grade chart end-->
							<?php }elseif($school == 14 && $row2=="C"){ ?>
							<!--for gyanodya title grade chart start-->
							<th>GRADE POINT</th>
							<!--for gyanodya title grade chart end-->
							<?php }else{ ?>
							<!--<th>INDICATOR</th>-->
							<?php } ?>
						</tr>
					</thead>
					<tbody>
                    <!-- Dynamic -->
					<!--for scholar & mkd grade chart start-->
                    <?php if($school == 13 && $row2=="A1" || $school == 7 && $row2=="D" || $school == 9 && $row2=="D"){ ?>
                    <tr style="background-color: #d8c4af;">
                        <td>91-100</td>
                        <td>A1</td>
                    </tr>
                    <tr style="background-color: #d8c4af;">
                        <td>81-90</td>
                        <td>A2</td>
                    </tr>
                    <tr style="background-color: #d8c4af;">
                        <td>71-80</td>
                        <td>B1</td>
                    </tr>
                    <tr style="background-color: #d8c4af;">
                        <td>61-70</td>
                        <td>B2</td>
                    </tr>
                    <tr style="background-color: #d8c4af;">
                        <td>51-60</td>
                        <td>C1</td>
                    </tr>
                     <tr style="background-color: #d8c4af;">
                        <td>41-50</td>
                        <td>C2</td>
                    </tr>
                     <tr style="background-color: #d8c4af;">
                        <td>33-40</td>
                        <td>D</td>
                    </tr>
                     <tr style="background-color: #d8c4af;">
                        <td>Needs Improvement</td>
                        <td>E</td>
                    </tr>
					<!--for scholar & mkd grade chart end-->
					<!--for gyanodya grade chart start-->
					<?php }else if($school == 14 && $row2=="C"){ ?>
					<tr>
                        <td>91-100</td>
                        <td>A1</td>
						<td>10.0</td>
                    </tr>
                    <tr>
                        <td>81-90</td>
                        <td>A2</td>
						<td>9.0</td>
                    </tr>
                    <tr>
                        <td>71-80</td>
                        <td>B1</td>
						<td>8.0</td>
                    </tr>
                    <tr>
                        <td>61-70</td>
                        <td>B2</td>
						<td>7.0</td>
                    </tr>
                    <tr>
                        <td>51-60</td>
                        <td>C1</td>
						<td>6.0</td>
                    </tr>
                     <tr>
                        <td>41-50</td>
                        <td>C2</td>
						<td>5.0</td>
                    </tr>
                     <tr>
                        <td>33-40</td>
                        <td>D</td>
						<td>4.0</td>
                    </tr>
                     <tr>
                        <td>21-32</td>
                        <td>E1</td>
						<td>3.0</td>
                    </tr>
					<tr>
                        <td>0-20</td>
                        <td>E2</td>
						<td>2.0</td>
                    </tr>
					<!--for gyanodya grade chart end-->
					<!--for sarvodya grade chart start-->
					<?php }else if($school == 10 && $row2=="D"){ ?>
					 <tr>
                        <td>91-100</td>
                        <td>A1</td>
						<!--<td>Outstanding</td>-->
                    </tr>
                    <tr>
                        <td>81-90</td>
                        <td>A2</td>
						<!--<td>Excellent</td>-->
                    </tr>
                    <tr>
                        <td>71-80</td>
                        <td>B1</td>
						<!--<td>Very Good</td>-->
                    </tr>
                    <tr>
                        <td>61-70</td>
                        <td>B2</td>
						<!--<td>Good</td>-->
                    </tr>
                    <tr>
                        <td>51-60</td>
                        <td>C1</td>
						<!--<td>Average</td>-->
                    </tr>
                     <tr>
                        <td>41-50</td>
                        <td>C2</td>
						<!--<td>Fair</td>-->
                    </tr>
                     <tr>
                        <td>33-40</td>
                        <td>D1</td>
						<!--<td>Marginal</td>-->
                    </tr>
                     <tr>
                        <td>32 & Below</td>
                        <td>D2</td>
						<!--<td>Poor</td>-->
                    </tr>
					<!--for sarvodya grade chart end-->
                    <?php }else{ ?>
					<!--for bsd,spring grade chart start-->
                    <tr>
                        <td>91-100</td>
                        <td>A1</td>
						<!--<td>Outstanding</td>-->
                    </tr>
                    <tr>
                        <td>81-90</td>
                        <td>A2</td>
						<!--<td>Excellent</td>-->
                    </tr>
                    <tr>
                        <td>71-80</td>
                        <td>B1</td>
						<!--<td>Very Good</td>-->
                    </tr>
                    <tr>
                        <td>61-70</td>
                        <td>B2</td>
						<!--<td>Good</td>-->
                    </tr>
                    <tr>
                        <td>51-60</td>
                        <td>C1</td>
						<!--<td>Average</td>-->
                    </tr>
                     <tr>
                        <td>41-50</td>
                        <td>C2</td>
						<!--<td>Fair</td>-->
                    </tr>
                     <tr>
                        <td>33-40</td>
                        <td>D1</td>
						<!--<td>Marginal</td>-->
                    </tr>
                     <tr>
                        <td>32 & Below</td>
                        <td>D2</td>
						<!--<td>Poor</td>-->
                    </tr>
					<!--for bsd,spring grade chart end-->
                    <?php } ?>
					</tbody>
                </table> <?php } ?>
				<?php 
				function calculateGrade($val,$classid){
								if($val >= 91 && $val < 101):
									return 'A1';
								elseif($val >= 81 && $val < 91):
									return 'A2';
								elseif($val >= 71 && $val < 81):
									return 'B1';
								elseif($val >= 61 && $val < 71):
									return 'B2';
								elseif($val >= 51 && $val < 61):
									return 'C1';
								elseif($val >= 41 && $val < 51):
									return 'C2';
								elseif($val >= 33 && $val < 41):
									return 'D';
								elseif($val >= 0 && $val < 33):
			                	    return 'E';
			                    else:
				                    return ' ';
								endif;
								
							}
							function calculateGrade_sarvodya($val,$classid){
								if($val >= 91 && $val < 101):
									return 'A1';
								elseif($val >= 81 && $val < 91):
									return 'A2';
								elseif($val >= 71 && $val < 81):
									return 'B1';
								elseif($val >= 61 && $val < 71):
									return 'B2';
								elseif($val >= 51 && $val < 61):
									return 'C1';
								elseif($val >= 41 && $val < 51):
									return 'C2';
								elseif($val >= 33 && $val < 41):
									return 'D1';
								else:
									return 'D2';
								endif;
								
							}
							function calculateGrade_gyan($val,$classid){
								if($val >= 91 && $val < 101):
									return 'A1';
								elseif($val >= 81 && $val < 91):
									return 'A2';
								elseif($val >= 71 && $val < 81):
									return 'B1';
								elseif($val >= 61 && $val < 71):
									return 'B2';
								elseif($val >= 51 && $val < 61):
									return 'C1';
								elseif($val >= 41 && $val < 51):
									return 'C2';
								elseif($val >= 33 && $val < 41):
									return 'D';
								elseif($val >= 21 && $val < 33):
									return 'E1';
								else:
									return 'E2';
								endif;
								
							}
							//for scholar & mkd remarks
							
							function remarks($val,$classid){
								if($val >= 91 && $val < 101):
									return 'Excellent';
								elseif($val >= 81 && $val < 91):
									return 'Very Good';
								elseif($val >= 71 && $val < 81):
									return 'Good';
								elseif($val >= 61 && $val < 71):
									return 'Fair';
								elseif($val >= 51 && $val < 61):
									return 'Work Hard';
								else:
									return 'Need Special Care/Attention';
								endif;
							}
							//for sarvodya remarks
							function remarks1($val,$classid){
								if($val >= 91 && $val < 101):
									return 'Outstanding';
								elseif($val >= 81 && $val < 91):
									return 'Excellent';
								elseif($val >= 71 && $val < 81):
									return 'Very Good';
								elseif($val >= 61 && $val < 71):
									return 'Good';
								elseif($val >= 51 && $val < 61):
									return 'Average';
								elseif($val >= 41 && $val < 51):
									return 'Fair';
								elseif($val >= 33 && $val < 41):
									return 'Marginal';
								else:
									return 'Poor';
								endif;
							}
							
							//for scholar ,gyanodya ,sarvodya ,bsd ,spring & mkd co_scolastic remarks  
							function co_scolastic($val,$classid){
								if($val > 80):
									return 'A';
								elseif($val >= 61  && $val < 81 ):
									return 'A';
								else:
									return 'B';
								endif;
							}
							?>
            </div>
            <br>
            <div  style="">
		<!--	<div  style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Congratulations! Promoted to Next Class </div>-->
			</div>
			<br>
            <div>
                <table style="width:95%;font-size: 14px;">
					<tr style="height: 100px;">
						<td>Date :</td>
						<td><label><b>Class Teacher Signature:</b></label></td>
                        <td><label><b>Principal Signature:</b> </label>
                            <div>
                                <img src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/images/empImage/<?php echo $info->principle_sign;?>" alt="" width="100" height="90" style="margin-top=-60px;" />
    		                </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div></div>
    </div>
    </div>
	<div class="invoice-buttons" style="text-align:center;">
    <button class="button button2" type="button" onclick="window.print();">
        <i class="fa fa-print padding-right-sm"></i> Print
    </button>
	</div>
</body>
</html>