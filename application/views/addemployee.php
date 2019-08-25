<div class="row">
  <div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">

      <div class="panel-heading panel-pink">
        <h3 class="panel-title"> <span class="text-bold">Employee Registration <a class="btn btn-success"
              href="<?php echo base_url();?>index.php/employeeController/quickreg">Quick Registration</a></span></h3>
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
          <h3 class="media-heading text-center">Welcome to Employee Registration</h3>
         This is Employee Registration Area.If you want a membership in this School Management Software,first of all filling in the correct information in the box below.
        You can also do Quick Registration on click Quick Registration button.Thank you
        </div>

        <form action="<?php echo base_url();?>index.php/employeeController/addEmpInfo" method="post" role="form"
          class="form-horizontal" id="form">
          <div class="panel-heading panel-green">
            <span class="panel-title">Employee <span class="text-bold">Information</span></h4>
          </div>
          <div class="panel-body text-uppercase">
            <div id="wizard" class="swMain">
              <div class="form-group">
                <div class="col-sm-5">
                  <label class="col-sm-5">
                    Name <span class="symbol required"></span>
                  </label>
                  <div class="col-sm-7">
                    <input type="text" onkeyup="namevalidation();" class="form-control text-uppercase"  maxlength="20"  minlength="5" id="empFirstName"
                      name="empName" value="<?php echo set_value('empFirstName'); ?>" required="required" />
                    <!-- <span  class="text-danger" id="fname"></span> -->
                  </div>
                  <?php echo form_error('empFirstName'); ?>
                </div>
                <div class="col-sm-5">
                  <label class="col-sm-5">
                    Job Title <span class="symbol required"></span>
                  </label>
                  <div class="col-sm-7">
                    <input type="text" onkeyup="jobtitle();"  maxlength="10"  minlength="5"  value="<?php echo set_value('jobTitle'); ?>"
                      class="text-uppercase form-control" id="jobTitle" name="jobTitle" required="required" />
                  </div>
                  <?php echo form_error('jobTitle'); ?>
                </div>

              </div>

              <div class="form-group">
                <div class="col-sm-5">
                  <label class="col-sm-5">
                    Job Category <span class="symbol required"></span>
                  </label>
                  <div class="col-sm-7">
                    <select class="form-control text-uppercase" id="jobCategory" name="jobCategory"
                      value="<?php echo set_value('jobCategory'); ?>" required="required">
                      <option value="0">-Category-</option>
                      <option value="1">Accountant</option>
                      <option value="2">Employee</option>
                      <option value="3">Teacher</option>
                      <option value="9">Principal</option>
                    </select>
                  </div>
                  <?php echo form_error('jobCategory'); ?>
                </div>
                <div class="col-sm-5">
                  <label class="col-sm-5">
                    Address <span class="symbol required"></span>
                  </label>
                  <div class="col-sm-7">
                    <input type="text" onkeyup="Address();" class="form-control text-uppercase"   maxlength="30"  minlength="10" id="employeeAddLine1"
                      name="employeeAddLine1" value="<?php echo set_value('employeeAddLine1'); ?>"
                      required="required" />
                  </div>
                  <?php echo form_error('employeeAddLine1'); ?>
                </div>

              </div>

              <div class="form-group">
                <div class="col-sm-5">
                  <label class="col-sm-5">
                    State <span class="symbol required"></span>
                  </label>
                  <div class="col-sm-7">
                    <select class="form-control text-uppercase" id="empState" name="empState"
                      value="<?php echo set_value('empState'); ?>" required="required">
                      <option value="">-State-</option>
                      <?php foreach($state as $row):?>
                      <option value="<?php echo $row->state; ?>"><?php echo $row->state; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <?php echo form_error('empState'); ?>
                </div>
                <div class="col-sm-5">
                  <label class="col-sm-5">
                    City <span class="symbol required"></span>
                  </label>
                  <div class="col-sm-7">
                    <select class="form-control text-uppercase" id="empCity" name="empCity"
                      value="<?php echo set_value('empCity'); ?>" required="required">
                    </select>
                  </div>
                  <?php echo form_error('empCity'); ?>
                </div>
              </div>

              <div class="form-group">

                <div class="col-sm-5">
                  <label class="col-sm-5">
                    Street/Area <span class="symbol required"></span>
                  </label>
                  <div class="col-sm-7">
                    <select class="form-control text-uppercase" id="area" name="employeeAddLine2"
                      value="<?php echo set_value('employeeAddLine2'); ?>" required="required">
                    </select>
                  </div>
                  <?php echo form_error('employeeAddLine2'); ?>
                </div>
                <div class="col-sm-5">
                  <label class="col-sm-5">
                    Pin
                  </label>
                  <div class="col-sm-7">
                    <input type="text" onkeyup="pinvalidation();" minLength="6" maxLength="6"  onkeypress="return isNumber(event)"  class="form-control"
                      id="empPin" name="empPin" value="<?php echo set_value('empPin'); ?>" required="required">
                    <span class="symbol require text-danger" id="pin"></span>
                  </div>
                  <?php echo form_error('empPin'); ?>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-5">
                  <label class="col-sm-5">
                    Date Of Birth <span class="symbol required"></span>
                  </label>
                  <div class="col-sm-7">
                    <input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years" id="empDob"
                      name="empDob" value="<?php echo set_value('empDob'); ?>"   min="1950-01-01" max="2001-06-30" onchange="checkDOB()" class="form-control date-picker"
                      required="required" />
                  </div>
                  <?php echo form_error('empDob'); ?>
                  <span id="valid" style="color:red"></span>
                </div>
                <div class="col-sm-5">
                  <label class="col-sm-5">
                    Country
                  </label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control text-uppercase" id="empCountry" name="empCountry"
                      value="India" value="<?php echo set_value('empCountry'); ?>" />
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-5">
    				<label class="col-sm-5">
    					Gender <span class="symbol required"></span>
    				</label>
    				<div class="col-sm-7">
    					<label class="radio-inline">
    						<input type="radio" class="grey" value="0" name="gender" value="<?php echo set_value('gender'); ?>" id="gender">
    						Female
    					</label>
    					<label class="radio-inline">
    						<input type="radio" class="grey" value="1" name="gender" value="<?php echo set_value('gender'); ?>"  id="gender">
    						Male
    					</label>
    				</div>
    				<?php echo form_error('gender'); ?>
    			</div>
                <div class="col-sm-5">
                  <label class="col-sm-5">
                    Mobile Number <span class="symbol required"></span>
                  </label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" minLength="10" maxLength="10" id="empmobileNumber"
                      value="<?php echo set_value('empmobileNumber'); ?>" name="empmobileNumber"
                      onkeyup="mobilevalidation();" required="required" 
                      onkeypress="return isNumber(event)" pattern="[6-9]{1}[0-9]{9}">
                    <span class="text-danger" id="mobile"></span>
                  </div>
                  <?php echo form_error('empmobileNumber'); ?>
                </div>

              </div>
              <div class="form-group">
                <div class="col-sm-5">
                  <label class="col-sm-5">
                    Category
                  </label>
                  <div class="col-sm-7">
                    <select class="form-control text-uppercase" id="empCategory" name="empCategory">
                      <option value="GEN">-Category-</option>
                      <option value="GEN">GEN</option>
                      <option value="OBC">OBC</option>
                      <option value="SC">SC</option>
                      <option value="ST">ST</option>

                    </select>
                  </div>
                </div>
                <div class="col-sm-5">
                  <label class="col-sm-5">
                    Alternate Number
                  </label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control"   onkeypress="return isNumber(event)"  minLength="10" maxLength="10"
                      onkeyup="altmobilevalidation();" pattern="[6-9]{1}[0-9]{9}" id="empPhoneNumber"
                      name="empPhoneNumber" value="<?php echo set_value('empPhoneNumber'); ?>">
                    <span class="text-danger" id="altmobile"></span>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-5">
                  <label class="col-sm-5">
                    Highest Qualification
                  </label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control text-uppercase" id="empQualification" maxLength="12" minLength="2" onkeypress="return isAplha(event)" minlenght="3"  name="empQualification"
                      value="<?php echo set_value('empQualification'); ?>">
                  </div>
                </div>
                <div class="col-sm-5">
                  <label class="col-sm-5">
                    Experience (Years) <span class="symbol required"></span>
                  </label>
                  <div class="col-sm-7">
                    <select class="form-control" id="experience" name="experience"
                      value="<?php echo set_value('experience'); ?>">
                      <option value="">-Experience-</option>
                      <?php for($i = 0;$i<=10; $i++): ?>
                      <option value="<?php if($i == 1){echo $i." Year";}else{echo $i." Years";}?>">
                        <?php if($i == 1){echo $i." Year";}else{echo $i." Years";}?></option>
                      <?php endfor; ?>
                    </select>
                  </div>
                  <?php echo form_error('experience'); ?>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-5">
                  <label class="col-sm-5">
                    Joining Date <span class="symbol required"></span>
                  </label>
                  <div class="col-sm-7">
                    <input type="date" data-date-format="yyyy-mm-dd"  onchange="checkjoin()" data-date-viewmode="years" id="j_date"
                      name="j_date" value="<?php echo set_value('j_date'); ?>" class="form-control date-picker"
                      required="required" />
                  </div>
                  <?php echo form_error('j_date'); ?>
                </div>
                <div class="col-sm-5">
                  <label class="col-sm-5">
                    Email
                  </label>
                  <div class="col-sm-7">
                    <input type="email" onkeyup="EmailId();" class="form-control" id="empemail" name="empemail"
                      value="<?php echo set_value('empemail'); ?>">
                    <span class="text-danger" id="email"></span>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- end: BODY PANEL -->
      </div>
      <!-- end: FORM WIZARD PANEL -->
    </div>
  </div>
</div>
<!-- ------------------------------------------------ BANK DETAIL --------------------------------------------- -->
<div class="row text-uppercase">
  <div class="col-sm-12">
    <!-- start: FORM WIZARD PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-azure">
        <h4 class="panel-title">Bank <span class="text-bold">Detail</span> (Optional Update Later) </h4>

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
        <div class="form-group">
          <div class="col-sm-5">
            <label class="col-sm-5 control-label">
              Bank Name
            </label>
            <div class="col-sm-7">
              <input type="text" onkeyup="bankname();"  class="form-control text-uppercase" minLength="3" maxLength="12" id="empBnakName"
                name="empBnakName" value="<?php echo set_value('empBnakName'); ?>">
            </div>
          </div>

          <div class="col-sm-5">
            <label class="col-sm-5 control-label">
              Account Number
            </label>
            <div class="col-sm-7">
              <input type="text" onkeyup="accnumber();" class="form-control" id="empAccountNumber"   onkeypress="return isNumber(event)" minlength="5" maxlength="15"
                name="empAccountNumber" value="<?php echo set_value('empAccountNumber'); ?>">
            </div>
          </div>
        </div>
        <br>
        <br>
        <div class="form-group">
          <div class="col-sm-5">
            <label class="col-sm-5 control-label">
              IFSC Code
            </label>

            <div class="col-sm-7">
              <input type="text" onkeyup="ifsccode();" class="form-control text-uppercase" minLength="8" maxLength="15"  id="empIfscCode"
                name="empIfscCode" value="<?php echo set_value('empIfscCode'); ?>">
            </div>
          </div>

          <div class="col-sm-5">
            <label class="col-sm-5 control-label">
              Branch Name
            </label>

            <div class="col-sm-7">
              <input type="text" onkeyup="branchname();"  onkeypress="return isAplha(event)"  minLength="8" maxLength="15" class="form-control text-uppercase" id="empBranchName"
                name="empBranchName" value="<?php echo set_value('empBranchName'); ?>">

            </div>
          </div>
        </div>
        <br>
        <br>

        <div class="form-group">

          <div class="col-sm-5">
            <label class="col-sm-5 control-label">
              Bank Address
            </label>

            <div class="col-sm-7">
              <input type="text"  minLength="8" maxLength="15"   class="form-control text-uppercase" id="empBankAddress"
                name="empBankAddress" value="<?php echo set_value('empBankAddress'); ?>">
            </div>
          </div>

          <div class="col-sm-5">
            <label class="col-sm-5 control-label">
              Payee Name
            </label>

            <div class="col-sm-7">
              <input type="text"  onkeypress="return isAplha(event)"  minLength="8" maxLength="12" class="form-control text-uppercase" id="empPayeeName"
                name="empPayeeName" value="<?php echo set_value('empPayeeName'); ?>">

            </div>
          </div>
        </div>
        <br>
        <br>
        <!-- end: FORM WIZARD PANEL -->
      </div>
    </div>
  </div>
</div>
<!-- ------------------------------------------------ LOGIN INFORMATION --------------------------------------------- -->
<div class="row">
  <div class="col-sm-12">
    <!-- start: FORM WIZARD PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-red">
        <h4 class="panel-title"><span class="text-bold">Login Information</span></h4>

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
        <div class="form-group">
          <div class="col-sm-5">
            <label class="col-sm-5 control-label text-uppercase">
              Password <span class="symbol required"></span>
            </label>
            <div class="col-sm-7">
              <input type="password" class="form-control" id="password" name="password" required="required">
            </div>
            <?php echo form_error('password'); ?>
          </div>
          <div class="col-sm-5">
            <label class="col-sm-5 control-label text-uppercase">
              Re-Password <span class="symbol required"></span>
            </label>
            <div class="col-sm-7">
              <input type="password" onkeyup="check();" class="form-control" id="re-password" name="re-password"
                required="required">
              <span id="cpass"></span>
            </div>
            <?php echo form_error('re-password'); ?>
          </div>
        </div>
        <br>
        <br>
        <div class="form-group">
                  
          <div class="col-sm-2 col-sm-offset-8">
            <input type="submit" class="btn btn-blue next-step btn-block" value="Save Employee" />
          </div>
        </div>
      </div>
      
    </div>
  </div>
  <!-- end: FORM WIZARD PANEL -->
</div>
</form>