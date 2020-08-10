<!--  
Niktech software Solutions,niktechsoftware.com,schoolerp-niktech.in
  <meta name="description" content="Welcome to niktech software School business ERP . we proving school management erp software. we including online attendance with biometric attendance machine and tracking student with GPS technology & many other facilities in our school management erp system">
  <meta name="keywords" content="Enterprise resource planning,school,ERP,system software,attendance,biometric,online, school management,gps,niktech software solution, online result, online admit card,omr">
  <meta name="author" content="School management System software">
-->
<?php
if($cla == "all" && $sec == "all"):
$this->db->where("school_code",$this->session->userdata("school_code"));
$this->db->where("status","Active");
	$student = $this->db->get("student_info");
elseif($cla != "all" && $sec == "all"):
$this->db->where("status","Active");
$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("class_id",$cla);
	$student = $this->db->get("student_info");
else:
$this->db->where("school_code",$this->session->userdata("school_code"));
$this->db->where("status","Active");
	$this->db->where("class_id",$cla);
	$this->db->where("section",$sec);
	$student = $this->db->get("student_info");
endif;
?>

		<br/><br/>
		<div class="row">
			<div class="col-md-12 space20">
				<div class="btn-group pull-right">
					<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
						Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu dropdown-light pull-right">
						<li>
							<a href="#" class="export-excel" data-table="#sample-table-2" >
								Export to Excel
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-striped table-hover" id="sample-table-2">
				<thead>
					<tr class ="success">
						<th>S.no.</th>
						<th>Student Id</th>
						<th>Student Name</th>
						<th>Father Name</th>
						<th>Father Mobile</th>
						<th>Address</th>
						<th>DOB</th>
						<th>Login ID</th>
						<th>Password</th>
						<th>Full Detail</th>
					</tr>
				</thead>
				
				<tbody>
				<?php 
				$count=1;
				    foreach($student->result() as $stuDetail):
				    $stu_id = $stuDetail->student_id;
				    $this->db->where("school_code",$this->session->userdata("school_code"));
				    $this->db->where("student_id",$stu_id);
				    $rows = $this->db->get("guardian_info")->row();
				   ?>
				   <?php if($count%2==0){$rowcss="danger";}else{$rowcss ="warning";}?><tr class="<?php echo $rowcss;?>">
			  			<td><?php echo $count;?></td>
			  			<td><?php echo $stu_id;?>
			  			<td><?php echo $stuDetail->first_name." ".$stuDetail->midd_name." ".$stuDetail->last_name;?></td>
			  			<td><?php echo $rows->father_full_name;?></td>
			  		
			  			
			  			<td><?php echo $rows->f_mobile;?>
				     	</td>
			  			
			  			<td>
							<?php echo $stuDetail->address1." ".$stuDetail->address2." ".$stuDetail->city.",".$stuDetail->state."-".$stuDetail->pin_code;?>
						</td>
			  			<td><?php echo date("d-m-Y",strtotime($stuDetail->date_ob));?>
			  			</td>
			  			<td><?php echo $stuDetail->username;?></td>
			  				<td><?php echo $stuDetail->password;?></td>
			  			<td>
							<a href="<?php echo base_url(); ?>index.php/studentController/admissionSuccess/<?php echo $stuDetail->student_id;?>" target="_blank" class="btn btn-blue">
								View Detail
							</a>
			  			</td>
			  		</tr>
			  		<?php $count++; ?>
			  		<?php endforeach;?>
			  		
				</tbody>
			</table>
		</div>
		
		<br/><br/>
		
<script>
	TableExport.init();
</script>