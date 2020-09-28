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
                    <form action="<?php echo base_url();?>index.php/examControllers/create_ques" method="post">
                    <div class="row"> 
                    <div class="panel-body padding-bottom-none">
                        <div class="col-md-10 col-lg-10 col-lg-offset-1">
              
                            <div class="row">
                            
                                <table class="table" style="width:100%;">
                                    <?php $i=1; if($i%2==0){$rowcss="warning";}else{$rowcss ="danger";}?>
                                 <tr class="<?php echo $rowcss;?>">
                                     <td>
                                <?php 
                               // $this->db->where('id',$period_name);
                                //$periodname=$this->db->get('no_of_period')->row();  ?> 
                                <?php //echo "Exam Name:-".$periodname->period_name."<br>"." Date:- [ ". $periodname->created_date. " ] ";?>
                                 </td>
                                        <td align="center"><h5>Number of Questions</h5></td>
                                        <td>
                                            <select name="nop" id="nop" class="form-control" required>
                                            <option value="-nop-">-NOP-</option>
											 <option value="4">4</option>
                                            <option value="6">6</option>
                                            <option value="8">8</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="30">30</option>
                                            <option value="40">40</option>
                                            <option value="50">50</option>
                                            <option value="60">60</option>
											 <option value="70">70</option> 
											 <option value="80">80</option>
											  <option value="90">90</option>
											   <option value="100">100</option>
                                            </select>
                                        </td>
                                        </tr>
                              <!--  <input type="hidden" id ="tb_id" name ="period_name"  value="<?php //echo $period_name;?>" />
                                 <input type="hidden" name ="pdate" value="<?php //echo $pdate;?>" />
                                 <input type="hidden" name ="nopid" value="<?php //echo $period_name;?>" />-->
							</table>
							<center><input type="submit" value="OK"  class="btn btn-success"/></center> 
                        </div>
                     </div>
                  </div>                                
                </div>
            </form>
             </div>
             </div>
           </div>
        </div>
     