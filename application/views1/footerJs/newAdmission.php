		
		
		<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.1.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.3.min.js"></script>
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
		<script src="<?php echo base_url(); ?>assets/plugins/jquery-maskmoney/jquery.maskMoney.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/form-elements.js"></script>
		
		<script src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/ckeditor/adapters/jquery.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/form-validation.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CORE JAVASCRIPTS  -->
		<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
		<!-- end: CORE JAVASCRIPTS  -->
		<script>
			jQuery(document).ready(function() {
				$("#jsdiv").hide();


    	        $("#stream").change(function(){
    	            var streamid = $("#stream").val();
    	          //alert(streamid);
    	            $.post("<?php echo site_url('configureClassControllers/getSection') ?>", {streamid : streamid}, function(data){
    	            	// alert(data);
    	                $("#section1").html(data);
    	    		});
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
    	               // alert(classid);
    	            $.post("<?php echo site_url('configureFeeController/getFeeHead') ?>",{classid : classid}, function(data){
    	            	// alert(data);
    	                $("#feeBox").html(data);
    	    		});
    	        });
				
				$("#sameAddress").click(function(){
					if($('#sameAddress:checked').val()?true:false){
						var addLine1 = $("#addLine1").val();
						var city = $("#empCity").val();
						var state = $("#empState").val();
						var pinCode = $("#empPin").val();
						var country = $("#country").val();
						
						$("#parentAddress").val(addLine1);
						$("#parentCity").val(city);
						$("#parentState").val(state);
						$("#parentPin").val(pinCode);
						$("#parentCountry").val(country);
					}else{
						$("#parentAddress").val("");
						$("#parentCity").val("");
						$("#parentState").val("");
						$("#parentPin").val("");
						$("#parentCountry").val("");
					}
				});

				$("#sameMobile").click(function(){
					if($('#sameMobile:checked').val()?true:false){
						var addLine1 = $("#mobileNumber").val();
						$("#fatherMobileNumber").val(addLine1);
						$("#motherMobileNumber").val(addLine1);
					}else{
						$("#fatherMobileNumber").val("");
						$("#motherMobileNumber").val("");
					}
				});
                
                $("#vt").change(function(){
					var tnum = $("#vt").val();
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
				
			
				$("#ts").change(function(){
					var ts = $("#ts").val();
					if(ts=="1"){
						$("#jsdiv").show();
					}else{
						$("#jsdiv").hide();
					}
					$.post("<?php echo site_url('index.php/allFormController/getSectionByclass') ?>",{className : className},function(data){
						//getElementById("section").value()=data;
						$("#section").html(data);
					});
					
				});
				
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
				
				
				$("#empState").change(function(){
					var state = $("#empState").val();
					//alert(state);
					$.post("<?php echo site_url('index.php/allFormController/getCity') ?>",{state : state},function(data){
						$("#empCity").html(data);
					});
				});

				$("#empCity").change(function(){
					var state = $("#empState").val();
					var city = $("#empCity").val();
					//alert(state);
					$.post("<?php echo site_url('index.php/allFormController/getArea') ?>",{city : city,state : state},function(data){
						$("#area").html(data);
					});
				});

				$("#area").change(function(){
					var state = $("#empState").val();
					var city = $("#empCity").val();
					var area = $("#area").val();
					//alert(state);
					$.post("<?php echo site_url('index.php/allFormController/getPin') ?>",{area : area,city : city,state : state},function(data){
						$("#empPin").val(data);
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

				$('[data-type="mobileNumber"]').keyup(function() {
					  var value = $(this).val();
					  value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("");
					  $(this).val(value);
					});

				$('[data-type="phonenumbar"]').keyup(function() {
					  var value = $(this).val();
					  value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("");
					  $(this).val(value);
					});
				$('[data-type="pin"]').keyup(function() {
					  var value = $(this).val();
					  value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("");
					  $(this).val(value);
					});
				$('[data-type="ppin"]').keyup(function() {
					  var value = $(this).val();
					  value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("");
					  $(this).val(value);
					});
				$('[data-type="fpin"]').keyup(function() {
					  var value = $(this).val();
					  value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("");
					  $(this).val(value);
					});
				$('[data-type="fathermobileNumber"]').keyup(function() {
					  var value = $(this).val();
					  value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("");
					  $(this).val(value);
					});
				$('[data-type="maamobileNumber"]').keyup(function() {
					  var value = $(this).val();
					  value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("");
					  $(this).val(value);
					});

					jQuery.validator.addMethod("accept", function(value, element, param) {
					return value.match(new RegExp("." + param + "$"));
					});
				
				Main.init();
				SVExamples.init();
				FormValidator.init();
				FormElements.init();
			});

			/* STUDENT INFORMATION FRONT-END VALIDATION */

				function stuScholar() {
                    var text_value = document.getElementById("scholerNumber").value;
                    // if (!text_value.match(/^[A-Za-z]+$/)) {
                    //     document.getElementById("schlor").innerHTML = "Alphabates Only without space";
                    //     document.getElementById("scholerNumber").focus();
                    //     if (text_value == "") {
                    //     		document.getElementById("schlor").innerHTML = "";
                            
                    //     }
                    // }else{
                    // 			document.getElementById("schlor").innerHTML = "";
                    //  		document.getElementById("scholerNumber").focus();
                    // }
                   	// console.log(text_value);
                    //value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
                    value = text_value.replace(/[^(A-Za-z0-9)]*/g, "");
                   	// console.log(value);
                    document.getElementById("scholerNumber").value=value;

                }
				function stuFirstname() {
                    var text_value = document.getElementById("firstName").value;
                    // if (!text_value.match(/^[A-Za-z]+$/)) {
                    //     document.getElementById("fname").innerHTML = "Alphabates Only without space";
                    //     document.getElementById("firstName").focus();
                    //     if (text_value == "") {
                    //     		document.getElementById("fname").innerHTML = "";
                            
                    //     }
                    // }else{
                    // 			document.getElementById("fname").innerHTML = "";
                    //  		document.getElementById("firstName").focus();
                    // }
                   	// console.log(text_value);
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
                    //value = text_value.replace(/[^(A-Za-z )]*/g, "");
                   	// console.log(value);
                    document.getElementById("firstName").value=value;

                }
               

                function checkDOB() {
			    var dateString = document.getElementById('dob').value;
			    var myDate = new Date(dateString);
			    var today = new Date('<?php echo date('m/d/Y');?>');
			    if ( myDate > today ) { 
			        $("#dob").nextAll().remove();
			        $('#dob').after('<p style="color:red">invalid Date of Birth</p>');
			        return false;
			    	}else{
				    	$("#dob").nextAll().remove();
				    	return true;
	                }
				}

                function stuBirthPlace() {
                    var text_value = document.getElementById("birthPlace").value;
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
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
                    document.getElementById("birthPlace").value=value;

                }
                function stuAddress() {
                    var text_value = document.getElementById("addLine1").value;
                    // if (!text_value.match(/^[0-9a-zA-Z ]+$/)) {
                    //     document.getElementById("stuadd").innerHTML = "Enter Parmanent Address";
                    //     document.getElementById("addLine1").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("stuadd").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("stuadd").innerHTML = " ";
                    //         document.getElementById("addLine1").focus();
                    // }
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z0-9- )]*/g, "");
                    document.getElementById("addLine1").value=value;

                }
                function stuCountry() {
                    var text_value = document.getElementById("country").value;
                    // if (!text_value.match(/^[A-Za-z]+$/)) {
                    //     document.getElementById("contry").innerHTML = "Alphabates Only without space";
                    //     document.getElementById("country").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("contry").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("contry").innerHTML = " ";
                    //         document.getElementById("country").focus();
                    // }
                    value = text_value.replace(/[^(A-Za-z)]*/g, "");
                    document.getElementById("country").value=value;
                }
                function stuEmailId() {
                    var text_value = document.getElementById("email1").value;
                    if (!text_value.match(/^[a-z0-9._]+[@][a-z]+[.][a-z]+$/)) {
                        document.getElementById("emailID").innerHTML = "Enter valid email id";
                        document.getElementById("email1").focus();
                        if (text_value == "") {
                            document.getElementById("emailID").innerHTML = " ";
                        }
                    }else{
                    	document.getElementById("emailID").innerHTML = " ";
                        document.getElementById("email1").focus();
                    }

                }
                var check = function() {
                	  if (document.getElementById('password').value ==
                	    document.getElementById('ConfirmPassword').value) {
                	    document.getElementById('cpass').style.color = 'green';
                	    document.getElementById('cpass').innerHTML = 'matching';
                	  } 
                	  else {
                	    document.getElementById('cpass').style.color = 'red';
                	    document.getElementById('cpass').innerHTML = 'not matching';
                	  }
                	}

                	let today = new Date().toISOString().substr(0, 10);
					document.querySelector("#doa").value = today;


            /* PARENTS INFORMATION FRONT-END VALIDATION */


                function stuFathername() {
                    var text_value = document.getElementById("fatherName").value;
                    // if (!text_value.match(/^[A-Za-z ]+$/)) {
                    //     document.getElementById("faname").innerHTML = "Alphabates Only";
                    //     document.getElementById("fatherName").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("faname").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("faname").innerHTML = " ";
                    //         document.getElementById("fatherName").focus();
                    // }
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
                    document.getElementById("fatherName").value=value;

                }
                function stuMothername() {
                    var text_value = document.getElementById("motherName").value;
                    // if (!text_value.match(/^[A-Za-z ]+$/)) {
                    //     document.getElementById("maname").innerHTML = "Alphabates Only";
                    //     document.getElementById("motherName").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("maname").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("maname").innerHTML = " ";
                    //         document.getElementById("motherName").focus();
                    // }
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
                    document.getElementById("motherName").value=value;

                }
                function stuFatherEdu() {
                    var text_value = document.getElementById("fatherEducation").value;
                    // if (!text_value.match(/^[A-Za-z ]+$/)) {
                    //     document.getElementById("faedu").innerHTML = "Alphabates Only";
                    //     document.getElementById("fatherEducation").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("faedu").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("faedu").innerHTML = " ";
                    //         document.getElementById("fatherEducation").focus();
                    // }
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z. )]*/g, "");
                    document.getElementById("fatherEducation").value=value;

                }
                function stuMotherEdu() {
                    var text_value = document.getElementById("motherEducation").value;
                    // if (!text_value.match(/^[A-Za-z ]+$/)) {
                    //     document.getElementById("maedu").innerHTML = "Alphabates Only";
                    //     document.getElementById("motherEducation").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("maedu").innerHTML = " ";
                    //     }
                    // }else{

                    // 		document.getElementById("maedu").innerHTML = " ";
                    //         document.getElementById("motherEducation").focus();
                    // }
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z. )]*/g, "");
                    document.getElementById("motherEducation").value=value;

                }
                function stuFatherOccup() {
                    var text_value = document.getElementById("fatherOccupation").value;
                    // if (!text_value.match(/^[A-Za-z ]+$/)) {
                    //     document.getElementById("faoccu").innerHTML = "Alphabates Only";
                    //     document.getElementById("fatherOccupation").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("faoccu").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("faoccu").innerHTML = " ";
                    //         document.getElementById("fatherOccupation").focus();
                    // }
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
                    document.getElementById("fatherOccupation").value=value;

                }
                function stuMotherOccup() {
                    var text_value = document.getElementById("motherOccupation").value;
                    // if (!text_value.match(/^[A-Za-z ]+$/)) {
                    //     document.getElementById("maoccu").innerHTML = "Alphabates Only";
                    //     document.getElementById("motherOccupation").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("maoccu").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("maoccu").innerHTML = " ";
                    //         document.getElementById("motherOccupation").focus();
                    // }
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
                    document.getElementById("motherOccupation").value=value;

                }	
                function stuFamilyIncome() {
                    var text_value = document.getElementById("familyAnnualIncome").value;
                    // if (!text_value.match(/^[A-Za-z0-9 ]+$/)) {
                    //     document.getElementById("familyincome").innerHTML = "Alphabates Only without space";
                    //     document.getElementById("familyAnnualIncome").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("familyincome").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("familyincome").innerHTML = " ";
                    //         document.getElementById("familyAnnualIncome").focus();
                    // }
                    value = text_value.replace(/[^(0-9 )]*/g, "");
                    document.getElementById("familyAnnualIncome").value=value;

                }
                function stuFamilyAdress() {
                    var text_value = document.getElementById("parentAddress").value;
                    // if (!text_value.match(/^[a-zA-Z0-9/ ]+$/)) {
                    //     document.getElementById("Padress").innerHTML = "Alphabates Only";
                    //     document.getElementById("parentAddress").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("Padress").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("Padress").innerHTML = " ";
                    //         document.getElementById("parentAddress").focus();
                    // }
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z0-9/- )]*/g, "");
                    document.getElementById("parentAddress").value=value;

                }
                 function garea() {
                    var text_value = document.getElementById("area").value;
                    // if (!text_value.match(/^[a-zA-Z0-9/ ]+$/)) {
                    //     document.getElementById("Padress").innerHTML = "Alphabates Only";
                    //     document.getElementById("parentAddress").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("Padress").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("Padress").innerHTML = " ";
                    //         document.getElementById("parentAddress").focus();
                    // }
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z0-9/- )]*/g, "");
                    document.getElementById("area").value=value;

                }
                function stuParentCity() {
                    var text_value = document.getElementById("parentCity").value;
                    // if (!text_value.match(/^[A-Za-z]+$/)) {
                    //     document.getElementById("Pcity").innerHTML = "Alphabates Only without space";
                    //     document.getElementById("parentCity").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("Pcity").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("Pcity").innerHTML = " ";
                    //         document.getElementById("parentCity").focus();
                    // }
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
                    document.getElementById("parentCity").value=value;

                }
                function stuParentstate() {
                    var text_value = document.getElementById("parentState").value;
                    // if (!text_value.match(/^[A-Za-z]+$/)) {
                    //     document.getElementById("Pstate").innerHTML = "Alphabates Only without space";
                    //     document.getElementById("parentState").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("Pstate").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("Pstate").innerHTML = " ";
                    //         document.getElementById("parentState").focus();
                    // }
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
                    document.getElementById("parentState").value=value;

                }
                function stuParentCountry() {
                    var text_value = document.getElementById("parentCountry").value;
                    // if (!text_value.match(/^[A-Za-z]+$/)) {
                    //     document.getElementById("pcontry").innerHTML = "Alphabates Only without space";
                    //     document.getElementById("parentCountry").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("pcontry").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("pcontry").innerHTML = " ";
                    //         document.getElementById("parentCountry").focus();
                    // }
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
                    document.getElementById("parentCountry").value=value;

                }
                function stucaretaker() {
                    var text_value = document.getElementById("guardianName").value;
                    // if (!text_value.match(/^[A-Za-z]+$/)) {
                    //     document.getElementById("carename").innerHTML = "Alphabates Only without space";
                    //     document.getElementById("guardianName").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("carename").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("carename").innerHTML = " ";
                    //         document.getElementById("guardianName").focus();
                    // }
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
                    document.getElementById("guardianName").value=value;
                }
                function stucaretakerRelation() {
                    var text_value = document.getElementById("guardianRelation").value;
                    // if (!text_value.match(/^[A-Za-z]+$/)) {
                    //     document.getElementById("caretrel").innerHTML = "Alphabates Only without space";
                    //     document.getElementById("guardianRelation").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("caretrel").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("carename").innerHTML = " ";
                    //         document.getElementById("guardianName").focus();
                    // }
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
                    document.getElementById("guardianRelation").value=value;

                }


/*------------------------------Previous School Information    -----------------------*/



				function oldstuSchname() {
                    var text_value = document.getElementById("pSchool").value;
                    // if (!text_value.match(/^[A-Za-z ]+$/)) {
                    //     document.getElementById("schname").innerHTML = "Alphabates Only";
                    //     document.getElementById("pSchool").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("schname").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("schname").innerHTML = " ";
                    //         document.getElementById("pSchool").focus();
                    // }
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
                    document.getElementById("pSchool").value=value;

                }
                function oldstuYear() {
                    var text_value = document.getElementById("pYear").value;
                    // if (!text_value.match(/^[0-9 ]+$/)) {
                    //     document.getElementById("passy").innerHTML = " Digits Only";
                    //     document.getElementById("pYear").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("passy").innerHTML = " ";
                    //     }
                    // }else{
                    // 		document.getElementById("passy").innerHTML = " ";
                    //         document.getElementById("pYear").focus();
                    // }
                    value = text_value.replace(/[^(0-9-)]*/g, "");
                    document.getElementById("pYear").value=value;

                }
                function oldstuRoll() {
                    var text_value = document.getElementById("pRoll").value;
                    // if (!text_value.match(/^[0-9 ]+$/)) {
                    //     document.getElementById("rool").innerHTML = " Digits Only";
                    //     document.getElementById("pRoll").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("rool").innerHTML = " ";
                    //         document.getElementById("pRoll").focus();
                    //     }
                    // }else{
                    // 	document.getElementById("rool").innerHTML = " ";
                    //     document.getElementById("pRoll").focus();
                    // }
                    value = text_value.replace(/[^(0-9-)]*/g, "");
                    document.getElementById("pRoll").value=value;

                }
                function oldstuMarks() {
                    var text_value = document.getElementById("pMarks").value;
                    // if (!text_value.match(/^[0-9 ]+$/)) {
                    //     document.getElementById("marks").innerHTML = " Digits Only";
                    //     document.getElementById("pMarks").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("marks").innerHTML = " ";
                    //         document.getElementById("pMarks").focus();
                    //     }
                    // }else{
                    // 		document.getElementById("marks").innerHTML = " ";
                    //         document.getElementById("pMarks").focus();
                    // }
                    value = text_value.replace(/[^(0-9-)]*/g, "");
                    document.getElementById("pMarks").value=value;

                }
                function oldstuPercentage() {
                    var text_value = document.getElementById("pPercentage").value;
                    // if (!text_value.match(/^[0-9% ]+$/)) {
                    //     document.getElementById("persent").innerHTML = " Digits only";
                    //     document.getElementById("pPercentage").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("persent").innerHTML = " ";
                    //         document.getElementById("pPercentage").focus();
                    //     }
                    // }else{
                    // 		document.getElementById("persent").innerHTML = " ";
                    //         document.getElementById("pPercentage").focus();
                    // }
                    value = text_value.replace(/[^(0-9% )]*/g, "");
                    document.getElementById("pPercentage").value=value;

                }
                function oldstuSub() {
                    var text_value = document.getElementById("pSubject").value;
                    // if (!text_value.match(/^[A-Za-z ]+$/)) {
                    //     document.getElementById("sub").innerHTML = " Alphabates Only";
                    //     document.getElementById("pSubject").focus();
                    //     if (text_value == "") {
                    //         document.getElementById("sub").innerHTML = " ";
                    //         document.getElementById("pSubject").focus();
                    //     }
                    // }else{
                    // 		document.getElementById("sub").innerHTML = " ";
                    //         document.getElementById("pSubject").focus();
                    // }
                    value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z, )]*/g, "");
                    document.getElementById("pSubject").value=value;

                }
                
                 // assign function to onsubmit property of form
               document.getElementById('form').onsubmit = function() {
                // get reference to required checkbox
                var terms = this.elements['terms'];
                
                if ( !terms.checked ) { // if it's not checked
                    // display error info (generally not an alert these days)
                    alert( 'Please click on  accept the Policy and Terms & Conditions checkbox' );
                    return false; // don't submit
                }
                    return true; // submit
                }; 
	</script>