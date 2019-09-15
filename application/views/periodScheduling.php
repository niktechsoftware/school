
     <div class="row"> 
        <div class="col-sm-15">     
                <div class="panel panel-calendar">
                    <div class="panel-heading panel-blue">
                        <h4 class="panel-title">Settings</h4>
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
                <div class="panel-body">
			<div class="alert alert-info"><h3 class="media-heading text-center">Welcome to Period Time Table scheduling Area</h3>
			<p class="media-timestamp">Welcome to time scheduling area
				  In this section you create a period and lunch time firstly select a no of period 
				  in a number of period box then create a period time list when you create time list 
				  then show in right side panel.
				</p>
			</div> 
                    <form action="<?php echo base_url();?>index.php/periodTimeControllers/insertPeriod" method="post">
                    <div class="row"> 
                    <div class="panel-body padding-bottom-none">
                        <div class="col-md-10 col-lg-10 col-lg-offset-1">
              
                            <div class="row">
                            
                                <table class="table" style="width:100%;">
                                    <?php $i=1; if($i%2==0){$rowcss="warning";}else{$rowcss ="danger";}?>
                                 <tr class="<?php echo $rowcss;?>">
                                     <td>
                                <?php 
                                $this->db->where('id',$period_name);
                                $periodname=$this->db->get('no_of_period')->row();  ?> 
                                <?php echo "Exam Name:-".$periodname->period_name."<br>"." Date:- [ ". $periodname->created_date. " ] ";?>
                                 </td>
                                        <td align="right">Number of Period</td>
                                        <td>
                                            <select name="nop" id="nop" class="form-control" required>
                                            <option value="-nop-">-NOP-</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            </select>
                                        </td>
                                        </tr>
                                <input type="hidden" id ="tb_id" name ="period_name"  value="<?php echo $period_name;?>" />
                                 <input type="hidden" name ="pdate" value="<?php echo $pdate;?>" />
                                 <input type="hidden" name ="nopid" value="<?php echo $period_name;?>" />
                                  </table>
                            </div>
                            <div class="col-md-12">
					<div class="col-md-7" id="sectionList"></div>
                   
                          
					<div class="col-md-5">
						<div class="panel">
							<div class="panel-heading panel-blue border-light">
								<h4 class="panel-title">Present Number Of Period</h4>
							</div>
							<div class="panel-body panel-scroll height-700" >
								<table class="table table-bordered table-hover ">
									<thead>
										<tr>
											<th>#</th>
											<th>Period Name</th>
											<th>From</th>
											<th>To</th>
										</tr>
									</thead>
									<tbody>
										<?php $i=1; foreach($request as $row): ?><tr>
											<td><?php echo $i;?></td>
											<td><?php echo $row->period;?></td>
											<td><?php echo $row->from;?></td>
											<td><?php echo $row->to;?></td>
										</tr>
										<?php $i++;endforeach; ?>
									</tbody>
								</table>
							</div> <!-- End Body scroll panel -->
						</div> <!-- End Panle -->
					</div> <!-- End Col 5 -->
				</div> 
                    </div>
                    </div>                                
                </div>
            </form>
             </div>
             </div>
           </div>
        </div>
        