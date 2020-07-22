		<?php $school_code = $this->session->userdata("school_code");?>
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-white">
					<div class="panel-heading">
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
					<div class="row" style="margin-left:10px;padding-bottom:20px;">
					<div class="col-md-3"><h4><strong>Select Time Table</strong></h4></div>
						<div class="col-md-4">
							<select class="form-control" name="thead" id="thead">
								<option value="">-Select Time Table-</option>
								<?php $this->db->where('school_code',$this->session->userdata('school_code'));
								$thead_id=$this->db->get('no_of_period');
								if($thead_id->num_rows()>0):
									foreach($thead_id->result() as $row):
										?>
											<option value="<?php echo $row->id;?>"><?php echo $row->period_name;?></option>
										<?php
									endforeach;
								endif;?>
							</select>
						</div>
					</div>
					<div class="row" id="time_table">
								<div class="col-md-12">
								</div>
					</div>
				</div>
			</div>
		</div>
						<!-- end: PAGE CONTENT-->
					
					