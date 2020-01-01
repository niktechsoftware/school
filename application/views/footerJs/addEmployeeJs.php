<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="assets/plugins/respond.min.js"></script>
		<script src="assets/plugins/excanvas.min.js"></script>
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
		<script src="<?php echo base_url(); ?>assets/js/subview.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/subview-examples.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/date-element.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CORE JAVASCRIPTS  -->
		<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
		<!-- end: CORE JAVASCRIPTS  -->
		<script>
		
			jQuery(document).ready(function() {
				$('#standered').hide();
				$('#stanrow').hide();
				$('#standlbl').hide();
				
				$('#jobCategory').change(function(){
				  var category= $('#jobCategory').val(); 
				  if(category==3){
				      $('#standered').show();
				      	$('#stanrow').show();
				      	$('#standlbl').show();
				  }else{
				      $('#standered').hide();
				      	$('#stanrow').hide();
				      	$('#standlbl').hide();
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
				
				Main.init();
				SVExamples.init();
				DateElement.init();
			});
		</script>
		<script>
                             var check = function() {
                        	  if (document.getElementById('password').value ==
                        	    document.getElementById('re-password').value) {
                        	    document.getElementById('cpass').style.color = 'green';
                        	    document.getElementById('cpass').innerHTML = 'Matched';
                        	  } else {
                        	    document.getElementById('cpass').style.color = 'red';
                        	    document.getElementById('cpass').innerHTML = 'Not Match';
                        	  }
                        	}


							 function jobtitle() 
							 {
								var text_value = document.getElementById("jobTitle").value;
								value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
								document.getElementById("jobTitle").value=value;
							 }

							 function Address() {
									var text_value = document.getElementById("employeeAddLine1").value;
									value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z0-9-., )]*/g, "");
									document.getElementById("employeeAddLine1").value=value;

								}

							 function namevalidation() {
								var text_value = document.getElementById("empFirstName").value;
								value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
								document.getElementById("empFirstName").value=value;
							     }

							//  function mnamevalidation() {
							// 	var text_value = document.getElementById("empMiddleName").value;
							// 	value = text_value.replace(/[^(A-Za-z)]*/g, "");
							// 	document.getElementById("empMiddleName").value=value;
							//      }


							//  function lnamevalidation() {
							// 	var text_value = document.getElementById("empLastName").value;
							// 	value = text_value.replace(/[^(A-Za-z)]*/g, "");
							// 	document.getElementById("empLastName").value=value;
							//      }

							function pinvalidation()
                             {
                                 var text_value = document.getElementById("empPin").value;
                                 if (!text_value.match(/[0-9]$/))
                                 {
                                     document.getElementById("pin").innerHTML = "Invalid Pin Number";
									 document.getElementById("empPin").focus();
                                     if(text_value=="")
                                     {
                                     document.getElementById("pin").innerHTML = " ";
                                     } 
                                 }                       
                             }

                             function mobilevalidation()
                             {
                                 var text_value = document.getElementById("empmobileNumber").value;
                                 if (!text_value.match(/[0-9]$/))
                                 {
                                     document.getElementById("mobile").innerHTML = "Invalid Mobile Number";
									 document.getElementById("empmobileNumber").focus();
                                     if(text_value=="")
                                     {
                                     document.getElementById("mobile").innerHTML = " ";
                                     } 
                                 }                       
                             }   
							  

							 function altmobilevalidation()
                             {
                                 var text_value = document.getElementById("empPhoneNumber").value;
                                 if (!text_value.match(/[0-9]$/))
                                 {
                                     document.getElementById("altmobile").innerHTML = "Invalid Alternate Number";
									 document.getElementById("empPhoneNumber").focus();
                                     if(text_value=="")
                                     {
                                     document.getElementById("altmobile").innerHTML = " ";
                                     } 
                                 }                       
                             }   

							 function joiningdate()
                             {
                                 var dob = document.getElementById("empDob").value;
								 var joindate = document.getElementById("j_date").value;
                                 if (joindate-dob==18)
                                 {
                                     document.getElementById("altmobile").innerHTML = "Invalid Date";
									 document.getElementById("j_date").focus();
                                     if(text_value=="")
                                     {
                                     document.getElementById("altmobile").innerHTML = " ";
                                     } 
                                 }                       
                             } 

						   function EmailId() {
								var text_value = document.getElementById("empemail").value;
								if (!text_value.match(/^[a-z0-9._]+[@][a-z]+[.][a-z]+$/)) {
									document.getElementById("email").innerHTML = "Enter valid email id";
									document.getElementById("empemail").focus();
									if (text_value == "") {
										document.getElementById("email").innerHTML = " ";
									}
								}else{
									document.getElementById("email").innerHTML = " ";
									document.getElementById("empemail").focus();
								}

							} 

							function bankname() {
								var text_value = document.getElementById("empBnakName").value;
								value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
								document.getElementById("empBnakName").value=value;
							     }

								 function accnumber() {
								var text_value = document.getElementById("empAccountNumber").value;
								value = text_value.replace(/[^(0-9)]*/g, "");
								document.getElementById("empAccountNumber").value=value;
							     }

								 function ifsccode() {
								var text_value = document.getElementById("empIfscCode").value;
								value = text_value.replace(/[^(A-Za-z0-9)]*/g, "");
								document.getElementById("empIfscCode").value=value;
							     }

								 function branchname() {
								var text_value = document.getElementById("empBranchName").value;
										value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z0-9-., )]*/g, "");
										document.getElementById("empBranchName").value=value;
							     }

								 function bankaddress() {
								var text_value = document.getElementById("empBankAddress").value;
										value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z0-9-., )]*/g, "");
										document.getElementById("empBankAddress").value=value;
							     }

								function payeename() {
								var text_value = document.getElementById("empPayeeName").value;
								value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
								document.getElementById("empPayeeName").value=value;
							     }

							     function country() {
								var text_value = document.getElementById("empCountry").value;
								value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
								document.getElementById("empCountry").value=value;
							     }

							     function hqualify() {
								var text_value = document.getElementById("empQualification").value;
								value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z0-9. )]*/g, "");
								document.getElementById("empQualification").value=value;
							     }
                    </script>
					
		<script>
                         var qcheck = function() 
							{
                        	  if (document.getElementById('password').value ==document.getElementById('re-password').value) 
							  {
                        	    document.getElementById('cpass').style.color = 'green';
                        	    document.getElementById('cpass').innerHTML = 'Matched';
                        	  } else {
                        	    document.getElementById('cpass').style.color = 'red';
                        	    document.getElementById('cpass').innerHTML = 'Not Match';
                        	  }
					        }
							function qAddress() {
								var text_value = document.getElementById("employeeAddLine1").value;
								value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z0-9-., )]*/g, "");
								document.getElementById("employeeAddLine1").value=value;

							}

							 function qnamevalidation() {
								var text_value = document.getElementById("empFirstName").value;
								value = text_value.replace(/[ ]+/g," ").replace(/[^(A-Za-z )]*/g, "");
								document.getElementById("empFirstName").value=value;
							     }

							//  function qmnamevalidation() {
							// 	var text_value = document.getElementById("empMiddleName").value;
							// 	value = text_value.replace(/[^(A-Za-z)]*/g, "");
							// 	document.getElementById("empMiddleName").value=value;
							//      }


							//  function qlnamevalidation() {
							// 	var text_value = document.getElementById("empLastName").value;
							// 	value = text_value.replace(/[^(A-Za-z)]*/g, "");
							// 	document.getElementById("empLastName").value=value;
							//      }

                            //  function qmobilevalidation()
                            //  {
                            //      var text_value = document.getElementById("empmobileNumber").value;
                            //      if (!text_value.match(/[0-9]$/))
                            //      {
                            //          document.getElementById("mobile").innerHTML = "Invalid Mobile Number";
                            //          if(text_value=="")
                            //          {
                            //          document.getElementById("mobile").innerHTML = " ";
                            //          } 
                            //      }                       
                            //  }
                             
                             
                             function isNumber(evt) {
                                    evt = (evt) ? evt : window.event;
                                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                    return false;
                                    }
                                    return true;
                                    
									}



									function isAplha(evt) {
                                    evt = (evt) ? evt : window.event;
                                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {

                                        return true;
                                    }
                                    return false;
                                }
									



					function checkDOB() {
			    var dateString = document.getElementById('empDob').value;
			    var myDate = new Date(dateString);
			    var today = new Date('<?php echo date('m/d/Y');?>');
			    if ( myDate > today ) { 
			        $("#empDob").nextAll().remove();
			        $('#empDob').after('<p style="color:red">invalid Date of Birth</p>');
			        return false;
			    	}else{
				    	$("#empDob").nextAll().remove();
				    	return true;
	                }
				}


				function checkjoin() {
				var dateString = document.getElementById('j_date').value;
			
				var myDate = new Date(dateString);
				// alert(myDate);
				var today = new Date('<?php echo date('m/d/Y');?>');
				// alert(today);
			    if ( myDate > today ) { 
			        $("#j_date").nextAll().remove();
			        $('#j_date').after('<p style="color:red">invalid Joining date</p>');
			        return false;
			    	}else{
				    	$("#j_date").nextAll().remove();
				    	return true;
	                }
				}
                             
                    </script>