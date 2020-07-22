
<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-pink">
        <h4 class="panel-title">Driver wise<span class="text-bold">Student List</span></h4>
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

     <div class="row">
                      <div class="col-sm-12">
                       <div class="col-sm-6">
                       <div class="col-sm-6">
                          
                        </div>
                         <div class="col-sm-6">
                          <h4 class="panel-title">Driver Name</h4>
                        </div>
                        </div>
                          <div class="col-sm-6">
	                          <div class="col-sm-6">
	                          <div class="form-group">
	                            <select id="clname" class="form-control">
	                              <option value="">Select Driver Name</option>
	                                                            <?php 
	                                                            
	                                                            $school_code = $this->session->userdata("school_code");
	                                                            $this->db->where('school_code',$school_code);
	                                                          $transport=  $this->db->get('transport')->result();
	                                                            
	                                                            
	                           foreach ($transport as $row){
	                                 
	                                  ?>
	                              <option value="<?php echo $row->id;?>"><?php echo $row->driver_name;?>&nbsp;(&nbsp;<?php echo $row->vehicle_name;?>&nbsp;[&nbsp;<?php echo $row->vehicle_numnber;?>&nbsp;]&nbsp;)</option>
	                              <?php } ?>
	                            </select>
	                          </div>
	                          </div>
	                         <div class="col-sm-6">
                         	</div>
                         </div>
                        
                        </div>
                        
                         
                      </div>
                    <div class="table-responsive" style="width:100%; overflow-y: scroll;">
                        <div id=sample_rahul>
                          
                        </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <script>
             $("#clname").change(function(){
          
            var transportid = $("#clname").val();

            $.ajax({
                        "url": "<?= base_url() ?>index.php/studentController/findtransport",
                        "method": 'POST',
                        "data": {transportid : transportid},
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

        });
</script>
              