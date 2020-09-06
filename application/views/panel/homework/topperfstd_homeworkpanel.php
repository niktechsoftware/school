<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-red">
        <h4 class="panel-title">Top 10 Student  <span class="text-bold">HomeWork Report</span></h4>
        <div class="panel-tools">
          <div class="dropdown">
            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
              <i class="fa fa-cog"></i>
            </a>
            <ul class="dropdown-menu dropdown-light pull-right" role="menu">
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
          <a class="btn btn-xs btn-link panel-close" href="#">
            <i class="fa fa-times"></i>
          </a>
        </div>
      </div>
     
  <div class="panel-body">
       <div class=" text-large">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td>Sno</td>
                            <td>Name</td>
                            <td>Username</td>
                            <td>Class</td>
                            <td>HomeWork</td>
                            <td>Submitted Date</td>
                        </tr>
                       <thead>
                       <tbody>
                       <?php $i=1;
                       foreach($class->result() as $data1)
                       {
                           
                               
                    		$this->db->where("work_id",$data1->work_name);
                    		$data = $this->db->get("homework");
                    		if($data->num_rows()>0){
                           $dt=$data->row();
                           
                           //print_r($a);
                            $this->db->where('id',$data1->class_id);
                        $dt3= $this->db->get("class_info");
                        if($dt3->num_rows()>0){
                            
                        
                        $this->db->where("username",$dt->submitted_by );
                        $this->db->where('class_id',$data1->class_id);
                        $dt= $this->db->get("student_info");
                        if($dt->num_rows()>0){
                            $dt1=$dt->row();
                              ?>
                       <tr>
                            <td><?php echo $i ; ?></td>
                            <td><?php echo $dt1->name ; ?></td>
                            <td><?php echo $data->submitted_by  ; ?></td>
                            <td><?php echo $dt3->row()->class_name ; ?></td>
                            <td><?php echo $data1->work_name ; ?></td>
                            <td><?php echo $data->submitted_date ; ?> Date</td>
                        </tr>
    <?php } } }  $i++; }
    ?>
                       </tbody>
                    </table>
                </div>
            </div>
            
        </div>
</div>


              
            </div>
          </div>
        </div>
        

