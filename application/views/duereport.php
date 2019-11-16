
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<!-- start: EXPORT DATA TABLE PANEL  -->
			<div class="panel panel-white">
			    

<?php if($Warning=$this->session->flashdata("Warning")){
	echo "<div class='alert alert-danger'>".$Warning."</div>";
}?>
				<div class="panel-heading panel-red">
					<h4 class="panel-title"> <span class="text-bold">Student Due REport</span></h4>
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
								
								</ul>
								</div>
						</div>
					</div>
				<?php $school_code =$this->session->userdata("school_code");
			 $fsd = $this->session->userdata("fsd");
				if($uri==3){
				?>
						<div class="table-responsive">
						 <table class="table" id="sample-table-2">
                    <thead>
                    <th>Sno.</th>
                    <th>Class </th>
                      <th>Section </th>
                    <th>Total Fee Due</th>
                    </thead>
                      


                      <tbody>
                        <?php $k=1;
                        $feecount=0;
                        $date=Date("Y-m-d");
                        $month = date("m", strtotime($date));
                        $yearmonth= date("m-y",strtotime($date));
                       // print_r($rmo);
                    //   $this->db->distinct();
                       $this->db->select('class_name,section,id');
                        $this->db->where("school_code",$school_code);
                        $classdt= $this->db->get("class_info");
                        //  print_r($this->session->userdata("fsd"));
                       
                        //  exit();
                        foreach($classdt->result() as $data): 
                            
                            // print_r($data->id);
                            $this->db->where("status",1);
                    	 	$this->db->where("class_id",$data->id);
                    	 	$this->db->where("fsd",$this->session->userdata('fsd'));
                    	 	$student = $this->db->get("student_info");
                    	 	 if($student->num_rows() > 0){
                    	$isData = $this->db->count_all("fee_deposit"); 
                    	if($isData > 0){

                    	   // print_r($isData);
                    	   // print_r($student->num_rows());
                    	   
                    	     $count = 1;
						$tot=0.00;
						$this->db->where("id",$fsd);
						$fdate =	$this->db->get("fsd")->row()->finance_start_date;

						$sum=0;
								 //$x=0;

				    foreach($student->result() as $stuDetail):
				    	$stu_id = $stuDetail->id;
				    	//print_r($school_code);
				    	$this->db->where("student_id",$stu_id);
				    	$this->db->where("school_code",$school_code);
				    	$rows = $this->db->get("guardian_info")->row();
				    	if($this->session->userdata("fsd")){
				    		$total = $this->db->query("SELECT SUM(paid) as totalpaid, SUM(total) as totaldeposite,invoice_no from fee_deposit WHERE student_id = '$stu_id' AND finance_start_date='$fsd' AND school_code='$school_code'")->row(); 
							
							
								$this->db->where("student_id",$stu_id);
								$this->db->where("fsd",$fsd);
								$fee_record = $this->db->get("deposite_months");
							
			               $i=0;
							foreach($fee_record->result() as $fd):
							     if($fd->deposite_month<4){
								$realm=  $fd->deposite_month-4+12;
					 
							}else{
							 $realm= $fd->deposite_month-4;}
							    $i++; endforeach; 
							    
							    	$cd=0;
			  			if($this->session->userdata("fsd")){
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
			  			   
			  			   	$depmonth=array();
            						$mbk=0;
								 	$this->db->where('invoice_no',$total->invoice_no); 
								 	$this->db->where('student_id',$stu_id);
                                  	$mbalance=$this->db->get('feedue');
								 	//print_r($mbalance->mbalance);
								 	if($mbalance->num_rows()>0){
								 	if(strlen($mbalance->row()->mbalance) > 0){
								 	    $db=$mbalance->row()->mbalance;
								 	   
								 	   // exit;
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
							
										$searchM[]=0;	$rt=0;$month="";	
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
									 $duedate= date("M-Y",strtotime($oldm));
										$month =$month." and ".$duedate;
									
										$rt++;
									//	print_r($month);
										// $rt;
								//	echo $cmonth;
							}
							//echo $rt;
									endforeach;
									
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
									 
									 	$this->db->where("fsd",$fsd);
									$this->db->where("class_id",$stuDetail->class_id);
									
									 $this->db->where_in("taken_month",$searchM);
								
								
								 $examfee1 = $this->db->get("class_fees");
								
								 if($examfee1->num_rows()>0){
								     
								    $exfee1= $examfee1->row()->fee_head_amount;
								    
									$totfee2= $fee_head * $rt;
									$totfee=$totfee2+$exfee1;
									
								 } 
								 else{
								    
								//      print_r($stuDetail->username);
								//  	print_r($fee_head);
								// 	print_r($rt);
								 	$totfee=$fee_head * $rt;
								//  		print_r($totfee);
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
									// $feehead=$fee_head+($fee_head_one*$rt);
								 $sum=$sum + ($totfee) ;
									 
								//  echo "<br>".($totfee) ;
								 
								 }else{
									 echo "fee Not found";	}
							 }
							}else{
								
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
									 $duedate = date("M-Y",strtotime($oldm));
							 	    $month =$month." and ".$duedate;
										$rt++;
								//	echo $fcg->month_number;
								//	echo $cmonth;
									
							}
								endforeach;
									$adable_amount=0;
						  //	$searchM[$rt]=13;
								//$this->db->distinct();
								$this->db->select_sum("fee_head_amount");
								$this->db->where("fsd",$fsd);
								$this->db->where("class_id",$stuDetail->class_id);
							//	print_r($stuDetail->class_id);
							if($school_code ==1){$this->db->where("cat_id",3);}
							
							    $this->db->where_in("taken_month",$searchM);
								$fee_head = $this->db->get("class_fees");
								
								if($fee_head->num_rows()>0){
								    
								     $this->db->select_sum("fee_head_amount");  
									$this->db->where("class_id",$stuDetail->class_id);
									$this->db->where("fsd",$fsd);
									$this->db->where_in("taken_month",13);
									$one_all_amount = $this->db->get("class_fees");
									if($one_all_amount->num_rows()>0){
										$one_all_amount=$one_all_amount->row()->fee_head_amount;
									
								// 	    for($ui=0;$ui<$rt;$ui++){
								// 			if($ui>0){
								// 				$adable_amount =$one_all_amount+$adable_amount;
								// 			}
								 //		}
								 $fee8=$one_all_amount*($rt);
								 
									$fee9 =$fee_head->row()->fee_head_amount;
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
									
									$sum=$sum + $fee_head;
								// echo "<br>".$fee_head;
							   	?><input type = "hidden" id="amt<?php echo $count;?>" value="<?php echo $fee_head;?>"/><?php 
								}else{ }
								}else{
									echo "fee Not found";}
									} ?>
									
										<?php $count++; ?>
			  		<?php  }else{
	
                             }  endforeach;  ?>

                        <tr>
                          <td class="center"><?php echo $k;?></td>
                          <td><?php echo $data->class_name;?></td>
                           <td><?php 
                           $this->db->where("id",$data->section);
                          $sec= $this->db->get("class_section");
                           if($sec->num_rows()>0){
                                echo $sec->row()->section;
                           }
                           else{
                           echo "Section Not Found"; }?></td>
                          <td><?php echo $sum; ?></td>
                          </tr>

                     <?php   $k++;  } } endforeach; ?>
                    </table>
                    
					<?php } else{  ?>
					
					 <table class="table" id="sample-table-2">
                    <thead>
                    <th>Sno.</th>
                    <th>Class Name</th>
                    <th>Total Fee Due</th>
                    </thead>
                    <tbody>
                        <?php $i=1;
                        $feecount=0;
                        $date=Date("Y-m-d");
                        $month = date("m", strtotime($date));

                        $this->db->where("school_code",$school_code);
                        $classdt= $this->db->get("class_info");
                        //  print_r($this->session->userdata("fsd"));
                        //  //print_r($classdt->result());
                        //  exit();
                        foreach($classdt->result() as $data):
                          $this->db->where("class_id",$data->id);
                          $studt=$this->db->get("student_info");
                          // echo "<pre>";
                          // print_r($studt->result());
                           
                          // exit();
                          if($studt->num_rows()>0){

                          $this->db->where("student_id",$studt->row()->id);
                          $this->db->where("deposite_month",$month);
                          $feedt=$this->db->get("fee_deposit");
                          if($feedt->num_rows()>0){

                          }
                          else{ 
                            $this->db->where("class_id",$data->id);
                            $this->db->where("fsd",$this->session->userdata("fsd"));
                           $classiddt= $this->db->get("class_fees");
                           if($classiddt->num_rows()>0){

                          // $this->db->where("school_code",$school_code);
                           $this->db->where("id",$classiddt->row()->class_id);
                           $classnm= $this->db->get("class_info")->row();


                            
                            $this->db->select_sum("fee_head_amount");
                            $this->db->where("class_id",$data->id);
                            $this->db->where("fsd",$this->session->userdata("fsd"));
                           $classfee= $this->db->get("class_fees")->row();
                           //$feecount=$feecount-$classfee;
                          ?>
                        <tr>
                          <td class="center"><?php echo $i;?></td>
                          <td><?php echo $classnm->class_name;?></td>
                          <td><?php echo $classfee->fee_head_amount; ?></td>
                          </tr>

                     <?php $i++; }  }   }  endforeach; ?>
                        
                      </tbody>
                    </table>
                 
					<?php } ?>
					</div>
				</div>
			</div>
			<!-- end: EXPORT DATA TABLE PANEL -->
		</div>
	</div>
	<!-- end: PAGE CONTENT-->
</div>