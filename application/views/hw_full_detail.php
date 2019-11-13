
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<!-- start: EXPORT DATA TABLE PANEL  -->
			<div class="panel panel-white">
			    

<?php if($Warning=$this->session->flashdata("Warning")){
	echo "<div class='alert alert-danger'>".$Warning."</div>";
}?>
				<div class="panel-heading panel-red">
					<h4 class="panel-title"> <span class="text-bold">Today's Homework Detail</span></h4>
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
						<div class="col-md-12 space20">
							<div class="btn-group pull-right">
								<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
									Export <i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu dropdown-light pull-right">
									
									<li>
										<a href="#" class="export-excel" data-table="#sample-table-2" >
											Export to Excel
										</a>
									</li>
								
								</ul>
								</div>
						</div>
					</div>
				<?php $school_code =$this->session->userdata("school_code");
			 $fsd = $this->session->userdata("fsd");
			?>
              <?php 
    		if($va->num_rows()>0){
			$var1=$va->result();
        	?>
    	<div class="table-responsive" id ="normal">
    	<table class="table table-striped table-hover" id="sample-table-2">
    	<thead>
    	<tr>
        	<th>S.no.</th>
        	<th>Given By</th>
        	<th>Class</th>
        	<th>Assignment Title</th>
        	<th>Subject</th>
        	<th>Marks & Grade</th>
        	<th>Work Description</th>
        	<th>Given Date</th>
        	<th>Submission Date</th>
        	<th>Action</th>
    	</tr>
    	</thead>
    	<tbody>
    	<?php
	      $count = 1;
				foreach($var1 as $lv):
				?>
					<tr>
			  			<td><?php echo $count;?></td>
			  			
			  			<td><?php $this->db->where("username",$lv->givenby);
			  			$emp_p = $this->db->get("employee_info");
			  			if($emp_p->num_rows()>0){
			  			    	echo $emp_p->row()->name."[".$emp_p->row()->username."]";
			  			}else{
			  			    	echo "Admin";
			  			}
			  		?></td>
			  		<td><?php
				  		        	$this->db->where("id",$lv->class_id);
                        	$var =  $this->db->get("class_info")->row();
                        	        $this->db->where("id",$var->section);
                        	$var1 = $this->db->get("class_section")->row();
                            if($lv->class_id==0){echo "No Record Found";}else{ echo $var->class_name."[". $var1->section."]";}
                            ?>
                            </td>
			  			<td><?php echo $lv->work_name;?></td>
			  		
			  			<td><?php $sub= $lv->subject_id;
			  			if($sub==0){
                            echo "for all subject";
                        }else{
                           $this->db->where("id",$sub);
						   $dt1= $this->db->get("subject")->row();
						   if($dt1){echo $dt1->subject;} else{ echo "N/A";}
                           
                        }
                        ?></td>
			  			<td><?php echo $lv->maximam_marks;?> ( <?php echo $lv->grade;?> )</td>
			  			<td style="max-width: 151px;"><?php echo $lv->workDiscription;?></td>
			  			<td><?php  echo $lv->givenWorkDate; ?></td>
						<td><?php echo $lv->DueWorkDate; ?></td>
						<td style=" width: 30%;"><a href="<?php echo $this->config->item("asset_url"); ?><?php echo $this->session->userdata("school_code");?>/images/filehomeWork/<?php echo $lv->upload_filename; ?>" download>
						    <button class="btn btn-info"  width="104" height="142">Download</button></a>
						<?php	 
						if($this->session->userdata("login_type")=='admin' ||$this->session->userdata("login_type")==3)
						{ 
						?><a href="<?php echo base_url(); ?>index.php/studentHWControllers/deleteHomeWork/<?php echo $lv->s_no;?>" style="color:white;"  class="btn btn-danger">Delete</a>
						<a href="<?php echo base_url(); ?>index.php/studentHWControllers/viewHomeWork/<?php echo $lv->s_no;?>" style="color:white;" id="view<?php echo $count;?>" class="btn btn-warning">View Detail</a>
						<?php }
						else{
						?>
						<a href="<?php echo base_url(); ?>index.php/studentHWControllers/submitHomeWork/<?php echo $lv->s_no;?>" style="color:white;">
						<button class="btn btn-success"  width="104" height="142">Submit</button></a> 
						<?php } ?>
						</td>
			  		</tr>
			  		<?php $count++; endforeach; ?>
				</tbody>
			</table>
			</div>
			<script>
	TableExport.init();
</script>
			<?php 
	}
	
	else{
		echo "<div style='color:red;'>home Work not Assign.</div>";
	} ?>
				
					</div>
				</div>
			</div>
			<!-- end: EXPORT DATA TABLE PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->
</div>