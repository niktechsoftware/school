<?php
class feeModel extends CI_Model{
	function getFeeRecord($invoice_no){
		$res = $this->db->query("select * from  fee_deposit  where status=1 and invoice_no='$invoice_no'");
		return $res;
	}
		function getTotMonthsHaveDeposited($stu_id,$fsd){
		$totj =0;
		$getDepositeMonth = $this->db->query("select sum(deposite_month) as totmonth from fee_deposit where student_id='$stu_id' and status =1 and finance_start_date='$fsd' ");
		if($getDepositeMonth->num_rows()>0){
			
		if($getDepositeMonth->row()->totmonth){
			$totj=$getDepositeMonth->row()->totmonth;
		}else{
			$totj=0;
		}
		
		}else{
			$totj=0;
			
		}
		return $totj;
	}
	function getDiscount($invoice_no,$i){
		$this->db->where('invoice_number',$invoice_no);
		$eunm1 = $this->db->get('dis_den_tab');
		$tdiscount=0;
		$totdisc=0;
		if($eunm1->num_rows()>0){
			$l=$i;
			
			foreach($eunm1->result() as $eunm):
			$this->db->where('username',$eunm->discounter_id);
			$eid = $this->db->get('employee_info');
			?>
							<?php if($eunm->discounter_id){?>
								<tr class='text-uppercase'>
						  		     <td class="col-sm-1 text-center"><b><?php echo $l;?></b></td>
									<td class="col-sm-8"><b><?php 
									if($eid->num_rows()>0){ echo "TEACHER DISCOUNT"."(".$eid->row()->name.")";}
									else{ $this->db->where("id",$eunm->discounter_id);
										$getdname = $this->db->get("discounttable");
										if($getdname->num_rows()>0){
											echo $getdname->row()->discount_head." "." (DISCOUNT)";
										 }
										 else{
										 echo "DISCOUNT";}} ?></b></td>
									<td class="col-sm-3 text-center"> <?php echo $tdiscount=$eunm->discount_rupee; $i++; ?></td>
								</tr>
								 <?php  } 
								 $l++;
								 endforeach;
								 }else{
								 				 if($tdiscount>0){?>
								 				<tr class='text-uppercase'>
								 		  		     <td class="col-sm-1 text-center"><b><?php echo $i;?></b></td>
								 					<td class="col-sm-8"><b><?php echo "DISCOUNT (N/A)";?></b></td>
								 					<td class="col-sm-3 text-center"> <?php echo $tdiscount="0.00"; $i++; ?></td>
								 				</tr>
								 				tdiscount
								 				 <?php }}
								//  print_r($totdisc);
								return $totdisc;
			}
			
		//single stundent fee report 
		///
		function totFee_due_by_id($stu_id,$indicator){
		
		$student_id = $stu_id;
		$monthArray =array();
		$getpreviousDue 	= $this->getPreviousDue($student_id);
		$student_fsd = $this->getFsdByStudentId($student_id);
		if($student_fsd){
			$totv =0 ;
			if($student_fsd->num_rows()>0){
				$fsdStartDate = $student_fsd->row()->finance_start_date;
				//echo $fsdStartDate."ggg";
				$getTotMonthsToDeposite		=	$this->getTotMonthsToDeposite($student_id,$fsdStartDate);
				$getTotMonthsHaveDeposited	=	$this->getTotMonthsHaveDeposited($student_id,$student_fsd->row()->id);
				if($getTotMonthsToDeposite > 0){
				//echo date('Y-m-d', strtotime("+$getTotMonthsHaveDeposited months", strtotime($student_fsd->row()->finance_start_date)));
				
				for( $i=$getTotMonthsHaveDeposited; $i < $getTotMonthsToDeposite; $i++){
				
					$demandtotdate =date('Y-m-d', strtotime("+$i months", strtotime($student_fsd->row()->finance_start_date)));
					
					$totmonthwise = $this->getMonthFeeByMonth($demandtotdate ,$student_id);
					
					if($totmonthwise){
						$fgh = $totmonthwise;
					}else{
						$fgh="N/A";
					}
					//echo $demandtotdate."<br>";
					$mon = date("m",strtotime($demandtotdate));
					array_push($monthArray,$mon);
					
					if($indicator == 1){echo date("M-Y",strtotime($demandtotdate))." [ ".$fgh." ]<br>";}
					$totv=$totv+$totmonthwise;
				}
				$totv=$totv+$getpreviousDue;
				 if($indicator == 9){
				 	$this->depositeFee($monthArray,$student_id,$student_fsd->row()->id,$totv,$getpreviousDue);
				 }
				return $totv;
				}else{
					return $totv;
				}
			}
		}else{
				echo "Student is Not Enroll.";
			}
			 
	}
	function depositeFee($monthArray,$student_id,$fsd,$totv,$getpreviousDue){
		$school_code =$this->session->userdata("school_code");
		$fsd1 =$this->session->userdata("fsd");
		$this->db->where("school_code",$school_code);
		$invoice = $this->db->get("invoice_serial");
		$invoice1=6000+$invoice->num_rows();
		$invoice_number = $school_code."I20".$invoice1;
		$invoiceDetail = array(
				"invoice_no" => $invoice_number,
				"heads" => 5,
				"invoice_date" => $this->input->post("subdate"),
				"school_code"=>$school_code
		);
		$this->db->insert("invoice_serial",$invoiceDetail);
		$this->db->where("id",$student_id);
		$studDetails=$this->db->get("student_info")->row();
		if($studDetails->transport){
			$tranportAm =$this->studentFeeTransportById($studDetails->vehicle_pickup);
		}else{
			$tranportAm=0;
		}
		$feecatd = $this->db->query("select feecat from fee_deposit where student_id='$student_id' order by diposit_date desc limit 1")->row()->feecat;
		$feeDepositData["student_id"]=$student_id;
		$feeDepositData["class_id"]=$studDetails->class_id;
		$feeDepositData["deposite_month"]=sizeof($monthArray);
		$feeDepositData["late"]="0.00";
		$feeDepositData["transport"]=$tranportAm;
		$feeDepositData["previous_balance"]=$getpreviousDue;
		$feeDepositData["description"]="On line fee Deposit";
		$feeDepositData["payment_mode"]="4";
		$feeDepositData["feecat"]=$feecatd;
		$feeDepositData["total"]=$totv;
		$feeDepositData["paid"]=$totv;
		$feeDepositData["diposit_date"]=date("Y-m-d H:i:s");
		$feeDepositData["invoice_no"]=$invoice_number;
		$feeDepositData["finance_start_date"]=$fsd1;
		$feeDepositData["school_code"]=$school_code;
		$feeDepositData["status"]=0;
		$this->db->insert("fee_deposit",$feeDepositData);
		
		$this->feeModel->updateDaybook($school_code,$totv,$student_id,"4",$invoice_number);
		$i=1; foreach($monthArray as $moi):
		if(($moi==4)&&($i>1)){
			$fsdid = $this->db->query("select id from fsd where id > '$fsd' and school_code ='$school_code' order by id DESC limit 1 ")->row()->id;
		}else{
			$fsdid=$fsd;
		}
		
		$depositeMonthData['student_id']=$student_id;
		$depositeMonthData['deposite_month']=$moi;
		$depositeMonthData['invoice_no']=$invoice_number;
		$depositeMonthData['fsd']=$fsdid;
		$this->db->where("student_id",$student_id);
		$this->db->where("deposite_month",$moi);
		$this->db->where("invoice_no",$invoice_number);
		$this->db->where("fsd",$fsdid);
		$oldcheck = $this->db->get("deposite_months");
		if($oldcheck->num_rows()>0){
		$this->db->where("id",$oldcheck->row()->id);
		$this->db->delete("deposite_months");
		$this->db->insert("deposite_months",$depositeMonthData);	
		}else{
			$this->db->insert("deposite_months",$depositeMonthData);
		}
		$this->feeModel->updateTransport($tranportAm,$invoice_number,$school_code,$moi,$fsdid);
		$i++; endforeach;
		redirect("index.php/paytm/pgRedirect/$invoice_number/$student_id/$fsdid/$totv/2/");
	}
	
	function getMonthFeeByMonth($demandtotdate,$student_id){
		//echo $demandtotdate;
	
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("finance_start_date <= ",$demandtotdate);
		$this->db->where("finance_end_date >= ",$demandtotdate);
		$getfsdid = $this->db->get("fsd");
		if($getfsdid->num_rows()>0){
			$getfsdid=$getfsdid->row()->id;
		$getmonth = date("m",strtotime($demandtotdate));
		//echo $getfsdid."-".$getmonth."<br>";
		if($getfsdid == $this->session->userdata("fsd")){
			$this->db->where("id",$student_id);
			$stu_record = $this->db->get("student_info")->row();
			$classid = $stu_record->class_id;
		}else{
			$this->db->where("student_id",$student_id);
			$ostu_record = $this->db->get("old_student_info");
			if($ostu_record->num_rows()>0){
			$classid = $ostu_record->row()->class_id;
			$this->db->where("id",$student_id);
			$stu_record = $this->db->get("student_info")->row();
			}else{
				$stu_record=0;
			}
		}
		if($stu_record){
		$totMonthly = $this->getOnemonthFee($student_id,$classid,$getmonth,$getfsdid,$stu_record->discount_id,$stu_record->vehicle_pickup);
		//	echo $totMonthly."<br>";
			//exit();
		return $totMonthly;
		}}
	}
		function getOnemonthFee($student_id,$classid,$getmonth,$getfsdid,$discount,$transportid){
	//echo $getfsdid."<br>";

		$school_code =$this->session->userdata("school_code");
		$this->db->select_sum("fee_head_amount");
		/* if($school_code ==1){
			$this->db->where("cat_id",3);} */
		$mon['0']=$getmonth;
		$mon['1']=13;
		
		$this->db->select_sum("fee_head_amount");
			$this->db->where("fsd",$getfsdid);
			$this->db->where("class_id",$classid);
			$this->db->where("cat_id",0);
            $this->db->where_in("taken_month",$mon);
			$fee_head = $this->db->get("class_fees")->row();
			$totf = $fee_head->fee_head_amount;
			$discount = $this->studentFeeDiscountById($classid,$totf,$discount,$mon);
			$transport = $this->studentFeeTransportById($transportid);
			$this->db->where("month",$getmonth);
			$this->db->where("stu_id",$student_id);
			$this->db->where("fsd",$getfsdid);
			$gettmonth=$this->db->get("transport_fee_month");
			if($gettmonth->num_rows()>0){
				$totf=$totf-$discount;
			}else{
				$totf=$totf-$discount+$transport;
			}
		
			return $totf;
	}
		function studentFeeTransportById($transportid){
		$this->db->where("v_id",$transportid);
		$tranportAmount  = $this->db->get("transport_root_amount");
		if($tranportAmount->num_rows()>0){
			return $tranportAmount->row()->transport_fee;
		}else{
			return 0;
		}
	}
	function studentFeeDiscountById($classid,$totf,$discount,$mon){
		$discountAmount = 0;
		if($discount>0){
		$discountAmount = 0;
			$this->db->where("id",$discount);
			$disdetails = $this->db->get("discounttable");
			if($disdetails->num_rows()>0){
				if($disdetails->row()->discount_amount>0){
					if($disdetails->row()->applied_head_id=="all"){
						$discountAmount=$disdetails->row()->discount_amount;
					}else{
						$this->db->where("fee_head_name",$disdetails->row()->applied_head_id);
						$this->db->where_in("taken_month",$mon);
						$this->db->where("class_id",$classid);
					
						$selectdamount = $this->db->get("class_fees");
						if($selectdamount->num_rows()>0){
							$discountAmount =$disdetails->row()->discount_amount;
						}
					}
				}else{
					if($disdetails->row()->discount_persent>0){
						if($disdetails->row()->applied_head_id=="all"){
							$discountAmount=((($totf*$disdetails->row()->discount_persent))/100);
						}else{
							$this->db->where("fee_head_name",$disdetails->row()->applied_head_id);
							$this->db->where_in("taken_month",$mon);
							$this->db->where("class_id",$classid);
							$selectdamount = $this->db->get("class_fees");
							if($selectdamount->num_rows()>0){
								
								$discountAmount=((($selectdamount->row()->fee_head_amount)*$disdetails->row()->discount_persent)/100);
							}
						}
					}
				}
			}
		}
		return $discountAmount;
	}
	function getFsdByStudentId($stud_id){
		$school_code=$this->session->userdata('school_code');
		$this->db->where("username",$stud_id);
		$this->db->or_where("id",$stud_id);
		$student_record = $this->db->get("student_info");
		if($student_record->num_rows()> 0){
			$student_id=$student_record->row()->id;
			//echo $student_id;
			$fsddetails1 = $this->db->query("select distinct(finance_start_date) from fee_deposit where student_id='$student_id'");
			if($fsddetails1->num_rows()>0){
				$usedfsd = $fsddetails1->row()->finance_start_date;
				$fsddetails = $this->db->query("select distinct(finance_start_date) from fee_deposit where finance_start_date >= '$usedfsd' and school_code='$school_code' order by finance_start_date ASC");
				$i =0;foreach($fsddetails->result() as $row):
					$this->db->select_sum("deposite_month");
					$this->db->where("student_id",$student_id);
					$this->db->where("status",1);
					$this->db->where("finance_start_date",$row->finance_start_date);
					$totdm = $this->db->get("fee_deposit")->row()->deposite_month;
					if($totdm < 12){ 
					$this->db->where('id',$row->finance_start_date);
					$student_fsd=$this->db->get('fsd'); 
						return $student_fsd;
					 $i++; break; }
				 endforeach;
				 if($i<1){
				 	//echo $totdm ;
				 	//echo $student_record->row()->fsd;
				 	//beech ke session ka logic likhna hai abhi
				 	$this->db->where('id',$student_record->row()->fsd);
				 	$student_fsd=$this->db->get('fsd');
				 	return $student_fsd;
				 }
			}else{
				//echo $totdm ;
				//echo $student_record->row()->fsd;
				$this->db->where('id',$student_record->row()->fsd);
				$student_fsd=$this->db->get('fsd');
				return $student_fsd;
		}}else{
			return false;
		}
	}	
	//total deposited by student

	//end total deposited by student
	function getTotMonthsToDeposite($stu_id,$fsddate){
			$fsdStartDate = $fsddate;
			$cdate = date("Y-m-d");
			$cdate=date('Y-m-d', strtotime("+1 months", strtotime($cdate)));
			$date1 = $fsdStartDate;
  			$date2 = $cdate;
  			$time_stamp1 = strtotime($date1);
			$time_stamp2 = strtotime($date2);
			$year1 = date('Y', $time_stamp1);
			$year2 = date('Y', $time_stamp2);
			$month1 = date('m', $time_stamp1);
			$month2 = date('m', $time_stamp2); 
			 $diff = (($year2 - $year1) * 12) + ($month2 - $month1); 
			 //echo $diff;
			return $diff;
		
		
		
	}
	//get previous balance by studentid
    function getPreviousDue($stu_id){
    	$this->db->order_by('id','desc');
    	$this->db->where('student_id',$stu_id);
    	$mbalance=$this->db->get('feedue');
    	if($mbalance->num_rows()>0){
    		return $mbalance->row()->mbalance;
    	}else{
    		return 0;	
    	}
    }
    //end  previous balance by studentid
	function checkFeeoverAll($school_code,$fsd){
		$this->db->where("fsd",$fsd);
		$res = $this->db->get("class_fees");
		if($res->num_rows()>0)
		{
			return True;
		}
		else{
			return False;
		}
	}
	function updateTransport($trnsfeemon,$invoice_number,$school_code,$g,$fsd){
	    	if($trnsfeemon>0){
		
							$tranportdat=array(
								"stu_id"=>$this->input->post('stuId'),
								"month"=>$g,
								"total_amount"=>$trnsfeemon,
								"paid_amount"=>$trnsfeemon,
								"invoice_number"=>$invoice_number,
								"school_code"=>$school_code,
								"date"=>date("y-m-d"),
									"fsd"=>$fsd
					
							);
							$this->db->insert("transport_fee_month",$tranportdat);
						}
	}
	public function updateDaybook($school_code,$amount,$paidID,$paymode,$invoice_no){
	    $this->db->where("invoice_no",$invoice_no);
	    $checknum = $this->db->get("day_book");
	    if($checknum->num_rows()<1){
	     
		$dayBook = array(
				"paid_to" =>$this->session->userdata("username"),
				"paid_by" =>$paidID,
				"status"=>1,
				"dabit_cradit" => "1",
				"amount" => $amount,
				"pay_date" => date("Y-m-d H:s:i"),
				"pay_mode" => $paymode,
				"invoice_no" => $invoice_no,
				"school_code"=>$school_code
		);
		$this->db->insert("day_book",$dayBook);
		 
		return true;
	    }
	    else{
	        return false;
	    }
	}
	////
    public function getlatefee($stuid,$fsdid){
        $school_code=$this->session->userdata("school_code");
    	$this->db->where("student_id",$stuid);
		$this->db->where("fsd",$fsdid);
		$fee_record = $this->db->get("deposite_months");
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
							$realm= $mno- $fd->deposite_month-1;
							    
							}
				          // print_r($realm);
						 }else{ 
							$cdate12=date('Y-m-d');
							if($cdate12 >= $fsdid){
							  $mno=(int)date('m',strtotime($cdate12));
						
						 $realm= $mno-$fd->deposite_month+12-1;
						// print_r($realm);
						}else{
						   
							$mno=(int)date('m',strtotime($cdate12));
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
						  
						        $latefee1=$amt;
						        if($latefee1<1){
						            $latefee1=0;
						        }
						    
						}else{ 
                                $latefee1=$amt*$realm;
                                 if($latefee1<1){
						            $latefee1=0;
						        }
                       
						}
                       
					}else{
						$cdate11=date('Y-m-d');
							if($cdate11>=$fsdid){
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
                         if($latefee1<1){
						        $latefee1=0;
						        }
					}}else{
						$latefee1='0.00';
					 }
					 return $latefee1;
					 
}


	function getstugurboth($stuid_id){
	    //echo $stuid_id;
		$query = $this->db->select('student_info.id,
			student_info.address1,guardian_info.father_full_name,
			student_info.class_id,student_info.gender,student_info.photo,
			student_info.name,guardian_info.school_code,student_info.username,student_info.city,
			student_info.state,student_info.pin_code,student_info.mobile')
		->from('student_info')
		->join('guardian_info', 'guardian_info.student_id = student_info.id')
		->where("student_info.username",$stuid_id)
		->where("student_info.status",1)
		->get();
		//echo $query->row()->id ;
		return $query->row();
	}
	
	function getperfeerecord($stuid_id){
		$this->db->where("school_code", $this->session->userdata("school_code"));
		$this->db->where("student_id", $stuid_id);
		$this->db->where("status", 1);
		$val = $this->db->get("fee_deposit");
		return $val;
	}
    function getstudent($classv){
                $this->db->where("class_id",$classv);
                $this->db->where("status",1);
              	$studt=  $this->db->get("student_info");
	              if($studt->num_rows()>0){
	                  return $studt;
	              }
	              else{
	              return false;
	              }
           
        }
	function insertocanddaybook($bal,$data){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("opening_date",date('Y-m-d'));
		$this->db->update("opening_closing_balance",$bal);
		$this->db->insert("day_book",$data);
		return true;
	}

	function fee_deposite($invoiceNo,$student_id){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where('invoice_no', $invoiceNo);
		$this->db->where('student_id', $student_id);
		$this->db->delete("fee_deposit");
		$this->db->where('invoice_no', $invoiceNo);
		$this->db->where('student_id', $student_id);
		$this->db->delete("deposite_months");
		return true;
	}

	
	function del_feedue($invoiceNo, $student_id){
		$this->db->where('invoice_no', $invoiceNo);
		$this->db->delete("feedue");
		return true;
	}

	function getFeeSlab($schoolCode) {
		$this->db->where("school_code", $schoolCode);
		$val = $this->db->get("late_fees");
		return $val;
	}
	
	function getStudData($data)
	{
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("username",$data);
		//$this->db->where("fsd",$fsd);
		$query1 = $this->db->get("student_info");
	return $query1;
	}
	function getFname($data)
	{
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("student_id",$data);
		$query1 = $this->db->get("guardian_info");
		return $query1;
	}
	function getFeeDetail($data)
	{$school_code = $this->session->userdata("school_code");
		$query1 = $this->db->query("SELECT * FROM fee_deposit WHERE student_id='$data' AND school_code='$school_code' and status=1 ORDER BY id DESC LIMIT 1");
		return $query1;
	}
	function getHoliDay($data)
	{$school_code = $this->session->userdata("school_code");
		$query1 = $this->db->query("SELECT * FROM holiday WHERE date_f='$data' AND school_code='$school_code'");
		return $query1;
	}
	function getfeeReport($sec,$class)
	{$school_code = $this->session->userdata("school_code");
		$query1 = $this->db->query("SELECT * FROM student_info WHERE class_id='$class' and section='$sec' AND school_code='$school_code'");
		return $query1;
	}
	
	function fullstudentfeeDetail($studentid)
	{
		$this->db->where("id",$studentid);
		$studentdata = $this->db->get("student_info")->row();
		return $studentdata;
	}

	function fulldetail($id,$fsd)
	{
	    $school_code = $this->session->userdata("school_code");
		if($fsd){
			$query1 = $this->db->query("SELECT * FROM fee_deposit WHERE student_id='$id' and status=1 and finance_start_date='$fsd' AND school_code='$school_code'");
			return $query1;
		}
		else{
			$query1 = $this->db->query("SELECT * FROM fee_deposit WHERE student_id='$id' and status=1 AND school_code='$school_code'");
			return $query1;
		}
	
		
	}
	
	function feedetails($id)
	{
		$school_code = $this->session->userdata("school_code");
		$query1 = $this->db->query("SELECT month_number,SUM(total) as tt FROM fee_deposit where student_id='$id' and status=1 AND school_code='$school_code'");
		return $query1;
	}
	function lastpaid($id)
	{$school_code = $this->session->userdata("school_code");
		$query1 = $this->db->query("SELECT * FROM fee_deposit WHERE student_id='$id' and status=1 AND school_code='$school_code' ORDER BY id DESC LIMIT 1");
		return $query1;
	}
	
	function classwisefee($class_id,$section,$school_code,$month_number){
		$query1 = $this->db->query("SELECT * FROM class_fees WHERE class_id='$class_id' AND school_code='$school_code' AND  section='$section' AND (taken_month='$month_number' OR taken_month='13') ");
		return $query1;
	}
	
	function getmonthdeposite($school_code){
		$this->db->where("school_code",$school_code);
		$val = $this->db->get("fee_card_detail");
		return $val;
	}
	


	function checkstuid1($stuid){
		$this->db->where("fsd",$this->session->userdata("fsd"));
		$this->db->where("username",$stuid);
	  $studata=	$this->db->get("student_info");
    	if($studata->num_rows()>0){
    		$studentrow=$studata->row();
    		$this->db->where("class_id",$studentrow->class_id);
			 $classfee=	$this->db->get("class_fees");
			 if($classfee->num_rows()>0){
				 return $classfee;
			 }else{
				 return $classfee;
			 }
    	}else{
				return $studata;
			}

	}
}
