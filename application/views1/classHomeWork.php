<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading">
				<h4 class="panel-title">Student <span class="text-bold">List</span></h4>
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
					
					<label class="col-sm-1 control-label">
						<strong>Start Date </strong><span ></span>
					</label>
					<div class="col-sm-2">
							<input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years" name="fsd1" id="fsd1" class="form-control date-picker" required="required"/>
					</div>
					<label class="col-sm-1 control-label">
						<strong>End Date </strong><span class="symbol required"></span>
					</label>
					<div class="col-sm-2">
							<input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years" name="fsd2" id="fsd2" class="form-control date-picker" required="required"/>
					</div>
					
					<label class="col-sm-1 control-label">
						<strong>Class</strong> <span class="symbol required"></span>
					</label>
					<div class="col-sm-2">
						<select class="form-control" id="classv1" name="class" style="width: 130px;" required="required">
							<option value="">-Select Class-</option>
							<?php foreach($request as $row):?>
							<option value="<?php echo $row->class_name;?>"><?php echo $row->class_name;?></option>
							<?php endforeach; ?>
							<option value="all">All Class</option>
						</select>
					</div>
					<label class="col-sm-1 control-label">
						<strong></strong>Section</strong><span class="symbol required"></span>
					</label>
					
					<div class="col-sm-2"  >
						<select class="form-control" id="sectionId1" style="width: 130px;" name="section"></select>
					</div>
				</div>
				<div class="col-sm-12">				
					<div class="table-responsive" id="homeWorkList"></div><!-- end: table-responsive -->
				</div>
			</div><!-- end: panel Body -->
		</div><!-- end: panel panel-white -->
		
	</div><!-- end: MAIN PANEL COL-SM-12 -->
</div><!-- end: PAGE ROW-->
					