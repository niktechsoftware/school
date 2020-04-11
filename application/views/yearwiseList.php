<?php $school_code = $this->session->userdata("school_code");?>
<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">

			<div class="panel-heading panel-green">
				<h4 class="panel-title">Year wise <span class="text-bold">Student Report</span></h4>

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
				
				    		<div class="alert alert-info">
		    <button data-dismiss="alert" class="close">×</button>

                <h3 class="media-heading text-center">Year wise student Report</h3>
                <p class="media-timestamp">Welcome to the Year wise Student area
                when you want to see your Year wise Student list than select Fsd name and click on Get student Detail button and access your selected Fsd Student.</div>

					<div class="row">
						<div class="col-sm-3">
							&nbsp;
						</div>
						<div class="col-sm-2">
							<strong>Finance Start Date</strong>
						</div>
						<div class="col-sm-2">
							<select class="form-controll" name="fsd" required>
								<option value="">-Select FSD-</option>
								<?php $f = $this->db->query("SELECT * FROM fsd WHERE school_code='$school_code'");?>
								<?php if($f->num_rows() > 0){?>
									<?php foreach($f->result() as $row):?>
										<option value="<?php echo $row->id;?>"><?php echo date("d-M-Y",strtotime($row->finance_start_date));?></option>
									<?php endforeach;?>
								<?php } ?>
							</select>
						</div>
						<div class="col-sm-3">
							<button type="submit" class="btn btn-success">Get Student Detail</button>
						</div>
					</div>
				</form>
				
					</div><!-- end: table-responsive -->
				</div>
			
			</div><!-- end: panel Body -->
		</div><!-- end: panel panel-white -->

	</div><!-- end: MAIN PANEL COL-SM-12 -->
</div><!-- end: PAGE ROW-->
