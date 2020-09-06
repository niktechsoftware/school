<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title><?php echo $title; ?></title>

	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/prin_result.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/example.js'></script>
	
	<style type="text/css">



		body {
			background: #e5952d;
			font-family: arial;
			line-height: 17px;
			font-size: 14px;
		}
		span {
			display: block;
		}
		table {
			border-collapse: collapse;
		}
		table tr td{
			border: 1px solid #000;
			width: 9.1%;
			padding: 6px;
			vertical-align: top;
		}
		.studentImage {
			width: 70px;
			height: 70px;
		}
		.tableHeader {
			background: #a1d657;
		}
		.wight {
			background: #FFFFFF;
		}
		.yellow {
			background: #ffff99;
		}
		.blue {
			background: #baceff;
		}
		.pink {
			background: #ffe0f1;
		}
		.schoolTitle {
			font-size: 20px;
			font-weight: bold;
			    padding: 5px;
		}
		
		.addressTitle{
			font-size: 15px;
			font-weight: bold;
		}
		.center {
			text-align: center;
		}
		.bold {
			font-weight: bold;
		}
		.report {
			font-size: 17px;
			font-weight: bolder;
			padding:5px;
		
			
		}
		.report1 {
			font-size: 15px;
		}
		.subject {
			font-size: 12px;
			font-weight: bold;
		}
		#hiderow,
		.delete {
		  display: none;
		}
		/* ---------------------------------------------------- BUtton CSS end ----------------------------------------- */
		@media print
		{
		    body * { visibility: visible; }
		    .non-printable { display: none; }
		    .printcontent * { visibility: visible; }
		    
		    @page
		   {
		   	height: 645px;
		   	width: 873px;
		   	margin-left:350px;
		   	margin-right:350px;
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
<?php
    $school_code = $this->session->userdata("school_code");
    $this->db->where("id",$school_code);
    $info =$this->db->get("school")->row();
    $row2=$this->db->get('db_name')->row()->name;
?><!---samta 9,10,11,12 body stART--->
<?php  ?>
<!---other body stART--->
<body>
<!---other body end--->
  

    <div id="printcontent">
    <table width="98%" class="printcontent"style="margin-top:50px; margin-left:auto; margin-right:auto;">
		<!---other school head section --->
        <tr style="border-top:none;">
            <td class="center" style="border:none;">
               
                <img src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/images/empImage/<?= $this->session->userdata('logo') ?>" alt="" style="width:100px; height:100px; float:left;" />
                <!--</br><i>Aff.No. - <?php echo $info->registration_no;?></i>-->
                </td>
                <td colspan="9" class="center" style="border:none;">
           
            <div style="text-align:center;" >
                <span class="schoolTitle"><?php echo $info->school_name;?></span>
               <span class="addressTitle"><?php echo $info->address1." ".$info->address2." ".$info->city." ".$info->state." - ".$info->pin; ?></span>
                <span class="report">PROGRESS REPORT</span>
                       <?php //$fsd1=$this->session->userdata('fsd');
                             $this->db->where('school_code',$school_code);
                             $this->db->where('id',$fsd);
                            $fsd2=$this->db->get('fsd')->row()->finance_end_date;

                       ?>
        <span class="report1">ACADEMIC SESSION <?php echo (date('Y', strtotime('-1 year', strtotime($fsd2)) )."-". date('Y', strtotime($fsd2))) ;?></span>
        </div>
            </td>
           <td class="center" style="border:none; display:none;">
               
                <img src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/images/empImage/<?= $this->session->userdata('logo') ?>" alt="" style="width:100px; height:100px; float:right;" />
                <!--</br><i>Aff.No. - <?php echo $info->registration_no;?></i>-->
                </td>
        </tr>
        <tr class="wight">
            <td colspan="5">
                <span style="text-transform: uppercase;">Scholar ID: <?= $studentInfo->username; ?></span>
                <span style="text-transform: uppercase;">Scholar Name:  <?= strtoupper($studentInfo->name);?> </span>
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
                <span style="text-transform: uppercase;">Class: <?php  echo $classdf->class_name."-".$secname; ?></span>
                 <?php } else { echo "something wrong please try again";  }?>
                <span></span>
            </td>
            <td colspan="5">
                           
                 <span style="text-transform: uppercase;">Mother's Name: <?= strtoupper($parentInfo->mother_full_name); ?></span>
                <span style="text-transform: uppercase;">Father's Name: <?= strtoupper($parentInfo->father_full_name); ?></span>
				<span style="text-transform: uppercase;">Date of Birth: <?php echo date("d-m-Y",strtotime($studentInfo->dob)); ?></span>
            </td>
			<td class="">
				<img src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/images/stuImage/<?php echo $studentInfo->photo; ?>"  alt="" width="90" height="105" />

			</td>
		</tr>
		<!---other school head section end --->
	
		<!---dds manner marks table start--->
		<?php 
			$school=$this->session->userdata('school_code');?>
	 
		<!---others marks table start--->
		<tr class="tableHeader">
			<td class="center" colspan="1" >A. SCHOLASTIC AREAS</td>
    		<td class="center" colspan="4">TERM - 1</td>
    		<td class="center" colspan="4">TERM - 2</td>
			<td colspan="2">Cumulative Evaluation</td>
		</tr>
		<tr class="yellow">
			<td>SUBJECT</td>
				<?php
				$dhtm=0;
			    $i=1; $arrco[1]=0;
			    $arrco[2]=0;
			    $arrco[3]=0;
			    $arrco[4]=0;
			    $arrco[5]=0;
			    $arrco[6]=0;
		
			  
			 if($examid->num_rows()==0){ ?>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;"></td>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;"></td>
			<?php }else if($examid->num_rows()==1){ ?>
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
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;"><?php echo $examname->exam_name; ?></td>
                        <?php 
						}
						$i++;
						endforeach ; ?>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;"></td>
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
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;"><?php echo $examname->exam_name; ?></td>
                        <?php 
						}
						$i++;
						endforeach ; ?>
			<?php } ?><td>Total</td>
					<td>Grade</td>
			<!--1st term exam name end-->
			<!--2nd term exam name start-->
			<?php  if($examid_2->num_rows()==0){ ?>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;"></td>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;"></td>
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
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;"><?php echo $examname->exam_name; ?></td>
                        <?php 
						}
						$i++;
						endforeach ; ?>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;"></td>
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
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;"><?php echo $examname->exam_name; ?></td>
                        <?php 
						}
						$i++;
						endforeach ; ?>
			<?php } ?><td>Total</td>
					<td>Grade</td>
			<!--2nd term exam name end-->
		
			<td colspan="1" class="text-center">Cumulative Marks<?php echo "[100]";?></td>
			<td colspan="1">Grade</td>
		</tr>
		<?php 
		$alltot=0;
		$alltotmax=0;
			$htotal = 0; 
			$ctotal =array();
			$ctotal[0]=0;
			$ctotal[1]=0;
			$ctotal[2]=0;
			$ctotal[3]=0;
		
			$ctotal["tot2"]=0;
			$ctotal["tot4"]=0;
			$ctotal["tot6"]=0;
			$ctotalm=array();
				$ctotalm[0]=0;
			$ctotalm[1]=0;
			$ctotalm[2]=0;
			$ctotalm[3]=0;
			$ctotalm[4]=0;
			
			$ctotal_2 =array();
			$ctotal_2[0]=0;
			$ctotal_2[1]=0;
			$ctotal_2[2]=0;
			$ctotal_2[3]=0;
			$ctotal_2[4]=0;
			$ctotal_2["tot2"]=0;
			$ctotal_2["tot4"]=0;
			$ctotal_2["tot6"]=0;
			
			
			$ctotal_3 =array();
			$ctotal_3[0]=0;
			$ctotal_3[1]=0;
			$ctotal_3[2]=0;
			$ctotal_3[3]=0;
			$ctotal_3[4]=0;
			$ctotal_3["tot2"]=0;
			$ctotal_3["tot4"]=0;
			$ctotal_3["tot6"]=0;
			$cumulativetotal=0;
			$totalp= 0;   
			$pi=1;$grnd_1=0;$grnd_2=0;$grnd_3=0;
			$grndt_1=0;$grndt_2=0;$grndt_3=0;
			foreach($resultData as $sub):
			?><?php 
							 $this->db->where('class_id',$classid->class_id);
							 $this->db->where('id',$sub['subject']);
				$subjectname=$this->db->get('subject'); 
                    if($subjectname->num_rows()>0){
                        $subjectname=$subjectname->row();
                   $totalp+=200;?>
		<tr class="wight"> 
					<td class="subject" colspan="1" ><?php echo  $subjectname->subject; ?> </td>
			     <?php 
                 $gtptal=0;
                 $subtatal=0;
		         $i=1; $t=0; $coltptal=0; $ttal=0; ?>
				 <?php  if($examid->num_rows()==0){?>
					<td></td><td></td>
				 <?php }else if($examid->num_rows()==1){ ?>
					<?php foreach ($examid->result() as $value): ?>
					<td><?php  
					            $this->db->where("term", 1);
								$this->db->where('subject_id',$subjectname->id);
								$this->db->where('class_id',$classid->class_id);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();
							$subtatal=$subtatal+$marks->marks;
							$gtptal= $gtptal+$marks->marks;
							$coltptal+=$marks->marks;
							echo $marks->marks;
							$ctotal[$t]+= $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid->class_id);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				 echo "/".$exammm;
				 $dhtm=$exammm+$dhtm;			
				  if(is_numeric($exammm)){
					  $ttal=$ttal+$exammm;
				    $dhtm=$exammm+$dhtm;
				    $ctotalm[$t]+=$exammm;
					}else{ $ttal= $ttal;
					 $dhtm= $dhtm;   
					}
				 } ?>
					</td>
					<td></td>
					<td></td>
				<?php  $i++; $t++; endforeach; ?>
				 <?php }else{ ?>
				 <?php foreach ($examid->result() as $value): ?>
					<td><?php  
					            $this->db->where("term", 1);
								$this->db->where('subject_id',$subjectname->id);
								$this->db->where('class_id',$classid->class_id);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();
							$subtatal=$subtatal+$marks->marks;
							$gtptal= $gtptal+$marks->marks;
							$coltptal+=$marks->marks;
							echo $marks->marks;
							$ctotal[$t]+= $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid->class_id);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				
if(is_numeric($exammm)){
    	 echo "/".$exammm;
				 $dhtm=$exammm+$dhtm;
					  $ttal=$ttal+$exammm;
					    $ctotalm[$t]+=$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal= $ttal;
					 $dhtm= $dhtm;   
					}
				 } ?>
					</td>
				
				<?php  $i++; $t++; endforeach; ?>
				<?php } ?>	
				<td><?php if($gtptal>0){echo $gtptal;?>/<?php echo $ttal; }?></td>
					<td><?php if($gtptal>0){ echo calculateGrade($gtptal*2,$classid->class_id);}?></td>
				<!--1st term marks end-->
				<!--2nd term marks start-->
				 <?php 
                 $gtptal_2=0;
                 $subtatal=0;
		         $i=1;  $coltptal=0; $ttal_2=0; ?>
				 <?php  if($examid_2->num_rows()==0){?>
					<td></td><td></td>
				 <?php }else if($examid_2->num_rows()==1){ ?>
				 
					<?php foreach ($examid_2->result() as $value): ?>
					<td><?php  
					            $this->db->where("term", 2);
								$this->db->where('subject_id',$subjectname->id);
								$this->db->where('class_id',$classid->class_id);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();
							$subtatal=$subtatal+$marks->marks;
							$gtptal_2= $gtptal_2+$marks->marks;
							$coltptal+=$marks->marks;
							echo $marks->marks;
							$ctotal[$t]+= $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid->class_id);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				
				 $dhtm=$exammm+$dhtm;		
 if(is_numeric($exammm)){
      echo "/".$exammm;
					  $ttal_2=$ttal_2+$exammm;
					    $ctotalm[$t]+=$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal_2= $ttal_2;
					 $dhtm= $dhtm;   
					}
				 } ?>
					</td>
				    
				<?php  $i++; $t++; endforeach; ?>
				 <?php }else{ ?>
				 <?php foreach ($examid_2->result() as $value): ?>
					<td><?php  
					            $this->db->where("term", 2);
								$this->db->where('subject_id',$subjectname->id);
								$this->db->where('class_id',$classid->class_id);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();
							$subtatal=$subtatal+$marks->marks;
							$gtptal_2= $gtptal_2+$marks->marks;
							$coltptal+=$marks->marks;
							echo $marks->marks;
							$ctotal[$t]+= $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid->class_id);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
			
				 $dhtm=$exammm+$dhtm;	
 if(is_numeric($exammm)){
     	 echo "/".$exammm;
					  $ttal_2=$ttal_2+$exammm;
					    $ctotalm[$t]+=$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal_2= $ttal_2;
					 $dhtm= $dhtm;   
					}
				 } ?>
					</td>
				
				<?php  $i++; $t++; endforeach; ?>
				<?php } ?>
				<td><?php if($gtptal_2>0){ echo $gtptal_2;?>/<?php echo $ttal_2;}?></td>
				<td><?php if($gtptal_2>0){ echo calculateGrade($gtptal_2*2,$classid->class_id);}?></td>
				<td><?php $alltot=$alltot+ $gtptal+$gtptal_2;
				$alltotmax=$alltotmax+ $ttal+$ttal_2;
				if($gtptal+$gtptal_2>0){ echo $gtptal+$gtptal_2;?>/<?php echo $ttal+$ttal_2;}?></td>
				<td><?php if($gtptal+$gtptal_2>0){echo calculateGrade($gtptal+$gtptal_2,$classid->class_id);}?></td>
			
			<?php	} endforeach;?>
				<!--2nd term marks end-->
		
				 <?php   ?>
		<tr class="wight">
					<td class="subject">GRAND TOTAL</td>
					<?php $h=1;$i=0; 
					foreach($ctotal as $cd):
					    
					if($h==3 || $h==4 ||  $h==7 ||$h==8){
					    ?> 
					   
					    <td class="bold" ><?php if($h==4 || $h==8){}else{if($h<5){echo $ctotal[0]+$ctotal[1]; echo '/'; echo $ctotalm[0]+$ctotalm[1]; }else{ echo $ctotal[2]+$ctotal[3];echo "/"; echo $ctotalm[2]+$ctotalm[3];}}?></td> <?php  
				 }else{  	if($i<5){
					?>
					<td class="bold">
					<?php echo $ctotal[$i];  ?>/<?php echo $ctotalm[$i];?>
					</td>
				
					<?php $i++; }  } $h++; endforeach;	
					?>
		<td></td>
				<td class="bold"><?php echo $alltot;?>/<?php echo $alltotmax;?></td>
			<td class="bold"></td>
		</tr>
		
		<?php $indicators =round((($alltot*100)/$alltotmax), 2);?>
			
		<tr class="tableHeader">	
			<td colspan="3" style="text-transform: uppercase;">B. CO-Scholastic Areas</td>
			<td colspan="3" style="text-transform: uppercase;">Descriptive Indicators</td>

			<td>Grade</td>
			<td colspan="3" style="text-transform: uppercase;">Descriptive Indicators</td>
			<td>Grade</td>
		<!--	<td colspan="1"  class="pink" style="text-transform: uppercase;">MARK PERCENTAGE  <?php //echo $totalp;  
			echo round((($cumulativetotal*100)/$dhtm), 2);?>% </td>
			<td colspan="1">RANK</td>-->
		</tr>
			<tr class="wight">
					<td class="subject" colspan="3">VALUE EDUCATION<?php //echo $arrco[1];?></td>
					<td colspan="3"><?php echo discriptiveindicator($indicators);?></td>
					<td><?php echo calculateGrade1($indicators,$studentInfo->class_id)?></td>
					<td colspan="3"><?php echo discriptiveindicator($indicators);?></td>
             		<td><?php echo calculateGrade1($indicators,$studentInfo->class_id)?></td>
					
		</tr>
		<tr class="wight">
					<td class="subject" colspan="3" >WORK EDUCATION <?php //echo $arrco[2];?></td>
					<td colspan="3"><?php echo discriptiveindicator($indicators);?></td>
             		<td><?php echo calculateGrade1($indicators,$studentInfo->class_id)?></td>
             		<td colspan="3"><?php echo discriptiveindicator($indicators);?></td>
             		<td><?php echo calculateGrade1($indicators,$studentInfo->class_id)?></td>
				
		</tr>
		<tr class="wight">
					<td class="subject" colspan="3">HEALTH & PHYSICAL EDUCATION <?php //echo $arrco[5];?></td>
					<td colspan="3"><?php echo discriptiveindicator($indicators);?></td>
					<td><?php echo calculateGrade1($indicators,$studentInfo->class_id)?></td>
					<td colspan="3"><?php echo discriptiveindicator($indicators);?></td>
             		<td><?php echo calculateGrade1($indicators,$studentInfo->class_id)?></td>
				
		</tr>
		<tr class="wight">
					<td colspan="3" class="subject">DISCIPLINE</td>
					<?php   if($examid->num_rows()==0){?><td colspan="2" ></td><?php }else{
					
							            $this->db->select_sum("marks");
							            $this->db->where("term", 1);
							
											$this->db->where('subject_id',$sub['subject']);
											$this->db->where('class_id',$classid->class_id);
											$this->db->where('stu_id',$studentInfo->id);
										
											$this->db->where('fsd',$fsd);
									$marks= $this->db->get('exam_info');
									if(($marks->num_rows()>0)){ 
										if($marks->num_rows()>0){
										$marks=$marks->row();
										$marks->marks;
					?>
					<td colspan="3"><?php echo discriptiveindicator($marks->marks);?></td>
						<td><?php echo calculateGrade1($marks->marks,$classid->class_id)?></td>
														<?php }else{ ?>
					<td colspan="3"><?php echo discriptiveindicator($cumulativetotal);?></td>
						<td><?php echo calculateGrade1($marks->marks,$classid->class_id)?></td>
															<?php }?>
														<?php }else{?>
					<td colspan="3"><?php echo discriptiveindicator($cumulativetotal);?></td>
						<td><?php echo calculateGrade1(0,$classid->class_id)?></td>
					<?php	} 
					
					
					}?>
					<?php  if($examid_2->num_rows()==0){?><td colspan="2" ></td><?php }else{
					
						    	$this->db->select_sum("marks");
						$this->db->where("term", 2);
					
										$this->db->where('subject_id',$sub['subject']);
										$this->db->where('class_id',$classid->class_id);
										$this->db->where('stu_id',$studentInfo->id);
										
										$this->db->where('fsd',$fsd);
								$marks= $this->db->get('exam_info');
								if(($marks->num_rows()>0)){ 
									if($marks->num_rows()>0){
									$marks=$marks->row();
									$marks->marks;
					?>
					<td colspan="3"><?php echo  discriptiveindicator($marks->marks);?></td>
					<td><?php //echo calculateGrade1($marks->marks,$classid->class_id)?></td>
														<?php }else{ ?>
					<td colspan="3"><?php echo discriptiveindicator($cumulativetotal);?></td>
					<td><?php echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
															<?php }?>
														<?php }else{?>
					<td colspan="3"><?php echo discriptiveindicator($cumulativetotal);?></td>
					<td><?php echo calculateGrade1(0,$studentInfo->class_id)?></td>
					<?php	} }?>
				
				
		</tr>
			<tr class="pink">
			<td colspan="2">MARK PERCENTAGE</td>
			<td colspan="9" style="text-transform: uppercase;">	<?php echo round((($alltot*100)/$alltotmax), 2);?>% </td>
		</tr>
			<tr class="pink">
			<td colspan="2"> class Rank</td>
			<td colspan="9" style="text-transform: uppercase;">	<?php  echo $this->exammodel->getClassRank($studentInfo->id, $classid->class_id, $fsd); ?></td>
		</tr>
			
		<tr class="blue">
			<td colspan="2">ATTENDANCE  </td>
			<td colspan="9">Class Teachers Remark</td>
		</tr>
	
		<!---other marksheet end(others)--->
			
	
		<!---other school footer section --->
		<tr class="pink">
			<td colspan="2">FINAL RESULT</td>
			<td colspan="9" style="text-transform: uppercase;">Passed/Promoted/Supp./Detained.</td>
		</tr>
		<tr>
			<td colspan="9" class="wight" height="25" style="border-right: None">
			<br>
			<br>
			<br>
			<br>&emsp;Sign Class Teacher
			</td>
			<td colspan="2" class="wight" height="25" style="border-left:none;">
			<img src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/images/empImage/<?php echo $info->principle_sign;?>" alt="" width="100" height="70" style="margin-top=-60px;" />
			
			Sign Principal
			</td>
		</tr>
        <tr style="border:none;"><?php	
                         $this->db->where('school_code',$this->session->userdata('school_code'));
						$url= $this->db->get('sms_setting')->row()->web_url; ?>
            	<td colspan="5" style="border:none; font-size:10px;"> <img style="float:left;" src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/Map-Icon.png"  alt="" width="20" height="20" />&nbsp;<?php echo $info->address1." ".$info->city." (".$info->state.") ".$info->nationalty; ?></td>
            	<td colspan="4" style="border:none; font-size:10px;"> <img style="float:left;" src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/email.png"  alt="" width="20" height="20" />&nbsp;<?php echo $info->email1;?></td>
            	<td colspan="2" style="border:none; font-size:10px;"> <img style="float:left;" src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/web.png"  alt="" width="30" height="30" />&nbsp;www.<?php echo $url; ?></td>
        </tr>
        <!---other school footer section end --->
      
	</table>

	<?php
		function calculateGrade($val,$classid){
				if(($classid==98)||($classid==99)||($classid== 116)){
		    $val=$val*2;
		}
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
		function calculateGrade1($val,$classid){
			if($val >= 91 && $val < 101):
				return 'A';
			elseif($val >= 81 && $val < 91):
				return 'B';
			elseif($val >= 60 && $val < 81):
				return 'C';
			elseif($val >= 40 && $val < 61):
				return 'D';
			else:
				return 'E';
			endif;
			}
		function discriptiveindicator($val){
			if($val >= 90 && $val < 101):
				return 'Excellent';;
			elseif($val >= 80 && $val < 91):
				return 'Very Good';
			elseif($val >= 60 && $val < 81):
				return 'Good';
			elseif($val >= 40 && $val < 61):
				return 'Satisfactory';
				else:
				return 'Need to improve';
			endif;
		}
		
		
		
		function numberTowords($num)
                    { 
                    $ones = array( 
                    1 => "one", 
                    2 => "two", 
                    3 => "three", 
                    4 => "four", 
                    5 => "five", 
                    6 => "six", 
                    7 => "seven", 
                    8 => "eight", 
                    9 => "nine", 
                    10 => "ten", 
                    11 => "eleven", 
                    12 => "twelve", 
                    13 => "thirteen", 
                    14 => "fourteen", 
                    15 => "fifteen", 
                    16 => "sixteen", 
                    17 => "seventeen", 
                    18 => "eighteen", 
                    19 => "nineteen" 
                    ); 
                    $tens = array( 
                    1 => "ten",
                    2 => "twenty", 
                    3 => "thirty", 
                    4 => "forty", 
                    5 => "fifty", 
                    6 => "sixty", 
                    7 => "seventy", 
                    8 => "eighty", 
                    9 => "ninety" 
                    ); 
                    $hundreds = array( 
                    "hundred", 
                    "thousand", 
                    "million", 
                    "billion", 
                    "trillion", 
                    "quadrillion" 
                    ); //limit t quadrillion 
                    $num = number_format($num,2,".",","); 
                    $num_arr = explode(".",$num); 
                    $wholenum = $num_arr[0]; 
                    $decnum = $num_arr[1]; 
                    $whole_arr = array_reverse(explode(",",$wholenum)); 
                    krsort($whole_arr); 
                    $rettxt = ""; 
					$ones[0]="";
                    foreach($whole_arr as $key => $i){ 
                    if($i < 20){ 
                    $rettxt .= $ones[$i]; 
                    }elseif($i < 100){ 
                    $rettxt .= $tens[substr($i,0,1)]; 
                    $rettxt .= " ".$ones[substr($i,1,1)]; 
                    }else{ 
                    $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
                    $rettxt .= " ".$tens[substr($i,1,1)]; 
                    $rettxt .= " ".$ones[substr($i,2,1)]; 
                    } 
                    if($key > 0){ 
                    $rettxt .= " ".$hundreds[$key]." "; 
                    } 
                    } 
                    if($decnum > 0){ 
                    $rettxt .= " and "; 
                    if($decnum < 20){ 
                    $rettxt .= $ones[$decnum]; 
                    }elseif($decnum < 100){ 
                    $rettxt .= $tens[substr($decnum,0,1)]; 
                    $rettxt .= " ".$ones[substr($decnum,1,1)]; 
                    } 
                    } 
                    return $rettxt; 
                    } 

/*extract($_POST);
if(isset($convert))
{
echo "<p align='center' style='color:blue'>".numberTowords(200)."</p>";
}*/
		
		
	?>
</div>
<div class="invoice-buttons" id ="non-printable" style="text-align:center;">
    <button class="button button2" type="button"  onclick="window.print();">
      <i class="fa fa-print padding-right-sm"></i> Print 
    </button>
  </div>
</body>

</html>
				
					

			