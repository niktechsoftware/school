<style>
.radio1{
    display:inline-block;
    width:50px;
    height: 50px;
    border-radius: 100%;
    background-color:lightblue;
    border: 3px solid lightblue;
    cursor:pointer;
  
}
</style>
	<div class="row">
							<div class="col-md-12">
								<!-- start: DYNAMIC TABLE PANEL -->
								<div class="panel panel-white">


								  <div class="panel-heading panel-purple">

										<h4 class="panel-title">Class  <span class="text-bold">Promotion Report</span></h4>

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
									<div class="panel-body">
<div class="alert alert-info">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to Student Questions</h3>
          <p class="media-timestamp">process
        </div>
						<div class="row" >
							<input type="hidden" id="school_code" value = "<?php echo $school_code;?>">
								<input type="hidden" id="stud_id" value = "<?php echo $stud_id;?>">
								
							<div class="col-md-8 col-lg-8 col-sm-8" style="height:500px;">
							   <?php  $i=1;   foreach($ques as $key => $value):
							   	$this->db->where("id",$ques[$i]);
			                $firstQuestion=$this->db->get("question_master")->row();
			                $this->db->where("question_master_id",$ques[$key]);
			               $option= $this->db->get("question_ans")->row();
			?>
						<input type="hidden" id="exam_id" value = "<?php echo $firstQuestion->exam_master_id;?>">
							<input type="hidden" id="subject_id" value = "<?php echo $firstQuestion->exam_subject_id;?>">	 
							<div id ="question<?php echo $i;?>"> 
						<h1>Quesion : <?php echo $i;?></h1> 
							<h1><?php echo $firstQuestion->question;?></h1>  
								<input type="hidden" id="row<?php echo $i;?>" value = "<?php echo $i;?>">
									<input type="hidden" id="qid<?php echo $i;?>" value = "<?php echo $firstQuestion->id;?>">
									<div class="row col-md-12" >
										    
										<div class="col-md-6">
										    <div class="col-md-12">
											<div class="col-md-4">
												<input type="radio" id="a1<?php echo $i;?>"  name="answer<?php echo $i;?>" value="A">
											</div>	
											<div class="col-md-8">
									            	A ).<?php echo $option->A;?>
											</div>
											</div>
												<br>	<br>
											<div class="col-md-12">
    											<div class="col-md-4">
    												<input type="radio" id="b1<?php echo $i;?>"  name="answer<?php echo $i;?>" value="B">
    											</div>	
    											<div class="col-md-8">	
    												B ).<?php echo $option->B;?>
    												</div>
											</div>	
												<br>	<br>
											<div class="col-md-12">
        											<div class="col-md-4">	
        												<input type="radio" id="c1<?php echo $i;?>"   name="answer<?php echo $i;?>" value="C">
        											</div>	
        											<div class="col-md-8">	
        												C ).<?php echo $option->C;?>
        											</div>	
        										</div>
        											<br>	<br>
												</div>
    											<div class="col-md-6"> 
    												<div class="col-md-12">
                										<div class="col-md-4">	
                											<input type="radio" id="d1<?php echo $i;?>"  name="answer<?php echo $i;?>" value="D">
                											</div>	
            											<div class="col-md-8">	
                									<label>	D ).	<?php echo $option->D;?></label>
                										</div>	
                									</div>
                									<br>	<br>
                							<div class="col-md-12">			
    										<div class="col-md-4">	
    											<input type="radio" id="e1<?php echo $i;?>"  name="answer<?php echo $i;?>" value="E">
    										</div>	
    									    	<div class="col-md-8">	
    										E ).	<?php echo $option->E;?>
    											</div>
    										</div>	                                 
    											</div>                                    
										</div>
							
									<button id="next<?php echo $i;?>" class="btn btn-success">Save & Next</button>
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
								             $.post("<?php echo site_url("index.php/singleStudentControllers/updateGivenAnswer") ?>",{qid : qid,sid : sid,school_code : school_code, exam_id : exam_id, subject_id : subject_id , result : result}, function(data){
                        						$("#questionleft").html(data);
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
						<?php $i++; endforeach;?>
						<div class="quiz-container">
						  <div id="quiz"></div>
						</div>
						
					
						<button id="submit">Submit Quiz</button>
						<div id="results"></div>	
						   </div>
						   	<div class="col-md-4 col-lg-4 col-sm-6" style="height:500px; background-color:white;">
						
			 <?php  $i=1;   foreach($ques as $key => $value):
			  ?>
                                               
                                       <div class='radio1' id="questionleft<?php echo $i;?>" style="background-color:red; font-size:300%;" ><span><?php echo $key;?></span></div>
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