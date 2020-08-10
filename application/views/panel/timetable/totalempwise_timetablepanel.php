<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-red">
        <h4 class="panel-title">Teacherwise <span class="text-bold">Timetable Report</span></h4>
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

    
  <div class="panel-body">
       <div class="text-white text-large">
        <div class="col-sm-4">
<select id="teachertime" class="form-control">
                              <option value="">Select Teacher Name</option><?php
                              $school=$this->session->userdata("school_code");
                              $this->db->where('school_code',$school);
                            $emp= $this->db->get('employee_info')->result();
                            foreach($emp as $data)
                            {
                                ?>
                            
                              <option value="<?php echo $data->id;?>"><?php echo $data->name;?>&nbsp;&nbsp;(<?php echo $data->username;?>)</option>
                              <?php
                             } ?>
                            </select>
</div>
                          
<input type="submit" value="submit" id="teachertimetablebutton" style="background-color:blue; color:white; height:30px;">

</div></div>


				 <div class="col-sm-12">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-blue border-light">
                          <h4 class="panel-title">Teacherwise Timetable list</h4>
                        </div>
                        <div class="panel-body" id="teachertimetablelist">

                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        

