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
		<!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> -->
		<!-- end: CORE JAVASCRIPTS  -->
		<script>
		$(document).ready(function() {
    $('#aarju').DataTable();
} );




		
	  $(document).ready(function() {
    $('#transportsearch').DataTable();
} );
 
    $(document).ready(function() {
        $('#driver').DataTable();
    } );
							   
			jQuery(document).ready(function() {
			    
			     $("#dddate").change(function(){
                                        document.getElementById("subbutton").disabled =false;
                                         });
				
				 $("#clname").change(function(){
					
    	            var clname = $("#clname").val();
    	            //alert(clname);
    	            $.post("<?php echo site_url('configureClassControllers/getStream') ?>", {className : clname}, function(data){
    	                $("#streamList").html(data);
    	                //alert(data);
    	    		});
    	        });

        		 $("#sectionshow").change(function(){
        			
     	            var sectionid = $("#sectionshow").val();
     	             var streamid = $("#streamListshow").val();
     	           // alert(sectionid);
     	             // alert(streamid);
     	            $.post("<?php echo site_url('configureClassControllers/getclass') ?>", {sectionid : sectionid,streamid:streamid}, function(data){
     	            	//alert(data);
     	                $("#classshow").html(data);
     	                //  alert(data);
     	    		});
     	        });

    	        $("#streamList").change(function(){
    	            var clname = $("#clname").val();
    	            var stream = $("#streamList").val();
    	            //alert(clname);
    	            $.post("<?php echo site_url('configureClassControllers/getSection') ?>", {className : clname, stream : stream}, function(data){
    	                $("#section").html(data);
    	               
    	    		});
    	        });

    	        $("#streamListshow").change(function(){
    	            var streamid = $("#streamListshow").val();
    	        
    	          // alert(streamid);
    	            $.post("<?php echo site_url('configureClassControllers/getSectionbyStream') ?>", {streamid : streamid}, function(data){
    	            	// alert(data);
    	                $("#sectionshow").html(data);

    	               
    	    		});
    	        });

    	        $("#section").change(function(){
    	            var clname = $("#clname").val();
    	            var stream = $("#streamList").val();
    	            var section = $("#section").val();
    	           
    	            $.post("<?php echo site_url('configureClassControllers/getSubject') ?>", {className : clname, stream : stream, section : section}, function(data){
    	                $("#subjectBox").html(data);
    	                
    	    		});
    	        });

    	        $("#classshow").change(function(){
    	            var classid = $("#classshow").val();
    	           // var streamid = $("#streamListshow").val();
    	          //  var sectionid = $("#sectionshow").val();
    	               //alert(classid+streamid+sectionid );
    	               // alert(classid);
    	         /*     $.ajax({
                        "url": "<?= base_url() ?>configureFeeController/getFeeHead",
                        "method": 'POST',
                        "data": {classid : classid},
                        beforeSend: function(data) {
                            $("#feeBox").html("<center><img src='<?= base_url()?>assets/images/loading.gif' /></center>")
                        },
                        success: function(data) {
                            $("#feeBox").html(data);
                        },
                        error: function(data) {
                            $("#feeBox").html(data)
                        }
                    })*/
    	      $.post("<?php echo site_url('configureFeeController/getFeeHead') ?>",{classid : classid}, function(data){
    	       //alert(data);
    	              $("#feeBox").html(data);
    	               
    	    	    });
    	        });

				        	        $.post("<?php echo site_url('index.php/configureFeeController/insertVehicle') ?>", {vehicle_name : '', vehicle_number:'', driver_name : '',dr_mobile:'', conductor_name : ''}, function(data){
				        	            $("#tranListBox").html(data);
				        			});
				        			
				        	        $("#addtransport").click(function(){
				        	            var vehicle_name = $("#vehicle_name").val();
				        	            var vehicle_number = "A"+$("#vehicle_number").val();
				        	            var driver_name = $("#driver_name").val();
				        	             var dr_mobile = $("#dr_mobile").val();
				        	            var conductor_name = $("#conductor_name").val();
				        	           
				        	            $.post("<?php echo site_url('index.php/configureFeeController/insertVehicle') ?>", {vehicle_name : vehicle_name, vehicle_number : vehicle_number, driver_name : driver_name,dr_mobile:dr_mobile ,conductor_name : conductor_name}, function(data){
				        	                $("#tranListBox").html(data);
				        	                //alert(data);
				        	    		});
				        	        });

				        	        $.post("<?php echo site_url('configureFeeController/insert_root') ?>", {vehicle_number : '', vehicle_pickup :'', drop_points : '', vahicle_root : '', transport_fee : '' }, function(data){
				        	            $("#roolist").html(data);
				        			});
				        	        $("#addrootbutton").click(function(){
				        	            var vehicle_number = $("#vehicle").val();
				        	            var vehicle_pickup = $("#vehicle_pickup").val();
				        	            var drop_points = $("#drop_points").val();
				        	            var vahicle_root = $("#vahicle_root").val();
				        	            var transport_fee = $("#transport_fee").val();
				        	           if(vehicle_number!="" && vehicle_pickup!="" && drop_points!="" && vahicle_root!="" && transport_fee!=""){
				        	           //alert(vehicle_number);
				        	            $.post("<?php echo site_url('configureFeeController/insert_root') ?>", {vehicle_number : vehicle_number, vehicle_pickup : vehicle_pickup, drop_points : drop_points, vahicle_root : vahicle_root, transport_fee : transport_fee }, function(data){
				        	                $("#roolist").html(data);
				        	                alert('Added Successfully');
				        	    		});
				        	           }else{
				        	               alert('Transport addition fail');
				        	           }
				        	        });

				        	        var input = document.getElementById("vehicle_name");
                        input.addEventListener("keyup", function () {
                        
                        });

                        input.addEventListener("keyup", function () {
                         var x = document.getElementById("vehicle_name");
                            x.value = x.value.toUpperCase();

                 }); 
                 
                  var input = document.getElementById("vehicle_number");
                        input.addEventListener("keyup", function () {
                        
                        });

                        input.addEventListener("keyup", function () {
                         var x = document.getElementById("vehicle_number");
                            x.value = x.value.toUpperCase();

                 }); 
                 
                            	        var input = document.getElementById("driver_name");
                        input.addEventListener("keyup", function () {
                        
                        });

                        input.addEventListener("keyup", function () {
                         var x = document.getElementById("driver_name");
                            x.value = x.value.toUpperCase();

                 });
                              	        var input = document.getElementById("conductor_name");
                        input.addEventListener("keyup", function () {
                        
                        });

                        input.addEventListener("keyup", function () {
                         var x = document.getElementById("conductor_name");
                            x.value = x.value.toUpperCase();

                 });
                       

         $("#reset").click(function(){
            
            var applymethod = $('#applymethod').val(); 
        if (confirm("Are you sure that you want to change your fee apply method ...If you click on RESET Button then all Your Fee Head is also Deleted")) {
        $.post("<?php echo base_url('configureFeeController/resetapply_method') ?>", {applymethod : applymethod}, function(data){
                $("#demo").html(data);
				window.location.reload();
                //alert(data);
            });
            $('#demo').val("");
         } 

        });


		

  $("#head").change(function(){
        var post_url = '<?php echo base_url() ?>configureFeeController/apply_method'
    $.ajax({
   type: "POST",
   url: post_url,
  data : { "hid" : $(this).val() },
   success: function(response){
	$.each(response, function(value, key) {
	 $("#trtrtr").html(data);
	})
}

});
});




           function isNumber(evt) {
              evt = (evt) ? evt : window.event;
              var charCode = (evt.which) ? evt.which : evt.keyCode;
              if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
              }
              return true;
            
            }
            	



                         input.addEventListener("keyup", function () {
                          var x = document.getElementById("vehicle_name");
                             x.value = x.value.toUpperCase();
                         
                  });



    var input = document.getElementById("driver_name");
                         input.addEventListener("keyup", function () {
                         var text_value = document.getElementById("driver_name").value;
                                    if (!text_value.match(/^[A-Za-z ]+$/)) {
                                        document.getElementById("name1").innerHTML = "Only Character Allow";
                                         $('#addtransport').attr('disabled', 'disabled');

                                           $(document).on('click', 'a', function(e) {
                                          if ($(this).attr('disabled') == 'disabled') {
                                             e.preventDefault();
                                                }
                                                window.location.reload();
											}); 
											
                                         
                                        document.getElementById("driver_name").focus();
                                        if (text_value == "") {
                                            document.getElementById("name").innerHTML = " ";
                                            document.getElementById("driver_name").focus();
                                            window.location.reload();
                                        }
                                    }
                         });

                         input.addEventListener("keyup", function () {
                          var x = document.getElementById("driver_name");
                             x.value = x.value.toUpperCase();
                         
                  });
                    var input = document.getElementById("conductor_name");
                         input.addEventListener("keyup", function () {
                         var text_value = document.getElementById("conductor_name").value;
                                    if (!text_value.match(/^[A-Za-z]+$/)) {
                                        document.getElementById("name2").innerHTML = "Only Character Allow";
                                         $('#addtransport').attr('disabled', 'disabled');

                                           $(document).on('click', 'a', function(e) {
                                          if ($(this).attr('disabled') == 'disabled') {
                                             e.preventDefault();
                                                }
                                                window.location.reload();
                                            });
                                         
                                        document.getElementById("conductor_name").focus();
                                        if (text_value == "") {
                                            document.getElementById("name").innerHTML = " ";
                                            document.getElementById("conductor_name").focus();
                                            window.location.reload();
                                        }
                                    }
                         });

                         input.addEventListener("keyup", function () {
                          var x = document.getElementById("conductor_name");
                             x.value = x.value.toUpperCase();
                         
                  });
  
                    		Main.init();
				SVExamples.init();
				TableExport.init();
			});

		</script>