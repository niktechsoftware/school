<!-- <script> -->


<!-- </script> -->  
 
<div class="main-content">
	<div class="section">
		<div class="section-body">
			<div class="row">
				<div class="col-xs-12 col-md-12 col-lg-12">
					<div class="card panel panel-white ">
							 <div class="panel-heading panel-pink">
				<h4 class="panel-title"><span class="text-bold">Update Question</span></h4>
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
</br>
</br>                       
					   <div class="card">
                            
                            <div class="card-body">       
                            <script>
alert("1");
                                            $("#nrml_dv").hide();
                                            $("#img_dv").hide();
                                            alert("3");
                                           </script>
                                             
                                <!-- //////////////////create test//////////////////////// -->
                                <?php if($q_dt->num_rows()>0)
                                {
                                    $q_dt2 = $q_dt->row();
                                    if($q_op->num_rows()>0)
                                    {
                                        $q_op2 = $q_op->row(); ?>
										<div id="img_question">
										<form method="post" id="editform" action="" enctype="multipart/form-data" >
                                       <div class="row">
									     
									     <input type="hidden" id="q_id" value="<?= $q_dt2->id;?>">
                                        <div class="col-md-3"><label style="float:right"><b>Question :</b></label></div>
                                        <div class="col-md-6">
                                            <textarea id="ques_dn" name="ques_dn" class="form-control" placeholder="Write Question here"></textarea>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input style="margin-top:15px;" type="file" id="qi1_id" name="qi1">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <input  style="margin-top:15px;" type="file" id="qi2_id" name="qi2">
                                                        </div>
                                                    </div>         
                                                </div>
                                                <div class="col-md-6">                                                
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input style="margin-top:15px;" type="file" id="qi3_id" name="qi3">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <input  style="margin-top:15px;" type="file" id="qi4_id" name="qi4">
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
													 A:<input type="text" id="txt_ai1_id" name="txt_ai1" class="form-control" required><input type="file" id="ai1_id" name="ai1" class=""><br>
													 B:<input type="text" id="txt_ai2_id" name="txt_ai2" class="form-control" required><input type="file" id="ai2_id" name="ai2" class="" ><br>
													 C:<input type="text" id="txt_ai3_id" name="txt_ai3" class="form-control" required><input type="file" id="ai3_id" name="ai3" class="" ><br>
												</div>
												<div class="col-md-4">                                                                                                         
													 D:<input type="text" id="txt_ai4_id" name="txt_ai4" class="form-control" required><input type="file" id="ai4_id" name="ai4" class=""><br>
													 E:<input type="text" id="txt_ai5_id" name="txt_ai5" class="form-control" ><input type="file" id="ai5_id" name="ai5" class="" ><br>
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
                                    <center><input type="submit" value="Update Question"  class="btn btn-success"/></center>   
                                    </div>
								 </br>
								 </br>
								 </br>
								 </br>
                                   <?php }
                                    else
                                    {
                                        echo "Data Not Available.";
                                    }
                                }
                                else
                                {
                                    echo "Data Not Available.";
                                }

                                ?>
                              
                                  </form>                                       
                                <!-- ///////// -->
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
 //alert("uppu");
    $("#editform").on('submit',(function(e){
		//alert("diksha");
    e.preventDefault();
    $.ajax({
		//alert("mayank");
    url: "<?= site_url();?>examControllers/update_imgques",
    type: "POST",
    data:  new FormData(this),
    contentType: false,
    cache: false,
    processData:false,
    success: function(data){
    // $("#targetLayer").html(data);
	//alert("simran");
   alert(data);
	alert("simran");
    location.reload();
    // if(console.log(data)=='1')
    //     {
           
    //     }
    },
    error: function(data){
//alert("khushbu");
        alert(data);
    } 	        
    });
    }));
 
</script>      
	<script>
$("#qi1_id").change(function(){
            var ques1 = $("#ques_dn").val();
            var new1 = ques1+"<=1!>";
            $("#ques_dn").val(new1);
        });
        $("#qi2_id").change(function(){
            var ques2 = $("#ques_dn").val();
            var new2 = ques2+"<=2!>";
            $("#ques_dn").val(new2);
        });
        $("#qi3_id").change(function(){
            var ques3 = $("#ques_dn").val();
            var new3 = ques3+"<=3!>";
            $("#ques_dn").val(new3);
        });
        $("#qi4_id").change(function(){
            var ques4 = $("#ques_dn").val();
            var new4 = ques4+"<=4!>";
            $("#ques_dn").val(new4);
        });
        $("#ai1_id").change(function(){
            var op1 = $("#txt_ai1_id").val();
            var new_op1 = op1+"<=5!>";
            $("#txt_ai1_id").val(new_op1);
        });
        $("#ai2_id").change(function(){
            var op2 = $("#txt_ai2_id").val();
            var new_op2 = op2+"<=6!>";
            $("#txt_ai2_id").val(new_op2);
        });
        $("#ai3_id").change(function(){
            var op3 = $("#txt_ai3_id").val();
            var new_op3 = op3+"<=7!>";
            $("#txt_ai3_id").val(new_op3);
        });
        $("#ai4_id").change(function(){
            var op4 = $("#txt_ai4_id").val();
            var new_op4 = op4+"<=8!>";
            $("#txt_ai4_id").val(new_op4);
        });
        $("#ai5_id").change(function(){
            var op5 = $("#txt_ai5_id").val();
            var new_op5 = op5+"<=9!>";
            $("#txt_ai5_id").val(new_op5);
        });
</script>			   