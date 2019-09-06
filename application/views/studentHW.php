<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">

<div class="panel-heading panel-blue">
				<h4 class="panel-title ">Home Work <span class="text-bold"> Details</span></h4>
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
					<h3 class="media-heading text-center">Welcome to show Homework Area</h3>
					<p class="media-timestamp">To know the show homework for all the Student / Teacher / Employee, go to the Home Work 
						for field and select it and you will start doing a list of homework and you can also take a printout of it.
					</p>
				</div>
				<div class="form-group">
				<div class="col-sm-12">
         <?php 
    		if($var1->num_rows()>0){
        	?>
    	<div class="table-responsive" id ="normal">
    	<table class="table table-striped table-hover table-bordered" id="studHW">
    	<thead>
    	<tr>
        	<th>S.no.</th>
        	<th>Given By</th>
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
                foreach($var1->result() as $lv):
                    $this->db->where('username',$lv->givenby);
                    $ename=$this->db->get('employee_info');
				?>
					<tr>
			  			<td><?php echo $count;?></td>
			  			<td><?php if($ename->num_rows()>0){ echo $ename->row()->name;}else{echo "<span style='color:red'>Teacher Name Not Found</span>";}?></td>
			  			<td><?php echo $lv->work_name;?></td>
			  		
			  			<td><?php $sub= $lv->subject_id;
			  			if($sub==0){
                            echo "N/A";
                        }else{
                           $this->db->where("id",$sub);
                           $dt1= $this->db->get("subject")->row();
                           echo $dt1->subject;
                        }
                        ?></td>
			  			<td><?php echo $lv->maximam_marks;?> ( <?php echo $lv->grade;?> )</td>
			  			<td style="max-width: 151px;"><?php echo $lv->workDiscription;?></td>
			  			<td><?php echo $lv->givenWorkDate; ?></td>
						<td><?php echo $lv->DueWorkDate; ?></td>
						<td style=" width: 30%;"><a href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/filehomeWork/<?php echo $lv->upload_filename; ?>" download>
						    <button class="btn btn-info"  width="104" height="142">Download</button></a>
						<a href="<?php echo base_url(); ?>index.php/studentHWControllers/submitHomeWork/<?php echo $lv->s_no;?>" style="color:white;">
						<button class="btn btn-success"  width="104" height="142">Submit</button></a>
					
						</td>
			  		</tr>
			  		<?php $count++; endforeach; ?>
				</tbody>
			</table>
			</div><?php 
	}
	else{
		echo "<div style='color:red;'>home Work not Assign.</div>";
    }?>
    </div>
    </div>
    </div>

    </div>
    </div>
    </div>