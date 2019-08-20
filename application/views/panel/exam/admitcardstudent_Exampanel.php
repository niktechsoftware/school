<form action="<?php echo base_url();?>index.php/adminc/admitCardReports" method="post" role="form"
    class="smart-wizard form-horizontal" id="form">
    <div class="row">
        <div class="col-md-12">
            <!-- start: RESPONSIVE TABLE PANEL -->
            <div class="panel panel-white">
                <div class="panel-heading panel-orange">
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
                        <h3 class="media-heading text-center">Welcome to Download Admitcard Area</h3>
                        <p class="media-timestamp">To get admit card of any student, select Exam Name and 
                            enter Student ID and click the get admit card button.admit card of that student will appear and then you can print it.
                    </div>
                    <div id="msg"></div>
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading panel-red border-light">
                                <h4 class="panel-title">Admit Card</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row space15">
                                    <div class="col-md-2">&nbsp;&nbsp;&nbsp;&nbsp;Select Exam </div>
                                    <div class="col-sm-2">
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


                                    </div>

                                    <div class="col-md-2">&nbsp;&nbsp;&nbsp;&nbsp;Enter Student ID </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="student_id" name="student_id"
                                            placeholder="Text Field">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" id="b1" class="btn btn-red">
                                            Get Admit Card <i class="fa fa-report"></i>
                                        </button>
                                    </div>
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
		jQuery(document).ready(function() {
			$("#b1").hide();
		$("#student_id").keyup(function(){
			
	var student_id = $("#student_id").val();
	
	//alert(teacherid);
	$.post("<?php echo site_url("index.php/studentController/checkID") ?>",{student_id : student_id}, function(data){
		$("#validId").html(data);
		
		
	});
	});
		Main.init();
		SVExamples.init();
		FormElements.init();
		PagesGallery.init();
	});
</script>