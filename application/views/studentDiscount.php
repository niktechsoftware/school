<!-- start: PAGE CONTENT -->
<div class="row">
							<div class="col-sm-12">
								<!-- start: INLINE TABS PANEL -->
								<div class="panel panel-white">
									<div class="panel-heading">
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
													<a class="panel-expand" href="#"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a>
												</li>
											</ul>
											</div>
										</div>
									</div>
									<div class="panel-body">
										<div>  <p class="alert alert-warning">Welcome to Student Discount By OTP And Other Panel </p>
										 <p class="alert alert-info"> Note : This is the area you can see  All Discount Type and its username.  <br>
										</div>
										<div class="row">
						<div class="col-md-12 space20">
							<div class="btn-group pull-right">
								<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
									Export <i class="fa fa-angle-down"></i>
								</button>
								<?php if($this->session->userdata('login_type') == 'admin'){?>
								<ul class="dropdown-menu dropdown-light pull-right">
									<!--<li>-->
									<!--	<a href="#" class="export-pdf" data-table="#sample-table-2" >-->
									<!--		Save as PDF-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-png" data-table="#sample-table-2">-->
									<!--		Save as PNG-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-csv" data-table="#sample-table-2" >-->
									<!--		Save as CSV-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-txt" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as TXT-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-xml" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as XML-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-sql" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as SQL-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-json" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Save as JSON-->
									<!--	</a>-->
									<!--</li>-->
									<li>
										<a href="#" class="export-excel" data-table="#sample-table-2" >
											Export to Excel
										</a>
									</li>
									<!--<li>-->
									<!--	<a href="#" class="export-doc" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Export to Word-->
									<!--	</a>-->
									<!--</li>-->
									<!--<li>-->
									<!--	<a href="#" class="export-powerpoint" data-table="#sample-table-2" data-ignoreColumn ="3,4">-->
									<!--		Export to PowerPoint-->
									<!--	</a>-->
									<!--</li>-->
								</ul>
								<?php }?>
							</div>
						</div>
					</div>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="sample-table-2">
                                                <thead>
                                                    <tr>
                                                        <th>S. No.</th>
                                                        <th> Discounter Username</th>
                                                        <th>Employee Name</th>
                                                        <th>Student Username</th>
                                                        <th>Student Name</th>
                                                        <th>Discount Amount</th>
                                                        <th>Class</th>
                                                        <th>OTP</th>
                                                        <th>OTP ID</th>
                                                        <th>Given Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                              $scode= $this->session->userdata("school_code");
                                            
                                             $fsd = $this->session->userdata("fsd");
                                                    $this->db->where('school_code',$scode);
                                                    $disc = $this->db->get('dis_den_tab');
                                                    $i=1;$totr=0;
                                                    foreach($disc->result() as $row){
                                                        $this->db->where('username',$row->discounter_id);
                                                        $emp=$this->db->get('employee_info')->result();
                                                       // print_r($emp);
                                                    foreach($emp as $row1){
                                                        $this->db->where('invoice_no',$row->invoice_number);
                                                       $dBook= $this->db->get('day_book')->result();
                                                        //print_r($dBook);
                                                       foreach($dBook as $dbook){
                                                           $this->db->where('id',$dbook->paid_by);
                                                           $stud = $this->db->get('student_info')->result();
                                                           //print_r($stud);
                                                           foreach($stud as $student){
                                                           
                                                                $this->db->where('id',$student->class_id);
                                                               $class= $this->db->get('class_info')->row();

                                                ?>
                                                <tr>
                                                <td><?php echo $i;?></td>
                                                   <td><?php echo $row1->username;?></td>
                                                   <td><?php echo $row1->name;?></td>
                                                   <td><?php echo $student->name;?></td>
                                                   <td><?php echo $student->username;?></td>
                                                   <td><?php $totr=$totr+$row->discount_rupee; echo $row->discount_rupee;?></td>
                                                   <td><?php echo $class->class_name; ?></td>
                                                   <td><?php if(strlen($row->otp)>4){echo $row->otp; }else{echo "By System";}?></td>
                                                    <td><?php echo $row->s_otp; ?></td>
                                                    <td><?php echo $row->generate_date;?></td>
                                            </tr>
                                                <?php $i++; } } } }?>
                                               <tr>
                                               	<td></td>
                                               	<td></td>
                                               	<td></td>
                                               	<td></td>
                                               	<td></td>
                                               	<td><?php echo $totr; ?></td>
                                               	<td></td>
                                               	<td></td>
                                               <td></td>
                                                 <td></td>
                                              
                                               
                                               </tr>
                                                </tbody>
                                                <!-- <tfoot>
                                                <tr>
                                                    <th>S no.</th>
                                                    <th>Username</th>
                                                      <th>Name</th>
                                                      <th>Class</th>
                                                      <th>Discount Name</th>
                                                      <th>Discount Amount /Persent</th>
                                                      <th>Discount Username</th>
                                                    </tr>
                                                </tfoot> -->
                                            </table>
                                            </div>
                                        </div>
                                    </div>
								</div>
								<!-- end: INLINE TABS PANEL -->
							</div>
						</div>
						<!-- end: PAGE CONTENT-->
