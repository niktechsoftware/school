
<div class="row">
	 <div class="col-sm-12">
		<!-- start: INLINE TABS PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-orange">
			    <h5 class="media-heading">Exam Scheduling</h5>
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
								<a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i> <span>Refresh</span> </a>
							</li>
							<li>
								<a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a>
							</li>										
						</ul>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
				
									<div class="alert alert-info">
									<h4 class="media-heading center">Welcome to Exam Scheduling Area </h4>
									<p class="media-timestamp">Here you can Schedule date and time. Please enter you exam name in exam name box like (exam type e.g. : Half yearly, Annual, Unit Test etc. ),
									and select exam starting date from select start date and click Submit Button. After clicking Submit Button you can see Scheduling process.
									and after that click on Go For Scheduling and wait for new page and Schedule your exam.
									You can also edit/delete the exam type and date from the options given in the right.  </p>
									</div>
									<div class="row">
										<div class="col-sm-5">
										

											<div class="panel  panel-calendar">
											
												<div class="panel-heading panel-blue border-light">
													<h3 class="panel-title">Enter Test Name And Starting Date</h3>
												</div>
												<form action="<?php echo base_url();?>index.php/examControllers/getData1"  method ="post"  id="form">
												<div class="panel-body space10">
													<div class="row col-sm-12">
													    <div class="space10" >
														<label class="panel-title">Select Term&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;</label>
					                           <select name="term"><option>--SELECT TERM--</option><option value="1" >TERM 1</option><option value="2">TERM 2</option><option value="3">TERM 3</option></select>
													</div>
													<div class="space10" >
														<label class="panel-title">Test Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;</label>
					                            <input type="text" name="examName" style="width: 180px;" id="examName" required="" onkeyup="myfunction1()" onkeyup="myfunction()" />
													</div>
													<label class="panel-title">Starting Date&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
															<input  type="date" data-date-format="yyyy-mm-dd"  id= "printDate" name ="datet" data-date-viewmode="years"  style="width: 180px;" class="date-picker" required=""> 
												
												 <button class="btn btn-red " style="margin-left:150px; margin-top:10px;">
                                                            Submit <i class="fa fa-arrow-circle-right"></i>
                                                        </button>
												
												</div>	
												
												</div>
												</form>
											</div>
											<script type="text/javascript">
												var input = document.getElementById("examName");
                                                   input.addEventListener("keyup", function () {

                                                    });

                                                   input.addEventListener("keyup", function () {
                                                     var x = document.getElementById("examName");
                                                          x.value = x.value.toUpperCase();
                                
                                                            });
				
											</script>
											<div class="col-sm-15">
											<div class="panel  panel-calendar">
												<div class="panel-heading panel-blue border-light">
													<h4 class="panel-title">Edit Exam Details</h4>
												</div>
												<form action="<?php echo base_url();?>index.php/examControllers/updateData1"  method ="post"  id="form">
												<div class="panel-body space10">
												<div class="input-group" >
													<select class="form-control space10" id="examName1" name="examName" style="width: 160px;" onClick="checkPrice()">
														<option value="01">-Select Exam-</option>
														<?php foreach ($request as $row):
															$ds= $row->exam_date;
															$id=$row->id;
															$ename=$row->exam_name;
															$cd=date("Y-m-d");
															if(($ename=="Class Test")||($ename=="Other Exam"))
															{?>
															<option  value="<?php echo $row->id?>"><?php echo $row->exam_name?></option>
															<?php }
																elseif($ds>=$cd)
																{
																	?><option  value="<?php echo $row->id?>"><?php echo $row->exam_name?></option><?php
																}endforeach;?>
														</select>

														<div id="upadteexam" class="input-group">	
								                      <input  type="text" id="upexam" name ="upexam"  style="width:200px;height:35px;margin-left:10px;" placeholder="Enter Exam Name">
														
													</div>
												</div>
											<div class="input-group" >
								                  <input  type="date" data-date-format="yyyy-mm-dd" id = "printDate1" name ="datet"  style="width: 160px;" class="form-control date-picker" placeholder="Enter Date">
												<div class="col-sm-4 ">
															
															<button class="btn btn-red ">

																Update <i class="fa fa-arrow-circle-right"></i>
															</button>
														</div>
													</div>
												</div>
												</form>
											</div>
										</div>
										</div>
										<div class="col-sm-7">
										<div class="panel panel-calendar">
												<div class="panel-heading panel-blue border-light">
													<h4 class="panel-title">Exam List</h4>
												</div>
											<div class="panel-body" id="examsetting">
											<table class="table table-responsive">
												<thead>
													<tr>	
														<th>Exam Name</th>
														<th>Term</th>
														<th>Exam Month</th>
														<th>Setting</th>
														<th>Action</th>
													</tr>
											</thead>
											<tbody>
											
											<?php $i=1; foreach ($request as $row): 
											 ?><form action="<?php echo base_url();?>index.php/examControllers/startScheduling" method="post" >
													
													<tr>
														<td>	
															
											<input type="text" style="width: 140px;" name="examName<?php echo $i;?>" value="<?php echo $row->exam_name;?>" id="ename<?php echo $i;?>" disabled="disabled"/>									
											 <input type="hidden" name="examName" id="rowid<?php echo $i;?>" value="<?php echo $row->id;?>"/>
														</td>
														<td><?php echo $row->term;?> Term</td>
														<td>
															<input  type="text" style="width: 95px;" data-date-format="yyyy-mm-dd" id="edate<?php echo $i;?>" data-date-viewmode="years" value="<?php echo date('d-F-Y', strtotime($row->exam_date));  ?>" disabled="disabled"/>
															<input type="hidden" name="edate" value="<?php echo date('d-F-Y', strtotime($row->exam_date));?>"/>		
														</td>
														
														<td >
													<?php 	$ds= $row->exam_date;
															$ename=$row->exam_name;
															$cd=date("Y-m-d");
															if(($ename=="Class Test")||($ename=="Other Exam"))
																	{?>

																	<button type='submit' style="width: 80px;" class="btn btn-xs btn-light-blue" id="scheduling<?php echo $i;?>"><i class="fa fa-check"></i>Go For Scheduling</button>

														
													    	</td>
															
															<?php }else
															{
																if($ds<$cd)
															{?><button type='submit' disabled="disabled"  style="width: 100px;" class="btn btn-xs btn-light-blue" id="scheduling1"><i class="fa fa-check"></i>Exam Done </button>
														    </td> 
														    <td>
														   <a href="<?php echo base_url();?>index.php/examControllers/examdonedeleteExam/<?php echo $row->id; ?>" class="btn btn-red ">
											          	   <i class="fa fa-arrow-circle-right"></i>Delete Exam</a> 
														    </td>
														   
														   

														<?php }else{ ?> <button type='submit' style="width: 160px;" class="btn btn-xs btn-light-blue" id="scheduling<?php echo $i;?>"><i class="fa fa-check"></i>Go For Scheduling</button>
														</td>
														</td>

														<td >												
											          <a href="#" class="btn btn-green " id="delete<?php echo $i;?>">
											          	<i class="fa fa-arrow-circle-right"></i>Delete Exam</a>
														</td>
													</tr></form>
													
                                </div>
							<script >	
							  <?php if($ds>$cd){ ?> 	 
						      $("#delete<?php echo $i;?>").click(function(){
					            var id =$('#rowid<?php echo $i;?>').val();
                                //window.confirm('Are you sure to delete the exam');
				           $.post("<?php echo site_url('index.php/examControllers/deleteExam') ?>",{id : id},function(data){
				    	  	alert(" Exam deleted Successfully!!!!! ");
                             $("#delete<?php echo $i;?>").hide();
                              window.location.reload();
				             });
				           }); 
						   <?php }?>  

					         </script>	
													<?php }} $i++;endforeach;?>
													
											   </tbody>
											</table>
											
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

						<!-- end: PAGE CONTENT