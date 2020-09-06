<div class="row">
  <div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-red">
        <h4 class="panel-title">Attendance <span class="text-bold">Table</span></h4>
        <div class="panel-tools">
          <div class="dropdown">
            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
              <i class="fa fa-cog"></i>
            </a>
            <ul class="dropdown-menu dropdown-light pull-right" role="menu">
              <li>
                <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
              </li>
              <li>
                <a class="panel-refresh" href="#">
                  <i class="fa fa-refresh"></i> <span>Refresh</span>
                </a>
              </li>
              <li>
                <a class="panel-config" href="#panel-config" data-toggle="modal">
                  <i class="fa fa-wrench"></i> <span>Configurations</span>
                </a>
              </li>
              <li>
                <a class="panel-expand" href="#">
                  <i class="fa fa-expand"></i> <span>Fullscreen</span>
                </a>
              </li>
            </ul>
          </div>

        </div>
      </div>
      <div class="panel-body">
        <div class="alert alert-info">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to Student Attendance</h3>
          <p class="media-timestamp">Here you can see Student Attendance shift wise.If you want to see Morning Attendance of any Student then click on Morning Attendance 
          Button Other wise click on After Lunch Button.
        </div>
        <div class="padding-20 core-content">
          <a href="<?php echo base_url(); ?>index.php/login/studentAttendance1">
            <button class="btn btn-dark-green">Morning Attendance <i class="fa fa-arrow-circle-right"></i></button>
          </a>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="<?php echo base_url(); ?>index.php/login/studentAttendance2">
            <button class="btn btn-dark-blue">After Lunch <i class="fa fa-arrow-circle-right"></i></button>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- end: PAGE CONTENT-->