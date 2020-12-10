<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-red">
        <h4 class="panel-title">Student Wise <span class="text-bold">Exam Panel</span></h4>
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
 <br>
			<div class="panel-body">
			    <div class="alert alert-info">
					<h3 class="media-heading text-center">Welcome to Show Exam Result Area</h3>
					<p class="media-timestamp">Here Stundent Can See  Exam Result. 
						.
					</p>
				</div>
  
       <div class="text-white text-large">
       <div class="row">
          <?php  
        /*  $this->db->where("username",$this->session->userdata("username"));
        $st_id = $this->db->get("student_info")->row();
          echo $st_id->id;
          $this->db->where("stu_id",$st_id->id);
          $e=$this->db->get("exam_info");
          print_r($e);
          
          //exam_id,stu_id,fsd need for data/
          
          */
          
          ?>
           <div class="col-md-4">
            <select id="fsda" class="form-control">
                <option value="">Select FSD</option><?php
                    $id=$this->session->userdata("id");
                    $query= $this->db->query("SELECT  distinct (fsd) as fsd from exam_info where stu_id='$id'");
                    if($query->num_rows()>0){
                    foreach($query->result() as $fd):
                        $this->db->where('id',$fd->fsd);
                       $fsd1=$this->db->get("fsd");
                        if($fsd1->num_rows()>0){
                    foreach($fsd1->result() as $fd1):
                        ?>
                        <option value="<?php echo $fd1->id;?>"><?php echo $fd1->finance_start_date." to ".$fd1->finance_end_date;?></option>
                        <?php
                         endforeach; } 
                    endforeach; } ?>
                </select>
        </div> 
        <div class="col-md-4">
            <select id="examid" class="form-control">
                <option value="">Select Exam Name</option><?php
                $school_code=$this->session->userdata("school_code");
                   $this->db->where("school_code",$school_code);
            	   $emp= $this->db->get('exam_name')->result();
                    foreach($emp as $data)
                    {
                        ?>
                <option value="<?php echo $data->id;?>"><?php echo $data->exam_name;?></option>
                        <?php
                    }  ?>
                </select>
</div>
<?php  $unm=$this->session->userdata("id");
      
      ?>
<div class="col-md-2">
    <input type="hidden" class="form-control" name="stdid" placeholder="Enter Student Id" value="<?php echo $unm;?>" id="stdexam">
    <input type="submit" class="btn btn-success" value="submit" id="stdexambutton" >

</div>
<div class="col-md-3">                    

</div>
<div class="col-md-4">
<div class="col-md-12" id ="validId"></div>
</div>
</div>
</div>
</div>
<br>
<br>
 <div class="col-sm-12 row">
                  
                       
                        </div>
                        <div class="panel-body" id="examtimetablelist">

                        </div>
                    </div>
                </div>
            
        </div>
    
                            <script>
                            jQuery(document).ready(function() {
                                $("#stdexambutton").click(function(){
                                var examid = $('#examid').val(); 
                                var stdexam = $('#stdexam').val(); 
                                var fsd = $('#fsda').val();
                                 	$.ajax({
						        "url": "<?= base_url() ?>index.php/exampanel/findstdexam",
						        "method": 'POST',
						        "data": {fsd : fsd,examid : examid,stdexam : stdexam},
						        beforeSend: function(data) {
							    $("#examtimetablelist").html("<center><img src='<?= base_url()?>assets/images/loading.gif' /></center>")
						        },
						        success: function(data) {
							    $("#examtimetablelist").html(data);
						        },
						        error: function(data) {
							    $("#examtimetablelist").html(data)
						        }
					            })
                                 });
                         $("#stdexam").keyup(function(){
                             $("#stdexambutton").show();
                
                                    var student_id = $("#stdexam").val();
                                    //alert(teacherid);
                                    $.post("<?php echo site_url("index.php/studentController/checkID") ?>",{student_id : student_id}, function(data){
                                        $("#validId").html(data);
                                        });
                                    });
                        
                        //              Main.init();
                        // SVExamples.init();
                        
                    });
                    

</script>