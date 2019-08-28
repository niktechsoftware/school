<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">

			<div class="panel-heading panel-blue">
				<h4 class="panel-title ">Home Work <span class="text-bold">Full Detail</span></h4>
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
			</div><br>
			
			<div class="panel-body">
			<div class="alert alert-info"><h3 class="media-heading text-center">Welcome to Homework Full Detail Area</h3>
			<p class="media-timestamp">This is the <b>Homework Full Detail Area </b>, where you can see the whole details of Given Homework in <b> Details of Given Homework Panel</b>
			and you can see the whole details of Submitted Homework in <b> Details of Submitted Homework Panel</b>
			</div>
			<div><!--view form-->
		<div class="col-sm-12">
    <!-- start: FORM WIZARD PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-red">
        <h4 class="panel-title"><span class="text-bold">Details of Given Homework</span></h4>

        <div class="panel-tools">
          <div class="dropdown">
            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
              <i class="fa fa-cog"></i>
            </a>
            <ul class="dropdown-menu dropdown-light pull-right" role="menu" style="display: none;">
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
          <!-- <a class="btn btn-xs btn-link panel-close" href="#">
          <i class="fa fa-times"></i>
        </a> -->
        </div>
      </div><?php
      $id= $this->uri->segment(3);
      	$this->db->where("school_code",$this->session->userdata("school_code"));
      	$this->db->where("s_no",$id);
		$var = $this->db->get("homework_name")->row();
	
       ?>
      <div class="panel-body">
        <div class="form-group">
         <div class="col-sm-5">
            <label class="col-sm-5 control-label">Given By :</label>
            <div class="col-sm-7">
             <label > <?php echo $var->givenby; ?></label>
            </div>
          </div>
          <div class="col-sm-5">
            <label class="col-sm-5 control-label">Assignment Title :</label>
            <div class="col-sm-7">
              <label ><?php echo $var->work_name; ?></label>
              </div>
          </div>
        </div>
        <div class="form-group">
         <div class="col-sm-5">
            <label class="col-sm-5 control-label">Work Description :</label>
            <div class="col-sm-7">
             <label ><?php echo $var->workDiscription; ?></label>
            </div>
          </div>
          <div class="col-sm-5">
            <label class="col-sm-5 control-label">Given Date :</label>
            <div class="col-sm-7">
              <label ><?php echo $var->givenWorkDate; ?></label>
              </div>
          </div>
        </div>
        <div class="form-group">
         <div class="col-sm-5">
            <label class="col-sm-5 control-label">Submittion Date :</label>
            <div class="col-sm-7">
             <label ><?php echo $var->DueWorkDate; ?></label>
            </div>
          </div>
        <?php if($var->workfor == "students"){ 	
            $this->db->where("id",$var->class_id);
    	$var1 = $this->db->get("class_info")->row();
        $this->db->where("id",$var1->section);
        $var2 = $this->db->get("class_section")->row();?>  <div class="col-sm-5">
            <label class="col-sm-5 control-label">Class :</label>
            <div class="col-sm-7">
              <label ><?php  if($var->class_id==0){echo "No Record Found";}else{ echo $var1->class_name;} ?></label>
              </div>
          </div><?php } ?>
        </div>
       <?php if($var->workfor == "students"){ ?> <div class="form-group">
         <div class="col-sm-5">
            <label class="col-sm-5 control-label">Section :</label>
            <div class="col-sm-7">
             <label ><?php echo $var2->section; ?></label>
            </div>
          </div>
          <div class="col-sm-5">
            <label class="col-sm-5 control-label">Marks & Grade :</label>
            <div class="col-sm-7">
              <label ><?php echo $var->grade; ?></label>
              </div>
          </div>
        </div><?php } ?>
        
      </div>
    </div>
  </div><div class="col-sm-12">
    <!-- start: FORM WIZARD PANEL -->
    <div class="panel panel-white">
      <div class="panel-heading panel-red">
        <h4 class="panel-title"><span class="text-bold">Details of Submitted Homework Panel</span></h4>

        <div class="panel-tools">
          <div class="dropdown">
            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
              <i class="fa fa-cog"></i>
            </a>
            <ul class="dropdown-menu dropdown-light pull-right" role="menu" style="display: none;">
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
          <!-- <a class="btn btn-xs btn-link panel-close" href="#">
          <i class="fa fa-times"></i>
        </a> -->
        </div>
      </div>
      <div class="panel-body">
       <?php $id= $this->uri->segment(3);
		$this->db->where("school_code",$this->session->userdata("school_code"));
      	$this->db->where("s_no",$id);
		$var = $this->db->get("homework_name")->row();
		
	
      //	$this->db->where("work_id",$id);
	//	$var1 = $this->db->get("homework")->row();
	?><?php if($var->workfor == "students"){   
		$id= $this->uri->segment(3);
					$this->db->where("work_id",$id);
	              	$var1 = $this->db->get("homework")->result();
	              	$i=1;
	?>	<div class="table-responsive">
							<table class="table table-striped table-hover" id="submithwstu">
								<thead>
									<tr style="background-color:#1ba593; color:white;">
										<th>SNo.</th>
										<th>Submitted By</th>
										<th>UserName</th>
										<th>Class</th>
										<th>Section</th>
										<th>Submitted Date</th>
										<th>Submitted Homework</th>
										
									</tr>
								</thead>
								<tbody>
								    <?php foreach($var1 as $lv): ?><tr>
        								<td><?php echo $i; ?></td>
        								<td><?php 
								$this->db->where("username",$lv->submitted_by);
	                           	$data = $this->db->get("student_info")->row();
	                           	
                                $this->db->where("id",$data->class_id);
    	                        $var1 = $this->db->get("class_info")->row();
                                $this->db->where("id",$var1->section);
                                $var2 = $this->db->get("class_section")->row();
                                echo $data->name; ?></td>
        								<td><?php echo $user=$lv->submitted_by; ?></td>
        								<td><?php  
        								echo $var1->class_name; ?></td>
        								<td><?php echo $var2->section; ?></td>
        								<td><?php echo $lv->submitted_date; ?></td>
								        <td><a href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/submithomeWork/<?php echo $lv->upload_file; ?>" download>
							        <button class="btn btn-info"  width="104" height="142">Download</button></a></td>
								   </tr><?php $i++; endforeach; ?>
								</tbody>
							</table>
					</div><?php }else{
					$id= $this->uri->segment(3);
					$this->db->where("work_id",$id);
	              	$var1 = $this->db->get("homework")->result();
	              	$i=1;
					?>
					 <div class="table-responsive">
							<table class="table table-striped table-hover" id="submithwemp">
								<thead>
									<tr style="background-color:#1ba593; color:white;">
										<th>SNo.</th>
										<th>Submitted By</th>
										<th>UserName</th>
										<th>Submitted Date</th>
										<th>Submitted Homework</th>
										
									</tr>
								</thead>
								<tbody><?php foreach($var1 as $lv): ?>
								<tr>
								<td><?php echo $i; ?></td>
								<td><?php 
								$this->db->where("username",$lv->submitted_by);
	                           	$data = $this->db->get("employee_info")->row();
                                echo $data->name; ?></td>
								<td><?php echo $lv->submitted_by; ?></td>
								<td><?php echo $lv->submitted_date; ?></td>
								<td><a href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/submithomeWork/<?php echo $lv->upload_file; ?>" download>
							        <button class="btn btn-info"  width="104" height="142">Download</button></a></td>
							</tr><?php $i++; endforeach; ?>
							</tbody>
							</table>
						
					</div>
					<?php } ?>
       
				
        
      </div>
    </div>
  </div>
			
			
			</div>
			</div><!-- end: panel Body -->
		</div><!-- end: panel panel-white -->
	</div><!-- end: MAIN PANEL COL-SM-12 -->
</div><!-- end: PAGE ROW-->
	</div>
