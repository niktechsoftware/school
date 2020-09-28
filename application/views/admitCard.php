 <div class="row">
        <div class="col-md-12">
            <!-- start: RESPONSIVE TABLE PANEL -->
            <div class="panel panel-white">
                <div class="panel-heading panel-orange">
                    <i class="fa fa-external-link-square"></i>
                    Download Admit Card Panel :
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
                <form action="<?php echo base_url();?>index.php/adminc/admitCardReports" method="post" role="form"
    class="smart-wizard form-horizontal" id="form">
                <div class="panel-body">
					<div class="alert alert-info">
                        <h3 class="media-heading text-center">Welcome to Download Admit Card Area</h3>
                        <p class="media-timestamp">
                            Here You can see or Download Admit Card, for This Select Exam and Enter Student Id and then Show Get Admit Card Button.After Click this Button You Get Admit Card.</p>
                    </div>
                    <div id="msg"></div>
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="row space15">
								 <div class="col-md-2">&nbsp;&nbsp;&nbsp;&nbsp;Select FSD </div>
								 <?php 
								   	$school_code = $this->session->userdata("school_code");
								  $fsd= $this->session->userdata("fsd");
						 $detail = $this->db->query("SELECT * FROM fsd where school_code='$school_code' Order BY id");
					     if(($detail->num_rows() > 0)){
							
					     ?>
					<div class="col-sm-2">
						<select class="form-control" id="fsd" name = "fsd" style="width: 150px;">
							<option value="">-select FSD-</option>
		                      			<?php 
		                      			if(($detail->num_rows() > 0)){
		                      			foreach($detail->result() as $row):?>
		                      				
		                      			<option value="<?php echo $row->id;?>">
		                      			<?php echo date("d-M-y", strtotime($row->finance_start_date));?>
		                      		</option>
		                      		<?php endforeach;
		                      				
		                      			}
		                      			?>
						</select>
					</div>
					<?php } ?>
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
                </form>
                <!-- hjgfhfgfy -->
               <!-- <form action="<?php echo base_url();?>index.php/adminc/admitCardReports" method="post" role="form"
    class="smart-wizard form-horizontal" id="form">
                <div class="panel-body">


<div class="alert alert-info">
    <h3 class="media-heading text-center">Welcome to Download Admit Card Area</h3>
    <p class="media-timestamp">
        Here you can see or download Admit Card for all students of single class,  and then show Get Admit Card Button.After Click this Button you get Admit Card</p>
</div>
<div id="msg"></div>
<div class="col-md-12">
    <div class="panel">
        
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
</form>-->
                <!-- hjghyfygf -->

            </div>
        </div>
    </div>
