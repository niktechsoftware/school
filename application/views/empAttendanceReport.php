						<div class="panel panel-white">
									<div class="panel-heading">
										<h4 class="panel-title">Teacher <span class="text-bold">Attendance Report</span></h4>
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
							<div class="panel-body">

							<div class="alert alert-info"><h3 class="media-heading text-center">Teacher Attendance Report</h3>
							<p class="media-timestamp">
							    Here you can see Teacher Attendance Report, Please select starting date and end date for seeing teacher attendance report and wait for another page.
                            </p>
                            </div>
								<div class="col-sm-12">
									<div class="form-group col-sm-4">
										<label class="col-sm-4 control-label" for="form-field-20">
											Start Date<span class="symbol required"></span>
										</label>
										<div class="col-sm-8">
											<input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years" id="sdate" name="startdate" class="form-control date-picker">
										</div>
									</div>

									<div class="form-group col-sm-4">
										<label class="col-sm-4 control-label" for="form-field-20">
											End Date<span class="symbol required"></span>
										</label>
										<div class="col-sm-8">
											<input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years" id="edate" name="enddate" class="form-control date-picker">
										</div>
									</div>
								</div>
								<div class="table-responsive" id="showTeacherAtendance">

								</div>
							</div>
					</div>