
<?php $school_code = $this->session->userdata("school_code");?>
<div class="container">
<form action="<?php echo base_url(); ?>index.php/newAdmissionControllers/addinfo" method="post" id="form">
	<div class="row">
		<div class="col-sm-12">
			<!-- start: FORM WIZARD PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading panel-pink">
					<h4 class="panel-title">Student  <span class="text-bold">Registration</span>
						<a class="btn btn-danger" href="<?php echo base_url();?>index.php/login/quickRegistraionStudent">Quick Registration</a>
                    </h4>
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
					</div>
				</div>
				<!-- End Heading panel -->
				<div class="panel-body">
				        <div class="alert alert-info">
          <button data-dismiss="alert" class="close">Ã—</button>
          <h3 class="media-heading text-center">Welcome to New Admission Area</h3>
         Here you can Enroll new Student in your School, by filling this Student Registration form.
          You can also Quick Register any Student by click on Quick Registration Button.
        </div>
				<!-- --------------------------------------------Student Test Form Start ---------------------------------------- -->
					<div class="row">
						<div class="col-md-12">
							<div class="errorHandler alert alert-danger no-display">
								<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
							</div>
							<div class="successHandler alert alert-success no-display">
								<i class="fa fa-ok"></i> Your form validation is successful!
							</div>
						</div>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Scholar Number <span id="schlor" Style="color:red;" class="symbol"></span>
										</label>
										<input type="text" value="<?php echo set_value('scholerNumber'); ?>" class="form-control" id="scholerNumber" onkeyup="stuScholar()" name="scholerNumber" style='text-transform:uppercase'>
									</div>
								</div>
									<div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Serial Number <span id="schlor" Style="color:red;" class="symbol"></span>
										</label>
										<input type="number" value="<?php echo set_value('serial_Number'); ?>" class="form-control" id="serial_Number" onkeyup="stuScholar()" name="serial_Number" style='text-transform:uppercase'>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											 Book Number <span id="fname" Style="color:red;" class="symbol required"></span>
										</label>
										<input type="number" value="<?php echo set_value('book_Number'); ?>" class="form-control"
										onkeyup="stuScholar()" id="book_Number" name="book_Number" style='text-transform:uppercase'>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											 Name <span id="fname" Style="color:red;" class="symbol required"></span>
										</label>
										<input type="text" value="<?php echo set_value('firstName'); ?>" class="form-control"
										onkeyup="stuFirstname()" id="firstName" name="firstName" required ="required" style='text-transform:uppercase'>
									</div>
								</div>
								
							</div>

							<div class="row">
							    <div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Date Of Birth <span class="symbol required">(yyyy-mm-dd)</span>
										</label>
										<input type="date" value="<?php echo set_value('dob'); ?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years" min="1990-01-01" max="2017-12-31" onkeyup="checkDOB()"name="dob" id="dob" class="form-control date-picker" required ="required">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Gender  <span class="symbol required" required ="required"></span>
										</label>
										<div>
											<label class="radio-inline text-uppercase">
												<input type="radio" class="grey" value="0" name="gender" id="gender_female" >
												Female
											</label>
											<label class="radio-inline text-uppercase">
												<input type="radio" class="grey" value="1" name="gender"  id="gender_male">
												Male
											</label>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Blood Group <span class="symbol"></span>
										</label>
										<select class="form-control" name="bloodgp" id="bloodgp" >
		                                      <option value="">SELECT BLOOD GROUP</option>
		                                      <option value="A+">A+</option>
		                                      <option value="A-">A-</option>
		                                      <option value="B+">B+</option>
		                                      <option value="B-">B-</option>
		                                      <option value="O+">O+</option>
		                                      <option value="O-">O-</option>
		                                      <option value="AB+">AB+</option>
		                                      <option value="AB-">AB-</option>
	                                	</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Birth Place <span id="bplace" Style="color:red;" class="symbol"></span>
										</label>
										<input type="text" value="<?php echo set_value('birthPlace'); ?>" class="form-control" onkeyup="stuBirthPlace()" id="birthPlace" name="birthPlace" style='text-transform:uppercase'>
									</div>
								</div>
						
							</div>
							<div class="row">
							    		<div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Mother Tongue <span class="symbol"></span>
										</label>
										<select class="form-control" id="mothertongue" name="mothertongue">
											<option value="">SELECT MOTHER TONGUE</option>
											<option value="HINDI" selected>HINDI</option>
											<option value="ENGLISH">ENGLISH</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Category <span class="symbol text-uppercase"></span>
										</label>
										<select class="form-control" id="category" name="category">
											<option value="">SELECT CATEGORY</option>
											<option value="GEN">GEN</option>
											<option value="OBC">OBC</option>
											<option value="SC">SC</option>
											<option value="ST">ST</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Religion <span class="symbol"></span>
										</label>

									<select  class="form-control" id="religion" name="religion">
											<option value="">SELECT RELIGION</option>
											<option value="HINDUISM" <?php if(set_value('religion')=="HINDUISM"){echo 'Selected="selected"';}?>>HINDUISM</option>
											<option value="ISLAM" <?php if(set_value('religion')=="ISLAM"){echo 'Selected="selected"';}?>>ISLAM</option>
											<option value="CHRISTIANITY" <?php if(set_value('religion')=="CHRISTIANITY"){echo 'Selected="selected"';}?>>CHRISTIANITY</option>
											<option value="BUDDISM"<?php  if(set_value('religion')=="BUDDISM"){echo 'Selected="selected"';}?> >BUDDISM</option>
											<option value="JAINISM"<?php if(set_value('religion')=="JAINISM"){echo 'Selected="selected"';}?>>JAINISM</option>
											<option value="OTHER" <?php if(set_value('religion')=="OTHER"){echo 'Selected="selected"';}?>>OTHER</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Address Line 1 <span id="stuadd" Style="color:red;" class="symbol required"></span>
										</label>
										<input type="text" value="<?php echo set_value('addLine1'); ?>" class="form-control" onkeyup="stuAddress()" id="addLine1" name="addLine1" required ="required"style='text-transform:uppercase'/>
									</div>
								</div>
								
							</div>
							
							<div class="row">
							    <div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											State <span  id="error" Style="color:red;" class="symbol required"></span>
										</label>
										<select class="form-control" id="empState" name="state"  required="required">
											<option value="">-SELECT STATE-</option>
											<?php foreach($state as $row):?>
											<option value="<?php echo $row->state; ?>"><?php echo $row->state; ?></option>
											<?php endforeach; ?>
										</select>

									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											City <span id="error" Style="color:red;" class="symbol required"></span>
										</label>
										<select class="form-control" id="empCity" name="city" value="<?php echo set_value('city'); ?>" required="required" style='text-transform:uppercase'>
														</select>
										</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Area <span id="error" Style="color:red;" class="symbol"></span>
										</label>
										<select class="form-control" id="area" name="addLine2" value="<?php echo set_value('addLine2'); ?>" required="required" style='text-transform:uppercase'>
														</select>

									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Pin Code <span id="error" Style="color:red;" class="symbol required"></span>
										</label>
										<input type="text" class="form-control" id="empPin" name="pinCode" data-type="pin" value="<?php echo set_value('empPin'); ?>" required="required" >

									</div>
								</div>
								
							</div>
							
							<div class="row">
							    <div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											House/Team <span id="house" class="symbol"></span>
										</label>
										<select class="form-control" id="house" name="house" >
											<option value="">-SELECT HOUSE-</option>
											<?php 
											$this->db->where("school_code",$this->session->userdata("school_code"));
											$gethouse =$this->db->get("house");
											if($gethouse->num_rows()>0){
											foreach($gethouse->result() as $r):?>
											<option value="<?php echo $r->id; ?>"><?php echo $r->house_name; ?></option>
											<?php endforeach; }?>
										</select>
										</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Mobile Number <span id="error" Style="color:red;" class="symbol required"></span>
										</label>
										<input type="text" value="<?php echo set_value('mobileNumber'); ?>" data-type="mobileNumber" maxLength="10" placeholder="mobile number for SMS" pattern="[6-9]{1}[0-9]{9}" class="form-control" id="mobileNumber" name="mobileNumber">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											E-mail Address <span id="emailID" Style="color:red;" class="symbol"></span>
										</label>
										<input type="text" value="<?php echo set_value('email'); ?>" class="form-control" onkeyup="stuEmailId()"  id="email1" name="emailAddress">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label text-uppercase">
											Aadhar Number <span id="error" Style="color:red;" class="symbol"></span>
										</label>
										<input type="text"  class="form-control" data-type="adhaar-number" maxLength="14" name="aadhar_number">
									</div>
								</div>
							
							</div>
						<!-- 6 row -->
							<div class="row">
							    	<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												 Admission Date<span class="symbol required">(yyyy-mm-dd)</span>
											</label>
											<input type="date" value="<?php echo set_value('dateOfAdmission'); ?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years" min="2018-01-01" max="Date()" name="dateOfAdmission" id="doa" class="form-control date-picker">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group text-uppercase">
											<label for="password" class="control-label">
												Password <span class="symbol required"></span>
											</label>
											<input type="password" value="<?php echo set_value('password'); ?>" class="form-control" id="password" name="password" title="Please enter at least 5 or more characters" required/>
										</div>
									</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="ConfirmPassword" class="control-label text-uppercase">
											Confirm Password <span id="cpass" class="symbol required"></span>
										</label>
										<input type="password" value="<?php echo set_value('password_again'); ?>" class="form-control" onkeyup='check();' id="ConfirmPassword" name="password_again" />
									</div>
								</div>
								<?php	$fsdvalue=	$this->session->userdata('fsd');
										//echo $fsdvalue."fg";
											$this->db->where('school_code',$school_code);
											$this->db->where('id',$fsdvalue)	;
											$fsd1=	$this->db->get('fsd');?>
								<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Fsd <span id="fsd" Style="color:red;" class="symbol required"></span>
											</label>
											<select class="form-control" id="fsd" name="fsd" required ="required">
												<!--<option> Select Fsd</option>-->
												<?php
												
										
											//	$fsd1 = $this->db->query("SELECT * FROM fsd WHERE school_code='$school_code'");
											    if($fsd1->num_rows()>0){
													// $this->db->where("id",$row->finance_start_date);
												// $fsd2 = $this->db->get("fsd")->row();
												echo '<option value="'.$fsd1->row()->id.'">'.date("d-M-Y", strtotime($fsd1->row()->finance_start_date)).'</option>';
											}
												?>


											</select>
										</div>
									</div>

							</div>
						<!-- end row 6 -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-sm-12">
			<!-- start: FORM WIZARD PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading panel-green">
					<h4 class="panel-title text-uppercase">Parent  <span class="text-bold text-uppercase">Information</span></h4>
					<div class="panel-tools">
						<div class="dropdown">
							<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
								<i class="fa fa-cog"></i>
							</a>
							<ul class="dropdown-menu dropdown-light pull-right" role="menu">
								<li >
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
					</div>
				</div> <!-- End Heading panel -->
				<div class="panel-body">
				<!-- --------------------------------------------Test Form Start ---------------------------------------- -->
						<div class="row">
							<div class="col-md-12">
								<div class="errorHandler alert alert-danger no-display">
									<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
								</div>
								<div class="successHandler alert alert-success no-display">
									<i class="fa fa-ok"></i> Your form validation is successful!
								</div>
							</div>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Father Name <span id="faname" Style="color:red;" class="symbol required"></span>
											</label>
											<input type="text" value="<?php echo set_value('fatherName'); ?>" class="form-control" onkeyup="stuFathername()" id="fatherName" name="fatherName" required ="required" style='text-transform:uppercase'/>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Mother Name <span id="maname" Style="color:red;" class="symbol required"></span>
											</label>
											<input type="text" value="<?php echo set_value('motherName'); ?>" class="form-control" onkeyup="stuMothername()" id="motherName" name="motherName" required ="required" style='text-transform:uppercase'/>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Caretaker Name <span id="carename" Style="color:red;" id="caretname" Style="color:red;" class="symbol"></span>
											</label>
											<input type="text" value="<?php echo set_value('guardianName'); ?>" class="form-control" onkeyup="stucaretaker()" id="guardianName" name="guardianName" style='text-transform:uppercase'/>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Caretaker Relation <span id="caretrel" Style="color:red;" class="symbol"></span>
											</label>
											<input type="text" value="<?php echo set_value('guardianRelation'); ?>" class="form-control" onkeyup="stucaretakerRelation()" id="guardianRelation" name="guardianRelation" style='text-transform:uppercase'/>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Father's Education <span id="faedu" Style="color:red;" class="symbol"></span>
											</label>
											<input type="text" value="<?php echo set_value('fatherEducation'); ?>" class="form-control" onkeyup="stuFatherEdu()" id="fatherEducation" name="fatherEducation"  style='text-transform:uppercase'/>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Mother's Education <span id="maedu" Style="color:red;" class="symbol"></span>
											</label>
											<input type="text" value="<?php echo set_value('motherEducation'); ?>" class="form-control" onkeyup="stuMotherEdu()" id="motherEducation" name="motherEducation" style='text-transform:uppercase'/>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Father's Occupation <span id="faoccu" Style="color:red;" class="symbol"></span>
											</label>
											<input type="text" value="<?php echo set_value('fatherOccupation'); ?>" class="form-control" onkeyup="stuFatherOccup()" id="fatherOccupation" name="fatherOccupation" style='text-transform:uppercase'/>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Mother's Occupation <span id="maoccu" Style="color:red;" class="symbol"></span>
											</label>
											<input type="text" value="<?php echo set_value('motherOccupation'); ?>" class="form-control" onkeyup="stuMotherOccup()" id="motherOccupation" name="motherOccupation" style='text-transform:uppercase'/>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Family Annual Income  <span id="familyincome" Style="color:red;" class="symbol"></span>
											</label>
											<input type="text" value="<?php echo set_value('familyAnnualIncome'); ?>" class="form-control" onkeyup="stuFamilyIncome()" id="familyAnnualIncome" name="familyAnnualIncome" style='text-transform:uppercase'/>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Address <span id="Padress" Style="color:red;" class="symbol required"></span>
												<input type="checkbox" id="sameAddress" /> if same as student.
											</label>
											<input type="text" value="<?php echo set_value('parentAddress'); ?>" class="form-control" id="parentAddress" onkeyup="stuFamilyAdress()" name="parentAddress" style='text-transform:uppercase'/>
										</div>
									</div>
										<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Area <span id="Padress" Style="color:red;" class="symbol required"></span>
											</label>
											<input type="text" value="<?php echo set_value('area'); ?>" class="form-control" id="area" onkeyup="garea()" name="area" style='text-transform:uppercase'/>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												city  <span id="Pcity" Style="color:red;" class="symbol required"></span>
											</label>
											<input type="text" value="<?php echo set_value('parentCity'); ?>" class="form-control" id="parentCity" onkeyup="stuParentCity()" name="parentCity" style='text-transform:uppercase'/>
										</div>
									</div>
								
								</div>
								<div class="row">
								    	<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												State <span id="Pstate" Style="color:red;" class="symbol required"></span>
											</label>
											<input type="text" value="<?php echo set_value('parentState'); ?>" class="form-control" id="parentState" onkeyup="stuParentstate()" name="parentState" style='text-transform:uppercase'/>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Pin  <span id="error" Style="color:red;" class="symbol required"></span>
											</label>
											<input type="text" value="<?php echo set_value('parentPin'); ?>" class="form-control" id="parentPin" name="parentPin" data-type="ppin" />
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Country  <span id="pcontry" Style="color:red;" class="symbol required"></span>
											</label>
											<input type="text" value="<?php echo set_value('parentCountry'); ?>" class="form-control" id="parentCountry" onkeyup="stuParentCountry()" name="parentCountry" required ="required" style='text-transform:uppercase'/>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Father's Mobile Number <span id="error" Style="color:red;" class="symbol required"></span>
												<input type="checkbox" id="sameMobile" /> if same.
											</label>
											<input type="text" value="<?php echo set_value('fatherMobileNumber'); ?>" class="form-control" data-type="fathermobileNumber" maxLength="10" id="fatherMobileNumber" name="fatherMobileNumber" required ="required"/>
										</div>
									</div>
								
								</div>
								<div class="row">
	                                  <div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Mother's Mobile Number <span id="error" Style="color:red;" class="symbol"></span>
											</label>
											<input type="text" value="<?php echo set_value('motherMobileNumber'); ?>" class="form-control" maxLength="10" data-type="maamobileNumber" id="motherMobileNumber" name="motherMobileNumber" />
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Select Transport Services  <span id="error" Style="color:red;" class="symbol"></span>
											</label>

										<select class="form-control"  name="ts" id="ts" required ="required">
											<option value="N/A">SELECT</option>
											<option value="1">YES</option>
											<option value="0">NO</option>
										</select>
										</div>
									</div>
									<div class="col-md-9" id ="jsdiv">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Vehicle Type <span class="symbol"></span>
											</label>
											<select class="form-control"  name="vt" id="vt" >
											<option value="">SELECT VEHICLE</option>
											<?php
											$this->db->distinct();
											$this->db->select("vehicle_name,id,vehicle_numnber");
											$this->db->select("vehicle_numnber");
											$this->db->where("school_code",$this->session->userdata("school_code"));
											$rts = $this->db->get("transport");
											if($rts->num_rows()>0){
											foreach($rts->result() as $row):?>

											<option value="<?php echo $row->id;?>"><?php echo $row->vehicle_name."[".$row->vehicle_numnber."]";?></option>

										<?php endforeach; }?></select></div>
									</div>
								 	<div class="col-md-4">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Pickup Points  <span id="error" Style="color:red;" class="symbol"></span>
											</label>

										<select class="form-control"  name="pickup" id="pickup" >
										</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Amount <span id="error" Style="color:red;" class="symbol required"></span>
											</label>
											<!--<select class="form-control"  name="pickupAmount" id="pickupAmount" >-->
											<input type="text" value="<?php //echo $personalInfo->amount; ?>" class="form-control" id="pickupAmount" name="pickupAmount" />

											</select>
										</div>
									</div>

								</div>
								</div>


							</div>
						</div>

				</div>
			</div>
			</div>
			</div>

<div class="row">
		<div class="col-sm-12">
			<!-- start: FORM WIZARD PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading panel-pink">
					<h4 class="panel-title text-uppercase">School <span class="text-bold text-uppercase">Information</span></h4>
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
					</div>
				</div> <!-- End Heading panel -->
				<div class="panel-body">
				<!-- --------------------------------------------Test Form Start ---------------------------------------- -->
						<div class="row">
							<div class="col-md-12">
								<div class="errorHandler alert alert-danger no-display">
									<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
								</div>
								<div class="successHandler alert alert-success no-display">
									<i class="fa fa-ok"></i> Your form validation is successful!
								</div>
							</div>
							<div class="col-md-12">
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Stream <span class="symbol required"></span>
											</label>
											<select class="form-control" id="stream" name="stream" required ="required">
												<option> SELECT STREAM</option>
												<?php
												$sub = $this->db->query("SELECT DISTINCT stream FROM class_info WHERE school_code='$school_code'");
												if($sub->num_rows()>0){
												foreach($sub->result() as $row):
												$this->db->where("id",$row->stream);
												$sname = $this->db->get("stream")->row();
												echo '<option value="'.$row->stream.'">'.$sname->stream.'</option>';
												endforeach;}
												?>
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group text-uppercase">
											<label class="control-label">
												Section <span id="error" Style="color:red;" class="symbol required"></span>
											</label>
											<select class="form-control" id="section1" name="section">
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Class Of Admission <span class="symbol required"></span>
											</label>
											<select class="form-control" id="classOfAdmission1" name="classOfAdmission" required ="required">
											</select>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label text-uppercase">
												Discount Type <span class="symbol required"></span>
											</label>
											<select class="form-control" id="discount" name="discount" required ="required">
												<option> SELECT DISCOUNT TYPE</option>
											<?php
												$sub = $this->db->query("SELECT DISTINCT * FROM discounttable WHERE school_code='$school_code'")->result();
												foreach($sub as $row):
													if(strlen($row->discount_head)<3){
																	$this->db->where('id',$row->discount_head);
																	$head=$this->db->get('discount_head')->row();
																	?><option value="<?php echo $head->id;?>"><?php echo $head->disc_head; ?></option>
																	<?php 
													}else{
														//$head=$row->discount_head;
														?><option value="<?php echo $row->id;?>"><?php echo $row->discount_head; ?></option>
												<?php 
													}
												
												endforeach;
												?>
											</select>
										</div>
									</div>
								</div>




<div class="row">
<div class="col-md-3">
	<div class="form-group text-uppercase" id="disc_div1">
		<label class="control-label ">
			Teacher/Student Id1 <span class="symbol required"></span>
		</label>
		<input type="text" class="form-control text-uppercase" id="id1" name="id1" />
	</div>
</div>

<div class="col-md-3">
	<div class="form-group text-uppercase" id="disc_div2">
		<label class="control-label">
		Teacher/Student Id2 <span id="error" Style="color:red;" class="symbol required"></span>
		</label>
		<input type="text" class="form-control text-uppercase" id="id2" name="id2"/>
	</div>
</div>

<div class="col-md-3">
	<div class="form-group text-uppercase" id="disc_div3">
		<label class="control-label ">
		Teacher/Student Id3 <span class="symbol required"></span>
		</label>
		<input type="text" class="form-control text-uppercase" id="id3" name="id3"/>
	</div>
</div>

<div class="col-md-3">
	<div class="form-group text-uppercase" id="disc_div4">
		<label class="control-label ">
		Teacher/Student Id4 <span class="symbol required"></span>
		</label>
		<input type="text" class="form-control text-uppercase" id="id4" name="id4"/>
	</div>
</div>
</div>
					<div class="row" id="sub1234"></div>

					</div>

				</div>
			</div>

	</div>
			</div>
		</div>
		<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->
			
		<div class="row">
		<div class="col-sm-12">
			<!-- start: FORM WIZARD PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading panel-blue">
					<h4 class="panel-title text-uppercase">Previous School/class Detail</span></h4>
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
					</div>
				</div> <!-- End Heading panel -->
				<div class="panel-body">
				<!-- --------------------------------------------Test Form Start ---------------------------------------- -->
						<div class="row">
							<div class="col-md-12">
								<div class="errorHandler alert alert-danger no-display">
									<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
								</div>
								<div class="successHandler alert alert-success no-display">
									<i class="fa fa-ok"></i> Your form validation is successful!
								</div>
							</div>
							<div class="col-md-12">
								<div class="row table-responsive">
									<table class="table">
											<thead>
												<tr class='text-uppercase'>
												<th Style="text-align:center;">Class</th>
												<th Style="text-align:center;">School Name<span id="schname" Style="color:red;"></span></th>
												<th Style="text-align:center;">Passing Year<span id="passy" Style="color:red;"></span></th>
												<th Style="text-align:center;">Roll No.<span id="rool" Style="color:red;"></span></th>
												<th Style="text-align:center;">Marks<span id="marks" Style="color:red;"></span></th>
												<th Style="text-align:center;">Percentage<span id="persent" Style="color:red;"></span></th>
												<th Style="text-align:center;">Subject<span id="sub" Style="color:red;"></span></th>
												</tr>
											</thead>
											<tbody>
											<tr>
												<td>
												<select class="form-control" id="pClass" name="pClass">
												<option value="">SELECT CLASS</option>
												<?php if(isset($className)):?>
													<?php foreach ($className as $row):?>
												<option value="<?php echo $row->class_name;?>"><?php echo $row->class_name;?></option>
													<?php endforeach;?>
												<?php endif;?>
											</select>

												</td>
												<td><input type="text" class="form-control" value="<?php echo set_value('pschool'); ?>" onkeyup="oldstuSchname()" id="pSchool" name="pSchool" style='text-transform:uppercase'/></td>
											
												<td><input type="text" class="form-control" onkeyup="oldstuYear()" id="pYear" name="pYear" value="<?php echo set_value('pYear'); ?>" style='text-transform:uppercase'/></td>
											
												<td><input type="text" class="form-control" onkeyup="oldstuRoll()" id="pRoll" name="pRoll" value="<?php echo set_value('pRoll'); ?>" style='text-transform:uppercase'/></td>
											
												<td><input type="text" class="form-control" onkeyup="oldstuMarks()" id="pMarks" name="pMarks" value="<?php echo set_value('pMarks'); ?>" style='text-transform:uppercase'/></td>
											
												<td><input type="text" class="form-control" onkeyup="oldstuPercentage()" id="pPercentage" name="pPercentage" value="<?php echo set_value('pPercentage'); ?>" style='text-transform:uppercase'/></td>
											
												<td><input type="text" class="form-control" onkeyup="oldstuSub()" id="pSubject" name="pSubject" value="<?php echo set_value('pSubject'); ?>" style='text-transform:uppercase'/></td>
											</tbody>
										</table>
								</div>
								</div>

							</div>
						</div>

				</div>
			</div>
		</div>
		
		
		<div class="row">
		<div class="col-sm-12">
			<!-- start: FORM WIZARD PANEL -->
			<div class="panel panel-white">
				<div class="panel-heading panel-green">
					<h4 class="panel-title text-uppercase">Term & Condition</span></h4>
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
					</div>
				</div>
		<div class="panel-body">
				<div class="row">   
				
		         	<label for="inputEmail3" class="col-sm-1 control-label"></label>
			            <div class="col-sm-11">
			        	<input type="checkbox" id="terms" name="terms" value="Yes"> I accept the <a href="#" style="color: blue">Policy and Terms & Conditions. </a><br>
			        	<span class="symbol required"></span>Required Fields
			        	
			        		<p style="float:right;">
								    By click on REGISTER, Then you are accepted the Policy and Terms &amp; Conditions.
								</p>
		            	</div>
            	   			   
			    </div>			


<!-----------------------------SUBMIT OR Registration Button------------------------------------------------------>

		

						<!--<div class="row">-->
						<!--	<div class="col-md-12">-->
						<!--		<div>-->
						<!--			<span class="symbol required"></span>Required Fields-->
						<!--			<hr>-->
						<!--		</div>-->
						<!--	</div>-->
						<!--</div>-->
						
						<div class="row">
							<div class="col-md-8">
							
							</div>
							<div class="col-md-4">
								<input type="submit" value="REGISTER" class="btn btn-yellow btn-block"/>
							</div>
						</div>
				</div>
			</div>	
		</div>
	</div>
	
	</form>
	</div>

<script> doa.max = new Date().toISOString().split("T")[0]; </script>