<!--  
Niktech software Solutions,niktechsoftware.com,schoolerp-niktech.in
  <meta name="description" content="Welcome to niktech software School business ERP . we proving school management erp software. we including online attendance with biometric attendance machine and tracking student with GPS technology & many other facilities in our school management erp system">
  <meta name="keywords" content="Enterprise resource planning,school,ERP,system software,attendance,biometric,online, school management,gps,niktech software solution, online result, online admit card,omr">
  <meta name="author" content="School management System software">
-->

<?php
if(($classv == "all") && $sec == ("all")):
$this->db->where("school_code",$this->session->userdata("school_code"));
$this->db->where("givenWorkDate<=",$fsd1);
$this->db->where("DueWorkDate>=",$fsd2);
	$student = $this->db->get("homework");

elseif(($classv != "all") && ($sec == "all")):
$this->db->where("school_code",$this->session->userdata("school_code"));
$this->db->where("givenWorkDate<=",$fsd1);
$this->db->where("DueWorkDate>=",$fsd2);
$this->db->where("class",$classv);
	$student = $this->db->get("homework");
else:
$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("givenWorkDate<=",$fsd1);
	$this->db->where("DueWorkDate>=",$fsd2);
	$this->db->where("class",$classv);
	$this->db->where("section",$sec);
	$student = $this->db->get("homework");
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
						<th>Home Work </th>
						<th>Subject</th>
						<th>Discription</th>
						<th>Uploaded File</th>
						<th>Remark</th>
						<th>Work For</th>
						
					</tr>
				</thead>
				
				<tbody>
				<?php 
				$count=1;
				    foreach($student->result() as $hwDetail):
				   
				   ?>
				   <?php if($count%2==0){$rowcss="danger";}else{$rowcss ="warning";}?><tr class="<?php echo $rowcss;?>">
			  			<td><?php echo $count;?></td>
			  			<td><?php echo $hwDetail->work_name;?></td>
			  			<td><?php echo $hwDetail->subject;?></td>
			  			<td><?php echo $hwDetail->subject;?></td>
			  		
			  			
			  			<td><?php echo $hwDetail->subject;?>
				     	</td>
			  			
			  			<td>
							<?php echo $hwDetail->subject;?>
						</td>
			  			<td><?php echo $hwDetail->subject;?>
			  			</td>
			  			<td><?php echo $hwDetail->subject;?></td>
			  				<td><?php $hwDetail->subject;?></td>
			  			<td>
							<a href="<?php echo base_url(); ?>index.php/studentController/admissionSuccess/<?php echo $hwDetail->subject;?>" target="_blank" class="btn btn-blue">
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