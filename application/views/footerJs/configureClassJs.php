<!-- start: MAIN JAVASCRIPTS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/excanvas.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-1.11.1.min.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->

<!--<![endif]-->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.1.1.min.js"></script>
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
<!--<script src="<?php echo base_url(); ?>assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>-->
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
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/x-editable/js/bootstrap-editable.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/typeaheadjs/typeaheadjs.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/typeaheadjs/lib/typeahead.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-address/address.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/wysihtml5/wysihtml5.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/x-editable/demo-mock.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/x-editable/demo.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<!-- start: CORE JAVASCRIPTS  -->

<script src="<?php echo base_url(); ?>assets/js/ui-notifications.js"></script>
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>

<!-- end: CORE JAVASCRIPTS  -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/select2/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/tableExport/tableExport.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jquery.base64.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/tableExport/html2canvas.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jquery.base64.js"></script>-->
<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jspdf/libs/sprintf.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jspdf/jspdf.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/tableExport/jspdf/libs/base64.js"></script>
<script src="<?php echo base_url(); ?>assets/js/table-export.js"></script>
<script>


    jQuery(document).ready(function() {
		<!--report formate-->
		$("#rep_formate_save").click(function(){
        	var formate_rep = $('#formate_rep').val();
			$.post("<?php echo site_url('index.php/configureClassControllers/rep_formate_save') ?>", {formate_rep : formate_rep}, function(data){
               alert("Report Formate successfully Cunfigured");
    		});
        });
		
		
		
				$("#report_1").hide();
				$("#report_2").hide();
				$("#report_3").hide();
				
				
				
         $("#formate_rep").change(function(){
            var formate_rep = $("#formate_rep").val();
        if(formate_rep== 1){
			 $("#report_1").show();
			  $("#report_2").hide();
				  $("#report_3").hide();
			 }else if(formate_rep== 2){
				  $("#report_1").hide();
					$("#report_2").show();
						$("#report_3").hide();
				 }else if(formate_rep== 3){
					  $("#report_1").hide();
						$("#report_2").hide();
							$("#report_3").show();
					 }
    		});
			<!--id formate-->
			$("#id_formate_save").click(function(){
        	var formate_id = $('#formate_id').val();
			$.post("<?php echo site_url('index.php/configureClassControllers/id_formate_save') ?>", {formate_id : formate_id}, function(data){
               alert("ID Formate successfully Cunfigured");
    		});
        });
		
		
			$("#id_1").hide();
				$("#id_2").hide();
				$("#id_3").hide();
         $("#formate_id").change(function(){
            var formate_rep = $("#formate_id").val();
        if(formate_rep== 1){
			 $("#id_1").show();
			  $("#id_2").hide();
				  $("#id_3").hide();
			 }else if(formate_rep== 2){
				  $("#id_1").hide();
					$("#id_2").show();
						$("#id_3").hide();
				 }else if(formate_rep== 3){
					  $("#id_1").hide();
						$("#id_2").hide();
							$("#id_3").show();
					 }
    		});
			<!--tc formate-->
			$("#tc_formate_save").click(function(){
        	var formate_tc = $('#formate_tc').val();
			$.post("<?php echo site_url('index.php/configureClassControllers/tc_formate_save') ?>", {formate_tc : formate_tc}, function(data){
               alert("TC Formate successfully Cunfigured");
    		});
        });
		
			$("#tc_1").hide();
				$("#tc_2").hide();
				$("#tc_3").hide();
         $("#formate_tc").change(function(){
            var formate_rep = $("#formate_tc").val();
        if(formate_rep== 1){
			 $("#tc_1").show();
			  $("#tc_2").hide();
				  $("#tc_3").hide();
			 }else if(formate_rep== 2){
				  $("#tc_1").hide();
					$("#tc_2").show();
						$("#tc_3").hide();
				 }else if(formate_rep== 3){
					  $("#tc_1").hide();
						$("#tc_2").hide();
							$("#tc_3").show();
					 }
    		});
			<!--cc formate-->
			$("#cc_formate_save").click(function(){
        	var formate_cc = $('#formate_cc').val();
			$.post("<?php echo site_url('index.php/configureClassControllers/cc_formate_save') ?>", {formate_cc : formate_cc}, function(data){
               alert("CC Formate successfully Cunfigured");
    		});
        });
		
		
			$("#cc_1").hide();
				$("#cc_2").hide();
				$("#cc_3").hide();
         $("#formate_cc").change(function(){
            var formate_rep = $("#formate_cc").val();
        if(formate_rep== 1){
			 $("#cc_1").show();
			  $("#cc_2").hide();
				  $("#cc_3").hide();
			 }else if(formate_rep== 2){
				  $("#cc_1").hide();
					$("#cc_2").show();
						$("#cc_3").hide();
				 }else if(formate_rep== 3){
					  $("#cc_1").hide();
						$("#cc_2").hide();
							$("#cc_3").show();
					 }
    		});
        
        ///////////
        $.post("<?php echo site_url('index.php/configureClassControllers/addStream') ?>", {streamName : ''}, function(data){
        	
            $("#streamList1").html(data);
		});
		//------------------fee category-------------------------//
		 $.post("<?php echo site_url('index.php/configureClassControllers/addfeecategory') ?>", {streamName : ''}, function(data){
        	
            $("#feeList1").html(data);
		});
       <!---->
        $.post("<?php echo site_url('index.php/configureClassControllers/addSection') ?>", {sectionName : ''}, function(data){
            $("#sectionList").html(data);
            //alert(data);
		});

        $.post("<?php echo site_url('index.php/configureClassControllers/addClass') ?>",{
    				className : '',
    				classStream : '',
    				classSection : ''
	    			}, function(data){
            $("#classDetail").html(data);
            //alert(data);
		});
		
        $("#addStreamButton").click(function(){
        	
    		var streamName = $('#addStream').val();	
    		if(streamName==""){
    		    alert("First add Stream");
    		}else{
    		    alert("stream successfully Added");
    		}
    		
    		$.post("<?php echo site_url('index.php/configureClassControllers/addStream') ?>", {streamName : streamName}, function(data){
                $("#streamList1").html(data);
                //alert(data);
    		});
    		$('#addStream').val("");
        });
        //-----------------------------------------------//
        $("#addfeecatButton").click(function(){
        	
    		var streamName = $('#addfeecategory').val();

    		$.post("<?php echo site_url('index.php/configureClassControllers/addfeecategory') ?>", {streamName : streamName}, function(data){
                $("#feeList1").html(data);
                //alert(data);
                alert("Fee Category successfully created");
    		});
    		$('#addfeecategory').val("");
            // }else{
            //     alert("First fill Student Category");
            // }
        });
        $("#clname").change(function(){
            var streamid = $("#clname").val();
            //alert(clname);
            $.post("<?php echo site_url('index.php/configureClassControllers/getSection')?>", {streamid : streamid}, function(data){
                $("#sectionList").html(data);
                //alert(data);
    		});
        });
        
         $("#sectionList").change(function(){
            var sectionid = $("#sectionList").val();
            var streamid = $("#clname").val();
            //alert(clname);
            $.post("<?php echo site_url('index.php/configureClassControllers/getClasslist')?>", {sectionid : sectionid, streamid : streamid}, function(data){
                $("#classlist").html(data);
                //alert(data);
    		});
        });
        
         $("#classlist").change(function(){
            var classid = $("#classlist").val();
            $.ajax({
                       // "url": "<?php //echo site_url('index.php/login/getSubject') ?>",
                       "url": "<?php echo site_url('index.php/configureFeeController/getfeeheadcat') ?>",
                        "method": 'POST',
                        "data": {classid : classid},
                        beforeSend: function(data) {
                           $("#subjectBox").html("<center><img src='<?php echo base_url(); ?>assets/images/loading.gif' /></center>")
                        },
                        success: function(data) {
                            $("#subjectBox").html(data);
                        },
                        error: function(data) {
                            $("#subjectBox").html(data)
                        }
                    })

        });
        
          

		
			
			
        //---------------------------------------------------//

        $("#addSectionButton").click(function(){
    		var sectionName = $('#addSection1').val();
    		
    		if(sectionName==""){
    		    alert("First add Section");
    		}else{
    		   alert("Section Successfully Added");
    		}
    		
    		$.post("<?php echo site_url('index.php/configureClassControllers/addSection') ?>", {sectionName : sectionName}, function(data){
                $("#sectionList").html(data);
                //alert("Enter only one character then created your new section");
    		});
    		$('#addSection1').val("");
        });
        
        

        $("#classSave").click(function(){
    		var className = $("#className").val();
    		var classStream = $("#classStream").val();
    		var classSection = $("#classSection").val();
    		if(!(className == "" || classStream == "" || classSection == "")){
    			$.post("<?php echo site_url('index.php/configureClassControllers/addClass') ?>", 
    	    		{
    				className : className,
    				classStream : classStream,
    				classSection : classSection
	    			}, 
	    				function(data){
                    $("#classDetail").html(data);
        		});
        		alert("Class Successfully Added");
    		}else{
    		    alert("Please fill all field");
    		}
    		$("#className").val("");
    		$("#classStream").val("");
    		$("#classSection").val("");
        });
    
     $("#createfsd").click(function(){
          
        var startdate = $('#startdate').val();
         var enddate = $('#enddate').val(); 
        alert("FSD Successfully created");
        $.post("<?php echo site_url('index.php/configureClassControllers/addfsd') ?>", {startdate : startdate,enddate:enddate}, function(data){
            $("#showfsd").html(data);
                //alert(data);
        });
        $('#startdate').val("");
         $('#enddate').val("");
        });

      $("#Applyfsd").click(function(){
          
        var fsdid = $('#fsdselect').val();
       // conformbox('Your want to Apply new fsd');
        alert("FSD Successfully Apply");
        $.post("<?php echo site_url('index.php/allFormController/updatefsd') ?>", {fsdid : fsdid,}, function(data){
            $("#showfsd1").html(data);
                //alert(data);
        });
        $('#fsdselect').val("");
        //  $('#enddate').val("");
        });
        
       
                $("#findclass").keyup(function(){
                var findclass =  $("#findclass").val();
                $.post("<?php echo site_url('index.php/configureClassControllers/findclass') ?>", {findclass : findclass}, function(data){
                $("#classfindDetail").html(data);
                //alert(data);
                });
                });
         
                         
                
         Main.init();
        SVExamples.init();
        TableExport.init();
  
        
                  
    });


</script>