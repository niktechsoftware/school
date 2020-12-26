<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-red">
        <h4 class="panel-title">Student Wise <span class="text-bold">Time  Panel</span></h4>
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
	        <div class="alert btn-purple">
					<button data-dismiss="alert" class="close">×</button>
					<h4 class="media-heading text-center">Welcome to Student  Time Scheduling Area
						Area</h4>
					<p>Here Stundent  can see Time  Schedule.</p>
				</div>
  <!--    -->
   	<?php 
   	        $stu_id=$this->session->userdata("id");
			$school_code=$this->session->userdata('school_code');
			$this->db->where('id',$stu_id);
			$stu_info=$this->db->get("student_info")->row();
			$class_id=$stu_info->class_id;
			$this->db->where("class_id",$class_id);  
			$dt1=$this->db->get("time_table")->result();
			//print_r($dt1);
			//} exit();
           // $pid= $dt1->period_id;
           // print_r($dt1);
           
			?>
		
		<div class="row">
			<div class="col-sm-12">
					<div class="tabbable">
									<ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
										<li class="active">
											<a data-toggle="tab" href="#monday">
												Monday
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#tuesday">
												Tuesday
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#wednesday">
												Wednesday
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#thursday">
												Thursday
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#friday">
												Friday
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#saturday">
												Saturday
											</a>
										</li>
									</ul>
									<div class="tab-content">
										<div id="monday" class="tab-pane fade in active">
										<div class="table-responsive">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
														echo $dt1->period_id;
														
														$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code' and nop_id='$dt1->period_id'");
														
														foreach($uniquePeriod->result() as $row):?>
														<th>
															<?php 
																if($row->period == ''){
																	echo "Lunch";
																}else{
																	echo $row->period;
																}
															?>
														</th>
														<?php endforeach;   ?>
													</tr>
													<tr>
														<th>Time Slot</th>
														
														<?php foreach($dt1 as $row): 
														
														$this->db->where("id",$row->period_id);
											             $this->db->where("school_code",$school_code);
														 $dt2=$this->db->get("period")->result();
														// print_r($row->period_id);
														foreach($dt2 as $row1):
														// print_r($row1); 
														if($row1->period == ''){ 
															?>
															<th><?php echo $row1->from; ?> to <?php echo $row1->to; ?></th>
														<?php }else{ ?>
															<th><?php echo $row1->from; ?> to <?php echo $row1->to; ?></th>
														<?php }
														 ?>
														
														<?php endforeach;
													endforeach;?>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?php echo $class."-".$sec1;?></td>
														<?php foreach($dt1 as $row):
														$this->db->where('time_table_id',$row->id);
														$days= $this->db->get('time_table_days');
														if($days->num_rows()>0){
															foreach($days->result() as $row1):
														 if($row1->days_id == "1")
															{ ?>
															<?php if(($row->teacher == '') && ($ror->subject_id == '')):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php  $this->db->where("id",$row->subject_id);
																$sname=$this->db->get("subject")->row(); 
																//print_r($sname);
																$this->db->where("id",$row->teacher);
																$ename=$this->db->get("employee_info"); 
																if($ename->num_rows()>0){
																echo $ename->row()->name."<br/>".$sname->subject;}?></td>
															<?php endif;} 
														endforeach; 
														} ?>
													<?php endforeach;?>
													</tr>
												</tbody>
											</table>
											</div>	
										</div>
										<!-- for Tuesday -->
										<div id="tuesday" class="tab-pane">
										   <div class="table-responsive">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
													$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code' and nop_id='$period'");
														foreach($uniquePeriod->result() as $row):?>
														<th>
															<?php 
																if($row->period == ''){
																	echo "Lunch";
																}else{
																	echo $row->period;
																}
															?>
														</th>
														<?php endforeach;?>
													</tr>
													<tr>
														<th>Time Slot</th>
														
														<?php foreach($dt1 as $row): 
														
														$this->db->where("id",$row->period_id);
											             $this->db->where("school_code",$school_code);
														 $dt2=$this->db->get("period")->result();
														foreach($dt2 as $row1):

														 //print_r($row1); 
															
														 ?>
														<th><?php echo $row1->from; ?> to <?php echo $row1->to; ?></th>
														<?php endforeach;;
													endforeach;?>
														
														
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?php echo $class."-".$sec1;?></td>
														<?php foreach($dt1 as $row):
														$this->db->where('time_table_id',$row->id);
														$days= $this->db->get('time_table_days');
														if($days->num_rows()>0){
															foreach($days->result() as $row1):
														 if($row1->days_id == "2")
															{?>
															<?php if($row->teacher == ''):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php  $this->db->where("id",$row->subject_id);
																$sname=$this->db->get("subject")->row(); 
																//print_r($sname);
																$this->db->where("id",$row->teacher);
																$ename=$this->db->get("employee_info")->row(); 
																echo $ename->name."<br/>".$sname->subject;?></td>
															<?php endif;}
															endforeach; } ?>
													<?php endforeach;?>
													</tr>
													
												</tbody>
											</table>
										</div>	
										</div>
										<!-- end for Tuesday -->
										<!-- for Wednesday -->
										<div id="wednesday" class="tab-pane">
										 	<div class="table-responsive">   
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
														$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code' and nop_id='$period'");
														foreach($uniquePeriod->result() as $row):?>
														<th>
															<?php 
																if($row->period == ''){
																	echo "Lunch";
																}else{
																	echo $row->period;
																}
															?>
														</th>
														<?php endforeach;?>
													</tr>
													<tr>
														<th>Time Slot</th>
														
														<?php foreach($dt1 as $row): 
														
														$this->db->where("id",$row->period_id);
											             $this->db->where("school_code",$school_code);
														 $dt2=$this->db->get("period")->result();
														foreach($dt2 as $row1):

														 //print_r($row1); 
															
														 ?>
														<th><?php echo $row1->from; ?> to <?php echo $row1->to; ?></th>
														<?php endforeach;;
													endforeach;?>
														
														
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?php echo $class."-".$sec1;?></td>
														<?php foreach($dt1 as $row):
														$this->db->where('time_table_id',$row->id);
														$days= $this->db->get('time_table_days');
														if($days->num_rows()>0){
															foreach($days->result() as $row1):
														 if($row1->days_id == "3")
															{?>
															<?php if($row->teacher == ''):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php  $this->db->where("id",$row->subject_id);
																$sname=$this->db->get("subject")->row(); 
																//print_r($sname);
																$this->db->where("id",$row->teacher);
																$ename=$this->db->get("employee_info")->row(); 
																echo $ename->name."<br/>".$sname->subject;?></td>
															<?php endif;}
															endforeach; } ?>
													<?php endforeach;?>
													</tr>
													
												</tbody>
											</table>
											</div>
										</div>
										
										<!-- end for Wednesday -->
										<!-- for thursday -->
										<div id="thursday" class="tab-pane">
										   <div class="table-responsive">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
														$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code' and nop_id='$period'");
														foreach($uniquePeriod->result() as $row):?>
														<th>
															<?php 
																if($row->period == ''){
																	echo "Lunch";
																}else{
																	echo $row->period;
																}
															?>
														</th>
														<?php endforeach;?>
													</tr>
													<tr>
														<th>Time Slot</th>
														
														<?php foreach($dt1 as $row): 
														
														$this->db->where("id",$row->period_id);
											             $this->db->where("school_code",$school_code);
														 $dt2=$this->db->get("period")->result();
														foreach($dt2 as $row1):

														 //print_r($row1); 
															
														 ?>
														<th><?php echo $row1->from; ?> to <?php echo $row1->to; ?></th>
														<?php endforeach;;
													endforeach;?>
														
														
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?php echo $class."-".$sec1;?></td>
														<?php foreach($dt1 as $row):
														$this->db->where('time_table_id',$row->id);
														$days= $this->db->get('time_table_days');
														if($days->num_rows()>0){
															foreach($days->result() as $row1):
														 if($row1->days_id == "4")
															{?>
															<?php if($row->teacher == ''):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php  $this->db->where("id",$row->subject_id);
																$sname=$this->db->get("subject")->row(); 
																//print_r($sname);
																$this->db->where("id",$row->teacher);
																$ename=$this->db->get("employee_info")->row(); 
																echo $ename->name."<br/>".$sname->subject;?></td>
															<?php endif;}
															endforeach; } ?>
													<?php endforeach;?>
													</tr>
													
												</tbody>
											</table>
										</div>
										</div>
										
										<!-- end for Thursday -->
										<!-- for Friday -->
										<div id="friday" class="tab-pane">
										   	<div class="table-responsive"> 
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
														$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code' and nop_id='$period'");
														foreach($uniquePeriod->result() as $row):?>
														<th>
															<?php 
																if($row->period == ''){
																	echo "Lunch";
																}else{
																	echo $row->period;
																}
															?>
														</th>
														<?php endforeach;?>
													</tr>
													<tr>
														<th>Time Slot</th>
														
														<?php foreach($dt1 as $row): 
														
														$this->db->where("id",$row->period_id);
											             $this->db->where("school_code",$school_code);
														 $dt2=$this->db->get("period")->result();
														foreach($dt2 as $row1):

														 //print_r($row1); 
															
														 ?>
														<th><?php echo $row1->from; ?> to <?php echo $row1->to; ?></th>
														<?php endforeach;;
													endforeach;?>
														
														
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?php echo $class."-".$sec1;?></td>
														<?php foreach($dt1 as $row):
														$this->db->where('time_table_id',$row->id);
														$days= $this->db->get('time_table_days');
														if($days->num_rows()>0){
															foreach($days->result() as $row1):
														 if($row1->days_id == "5")
															{?>
															<?php if($row->teacher == ''):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php  $this->db->where("id",$row->subject_id);
																$sname=$this->db->get("subject")->row(); 
																//print_r($sname);
																$this->db->where("id",$row->teacher);
																$ename=$this->db->get("employee_info")->row(); 
																echo $ename->name."<br/>".$sname->subject;?></td>
															<?php endif;}
															endforeach; } ?>
													<?php endforeach;?>
													</tr>
													
												</tbody>
											</table>										</div>
										</div>
									
										<!-- end for Friday -->
										<div id="saturday" class="tab-pane">
										   <div class="table-responsive">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>Period</th>
														<?php 
														$uniquePeriod=$this->db->query("SELECT * from period WHERE school_code='$school_code' and nop_id='$period'");
														foreach($uniquePeriod->result() as $row):?>
														<th>
															<?php 
																if($row->period == ''){
																	echo "Lunch";
																}else{
																	echo $row->period;
																}
															?>
														</th>
														<?php endforeach;?>
													</tr>
													<tr>
														<th>Time Slot</th>
														
														<?php foreach($dt1 as $row): 
														
														$this->db->where("id",$row->period_id);
											             $this->db->where("school_code",$school_code);
														 $dt2=$this->db->get("period")->result();
														foreach($dt2 as $row1):

														 //print_r($row1); 
															
														 ?>
														<th><?php echo $row1->from; ?> to <?php echo $row1->to; ?></th>
														<?php endforeach;;
													endforeach;?>
														
														
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><?php echo $class."-".$sec1;?></td>
														<?php foreach($dt1 as $row):
														$this->db->where('time_table_id',$row->id);
														$days= $this->db->get('time_table_days');
														if($days->num_rows()>0){
															foreach($days->result() as $row1):
														 if($row1->days_id == "6")
															{?>
															<?php if($row->teacher == ''):?>
																<td><?php echo "Lunch";?></td>
															<?php else:?>
																<td><?php  $this->db->where("id",$row->subject_id);
																$sname=$this->db->get("subject")->row(); 
																//print_r($sname);
																$this->db->where("id",$row->teacher);
																$ename=$this->db->get("employee_info")->row(); 
																echo $ename->name."<br/>".$sname->subject;?></td>
															<?php endif;}
															endforeach; } ?>
													<?php endforeach;?>
													</tr>
													
												</tbody>
											</table>
										</div>
										</div>
										<!-- for Saturday -->
									</div>
								</div>
							</div>
						</div>
						<!-- end: PAGE CONTENT-->
					
					
<!---     -->
</div>
<br>
<br>
 <div class="col-sm-12 row">
                  
                       
                        </div>
                        <div class="panel-body" id="periodTimetablelist">

                        </div>
                    </div>
                </div>
             </div>
             <script>
              jQuery(document).ready(function() {
                $("#stdexambutton").click(function(){
                var ttmid = $('#examid').val(); 
                var stdexam = $('#stdexam').val(); 
                var fsd = $('#fsda').val();
                   $.ajax({
						"url": "<?= base_url() ?>index.php/singleStudentControllers/timeScheduling1",
						"method": 'POST',
						"data": {fsd : fsd,ttmid : ttmid,stdexam : stdexam},
						beforeSend: function(data) {
							$("#periodTimetablelist").html("<center><img src='<?= base_url()?>assets/images/loading.gif' /></center>")
						},
						success: function(data) {
							$("#periodTimetablelist").html(data);
						},
						error: function(data) {
							$("#periodTimetablelist").html(data)
						}
					})
     
                 });
            $("#stdexam").keyup(function(){
             $("#stdexambutton").show();

                    var student_id = $("#stdexam").val();
                    //alert(teacherid);
                    $.post("<?php echo site_url("index.php/studentController/checkID") ?>",{student_id : student_id}, function(data){
                        $("#validId").html(data);
                        });
                    });
        
        //              Main.init();
        // SVExamples.init();
        
    });
    

</script>