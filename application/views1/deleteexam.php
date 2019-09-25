 <div class="row">
        <div class="col-md-12">
            <!-- start: RESPONSIVE TABLE PANEL -->
            <div class="panel panel-white">
                <div class="panel-heading panel-orange">
                    <i class="fa fa-external-link-square"></i>
                   Delete Exam  :
                    <div class="panel-tools">
                        <div class="dropdown">
                            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                                <i class="fa fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                                <li>
                                    <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i>
                                        <span>Collapse</span> </a>
                                </li>
                                <li>
                                    <a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i>
                                        <span>Refresh</span> </a>
                                </li>
                                <li>
                                    <a class="panel-config" href="#panel-config" data-toggle="modal"> <i
                                            class="fa fa-wrench"></i> <span>Configurations</span></a>
                                </li>
                                <li>
                                    <a class="panel-expand" href="#"> <i class="fa fa-expand"></i>
                                        <span>Fullscreen</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-body">


                    <div class="alert alert-info">
                        <h3 class="media-heading text-center">Welcome to Delete Exam Detail</h3>
                        <p class="media-timestamp"> Here you can Delete Exam Detail.For Deletion Exam Detail Admin mobile number is required.after filling the Admin
                        mobile number a OTP send to mobile number when OTP Matched then Admin Delete Exam.</p>
                    </div>
                    <div id="msg"></div>
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading panel-red border-light">
                                <h4 class="panel-title">Exam Name</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row space15">    

                                    <div class="col-md-3" id="admin"><b style="font-size:18px;">Admin Mobile Number</b> </div>
                                    <div class="col-sm-4">
                                    <input type="number" class="form-control" id="student_id" name="student_id"
                                            placeholder="Enter Mobile Number">
                                             </div>
                                <input type="hidden" class="form-control" id="exam_id" name="exam_id" value="<?php echo $examid?>" >
                                           
                                   
                                    <br><br>
                                    <div class="col-md-10" id="newpassword">
                                     <div class="col-md-6">
                                    <span style="font-size:20px;">ENTER OTP</span>
                                  <input type="number"  class="form-control" id="otp" name="otp" placeholder="Enter Otp here" title="Please Enter Otp">
                                 <input type="hidden"  class="form-control" id="exam_id" name="exam_id" value="<?php echo $examid?>">
                                <?php $tdtp=date('Y-m-d H:i:s',time());?>
                               <input type="hidden" class="form-control"  name="date" id="date" value="<?php echo $tdtp?>" >
                             </div>
                             <br><br> 
                             <div class="col-md-6"  onclick="return confirm('Are you sure you want to delete this item?');">
                             <button type="submit" id="conform" class="btn btn-red" >
                                            Delete Exam Detail<i class="fa fa-report" ></i>
                                        </button> 
                            </div> 
                           </div>    
                               
                                 </div>
                            </div>
                            <div class="row space15">
                            <div class="col-md-8">
                             <div id="validId"></div>
                                </div>
                            </div>
                               </div>
                            </div>               
                    </div>
                </div>
            </div>
        </div>

            
       
    
