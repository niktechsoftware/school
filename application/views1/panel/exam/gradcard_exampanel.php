<form action="<?php echo base_url();?>examControllers/resultRender" method="post">
<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-sm-12">
		<!-- start: INLINE TABS PANEL -->
	<div class="panel panel-white">
		<div class="panel-heading panel-green">
				<h4 class="panel-title">Generate Result</h4>
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
						<a class="panel-refresh" href="#"> <i class="fa fa-refresh"></i> <span>Refresh</span> </a>
					</li>
					<li>
						<a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a>
					</li>										
				</ul>
				</div>
			</div>
		</div>
		
		<div class="panel-body">
			<div class="alert panel-green">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to Student Wise Exam Report Area </h3>
          Please select FSD,type Student ID and select a Exam Name. then click on Generate result button .Now you can see Grade Card of that Student.
              
        </div>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
		                   <?php $school_code =$this->session->userdata("school_code");
						$detail = $this->db->query("SELECT finance_start_date FROM `fsd` where school_code='$school_code' GROUP BY finance_start_date ");
						if($detail->num_rows() > 0){
					?>
					<label class="col-sm-4 control-label">
						Finance Start Date <span class="symbol required"></span>
					</label>
					
						<select class="form-control" id="fsd" name = "fsd" style="width: 150px;">
						<option value="">-select FSD-</option>
                                          <?php 
                                             $this->db->where("school_code",$this->session->userdata("school_code"));
                                            $a=$this->db->get("fsd");
                                            foreach($a->result() as $row):
                                            ?>
                                         <option value="<?php echo $row->id;?>">
                                           <?php echo date("d-M-y", strtotime($row->finance_start_date));?>
                                              </option>
		                      			<?php endforeach;?>
						</select>
					
					</div>	
					<?php } ?>
				</div>
				<div class="col-md-4">
						<div class="form-group">
					<label>Student ID</label>
					<input type="text" name="student_id" id= "student_id" required="required"/>
				</div>
			</div>	
			
			
			</div>
		<div class="col-md-4" id ="validId">
						
				</div>	
			
		<?php 
			$i = 1;
			$this->db->where("school_code",$this->session->userdata("school_code"));
			$exam = $this->db->get("exam_name");
			if($exam->num_rows() > 0){
				foreach($exam->result() as $row){
					if($i == 1){
		?>
			<div class="row  space15">
					<?php } ?>
				<div class="col-md-2">
					<label class="checkbox-inline">
						<input type="checkbox" value="<?php echo $row->id; ?>" name="examName[]" >
						<?php echo $row->exam_name; ?>
					</label>
					
				</div>
					<?php if($i == 6){ ?>
					
			</div>
			
		<?php 
						$i = 1;
					}
					$i++;
				}
		?>
			<div class="row  space15">
				<div class="col-md-2"></div>
				<div class="col-md-2">
					<input type="submit" class="btn btn-green" value="Generate Result" />
				</div>
			</div>
		<?php
			}
			else{
		?>
			<div class="row  space15">
				<div class="col-md-12">
					<h1>No Exam Found....</h1>
				</div>
			</div>
		<?php 
			}
		?>
		</div>
		</div>
		</div>
	</div>
	<!-- end: INLINE TABS PANEL -->
	</div>
</div>
<!-- end: PAGE CONTENT-->
</form>

<script>
	
	$("#student_id").keyup(function(){
					var student_id = $("#student_id").val();
					//alert(teacherid);
					$.post("<?php echo site_url("index.php/studentController/checkID") ?>",{student_id : student_id}, function(data){
						$("#validId").html(data);
						});
					});
</script>