<?php
class SubjectController extends CI_Controller{
    
    	public function __construct(){
		parent::__construct();
			$this->is_login();
	
	}
	
	
		function is_login(){
		$is_login = $this->session->userdata('is_login');
	
		if(($is_login != true)){
			
			redirect("index.php/homeController/index");
		}
	
	}
	function getSubject(){
		$classid = $this->input->post("classid");
		//$stream = $this->input->post("stream");
		//$section = $this->input->post("section");
		$this->load->model("subjectModel");
		$result = $this->subjectModel->getSubject($classid);
		?>
			<div class="col-sm-12">
				<!-- start: INLINE TABS PANEL -->
				<div class="panel panel-white">
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="tab-pane fade in active" id="myTab_example1">
									<div class="row">
										<div class="col-sm-6">
											<div class="panel panel-calendar">
												<div class="panel-heading panel-grey border-light">
													<h4 class="panel-title">Subject Name</h4>
												</div>
												<div class="panel-body">
													<div class="text-white text-large">
														<span id=name style="color:red;"></span>
														<input type="text" id="addSubject" minlength="3" maxlength="30" onkeyup="myfunction()" onkeyup="myfunction1()" onkeypress="return isNumberKey(event)" >
														<a href="#" class="btn btn-sm btn-light-green" id="addSSubjectButton"><i class="fa fa-check"></i> Add Subject</a>
													</div>
													<div class="text-blue text-small" style="padding-top:5px;">
													Please type Subject name make <strong>sure after admission, Subject name can not be 
													Edited in any case </strong> if you change 
													then the exam section, student section and time scheduling may be affected. Press add 
													subject button after added it will show you right side panel.		
												</div>
											</div>
										</div>
										</div>
										<script>
											 $("#addSSubjectButton").click(function(){
										            var classid = $("#classlist").val();
										           // var stream = $("#streamList").val();
										          //  var section = $("#section").val();
										            var subject = $("#addSubject").val();
										            //alert(clname+","+stream+","+section+","+subject);
													if(subject!=""){
										            $.post("<?php echo site_url('index.php/subjectController/addSubject') ?>", {classid : classid,subject : subject}, function(data){
										                $("#subjectBox").html(data);
										                //alert(data);
										    		});
											 }else{
												 alert("Please fill a valid Subject name");
											 }
										        });
                                           var input = document.getElementById("addSubject");
                                              input.addEventListener("keyup", function () {
                            //                 var text_value = document.getElementById("addSubject").value;
                            //               if (!text_value.match(/^[A-Za-z]+$/)) {
                            //                 document.getElementById("name").innerHTML = "Only Character Allow";
                            //               $('#addSSubjectButton').attr('disabled', 'disabled');

                            //               $(document).on('click', 'a', function(e) {
                            //               if ($(this).attr('disabled') == 'disabled') {
                            //                  e.preventDefault();
                            //                     }
                            //                   // window.location.reload();
                            //                 });   
                            //             document.getElementById("addSubject").focus();
                            //             if (text_value == "") {
                            //                 document.getElementById("name").innerHTML = " ";
                            //                 document.getElementById("addSubject").focus();
                            //                 window.location.reload();
                            //             }
                            //         }
                             });
                           input.addEventListener("keyup", function () {
                          var x = document.getElementById("addSubject");
                             x.value = x.value.toUpperCase();
                         
                  });
                           function isNumberKey(evt)
                {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return true;

         return false;
        }
											
										</script>
										<div class="col-sm-6">
											<div class="panel panel-calendar">
												<div class="panel-heading panel-dark border-light">
													<h4 class="panel-title">Subject List</h4>
												</div>
												<div class="panel-body" id="subjectList">
													<span id="name2" style="color:red;"></span>
													<?php 
													if(isset($result)){
														$i = 1;
														foreach ($result->result() as $row){
															echo '<div class="text-white text-sm pull-left space10">';
															echo '<input type="text" id="subjectValue'.$i.'" onkeyup="myfunction()" onkeyup="myfunction1()"   onkeypress="return isNumberKey(event)" size="20" value="'.$row->subject.'">';
															echo '<input type="hidden" id="subjectId'.$i.'" size="20" value="'.$row->id.'">';
															echo ' <a href="#" class="btn btn-sm btn-dark-green" id="edit'.$i.'"><i class="fa fa-edit"></i> Edit</a>';
															echo ' <a href="#" class="btn btn-sm btn-dark-red" id="delete'.$i.'"><i class="fa fa-trash-o"></i> Delete</a>';
															echo '</div>';
															$i++;
														}
														?>
														<script>
															    <?php for($j = 1; $j < $i; $j++){ ?>
															    
															    $("#edit<?php echo $j; ?>").click(function(){
															    	var classid = $("#classlist").val();
														          //  var stream = $("#streamList").val();
														          //  var section = $("#section").val();
														            var subject = $("#addSubject").val();
														            
														    		var subjectId = $('#subjectId<?php echo $j; ?>').val();	
														    		var subjectName = $('#subjectValue<?php echo $j; ?>').val();
														    		//alert(streamName);
														    		$.post("<?php echo site_url('index.php/subjectController/updateSubject') ?>", {subjectId : subjectId, subjectName : subjectName, classid : classid, subject : subject}, function(data){
														                $("#subjectBox").html(data);
														                //alert(data);
														    		})
														        });
										
															    $("#delete<?php echo $j; ?>").click(function(){
															    	var classid = $("#classlist").val();
														            //var stream = $("#streamList").val();
														            //var section = $("#section").val();
														            var subject = $("#addSubject").val();
														            
														    		var subjectId = $('#subjectId<?php echo $j; ?>').val();	
														    		//alert(streamName);
														    		$.post("<?php echo site_url('index.php/subjectController/deleteSubject') ?>", {subjectId : subjectId, classid : classid,subject : subject}, function(data){
														                $("#subjectBox").html(data);
														                //alert(data);
														    		})
														        });
														        
															


											 var input = document.getElementById("subjectValue<?php echo $j; ?>");
                                            input.addEventListener("keyup", function () {
                            //                 var text_value = document.getElementById("subjectValue<?php echo $j; ?>").value;
                            //               if (!text_value.match(/^[A-Za-z]+$/)) {
                            //                 document.getElementById("name2").innerHTML = "Only Character Allow";
                            //               $('#edit<?php echo $j; ?>').attr('disabled', 'disabled');

                            //               $(document).on('click', 'a', function(e) {
                            //               if ($(this).attr('disabled') == 'disabled') {
                            //                  e.preventDefault();
                            //                     }
                            //                   // window.location.reload();
                            //                 });   
                            //             document.getElementById("subjectValue<?php echo $j; ?>").focus();
                            //               if (text_value == "") {
                            //                 document.getElementById("name2").innerHTML = " ";
                            //                 document.getElementById("subjectValue<?php echo $j; ?>").focus();
                            //                 window.location.reload();
                            //             }
                            //         }
                             });
                           input.addEventListener("keyup", function () {
                          var x = document.getElementById("subjectValue<?php echo $j; ?>");
                             x.value = x.value.toUpperCase();
                         
                  });
                             function isNumberKey(evt)
                {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return true;

         return false;
        }
                               <?php } ?> 
														</script>
													<?php
													}
													?>
												</div>
											</div>
										</div>
									</div>
								</div>														
							</div>
						</div>
					</div>
				</div>
				<!-- end: INLINE TABS PANEL -->
			</div>
		<?php 
	}
	
	function addSubject(){
		$classid = $this->input->post("classid");
		//$stream = $this->input->post("stream");
		//$section = $this->input->post("section");
		$subject = $this->input->post("subject");
		
		$data = array(
				"class_id" => $classid,
				//"stream" => $stream,
				//"section" => $section,
				"subject" => $subject,
				//"school_code"=>$this->session->userdata("school_code")
		);
		
		$this->load->model("subjectModel");
		$result = $this->subjectModel->addSubject($data);
		$this->getSubject();
	}
	
	function updateSubject(){
		$classid = $this->input->post("classid");
		//$stream = $this->input->post("stream");
		//$section = $this->input->post("section");
		$subject = $this->input->post("subject");
		
			$subjectId = $this->input->post("subjectId");
			$subjectName = $this->input->post("subjectName");
		
			$data = array(
					"subject" => $subjectName,
					//"school_code"=>$this->session->userdata("school_code")
			);
		
			$this->load->model("subjectModel");
			$result = $this->subjectModel->updateSubject($data,$subjectId);
			$this->getSubject();
	}
	
	function deleteSubject(){
		$classid = $this->input->post("classid");
		//$stream = $this->input->post("stream");
		//$section = $this->input->post("section");
		$subject = $this->input->post("subject");
		
		$subjectId = $this->input->post("subjectId");
		$scode=$this->session->userdata("school_code");

		$this->db->where('school_code',$scode);
		$sub=$this->db->get('exam_info')->result();
		foreach($sub as $data)
		{

			$subject=$data->subject_id;
			if($subject==$subjectId)
			{
					 echo "<script>alert('you can not delete this subject because this subject is already used in Exam Section');</script>";
                return false;
				
			}
		}

		$subjectId = $this->input->post("subjectId");
		$scode=$this->session->userdata("school_code");

		$this->db->where('school_code',$scode);
		$timetable=$this->db->get('time_table')->result();
		foreach($timetable as $data)
		{

			$time=$data->subject_id;
			if($time==$subjectId)
			{
					 echo "<script>alert('you can not delete this subject because this subject is already used in Timetable Section');</script>";
                return false;
				
			}
		}



	
		$this->load->model("subjectModel");
		$result = $this->subjectModel->deleteSubject($subjectId);
		$this->getSubject();
	}
}
?>
