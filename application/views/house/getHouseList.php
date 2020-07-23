<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading">
				<h4 class="panel-title">Housewise <span class="text-bold">Student List</span></h4>
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
				<div class="form-group">
					<?php if($request->num_rows()>0){
					$school_code =$this->session->userdata("school_code");
						$detail = $this->db->query("SELECT finance_start_date,id FROM fsd where school_code='$school_code' GROUP BY finance_start_date");
						if($detail->num_rows() > 0){
					?>
					<label class="col-sm-2 control-label">
						<strong>Finance Start Date </strong><span class="symbol required"></span>
					</label>
					<div class="col-sm-2">
						<select class="form-control" id="fsd" name = "fsd" style="width: 150px;" required="required">
							<option value="">-select FSD-</option>
		                      			<?php foreach($detail->result() as $row):?>
		                      				<option value="<?php echo $row->id;?>">
		                      					<?php echo date("d-M-y", strtotime($row->finance_start_date));?>
		                      				</option>
		                      			<?php endforeach;?>
						</select>
					</div>
					<?php } ?>
					<label class="col-sm-1 control-label">
						<strong>House/Team</strong>  Name<span class="symbol required"></span>
					</label>
					<div class="col-sm-2">
						<select class="form-control" id="classvh" name="hclass" style="width: 150px;" required="required">
							<option value="">-Select House/Team-</option>
							<?php 
							
							foreach($request->result() as $row):?>
							<option value="<?php echo $row->id;?>"><?php echo $row->house_name;?></option>
							<?php endforeach; ?>
							 <option value="all">All House/Team</option>
						</select>
					</div>
					
				</div>
				<?php }else{?>
				<div class="alert alert-danger">First you have to Configure House/Team. Or Contact to Admin.</div>
				<?php }?>
				<div class="col-sm-12">				
					<div class="table-responsive" id="rahul"></div><!-- end: table-responsive -->
				</div>
			</div><!-- end: panel Body -->
		</div><!-- end: panel panel-white -->
		
	</div><!-- end: MAIN PANEL COL-SM-12 -->
</div><!-- end: PAGE ROW-->
					