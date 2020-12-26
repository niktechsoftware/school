<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
    <div class="panel-heading panel-red">
        <h4 class="panel-title">Class Wise <span class="text-bold">Exam Panel</span></h4>
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
    <!-- <div class="row">
                       <div class="col-sm-12">
                      <div class="panel panel-white">

                        <div class="panel-heading panel-purple">


                          <h4 class="panel-title">Class Wise Exam Report list</h4>

                        </div>
                        <div class="panel-body" id="sample_rahul">
						
                        </div>
                    </div>
                </div>
                </div>-->
       <div class="row">
        <div class="col-md-12">
        <div class="panel-body">
       <div class="text-white text-large">
	     <div class="alert alert-info"><h3 class="media-heading text-center">Welcome to Examination Report  Section Area.</h3>
                            <p class="media-timestamp">In this Page Teacher  Can Access Class Wise EXAM Report.</div></div>
	   <!---->
	    <div class="col-md-3">
                          <div class="form-group">
<?php 					$school_code = $this->session->userdata("school_code");
						$detail = $this->db->query("SELECT * FROM fsd where school_code='$school_code' Order BY id");
						if(($detail->num_rows() > 0)){
							
					?>
                   <select class="form-control" id="fsd" name = "fsd" >
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
						<?php } ?>
                          </div>
                        </div>
	   <!---->
	   
        <div class="col-md-3">
                          <div class="form-group">
						   <select id="examid" class="form-control">
									   <!-- <option value="">Select Exam Name</option>-->
										<?php
											 /* $school=$this->session->userdata("school_code");
											  //$this->db->where('fsd',$fsd);
											  $this->db->where('school_code',$school);
										$emp= $this->db->get('exam_name')->result();
										foreach($emp as $data){ ?>
										<option value="<?php echo $data->id;?>"><?php echo $data->exam_name;?></option>
									  <?php } */?>
							</select>
                          </div>
                        </div>
                  
                      <div class="col-sm-2">
                        
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
                      <div class="col-sm-2">
                          <div class="form-group">
                            <select id="sectionList" class="form-control">
                              
                            </select>
                          </div>
                        </div>
                      <div class="col-sm-2">
                          <div class="form-group">
                            <select id="classlist" class="form-control">
                            </select>
                          </div>
                        </div>
                       </div>
                      </div>
                    </div>
                </div>
               </div>
              </div>
        </div>
     <script>
                 jQuery(document).ready(function() {
		$("#fsd").change(function(){
            var fsd = $("#fsd").val();
            //alert(clname);
            $.post("<?php echo site_url('index.php/configureClassControllers/getexamname') ?>", {fsd : fsd}, function(data){
                $("#examid").html(data);
                //alert(data);
            });
        });
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
         
            var classid = $("#classlist").val();
             var examid = $("#examid").val();
			 var fsd = $("#fsd").val();

            $.ajax({
                        "url": "<?= base_url() ?>index.php/exampanel/findclassexam",
                        "method": 'POST',
                        "data": {classid : classid , examid : examid, fsd :fsd},
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

        
        Main.init();
        SVExamples.init();
        
    });
                                         
</script>
              