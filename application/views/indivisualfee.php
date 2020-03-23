<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-white">
									<div class="panel-heading panel-orange">
										<h4 class="panel-title">Define  Maximum <span class="text-bold">Marks, Subject Wise</span></h4>
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
															<form  action="<?= base_url();?>index.php/PayTransportFee" method="post">
										<div class="alert alert-info">
										    <h3 class="media-heading text-center">Welcome to Individual Fees Collection Area.</h3>
										    <p class="media-timestamp">If you want to collect individual student fee collection then enter student id and select fee type and select deposite month  and click on pay fee button. Then submit your individual fees and print your reciept.</p>
                                        </div>
									
								<div class="row">
									   	<div class="col-lg-4 col-md-4 col-sm-4">
                          <label>
                            Enter Student ID </br>
                            <input type="text" name="stuid" id="stuid">
                          </label>
											</div>
											
                      <div class="col-lg-4 col-md-4 col-sm-4">
                            <label>
                              Select Fee
                              
                              <select name="fee" id="fee" class="form-control" required="">
                               
                              </select>
                            </label>
											</div>
                      <div class="col-lg-4 col-md-4 col-sm-4">
                            <label>
                              Select Deposite Month
                              
                              <select name="month" id="month" class="form-control" required="">
                             
                            
                              </select>
                            </label>
											</div>
											
											
										</div>
										</br>

										<div class="row">
										<div id="getfeedata"></div>
										</div>
										</form>
									</div>
								</div>
							</div>
						</div>