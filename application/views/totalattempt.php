<div class="row">
							<div class="col-md-12">
								<!-- start: DYNAMIC TABLE PANEL -->
								<div class="panel panel-white">


								  <div class="panel-heading panel-purple">

										<h4 class="panel-title"> <span class="text-bold">Objective Question</span></h4>

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
									<br>
									<div class="panel-body" id="txt" >
<div class="alert alert-info">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to Student Questions</h3>
          <p class="media-timestamp">Welcome To Objective Questions Area,There will be question shows here and you will click on a radio button to select the answer and click on the save&next button to save your answer.Click on previous button to go to previous question.
When all questions are answered, then click on submit button.
        </div>
 
						<div class="row" >
						    <div class="col-md-2 col-lg-2 col-sm-2"></div>
						<div class="col-md-8 col-lg-8 col-sm-8">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-blue border-light">
                          <h4 class="panel-title" style="font-size:150%;">Total Attempt Quesion List:</h4>
                          <p id="demo" style="margin-left:80%; font-size:150%;"></p>
                        </div>
                        <div class="panel-body" id="list">
                            <?php $i=1;foreach($result1->result() as $res):
                            $this->db->where('id',$res->question_id);
                            $ques=$this->db->get('question_master')->row();
                            ?>
                            
                            <p style="font-size:20px;"><?php echo $i;?>.<?php echo $ques->question;?></p>
                            <?php $i++;endforeach;?>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>