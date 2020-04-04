<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-sm-12">
		<!-- start: INLINE TABS PANEL -->
		<div class="panel panel-white">

			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="tabbable">
							<ul id="myTab" class="nav nav-tabs">
								<li class="active"><a href="#myTab_example1" data-toggle="tab">
										<i class="green fa fa-home"></i>FSD(Financial Start Date)
										Section
								</a></li>
								<li><a href="#myTab_example2" data-toggle="tab"> <i
										class="green fa fa-home"></i> Apply FSD
									</a>
								</li>
								<li><a href="#myTab_example3" data-toggle="tab"> <i
										class="green fa fa-home"></i> Update School Fee
									</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade in active" id="myTab_example1">
									<div class="alert alert-danger">
										<button data-dismiss="alert" class="close">×</button>
										<h3 class="media-heading text-center">Welcome to FSD Section</h3>
										<a class="alert-link" href="#"></a> This is very Important to
										Create FSD(Financial Start Date) First because School or
										College requires a Financial Start Date and Financial End Date
										.You Can not change Financial Start Date and Financial End
										Date after creating and declare the FSD. If You change its may
										affect Your Fee Structure and Other Section.
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="panel panel-calendar">
												<div class="panel-heading panel-blue border-light">
													<h4 class="panel-title text-center">Create FSD Section</h4>
												</div>
												<div class="panel-body">
													<div class="text-black text-large">
														Start Date <input type="date" id="startdate"
															name="startdate" required> End Date <input type="date"
															id="enddate" required><br> <br>
														<center>
															<a href="#" class="btn btn-sm btn-blue" id="createfsd"><i
																class="fa fa-check"> </i> Create FSD </a>
														</center>
														</<br> <br> <br>
														<div class="alert alert-warning">Select Financial Start
															Date and Financial End Date. If FSD Successfully added
															then it Shows in right side panel where You can not
															change Any of the Date.</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="panel panel-calendar">
												<div class="panel-heading panel-green border-light">
													<h4 class="panel-title text-center">Old/Current FSD Section
													</h4>
												</div>
												<div class="panel-body">
                    
                         							<div class="panel-body panel-scroll height-450">
														<table class="table table-bordered table-hover ">
															<thead>
																<tr class="text-center">
																	<th>FSD ID</th>
																	<th>Financial Start Date</th>
																	<th>Financial End Date</th>
																	<th>Status</th>
																</tr>
															</thead>
															<tbody>
                       
                        							<?php
																																				
														if ($fsd->num_rows () > 0) {
															$i = 1;
																foreach ( $fsd->result () as $row ) {
																		if ($this->session->userdata ( 'fsd' ) == $row->id) {
																		$rowcss = "success";
																		} else {
																		$this->db->where ( "fsd", $row->id );
																		$checkworking = $this->db->get ( "student_info" );
																		if ($checkworking->num_rows () > 0) {
																		$rowcss = "warning";
																		} else {
																		$rowcss = "danger";
																		}
																			}
								?>
                         									<tr class="alert alert-<?php echo $rowcss;?>">
																	<td class="text-center"><?php echo $i."/".$row->id;?> <input
																		type="hidden" id="fsdid<?php echo $i;?>"
																		value="<?php echo $row->id;?>"></td>
																	<td class="text-center"><?php echo date("d-M-Y", strtotime($row->finance_start_date));?></td>
																	<td class="text-center"><?php echo date("d-M-Y", strtotime($row->finance_end_date));?></td>
																	<td class="text-center"><button
																			class="btn btn-<?php echo $rowcss;?>"
																			id="delete<?php echo $i;?>">Delete</button></td>
																</tr>
																<script>	
																	$("#otpbox").hide();
																	      $("#delete<?php echo $i;?>").click(function(){
																            var id =$('#fsdid<?php echo $i;?>').val();
																            //alert(id);
											                                //window.confirm('Are you sure to delete the exam');
															           $.post("<?php echo site_url('index.php/allFormController/deleteFsd') ?>",{id : id},function(data){
															    	  	alert(data);
															    	  	$("#delete<?php echo $i;?>").html(data);
											                              window.location.reload();
															             });
															           }); 
																	
											
																    </script>	
											                       <?php   $i++; }}?>
											                        </tbody>
														</table>

													</div>
													<div class="alert alert-warning">
														1). In Green Colour Shows Current Applied FSD.(You can't
														Delete).<br> 2). In Yellow Colour Shows Used FSD (Delete
														with Admin OTP Confirmation Only).<br> 3). In Red Coloue
														Shows New and not used fsd. (Delete By Click Delete
														Button). <br>

													</div>
												</div>
											</div>
										</div>
									</div>

								</div>

								<div class="tab-pane fade" id="myTab_example2">
									<div class="alert alert-info">
										<button data-dismiss="alert" class="close">×</button>
										<h3 class="media-heading text-center">Welcome to Update Class
											Fee Area</h3>
										<a class="alert-link" href="#"></a> This is important to
										Update Class Fee after Creating Financial Start Date and
										Financial End Date and update the class fees with new FSD.
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="panel panel-calendar">
												<div class="panel-heading panel-red border-light">
													<h4 class="panel-title">Current Class Fees</h4>
												</div>
												<div class="panel-body">
													<div class="text-black text-large">
														<div class="panel-body panel-scroll" style="overflow: auto; width: 600px; height: 420px;">
                        									<table class="table table-striped table-hover"
																id="sample-table-2">
																<thead>
																	<tr class="text-center">
																		<th class="text-center">FSD ID</th>
																		<th class="text-center">Fee Head Name</th>
																		<th class="text-center">Fee Amount</th>

																	</tr>
																</thead>
																<tbody>
										                        <?php 
										                        if($data->num_rows()>0){
										                        foreach($data->result() as $row1):?>
										                         <tr>
																			<td class="text-center"><?php echo $row1->fsd;?> </td>
																			<td class="text-center"><?php echo $row1->fee_head_name;?></td>
																			<td class="text-center"><?php echo $row1->fee_head_amount;?></td>
																	</tr>
										                       <?php   endforeach;}?>
										                        </tbody>
															</table>
														</div>
													</div>
													<div class="alert alert-danger">
														<p>This panel shows the class fee with current FSD . Here
															You can not update or change any anything.</p>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="panel panel-calendar">
												<div class="panel-heading panel-blue border-light">
													<h4 class="panel-title">New FSD Update</h4>
												</div>
												<div class="panel-body">
													<div class="col-sm-6">
														<select id="fsdselect" class="form-control">
															
                          								<?php
                          									foreach ( $fsd->result () as $v ) :	?>
										                              <option value="<?php echo $v->id;?>" <?php if($this->session->userdata("fsd")==$v->id){ echo 'selected="selected"';}?>>
										                              <?php echo $v->id."[".$v->finance_start_date."]";?></option>
										                                  <?php endforeach;?>
										                                </select> <br></br>
										                                	<center>
															<a href="#" class="btn  btn-purple" id="Applyfsd"><i
																class="fa fa-check"> </i> Apply FSD </a>
														</center>
														<br></br>
													</div>
													<div class="col-sm-6">
															<!-- <h3>
															Want To Copy Fee Structure last Session <input
																type="checkbox" class="grey" value=""
																style="width: 40px; height: 40px;" checked="checked">
														</h3> -->
													</div>
												</div>
												<div id="showfsd1"></div>

												<div class="alert alert-success">
													<p>Select FSD from the dropdown and Press Apply FSD
														Button.which is new FSD for Your School or College.</p>
												</div>
											</div>
										</div>

									</div>
								</div>
								<div class="tab-pane fade in active" id="myTab_example3">
									<div class="col-sm-12">
											<div class="panel panel-calendar">
												<div class="panel-heading panel-blue border-light">
													<h4 class="panel-title">Select FSD</h4>
												</div>
												<div class="panel-body">
													<div class="col-sm-12">
														<select id="fsdselect1" class="form-control">
															
                          								<?php
                          									foreach ( $fsd->result () as $v ) :	?>
										                              <option value="<?php echo $v->id;?>" <?php if($this->session->userdata("fsd")==$v->id){ echo 'selected="selected"';}?>>
										                              <?php echo $v->id."[".$v->finance_start_date."]";?></option>
										                                  <?php endforeach;?>
										                                </select> <br></br>
										                                	
														
													</div>
													<div class="col-sm-12">
														<!-- <h3>
															Want To Copy Fee Structure last Session <input
																type="checkbox" class="grey" value=""
																style="width: 40px; height: 40px;" checked="checked">
														</h3> -->
													</div>
												</div>
												<div  id="showfsdFeelist"></div>
												<script>
												$("#fsdselect1").change(function(){
														var fsd = $("#fsdselect1").val();
														$.post("<?php echo site_url("index.php/promotionControler/getfeelist") ?>",{fsd : fsd }, function(data){
															$("#showfsdFeelist").html(data);
														});
													});

												</script>
												<div class="alert alert-success">
													<p>Select FSD from the dropdown and Press update 
														Button for update class fee.</p>
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
	</div>
	<!-- end: INLINE TABS PANEL -->
</div>
</div>
</div>
<!-- end: PAGE CONTENT-->
