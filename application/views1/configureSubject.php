<!-- start: PAGE CONTENT -->
						<div class="row">
							<div class="col-sm-12">
								<!-- start: INLINE TABS PANEL -->
								<div class="panel panel-white">
									<div class="panel-body">
										<div class="alert alert-info">
											<center><h3 class="media-heading"><b>Important Instructions about Adding Subjects to a Class.</b></h3></center>
                    						<p class="media-timestamp">Welcome to Add Subject area where we can attach Subjects belonging to a Class. Please ensure that we have created Stream, Class, and Section. After that we can able to take admission in any Class.
                    						 to add Subject choose Stream Name, Section Name and Class Name respectively . Please type your <strong> Subject
                      Name</strong> into the box given below and Press 
                    <strong>Add Subject</strong> Button.</p>
                    						<p class="media-timestamp">
                    						For	Update your Subject in the boxes given in the chart  Press <strong>Edit </strong>Button And to <strong>Delete</strong> a Subject simply Press <strong>Delete</strong> Button below the Chart.
                    						</p>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<div class="panel-heading panel-red border-light">
													<h4 class="panel-title">Select Stream</h4>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<select id="clname" class="form-control">
															<option value="">--Select--</option>
															<?php if(isset($StreamList)){?>
															<?php foreach ($StreamList as $row){
																 
																  $streamid=$row->stream;
																 $this->db->where('id',$streamid);
																$row2=$this->db->get('stream')->row(); 
                                                                ?>
															<option value="<?php echo $row2->id;?>"><?php echo $row2->stream;?></option>
															<?php } }?>
														</select>
													</div>
													<div class="text-red text-small">Please select a Stream, Section and Class will automatically come select and add subject.</div>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="panel-heading panel-green border-light">
													<h4 class="panel-title">Select Section</h4>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<select id="sectionList" class="form-control">
															
														</select>
													</div>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="panel-heading panel-blue border-light">
													<h4 class="panel-title">Select Class</h4>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<select id="classlist" class="form-control">
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
		<div class="row" id="subjectBox">
		</div>
						
					
						<!-- end: PAGE CONTENT-->