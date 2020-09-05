<?php $school_code = $this->session->userdata("school_code");?>
<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-pink">
				<h4 class="panel-title">Student <span class="text-bold">Configuration Test</span></h4>
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
                  <div class="alert panel-green">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to Configuration Test Area</h3>
          Please fill start date, Class and Section then show all Fees Report in new form. if you saw all Fees detail 
          then click on view detail Button. if you want to send a sms then click on SEND SMS Button.
              
        </div>
          
			<div class="row">
			<form action="<?php echo base_url();?>index.php/examControllers/create_ques"  method ="post"  id="form">
											<div class="col-sm-3">
												<div class="panel-heading panel-red border-light">
													<h4 class="panel-title">Select Exam</h4>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<select class="form-control" name="select_exam" id="select_exam" style="width: 200px;">
							<option value="">-select Exam-</option>
		                      		<?php foreach ($requestforUpdate as $row):
															$ds= $row->exam_date;
															$id=$row->id;
															$ename=$row->exam_name;
															$this->db->where("id",$this->session->userdata("fsd"));
															$getfsdDates = $this->db->get("fsd")->row();
															$cd=$getfsdDates->finance_start_date;
															
																if($ds>=$cd)
																{
																	?><option  value="<?php echo $row->id; ?>"><?php echo $row->exam_name ;?></option><?php }endforeach;?>
														</select>
													</div>
													<div class="text-red text-small">Please select a exam, language and  Class will automatically come select and add subject.</div>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="panel-heading panel-green border-light">
													<h4 class="panel-title">Select Language</h4>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<select class="form-control" name="select_lang" id="select_lang" style="width: 200px;">
								<option value="">-select Language-</option>
							<?php
												$lan = $this->db->get('language');
												if($lan->num_rows()>0){
												foreach($lan->result() as $row):
												echo '<option value="'.$row->id.'">'.$row->language.'</option>';?>
												<?php endforeach ;}?>
														
							
						</select>
													</div>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="panel-heading panel-blue border-light">
													<h4 class="panel-title">Select Practice Set</h4>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<select class="form-control" name="select_test" id="select_test">
						</select>
													</div>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="panel-heading panel-blue border-light">
													<h4 class="panel-title">Select Subject</h4>
												</div>
												<div class="panel-body">
													<div class="form-group">
														<select class="form-control" name="select_subject" id="select_subject">
							<option value="">-select Subject-</option>
						<?php
												$sub = $this->db->get('subject');
												if($sub->num_rows()>0){
												foreach($sub->result() as $row):
												echo '<option value="'.$row->id.'">'.$row->subject.'</option>';?>
												<?php endforeach ;}?>
						</select>
													</div>
												</div>
											</div>
											<div class="row">
											<div class="col-sm-3"></div>
											<div class="col-sm-3"></div>
											<div class="col-sm-3"></div>
											
											<div class="col-sm-3">
											<input type="submit" class="btn btn-red  fa fa-arrow-circle-right" id="config_tst" name = "config_tst" style="margin-left:150px; margin-top:10px;">
											</div>
            	</div>
				</form>
										</div>
				
			</div><!-- end: panel Body -->
		</div><!-- end: panel panel-white -->
		
	</div><!-- end: MAIN PANEL COL-SM-12 -->
</div><!-- end: PAGE ROW-->
		<script>
/////////////create test///////////////
$("#select_lang").change(function(){
	//alert("hiiii");
    var exam_n = $('#select_exam').val();
    var lang_n = $('#select_lang').val();
    if(exam_n == null)
    {
	//	alert();
        alert("Please Select Exam");
    }
    else
    {
        // alert("yes");
        $.post("<?= site_url();?>/examController/select_exam", {exam_n : exam_n,lang_n : lang_n}, function(data){
         $("#select_test").html(data);
        });
    }
});
</script>			