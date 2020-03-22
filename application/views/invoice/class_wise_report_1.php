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

<body>
    <div id="printcontent">
        <div id="page-wrap">
            <div class="row">
                <div class="col-sm-12">
                    <?php   
                            $this->db->where('status',1);
                            $this->db->where('class_id',$classid);
                            $sid=$this->db->get('student_info');
                	        foreach($sid->result() as $studentProfile){
                            $studentInfo = $studentProfile;
                            $this->db->where('student_id',$studentInfo->id);
                            $guardian_info=$this->db->get('guardian_info');
                            $parentInfo = $guardian_info->row();?>
			
			<?php 
				$school_code = $this->session->userdata("school_code");
							   $this->db->where("id",$school_code);
						$info =$this->db->get("school")->row();
						$row2=$this->db->get('db_name')->row()->name;
						
			?>
    <table width="98%" class="printcontent"style="margin-top:50px; margin-left:auto; margin-right:auto;">
       <?php if( $classid == 262 && $row2== "D" || $classid == 343 && $row2== "D" || $classid == 261 && $row2== "D" || $classid == 342 && $row2== "D"){ ?>
		<!---samta 9,10,11,12 head section not required--->
		<tr style="border-top:none;">
            <td class="center" colspan="12" style="border:none;">
              <img src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/images/empImage/<?= $this->session->userdata('logo') ?>" alt="" style="width:100px; height:100px; " />
            </td>
        </tr>
		<tr style="border-top:none;">
            <td colspan="12" class="center" style="border:none;">
             <div style="text-align:center;" >
                <span class="schoolTitle"><?php if(($classid==98)||($classid==99) || ($classid==116)||($classid== 100) ||($classid== 101) ||($classid== 102) ||($classid== 103) ||($classid== 104) ){ echo "THE MANNER SCHOOL";}else{echo $info->school_name;}?></span>
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
            <!--<td colspan="3" class="center" style="border:none;">
				<img src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/images/stuImage/<?php echo $studentInfo->photo; ?>"  alt="" width="90" height="105" />
        	</td>-->
        </tr>
        <tr class="wight" style="border-top:none;">
            <td colspan="12" style="border:none;" >
                <span style="">यह प्रमाणित किया जाता है कि This is to certify that: <?= strtoupper($studentInfo->name);?></span></br>
                <span style="">Student ID: <?= strtoupper($studentInfo->username); ?>  </span></br>
                <span style="">माता का नाम Mother's Name: <?= strtoupper($parentInfo->mother_full_name); ?></span></br>
                <span style="">पिता/संरक्षक का नाम Father's / Guardian's Name: <?= strtoupper($parentInfo->father_full_name); ?></span></br>
                <span style="">जन्म-तिथि Date of Birthdate: <?= strtoupper($studentInfo->dob); ?></span></br>
                <span style="">विद्यालय School: <?php echo $info->school_name; ?><?php echo $info->address1." ".$info->address2." ".$info->city." ".$info->state." - ".$info->pin; ?></span></br>
                <span style="">की शैक्षणिक उपलब्धियां निम्नानुसार हैं has achieved scholastic Achievements as under :</span>
               <?php
                $this->db->where('school_code',$school_code);
                $this->db->where('id',$classid);
                $classname=$this->db->get('class_info');
                if($classname->num_rows()>0){
                  $classdf=$classname->row();
                  $this->db->where("id",$classdf->section);
                  $secname = $this->db->get("class_section")->row()->section;
                  ?>
                <!--<span style="">Class: <?php  echo $classdf->class_name."-".$secname; ?></span>-->
                 <?php } else { echo "something wrong please try again";  }?>
                
            </td>
           
			
		</tr>
		<?php }else{ ?>
		<!---other school head section --->
        <tr style="border-top:none;">
            <td class="center" style="border:none;">
               
                <img src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/images/empImage/<?= $this->session->userdata('logo') ?>" alt="" style="width:100px; height:100px; float:left;" />
                <!--</br><i>Aff.No. - <?php echo $info->registration_no;?></i>-->
                </td>
                <td colspan="9" class="center" style="border:none;">
           
            <div style="text-align:center;" >
                <span class="schoolTitle"><?php if(($classid==98)||($classid==99) || ($classid==116)||($classid== 100) ||($classid== 101) ||($classid== 102) ||($classid== 103) ||($classid== 104) ){ echo "THE MANNER SCHOOL";}else{echo $info->school_name;}?></span>
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
                <span></span>
            </td>
            <td colspan="5">
                           
                 <span style="text-transform: uppercase;">Mother's Name: <?= strtoupper($parentInfo->mother_full_name); ?></span>
                <span style="text-transform: uppercase;">Father's Name: <?= strtoupper($parentInfo->father_full_name); ?></span>
				<span style="text-transform: uppercase;">Date of Birth: <?= $studentInfo->dob; ?></span>
            </td>
			<td class="">
				<img src="<?php echo $this->config->item('asset_url'); ?><?= $this->session->userdata('school_code') ?>/images/stuImage/<?php echo $studentInfo->photo; ?>"  alt="" width="90" height="105" />

			</td>
		</tr>
		<!---other school head section end --->
		<?php } ?>
		<!---dds manner marks table start--->
		<?php 
			$school=$this->session->userdata('school_code');
					
		if($school == 8 && $row2 == "A"){ ?>
		<tr class="tableHeader">
			<td class="center" colspan="1" >A. SCHOLASTIC AREAS</td>
    		<td class="center" colspan="4">TERM - 1</td>
    		<td class="center" colspan="4">TERM - 2</td>
			<td colspan="2" style="text-transform: uppercase;">Cumulative Evaluation</td>
		</tr>
		<tr class="yellow">
		<td>SUBJECT</td>
			<?php
			$dhtm=0;
           $i=1; 
		   $arrco[1]=0;
           $arrco[2]=0;
           $arrco[3]=0;
           $arrco[4]=0;
           $arrco[5]=0;
            $arrco[6]=0;
           foreach ($examid->result() as $value):
              $examid1=$value->exam_id;	
             $this->db->where('id',$examid1);
             $examname=$this->db->get('exam_name'); 
             
             if ($examname->num_rows()>0){
             $examname=$examname->row(); 
             	?>  <td style="text-transform: uppercase;"><?php echo $examname->exam_name;?><?php if(($classid==98)||($classid==99)||($classid== 116)){if($i%2==1){echo "[20]";}else{echo "[30]";}}else{
             	if(($classid==100)||($classid==101)||($classid== 102) ||($classid== 103) ||($classid== 104) ){ if($i%2==1){echo "[40]";}else{echo "[60]";}}else{ if($i%2==1){echo "[20]";}else{echo "[80]";}}}?></td>
             	<?php 
             }else{
             		?>  <td></td>
             	<?php
             }
			?>

          
            <?php if($i%2==0){ ?>
            <td class="center bold" style="text-transform: uppercase;">Total<br>
           <?php if(($classid==98)||($classid==99)||($classid== 116)){echo "[50]";}else{echo "[100]";}?>
        </td>
			<td class="center bold">Grade</td>
   <?php } ?>
 			<?php $i++; endforeach ;
for($j=$i; $j < 5; $j++){
?>
<td></td>
 <?php if($i%2==0){ ?>
            <td style="text-transform: uppercase;">Total <br><?php if(($classid==98)||($classid==99)||($classid== 116)){echo "50";}else{echo "100";}?></td>
			<td style="text-transform: uppercase;">Grade</td>
      <?php }}
			?>
			<td colspan="1" class="text-center" style="text-transform: uppercase;">Cumulative Marks<?php if(($classid==98)||($classid==99)||($classid== 116)){echo "[100]";}else{echo "[200]";}?></td>
			<td colspan="1" style="text-transform: uppercase;">Grade</td>
		</tr>
		<?php $htotal = 0;  


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
		foreach($resultData as $sub):?>

			
                    <?php 
                    $this->db->where('class_id',$classid);
                    $this->db->where('id',$sub['subject']);
                    $subjectname=$this->db->get('subject');
                    if($subjectname->num_rows()>0){
                        $subjectname=$subjectname->row();
                    
                    if(($subjectname->subject == "VALUE EDUCATION") || ($subjectname->subject =="WORK EDUCATION") || ($subjectname->subject == "ART/URDU")||($subjectname->subject == "SENSORIAL ACTIVITIES" ) || ($subjectname->subject == "HEALTH & PHYSICAL EDUCATION" )|| ($subjectname->subject == "DISCIPLINE" )){
                   if($subjectname->subject == "VALUE EDUCATION"){
                   $arrco[1]= $subjectname->id;
                 
                   $pi=$pi+1;
                   }
                   if($subjectname->subject == "WORK EDUCATION"){
                   $arrco[2]= $subjectname->id;
                    $pi=$pi+1;
                   }
                   if($subjectname->subject == "ART/URDU"){
                   $arrco[3]= $subjectname->id;
                    $pi=$pi+1;
                   }
                   if($subjectname->subject == "SENSORIAL ACTIVITIES"){
                   $arrco[4]= $subjectname->id;
                    $pi=$pi+1;
                   }
                     if($subjectname->subject == "HEALTH & PHYSICAL EDUCATION"){
                   $arrco[5]= $subjectname->id;
                    $pi=$pi+1;
                   }
                   
                   if($subjectname->subject == "DISCIPLINE"){
                   $arrco[6]= $subjectname->id;
                    $pi=$pi+1;
                   }
                 
                    }else{ $totalp+=200;?>

					 	<tr class="wight"> 
					 <td class="subject" style="text-transform: uppercase;">	

                     <?php echo  $subjectname->subject;
                       ?> 
					</td>
			     <?php 
 				
                 $gtptal=0;
                 $subtatal=0;
		         ?>
				<?php  $i=1; $t=0; $coltptal=0;  foreach ($examid->result() as $value):?>
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
							$subtatal=$subtatal+$marks->marks;
							$gtptal= $gtptal+$marks->marks;
							$coltptal+=$marks->marks;
							echo $marks->marks;
							$ctotal[$t]+= $marks->marks;
							
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				$dhtm=$exammm+$dhtm;
						}
					
					?>
					</td>
					<?php if($i%2==0){
						?>
						<td class="center bold"><?php echo $subtatal; 
							$ctotal['tot'.$i]+=$subtatal;
							$gradecal =calculateGrade($subtatal,$classid);
						 $subtatal=0;?></td>

						<td class="center bold"><?php echo $gradecal;?></td>
					<?php } ?>
				            
				<?php $i++; $t++;endforeach; 
					

				for($j=$i; $j < 5; $j++){
               ?>
              <td class="center bold" ></td>
              <?php if($i%2==0){ ?>
              <td class="center"><?php 
					$ctotal['tot'.$i]+=0;?>
						</td>
			 <td class="center bold" style="text-transform: uppercase;"><?php echo calculateGrade($ctotal['tot'.$i],$classid); ?></td>
               <?php }}
		           ?>

				<td class="center bold" style="text-transform: uppercase;"><?php  $rty = $gtptal/2; echo $gtptal;  ?></td>
			   <td class="center bold" style="text-transform: uppercase;"><?php echo calculateGrade($rty,$classid)?></td>	
				</tr>

					<?php } }endforeach;?>
		<tr class="wight">
					<td class="subject">GRAND TOTAL</td>
					<?php $h=1;$i=0; foreach($ctotal as $cd):
					if($h<5){?>
					<td class="center">
					<?php echo $ctotal[$i];  ?>
					</td>
					<?php if($h%2==0){ ?>
					<td class="center bold"><?php $cumulativetotal+=$ctotal['tot'.$h];echo $ctotal['tot'.$h];?> </td> 
					<td class="center bold"></td>
					<?php 			} ?>
					<?php $h++; $i++; } endforeach;	
					?>
			<td class="center bold"><?php echo $cumulativetotal;?></td>
			<td class="center bold"></td>
		</tr>
		<tr class="tableHeader">	
			<td colspan="2" style="text-transform: uppercase;">B. CO-Scholastic Areas</td>
			<td colspan="2" style="text-transform: uppercase;">Descriptive Indicators</td>

			<td>Grade</td>
			<td colspan="2" style="text-transform: uppercase;">Descriptive Indicators</td>
			<td>Grade</td>
			<td colspan="2" class="pink" style="text-transform: uppercase;">Class Teachers Remark</td>
		</tr>
		<tr class="wight">
					<td class="subject" colspan="1">VALUE EDUCATION <?php //echo $arrco[1];?></td>
					<?php 
								$this->db->where('subject_id',$arrco[1]);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',28);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
								$this->db->where('subject_id',$arrco[1]);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',30);
								$this->db->where('fsd',$fsd);
						$marksa=$this->db->get('exam_info');
							if(($marks->num_rows()>0) || ($marksa->num_rows()>0)){
							if($marks->num_rows()>0){
							$marks=$marks->row();
						$marks->marks;
						?>
					<td colspan="3" style="text-transform: uppercase;"><?= discriptiveindicator($marks->marks);?></td>
					<td style="text-transform: uppercase;"><?php echo calculateGrade1($marks->marks,$classid)?></td>
						<?php }else{ ?>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
							<?php } if($marksa->num_rows()>0){
								$marksa = $marksa->row();	?>
					<td colspan="3" style="text-transform: uppercase;"><?= discriptiveindicator($marksa->marks);?></td>
             		<td style="text-transform: uppercase;"><?php echo calculateGrade1($marksa->marks,$classid)?></td>
														<?php }else{?>
             		<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
																<?php } 
																				}else{?>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
																			<?php	} ?>
             	<?php if(($classid==98)||($classid==99)||($classid== 116)){?>
					<td rowspan="8" colspan="2"> </td>
					<?php }else{?>
					<td rowspan="7" colspan="2"> </td>
				<tr class="wight">
					<td class="subject" colspan="1" >WORK EDUCATION <?php //echo $arrco[2];?></td>
					<?php 
							$this->db->where('subject_id',$arrco[2]);
							$this->db->where('class_id',$classid);
							$this->db->where('stu_id',$studentInfo->id);
							$this->db->where('exam_id',28);
							$this->db->where('fsd',$fsd);
					$marks= $this->db->get('exam_info');
							$this->db->where('subject_id',$arrco[2]);
							$this->db->where('class_id',$classid);
							$this->db->where('stu_id',$studentInfo->id);
							$this->db->where('exam_id',30);
							$this->db->where('fsd',$fsd);
						$marksa= $this->db->get('exam_info');

							if(($marks->num_rows()>0) || ($marksa->num_rows()>0)){
							if($marks->num_rows()>0){
							$marks=$marks->row();
						$marks->marks;
						?>
					<td colspan="3" style="text-transform: uppercase;"><?= discriptiveindicator($marks->marks);?></td>
					<td style="text-transform: uppercase;"><?php echo calculateGrade1($marks->marks,$classid)?></td>
						<?php }else{ ?>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
						<?php }
						if($marksa->num_rows()>0){$marksa = $marksa->row();	?>
					<td colspan="3"><?= discriptiveindicator($marksa->marks);?></td>

             		<td style="text-transform: uppercase;"><?php echo calculateGrade1($marksa->marks,$classid)?></td>
             		

             		<?php }else{?>
             		<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
             		<?php }}else{?>
             		<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
             	<?php	} ?>
			</tr>
             	<?php } ?>
		</tr>
		<tr class="wight">
		                 	<?php if(($classid==98)||($classid==99)||($classid== 116)){?>
					<td class="subject" colspan="1">ART EDUCATION <?php //echo $arrco[3];?></td>
             	<?php }else{?>
					<td class="subject" colspan="1">ART/URDU <?php //echo $arrco[3];?></td>
             	<?php } ?>
						<?php 
								$this->db->where('subject_id',$arrco[3]);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',28);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
								$this->db->where('subject_id',$arrco[3]);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',30);
								$this->db->where('fsd',$fsd);
						$marksa= $this->db->get('exam_info');
							if(($marks->num_rows()>0) || ($marksa->num_rows()>0)){
							if($marks->num_rows()>0){
							$marks=$marks->row();
						$marks->marks;
						?>
					<td colspan="3"><?= discriptiveindicator($marks->marks);?></td>
					<td><?php echo calculateGrade1($marks->marks,$classid)?></td>
						<?php }else{ ?>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
							<?php } if($marksa->num_rows()>0){
								$marksa = $marksa->row();	?>
					<td colspan="3"><?= discriptiveindicator($marksa->marks);?></td>
             		<td><?php echo calculateGrade1($marksa->marks,$classid)?></td>
														<?php }else{?>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
																<?php }}else{?>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
             	<?php	} ?>
		   </tr>
		  
			<?php if(($classid==98)||($classid==99)||($classid== 116)){?>
		   <tr class="wight">
					<td class="subject" colspan="1">SENSORIAL ACTIVITIES <?php //echo $arrco[4];?></td>
						<?php 
								$this->db->where('subject_id',$arrco[4]);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',28);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
								$this->db->where('subject_id',$arrco[4]);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',30);
								$this->db->where('fsd',$fsd);
						$marksa=$this->db->get('exam_info');
							if(($marks->num_rows()>0) || ($marksa->num_rows()>0)){
							if($marks->num_rows()>0){
							$marks=$marks->row();
						$marks->marks;
						?>
					<td colspan="3"><?= discriptiveindicator($marks->marks);?></td>
					<td><?php echo calculateGrade1($marks->marks,$classid)?></td>
						<?php }else{ ?>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
						<?php }
						if($marksa->num_rows()>0){$marksa = $marksa->row();	?>
					<td colspan="3"><?= discriptiveindicator($marksa->marks);?></td>
             		<td><?php echo calculateGrade1($marksa->marks,$classid)?></td>
             		<?php }else{?>
             		<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
             		<?php }}else{?>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
             	<?php	} ?>
				
		</tr>
		<tr class="wight">
					<td class="subject" colspan="1">HEALTH & PHYSICAL EDUCATION <?php //echo $arrco[5];?></td>
						<?php 
								$this->db->where('subject_id',$arrco[5]);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',28);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
								$this->db->where('subject_id',$arrco[5]);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',30);
								$this->db->where('fsd',$fsd);
						$marksa= $this->db->get('exam_info');
							if(($marks->num_rows()>0) || ($marksa->num_rows()>0)){
							if($marks->num_rows()>0){
							$marks=$marks->row();
						$marks->marks;
						?>
					<td colspan="3"><?= discriptiveindicator($marks->marks);?></td>
					<td><?php echo calculateGrade1($marks->marks,$classid)?></td>
												<?php }else{ ?>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
													<?php } if($marksa->num_rows()>0){
														$marksa = $marksa->row();	?>
					<td colspan="3"><?= discriptiveindicator($marksa->marks);?></td>
             		<td><?php echo calculateGrade1($marksa->marks,$classid)?></td>
																				<?php }else{?>
             		<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
																					<?php }   }else{ ?>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
																							<?php	} ?>
			</tr>
																			<?php } ?>
			<?php if(($classid==98)||($classid==99)||($classid== 116)){?>
			<tr class="tableHeader">
				<td colspan="2">Height & Weight</td>
				<!--<td colspan="3"><?= $studentInfo->height; ?></td>-->
				<!--<td colspan="4"><?= $studentInfo->weight; ?></td>-->
				<td colspan="7">&nbsp;</td>
			</tr>
			<?php } ?>
			<tr class="wight">
					<td colspan="1" class="subject">DISCIPLINE</td>
							<?php $this->db->where('subject_id',$arrco[6]);
					$this->db->where('class_id',$classid);
					$this->db->where('stu_id',$studentInfo->id);
					$this->db->where('exam_id',28);
					$this->db->where('fsd',$fsd);
					
						$marks= $this->db->get('exam_info');
						
						$this->db->where('subject_id',$arrco[6]);
					$this->db->where('class_id',$classid);
					$this->db->where('stu_id',$studentInfo->id);
					$this->db->where('exam_id',30);
					$this->db->where('fsd',$fsd);
						$marksa= $this->db->get('exam_info');
							if(($marks->num_rows()>0) || ($marksa->num_rows()>0)){
							if($marks->num_rows()>0){
							$marks=$marks->row();
						$marks->marks;
						?>
					<td colspan="3"><?= discriptiveindicator($marks->marks);?></td>
					<td><?php echo calculateGrade1($marks->marks,$classid)?></td>
						<?php }else{
						?>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
						<?php }
						if($marksa->num_rows()>0){$marksa = $marksa->row();	?>
					<td colspan="3"><?= discriptiveindicator($marksa->marks);?></td>
             		<td><?php echo calculateGrade1($marksa->marks,$classid)?></td>
             		<?php }else{?>
             		<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
             		<?php }}else{?>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
             	<?php	} ?>
				
		</tr>
		<tr class="blue">
			<td colspan="2">ATTENDANCE  </td>
			<td colspan="3">MARK PERCENTAGE  <?php //echo $totalp;  
			echo round((($cumulativetotal*100)/$dhtm), 2);?>%  </td>
			<td colspan="4">CLASS RANK : <?php 
			echo $this->exammodel->getClassRank($studentInfo->id, $classid, $fsd);?></br></br></br>
			SCHOOL RANK : <?php 
			echo $this->exammodel->getSchoolRank($studentInfo->id,  $fsd);?></td>
		</tr>
		<!---dds manner marks table end--->
		<?php }else if($school == 1 && $row2== "A"){ ?>
		<!---mla marks table start--->
		<tr class="tableHeader">
			<td class="center" colspan="2" >A SCHOLASTIC AREAS</td>
			<td class="center" colspan="3">TERM - 1</td>
			<td class="center" colspan="3">TERM - 2</td>
			<td class="center" colspan="3">TERM - 3</td>
			<td colspan="4">Cumulative Evaluation</td>
		</tr>
		
		
		<tr class="yellow">
			<td colspan="2" rowspan="2">SUBJECT</td>
			<?php
				    $dhtm=0;
				    $i=1; 
				    $arrco[1]=0;
				    $arrco[2]=0;
				    $arrco[3]=0;
				    $arrco[4]=0;
				    $arrco[5]=0;
					$arrco[6]=0; 
			?>
			<!---1st term exam name start--->
			<?php  if($examid->num_rows()==0){?>
			<td colspan="3" ></td>
			<?php }else{
            foreach ($examid->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',1);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');   
             if ($examname->num_rows()>0){
             $examname=$examname->row();	?>  
			<td colspan="3" ><?php echo $examname->exam_name;?></td>
								<?php  }else{ ?>  
			<td colspan="3" ></td>					<?php } ?>
            <?php $i++; endforeach ; } ?>
			<!---1st term exam name end--->
			<!---2nd term exam name start--->
			<?php  if($examid_2->num_rows()==0){?>
			<td colspan="3" ></td>
			<?php }else{
           foreach ($examid_2->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',2);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');		 
             if ($examname->num_rows()>0){
             $examname=$examname->row(); ?>  
			<td colspan="3" ><?php echo $examname->exam_name;?></td>
									<?php }else{ ?>  
			<td colspan="3" ></td>
										<?php } ?>
            
 			<?php $i++; endforeach ; }?>
			<!---2nd term end--->
			<!---3rd term exam name start--->
			<?php   if($examid_3->num_rows()==0){?><td colspan="3" ></td><?php }else{
			foreach ($examid_3->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',3);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');   
             if ($examname->num_rows()>0){
             $examname=$examname->row();
             	?>  
			<td colspan="3" ><?php echo $examname->exam_name;?>
			</td>
            <?php 						}else{ ?>  
			<td colspan="3" ></td>
										<?php } ?>
            
 			<?php $i++; endforeach ; }?>
			<!---3rd term exam name end--->
			<td colspan="2" class="text-center" rowspan="2">Cumulative Marks <?php echo "[220]";?></td>
			<td colspan="2" rowspan="2">Grade </td>
		</tr>
		<tr class="yellow">
			<td class="center" >WRITTEN</td>
			<td class="center" >ORAL</td>
			<td class="center" >TOTAL</td>
			<td class="center" >WRITTEN</td>
			<td class="center" >ORAL</td>
			<td class="center" >TOTAL</td>
			<td class="center" >WRITTEN</td>
			<td class="center" >ORAL</td>
			<td class="center" >TOTAL</td>
		</tr>
		<?php 
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
			$pi=1;$grnd_1=0;$grnd_2=0;$grnd_3=0;
			foreach($resultData as $sub):
			?><?php 
							 $this->db->where('class_id',$classid);
							 $this->db->where('id',$sub['subject']);
				$subjectname=$this->db->get('subject'); 
                    if($subjectname->num_rows()>0){
                        $subjectname=$subjectname->row();
                    if(($subjectname->subject == "VALUE EDUCATION") || ($subjectname->subject =="WORK EDUCATION") || ($subjectname->subject == "ART/URDU")||($subjectname->subject == "SENSORIAL ACTIVITIES" ) || ($subjectname->subject == "HEALTH & PHYSICAL EDUCATION" )|| ($subjectname->subject == "DISCIPLINE" )){
                   if($subjectname->subject == "VALUE EDUCATION"){
                   $arrco[1]= $subjectname->id;
                   $pi=$pi+1;
                   }
                   if($subjectname->subject == "WORK EDUCATION"){
                   $arrco[2]= $subjectname->id;
                    $pi=$pi+1;
                   }
                   if($subjectname->subject == "ART/URDU"){
                   $arrco[3]= $subjectname->id;
                    $pi=$pi+1;
                   }
                   if($subjectname->subject == "SENSORIAL ACTIVITIES"){
                   $arrco[4]= $subjectname->id;
                    $pi=$pi+1;
                   }
                     if($subjectname->subject == "HEALTH & PHYSICAL EDUCATION"){
                   $arrco[5]= $subjectname->id;
                    $pi=$pi+1;
                   }
                   
                   if($subjectname->subject == "DISCIPLINE"){
                   $arrco[6]= $subjectname->id;
                    $pi=$pi+1;
                   }
                 
                    }else{ $totalp+=200;?>
		<tr class="wight"> 
					<td class="subject" colspan="2" >	
                     <?php echo  $subjectname->subject;
                       ?> 
					</td>
			     <?php 
                 $gtptal=0;
                 $subtatal=0;
		         $i=1; $t=0; $coltptal=0;  ?>
				 <?php  if($examid->num_rows()==0){?><td></td><td></td><td></td><?php }else{
				 foreach ($examid->result() as $value): ?>
		
					<td> 
					<?php  // echo "hh";
					            $this->db->where("term", 1);
								$this->db->where('subject_id',$subjectname->id);
								$this->db->where('sub_type',1);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
				// 		print_r($marks->result());
						if($marks->num_rows()>0){
							$marks=$marks->row();
							$subtatal=$subtatal+$marks->marks;
							$gtptal= $gtptal+$marks->marks;
							$coltptal+=$marks->marks;
							echo $marks->marks;
							$ctotal[$t]+= $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
							$this->db->where('sub_type',1);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				 
				 echo "/".$exammm;
				 
				 $dhtm=$exammm+$dhtm;
						} ?>
					</td>
					<td>
					<?php  // echo "hh";
					            $this->db->where("term", 1);
								$this->db->where('subject_id',$subjectname->id);
								$this->db->where('sub_type',0);
								$this->db->where('class_id',$classid);
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
							$this->db->where('sub_type',0);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				 echo "/".$exammm;
				 $dhtm=$exammm+$dhtm;
						} ?>
					</td>
					<td><?= $gtptal ;?></td>
					<?php //} ?>
				
				<?php 
				 $i++; $t++; endforeach; }
				?>
				<!--<td class="center bold"><?php // $rty = $gtptal/2; echo $gtptal;  ?></td>	-->
				<!--1st term marks end-->
				<!--2nd term marks start-->
				 <?php 
                 $gtptal_2=0;
                 $subtatal=0;
		         $i=1; $t=0; $coltptal=0;  ?>
				 <?php  if($examid_2->num_rows()==0){?><td ></td><td></td><td></td><?php }else{
				 foreach ($examid_2->result() as $value):?>
					<td> 
					<?php  // echo "hh";
					            $this->db->where("term", 2);
								$this->db->where('subject_id',$subjectname->id);
								$this->db->where('sub_type',1);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
				// 		print_r($marks->result());
						if($marks->num_rows()>0){
							$marks=$marks->row();
							$subtatal=$subtatal+$marks->marks;
							$gtptal_2= $gtptal_2+$marks->marks;
							$coltptal+=$marks->marks;
							echo $marks->marks;
							$ctotal[$t]+= $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
							$this->db->where('sub_type',1);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				 
				 echo "/".$exammm;
				 
				 $dhtm=$exammm+$dhtm;
						} ?>
					</td>
					<td>
					<?php  // echo "hh";
					            $this->db->where("term", 2);
								$this->db->where('subject_id',$subjectname->id);
								$this->db->where('sub_type',0);
								$this->db->where('class_id',$classid);
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
							$this->db->where('sub_type',0);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				 echo "/".$exammm;
				 $dhtm=$exammm+$dhtm;
						} ?>
					</td>
					<td><?= $gtptal_2 ;?></td>
					<?php //} ?>
				
				<?php 
				 $i++; $t++;endforeach;}
				?>
				<!--<td class="center bold"><?php  //$rty = $gtptal_2/2; echo $gtptal_2;  ?></td>-->
				<!--2nd term marks end-->
				<!--3rd term marks start-->
				 <?php 
                 $gtptal_3=0;
                 $subtatal=0;
		         $i=1; $t=0; $coltptal=0;?>
				 <?php  if($examid_3->num_rows()==0){?><td ></td><td></td><td></td><?php }else{
				 foreach ($examid_3->result() as $value):?>
					<td> 
					<?php  // echo "hh";
					            $this->db->where("term", 3);
								$this->db->where('subject_id',$subjectname->id);
								$this->db->where('sub_type',1);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
				// 		print_r($marks->result());
						if($marks->num_rows()>0){
							$marks=$marks->row();
							$subtatal=$subtatal+$marks->marks;
							$gtptal= $gtptal+$marks->marks;
							$coltptal+=$marks->marks;
							echo $marks->marks;
							$ctotal[$t]+= $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
							$this->db->where('sub_type',1);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				 
				 echo "/".$exammm;
				 
				 $dhtm=$exammm+$dhtm;
						} ?>
					</td>
					<td>
					<?php  // echo "hh";
					            $this->db->where("term", 3);
								$this->db->where('subject_id',$subjectname->id);
								$this->db->where('sub_type',0);
								$this->db->where('class_id',$classid);
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
							$this->db->where('sub_type',0);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				 echo "/".$exammm;
				 $dhtm=$exammm+$dhtm;
						} ?>
					</td>
					<td><?= $gtptal ;?></td>
					<?php //} ?>
				
				<?php 
				 $i++; $t++;endforeach;}
				
				?>
				<!--<td class="center bold"><?php // $rty = $gtptal_3/2; echo $gtptal_3;  ?></td>-->
				<!--3rd term marks end-->
				<!--Cumulative Evaluation start-->
				<td class="center bold" colspan="2"><?php   echo $gtptal_grand= $gtptal+$gtptal_2+$gtptal_3;
				 $grnd_1=$grnd_1+$gtptal;
				 $grnd_2=$grnd_2+$gtptal_2;
				 $grnd_3=$grnd_3+$gtptal_3;
				?></td>
			   <td class="center bold" colspan="2"><?php //echo calculateGrade($gtptal_grand,$classid)?></td>
			   <!--Cumulative Evaluation end-->
				
		</tr>
					<?php } 					}endforeach;?>
		<tr class="wight">
				<td class="subject" colspan="2" >GRAND TOTAL</td>
				<?php 
				$h=1;$i=0; 
				foreach($ctotal as $cd):
					if($h<2){ ?>
					<td class="center" ></td>
					<td class="center" ></td>
					<td class="center" ><?php echo $grnd_1;?></td>
						<td class="center" ></td>
					<td class="center" ></td>
					<td class="center" ><?php echo $grnd_2;?></td>
						<td class="center" ></td>
					<td class="center" ></td>
					<td class="center"  ><?php echo $grnd_3;?></td>
					<?php  $cumulativetotal+=$ctotal[$i]; $h++; $i++; 
							} 
				endforeach;	
				?>
				<td class="center bold" colspan="2"><?php echo $cumulativetotal;?></td>
				<td class="center bold" colspan="2"></td>
		</tr>
		<tr class="tableHeader">	
			<td colspan="2" style="text-transform: uppercase;">B. CO-Scholastic Areas</td>
			<td colspan="2" style="text-transform: uppercase;">Descriptive Indicators</td>
			<td>Grade</td>
			<td colspan="2" style="text-transform: uppercase;">Descriptive Indicators</td>
			<td>Grade</td>
			<td colspan="2" style="text-transform: uppercase;">Descriptive Indicators</td>
			<td>Grade</td>
			<td colspan="4" rowspan="5" class="pink" style="text-transform: uppercase;">Class Teachers Remark</td>
		</tr>
		<tr class="wight">
					<td class="subject" colspan="2">VALUE EDUCATION<?php //echo $arrco[1];?></td>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
		</tr>
		<tr class="wight">
					<td class="subject" colspan="2" >WORK EDUCATION <?php //echo $arrco[2];?></td>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
             		<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
		</tr>
		<tr class="wight">
					<td class="subject" colspan="2">HEALTH & PHYSICAL EDUCATION <?php //echo $arrco[5];?></td>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
		</tr>
		<tr class="wight">
					<td colspan="2" class="subject">DISCIPLINE</td>
					<?php   if($examid->num_rows()==0){?><td colspan="3" ></td><?php }else{
							foreach ($examid->result() as $value):
							$this->db->where("term", 1);
											$this->db->where('subject_id',$sub['subject']);
											$this->db->where('class_id',$classid);
											$this->db->where('stu_id',$studentInfo->id);
											$this->db->where('exam_id',$value->exam_id);
											$this->db->where('fsd',$fsd);
									$marks= $this->db->get('exam_info');
									if(($marks->num_rows()>0)){ 
										if($marks->num_rows()>0){
										$marks=$marks->row();
										$marks->marks;
					?>
					<td colspan="3"><?php //echo discriptiveindicator($marks->marks);?></td>
														<?php }else{ ?>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
															<?php }?>
														<?php }else{?>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
					<?php	} endforeach;}?>
					<?php  if($examid_2->num_rows()==0){?><td colspan="3" ></td><?php }else{
						foreach ($examid_2->result() as $value):
						$this->db->where("term", 2);
										$this->db->where('subject_id',$sub['subject']);
										$this->db->where('class_id',$classid);
										$this->db->where('stu_id',$studentInfo->id);
										$this->db->where('exam_id',$value->exam_id);
										$this->db->where('fsd',$fsd);
								$marks= $this->db->get('exam_info');
								if(($marks->num_rows()>0)){ 
									if($marks->num_rows()>0){
									$marks=$marks->row();
									$marks->marks;
					?>
					<td colspan="3"><?php // discriptiveindicator($marks->marks);?></td>
					<td><?php //echo calculateGrade1($marks->marks,$classid)?></td>
														<?php }else{ ?>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
															<?php }?>
														<?php }else{?>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
					<?php	} endforeach;}?>
					<?php  if($examid_3->num_rows()==0){?><td colspan="3" ></td><?php }else{
						foreach ($examid_3->result() as $value):
										$this->db->where("term",3);
										$this->db->where('subject_id',$sub['subject']);
										$this->db->where('class_id',$classid);
										$this->db->where('stu_id',$studentInfo->id);
										$this->db->where('exam_id',$value->exam_id);
										$this->db->where('fsd',$fsd);
								$marks= $this->db->get('exam_info');
								if(($marks->num_rows()>0)){ 
									if($marks->num_rows()>0){
									$marks=$marks->row();
									$marks->marks;
					?>
					<td colspan="3"><?php // discriptiveindicator($marks->marks);?></td>
					<td><?php //echo calculateGrade1($marks->marks,$classid)?></td>
														<?php }else{ ?>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
															<?php }?>
														<?php }else{?>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
					<?php	} endforeach;}?>
				
		</tr>
		<tr class="blue">
			<td colspan="2">ATTENDANCE  </td>
			<td colspan="6">MARK PERCENTAGE  <?php  
			echo round((($cumulativetotal*100)/$dhtm), 2);?>%  </td>
			<td colspan="6">RANK</td>
		</tr>
		<!---mla marks table end--->
		<?php }else if($school == 6 && $row2== "A"){ ?>
		<!---samrat ashok marks table start--->
		<tr class="tableHeader">
			<td class="center" colspan="4" >A SCHOLASTIC AREAS</td>
			<td class="center" colspan="2">TERM - 1</td>
			<td class="center" colspan="2">TERM - 2</td>
			<td class="center" colspan="2">TERM - 3</td>
			<td class="center" colspan="2">Overall</td>
		</tr>
		<tr class="yellow">
			<td colspan="4" >SUBJECT</td>
			<?php
				    $dhtm=0;
				    $i=1; 
				    $arrco[1]=0;
				    $arrco[2]=0;
				    $arrco[3]=0;
				    $arrco[4]=0;
				    $arrco[5]=0;
					$arrco[6]=0; 
			?>
			 <!--1st term -->
			<?php  if($examid->num_rows()==0){ ?>
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
			<?php } ?>
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
			<?php } ?>
			<!--2nd term exam name end-->
			<!---3rd term exam name start--->
			<?php  if($examid_3->num_rows()==0){ ?>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;"></td>
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;"></td>
			<?php }else if($examid_3->num_rows()==1){ ?>
						<?php 
							$i=1;
							 foreach ($examid_3->result() as $value):
							   $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							    $this->db->where('term',3);
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
							 foreach ($examid_3->result() as $value):
							   $examid1=$value->exam_id;	
							   $this->db->where('id',$examid1);
							    $this->db->where('term',3);
							   $examname=$this->db->get('exam_name');   
							   if ($examname->num_rows()>0){
							   $examname=$examname->row();
						?> 
						<td colspan="1" style="text-transform: uppercase; font-weight:bold;"><?php echo $examname->exam_name; ?></td>
                        <?php 
						}
						$i++;
						endforeach ; ?>
			<?php } ?>
			<!---3rd term exam name end--->
			<!---overall start--->
			<td  class="text-center" colspan="2">Obtain Marks</td>
			<!---overall end--->
		</tr>
		<?php 
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
							 $this->db->where('class_id',$classid);
							 $this->db->where('id',$sub['subject']);
				$subjectname=$this->db->get('subject'); 
                    if($subjectname->num_rows()>0){
                        $subjectname=$subjectname->row();
                   $totalp+=200;?>
		<tr class="wight"> 
					<td class="subject" colspan="4" ><?php echo  $subjectname->subject; ?> </td>
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
								$this->db->where('class_id',$classid);
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
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				 echo "/".$exammm;
				 $dhtm=$exammm+$dhtm;			
				  if(is_numeric($exammm)){
					  $ttal=$ttal+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal= $ttal;
					 $dhtm= $dhtm;   
					}
				 } ?>
					</td>
					<td></td>
				<?php  $i++; $t++; endforeach; ?>
				 <?php }else{ ?>
				 <?php foreach ($examid->result() as $value): ?>
					<td><?php  
					            $this->db->where("term", 1);
								$this->db->where('subject_id',$subjectname->id);
								$this->db->where('class_id',$classid);
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
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				 echo "/".$exammm;
				 $dhtm=$exammm+$dhtm;	
if(is_numeric($exammm)){
					  $ttal=$ttal+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal= $ttal;
					 $dhtm= $dhtm;   
					}
				 } ?>
					</td>
				<?php  $i++; $t++; endforeach; ?>
				<?php } ?>
				<!--1st term marks end-->
				<!--2nd term marks start-->
				 <?php 
                 $gtptal_2=0;
                 $subtatal=0;
		         $i=1; $t=0; $coltptal=0; $ttal_2=0; ?>
				 <?php  if($examid_2->num_rows()==0){?>
					<td></td><td></td>
				 <?php }else if($examid_2->num_rows()==1){ ?>
				 
					<?php foreach ($examid_2->result() as $value): ?>
					<td><?php  
					            $this->db->where("term", 2);
								$this->db->where('subject_id',$subjectname->id);
								$this->db->where('class_id',$classid);
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
							$ctotal_2[$t]+= $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				 echo "/".$exammm;
				 $dhtm=$exammm+$dhtm;		
 if(is_numeric($exammm)){
					  $ttal_2=$ttal_2+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal_2= $ttal_2;
					 $dhtm= $dhtm;   
					}
				 } ?>
					</td>
					<td></td>
				<?php  $i++; $t++; endforeach; ?>
				 <?php }else{ ?>
				 <?php foreach ($examid_2->result() as $value): ?>
					<td><?php  
					            $this->db->where("term", 2);
								$this->db->where('subject_id',$subjectname->id);
								$this->db->where('class_id',$classid);
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
							$ctotal_2[$t]+= $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				 echo "/".$exammm;
				 $dhtm=$exammm+$dhtm;	
 if(is_numeric($exammm)){
					  $ttal_2=$ttal_2+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal_2= $ttal_2;
					 $dhtm= $dhtm;   
					}
				 } ?>
					</td>
				<?php  $i++; $t++; endforeach; ?>
				<?php } ?>
				<!--2nd term marks end-->
				<!--3rd term marks start-->
				 <?php 
                 $gtptal_3=0;
                 $subtatal=0;
		         $i=1; $t=0; $coltptal=0; $ttal_3=0; ?>
				 <?php  if($examid_3->num_rows()==0){?>
					<td></td><td></td>
				 <?php }else if($examid_3->num_rows()==1){ ?>
					<?php foreach ($examid_3->result() as $value): ?>
					<td><?php  
					            $this->db->where("term", 3);
								$this->db->where('subject_id',$subjectname->id);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();
							$subtatal=$subtatal+$marks->marks;
							$gtptal_3= $gtptal_3+$marks->marks;
							$coltptal+=$marks->marks;
							echo $marks->marks;
							$ctotal_3[$t]+= $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				 echo "/".$exammm;
				 $dhtm=$exammm+$dhtm;		
				if(is_numeric($exammm)){
					  $ttal_3=$ttal_3+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal_3= $ttal_3;
					 $dhtm= $dhtm;   
					}
				 } ?>
					</td>
					<td></td>
				<?php  $i++; $t++; endforeach; ?>
				 <?php }else{ ?>
				 <?php foreach ($examid_3->result() as $value): ?>
					<td><?php  
					            $this->db->where("term", 3);
								$this->db->where('subject_id',$subjectname->id);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();
							$subtatal=$subtatal+$marks->marks;
							$gtptal_3= $gtptal_3+$marks->marks;
							$coltptal+=$marks->marks;
							echo $marks->marks;
							$ctotal_3[$t]+= $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				 echo "/".$exammm;
				 $dhtm=$exammm+$dhtm;	
				if(is_numeric($exammm)){
					  $ttal_3=$ttal_3+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal_3= $ttal_3;
					 $dhtm= $dhtm;   
					}
				 } ?>
					</td>
				<?php  $i++; $t++; endforeach; ?>
				<?php } ?>
				<!--3rd term marks end-->
				<!--Cumulative Evaluation start-->
				<td class="center bold" colspan="2" ><?php   echo $gtptal_grand= $gtptal+$gtptal_2+$gtptal_3;
				$g_ttal=$ttal + $ttal_2 + $ttal_3;
				echo "/".$g_ttal;
				 $grnd_1=$grnd_1+$gtptal;
				 $grnd_2=$grnd_2+$gtptal_2;
				 $grnd_3=$grnd_3+$gtptal_3;
				 $grndt_1=$grndt_1+$ttal;
				 $grndt_2=$grndt_2+$ttal_2;
				 $grndt_3=$grndt_3+$ttal_3;
				?></td>
			   <!--Cumulative Evaluation end-->
		</tr>
					<?php  					}endforeach;?>
		
		<tr class="wight">
					<td class="subject" colspan="4" >GRAND TOTAL</td>
					<?php $h=1;$i=0; foreach($ctotal as $cd):
					if($h<3){?>
					<td class="center">
					<?php echo $ctotal[$i];  ?>
					</td>
					<?php $h++; $i++; } endforeach;	
					?>
					
					<?php $h=1;$i=0; foreach($ctotal_2 as $cd):
					if($h<3){?>
					<td class="center">
					<?php echo $ctotal_2[$i];  ?>
					</td>
					<?php $h++; $i++; } endforeach;	
					?>
					
					<?php $h=1;$i=0; foreach($ctotal_3 as $cd):
					if($h<3){?>
					<td class="center">
					<?php echo $ctotal_3[$i];  ?>
					</td>
					<?php $h++; $i++; } endforeach;	
					?>
			<td class="center bold"><?php echo $a= $grnd_1+$grnd_2+$grnd_3;?></td>
		</tr>
		
		
		
		<tr class="blue">
			<td colspan="2">ATTENDANCE  </td>
			<td colspan="6">MARK PERCENTAGE  <?php   
			$b=$grndt_1+$grndt_2+$grndt_3;


			if($b>0){
			echo round((($a*100)/$b), 2);
			}else{
			    echo "0.00";
			}
			?>%  </td>
		<td colspan="6">Class Rank:<?php 
			echo $this->exammodel->getClassRank($studentInfo->id, $classid->class_id, $fsd);?></td>


		</tr>
		<!---samrat ashok marks table end--->
		<?php }else if($school == 1 && $row2== "D" || $school == 2 && $row2== "D" || $school == 3 && $row2== "D" || $school == 4 && $row2== "D"){ ?>
		<!---kerala marks table start--->
		<tr class="tableHeader">
			<td class="center" colspan="1" >A. SCHOLASTIC AREAS</td>
			<td class="center" colspan="4">TERM - 1</td>
			<td class="center" colspan="4">TERM - 2</td>
			<td colspan="2">Cumulative Evaluation</td>
		</tr>
		<tr class="yellow">
			<td>SUBJECT</td>
			<?php
			$ctotalmo=array();
			$ctotalmo[0]=0;
			$ctotalmo[1]=0;
			$ctotalmo[3]=0;
			$ctotalmo[2]=0;
			$ctotalmo2=array();
			$ctotalmo2[0]=0;
			$ctotalmo2[1]=0;
			$ctotalmo2[3]=0;
			$ctotalmo2[2]=0;
			$ctotalmo2[4]=0;
            $dhtm=0;
            $dhtm1=0;
            $dhtm12=0;
           $i=1; $arrco[1]=0;
           $arrco[2]=0;
           $arrco[3]=0;
           $arrco[4]=0;
           $arrco[5]=0;
            $arrco[6]=0;?>
			<!---1st term exam name start--->
			<?php     if($examid->num_rows()==0){?><td colspan="1" ></td><td colspan="1" ></td><td colspan="1" ></td>
											<?php }else if($examid->num_rows()==1){ ?>
          <?php foreach ($examid->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',1);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');		 
             if ($examname->num_rows()>0){
             $examname=$examname->row();
             	?>  
			<td colspan="1" ><td colspan="1" ></td>
			<?php echo $examname->exam_name; ?><?php
							if($examid1== 20 || $examid1== 14|| $examid1== 11|| $examid1== 17){
         	    echo "[20]";
                        	}else if($examid1== 21 ||$examid1== 15 || $examid1== 12 ||$examid1== 18){
         	                        echo "[50]";  }else{
         	                                        echo "[100]";
         	                                             }
			?>
			</td>
									<?php }else{ ?>  
			<td colspan="1" ></td>			<?php } ?>
 			<?php $i++; endforeach ; ?><td colspan="1" ></td><td colspan="1" ></td>
			
			<?php }else if($examid->num_rows()==2){ ?>
          <?php foreach ($examid->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',1);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');		 
             if ($examname->num_rows()>0){
             $examname=$examname->row();
             	?>  
			<td colspan="1" ><td colspan="1" ></td>
			<?php echo $examname->exam_name; ?><?php
							if($examid1== 20 || $examid1== 14|| $examid1== 11|| $examid1== 17){
         	    echo "[20]";
                        	}else if($examid1== 21 ||$examid1== 15 || $examid1== 12 ||$examid1== 18){
         	                        echo "[50]";  }else{
         	                                        echo "[100]";
         	                                             }
			?>
			</td>
									<?php }else{ ?>  
			<td colspan="1" ></td>			<?php } ?>
 			<?php $i++; endforeach ; ?><td colspan="1" ></td>
			<?php }else{ ?>
			<?php foreach ($examid->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',1);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');		 
             if ($examname->num_rows()>0){
             $examname=$examname->row();
             	?>  
			<td colspan="1" >
			<?php echo $examname->exam_name; ?><?php
							if($examid1== 20 || $examid1== 14|| $examid1== 11|| $examid1== 17){
         	    echo "[20]";
                        	}else if($examid1== 21 ||$examid1== 15 || $examid1== 12 ||$examid1== 18){
         	                        echo "[50]";  }else{
         	                                        echo "[100]";
         	                                             }
			?>
			</td>
									<?php }else{ ?>  
			<td colspan="1" ></td>			<?php } ?>
 			<?php $i++; endforeach ; ?>
			<?php } ?>
			<td class="center bold">Grade</td> 
			<!---1st term exam name end--->
   <!---2nd term exam name start--->
			<?php     if($examid_2->num_rows()==0){?><td colspan="1" ></td><td colspan="1" ></td><td colspan="1" ></td>
											<?php }else if($examid_2->num_rows()==1){  ?>
          <?php foreach ($examid_2->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',2);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');		 
             if ($examname->num_rows()>0){
             $examname=$examname->row();
             	?>  
			<td colspan="1" >
			<?php echo $examname->exam_name; ?><?php
							if($examid1== 20 || $examid1== 14|| $examid1== 11|| $examid1== 17){
         	    echo "[20]";
                        	}else if($examid1== 21 ||$examid1== 15 || $examid1== 12 ||$examid1== 18){
         	                        echo "[50]";  }else{
         	                                        echo "[100]";
         	                                             }
			?>
			</td>
									<?php }else{ ?>  
			<td colspan="1" ></td>			<?php } ?>
 			<?php $i++; endforeach ; ?>
			<td colspan="1" ></td><td colspan="1" ></td>
			<?php }else if($examid_2->num_rows()==2){ ?>
          <?php foreach ($examid_2->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',2);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');		 
             if ($examname->num_rows()>0){
             $examname=$examname->row();
             	?>  
			<td colspan="1" >
			<?php echo $examname->exam_name; ?><?php
							if($examid1== 20 || $examid1== 14|| $examid1== 11|| $examid1== 17){
         	    echo "[20]";
                        	}else if($examid1== 21 ||$examid1== 15 || $examid1== 12 ||$examid1== 18){
         	                        echo "[50]";  }else{
         	                                        echo "[100]";
         	                                             }
			?>
			</td>
									<?php }else{ ?>  
			<td colspan="1" ></td>			<?php } ?>
 			<?php $i++; endforeach ; ?><td colspan="1" ></td>
			<?php }else{ ?>
			<?php foreach ($examid_2->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',2);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');		 
             if ($examname->num_rows()>0){
             $examname=$examname->row();
             	?>  
			<td colspan="1" >
			<?php echo $examname->exam_name; ?><?php
							if($examid1== 20 || $examid1== 14|| $examid1== 11|| $examid1== 17){
         	    echo "[20]";
                        	}else if($examid1== 21 ||$examid1== 15 || $examid1== 12 ||$examid1== 18){
         	                        echo "[50]";  }else{
         	                                        echo "[100]";
         	                                             }
			?>
			</td>
									<?php }else{ ?>  
			<td colspan="1" ></td>			<?php } ?>
 			<?php $i++; endforeach ; ?>
			<?php } ?>
			<td class="center bold">Grade</td> 
			<!---2nd term exam name end--->
			<td colspan="1" class="text-center">Cumulative Marks<?php if(($classid==98)||($classid==99)||($classid== 116)){echo "[100]";}else{echo "[200]";}?></td>
			<td colspan="1">Grade</td>
		</tr>
		<?php 
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
			$ctotal1 =array();
            $ctotal1[0]=0;
            $ctotal1[1]=0;
			$ctotal1[2]=0;
			$ctotal1[3]=0;
            $ctotal1["tot2"]=0;
			$cumulativetotal=0;
			$cumulativetotal1=0;
		   $totalp= 0;   
		   $pi=1;
		foreach($resultData as $sub):?>
                    <?php 
                    $this->db->where('class_id',$classid);
                    $this->db->where('id',$sub['subject']);
                    $subjectname=$this->db->get('subject'); 
                    if($subjectname->num_rows()>0){
                        $subjectname=$subjectname->row();
                    
                    if(($subjectname->subject == "VALUE EDUCATION") || ($subjectname->subject =="WORK EDUCATION") || ($subjectname->subject == "ART/URDU")||($subjectname->subject == "SENSORIAL ACTIVITIES" ) || ($subjectname->subject == "HEALTH & PHYSICAL EDUCATION" )|| ($subjectname->subject == "DISCIPLINE" )){
                   if($subjectname->subject == "VALUE EDUCATION"){
                   $arrco[1]= $subjectname->id;
                 
                   $pi=$pi+1;
                   }
                   if($subjectname->subject == "WORK EDUCATION"){
                   $arrco[2]= $subjectname->id;
                    $pi=$pi+1;
                   }
                   if($subjectname->subject == "ART/URDU"){
                   $arrco[3]= $subjectname->id;
                    $pi=$pi+1;
                   }
                   if($subjectname->subject == "SENSORIAL ACTIVITIES"){
                   $arrco[4]= $subjectname->id;
                    $pi=$pi+1;
                   }
                     if($subjectname->subject == "HEALTH & PHYSICAL EDUCATION"){
                   $arrco[5]= $subjectname->id;
                    $pi=$pi+1;
                   }
                   
                   if($subjectname->subject == "DISCIPLINE"){
                   $arrco[6]= $subjectname->id;
                    $pi=$pi+1;
                   }
                 
                    }else{ $totalp+=200;?>
		<tr class="wight"> 
					 <td class="subject"> <?php echo  $subjectname->subject;?> </td>
			     <?php 
                 $gtptal=0;
                 $subtatal=0;
		         $i=1; $t=0; $coltptal=0;  ?>
				
				 <?php   if($examid->num_rows()==0){?><td colspan="1" ></td><td colspan="1" ></td><td colspan="1" ></td>
											<?php }else if($examid->num_rows()==1){ ?>
				 <?php foreach ($examid->result() as $value):?>
					<td class="center" colspan="1" >
					<?php       $this->db->where("term", 1);
								$this->db->where('subject_id',$sub['subject']);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();
							if(is_numeric($marks->marks) ){
							    $dfg =$marks->marks;
                      $gtptal= $gtptal+$marks->marks;
                      $ctotal[$t]+= $marks->marks;
                    }else{ $gtptal= $gtptal;}
							echo $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
        					$this->db->where('class_id',$classid);
        					$this->db->where('exam_id',$value->exam_id);
				  $exammm_row=    $this->db->get('exam_max_subject')->row();
               $exammm=    $exammm_row->max_m;
               if(is_numeric($exammm)){
               $ctotalmo[$t]+=$exammm;
                echo "/".$exammm;
               }
				if($value->exam_id == 31 && $row2=="D" || $value->exam_id == 33 && $row2=="D" || $value->exam_id == 25 && $row2=="D" || $value->exam_id == 26 && $row2=="D"){
				  if(is_numeric($exammm)){ 
				      $dhtm=$exammm+$dhtm;
				  }
				}
											}
					?>
					</td>
				<?php $i++; $t++;endforeach; ?>
				<td colspan="1" ></td><td colspan="1" ></td>
				<?php }else if($examid->num_rows()==2){ ?>
				<?php foreach ($examid->result() as $value):?>
					<td class="center" colspan="1" >
					<?php       $this->db->where("term", 1);
								$this->db->where('subject_id',$sub['subject']);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();
							if(is_numeric($marks->marks) ){
							    $dfg =$marks->marks;
                      $gtptal= $gtptal+$marks->marks;
                      $ctotal[$t]+= $marks->marks;
                    }else{ $gtptal= $gtptal;}
							echo $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
        					$this->db->where('class_id',$classid);
        					$this->db->where('exam_id',$value->exam_id);
				  $exammm_row=    $this->db->get('exam_max_subject')->row();
               $exammm=    $exammm_row->max_m;
               if(is_numeric($exammm)){
               $ctotalmo[$t]+=$exammm;
                echo "/".$exammm;
               }
				if($value->exam_id == 31 && $row2=="D" || $value->exam_id == 33 && $row2=="D" || $value->exam_id == 25 && $row2=="D" || $value->exam_id == 26 && $row2=="D"){
				  if(is_numeric($exammm)){ 
				      $dhtm=$exammm+$dhtm;
				  }
				}
											}
					?>
					</td>
				<?php $i++; $t++;endforeach; ?><td colspan="1" ></td>
				<?php }else{ ?>
				 <?php foreach ($examid->result() as $value):?>
					<td class="center" colspan="1" >
					<?php       $this->db->where("term", 1);
								$this->db->where('subject_id',$sub['subject']);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();
							if(is_numeric($marks->marks) ){
							    $dfg =$marks->marks;
                      $gtptal= $gtptal+$marks->marks;
                      $ctotal[$t]+= $marks->marks;
                    }else{ $gtptal= $gtptal;}
							echo $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
        					$this->db->where('class_id',$classid);
        					$this->db->where('exam_id',$value->exam_id);
				  $exammm_row=    $this->db->get('exam_max_subject')->row();
               $exammm=    $exammm_row->max_m;
               if(is_numeric($exammm)){
               $ctotalmo[$t]+=$exammm;
                echo "/".$exammm;
               }
				if($value->exam_id == 31 && $row2=="D" || $value->exam_id == 33 && $row2=="D" || $value->exam_id == 25 && $row2=="D" || $value->exam_id == 26 && $row2=="D"){
				  if(is_numeric($exammm)){ 
				      $dhtm=$exammm+$dhtm;
				  }
				}
											}
					?>
					</td>
				<?php $i++; $t++;endforeach; ?>
				<?php } ?>
					<!--	<td class="center bold"><?php
						$dfg1= round((($dfg*100)/$exammm), 2);
							$gradecal =calculateGrade($dfg1,$classid);
						 ?></td>-->
						<td class="center bold"><?php  if($examid->num_rows() >0){echo $gradecal;}else{echo "";}?></td>
					<!--1st term exam end-->
					<!--2nd term exam start-->
						<?php 
                 $gtptal_2=0;
				 $subtatal_2=0;
		         $i=1; $t=0; $coltptal=0; ?>
				 <?php   if($examid_2->num_rows()==0){?><td colspan="1" ></td><td colspan="1" ></td><td colspan="1" ></td>
											<?php }else if($examid_2->num_rows()==1){ ?>
				 <?php foreach ($examid_2->result() as $value):?>
					<td class="center" colspan="1" >
					<?php       $this->db->where("term", 2);
								$this->db->where('subject_id',$sub['subject']);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();
							if(is_numeric($marks->marks) ){
							    $dfg_2 =$marks->marks;
                      $gtptal_2= $gtptal_2+$marks->marks;
                      $ctotal1[$t]+= $marks->marks;
                    }else{ $gtptal_2= $gtptal_2;}
							echo $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
        					$this->db->where('class_id',$classid);
        					$this->db->where('exam_id',$value->exam_id);
				  $exammm_row=    $this->db->get('exam_max_subject')->row();
               $exammm=    $exammm_row->max_m;
               if(is_numeric($exammm)){
               $ctotalmo2[$t]+=$exammm;
                echo "/".$exammm;
               }
				if($value->exam_id == 31 && $row2=="D" || $value->exam_id == 33 && $row2=="D" || $value->exam_id == 25 && $row2=="D" || $value->exam_id == 26 && $row2=="D"){
				  if(is_numeric($exammm)){ 
				      $dhtm=$exammm+$dhtm;
				  }
				}
											}
					?>
					</td>
				<?php $i++; $t++;endforeach; ?>
				<td colspan="1" ></td><td colspan="1" ></td>
				<?php }else if($examid_2->num_rows()==2){ ?>
				 <?php foreach ($examid_2->result() as $value):?>
					<td class="center" colspan="1" >
					<?php       $this->db->where("term", 2);
								$this->db->where('subject_id',$sub['subject']);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();
							if(is_numeric($marks->marks) ){
							    $dfg_2 =$marks->marks;
                      $gtptal_2= $gtptal_2+$marks->marks;
                      $ctotal1[$t]+= $marks->marks;
                    }else{ $gtptal_2= $gtptal_2;}
							echo $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
        					$this->db->where('class_id',$classid);
        					$this->db->where('exam_id',$value->exam_id);
				  $exammm_row=    $this->db->get('exam_max_subject')->row();
               $exammm=    $exammm_row->max_m;
               if(is_numeric($exammm)){
               $ctotalmo2[$t]+=$exammm;
                echo "/".$exammm;
               }
				if($value->exam_id == 31 && $row2=="D" || $value->exam_id == 33 && $row2=="D" || $value->exam_id == 25 && $row2=="D" || $value->exam_id == 26 && $row2=="D"){
				  if(is_numeric($exammm)){ 
				      $dhtm=$exammm+$dhtm;
				  }
				}
											}
					?>
					</td>
				<?php $i++; $t++;endforeach; ?><td colspan="1" ></td>
				<?php }else{ ?>
				 <?php foreach ($examid_2->result() as $value):?>
					<td class="center" colspan="1" >
					<?php       $this->db->where("term", 2);
								$this->db->where('subject_id',$sub['subject']);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();
							if(is_numeric($marks->marks) ){
							    $dfg_2 =$marks->marks;
                      $gtptal_2= $gtptal_2+$marks->marks;
                      $ctotal1[$t]+= $marks->marks;
                    }else{ $gtptal_2= $gtptal_2;}
							echo $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
        					$this->db->where('class_id',$classid);
        					$this->db->where('exam_id',$value->exam_id);
				  $exammm_row=    $this->db->get('exam_max_subject')->row();
               $exammm=    $exammm_row->max_m;
               if(is_numeric($exammm)){
               $ctotalmo2[$t]+=$exammm;
                echo "/".$exammm;
               }
				if($value->exam_id == 31 && $row2=="D" || $value->exam_id == 33 && $row2=="D" || $value->exam_id == 25 && $row2=="D" || $value->exam_id == 26 && $row2=="D"){
				  if(is_numeric($exammm)){ 
				      $dhtm=$exammm+$dhtm;
				  }
				}
											}
					?>
					</td>
				<?php $i++; $t++;endforeach; ?>
				<?php } ?>
						<!--<td class="center bold"><?php 
						$dfg1_2= round((($dfg_2*100)/$exammm), 2);
							$gradecal_2 =calculateGrade($dfg1_2,$classid);
						 ?></td>-->
						 
						<td class="center bold"><?php  if($examid_2->num_rows() >0){echo $gradecal_2;}else{echo " ";} ?></td>
					<!--2nd term exam end-->
				<td class="center bold"><?php  //$rty = $gtptal/2; echo $gtptal;  ?></td>
			   <td class="center bold"><?php //echo calculateGrade($rty,$classid)?></td>	
		</tr>
					<?php } }endforeach;?>
		<tr class="wight">
					<td class="subject">GRAND TOTAL</td>
					<?php 
					$h=1;$i=0; foreach($ctotal as $cd): 
					if($h<5){ ?>
				<td class="center" colspan="1">	<?php $cumulativetotal+=$ctotal[$i];echo $ctotal[$i];  ?>
				<?php  if($ctotalmo[$i] >0 ){echo "/".$ctotalmo[$i];} ?> 
				</td>
				<?php $h++; $i++; $dhtm1=0;}  endforeach; ?>
				<?php if($h%2==0){ ?>
					<td class="center bold"><?php $cumulativetotal+=$ctotal['tot'.$h];echo $ctotal['tot'.$h];?> </td> 
					<td class="center bold"></td>
					<?php 			} ?>
				<?php	
				  $h1=1;$i1=0;
				  foreach($ctotal1 as $cd): 
					if($h1<5){ ?>
				<td class="center" colspan="1">	<?php  $cumulativetotal1+=$ctotal1[$i1];echo $ctotal1[$i1];  ?>
				<?php  if($ctotalmo2[$i1] >0 ){echo "/".$ctotalmo2[$i1];} ?> </td>
					<?php $h1++; $i1++; }  endforeach;	?>
					
			<td class="center bold"><?php //echo $cumulativetotal;?></td>
			<td class="center bold"></td>
		</tr>
		
		  <tr class="tableHeader">	
			<td colspan="11" class="pink" style="text-transform: uppercase;">Class Teachers Remark</td>
		</tr>
		<tr class="wight">
					<td class="subject" colspan="1">VALUE EDUCATION <?php //echo $arrco[1];?></td>
					<?php 
								$this->db->where('subject_id',$arrco[1]);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',28);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
								$this->db->where('subject_id',$arrco[1]);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',30);
								$this->db->where('fsd',$fsd);
						$marksa=$this->db->get('exam_info');
							if(($marks->num_rows()>0) || ($marksa->num_rows()>0)){
							if($marks->num_rows()>0){
							$marks=$marks->row();
						$marks->marks;
						?>
					
					<td colspan="3" style="text-transform: uppercase;"><?= discriptiveindicator($marks->marks);?></td>
					<td style="text-transform: uppercase;"><?php echo calculateGrade1($marks->marks,$classid)?></td>
						<?php }else{
						?>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
						<?php }
						if($marksa->num_rows()>0){$marksa = $marksa->row();	?>
					<td colspan="2" style="text-transform: uppercase;"><?= discriptiveindicator($marksa->marks);?></td>
             		<td style="text-transform: uppercase;"><?php echo calculateGrade1($marksa->marks,$classid)?></td>
             		<?php }else{?>
             		<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
             		<?php }}else{?>
					<td colspan="4"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td colspan="2"><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td colspan="2"><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
             	<?php	} ?>
		</tr>
		<tr class="wight">
					<td class="subject" colspan="1" >WORK EDUCATION <?php //echo $arrco[2];?></td>
					<?php $this->db->where('subject_id',$arrco[2]);
					$this->db->where('class_id',$classid);
					$this->db->where('stu_id',$studentInfo->id);
					$this->db->where('exam_id',28);
					$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						$this->db->where('subject_id',$arrco[2]);
					$this->db->where('class_id',$classid);
					$this->db->where('stu_id',$studentInfo->id);
					$this->db->where('exam_id',30);
					$this->db->where('fsd',$fsd);
						$marksa= $this->db->get('exam_info');
							if(($marks->num_rows()>0) || ($marksa->num_rows()>0)){
							if($marks->num_rows()>0){
							$marks=$marks->row();
						$marks->marks;
						?>
					<td colspan="3" style="text-transform: uppercase;"><?= discriptiveindicator($marks->marks);?></td>
					<td style="text-transform: uppercase;"><?php echo calculateGrade1($marks->marks,$classid)?></td>
						<?php }else{
						?>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
						<?php }
						if($marksa->num_rows()>0){$marksa = $marksa->row();	?>
					<td colspan="2"><?= discriptiveindicator($marksa->marks);?></td>
             		<td style="text-transform: uppercase;"><?php echo calculateGrade1($marksa->marks,$classid)?></td>
             		<?php }else{?>
             		<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
             		<?php }}else{?>
             		<td colspan="4"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td colspan="2"><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td colspan="2"><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
             	<?php	} ?>
			</tr>
			<tr class="wight">
					<td colspan="1" class="subject">DISCIPLINE</td>
							<?php 
							$this->db->where('subject_id',$arrco[6]);
							$this->db->where('class_id',$classid);
							$this->db->where('stu_id',$studentInfo->id);
							$this->db->where('exam_id',28);
							$this->db->where('fsd',$fsd);
					$marks= $this->db->get('exam_info');
						$this->db->where('subject_id',$arrco[6]);
					$this->db->where('class_id',$classid);
					$this->db->where('stu_id',$studentInfo->id);
					$this->db->where('exam_id',30);
					$this->db->where('fsd',$fsd);
						$marksa= $this->db->get('exam_info');
							if(($marks->num_rows()>0) || ($marksa->num_rows()>0)){
							if($marks->num_rows()>0){
							$marks=$marks->row();
						$marks->marks;
						?>
					<td colspan="3"><?= discriptiveindicator($marks->marks);?></td>
					<td><?php echo calculateGrade1($marks->marks,$classid)?></td>
						<?php }else{
						?>
					<td colspan="3"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
						<?php }
						if($marksa->num_rows()>0){$marksa = $marksa->row();	?>
					<td colspan="2"><?= discriptiveindicator($marksa->marks);?></td>
             		<td><?php echo calculateGrade1($marksa->marks,$classid)?></td>
             		<?php }else{?>
             		<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
             		<?php }}else{?>
					<td colspan="4"><?php //discriptiveindicator($cumulativetotal);?></td>
					<td colspan="2"><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
					<td colspan="2"><?php //discriptiveindicator($cumulativetotal);?></td>
             		<td colspan="2"><?php //echo calculateGrade1($coltptal,$studentInfo->class_id)?></td>
             	<?php	} ?>
				
		</tr>
		<tr class="blue">
			<td colspan="2">ATTENDANCE  </td>
			<td colspan="3">MARK PERCENTAGE  <?php  
		//	echo round((($cumulativetotal*100)/$dhtm), 2);
		if($ctotal[2] > 0){echo round((($ctotal[2]*100)/$dhtm), 2);}else{}
		?>%  </td>
			<td colspan="6">CLASS RANK: <?php 
			//echo $this->exammodel->getClassRank($studentInfo->id, $classid, $fsd); ?></td>
		</tr>
			<!---kerala marks table end--->
			<?php }else if($school == 5 && $row2== "C"){ ?>
			<!---SL marks table START--->
			<tr class="tableHeader">
			<td class="center" colspan="2" >A. SCHOLASTIC AREAS</td>
    		<td class="center" colspan="3">TERM - 1</td>
    		<td class="center" colspan="2">TERM - 2</td>
			<td colspan="4">Cumulative Evaluation</td>
		</tr>
		<tr class="yellow" >
		    <td colspan="2">SUBJECT</td>
			<?php
                $dhtm=0;
                $i=1; $arrco[1]=0;
                $arrco[2]=0;
                $arrco[3]=0;
                $arrco[4]=0;
                $arrco[5]=0;
                $arrco[6]=0; ?>
				<?php  if($examid->num_rows()==0){?><td colspan="1" ></td><td colspan="1" ></td><td colspan="1" ></td>
				<?php }else if($examid->num_rows()==1){ ?>
				<?php
           foreach ($examid->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',1);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');   
             if ($examname->num_rows()>0){
             $examname=$examname->row();
             	?>  
			<td colspan="1" >
			<?php echo $examname->exam_name; 
							$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
				echo "[".$exammm."]";
			?>
			</td>
								<?php  }else{ ?>  
			<td colspan="1" ></td>					<?php } ?>
				<?php $i++; endforeach ; ?>
				<td colspan="1" ></td><td colspan="1" ></td>
				<?php }else if($examid->num_rows()==2){ ?>
				<?php
           foreach ($examid->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',1);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');   
             if ($examname->num_rows()>0){
             $examname=$examname->row();
             	?>  
			<td colspan="1" >
			<?php echo $examname->exam_name; 
							$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
				echo "[".$exammm."]";
			?>
			</td>
								<?php  }else{ ?>  
			<td colspan="1" ></td>					<?php } ?>
				<?php $i++; endforeach ; ?>
				<td colspan="1" ><?php }else{ ?>
				<?php
           foreach ($examid->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',1);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');   
             if ($examname->num_rows()>0){
             $examname=$examname->row();
             	?>  
			<td colspan="1" >
			<?php echo $examname->exam_name; 
							$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
				echo "[".$exammm."]";
			?>
			</td>
								<?php  }else{ ?>  
			<td colspan="1" ></td>					<?php } ?>
				<?php $i++; endforeach ; ?>
				<?php }?>
			<!---1st term exam name end--->
			<!---2nd term exam name start--->
			<?php     if($examid_2->num_rows()==0){?><td colspan="1" ></td><td colspan="1" ></td>
											<?php }else if($examid_2->num_rows()==1){ ?>
          <?php foreach ($examid_2->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',2);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');		 
             if ($examname->num_rows()>0){
             $examname=$examname->row();
             	?>  
			<td colspan="1" >
			<?php echo $examname->exam_name; 
							$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
				echo "[".$exammm."]";
			?>
			</td>
									<?php }else{ ?>  
			<td colspan="1" ></td>			<?php } ?>
 			<?php $i++; endforeach ; ?><td colspan="1" ></td><?php }else{ ?>
			<?php foreach ($examid_2->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',2);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');		 
             if ($examname->num_rows()>0){
             $examname=$examname->row();
             	?>  
			<td colspan="1" >
			<?php echo $examname->exam_name; 
							$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
				echo "[".$exammm."]";
			?>
			</td>
									<?php }else{ ?>  
			<td colspan="1" ></td>			<?php } ?>
 			<?php $i++; endforeach ; ?>
			<?php } ?>
			<!---2nd term exam name end--->
			<!---Cumulative exam name start--->
          <td colspan="1">Third Monthly(Quarterly Exam)/Unit Test</td>
            <td colspan="1">Half Yearly</td>
            <td colspan="1">Annual</td>
			<td colspan="1" class="text-center">Grand Total<?php echo "[300]";?></td>
			<!---Cumulative exam name end--->
		</tr>
		<?php 
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
			$ctotal1 =array();
            $ctotal1[0]=0;
            $ctotal1[1]=0;
			$ctotal1[3]=0;
            $ctotal1["tot2"]=0;
            $cumulativetotal=0;
            $cumulativetotal1=0;
            $totalp= 0;   
            $pi=1;
		foreach($resultData as $sub): 
                        $this->db->where('class_id',$classid);
                        $this->db->where('id',$sub['subject']);
        $subjectname=   $this->db->get('subject'); 
                    if($subjectname->num_rows()>0){
                        $subjectname=$subjectname->row();
                    if(($subjectname->subject == "VALUE EDUCATION") || ($subjectname->subject =="WORK EDUCATION") || ($subjectname->subject == "ART/URDU")||($subjectname->subject == "SENSORIAL ACTIVITIES" ) || ($subjectname->subject == "HEALTH & PHYSICAL EDUCATION" )|| ($subjectname->subject == "DISCIPLINE" )){
                   
				   }else{ $totalp+=200;
				   ?>
		<tr class="wight" > 
					 <td class="subject" colspan="2"> <?php echo  $subjectname->subject; ?>	</td>
			     <?php 
                    $gtptal=0;
                    $subtatal=0;
		            $i=1; $t=0; $coltptal=0; ?>
					<?php  if($examid->num_rows()==0){?><td colspan="1" ></td><td colspan="1" ></td><td colspan="1" ></td>
				<?php }else if($examid->num_rows()==1){ ?>
					<?php
					
					foreach ($examid->result() as $value):?>
					<td class="center" colspan="1">	
					<?php  		$this->db->where("term", 1);
            					$this->db->where('subject_id',$sub['subject']);
            					$this->db->where('class_id',$classid);
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
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				$dhtm=$exammm+$dhtm;
						}
					?>
					</td>
					<?php $i++; $t++;endforeach; ?><td colspan="1" ></td><td colspan="1" ></td>
				<?php }else if($examid->num_rows()==2){ ?>
				<?php
					
					foreach ($examid->result() as $value):?>
					<td class="center" colspan="1">	
					<?php  		$this->db->where("term", 1);
            					$this->db->where('subject_id',$sub['subject']);
            					$this->db->where('class_id',$classid);
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
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				$dhtm=$exammm+$dhtm;
						}
					?>
					</td>
					<?php $i++; $t++;endforeach; ?>
				<td colspan="1" ><?php }else{ ?>
				<?php
					
					foreach ($examid->result() as $value):?>
					<td class="center" colspan="1">	
					<?php  		$this->db->where("term", 1);
            					$this->db->where('subject_id',$sub['subject']);
            					$this->db->where('class_id',$classid);
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
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				echo "/".$exammm;
				$dhtm=$exammm+$dhtm;
						}
					?>
					</td>
					<?php $i++; $t++;endforeach; ?>
				<?php }?>
				<!--1st term marks end-->
				<!--overall total marks of 1st term in list-->
				<!--<td class="center bold"><?php  $rty = $gtptal/2; echo $gtptal;  ?></td>-->
				<!--overall total marks of 1st term in list-->
				<!--2nd term marks start-->
				 <?php 
                 $gtptal_2=0;
                 $subtatal=0;
		         $i=1; $t=0; $coltptal=0; ?>
				 <?php   if($examid_2->num_rows()==0){?><td colspan="1" ></td><td colspan="1" ></td>
											<?php }else if($examid_2->num_rows()==1){ ?>
				 <?php 
				 foreach ($examid_2->result() as $value):?>
					<td class="center" colspan="1" >
					<?php       $this->db->where("term", 2);
								$this->db->where('subject_id',$sub['subject']);
								$this->db->where('class_id',$classid);
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
							 $ctotal1[$t]+= $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				$dhtm=$exammm+$dhtm;
						}
					?>
					</td>
				<?php 
				 $i++; $t++;endforeach;
				?><td colspan="1" ></td><?php }else{ ?>
				 <?php 
				 foreach ($examid_2->result() as $value):?>
					<td class="center" colspan="1" >
					<?php       $this->db->where("term", 2);
								$this->db->where('subject_id',$sub['subject']);
								$this->db->where('class_id',$classid);
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
							 $ctotal1[$t]+= $marks->marks;
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				$dhtm=$exammm+$dhtm;
						}
					?>
					</td>
				<?php 
				 $i++; $t++;endforeach;
				?>
				<?php } ?>
				<!--2nd term marks end-->
				<?php
				for($j=$i; $j < 5; $j++){ ?>
                <?php      } ?>
				<!--overall total marks of 2nd term in list-->
				<!--<td class="center bold"><?php  $rty = $gtptal_2/2; echo $gtptal_2;  ?></td>-->
				<!--end overall total marks of 2nd term in list-->
				<?php  calculateGrade($rty,$classid);
				 $gtptal_grand= $gtptal_2+$gtptal;
				?>
			   <td class="center bold"><?php ?></td>
				<td class="center bold"><?php     ?></td>	
				<td class="center bold"><?php     ?></td>	
<td class="center bold"><?php     ?></td>				
		</tr>
					<?php } }endforeach;?>
		<tr class="wight">
					<td class="subject" colspan="2">GRAND TOTAL</td>
					<?php 
					$h=1;$i=0; 
					foreach($ctotal as $cd): 
					if($h<4){ ?>
				<td class="center" colspan="1">	<?php $cumulativetotal+=$ctotal[$i];echo $ctotal[$i];  ?></td>
					<!--<td class="center" colspan="5">	<?php echo $ctotal[$i];  ?></td>-->
					<?php if($h%2==0){ ?>	
					<!--obtain grand total-->
				<!--<td class="center bold"><?php $cumulativetotal+=$ctotal['tot'.$h];echo $ctotal['tot'.$h];?> </td>-->
					<!--end obtain grand total-->
					<?php 			} ?>
					<?php $h++; $i++;
					       } 
			      endforeach;	
				  $h1=1;$i1=0;
				  foreach($ctotal1 as $cd): 
					if($h1<3){ ?>
				<td class="center" colspan="1">	<?php  $cumulativetotal1+=$ctotal1[$i1];echo $ctotal1[$i1];  ?></td>
					<!--<td class="center" colspan="5">	<?php echo $ctotal1[$i1];  ?></td>-->
					<?php if($h%2==0){ ?>	
					<!--obtain grand total-->
				<!--<td class="center bold"><?php $cumulativetotal1+=$ctotal1['tot'.$h1];echo $ctotal1['tot'.$h1];?> </td>-->
					<!--end obtain grand total-->
					<?php 			} ?>
					<?php $h1++; $i1++;
					       } 
			      endforeach;	?>
				<td class="center bold"></td>
				<td class="center bold"></td>
				<td class="center bold"></td>
				<td class="center bold"></td>
		</tr>
		<tr class="tableHeader">	
			<td colspan="2" style="text-transform: uppercase;">B. CO-Scholastic Areas</td>
			<td colspan="3" style="text-transform: uppercase;">Descriptive Indicators</td>

			<td>Grade</td>
			<td colspan="2" style="text-transform: uppercase;">Descriptive Indicators</td>
			<td>Grade</td>
			<td colspan="2" rowspan="2" class="pink" style="text-transform: uppercase;">Class Teachers Remark</td>
		</tr>
		<tr class="blue">
			<td colspan="2">ATTENDANCE : </td>
			<td colspan="3">MARK PERCENTAGE : <?php  $cumulativetotal_g=$cumulativetotal+$cumulativetotal1;
			echo round((($cumulativetotal_g*100)/$dhtm), 2);?>%  </td>
			<td colspan="4">RANK :<?php //echo $this->exammodel->getClassRank($studentInfo->id, $classid, $fsd);?></td>
		</tr>
		<!---SL marks table END--->
		<?php }else if($school == 6 && $row2== "D"){ ?>
		<!---samta MARKSHEET START--->
		<?php if( $classid == 262 && $row2== "D" || $classid == 343 && $row2== "D" || $classid == 261 && $row2== "D" || $classid == 342 && $row2== "D" ){ ?>
		
		<!--samta 9 to 12 start-->
		<tr class="yellow">
		    <td colspan="1" rowspan="2" >विषय कोड SUB CODE</td>
			<td colspan="1" rowspan="2" >विषय SUBJECT</td>
			<?php
				    $dhtm=0;
				    $i=1;  
			?>
			<!---1st term exam name start--->
			<?php  if($examid->num_rows()==0){ ?>
			<td colspan="4" ></td>
			<?php                            }else{
            foreach ($examid->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',1);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');   
             if ($examname->num_rows()>0){
             $examname=$examname->row();	?>  
			<td colspan="4" ><?php echo $examname->exam_name;?></td>
								<?php  }else{ ?>  
			<td colspan="4" ></td>					<?php } ?>
            <?php $i++; endforeach ; } ?>
        	<td colspan="1" rowspan="2">GRADE</td>
			<!---1st term exam name end--->
			<!---2nd term exam name start--->
			<?php  if($examid_2->num_rows()==0){?>
			<td colspan="4" ></td>
			<?php }else{
           foreach ($examid_2->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',2);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');		 
             if ($examname->num_rows()>0){
             $examname=$examname->row(); ?>  
			<td colspan="4" ><?php echo $examname->exam_name;?></td>
									<?php }else{ ?>  
			<td colspan="4" ></td>          <?php } ?>
 			<?php $i++; endforeach ; } ?>
 			<td colspan="1" rowspan="2">GRADE</td>
			<!---2nd term end--->
		</tr>
		<tr class="yellow">
			<td class="center" >लिखित THEORY</td>
			<td class="center" >आं.मू.IR/PR</td>
			<td class="center" >योग TOTAL[100]</td>
			<td class="center" >योग (शब्दों में )TOTAL(IN WORDS)</td>
		    <td class="center" >लिखित THEORY </td>
			<td class="center" >आं.मू.IR/PR</td>
			<td class="center" >योग TOTAL[100]</td>
			<td class="center" >योग (शब्दों में)TOTAL(IN WORDS)</td>
		</tr>
		<?php
		$ctotal =array();
        $ctotal[0]=0;
        $ctotal[1]=0;
        $ctotal[2]=0;
        $ctotal[3]=0;
        $ctotal[4]=0;
		$totalp= 0;
		foreach($resultData as $sub): 
                    $this->db->where('class_id',$classid);
                    $this->db->where('id',$sub['subject']);
                    $subjectname=$this->db->get('subject'); 
                    if($subjectname->num_rows()>0){
                        $subjectname=$subjectname->row();
					$totalp+=200;
					?>
		<tr class="wight"> 
			<td class="subject" colspan="1" > </td>
			<td class="subject" colspan="1" ><?php echo  $subjectname->subject; ?> </td>
			     <?php 
					$ttal=0;
					$gtptal=0;
                 $subtatal=0;
		         $i=1; $t=0; $coltptal=0; 
				 if($examid->num_rows()==0){
					 ?><td></td><td></td><td></td><td></td>
									<?php }else{
				 foreach ($examid->result() as $value): ?>
			<td> 
			<?php  
			            $this->db->where("term", 1);
						$this->db->where('subject_id',$subjectname->id);
						$this->db->where('sub_type',2);
						$this->db->where('class_id',$classid);
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
					$this->db->where('sub_type',2);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
		 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
		 echo "/".$exammm;
		 $dhtm=$exammm+$dhtm;
		 if(is_numeric($exammm)){
					  $ttal=$ttal+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal= $ttal;
					 $dhtm= $dhtm;   
					}
		 
				} ?>
			</td>
			<td>
			<?php  
			            $this->db->where("term", 1);
						$this->db->where('subject_id',$subjectname->id);
						$this->db->where('sub_type',3);
						$this->db->where('class_id',$classid);
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
					$this->db->where('sub_type',3);
			$this->db->where('class_id',$classid);
			$this->db->where('exam_id',$value->exam_id);
		 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
		 echo "/".$exammm;
		 $dhtm=$exammm+$dhtm;
		 if(is_numeric($exammm)){
					  $ttal=$ttal+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal= $ttal;
					 $dhtm= $dhtm;   
					}
				} ?>
			</td>
			<td><?= $gtptal ;?></td>
			<td><?php echo numberTowords($gtptal); ?></td>
				<?php  $i++; $t++; endforeach; } ?>
			<td class="center bold"><?php 
				if($ttal>0){ $per=round((($gtptal*100)/$ttal), 2);}
				if($ttal>0){echo $gradecal =calculateGrade($per,$classid);}?>
			</td>	
				<!--1st term marks end-->
				<!--2nd term marks start-->
				 <?php 
					$ttal_2=0;
                 $gtptal_2=0;
                 $subtatal=0;
		         $i=1; $t=0; $coltptal=0;  ?>
				 <?php  if($examid_2->num_rows()==0){?><td ></td><td></td><td></td><td></td><?php }else{
				 foreach ($examid_2->result() as $value):?>
					<td> 
					<?php  
					            $this->db->where("term", 2);
								$this->db->where('subject_id',$subjectname->id);
								$this->db->where('sub_type',2);
								$this->db->where('class_id',$classid);
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
							$this->db->where('sub_type',2);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				 echo "/".$exammm;
				 $dhtm=$exammm+$dhtm;
		 if(is_numeric($exammm)){
					  $ttal_2=$ttal_2+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal_2= $ttal_2;
					 $dhtm= $dhtm;   
					}
						} ?>
					</td>
					<td>
					<?php  
					            $this->db->where("term", 2);
								$this->db->where('subject_id',$subjectname->id);
								$this->db->where('sub_type',3);
								$this->db->where('class_id',$classid);
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
							$this->db->where('sub_type',3);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				 $exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				 echo "/".$exammm;
				 $dhtm=$exammm+$dhtm;
				 if(is_numeric($exammm)){
					  $ttal_2=$ttal_2+$exammm;
				    $dhtm=$exammm+$dhtm;
					}else{ $ttal_2= $ttal_2;
					 $dhtm= $dhtm;   
					}
						} ?>
					</td>
					<td><?= $gtptal_2 ;?></td>
					<td><?php echo numberTowords($gtptal_2); ?></td>
				<?php  $i++; $t++;endforeach; } ?>
				<td class="center bold"><?php 
				if($ttal_2>0){ $per_2=round((($gtptal_2*100)/$ttal_2), 2);}
				if($ttal_2>0){echo $gradecal =calculateGrade($per_2,$classid);}?></td>
				<!--2nd term marks end-->
				
		</tr>
					<?php //}
					}endforeach;?>
		<!---->
		<?php }else{ ?>
		<!--samta 1 to 8-->
		<tr class="tableHeader">
			<td class="center" colspan="1" >A. SCHOLASTIC AREAS</td>
    		<td class="center" colspan="4">TERM - 1</td>
    		<td class="center" colspan="4">TERM - 2</td>
			<td colspan="2">Cumulative Evaluation</td>
		</tr>
		<tr class="yellow" >
		    <td colspan="1">SUBJECT</td>
			<?php
                $dhtm=0;
                $i=1; $arrco[1]=0;
                $arrco[2]=0;
                $arrco[3]=0;
                $arrco[4]=0;
                $arrco[5]=0;
                $arrco[6]=0;  ?>
				<?php  if($examid->num_rows()==0){?>
				<td colspan="1" ></td><td colspan="1" ></td>
				<?php }else if($examid->num_rows()==1){ ?>
				<?php
           foreach ($examid->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',1);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');   
             if ($examname->num_rows()>0){
             $examname=$examname->row();
             	?>  
			<td colspan="1" >
			<?php echo $examname->exam_name; 
							$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
				echo "[".$exammm."]";
			?>
			</td>
								<?php  }else{ ?>  
			<td colspan="1" ></td>					<?php } ?>
				<?php $i++; endforeach ; ?>
				<td colspan="1" ></td>
				<?php }else{ ?>
				<?php
           foreach ($examid->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',1);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');   
             if ($examname->num_rows()>0){
             $examname=$examname->row();
             	?>  
			<td colspan="1" >
			<?php echo $examname->exam_name; 
							$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
				echo "[".$exammm."]";
			?>
			</td>
								<?php  }else{ ?>  
			<td colspan="1" ></td>					<?php } ?>
				<?php $i++; endforeach ; ?>
				<?php }?>
				<td colspan="1" >Total<?php echo "[100]";?></td><td colspan="1" >Grade</td>
			<!---1st term exam name end--->
			<!---2nd term exam name start--->
			<?php     if($examid_2->num_rows()==0){?>
			<td colspan="1" ></td><td colspan="1" ></td>
											<?php }else if($examid_2->num_rows()==1){ ?>
          <?php foreach ($examid_2->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',2);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');		 
             if ($examname->num_rows()>0){
             $examname=$examname->row();
             	?>  
			<td colspan="1" >
			<?php echo $examname->exam_name; 
							$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
				echo "[".$exammm."]";
			?>
			</td>
									<?php }else{ ?>  
			<td colspan="1" ></td>			<?php } ?>
 			<?php $i++; endforeach ; ?><td colspan="1" ></td>
			<?php }else{ ?>
			<?php foreach ($examid_2->result() as $value):
              $examid1=$value->exam_id;
						$this->db->where('term',2);			  
						$this->db->where('id',$examid1);
             $examname= $this->db->get('exam_name');		 
             if ($examname->num_rows()>0){
             $examname=$examname->row();
             	?>  
			<td colspan="1" >
			<?php echo $examname->exam_name; 
							$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
				echo "[".$exammm."]";
			?>
			</td>
									<?php }else{ ?>  
			<td colspan="1" ></td>			<?php } ?>
 			<?php $i++; endforeach ; ?>
			<?php } ?>
			<td colspan="1" >Total<?php echo "[100]";?></td><td colspan="1" >Grade</td>
			<!---2nd term exam name end--->
			<!---Cumulative exam name start--->
          <td colspan="1" class="text-center">Cumulative Marks<?php echo "[200]";?></td>
			<td colspan="1">Grade</td>
			<!---Cumulative exam name end--->
		</tr>
		<?php 
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
		$ctotal1 =array();
        $ctotal1[0]=0;
        $ctotal1[1]=0;
        $ctotal1[2]=0;
        $ctotal1[3]=0;
        $ctotal1[4]=0;
        $ctotal1["tot2"]=0;
        $ctotal1["tot4"]=0;
        $ctotal1["tot6"]=0;
        $cumulativetotal=0;
        $totalp= 0;   
        $pi=1;
		foreach($resultData as $sub):
                    $this->db->where('class_id',$classid);
                    $this->db->where('id',$sub['subject']);
                    $subjectname=$this->db->get('subject'); 
                    if($subjectname->num_rows()>0){
                        $subjectname=$subjectname->row(); 
				   $totalp+=200;
					?>
		<tr class="wight"> 
					 <td class="subject"><?php echo  $subjectname->subject; ?> </td>
			     <?php 
                    $gtptal=0;
                    $subtatal=0;
		            $i=1; $t=0; $coltptal=0; ?>
					<?php  if($examid->num_rows()==0){?>
					<td colspan="1" ></td><td colspan="1" ></td>
				<?php }else if($examid->num_rows()==1){ ?>
					<?php
					foreach ($examid->result() as $value):?>
					<td class="center" colspan="1">	
					<?php  		$this->db->where("term", 1);
            					$this->db->where('subject_id',$sub['subject']);
            					$this->db->where('class_id',$classid);
            					$this->db->where('stu_id',$studentInfo->id);
            					$this->db->where('exam_id',$value->exam_id);
            					$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();

								if(is_numeric($marks->marks)){
							$subtatal=$subtatal+$marks->marks;
							$gtptal= $gtptal+$marks->marks;
							$coltptal+=$marks->marks;
								$ctotal[$t]+= $marks->marks;
								}
							echo $marks->marks;

							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				//echo "/".$exammm;
				$dhtm=$exammm+$dhtm;
						}
					?>
					</td>
					<?php $i++; $t++;endforeach; ?>
					<td colspan="1" ></td>
					<?php }else{ ?>
				<?php
					foreach ($examid->result() as $value):?>
					<td class="center" colspan="1">	
					<?php  		$this->db->where("term", 1);
            					$this->db->where('subject_id',$sub['subject']);
            					$this->db->where('class_id',$classid);
            					$this->db->where('stu_id',$studentInfo->id);
            					$this->db->where('exam_id',$value->exam_id);
            					$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();

								if(is_numeric($marks->marks)){
							$subtatal=$subtatal+$marks->marks;
							$gtptal= $gtptal+$marks->marks;
							$coltptal+=$marks->marks;
								$ctotal[$t]+= $marks->marks;
							echo $marks->marks;
								}

							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				//echo "/".$exammm;
				$dhtm=$exammm+$dhtm;
						}
					?>
					</td>
					<?php $i++; $t++;endforeach; ?>
				<?php }?>
				<td class="center bold"><?php  $rty = $gtptal/2; echo $gtptal;  ?></td>
			   <td class="center bold"><?php echo calculateGrade($rty,$classid)?></td>
				<!--1st term marks end-->
				<!--2nd term marks start-->	
				 <?php 
                 $gtptal_2=0;
                 $subtatal=0;
		         $i=1; $t=0; $coltptal=0; ?>
				 <?php   if($examid_2->num_rows()==0){?><td colspan="1" ></td><td colspan="1" ></td>
											<?php }else if($examid_2->num_rows()==1){ ?>
				 <?php 
				 foreach ($examid_2->result() as $value):?>
					<td class="center" colspan="1" >
					<?php       $this->db->where("term", 2);
								$this->db->where('subject_id',$sub['subject']);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();

							if(is_numeric($marks->marks)){
							$subtatal=$subtatal+$marks->marks;
							$gtptal_2= $gtptal_2+$marks->marks;
							$coltptal+=$marks->marks;
							$ctotal1[$t]+= $marks->marks;
							}
							echo $marks->marks;
							 

							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				//echo "/".$exammm;
				$dhtm=$exammm+$dhtm;
						}
					?>
					</td>
				<?php 
				 $i++; $t++;endforeach;
				?><td colspan="1" ></td><?php }else{ ?>
				 <?php 
				 foreach ($examid_2->result() as $value):?>
					<td class="center" colspan="1" >
					<?php       $this->db->where("term", 2);
								$this->db->where('subject_id',$sub['subject']);
								$this->db->where('class_id',$classid);
								$this->db->where('stu_id',$studentInfo->id);
								$this->db->where('exam_id',$value->exam_id);
								$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();

							if(is_numeric($marks->marks)){
							$subtatal=$subtatal+$marks->marks;
							$gtptal_2= $gtptal_2+$marks->marks;
							$coltptal+=$marks->marks;
							$ctotal1[$t]+= $marks->marks;
							}
							echo $marks->marks;
							 

							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				//echo "/".$exammm;
				$dhtm=$exammm+$dhtm;
						}
					?>
					</td>
				<?php 
				 $i++; $t++;endforeach;
				?>
				<?php } ?>
				<td class="center bold"><?php  $rty_2 = $gtptal_2/2; echo $gtptal_2;  ?></td>
			   <td class="center bold"><?php echo calculateGrade($rty_2,$classid)?></td>
				<!--2nd term marks end-->
				<td class="center bold"><?php 
				$gtptal_overall=$gtptal_2+$gtptal;
				$rty_overall = $gtptal_overall/2; echo $gtptal_overall;  ?></td>
			   <td class="center bold"><?php echo calculateGrade($rty_overall,$classid)?></td>
		</tr>
					<?php }endforeach;?>
		<tr class="wight">
			<td class="subject">GRAND TOTAL</td>
					<?php $h=1;$i=0; foreach($ctotal as $cd):
					if($h<3){?>
					<td class="center">
					<?php echo $ctotal[$i];  ?>
					</td>
					<?php if($h%2==0){ ?>
					<td class="center bold"><?php echo $g1= $ctotal[0]+$ctotal[1];?></td> 
					<td class="center bold"></td>
					<?php 			} ?>
					<?php $h++; $i++; } endforeach;	
					?>
					
					
					
					<?php $h=1;$i=0; foreach($ctotal1 as $cd):
					if($h<3){?>
					<td class="center">
					<?php echo $ctotal1[$i];  ?>
					</td>
					<?php if($h%2==0){ ?>
					<td class="center bold"><?php echo $g2= $ctotal1[0]+$ctotal1[1];?></td> 
					<td class="center bold"></td>
					<?php 			} ?>
					<?php $h++; $i++; } endforeach;	
					?>
			<td class="center bold"><?php echo $overg= $g1+$g2;?></td>
			<td class="center bold"></td>
		</tr>
		<tr class="tableHeader">	
			<td colspan="1" style="text-transform: uppercase;">B. CO-Scholastic Areas</td>
			<td colspan="3" style="text-transform: uppercase;">Descriptive Indicators</td>

			<td>Grade</td>
			<td colspan="3" style="text-transform: uppercase;">Descriptive Indicators</td>
			<td>Grade</td>
			<td colspan="1"  class="pink" style="text-transform: uppercase;">MARK PERCENTAGE  <?php 
			echo round((($overg*100)/$dhtm), 2);?>% </td>
			<td colspan="1">RANK</td>
		</tr>
		<tr class="blue">
			<td colspan="2">ATTENDANCE  </td>
			<td colspan="9">Class Teachers Remark</td>
		</tr>
		<?php } ?>
		<!---samta MARKSHEET END--->
		<?php }else{ ?>
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
			   foreach ($examid->result() as $value):
				  $examid1=$value->exam_id;	
				 $this->db->where('id',$examid1);
				 $examname=$this->db->get('exam_name');   
				 if ($examname->num_rows()>0){
				 $examname=$examname->row();
					?>  
			<td><?php echo $examname->exam_name; 
							$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;	
				echo "[".$exammm."]";
			?></td>
										<?php }else{ ?>  <td></td>
												<?php } ?>
            <?php if($i%2==0){ ?>
            <td class="center bold">Total<br><?php echo "[100]";?></td>
			<td class="center bold">Grade</td>
						<?php } ?>
 			<?php $i++; endforeach ;
					for($j=$i; $j < 5; $j++){ ?>
					<td></td>
						<?php if($i%2==0){ ?>
            <td>Total <br><?php echo "100";?></td>
			<td>Grade</td>				<?php }} ?>
			<td colspan="1" class="text-center">Cumulative Marks<?php echo "[200]";?></td>
			<td colspan="1">Grade</td>
		</tr>
		<?php $htotal = 0;  


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
		foreach($resultData as $sub):?>

			
                    <?php 
                    $this->db->where('class_id',$classid);
                    $this->db->where('id',$sub['subject']);
                    $subjectname=$this->db->get('subject'); 
                    if($subjectname->num_rows()>0){
                        $subjectname=$subjectname->row();
                    
                    if(($subjectname->subject == "VALUE EDUCATION") || ($subjectname->subject =="WORK EDUCATION") || ($subjectname->subject == "ART/URDU")||($subjectname->subject == "SENSORIAL ACTIVITIES" ) || ($subjectname->subject == "HEALTH & PHYSICAL EDUCATION" )|| ($subjectname->subject == "DISCIPLINE" )){
                   if($subjectname->subject == "VALUE EDUCATION"){
                   $arrco[1]= $subjectname->id;
                 
                   $pi=$pi+1;
                   }
                   if($subjectname->subject == "WORK EDUCATION"){
                   $arrco[2]= $subjectname->id;
                    $pi=$pi+1;
                   }
                   if($subjectname->subject == "ART/URDU"){
                   $arrco[3]= $subjectname->id;
                    $pi=$pi+1;
                   }
                   if($subjectname->subject == "SENSORIAL ACTIVITIES"){
                   $arrco[4]= $subjectname->id;
                    $pi=$pi+1;
                   }
                     if($subjectname->subject == "HEALTH & PHYSICAL EDUCATION"){
                   $arrco[5]= $subjectname->id;
                    $pi=$pi+1;
                   }
                   
                   if($subjectname->subject == "DISCIPLINE"){
                   $arrco[6]= $subjectname->id;
                    $pi=$pi+1;
                   }
                 
                    }else{ $totalp+=200;?>
		<tr class="wight"> 
					 <td class="subject">	
                     <?php echo  $subjectname->subject;
                       ?> 
					</td>
			     <?php 
 				
                 $gtptal=0;
                 $subtatal=0;
		         ?>
				<?php  $i=1; $t=0; $coltptal=0;  foreach ($examid->result() as $value):?>
					<td class="center">	
					<?php   	$this->db->where('subject_id',$sub['subject']);
            					$this->db->where('class_id',$classid);
            					$this->db->where('stu_id',$studentInfo->id);
            					$this->db->where('exam_id',$value->exam_id);
            					$this->db->where('fsd',$fsd);
						$marks= $this->db->get('exam_info');
						if($marks->num_rows()>0){
							$marks=$marks->row();
						/*	$subtatal=$subtatal+$marks->marks;
							$gtptal= $gtptal+$marks->marks;
							$coltptal+=$marks->marks; */
							
							
							
							///////////////////////
							if(is_numeric($marks->marks) ){
							    $dfg =$marks->marks;
							    $subtatal=$subtatal+$marks->marks;
                      $gtptal= $gtptal+$marks->marks;
                      $ctotal[$t]+= $marks->marks;
                    }else{ $gtptal= $gtptal;}
							/////////////////////////
							echo $marks->marks;
						//	$ctotal[$t]+= $marks->marks;
							
							$this->db->where('subject_id',$sub['subject']);
					$this->db->where('class_id',$classid);
					$this->db->where('exam_id',$value->exam_id);
				$exammm=	$this->db->get('exam_max_subject')->row()->max_m;
				 if(is_numeric($exammm)){
                echo "/".$exammm;
               }
				$dhtm=$exammm+$dhtm;
						}
					
					?>
					</td>
					<?php if($i%2==0){
						?>
						<td class="center bold"><?php echo $subtatal; 
							$ctotal['tot'.$i]+=$subtatal;
							$gradecal =calculateGrade($subtatal,$classid);
						 $subtatal=0;?></td>

						<td class="center bold"><?php echo $gradecal;?></td>
					<?php } ?>
				            
				<?php $i++; $t++;endforeach; 
					

				for($j=$i; $j < 5; $j++){
               ?>
              <td class="center bold"></td>
              <?php if($i%2==0){ ?>
              <td class="center"><?php 
					$ctotal['tot'.$i]+=0;?>
						</td>
			 <td class="center bold"><?php echo calculateGrade($ctotal['tot'.$i],$classid); ?></td>
               <?php }}
		           ?>
				<td class="center bold"><?php  $rty = $gtptal/2; echo $gtptal;  ?></td>
			   <td class="center bold"><?php echo calculateGrade($rty,$classid)?></td>	
		</tr>
					<?php } }endforeach;?>
		<tr class="wight">
					<td class="subject">GRAND TOTAL</td>
					<?php $h=1;$i=0; foreach($ctotal as $cd):
					if($h<5){?>
					<td class="center">
					<?php echo $ctotal[$i];  ?>
					</td>
					<?php if($h%2==0){ ?>
					<td class="center bold"><?php $cumulativetotal+=$ctotal['tot'.$h];echo $ctotal['tot'.$h];?> </td> 
					<td class="center bold"></td>
					<?php 			} ?>
					<?php $h++; $i++; } endforeach;	
					?>
			<td class="center bold"><?php echo $cumulativetotal;?></td>
			<td class="center bold"></td>
		</tr>
		
		
		
		

			
		<tr class="tableHeader">	
			<td colspan="1" style="text-transform: uppercase;">B. CO-Scholastic Areas</td>
			<td colspan="3" style="text-transform: uppercase;">Descriptive Indicators</td>

			<td>Grade</td>
			<td colspan="3" style="text-transform: uppercase;">Descriptive Indicators</td>
			<td>Grade</td>
			<td colspan="1"  class="pink" style="text-transform: uppercase;">MARK PERCENTAGE  <?php //echo $totalp;  
			echo round((($cumulativetotal*100)/$dhtm), 2);?>% </td>
			<td colspan="1">RANK</td>
		</tr>
		
			
		<tr class="blue">
			<td colspan="2">ATTENDANCE  </td>
			<td colspan="9">Class Teachers Remark</td>
		</tr>
		<?php } ?>
		<!---other marksheet end(others)--->
			
		     	
			
		<?php if( $classid == 262 && $row2== "D" || $classid == 343 && $row2== "D" || $classid == 261 && $row2== "D" || $classid == 342 && $row2== "D"){ ?>
		<!---samta footer section not required--->
		
        <tr class="wight" style="border-top:none;">
            <td colspan="6" style="border:none;">
                <span style="">संक्षिप्तियों का अर्थ : Abbreviations</span></br>
                <span style="">AB:अनुपस्थित Absent  </span></br>
                <span style="">आं.मू.:आंतरिक मूल्यांकन</span></br>
                <span style="">IA: Internal Assessment</span></br>
                <span style="">प्रा. /PR. :प्रायोगिक /Practical</span></br>
                </br>
                </br>
                </br>
                <!--<span style="">दिल्ली Delhi:</span></br>-->
                <span style="">दिनांक Dated :</span>
            </td>
            <td colspan="6" style="border:none;">
                <span style=""></span></br>
                <span style="">परिणाम Result  </span></br>
                <span style=""></span></br>
                <span style=""></span></br>
                <span style=""></span></br>
                </br>
                </br>
                </br>
                <span style=""></span></br>
                <span style="">परीक्षा नियंत्रक Controller of Examinations :</span>
            </td>
		</tr>
		<!--<tr class="wight">
            <td colspan="12"  style="border-bottom: none;
    border-left: none;
    border-right: none;">
                <span style="">सह-शैक्षणिक उपलब्धियां: सह शैक्षणिक एवम् अनुशासन क्षेत्र में ट्रेडिंग विद्यालय द्वारा अपने स्तर पर बोर्ड द्वारा जारी प्रारुपनुसार प्रदान की जाती है | </span></br>
             <span style="">Co-Scholastic achievements : Grading for Co- Scholastic and Displine area is being issued by the school as per format prescribed by the Board.</span></br>
            </td>
		</tr>-->
		<?php }else{ ?>
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
        <?php } ?>
	</table>


<br /><br /><br /><br /><br /><br /><br />



	<?php 	} ?>
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