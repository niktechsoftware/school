<div class="row">
  <div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">

      <div class="panel-heading panel-pink">
        <h3 class="panel-title">Define <span class="text-bold">Home Work Details</span></h3>
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

      <div class="panel-body">
        <div class="alert alert-info">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to the Define Homework Area</h3>
         In this section you can give the homework to employees/teachers/students. if you want to give home work then select option "home work for" and give the subject name of homework 
         on work subject name box. Give some remark, define work and given date of homework and also give the submission date and give the maximum marks, class name, section, subject
         and then upload file after then submit the details.
        </div>
        <!-- <div class="table-responsive" style="width:100%; overflow-y: scroll;">
      </div> -->
          
          
         <?php $do=$this->uri->segment(3);
								if($do)
								{?>
                <h3 class="text-success"> <?php echo "Home work is given successfully";?></h3>

                <?php }?>
    
        <form action="<?php echo base_url();?>index.php/studentHWControllers/addHomeWork" method="post" enctype="multipart/form-data">
          <div class="row" style="margin-bottom:18px;">
              
            <div class="col-sm-12">

              <?php $do=$this->uri->segment(3);
								if($do)
								{?>
                <!--<span class="text-success"> <?php echo "successfully home work is Given";?></span>-->

                <?php }?>
              <div class="col-sm-6">
                <label class="col-sm-5 control-label">
                  Home Work For <span class="symbol required"></span>
                </label>
                <div class="col-sm-7">
                  <select class="form-control" name="homeworkfor" id="homeworkfor">
                    <option value="01">-Select-</option>
                    <?php $logtype = $this->session->userdata('login_type');
											if($logtype == "admin"){
											?>
                    <option value="employee">Employee</option>
                    <option value="teachers">Teachers</option>
                    <option value="students">Students</option>
                    <?php
											}
											elseif($logtype == "3"){
											?>
                    <option value="students">Students</option>
                    <?php }
											elseif($logtype == "student"){
												?>
                    <option value="students">Students</option>
                    <?php }
											elseif($logtype == "accountent"){
											?>
                    <option value="employee">Employee></option>
                    <option value="teachers">Teachers</option>
                    <option value="students">Students</option>
                    <?php	}
											 ?>
                  </select>
                </div>
                <?php echo form_error('empState'); ?>
              </div>

              <div class="col-sm-6">
                <label class="col-sm-5 control-label">
                  Work Subject Name</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="wsubjectname" id="wsubject" />
                </div>
              </div>
              </div>
              </div>
             
              <div class="row" style="margin-bottom:18px;">
              <div class="col-sm-12">
                <div class="col-sm-6">
                  <label class="col-sm-5 control-label">
                    Remark <span class="symbol required"></span>
                  </label>
                  <div class="col-sm-7">
                    <textarea rows="5" class="form-control" name="hwremark" id="hw"></textarea>
                  </div>

                </div>
                <div class="col-sm-6">
                  <label class="col-sm-5 control-label">
                    Define Work <span class="symbol required"></span>
                  </label>
                  <div class="col-sm-7">
                    <textarea rows="5" class="form-control" name="hwdefine" id="hw"></textarea>
                  </div>
                </div>
              </div>
              </div>
              
              <div class="row" style="margin-bottom:18px;">
          <div class="col-sm-12">
            <div class="col-sm-6">
             
                <div class="col-sm-5 "><label>Given Date</label></div>
                <div class="col-sm-7"><input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years"
                    name="gdate" class="form-control date-picker" required="required"></div>
              </div>
        
            <div class="col-sm-6">
             
                <div class="col-sm-5"><label>submission Date</label></div>
                <div class="col-sm-7"><input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years"
                    name="sdate" class="form-control date-picker" required="required"></div>
              </div>
            </div>
            </div>

          <div id="selectStudent">
              <div class="row" style="margin-bottom:18px;">
            <div class="col-sm-12">
              <div class="col-sm-6">
               
                  <div class="col-sm-3">
                      <label>Maximam Marks</label>
                  </div><div class="col-sm-3">
                      <input type="text" name="mm" id="mm" class="form-control">
                  </div>
				   <div class="col-sm-3">
				       <label>Grade</label>
				  </div>
				  <div class="col-sm-3">
				      <input type="text" name="grade" id="grade" class="form-control">
				  </div>
                  <!--<div class="col-sm-7"></div>-->
                </div>

              <div class="col-sm-6">
                  <div class="col-sm-5">Section</div>
                  <div class="col-sm-7">
                    <select class="form-control" id="sectionId" name="section">
                      <option value="01">-Select Section-</option>
                      
                      <?php 
                      foreach ($noc as $en):?>
                      <option value="<?php echo $en->id?>"><?php echo $en->section?></option>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>
              </div>
              </div>

        <div class="row" style="margin-bottom:18px;">
            <div class="col-sm-12" >
              <div class="col-sm-6">
                  <div class="col-sm-5"><label>Class Name</label></div>
                  <div class="col-sm-7">
                    <select name="classv" id="classv" class="form-control">
                    </select>
                  </div>
                </div>
          
              <div class="col-sm-6">
               
                  <div class="col-sm-5"><label>Subject</label></div>
                  <div class="col-sm-7">
                    <select class="form-control" id="subjectId" name="subject">
                    </select>
                  </div>
                </div>
              </div>
              </div>
              </div>
              
              <div class="row" style="margin-bottom:18px;">
            <div class="col-sm-12" >
              <div class="col-sm-6">
                
                  <div class="col-sm-5"></div>
                  <div class="col-sm-7"></div>
                </div>
                <div class="col-sm-6">
                  <div class="col-sm-5"></div>
                  <div class="col-sm-7"></div>
                </div>
              </div>
               </div>
               
               <div class="row" style="margin-bottom:18px;">
          <div class="col-sm-12">
            <div class="col-sm-6">
              
                <div class="col-sm-5"><label>Upload</label></div>
                <div class="col-sm-7"><input type="file" name="filehomeWork" class="form-control"></div>
              </div>
         
            <div class="col-sm-6">
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