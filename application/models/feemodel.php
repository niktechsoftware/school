<?php
class feeModel extends CI_Model{
	
	function totFee_due_by_id($stu_id,$indicator){
		$student_id = $stu_id;
		
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
					
				
					if($indicator > 0){echo date("M-Y",strtotime($demandtotdate))."<br>";}
					$totv=$totv+$this->getMonthFeeByMonth($demandtotdate ,$student_id);
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
	
	function getMonthFeeByMonth($demandtotdate,$student_id){
		//echo $demandtotdate;
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("finance_start_date <= ",$demandtotdate);
		$this->db->where("finance_end_date >= ",$demandtotdate);
		$getfsdid = $this->db->get("fsd")->row()->id;
		$getmonth = date("m",strtotime($demandtotdate));
		//echo $getfsdid."-".$getmonth."<br>";
		if($getfsdid == $this->session->userdata("fsd")){
			$this->db->where("id",$student_id);
			$stu_record = $this->db->get("student_info")->row();
			$classid = $stu_record->class_id;
		}else{
			$this->db->where("student_id",$student_id);
			$ostu_record = $this->db->get("old_student_info")->row();
			$classid = $ostu_record->class_id;
			
			$this->db->where("id",$student_id);
			$stu_record = $this->db->get("student_info")->row();
		}
		$totMonthly = $this->getOnemonthFee($student_id,$classid,$getmonth,$getfsdid,$stu_record->discount_id,$stu_record->vehicle_pickup);
			//echo $totMonthly."<br>";
		return $totMonthly;
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
			//echo $totf;
			return $totf;
	}
	function studentFeeTransportById($transportid){
		$this->db->where("v_id",$transportid);
		$tranportAmount  = $this->db->get("transport_root_amount");
		if($tranportAmount->num_rows()>0){
			return $tranportAmount->transport_fee;
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
	     $op1 = $this->db->query("select closing_balance from opening_closing_balance where  school_code='$school_code' order by id DESC Limit 1")->row();
		$balance = $op1->closing_balance;
		$close1 = $balance +$amount;
		$dayBook = array(
				"paid_to" =>$this->session->userdata("username"),
				"paid_by" =>$paidID,
				"reason" => "Fee Deposit",
				"dabit_cradit" => "1",
				"amount" => $amount,
				"closing_balance" => $close1,
				"pay_date" => date("Y-m-d H:s:i"),
				"pay_mode" => $paymode,
				"invoice_no" => $invoice_no,
				"school_code"=>$school_code
		);
		$this->db->insert("day_book",$dayBook);
		$bal = array(
				"closing_balance" => $close1
		);
		$this->db->where("school_code",$school_code);
		$this->db->where("opening_date",date('Y-m-d'));
		$this->db->update("opening_closing_balance",$bal); 
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

		return true;
	}

	function deposite_month($invoiceNo,$student_id){
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
			$query1 = $this->db->query("SELECT * FROM fee_deposit WHERE student_id='$id' and finance_start_date='$fsd' AND school_code='$school_code'");
			return $query1;
		}
		else{
			$query1 = $this->db->query("SELECT * FROM fee_deposit WHERE student_id='$id' AND school_code='$school_code'");
			return $query1;
		}
	
		
	}
	
	function feedetails($id)
	{
		$school_code = $this->session->userdata("school_code");
		$query1 = $this->db->query("SELECT month_number,SUM(total) as tt FROM fee_deposit where student_id='$id' AND school_code='$school_code'");
		return $query1;
	}
	function lastpaid($id)
	{$school_code = $this->session->userdata("school_code");
		$query1 = $this->db->query("SELECT * FROM fee_deposit WHERE student_id='$id' AND school_code='$school_code' ORDER BY id DESC LIMIT 1");
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
