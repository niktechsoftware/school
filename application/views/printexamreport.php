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
           
        
            <div class="row">
            <div class="col-md-2">

                 <center>
           <?php    $school_code=$this->session->userdata("school_code");?>
				
		<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/select2/select2.css" />-->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CORE CSS -->
		<!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">-->
		<!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles-responsive.css">-->
		<!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/plugins.css">-->
		<!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/themes/theme-default.css" type="text/css" id="skin_color">-->
		<!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/print.css" type="text/css" media="print"/>-->
		<!-- end: CORE CSS -->
		<!--<link rel="shortcut icon" href="favicon.ico" />-->
			
			
		<?php 	
		$m=1;
		
		$res=$this->db->query("SELECT  * FROM class_info where school_code='$school_code' ORDER BY id asc");
		$getClass = $res->result();
		$dad=$this->db->query("SELECT * FROM exam_day where exam_id='$examid'");
		?><table class="table table-striped table-hover" style="width:100%;" id="sample-table-2">
			<thead>
			 <?php $i=1; if($i%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
             <tr class="<?php echo $rowcss;?>">
					<th class="column-left"> Date Of Exam/<br>Class & Shift</th>
				<?php foreach ($dad->result() as $col):
				//print_r($dad->result());?>
				<th ><?php echo $col->date1;?></th>
			<?php endforeach;?>
		</thead>
		<tbody><?php $i=1;foreach ($getClass as $rowClass):
		?>
		<?php 
		    foreach ($shiftid->result() as $rowShift):
		
			?>
		 <?php if($i%2==0){$rowcss="warning";}else{$rowcss ="danger";}?>
            <tr class="<?php echo $rowcss;?>">
			<td class="column-left"><?php
				$this->db->where('id',$rowClass->section);
				 $this->db->order_by('id',"asc");
							$section=$this->db->get('class_section')->row()->section;
			echo $rowClass->class_name."[".$section."]";?>-<?php
			echo $rowShift->shift;
			?></td><?php 
			foreach ($dad->result() as $col):
			$j=1;
			?><td class="column-right" ><?php
				$subject=$this->db->query("SELECT subject_id,id FROM exam_time_table where exam_day_id='$col->id'  AND shift_id='$rowShift->id' AND class_id='$rowClass->id' AND school_code='$school_code'");
				foreach ($subject->result() as $sub):
					$subjectid=$sub->subject_id;
					$exam=$sub->id;

				?>
                  <?php    
                       $this->db->where('id',$subjectid);
                         $this->db->where('class_id',$rowClass->id);
                        $subject1=$this->db->get('subject')->result();            
                      foreach ($subject1 as  $value) {   
                           ?>

				
				<?php echo $value->subject; ?>
			
					
				<?php $m = $j++;
			}
				endforeach;
				?></td>
				
				
							<?php
			endforeach;
			?>
			<?php 
			endforeach;//claas print loop
			?>
			</tr><?php $i++;
		endforeach;//shift print loops
		
		?></tbody></table>
				
		
		
		<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/select2/select2.min.js"></script>-->
		<!--<script src="<?php echo base_url(); ?>assets/plugins/tableExport/tableExport.js"></script>-->
		<!--<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jquery.base64.js"></script>-->
		<!--<script src="<?php echo base_url(); ?>assets/plugins/tableExport/html2canvas.js"></script>-->
		<!--<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jquery.base64.js"></script>-->
		<!--<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jspdf/libs/sprintf.js"></script>-->
		<!--<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jspdf/jspdf.js"></script>-->
		<!--<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jspdf/libs/base64.js"></script>-->
		<!--<script src="<?php echo base_url(); ?>assets/js/table-export.js"></script>-->
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CORE JAVASCRIPTS  -->
		<!--<script src="<?php echo base_url(); ?>assets/js/main.js"></script>-->
		<!-- end: CORE JAVASCRIPTS  -->
		<!--<script>-->
		<!--		TableExport.init();-->
			
		<!--</script>							-->
		 

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