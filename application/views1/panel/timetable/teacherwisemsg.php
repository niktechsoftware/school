	<table class="table table-striped table bordered">
		<b><th>Period</th>
	
	<th>From</th>
	<th>To</th>
	<th>Subject</th>
	<th>Class</th>
	
	<th>Day</th></b>
 
<?php
$school_code=$this->session->userdata("school_code");
			$this->db->where("school_code",$school_code);
		$sender=$this->db->get("sms_setting");
				$sende_Detail =$sender;

			  		 $sende_Detail1=$sende_Detail->row();
	
 $msg=" ";
  	foreach($data1 as $data)
{

// $mobile=$data->mobile;
 $row1=$data->subject_id;
 $row2=$data->class_id;
 $row3=$data->period_id;
 $row4=$data->teacher;
 $row6=$data->subject_id;
 $row5=$data->day;

 $this->db->where('id',$row1);
 $sub=$this->db->get('subject')->row();
 $this->db->where('id',$row2);
$class=$this->db->get('class_info')->row();

$this->db->where('id',$row3);
$period=$this->db->get('period')->row();

$this->db->where('id',$row2);
$class=$this->db->get('class_info')->row();

if($row3==0)
	{$var1= "LUNCH"; }
else{$var1= $period->period;}

if($row3==0){$var2= "LUNCH"; } else{$var2= $period->to;}

if($row3==0){$var3= "LUNCH"; } else{$var3= $period->from;}

if($row1==0){$var4= "LUNCH"; }else{$var4= $sub->subject;}
if($row4==0){$var5= "LUNCH"; }else{$var5= $class->class_name;}

 ?>

<?php 



 $msg =$msg.
     $var1."-(".$var3.",".$var2.",".$var4.",".$var5.",".$row5.")"; 


}

 sms($mobile,$msg,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
	
	 redirect("index.php/timetablepanel/totalempwisetimetablepanel");

		  		
			  			

?>
</table>
