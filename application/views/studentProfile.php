<script>
    function autoResize(id){
        var newheight;
        var newwidth;

        if(document.getElementById){
            newheight=document.getElementById(id).contentWindow.document .body.scrollHeight;
            newwidth=document.getElementById(id).contentWindow.document .body.scrollWidth;
        }

        document.getElementById(id).height= (newheight) + "px";
        document.getElementById(id).width= (newwidth) + "px";
    }
</script>

<div class="row">
	<div class="col-sm-12">
		<?php 
			if(isset($studentProfile)):
				$personalInfo = $studentProfile->row();
				$gurdianInfo = $gurdianDetail->row();
				$sectionname = $sectionName->row();
				$school_code=$this->session->userdata("school_code");
				$id=$this->session->userdata("username");
			    $cid=$personalInfo->class_id;
			    $this->db->where('id',$cid);
			   $data= $this->db->get('class_info')->row();
			  $cnm= $data->class_name;
			  $sid=$data->section;
			   $this->db->where('id',$sid);
			   $data1= $this->db->get('class_section')->row();
			   $sec=$data1->section;
			
		
		?>
		<div class="tabbable">
			<ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
				<li<?php if(strlen($this->uri->segment(4)) <= 0){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#panel_overview">
						Profile
					</a>
				</li>
				<!--<li<?php // if($this->uri->segment(4) == 'Fee Report'){ echo ' class="active"';}?>>-->
				<!--	<a data-toggle="tab" href="#fee_report">-->
				<!--		Fee Report-->
				<!--	</a>-->
				<!--</li>-->
				<li<?php if($this->uri->segment(4) == 'Attendance'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#attendance_report">
						Attendance
					</a>
				</li>
				<li<?php if($this->uri->segment(4) == 'Print Profile'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#print_report">
						Print Profile
					</a>
				</li>
				<li<?php if($this->uri->segment(4) == 'Purchase Report'){ echo ' class="active"';}?>>
					<a data-toggle="tab" href="#Purchase_report">
						Purchase Report
					</a>
				</li>
			</ul>

			<div class="tab-content">
				<div id="panel_overview" class="tab-pane fade <?php if(strlen($this->uri->segment(4)) <= 0){ echo "in active";}?>">
					<div class="row">
						<div class="col-sm-5 col-md-4">
							<div class="user-left">
								<div class="center">
									<h4><?php echo $personalInfo->name; ?></h4>
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div style="width: 140px; height: 150px; border: 1px solid #ccc;">
											<?php if(strlen($personalInfo->photo > 0)):?>
												<img alt="<?php echo $personalInfo->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $personalInfo->photo;?>" />
											<?php else:?>
												<?php if($personalInfo->gender == '1'):?>
													<img alt="<?php echo $personalInfo->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/stuMale.png" />
												<?php endif;?>
												<?php if($personalInfo->gender == '0'):?>
													<img alt="<?php echo $personalInfo->name;?>" height="148" width="138" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/stuFemale.png" />
												<?php endif;?>
											<?php endif;?>
										</div>
									</div>
								</div>
								<table class="table table-condensed table-hover">
									<thead>
										<tr>
											<th colspan="3">School information</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Scholar No.</td>
											<td>
												<?php if(strlen($personalInfo->scholer_no) > 1) {echo $personalInfo->scholer_no; }else echo "N/A"; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
											<tr>
											<td>Serial No.</td>
											<td>
												<?php if(strlen($personalInfo->sno) > 1) {echo $personalInfo->sno; }else echo "N/A"; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
											<tr>
											<td>Book No.</td>
											<td>
												<?php if(strlen($personalInfo->book_no) > 1) {echo $personalInfo->book_no; }else echo "N/A"; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Admission Date</td>
											<td>
												<?php echo date("d-M-Y", strtotime($personalInfo->adm_date)); ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
										    
											<td>Class</td>
											<td>
												<?php echo $cnm." - ".$sec; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Login ID</td>
											<td>
												<?php echo $personalInfo->username; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Password</td>
											<td>
												<?php echo $personalInfo->password; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-sm-6 col-md-8">
								<table class="table table-condensed table-hover">
									<thead>
										<tr>
											<th colspan="3">Personal Information</th>
										</tr>
									</thead>
									<tbody>
										<!--<tr>-->
										<!--	<td>Student ID</td>-->
										<!--	<td>-->
										<!--		<?php echo $personalInfo->id; ?>-->
										<!--	</td>-->
										<!--	<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>-->
										<!--</tr>-->
										<tr>
											<td>Full Name</td>
											<td>
												<?php echo $personalInfo->name; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Date Of Birth</td>
											<td>
												<?php echo date("d-M-Y", strtotime($personalInfo->dob)); ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Gender</td>
											<td>
												<?php if($personalInfo->gender==1){echo "Male";}else{echo "Female";} ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Blood Group</td>
											<td>
												<?php if(strlen($personalInfo->bloodgp) > 1) {echo $personalInfo->bloodgp; }else echo "N/A"; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Birth Place</td>
											<td>
												<?php if(strlen($personalInfo->birth_place) > 1) {echo $personalInfo->birth_place; }else echo "N/A"; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Nationality</td>
											<td>
												<?php if(strlen($personalInfo->nationality) > 1) {echo $personalInfo->nationality; }else echo "N/A"; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Mother Tongue</td>
											<td>
												<?php if(strlen($personalInfo->mother_tongue) > 1) {echo $personalInfo->mother_tongue; }else echo "N/A"; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Category</td>
											<td>
												<?php if(strlen($personalInfo->category) > 1) {echo $personalInfo->category; }else echo "N/A"; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Religion</td>
											<td>
												<?php if(strlen($personalInfo->religion) > 1) {echo $personalInfo->religion; }else echo "N/A"; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
									</tbody>
								</table>
								<table class="table table-condensed table-hover">
									<thead>
										<tr>
											<th colspan="3">Contact information</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Address</td>
											<td>
												<?php echo $personalInfo->address1; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>City / State / PIN</td>
											<td>
												<?php echo $personalInfo->city." / ".$personalInfo->state." / ".$personalInfo->pin_code; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Country</td>
											<td>
												<?php echo $personalInfo->country; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										
										<tr>
											<td>Mobile Number</td>
											<td>
												<?php echo $personalInfo->mobile; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>E-Mail</td>
											<td>
												<?php if(strlen($personalInfo->email) <= 0){ echo "N/A"; }else{ echo $personalInfo->email; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
									</tbody>
								</table>
								<table class="table table-condensed table-hover">
									<thead>
										<tr>
											<th colspan="3">Guardian information</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Father Name</td>
											<td>
												<?php echo $gurdianInfo->father_full_name; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Mother Name</td>
											<td>
												<?php echo $gurdianInfo->mother_full_name; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Caretaker Name</td>
											<td>
												<?php echo $gurdianInfo->caretaker_name; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Caretaker Relation</td>
											<td>
												<?php if(strlen($gurdianInfo->caretaker_relation) <= 0){ echo "N/A"; }else{ echo $gurdianInfo->caretaker_relation; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Father Education</td>
											<td>
												<?php if(strlen($gurdianInfo->father_education) <= 0){ echo "N/A"; }else{ echo $gurdianInfo->father_education; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Mother Education</td>
											<td>
												<?php if(strlen($gurdianInfo->mother_education) <= 0){ echo "N/A"; }else{ echo $gurdianInfo->mother_education; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Father Occupation</td>
											<td>
												<?php if(strlen($gurdianInfo->father_occupation) <= 0){ echo "N/A"; }else{ echo $gurdianInfo->father_occupation; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Mother Occupation</td>
											<td>
												<?php if(strlen($gurdianInfo->mother_occupation) <= 0){ echo "N/A"; }else{ echo $gurdianInfo->mother_occupation; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Family Annual Income</td>
											<td>
												<?php if(strlen($gurdianInfo->family_annual_income) <= 0){ echo "N/A"; }else{ echo $gurdianInfo->family_annual_income; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Address</td>
											<td>
												<?php echo $gurdianInfo->address; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>City / State / PIN</td>
											<td>
												<?php echo $gurdianInfo->city." / ".$gurdianInfo->state." / ".$gurdianInfo->pin; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Country</td>
											<td>
												<?php echo $gurdianInfo->country; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Land-line Number</td>
											<td>
												<?php if(strlen($gurdianInfo->f_mobile) <= 0){ echo "N/A"; }else{ echo $gurdianInfo->f_mobile; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Father Cell-Number</td>
											<td>
												<?php echo $gurdianInfo->f_mobile; ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Mother Cell-Number</td>
											<td>
												<?php if(strlen($gurdianInfo->m_mobile) <= 0){ echo "N/A"; }else{ echo $gurdianInfo->m_mobile; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Father E-Mail</td>
											<td>
												<?php if(strlen($gurdianInfo->f_email) <= 0){ echo "N/A"; }else{ echo $gurdianInfo->f_email; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
										<tr>
											<td>Mother E-Mail</td>
											<td>
												<?php if(strlen($gurdianInfo->m_email) <= 0){ echo "N/A"; }else{ echo $gurdianInfo->m_email; } ?>
											</td>
											<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
										</tr>
									</tbody>
								</table>
						</div>
					</div>
				</div>
<!-- ---------------------------------------------------------------------------------------------------------------------- -->	
				<div id="attendance_report" class='tab-pane fade <?php if($this->uri->segment(4) == 'Attendance'){ echo "in active";}?>'>
				<div class="row">
<div class="col-md-12">
<!-- start: RESPONSIVE TABLE PANEL -->
<div class="panel panel-white">
<div class="panel-heading panel-blue">
<h4 class="panel-title">Student <span class="text-bold">Attendance Detail</span></h4>
<div class="panel-tools">
<div class="dropdown">
<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
<i class="fa fa-cog"></i>
</a>
<ul class="dropdown-menu dropdown-light pull-right" role="menu">
<li>
<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
</li>
<li>
<a class="panel-refresh" href="#">
<i class="fa fa-refresh"></i> <span>Refresh</span>
</a>
</li>
<li>
<a class="panel-config" href="#panel-config" data-toggle="modal">
<i class="fa fa-wrench"></i> <span>Configurations</span>
</a>
</li>
<li>
<a class="panel-expand" href="#">
<i class="fa fa-expand"></i> <span>Fullscreen</span>
</a>
</li>
</ul>
</div>
<a class="btn btn-xs btn-link panel-close" href="#">
<i class="fa fa-times"></i>
</a>
</div>
</div>
<div class="panel-body panel-scroll height-450" >
<table class="table table-bordered table-hover " id="a_tb">
<thead>
<tr class="text-center">
<th class="text-center">S No.</th>
<th class="text-center">Student Userid</th>

<th class="text-center">Attendance (Green for present,Red for absent)</th>
<th class="text-center">Attendance Date</th>
<th class="text-center">Shift 1</th>
<th class="text-center">Shift 2</th>

<!-- <th>Activity</th> -->
</tr>
</thead>
<tbody>
<?php 
$username=$this->session->userdata("username");
$this->db->where("username",$username);
$id=$this->db->get("student_info")->row()->id;

$this->db->where("stu_id",$id);
$dt=$this->db->get("attendance")->result();
?>

<?php $v=1;$p=0;$a1=0; foreach($dt as $row):
?><tr>
<td class="text-center"><?php echo $v; ?> </td>
<td class="text-center"><?php echo $username;?></td>

<td class="text-center"><?php $this->db->where("attendance",0);
$a=$this->db->get("attendance")->result();
if($row->attendance==1){ ?>
 <svg height="30" width="30">
  <circle cx="15" cy="15" r="13" stroke="black" stroke-width="1" fill="green" />
</svg>  
<?php $p=$p+1; }else{ //echo 'Absent';?>
    <svg height="30" width="30">
  <circle cx="15" cy="15" r="13" stroke="black" stroke-width="1" fill="red" />
</svg> 
<?php $a1=$a1+1; };?></td>

<td class="text-center"><?php echo $row->a_date; $at=$row->a_date; echo " ( ".date('D', strtotime("D", strtotime($at)))." )"; ?></td>
<td class="text-center">

<?php echo $row->shift_1;?></td>

</td>
<td class="text-center"><?php echo $row->shift_2;?></td> 

</tr>	<?php $v++; endforeach; ?>

</tbody>

           <span style="font-size:20px;">Attendence (in %) = <?php $totatt=$p+$a1;if($totatt!=0){echo round(($p/$totatt)*100,2) ."%";}else{echo "0%";}?></span>
        
</table>
</div>
</div>
</div>
</div>
			</div>
				<div id="fee_report" class="tab-pane fade <?php if($this->uri->segment(4) == 'Fee Report'){ echo "in active";}?>">                                      

									
					<div class="row">
<div class="col-md-12">
<!-- start: RESPONSIVE TABLE PANEL -->
<div class="panel panel-white">
<div class="panel-heading panel-blue">
<h4 class="panel-title">Student <span class="text-bold">Fees Detail</span></h4>
<div class="panel-tools">
<div class="dropdown">
<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
<i class="fa fa-cog"></i>
</a>
<ul class="dropdown-menu dropdown-light pull-right" role="menu">
<li>
<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
</li>
<li>
<a class="panel-refresh" href="#">
<i class="fa fa-refresh"></i> <span>Refresh</span>
</a>
</li>
<li>
<a class="panel-config" href="#panel-config" data-toggle="modal">
<i class="fa fa-wrench"></i> <span>Configurations</span>
</a>
</li>
<li>
<a class="panel-expand" href="#">
<i class="fa fa-expand"></i> <span>Fullscreen</span>
</a>
</li>
</ul>
</div>
<a class="btn btn-xs btn-link panel-close" href="#">
<i class="fa fa-times"></i>
</a>
</div>
</div>
<div class="panel-body panel-scroll " >
<table class="table table-bordered table-hover " id="f_tb1">
<thead>
<tr class="text-center">
<th class="text-center">S No.</th>
<th class="text-center">Student Id</th>

<th class="text-center">Total Fees</th>
<th class="text-center">Deposit Months</th>
<th class="text-center">Payment Mode </th>
<th class="text-center">Late Fees</th>
<th class="text-center">Paid Amount</th>
<th class="text-center">Pending Amount</th>

<!-- <th>Activity</th> -->
</tr>
</thead>

<?php 
$this->db->where("username",$this->session->userdata("username"));
$id=$this->db->get("student_info")->row()->id;
$this->db->where("student_id",$id);
$dt=$this->db->get("fee_deposit")->result();
?>
<?php $v=1; foreach($dt as $row):
$sid=$row->student_id;
$this->db->where('id',$sid);
$stud_unm= $this->db->get('student_info')->row();

?><tbody>
	<tr>
<td class="text-center"><?php echo $v; ?> </td>
<td class="text-center"><?php echo $stud_unm->username;?></td>

<td class="text-center"><?php $dte= $row->total; echo $dte;?></td>

<td class="text-center"><?php echo $row->deposite_month;?></td>
<td class="text-center"><?php if($row->payment_mode==1){ echo "Cash";} else{ echo "Online";}?></td>
<td class="text-center"><?php echo $row->late;?></td> 
<td class="text-center"><?php $pd= $row->paid; echo $pd?></td> 
<td class="text-center"><?php $cr=$dte-$pd; echo $cr;?></td> 

</tr>	<?php $v++; endforeach; ?>

</tbody>
</table>
</div>
</div>
</div>
</div>
				</div>
				
				<div id="print_report" class="tab-pane fade <?php if(!$this->uri->segment(4) == 'Print Profile'){ echo "in active";}?>">
					<div class="panel-body">
						<IFRAME src="<?php echo base_url(); ?>index.php/invoiceController/printProfile/<?php echo $id; ?>" width="100%" height="200px" id="iframe1" style="border: 0px;" onLoad="autoResize('iframe1');"></iframe>
					</div>
				</div>
				
				
				<div id="Purchase_report" class="tab-pane fade <?php if($this->uri->segment(4) == 'Purchase Report'){ echo "in active";}?>">
					<div class="panel-body">
					 <?php 	 
					$unm = $this->session->userdata("username");
                    $this->db->where("username",$unm);
                    $dt= $this->db->get("student_info")->row();
                    $fsd= $dt->fsd;
                    $id= $dt->id;
                    $this->db->where("id",$fsd);
                    $dt1= $this->db->get("fsd")->row();
                    $school_code=$dt1->school_code;
					$this->db->where("school_code",$school_code);
					$this->db->where("valid_id",$id);
			   				 $row = $this->db->get("sale_info"); ?> 
			    		<table class="table table-striped table-hover" id="sample-table-2"> 
			    				<thead><tr>
			    				<th>S.no.</th>
			    				<th>Item No.</th>
			    				<th>Purchase Date</th>
			    				<th>Balance</th>
			    				<th>Total Paid</th>
			    				<th>Bill No.</th>
			    				</tr>
			    			</thead>
			    			<tbody>	
			    		 <?php		$i=1; 	
						foreach($row->result() as $rows):
						$this->db->where('billno',$rows->bill_no);
						$bal=$this->db->get('sale_balance');
						if($bal->num_rows()>0){ 
							$balance1= $bal->row();?> 
								
			    				 <tr>
			    				<td> <?php echo $i;?> </td>
			    				<td> <?php echo $rows->item_no;?> </td>
			    				<td> <?php echo $rows->date;?> </td>
			    				<td> <?php echo $balance1->balance;?> </td>
			    				<td> <?php echo $balance1->paid;?> </td>
			    				<td> <?php echo $rows->bill_no;?> </td>
			    				</tr>
			    				<?php $i++; }
			    				endforeach; ?> 
			    			</tbody>	
			    		</table>
					</div>
				</div>
			</div>
		</div>
		<?php 
			endif;
		?>
	</div>
	</div>
