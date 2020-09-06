<link rel="stylesheet" href="<?php echo base_url();?>assets/css/question.css">

<style>
.radio{
    display:inline-block;
    width:30px;
    height: 30px;
    border-radius: 100%;
    background-color:lightblue;
    border: 2px solid lightblue;
    cursor:pointer;
  
}
</style>
<div class="alert alert-info">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to Student Questions</h3>
          <p class="media-timestamp">Here you can see Student Attendance shift wise.If you want to see Morning Attendance of any Student then click on Morning Attendance 
          Button Other wise click on After Lunch Button.
        </div>
						<div class="row" >
							<div class="col-md-4 col-lg-4 col-sm-6" style="background-color:white;height:500px;">
						
							</div>
							<div class="col-md-4 col-lg-4 col-sm-6" style="height:500px;">
							<div id ="question"></div>
							<h1>Quiz on Important Facts</h1>
						<div class="quiz-container">
						  <div id="quiz"></div>
						</div>
						<button id="previous">Previous Question</button>
						<button id="next">Next Question</button>
						<button id="submit">Submit Quiz</button>
						<div id="results"></div>	
						   </div>
						   	<div class="col-md-4 col-lg-4 col-sm-6" style="height:500px; background-color:white;">
								<?php
			
		
		//print_r($data);
		//echo $data->id;
			?>
			 <?php  $i=1;   foreach($ques->result() as $row):
			  ?>
                                               
                                       <div class='radio' data-value="One"><?php echo $i;?></div>
                                           <?php $i++;endforeach;	
                                                  ?>					
								
								
						   </div>
   </div>

<script>
$("#next").click(function(){
					var streamid = $("#classv").val();
					
					var sectionid = $("#sectionId").val();
					//alert(sectionid +"-"+streamid);
					$.post("<?php echo site_url("index.php/teacherController/getclassforexam") ?>",{streamid : streamid,sectionid : sectionid}, function(data){
						$("#classId").html(data);
						});
					
					});
</script>