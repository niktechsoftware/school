<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-red">
        <h4 class="panel-title">Student Wise <span class="text-bold">Attendance Report</span></h4>
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
       <div class="text-white text-large">
        <?php $school_code = $this->session->userdata("school_code");
            $detail = $this->db->query("SELECT * FROM `fsd` WHERE school_code ='$school_code' order BY id");
            if($detail->num_rows() > 0){
          ?>
            <label class="col-sm-2 control-label">
              Finance Start Date <span class="symbol required"></span>
            </label>
            <div class="col-sm-3">
              <select class="form-control" id="fsd" name="fsd" style="width: 250px;">
                <option value="">Select FSD-</option>
                <?php foreach($detail->result() as $row):?>
                <option value="<?php echo $row->id;?>">
                  <?php echo date("d-M-y", strtotime($row->finance_start_date));?>
                </option>
                <?php endforeach;?>
              </select>
            </div>
            <?php } ?>
      


        <div class="col-sm-3">
<input type="text" name="stdid" placeholder="Enter Student Id" class="form-control" id="stdtimetable"></div>
<div class="col-sm-2">
<input type="submit" value="submit" id="stdattendancebutton" class="btn btn-primary form-control"></div>



</div></div>
 <div class="panel-body">

				 <div class="col-sm-12">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-blue border-light">
                          <h4 class="panel-title">Student Attendance list</h4>
                        </div>

                        <div class="panel-body" id="attendancelist">
                        </div>
                    </div>
                </div>
              </div>
              <div class="col-md-4" id ="validId">
            </div>
          </div>
        </div>
        </table>