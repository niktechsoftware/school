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
										<div>  <p class="alert alert-warning">Welcome to Student Discount Panel...</p>
										 <p class="alert alert-info"> Note : This is the area you can see  All Discount Type and its username.  <br>
										</div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered" id="aarju">
                                                <thead>
                                                    <tr>
                                                        <th>S. No.</th>
                                                        <th> Discounter Username</th>
                                                        <th>Employee Name</th>
                                                        <th>Student Username</th>
                                                        <th>Student Name</th>
                                                        <th>Discount Amount</th>
                                                        <th>Class</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                              $scode= $this->session->userdata("school_code");
                                            
                                             $fsd = $this->session->userdata("fsd");
                                                    $this->db->where('school_code',$scode);
                                                    $disc = $this->db->get('dis_den_tab')->result();
                                                    $i=1;
                                                    foreach($disc as $row){
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
                                                   <td><?php echo $row->discount_rupee;?></td>
                                                   <td><?php echo $class->class_name; ?></td>
                                                  
                                            </tr>
                                                <?php $i++; } } } }?>
                                               
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
								<!-- end: INLINE TABS PANEL -->
							</div>
						</div>
						<!-- end: PAGE CONTENT-->
