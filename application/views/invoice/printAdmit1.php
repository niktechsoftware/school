<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

<title><?php echo $title; ?></title>

	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/css/invoice_css/prin_result.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/invoice_js/example.js'></script>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<style type="text/css">

	@media print
	{
			body * { visibility: hidden; }
			#printcontent * { visibility: visible; }
			#printcontent { position: absolute; top: 40px; left: 30px; }
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
	
    <script>
        function convert_number(number)
        {
            if ((number < 0) || (number > 999999999))
            {
                return "Number is out of range";
            }
            var Gn = Math.floor(number / 10000000);  /* Crore */
            number -= Gn * 10000000;
            var kn = Math.floor(number / 100000);     /* lakhs */
            number -= kn * 100000;
            var Hn = Math.floor(number / 1000);      /* thousand */
            number -= Hn * 1000;
            var Dn = Math.floor(number / 100);       /* Tens (deca) */
            number = number % 100;               /* Ones */
            var tn= Math.floor(number / 10);
            var one=Math.floor(number % 10);
            var res = "";

            if (Gn>0){
                res += (convert_number(Gn) + " Crore");
            }
            if (kn>0){
                res += (((res=="") ? "" : " ") +
                    convert_number(kn) + " Lakhs");
            }
            if (Hn>0){
                res += (((res=="") ? "" : " ") +
                    convert_number(Hn) + " Thousand");
            }

            if (Dn){
                res += (((res=="") ? "" : " ") +
                    convert_number(Dn) + " hundred");
            }


            var ones = Array("", "One", "Two", "Three", "Four", "Five", "Six","Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen","Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen","Nineteen");
            var tens = Array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty","Seventy", "Eigthy", "Ninety");

            if (tn>0 || one>0)
            {
                if (!(res==""))
                {
                    res += " and ";
                }
                if (tn < 2)
                {
                    res += ones[tn * 10 + one];
                }
                else
                {

                    res += tens[tn];
                    if (one>0)
                    {
                        res += ("-" + ones[one]);
                    }
                }
            }

            if (res=="")
            {
                res = "zero";
            }
            return res;
        }
        
        

    </script>
</head>

<body>
	<div id="printcontent" align="center" class="container">
	<br/><br/><br/>
	<?php
	$school_code = $this->session->userdata("school_code");

    $this->db->where("id",$school_code);
    $info =$this->db->get("school")->row();

    $fsd=$this->session->userdata('fsd');
    $this->db->where('class_id',$class_id);
    $this->db->where('fsd',$fsd);
    $this->db->where('status',1);
    $stu_id=$this->db->get('student_info');
    if($stu_id->num_rows()>0){
        foreach($stu_id->result() as $rowc){
	//  $this->db->where("username",$id);
	// $rowc = $this->db->get("student_info")->row();
	 $this->db->where("student_id",$rowc->id);
	 $this->db->where("school_code",$this->session->userdata("school_code"));
	 $pInfo = $this->db->get("guardian_info")->row();
	 //$fsd = $this->session->userdata("fsd");

	  $this->db->where('school_code',$school_code);
	  $this->db->where('id',$fsd);
	  $date=$this->db->get('fsd')->row();
	   $cyear = date('Y', strtotime($date->finance_start_date));
		$nyear = date('Y', strtotime($date->finance_end_date));
?>		

	<div id="page-wrap" style="width:1000px; border: 1px solid black; outline: 1px solid black; solid #333;">

		<table style="margin-left:10px;">
            <?php 
            
           
            ?>
			<tr>
			<td style="width:15%; border:none;">
					<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $info->logo;?>" style="width:100%;" />
				</td>
				<td style="text-align:center; border:none; width:70%;">
				<p style="text-transform:uppercase; text-align:center;font-size:25px"><b><?php echo $info->school_name; ?></b></p>
                <p style="font-variant:small-caps;font-size:20px">
            		<?php echo $info->address1." ".$info->address2." ".$info->city; ?>
                </p>
                <p style="font-variant:small-caps;font-size:20px">
            		<?php if(strlen($info->mobile_no > 0 )){echo $info->state." - ".$info->pin.", Phone : ".$info->mobile_no.", ";} ?>
                </p>
                <p style="border: 2px solid #000;font-size:20px; text-align:center;margin-left:auto;margin-right:auto; width:70%">
                <?php 
                $this->db->where("id",$exam_name);
                $exname  =	$this->db->get("exam_name")->row()->exam_name;
                $this->db->where("id",$this->session->userdata("fsd"))	;
                $fsdarray = $this->db->get("fsd")->row();
                $styear=date('Y',strtotime($fsdarray->finance_start_date));
                $etyear=substr(date('Y',strtotime($fsdarray->finance_end_date)),2);
                echo $exname." [ " .$styear."-".$etyear. " ]";?>
                <br>
                Admit Card : 
                <?php 
                $this->db->where("id",$rowc->class_id);
                $rtyg  =	$this->db->get("class_info")->row();
                $this->db->where("id",$rtyg->section);
                $section = $this->db->get("class_section")->row();
                echo $rtyg->class_name."-".$section->section; ?>
                </p>
				</td>
				<td style="width:15%; border:none;">&nbsp;</td>
			</tr>
		
		</table>
	<!--			<div class="row">  -->
				
 <!--   <div class="col-md-2">-->
 <!--       <img src="<?php //echo base_url();?>assets/<?php //echo $this->session->userdata("school_code");?>/images/empImage/<?php echo $info->logo;?>" alt="" width="80" />-->
 <!--   </div>-->
	<!--<div class="col-md-8">-->
	<!--<h2 align="center" style="text-transform:uppercase;"><b><?php //echo $info->school_name; ?></b></h2>-->
 <!--   <h4 align="center" style="font-variant:small-caps;padding:10px;">-->
	<!--	<?php //echo $info->address1." ".$info->address2." ".$info->city; ?>-->
 <!--   </h4>-->
 <!--   <h4 align="center" style="font-variant:small-caps;padding-bottom:10px;">-->
	<!--	<?php //if(strlen($info->mobile_no > 0 )){echo $info->state." - ".$info->pin.", Phone : ".$info->mobile_no.", ";} ?>-->
        
 <!--   </h4>-->
	<!--</div>-->

	<!--<div class="col-md-2"></div>-->
 <!--   </div>-->
        <hr/>
		<div style="clear:both"></div>
		
		<div id="customer">
        	<div style="display:inline-block; float:left; margin-left:20px;">
            <table> 
          
                     <tr>
                    	<td style="border:none;">
                        	
				  		<span style="font-size:18px">Student ID : <strong><?php echo $rowc->username; ?></strong></span>
				  		
                        </td>
                       
                    </tr>
                    <tr>
                     <td style="border:none;">
                        	
                     <span style="font-size:18px">	Roll Number : <strong>____________</strong>	(To Be Filled By School Office.)</span>
				  		
                        </td>
                    </tr>
                    <tr>
                    	<td style="border:none;">
                    	<span style="font-size:18px">	Student Name : <strong><?php echo $rowc->name ?></strong></span>

                        </td>
                    </tr>
                    <tr>
                    	<td style="border:none;">
                        <span style="font-size:18px">Father Name : <strong><?php echo $pInfo->father_full_name; ?></strong></span>
                        </td>
                    </tr>
                   
                 
            </table>
			</div>
			
			
			<div style="display:inline-block; float:right; margin-right:5px;">
            <table>
                <tr>
                    	<td style="border:none; line-height: 10px;">
                    		<img src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $rowc->photo; ?>"  alt="" width="75" />
                        </td>
                    </tr>
                   
            </table>
            </div>
            </div>
       <?php
            
            
            //$this->db->distinct();
           // $this->db->select("date1");
            $this->db->where("school_code",$this->session->userdata("school_code"));
             $this->db->where("exam_id",$exam_name);
          //  $this->db->where("start_date",$exam_date);
            $this->db->where("class_id",$class_id);
           //  $this->db->order_by("date1","asc");
             $exam_day=$this->db->get("exam_time_table")->row();
             //print_r($exam_day->exam_id);print_r($class_id);exit;
             ?>
        <br>
			<table id="items" align="center"  style="width:100%; margin-top:0px; alignment-adjust:central;">
					<thead>
						<th>Date</th>
                        <?php 
                        $this->db->where('exam_id',$exam_day->exam_id);
                        $date=$this->db->get('exam_day')->result();
                        foreach($date as $ed):?>
						<th><?php echo date("Y-m-d",strtotime($ed->date1));?></th>
						<?php endforeach;?>
					</thead>
					<tbody>
                        <?php
                        $this->db->where("exam_id",$exam_name);
                        //$this->db->where("to1",$exam_date);
                        $shift=$this->db->get("exam_shift")->result();
                        //print_r($exam_name);print_r($exam_date);exit;
                        foreach($shift as $s):
                        ?>
                        <tr>
                        <td><?php echo $s->shift;?></td>
                        <?php 
                         foreach($date as $ed):
						$this->db->where("school_code",$this->session->userdata("school_code"));
                        $this->db->where("exam_id",$exam_name);
                        $this->db->where("shift_id",$s->id);
                     //  $this->db->where("start_date",$exam_date);
                       $this->db->where("class_id",$rowc->class_id);
                        $this->db->where("exam_day_id",$ed->id);
						$etb = $this->db->get("exam_time_table");
						if($etb->num_rows()>0){
						   
                            foreach($etb->result() as $ff):
                                 if($ff->subject_id){
                                $this->db->where('id',$ff->subject_id);
                                $this->db->where('class_id',$ff->class_id);
                                 $subject=$this->db->get('subject');
                                    ?>
                                <td> <?php echo $subject->row()->subject;?></td>
                                
							<?php }else{?> <td> </td> <?php }
						endforeach;?>
                        <?php }else{ ?>
                            <td>-</td>
                            <?php } endforeach;?>
						</tr>
					<?php endforeach;?>
					</tbody>
			
            </table>
        <br>
		<div align="left" style="margin-left:20px;"><h4>&nbsp;Note 1.Exam timing for Shift <?php foreach($shift as $s):  echo $s->shift." - ".date('H:i A',strtotime($s->from1))." to ".date('H:i A',strtotime($s->to1))." "; endforeach; ?><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.Students reporting time is <?php foreach($shift as $s): $startt=strtotime("-30 minutes",strtotime($s->from1));
		$endt =strtotime("-00 minutes",strtotime($s->to1));
		echo $s->shift."-".date('H:i A', $startt)." "; endforeach; ?> </br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3) Bringing this admit card during exam is compulsory.</br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4) Unfair means or papers are strictly prohibited.</br>
		
		</div>
		</h4>
		<div>
		    <br/>
		<table id="items" align="center"  style="width:100%; margin-top:0px;alignment-adjust:central;">
		<tr>
		<td><br>(Signature)<br>Class Teacher</td><td><br>(Signature)<br>Principal</td>
		</tr>
		</table></div>
        <div> </div>
        <hr>
        
	</div>
	<?php }}else{echo "<span style='color:red'>Student not found</span>";}?>
	</div>

</body>
	<div class="invoice-buttons" style="text-align:center;">
    <button class="button button2" type="button"  onclick="window.print();">
      <i class="fa fa-print padding-right-sm"></i> Print
    </button>
  </div>
</html>