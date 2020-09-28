						
						<form action="<?php echo base_url();?>index.php/employeeController/quickreginsert"  method ="post" role="form" class="form-horizontal" id="form">
						<div class="row">
							<div class="col-sm-12">
								<!-- start: FORM WIZARD PANEL -->
								<div class="panel panel-white">
									<div class="panel-heading panel-blue">
										<h4 class="panel-title">  <span class="text-bold">Employee Registration Form</span></h4>
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
										<div id="wizard" class="swMain">
                                        <div class="form-group">
                                               <div class="col-sm-5">
													<label class="col-sm-5 control-label">
													Name  <span class="symbol required"></span>
													</label>
													<div class="col-sm-7">
														<input type="text"   minLength="5" maxLength="15"  onkeyup="qnamevalidation();" class="form-control text-uppercase" id="empFirstName" name="empName" value="<?php echo set_value('empFirstName'); ?>" required="required"/>
													    <!-- <span  class="text-danger" id="fname"></span> -->
													</div>
													<?php echo form_error('empFirstName'); ?>
												</div>
												<div class="col-sm-5">
													<label class="col-sm-5 control-label">
													Address <span class="symbol required"></span>
													</label>
													<div class="col-sm-7">
														<input type="text" onkeyup="qAddress();"    minLength="5" maxLength="20" class="form-control text-uppercase" id="employeeAddLine1" name="employeeAddLine1" value="<?php echo set_value('employeeAddLine1'); ?>" required="required" />
													</div>
													<?php echo form_error('employeeAddLine1'); ?>
												</div>
												
											</div>
												
											<div class="form-group">
												<div class="col-sm-5">
													<label class="col-sm-5 control-label">
														Gender <span class="symbol required"></span>
													</label>
													<div class="col-sm-7">
														<label class="radio-inline">
															<input type="radio" class="grey" value="0" name="gender" value="<?php echo set_value('gender'); ?>" id="gender_female" >
															Female
														</label>
														<label class="radio-inline">
															<input type="radio" class="grey" value="1" name="gender" value="<?php echo set_value('gender'); ?>"  id="gender_male">
															Male
														</label>
													</div>
													<?php echo form_error('gender'); ?>
												</div>
													<div class="col-sm-5">
													<label class="col-sm-5 control-label">
													Mobile Number  <span class="symbol required"></span>
													</label>
													<div class="col-sm-7">
														<input type="text" class="form-control" minLength="10" maxLength="10" id="empmobileNumber" value="<?php echo set_value('empmobileNumber'); ?>" 
														name="empmobileNumber"   onkeypress="return isNumber(event)" onkeyup="mobilevalidation();" required="required" pattern="[6-9]{1}[0-9]{9}" />
													    <span class="text-danger" id="mobile"></span>
													</div>
												<?php echo form_error('empmobileNumber'); ?>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-5">
													<label class="col-sm-5 control-label">
														Joining Date <span class="symbol required"></span>
													</label>
													<div class="col-sm-7">
														<input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years" id="j_date" name="j_date"  onchange="checkjoin()" value="<?php echo set_value('j_date'); ?>" class="form-control date-picker" required="required"/>
													</div>
													<?php echo form_error('j_date'); ?>
												</div>
												
											
											<div class="col-sm-5">
													<label class="col-sm-5 control-label">
														Job Category  <span class="symbol required"></span>
													</label>
													<div class="col-sm-7">
														<select class="form-control text-uppercase" id="jobCategory" name="jobCategory" value="<?php echo set_value('jobCategory'); ?>" required="required">
															<option value="0">-Category-</option>
															<option value="1">Accountent</option>
															<option value="2">Employee</option>
															<option value="3">Teacher</option>
															<option value="4">Principal</option>
														</select>
													</div>
													<?php echo form_error('jobCategory'); ?>
												</div>
												</div>
												
												 <div class="form-group" id="stanrow">
                                                    <div class="col-sm-5">
                                                      <label class="col-sm-5" id="standlbl">
                                                        Select Standered <span class="symbol required"></span>
                                                      </label>
                                                      <div class="col-sm-7">
                                                        <select class="form-control text-uppercase" id="standered" name="standered"
                                                          value="<?php echo set_value('standered'); ?>" required="required">
                                                          <option value="0">-Standered-</option>
                                                          <option value="1">PG to UKG</option>
                                                          <option value="2">1 to 5</option>
                                                          <option value="3">6 to 8</option>
                                                          <option value="4">9 to 10</option>
                                                          <option value="5">11 to 12</option>
                                                        </select>
                                                      </div>
                                                      <?php echo form_error('standered'); ?>
                                                    </div>
                                                    <div class="col-sm-5">
                                                     
                                                    </div>

              </div>
										</div>
									</div><!-- end: BODY PANEL -->
								</div>
								<!-- end: FORM WIZARD PANEL -->
							</div>
						</div>

<!-- ------------------------------------------------ LOGIN INFORMATION --------------------------------------------- -->							
						<div class="row">
							<div class="col-sm-12">
								<!-- start: FORM WIZARD PANEL -->
								<div class="panel panel-white">
									<div class="panel-heading panel-blue">
										<h4 class="panel-title"><span class="text-bold">Login Information</span></h4>
									</div>
									<div class="panel-body">
										<div class="form-group">
											<div class="col-sm-5">
												<label class="col-sm-5 control-label">
													Password <span class="symbol required"></span>
												</label>
												<div class="col-sm-7">
													<input type="password" class="form-control" id="password" name="password" required="required" >
												</div>
												<?php echo form_error('password'); ?>
											</div>
											<div class="col-sm-5">
												<label class="col-sm-5 control-label">
													Re-Password <span class="symbol required"></span>
												</label>
												<div class="col-sm-7">
													<input type="password" onkeyup="qcheck();" class="form-control" id="re-password" name="re-password" required="required" >
												    <span id="cpass"></span>
												</div>
												<?php echo form_error('re-password'); ?> 
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-2 col-sm-offset-8">
												<input type="submit" class="btn btn-blue next-step btn-block"
													value="Save Employee"/>
											</div>
										</div>
									</div>
								</div>
							</div>
								<!-- end: FORM WIZARD PANEL -->
						</div>				
					</form>
					
			