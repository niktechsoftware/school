<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

    <title><?php echo $title; ?></title>

    <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/style.css' />
    <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/prin_result.css'
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
        <br /><br /><br />
        <div id="page-wrap" style="height: 788px;width:960px; border:1px solid #333;">

            <div
                style="width:80%; height: 788px;margin-left:auto; margin-right:auto; border:1px  solid blue; background-color:#e30e0e;">

                <div style="width:95%; margin-left:auto; margin-right:auto; border:1px  solid yellow; height:auto;">
                    <?php
	$school_code = $this->session->userdata("school_code");

    $this->db->where("id",$school_code);
    $info =$this->db->get("school")->row();
?>
                    <table style="width: 100%;">
                        <tr>
                            <td width="20%" style="border: none;" rowspan="2">
                                <img src="<?php echo $this->config->item('asset_url'); ?><?php echo $school_code;?>/images/empImage/<?php echo $info->logo;?>"
                                    alt="" width="120" />
                                </br><label style="color:white">Aff.No. - <?php echo $info->registration_no;?></label>
                                </br><label style="color:white">School Code - 70447</label>
                            </td>
                            <td style="border: none;">
                                <h1 style="color:white;text-align: center;font-size: 30px;">
                                    <?php echo $info->school_name;?></h1>
                                <!--	<p style="Arial Black, Gadget, sans-serif; font-size:45px; color:blue; margin-left:45px;"><?php echo $info->your_school_name;?></p>-->
                                <h2 style="color:white;text-align: center;">
                                    <?php echo $info->address1." ".$info->city; ?>
                                </h2>
                                <h2 style="color:white;text-align: center;">
                                 Mob Number:   <?php echo $info->mobile_no; ?>
                                </h2>

                                <!--   <h2 style="font-variant:small-caps; margin-left:180px;">
						<?php   if(strlen($info->mobile_number > 0 )){echo "Mobile No:- : ".$info->mobile_number." ";} ?>
			           
			        </h2>-->
                            </td>
                            <td style="border: none;></td>
				    	<div style=" display:inline-block; float:right; margin-right:5px;>
                                <table>
                                    <tr>
                                        <td style="border:none; line-height: 20px;">
                                            <img src="<?php echo $this->config->item('asset_url'); ?><?php echo $school_code;?>/images/stuImage/<?php echo $studentInfo->photo;?>"
                                                alt="" width="100" height="100" />
                                        </td>
                                    </tr>

                                </table>
                </div>
                </td>
                </tr>
                <tr>
                    <td style="border: none;">

                        <h2 style="border: 2px solid #000; padding: 5px; width: 200px; color:white; margin-left:130px;">
                            &nbsp;&nbsp;Progress Report (2019-20) <br>
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
				  //		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Class : <strong>'.$c.' - '.$d.'</strong>';	
				  		}else{
				  			echo " There are no marks entry for this Student";
				  		} 
                        	?>
                        </h2>


                    </td>
                </tr>
                </table>
            </div>
            <br>
            <div>
                <table
                    style="width:95%; margin-left:auto; margin-right:auto; border:1px solid black; background-color:white;">
                    <tr>
                        <th colspan="1" rowspan="2">SCHOLASTIC AREA </th>
						<th colspan="5" rowspan="2">Term 1 (100 Marks) </th>
						<!--<th colspan="5" rowspan="2">Term 2 (100 Marks) </th>-->
						<th colspan="1" rowspan="2">Term 2 (100 Marks) </th>
                        <th colspan="3">OVERALL</th>

                    </tr>

                    <tr>
                        <th colspan="3">Term 1 (50)+ Term 2(50)</th>
                    </tr>

                    <tr>

                        <th colspan="1" rowspan="1">Subjects</th>
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
						<td colspan="1" ><?php echo $examname->exam_name;?></td>
                        <?php 
						}
						$i++;
						endforeach ;
						if(!$i%2==0){ ?>
						<td class="center bold">Total</td> 
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
						<td class="center bold">Total</td> 
						<?php } ?>
                       <th>Grand<br> Total</th>
                        <th rowspan="1">Grade</th>
                        <th rowspan="1">Rank</th>
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
                        $ctotal["tot6"]=0;
                        $cumulativetotal=0;
           $totalp= 0;   
           $pi=1;
foreach($resultData as $sub){
$this->db->where('class_id',$classid->class_id);
$this->db->where('id',$sub['subject']);
$subjectname=$this->db->get('subject'); 
if($subjectname->num_rows()>0){
    $subjectname=$subjectname->row();
?>
                   <tr class="wight"> 
					 <td class="subject">	
                     <?php echo  $subjectname->subject;?> 
					</td>
			     <?php 
 				
                 $gtptal=0;
                 $subtatal=0;
		         ?>
				<?php  $i=1; $t=0; $coltptal=0;  foreach ($examid as $value):?>
					<td class="center" >	
					<?php  

					$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid->class_id);
					$this->db->where('stu_id',$studentInfo->id);
					$this->db->where('exam_id',$value->exam_id);
					$this->db->where('fsd',$fsd);
					
						$marks1= $this->db->get('exam_info');
						if($marks1->num_rows()>0){
							$marks=$marks1->row();
							if(is_int($marks)){ 
						    $subtatal=$subtatal+$marks->marks;
							$gtptal= $gtptal+$marks->marks;
							$coltptal+=$marks->marks;
							echo $marks->marks;
							$ctotal[$t]+= $marks->marks; }else{echo $marks->marks;}
							$this->db->where('subject_id',$sub['subject']);
        					$this->db->where('class_id',$classid->class_id);
        					$this->db->where('exam_id',$value->exam_id);
            				$exammm=$this->db->get('exam_max_subject')->row()->max_m;
    				if(is_int($exammm)){
    				    	$dhtm=$exammm+$dhtm;
    				}
    				
						}
					
					?><?php echo "/" .$exammm; ?>
					</td>
					
				            
				<?php 
				$i++; $t++;endforeach; ?>
				<?php if(!$i%2==0){ ?>
						<td class="center bold">
						<?php 
					/*	echo $subtatal; 
						$ctotal['tot'.$i]+=$subtatal;
						 $subtatal=0;*/
						 ?>/100
						 </td>
					<?php } ?>
			
				<td class="center bold">/100</td>
			   <td class="center bold">/100</td>
			   <td class="center bold"></td>
			   <td class="center bold"></td>
			   
				</tr>
                    <?php }}?>
                  
                </table>
            </div>

            <br>
            <div>
                <table
                    style="width:95%; margin-left:auto; margin-right:auto; border:1px solid black; background-color:white;">

                    <tr>
                        <td colspan="2"> CO - SCHOLASTIC Area </td>
                        <td colspan="2">CO - SCHOLASTIC Area</td>
                    </tr>

                    <tr>
                        <td>Work Education</td>
                        <td>0</td>
                        <td>Work Education</td>
                        <td>0</td>
                    </tr>

                    <tr>
                        <td>Art Education</td>
                        <td>0</td>
                        <td>Art Education</td>
                        <td>0</td>
                    </tr>

                    <tr>
                        <td>Helth</td>
                        <td>0</td>
                        <td>Helth</td>
                        <td>0</td>
                    </tr>
                </table>
            </div>

            <br>
            <div>
                <table
                    style="width:95%; margin-left:auto; margin-right:auto; border:1px solid black; background-color:white;">

                    <tr>
                        <td colspan="2"> Grade </td>
                        <td colspan="2">Grade</td>
                    </tr>

                    <tr>
                        <td>Work Education</td>
                        <td>0</td>
                        <td>Work Education</td>
                        <td>0</td>
                    </tr>

                </table>
            </div>

            <br>
            <div>
                <table
                    style="width:95%; margin-left:auto; margin-right:auto; border:1px solid black; background-color:white;">

                    <tr>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                        <td>
                            0
                        </td>
                    </tr>
                </table>
            </div>

            <br>

            <div style=" width:95%; margin-left:auto; margin-right:auto;">
                <div style="width:50%; float:left;">

                    <table style="width:90%; border:1px solid black; background-color:white;">
                        <tr>
                            <th colspan="3">Co- SCHOLASTIC Area</th>
                        </tr>

                        <tr>
                            <th> Activity </th>
                            <th>T1</th>
                            <th>T2</th>
                        </tr>

                        <!-- Dynamic -->
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>

                        </tr>
                    </table>
                    <table style="width:70%; border:1px solid black; background-color:white;">
                        <tr>
                            <td>-</td>
                        </tr>
                    </table>


                </div>



                <div style="width:50%; float:right;">

                    <table style="width:90%; border:1px solid black; background-color:white;">

                        <tr>
                            <th colspan="3"> Discipline</th>
                        </tr>
                        <tr>
                            <th> Activity </th>
                            <th>T1</th>
                            <th>T2</th>
                        </tr>

                        <!-- Dynamic -->
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>

                        </tr>
                    </table>

                    <table style="width:70%; border:1px solid black; background-color:white;">
                        <tr>
                            <td>-</td>
                        </tr>
                    </table>

                </div>

            </div>

            <br />
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
                        <td><?php	//echo round((($cumulativetotal*100)/$dhtm), 2);?>% </td>
                        <td>-</td>

                    </tr>

                </table>
            </div>
        </div>
    </div>
    </div>
</body>
<div class="invoice-buttons" style="text-align:center;">
    <button class="button button2" type="button" onclick="window.print();">
        <i class="fa fa-print padding-right-sm"></i> Print
    </button>
</div>

</html>