<!--  
Niktech software Solutions,niktechsoftware.com,schoolerp-niktech.in
  <meta name="description" content="Welcome to niktech software School business ERP . we proving school management erp software. we including online attendance with biometric attendance machine and tracking student with GPS technology & many other facilities in our school management erp system">
  <meta name="keywords" content="Enterprise resource planning,school,ERP,system software,attendance,biometric,online, school management,gps,niktech software solution, online result, online admit card,omr">
  <meta name="author" content="School management System software">
-->

<?php $w=0; 


//print_r($var->num_rows());
if($var->num_rows()>0){
			?>	
			<form action ="<?php echo base_url();?>index.php/periodTimeControllers/periodsheduleinsert" method="post">
			<div class="row">
        		<div class="col-md-12 ">
					<div class="panel panel-white">
            			<div class="panel-heading panel-orange">
	            			<i class="fa fa-external-link-square"></i>
								Time Scheduling :
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
							<h4 class="panel-title">
							<?php 
							if(strlen($monday)>0){
							
								$checkTB = $this->periodModel->checkvalue($monday,$period_name);
									if($checkTB->num_rows()>0){
										echo "Scheduling for Monday Is Already Done fill all boxes given below if you want to change current Timle Table or UnCheck Monday";
										?><br><?php 
									}else 
										{echo $monday;}
									
								}
								if(strlen($tuesday)>0){
									
									$checkTB = $this->periodModel->checkvalue($tuesday,$period_name);
									if($checkTB->num_rows()>0){
										
										echo "Scheduling for Tuesday Is Already Done fill all boxes given below if you want to change current Timle Table or UnCheck Tuesday";
										?><br><?php 
									}else 
										{echo $tuesday;}
								}
								if(strlen($wednesday)>0){
									
									$checkTB = $this->periodModel->checkvalue($wednesday,$period_name);
									if($checkTB->num_rows()>0){
										echo "Scheduling for Wednesday Is Already Done fill all boxes given below if you want to change current Timle Table or UnCheck Wednessday";
										?><br><?php 
									}else 
										{echo $wednesday;}
								}
								if(strlen($thursday)>0){
									
									$checkTB = $this->periodModel->checkvalue($thursday,$period_name);
									if($checkTB->num_rows()>0){
										echo "Scheduling for Thursday Is Already Done fill all boxes given below if you want to change current Timle Table or UnCheck Thursday";
										?><br><?php 
									}
									else 
										{echo $thursday;}
								}
								if(strlen($friday)>0){
									
									$checkTB = $this->periodModel->checkvalue($friday,$period_name);
									if($checkTB->num_rows()>0){
										echo "Scheduling for Friday Is Already Done fill all boxes given below if you want to change current Timle Table or UnCheck Friday";
										?><br><?php 
									}else 
										{echo $friday;}
								}
								if(strlen($saturday)>0){
									
									$checkTB = $this->periodModel->checkvalue($saturday,$period_name);
										if($checkTB->num_rows()>0){
											echo "Scheduling for Saturday Is Already Done fill all boxes given below if you want to change current Timle Table or UnCheck Saturday";
										?><br><?php 
										}else {
											echo $saturday;
										}
								}
								?>
							<input type="hidden" name="days" value="<?php 
							if(strlen($monday)>0){
							    //echo $monday;
								echo $monday.",";}
								if(strlen($tuesday)>0){
									echo $tuesday.",";}
								if(strlen($wednesday)>0){
									echo $wednesday.",";}
								if(strlen($thursday)>0){
									echo $thursday.",";}
								if(strlen($friday)>0){
									echo $friday.",";}
								if(strlen($saturday)>0){
									echo $saturday.",";}
											 ?>"/>
						</h4>
						</div>
						<div class="panel-body" id ="createBody">
							<div class="row">
								<div class="col-sm-12">
									<!-- start: INLINE TABS PANEL -->
									<div class="panel panel-white">
										<table class="table table-hover" width ="100%">
			 								<tr>
			 									<td class ="center">
													PERIODS
												</td>
												<?php 
												//-----------------------------//

												$prid = array();  $lunch = 1; $c=1; foreach ($var->result() as $pk){
														//print_r($pk);

												 ?>
												<td class ="center">
													<input type="hidden" name="from<?php echo $c?>" value="<?php echo $pk->from."-".$pk->to?>" />
													
													<?php
														if($lunch != $pk->lunch){
														$prid[$c]=$pk->id;	echo $pk->period;
													?>
														<input type="hidden" name="period<?php echo $c?>" value="<?php echo $pk->id?>" />
													<?php 
													}
													else{ 
														echo "Lunch";?>
														<input type="hidden" name="period<?php echo $c?>" value="Lunch" />
														<?php }
												?></td>
												<?php $lunch++;$c++; } ?> 
											</tr> 
											<tr>
												<td class= "center">TIME SLOTS</td>
												<?php //print_r($var->result());
												foreach ($var->result() as $pk): ?>
												<td class = "center" ><?php echo $pk->from;?> - <?php echo $pk->to; ?></td>
												<?php endforeach; ?>
											</tr>
				  							<?php 
				  							$tbr=1;
				  							foreach($className->result() as $row){

				 							 ?>
				  							<tr>
				  								<td class= "center">
				  									<?php echo $row->class_name;?>-
				  									<?php $this->db->where("id",$row->section);
				  									 $sec=$this->db->get("class_section")->row(); 
				  									echo $sec->section;
				  											
				  									?> 
				  									<input type="hidden" name="class1<?php echo $tbr;?>" value="<?php echo $row->id.",".$row->section;?>" />
				  									<?php
				  									$subject = $this->periodModel->getSubjectName($row->id);
				  									//print_r($subject);
				  									?>
				  								</td>
				  									<?php for($tbc = 1; $tbc <= $countPeriod; $tbc++){
				  												if($tbc != $dog->lunch){ 
				  									?>				
				  								<td>
				  									<select class="form-control" id="teacher<?php echo $tbr.$tbc;?>" name="teacher<?php echo $tbr.$tbc;?>" >
														<option value="N/A">-Select Teacher-</option>
														
														<?php
											
														foreach($teacher->result() as $tea):
															$this->db->where('class_id',$row->id);
															$this->db->where('teacher',$tea->id);
															//$this->db->where('time_thead_id',$period_name);
														$this->db->where('period_id',$prid[$tbc]);
														$oldv = $this->db->get("time_table");
				 	//	$oldv = $this->db->query("SELECT * FROM time_table WHERE class_id='$row->id' AND teacher='$tea->id' AND period_id='$prid[$tbc]' AND day LIKE '%$monday%' OR day LIKE '%$tuesday%' OR day LIKE '%$wednesday%' OR day LIKE '%$thursday%' OR day LIKE '%$friday%'");
                  // 	$oldv = $this->db->query("SELECT * FROM time_table WHERE class_id='$row->id' AND teacher='$tea->id' AND period_id='$prid[$tbc]' AND day LIKE '%$tuesday%'");
    //                   	$oldv = $this->db->query("SELECT * FROM time_table WHERE class_id='$row->id' AND teacher='$tea->id' AND period_id='$prid[$tbc]' AND day LIKE '%$wednesday%'");
                                
            //                                     	$this->db->like('day',$monday);
            //                                         $this->db->or_like('day',$tuesday); 
            //                                          $this->db->or_like('day',$tuesday); 
            //                                          $this->db->or_like('day',$wednesday); 
            //                                          $this->db->or_like('day',$thursday); 
            //                                          $this->db->or_like('day',$friday); 
            //                                          $this->db->or_like('day',$saturday); 
            //                                          $this->db->where('class_id',$row->id);
												// 	$this->db->where('teacher',$tea->id);
												// 	$this->db->where('period_id',$prid[$tbc]);
												
            //                                          	$oldv = $this->db->get("time_table");
            
            
    //          $this->db->select('*')->from('time_table')->where('class_id', $row->id)-> where('teacher', $tea->id)-> where('period_id', $prid[$tbc]);
    // $this->db->like('day',$monday,'after');
    // $this->db->or_like('day',$tuesday,'after');
    // $this->db->or_like('day',$wednesday,'after');
    // $this->db->or_like('day',$thursday,'after'); 
    //   $oldv = $this->db->get();

                                                   			?>
														<option value="<?php echo $tea->id; ?>" <?php if($oldv->num_rows()>0){$oldt=$oldv->row(); if($oldt->teacher==$tea->id){echo 'selected="selected"';}}?>>
															<?php echo $tea->name."[".$tea->username."]" ;
															?>
														</option>
														<?php echo $tea->id; endforeach; ?>
													</select>
													
													<select class="form-control" id="subject<?php echo $tbr.$tbc;?>" name="subject<?php echo $tbr.$tbc;?>" >

														<option value="N/A">-Select Subject-</option>
														<?php foreach($subject->result() as $row1):?>	

														<?php $this->db->where('class_id',$row->id);
														$this->db->where('period_id',$prid[$tbc]);
														$this->db->where('subject_id',$row1->id);
														//$this->db->where('time_thead_id',$period_name);
														$oldv = $this->db->get("time_table"); 

														?>
														<option value="<?php echo $row1->id; ?>" <?php if($oldv->num_rows()>0){ $oldt=$oldv->row();if($oldt->subject_id== $row1->id){echo 'selected="selected"';}} ?>>
															<?php echo $row1->subject."[".$row1->id."]" ;?>
														</option>
														<?php endforeach;?>
													</select>
									 			</td>
									 			<?php			} // End if condition of Lunch
										
				  												else{ ?> 
				  								<td class = "center"> <?php echo "Lunch";?></td>
				  								<?php
																} // End Else
				  									} // End For

												?> 
											</tr>
												<?php  $tbr++;

												}//end foreach
												?>
					</table>
					<input type="hidden" name="tbr" value="<?php echo $tbr;?>"/>
					<input type="hidden" name="tbc" value="<?php echo $tbc;?>"/>
					<input type="hidden" name="period_id" value="<?php echo $period_name;?>"/>
				</div> 

				
				<div class="form-group center">
	       			<input class="submit btn btn-blue" type="submit" value="Save &amp; Print Slip" />
	        	</div>
				<?php
				}
							else
								{
									echo "<div class='col-sm-6 bg-dark' style='color:red'>First Define Period and Time Slot and then select your time Scheduling</div>" ;
								}
								 ?>
       	   </div>
      	  </div>
     	  </div>
  		 </div>
	</div></div>
	</form>
	<script>
	<?php 
	for($i = 1; $i<=$tbr; $i++){
		for($j = 1; $j <= $tbc; $j++){
			?>
			$('select#teacher<?php echo $i. $j; ?>').change(
				function(){
					var val1 = $('#teacher<?php echo $i.$j; ?>').val()
			<?php
				for($k = 1; $k<=$tbr; $k++){				
					if($k != $i){
						?>
						var val<?php echo $k+1; ?> = $('#teacher<?php echo $k. $j; ?>').val()
						if(val1 == val<?php echo $k+1; ?>){
							//alert("This teacher can't attend 2 class at same time.");
							document.getElementById('teacher<?php echo $i.$j; ?>').value = "";
						}
						<?php
					}
				}
		?>
				});
		<?php
		}
	} ?>
	</script>
	