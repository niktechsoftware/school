
<?php $school_code = $this->session->userdata("school_code");?>
<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-pink">
				<h4 class="panel-title">Student <span class="text-bold">Fee Report</span></h4>
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
                  <div class="alert panel-green">
          <button data-dismiss="alert" class="close">×</button>
          <h3 class="media-heading text-center">Welcome to Fee Report Area </h3>
          Please fill start date, Class and Section then show all Fees Report in new form. if you saw all Fees detail 
          then click on view detail Button. if you want to send a sms then click on SEND SMS Button.
              
        </div>
          
				<div class="form-group">
					<?php 
						$detail = $this->db->query("SELECT * FROM fsd where school_code='$school_code' Order BY id");
						//$detail1 = $this->db->query("SELECT finance_start_date FROM `old_fee_deposit` where school_code='$school_code' GROUP BY finance_start_date ");
						// if(($detail->num_rows() > 0)||($detail1->num_rows() > 0))
						if(($detail->num_rows() > 0)){
							
					?>
					<label class="col-sm-1 control-label">
						Finance Start Date <span class="symbol required"></span>
					</label>
					<div class="col-sm-2">
						<select class="form-control" id="fsd1" name = "fsd" style="width: 150px;">
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
					</div>
					<?php } ?>

					<label class="col-sm-1 control-label">
						Section <span class="symbol required"></span>
					</label>
					<div class="col-sm-2">
						<select class="form-control" id="classv1" name="class" style="width: 150px;">
							<option value="">-Select Section-</option>
							<?php foreach($request as $row):
								  $sectionid=$row->section;
								  $this->db->where('school_code',$school_code);
								   $this->db->where('id',$sectionid);
							 $row=$this->db->get('class_section');    
							 if($row->num_rows()>0){     
								  ?>
							<option value="<?php echo $row->row()->id;?>"><?php echo $row->row()->section;?></option>
							<!-- <option value="all"></option> -->
							<?php }endforeach; ?>
						
						</select>
					</div>

					<label class="col-sm-1 control-label">
						Class<span class="symbol required"></span>
					</label>
					<div class="col-sm-2"  >
						<select class="form-control" id="sectionId1" name="class">
						</select>
					</div>
	             <label class="col-sm-1 control-label">
						Month<span class="symbol required"></span>
					</label>
					<div class="col-sm-2"  >
						<select class="form-control" id="fmonth" name="class">
						    <option>--Select--</option>
						    <option value="1">January</option>
						    <option value="2">February</option>
						    <option value="3">March</option>
						    <option value="4">April</option>
					        <option value="5">May</option>
					        <option value="6">June</option>
					        <option value="7">July</option>
	     			         <option value="8">August</option>
					         <option value="9">September</option> 
					         <option value="10">October</option>
					         <option  value="11">November</option>
					        <option value="12">December</option>
						              
						</select>
					</div>
					
				
				</div>
				<div class="col-sm-12">				
					<div class="table-responsive" id="rahul"></div><!-- end: table-responsive -->
				</div>
			</div><!-- end: panel Body -->
		</div><!-- end: panel panel-white -->
		
	</div><!-- end: MAIN PANEL COL-SM-12 -->
</div><!-- end: PAGE ROW-->
					