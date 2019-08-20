<div class="row">
	<div class="col-md-12">
		<!-- start: RESPONSIVE TABLE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading panel-orange">
				<h4 class="panel-title">Teacher <span class="text-bold">Leave Detail</span></h4>
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
			    <div class="alert alert-info"><h3 class="media-heading text-center">Welcome to Teacher Leave Detail Area,</h3>
                    <p class="media-timestamp">
                        Here you can see your leave details.If your leave is Approved then you will see Approved Button.
                        You can also request for Leave by click on Define New Leave Button. 
                    </p>
                </div>
				<div class="form-group">
				<div class="col-sm-12">	
			<div class="row">
				<div class="col-md-12 space20">
				<div class="btn-group pull-right">
				<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
					Export <i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu dropdown-light pull-right">
					<li>
						<a href="#" class="export-excel" data-table="#sample-table-2" data-ignoreColumn ="3,4">
							Export to Excel
						</a>
					</li>
				</ul>
			</div>
		</div>
			
	<div class="table-responsive">
		<table class="table table-striped table-hover" id="example">
			<thead>
				<tr>
					<th>S.no.</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Total leave</th>
					<td>Reason</td>
					<th>Action</th>
					
				</tr>
			</thead>
			<tbody>
			<?php 
		
			    $color = array(
				    "progress-bar-danger",
				    "progress-bar-success",
				    "progress-bar-warning",
				    "progress-partition-green",
				    "partition-azure",
				    "partition-blue",
				    "partition-orange",
				    "partition-purple",
				    "progress-bar-danger",
				    "progress-bar-success",
				    "progress-partition-green",
				    "partition-purple"
			    );
			    
			    $this->load->model("singleTeacherModel");
			   $v1=$this->session->userdata('username');
                $this->db->where("username",$v1);
                $eid=$this->db->get("employee_info");
                $id= $eid->row();
                $v = $id->id;
			    $var = $this->singleTeacherModel->getTeacherLeave($v);
			    
			    
			    $count = 1;
			foreach($var->result() as $lv): ?>
				<?php if($count%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
                     <tr class="<?php echo $rowcss;?>">
		  			<td><?php echo $count;?></td>
		  			<td><?php echo $lv->start_date;?></td>
		  			<td><?php echo $lv->end_date;?></td>
		  			<td><?php echo $lv->total_leave;?></td>
		  			<td><?php echo strtoupper($lv->reason);?></td>
		  			<?php if($lv->status==0){?>
		  				<input type="hidden" id="rowid" value="<?php echo $lv->id;?>">
		  			<td><button type="submit" id ="leavedelete" class="btn btn-red">
				           Cancle leave
				</button></td>
			<?php }else{?>
           <td><button type="submit"  class="btn btn-yellow">
				          Approved
				</button></td>
            
			<?php } ?>
		  		</tr>
		  		<?php $count++; endforeach; ?>
		  		
			</tbody>
			
		</table>
		<div><div class="col-sm-2 col-sm-offset-8">
				<button type="submit" id = "sonu" class="btn btn-green next-step btn-block">
				Define New Leave <i class="fa fa-arrow-circle-left"></i>
				</button>
			</div>
			
								<div id="stuLeave">
								<form action="<?php echo base_url();?>index.php/singleTeacherControllers/insertLeave" method ="post">
										<div class="form-group">
<div class="row">
<div class="col-md-6">
<label class="col-md-5 control-label">
Start Date  <span class="symbol required"></span>
</label>
<div class="col-md-7 form-group">
<input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years" name="sdate" value="<?php echo set_value('empDob'); ?>" class="form-control date-picker" required="required"/>
</div>
</div>


<div class="col-md-6">
<label class="col-md-5 control-label">
End Date <span class="symbol required"></span>
</label>
<div class="col-md-7 form-group">
<input type="date" data-date-format="yyyy-mm-dd" data-date-viewmode="years"  name="edate" value="<?php echo set_value('empDob'); ?>" class="form-control date-picker" required="required"/>
</div>

</div>
</div>

<div class="row">
<div class="col-md-6">
<label class="col-md-5 control-label">
Total Leave  
</label>
<div class="col-sm-7 form-group">
<input type="number" class="form-control" id="totalLeave" name="totalLeave"  required="required" value="<?php echo set_value('empPhoneNumber'); ?>" >
</div>
</div>
<div class="col-md-6">
<label class="col-md-5 control-label">
Reason  
</label>
<div class="col-md-7 form-group ">
<input type="text" class="form-control text-uppercase"  required="required" id="reason" name="reason" value="<?php echo set_value('empPhoneNumber'); ?>" title="Only alphabate allow" >
</div>
</div>
</div>

<div class="col-sm-2 col-sm-offset-8">
<button type="submit" class="btn btn-blue next-step btn-block">
Submit <i class="fa fa-arrow-circle-left"></i>
</button>
</div>
</div>
	</form>
											
											</div>
		
		</div>
		</div>
	</div>		
	</div>
			</div><!-- end: panel Body -->
		</div><!-- end: panel panel-white -->
		
	</div><!-- end: MAIN PANEL COL-SM-12 -->
</div><!-- end: PAGE ROW-->
	</div>				