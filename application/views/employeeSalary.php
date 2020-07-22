<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-white">

							<div class="panel-heading panel-red border-light">
								<h4 class="panel-title">Employee <span class="text-bold">List</span></h4>
							</div>
							<div class="panel-body">
							    <div class="alert alert-info">
							    <button data-dismiss="alert" class="close">×</button>
								<h3 class="media-heading text-center">Welcome to Employee Salary Section</h3>
                                <p class="media-timestamp">This Panel where You can  Configure and Pay        Salary  of the Empolyee.
                                if <strong> Configure Status is Not Configured </strong> so First Configure  Salary structure of the Empolyee by press the  Button where Empolyee Name is print. 
                                if <strong> Configure Status is Configured </strong> so pay the Salary of the Empolyee by 
                                 press the  Button where Empolyee Name is print.</div>
								<div class="panel-scroll height-1000">
									<table class="table table-hover" id="sample-table-1">
										<thead>
											<tr>
												<th style="width: 5%;">SNo.</th>
												<th style="width: 10%;">Emp. ID.</th>
												<th style="width: 10%;">Name</th>
												<th style="width: 15%;">Configure Salary</th>
												<th style="width: 15%;">Pay Salary</th>
												<th style="width: 60%;">Paid Status</th>
											</tr>
										</thead>
										<tbody id="classDetail">
											<?php $j = 1; ?>
											<?php if(isset($empList)):?>
											<?php foreach($empList as $row):?>
											<tr>
												<td>
													<?php echo $j;?>
												</td>
												<td>
													<?php echo $row->username;?>
													<input type="hidden" id="id<?php echo $j;?>" value="<?php echo $row->id;?>">
												</td>
												<td>

												
							                    		<?php echo $row->name;?>
							                    
												</td>
												<td>
													<?php
														$this->load->model("employeeModel");
													$qres = $this->employeeModel->getSalaryDetail($row->id);
														if($qres->num_rows()>0)
														{?>
															<button class="btn btn-blue btn-sm" id="classSave<?php echo $j;?>" value="<?php echo $row->name;?>">
														<?php	echo "<b style='color:white;'>Re Configure</b>"; ?>
																</button>
													<?php	}
														else
														{ ?> 
														<button class="btn btn-blue btn-sm" id="classSave<?php echo $j;?>" value="<?php echo $row->name;?>">
														<?php	echo "<b style='color:white;'> Configure</b>"; ?>
														</button>
													<?php	}
													?>
												</td>
													<td>
													    	<button class="btn btn-blue btn-sm" id="classSave1<?php echo $j;?>" value="<?php echo $row->name;?>">
													    	    Pay Salary
                                                               </button>
							                    
												</td>
												<td>
												<?php
												$school_code=$this->session->userdata("school_code");
                                                  $fsd=$this->session->userdata("fsd");
												 $this->db->where('id',$fsd);
                                                 $this->db->where('school_code',$school_code);
                                                 $fsdstart1=$this->db->get('fsd')->row();
                                                   $fsdstart=$fsdstart1->finance_start_date;
												$b=array();
												if($qres->num_rows()>0){
													$this->db->select("SUM(monthNo) as month");
													$this->db->where("school_code",$this->session->userdata("school_code"));
													$this->db->where("emp_id",$row->id);
													$this->db->where('fsd',$this->session->userdata('fsd'));
													$a = $this->db->get("emp_salary_info");
												$this->db->where("emp_id",$row->id);
												$this->db->where("school_code",$this->session->userdata("school_code"));
												$b = $this->db->get("emp_salary_info")->row();
												$month = $a->row()->month;
											//$b=$this->db->query("SELECT fsd FROM emp_salary_info WHERE emp_id = '$row->username' order by `id` asc limit 1")->row();
												if(($month>0)&&($month<12)){
												$fsd=$b->fsd;
												}else{
													if($month>12){
														$month=$month-12;
													}
													$fsd = $this->session->userdata("fsd");
												}
												}
												else{
												$fsd = $this->session->userdata("fsd");
												$month = 0;
												}
							                         $color = array(
							                             "partition-purple",
							                             "progress-partition-green",
							                             "progress-bar-warning",
							                             "progress-bar-success",
							                             "progress-partition-green",
							                             "partition-azure",
							                             "partition-orange",
							                             "progress-bar-success",
							                             "partition-blue",
							                             "progress-bar-danger",
							                             "progress-bar-danger",
							                             "partition-purple",
							                         );
							                         if($b){

							                    ?>
								                    <div class="progress">
								                       	<input type="hidden" name="fsd" value="<?php echo $fsd; ?>" />
								                        <input type="hidden" name="month" value="<?php echo $month; ?>" />
								                        <?php for($i =0 ; $i<=$month-1; $i++):?>
								                        <div class="progress-bar <?php echo $color[$i];?>" style="width: 8.33%">
								                        	<?php echo date("M-y",strtotime("$fsdstart + $i month"));?>
								                        </div>
								                        <?php endfor; ?>
								                    </div>
								                    <?php }?>
												</td>
											</tr>
											<?php $j++; ?>
											<?php endforeach; ?>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
					<!-- end: INLINE TABS PANEL -->
<div class="row">
	<div class="col-md-12"  id="givenDetail">

	</div>
</div>

<!-- end: PAGE CONTENT-->