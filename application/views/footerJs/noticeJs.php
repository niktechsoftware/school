<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="assets/plugins/respond.min.js"></script>
		<script src="assets/plugins/excanvas.min.js"></script>
		<script type="text/javascript" src="assets/plugins/jQuery/jquery-1.11.1.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		
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
		<script src="<?php echo base_url(); ?>assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/autosize/jquery.autosize.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/jquery-maskmoney/jquery.maskMoney.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/js/commits.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/jQuery-Tags-Input/jquery.tagsinput.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/ckeditor/adapters/jquery.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/form-elements.js"></script>


		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CORE JAVASCRIPTS  -->
		<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
		<!-- end: CORE JAVASCRIPTS  -->
<script>
 $("#teachertimetablebutton").click(function(){
    		var teacherid = $('#teachertimetable').val();	
    		//alert(teacherid);
    		$.post("<?php echo site_url('index.php/homeworkpanel/findteacherhw') ?>", {teacherid : teacherid}, function(data){
                $("#teachertimetablelist").html(data);
               
    		});
    		$('#teachertimetable').val("");
        });
$("#stdtimetablebutton").click(function(){
    		var studentid = $('#stdtimetable').val();
    		$.post("<?php echo site_url('index.php/homeworkpanel/findstdhw') ?>", {studentid : studentid}, function(data){
                $("#timetablelist").html(data);
                
    		});
    		$('#stdtimetable').val("");
        });

$("#stdattendancebutton").click(function(){
    		var studentid = $('#stdtimetable').val();
    		var fsd=$('#fsd').val();
    		$.post("<?php echo site_url('index.php/attendancepanel/findstdattendance') ?>", {studentid : studentid , fsd:fsd}, function(data){
                $("#attendancelist").html(data);
                
    		});
    		$('#stdtimetable').val("");
        });

$("#teacherattendancebutton").click(function(){
		var fsd = $('#fsdval').val();
    		var teacherid = $('#teacherid').val();
    		$.post("<?php echo site_url('index.php/attendancepanel/findteacherattendance') ?>", {fsd:fsd,teacherid : teacherid}, function(data){
                $("#teacherattendancelist").html(data);
                
    		});
    		$('#teacherid').val("");
        });

		$(document).ready(function() {
    $('#cldetail').DataTable();
} );
jQuery(document).ready(function(){
	$('#studattendance').DataTable();
});

	jQuery(document).ready(function() {
	$("#textArea").keyup(function(){
			var totalc = $("#textArea").val();
			
			$.post("<?php echo site_url('index.php/msgNoticeControllers/countChar') ?>", {totalc : totalc},function(data){
		          $("#totalCharacter").html(data);
			});	
		});
		/*find sms unit js*/
		$("#textArea").keyup(function(){
			var totalc = $("#textArea").val();
			
			$.post("<?php echo site_url('index.php/msgNoticeControllers/countCharunit') ?>", {totalc : totalc},function(data){
		          $("#totalCharacter1").html(data);
			});	
		});
		
		$("#submit").click(function(){
			var message = $("#message").val();
			var subject = $("#subject").val();
			var reciever = $("#reciever").val();
			$.post("<?php echo site_url('index.php/msgNoticeControllers/sendMsg') ?>", {message : message,subject : subject,reciever : reciever},function(data){
		   $("#msg").html(data);
			});	
		});

		$("#admission").click(function(){
			var message = $("#admission").val();
			$.post("<?php echo site_url('index.php/smsAjax/smsSetting') ?>", {message : message},function(data){
		          $("#smsSetting").html(data);
			});
		});
		$("#fee_submit").click(function(){
			var message = $("#fee_submit").val();
			$.post("<?php echo site_url('index.php/smsAjax/smsSetting') ?>", {message : message},function(data){
		          $("#smsSetting").html(data);
			});	
		});
		$("#purchase").click(function(){
			var message = $("#purchase").val();
			$.post("<?php echo site_url('index.php/smsAjax/smsSetting') ?>", {message : message},function(data){
		          $("#smsSetting").html(data);
			});	
		});
		$("#stu_attendance").click(function(){
			var message = $("#stu_attendance").val();
			$.post("<?php echo site_url('index.php/smsAjax/smsSetting') ?>", {message : message},function(data){
		          $("#smsSetting").html(data);
			});	
		});
		$("#exam_report").click(function(){
			var message = $("#exam_report").val();
			$.post("<?php echo site_url('index.php/smsAjax/smsSetting') ?>", {message : message},function(data){
		          $("#smsSetting").html(data);
			});	
		});
		$("#parent_message").click(function(){
			var message = $("#parent_message").val();
			$.post("<?php echo site_url('index.php/smsAjax/smsSetting') ?>", {message : message},function(data){
		          $("#smsSetting").html(data);
			});	
		});
		$("#announcement").click(function(){
			var message = $("#announcement").val();
			$.post("<?php echo site_url('index.php/smsAjax/smsSetting') ?>", {message : message},function(data){
		          $("#smsSetting").html(data);
			});	
		});
		$("#greeting").click(function(){
			var message = $("#greeting").val();
			$.post("<?php echo site_url('index.php/smsAjax/smsSetting') ?>", {message : message},function(data){
		          $("#smsSetting").html(data);
			});	
		});
		$("#homework").click(function(){
			var message = $("#homework").val();
			$.post("<?php echo site_url('index.php/smsAjax/smsSetting') ?>", {message : message},function(data){
		          $("#smsSetting").html(data);
			});	
		});
		$("#class").change(function(){
			var classv = $("#class").val();
			alert(classv);
			$.post("<?php echo site_url("index.php/teacherController/getSection") ?>",{classv : classv}, function(data){
				$("#section").html(data);
			});
		});
		$("#clname").change(function(){
           var streamid = $("#clname").val();
           //alert(clname);
           $.post("<?php echo base_url();?>index.php/configureClassControllers/getSection.Niktech", {streamid : streamid}, function(data){
               $("#sectionList").html(data);
               //alert(data);
           });
       });
       $("#clnameatn").change(function(){
           var streamid = $("#clnameatn").val();
           //alert(clname);
           $.post("<?php echo base_url();?>index.php/configureClassControllers/getSection.Niktech", {streamid : streamid}, function(data){
               $("#sectionListatn").html(data);
               //alert(data);
           });
       });
       $("#classlist").change(function(){
           var classid = $("#classlist").val();
          // alert(classid);
           $.ajax({
                       "url": "<?php echo base_url();?>index.php/homeworkpanel/findclasstime",
                       "method": 'POST',
                       "data": {classid : classid},
                       beforeSend: function(data) {
                           $("#sample_rahul").html("<center><img src='<?php echo base_url();?>assets/images/loading.gif' /></center>")
                       },
                       success: function(data) {
                           $("#sample_rahul").html(data);
                       },
                       error: function(data) {
                           $("#sample_rahul").html(data)
                       }
                   })
       });
        $("#classlistatn").change(function(){
           var classid = $("#classlistatn").val();
            var fsd = $("#fsd").val();
           
          // alert(classid);
           $.ajax({
                       "url": "<?php echo base_url();?>index.php/attendancepanel/findclasstime",
                       "method": 'POST',
                       "data": {classid : classid, fsd:fsd},
                       beforeSend: function(data) {
                           $("#sample_rahul").html("<center><img src='<?php echo base_url();?>assets/images/loading.gif' /></center>")
                       },
                       success: function(data) {
                           $("#sample_rahul").html(data);
                       },
                       error: function(data) {
                           $("#sample_rahul").html(data)
                       }
                   })
       });
       $("#sectionList").change(function(){
           var sectionid = $("#sectionList").val();
           var streamid = $("#clname").val();
           //alert(clname);
           $.post("<?php echo base_url();?>index.php/configureClassControllers/getClasslist.Niktech", {sectionid : sectionid, streamid : streamid}, function(data){
               $("#classlist").html(data);
           });
       });
       $("#sectionListatn").change(function(){
           var sectionid = $("#sectionListatn").val();
           var streamid = $("#clnameatn").val();
           $.post("<?php echo base_url();?>index.php/configureClassControllers/getClasslist.Niktech", {sectionid : sectionid, streamid : streamid}, function(data){
               $("#classlistatn").html(data);
           });
       });

	   $("#fsd").change(function(){
					if($("#fsd").val() == '') {
						$("#classv").attr("disabled", "disabled");
					}
					else {
						$('#classv').removeAttr("disabled");
					}
				})
			
				$("#classv").change(function(){
					var sectionid = $("#classv").val();
					//alert(teacherid);
					if(classv == 'all'){
						$('#sectionId').prop('disabled', 'disabled');
						var fsd = $("#fsd").val();
						var section = "all";
						var classv = "all";
						$.ajax({
							"url": "<?= site_url("index.php/feeControllers/feeReport") ?>",
							"method": 'POST',
							"data": {fsd : fsd,section : section,classv : classv},
							beforeSend: function(data) {
								$("#rahul").html("<img src='<?= base_url()?>assets/images/loading.gif' />")
							},
							success: function(data) {
								$("#rahul").html(data);
							},
							error: function(data) {
								$("#rahul").html(data)
							}
						})
						
						
					}else{
						$('#sectionId').prop('disabled', false);
						$.post("<?php echo site_url("index.php/teacherController/getClassbySectionfeeReport") ?>",{sectionid : sectionid}, function(data){
							$("#sectionId").html(data);
						});
					}
				});
				$("#sectionId").change(function(){
					var fsd = $("#fsd").val();
					var classid = $("#sectionId").val();
					//var sectionid = $("#classv").val();
					//alert(classid);
					$.ajax({
						"url": "<?= base_url() ?>index.php/feeControllers/feeReport",
						"method": 'POST',
						"data": {fsd : fsd,classid : classid,},
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
				

				$("#classv").change(function(){
					var sectionid = $("#classv").val();
					//alert(teacherid);
					if(classv == 'all'){
						$('#sectionId').prop('disabled', 'disabled');
						var fsd = $("#fsd").val();
						var section = "all";
						var classv = "all";
						$.ajax({
							"url": "<?= site_url("index.php/feepanel/feeReport") ?>",
							"method": 'POST',
							"data": {fsd : fsd,section : section,classv : classv},
							beforeSend: function(data) {
								$("#rahul1").html("<img src='<?= base_url()?>assets/images/loading.gif' />")
							},
							success: function(data) {
								$("#rahul1").html(data);
							},
							error: function(data) {
								$("#rahul1").html(data)
							}
						})
						
						
					}else{
						$('#sectionId').prop('disabled', false);
						$.post("<?php echo site_url("index.php/teacherController/getClassbySectionfeeReport") ?>",{sectionid : sectionid}, function(data){
							$("#sectionId").html(data);
						});
					}
				});
				$("#sectionId").change(function(){
					var fsd = $("#fsd").val();
					var classid = $("#sectionId").val();
					//var sectionid = $("#classv").val();
					//alert(classid);
					$.ajax({
						"url": "<?= base_url() ?>index.php/feepanel/feeReport",
						"method": 'POST',
						"data": {fsd : fsd,classid : classid,},
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
				
				
					$("#classv").change(function(){
					var sectionid = $("#classv").val();
					//alert(teacherid);
					if(classv == 'all'){
						$('#sectionId').prop('disabled', 'disabled');
						var fsd = $("#fsd").val();
						var section = "all";
						var classv = "all";
						$.ajax({
							"url": "<?= site_url("index.php/feepanel/topfeeReport") ?>",
							"method": 'POST',
							"data": {fsd : fsd,section : section,classv : classv},
							beforeSend: function(data) {
								$("#rahul11").html("<img src='<?= base_url()?>assets/images/loading.gif' />")
							},
							success: function(data) {
								$("#rahul11").html(data);
							},
							error: function(data) {
								$("#rahul11").html(data)
							}
						})
						
						
					}else{
						$('#sectionId').prop('disabled', false);
						$.post("<?php echo site_url("index.php/teacherController/getClassbySectionfeeReport") ?>",{sectionid : sectionid}, function(data){
							$("#sectionId").html(data);
						});
					}
				});
				$("#sectionId").change(function(){
					var fsd = $("#fsd").val();
					var classid = $("#sectionId").val();
					//var sectionid = $("#classv").val();
					//alert(classid);
					$.ajax({
						"url": "<?= base_url() ?>index.php/feepanel/topfeeReport",
						"method": 'POST',
						"data": {fsd : fsd,classid : classid,},
						beforeSend: function(data) {
							$("#rahul11").html("<center><img src='<?= base_url()?>assets/images/loading.gif' /></center>")
						},
						success: function(data) {
							$("#rahul11").html(data);
						},
						error: function(data) {
							$("#rahul11").html(data)
						}
					})
					
				});
				
          /*  $("#classlisthw").change(function(){
                         var classid = $("#classlist").val();
                        $.ajax({
                                    "url": "<?= base_url() ?>index.php/timetablepanel/findclasstime",
                                    "method": 'POST',
                                    "data": {classid : classid},
                                    beforeSend: function(data) {
                                        $("#sample_rahul").html("<center><img src='<?= base_url()?>assets/images/loading.gif' /></center>")
                                    },
                                    success: function(data) {
                                        $("#sample_rahul").html(data);
                                    },
                                    error: function(data) {
                                        $("#sample_rahul").html(data)
                                    }
                                })
            
                    });*/
					$("#b1").hide();
					$("#classv111").change(function(){
					var streamid = $("#classv111").val();
					
					$.post("<?php echo site_url("index.php/teacherController/getSectionforexam") ?>",{streamid : streamid}, function(data){
						$("#sectionId111").html(data);
						});
					
					});
				$("#sectionId111").change(function(){
					var streamid = $("#classv111").val();
					
					var sectionid = $("#sectionId111").val();
					//alert(sectionid +"-"+streamid);
					$.post("<?php echo site_url("index.php/teacherController/getclassforexam") ?>",{streamid : streamid,sectionid : sectionid}, function(data){
						$("#classId111").html(data);
						});
						
					});
				$("#classId111").change(function(){
					$("#b1").show();
					
					});

					$('#empattendance').change(function(){
						var emp= $('#empattendance').val();
						$.post("<?php echo site_url("index.php/attendancepanel/categorywise") ?>",{emp : emp}, function(data){
						$("#empatt1").html(data);
						});
					});
		Main.init();
		SVExamples.init();
		FormElements.init();
	});
</script>