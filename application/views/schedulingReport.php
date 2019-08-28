
<?php $school_code = $this->session->userdata("school_code");?>
<div class="row">
	<div class="col-md-12">
	<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-orange">
				<i class="fa fa-external-link-square"></i>
				Time Scheduling
			</div>
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
			<div class="panel-body"  >

<div class="alert alert-info"><h3 class="media-heading text-center">Welcome to Time Scheduling Report Area</h3>
<p class="media-timestamp">
	Here you can see class time Scheduling report .
</p>
</div>
<div class="row">
	<div class="col-md-4"></div>
<div class="col-md-4 center"> 
	<select name="no_of_period" id="no_of_period" class="form-control" required>
		<option value="-nop-">-NOP-</option>
		<?php
		$this->db->where('school_code',$this->session->userdata('school_code'));
		$period_name=$this->db->get('no_of_period')->result();
		foreach($period_name as $data ){?>
		<option value="<?php echo $data->id ?>"><?php echo $data->period_name ?></option>
		<?php } ?>
	</select>
</div>	
<div class="col-md-4"></div>
</div><br>
<div class="row" id="report"></div>
</div>
</div>
</div>
</div>
						<!-- end: PAGE CONTENT-->

