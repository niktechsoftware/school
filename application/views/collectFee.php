<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-sm-12">
		<!-- start: INLINE TABS PANEL -->
		<div class="panel panel-white">
		
			<div class="panel-heading panel-pink">
				<h4 class="panel-title">Student  <span class="text-bold">Fee Collect Area</span></h4>
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
			    <div class="alert alert-info"><h3 class="media-heading text-center">Welcome to Fees Collection Area</h3><p class="media-timestamp">If you want to show student fee collection then 
		enter student id in student id box and click on get record button. Then open new form fill all detail in the form and show all fees of student and save it.</div>
				<div class="row">
					<div class="col-sm-12">
					<?php if(($this->uri->segment(3) == "feeFalse")){?>
						<div class="alert alert-danger">
							<button data-dismiss="alert" class="close">
								&times;
							</button>
							<strong>Oh my god...!</strong> Somthing Wrong contact Niktech Software Solutions... :(
						</div>
					<?php } ?>
						<div class="panel panel-calendar">
							<div class="panel-heading panel-purple border-light">
								<h4 class="panel-title">Collect <span class="text-bold">Student Fees</span></h4>
							</div>
							<div class="panel-body">
						<form action="<?php echo base_url();?>index.php/feeControllers/checkID"  method ="post" role="form" class="smart-wizard form-horizontal" id="form">

							<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
						                      <label for="inputStandard" class="col-lg-6 control-label">
						                      		Student ID <span style="color:red">*</span>
						                      </label>
						                      <div class="col-lg-6">
						                        <input type="text" id="studid" name="studid" class="form-control text-uppercase" onkeyup="stuBirthPlace()" />
						                       
						                      </div>
						                </div>	
									</div>
									<div class="col-sm-6" id="getFsd">
											
									</div>
									
								</div>
								OR
								<div class="row">
								<div class="col-sm-6">
										<div class="form-group">
						                      <label for="inputStandard" class="col-lg-6 control-label">
						                      	Student	Name <span style="color:red">*</span>
						                      </label>
						                      <div class="col-lg-6">
						                        <input type="text" id="stuname" name="stuname" onkeyup="autocomplet()" class="form-control text-uppercase"  />
						                        <ul style="list-style: none; padding:0px;" id="student_list_id"></ul>
						                      </div>
						                </div>	
									</div>
								</div>	
							</form>
							<script>
							function autocomplet() {
								var min_length = 1; // min caracters to display the autocomplete
								var keyword = $('#stuname').val();
								if (keyword.length >= min_length) {
									$.ajax({
										url: '<?php echo site_url("feeControllers/searchstudent");?>',
										type: 'POST',
										data: {keyword:keyword},
										success:function(data){
											$('#student_list_id').show();
											$('#student_list_id').html(data);
										}
									});
								} else {
									$('#student_list_id').hide();
									
									
								}
							}
							function set_item(item) {
								$('#stuname').val(item);
								// change input value
								var studentid = $("#stuname").val();
								//alert(studentid);
								$.post("<?php echo site_url("index.php/feeControllers/getFsd") ?>",{studentid : studentid}, function(data){
									$("#getFsd").html(data);
									});
								
							}
														
							</script>
				                <div class="panel-body">
									<?php
								//	echo $stud_id;
									if($stud_id!='0'){
									$pk=$totdata;
									//$pk->student_info.id;
									if($fsddate->num_rows()>0){
									    $fsddate = $fsddate->row()->finance_start_date;
									    	$fee_record=$this->feemodel->getperfeerecord($pk->id);
										?>
								<form action="<?php echo base_url(); ?>index.php/feeControllers/payFee" method="post" id ="form2">
												    <div class ="row">
												        <div class="col-sm-12">
														<?php if($this->uri->segment(4)){?>
												<input type="hidden"  id ="fsd_id" name ="fsdid" value="<?php echo $fsd_id; ?>" class="form-control"  />
												<?php }?>  

												            <div class="row">
															<div class="alert alert-warning"> <strong class="">Note :-This is fee section.here you can deposit fee. Procedure for fee deposit is-First choose Pay Mode,Pay Date,Student Category after that click on those month which you want to pay.
														You can pay two or more month at a time press control button and choose you month you want to pay </div>
												                <div class="col-sm-4">
												                    <div class="panel panel-white">
												                    <div class="panel-heading panel-red text-uppercase">Student Detail</div>
												                        <div class="row">
												                            <div class="col-sm-12">
												                                <div class="row space15">
												                                    <div class="portfolio-item center">
																					<?php if(strlen($pk->photo > 0)):?>
																						<img alt="<?php echo $pk->name;?>" class="img-circle" height="148" width="140" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/<?php echo $pk->photo;?>" />
																					<?php else:?>
																						<?php if($pk->gender == "1"):?>
																							<img alt="<?php echo $pk->name;?>" class="img-circle" height="148" width="140" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/stuMale.png" />
																						<?php endif;?>
																						<?php if($pk->gender == "0"):?>
																							<img alt="<?php echo $pk->name;?>" class="img-circle" height="148" width="140" src="<?php echo $this->config->item('asset_url'); ?><?php echo $this->session->userdata("school_code");?>/images/stuImage/stuFemale.png" />
																						<?php endif;?>
																					<?php endif;?>  
												                                    </div>
												                                </div>
												                                <div class="row space15">
												                                    <div class="col-sm-12">
												                                        <div class="col-sm-4 text-uppercase">Student Name & ID</div>
												                                        <div class="col-sm-8">
												                                            <span class="text-bold text-uppercase"><?php echo $pk->name."[".$pk->username."]";?></span>
												                                        </div>
												                                    </div>
												                                </div>
												                                <div class="row space15">
												                                    <div class="col-sm-12">
												                                        <div class="col-sm-4 text-uppercase">Father Name</div>
												                                        <div class="col-sm-8">
												                                            <span class="text-bold text-uppercase"><?php echo $pk->father_full_name;?></span>
												                                        </div>
												                                    </div>
												                                    <input type="hidden" name ="stuId" id = "stuId" value="<?php echo $pk->id; ?>" />
												                                </div>

																				<?php $this->db->where('id',$pk->class_id);

																				$classname=$this->db->get("class_info")->row();
                                                                            
																				 $this->db->where('id',$classname->section);
																				$classsection=$this->db->get("class_section");
																				
																				?>
												                                <div class="row space15">
												                                    <div class="col-sm-12">
												                                        <div class="col-sm-4 text-uppercase">Class &amp; Sec.</div>
												                                        <div class="col-sm-8">
												                                            <span class="text-bold text-uppercase"><?php echo $classname->class_name;?></span>

																							& <span class="text-bold text-uppercase"><?php if($classsection->num_rows()>0){ echo $classsection->row()->section;}else {echo "N/A";}?></span>

												                                        </div>
												                                    </div>
												                                </div>
												                                
												                                <div class="row space15">
												                                    <div class="col-sm-12">
												                                        <div class="col-sm-4 text-uppercase">Address</div>
												                                        <div class="col-sm-8">
												                                            <span class="text-bold text-uppercase">
												                                                <?php echo $pk->address1 ?>

												                                                <?php echo $pk->city ?>
												                                                <?php echo $pk->state."-".$pk->pin_code;?>
												                                            </span>
												                                        </div>
												                                    </div>
												                                </div>
												                                <div class="row space15">
												                                    <div class="col-sm-12">
												                                        <div class="col-sm-4 text-uppercase">Mobile Number</div>
												                                        <div class="col-sm-8">
												                                            <input type="hidden" name ="mobile" id ="mobile" value="<?php echo $pk->mobile; ?>" />
												                                            <span class="text-bold"><?php echo $pk->mobile;?></span>
												                                        </div>
												                                    </div>
												                                </div>
												                                <div class="row space15">
												                                    <div class="col-sm-12">
												                                        <div class="col-sm-4 text-uppercase">Pay Mode</div>
												                                        <div class="col-sm-8">
												                                            <select class="form-control text-uppercase" id="payFeeMode" name="payment_mode" required="required">
												                                                <option value="">-Select Mode-</option>
												                                                <option value="1">Cash Payment</option>
												                                                <option value="2">Online Transfer</option>
												                                                <option value="3">Bank Challan</option>
												                                                <option value="4">Cheque</option>
												                                                <option value="5">Swap Machine</option>
												                                            </select>
												                                        </div>
												                                    </div>
												                                </div>
												                                 <div class="row space15">
												                                    <div class="col-sm-12">
												                                        <div class="col-sm-4 text-uppercase">Pay Date</div>
												                                        <div class="col-sm-8">
									                                                    <input type="datetime" class="form-control" name ="subdate" value="<?php echo date('Y-m-d H:i:s');?>" required/>

												                                        </div>
												                                    </div>
												                                </div>
												                            
												                                	<div class="row space15">
												                                    <div class="col-sm-12">
												                                        <div class="col-sm-4 text-uppercase">Student Category</div>
												                                        <div class="col-sm-8">
												                                            <select class="form-control text-uppercase" id="scat" name="s_cat" required="required">
																								<?php 
																									$this->db->where('student_id',$pk->id);
																									$this->db->where('school_code',$this->session->userdata('school_code'));
																									$student_cat=$this->db->get('fee_deposit');
																								//	print_r($student_cat->row()->feecat);exit;
																									
																								
																								$school_code=$this->session->userdata('school_code');
																								$this->db->where('school_code',$school_code);
																								$cat=$this->db->get('fee_cat');
																								// print_r($cat) ;
																								if($cat->num_rows()>0){
																								 foreach($cat->result() as $sc):?>
												                                                <option  value="<?php echo $sc->id;?>"><?php echo $sc->cat_name;?></option>
																							   <?php endforeach; }else{
                                                                                                         echo 'First define student type in setting menu inside fee category';
																							   }?>
																							   
																							</select>
																							
												                                        </div>
												                                    </div>
												                                </div>
												                                <div class="alert panel-pink" id="onlinePayDetails" style="display: none">
																					<button data-dismiss="alert" class="close">�</button>
																					<h4 class="media-heading text-center">Online Fee Payment Charges</h4>
																					<p>* Credit Card Rs.0.03 + GST as applicable </p>
																					<p>* Net Banking  Rs.20.00 + GST as applicable</p>
																					<p>* Debit Card Rs.0.01 + GST as applicable </p>
																					<p>* Amex Card 3.60 %</p>
																					<p>* Wallet 2.50 %</p>
																					<p>* BHIM UPI Rs.0.00 + GST as applicable</p>
																					<p>* Post-Paid 2.90 %</p>
																				</div>
												                                
												                            </div><!-- End 12div column -->
												                        </div><!-- End row -->
												                    </div> <!-- End panel -->
												                </div>
												                <div class="col-sm-8">
												                    <div class="panel panel-white">
												                        <div class="col-sm-12">
												                            <div class="row">
												                                <div class="col-sm-12">
												                                    <?php
												                                    $this->db->select("*");
												                                       $this->db->where("school_code",$this->session->userdata("school_code"));
												                                      $apm1  =  $this->db->get("late_fees");
												                                      
												                                       $this->db->distinct();

												                                     $monthDeposit =  $this->db->query("select deposite_months.deposite_month from deposite_months join fee_deposit on fee_deposit.invoice_no = deposite_months.invoice_no where fee_deposit.status=1 and fee_deposit.finance_start_date='$fsd_id' and deposite_months.student_id='$pk->id' order by deposite_months.id ASC");
                       // echo "<pre>";    print_r($monthDeposit->result()); echo "</pre>";
                                                                                		 /*  $this->db->select("*");
                                                                                		   $this->db->where("student_id",$pk->id);
                                                                                		    $this->db->where("fsd",$fsd_id);
                                                                                		   $monthDeposit = $this->db->get("deposite_months");*/
												                                    
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
												                                                 "partition-blue",
												                                                "partition-purple"
												                                        );
												                                    ?>
												                                    <div class="progress">


												                                        <?php


												                                        $i=1;
												                                        if($fee_record->num_rows()>0){
												                                            
												                                     $j=1;  
												                                       
                                                                      foreach($monthDeposit->result() as $mdf):
												                                           ?>
												                                            <div class="progress-bar <?php echo $color[$i];?>" style="width: 8.33%">
												                                            <?php

												                                          if($mdf->deposite_month<3){


												                                                $deposite_month =$mdf->deposite_month-4+12;
												                                            }else{
												                                              $deposite_month =$mdf->deposite_month-4;  
												                                            }

												                                            $rdt =date('Y-m-d', strtotime("$deposite_month months", strtotime($fsddate)));
												                                            //$rdt = "01-".$fd->month_number."-2019";
												                                            echo date("M-y",strtotime("$rdt"));
												                                            ?>
												                                        </div>
												                                        <?php $i++; endforeach;
												                                       }else{
												                                           
												                                      if($apm1->num_rows()>0){
												                                          $apm =$apm1->row()->apply_method;
												                                          $h=0; $pm=12/$apm;
												                                          for($j=1;$j<$pm+1;$j++){?>

												                                      
												                                        <?php } }?>
												                                        <?php  } ?>
												                                    </div>
												                                </div>
												                            </div>

												                            <div class="row space20">
												                                <div class="col-sm-12">
												                                    <select multiple="multiple" id="form-field-select-2" name="diposit_month[]" class="form-control search-select" required="required">

													                                      <?php
													                                      if($fee_record->num_rows()>0){
													                                            $j=0;  foreach($monthDeposit->result() as $fd):
                                                                                                $mpinffd[$j]  = $fd->deposite_month;
                                                                                            $j++;
                                                                                            endforeach;
                                                                                          
												                                            $this->db->distinct();
                                                                                		    $this->db->select("taken_month");
                                                                                		    $this->db->where("class_id",$pk->class_id);
                                                                                		    $this->db->where_not_in("taken_month",$mpinffd);
                                                                                		   $monthDeposit1 = $this->db->get("class_fees");
                                                                                		   $monthDe=$monthDeposit1->num_rows();
                                                                                		   //foreach($monthDeposit1->result() as $mdf1):
                                                                                		    $apm =$apm1->row()->apply_method;
													                                              $h=0; $pm=12/$apm;
                                                                                		   for($j=1;$j<$pm+1;$j++){
                                                                                           // if($j > $monthDeposit->num_rows()){
												                                           ?>
												                                            <div class="progress-bar <?php echo $color[$j];?>" style="width: 8.33%">
												                                            <?php
												                                            //$deposite_month1 =$mdf1->taken_month-4;
												                                            $rdt =date('Y-m-d', strtotime("$h months", strtotime($fsddate)));
												                                           $print=0;
												                                            foreach($mpinffd as $mcheck):
												                                                  if($h+4 > 12){
												                                                       $h=$h-12;  
												                                                    }
												                                                if($mcheck==$h+4){
												                                                    $print =1;
												                                                    echo $mcheck."tttt".$mcheck;
												                                                }else{
												                                                     echo $mcheck."ggggg".$mcheck;
												                                                }
												                                                endforeach;
												                                         if($print==1){ }else{ ?>
													                                     
													                                            <option value="<?php  echo $h+4;?>">
													                                                <?php echo date("M-Y",strtotime($rdt));?>
													                                            </option>
													                                            <?php }?>
												                                        </div>
												                                        <?php  // }  
												                                        $h=$h+$apm; $i++;}//endforeach;
													                                      }else{
																							if($apm1->num_rows()>0){
																								$apm =$apm1->row()->apply_method;
																								$h=0; $pm=12/$apm;
																								for($j=1;$j<$pm+1;$j++){
                                                                                            	$rdt = date('Y-m-d', strtotime("$h months", strtotime($fsddate)));
																									$ft=$h+4;
																									if($ft>12){
											                                                         $ft=$ft-12;}?>
																									<option value="<?php echo $ft;?>">
																									<?php echo date("M-Y",strtotime($rdt));?>
																									</option>
																		                              <?php
																						             
																						             $h=$h+$apm;

																						    }
																							}}?>
																		
													                      
												                                    </select>
												                                </div>
												                            </div>
												                             
												                            <br/><br/>
												                        </div>
												                    </div>
												<!-- ------------------------------------------------- Payment mode and Fee Detail Column Start ------------------------------------------------------ -->
												                    <div class="row">
												                        <div class="col-sm-12">
												<!-- ------------------------------------------------- Payment mode Column Start ------------------------------------------------------ -->
												                           <div class="table-responsive">
    												                            <table class="table table-striped table-hover" >
    																			<tr>
    												                            <td id="basicfee"></td>
    												                            </tr></table>
												                            </div>
												<!-- ------------------------------------------------- Fee Detail Column ------------------------------------------------------ -->
												                        </div>
												                    </div>
												<!-- ------------------------------------------------- Payment mode and Fee Detail Column End ------------------------------------------------------ -->
																</div>
												            </div>
												        </div>
												    </div>
												</form>
                                               <?php $this->db->where('school_code',$this->session->userdata('school_code'));
                                               $catid=$this->db->get('fee_cat');
                                               ?>
												<script type="text/javascript">
												    $("#payFeeMode").change(function () {
													    if (this.value === "2"){
													        $("#onlinePayDetails").show();
													    } else {
													        $("#onlinePayDetails").hide();
													    }
													});
												    
													$("#form-field-select-2").change(function(){
														var month=[];var i=0;
														var stuId = $("#stuId").val();
															var catId = $("#scat").val();
															var fsdid = $("#fsd_id").val();
															
														$('#form-field-select-2 :selected').each(function(i, selectedElement) {
															month[i] =$(selectedElement).val();


															});

														//	alert(month[i]+stuId+catId +fsdid);


														$.post("<?php echo site_url('feeControllers/getFeeDetails') ?>", {month : month,stuId : stuId,catId : catId, fsdid : fsdid}, function(data){
															$("#basicfee").html(data);

														});


													});
													$("#paid").keyup(function(){
														var c = Number($("#total").val()) - $("#paid").val();
														$("#sub_total").val($("#paid").val());
														$("#sub_total1").val($("#paid").val());
														$("#cb").val(c);
														$("#cb1").val(c);
													});

		//---------------------------------------------------------------------------------------------------

	                                        </script>
									<?php }else{
									echo "FSD NOT SET PLESE DEFINE FSD IN FSD TABLE";
									}}?>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>