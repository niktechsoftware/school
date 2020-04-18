            <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.1.1.min.js"></script>
			<!--<![endif]-->
			<script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/blockUI/jquery.blockUI.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/iCheck/jquery.icheck.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/moment/min/moment.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/bootbox/bootbox.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/jquery.scrollTo/jquery.scrollTo.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/jquery.appear/jquery.appear.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/velocity/jquery.velocity.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/TouchSwipe/jquery.touchSwipe.min.js"></script>
			<!-- end: MAIN JAVASCRIPTS -->
			<!-- start: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
			<script src="<?php echo base_url(); ?>assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/jquery-mockjax/jquery.mockjax.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/truncate/jquery.truncate.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/summernote/dist/summernote.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
			<script src="<?php echo base_url(); ?>assets/js/subview.js"></script>
			<script src="<?php echo base_url(); ?>assets/js/subview-examples.js"></script>
			<!-- end: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
			<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
			<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
			<script src="<?php echo base_url(); ?>assets/js/ui-modals.js"></script>
			
			<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/select2/select2.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/tableExport/tableExport.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jquery.base64.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/tableExport/html2canvas.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jquery.base64.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jspdf/libs/sprintf.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jspdf/jspdf.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jspdf/libs/base64.js"></script>
			<script src="<?php echo base_url(); ?>assets/js/table-export.js"></script>
			<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
			<!-- start: CORE JAVASCRIPTS  -->
			<script src="<?php echo base_url(); ?>assets/js/main.js"></script>

		<script>
		
		 $(document).ready(function() {
    $('#table12').DataTable();
     $('#sample-table-2').DataTable();
} );


			jQuery(document).ready(function() {
				
				$('#examName').change(function(){
					var examName = $('#examName').val();
					//alert("rahul");
				$.post("<?php echo site_url('index.php/examControllers/printDate') ?>",{examName : examName},function(data){
					$('#printDate').val(data);
				});

				});
				$('#examName1').change(function(){
					var examName = $('#examName1').val();
					//alert("rahul");
				$.post("<?php echo site_url('index.php/examControllers/printDate') ?>",{examName : examName},function(data){
					$('#printDate1').val(data);
				});
				});
				$('#nos').change(function(){
					var nos = $('#nos').val();
					
					//alert("rahul");
					$.post("<?php echo site_url('index.php/examControllers/defineExam') ?>",{nos : nos},function(data){
						$('#exam1').html(data);	
					});
				});
				$('#nod').change(function(){
					var nod = $('#nod').val();
				
					//alert("rahul");
					$.post("<?php echo site_url('index.php/examControllers/defineExam1') ?>",{nod : nod},function(data){
						$('#exam12').html(data);	
					});
				});
				
				$('#update').click(function(){
					alert("rahul");
				});
				$('#delete').click(function(){
					alert("rahul");
				});

				
				
				
				
				
				$("#teacherid").keyup(function(){
					var teacherid = $("#teacherid").val();
					//alert(teacherid);
					$.post("<?php echo site_url("index.php/teacherController/checkID") ?>",{teacherid : teacherid}, function(data){
						$("#validId").html(data);
						});
					});
				
			$("#classv").change(function(){
					var streamid = $("#classv").val();
					
					$.post("<?php echo site_url("index.php/teacherController/getSectionfrexam") ?>",{streamid : streamid}, function(data){
						$("#sectionId").html(data);
						});
					
					});
				$("#sectionId").change(function(){
					var streamid = $("#classv").val();
					
					var sectionid = $("#sectionId").val();
					//alert(sectionid +"-"+streamid);
					$.post("<?php echo site_url("index.php/teacherController/getclassforexam") ?>",{streamid : streamid,sectionid : sectionid}, function(data){
						$("#classId").html(data);
						});
					
					});
				$("#classId").change(function(){
					//var streamid = $("#classv").val();
					//var sectionid = $("#sectionId").val();
					var classid = $("#classId").val();
					
					$.post("<?php echo site_url("index.php/teacherController/getSubjecforexam") ?>",{classid:classid}, 
						function(data){
						$("#subjectId").html(data);
							$("#subjectIdresult").html(data);
								$("#subjectIdmarks").html(data);
						});
					
					});
				

					<?php
    $school_code = $this->session->userdata("school_code");
    $row2=$this->db->get('db_name')->row()->name;


if($school_code == 9 && $row2 == "A" || $school_code == 6 && $row2 == "A" || $school_code == 1 && $row2 == "D" || $school_code == 2 && $row2 == "D" || $school_code == 3 && $row2 == "D" || $school_code == 4 && $row2 == "D" || $school_code == 10 && $row2 == "D" || $school_code == 9 && $row2 == "D" || $school_code == 8 && $row2 == "D"){ ?>			


			
			$("#subjectIdmarks").change(function(){
					var classid = $("#classId").val();
					//var select = $("#select").val();
					var examid = $("#exam_name").val();
					var sectionid = $("#sectionId").val();
					//var mm = $("#mm").val();
					var subjectid = $("#subjectIdmarks").val();
					 $.ajax({
						"url": "<?= base_url() ?>index.php/examControllers/maxmumsubMarks",
						"method": 'POST',
						"data": {examid : examid,classid : classid,sectionid : sectionid,subjectid : subjectid},
						beforeSend: function(data) {
							$("#showMarks").html("<center><img src='<?= base_url()?>assets/images/loading.gif' /></center>")
						},
						success: function(data) {
							$("#showMarks").html(data);
						},
						error: function(data) {
							$("#showMarks").html(data)
						}
					})
					
					});
				<?php } else{ ?>
					
			$("#subjecttypem").change(function(){
					var classid = $("#classId").val();
					//var select = $("#select").val();
					var examid = $("#exam_name").val();
					var sectionid = $("#sectionId").val();
					var subtypeid = $("#subjecttypem").val();
					
					var subjectid = $("#subjectIdmarks").val();
					 $.ajax({
						"url": "<?= base_url() ?>index.php/examControllers/maxmumsubMarks",
						"method": 'POST',
						"data": {examid : examid,classid : classid,sectionid : sectionid,subjectid : subjectid,subtypeid : subtypeid },
						beforeSend: function(data) {
							$("#showMarks").html("<center><img src='<?= base_url()?>assets/images/loading.gif' /></center>")
						},
						success: function(data) {
							$("#showMarks").html(data);
						},
						error: function(data) {
							$("#showMarks").html(data)
						}
					})
					
					});
					
				<?php } ?>
								
				$("#subjectIdresult").change(function(){
				   var classid = $("#classId").val();
					var examid = $("#exam_name").val();
				   var sectionid = $("#sectionId").val();
					var subjectid = $("#subjectIdresult").val();
					$.post("<?php echo site_url("index.php/examControllers/resultMarks") ?>",{examid : examid,classid : classid,sectionid : sectionid,subjectid : subjectid}, function(data){
						$("#result123").html(data);
					});
				});
				
				//------------------------------------------------------------- Edit Exam Detail JS---------------------------------------------------

				$("#classv1").change(function(){
					var classv = $("#classv1").val();
					
					$.post("<?php echo site_url("index.php/teacherController/getSection") ?>",{classv : classv}, function(data){
						$("#sectionId1").html(data);
						});
					
					});
				$("#sectionId1").change(function(){
					var classv = $("#classv1").val();
					var section = $("#sectionId1").val();
					
					$.post("<?php echo site_url("index.php/teacherController/getSubject") ?>",{classv : classv,section : section}, function(data){
						$("#subjectId1").html(data);
						});
					
					});

				$("#subjectId1").change(function(){
					var classv = $("#classv1").val();
					var teacherid = $("#teacherid1").val();
					var exam_name = $("#exam_name1").val();
					var section = $("#sectionId1").val();
					var subject = $("#subjectId").val();
					$.post("<?php echo site_url("index.php/examControllers/enterMarks") ?>",{teacherid : teacherid,exam_name : exam_name,classv : classv,section : section,subject : subject}, function(data){
						$("#enterMarks").html(data);
						});
					
					});
				var select = document.getElementById('examName1');
                     var input1 = document.getElementById('upexam');
                       select.onchange = function() {
                         input1.value = select.value;
                       }						



                        var input = document.getElementById("examName");
                         input.addEventListener("keyup", function () {
                         });

                         input.addEventListener("keyup", function () {
                          var x = document.getElementById("examName");
                             x.value = x.value.toUpperCase();
                         
                  });
				
                           
	});
<?php

    $school_code = $this->session->userdata("school_code");
    $row2=$this->db->get('db_name')->row()->name;


if($school_code == 9 && $row2 == "A" || $school_code == 6 && $row2 == "A" || $school_code == 1 && $row2 == "D" || $school_code == 2 && $row2 == "D" || $school_code == 3 && $row2 == "D" || $school_code == 4 && $row2 == "D" || $school_code == 10 && $row2 == "D"  || $school_code == 8 && $row2 == "D"|| $school_code == 9 && $row2 == "D" ){ ?>


				$("#subjectId").change(function(){
					var classid = $("#classId").val();
					var teacherid = $("#teacherid").val();
					var examid = $("#exam_name").val();
					var sectionid = $("#sectionId").val();
					var subjectid = $("#subjectId").val();
				
					$.post("<?php echo site_url("index.php/examControllers/enterMarks") ?>",{teacherid : teacherid,examid : examid,classid : classid,sectionid : sectionid,subjectid : subjectid}, function(data){
			
						$("#enterMarks").html(data);
						});
					
					});

<?php }else{ ?>

$("#sub_type").change(function(){
					var classid = $("#classId").val();
					var teacherid = $("#teacherid").val();
					var examid = $("#exam_name").val();
					var sectionid = $("#sectionId").val();
					var sub_type = $("#sub_type").val();
					var subjectid = $("#subjectId").val();
				//	alert(sub_type);
					$.post("<?php echo site_url("index.php/examControllers/enterMarks") ?>",{sub_type : sub_type,teacherid : teacherid,examid : examid,classid : classid,sectionid : sectionid,subjectid : subjectid}, function(data){
			
						$("#enterMarks").html(data);
						});
					
					});

<?php } ?>
	Main.init();
				FormElements.init();
				
				SVExamples.init();
				TableExport.init();
		</script>
