<form action="<?php echo base_url();?>index.php/adminc/admitCardReports" method="post" role="form"
    class="smart-wizard form-horizontal" id="form">
    <div class="row">
        <div class="col-md-12">
            <!-- start: RESPONSIVE TABLE PANEL -->
            <div class="panel panel-white">
                <div class="panel-heading">
                    <i class="fa fa-external-link-square"></i>
                    Download Admit Card :
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
                        <h3 class="media-heading text-center">welcome to download Admit card area</h3>
                        <p class="media-timestamp">To get admit card of all your students in a particular class,select exam ,stream, section and class.
                            Now click get admit card button.then the admit cards of that class will appear and it's ready to print.
                    </div>
                    <div id="msg"></div>
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading panel-red border-light">
                                <h4 class="panel-title">Admit Card</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row space15">
                                   <!--  <div class="col-md-1">&nbsp;&nbsp;&nbsp;&nbsp;Select Exam </div> -->
                                    <div class="col-sm-3">
                                     <div class="panel-heading panel-pink border-light">
                                                    <h4 class="panel-title">Select Exam</h4>
                                                </div>
                                   <div class="panel-body">
                                                    <div class="form-group">
                                        <select id="selectExam" name="selectExam" class="form-control"
                                            required="required">
                                            <option value="">Select Exam</option>
                                            <?php
													$school_code = $this->session->userdata("school_code");
												 $fsd= $this->session->userdata("fsd");
											$examList = $this->db->query("select * from exam_name where school_code='$school_code'");
												if($examList->num_rows()>0):
											foreach ($examList->result() as $row):?>
                                            <option value="<?php echo $row->id;?>">
                                                <?php echo $row->exam_name."[".date('d-m-y',strtotime($row->exam_date))."]";?></option>
                                            <?php endforeach;  endif;?>
                                        </select>


                                    </div></div></div>

                                   
                                            <div class="col-sm-3">
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
                                                  
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
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
                                            <div class="col-sm-3">
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
                                        
                                        <div class="table-responsive" style="width:100%; overflow-y: scroll;">
                                                <div id=sample_rahul>
                                                    
                                                </div>
                                            
                                        </div>
                                   <!--  <div class="col-md-2">
                                        <button type="submit" id="b1" class="btn btn-red">
                                            Get Admit Card <i class="fa fa-report"></i>
                                        </button>
                                    </div> -->
                                </div>

                                <div class="row space15">
                                    <div class="col-md-7">
                                        <div id="validId"></div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
<script>
       $("#clname").change(function(){
            var streamid = $("#clname").val();
            //alert(clname);
            $.post("<?php echo site_url('index.php/configureClassControllers/getSection') ?>", {streamid : streamid}, function(data){
                $("#sectionList").html(data);
                //alert(data);
            });
        });

        $("#sectionList").change(function(){
            var sectionid = $("#sectionList").val();
            var streamid = $("#clname").val();
            //alert(clname);
            $.post("<?php echo site_url('index.php/configureClassControllers/getClasslist') ?>", {sectionid : sectionid, streamid : streamid}, function(data){
                $("#classlist").html(data);
                //alert(data);
            });
        });
       $("#classlist").change(function(){
          
            var classv = $("#classlist").val();
             var selectExam = $("#selectExam").val();
          
           $.ajax({
                        "url": "<?= base_url() ?>index.php/exampanel/admitcardclass",
                        "method": 'POST',
                        "data": {classv : classv , selectExam: selectExam},
                        beforeSend: function(data) {
                            $("#sample_rahul").html("<center><img src='<?= base_url()?>assets/images/loading.gif' /></center>")
                        },
                        success: function(data) {
                            $("#sample_rahul").html(data);
                        },
                        error: function(data) {
                            $("#sample_rahul").html(data)
                        }
                    })
    
                  $("#sonu").show();
                    });

</script>