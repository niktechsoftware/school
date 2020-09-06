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
				
				$("#editProfile").click(function(){
					//alert("rahul");
					var empId = $("#empId").val();
					var firstName  = $("#firstname").val();
					var midName = $("#midname").val();
					var lastName = $("#lastname").val();
					var dob = $("#empDob").val();
					
					if($('#gender:checked').val()?true:false){
						var gender = $("#gender").val();
					}else{
						var gender = $("#gender1").val();
					}
									
					var category = $("#category").val();
					var job_title = $("#job_title").val();
					var qualification = $("#qualification").val();
					var experiance = $("#experiance").val();
					
					if($('#status:checked').val()?true:false){
						var status = $("#status").val();
					}else{
						var status = $("#status1").val();
					}
					
					var address1 = $("#address1").val();
					var address2 = $("#address2").val();
					var city = $("#city").val();
					var state = $("#state").val();
					var pincode = $("#pincode").val();
					var country = $("#country").val();
					var phone = $("#phone").val();
					var mobile = $("#mobile").val();
					var email = $("#email").val();
					var password = $("#password").val();
					var bank = $("#bank").val();
					var ac = $("#ac").val();
					var bankadd = $("#bankadd").val();
					var payee = $("#payee").val();
					var ifsc = $("#ifsc").val();
					var branchname = $("#branchname").val();
					$.post("<?php echo site_url('index.php/employeeController/updateProfile')?>",
					{
						empId : empId,
						firstName : firstName,
						midName : midName,
						lastName : lastName,
						dob : dob,
						gender : gender,
						category : category,
						job_title : job_title,
						qualification : qualification,
						experiance : experiance,
						status : status,
						address1 : address1,
						address2 : address2,
						city : city,
						state : state,
						pincode : pincode,
						country : country,
						phone : phone,
						mobile : mobile,
						email : email,
						password : password,
						bank:bank,
						ac:ac,
						bankadd:bankadd,
						payee:payee,
						ifsc:ifsc,
						branchname:branchname,
					},
					function(data){
		                $("#streamList").html(data);
		                window.location.reload();

					});
				});
				
					$("#editbank").click(function(){
					
					var empId = $("#empId").val();
					//alert(empId);
					var bank = $("#bank").val();
					var ac = $("#ac").val();
					var bankadd = $("#bankadd").val();
					var payee = $("#payee").val();
					var ifsc = $("#ifsc").val();
					var branchname = $("#branchname").val();
					$.post("<?php echo site_url('index.php/employeeController/updateBankInformation')?>",
					{
						empId : empId,
						bank:bank,
						ac:ac,
						bankadd:bankadd,
						payee:payee,
						ifsc:ifsc,
						branchname:branchname,
					},
					function(data){
		                $("#streamList").html(data);
		                window.location.reload();

					});
				});
				
				Main.init();
				SVExamples.init();
				FormElements.init();
				PagesGallery.init();
			});
		</script>
<!--    CHECK IMAGE SIZE VALIDATION    -->
<script>
    function GetFileSize() {
        var fi = document.getElementById('empImage'); // GET THE FILE INPUT.

        // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
        if (fi.files.length > 0) {
            // RUN A LOOP TO CHECK EACH SELECTED FILE.
            for (var i = 0; i <= fi.files.length - 1; i++) 
			{
                var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.
                document.getElementById('fp').innerHTML =
                    document.getElementById('fp').innerHTML + '<br /> ' +
                        '<b>Image Size ' + Math.round((fsize / 1024)) + '</b> KB';
            }
        }
    }

	function GetFileSize1() {
        var fi = document.getElementById('employeeCertificates'); // GET THE FILE INPUT.

        // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
        if (fi.files.length > 0) {
            // RUN A LOOP TO CHECK EACH SELECTED FILE.
            for (var i = 0; i <= fi.files.length - 1; i++) 
			{
                var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.
                document.getElementById('fp1').innerHTML =
                    document.getElementById('fp1').innerHTML + '<br /> ' +
                        '<b>Image Size ' + Math.round((fsize / 1024)) + '</b> KB';
            }
		}		
		else if(fi.files.length==" ")
		{
            alert('knjnjnjnnuvfd');

		}
    }

	function GetFileSize2() {
        var fi = document.getElementById('empImage1'); // GET THE FILE INPUT.

        // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
        if (fi.files.length > 0) {
            // RUN A LOOP TO CHECK EACH SELECTED FILE.
            for (var i = 0; i <= fi.files.length - 1; i++) 
			{
                var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.
                document.getElementById('fp2').innerHTML =
                    document.getElementById('fp2').innerHTML + '<br /> ' +
                        '<b>Image Size ' + Math.round((fsize / 1024)) + '</b> KB';
            }
        }
    }
	function GetFileSize3() {
        var fi = document.getElementById('empImage2'); // GET THE FILE INPUT.

        // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
        if (fi.files.length > 0) {
            // RUN A LOOP TO CHECK EACH SELECTED FILE.
            for (var i = 0; i <= fi.files.length - 1; i++) 
			{
                var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.
                document.getElementById('fp3').innerHTML =
                    document.getElementById('fp3').innerHTML + '<br /> ' +
                        '<b>Image Size ' + Math.round((fsize / 1024)) + '</b> KB';
            }
        }
    }
	function GetFileSize4() {
        var fi = document.getElementById('empImage3'); // GET THE FILE INPUT.

        // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
        if (fi.files.length > 0) {
            // RUN A LOOP TO CHECK EACH SELECTED FILE.
            for (var i = 0; i <= fi.files.length - 1; i++) 
			{
                var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.
                document.getElementById('fp4').innerHTML =
                    document.getElementById('fp4').innerHTML + '<br /> ' +
                        '<b>Image Size ' + Math.round((fsize / 1024)) + '</b> KB';
            }
        }
    }
    function GetFileSize5() {
        var fi = document.getElementById('empImage4'); // GET THE FILE INPUT.

        // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
        if (fi.files.length > 0) {
            // RUN A LOOP TO CHECK EACH SELECTED FILE.
            for (var i = 0; i <= fi.files.length - 1; i++) 
			{
                var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.
                document.getElementById('fp5').innerHTML =
                    document.getElementById('fp5').innerHTML + '<br /> ' +
                        '<b>Image Size ' + Math.round((fsize / 1024)) + '</b> KB';
            }
        }
    }
    
      $("#edate").change(function(){ 
					var emp_id = $("#empid").val();
					var edate = $("#edate").val();
					var sdate = $("#sdate").val();
			$.post("<?php echo site_url("index.php/employeeController/empreport") ?>",{emp_id : emp_id,edate : edate,sdate : sdate}, function(data){
				$("#rahul").html(data);
						});
				});


</script>