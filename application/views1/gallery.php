<div class="row">
							<div class="col-md-12">
								<!-- start: DYNAMIC TABLE PANEL -->
								<div class="panel panel-white">
								  <div class="panel-heading panel-purple">
									
										<h4 class="panel-title">Update <span class="text-bold"> Website Gallery</span></h4>
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
                            				<form class="form-horizontal" action="<?php echo base_url()?>noticeControllers/saveGallery" method="post" enctype="multipart/form-data">
		                                        <?php $raj=$this->uri->segment(3);
		                                        if($raj==23)
		                                        {
		                                        echo '<div class="alert alert-warning">Successfully Uploaded Image </div>';
		                                        	
		                                        }?>
		                                        
		                                        
		                           
																				<div class="row space15">
																					<div class="col-md-3">&nbsp;&nbsp;&nbsp;&nbsp;Title</div>
																					<div class="col-sm-4">
																						<input type="text" class="form-control" id="input-Default" name="title">
																					
																					</div>
																				</div>
																				<div class="row space15">
																					<div class="col-md-3">&nbsp;&nbsp;&nbsp;&nbsp;Gallery Image (Max. 1000kb)</div>
																					<div class="col-md-4"><input type="file"  name="selectedStu" /></div>
																					
																				</div>
																				<div class="row space15">
																					<div class="col-md-3">&nbsp;&nbsp;&nbsp;&nbsp;Image Description</div>
																					<div class="col-md-4">
																					<input type ="text" name="category"/>
																			
																			
																			</div>
																				</div>
																				<div class="row space15">
																					<div class="col-md-4">
																						&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-success">Upload Image</button>
																					</div>
																					
																				</div>
																			</div>
		                            
		                                    </form>
                            			</div>
                            		</div>
                            	
                                   <div class="table-responsive">
                                   <div><h3><center>Uploaded Images</center></h3></div>
                                    <table id="example" class="table table-striped table-hover" >
                                        <thead>
                                            <tr class = "success">
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Image</th>
                                                 <th>Image Type</th>
                                                <th>Date</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php $i = 1;?>
                                        	<?php $this->db->where("school_code",$this->session->userdata("school_code"));
                                        	$res = $this->db->get("gallery")->result();?>
                                        	<?php foreach($res as $row):
                                        	
                                        	if($i%2==0){$rowcss="danger";}else{$rowcss ="warning";}?>
                                            <tr class="<?php echo $rowcss;?>">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row->name; ?></td>
                                              <td><img width="50" height="50" src="<?php echo base_url();?>assets/gal/<?php echo $row->image; ?>" alt="" /></td>
                                                 <td><?php echo $row->image_type; ?></td>
                                                <td><?php echo $row->date; ?></td>
                                                <td>
                                                	<a href="<?php echo base_url();?>noticeControllers/deleteGallery/<?php echo $row->sno;?>">
                                                		Delete
                                                	</a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                            <?php endforeach;?>
                                        </tbody>
                                       </table>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row -->
               