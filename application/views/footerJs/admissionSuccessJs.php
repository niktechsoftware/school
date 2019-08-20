<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="assets/plugins/respond.min.js"></script>
		<script src="assets/plugins/excanvas.min.js"></script>
		<script type="text/javascript" src="assets/plugins/jQuery/jquery-1.11.1.min.js"></script>
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
		
		<script src="<?php echo base_url(); ?>assets/plugins/mixitup/src/jquery.mixitup.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/lightbox2/js/lightbox.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/pages-gallery.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CORE JAVASCRIPTS  -->
		<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
		<!-- end: CORE JAVASCRIPTS  -->
		<script>
		
			jQuery(document).ready(function() {
			    $("#stream").change(function(){
    	            var streamid = $("#stream").val();
    	          //alert(streamid);
    	            $.post("<?php echo site_url('configureClassControllers/getSection') ?>", {streamid : streamid}, function(data){
    	            	// alert(data);
    	                $("#section1").html(data);
    	    		});
    	        });

    	       /* $("#section").change(function(){
    	            var clname = $("#clname").val();
    	            var stream = $("#streamList").val();
    	            var section = $("#section").val();
    	            $.post("<?php echo site_url('configureClassControllers/getSubject') ?>", {className : clname, stream : stream, section : section}, function(data){
    	                $("#classOfAdmission").html(data);
    	    		});
    	        });*/
    	        
    	        	$("#disc_div1").hide();
                $("#disc_div2").hide();
                $("#disc_div3").hide();
                $("#disc_div4").hide();

	          $("#discount").change(function(){
               
					var disc = $("#discount").val();
				//	alert(disc);
					if(disc==1){
						$("#disc_div1").show();
					}else if(disc==2){
						$("#disc_div1").show();
					}else if(disc==3){
						$("#disc_div1").show();
                        $("#disc_div2").show();
					}else if(disc==4){
						$("#disc_div1").show();
                        $("#disc_div2").show();
                        $("#disc_div3").show();
                        $("#disc_div4").show();
					}else if(disc==5){
						$("#disc_div1").show();
					}else{
						 $("#disc_div1").hide();
                $("#disc_div2").hide();
                $("#disc_div3").hide();
                $("#disc_div4").hide();
					}
				});   

    	        $("#section1").change(function(){
    	        	 var streamid = $("#stream").val();
    	        	 var sectionid = $("#section1").val();
    	        	   // alert(sectionid);
    	            $.post("<?php echo site_url('configureClassControllers/getclass') ?>", {streamid : streamid, sectionid : sectionid}, function(data){
    	                $("#classOfAdmission1").html(data);
    	    		});
    	        });

    	        $("#classOfAdmission").change(function(){
    	            var classid = $("#classOfAdmission").val();
    	           // var streamid = $("#streamListshow").val();
    	          //  var sectionid = $("#sectionshow").val();
    	               //alert(classid+streamid+sectionid );
    	               // alert(classid);
    	            $.post("<?php echo site_url('configureFeeController/getFeeHead') ?>",{classid : classid}, function(data){
    	            	// alert(data);
    	                $("#feeBox").html(data);
    	    		});
    	        });
			$("#jsdiv").hide();
				<?php $subjectId = $subjectList->num_rows(); ?>
				<?php for($i = 1; $i <= $subjectId; $i++):?>
				$("#stuSubject<?php echo $i;?>").change(function(){
					
				});
				<?php endfor;?>

				$("#edate").change(function(){
					var stu_id = $("#stuid").val();
					var edate = $("#edate").val();
					var sdate = $("#sdate").val();
					//alert(edate+","+section+","+classv+","+sdate)
					$.post("<?php echo site_url("index.php/singleStudentControllers/stuReport1") ?>",{stu_id : stu_id,edate : edate,sdate : sdate}, function(data){
					$("#rahul").html(data);
						});
				});
				$("#ts").change(function(){
					var ts = $("#ts").val();
					if(ts==1){
						$("#jsdiv").show();
					}else{
						$("#jsdiv").hide();
					}
				/*	$.post("<?php //echo site_url('index.php/allFormController/getSectionByclass') ?>",{className : className},function(data){
						//getElementById("section").value()=data;
						$("#section").html(data);
					});*/
					
				});
				$("#vt").change(function(){
					var tnum = $("#vt").val();
				//	alert(tnum);
					$.post("<?php echo site_url('index.php/allFormController/getpickup') ?>",{tnum : tnum},function(data){
						//getElementById("section").value()=data;
						$("#pickup").html(data);
					});
				});
				
				$("#pickup").change(function(){
					var pickupAmount = $("#pickup").val();
					$.post("<?php echo site_url('index.php/allFormController/getpickupAmount') ?>",{pickupAmount : pickupAmount},function(data){
						//getElementById("section").value()=data;
						$("#pickupAmount").val(data);
					});
				});
				
				$('[data-type="adhaar-number"]').keyup(function() {
					  var value = $(this).val();
					  value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("-");
					  $(this).val(value);
					});

					$('[data-type="adhaar-number"]').on("change, blur", function() {
					  var value = $(this).val();
					  var maxLength = $(this).attr("maxLength");
					  if (value.length != maxLength) {
					    $(this).addClass("highlight-error");
					  } else {
					    $(this).removeClass("highlight-error");
					  }
					});
					
				
				Main.init();
				SVExamples.init();
				FormElements.init();
				PagesGallery.init();
			});
		</script>
		
		<!--image size validation -->
		<!--<script>-->
  <!--      function GetFileSize() {-->
        <!--var fi = document.getElementById('empImage'); // GET THE FILE INPUT.

        // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
  <!--      if (fi.files.length > 0) {
            // RUN A LOOP TO CHECK EACH SELECTED FILE.
  <!--          for (var i = 0; i <= fi.files.length - 1; i++) -->
		<!--	{
                var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.
  <!--              document.getElementById('fp').innerHTML =-->
  <!--                  document.getElementById('fp').innerHTML + '<br /> ' +-->
  <!--                      '<b>Image Size ' + Math.round((fsize / 1024)) + '</b> KB';-->
  <!--          }-->
  <!--        }-->
  <!--      }-->
		<!--</script>-->