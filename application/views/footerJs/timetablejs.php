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

    //  $("#teachertimetablebutton").click(function(){
    //     var teacherid = $('#teachertime').val(); 
    //     //alert("Your section is successfully created");
    //     $.post("<?php //echo site_url('index.php/timetablepanel/findallteachertime') ?>", {teacherid : teacherid}, function(data){
    //             $("#teachertimetablelist").html(data);
    //             //alert("Enter only one character then created your new section");
    //     });
    //     $('#teachertime').val("");
    //     });
	
	$("#stdtimetablebutton").click(function(){
    		var studentid = $('#stdtimetable').val();	
    	
    		$.post("<?php echo site_url('index.php/timetablepanel/findstdtime') ?>", {studentid : studentid}, function(data){
                $("#timetablelist").html(data);
                
    		});
    		$('#stdtimetable').val("");
        });
	
	
	     $("#teachertimetable").keyup(function(){
    		var teacherid = $('#teachertimetable').val();	
    		//alert(teacherid);
    		$.post("<?php echo site_url('index.php/timetablepanel/findteachertime') ?>", {teacherid : teacherid}, function(data){
                $("#validId").html(data);
               
    		});
    		//$('#teachertimetable').val("");
        });
        
    jQuery(document).ready(function() {

        $("#clname").change(function(){
            var streamid = $("#clname").val();
            //alert(clname);
            $.post("<?php echo site_url('index.php/configureClassControllers/getSection') ?>", {streamid : streamid}, function(data){
                $("#sectionList").html(data);
                //alert(data);
    		});
        });

        $("#sectionList").change(function(){
            var sectionid = $("#sectionList").val();
            var streamid = $("#clname").val();
            //alert(clname);
            $.post("<?php echo site_url('index.php/configureClassControllers/getClasslist') ?>", {sectionid : sectionid, streamid : streamid}, function(data){
                $("#classlist").html(data);
                //alert(data);
    		});
        });

        $("#classlist").change(function(){
            //var streamid = $("#clname").val();
           // var sectionid= $("#sectionList").val();
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


           // alert(clname);
      //       $.post("<?php echo site_url('index.php/subjectController/getSubject') ?>", {classid : classid}, function(data){
      //           $("#subjectBox").html(data);
      //           //alert(data);
    		// });
        });

        
        Main.init();
        SVExamples.init();
        
    });
                                         

</script>