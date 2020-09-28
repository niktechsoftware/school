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
          <p class="media-timestamp">Welcome To Objective Questions Area,There will be question shows here and you will click on a radio button to select the answer and click on the save&next button to save your answer.Click on previous button to go to previous question.
When all questions are answered, then click on submit button.
        </div>
 
<script>
var myVar = setInterval(myTimer ,1000);
function myTimer() {
  var d = new Date();
  document.getElementById("demo").innerHTML = d.toLocaleTimeString();
}


// Set the date we're counting down to
var countDownDate = new Date(new Date().getTime() + 60 * 60 * 1 * 1000);
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
  document.getElementById("demoleft").innerHTML =  hours + "h "
  + minutes + "m " + seconds + "s  Left";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demoleft").innerHTML = "EXPIRED";
  }
}, 1000);
</script>

        
						<div class="row" >
							<input type="hidden" id="school_code" value = "<?php echo $school_code;?>">
								<input type="hidden" id="stud_id" value = "<?php echo $stud_id;?>">
							
								<div class="col-md-8 col-lg-8 col-sm-8">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-blue border-light">
                          <h4 class="panel-title" style="font-size:150%;">Question</h4>
                          <p id="demo" style="margin-left:80%; font-size:150%;"></p>
                          <p id="demoleft" style="margin-left:80%; font-size:150%;"></p>
                        </div>
                        <div class="panel-body" id="list" >
						
							   <?php  $i=1;   foreach($ques as $key => $value):
							   	$this->db->where("id",$ques[$i]);
			                $firstQuestion=$this->db->get("question_master")->row();
			                $this->db->where("question_master_id",$ques[$key]);
			               $option= $this->db->get("question_ans")->row();
			               
			               //make model
			            $this->db->where("exam_id",$firstQuestion->exam_master_id);
						              $this->db->where("subject_id",$firstQuestion->exam_subject_id);
						              $this->db->where("question_id",$ques[$key]);
						              $this->db->where("student_id",$stud_id);
						             // echo $stud_id;
						             // exit();
						               $quesStatus = $this->db->get("objective_exam_result");
						               if($quesStatus->num_rows()>0){
						                   $AnswerP = $quesStatus->row()->given_answer;
						               }else{
						                   $AnswerP="H";
						               }
			?>
						<input type="hidden" id="exam_id" value = "<?php echo $firstQuestion->exam_master_id;?>">
							<input type="hidden" id="subject_id" value = "<?php echo $firstQuestion->exam_subject_id;?>">	 
							<div id ="question<?php echo $i;?>" > 
						<h1 style=""><?php echo $i;?>.&nbsp&nbsp<?php echo $this->examModel->getOrgQuestion($firstQuestion->id);?></h1> 
							<h1 style="margin-left:290px;"></h1>  
								<input type="hidden" id="row<?php echo $i;?>" value = "<?php echo $i;?>">
									<input type="hidden" id="qid<?php echo $i;?>" value = "<?php echo $firstQuestion->id;?>">
									  <div class="alert alert-info">Select any one answer</div>
									<div class="row col-md-12" >
										   
										<div class="col-md-6">
										   
										   <?php if($option->A){?> <div class="col-md-12">
    											<div class="col-md-3">
    
    												<input type="radio" id="a1<?php echo $i;?>"  <?php if($AnswerP =="A"){echo "checked";}?> name="answer<?php echo $i;?>" value="A" style="height:20px; width:20px;">
    											</div>	
    											<div class="col-md-9">
    									            	<h5 style="font-size:20px">A).<?php echo $this->examModel->getOrgAnswer($firstQuestion->id,$option->A,1);?></h5>
    											</div>
											</div>
											<?php }?>
												<br>	<br>	<br>	<br>
										 <?php if($option->B){?> 		
											<div class="col-md-12">
    											<div class="col-md-3">
    												<input type="radio" id="b1<?php echo $i;?>" <?php if($AnswerP =="B"){echo "checked";}?>  name="answer<?php echo $i;?>" value="B" style="height:20px; width:20px;">
    											</div>	
    											<div class="col-md-9">	
    											<h5 style="font-size:20px">	B ).<?php echo $this->examModel->getOrgAnswer($firstQuestion->id,$option->B,2);?></h5>
    											</div>
											</div>	
											<?php }?>
												<br>	<br>	<br>	<br>
												 <?php if($option->C){?> 
											<div class="col-md-12">
        											<div class="col-md-3">	
        												<input type="radio" id="c1<?php echo $i;?>" <?php if($AnswerP =="C"){echo "checked";}?>  name="answer<?php echo $i;?>" value="C" style="height:20px; width:20px;">
        											</div>	
        											<div class="col-md-9">	
        											<h5 style="font-size:20px">	C ).<?php echo $this->examModel->getOrgAnswer($firstQuestion->id,$option->C,3);?></h5>
        											</div>	
        										</div>
        										<?php }?>
        											<br>	<br>	<br>	<br>
												</div>
												 <?php if($option->D){?> 
    											<div class="col-md-6"> 
    												<div class="col-md-12">
                										<div class="col-md-3">	
                											<input type="radio" id="d1<?php echo $i;?>" <?php if($AnswerP =="D"){echo "checked";}?> name="answer<?php echo $i;?>" value="D" style="height:20px; width:20px;">
                											</div>	
            											<div class="col-md-9">	
                									        <h5 style="font-size:20px">D ).<?php echo $this->examModel->getOrgAnswer($firstQuestion->id,$option->D,4);?></h5>
                										</div>	
                									</div>
                									<?php }?>
                									<br>	<br>	<br>	<br>
                									 <?php if($option->E){?> 
                    							<div class="col-md-12">			
            										<div class="col-md-3">	
            											<input type="radio" id="e1<?php echo $i;?>" <?php if($AnswerP =="E"){echo "checked";}?> name="answer<?php echo $i;?>" value="E" style="height:20px; width:20px;">
            										</div>	
        									    	<div class="col-md-9">	
        									                <h5 style="font-size:20px">	E ).<?php echo $this->examModel->getOrgAnswer($firstQuestion->id,$option->E,5);?></h5>
        											</div>
        										</div>	
        										<?php }?>
    											<br>	<br>	<br>	<br>
    											</div>                                    
										</div>
							<br>
							<br>
							<br>
							<br>
									<button id="next<?php echo $i;?>" style="margin-left:40%" class="btn btn-success" >Save & Next</button>
									
								
									<button id="previous<?php echo $i;?>" class="btn btn-warning">Previous </button>
										<script>
								     $("#next<?php echo $i;?>").click(function(){
								           
								         var result=$("input:radio[name=answer<?php echo $i;?>]:checked").val();
								         if(result.length > 0){
								                var qid =  $("#qid<?php echo $i;?>").val();
								                var sid =  $("#stud_id").val();
								                var school_code =  $("#school_code").val();
								                 var exam_id =  $("#exam_id").val();
								                var subject_id =  $("#subject_id").val();
								               // alert(sid);
								             $.post("<?php echo site_url("index.php/singleStudentControllers/updateGivenAnswer") ?>",{qid : qid,sid : sid,school_code : school_code, exam_id : exam_id, subject_id : subject_id , result : result}, function(data){
                        						
                        						$("#questionleft<?php echo $i;?>").removeClass("btn btn-sm btn-light-red").addClass("btn btn-sm btn-light-green");
                        						});
								         }
								        
                            				 $("#question<?php echo $i+1;?>").show();
                            				 	 $("#question<?php echo $i;?>").hide();
                            					});
                            		 $("#previous<?php echo $i;?>").click(function(){
                            				 $("#question<?php echo $i-1;?>").show();
                            				 	 $("#question<?php echo $i;?>").hide();
                            					});			
			
								</script>
								</div>
						<?php $i++; endforeach;
						?>
						<div id ="question<?php echo $i;?>" > 
						<h2>There is no more question please review and submit for result.</h2>
							<button id="previous<?php echo $i;?>" class="btn btn-warning">Previous </button>
						<script>	 $("#previous<?php echo $i;?>").click(function(){
                            				 $("#question<?php echo $i-1;?>").show();
                            				 	 $("#question<?php echo $i;?>").hide();
                            					});
                        </script>    					
                      	</div>
					<br>
						<br>                                           
						                            
					
						<a href="<?php echo base_url();?>index.php/singleStudentControllers/objectiveque_result/<?php echo $firstQuestion->exam_master_id;?>/<?php echo $stud_id;?>/<?php echo $firstQuestion->exam_subject_id;?>">
						<button id="submit" class="btn btn-info button" style="margin-left:45%;" >Submit</button></a>
						
						</div>
						</div>
						</div>
					
						
						    <div class="col-md-4 col-lg-4 col-sm-4">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-red border-light">
                          <h4 class="panel-title">List</h4>
                        </div>
                        <div class="panel-body" id="list">
                            	 <?php  $i=1;   foreach($ques as $key => $value):
                            	      $this->db->where("exam_id",$firstQuestion->exam_master_id);
						              $this->db->where("subject_id",$firstQuestion->exam_subject_id);
						              $this->db->where("question_id",$ques[$key]);
						              $this->db->where("student_id",$stud_id);
						               $quesStatus = $this->db->get("objective_exam_result");
						               if($quesStatus->num_rows()>0){
			  ?>                            
                                       <button class="btn btn-sm btn-light-green" id="questionleft<?php echo $i;?>" style="font-size:15px;">
												<i class="<?php echo "fa fa-check";?>"></i> 
												<?php echo $key;?>
											</button>    
									
                                       	<?php }else{?>
                                       	<button class="btn btn-sm btn-light-red" id="questionleft<?php echo $i;?>" style="font-size:15px;" >
												<i class="<?php echo "fa fa-times fa fa-white";?>"></i> 
											<?php echo $key;?>
											</button>
                                      	
                                       	<?php }?>
                                       		<script>      
								        $("#questionleft<?php echo $i;?>").click(function(){
								             <?php  $l=1;   foreach($ques as $key => $value):?>
                                                           $("#question<?php echo $l;?>").hide(); 
                                                     	<?php	$l++; endforeach;?>
                                                     	
                            				 $("#question<?php echo $i;?>").show();
                            				 
                            					});
                            	
								</script>
                                           <?php $i++;endforeach;	
                                                  ?>



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