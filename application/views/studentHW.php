<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.myth{
    color:black;
    font: 15px Arial, sans-serif bold:27px;
}
</style>
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
					<h3 class="media-heading text-center">Welcome to Show Homework Area</h3>
					<p class="media-timestamp">To know the Show homework for all the Student / Teacher / Employee, go to the Home Work 
						for field and select it and you will start doing a list of homework and you can also take a printout of it.
					</p>
				</div>
				<div class="form-group">
				<div class="col-sm-12">
       
    	<div class="table-responsive" >
    	<table class="table table-striped table-hover" id="sample-table-2">
    	<thead>
    	<tr>
        	<th class="myth">S.no.</th>
        	<th class="myth">Given By</th>
        	<th class="myth">Assignment Title</th>
        	<th class="myth">Subject</th>
        	<th class="myth">Marks & Grade</th>
        	<th class="myth">Work Description</th>
        	<th class="myth">Given Date</th>
        	<th class="myth">Submission Date</th>
        	<th class="myth">Action</th>
        	<th class="myth">Status</th>
        	<th class="myth">Delete</th>
    	</tr>
    	</thead>
    	<tbody>
      <?php 
    		if($var1->num_rows()>0){
                 $count = 1;
                foreach($var1->result() as $lv):
                    $this->db->where("work_id",$lv->s_no);
                    $this->db->where("submitted_by",$this->session->userdata("username"));
                   $checkStatus= $this->db->get("homework");
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
			  			<td ><?php echo $lv->workDiscription;?></td>
			  			<td><?php echo date("d-m-Y",strtotime($lv->givenWorkDate)); ?></td>
						<td><?php echo date("d-m-Y",strtotime($lv->DueWorkDate)); ?></td>
						<td style=" width: 20%;"><a href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/filehomeWork/<?php echo $lv->upload_filename; ?>" download>
						    <button class="btn btn-info" ><i class="fa fa-download"></i></button></a>
						<a href="<?php echo base_url(); ?>index.php/studentHWControllers/submitHomeWork/<?php echo $lv->s_no;?>" style="color:white;">
						<button class="btn btn-success"  >Submit</button></a>
					
						</td>
					
						    <?php if($checkStatus->num_rows()>0){?>
						    	<td>
						    <a href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/submithomeWork/<?php echo $checkStatus->row()->upload_file; ?>" download>
						     <button class="btn btn-info" >view</i></button></a>
						<a href="#" style="color:white;">
						<button class="btn btn-success"  >Done</button></a>
						</td>
						<td><a href="<?php echo base_url();?>index.php/studentHWControllers/deleteHomework/<?php echo $checkStatus->row()->work_id;?>"> <button class="btn btn-danger" ><i class="fa fa-trash" style="color:white;"></i></button></a>     </td>
						   <?php }else{?> 
						   <td></td>
						   <td></td>
						<?php }?>
			  		</tr>
			  		<?php $count++; endforeach; 
			  		
			  			}?>
				</tbody>
			</table>
			</div>

    
    </div>
    </div>
    </div>
</div>
</div>
 </div>