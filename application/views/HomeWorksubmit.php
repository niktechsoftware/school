<div class="min-content" style="max-height:465px;">
<div class="row">
  <div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">

      <div class="panel-heading panel-pink">
        <h3 class="panel-title">Define <span class="text-bold">Home Work Detail</span></h3>
        <div class="panel-tools">
          <div class="dropdown">
            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
              <i class="fa fa-cog"></i>
            </a>
            <ul class="dropdown-menu dropdown-light pull-right" role="menu" style="display: none;">
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
          <!-- <a class="btn btn-xs btn-link panel-close" href="#">
          <i class="fa fa-times"></i>
        </a> -->
        </div>
      </div>
     <div class="panel-body" >
        <div class="alert alert-info">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to the Submit Homework Area</h3>
          In this section student can submit the homework . if they want to
          submit home work then upload home work and fill submite date and upload his/her homework notes.
        </div>
        <!-- <div class="table-responsive" style="width:100%; overflow-y: scroll;">
      </div> -->
      <br/> <br/>
        <form action="<?php echo base_url();?>index.php/studentHWControllers/submithw" method="post" enctype="multipart/form-data">
          <div class="row" style="margin-bottom:18px;">
            <div class="col-sm-12">
              <?php  $do=$this->uri->segment(3);
								if(!$do)
								{?>
                <span class="text-success"> <?php echo "successfully home work is Submitted";?></span>

                <?php }?>
                 <input type="text" hidden="hidden" name="work_id" value="<?php echo $do;?>">
              <!--<div class="col-sm-6">
           
                <label class="col-sm-5 control-label">
                  Submit Home Work From <span class="symbol required"></span>
                </label>
               <div class="col-sm-7">
                  <select class="form-control" name="homeworkfor" id="homeworkfor">
                    <option value="01">-Select-</option>
                    <?php // $logtype = $this->session->userdata('login_type');
										 //	if($logtype == "admin"){
											?>
                    <option value="employee">Employee</option>
                    <option value="teachers">Teachers</option>
                    <option value="students">Students</option>
                    <?php
										//	}
										//	elseif($logtype == "3"){
											?>
                    <option value="teachers">Teachers</option>
                    <?php //}
                                            //elseif($logtype == "2"){
                        					?>
                    <option value="employee">Employee</option>
                    <?php // }
										//	elseif($logtype == "student"){
												?>
                    <option value="students">Students</option>
                    <?php //}
										//	elseif($logtype == "accountent"){
											?>
                    <option value="employee">Employee></option>
                    <option value="teachers">Teachers</option>
                    <option value="students">Students</option>
                    <?php//	}
											 ?>
                  </select>
                </div>
                </div>-->
                <?php echo form_error('empState'); ?>
             <div class="col-sm-6">
               <div class="col-sm-5"><label>Upload Home Work</label></div>
                <div class="col-sm-7"><input type="file" name="filehomeWork" class="form-control" required="required"></div>
              </div>
            <div class="col-sm-4">
                <label class="col-sm-5 control-label">
                  Submittion Date</label>
                <div class="col-sm-7">
                  <input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years"
                    name="sdate" class="form-control date-picker" required="required">
                </div>
              </div>
                <div class="col-sm-2">
              <div class="col-sm-5">&nbsp</div>
                <div class="col-sm-7"><button class="btn btn-green pull-right" type="submit">SUBMIT</button></div>
            </div>
          </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>