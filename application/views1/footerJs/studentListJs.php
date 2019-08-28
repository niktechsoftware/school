<!-- start: MAIN JAVASCRIPTS -->
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
		<script src="<?php echo base_url(); ?>assets/js/studentList.js"></script>
		<!-- end: CORE JAVASCRIPTS  -->
		<script>
			jQuery(document).ready(function() {

				empList();
				function empList(){
					if($('#student_id:checked').val()?true:false){
						var student_id = $("#student_id").val();
					}else{
						var student_id = "";
					}
					
					if($('#name:checked').val()?true:false){
						var name = $("#name").val();
					}else{
						var name = "";
					}
					
					if($('#scholer_no:checked').val()?true:false){
						var scholer_no = $("#scholer_no").val();
					}else{
						var scholer_no = "";
					}
					
					if($('#board_register_no:checked').val()?true:false){
						var board_register_no = $("#board_register_no").val();
					}else{
						var board_register_no = "";
					}

					if($('#adm_date:checked').val()?true:false){
						var adm_date = $("#adm_date").val();
					}else{
						var adm_date = "";
					}

					if($('#date_ob:checked').val()?true:false){
						var date_ob = $("#date_ob").val();
					}else{
						var date_ob = "";
					}

					if($('#class_section:checked').val()?true:false){
						var class_section = $("#class_section").val();
					}else{
						var class_section = "";
					}

					if($('#gender:checked').val()?true:false){
						var gender = $("#gender").val();
					}else{
						var gender = "";
					}

					if($('#bloodgp:checked').val()?true:false){
						var bloodgp = $("#bloodgp").val();
					}else{
						var bloodgp = "";
					}

					if($('#birth_place:checked').val()?true:false){
						var birth_place = $("#birth_place").val();
					}else{
						var birth_place = "";
					}

					if($('#nationality:checked').val()?true:false){
						var nationality = $("#nationality").val();
					}else{
						var nationality = "";
					}

					if($('#mother_tongue:checked').val()?true:false){
						var mother_tongue = $("#mother_tongue").val();
					}else{
						var mother_tongue = "";
					}

					if($('#category:checked').val()?true:false){
						var category = $("#category").val();
					}else{
						var category = "";
					}

					if($('#religion:checked').val()?true:false){
						var religion = $("#religion").val();
					}else{
						var religion = "";
					}

					if($('#address1:checked').val()?true:false){
						var address1 = $("#address1").val();
					}else{
						var address1 = "";
					}

					if($('#city:checked').val()?true:false){
						var city = $("#city").val();
					}else{
						var city = "";
					}

					if($('#state:checked').val()?true:false){
						var state = $("#state").val();
					}else{
						var state = "";
					}

					if($('#pin_code:checked').val()?true:false){
						var pin_code = $("#pin_code").val();
					}else{
						var pin_code = "";
					}

					if($('#mobile:checked').val()?true:false){
						var mobile = $("#mobile").val();
					}else{
						var mobile = "";
					}

					if($('#email:checked').val()?true:false){
						var email = $("#email").val();
					}else{
						var email = "";
					}
					
					if($('#sno:checked').val()?true:false){
						var sno = $("#sno").val();
					}else{
						var sno = "";
					}

					if($('#bookno:checked').val()?true:false){
						var bookno = $("#bookno").val();
					}else{
						var bookno = "";
					}

					if($('#father_full_name:checked').val()?true:false){
						var father_full_name = $("#father_full_name").val();
					}else{
						var father_full_name = "";
					}

					if($('#mother_full_name:checked').val()?true:false){
						var mother_full_name = $("#mother_full_name").val();
					}else{
						var mother_full_name = "";
					}
					
					if($('#caretaker_name:checked').val()?true:false){
						var caretaker_name = $("#caretaker_name").val();
					}else{
						var caretaker_name = "";
					}
					
					if($('#caretaker_relation:checked').val()?true:false){
						var caretaker_relation = $("#caretaker_relation").val();
					}else{
						var caretaker_relation = "";
					}
					
					if($('#father_education:checked').val()?true:false){
						var father_education = $("#father_education").val();
					}else{
						var father_education = "";
					}
					
					if($('#mother_education:checked').val()?true:false){
						var mother_education = $("#mother_education").val();
					}else{
						var mother_education = "";
					}
					
					if($('#father_occupation:checked').val()?true:false){
						var father_occupation = $("#father_occupation").val();
					}else{
						var father_occupation = "";
					}
					
					if($('#mother_occupation:checked').val()?true:false){
						var mother_occupation = $("#mother_occupation").val();
					}else{
						var mother_occupation = "";
					}
					
					if($('#family_annual_income:checked').val()?true:false){
						var family_annual_income = $("#family_annual_income").val();
					}else{
						var family_annual_income = "";
					}
					
					if($('#f_mobile:checked').val()?true:false){
						var f_mobile = $("#f_mobile").val();
					}else{
						var f_mobile = "";
					}
					
					if($('#m_mobile:checked').val()?true:false){
						var m_mobile = $("#m_mobile").val();
					}else{
						var m_mobile = "";
					}
					
					if($('#f_email:checked').val()?true:false){
						var f_email = $("#f_email").val();
					}else{
						var f_email = "";
					}
					
					if($('#m_email:checked').val()?true:false){
						var m_email = $("#m_email").val();
					}else{
						var m_email = "";
					}
					if($('#disc:checked').val()?true:false){
						var disc = $("#disc").val();
					}else{
						var disc = "";
					}
					if($('#transport:checked').val()?true:false){
						var transport = $("#transport").val();
					}else{
						var transport = "";
					}
					$.post("<?php echo site_url("index.php/studentController/studentList") ?>",{
						student_id : student_id,
						name : name,
						scholer_no : scholer_no,
						board_register_no : board_register_no,
						adm_date : adm_date,
						date_ob : date_ob,
						class_section : class_section,
						gender : gender,
						bloodgp : bloodgp,
						birth_place : birth_place,
						nationality : nationality,
						mother_tongue : mother_tongue,
						category : category,
						religion : religion,
						address1 : address1,
						city : city,
						state : state,
						pin_code : pin_code,
						mobile : mobile,
						email : email,
						sno : sno,
						bookno : bookno,
						father_full_name : father_full_name,
						mother_full_name : mother_full_name,
						caretaker_name : caretaker_name,
						caretaker_relation : caretaker_relation,
						father_education : father_education,
						mother_education : mother_education,
						father_occupation : father_occupation,
						mother_occupation : mother_occupation,
						family_annual_income : family_annual_income,
						f_mobile : f_mobile,
						m_mobile : m_mobile,
						f_email : f_email,
						disc:disc,
						transport:transport,
						m_email : m_email
						},function(data){
						$("#dynamicStudentList").html(data);
					});
				}

				$('input[name="chk[]"]').on("click",function(){
						var atLeastOneIsChecked = $('input[name="chk[]"]:checked').length;
						if(atLeastOneIsChecked > 15){
							alert("Maximum 15 Column are allowed at a time.");
						}
						else{
							if($('#student_id:checked').val()?true:false){
								var student_id = $("#student_id").val();
							}else{
								var student_id = "";
							}
							
							if($('#name:checked').val()?true:false){
								var name = $("#name").val();
							}else{
								var name = "";
							}
							
							if($('#scholer_no:checked').val()?true:false){
								var scholer_no = $("#scholer_no").val();
							}else{
								var scholer_no = "";
							}
							
							if($('#board_register_no:checked').val()?true:false){
								var board_register_no = $("#board_register_no").val();
							}else{
								var board_register_no = "";
							}

							if($('#adm_date:checked').val()?true:false){
								var adm_date = $("#adm_date").val();
							}else{
								var adm_date = "";
							}

							if($('#date_ob:checked').val()?true:false){
								var date_ob = $("#date_ob").val();
							}else{
								var date_ob = "";
							}

							if($('#class_section:checked').val()?true:false){
								var class_section = $("#class_section").val();
							}else{
								var class_section = "";
							}

							if($('#gender:checked').val()?true:false){
								var gender = $("#gender").val();
							}else{
								var gender = "";
							}
									

							if($('#bloodgp:checked').val()?true:false){
								var bloodgp = $("#bloodgp").val();
							}else{
								var bloodgp = "";
							}

							if($('#birth_place:checked').val()?true:false){
								var birth_place = $("#birth_place").val();
							}else{
								var birth_place = "";
							}

							if($('#nationality:checked').val()?true:false){
								var nationality = $("#nationality").val();
							}else{
								var nationality = "";
							}

							if($('#mother_tongue:checked').val()?true:false){
								var mother_tongue = $("#mother_tongue").val();
							}else{
								var mother_tongue = "";
							}

							if($('#category:checked').val()?true:false){
								var category = $("#category").val();
							}else{
								var category = "";
							}

							if($('#religion:checked').val()?true:false){
								var religion = $("#religion").val();
							}else{
								var religion = "";
							}

							if($('#address1:checked').val()?true:false){
								var address1 = $("#address1").val();
							}else{
								var address1 = "";
							}

							if($('#city:checked').val()?true:false){
								var city = $("#city").val();
							}else{
								var city = "";
							}

							if($('#state:checked').val()?true:false){
								var state = $("#state").val();
							}else{
								var state = "";
							}

							if($('#pin_code:checked').val()?true:false){
								var pin_code = $("#pin_code").val();
							}else{
								var pin_code = "";
							}

							if($('#mobile:checked').val()?true:false){
								var mobile = $("#mobile").val();
							}else{
								var mobile = "";
							}

							if($('#email:checked').val()?true:false){
								var email = $("#email").val();
							}else{
								var email = "";
							}
							
							if($('#sno:checked').val()?true:false){
								var sno = $("#sno").val();
							}else{
								var sno = "";
							}

							if($('#bookno:checked').val()?true:false){
								var bookno = $("#bookno").val();
							}else{
								var bookno = "";
							}

							if($('#father_full_name:checked').val()?true:false){
								var father_full_name = $("#father_full_name").val();
							}else{
								var father_full_name = "";
							}

							if($('#mother_full_name:checked').val()?true:false){
								var mother_full_name = $("#mother_full_name").val();
							}else{
								var mother_full_name = "";
							}
							
							if($('#caretaker_name:checked').val()?true:false){
								var caretaker_name = $("#caretaker_name").val();
							}else{
								var caretaker_name = "";
							}
							
							if($('#caretaker_relation:checked').val()?true:false){
								var caretaker_relation = $("#caretaker_relation").val();
							}else{
								var caretaker_relation = "";
							}
							
							if($('#father_education:checked').val()?true:false){
								var father_education = $("#father_education").val();
							}else{
								var father_education = "";
							}
							
							if($('#mother_education:checked').val()?true:false){
								var mother_education = $("#mother_education").val();
							}else{
								var mother_education = "";
							}
							
							if($('#father_occupation:checked').val()?true:false){
								var father_occupation = $("#father_occupation").val();
							}else{
								var father_occupation = "";
							}
							
							if($('#mother_occupation:checked').val()?true:false){
								var mother_occupation = $("#mother_occupation").val();
							}else{
								var mother_occupation = "";
							}
							
							if($('#family_annual_income:checked').val()?true:false){
								var family_annual_income = $("#family_annual_income").val();
							}else{
								var family_annual_income = "";
							}
							
							if($('#f_mobile:checked').val()?true:false){
								var f_mobile = $("#f_mobile").val();
							}else{
								var f_mobile = "";
							}
							
							if($('#m_mobile:checked').val()?true:false){
								var m_mobile = $("#m_mobile").val();
							}else{
								var m_mobile = "";
							}
							
							if($('#f_email:checked').val()?true:false){
								var f_email = $("#f_email").val();
							}else{
								var f_email = "";
							}
							
							if($('#m_email:checked').val()?true:false){
								var m_email = $("#m_email").val();
							}else{
								var m_email = "";
							}

							if($('#disc:checked').val()?true:false){
								var disc = $("#disc").val();
							}else{
								var disc = "";
							}

							if($('#transport:checked').val()?true:false){
								var transport = $("#transport").val();
							}else{
								var transport = "";
							}

							$.post("<?php echo site_url("index.php/studentController/studentList") ?>",{
								student_id : student_id,
								name : name,
								scholer_no : scholer_no,
							   board_register_no : board_register_no,
								adm_date : adm_date,
								date_ob : date_ob,
								class_section : class_section,
								gender : gender,
								bloodgp : bloodgp,
								birth_place : birth_place,
								nationality : nationality,
								mother_tongue : mother_tongue,
								category : category,
								religion : religion,
								address1 : address1,
								city : city,
								state : state,
								pin_code : pin_code,
								mobile : mobile,			
								email : email,
								sno : sno,			
								bookno : bookno,
								father_full_name : father_full_name,
								mother_full_name : mother_full_name,
								caretaker_name : caretaker_name,
								caretaker_relation : caretaker_relation,
								father_education : father_education,
								mother_education : mother_education,
								father_occupation : father_occupation,
								mother_occupation : mother_occupation,
								family_annual_income : family_annual_income,
								f_mobile : f_mobile,
								m_mobile : m_mobile,
								f_email : f_email,
								m_email : m_email,
								disc : disc,
								transport:transport
								},function(data){
								$("#dynamicStudentList").html(data);
							});
						}
				});
				Main.init();
				SVExamples.init();
				
			});
		</script>