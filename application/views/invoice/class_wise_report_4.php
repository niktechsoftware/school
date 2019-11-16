<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

    <title>Classwise Report</title>

    <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/style.css' />
    <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/print.css'
        media="print" />
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/jquery-1.3.2.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/example.js'></script>
    <style type="text/css">
    @media print {
         
         #pagebreak { page-break-after: always; }
        body * {
            visibility: hidden;
        }

        #printcontent * {
            visibility: visible;
        }

        #printcontent {
            position: absolute;
           /* top: 40px;*/
            left: 30px;
        }
        /*#page-wrap {page-break-after: always;}*/
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
                            $this->db->where('status',1);
                            $this->db->where('class_id',$classid);
                            $sid=$this->db->get('student_info');
                	        foreach($sid->result() as $studentProfile){
                            $studentInfo = $studentProfile;
                            $this->db->where('student_id',$studentInfo->id);
                            $guardian_info=$this->db->get('guardian_info');
                            $parentInfo = $guardian_info->row();?>
 <p style="page-break-after: always;">&nbsp;
                    <div id="pagebreak " style="margin-top: 0px;height: 1250px;width:960px; border:1px solid #333;" >

            <div style="width:100%; height:1250px;margin-left:auto; margin-right:auto; border:1px  solid blue; background-color:#e30e0e;">

                <div style="width:95%; margin-left:auto; margin-right:auto; border:1px  solid yellow; height:auto;">
                    <?php
						$school_code = $this->session->userdata("school_code");
						$this->db->where("id",$school_code);
						$info =$this->db->get("school")->row();
					?>
                    <table style="width: 100%;">
                        <tr>
                           <td  style="border: none;">
                                <img src="<?php echo $this->config->item('asset_url'); ?><?php echo $school_code;?>/images/empImage/<?php echo $info->logo;?>"
                                    alt="" style="height: 100px;width: 100px;" />
                                </br><h3 style="color:white">Aff.No. - <?php echo $info->registration_no;?></h3>
                            </td>
                            <td colspan="2" style="border: none;" >
                                <h1 style="color:white;font-size: 35px;">
                                    <?php echo $info->school_name;?></h1>
                                <h2 style="color:white;">
                                   	<?php if($info->address1){echo $info->address1; }else{echo $info->address2; }echo ",".$info->city; ?>
                                </h2>
                                <h2 style="color:white;">
                                <?php echo $info->state." - ".$info->pin.", Contact No. : " ;
									if(strlen($info->mobile_no > 0 )){echo $info->mobile_no ;}
									if(strlen($info->other_mobile_no > 0 )){echo ", ".$info->other_mobile_no ;}
									?>
									
                                </h2>
                            </td>
							<!--<div class="row">
							<div class="col-md-2"><img src="<?php echo $this->config->item('asset_url'); ?><?php echo $school_code;?>/images/empImage/<?php echo $info->logo;?>"
                                    alt="" width="120" /></div>
							<div class="col-md-10"><h1 style="color:white;text-align: center;font-size: 30px;">
                                    <?php echo $info->school_name;?></h1>
                                <h2 style="color:white;text-align: center;">
                                   	<?php if($info->address1){echo $info->address1; }else{echo $info->address2; }echo ",".$info->city; ?>
                                </h2>
                                <h2 style="color:white;text-align: center;">
                                <?php echo $info->state." - ".$info->pin.", Contact No. : " ;
									if(strlen($info->mobile_no > 0 )){echo $info->mobile_no.", ".$info->mobile_no ;} ?>
                                </h2></div>
							</div>-->
						</tr>
						 <tr class="wight" style="color: white;font-size: 13px;">
							<td >
								<span style="text-transform: uppercase;">Scholar ID: <?php echo $studentInfo->username; ?></span><br>
								<span style="text-transform: uppercase;">Scholar Name: <?php echo strtoupper($studentInfo->name);?> </span><br>
							   <?php
										   $this->db->where('school_code',$school_code);
										   $this->db->where('id',$classid);
										   $classname=$this->db->get('class_info');
										  
											?>
								  <?php if($classname->num_rows()>0){
								  $classdf=$classname->row();
								  $this->db->where("id",$classdf->section);
								  $secname = $this->db->get("class_section")->row()->section;
								  ?>
								<span style="text-transform: uppercase;">Class: <?php  echo $classdf->class_name."-".$secname; ?></span>
								 <?php } else { echo "something wrong please try again";  }?>
							
							</td>
							<td >
								 <span style="text-transform: uppercase;">Mother's Name: <?= strtoupper($parentInfo->mother_full_name); ?></span><br>
								<span style="text-transform: uppercase;">Father's Name: <?= strtoupper($parentInfo->father_full_name); ?></span><br>
							</td>
							<td class="">
								<img src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/images/stuImage/<?php echo $studentInfo->photo; ?>"  alt="" width="90" height="105" />
							</td>
						</tr>
						<tr>
						
							<td style="border: none;" colspan="3">
								<center><h2 style="border: 2px solid #000; padding: 5px; width: 200px; color:white;">
									Progress Report (2019-20) <br>
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
            						
            <br><!---------------------------------------------------->
<?php 
$school=$this->session->userdata('school_code');
			$row2=$this->db->get('db_name')->row()->name;
if($classid == 142 && $row2=="A" || $classid == 143 && $row2=="A" || $classid == 147 && $row2=="A" || $classid == 148 && $row2=="A" || $classid == 293 && $row2=="A"){
               ?>
			   <!--for 9th 10th marks-->
                <div>
                <table
                    style="width:95%;text-transform: uppercase; margin-left:auto; margin-right:auto; border:1px solid black; background-color:white;">
                    <tr>
                        <th colspan="1" rowspan="2">SCHOLASTIC AREA </th>
						<th colspan="4" rowspan="2">Periodic Test</th>
						<th rowspan="3">NoteBook(5) &
                                Sub. Enrichment(5)<br>
                                <span>(B=10)</span></th>
                       <th rowspan="3" colspan="1">total</th>

                    </tr>

                    <tr>
                       <!-- <th colspan="3">Term 1 (50)+ Term 2(50)</th>-->
                    </tr>

                    <tr>

                        <th colspan="1" rowspan="1" style="text-transform: uppercase;">Subjects</th>
                        <!--1st term -->
						<?php 
							$i=1;
							 foreach ($examid as $value):
							   $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							    $this->db->where('term',1);
							   $examname=$this->db->get('exam_name');   
							   if ($examname->num_rows()>0){
							   $examname=$examname->row();
						?> 
						<td colspan="1" style="text-transform: uppercase;"><?php echo $examname->exam_name;?></td>
                        <?php 
						}
						$i++;
						endforeach ;
						if(!$i%2==0){ ?>
						<td class="center bold" style="text-transform: uppercase;">Total</td> 
						<?php } ?>
						<!--2nd term-->
						<?php 
							$i=1;
							 foreach ($examid as $value):
							   $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							   $this->db->where('term',2);
							   $examname=$this->db->get('exam_name');   
							   if ($examname->num_rows()>0){
							   $examname=$examname->row();
						?> 
						<td colspan="1" ><?php echo $examname->exam_name;?></td>
                        <?php 
						}
						$i++;
						endforeach ;
						if(!$i%2==0){ ?>
						<!--<td class="center bold" style="text-transform: uppercase;">Total</td> -->
						<?php } ?>
                       <!--<th style="text-transform: uppercase;">Grand<br> Total</th>
                        <th rowspan="1" style="text-transform: uppercase;">Grade</th>
                        <th rowspan="1" style="text-transform: uppercase;">Rank</th>-->
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
           $pi=1;
		   $grandtotal=0;
foreach($resultData as $sub){
$this->db->where('stu_id',$studentInfo->id);
$this->db->where('class_id',$classid);
$this->db->where('subject_id',$sub['subject']);
//$this->db->where('exam_id',$value->exam_id);
$this->db->where('fsd',$fsd);
$subjectname=$this->db->get('exam_info');
/*$this->db->where('class_id',$classid);
$this->db->where('id',$sub['subject']);
$subjectname=$this->db->get('subject');*/ 
if($subjectname->num_rows()>0){
    $subjectname=$subjectname->row();
	?><?php $totalp+=200;?>
                   <tr class="wight"> 
					 <td class="subject">	
                     <?php 
								$this->db->where('id',$subjectname->subject_id);
			echo $subjectname1= $this->db->get('subject')->row()->subject;
					 ?> 
					</td>
			     <?php 
 				$ttal=0;
                 $gtptal=0;
                 //$subtatal=0;
					$i=1; $t=0; 
					//$coltptal=0; 
					foreach ($examid as $value):?>
					<td class="center">	
					<?php 
        					$this->db->where('subject_id',$sub['subject']);
        					$this->db->where('class_id',$classid);
        					$this->db->where('stu_id',$studentInfo->id);
        					$this->db->where('exam_id',$value->exam_id);
        					$this->db->where('fsd',$fsd);
        			$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();
					////////////////////////	
					if(is_numeric($marks->marks)){
					  $gtptal= $gtptal+$marks->marks;
					}else{ $gtptal= $gtptal;}
					////////////////////////


							//$gtptal= $gtptal+$marks->marks;
							echo $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
        					$this->db->where('class_id',$classid);
        					$this->db->where('exam_id',$value->exam_id);
			    $exammm_row=$this->db->get('exam_max_subject')->row();
				    $exammm=$exammm_row->max_m;
		                //$ttal=$ttal+$exammm;
				        //$dhtm=$exammm+$dhtm;
				        
				        
			//////////////////////
			if(is_numeric($exammm)){
					  $ttal=$ttal+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal= $ttal;
					 $dhtm= $dhtm;   
					}
			///////////////////////
						}else if($marks->num_rows()==0){ $exammm=" "; }
					?><?php echo "/" .$exammm; ?>
					</td> 
				<?php $i++; $t++;endforeach; ?>
				<td class="center bold"><?php  $grandtotal=$grandtotal+$gtptal; echo $gtptal;  ?>/<?php print_r($ttal);?>
			   <?php ?></td>
			   
			   <!--toatl marks of all pt and note &sea-->
			   <td></td>
			   <!--annual exam marks-->
			   <td></td>
				<!--<td class="center bold"><?php   echo $gtptal;  ?></td>
				<td class="center bold"><?php  echo $gtptal;  ?></td>-->
			  <!-- <td class="center bold"></td>-->
			  <!-- <td class="center bold"></td>-->
				</tr>
                    <?php 
    
}
					}?>
					
					
                </table>
            </div>
			<!--for 9th 10th formate of ramdoot end-->
               <?php     }else if($classid == 216  && $row2=="A" || $classid == 217 && $row2=="A"  || $classid == 150 && $row2=="A"  || $classid == 153 && $row2=="A" || $classid == 149 && $row2=="A"  || $classid == 152 && $row2=="A"  ){ ?>
		   <!--for 12th 11th formate of ramdoot-->
               <div>
                <table
                    style="width:95%;text-transform: uppercase; margin-left:auto; margin-right:auto; border:1px solid black; background-color:white;">
                    <tr>
                         <th colspan="1" rowspan="2">SCHOLASTIC AREA </th>
                        <th colspan="3" rowspan="2">TERM 1 (100 MARKS) </th>
                        <th colspan="3" rowspan="2">Term 2 (100 Marks) </th>
                       <!-- <th colspan="3">OVERALL</th>-->

                    </tr>

                    <tr>
                       <!-- <th colspan="3">Term 1 (50)+ Term 2(50)</th>-->
                    </tr>

                    <tr>

                        <th colspan="1" rowspan="1" style="text-transform: uppercase;">Subjects</th>
                        <!--1st term -->
						<?php 
							$i=1;
							 foreach ($examid as $value):
							   $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							    $this->db->where('term',1);
							   $examname=$this->db->get('exam_name');   
							   if ($examname->num_rows()>0){
							   $examname=$examname->row();
						?> 
						<td colspan="1" style="text-transform: uppercase;"><?php echo $examname->exam_name;?></td>
                        <?php 
						}
						$i++;
						endforeach ;
						if(!$i%2==0){ ?>
						<!--<td class="center bold" style="text-transform: uppercase;">Total</td> -->
						<?php } ?>
						<!--2nd term-->
						<?php 
							$i=1;
							 foreach ($examid_2 as $value):
							   $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							   $this->db->where('term',2);
							   $examname=$this->db->get('exam_name');   
							   if ($examname->num_rows()>0){
							   $examname=$examname->row();
						?> 
						<td colspan="1" ><?php echo $examname->exam_name;?></td>
                        <?php 
						}
						$i++;
						endforeach ;
						if(!$i%2==0){ ?>
						<!--<td class="center bold" style="text-transform: uppercase;">Total</td> -->
						<?php } ?>
                       <!--<th style="text-transform: uppercase;">Grand<br> Total</th>
                        <th rowspan="1" style="text-transform: uppercase;">Grade</th>
                        <th rowspan="1" style="text-transform: uppercase;">Rank</th>-->
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
           $pi=1;
		   $grandtotal=0; 
foreach($resultData as $sub){ 
$this->db->where('stu_id',$studentInfo->id);
$this->db->where('class_id',$classid);
$this->db->where('subject_id',$sub['subject']);
//$this->db->where('exam_id',$value->exam_id);
$this->db->where('fsd',$fsd);
$subjectname=$this->db->get('exam_info');
/*$this->db->where('class_id',$classid);
$this->db->where('id',$sub['subject']);
$subjectname=$this->db->get('subject');*/ 
if($subjectname->num_rows()>0){
    $subjectname=$subjectname->row();
	?><?php $totalp+=200;?>
                   <tr class="wight"> 
					 <td class="subject">	
                     <?php 
								$this->db->where('id',$subjectname->subject_id);
			echo $subjectname1= $this->db->get('subject')->row()->subject;
					 ?> 
					</td>
			     <?php 
 				$ttal=0;
                 $gtptal=0;
					$i=1; $t=0;
					foreach ($examid as $value):?>
					<td class="center">	
					<?php $this->db->where("term", 1);
        					$this->db->where('subject_id',$sub['subject']);
        					$this->db->where('class_id',$classid);
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
        					$this->db->where('class_id',$classid);
        					$this->db->where('exam_id',$value->exam_id);
			    $exammm_row=$this->db->get('exam_max_subject')->row();
				    $exammm=$exammm_row->max_m;
			if(is_numeric($exammm)){
					  $ttal=$ttal+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal= $ttal;
					 $dhtm= $dhtm;   
					}
						}else if($marks->num_rows()==0){ $exammm=" "; }
					?><?php echo "/" .$exammm; ?>
					</td> 
				<?php $i++; $t++;endforeach; ?>
				<!--<td class="center bold"><?php  $grandtotal=$grandtotal+$gtptal; echo $gtptal;  ?>/<?php print_r($ttal);?>
			   <?php ?></td>-->
			   
			   
			   <!--for 2nd term marks start-->
			   <?php 
                $ttal=0;
                 $gtptal=0;
                    $i=1; $t=0; 
                    foreach ($examid_2 as $value):?>
                    <td class="center"> 
                    <?php
								$this->db->where("term", 2);
								$this->db->where('subject_id',$sub['subject']);
								$this->db->where('class_id',$classid);
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
							$this->db->where('class_id',$classid);
							$this->db->where('exam_id',$value->exam_id);
            $exammm_row=    $this->db->get('exam_max_subject')->row();
                $exammm=    $exammm_row->max_m;
            if(is_numeric($exammm)){
                      $ttal=$ttal+$exammm;
                    $dhtm=$exammm+$dhtm;
                    }else{ $ttal= $ttal;
                     $dhtm= $dhtm;   
                    }
                        }else if($marks->num_rows()==0){ $exammm=" "; }?><?php echo "/" .$exammm; ?>
                    </td> 
                <?php $i++; $t++;endforeach; ?>
               <!-- <td class="center bold"><?php  $grandtotal=$grandtotal+$gtptal; echo $gtptal;  ?>/<?php print_r($ttal);?>
               <?php ?></td>-->
			   <!--for 2nd term marks end-->
			   
				<!--<td class="center bold"><?php   echo $gtptal;  ?></td>
				<td class="center bold"><?php  echo $gtptal;  ?></td>-->
			  <!-- <td class="center bold"></td>-->
			  <!-- <td class="center bold"></td>-->
				</tr>
                    <?php 
					}
					}?>
					
					
                </table>
            </div>
			<!--for 12th 11th formate of ramdoot end-->
			   <?php }else if($classid == 131 && $row2=="A" || $classid == 132 && $row2=="A" || $classid == 133 && $row2=="A"){  ?>
		   <!--for lkg ukg pg of ramdoot-->
			    <div>
                <table
                    style="width:95%;text-transform: uppercase; margin-left:auto; margin-right:auto; border:1px solid black; background-color:white;">
                    <tr>
                        <th colspan="1" rowspan="2">SCHOLASTIC AREA </th>
						<th colspan="5" rowspan="2">TERM 1 (100 MARKS) </th>
						<!--<th colspan="5" rowspan="2">Term 2 (100 Marks) </th>-->
                       <!-- <th colspan="3">OVERALL</th>-->
                    </tr>
                    <tr>
                       <!-- <th colspan="3">Term 1 (50)+ Term 2(50)</th>-->
                    </tr>
                    <tr>
                        <th colspan="1" rowspan="1" style="text-transform: uppercase;">Subjects</th>
                        <!--1st term -->
						<?php 
							$i=1;
							 foreach ($examid as $value):
							   $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							    $this->db->where('term',1);
							   $examname=$this->db->get('exam_name');   
							   if ($examname->num_rows()>0){
							   $examname=$examname->row();
						?> 
						<td colspan="1" style="text-transform: uppercase;"><?php echo $examname->exam_name;?></td>
                        <?php 
						}
						$i++;
						endforeach ;
						if(!$i%2==0){ ?>
						<td class="center bold" style="text-transform: uppercase;">Grade</td> 
						<?php } ?>
						<!--2nd term-->
						<?php 
							$i=1;
							 foreach ($examid as $value):
							   $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							   $this->db->where('term',2);
							   $examname=$this->db->get('exam_name');   
							   if ($examname->num_rows()>0){
							   $examname=$examname->row();
						?> 
						<td colspan="1" ><?php echo $examname->exam_name;?></td>
                        <?php 
						}
						$i++;
						endforeach ;
						if(!$i%2==0){ ?>
						<!--<td class="center bold" style="text-transform: uppercase;">Total</td> -->
						<?php } ?>
                       <!--<th style="text-transform: uppercase;">Grand<br> Total</th>
                        <th rowspan="1" style="text-transform: uppercase;">Grade</th>
                        <th rowspan="1" style="text-transform: uppercase;">Rank</th>-->
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
					   $pi=1;
					   $grandtotal=0;
foreach($resultData as $sub){
$this->db->where('stu_id',$studentInfo->id);
$this->db->where('class_id',$classid);
$this->db->where('subject_id',$sub['subject']);
//$this->db->where('exam_id',$value->exam_id);
$this->db->where('fsd',$fsd);
$subjectname=$this->db->get('exam_info');
/*$this->db->where('class_id',$classid);
$this->db->where('id',$sub['subject']);
$subjectname=$this->db->get('subject');*/ 
if($subjectname->num_rows()>0){
    $subjectname=$subjectname->row();
	?><?php $totalp+=200;?>
                   <tr class="wight"> 
					 <td class="subject">	
                     <?php 
								$this->db->where('id',$subjectname->subject_id);
			echo $subjectname1= $this->db->get('subject')->row()->subject;
					 ?>
					</td>
			     <?php 
					$ttal=0;
					$gtptal=0;
					$i=1; $t=0; 
					foreach ($examid as $value):?>
					<td class="center">	
					<?php 
        					$this->db->where('subject_id',$sub['subject']);
        					$this->db->where('class_id',$classid);
        					$this->db->where('stu_id',$studentInfo->id);
        					$this->db->where('exam_id',$value->exam_id);
        					$this->db->where('fsd',$fsd);
        			$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();	
					if(is_numeric($marks->marks)){
					  $gtptal= $gtptal+$marks->marks;
					}else{ 
					 $grade= $marks->marks;
					if($grade == "A1"){   $gtptal=$gtptal+100;}else if($grade == "A2"){  $gtptal=$gtptal+90;}else if($grade == "B1"){
						  $gtptal=$gtptal+80;}else if($grade == "B2"){  $gtptal=$gtptal+70;}else if($grade == "C1"){ $gtptal=$gtptal+60;
						}else if($grade == "C2"){ $gtptal=$gtptal+50;}else if($grade == "D"){ $gtptal=$gtptal+40;}else{$gtptal=$gtptal+32;}
					}
							echo $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
        					$this->db->where('class_id',$classid);
        					$this->db->where('exam_id',$value->exam_id);
			    $exammm_row=$this->db->get('exam_max_subject')->row();
				    $exammm=$exammm_row->max_m;
				
			if(is_numeric($exammm)){
					  $ttal=$ttal+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal= $ttal+100;
					 $dhtm= $dhtm;   
					}
						}else if($marks->num_rows()==0){ $exammm=" "; }
					?><?php echo "/" .$exammm;					?>
					</td> 
				<?php $i++; $t++;endforeach; ?>
				<td class="center bold">
				<?php 
                            $grandtotal=$grandtotal+$gtptal;
                            $dhtm=$dhtm+$ttal;
                            if($ttal>0){ 
                                $per=round((($gtptal*100)/$ttal), 2);
                            /* if($per <= 100 || $per >= 91){  echo $m="A1";}else if($per <= 90 || $per >= 81){ echo $m="A2";}else if($per <= 80 || $per >= 71){
						    echo $m="B1";}else if($per <= 70 || $per >= 61){echo $m="B2";}else if($per <= 60 || $per >= 51){ echo $m="C1";
						    }else if($per <= 50 || $per >= 41){ echo $m="C2";}else if($per <= 40 || $per >= 33){ echo $m="D";}else{echo $m="E";}  */ 
                               if($dhtm>0){echo $gradecal =calculateGrade($per,$classid);}         
                                        } ?> 
                
                </td>
				<!--<td class="center bold"><?php   echo $gtptal;  ?></td>
				<td class="center bold"><?php  echo $gtptal;  ?></td>-->
			  <!-- <td class="center bold"></td>-->
			  <!-- <td class="center bold"></td>-->
				</tr>
                    <?php }
					}?>
					
					
                </table>
            </div>
			<!---lkg, ukg, pg formate of ramdoot end--->
			   <?php }else{ ?>
		   <!---other formate start--->
               <div>
                <table
                    style="width:95%;text-transform: uppercase; margin-left:auto; margin-right:auto; border:1px solid black; background-color:white;">
                    <tr>
                        <th colspan="1" rowspan="2">SCHOLASTIC AREA </th>
						<th colspan="5" rowspan="2">TERM 1 (100 MARKS) </th>
						<!--<th colspan="5" rowspan="2">Term 2 (100 Marks) </th>-->
                       <!-- <th colspan="3">OVERALL</th>-->

                    </tr>

                    <tr>
                       <!-- <th colspan="3">Term 1 (50)+ Term 2(50)</th>-->
                    </tr>

                    <tr>

                        <th colspan="1" rowspan="1" style="text-transform: uppercase;">Subjects</th>
                        <!--1st term -->
						<?php 
							$i=1;
							 foreach ($examid as $value):
							   $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							    $this->db->where('term',1);
							   $examname=$this->db->get('exam_name');   
							   if ($examname->num_rows()>0){
							   $examname=$examname->row();
						?> 
						<td colspan="1" style="text-transform: uppercase;"><?php echo $examname->exam_name;?></td>
                        <?php 
						}
						$i++;
						endforeach ;
						if(!$i%2==0){ ?>
						<td class="center bold" style="text-transform: uppercase;">Total</td> 
						<?php } ?>
						<!--2nd term-->
						<?php 
							$i=1;
							 foreach ($examid as $value):
							   $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							   $this->db->where('term',2);
							   $examname=$this->db->get('exam_name');   
							   if ($examname->num_rows()>0){
							   $examname=$examname->row();
						?> 
						<td colspan="1" ><?php echo $examname->exam_name;?></td>
                        <?php 
						}
						$i++;
						endforeach ;
						if(!$i%2==0){ ?>
						<!--<td class="center bold" style="text-transform: uppercase;">Total</td> -->
						<?php } ?>
                       <!--<th style="text-transform: uppercase;">Grand<br> Total</th>
                        <th rowspan="1" style="text-transform: uppercase;">Grade</th>
                        <th rowspan="1" style="text-transform: uppercase;">Rank</th>-->
                    </tr>


                    <!-- Dynamic -->
					
                   <!-- <tr>
                        <th>10</th>
                        <th>5</th>
                        <th>5</th>
                        <th>80</th>
                        <th>100</th>

                      <th>10</th>
                        <th>5</th>
                        <th>5</th>
                        <th>80</th>
                        <th>100</th>

                        <th>100</th>
                    </tr>-->

                    <!--Dynamic Subject-->

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
           $pi=1;
		   $grandtotal=0;
foreach($resultData as $sub){
$this->db->where('stu_id',$studentInfo->id);
$this->db->where('class_id',$classid);
$this->db->where('subject_id',$sub['subject']);
//$this->db->where('exam_id',$value->exam_id);
$this->db->where('fsd',$fsd);
$subjectname=$this->db->get('exam_info');
/*$this->db->where('class_id',$classid);
$this->db->where('id',$sub['subject']);
$subjectname=$this->db->get('subject');*/ 
if($subjectname->num_rows()>0){
    $subjectname=$subjectname->row();
	?><?php $totalp+=200;?>
                   <tr class="wight"> 
					 <td class="subject">	
                     <?php 
								$this->db->where('id',$subjectname->subject_id);
			echo $subjectname1= $this->db->get('subject')->row()->subject;
					 ?> 
					</td>
			     <?php 
 				$ttal=0;
                 $gtptal=0;
                 //$subtatal=0;
					$i=1; $t=0; 
					//$coltptal=0; 
					foreach ($examid as $value):?>
					<td class="center">	
					<?php 
        					$this->db->where('subject_id',$sub['subject']);
        					$this->db->where('class_id',$classid);
        					$this->db->where('stu_id',$studentInfo->id);
        					$this->db->where('exam_id',$value->exam_id);
        					$this->db->where('fsd',$fsd);
        			$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();
					////////////////////////	
					if(is_numeric($marks->marks)){
					  $gtptal= $gtptal+$marks->marks;
					}else{ $gtptal= $gtptal;}
					////////////////////////


							//$gtptal= $gtptal+$marks->marks;
							echo $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
        					$this->db->where('class_id',$classid);
        					$this->db->where('exam_id',$value->exam_id);
			    $exammm_row=$this->db->get('exam_max_subject')->row();
				    $exammm=$exammm_row->max_m;
		                //$ttal=$ttal+$exammm;
				        //$dhtm=$exammm+$dhtm;
				        
				        
			//////////////////////
			if(is_numeric($exammm)){
					  $ttal=$ttal+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal= $ttal;
					 $dhtm= $dhtm;   
					}
			///////////////////////
						}else if($marks->num_rows()==0){ $exammm=" "; }
					?><?php echo "/" .$exammm; ?>
					</td> 
				<?php $i++; $t++;endforeach; ?>
				<td class="center bold"><?php  $grandtotal=$grandtotal+$gtptal; echo $gtptal;  ?>/<?php print_r($ttal);?>
			   <?php ?></td>
			   
			   
				<!--<td class="center bold"><?php   echo $gtptal;  ?></td>
				<td class="center bold"><?php  echo $gtptal;  ?></td>-->
			  <!-- <td class="center bold"></td>-->
			  <!-- <td class="center bold"></td>-->
				</tr>
                    <?php }
					}?>
					
					
                </table>
            </div>
               <?php }?>
            
<!---------------------------------------------------->
            <br>
            <div>
               <!-- <table
                    style="width:95%; margin-left:auto; margin-right:auto; border:1px solid black; background-color:white;">

                    <tr>
                        <td colspan="2"> CO - SCHOLASTIC Area </td>
                        <td colspan="2">CO - SCHOLASTIC Area</td>
                    </tr>

                    <tr>
                        <td>Work Education</td>
                        <td>A</td>
                        <td>Health</td>
                        <td>A</td>
                    </tr>

                    <tr>
                        <td>Art Education</td>
                        <td>A</td>
                        <td>Discipline</td>
                        <td>A</td>
                    </tr>

                </table>-->
            </div>

            
            <br>
            <div>
                <table
                    style="width:95%; margin-left:auto; margin-right:auto; border:1px solid black; background-color:white;">
<?php if($classid == 131 && $row2=="A" || $classid == 132 && $row2=="A" || $classid == 133 && $row2=="A"){ ?>
					<tr> 
					    <!--<td>Total Marks : <?php echo $grandtotal; ?>/<?php echo $dhtm;?> </td>-->
                        <td>Percentage: <?php if($dhtm>0){echo $per=round((($grandtotal*100)/$dhtm), 2);} ?>%</td>
                        <td>Grade: <label style="text-transform: uppercase;"><?php if($dhtm>0){echo $gradecal =calculateGrade($per,$classid);}?></label>
                        </td>
                        <td>Rank</td>
                    </tr>
<?php }else{ ?>
                    <tr>
					
                        <td>
                            Total Marks : <?php echo $grandtotal; ?>/<?php echo $dhtm;?>
                           
                        </td>
                        <td>
                            Percentage: <?php if($dhtm>0){echo $per=round((($grandtotal*100)/$dhtm), 2);}
                            ?>% 
                        </td>
                        <td >
                             Grade: <label style="text-transform: uppercase;"><?php if($dhtm>0){echo $gradecal =calculateGrade($per,$classid);}?></label>
                        </td>
                        <td>
                            Rank
                        </td>
                    </tr>
<?php }?>
                </table>
            </div>

            <br>

            <div style=" width:95%; margin-left:auto; margin-right:auto;">
                <div style="width:50%; float:left;">

                    <table style="width:90%; border:1px solid black; background-color:white;">
                        <tr>
                            <th colspan="3" style="text-transform: uppercase;">Co- SCHOLASTIC Area</th>
                        </tr>

                        <tr>
                            <th style="text-transform: uppercase;"> Activity </th>
                            <th>T1</th>
                            
                        </tr>

                        <!-- Dynamic -->
                        <tr>
                            <td >Work Education</td>
                            <td>A</td>
                            
                        </tr>
                        <tr>
                            <td>Art Education</td>
                            <td>B</td>
                           
                        </tr>
                        <tr>
                            <td>Health & Physical Education</td>
                            <td>A</td>
                           
                        </tr>
                        <tr>
                            <td>Scientific Skills</td>
                            <td>A</td>
                            
                        </tr>
                        <tr>
                            <td>Thinking Skills</td>
                            <td>A</td>
                           
                        </tr>
                        <tr>
                            <td>Social Skills</td>
                            <td>A</td>
                           
                        </tr>
                        <tr>
                            <td>Yoga/NCC</td>
                            <td>A</td>
                            
                        </tr>
                        <tr>
                            <td>Sports</td>
                            <td>A</td>
                           
                        </tr>
                    </table>
                    <table style="width:70%; border:1px solid black; background-color:white;">
                        <tr>
                            <?php
                            $this->db->where("class_id",$classid);
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
                            <td>Attendance:&nbsp;&nbsp;&nbsp;&nbsp;<label><?php echo $present; ?>/<?php echo $atotal; ?></label></td>
                        </tr>
                    </table>


                </div>



                <div style="width:50%; float:right;">

                    <table style="width:90%; border:1px solid black; background-color:white;">

                        <tr>
                            <th colspan="3" style="text-transform: uppercase;"> Discipline</th>
                        </tr>
                        <tr>
                            <th style="text-transform: uppercase;"> Element </th>
                            <th>T1</th>
                           
                        </tr>

                        
                        <!-- Dynamic -->
                        <tr>
                            <td>Regularity & Punctuality</td>
                            <td>B</td>
                           

                        </tr>
                        <tr>
                            <td>Sincerity</td>
                            <td>A</td>
                            

                        </tr>
                        <tr>
                            <td>Behaviour & Values</td>
                            <td>A</td>
                           

                        </tr>
                        <tr>
                            <td>Respectful For Rules & Regulations</td>
                            <td>A</td>
                            

                        </tr>
                        <tr>
                            <td>Attitude Towards Teachers</td>
                            <td>A</td>
                            

                        </tr>
                        <tr>
                            <td>Attitude Towards School-Maltes</td>
                            <td>A</td>
                            

                        </tr>
                        <tr>
                            <td>Attitude Towards Society</td>
                            <td>A</td>
                           

                        </tr>
                        <tr>
                            <td>Attitude Towards Nation</td>
                            <td>A</td>
                           

                        </tr>
                    </table>

                    <table style="width:70%; border:1px solid black; background-color:white;">
                        <tr>
                            <td>Remarks:&nbsp;&nbsp;&nbsp;&nbsp;<label><?php if($dhtm>0){echo $gradecal =remarks($per,$classid);}?></label></td>
                        </tr>
                    </table>

                </div>

            </div>

            <br />
            <div>
            <p><h3  style="color: white;text-transform: uppercase;">Instructions</label></h3>
            <p><h4  style="color: white;">Grading Scale For Scholastic areas:Grades are awarded on a 8-point Grading Scale as Follows-</h4></p>
            </div></br>
            <div>
                <table
                    style="width:95%;  margin-left:auto; margin-right:auto; border:1px solid black; background-color:white;">
                    <tr>
                        <th>
                            MARKS RANGE
                        </th>
                        <th>
                            GRADE
                        </th>
                    </tr>
                    <!-- Dynamic -->
                    <tr>
                        <td>91-100</td>
                        <td>A1</td>
                    </tr>
                    <tr>
                        <td>81-90</td>
                        <td>A2</td>
                    </tr>
                    <tr>
                        <td>71-80</td>
                        <td>B1</td>
                    </tr>
                    <tr>
                        <td>61-70</td>
                        <td>B2</td>
                    </tr>
                    <tr>
                        <td>51-60</td>
                        <td>C1</td>
                    </tr>
                     <tr>
                        <td>41-50</td>
                        <td>C2</td>
                    </tr>
                     <tr>
                        <td>33-40</td>
                        <td>D</td>
                    </tr>
                     <tr>
                        <td>32 & Below</td>
                        <td>E(Needs Improvement)</td>
                    </tr>

                </table>
				
            </div>
            <br>
            <div  style="color: white;">
			<div  style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Congratulations! Promoted to Class :</div>
			</div>
			<br>
            <div>
                <table style="width:95%;background-color:white;">
					<tr>
						<td>		
                            Date :
                        </td>
                        <td>
                            Class Teacher :
                        </td>
                        <td>
                            Principal :<div><img src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/images/empImage/<?php echo $info->principle_sign;?>" alt="" width="100" height="70" style="margin-top=-60px;" /></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div></div>
    </div> </p><?php 	} ?><?php 
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
								else:
									return 'E';
								endif;
								
							}
							function remarks($val,$classid){
								if($val >= 91 && $val < 101):
									return 'Excellent';
								elseif($val >= 81 && $val < 91):
									return 'Very Good';
								elseif($val >= 71 && $val < 81):
									return 'Good';
								elseif($val >= 61 && $val < 71):
									return 'Good';
								elseif($val >= 51 && $val < 61):
									return 'Progressive';
								else:
									return 'Needs Improvement';
								endif;
								
							} ?>
             
    </div>
    <div class="invoice-buttons" style="text-align:center;">
    <button class="button button2" type="button" onclick="window.print();">
        <i class="fa fa-print padding-right-sm"></i> Print
    </button>
</div>
</body>


</html>