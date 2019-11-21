				<table class="table table-striped table-hover" id="sample_2">
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
											<input type="hidden" name="radate" id ="radate" value="<?php echo $radate?>">
											<input type="hidden" name="teacherid" id ="teacherid" value="<?php echo $tID1?>">
														<td> <strong><?php echo strtoupper($row->name);?></strong></td>

														<td><strong> <?php echo $row->mobile;?></strong></td>
														<td><strong> <?php echo strtoupper($row->job_title);?></strong></td>
														<td><strong> <input type="time"  class="form-control" id="indate<?php echo $i; ?>" name="indate"  required="required" ></strong></td>
														<td><strong> <input type="time"  class="form-control" id="outdate<?php echo $i; ?>" name="outdate"   ></strong></td>
														<td><strong> <input type="text"  class="form-control" id="latehour<?php echo $i; ?>" name="latehour"   ></strong></td>

														<td> <strong><div class="form-group">


															<label class="radio-inline">

																<input type="radio" class="grey" value="1" id="pr" name="gender<?php echo $i; ?>" checked>
																p
															</label>
															<label class="radio-inline">

																<input type="radio" id="ab" class="grey" value="0" name="gender<?php echo $i; ?>" >
																A
															</label>
															 <label class="radio-inline">

																<input type="radio" class="grey" id="le" value="L" name="gender<?php echo $i; ?>"  >

																L
															</label> 
													</td>
														<td> <input type="text" name="reasonid<?php echo $i; ?>" id="reasonid<?php echo $i; ?>"> </td>
														<td> <input type="hidden" value="<?php echo $i; ?>" name="rows" />
														    <button type="button" class="btn btn-success" style="display:none" id="success<?php echo $i; ?>">Success</button>
															<button class="btn btn-blue next-step btn-block" id="submit<?php echo $i; ?>" onclick="submitTeacherAttendence(<?=$row->id?>,indate<?php echo $i; ?>,outdate<?php echo $i; ?>,latehour<?php echo $i; ?>,gender<?php echo $i; ?>,reasonid<?php echo $i; ?>,success<?php echo $i; ?>.id,submit<?php echo $i; ?>.id)">
															Submit <i class="fa fa-arrow-circle-right"></i>
															</button> </td>
														</div></strong></td>

													</tr><script>
													
								var dhead = document.getElementById("ab");
                              dhead.onchange = function () {
                           if (this.value != "" || this.value.length > 0) {
							  document.getElementById("latehour<?php echo $i;?>").disabled = true;
							  document.getElementById("indate<?php echo $i;?>").disabled = true;
							  document.getElementById("outdate<?php echo $i;?>").disabled = true;
                           }
						}


						var dhead = document.getElementById("le");
                              dhead.onchange = function () {
                           if (this.value != "" || this.value.length > 0) {
							  document.getElementById("latehour<?php echo $i;?>").disabled = true;
							  document.getElementById("indate<?php echo $i;?>").disabled = true;
							  document.getElementById("outdate<?php echo $i;?>").disabled = true;
                           }
						}

						
						// var dhead = document.getElementById("pr");
                        //       dhead.onchange = function () {
                        //    if (this.value != "" || this.value.length > 0) {
						// 	  document.getElementById("reasonid<?php echo $i;?>").disabled = true;
							 
                        //    }
                        // }
													


													</script>


													<?php

												

												$i++;}
				 	                                  ?>
				 								</tbody>
											</table>

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

