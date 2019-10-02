<!--  
Niktech software Solutions,niktechsoftware.com,schoolerp-niktech.in
  <meta name="description" content="Welcome to niktech software School business ERP . we proving school management erp software. we including online attendance with biometric attendance machine and tracking student with GPS technology & many other facilities in our school management erp system">
  <meta name="keywords" content="Enterprise resource planning,school,ERP,system software,attendance,biometric,online, school management,gps,niktech software solution, online result, online admit card,omr">
  <meta name="author" content="School management System software">
-->
<?php
if($clah == "all"):
//$this->db->where("school_code",$this->session->userdata("school_code"));
$this->db->where("status",1);
	$student = $this->db->get("student_info");

else:
//$this->db->where("school_code",$this->session->userdata("school_code"));
$this->db->where("status",1);
	$this->db->where("house_id",$clah);
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
		<?php if($student->num_rows()>0){?>
			<table class="table table-striped table-hover" id="sample-table-2">
				<thead>
					<tr class ="success">
						<th>S.no.</th>
						<th>Student Id</th>
						<th>Student Name</th>
						<th>Class</th>
						<th>Father Name</th>
						<th>Father Mobile</th>
						<th>Address</th>
						<th>DOB</th>
						<th>House</th>
					
						<th>Full Detail</th>
					</tr>
				</thead>
				
				<tbody>
				<?php 
				$count=1;
				
				    foreach($student->result() as $stuDetail):
				    $stu_id = $stuDetail->id;
				    $this->db->where("school_code",$this->session->userdata("school_code"));
				    $this->db->where("student_id",$stu_id);
				    $rows = $this->db->get("guardian_info")->row();
				   ?>
				   <?php if($count%2==0){$rowcss="danger";}else{$rowcss ="warning";}?><tr class="<?php echo $rowcss;?>">
			  			
			  				<td><?php echo $count;?></td>
			  			<td><?php echo $stuDetail->username;?></td>
			  			<td><?php echo $stuDetail->name;?></td>
			  			<td><?php  $stuDetail->class_id;
	  			                  $this->db->where('school_code',$this->session->userdata("school_code"));
                                  $this->db->where('id',$stuDetail->class_id);
                       $classname=$this->db->get('class_info');
                       if($classname->num_rows()>0){
                                  $classdf=$classname->row();
                                  $this->db->where("id",$classdf->section);
                                  $secname = $this->db->get("class_section")->row()->section;
                                 echo $classdf->class_name."-".$secname;
                                 }?></td>
			  			<td><?php echo $rows->father_full_name;?></td>
			  		
			  			
			  			<td><?php echo $rows->f_mobile;?>
				     	</td>
			  			
			  			<td>
							<?php echo $stuDetail->address1."-".$stuDetail->city;?>
						</td>
			  			<td><?php echo date("d-m-Y",strtotime($stuDetail->dob));?>
			  			</td>
			  			<td><?php $this->db->where("id",$stuDetail->house_id);
			  			$hname = $this->db->get("house");
			  			if($hname->num_rows()>0){echo $hname->row()->house_name;}else{echo "not Define";}?></td>
			  			
			  			<td>
							<a href="<?php echo base_url(); ?>index.php/studentController/admissionSuccess/<?php echo $stuDetail->id;?>" target="_blank" class="btn btn-blue">
								View Detail
							</a>
			  			</td>
			  		</tr>
			  		<?php $count++; ?>
			  		<?php endforeach;}else{?>
			  	
			  		
			  		
				</tbody>
			</table>
			<?php }?>
			<div class ="alert alert-danger">Student Record Not Found in House.</div>
		</div>
		
		<br/><br/>
		
<script>
	TableExport.init();
</script>