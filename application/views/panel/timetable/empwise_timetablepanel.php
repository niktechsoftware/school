<form action="<?php echo base_url();?>index.php/timetablepanel/ttableprint"  method ="post">

<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-red">
        <h4 class="panel-title">Employee wise <span class="text-bold">Timetable Report</span></h4>
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
          <a class="btn btn-xs btn-link panel-close" href="#">
            <i class="fa fa-times"></i>
          </a>
        </div>
      </div>
      <div class="panel-body">

<div class="alert alert-info"> <h3 class="media-heading text-center">Welcome to Employee wise Timetable Report</h3>
<p class="media-timestamp">

</p>
</div>
      <div class="row space20">
          <div class="col-sm-6">
                          
          <label class="col-sm-4 control-label">
              Enter Teacher ID<span class="symbol required"></span>
            </label>

            <div class="col-sm-8">

<input type="text" name="teacherid" placeholder="Enter Teacher Id" id="teachertimetable">
<!-- <input type="submit" value="submit" id="teachertimetablebutton" style="background-color:blue; color:white; height:30px;"> -->
</div>
</div>
<div class="col-md-6" id ="validId"></div>
</div>
</div>


				 <!-- <div class="col-sm-12">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-blue border-light">
                          <h4 class="panel-title">Teacher Timetable list</h4>
                        </div>
                        <div class="panel-body" id="tchertimetablelist">

                        </div>
                    </div>
                </div> -->
           
               
            </div>
          </div>
        </div>
</form>
