<div class="container">
					<div class="row">
							<div class="col-md-12">
								<!-- start: EXPORT DATA TABLE PANEL  -->
								<div class="panel panel-white">
									<div class="panel-heading panel-orange">
										<h4 class="panel-title">Exam <span class="text-bold">Time</span> Table</h4>
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
                                  <div class="alert alert-info"><h3 class="media-heading text-center">Welcome to Exam Time Table</h3>
                                  <p class="media-timestamp">In this section you see the exam time table/ schedule of every class/ shift.
                                  if you want see the list than you select subject on select exam name field and show all exam date or time of this subject.
                                  if you want any change on time delete any field, you can done it by using edit or delete button.</p></div>
										<div class="row">
											<div class="col-md-12 space20">
											<div class="col-">
										<label>
											Select Exam Name
											<select name="exam_name" id="exam_name" class="form-control">
												<option value="01">-Select-</option>
												<?php foreach ($request as $en):?>
												<option value="<?php echo $en->id?>"><?php echo $en->exam_name?></option>
												<?php endforeach;?>
											</select>
										</label>
											</div>
											
											</div>
										</div>
										
										<div class="table-responsive">


										<div id="printsub"></div>

										</div>
										</div>
										</div>
									</div>
								</div>

							</div>




















