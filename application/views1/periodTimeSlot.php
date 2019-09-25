<div class="row">
	<div class="col-md-12">
		<div class="panel panel-white">
			<div class="panel-heading panel-blue">
				<i class="fa fa-external-link-square"></i>
					Period Time Table :
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
								<a class="panel-config" href="#panel-config" data-toggle="modal"> <i class="fa fa-wrench"></i> <span>Configurations</span></a>
							</li>
							<li>
								<a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div> <!-- End Panel Heading -->
			<div class="panel-body">
			<div class="alert alert-info"><h3 class="media-heading text-center">Welcome to Period Time Table scheduling Area</h3>
			<p class="media-timestamp">Welcome to time scheduling area
				  In this section you create a period and lunch time.Please enter your period name in time table name box and select starting date
				  and after that click on Submit Button.After clicking Submit Button you can see Scheduling process.
				  and after that click on Go For Scheduling and wait for new page and Schedule your time table.you can also delete time table.
				</p>
			</div>

			<div class="row">
										<div class="col-sm-5">
										
											<div class="panel  panel-calendar">
											
												<div class="panel-heading panel-blue border-light">
													<h4 class="panel-title">Enter Time Table Name And Starting Date</h4>
												</div>
												<form action="<?php echo base_url();?>index.php/periodTimeControllers/period_no"  method ="post"  id="form">
												<div class="panel-body space10">
													<div class="row">
													<div class="col-lg-6 col-md-6 col-sm-6">
													<div class="space10" >
														<label class="panel-title">Time Table Name</label>
					                            <input type="text" name="periodName" id="examName" required="" onkeyup="myfunction1()" onkeyup="myfunction()" />
													</div>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-6">
													<div class="space10" >
													<label class="panel-title">Starting Date</label> 
															<input  type="date" data-date-format="yyyy-mm-dd"  id= "printDate" name ="datet" data-date-viewmode="years" class="date-picker" required=""> 
															</div>
															</div>
															<div class="col-lg-12 col-md-12 col-sm-12">
											<center> <button class="btn btn-red ">
                                                            Submit <i class="fa fa-arrow-circle-right"></i>
                                                        </button></center>	
														</div>
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
											<!-- <div class="col-sm-15">
										
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
								                      <input  type="text" id="upexam" name ="upexam"  style="width:200px;height:35px;margin-left:10px;" placeholder="Enter Text Name">
														
													</div>
												</div>
											<div class="input-group" >
								                  <input  type="text" data-date-format="yyyy-mm-dd" id = "printDate1" name ="datet"  style="width: 160px;" class="form-control date-picker" placeholder="Enter Date">
												<div class="col-sm-4 ">
															
															<button class="btn btn-red ">
																Update <i class="fa fa-arrow-circle-right"></i>
															</button>
														</div>
													</div>
												</div>
												</form>
											</div>
										</div> -->
										</div>
										
										
										<div class="col-sm-7">
										<div class="panel panel-calendar">
												<div class="panel-heading panel-blue border-light">
													<h4 class="panel-title">Settings</h4>
												</div>
											<div class="panel-body" id="examsetting">
											<table class="table table-responsive">
												<thead>
													<tr>	
														<th>Period Name</th>
														<th>Period Starting Date</th>
														<th>Setting</th>
														<th>Action</th>
													</tr>
											</thead>
											<tbody>
											
											<?php $i=1; foreach ($request as $row):
											 ?><form action="<?php echo base_url();?>index.php/periodTimeControllers/startScheduling" method="post" >
													
													<tr>
														<td>	
															
														<input type="text" style="width: 160px;" name="periodName<?php echo $i;?>" value="<?php echo $row->period_name;?>" id="pname<?php echo $i;?>" disabled="disabled"/>									
														<input type="hidden" name="periodName" id="rowid<?php echo $i;?>" value="<?php echo $row->id;?>"/>
														</td>
														<td>
															<input  type="text" style="width: 160px;" data-date-format="yyyy-mm-dd" id="edate<?php echo $i;?>" data-date-viewmode="years" value="<?php echo date('d-F-Y', strtotime($row->created_date));  ?>" disabled="disabled"/>
															<input type="hidden" name="edate" value="<?php echo date('d-F-Y', strtotime($row->created_date));?>"/>		
														</td>
														
														<td >
														<?php 
														//$ds= $row->created_date;
														//print_r($ds);
														//$ename=$row->period_name;
														//$cd=date("Y-m-d");
														//print_r($cd);
													    ?> 
													 <button type='submit' style="width: 130px;" class="btn btn-xs btn-light-blue" id="scheduling<?php echo $i;?>"><i class="fa fa-check"></i>Go For Scheduling</button>
														</td>
														
														<td >												
											          <a href="<?php echo base_url();?>index.php/periodTimeControllers/deleteperiod/<?php echo $row->id; ?>" class="btn btn-danger " id="delete<?php echo $i;?>">
											          	<i class="fa fa-trash-o" style="color:white;"></i></a>
														</td>
													</tr>
													</form>
													
															</div>
														<!-- <script >	 
														$("#delete<?php echo $i;?>").click(function(){
														var id =$('#rowid<?php echo $i;?>').val();
														alert(id);
														//window.confirm('Are you sure to delete the exam');
													    $.post("<?php //echo site_url('index.php/periodTimeControllers/deleteperiod') ?>",{id : id},function(data){
														alert(" Period deleted Successfully!!!!! ");
														$("#delete<?php echo $i;?>").html(data);
														window.location.reload();
														});
													}); 

														</script>	 -->
													<?php $i++;endforeach;?>
													
											   </tbody>
											</table>
											
											</div>
										</div>
									</div>

<!-- End Main col 12 -->
</div>
</div>
</div>
</div>