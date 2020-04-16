<!--[if lt IE 9]>
			<script src="<?php echo base_url(); ?>assets/plugins/respond.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/excanvas.min.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-1.11.1.min.js"></script>
			<![endif]-->
			<!--[if gte IE 9]><!-->
			
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
		<!-- end: CORE JAVASCRIPTS  -->
		<script>
		$(document).ready(function() {
        $('#sample-table-12').DataTable();
        } );

			$(document).ready(function() {
    $('#a_tb').DataTable();
     } );
					$(document).ready(function() {
    $('#f_tb').DataTable();
     } );
			
    $(document).ready(function() {
    $('#sample-table-daybook').DataTable();
     } );

			jQuery(document).ready(function() {
			    
			    $("#sonu").hide();
				$("#studid").keyup(function(){
					var studentid = $("#studid").val();
					//alert(studentid);
					$.post("<?php echo site_url("index.php/feeControllers/getFsd") ?>",{studentid : studentid}, function(data){
						$("#getFsd").html(data);
						});
					});
			    
			     $("#form2").submit(function(){
			         //alert("ok");
			             $("#form2").attr("action","<?php echo base_url("feeControllers/payFee");?>");
			         return true;
			     });

				$("#fsd").change(function(){
					if($("#fsd").val() == '') {
						$("#classv").attr("disabled", "disabled");
					}
					else {
						$('#classv').removeAttr("disabled");
					}
				})
				
				$("#fsd1").change(function(){
					if($("#fsd1").val() == '') {
						$("#classv1").attr("disabled", "disabled");
					}
					else {
						$('#classv1').removeAttr("disabled");
					}
				})
				
			
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
					
					
				$("#classv").change(function(){
					var streamid = $("#classv").val();
					//alert(streamid);
					$.post("<?php echo site_url("index.php/teacherController/getSectionforexam") ?>",{streamid : streamid}, function(data){
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
				

			

				$("#subjectId").change(function(){
					var classid = $("#classId").val();
					var teacherid = $("#teacherid").val();
					var examid = $("#exam_name").val();
					var sectionid = $("#sectionId").val();
					//var mm = $("#mm").val();
					var subjectid = $("#subjectId").val();
				// alert(classid);
					$.post("<?php echo site_url("index.php/examControllers/enterMarks") ?>",{teacherid : teacherid,examid : examid,classid : classid,sectionid : sectionid,subjectid : subjectid}, function(data){
						$("#enterMarks").html(data);
						});
					
					});
			
				
			$("#classv").change(function(){
					var sectionid = $("#classv").val();
						var fsd = $("#fsd").val();
					//alert(sectionid);
					if(sectionid == 'all'){
						$('#sectionId').prop('disabled', 'disabled');
						var fsd = $("#fsd").val();
						var section = "all";
						var classv = "all";
						// alert(fsd);
						 //alert(section);
						 //alert(classv);
						$.ajax({
							"url": "<?= site_url("index.php/feeControllers/feeReport") ?>",
							"method": 'POST',
							"data": {fsd : fsd,section : section,classv : classv},
							beforeSend: function(data) {
								$("#rahul").html("<center><img src='<?= base_url()?>assets/images/loading.gif' /></center>")
							},
							success: function(data) {
								$("#rahul").html(data);
							},
							error: function(data) {
								$("#rahul").html(data)
							}
						})
					}else{//alert ('hii');
						$('#sectionId').prop('disabled', false);
						$.post("<?php echo site_url("index.php/teacherController/getClassbySectionfeeReport") ?>",{sectionid : sectionid}, function(data){
							$("#sectionId").html(data);
						});
					}
				});
				
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
					

			$("#sectionId").change(function(){
					var fsd = $("#fsd").val();
					var classv = $("#sectionId").val();
					var section = $("#classv").val();
					//alert(classv);
					$.ajax({
						"url": "<?= base_url() ?>index.php/feeControllers/feeReport",
						"method": 'POST',
						"data": {fsd : fsd,section : section,classv : classv},
						beforeSend: function(data) {
							$("#rahul").html("<center><img src='<?= base_url()?>assets/images/loading.gif' /></center>")
						},
						success: function(data) {
							$("#rahul").html(data);
						},
						error: function(data) {
							$("#rahul").html(data)
						}
					})
					
				});
	$('#fmonth').change(function(){
	    
					var fsd = $("#fsd").val();
					var classv = $("#sectionId1").val();
					var section = $("#classv").val();
					var month = $("#fmonth").val();
		
					$.ajax({
						"url": "<?= base_url() ?>index.php/feeControllers/current_monthreport",
						"method": 'POST',
						"data": {fsd : fsd,section : section,classv : classv,month : month},
						beforeSend: function(data) {
							$("#rahul").html("<center><img src='<?= base_url()?>assets/images/loading.gif' /></center>")
						},
						success: function(data) {
							$("#rahul").html(data);
						},
						error: function(data) {
							$("#rahul").html(data)
						}
					})
				
					
				});

				
				$("#fsd1").change(function(){
					if($("#fsd1").val() == '') {
						$("#classv1").attr("disabled", "disabled");
					}
					else {
						$('#classv1').removeAttr("disabled");
					}
				})
				
				
			$("#classv1").change(function(){
					var sectionid = $("#classv1").val();
					//alert(sectionid);
						$('#sectionId1').prop('disabled', false);
						$.post("<?php echo site_url("index.php/teacherController/getClassbySectionfeeReport") ?>",{sectionid : sectionid}, function(data){
							$("#sectionId1").html(data);
						});
					
				});
				

			$("#sectionId1").change(function(){
					var fsd = $("#fsd1").val();
					var classv = $("#sectionId1").val();
					var section = $("#classv1").val();
					//alert(classid);
					$.ajax({
						"url": "<?= base_url() ?>index.php/promotionControler/promotionReport",
						"method": 'POST',
						"data": {fsd : fsd,section : section,classv : classv},
						beforeSend: function(data) {
							$("#rahul1").html("<center><img src='<?= base_url()?>assets/images/loading.gif' /></center>")
						},
						success: function(data) {
							$("#rahul1").html(data);
						},
						error: function(data) {
							$("#rahul1").html(data)
						}
					})
					
				});

				
				
				Main.init();
				SVExamples.init();
				FormElements.init();
			});

			function depositorname() {
                    var text_value = document.getElementById("ac").value;
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
                    document.getElementById("ac").value=value;
                }

			function amount() {
				var text_value = document.getElementById("discountv").value;
				value = text_value.replace(/[^(0-9-.)]*/g, "");
				document.getElementById("discountv").value=value;
			}

			function OTP() {
				var text_value = document.getElementById("discounterOTPv").value;
				value = text_value.replace(/[^(0-9-.)]*/g, "");
				document.getElementById("discounterOTPv").value=value;
			}

			function fee() {
				var text_value = document.getElementById("latefee2").value;
				value = text_value.replace(/[^(0-9-.)]*/g, "");
				document.getElementById("latefee2").value=value;
			}
	       function trans() {
				var text_value = document.getElementById("dtransport_fee1").value;
				value = text_value.replace(/[^(0-9-.)]*/g, "");
				document.getElementById("dtransport_fee1").value=value;
			}

			function stuBirthPlace() {
                    var text_value = document.getElementById("studid").value;
                    // if (!text_value.match(/^[A-Za-z]+$/)) {
                    //     document.getElementById("bplace").innerHTML = "Alphabates Only without space";
                    //     document.getElementById("birthPlace").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("bplace").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("bplace").innerHTML = " ";
                    //         document.getElementById("birthPlace").focus();
                    // }
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z0-9 )]*/g, "");
                    document.getElementById("studid").value=value;

                };

								TableExport.init();

		</script>