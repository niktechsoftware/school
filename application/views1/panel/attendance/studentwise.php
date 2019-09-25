<div class="row">
<div class="col-md-12">
<!-- start: RESPONSIVE TABLE PANEL -->


<div class="panel-body panel-scroll"  style="height:auto" >
<table class="table table-bordered table-hover " id="a_tb">
<thead>
<tr class="text-center">
<th class="text-center">S No.</th>
<th class="text-center">Student Userid</th>
<th class="text-center">Attendence (Green for present,Red for absent)</th>
<th class="text-center">Attendence Date/Day</th>
<th class="text-center">Shift 1</th>
<th class="text-center">Shift 2</th>

<!-- <th>Activity</th> -->
</tr>
</thead>
<tbody>
<?php 
//$username=$this->session->userdata("username");
$this->db->where("username",$username);
$this->db->where("status",1);
$id=$this->db->get("student_info")->row();

// $this->db->where("stu_id",$id->id);
$this->db->where("class_id",$id->class_id);
$this->db->where("school_code",$this->session->userdata('school_code'));
$dt=$this->db->get("school_attendance")->result();
// echo "<pre>";
// print_r($dt);exit;
?>

<?php $v=1;$p=0;$a1=0; foreach($dt as $row):
?><tr>
<td class="text-center"><?php echo $v; ?> </td>
<td class="text-center"><?php echo $username;?></td>


<?php 

$this->db->where("class_id",$row->class_id);
$this->db->where("stu_id",$id->id);
$this->db->where("attendance",0);
$this->db->where("a_date",$row->date);
$this->db->where("school_code",$this->session->userdata('school_code'));
$a=$this->db->get("attendance");
if($a->num_rows()>0){ ?>
<td class="text-center">
 <svg height="30" width="30">
  <circle cx="15" cy="15" r="13" stroke="black" stroke-width="1" fill="red" />
</svg>  
</td>
<td class="text-center"><?php echo $a->row()->a_date; $at=$a->row()->a_date; echo " ( ".date('D', strtotime("D", strtotime($at)))." )"; ?></td>
<td class="text-center"><?php if($a->row()->shift_1==1){echo "YES";}else{echo "NO";}?></td>
<td class="text-center"><?php if($a->row()->shift_2==1){echo "YES";}else{echo "NO";};?></td>
<?php $p=$p+1;}else{ 
  ?>
  <td class="text-center">
    <svg height="30" width="30">
  <circle cx="15" cy="15" r="13" stroke="black" stroke-width="1" fill="green" />
</svg> 
</td>
<td class="text-center"><?php echo $row->date; $at=$row->date; echo " ( ".date('D', strtotime("D", strtotime($at)))." )"; ?></td>
<td class="text-center"><?php echo "YES";?></td>
<td class="text-center"><?php echo "NO";?></td>
  <?php $a1=$a1+1;}?>


 

</tr>	<?php $v++; endforeach; ?>
</tbody>
<div class="row">
	<div class="col-md-6">
			<div><label>Student Id:</label>&nbsp;<label><strong><?php echo $username;  ?></strong></label></div>
			<div><label>Name:</label>&nbsp;<label><strong><?php echo $name;  ?></strong></label></div>
			<div><label>Class:</label>&nbsp;<label><strong><?php echo $class; ?></strong></label></div>
			<div><label>Section:</label>&nbsp;<label><strong><?php echo $section;?><strong></label></div>
	</div>
	<div class="col-md-6">
		<div><label>Attendence (in %):</label>&nbsp;<label><strong><?php $totatt=$p+$a1;if($totatt!=0){echo round(($a1/$totatt)*100,2) ."%";}else{echo "0%";}?><strong></label></div>
			
        <?php $totatt=$p+$a1;if($totatt!=0){ ?>
		<div><label>Total Attendence=</label><label><?php echo $totatt; ?></label></div>
		<div><label>Total Present =</label><label><?php echo $a1; ?></label></div>
		<div><label>Total Absent =</label><label><?php echo $absent= $totatt-$a1; ?></label></div>
		<?php } ?>
	</DIV>
</div>
</table>
</div>

</div>
</div>