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
                        <h3 class="media-heading text-center">Welcome to Demo Exam Detail</h3>
                        <p class="media-timestamp"> .</p>
                    </div>
                    <div id="msg"></div>
                    <div class="col-md-12">
                        <?php 
                        if($this->session->userdata('login_type')=='student'){
                        $stu=$this->session->userdata('id');
                        }else{
                           $this->db->where("username",$stu);
                          $stu= $this->db->get("student_info")->row()->id;
                           
                        }
                      //  echo $stu;
                      $this->examModel->getExamTimeTableChartBy($exam_id,$class_id,$school_code,$stu,0);
                      ?>
                            </div>               
                    </div>
                </div>
            </div>
        </div>

            
       
    
