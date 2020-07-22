
<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-pink">
        <h4 class="panel-title">Classwise <span class="text-bold">Timetable Report</span></h4>
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

     <div class="row">
                      <div class="col-sm-4">
                        <div class="panel-heading panel-red border-light">
                          <h4 class="panel-title">Stream Name</h4>
                        </div>
                        <div class="panel-body">
                          <div class="form-group">
                            <select id="clname" class="form-control">
                              <option value="">Select Stream Name</option>
                                                            <?php 
                                                            $school_code = $this->session->userdata("school_code");
                  $StreamList = $this->db->query("SELECT DISTINCT stream from class_info where school_code='$school_code' ORDER BY id");
                                                            ?>


                              <?php if(isset($StreamList)){?>
                              <?php foreach ($StreamList->result() as $row){
                                 
                                  $streamid=$row->stream;
                                 $this->db->where('id',$streamid);
                                $row2=$this->db->get('stream')->row(); 
                                                                ?>
                              <option value="<?php echo $row2->id;?>"><?php echo $row2->stream;?></option>
                              <?php } }?>
                            </select>
                          </div>
                          <div class="text-red text-small">Please select a Stream, Section and Class will automatically come select and promote your student.</div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="panel-heading panel-green border-light">
                          <h4 class="panel-title">Section</h4>
                        </div>
                        <div class="panel-body">
                          <div class="form-group">
                            <select id="sectionList" class="form-control">
                              
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="panel-heading panel-blue border-light">
                          <h4 class="panel-title"> Class</h4>
                        </div>
                        <div class="panel-body">
                          <div class="form-group">
                            <select id="classlist" class="form-control">
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive" style="width:100%; overflow-y: scroll;">
                        <div id=sample_rahul>
                          
                        </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>

              