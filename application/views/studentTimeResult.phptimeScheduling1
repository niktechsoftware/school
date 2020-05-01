

<div class="row">
  <div class="col-md-12">
    <!-- start: RESPONSIVE TABLE PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-red">
        <h4 class="panel-title">Student Wise <span class="text-bold">Time  Panel</span></h4>
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
       <div class="text-white text-large">
       <div class="row">
           
           <div class="col-md-4">
            <select id="fsda" class="form-control">
                <option value="">Select FSD</option><?php
                    $school_code=$this->session->userdata("school_code");
                    $this->db->where("school_code",$school_code);
            	   $fsd = $this->db->get("fsd");
                    if($fsd->num_rows()>0){
                    foreach($fsd->result() as $fd):
                        ?>
                        <option value="<?php echo $fd->id;?>"><?php echo $fd->finance_start_date." to ".$fd->finance_end_date;?></option>
                        <?php
                    endforeach; } ?>
                </select>
        </div> 
        <div class="col-md-4">
            <select id="examid" class="form-control">
                <option value="">Select Time Table Name</option><?php
                   
                    $this->db->where("school_code",$school_code);
            	  
                    $emp= $this->db->get('no_of_period');
                    if($emp->num_rows()>0){
                    foreach($emp->result() as $data)
                    {
                        ?>
                
                        <option value="<?php echo $data->id;?>"><?php echo $data->period_name;?></option>
                        <?php
                    } } ?>
                </select>
</div>
<?php  $unm=$this->session->userdata("username");
      
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
                        <div class="panel-body" id="periodTimetablelist">

                        </div>
                    </div>
                </div>
            
        </div>
    
<script>



     jQuery(document).ready(function() {
        $("#stdexambutton").click(function(){
        var ttmid = $('#examid').val(); 
         var stdexam = $('#stdexam').val(); 
          var fsd = $('#fsda').val();
         
            
        	$.ajax({
						"url": "<?= base_url() ?>index.php/singleStudentControllers/timeScheduling1",
						"method": 'POST',
						"data": {fsd : fsd,ttmid : ttmid,stdexam : stdexam},
						beforeSend: function(data) {
							$("#periodTimetablelist").html("<center><img src='<?= base_url()?>assets/images/loading.gif' /></center>")
						},
						success: function(data) {
							$("#periodTimetablelist").html(data);
						},
						error: function(data) {
							$("#periodTimetablelist").html(data)
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