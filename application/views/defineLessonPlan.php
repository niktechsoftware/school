<div class="row">
	<div class="col-md-12">
		<div class="panel panel-white">
			<div class="panel-heading panel-blue">
				<i class="fa fa-external-link-square"></i>
					Define Lession Plan :
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
			</div> <!-- End Panel Heading -->
			<div class="panel-body">
			<form action ="<?php echo base_url();?>index.php/periodTimeControllers/defineclassplan" method ="post">
				<div>
					<div class="alert alert-info"><h3 class="media-heading text-center">Welcome to Define Lesson Plan</h3>
					<p class="media-timestamp">If you want to see Period Time Days, select Start date and end date and click on the Define Class Plan Button, you will get full information. If you want to change this time then click on the reset Button and save it again.</div>
					<div class="row space15">
						<div class="col-md-12">
							<div class="col-md-3"><h4><b>Start Date</b></h4></div>
								<div class="col-sm-3">
								<input type="date" name ="sdate" required="required"/>
								</div>

							<div class="col-md-3"><h4><b>End Date</b></h4></div>
								<div class="col-sm-3">
								<input type="date" name ="edate" required="required"/>
								</div>
							</div>
					</div>
					<div>
							<button type="submit" class="btn btn-light-purple">Define Class Plan<i class="fa fa-arrow-circle-right"></i> </button>
					</div>
			</div>
		</form>
	</div>
</div>
</div>
</div>

