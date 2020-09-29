<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
pet {
  text-align: center;
  font-size: 60px;
  margin-top: 0px;
}
</style>

	<div class="row">
							<div class="col-md-12">
								<!-- start: DYNAMIC TABLE PANEL -->
								<div class="panel panel-white">


								  <div class="panel-heading panel-purple">

										<h4 class="panel-title"> <span class="text-bold">Objective Question</span></h4>

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
									<br>
									<div class="panel-body" id="txt" >
									   
<div class="alert alert-info">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to Student Questions</h3>
          <p class="media-timestamp">Welcome To Subjective Questions Area,There will be question Paper here and you will click to download button to download question paper and Solve then after you can upload your Answer </div>
 
<script>
var myVar = setInterval(myTimer ,1000);
function myTimer() {
  var d = new Date();
  document.getElementById("demo").innerHTML = d.toLocaleTimeString();
}

// Set the date we're counting down to
var countDownDate = new Date(new Date().getTime() + 60 * 60 * 2 * 1000);
// Update the count down every 1 second
var x = setInterval(function() {

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s Left";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>

        
						<div class="row" >
								<div class="col-md-12 col-lg-12 col-sm-12">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-blue border-light">
                          <h4 class="panel-title" style="font-size:150%;">Question Paper</h4>
                          <p id="demo" style="margin-left:80%; font-size:150%;"></p>
                        </div>
                        
                        <div class="panel-body" id="list" >
                            <?php 
                            	$this->db->where("exam_mode_id",$exam_mode_id);
								$getsheet=$this->db->get('subjective_question')->row();
									$this->db->where("id",$exam_mode_id);
												$exammoded1 = $this->db->get("exam_mode");
												$exammoded=$exammoded1->row();
									$this->db->where("id",$exammoded->class_id);
											$classname= 	$this->db->get("class_info")->row();;
											
											$this->db->where("id",$exammoded->subject);
											$subject= 	$this->db->get("subject")->row();;
											
											
										$this->db->where("exam_mode_id",$exam_mode_id);
        		                        $this->db->where("student_id",$studentD->id);
        	
        		                        $sar = $this->db->get("subjective_answer_report");
								
								?>
                               <div class="alert alert-warning"> Subjective Exam panel for <?php echo $studentD->name;?></div>
                              
                               <form action="<?php echo base_url();?>index.php/examControllers/submit_Ans"  method ="post" enctype="multipart/form-data">
                                   <div class="table-responsive">
            						<table class="table table-striped table-hover">
            							 <thead><tr><th>Sno</th><th>class</th><th>Subject</th><th>Download Question</th><th>Upload Answer</th><th>Action</th></tr></thead>
            							<tbody>
            							    
            							         
            							    <?php $i=1;for($i=1; $i<6;$i++){?>
            							     <form action="<?php echo base_url();?>index.php/examControllers/submit_Ans"  method ="post" enctype="multipart/form-data">
            							        <tr>
            							                <td>	<input type="hidden" name="subjeciveID" id="rowid" value="<?php echo $getsheet->id;?>"/>
            										<input type="hidden" name="student_id" id="student_id" value="<?php echo $studentD->id;?>"/>
            										<input type="hidden" name="exam_mode_id" value = "<?php echo $exam_mode_id;?>">
            										<input type="hidden" name="school_code" value = "<?php echo $school_code;?>">
            										<input type="hidden" name="stud_username" value = "<?php echo $stu;?>">
            							                   <?php echo $i;?><input type="hidden" name ="ro" value="<?php echo $i;?>">
            							                </td>
            							                <td>
            							                   <?php echo $classname->class_name;?>
            							                </td>
            							                <td>
            							                    <?php $vi ="image".$i; echo $subject->subject;?>
            							                </td>
            							                <td><?php if($getsheet->$vi){?>
            							                   <a href="<?php echo base_url();?>assets/images/question_img/<?php echo $getsheet->$vi ;?>"><?php echo $getsheet->$vi ;?>
            							                 <!--  <img src="<?php echo base_url();?>assets/images/question_img/<?php echo $getsheet->image ;?>" alt="" width="200" height="250"/>-->
            							                  <!--<iframe src="<?php echo base_url();?>assets/images/question_img/<?php echo $getsheet->image ;?>" ></iframe> -->
            							                  <object src="<?php echo base_url();?>assets/images/question_img/<?php echo $getsheet->$vi ;?>"><embed src="<?php echo base_url();?>assets/images/question_img/<?php echo $getsheet->$vi ;?> " width="200" height="250"></embed></object>
            							                   
            							                   </a>
            											
								                            <?php }?>
            							                </td>
            							                <td>
            							                    <?php if($sar->num_rows()>0){
            							                        
            							                        $value1="upload_answers".$i;
            							                        if($sar->row()->$value1){
            							                        ?><a href="<?php echo base_url();?>assets/images/question_img/<?php echo $sar->row()->$value1 ;?>">
            							                        <img src="<?php echo base_url();?>assets/images/question_img/<?php echo $sar->row()->$value1 ;?>" alt="" width="300" height="450"/>
            							                        
            							                        </a>
            							                   <?php  }}?>
            							                    <input type="file" name="answerSheet<?php echo $i;?>" class= "form-controll" accept="image/*" capture="camera">
            							                   
            							                    
            							                </td>
            							                 <td>
            							                    <button class="btn btn-success" >Submit</button>
            							                  
            							                </td>
            							                
            							        </tr>
            							      </form>
            							        <?php }?>
            							         
            							</tbody>	
            
            
                                    </table>
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
  </div>
   </div>
<script>
 <?php  $i=1;   foreach($ques as $key => $value):
     if($i==1){?>
        $("#question<?php echo $i;?>").show();
   <?php   }else{?>
       $("#question<?php echo $i;?>").hide();  
    <?php }
 ?>
 	<?php	$i++; endforeach;?>
           
</script>