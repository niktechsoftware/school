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
                       <?php
                       foreach($class as $data)
                       {
                           $a=$data->submitted_by;
                           //print_r($a);
                        $this->db->where("username",$a);
    $this->db->where('class_id',$cls);
    $dt= $this->db->get("student_info");
    if($dt->num_rows()>0){
        $dt1=$dt->row();?>
                       <tr>
                            <td>Sno</td>
                            <td>Name</td>
                            <td>Username</td>
                            <td>Class</td>
                            <td>HomeWork</td>
                            <td>Submitted Date</td>
                        </tr>
    <?php } }
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
        

