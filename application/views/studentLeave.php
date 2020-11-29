<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-blue">
				<h4 class="panel-title">
					Student <span class="text-bold">Leave Detail</span>
				</h4>
				<div class="panel-tools">
					<div class="dropdown">
						<a data-toggle="dropdown"
							class="btn btn-xs dropdown-toggle btn-transparent-grey"> <i
							class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu dropdown-light pull-right" role="menu">
							<li><a class="panel-collapse collapses" href="#"><i
									class="fa fa-angle-up"></i> <span>Collapse</span> </a></li>
							<li><a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i>
									<span>Refresh</span>
							</a></li>
							<li><a class="panel-config" href="#panel-config"
								data-toggle="modal"> <i class="fa fa-wrench"></i> <span>Configurations</span>
							</a></li>
							<li><a class="panel-expand" href="#"> <i class="fa fa-expand"></i>
									<span>Fullscreen</span>
							</a></li>
						</ul>
					</div>
					<a class="btn btn-xs btn-link panel-close" href="#"> <i
						class="fa fa-times"></i>
					</a>
				</div>
			</div>
			 <br>
			<div class="panel-body">
			    <div class="alert btn-purple">
					<h3 class="media-heading text-center">Welcome to Leave Deatil Area Area</h3>
					<p class="media-timestamp">Here Stundent Can Apply For New  Leave and See All Leave details  . 
					</p>
				</div>
            <div class="form-group">
        	<div class="col-sm-12">
            	<br />
						<br />
						<div class="row">
							<div class="col-md-12 space20">
								<div class="btn-group pull-right">
									<button data-toggle="dropdown"
										class="btn btn-green dropdown-toggle">
										Export <i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu dropdown-light pull-right">
										<li><a href="#" class="export-excel"
											data-table="#sample-table-2" data-ignoreColumn="3,4"> Export
												to Excel </a></li>
									</ul>
								</div>
							</div>

							<div class="table-responsive">
								<table class="table table-striped table-hover" id="example">
									<thead>
										<tr>
											<th>S.no.</th>
											<th>Start Date</th>
											<th>End Date</th>
											<th>Total leave</th>
											<td>Reason</td>
											<th>Approved</th>
											<th>Action</th>

										</tr>
									</thead>
									<tbody>
<?php
$color = array (
		"progress-bar-danger",
		"progress-bar-success",
		"progress-bar-warning",
		"progress-partition-green",
		"partition-azure",
		"partition-blue",
		"partition-orange",
		"partition-purple",
		"progress-bar-danger",
		"progress-bar-success",
		"progress-partition-green",
		"partition-purple" 
);

$this->load->model ( "singleStudentModel" );
$v = $this->session->userdata ( 'username' );
$var = $this->singleStudentModel->getStuLeave ( $v );

$count = 1;
foreach ( $var->result () as $lv ) :
	?>
<?php if($count%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
<tr class="<?php echo $rowcss;?>">
											<td><?php echo $count;?></td>
											<td><?php echo $lv->start_date;?></td>
											<td><?php echo $lv->end_date;?></td>
											<td><?php echo $lv->total_leave;?></td>
											<td><?php echo strtoupper($lv->reason);?></td>
											<td><?php echo $lv->approve?></td>
<?php if($lv->approve=="NO"){?>
		  <input type="hidden" id="rowid" value="<?php echo $lv->id;?>">
											<td><button type="submit" id="leavedelete"
													class="btn btn-red">Cancel leave</button></td>
			<?php }else{?>
           <td><button type="submit" class="btn btn-yellow">Approve</button></td>
            
			<?php } ?>


</tr>
<?php $count++; endforeach; ?>

</tbody>

								</table>
								</br>
								<div>
									<div class="col-sm-2 col-sm-offset-8 form-group">
										<button type="submit" id="sonu"
											class="btn btn-blue next-step btn-green">
											Define New Leave <i class="fa fa-arrow-circle-left"></i>
										</button>
									</div>

									<div id="stuLeave">
										<form
											action="<?php echo base_url();?>index.php/singleStudentControllers/insertLeave"
											method="post">
											<div class="form-group">
												<div class="row">
													<div class="col-md-6">
														<label class="col-md-5 control-label"> Start Date <span
															class="symbol required"></span>
														</label>
														<div class="col-md-7 form-group">
															<input type="date" data-date-format="yyyy-mm-dd"
																data-date-viewmode="years" name="sdate"
																value="<?php echo set_value('empDob'); ?>"
																placeholder="Start Date"
																class="form-control date-picker" required="required" />
														</div>
													</div>


													<div class="col-md-6">
														<label class="col-md-5 control-label"> End Date <span
															class="symbol required"></span>
														</label>
														<div class="col-md-7 form-group">
															<input type="date" data-date-format="yyyy-mm-dd"
																data-date-viewmode="years" name="edate"
																value="<?php echo set_value('empDob'); ?>"
																placeholder="End Date" class="form-control date-picker"
																required="required" />
														</div>

													</div>
												</div>

												<div class="row">
													<div class="col-md-6">
														<label class="col-md-5 control-label"> Total Leave </label>
														<div class="col-sm-7 form-group">
															<input type="number" class="form-control" id="totalLeave"
																name="totalLeave" required="required"
																value="<?php echo set_value('empPhoneNumber'); ?>">
														</div>
													</div>
													<div class="col-md-6">
														<label class="col-md-5 control-label"> Reason </label>
														<div class="col-md-7 form-group ">
															<input type="text" class="form-control text-uppercase"
																required="required" id="reason" name="reason"
																value="<?php echo set_value('empPhoneNumber'); ?>"
																title="Only alphabate allow">
														</div>
													</div>
												</div>

												<div class="col-sm-2 col-sm-offset-8">
													<button type="submit"
														class="btn btn-blue next-step btn-block">
														Submit <i class="fa fa-arrow-circle-left"></i>
													</button>
												</div>
											</div>
										</form>

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
