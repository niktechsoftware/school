<div class="row">
							<div class="col-md-12">
								<!-- start: DYNAMIC TABLE PANEL -->
								<div class="panel panel-white">
								  <div class="panel-heading panel-purple">
									
										<h4 class="panel-title">Your <span class="text-bold">Employee HomeWork </span></h4>
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
                            		<div class="row">
                            			<div class="col-md-12">

                <table class="table table-striped table bordered">
                <tr>
                <th>Name</th>
                <th>Submite Date</th>
        	    <th>HomeWork</th>
                </tr>
            <?php 
            foreach($hw as $data)
            {
            $teacherid=$data->submitted_by;
            $this->db->where('username',$teacherid);
  	         $username=$this->db->get('employee_info')->row();
     ?>
            <tr>
            <td><?php echo $username->name; ?></td>
             <td><?php echo $data->submitted_date; ?></td>
            <td><a href="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/submithomeWork/<?php echo $data->upload_file; ?>" download>
                <button class="btn btn-info"  width="104" height="142">Download</button></a> </td>
            </tr>
            </tr>
            <?php
             }
            ?>
            </table>
            </div></div></div></div></div>
            </div>
