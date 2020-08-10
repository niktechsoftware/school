<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-sm-12">
		<!-- start: INLINE TABS PANEL -->
		<div class="panel panel-white">
		<div class="alert alert-info"><h3 class="media-heading text-center">WELCOME TO THE COLLECTION FEES    </h3><p class="media-timestamp">If you want to show student fee collection then enter student id in student id box and click on get record button. Then open new form fill all detail in the form and show all fees of student and save it.</div>
			<div class="panel-heading">
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
					<?php if(($this->uri->segment(3) == "feeFalse")){?>
						<div class="alert alert-danger">
							<button data-dismiss="alert" class="close">
								&times;
							</button>
							<strong>Oh my god...!</strong> Somthing Wrong contact Gfinch technologies... :(
						</div>
					<?php } ?>
						<div class="panel panel-calendar">
							<div class="panel-heading panel-purple border-light">
								<h4 class="panel-title">Collect <span class="text-bold">Student Fees</span></h4>
							</div>
							<div class="panel-body">
							<form action="<?php echo base_url();?>index.php/vreportpanel/getcc"  method ="post" role="form" class="smart-wizard form-horizontal" id="form">

								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
						                      <label for="inputStandard" class="col-lg-4 control-label">
						                      		Student ID <span style="color:#F00">*</span>
						                      </label>
						                      <div class="col-lg-7">
						                        <input type="text" id="studid" name ="studid" class="form-control"  />

						                      </div>
						                </div>
									</div>
									<div class="col-sm-6" id="subbox">
										 <button  class="btn btn-dark-green">Get Record <i class="fa fa-arrow-circle-right"></i></button>

									</div>
								</div>
							</form>
				                <div class="panel-body">
									<?php
									if($stud_id!=0){
									    echo "rahuljcbjksd";
									$pk=$totdata;
									echo $pk->cc;
									echo $stud_id;
									
									if($fsddate->num_rows()>0){
									    
									    $fsddate = $fsddate->row()->finance_start_date;
										?>
								<form action="#">
												    <div class ="row">
												        <div class="col-sm-12">
												            <div class="row">
												            <div class="alert alert-warning"> <strong>Note :-The fee of April should be deposited separately because one time fee is included.</strong> After April fee you can deposited number of month fee in one time.</div>
												                <div class="col-sm-12">
												                    <div class="panel panel-white">
												                    <div class="panel-heading panel-red">Student Detail</div>
												                        <div class="row">
												                            <div class="col-sm-12">
												                                kldhguiwehilu
												                                <?php// echo $totdata;?>
												                                </div>
												                            </div><!-- End 12div column -->
												                        </div><!-- End row -->
												                    </div> <!-- End panel -->
												                </div>
												                
												            </div>
												        </div>
												    
												</form>
												</div>

												<!-- <script>
													$("#form-field-select-2").change(function(){
														var month=[];var i=0;
														var stuId = $("#stuId").val();
														
														$('#form-field-select-2 :selected').each(function(i, selectedElement) {
															month[i] = $(selectedElement).val();
															alert(month[i]+stuId);

															});


														$.post("<?php echo site_url('feeControllers/getFeeDetails') ?>", {month : month,stuId : stuId}, function(data){
															$("#basicfee").html(data);

														});


													});
													$("#paid").keyup(function(){
														var c = Number($("#total").val()) - $("#paid").val();
														$("#sub_total").val($("#paid").val());
														$("#sub_total1").val($("#paid").val());
														$("#cb").val(c);
														$("#cb1").val(c);
													});

		//---------------------------------------------------------------------------------------------------

	</script> -->
									<?php }}else{
									echo "FSD NOT SET PLESE DEFINE FSD IN FSD TABLE";
									}?>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>