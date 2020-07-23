

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

  <div class="panel-body">
       <div class="text-white text-large">
       <div class="row">
             <div class="col-md-3">
            											<label class="col-md-6">
                											Select	FSD
                											</label>
                											 <div class="col-md-6">
                												<select name="fsd" id="fsd" class="form-control">
                													<option value="">-Select-</option>
                													<?php 
                													$this->db->where("school_code",$this->session->userdata("school_code"));
                													$fsdd = $this->db->get("fsd");
                													foreach ($fsdd->result() as $f):?>
                													<option value="<?php echo $f->id;?>"><?php echo $f->finance_start_date." To ".$f->finance_end_date;?></option>
                													<?php endforeach;?>
                												</select>
                											</label>
											        </div>
											        </div>
											       
        <div class="col-md-3">
            	<label class="col-md-6">Exam Name
            	  </label>
              <div class="col-md-6">
            <select id="examid" class="form-control">
          
              <option value="">Select Exam Name</option><?php
              $school=$this->session->userdata("school_code");
              
              $this->db->where('school_code',$school);
            $emp= $this->db->get('exam_name')->result();
            foreach($emp as $data)
            {
                ?>
            
              <option value="<?php echo $data->id;?>"><?php echo $data->exam_name;?></option>
              <?php
              } ?>
        </select>
</div>
</div>
<div class="col-md-2">
<input type="text" class="form-control" name="stdid" placeholder="Enter Student Id" id="stdexam">
</div>
<div class="col-md-3">                    
<input type="submit" class="form-control btn btn-info" value="submit" id="stdexambutton" >
</div>
<div class="col-md-4">
<div class="col-md-12" id ="validId"></div>
</div>
</div>
</div>
</div>

 <div class="col-sm-12">
                      <div class="panel panel-calendar">
                        <div class="panel-heading panel-blue border-light">
                        <h4 class="panel-title">Student Wise <span class="text-bold">Exam Panel</span></h4>
                        </div>
                        <div class="panel-body" id="examtimetablelist">

                        </div>
                    </div>
                </div>
            
        </div>
      </div>
      </div>
<script>



     jQuery(document).ready(function() {
         $("#stdexambutton").hide();
    
                 $("#stdexambutton").click(function(){
        var examid = $('#examid').val(); 
         var stdexam = $('#stdexam').val(); 
          var fsd = $('#fsd').val(); 
          alert(fsd);
               $.post("<?php echo site_url('index.php/exampanel/findstdexam') ?>", {examid : examid,stdexam : stdexam, fsd:fsd}, function(data){
                $("#examtimetablelist").html(data);
                
        });
       // $('#stdexam').val("");
        });

        $("#stdexam").keyup(function(){
             $("#stdexambutton").show();

                    var student_id = $("#stdexam").val();
                    //alert(teacherid);
                    $.post("<?php echo site_url("index.php/studentController/checkID") ?>",{student_id : student_id}, function(data){
                        $("#validId").html(data);
                        });
                    });
        
                     Main.init();
        SVExamples.init();
        
    });
    

</script>