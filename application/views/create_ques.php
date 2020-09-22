<?php $school_code = $this->session->userdata("school_code");?>
<?php $uri=  $this->uri->segment(3);?>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  
}

td, th {
  border:  ;
  text-align: center;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
#demo {
  display: none;
}
</style>
</style>

<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			 <div class="panel-heading panel-pink">
				<h4 class="panel-title"><span class="text-bold">Configuration Test</span></h4>
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
										
										<table class="table table-responsive">
										<thead>
											<tr style="background-color:#E2EFED">
											<?php $i=1;
											
											foreach($exam->result() as $res):?>
											 <?php $this->db->where('id',$res->exam_id);
											 	$ename=$this->db->get('exam_name')->row();
											 	$this->db->where('id',$res->class_id);
												$info=$this->db->get('class_info')->row();
												$this->db->where('id',$res->section);
												$sec=$this->db->get('class_section')->row();
											 	$this->db->where('id',$res->language);
												$lan=$this->db->get('language')->row();
												$this->db->where('id',$res->subject);
												$sub=$this->db->get('subject')->row();
											 ?>
												<th><?php   echo $ename->exam_name;;  ?></th>
												<th><?php   echo $info->class_name;  ?></th>
												<th><?php   echo $sec->section;  ?></th>
												<th><?php   echo $lan->language;  ?></th>
												<th><?php   echo $sub->subject;  ?></th>
											 <?php $i++;
											 endforeach; ?>
											 </tr>
											 <thead>
										  </table>
											</br>
											</br>
	  
					   <div class="form-group">
							<div>
                                      <center><label><h5 style="font-size:150%;">Select Question Type :</h5></label><br>
                                      <label><h5 style="font-size:130%;">Normal Questions :</h5></label><input type="radio" name="radio_q" id="radio_1" style="width:20px; height:18px;"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      <label><h5 style="font-size:130%;">Questions With Images:</h5></label><input type="radio" name="radio_q" id="radio_2" style="width:20px; height:18px;"/></center>
                            </div>
                           <div style="margin-left:80%;">  <button type="button"  onclick="myFunction()" class="btn btn-info" >View Demo</button>
                              <div class="form-group" id="demo" >
                                  <form action="<?php echo base_url();?>index.php/examControllers/demoExam"  method ="post" role="form" class="smart-wizard form-horizontal" id="form">
                                  <input type="text" name="stu_id" id="stu_id" placeholder="Stundent Id ">
                                  <input type="hidden" name="class_id" value="<?php echo $res->class_id;?>">
                                  <input type="hidden"  name="exam_id" value="<?php echo $res->exam_id;?>">
                                  <input type="hidden"  name="fsd" value="<?php echo $this->session->userdata("fsd");?>">
                                   <input type="hidden"  name="subjectid" value="<?php echo $res->subject;?>">
                                  
                                  </br>
                                  <input  type="submit">
                                   </form>
                            </div>
                                  </div>
                              <script>
function myFunction() {
  document.getElementById("demo").style.display = "block";
}
</script>
							<div id="normal_ques">
                                 <div class="row">
                                        <div class="col-md-3 "><label style="float:right"><h4>Question :</h4></label></div>
                                        <div class="col-md-6"><textarea id="ques" class="form-control" placeholder="Write Question here"></textarea></div>
										<div class="col-md-3 "></div>
								 </div>
										</br>
										</br>
								 <div class="row">
									 <div class="panel-heading panel-red border-light"><h4 class="panel-title">Answer Options :</h4></div>
                                        </br>
										</br>
										<div class="row" style="margin-left:55px;">
										    <div class="col-md-2"></div>
												<div class="col-md-4">
													A:<input class="form-control" type="text" id="a1"/><br>
													B:<input class="form-control" type="text" id="b1"/><br>  
													C:<input class="form-control" type="text" id="c1"/><br>
												</div>
											<div class="col-md-4">                                                                                                         
												D:<input class="form-control" type="text" id="d1"/><br>
												E:<input class="form-control" type="text" id="e1"/><br>   
												Select Answer:<select class="form-control" id="sel_ct" style="width:350px">
													<option value="0">--Select--</option>
													<option value="1">A</option>
													<option value="2">B</option>
													<option value="3">C</option>
													<option value="4">D</option>
													<option value="5">E</option>
												</select>                                    
											</div>                                    
										</div>
										</br>
                                    <input style="margin-left:50%;" type="button" value="Submit" id="submit_q" class="btn btn-primary"/>     
								 </div>
							</div>
									</br>
									</br>
							<div id="image_ques">
                                 <form method="post" id="uploadform" enctype="multipart/form-data" action="" >
                                    <div class="row">
                                        <input type="hidden" name="exam_master_id1"  id="exam_master_id" value="<?php echo $select_exam; ?>">
                                     <input type="hidden" name="exam_language"  id="exam_language" value="<?php echo $language; ?>">
                                        <input type="hidden" name="exam_subject_id1" id="exam_subject_id" value="<?php echo $res->subject; ?>">
                                        <div class="col-md-3"><label style="float:right"><b>Question :</b></label></div>
                                        <div class="col-md-6">
                                            <textarea id="ques1" name="ques1" class="form-control" placeholder="Write Question here"></textarea>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input style="margin-top:15px;" type="file" id="qf1_id" name="qf1">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <input  style="margin-top:15px;" type="file" id="qf2_id" name="qf2">
                                                        </div>
                                                    </div>         
                                                </div>
                                                <div class="col-md-6">                                                
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input style="margin-top:15px;" type="file" id="qf3_id" name="qf3">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <input  style="margin-top:15px;" type="file" id="qf4_id" name="qf4">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                       
                                        </div>
										
                                       
                                    </div>
									</br>
									</br>
									 <div class="row">
									 <div class="panel-heading panel-red border-light" style="width:1100px; margin-left:3%;"><h4 class="panel-title">Question Options :</h4></div>
                                        </br>
										</br>
										<div class="row" style="margin-left:55px;">
										    <div class="col-md-2"></div>
												<div class="col-md-4">
													 A:<input type="text" id="txt_af1_id" name="txt_af1" class="form-control" required><input type="file" id="af1_id" name="af1" class=""><br>
													 B:<input type="text" id="txt_af2_id" name="txt_af2" class="form-control" required><input type="file" id="af2_id" name="af2" class="" ><br>
													 C:<input type="text" id="txt_af3_id" name="txt_af3" class="form-control" required><input type="file" id="af3_id" name="af3" class="" ><br>
												</div>
												<div class="col-md-4">                                                                                                         
													 D:<input type="text" id="txt_af4_id" name="txt_af4" class="form-control" required><input type="file" id="af4_id" name="af4" class="" ><br>
													 E:<input type="text" id="txt_af5_id" name="txt_af5" class="form-control" ><input type="file" id="af5_id" name="af5" class="" ><br>
													 Select Answer:<select class="form-control" required name = "sel_ct" style="width:350px;">
														<option value="0" disabled selected>--Select--</option>
														<option value="1">A</option>
														<option value="2">B</option>
														<option value="3">C</option>
														<option value="4">D</option>
														<option value="5">E</option>
													 </select>                        
												</div>                                    
										</div>
										</br>
                                    <center><input type="submit" value="Submit" id="submit_imgq" name="bt_qq" class="btn btn-primary" /></center>
                                    </div>
								 </form>	
							</div>
							<div id ="mydiv_q" class="table-responsive">
								<div class="panel-heading panel-blue border-light"><h4 class="panel-title">Exam Question List</h4></div>
                                    <table class="table table-responsive" id="table-2">
                                        <thead>
                                            <tr>
                                                <th class="text-center"> #</th>
                                                <th class="text-center">Exam Name</th>
                                                <th class="text-center">Language</th>

                                                <th class="text-center">Subject</th>
                                                <th class="text-center">Question</th>
                                                <th class="text-center">Answer</th>
                                                <th class="text-center">Edit</th>
                                                <th class="text-center">Delete</th>                     
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php $i=1; 
										 if($dt_qt->num_rows()>0){
												foreach($dt_qt->result() as $data_q){ ?>
											<tr>
												<td class="text-center"><?php echo $i;?></td>
									
												<td><?php  echo $ename->exam_name;?></td> 
												
												<td><?php echo $lan->language;?></td>
												
												<td><?php echo $sub->subject; ?></td>
													
												<td><?php 	echo $this->examModel->getOrgQuestion($data_q->id);
												 ?></td> 
												
													<?php $this->db->where('question_master_id',$data_q->id);
														  $dx_q = $this->db->get('right_answer'); ?>
												<input type="hidden" id="questt_id<?= $i;?>" value="<?= $data_q->id;?>">
												<td class="text-center"><?php if($dx_q->num_rows()>0){ ?><textarea readonly> <?php echo $dx_q->row()->right_answer; ?></textarea> <?php } else { ?> <textarea readonly> <?php echo "N/A"; }  ?></textarea></td>
												<td class="text-center"><a target="_blank" href="<?= base_url();?>index.php/login/edit_q/<?= $data_q->id;?>" id="edit_ques<?= $i;?>" class="btn btn-warning">Edit</a></td>
												<td class="text-center"><input type="button" value="Delete" id="dlt_ques<?= $i;?>" class="btn btn-danger"/></td>
											</tr>
                                               <script>
												//alert("uppu");
                                                    $("#dlt_ques<?= $i;?>").click(function(){
														//ert("uppu");
                                                        var ques_id = $("#questt_id<?= $i;?>").val();
                                                      //alert(ques_id);
                                                        $.post("<?php echo site_url();?>examControllers/delete_q",{ques_id : ques_id},function(data){
															//alert(data);
                                                            if(data==1)
                                                            {
																
                                                                alert("Question deleted successfully");
                                                                location.reload();

                                                            }
                                                            else if(data==0)
                                                            {
                                                                alert("Question not deleted");
                                                            }
                                                           
                                                        });
                                                    });
                                                </script>
												<?php  $i++; }
											  } ?>
                                      </tbody>
                                    </table>
                            </div> 
				
				
			</div><!-- end: panel Body -->
		</div><!-- end: panel panel-white -->
		</div>

	</div><!-- end: MAIN PANEL COL-SM-12 -->
</div><!-- end: PAGE ROW-->
<script>
 //alert("hiidfddf");
$("#image_ques").hide();
$("#normal_ques").hide();
$("#radio_1").click(function(){
	alert("You Choose Objective Question..");
    if($("#radio_1").is(":checked"))
    {
        $("#normal_ques").show();
        $("#image_ques").hide();
    }
    else
    {
        $("#image_ques").hide();
        $("#normal_ques").hide();
    }
});
$("#radio_2").click(function(){
	
    if($("#radio_2").is(":checked"))
    {
		alert("You Choose Objective Images Question..");
        $("#image_ques").show();
        $("#normal_ques").hide();
    }
    else{
        //$("#image_ques").hide();
        $("#normal_ques").hide();
    }
});		
</script>

<script>
$("#submit_q").click(function(){

		var ques = $('#ques').val();
        var a = $('#a1').val();
        var b = $('#b1').val();
        var c = $('#c1').val();
        var d = $('#d1').val();
        var e = $('#e1').val();
		var sel = $('#sel_ct').val();
      
        var exam_master_id = $('#exam_master_id').val();
	//	alert(exam_master_id);
        
		//alert(exam_name_id);
        var exam_subject_id = $('#exam_subject_id').val();
		alert(exam_subject_id);
    if((ques.length>0) && (($('#a1').val()).length>0) && (($('#b1').val()).length>0) && (($('#c1').val()).length>0) && (($('#d1').val()).length>0))
    {
        if(sel == "" || sel == 0)
        {
        alert("Please select anwser");   
        }
        else
        {
            if(sel == 1)
            {
            var ans = 'A';
            } 
            else if(sel == 2)
            {
                var ans = 'B';
            } 
            else if(sel == 3)
            {
                var ans = 'C';
            } 
            else if(sel == 4)
            {
                var ans = 'D';
            } 
            else if(sel == 5)
            {
                var ans = 'E';
            } 
 

            $.post("<?php echo site_url();?>examControllers/insert_question", {
				//alert("uppu");
                ques : ques,a:a,b:b,c:c,d:d,e:e,ans:ans,
                exam_master_id :exam_master_id,
               
                exam_subject_id : exam_subject_id
                }, function(data){
               //alert(data);
                if(data==1)
                {
                    alert("Question Created Successfully.");
                    // $("#table3_div").load(location.href + "#table3_div");
                    // $("#table4_div").load(location.href + " #table4_div");
                    // $("#m_div").load(location.href + " #m_div");
                    location.reload();
                }
                else if(data==0)
                {
                    alert("Question Not Created");
                }
                else if(data==3)
                {
                    alert("Question Already exists");
                }
            
            });
        }
    }
    else
    {
        alert("Fill All Feilds Correct. ");
    }
   
});
  

</script>	
 <script>
 //alert("uppu");
    $("#uploadform").on('submit',(function(e){
		//alert("diksha");
    e.preventDefault();
    $.ajax({
		//alert("mayank");
    url: "<?= site_url();?>examControllers/new_ques",
    type: "POST",
    data:  new FormData(this),
    contentType: false,
    cache: false,
    processData:false,
    success: function(data){
        alert(data);
    // $("#targetLayer").html(data);
	
  // alert(data);
	
    location.reload();
    // if(console.log(data)=='1')
    //     {
           
    //     }
    },
    error: function(data){
//alert("khushbu");
       // alert(data);
    } 	        
    });
    }));
 
</script>         
	<script>
$("#qf1_id").change(function(){
            var ques1 = $("#ques1").val();
            var new1 = ques1+"<=1!>";
            $("#ques1").val(new1);
        });
        $("#qf2_id").change(function(){
            var ques2 = $("#ques1").val();
            var new2 = ques2+"<=2!>";
            $("#ques1").val(new2);
        });
        $("#qf3_id").change(function(){
            var ques3 = $("#ques1").val();
            var new3 = ques3+"<=3!>";
            $("#ques1").val(new3);
        });
        $("#qf4_id").change(function(){
            var ques4 = $("#ques1").val();
            var new4 = ques4+"<=4!>";
            $("#ques1").val(new4);
        });
        $("#af1_id").change(function(){
            var op1 = $("#txt_af1_id").val();
            var new_op1 = op1+"<=1!>";
            $("#txt_af1_id").val(new_op1);
        });
        $("#af2_id").change(function(){
            var op2 = $("#txt_af2_id").val();
            var new_op2 = op2+"<=2!>";
            $("#txt_af2_id").val(new_op2);
        });
        $("#af3_id").change(function(){
            var op3 = $("#txt_af3_id").val();
            var new_op3 = op3+"<=3!>";
            $("#txt_af3_id").val(new_op3);
        });
        $("#af4_id").change(function(){
            var op4 = $("#txt_af4_id").val();
            var new_op4 = op4+"<=4!>";
            $("#txt_af4_id").val(new_op4);
        });
        $("#af5_id").change(function(){
            var op5 = $("#txt_af5_id").val();
            var new_op5 = op5+"<=5!>";
            $("#txt_af5_id").val(new_op5);
        });
</script>			