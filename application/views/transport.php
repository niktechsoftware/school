<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-pink">
        <h4 class="panel-title">Student Fee <span class="text-bold">Card</span></h4>
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

        <div class="alert alert-info">
          <h4 class="media-heading text-center">Welcome to Student Fee Card Area</h4>
          <p class="media-timestamp">Welcome to Student Fee Card Area,
            in this page you can view Students Fee Card
            <strong>Please select following Dropdown options and wait for Student List.</strong>
            Now Click on View Detail to show Fee Card Detail. Thanks you.......

          </p>
        </div>
        <div>
          <div id="validId"></div>

          <div class="form-group">
            <?php $school_code = $this->session->userdata("school_code");
						$detail = $this->db->query("SELECT * FROM `fsd` WHERE school_code ='$school_code' order BY id");
						if($detail->num_rows() > 0){
					?>
            <label class="col-sm-1 control-label">
              Finance Start Date <span class="symbol required"></span>
            </label>
            <div class="col-sm-2">
              <select class="form-control" id="fsd" name="fsd" style="width: 150px;">
                <option value="">Select FSD-</option>
                <?php foreach($detail->result() as $row):?>
                <option value="<?php echo $row->id;?>">
                  <?php echo date("d-M-y", strtotime($row->finance_start_date));?>
                </option>
                <?php endforeach;?>
              </select>
            </div>
            <?php } ?>
            <label class="col-sm-1 control-label">
              Section <span class="symbol required"></span>
            </label>
            <div class="col-sm-2">

              <select class="form-control" id="sectionId" name="section" style="width: 150px;">
                <option value="">Select Section</option>
                <?php foreach($request as $row):
								$sectionid=$row->section;
								$this->db->where('school_code',$school_code);
								$this->db->where('id',$sectionid);
								$section=$this->db->get('class_section')->row();
								?>
                <option value="<?php echo $section->id;?>"><?php echo $section->section;?></option>
                <?php endforeach; ?>
                <!-- <option value="all">All Class</option> -->
              </select>
            </div>
            <label class="col-sm-1 control-label">
              Class<span class="symbol required"></span>
            </label>

            <div class="col-sm-3">
              <select class="form-control" id="classv" name="class"></select>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="table-responsive" id="rahul"></div><!-- end: table-responsive -->
          </div>
        </div><!-- end: panel Body -->
      </div><!-- end: panel panel-white -->

    </div><!-- end: MAIN PANEL COL-SM-12 -->
  </div><!-- end: PAGE ROW-->