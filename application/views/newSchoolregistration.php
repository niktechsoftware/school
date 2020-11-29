<style>
.control-label{
  color:2134F3;  
}

</style>
<div class="container">
    <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/homeController/schoolInfo/" method="post" role="form" style="background-color:white;">
        <h2 style="color:#C70039 ;"> School Registration Form</h2>
        <br/>
        <div class="form-group">
            <label for="firstName" class="col-sm-3 control-label" style="color:blue;">School Name</label>
            <div class="col-sm-9">
                <input type="text" id="schoolName" name="schoolName" placeholder="School Name" class="form-control" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="startDate" class="col-sm-3 control-label" >FSD* Start</label>
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
                <span class="help-block" style="color:red;">Your phone number won't be disclosed anywhere </span>
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
         <h2 style="color:red;">School Information</h2>
          <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Customer Id*</label>
            <div class="col-sm-9">
                <input type="text" id="cid" name="cid" placeholder="Customer Id" class="form-control">
            </div>
        </div>
         <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Address 1*</label>
            <div class="col-sm-9">
                <input type="text" id="address1" name="address1" placeholder="Address 1" class="form-control">
            </div>
        </div>
         <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Address 2*</label>
            <div class="col-sm-9">
                <input type="text" id="address2" name="address2" placeholder="Address 2" class="form-control">
            </div>
        </div>
         <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Mobile No*</label>
            <div class="col-sm-9">
                <input type="text" id="mobile" name="mobile" placeholder="Mobile No" class="form-control">
            </div>
        </div>
         <div class="form-group">
            <label for="password" class="col-sm-3 control-label">State*</label>
            <div class="col-sm-9">
                <input type="text" id="state" name="state"placeholder="State" class="form-control">
            </div>
        </div>
         <div class="form-group">
            <label for="pin" class="col-sm-3 control-label">Pin Code*</label>
            <div class="col-sm-9">
                <input type="text" id="pin"  name="pin"placeholder="Pin Code" class="form-control">
            </div>
        </div>
        <h2 style="color:red;">SMS DETAIL</h2>
         <div class="form-group">
            <label for="smsweburl" class="col-sm-3 control-label">SMS USER NAME*</label>
            <div class="col-sm-9">
                <input type="text" id="uname" name="uname" placeholder="SMS USER NAME" class="form-control">
            </div>
        </div>
         <div class="form-group">
            <label for="password" class="col-sm-3 control-label">SMS password*</label>
            <div class="col-sm-9">
                <input type="text" id="spassword"  name="smspassword" placeholder="SMS password" class="form-control">
            </div>
        </div>
         <div class="form-group">
            <label for="password" class="col-sm-3 control-label">SMS SENDER ID*</label>
            <div class="col-sm-9">
                <input type="text" id="senderid"  name="smssender_id"placeholder="SMS SENDER ID" class="form-control">
            </div>
        </div>
         <div class="form-group">
            <label for="text" class="col-sm-3 control-label">AUTH KEY*</label>
            <div class="col-sm-9">
                <input type="password" id="authkey" name="authkey" placeholder="AUTH KEY" class="form-control">
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