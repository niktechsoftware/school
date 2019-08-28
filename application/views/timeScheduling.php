<div class="row">
 	<div class="col-md-12 ">
		<div class="panel panel-white">
            <div class="panel-heading panel-orange">
	            <i class="fa fa-external-link-square"></i>
								Time Scheduling :
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
<!-- ---------------------------------------------------- START BODY ---------------------------------------------------- -->
            <div class="row"> 
            	<div class="panel-body">
				<div class="alert btn-purple">
						<button data-dismiss="alert" class="close">×</button>
						<h4 class="media-heading text-center">Welcome to Time Scheduling Area</h4>
						<p>
                            Here you can see Teacher class taken time scheduling,Please select all check boxes and wait for few second and see you time scheduling.
						</p> 
				</div>
			
			<div class="container">
			<div class="row">
				
				<div class="col-md-4 center"> 
				<select name="period_name" id="period_name" class="form-control" required>
					<option value="-nop-">-NOP-</option>
					<?php
					$this->db->where('school_code',$this->session->userdata('school_code'));
					$period_name=$this->db->get('no_of_period')->result();
					foreach($period_name as $data ){?>
					<option value="<?php echo $data->id ?>"><?php echo $data->period_name ?></option>
					<?php } ?>
				</select>
				</div>	
				<div  id="days" class="col-md-6 center">
								<input type='checkbox' id="monday" name='day[]' value="1">Monday
								<input type='checkbox' id="tuesday" name='day[]' value="2">Tuesday
								<input type='checkbox' id="wednesday" name='day[]' value="3">Wednesday
								<input type='checkbox' id="thursday" name='day[]' value="4">Thursday
								<input type='checkbox' id="friday" name='day[]' value="5">Friday
								<input type='checkbox' id="saturday" name='day[]' value="6">Saturday 
				</div>
				<div class="col-md-2"></div>
			</div>
					</div>
                </div>                                
            	</div>
          </div>
        </div>        
      </div>
      <div id="structperiod"></div>