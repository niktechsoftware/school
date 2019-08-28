
<div class="container">
    <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/homeController/schoolInfo/" method="post" role="form">
        <h2> School Registration Form</h2>
        <div class="form-group">
            <label for="firstName" class="col-sm-3 control-label">School Name</label>
            <div class="col-sm-9">
                <input type="text" id="schoolName" name="schoolName" placeholder="School Name" class="form-control" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="startDate" class="col-sm-3 control-label">FSD* Start</label>
            <div class="col-sm-4">
                <input type="date" id="fsdS" name="fsdS"class="form-control">
            </div>
            <label for="endDate" class="col-sm-1 control-label">End</label>
            <div class="col-sm-4">
                <input type="date" id="fsdE" name="fsdE" class="form-control">
            </div>
        </div>
        
        <div class="form-group">
            <label for="lastName" class="col-sm-3 control-label">Principal Name</label>
            <div class="col-sm-9">
                <input type="text" id="principalName" name="principalName" placeholder="Principal Name" class="form-control" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="lastName" class="col-sm-3 control-label">Wise Principal Name</label>
            <div class="col-sm-9">
                <input type="text" id="wiseprincipalName" id="wiseprincipalName" placeholder="Wise Principal Name" class="form-control" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="mobileNumber" class="col-sm-3 control-label">Mobile number </label>
            <div class="col-sm-9">
                <input type="mobileNumber" id="mobile" name="mobile" placeholder="Enter Mobile number" class="form-control">
                <span class="help-block">Your phone number won't be disclosed anywhere </span>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email* </label>
            <div class="col-sm-9">
                <input type="email" id="schemail" placeholder="Email" class="form-control" name= "schemail">
            </div>
        </div>
        <div class="form-group">
                <label for="username" class="col-sm-3 control-label">Sender ID*</label>
            <div class="col-sm-9">
                <input type="text" id="smsid" name="smsid" placeholder="SMS username" class="form-control">
            </div>
        </div>
        <div class="form-group">
                <label for="username" class="col-sm-3 control-label">Web-Url</label>
            <div class="col-sm-9">
                <input type="text" id="smsweburl" name="smsweburl" placeholder="Sms web_url" class="form-control">
            </div>
        </div>       
        <div class="form-group">
                <label for="username" class="col-sm-3 control-label">Admin Username</label>
            <div class="col-sm-9">
                <input type="text" id="username" name="username" placeholder="Admin username" class="form-control">
            </div>
        </div>
         <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Admin Password*</label>
            <div class="col-sm-9">
                <input type="password" id="password" placeholder="Admin Password" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Confirm Password*</label>
            <div class="col-sm-9">
                <input type="password" id="password" placeholder="Confifm Password" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="regisDate" class="col-sm-3 control-label">Registration Date</label>
            <div class="col-sm-9">
                <input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years" min="2018-01-01" max="Date()" id="regisDate" value="<?php echo date("Y-m-d");?>" placeholder="School Registration Date" class="form-control">
            </div>
        </div>
         <!-- /.form-group -->
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <span class="help-block">*Required fields</span>
            </div>
        </div>
        <button type="submit"  class="btn btn-primary btn-block">Register</button>
    </form> <!-- /form -->
</div> <!--container -->
<script> regisDate.max = new Date().toISOString().split("T")[0]; </script>