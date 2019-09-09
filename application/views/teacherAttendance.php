	<form id="teacherattendancedata" method="post">
	<div class="row">
							<div class="col-md-12">
								<!-- start: DYNAMIC TABLE PANEL -->
								<div class="panel panel-white">
									<div class="panel-heading">
										<h4 class="panel-title"> Teacher <span class="text-bold">Attendance Table</span></h4>
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
<div class="alert alert-info"><h3 class="media-heading text-center">Teacher Attendance</h3><p class="media-timestamp">Welcome To The Teacher Attendance area
To know the attendance of all your teachers, following the rules given below, you will get the information about all your attendance attenuate.</div>

									<div class="row">
										<div class="col-sm-12" id="validId"></div>
									</div><?php if($v){?>
										<div class="alert alert-success">
										<?php echo "Successfully Attendance Done";?></div><?php

									}?>
									<div class="row space20">
										<div class="col-sm-4">
											<div class="form-group">
												<div class="col-sm-4">
												<label class="control-label">
													<strong>Teacher ID</strong><span class="symbol required"></span>
												</label>
												</div>
												<div class="col-sm-7">
												<input type="text" size= "20" class="form-control" id="teacherid" name="teacherid"   placeholder="Text Field">
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<div class="col-sm-4">
												<label class="control-label">
													<strong>Select Date</strong> <span class="symbol required"></span>
												</label>
												</div>
												<?php 
										$fsdid =$this->session->userdata('fsd');
										$this->db->where('id',$fsdid );
										$this->db->select('finance_start_date');
									  $dat =	$this->db->get('fsd');
										if($dat->num_rows()){
											$date= $dat->row()->finance_start_date;
										}
										?>
												<div class="col-sm-7">
												<input type="date"  class="form-control"  name = "date1" id= "radate" min='<?php echo $date;?>' required="required" >
												<div style="display:none;color:red" id="radateid">Required</div>
												</div>
											</div>
										</div>

										
                  <div class="col-sm-4">
                  	<div class="form-group">
					
						<div class="col-sm-4">
					<label class="control-label">
					<strong>Job Category</strong> <span class="symbol required"></span>
					</label>
					</div><div class="col-sm-7">
                    <select class="form-control text-uppercase" id="jobCategoryval" name="jobCategory"
                      required="required">
                      <option value="0">-Category-</option>
                      <option value="1">Accountant</option>
                      <option value="2">Employee</option>
                      <option value="3">Teacher</option>
                      <option value="9">Principal</option>
                    </select>
                  </div>
                
                </div></div>

										<br>
										<br>
										<br>
										<br>
										<br>


										<div class="table-responsive" id="teacherwisedata">
											<!--<table class="table table-striped table-hover" id="sample_2">
												<thead >
												<tr class = "success">
														<th>S.No.</th>
														<th>Teacher ID </th>
														<th> Teacher Name</th>
														<th> Mobile Number</th>
														<th> Job Title</th>
														<th> In time</th>
														<th>  Out time</th>
														<th> Late </th>

														<th> Attendance <input type="hidden" value="300001" name="tID" id="tID"/></th>
															<th> Reason </th>
															<th> Save </th>
														</tr>

												</thead>
												<tbody >
												<?php $i = 1;
												//$var = $this->input->post("request");

												foreach ($request as $row){

													//$this->teacherModel->checkTeacherAttenf($date1);
										       ?><tr class = "warning">
											<td> <?php echo $i;?> </td>
											<td> <input type="hidden" name="empID<?php echo $i;?>" value="<?php echo $row->id;?>" /> <?php echo $row->username;?> </td>
														<td> <strong><?php echo strtoupper($row->name);?></strong></td>

														<td><strong> <?php echo $row->mobile;?></strong></td>
														<td><strong> <?php echo strtoupper($row->job_title);?></strong></td>
														<td><strong> <input type="time"  class="form-control" id="indate<?php echo $i; ?>" name="indate"  required="required" ></strong></td>
														<td><strong> <input type="time"  class="form-control" id="outdate<?php echo $i; ?>" name="outdate"   ></strong></td>
														<td><strong> <input type="text"  class="form-control" id="latehour<?php echo $i; ?>" name="latehour"   ></strong></td>

														<td> <strong><div class="form-group">


															<label class="radio-inline">
																<input type="radio" class="grey" value="1" name="gender<?php echo $i; ?>"  checked="checked">
																p
															</label>
															<label class="radio-inline">
																<input type="radio" class="grey" value="0" name="gender<?php echo $i; ?>" >
																A
															</label>
															<!-- <label class="radio-inline">
																<input type="radio" class="grey" value="L" name="gender<?php echo $i; ?>"  >
																L
															</label> -->


													<!--	</td>
														<td> <input type="text" name="reasonid<?php echo $i; ?>" id="reasonid<?php echo $i; ?>"> </td>


													<!--	</td>
														<td> <input type="text" name="reasonid<?php echo $i; ?>" id="reasonid<?php echo $i; ?>"> </td>

														<td> <input type="hidden" value="<?php echo $i; ?>" name="rows" />
														    <button type="button" class="btn btn-success" style="display:none" id="success<?php echo $i; ?>">Success</button>
															<button class="btn btn-blue next-step btn-block" id="submit<?php echo $i; ?>" onclick="submitTeacherAttendence(<?=$row->id?>,indate<?php echo $i; ?>,outdate<?php echo $i; ?>,latehour<?php echo $i; ?>,gender<?php echo $i; ?>,reasonid<?php echo $i; ?>,success<?php echo $i; ?>.id,submit<?php echo $i; ?>.id)">
															Submit <i class="fa fa-arrow-circle-right"></i>
															</button> </td>
														</div></strong></td>
													</tr><?php
												$i++;}
				 	                                  ?>
				 								</tbody>
											</table>-->

										</div>
									</div>
								</div>
							</div>
					</div>
				</div>

	<!--</form>-->
	<script>
	    function submitTeacherAttendence(empno,intime,outtime,latetime,gender,reason,successbtnid,submitid){

	        let radate = $('#radate').val();
	        let tID1 =  $('#teacherid').val();
	        let intimes = intime.value;
	        let outtimes = outtime.value;
	        let latetimes = latetime.value;
	        let attdnce = gender.value;
	        let reasonid = reason.value;



	        if(radate == ''){

	            document.getElementById('radateid').style.display = "block";

	        }
	        else{

	            document.getElementById('radateid').style.display = "none";
	            let formData = {
	                itime:intimes,
	                otime:outtimes,
	                ltime:latetimes,
	                date: radate,
	                teacherId: empno,
	                tID: tID1,
	                attendance: attdnce,
	                reason: reasonid
	            }

	            $.ajax({
                    url : "<?= site_url('index.php/teacherController/teacherAtten')?>",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        $(`#${successbtnid}`).show();
                        $(`#${submitid}`).hide();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                      alert('Error submit data');
                    }
                });

	        }

	    }



	</script>

	<script>
				               var dper = document.getElementById("latehour<?php echo $i; ?>");
                        dper.onchange = function () {
                           if (this.value != "" || this.value.length > 0) {
                              document.getElementById("reasonid<?php echo $i; ?>").disabled = false;
                           }
                        }
	
	</script>
		<script>
	
	radate.max = new Date().toISOString().split("T")[0];
	</script>

						<!-- end: PAGE CONTENT-->
