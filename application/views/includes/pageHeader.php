<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
  box-sizing:border-box;
}
.button_responsive{
  padding:5px;
  float:left;
  width:12%; /* The width is 20%, by default */
}
/* Use a media query to add a break point at 800px: */
@media screen and (max-width:800px) {
  .button_responsive {
    width:100%; /* The width is 100%, when the viewport is 800px or smaller */
  }
}
</style>
<!-- start: MAIN CONTAINER -->
<div class="main-container inner">
<?php $school_code = $this->session->userdata("school_code");?>
<!-- start: PAGE -->
<div class="main-content">
<!-- start: PANEL CONFIGURATION MODAL FORM -->
<div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Panel Configuration</h4>
            </div>
            <div class="modal-body">
                Here will be a configuration form
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary">
                    Save changes
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- end: SPANEL CONFIGURATION MODAL FORM -->
<div class="container">
<!-- start: PAGE HEADER -->
<!-- start: TOOLBAR -->
<div class="toolbar row">
    <div class="col-sm-3 hidden-xs">
        <div class="page-header">
            <h1><?php echo $pageTitle; ?> <small><?php echo $smallTitle; ?> </small></h1>
        </div>
    </div>
    <?php if($this->session->userdata("login_type") !=  "student"){?>
    <div class="col-sm-6 hidden-xs" style="margin-top:04px; font-size:18px;">
        <center><a class="" style="color: #f5f5f5;" href="#">Customer Care:<br><i class="fa fa-phone"></i>+91-&nbsp;9454012026,&nbsp;8765398096,&nbsp;9580121878
                <br>WhatsApp Number&nbsp;: <i class="fab fa-whatsapp"></i>+91-&nbsp;9580121878</a></center>
    </div>
    <?php }?>
    <!--<?php if($this->session->userdata("login_type")=="admin"){?>

     <div class="col-sm-3" style="margin-top:15px;">
        <div class="page-header">
        <?php 
       // $this->db->where("school_code",$school_code);
	//	$sender=$this->db->get("sms_setting")->row(); 
        // $sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"))->row(); ?>
        <a class="button_blink" href="#">Remaining SMS&nbsp;<br>
        </div>
    </div>
    <?php } ?>-->
    <!--    <div class="col-sm-3 hidden-xs center">-->
    <!--    <div class="page-header">-->
    <!--        <small>Download our Android App <i class="fa fa-refresh fa-spin"></i> -->
    <!--        <h1> <a href="<?php echo base_url();?>assets/apk/niktech_software.apk" target="_blank" style="color:white;"><i class="fa fa-download"></i></a></h1>-->
    <!--        </small>-->
            
    <!--    </div>-->
    <!--</div>-->
    <?php if(($this->session->userdata('login_type') == 'admin') ||($this->session->userdata('login_type') == '1')){?> 
      <!--<a class="sb-toggle-left hidden-md hidden-lg" href="#main-navbar">
            <i class="fa fa-bars"></i> &nbsp;   &nbsp;
            </a>-->
   <div class="toolbar-tools pull-right">
       
									<!-- start: TOP NAVIGATION MENU -->
									<ul class="nav navbar-right" style="margin-right:10px;">
										<!-- start: TO-DO DROPDOWN -->
										<li class="dropdown">
											<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
												<i class="fa fa-plus"></i><b> QUICK REPORT</b>
												<div class="tooltip-notification hide">
													<div class="tooltip-notification-arrow"></div>
													<div class="tooltip-notification-inner">
														<div>
														<div class="semi-bold">
																HI THERE!
															</div>
															<div class="message">
																Try Quick Report
															</div>
														</div>
													</div>
												</div>
											</a>
											<ul class="dropdown-menu dropdown-light dropdown-subview">
											
												<li style="background-color:lightgray;">
													<a href="<?php echo base_url(); ?>index.php/smsAjax/smsPanel" class="new-note"><span class="fa-stack"> <i class="fa fa-comments fa-stack-1x fa-lg"></i></span>Sms Panel</a>
												</li>
												<li style="background-color:lightgray;">
													<a href="<?php echo base_url(); ?>index.php/studentController/studentPanel" class="read-all-notes"><span class="fa-stack"> <i class="fa fa-users fa-stack-1x fa-lg"></i> </span>Student Panel</a>
												</li>
												<li style="background-color:lightgray;">
													<a href="<?php echo base_url(); ?>index.php/exampanel" class="new-event"><span class="fa-stack"> <i class="fa fa-book fa-stack-1x fa-lg"></i></span>Exam Detail</a>
												</li>
												<li style="background-color:lightgray;">
													<a href="<?php echo base_url(); ?>index.php/attendancepanel" class="show-calendar"><span class="fa-stack"> <i class="fa fa-calendar-o fa-stack-1x fa-lg"></i></span>Attendance Report</a>
												</li>
												<li style="background-color:lightgray;">
													<a href="<?php echo base_url(); ?>index.php/feepanel" class="new-contributor"><span class="fa-stack"> <i class="fa fa-money fa-stack-1x fa-lg"></i> </span>Fee Report</a>
												</li>
												<li style="background-color:lightgray;">
													<a href="<?php echo base_url(); ?>index.php/homeworkpanel" class="show-contributors"><span class="fa-stack"> <i class="fa fa-file-text-o fa-stack-1x fa-lg"></i> </span>Home Work</a>
												</li>
													<li style="background-color:lightgray;">
													<a href="<?php echo base_url(); ?>index.php/timetablepanel" class="new-contributor"><span class="fa-stack"> <i class="fa fa-clock-o fa-stack-1x fa-lg"></i> </span>Time Table</a>
												</li>
												<li style="background-color:lightgray;">
													<a href="<?php echo base_url();?>index.php/login/quickRegistraionStudent" class="show-contributors"><span class="fa-stack"> <i class="fa fa-user fa-stack-1x fa-lg"></i></span>Quick Admission</a>
												</li>
													<li style="background-color:lightgray;">
													<a href="<?php echo base_url(); ?>index.php/login/collectFee" class="new-contributor"><span class="fa-stack"> <i class="fa fa-rupee fa-stack-1x fa-lg"></i> </span>Collect Fee</a>
												</li>
												<li style="background-color:lightgray;">
													<a href="<?php echo base_url(); ?>index.php/login/simpleSearchStudent" class="show-contributors"><span class="fa-stack"> <i class="fa  fa-search fa-stack-1x fa-lg"></i> </span>Search Student</a>
												</li>
											</ul>
										</li>
										<li class="dropdown">
											<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
												<span class="messages-count badge badge-default hide">3</span> <i class="fa fa-envelope"></i> BUY SMS
											</a>
											<ul class="dropdown-menu dropdown-light dropdown-messages">
												<li>
												</li>
												<li>
													<div class="drop-down-wrapper ps-container">
														<ul>
														<li style="background-color:lightgray;">
													<a href="<?php echo base_url(); ?>index.php/login/mobileNotice/buysms" class="new-note"><span class="fa-stack"></span><h4 style="font-size:18px;">Buy SMS</h4></a>
												</li>
													<li style="background-color:lightgray;">
													<a href="<?php echo base_url(); ?>index.php/login/mobileNotice/requestsms" class="new-note"><span class="fa-stack"></span><h4 style="font-size:18px;">Request Offline</h4></a>
												</li>
															
														</ul>
													</div>
												</li>
											</ul>
										</li>
	</div>
										
       <?php } ?>
</div>
    <!-- <div class="row">
        <div class="col-lg-12">
            <div class="col-md-4"><div><a class="button_blink" href="#">Remaining SMS&nbsp;<br>// echo $cbs;?></a></div></div>
            <div class="col-md-3"><div><a class="button_blink" href="#">&nbsp;</a></div></div>
            <div class="col-md-5"><div><a class="button_blink" href="#">Customer Care:&nbsp;<br>+91-&nbsp;6389027901,&nbsp;6389027902,&nbsp;6389027904,&nbsp;6389027905</a></div></div>
        </div>
    </div> -->


<!-- end: TOOLBAR -->
<!-- end: PAGE HEADER -->
<!-- start: BREADCRUMB -->
<div class="container">
<div class="row">
    <div class="col-md-12">

        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <?php echo $mainPage; ?>
                </a>
            </li>
            <li class="active">
                <?php echo $subPage; ?>
            </li>
        </ol>
<!--
             

        <a class="button_responsive btn btn-grey" style="margin:3px;" href="<?php echo base_url(); ?>index.php/smsAjax/smsPanel">SMS Panel</a>
        <a class="button_responsive btn btn-orange" style="margin:3px;" href="<?php echo base_url(); ?>index.php/studentController/studentPanel">Student Panel</a>
        <a style="margin:3px;" class="button_responsive btn btn-green" href="<?php echo base_url(); ?>index.php/exampanel">Exam Detail</a>
        <a  style="margin:3px;" class="button_responsive btn btn-purple" href="<?php echo base_url(); ?>index.php/attendancepanel">Attendance Report</a>
        <a style="margin:3px;" class="button_responsive btn btn-dark-beige" href="<?php echo base_url(); ?>index.php/feepanel">Fee Report</a>
        <a style="margin:3px;" class=" button_responsive btn btn-dark-azure" href="<?php echo base_url(); ?>index.php/homeworkpanel">Home Work</a>
        <a style="margin:3px;" class="button_responsive btn btn-dark-yellow" href="<?php echo base_url(); ?>index.php/timetablepanel">Time Table</a>
        <a style="margin:3px;" class="button_responsive btn btn-danger" href="<?php echo base_url();?>index.php/login/quickRegistraionStudent">Quick Admission</a>
        <a style="margin:3px;" class="button_responsive btn btn-danger" href="<?php echo base_url(); ?>index.php/login/collectFee">Collect Fee</a>
        <a href="<?php echo base_url(); ?>index.php/login/simpleSearchStudent"  class="button_responsive btn btn-dark-purple" target="_blanck">Search Student </a>
                     
        <!-- Student Registration</a> -->

      
    </div>
</div>

 <br>