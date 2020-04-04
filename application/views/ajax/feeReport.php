
		<br/><br/>
		<div class="row">
			<div class="col-md-12 space20">
				<div class="btn-group pull-right">
					<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
						Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu dropdown-light pull-right">
						<li>
							<a href="#" class="export-excel" data-table="#sample-table-2" >
								Export to Excel
							</a>
						</li>

						<li>
							<a href="#" class="export-csv" data-table="#sample-table-2" >
								Save as CSV
							</a>
						</li>
						<li>
							<a href="#" class="export-doc" data-table="#sample-table-2" data-ignoreColumn ="3,4">
								Export to Word
							</a>
						</li>

					</ul>
				</div>
			</div>
		</div>
		<?php   $count = 1;
			$sum=0;
	$school_code=	$this->session->userdata('school_code');
		$this->db->where('school_code',$this->session->userdata('school_code'));
		$sende_Detail=$this->db->get('sms_setting')->row();
		?>
		<div>   <p class="alert alert-danger"> Available SMS Balance = <?php 
		$cbs=checkBalSms($sende_Detail->uname,$sende_Detail->password)+$sende_Detail->sms_bal;
		echo $cbs;?></p>
		 <p class="alert alert-info"> Note : This is the area you can send Fee reminder to send click send sms button . If you send SMS change to Success Message send Successfully . <br>
		</div>
	<?php 	$fsd=$this->input->post("fsd"); 
	if($cla == "all" && $sec == "all"){ ?>
		<div class="table-responsive">
		
			<table class="table table-striped table-hover" id="sample-table-2">
				<thead>
					<tr class = "success">
						<th>SNo</th>
						<th>Student id</th>
						<th>Student Name</th>
						<th>Class & Section</th>
						<th>Father Mobile </th>
						<th>Father Name</th>
						<th>Paid Fee  Month</th>
						<th>Total Pay Amount</th>
						<th>Total Paid Amount</th>
						<th>Total Due Amount</th>
						<th>Full Detail</th>
						<th>Sms Send</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if($stidRecord->num_rows() > 0){
				foreach($stidRecord->result() as $sid):
			
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
				    $count = 1;
				    $tot=0.00;
				    $totalpaidp=0;
				    $totalduep=0;
				    $tilldatedue=0;
				    ?>
				
				<?php 
			
				    $rowcss = "danger";
				    $count = 1;
						$tot=0.00;
						$this->db->where("id",$fsd);
						$fdate =$this->db->get("fsd")->row()->finance_start_date;

						$sum=0;
				    	$stu_id = $sid->id;
				        $stuDetail= $this->allFormModel->getStu_record_fsdSingleid($stu_id)->row();
				    		$total = $this->db->query("SELECT DISTINCT(class_id) as classid, SUM(paid) as totalpaid, SUM(total) as totaldeposite,invoice_no from fee_deposit WHERE student_id = '$stu_id' AND finance_start_date='$fsd' AND school_code='$school_code'")->row(); 
							$rowcss = $count % 2 == 0 ? "danger" : "warning";
						?>
					<tr class="<?php echo $rowcss;?>">
			  		<td><?php echo $count;?></td>
			  				<td><strong><?php echo $stuDetail->username;?></strong></td>
			  			<td><?php echo $stuDetail->name;?>
			  			    <input type = "hidden" id="sname<?php echo $count;?>" value="<?php echo $stuDetail->name;?>"/></td>
						  <td><strong><?php 
						 $classinfo =  $this->allFormModel->classDetailsbyId($total->classid);
						  echo $classinfo['class']." & ".$classinfo['section'];?></strong> </td> 
						  <td><strong><?php if(strlen($stuDetail->mobile) > 1) {echo $stuDetail->mobile; }else echo "N/A"; ?>
                    </strong><input type = "hidden" id="mnum<?php echo $count;?>" value="<?php echo $stuDetail->mobile;?>"/></td>
                      
                          
                          <td><strong><?php if(strlen($stuDetail->father_full_name) > 1) {echo $stuDetail->father_full_name; }else echo "N/A"; ?><?php //echo $rows->father_full_name;
                          
                        ?></strong><input type = "hidden" id="fname<?php echo $count;?>" value="<?php echo $stuDetail->father_full_name;?>"/></td></td>
                          
                          <td>
			  			
							<?php 
							
						
								//$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("student_id",$stu_id);
								$this->db->where("fsd",$fsd);
								$fee_record = $this->db->get("deposite_months");
							
			               $i=0;
							foreach($fee_record->result() as $fd):
								?>
								<span class="label label-success" style="line-height:20px;">
								<?php 
							 if($fd->deposite_month<4){
								$realm=  $fd->deposite_month-4+12;
					 
							}else{
							 $realm= $fd->deposite_month-4;}
							//	$realm = $fd->deposite_month-4;
								echo date('M-Y', strtotime("$realm months", strtotime($fdate)));
								//echo date("d-M-y",strtotime("$rdt1"));?>
								 </span>
									
							<?php $i++; endforeach;  ?>
						</td>
					
					
			  			<td>
			  			<?php  
			  			$cd=0;
			  			if($this->input->post("fsd")){
			  				$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("student_id",$stu_id);
								$this->db->where("finance_start_date",$fsd);
							//	$this->db->where("status",1);
								$feedue = $this->db->get("fee_deposit");
								
								foreach($feedue->result() as $fd):?>
																
								<!-- <span class="label label-success" style="line-height:20px;">
								<?php //echo date("M-y",strtotime("$fd->diposit_date"));?> 
								 </span> -->
								<?php $cd=$cd+$fd->total;?>
							 <?php  endforeach; 
			  			   }
			  		  ?>
			  			<?php $totalduep += $cd; echo $cd;?>
							</td>
							<td>
							<?php  $totalpaidp += $total->totalpaid; echo $total->totalpaid;?>
						</td>
						<td>
							
							<?php 
					            	$depmonth=array();
					            	$mbk=0;
								 	$this->db->order_by('id','desc'); 
								 	$this->db->where('student_id',$stu_id);
                                 	$mbalance=$this->db->get('feedue');
								 	//print_r($mbalance->mbalance);
								 	if($mbalance->num_rows()>0){
								 	   
								 	if(strlen($mbalance->row()->mbalance)>0){
									echo	$mbk= "Previous Balance ".$mbalance->row()->mbalance."<br>";
                                	print_r($mbalance->row()->mbalance);
									?>
									<input type = "hidden" id="amt1<?php echo $count;?>" value="<?php echo $mbalance->row()->mbalance;?>"/>
									<?php
									}
								 	    
								 	}
									$cdate = date("Y-m-d");
									if($this->session->userdata("school_code")==9){
									    	$cmonth = date("Y-m",strtotime("1 months", strtotime($cdate)));
									}else{
									    	$cmonth = date("Y-m",strtotime($cdate));
									}
								//	$cmonth = date("Y-m",strtotime($cdate));
									$curmon = date("m",strtotime($cdate));
									//print_r($stu_id);
									$this->db->where("student_id",$stu_id);
									$dipom = $this->db->get("deposite_months");
									if($dipom->num_rows()>0){
										$g=0;	
											foreach($dipom->result() as $dip):
												$depmonth[$g]=$dip->deposite_month;
												//echo $depmonth[$g];
												$g++;
											endforeach;
												//print_r($depmonth);
        										$this->db->where_not_in("month_number",$depmonth);
        										$this->db->where("school_code",$this->session->userdata("school_code"));
        										$fcd = 	$this->db->get("fee_card_detail");
        										if($fcd->num_rows()>0){
    									       	$searchM[]=0;	$rt=0;$month="";	
    											foreach($fcd->result() as $fcg):
    											if($fcg->month_number<4){
    												$roldm=$fcg->month_number-4+12;
    											}
    											else{
    												$roldm=$fcg->month_number-4;
    											}
            									$oldm =  date('Y-m', strtotime("$roldm months", strtotime($fdate)));
            									if($oldm<=$cmonth){
            										$searchM[$rt]=$fcg->month_number;
            										echo $duedate= date("M-Y",strtotime($oldm));
            										$month =$month." and ".$duedate;
            									
            										$rt++;
						                      	}
							
									endforeach;
										?><input type = "hidden" id="rem<?php echo $count;?>" value="<?php echo $month;?>"/><?php
								if($rt>0){
							//	$searchM[$rt]=13;
								$dt=Date("y-m-d");
								
									//$this->db->distinct();
							
								
									$this->db->select_sum("fee_head_amount");
									if($school_code ==1){
										$this->db->where("cat_id",3);}
									$this->db->where("fsd",$fsd);
									$this->db->where("class_id",$stuDetail->class_id);
									
								 $this->db->where("taken_month",13);
								 
								 $fee_head = $this->db->get("class_fees");
								 if($fee_head->num_rows()>0){
									 $fee_head_one =$fee_head->row()->fee_head_amount;

									// print_r($fee_head->row()->fee_head_amount);
									 	// print_r($searchM);
									 	 $this->db->select_sum('fee_head_amount');
									 	 $this->db->from('class_fees');

									 	$this->db->where("fsd",$fsd);
									    $this->db->where("class_id",$stuDetail->class_id);
									 	 $this->db->where_in("taken_month",$searchM);
								 
							         	 $examfee = $this->db->get();
								 // print_r($examfee->row()->fee_head_amount);
							
								 if($examfee->num_rows()>0){
								    
								         
								    $exfee= $examfee->row()->fee_head_amount;

								    //	 print_r($exfee);

									$totfee2= $fee_head_one * $rt;
								//	print_r($totfee2);
									$totfee=$totfee2+$exfee;
										
								
								 } 
								 else{
								 	$totfee=$fee_head_one * $rt;
								 		// print_r($totfee);
								 } 
								 if($stuDetail->transport==1){
								     $vid=$stuDetail->vehicle_pickup;
								     $this->db->where("id",$vid);
								    $rootdt= $this->db->get("transport_root_amount");
								     if($rootdt->num_rows()>0){
								       $tfee1=  $rootdt->row()->transport_fee;
								       $tfee=$tfee1*$rt;
								       $totfee=$totfee+ $tfee;
								     }
								     else{
								         echo "root not define";
								     }
								     
								 } 
								 else{
								     $totfee =$totfee;
								 }
								 
								 			$this->db->where('school_code',$school_code);
						$feecat=$this->db->get('late_fees')->row()->apply_cat;
						if($feecat==1){
						if($fee_record->num_rows()>0){
					   $i=0;
						foreach($fee_record->result() as $fd):
							?>
							<?php 
						 if($fd->deposite_month<4){
							$cdate11=date('Y-m-d');
							$mno=(int)date('m',strtotime($cdate11));
							if($mno < $fd->deposite_month){
							    $realm=0;
							 //  print_r($mno);
							 //    print_r($mno);
							}else{
								//echo $mno;
							$realm= $mno- $fd->deposite_month-1;}
				          // print_r($realm);
						 }else{
							$cdate11=date('Y-m-d');
							if($cdate11>='2020-01-01'){
							$mno=(int)date('m',strtotime($cdate11));
						 $realm= $mno-$fd->deposite_month+12-1;
						// print_r($realm);
						}else{
							$mno=(int)date('m',strtotime($cdate11));
						if($mno<$fd->deposite_month){
						    $realm=0;
							    
							}else{
								
								//echo $mno;
							$realm= $mno- $fd->deposite_month;
							
							}
				// 			print_r($mno);
				// 		print_r($fd->deposite_month);
						 }
						}
						?>
								
						<?php $i++; endforeach; 
						
						
						$this->db->where('school_code',$school_code);
						$amt=$this->db->get('late_fees')->row()->late_fee;
						
							$this->db->where('month_number',$mno);
						$this->db->where('school_code',$school_code);
						$depdate1=$this->db->get('fee_card_detail')->row();
						$depdate=date("y-m-d", strtotime($depdate1->deposite_date));
						 $date=date("y-m-d");
						
					
						if($realm==1 && $date<$depdate){
						   
						        $latefee1=0.00;
						    
						}else{
                        $latefee1=$amt*$realm;
                       
						}
                       
					}else{
						$cdate11=date('Y-m-d');
							if($cdate11>='2020-01-01'){
							$mno=(int)date('m',strtotime($cdate11));
						
						 $realm= $mno-4+12;
						}else{
							$mno=(int)date('m',strtotime($cdate11));
						
						
                            $realm= $mno-4;
						 }?>	
						<?php 
						$this->db->where('school_code',$school_code);
						$amt=$this->db->get('late_fees')->row()->late_fee;
                        $latefee1=$amt*$realm;
                       
					}}else{
					   
						$latefee1='0.00';
						 
					 }
					 
									  $sum=$sum +$totfee +$latefee1 ;
									$totalfee=$totfee + $latefee1;
								
								 echo "<br>".$totalfee;
										?><input type = "hidden" id="amt<?php echo $count;?>" value="<?php echo $totfee+$latefee1;?>"/><?php
								 }else{
									 echo "fee Not found";								}
							 }
							}else{
								echo "Define Deposite Date in Configuration Fee section";
							}

							}else{
							    $searchM[0]=0;
							    $m = 0;
								$this->db->where("school_code",$this->session->userdata("school_code"));
								$fcd = 	$this->db->get("fee_card_detail");
								$rt=0;
									$month="";
								foreach($fcd->result() as $fcg):
									if($fcg->month_number<4){
										$roldm=$fcg->month_number-4+12;
									}else{
									$roldm=$fcg->month_number-4;
									}	$oldm =  date('Y-m', strtotime("$roldm months", strtotime($fdate)));
									if($oldm<=$cmonth){
										$searchM[$rt]=$fcg->month_number;
										echo $duedate = date("M-Y",strtotime($oldm));
							 	    $month =$month." and ".$duedate;
										$rt++;
										$m++;
								//	echo $fcg->month_number;
								//	echo $cmonth;
									
							}
								endforeach;
							?><input type = "hidden" id="rem<?php echo $count;?>" value="<?php echo $month;?>"/><?php
								$adable_amount=0;
						  //	$searchM[$rt]=13;
								//$this->db->distinct();
								$this->db->select_sum("fee_head_amount");
								$this->db->where("fsd",$fsd);
								$this->db->where("class_id",$stuDetail->class_id);
							//	print_r($stuDetail->class_id);
							if($school_code ==1){$this->db->where("cat_id",3);}
							
							    $this->db->where_in("taken_month",13);
								$fee_head = $this->db->get("class_fees");
								if($fee_head->num_rows()>0){
								    
	                                $this->db->select_sum("fee_head_amount");   
									$this->db->where("class_id",$stuDetail->class_id);
									//	print_r($stuDetail->class_id);
									$this->db->where("fsd",$fsd);

											$this->db->where("taken_month",13);

										$one_all_amount = $this->db->get("class_fees");
										$one_all_amount=$one_all_amount->row()->fee_head_amount;
									/*echo $one_all_amount."al";
										for($ui=0;$ui<$rt;$ui++){
											if($ui>0){
												$adable_amount =$one_all_amount+$adable_amount;
											}
										}*/
										$hmfee = $fee_head->row()->fee_head_amount*($m);
										$monthtotald=$one_all_amount;
									$fee_head =$hmfee +	$monthtotald; 
									
									 if($stuDetail->transport==1){
								     $vid=$stuDetail->vehicle_pickup;
								     $this->db->where("id",$vid);
								    $rootdt= $this->db->get("transport_root_amount");
								     if($rootdt->num_rows()>0){
								       $tfee2=  $rootdt->row()->transport_fee;
								       $tfee3=$tfee2*($m);
								       $fee_head=$fee_head+ $tfee3;
								     }
								     else{
								         echo "root not define";
								     }
								     
								 } 
								 else{
								     $fee_head =$fee_head;
								 }
								 
								 		$this->db->where('school_code',$school_code);
						$feecat=$this->db->get('late_fees')->row()->apply_cat;
						if($feecat==1){
						if($fee_record->num_rows()>0){
					   $i=0;
						foreach($fee_record->result() as $fd):
							?>
							<?php 
						 if($fd->deposite_month<4){
							$cdate11=date('Y-m-d');
							$mno=(int)date('m',strtotime($cdate11));
							if($mno < $fd->deposite_month){
							    $realm=0;
							 //  print_r($mno);
							 //    print_r($mno);
							}else{
								//echo $mno;
							$realm= $mno- $fd->deposite_month-1;}
				          // print_r($realm);
						 }else{
							$cdate11=date('Y-m-d');
							if($cdate11>='2020-01-01'){
							$mno=(int)date('m',strtotime($cdate11));
						 $realm= $mno-$fd->deposite_month+12-1;
						// print_r($realm);
						}else{
							$mno=(int)date('m',strtotime($cdate11));
						if($mno<$fd->deposite_month){
						    $realm=0;
							    
							}else{
								
								//echo $mno;
							$realm= $mno- $fd->deposite_month;
							
							}
				// 			print_r($mno);
				// 		print_r($fd->deposite_month);
						 }
						}
						?>
								
						<?php $i++; endforeach; 
						
						
						$this->db->where('school_code',$school_code);
						$amt=$this->db->get('late_fees')->row()->late_fee;
						
							$this->db->where('month_number',$mno);
						$this->db->where('school_code',$school_code);
						$depdate1=$this->db->get('fee_card_detail')->row();
						$depdate=date("y-m-d", strtotime($depdate1->deposite_date));
						 $date=date("y-m-d");
						
					
						if($realm==1 && $date<$depdate){
						   
						        $latefee1=0.00;
						    
						}else{
                        $latefee1=$amt*$realm;
                       
						}
                       
					}else{
						$cdate11=date('Y-m-d');
							if($cdate11>='2020-01-01'){
							$mno=(int)date('m',strtotime($cdate11));
						
						 $realm= $mno-4+12;
						}else{
							$mno=(int)date('m',strtotime($cdate11));
						
						
                            $realm= $mno-4;
						 }?>	
						<?php 
						$this->db->where('school_code',$school_code);
						$amt=$this->db->get('late_fees')->row()->late_fee;
                        $latefee1=$amt*$realm;
					}}else{
						$latefee1='0.00';
					 }
									//print_r($m);
										//print_r($one_all_amount);
								
									$sum=$sum +$fee_head+$latefee1;
								$totalfee=	$fee_head +$latefee1;
								echo "<br>".$totalfee;
						//	print_r($fee_head);
							   	?><input type = "hidden" id="amt<?php echo $count;?>" value="<?php echo $fee_head +$latefee1;?>"/><?php
								}else{
									echo "fee Not found";}
							}

							?>
						</td>
			  			<td>
							<a href="<?php echo base_url()?>index.php/feeControllers/feesDetail/<?php echo $stu_id;?>/<?php echo $fsd;?>" target="_blank" class="btn btn-blue">
								View Detail
							</a></td>
								<td>
							<button class="btn btn-yellow" id ="smstodew<?php echo $count;?>" >
								Send SMS
							</button></td>
							<script>
			  		
			  			$("#smstodew<?php echo $count;?>").click(function(){
			  				var smstodue = $("#rem<?php echo $count;?>").val();
			  				var sname = $("#sname<?php echo $count;?>").val();
			  				var fname = $("#fname<?php echo $count;?>").val();
			  				var mnum = $("#mnum<?php echo $count;?>").val();
							var amount = $("#amt<?php echo $count;?>").val();
							var amount1 = $("#amt1<?php echo $count;?>").val();
				// alert(amount1);
				// alert(amount);
					$.post("<?php echo site_url("index.php/feeControllers/feeRemSms") ?>",{smstodue : smstodue,sname : sname,fname : fname,mnum : mnum,amount : amount,amount1 : amount1}, function(data){
						$("#smstodew<?php echo $count;?>").html(data);
					});
				
				});
			  			</script>
			  			
			  		</tr>
			  		<?php  ?>
			  		<?php $count++; endforeach;?>
			  		</tbody>
				<tfoot>
				    <tr>
				        <td></td>
				        <td>Total Due</td>
				        <td></td>
				        <td></td>
				        <td></td>
				        <td></td>
				        <td></td>
				        <td></td>
				        <td><?php echo $sum;?></td>
				    </tr>
				</tfoot>
				
			</table>
		</div>
	
		

				<?php }else{?>

<br/><br/>
			<div class="alert alert-block alert-danger fade in">
				<button data-dismiss="alert" class="close" type="button">
					&times;
				</button>
				<h4 class="alert-heading"><i class="fa fa-times"></i> Error! <?php echo $student->num_rows();?></h4>
				<p>
					No record found from Fee database please submit fee first of this class &amp; section... 
				</p>
			</div>
		
<?php }  }
	else{
	   
$sum=0;
?>
		<div class="table-responsive">
			<table class="table table-striped table-hover" id="sample-table-2">
				<thead>
					<tr class = "success">
						<th>SNo</th>
						<th>Student Id</th>
						<th>Student Name</th>
						<th>Class & Section</th>
						<th>Father Mobile </th>
						<th>Father Name</th>
						<th>Paid Fee  Month</th>
						<th>Total Pay Amount</th>
						<th>Total Paid Amount</th>
						<th>Total Due Amount</th>
						<th>Full Detail</th>
						<th>Sms Send</th>
					</tr>
				</thead>
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
				    $count = 1;
				    $tot=0.00;
				    $totalpaidp=0;
				    $totalduep=0;
				    $tilldatedue=0;
				    ?>
				<tbody>
				<?php 
					if($stidRecordfsdclass->num_rows() > 0){
	    //print_r($stidRecordfsdclass);
        
				    $rowcss = "danger";
				    $count = 1;
				  
						$tot=0.00;
						$this->db->where("id",$fsd);
						$fdate = $this->db->get("fsd")->row()->finance_start_date;
	                foreach($stidRecordfsdclass->result() as $sid):
	                      $stu_id=$sid->id;
					
								 //$x=0;
                //  print_r($student->num_rows());
				    $stuDetail= $this->allFormModel->getStu_record_fsdSingleid($stu_id)->row();
				    		$total = $this->db->query("SELECT DISTINCT(class_id) as classid, SUM(paid) as totalpaid, SUM(total) as totaldeposite,invoice_no from fee_deposit WHERE student_id = '$stu_id' AND finance_start_date='$fsd' AND school_code='$school_code'")->row(); 
								
							$rowcss = $count % 2 == 0 ? "danger" : "warning";
						?>
					<tr class="<?php echo $rowcss;?>">
			  		<td><?php echo $count;?></td>
			  				<td><strong><?php echo $stuDetail->username;?></strong>
			  			<td><?php echo $stuDetail->name;?>
			  			<input type = "hidden" id="sname<?php echo $count;?>" value="<?php echo $stuDetail->name;?>"/></td>
						      <td><strong><?php 
						 $classinfo =  $this->allFormModel->classDetailsbyId($total->classid);
						  echo $classinfo['class']." & ".$classinfo['section'];?></strong> </td> 
						  <td><strong><?php if(strlen($stuDetail->mobile) > 1) {echo $stuDetail->mobile; }else echo "N/A"; ?>
                            </strong><input type = "hidden" id="mnum<?php echo $count;?>" value="<?php echo $stuDetail->mobile;?>"/></td>
                      
                          
                          <td><strong><?php if(strlen($stuDetail->father_full_name) > 1) {echo $stuDetail->father_full_name; }else echo "N/A"; ?><?php //echo $rows->father_full_name;
                          
                        ?></strong><input type = "hidden" id="fname<?php echo $count;?>" value="<?php echo $stuDetail->father_full_name;?>"/></td></td>
                          
                          <td>
			  			
							<?php 
							
						
								//$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("student_id",$stu_id);
								$this->db->where("fsd",$fsd);
								$fee_record = $this->db->get("deposite_months");
							
			               $i=0;
							foreach($fee_record->result() as $fd):
								?>
								<span class="label label-success" style="line-height:20px;">
								<?php 
							 if($fd->deposite_month<4){
								$realm=  $fd->deposite_month-4+12;
					 
							}else{
							 $realm= $fd->deposite_month-4;}
							//	$realm = $fd->deposite_month-4;
								echo date('M-Y', strtotime("$realm months", strtotime($fdate)));
								//echo date("d-M-y",strtotime("$rdt1"));?>
								 </span>
									
							<?php $i++; endforeach;  ?>
						</td>
					
					
			  			<td>
			  			<?php  
			  			$cd=0;
			  			if($this->input->post("fsd")){
			  				$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("student_id",$stu_id);
								$this->db->where("finance_start_date",$fsd);
							//	$this->db->where("status",1);
								$feedue = $this->db->get("fee_deposit");
								
								foreach($feedue->result() as $fd):?>
																
								<!-- <span class="label label-success" style="line-height:20px;">
								<?php //echo date("M-y",strtotime("$fd->diposit_date"));?> 
								 </span> -->
								<?php $cd=$cd+$fd->total;?>
							 <?php  endforeach; 
			  			   }
			  		  ?>
			  			<?php $totalduep += $cd; echo $cd;?>
							</td>
							<td>
							<?php  $totalpaidp += $total->totalpaid; echo $total->totalpaid;?>
						</td>
						<td>
							
							<?php 
							$searchM[0]=0;
            						$depmonth=array();
            						$mbk=0;
            					//	print_r($total->invoice_no);
            						
								 	$this->db->order_by('id','desc'); 
								 	$this->db->where('student_id',$stu_id);
                                  	$mbalance=$this->db->get('feedue');
                                  	
								 	//print_r($mbalance->mbalance);
								 	if($mbalance->num_rows()>0){
								 	    
								 	if(strlen($mbalance->row()->mbalance) > 0){
								 	    $db=$mbalance->row()->mbalance;
								 	  //  $db3=$mbalance->row()->invoice_no;
								 	  //  print_r($db3);
									echo	$mbk= "Previous Balance ".$db."<br>";
										?><input type = "hidden" id="amt1<?php echo $count;?>" value="<?php echo $mbalance->row()->mbalance;?>"/><?php
									}}
									$cdate = date("Y-m-d");
									$cmonth = date("Y-m",strtotime($cdate));
									//print_r($stu_id);
									$this->db->where("student_id",$stu_id);
									$dipom = $this->db->get("deposite_months");
									if($dipom->num_rows()>0){
										$g=0;	
    									foreach($dipom->result() as $dip):
    										$depmonth[$g]=$dip->deposite_month;
    									//	echo $depmonth[$g];
    										$g++;	
    									
    									endforeach;
    									//	print_r($depmonth);
										$this->db->where_not_in("month_number",$depmonth);
										$this->db->where("school_code",$this->session->userdata("school_code"));
										$fcd = 	$this->db->get("fee_card_detail");
										if($fcd->num_rows()>0){
							
										$searchM[]=0;$rt=0;$month="";	
											foreach($fcd->result() as $fcg):
											if($fcg->month_number<4){
												$roldm=$fcg->month_number-4+12;
											//	print_r($roldm);
												
											}
											else{
												$roldm=$fcg->month_number-4;
												//	print_r($roldm);
											}
									$oldm =  date('Y-m', strtotime("$roldm months", strtotime($fdate)));
										//print_r($oldm);
									if($oldm<=$cmonth){
										$searchM[$rt]=$fcg->month_number;
										echo $duedate= date("M-Y",strtotime($oldm));
										$month =$month." and ".$duedate;
									
										$rt++;
								//	print_r($month);
										// $rt;
								//	echo $cmonth;
							}
							//echo $rt;
									endforeach;
										?><input type = "hidden" id="rem<?php echo $count;?>" value="<?php echo $month;?>"/><?php
								if($rt>0){
								  //  print_r($rt);
								//$searchM[$rt]=13;
									//$this->db->distinct();
								
									$this->db->select_sum("fee_head_amount");
									if($school_code ==1){
										$this->db->where("cat_id",3);}
									$this->db->where("fsd",$fsd);
									$this->db->where("class_id",$stuDetail->class_id);
									
								 $this->db->where_in("taken_month",13);
								 $fee_head = $this->db->get("class_fees");
								 
								//  	$this->db->select_sum("fee_head_amount");
								// 	if($school_code ==1){
								// 		$this->db->where("cat_id",3);}
								// 	$this->db->where("fsd",$fsd);
								// 	$this->db->where("class_id",$stuDetail->class_id);
									
								//  $this->db->where_in("taken_month",13);
								//  $fee_head_one = $this->db->get("class_fees")->row()->fee_head_amount;
								 
								 if($fee_head->num_rows()>0){ 
									 $fee_head =$fee_head->row()->fee_head_amount;
									 $exdate1=Date("y-m-d");
									 $dte1 = date("m",strtotime($exdate1));
									 
									 //print_r($searchM);
									  $this->db->select_sum('fee_head_amount');
									 	 $this->db->from('class_fees');
									 	$this->db->where("fsd",$fsd);
									    $this->db->where("class_id",$stuDetail->class_id);
									 	 $this->db->where_in("taken_month",$searchM);
								 
								      $examfee1 = $this->db->get();
									 
								 if($examfee1->num_rows()>0){
								     
								    $exfee1= $examfee1->row()->fee_head_amount;
								    
									$totfee2= $fee_head * $rt;
									$totfee=$totfee2+$exfee1;
								 //	print_r($exfee1);
							 //	print_r($fee_head);
								// 	print_r($rt);
								 } 
								 else{
								 	$totfee=$fee_head * $rt;
								// 		print_r($totfee);
								 }
									 if($stuDetail->transport==1){
								     $vid=$stuDetail->vehicle_pickup;
								     $this->db->where("id",$vid);
								    $rootdt= $this->db->get("transport_root_amount");
								     if($rootdt->num_rows()>0){
								       $tfee6=  $rootdt->row()->transport_fee;
								       $tfee7=$tfee6*($rt);
								       $totfee=$totfee+ $tfee7;
								     }
								     else{
								         echo "root not define";
								     }
								     
								 } 
								 else{
								     $totfee =$totfee;
								 }
								 
								 			$this->db->where('school_code',$school_code);
						$feecat=$this->db->get('late_fees')->row()->apply_cat;
						if($feecat==1){
						if($fee_record->num_rows()>0){
					   $i=0;
						foreach($fee_record->result() as $fd):
							?>
							<?php 
						 if($fd->deposite_month<4){
							$cdate11=date('Y-m-d');
							$mno=(int)date('m',strtotime($cdate11));
							if($mno < $fd->deposite_month){
							    $realm=0;
							 //  print_r($mno);
							 //    print_r($mno);
							}else{
								//echo $mno;
							$realm= $mno- $fd->deposite_month-1;}
				          // print_r($realm);
						 }else{
							$cdate11=date('Y-m-d');
							if($cdate11>='2020-01-01'){
							$mno=(int)date('m',strtotime($cdate11));
						 $realm= $mno-$fd->deposite_month+12-1;
						// print_r($realm);
						}else{
							$mno=(int)date('m',strtotime($cdate11));
						if($mno<$fd->deposite_month){
						    $realm=0;
							    
							}else{
								
								//echo $mno;
							$realm= $mno- $fd->deposite_month;
							
							}
				// 			print_r($mno);
				// 		print_r($fd->deposite_month);
						 }
						}
						?>
								
						<?php $i++; endforeach; 
						
						
						$this->db->where('school_code',$school_code);
						$amt=$this->db->get('late_fees')->row()->late_fee;
						
							$this->db->where('month_number',$mno);
						$this->db->where('school_code',$school_code);
						$depdate1=$this->db->get('fee_card_detail')->row();
						$depdate=date("y-m-d", strtotime($depdate1->deposite_date));
						 $date=date("y-m-d");
						
					
						if($realm==1 && $date<$depdate){
						   
						        $latefee1=0.00;
						    
						}else{
                        $latefee1=$amt*$realm;
                       
						}
                       
					}else{
						$cdate11=date('Y-m-d');
							if($cdate11>='2020-01-01'){
							$mno=(int)date('m',strtotime($cdate11));
						
						 $realm= $mno-4+12;
						}else{
							$mno=(int)date('m',strtotime($cdate11));
						
						
                            $realm= $mno-4;
						 }?>	
						<?php 
						$this->db->where('school_code',$school_code);
						$amt=$this->db->get('late_fees')->row()->late_fee;
                        $latefee1=$amt*$realm;
					}}else{
						$latefee1='0.00';
					 }
					 
									// $feehead=$fee_head+($fee_head_one*$rt);
								 $sum=$sum + ($totfee)+$latefee1 ;
									 $totalfee=$totfee +$latefee1;
									
								 echo "<br>". $totalfee;
								// print_r($fee_head);
								// print_r($rt);
								 
										?><input type = "hidden" id="amt<?php echo $count;?>" value="<?php echo $totfee + $latefee1;?>"/><?php
								 }else{
									 echo "fee Not found";								}
							 }
							}else{
								echo "Define Deposite Date in Configuration Fee section";
							}

							}else{
								$this->db->where("school_code",$this->session->userdata("school_code"));
								$fcd = 	$this->db->get("fee_card_detail");
								$rt=0;
									$month="";
								foreach($fcd->result() as $fcg):
									if($fcg->month_number<4){
										$roldm=$fcg->month_number-4+12;
									}else{
									$roldm=$fcg->month_number-4;
									}	$oldm =  date('Y-m', strtotime("$roldm months", strtotime($fdate)));
									if($oldm<=$cmonth){
										$searchM[$rt]=$fcg->month_number;
										echo $duedate = date("M-Y",strtotime($oldm));
							 	    $month =$month." and ".$duedate;
										$rt++;
								//	echo $fcg->month_number;
								//	echo $cmonth;
									
							}
								endforeach;
							?><input type = "hidden" id="rem<?php echo $count;?>" value="<?php echo $month;?>"/><?php
								$adable_amount=0;
						  //	$searchM[$rt]=13;
								//$this->db->distinct();
								$this->db->select_sum("fee_head_amount");
								$this->db->where("fsd",$fsd);
								$this->db->where("class_id",$stuDetail->class_id);
							//	print_r($stuDetail->class_id);
							if($school_code ==1){$this->db->where("cat_id",3);}
							
							    $this->db->where_in("taken_month",13);
								$fee_head = $this->db->get("class_fees");
								
								if($fee_head->num_rows()>0){
								    
								     $this->db->select_sum("fee_head_amount");  
									$this->db->where("class_id",$stuDetail->class_id);
									$this->db->where("fsd",$fsd);
									$this->db->where_in("taken_month",$searchM);
									$one_all_amount = $this->db->get("class_fees");
									if($one_all_amount->num_rows()>0){
										$one_all_amount=$one_all_amount->row()->fee_head_amount;
									
								// 	    for($ui=0;$ui<$rt;$ui++){
								// 			if($ui>0){
								// 				$adable_amount =$one_all_amount+$adable_amount;
								// 			}
								// 		}
								 $fee8=$fee_head->row()->fee_head_amount*($rt);
								 
									$fee9 =$one_all_amount;
									$fee_head=$fee8 + $fee9;
									
									if($stuDetail->transport==1){
								     $vid=$stuDetail->vehicle_pickup;
								     $this->db->where("id",$vid);
								    $rootdt= $this->db->get("transport_root_amount");
								     if($rootdt->num_rows()>0){
								       $tfee4=  $rootdt->row()->transport_fee;
								       $tfee5=$tfee4*($rt);
								       $fee_head=$fee_head+ $tfee5;
								     }
								     else{
								         echo "root not define";
								     }
								     
								 } 
								 else{
								     $fee_head =$fee_head;
								 }
								 		$this->db->where('school_code',$school_code);
						$feecat=$this->db->get('late_fees')->row()->apply_cat;
						if($feecat==1){
						if($fee_record->num_rows()>0){
					   $i=0;
						foreach($fee_record->result() as $fd):
							?>
							<?php 
						 if($fd->deposite_month<4){
							$cdate11=date('Y-m-d');
							$mno=(int)date('m',strtotime($cdate11));
							if($mno < $fd->deposite_month){
							    $realm=0;
							 //  print_r($mno);
							 //    print_r($mno);
							}else{
								//echo $mno;
							$realm= $mno- $fd->deposite_month-1;}
				          // print_r($realm);
						 }else{
							$cdate11=date('Y-m-d');
							if($cdate11>='2020-01-01'){
							$mno=(int)date('m',strtotime($cdate11));
						 $realm= $mno-$fd->deposite_month+12-1;
						// print_r($realm);
						}else{
							$mno=(int)date('m',strtotime($cdate11));
						if($mno<$fd->deposite_month){
						    $realm=0;
							    
							}else{
								
								//echo $mno;
							$realm= $mno- $fd->deposite_month;
							
							}
				// 			print_r($mno);
				// 		print_r($fd->deposite_month);
						 }
						}
						?>
								
						<?php $i++; endforeach; 
						
						
						$this->db->where('school_code',$school_code);
						$amt=$this->db->get('late_fees')->row()->late_fee;
						
							$this->db->where('month_number',$mno);
						$this->db->where('school_code',$school_code);
						$depdate1=$this->db->get('fee_card_detail')->row();
						$depdate=date("y-m-d", strtotime($depdate1->deposite_date));
						 $date=date("y-m-d");
						
					
						if($realm==1 && $date<$depdate){
						   
						        $latefee1=0.00;
						    
						}else{
                        $latefee1=$amt*$realm;
                       
						}
                       
					}else{
						$cdate11=date('Y-m-d');
							if($cdate11>='2020-01-01'){
							$mno=(int)date('m',strtotime($cdate11));
						
						 $realm= $mno-4+12;
						}else{
							$mno=(int)date('m',strtotime($cdate11));
						
						
                            $realm= $mno-4;
						 }?>	
						<?php 
						$this->db->where('school_code',$school_code);
						$amt=$this->db->get('late_fees')->row()->late_fee;
                        $latefee1=$amt*$realm;
					}}else{
						$latefee1='0.00';
					 }
									
									$sum=$sum + $fee_head +$latefee1;
								$totalfee=	$fee_head+$latefee1;
								echo "<br>".$totalfee;
							   	?><input type = "hidden" id="amt<?php echo $count;?>" value="<?php echo $fee_head+$latefee1;?>"/><?php 
								}else{echo "<label style='color:red;'>Configure Fee Head and Amount</label>";}
								}else{
									echo "fee Not found";}
									}

							?>
						</td>
			  			<td>
							<a href="<?php echo base_url()?>index.php/feeControllers/feesDetail/<?php echo $stu_id;?>/<?php echo $fsd;?>" target="_blank" class="btn btn-blue">
								View Detail
							</a></td>
								<td>
							<button class="btn btn-yellow" id ="smstodew<?php echo $count;?>" >
								Send SMS
							</button></td>
							<script>
			  		
			  			$("#smstodew<?php echo $count;?>").click(function(){
			  				var smstodue = $("#rem<?php echo $count;?>").val();
			  				var sname = $("#sname<?php echo $count;?>").val();
			  				var fname = $("#fname<?php echo $count;?>").val();
			  				var mnum = $("#mnum<?php echo $count;?>").val();
							var amount = $("#amt<?php echo $count;?>").val();
							var amount1 = $("#amt1<?php echo $count;?>").val();
				// alert(amount);
				// alert(amount1);
					$.post("<?php echo site_url("index.php/feeControllers/feeRemSms") ?>",{smstodue : smstodue,sname : sname,fname : fname,mnum : mnum,amount : amount,amount1 : amount1}, function(data){
						$("#smstodew<?php echo $count;?>").html(data);
					});
				
				});
			  			</script>
			  			
			  		</tr>
			  		<?php  ?>
			  		<?php $count++;  endforeach; }
        //
        if($fsd!= $this->session->userdata("fsd")){
        $student1= $this->db->query("select DISTINCT(student_info.id) from student_info  where status =1 and fsd ='$fsd' and student_info.class_id ='$cla'" );
        if($student1->num_rows()>0){
           $rowcss = "danger";
				   
				  
						$tot=0.00;
						$this->db->where("id",$fsd);
						$fdate = $this->db->get("fsd")->row()->finance_start_date;
	                foreach($student1->result() as $sid):
	                      $stu_id=$sid->id;
						
								 //$x=0;
                //  print_r($student->num_rows());
				    $stuDetail= $this->allFormModel->getStu_record_fsdSingleid($stu_id)->row();
				    		$total = $this->db->query("SELECT DISTINCT(class_id) as classid, SUM(paid) as totalpaid, SUM(total) as totaldeposite,invoice_no from fee_deposit WHERE student_id = '$stu_id' AND finance_start_date='$fsd' AND school_code='$school_code'")->row(); 
								
							$rowcss = $count % 2 == 0 ? "danger" : "warning";
						?>
					<tr class="<?php echo $rowcss;?>">
			  		<td><?php echo $count;?></td>
			  				<td><strong><?php echo $stuDetail->username;?></strong>
			  			<td><?php echo $stuDetail->name;?>
			  			<input type = "hidden" id="sname<?php echo $count;?>" value="<?php echo $stuDetail->name;?>"/></td>
						      <td><strong><?php 
						 $classinfo =  $this->allFormModel->classDetailsbyId($total->classid);
						  echo $classinfo['class']." & ".$classinfo['section'];?></strong> </td> 
						  <td><strong><?php if(strlen($stuDetail->mobile) > 1) {echo $stuDetail->mobile; }else echo "N/A"; ?>
                            </strong><input type = "hidden" id="mnum<?php echo $count;?>" value="<?php echo $stuDetail->mobile;?>"/></td>
                      
                          
                          <td><strong><?php if(strlen($stuDetail->father_full_name) > 1) {echo $stuDetail->father_full_name; }else echo "N/A"; ?><?php //echo $rows->father_full_name;
                          
                        ?></strong><input type = "hidden" id="fname<?php echo $count;?>" value="<?php echo $stuDetail->father_full_name;?>"/></td></td>
                          
                          <td>
			  			
							<?php 
							
						
								//$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("student_id",$stu_id);
								$this->db->where("fsd",$fsd);
								$fee_record = $this->db->get("deposite_months");
							
			               $i=0;
							foreach($fee_record->result() as $fd):
								?>
								<span class="label label-success" style="line-height:20px;">
								<?php 
							 if($fd->deposite_month<4){
								$realm=  $fd->deposite_month-4+12;
					 
							}else{
							 $realm= $fd->deposite_month-4;}
							//	$realm = $fd->deposite_month-4;
								echo date('M-Y', strtotime("$realm months", strtotime($fdate)));
								//echo date("d-M-y",strtotime("$rdt1"));?>
								 </span>
									
							<?php $i++; endforeach;  ?>
						</td>
					
					
			  			<td>
			  			<?php  
			  			$cd=0;
			  			if($this->input->post("fsd")){
			  				$this->db->where("school_code",$this->session->userdata("school_code"));
								$this->db->where("student_id",$stu_id);
								$this->db->where("finance_start_date",$fsd);
							//	$this->db->where("status",1);
								$feedue = $this->db->get("fee_deposit");
								
								foreach($feedue->result() as $fd):?>
																
								<!-- <span class="label label-success" style="line-height:20px;">
								<?php //echo date("M-y",strtotime("$fd->diposit_date"));?> 
								 </span> -->
								<?php $cd=$cd+$fd->total;?>
							 <?php  endforeach; 
			  			   }
			  		  ?>
			  			<?php $totalduep += $cd; echo $cd;?>
							</td>
							<td>
							<?php  $totalpaidp += $total->totalpaid; echo $total->totalpaid;?>
						</td>
						<td>
							
							<?php 
							$searchM[0]=0;
            						$depmonth=array();
            						$mbk=0;
            					//	print_r($total->invoice_no);
            						
								 	$this->db->order_by('id','desc'); 
								 	$this->db->where('student_id',$stu_id);
                                  	$mbalance=$this->db->get('feedue');
                                  	
								 	//print_r($mbalance->mbalance);
								 	if($mbalance->num_rows()>0){
								 	    
								 	if(strlen($mbalance->row()->mbalance) > 0){
								 	    $db=$mbalance->row()->mbalance;
								 	  //  $db3=$mbalance->row()->invoice_no;
								 	  //  print_r($db3);
									echo	$mbk= "Previous Balance ".$db."<br>";
										?><input type = "hidden" id="amt1<?php echo $count;?>" value="<?php echo $mbalance->row()->mbalance;?>"/><?php
									}}
									$cdate = date("Y-m-d");
									$cmonth = date("Y-m",strtotime($cdate));
									//print_r($stu_id);
									$this->db->where("student_id",$stu_id);
									$dipom = $this->db->get("deposite_months");
									if($dipom->num_rows()>0){
										$g=0;	
    									foreach($dipom->result() as $dip):
    										$depmonth[$g]=$dip->deposite_month;
    									//	echo $depmonth[$g];
    										$g++;	
    									
    									endforeach;
    									//	print_r($depmonth);
										$this->db->where_not_in("month_number",$depmonth);
										$this->db->where("school_code",$this->session->userdata("school_code"));
										$fcd = 	$this->db->get("fee_card_detail");
										if($fcd->num_rows()>0){
							
										$searchM[]=0;$rt=0;$month="";	
											foreach($fcd->result() as $fcg):
											if($fcg->month_number<4){
												$roldm=$fcg->month_number-4+12;
											//	print_r($roldm);
												
											}
											else{
												$roldm=$fcg->month_number-4;
												//	print_r($roldm);
											}
									$oldm =  date('Y-m', strtotime("$roldm months", strtotime($fdate)));
										//print_r($oldm);
									if($oldm<=$cmonth){
										$searchM[$rt]=$fcg->month_number;
										echo $duedate= date("M-Y",strtotime($oldm));
										$month =$month." and ".$duedate;
									
										$rt++;
								//	print_r($month);
										// $rt;
								//	echo $cmonth;
							}
							//echo $rt;
									endforeach;
										?><input type = "hidden" id="rem<?php echo $count;?>" value="<?php echo $month;?>"/><?php
								if($rt>0){
								  //  print_r($rt);
								//$searchM[$rt]=13;
									//$this->db->distinct();
								
									$this->db->select_sum("fee_head_amount");
									if($school_code ==1){
										$this->db->where("cat_id",3);}
									$this->db->where("fsd",$fsd);
									$this->db->where("class_id",$stuDetail->class_id);
									
								 $this->db->where_in("taken_month",13);
								 $fee_head = $this->db->get("class_fees");
								 
								//  	$this->db->select_sum("fee_head_amount");
								// 	if($school_code ==1){
								// 		$this->db->where("cat_id",3);}
								// 	$this->db->where("fsd",$fsd);
								// 	$this->db->where("class_id",$stuDetail->class_id);
									
								//  $this->db->where_in("taken_month",13);
								//  $fee_head_one = $this->db->get("class_fees")->row()->fee_head_amount;
								 
								 if($fee_head->num_rows()>0){ 
									 $fee_head =$fee_head->row()->fee_head_amount;
									 $exdate1=Date("y-m-d");
									 $dte1 = date("m",strtotime($exdate1));
									 
									 //print_r($searchM);
									  $this->db->select_sum('fee_head_amount');
									 	 $this->db->from('class_fees');
									 	$this->db->where("fsd",$fsd);
									    $this->db->where("class_id",$stuDetail->class_id);
									 	 $this->db->where_in("taken_month",$searchM);
								 
								      $examfee1 = $this->db->get();
									 
								 if($examfee1->num_rows()>0){
								     
								    $exfee1= $examfee1->row()->fee_head_amount;
								    
									$totfee2= $fee_head * $rt;
									$totfee=$totfee2+$exfee1;
								 //	print_r($exfee1);
							 //	print_r($fee_head);
								// 	print_r($rt);
								 } 
								 else{
								 	$totfee=$fee_head * $rt;
								// 		print_r($totfee);
								 }
									 if($stuDetail->transport==1){
								     $vid=$stuDetail->vehicle_pickup;
								     $this->db->where("id",$vid);
								    $rootdt= $this->db->get("transport_root_amount");
								     if($rootdt->num_rows()>0){
								       $tfee6=  $rootdt->row()->transport_fee;
								       $tfee7=$tfee6*($rt);
								       $totfee=$totfee+ $tfee7;
								     }
								     else{
								         echo "root not define";
								     }
								     
								 } 
								 else{
								     $totfee =$totfee;
								 }
								 
								 			$this->db->where('school_code',$school_code);
						$feecat=$this->db->get('late_fees')->row()->apply_cat;
						if($feecat==1){
						if($fee_record->num_rows()>0){
					   $i=0;
						foreach($fee_record->result() as $fd):
							?>
							<?php 
						 if($fd->deposite_month<4){
							$cdate11=date('Y-m-d');
							$mno=(int)date('m',strtotime($cdate11));
							if($mno < $fd->deposite_month){
							    $realm=0;
							 //  print_r($mno);
							 //    print_r($mno);
							}else{
								//echo $mno;
							$realm= $mno- $fd->deposite_month-1;}
				          // print_r($realm);
						 }else{
							$cdate11=date('Y-m-d');
							if($cdate11>='2020-01-01'){
							$mno=(int)date('m',strtotime($cdate11));
						 $realm= $mno-$fd->deposite_month+12-1;
						// print_r($realm);
						}else{
							$mno=(int)date('m',strtotime($cdate11));
						if($mno<$fd->deposite_month){
						    $realm=0;
							    
							}else{
								
								//echo $mno;
							$realm= $mno- $fd->deposite_month;
							
							}
				// 			print_r($mno);
				// 		print_r($fd->deposite_month);
						 }
						}
						?>
								
						<?php $i++; endforeach; 
						
						
						$this->db->where('school_code',$school_code);
						$amt=$this->db->get('late_fees')->row()->late_fee;
						
							$this->db->where('month_number',$mno);
						$this->db->where('school_code',$school_code);
						$depdate1=$this->db->get('fee_card_detail')->row();
						$depdate=date("y-m-d", strtotime($depdate1->deposite_date));
						 $date=date("y-m-d");
						
					
						if($realm==1 && $date<$depdate){
						   
						        $latefee1=0.00;
						    
						}else{
                        $latefee1=$amt*$realm;
                       
						}
                       
					}else{
						$cdate11=date('Y-m-d');
							if($cdate11>='2020-01-01'){
							$mno=(int)date('m',strtotime($cdate11));
						
						 $realm= $mno-4+12;
						}else{
							$mno=(int)date('m',strtotime($cdate11));
						
						
                            $realm= $mno-4;
						 }?>	
						<?php 
						$this->db->where('school_code',$school_code);
						$amt=$this->db->get('late_fees')->row()->late_fee;
                        $latefee1=$amt*$realm;
					}}else{
						$latefee1='0.00';
					 }
					 
									// $feehead=$fee_head+($fee_head_one*$rt);
								 $sum=$sum + ($totfee)+$latefee1 ;
									 $totalfee=$totfee +$latefee1;
									
								 echo "<br>". $totalfee;
								// print_r($fee_head);
								// print_r($rt);
								 
										?><input type = "hidden" id="amt<?php echo $count;?>" value="<?php echo $totfee + $latefee1;?>"/><?php
								 }else{
									 echo "fee Not found";								}
							 }
							}else{
								echo "Define Deposite Date in Configuration Fee section";
							}

							}else{
								$this->db->where("school_code",$this->session->userdata("school_code"));
								$fcd = 	$this->db->get("fee_card_detail");
								$rt=0;
									$month="";
								foreach($fcd->result() as $fcg):
									if($fcg->month_number<4){
										$roldm=$fcg->month_number-4+12;
									}else{
									$roldm=$fcg->month_number-4;
									}	$oldm =  date('Y-m', strtotime("$roldm months", strtotime($fdate)));
									if($oldm<=$cmonth){
										$searchM[$rt]=$fcg->month_number;
										echo $duedate = date("M-Y",strtotime($oldm));
							 	    $month =$month." and ".$duedate;
										$rt++;
								//	echo $fcg->month_number;
								//	echo $cmonth;
									
							}
								endforeach;
							?><input type = "hidden" id="rem<?php echo $count;?>" value="<?php echo $month;?>"/><?php
								$adable_amount=0;
						  //	$searchM[$rt]=13;
								//$this->db->distinct();
								$this->db->select_sum("fee_head_amount");
								$this->db->where("fsd",$fsd);
								$this->db->where("class_id",$stuDetail->class_id);
							//	print_r($stuDetail->class_id);
							if($school_code ==1){$this->db->where("cat_id",3);}
							
							    $this->db->where_in("taken_month",13);
								$fee_head = $this->db->get("class_fees");
								
								if($fee_head->num_rows()>0){
								    
								     $this->db->select_sum("fee_head_amount");  
									$this->db->where("class_id",$stuDetail->class_id);
									$this->db->where("fsd",$fsd);
									$this->db->where_in("taken_month",$searchM);
									$one_all_amount = $this->db->get("class_fees");
									if($one_all_amount->num_rows()>0){
										$one_all_amount=$one_all_amount->row()->fee_head_amount;
									
								// 	    for($ui=0;$ui<$rt;$ui++){
								// 			if($ui>0){
								// 				$adable_amount =$one_all_amount+$adable_amount;
								// 			}
								// 		}
								 $fee8=$fee_head->row()->fee_head_amount*($rt);
								 
									$fee9 =$one_all_amount;
									$fee_head=$fee8 + $fee9;
									
									if($stuDetail->transport==1){
								     $vid=$stuDetail->vehicle_pickup;
								     $this->db->where("id",$vid);
								    $rootdt= $this->db->get("transport_root_amount");
								     if($rootdt->num_rows()>0){
								       $tfee4=  $rootdt->row()->transport_fee;
								       $tfee5=$tfee4*($rt);
								       $fee_head=$fee_head+ $tfee5;
								     }
								     else{
								         echo "root not define";
								     }
								     
								 } 
								 else{
								     $fee_head =$fee_head;
								 }
								 		$this->db->where('school_code',$school_code);
						$feecat=$this->db->get('late_fees')->row()->apply_cat;
						if($feecat==1){
						if($fee_record->num_rows()>0){
					   $i=0;
						foreach($fee_record->result() as $fd):
							?>
							<?php 
						 if($fd->deposite_month<4){
							$cdate11=date('Y-m-d');
							$mno=(int)date('m',strtotime($cdate11));
							if($mno < $fd->deposite_month){
							    $realm=0;
							 //  print_r($mno);
							 //    print_r($mno);
							}else{
								//echo $mno;
							$realm= $mno- $fd->deposite_month-1;}
				          // print_r($realm);
						 }else{
							$cdate11=date('Y-m-d');
							if($cdate11>='2020-01-01'){
							$mno=(int)date('m',strtotime($cdate11));
						 $realm= $mno-$fd->deposite_month+12-1;
						// print_r($realm);
						}else{
							$mno=(int)date('m',strtotime($cdate11));
						if($mno<$fd->deposite_month){
						    $realm=0;
							    
							}else{
								
								//echo $mno;
							$realm= $mno- $fd->deposite_month;
							
							}
				// 			print_r($mno);
				// 		print_r($fd->deposite_month);
						 }
						}
						?>
								
						<?php $i++; endforeach; 
						
						
						$this->db->where('school_code',$school_code);
						$amt=$this->db->get('late_fees')->row()->late_fee;
						
							$this->db->where('month_number',$mno);
						$this->db->where('school_code',$school_code);
						$depdate1=$this->db->get('fee_card_detail')->row();
						$depdate=date("y-m-d", strtotime($depdate1->deposite_date));
						 $date=date("y-m-d");
						
					
						if($realm==1 && $date<$depdate){
						   
						        $latefee1=0.00;
						    
						}else{
                        $latefee1=$amt*$realm;
                       
						}
                       
					}else{
						$cdate11=date('Y-m-d');
							if($cdate11>='2020-01-01'){
							$mno=(int)date('m',strtotime($cdate11));
						
						 $realm= $mno-4+12;
						}else{
							$mno=(int)date('m',strtotime($cdate11));
						
						
                            $realm= $mno-4;
						 }?>	
						<?php 
						$this->db->where('school_code',$school_code);
						$amt=$this->db->get('late_fees')->row()->late_fee;
                        $latefee1=$amt*$realm;
					}}else{
						$latefee1='0.00';
					 }
									
									$sum=$sum + $fee_head +$latefee1;
								$totalfee=	$fee_head+$latefee1;
								echo "<br>".$totalfee;
							   	?><input type = "hidden" id="amt<?php echo $count;?>" value="<?php echo $fee_head+$latefee1;?>"/><?php 
								}else{echo "<label style='color:red;'>Configure Fee Head and Amount</label>";}
								}else{
									echo "fee Not found";}
									}

							?>
						</td>
			  			<td>
							<a href="<?php echo base_url()?>index.php/feeControllers/feesDetail/<?php echo $stu_id;?>/<?php echo $fsd;?>" target="_blank" class="btn btn-blue">
								View Detail
							</a></td>
								<td>
							<button class="btn btn-yellow" id ="smstodew<?php echo $count;?>" >
								Send SMS
							</button></td>
							<script>
			  		
			  			$("#smstodew<?php echo $count;?>").click(function(){
			  				var smstodue = $("#rem<?php echo $count;?>").val();
			  				var sname = $("#sname<?php echo $count;?>").val();
			  				var fname = $("#fname<?php echo $count;?>").val();
			  				var mnum = $("#mnum<?php echo $count;?>").val();
							var amount = $("#amt<?php echo $count;?>").val();
							var amount1 = $("#amt1<?php echo $count;?>").val();
				// alert(amount);
				// alert(amount1);
					$.post("<?php echo site_url("index.php/feeControllers/feeRemSms") ?>",{smstodue : smstodue,sname : sname,fname : fname,mnum : mnum,amount : amount,amount1 : amount1}, function(data){
						$("#smstodew<?php echo $count;?>").html(data);
					});
				
				});
			  			</script>
			  			
			  		</tr>
			  		<?php  ?>
			  		<?php $count++;  endforeach; }}?>
        	</tbody>
				<tfoot>
				    <tr>
				        <td></td>
				        <td>Total Due</td>
				        <td></td>
				        <td></td>
				        <td></td>
				        <td></td>
				        <td></td>
				        <td></td>
				        <td><?php echo $sum;?></td>
				    </tr>
				</tfoot>
			</table>
		</div>
        <?php 
        }?>


<script>
	TableExport.init();
	
</script>