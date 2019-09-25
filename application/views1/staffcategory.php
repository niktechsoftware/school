<form action="<?php echo base_url();?>index.php/employeeController/staffcategory"  method ="post">

<div class="row">
	<div class="col-md-12">
	<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel">
			<div class="panel-heading panel-orange">
				<i class="fa fa-external-link-square"></i>
                Change Staff Category    
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
								<a class="panel-config" href="#panel-config" data-toggle="modal"> <i class="fa fa-wrench"></i> <span>Configurations</span></a>
							</li>
							<li>
								<a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="panel-body">

<div class="alert alert-info">	
<h3 class="media-heading text-center">Welcome to Change Staff Category Area</h3>
<p class="media-timestamp">If you want to change Staff Job Category,then first fill Staff Id in the Box and click on Get Detail and wait for Next Page.Thank You....
</div>

				<div class="row space20">
					<div class="col-sm-6">
						<label class="col-sm-4 control-label">
							Enter Staff ID<span class="symbol required"></span>
						</label>

						<div class="col-sm-8">
							<input type="text" class="form-control" name="staff_id" id="staff_id" placeholder=" ">
						</div>
					</div>
					<div id = "rahul" class="col-sm-6">

					</div>
				</div>

			</div>

		</div>
	</div>
</div>
</form>