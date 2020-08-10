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
  // quickform js

  $(function()
{
    $("#myform").validate(
      {
        rules: 
        {
          items: 
          {
            required: true,
            min:1
          },
          mobvalid:
          {
            range:[0,10]
          },
          factor:
          {
            required: true,
            range:[0.08,0.09]  
          },
          dullness:
          {
            required: true,
            range:[-9.5,11.1]
          }
        }
      }); 
});

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