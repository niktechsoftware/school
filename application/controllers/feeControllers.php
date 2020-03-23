<?php
class feeControllers extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->is_login();
        $this->load->model("teacherModel");
        $this->load->model("allFormModel");
        $this->load->model("feeModel");
        $this->load->model("smsmodel");
        $school_code = $this->session->userdata("school_code");
    }
    
    function is_login(){
        $is_login = $this->session->userdata('is_login');
        $is_lock = $this->session->userdata('is_lock');
        $logtype = $this->session->userdata('login_type');
        if($is_login != "admin"){
            //echo $is_login;
            redirect("index.php/homeController/index");
        }
        elseif(!$is_login){
            //echo $is_login;
            redirect("index.php/homeController/index");
        }
        elseif(!$is_lock){
            redirect("index.php/homeController/lockPage");
        }
    }
    
    function checkID(){
				$studID=$this->input->post("studid");
				$fsd=$this->input->post("fsd");
            $this->load->model("feemodel");
            $var=$this->feemodel->getStudData($studID);
           if( $var->num_rows()>0){
           	redirect("login/collectFee/$studID/$fsd");
		}else{
			redirect("login/collectFee/feeFalse");
		}
	}
	
function getFsd(){
		$school_code=$this->session->userdata('school_code');
		$this->db->where('school_code',$school_code);
		$fsd1 = $this->db->get("general_settings")->row()->fsd_id;
		//echo $fsd1;
		$stud_id=$this->input->post("studentid");
		//print_r($this->session->userdata('fsd'));
	//	$this->db->where('fsd',$fsd1);
		$this->db->where("username",$stud_id);
		$check = $this->db->get("student_info");
		if($check->num_rows() > 0)
		{ if($check->row()->fsd != $fsd1){
		    $this->db->select_sum("deposite_month");
		    $this->db->where("student_id",$check->row()->id);
		  $totdm =   $this->db->get("fee_deposit")->row()->deposite_month;
		  if($totdm >11){
		      $this->db->where('id',$fsd1); 
				$start_date=$this->db->get('fsd')->row()->finance_start_date;
							?>	<div class="form-group">
				                      <label for="inputStandard" class="col-lg-3 control-label">
				                      		Select FSD <span style="color:#F00">*</span>
				                      </label>
				                      <div class="col-lg-5">
				                      		<select id="fsd12" name="fsd" class="form-control">
				                      			<option value="<?php echo $fsd1 ?>"><?php echo $start_date ?></option>
								            </select>
									   </div>
									   <div class="col-sm-4" id="subbox">
										 <button  class="btn btn-dark-green">Get Record <i class="fa fa-arrow-circle-right"></i></button>
									</div>
								</div>
		<?php   }else{
		    $this->db->where('id',$check->row()->fsd); 
				$start_date=$this->db->get('fsd')->row()->finance_start_date;
							?>	<div class="form-group">
				                      <label for="inputStandard" class="col-lg-3 control-label">
				                      		Select FSD <span style="color:#F00">*</span>
				                      </label>
				                      <div class="col-lg-5">
				                      		<select id="fsd12" name="fsd" class="form-control">
				                      			<option value="<?php echo $check->row()->fsd ?>"><?php echo $start_date ?></option>
								            </select>
									   </div>
									   <div class="col-sm-4" id="subbox">
										 <button  class="btn btn-dark-green">Get Record <i class="fa fa-arrow-circle-right"></i></button>
									</div>
								</div>
	<?php	}
		}else{
				$this->db->where('id',$fsd1); 
				$start_date=$this->db->get('fsd')->row()->finance_start_date;
							?>	<div class="form-group">
				                      <label for="inputStandard" class="col-lg-3 control-label">
				                      		Select FSD <span style="color:#F00">*</span>
				                      </label>
				                      <div class="col-lg-5">
				                      		<select id="fsd12" name="fsd" class="form-control">
				                      			<option value="<?php echo $fsd1 ?>"><?php echo $start_date ?></option>
								            </select>
									   </div>
									   <div class="col-sm-4" id="subbox">
										 <button  class="btn btn-dark-green">Get Record <i class="fa fa-arrow-circle-right"></i></button>
									</div>
								</div>
	<?php	}}else{?>
			<div class="alert alert-block alert-danger fade in">
				<button data-dismiss="alert" class="close" type="button">
					&times;
				</button>
				<h4 class="alert-heading"><i class="fa fa-times"></i> Error!</h4>
				<p>
					This student id <b><?php echo $stud_id;?></b> is not avaliable in current FSD .....
				</p>
			</div><?php
		}
	}
	
	function payFee(){
	    
		$school_code = $this->session->userdata("school_code");
		$fsddate=$this->input->post('fsdid');
// 		print_r($fsddate);
// 		exit;
		// Calculate naxt month start	
		$feecat = $this->input->post("feecat");
		//invoice number logic start
		$this->db->where("school_code",$school_code);
		$invoice = $this->db->get("invoice_serial");
		$invoice1=6000+$invoice->num_rows();
		$invoice_number = $school_code."I19".$invoice1;
		$invoiceDetail = array(
				"invoice_no" => $invoice_number,
				"reason" => "Fee Deposit",
				"invoice_date" => $this->input->post("subdate"),
				"school_code"=>$school_code
		);
		$this->db->insert("invoice_serial",$invoiceDetail);
		
		$months = $this->input->post("diposit_month");
		
		//echo "<pre>";
		//print_r($this->session->all_userdata());
		//echo "</pre>";
		
		$this->load->model("studentModel");
		$student = $this->studentModel->getStudentDetail($this->input->post('stuId'))->row();
		
		$cmnum=0;
		foreach($months as $g):
	
		$cmnum++;
		endforeach;
		
		$updata['student_id']=$this->input->post('stuId');
		$updata['late']=$this->input->post("latefee");
	//	$updata['monthly_fee']=$this->input->post("monthfee");
	
	if($school_code==14){
		$updata['transport']=	$this->input->post("dtransport_fee");
	 }else{
		$updata['transport']	=$this->input->post("transport_fee");
	 }
	
		$updata['deposite_month ']=	$cmnum;
		$updata['feecat']=$feecat;
		$updata['description']=$this->input->post("disc");
		$updata['previous_balance']=$this->input->post("pb");
		//$updata['discounter_id']=$this->input->post("discounterID");
		$updata['total']=$this->input->post("total1");
		$updata['paid']=$this->input->post("paid");
		//$updata['current_balance']=$this->input->post("cb");
		$updata['diposit_date']=$this->input->post("subdate");
		//$updata['status']="paid";
		$updata['payment_mode']=$this->input->post("payment_mode");
		$updata['invoice_no']=$invoice_number;
		$updata['school_code']=$school_code;
		$updata['finance_start_date']=$fsddate;

         $cb1=$this->input->post("cb");
	    	$stuid=$this->input->post('stuId');
		  
		  $this->db->where("student_id",$stuid);
		  $this->db->where("school_code",$school_code);
			$duedt2=  $this->db->get("feedue");
		
	
		$op1 = $this->db->query("select closing_balance from opening_closing_balance where opening_date='".date('Y-m-d')."' AND school_code='$school_code'")->row();
		$balance = $op1->closing_balance;
		$close1 = $balance + $this->input->post("paid");
		$dayBook = array(
				"paid_to" =>$this->session->userdata("username"),
				"paid_by" =>$this->input->post("stuId"),
				"reason" => "Fee Deposit",
				"dabit_cradit" => "1",
				"amount" => $this->input->post("paid"),
				"closing_balance" => $close1,
				"pay_date" => date("Y-m-d H:s:i"),
				"pay_mode" => $this->input->post("payment_mode"),
				"invoice_no" => $invoice_number,
				"school_code"=>$school_code
		);
		
		$otptable=array(
			"invoice_number"=>$invoice_number
			);
		$this->db->where('otp',$this->input->post("discounterOTPv"));
                      $this->db->where('school_code',$school_code);
					  $this->db->update("dis_den_tab",$otptable);
					  $this->db->where("id",$this->input->post("stuId"));
					$studd=  $this->db->get("student_info")->row();
				
		$discountv = array(
			"discount_rupee"=>  $this->input->post("discount_start"),
			"discounter_id"=>$studd->discount_id,
			"invoice_number"=>$invoice_number,
			"otp"=>5,
			"generate_date"=>date("Y-m-d"),
			"school_code"=>$school_code
		);	
		$mbalance = array(
			"mbalance"=>$this->input->post("cb"),
			"description"=>$this->input->post("disc"),
			//"depositedate"=>date('y-m-d'),
			"updatedate"=>date('y-m-d'),
			);

		$this->db->insert("dis_den_tab",$discountv);
		if( $this->db->insert('day_book',$dayBook) && $this->db->insert("fee_deposit",$updata) ){
		    
		   if($duedt2->num_rows()>0){
		     
     		$mdata['student_id']=$this->input->post('stuId');
    		$mdata['description']=$this->input->post("disc");
    		$mdata['mbalance']=$this->input->post("cb");
    		$mdata['depositedate']=$this->input->post("subdate");
    		$mdata['invoice_no']=$invoice_number;
     		$mdata['school_code']=$school_code;
     		
 	     	$this->db->where("student_id",$stuid);
		    $this->db->where("school_code",$school_code);
		    $this->db->update("feedue",$mdata);
		 }
		 else{
		    $mdata['student_id']=$this->input->post('stuId');
    		$mdata['description']=$this->input->post("disc");
    		$mdata['mbalance']=$this->input->post("cb");
    		$mdata['depositedate']=$this->input->post("subdate");
    		$mdata['invoice_no']=$invoice_number;
     		$mdata['school_code']=$school_code;
     		
 	     
		    $this->db->insert("feedue",$mdata);
		 }
		  
		    
		    
			foreach($months as $g):
				
		    $fee_deposite_m = array(
		    "student_id"=>$this->input->post('stuId'),
		    "deposite_month"=>$g,
		    "invoice_no"=>$invoice_number,
		    "fsd"=>$this->input->post("fsdid")
		    );
		    $this->db->where("student_id",$this->input->post("stuId"));
		    $this->db->where("deposite_month",$g);
		   $checkdeposite= $this->db->get("deposite_months");
		   if($checkdeposite->num_rows()>0){
		       $checkdeposite = $checkdeposite->row();
		       $this->db->where("id",$checkdeposite ->id);
		$this->db->update("deposite_months",$fee_deposite_m);
		   }else{
		       $this->db->insert("deposite_months",$fee_deposite_m);
			 }
			 
			 if($school_code==14){
		   $trnsfeemon=	$this->input->post("dtransport_fee");
			}else{
				$trnsfeemon	=$this->input->post("transport_fee");
			}
						if($trnsfeemon>0){
		
							$tranportdat=array(
								"stu_id"=>$this->input->post('stuId'),
								"month"=>$g,
								"total_amount"=>$this->input->post("transport_fee"),
								"paid_amount"=>$this->input->post("transport_fee"),
								"invoice_number"=>$invoice_number,
								"school_code"=>$school_code,
								"date"=>date("y-m-d")
					
							);
							$this->db->insert("transport_fee_month",$tranportdat);
						}
			

		endforeach;
		//---------------------------------------------- Opening Colsing Balance Start -----------------------------------------
		$bal = array(
				"closing_balance" => $close1
		);
		$this->db->where("school_code",$school_code);
		$this->db->where("opening_date",date('Y-m-d'));
		$this->db->update("opening_closing_balance",$bal);
		//---------------------------------------------- Opening Colsing Balance End -------------------------------------------
			
		
		//---------------------------------------------- CHECK SMS SETTINGS -----------------------------------------
		$totfee = $this->input->post("total1");
		$paid = $this->input->post("paid");
		$current_balance = $this->input->post("cb");
		$this->load->model("smsmodel");
		$sender = $this->smsmodel->getsmssender($school_code);
		$sende_Detail =$sender;
		$isSMS = $this->smsmodel->getsmsseting($school_code);
		 $sende_Detail1=$sende_Detail->row();
			  			
		//---------------------------------------------- END CHECK SMS SETTINGS -----------------------------------------
			$this->db->where("school_code",$school_code);
			$this->db->where("student_id",$this->input->post('stuId'));
			$this->db->where("invoice_no",$invoice_number);
		    $mode = $this->db->get('fee_deposit')->row()->payment_mode;
		if($isSMS->fee_submit){
		    if($mode==1 || $mode==5){
		
			//echo $student->student_id.'sss';
			$this->db->where("school_code",$school_code);
			$this->db->where("student_id",$student->id);
			$var=$this->db->get("guardian_info")->row();
			$fmobile=$student->mobile;

				$fmobile1=$this->session->userdata("mobile_number");
	
			$msg1="Dear sir/Mam , Rs. ".$paid."amount has been credited in your account  by ".$student->username;
		//get fee details
	         	$this->db->where("invoice_no",$invoice_number);
                    	//$this->db->where("school_code",$this->session->userdata("school_code"));
					$rty = 	$this->db->get("deposite_months");
					$monthmk=array();
					$this->db->where('id',$fsddate);
					$fsd1=$this->db->get('fsd')->row();
					$demont = $rty->num_rows();
                   $i=0;$printMonth=""; foreach($rty->result() as $tyu):
                         if($tyu->deposite_month<4){
                            $ffffu= $tyu->deposite_month-4+12;
                         }else{
                            $ffffu= $tyu->deposite_month-4;
                         }
                         $printMonth= $printMonth."".date('M-Y', strtotime("$ffffu months", strtotime($fsd1->finance_start_date))).", ";
						$monthmk[$i]=$tyu->deposite_month;
                    	//echo date("d-M-y", $rdt);
					$i++; endforeach;	
			//end get fee details
			
			
			$stuname=$student->name;
			$msg = "Dear Parent your child ".$stuname.",Fee of Month ".$printMonth.",is deposited of Rs.".$paid."/-with due balance Rs.".$current_balance."/-.For more info visit: ".$sende_Detail1->web_url;
		//echo $msg;exit;
			$this->db->where("id",$school_code);
		    $admin_mobile = $this->db->get('school')->row();
		    $max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		    $master_id=$max_id->maxid+1;

		     if($this->session->userdata("school_code")!=9){
		          $getv=mysms($sende_Detail1->auth_key,$msg,$sende_Detail1->sender_id,$fmobile1);
		           $this->smsmodel->sentmasterRecord($msg,2,$master_id,$getv);
		          	$master_id=$master_id+1;
		       // sms($fmobile1,$msg1,$sende_Detail1->uname,$sende_Detail1->password,$sende_Detail1->sender_id);
		        }
		        $getv=mysms($sende_Detail1->auth_key,$msg,$sende_Detail1->sender_id,$fmobile);
		     $this->smsmodel->sentmasterRecord($msg,2,$master_id,$getv);
		    
		   redirect("index.php/invoiceController/fee/$invoice_number/$stuid/$fsddate/yes");
			
		
		}
			elseif($mode==2){
				$amt_paid=$this->input->post('paid');
				//print_r($amt_paid);
				// print_r($mode);
				//  exit;
				redirect("index.php/paytm/pgRedirect/$invoice_number/$stuid/$fsddate/$amt_paid/2/");
				}
		}
		
				
		else{
			$this->db->where("school_code",$school_code);
			$this->db->where("student_id",$this->input->post('stuId'));
			$this->db->where("invoice_no",$invoice_number);
		    $mode = $this->db->get('fee_deposit')->row()->payment_mode;
		    //print_r($mode);exit;
			if($mode==1 || $mode==5){
			redirect("index.php/invoiceController/fee/$invoice_number/$stuid/$fsddate/");
			}
			elseif($mode==2){
				$amt_paid=$this->input->post('paid');
				// exit;
				redirect("index.php/paytm/pgRedirect/$invoice_number/$stuid/$fsddate/$amt_paid/2/");
				}
		}
		}else{
		redirect("login/collectFee/feeFalse");
	
		}
			
	}

	
	function feeReport(){
        $data['fsd'] = $this->input->post("fsd");
	    $data['sec'] = $this->input->post("section");
		$data['cla'] = $this->input->post("classv");
		$this->load->view("ajax/feeReport",$data);
		// if($cla == "all"):
		// //$this->db->where("school_code",$school_code);
		// $this->db->where("status",1);
		// $student = $this->db->get("student_info");
		// elseif($cla != "all"):
		// //$this->db->where("school_code",$school_code);
		// $this->db->where("status",1);
		// $this->db->where("class_id",$cla);
		// $student = $this->db->get("student_info");
		// else:
		// //$this->db->where("school_code",$this->session->userdata("school_code"));
		// $this->db->where("status",1);
		// $this->db->where("class_id",$cla);
		// //$this->db->where("section",$sec);
		// $student = $this->db->get("student_info");
		
		// endif;
		// $checkstudent="NEW";
		// }
		 // else{
	 	// if($cla == "all"):
		// 	$this->db->where("school_code",$this->session->userdata("school_code"));
		//  	$this->db->where("status",1);
		//  	$student = $this->db->get("student_info");
		//  	elseif($cla != "all"):
		// // 	$this->db->where("school_code",$this->session->userdata("school_code"));
	 //     $this->db->where("status",1);
	 // 	  $this->db->where("class_id",$cla);
		// 	$student = $this->db->get("student_info");
		// 	else:
		 	
		// 	$this->db->where("section",$sec);
			//$this->db->where("school_code",$this->session->userdata("school_code"));
			
			
		// 	endif;
		//  	$checkstudent="OLD";
		//  }
		// $data['checkStudent']=$checkstudent;
		
	}
				  
	function fullstudentfeeDetail(){
		$studentid = $this->uri->segment(3);
		
		$this->load->model("feeModel");
		$studentdata=$this->feeModel->fullstudentfeeDetail($studentid);
		$data['student']=$studentdata;
		$data['pageTitle'] = 'Fee Report';
		$data['smallTitle'] = 'Fee Report';
		$data['mainPage'] = 'Fee';
		$data['subPage'] = 'Fee Report';
		$data['title'] = 'Fee Report';
		$data['headerCss'] = 'headerCss/feeCss';
		$data['footerJs'] = 'footerJs/feeJs';
		$data['mainContent'] = 'studentfeecard';
		$this->load->view("includes/mainContent", $data);
		}	

		function fullfeeDetailIframe(){
			$studentid = $this->uri->segment(3);
			
			$this->load->model("feeModel");
			$studentdata=$this->feeModel->fullstudentfeeDetail($studentid);
			$data['student']=$studentdata;

			$data['headerCss'] = 'headerCss/feeCss';
			$data['footerJs'] = 'footerJs/feeJs';
		
			$this->load->view("fullfeeDetailIframe", $data);
			// $this->load->view("includes/mainContent", $data);
			}

		function fullDetail(){
		$studid = $this->uri->segment(3);
		$fsd = $this->uri->segment(4);
		$data['fsdorg']=$fsd;
		$this->load->model("feeModel");
		$da=$this->feeModel->fulldetail($studid,$fsd);
		$data['request']=$da->result();
		$data['pageTitle'] = 'Fee Report';
		$data['smallTitle'] = 'Fee Report';
		$data['mainPage'] = 'Fee';
		$data['subPage'] = 'Fee Report';
		$data['title'] = 'Fee Report';
		$data['headerCss'] = 'headerCss/feeCss';
		$data['footerJs'] = 'footerJs/feeJs';
		$data['mainContent'] = 'personal';
		$this->load->view("includes/mainContent", $data);
		}
		function stuattendence(){
		$studid = $this->uri->segment(3);
		$fsd = $this->uri->segment(4);
		$data['fsdorg']=$fsd;
		$this->load->model("feeModel");
		$da=$this->feeModel->fulldetail($studid,$fsd);
		$data['request']=$da->result();
		$data['pageTitle'] = 'Attendence Report';
		$data['smallTitle'] = 'Attendence Report';
		$data['mainPage'] = 'Attendence';
		$data['subPage'] = 'Attendence Report';
		$data['title'] = 'Attendence Report';
		$data['headerCss'] = 'headerCss/feeCss';
		$data['footerJs'] = 'footerJs/feeJs';
		$data['mainContent'] = 'attendence';
		$this->load->view("includes/mainContent", $data);
		}	
		function feesDetail(){
		
		$data['pageTitle'] = 'Student Fee Report';
		$data['smallTitle'] = 'Student Fee Report';
		$data['mainPage'] = 'Student Fee Report';
		$data['subPage'] = 'Student Fee Report';
		$data['title'] = 'Student Fee Report';
		$data['headerCss'] = 'headerCss/feeCss';
		$data['footerJs'] = 'footerJs/feeJs';
		$data['mainContent'] = 'stufeesdetail';
		$this->load->view("includes/mainContent", $data);
		}
			
		function current_monthreport(){
		   $fsd= $this->input->post("fsd");
		   $section= $this->input->post("section");
		   $classv= $this->input->post("classv");
		  
		   $month= $this->input->post("month");
		 
		   $data['month']=$month;
		   $data['studt']=$this->feeModel->getstudent($classv);
		  
    		$this->load->view("currentmonthfee", $data);
		    
		}
		function enterDeufee(){
		    
            $school_code=$this->session->userdata("school_code");
			$this->db->where("school_code",$school_code);
    		$invoice = $this->db->get("invoice_serial");
    		$invoice1=6000+$invoice->num_rows();
    		$invoice_number = $school_code."I19".$invoice1;
    		
			$invoiceDetail = array(
					"invoice_no" => $invoice_number,
					"reason" => "Fee Due",
					"invoice_date" => date("Y-m-d"),
					"school_code"=>$this->session->userdata("school_code")
			);
			$this->db->insert("invoice_serial",$invoiceDetail);
			$studid=$this->input->post("studentId");
		    $feeDueData = array(
				"student_id" => $this->input->post("studentId"),
				//"feecat" => $this->input->post("s_cat"),
				"mbalance" => $this->input->post("remain"),
				//"paid" => $this->input->post("paid"),
				//"remain" => $this->input->post("remain"),
				"description" => $this->input->post("desc"),
				"depositedate" => date("Y-m-d"),
				'invoice_no'=>$invoice_number,
				"school_code"=>$this->session->userdata("school_code")
		);
		$school_code = $this->session->userdata("school_code");
		
		$paid=$this->input->post("paid");
		$cv =	$this->db->query("SELECT mbalance FROM feedue WHERE student_id = '$studid'  AND school_code='$school_code' order by `id` desc limit 1")->row();
		//$psv =	$this->db->query("SELECT previous_stock_balance FROM fee_deposit WHERE student_id = '$studid' AND school_code='$school_code' order by `id` desc limit 1")->row();
        $pri=0;
		$pri = $pri + $cv->mbalance; //+ $psv->previous_stock_balance;
		$remain12=$pri-$paid;
		$da=array(
				'mbalance'=>$remain12
		);
		$this->db->where("school_code",$school_code);
		$this->db->where("invoice_no",$invoice_number);
		$this->db->where("student_id",$studid);
		$this->db->update("feedue",$da);
		
		$this->load->model("feeduemodel");
		$var = $this->feeduemodel->enterDetail($feeDueData,$studid);
		$op1 = $this->db->query("select closing_balance from opening_closing_balance where opening_date='".date('Y-m-d')."' AND school_code='$school_code'")->row();
		$Clbalance = $op1->closing_balance;
		$amount=$this->input->post("paid");
		$cbal=$Clbalance+$amount;
		$bal = array(
				"closing_balance" => $cbal
		);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("opening_date",date('Y-m-d'));
		$this->db->update("opening_closing_balance",$bal);
		
		$daybookdata=array(
				'paid_to'=>"Admin",
				'paid_by'=>$this->input->post("studentId"),
				'reason'=>$this->input->post("desc"),
				'dabit_cradit'=>2,
				'amount'=>$this->input->post("paid"),
				'closing_balance'=>$cbal,
				'pay_date'=>date('Y-m-d'),
				'pay_mode'=>"Cash",
				'invoice_no'=>$invoice_number,
				'school_code'=>$this->session->userdata("school_code")
		);
		$this->db->insert("day_book",$daybookdata);
		
		$feedepositedata=array(
			'student_id'=>$studid,
			'deposite_month'=>0,
			'late'=>'0.00',
			'previous_balance'=>'0.00',
			'feecat'=>$this->input->post("s_cat"),
			'transport'=>0,
			'description'=>$this->input->post("desc"),
			'payment_mode'=>"Due Print",
			'total'=>$this->input->post("totdue"),
			'paid'=>$paid,
			'diposit_date'=>date('Y-m-d H:i:s'),
			'invoice_no'=>$invoice_number,
			'finance_start_date'=>$this->session->userdata('fsd'),
			'school_code'=>$school_code
	);
	$this->db->insert("fee_deposit",$feedepositedata);
		         $this->db->where("school_code",$school_code);
		$isSMS = $this->db->get("sms")->row()->fee_submit;
		$amount1=$this->input->post("paid");
		$totdue=$this->input->post("totdue");
		$balance=$this->input->post("remain");
		
			
		//---------------------------------------------- END CHECK SMS SETTINGS -----------------------------------------
		if($isSMS == '1'){
		   
			$student_id = $this->input->post("studentId");
			$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("student_id",$student_id);
			$var=$this->db->get("guardian_info")->row();
			$fmobile=$var->f_mobile;
			
			//$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("status",1);
			$this->db->where("id",$student_id);
			$stu=$this->db->get("student_info")->row();
			$stuname=$stu->name;
				
            $school_code=  $this->session->userdata("school_code");
		    $this->db->where("school_code",$school_code);
	     	$sender=$this->db->get("sms_setting");
		  	$sende_Detail =$sender->row();
				$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
		$master_id=$max_id->maxid+1;
		
		//	sms($fmobile,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
		
			 $master_id=$master_id+1;
			$this->db->where("id",$school_code);
        	$schoolname=$this->db->get("school")->row();
        		$msg = "Dear Parent your child ".$stuname." fee ".$amount1.",is diposited of total ".$totdue."/-with due balance Rs.".$balance."/-".$schoolname->school_name;
			$getv=mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$fmobile);
				 $this->smsmodel->sentmasterRecord($msg,2,$master_id,$getv);
			if($schoolname->id==1){
			    $msg1 = "Dear school principle student ".$stuname." fee ".$amount1.",is diposited of total ".$totdue."/-with due balance Rs.".$balance."/-".$schoolname->school_name;
			 	$getv=mysms($sende_Detail->auth_key,$msg1,$sende_Detail->sender_id,$schoolname->mobile_no);   
			 $this->smsmodel->sentmasterRecord($msg1,2,$master_id,$getv);
			 	 $master_id=$master_id+1;
			 $msg2 = "Dear school principle student ".$stuname." fee ".$amount1.",is diposited of total ".$totdue."/-with due balance Rs.".$balance."/-".$schoolname->school_name;
	            	$getv=mysms($sende_Detail->auth_key,$msg2,$sende_Detail->sender_id,"7398863503");   
			 $this->smsmodel->sentmasterRecord($msg2,2,$master_id,$getv);	
		
			}
		}
		redirect(base_url()."invoiceController/printDueFee/".$invoice_number);
	}		
		public function checkDetails(){
			$msg = '<div class="alert alert-info"><button data-dismiss="alert" class="close">&times;</button><strong>New Entry :) </strong></div>';
			//$studentId = $this->input->post("studentId");
			$studentusername = $this->input->post("studentusername");
			$this->db->where('username',$studentusername);
			$id=$this->db->get('student_info');
			if($id->num_rows()>0){
			$id1 = 	$id->row();
			$this->load->model("feeduemodel");
			$var = $this->feeduemodel->checkStock($id1->id);
			if($var->num_rows() > 0){
				foreach ($var->result() as $row){
					 $sname = $id1->name;
					 $tdue =$row->mbalance;
						$itemData = array(
							"studentId" =>$row->student_id,
							"studentName" =>$sname,
							"totdue" =>$tdue,
							"msg" => ""
					);
				}
				echo (json_encode($itemData));
			}
			else{
				$var = $this->feeduemodel->checkStock2($id1->id);
				if($var->num_rows() > 0){
					foreach ($var->result() as $row){
						$sname = $row->name;
						$tdue =0.00;
						$itemData = array(
							"studentId" =>$row->id,
							"studentName" =>$sname,
							"totdue" =>$tdue,
							"msg" => $msg
						);
				}
				echo (json_encode($itemData));
			}
			}
			
		}else{
			echo "wrong Username";
		}
		
	}
		function printDueById(){
			$var= $this->input->post("billNo");
			$this->db->where('username',$var);
			$id=$this->db->get("student_info");
			if($id->num_rows()>0)
			{
			$id1=$id->row()->id;
			$this->db->where("student_id",$id1);
			$filter=$this->db->get("feedue");
			if($filter->num_rows()>0)
			{
				?><table class="table table-bordered table-striped">
				<tr> 
					<th>S.no</th>
					<th>Student Id</th>
					<!-- <th>Student Name</th> -->
					<th>Total due</th>
					<!-- <th>Paid</th> -->
					<th>Deposit Date</th>
					<!-- <th>Invoice No</th> -->
					<th>Action</th>
				</tr>
				<?php $i =1 ;foreach($filter->result() as $f):?>
				<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $f->student_id;?></td>
				<!-- <td><?php echo $f->student_name;?></td> -->
				<td><?php echo $f->mbalance;?></td>
				<!-- <td><?php  echo $f->paid;?></td>-->
				<td><?php $inv = $f->invoice_no; echo $f->depositedate;?></td> 
				
				<td>
				<a href="<?php echo base_url()?>index.php/invoiceController/printDueFee/<?php echo $inv;?>" target="_blank" class="btn btn-blue">
								Print Invoice
							</a>
				</td>
				</tr>
				<?php $i++; endforeach;?>
				</table><?php 
		}
		else{
		echo "No Value Found In table";
		}
	}
	else{
		echo "Username Not Found";
	}
}
		
	function deleteFee(){
			$invoiceNo = $this->uri->segment(3);
			$student_id = $this->uri->segment(4);
			$school_code=$this->session->userdata("school_code");
			$this->db->where("school_code",$school_code);
			$this->db->where('invoice_no', $invoiceNo);
			$this->db->where('student_id', $student_id);
			$uprow = $this->db->get('fee_deposit');
			$pvt = $uprow->row()->previous_balance;
		$this->db->where("student_id",$student_id);
	$pvv = 	$this->db->get("feedue");
	if($pvv->num_rows()>0){
	    $updatepv = array(
	        "mbalance"=>$pvt
	        );
	     $this->db->where("student_id",$student_id);
	     $this->db->update("feedue",$updatepv);
	        
	}else{
	     $updatepv = array(
	        "mbalance"=>$pvt
	        );
	        
	          $this->db->where("student_id",$student_id);
	             $this->db->insert("feedue",$updatepv);
	}
			if($this->uri->segment(6)){
			$fristfee = $this->uri->segment(6);
			$df = $this->uri->segment(5);
			}else{
				$df = $this->uri->segment(5);
			}
			$this->db->where("school_code",$school_code);
			$this->db->where('invoice_no', $invoiceNo);
			$val = $this->db->get("day_book")->row();
			$op1 = $this->db->query("select closing_balance from opening_closing_balance where opening_date='".date('Y-m-d')."' AND school_code='$school_code'");
			if($op1->num_rows()>0){
			$balance = $op1->row()->closing_balance;}else{$balance="0.00";}
			$close1 = $balance - $val->amount;
			$data = array(
					'paid_to' =>$student_id ,
					'paid_by' => $this->session->userdata('username'),
					'reason' => " Wrong Fee Entered",
					'dabit_cradit' => 0,
					'amount' =>$uprow->row()->paid,
					'closing_balance' => $close1,
					'pay_date' => date("Y-m-d"),
					'pay_mode' => "Software",
					'invoice_no' => "Delete Fee",
					'school_code'=>$school_code
					
			);
			$bal = array(
					"closing_balance" => $close1
			);
			$this->load->model('feemodel');
			$this->feemodel->insertocanddaybook($bal,$data);
			
			// 	$this->db->where("school_code",$this->session->userdata("school_code"));
			// $this->db->where('invoice_no', $invoiceNo);
			// $this->db->where('student_id', $student_id);
			// $uprow = $this->db->get('fee_deposit');
			// if($uprow->num_rows()>0){
			   
			    // $tot=0;
			   
			    // $tot=$uprow->paid;
			    // $datau  = array(
			    //    // 'status'=>"pending",
			    //     'invoice_no'=>null,
			    //     'diposit_date'=>'0000-00-00',
			    //     'total'=>0.00,
			    //     'paid' =>0
			    // );
			   // $this->db->where("student_id",$student_id);

			   if(($this->feemodel->fee_deposite($invoiceNo,$student_id))&&($this->feemodel->deposite_month($invoiceNo,$student_id))){
				redirect(base_url()."index.php/feeControllers/feesDetail/".$student_id."/".$df); 
			   }else{
				   echo "Please Contact to Admin";
			   }

			  
			//}
			
			
		
			//redirect(base_url()."index.php/feeControllers/fullDetail/".$student_id."/".$df); 
			
		}
		function deleteFeedue2(){
			$invoiceNo = $this->uri->segment(3);
			$student_id = $this->uri->segment(4);
			$fristfee = $this->uri->segment(5);
			$this->db->where('invoice_no', $invoiceNo);
			if($val = $this->db->get("day_book")->row()){
			$op1 = $this->db->query("select closing_balance from opening_closing_balance where opening_date='".date('Y-m-d')."' AND school_code='$this->session->userdata(school_code)'")->row();
			$balance = $op1->closing_balance;
			$close1 = $balance - $val->amount;
			$data = array(
					'paid_to' => "student",
					'paid_by' => "admin",
					'reason' => " Wrong Fee Entered",
					'dabit_cradit' => "Debit",
					'amount' => $val->amount,
					'closing_balance' => $close1,
					'pay_date' => date("Y-m-d"),
					'pay_mode' => "Software",
					'invoice_no' => "Delete Fee",
					'school_code'=>$this->session->userdata("school_code")
			
			);
			$bal = array(
					"closing_balance" => $close1
			);
			
			$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("opening_date",date('Y-m-d'));
			$this->db->update("opening_closing_balance",$bal);
			
			$this->db->insert("day_book",$data);
			}
			$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where('invoice_no', $invoiceNo);
			$this->db->where('student_id', $student_id);
			$this->db->delete('feedue2');
			//$data1 = array(
					//"current_balance" => $val->amount
			///); 
			
			//$sno = $this->db->query("SELECT * FROM fee_deposit WHERE student_id ='".$student_id."' ORDER BY ID DESC limit 1")->row();
			//$this->db->where("id",$sno->id);
			//if($this->db->update("fee_deposit",$data1)){
			redirect(base_url()."index.php/feeControllers/fullDetail/".$student_id);
			//}
			//else{l
			//	echo "Wrong Value";
			//}
		}
		function transReport(){
			$data['fsd'] = $this->input->post("fsd");
			$data['cla'] = $this->input->post("classv");
			$data['sec'] = $this->input->post("section");
			$this->load->view("ajax/transport",$data);
			}
			
		
		function feeRemSms(){
		    $school_code=  $this->session->userdata("school_code");
		    $this->db->where("school_code",$school_code);
		    $sender=$this->db->get("sms_setting");
		
        	$this->db->where("id",$school_code);
        	$schoolname=$this->db->get("school")->row();
	     	$this->load->model("smsmodel");
		  	$sende_Detail =$sender->row();
	      	$sdue=$this->input->post("smstodue");
			echo 'Send';
			$mnum=$this->input->post("mnum");
			$sname=$this->input->post("sname");
			$amt=$this->input->post("amount");
			$amt1=$this->input->post("amount1");
			
			
// 			if($amt==0)	{
// 			    $amt2=$this->input->post("amount");
// 			}else{
// 			    $amt2="0.00";
// 			}
// 			if($amt1==0){
// 			    $amt3=$this->input->post("amount1");
// 			}else{
// 			    $amt3="0.00";
// 			}
// 		  if($amt==0)	{
		  		   
		  		
// 			$msg =	"Dear Sir/Madam your Ward's (".$sname.") School Fee ".$amt1." is remain to deposit. Please deposit soon.".$schoolname->school_name;
		  	
// 				sms($mnum,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
//           }else	{
		  			$msg =	"Dear Sir/Madam your Ward's (".$sname.") School Fee ".$amt." of month ".$sdue." is remain to deposit and your previous Balance is ".$amt1.". Please deposit the fee before the exam otherwise Your ward will not allow to take the exam.".$schoolname->school_name;
   
		  		$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
					$master_id=$max_id->maxid+1;

			
				
						 $getv=  mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$mnum);
					
						 $this->smsmodel->sentmasterRecord($msg,2,$master_id,$getv);
						echo "Sent Success";
					//}

			
		// print_r($msg);
// exit();
	//	$msg =	"Dear Sir/Madam your Ward's (".$sname.") School Fee ".$amt." of month ".$sdue." is remain to deposit and your previous Balance is ".$amt1.". Please deposit it till 5 september.".$schoolname->school_name;
			
		//
          //}
						
		}
		
		function getFeeDetails(){
		    $school_code = $this->session->userdata("school_code");
		   $month =  $this->input->post("month");
		   $stuid =  $this->input->post("stuId");
		   $scatid =  $this->input->post("catId");
		   $fsdid =  $this->input->post("fsdid");
		   //$this->feeModel->getperfeerecord($stuid);
		 
		   //echo $fsdid."rahuk";
		 
		 
		$i=0; foreach($month as $mtable):
		     $searchM[$i] = $mtable;
		    $i++; endforeach;
		     $searchM[$i]=13;
		   $this->db->where("id",$stuid);
		   $stuid_details = $this->db->get("student_info")->row();
		   $feecata[0]=$scatid;
		      $feecata[1]=0;
		   $this->db->distinct();
		   $this->db->select("*");
		   $this->db->where("fsd",$fsdid);
		   $this->db->where("class_id",$stuid_details->class_id);
		    $this->db->where_in("cat_id",$feecata);
			$this->db->where_in("taken_month",$searchM);
			
		   $fee_head = $this->db->get("class_fees");
		    $totfees=0;
		    if($stuid_details->discount_id>0){
		    	$this->db->where("id",$stuid_details->discount_id);
		    	$studdiscount = $this->db->get("discounttable");
		    }
		  ?>
		  
		  <table><tr>
		  <td valign="top" width="50%">
	                            <div class="col-sm-12">
	                                <div class="panel panel-white">
	                                    <div class="panel-heading panel-red text-uppercase">Payment Mode Detail</div>
	                                      <input type="hidden" name ="feecat" id="feecat" value="<?php echo $scatid; ?>" class="form-control">             	
	                                    <div class="row" id="cheque">
	                                        <div class="col-sm-12">
	                                            <br/>
	                                            <div class="row space15">
	                                                <div class="col-sm-12">
	                                                    <div class="col-sm-5 text-uppercase">Depositor Name</div>
	                                                    <div class="col-sm-7">
	                                                        <input type="text" name ="dipositorName1" id="ac" class="form-control text-uppercase" onkeyup="depositorname();">
	                                                    </div>
	                                                </div>
	                                            </div>									
	                                           <?php 	
	                                           if($stuid_details->discount_id>0){
	                                           if($studdiscount->num_rows()>0){
	                                        		$discountRow = $studdiscount->row();?>
	                                        		<div class="row space15">
	                                           
	                                                <div class="col-sm-12">
	                                                    <div class="col-sm-5 text-uppercase"><?php echo $discountRow->discount_head;?></div>
	                                                    <div class="col-sm-7">
	                                                      <?php if($discountRow->discount_amount > 0.00){echo $discountRow->discount_amount;}else{ echo $discountRow->discount_persent."%";} ?>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        		<?php  }}?>
	                                            <div class="row space15">
	                                           
	                                                <div class="col-sm-12">
	                                                    <div class="col-sm-5 text-uppercase">Enter Discount</div>
	                                                    <div class="col-sm-7">
	                                                       <input type="text" name ="discountv" id="discountv" value="0.00" class="form-control" onkeyup="amount();">
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="row space15">
	                                                <div id = "discountprint">
	                                                 <div  class="col-sm-12">
	                                                    <div class="col-sm-5 text-uppercase">Enter Discounter ID</div>
	                                                    <div class="col-sm-7">
	                                                        <input type="text" name ="discounterID" id="discounterID"  class="form-control text-uppercase">
	                                                    </div>
	                                                </div>
	                                               </div>
	                                           </div> 
	                                
	                                             <div class="row space15">
	                                                <div id = "discounterOTP">
	                                                 <div  class="col-sm-12">
	                                                    <div class="col-sm-5 text-uppercase">Enter OTP</div>
	                                                    <div class="col-sm-7">
	                                                        <input type="text" name ="discounterOTPv" id="discounterOTPv"  class="form-control" >
	                                                    </div>
	                                                </div>
	                                            </div>
	                                           </div> 
	                                            <div class="row space15">
	                                                <div id = " ">
	                                                 <div  class="col-sm-12">
	                                                    <div class="col-sm-12" id ="rahul1"></div>
	                                                   
	                                                </div>
	                                            </div>
	                                           </div> 
	                                            <div class="row space15">
	                                                <div class="col-sm-12">
	                                                    <div class="col-sm-12" id="rahul"></div>
	                                                   
	                                                </div>
												</div>
												<?php $disc=0;$disc1 =0;
												if($stuid_details->discount_id>0){
													if($studdiscount->num_rows()>0){
														$discountRow = $studdiscount->row();
													//$this->db->where("school_code",$school_code);
													//print_r($discountRow->applied_head_id);
													//print_r($stuid_details->class_id);
													$this->db->where("fsd",$stuid_details->fsd);
													$this->db->where("fee_head_name",$discountRow->applied_head_id);
													$this->db->where("class_id",$stuid_details->class_id);
													$damount=$this->db->get("class_fees");
													
													if($damount->num_rows()>0){
													$dmo = ($damount->row()->fee_head_amount);
													if($discountRow->discount_persent>0){
													$disc1 = ($dmo * $discountRow->discount_persent)/100;
													}else{
														$disc1=$discountRow->discount_amount;
													}}
													?>
												<div class="row space15">
	                                                <div class="col-sm-12">
														<div class="col-sm-5 text-uppercase">Discount</div>
														<?php  $disc=0 ; foreach($month as $mtable):
														$disc+=$disc1;
															endforeach;?>
															
														<div class="col-sm-7"> <input type="text" name ="discount_start"  id="discount_start"  value ="<?php echo $disc;?>" class="form-control"></div>
	                                                </div>
												</div>
												<?php } }else{
													?>
                                                <input type="hidden" name ="discount_start" id="discount_start" value ="<?php echo 0.00;?>" class="form-control">
												<?php } ?>
												<div class="row space15">
	                                                <div class="col-sm-12">
	                                                    <div class="col-sm-5 text-uppercase">Late Fee</div>
	                                                    <div class="col-sm-7">
	                                                   
	                                                     	  	<?php 
							
					$latefee1=	$this->feeModel->getlatefee($stuid,$fsdid);
						

							//$this->db->where("school_code",$school_code);
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
							if($cdate12>='2020-01-01'){
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
                         if($latefee1<1){
						            $latefee1=0;
						        }
					}}else{
						$latefee1='0.00';
					 }
					 
				// 	 if($realm>0){
					     
				// 	}else{
				// 		$realm=0;
				// 	} 

				if($school_code==7){
				    if($this->session->userdata("login_type")=="admin"){
				?>
				<input type="text" value="<?php echo  $latefee1; ?>" name ="latefee" id="latefee2" class="form-control" onkeyup="fee();">
	              
	                 <?php } else{ ?>
	                 <input type="text" value="<?php echo  $latefee1; ?>" name ="latefee" id="latefee2" readonly="" class="form-control" onkeyup="fee();">
	                 
	                 <?php }} else{ ?>
	                  <input type="text" value="<?php echo  $latefee1; ?>" name ="latefee" id="latefee2" class="form-control" onkeyup="fee();">
	              
	                 <?php } ?>
						
														</div>
	                                                </div>
	                                            </div>
	                                             <input type='hidden' value='<?= json_encode($month) ;?>' name='arrvalue'>    
	                                           
	                                           
	                                            <?php 
												$this->db->where('id',$fsdid);
												$junefee=$this->db->get('fsd')->row()->june_transport_fee_status;
	                                           $transfee=0;
	                                          
	                                            if(($stuid_details->transport)){
	                                                $this->db->where("id",$stuid_details->vehicle_pickup);
	                                              $tffee=  $this->db->get("transport_root_amount");
	                                              
	                                              if($tffee->num_rows()>0){
	                                                   $tffee=$tffee->row();
	                                                  
	                                                  $this->db->where("root_id",$tffee->id);
	                                                  $this->db->where("fsd",$fsdid);
	                                                 $rtyh = $this->db->get("fsdwise_root_amount");
	                                                 if($rtyh->num_rows()>0){
	                                                    
	                                                   foreach($month as $mtable):
		   
		     if(($junefee == 1)){
	                                            if($mtable!=6){
	                                                $transfee  +=$rtyh->row()->amount;
	                                            }}else{
	                                                $transfee  +=$rtyh->row()->amount;
	                                            } endforeach; }
	                                            	?>
	                                             <div class="row space15">
	                                                <div class="col-sm-12">
	                                                    <div class="col-sm-5 text-uppercase">Transport Fee</div>
	                                                    <div class="col-sm-7">
	                                                   <?php if($school_code==14){ 
																											$tmno=implode("",$month);
																											
																											 $this->db->where("month",$tmno);
																											 $this->db->where("stu_id",$stuid);
																											 $tamount=$this->db->get("transport_fee_month");
																											 if($tamount->num_rows()>0){ ?>
																											 <input type="text" name ="dtransport_fee" id="dtransport_fee1" value="" class="form-control" onkeyup="trans();" >
																											<?php }else{
																											 ?>
	                                                        <!--<input type="hidden" name ="transport_fee" id="transport_fee" value ="<?php // echo $transfee;?>" class="form-control">-->
	                                                         <input type="text" name ="dtransport_fee" id="dtransport_fee1" value="" class="form-control" onkeyup="trans();" >
	                                                   <?php  } } else{ 
																											
																											//  print_r($month);
																											//  exit;
																											$tmno=implode("",$month);
																											
																											 $this->db->where("month",$tmno);
																											 $this->db->where("stu_id",$stuid);
																											 $tamount=$this->db->get("transport_fee_month");
																											//  print_r($tamount->row());
																											//  exit;
																											 if($tamount->num_rows()<1){  ?>
																												<input type="hidden" name ="transport_fee" id="transport_fee" value ="<?php echo $transfee;?>" class="form-control">
																												<input type="text" name ="dtransport_fee" id="dtransport_fee" value="<?php echo $transfee;?>" class="form-control" disabled="disabled">
																									<?php	  $totfees+=$transfee;	}else{ ?>
	                                                   <input type="hidden" name ="transport_fee" id="transport_fee" value ="<?php echo $transfee;?>" class="form-control">
	                                                         <input type="text" name ="dtransport_fee" id="dtransport_fee" value="<?php echo $transfee;?>" class="form-control" disabled="disabled">
	                                                 <?php $totfees+=$transfee;?>
	                                                   <?php  } } ?>
	                                                  
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <?php }}?>
	                                             <div class="row space15">
	                                                <div class="col-sm-12">
	                                                    <div class="col-sm-5 text-uppercase">Description</div>
	                                                    <div class="col-sm-7">
	                                                       <textarea rows="5" cols="6" class="form-control" id="disc" name="disc" placeholder="Text Field"></textarea>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="row space15">
	                                                <div class="col-sm-12">
	                                                    <div class="col-sm-12" id="rahul"></div>
	                                                   
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
	                                   
	                                    
	                                </div>
	                            </div>
	                           
	                            </td>
	                            <td>
	<!-- ------------------------------------------------- Payment mode Column End ------------------------------------------------------ -->					
	<!-- ------------------------------------------------- Fee Detail Column ------------------------------------------------------ -->
	                            <div class="col-sm-12">
	                                <div class="panel panel-white">
	                                    <div class="panel-heading panel-red text-uppercase">Fee Detail</div>
	                                    <div class="row" id="no1">
	                                        <div class="col-sm-12">
	                                           
	                                        </div>
	                                    </div>
	                            
	                                    <div id="feeDetail">
	                                        <div class="row space15">
	                                            <div class="col-sm-12"></div>
	                                        </div>
	                                     <?php  
	                                   
	                                  $i=1;
	                                  if($fee_head->num_rows()>0){
	                                     foreach($fee_head->result() as $feeh):
	                                         
	                                     if($feeh->fee_head_name!= NULL){
											
	                                     ?>
	                                        <div class="row space15">
	                                                        <div class="col-sm-12">
	                                                           
	                                                           
	                                                            <?php $name =  $feeh->fee_head_name;
	                                                            if($feeh->taken_month==13){
	                                                                $fhamount=0;
	                                                                foreach($month as $m):
	                                                                    $fhamount=$fhamount+$feeh->fee_head_amount;
	                                                           
	                                                                 $totfees+=$feeh->fee_head_amount;
	                                                                 endforeach;?>
	                                                                  <div class="col-sm-6"> <?php echo $feeh->fee_head_name; ?>
	                                                            <input type="hidden" id="h<?= $feeh->fee_head_name; ?>"  value="<?= $fhamount;?>" class="form-control"/>
	                                                            </div>
	                                                             <div class="col-sm-6">
	                                                                <input type="hidden" id="<?php echo $name ?>" name="monthfee"  value="<?php echo $fhamount;?>" class="form-control"/>
	                                                                 <input type="text" id="d<?php echo $name; ?>" value="<?php echo $fhamount;?>" class="form-control" disabled="disabled"/>
	                                                               </div> 
	                                                               
	                                                              <!--  <div class="col-sm-3">
	                                                                Skip <input type="checkbox" id="skip--<?= $name; ?>" onchange="skip('skip--<?= $name ?>')" />
	                                                                <input type="hidden" id="skipValue--<?= $name; ?>" value="0" />
	                                                                </div>-->
	                                                                 
	                                                               <?php  }else{ ?>
	                                                             <div class="col-sm-6"> <?php echo $feeh->fee_head_name; ?>
	                                                            <input type="hidden" id="h<?= $feeh->fee_head_name; ?>"  value="<?= $feeh->fee_head_amount;?>" class="form-control"/>
	                                                            </div>
	                                                             <div class="col-sm-6">
	                                                                 <input type="hidden" id="<?php echo $name ?>"  value="<?php echo $feeh->fee_head_amount;?>" class="form-control"/>
	                                                                 <input type="text" id="d<?php echo $name; ?>"  value="<?php echo $feeh->fee_head_amount;?>" class="form-control" disabled="disabled"/>
	                                                               </div> 
	                                                               
	                                                             <!--   <div class="col-sm-3">
	                                                                Skip <input type="checkbox" id="skip--<?= $name; ?>" onchange="skip('skip--<?= $name ?>')" />
	                                                                <input type="hidden" id="skipValue--<?= $name; ?>" value="0" />
	                                                               </div>-->
	                                                               
	                                                                 <?php 
	                                                                 $totfees+=$feeh->fee_head_amount;
	                                                            }
	                                     //$count =$count+ $field->fee_head_amount;
	                                                                // if($disValue->num_rows()>0){
	                                                                    // $fg=$disValue->row();
	                                                                   //  if($field->fee_head_name==$fg->mannual){
	                                                                // if(strpos($discountCheck, '%')==true){
	                                                                   //  $name = str_replace('%', '0', $discountCheck);
	                                                                  //   $adcount = ($field->fee_head_name*$name)/100;
	                                                                  //   $count =$count-$adcount;
	                                                                // }else{
	                                                                   //  $count=$count-$discountCheck;
	                                                                // }
	                                                                 
	                                                                // }
	                                                                // }  
	                                                                 ?>
	                                                                 
	                                                           
	                                                      
	                                                    </div>
	                                        </div>
	                                        <?php } endforeach;}else{
	                                            echo "define Class Fee First";}
	                                            ?>
	                                        
	                                        
	                                        
	                                        <div class="row space15">
	                                            <div class="col-sm-12">
	                                                <div class="col-sm-6 text-uppercase">Previous Balance</div>
	                                                <div class="col-sm-6">
	                                                	<?php 
	                                                	$paid12 = "paid";
	                                                	$pb = $this->db->query("SELECT mbalance FROM feedue WHERE student_id='$stuid' and school_code='$school_code' ORDER BY id DESC LIMIT 1"); 
	                                                	
	                                                		if($pb->num_rows() > 0){
	                                                			$pBalance = $pb->row()->mbalance;
	                                                		}else{
	                                                			$pBalance = 0.00;
	                                                		}
	                                                		$totfees+=$pBalance;
	                                                	?>
	                                                	<input type="hidden" id="pb" name="pb" value="<?php echo $pBalance; ?>" class="form-control"/>
	                                                    <input type="text" id="pb1" name="pb1" value="<?php echo $pBalance; ?>" class="form-control" disabled="disabled"/>
	                                                </div>
	                                            </div>
	                                        </div>
	                                        	<?php $totfees=$totfees-$disc ;
	                                        	$totwlate =$totfees+$latefee1;
	                                        	if($stuid_details->discount_id>0){
	                                        	if($studdiscount->num_rows()>0){
	                                        		$discountRow = $studdiscount->row();
	                                        		if($discountRow->applied_head_id=="all"){
	                                        			$totfees=0;
	                                        			$totwlate=0;
	                                        		}
	                                        	}
	                                        	}
	                                        	?>
										
	                                        <div class="row space15">
	                                            <div class="col-sm-12">
	                                                <div class="col-sm-6 text-uppercase">Total</div>
	                                                <div class="col-sm-6">
	                                                 <?php   if($school_code==14){
	                                                     ?>
	                                                    
	                                                    <input type="hidden" id="total1"  value="<?php echo $totwlate;?>" name="total1" />
	                                                    <input type="hidden" value="<?php echo $totfees;?>" id="tempValue"/>
	                                                    <input type="text" id="total"  value="<?php echo $totwlate;?>" class="form-control" readonly/>
	                                                    <?php } else { ?>
	                                                     <input type="hidden" id="total1"  value="<?php echo $totwlate;?>" name="total1" />
	                                                    <input type="hidden" value="<?php echo $totfees;?>" id="tempValue"/>
	                                                    <input type="text" id="total"  value="<?php echo $totwlate;?>" class="form-control" readonly/>
	                                                    <?php } ?>
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div class="row space15">
	                                            <div class="col-sm-12">
	                                                <div class="col-sm-6 text-uppercase">Paid</div>
	                                                <div class="col-sm-6">
	                                                    <input type="number" id="paid" name="paid" class="form-control" required="required" />
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <div class="row space15">
	                                            <div class="col-sm-12">
	                                                <div class="col-sm-6 text-uppercase">Remaining Balance</div>
	                                                <div class="col-sm-6">
	                                                    <input type="hidden" id="cb1" name="cb" value="0.00" />
	                                                    <input type="text" id="cb" value="0.00" class="form-control" disabled="disabled"/>
	                                                </div>
	                                            </div>
	                                        </div>
	                                       
	                                    
	                                        <div class="row space15">
	                                            <div class="col-sm-12">
	                                                <div class="col-sm-6"></div>
	                                                <div class="col-sm-6">
	                                                    <button type="submit" class="btn btn-info btn-squared btn-lg text-uppercase">
	                                                        Save Fee <i class="fa fa-arrow-circle-right"></i>
	                                                    </button>
	                                                </div>
	                                            </div>
	                                        </div>
	                                
	                                        <div class="row space15">
	                                            <div class="col-sm-12"></div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            </td>
	                           </tr> 
							  </table>                      
	                                                <?php //$count=0;
	                                   //$count=$count+ $totfees;
	                 	
?>
	<script>
	$("#dtransport_fee1").change(function(){
	   
	    	var tran=Number($("#dtransport_fee1").val());
	   // 	alert(($("#dtransport_fee1").val()).length);
	      if(tran.toString().length>0){
	          
	    		var tot = Number($("#total1").val());
	    			//alert(tran + " "+ tot);
	    		var totfee= tran + tot;
	    		alert(totfee);
	    		$("#total1").val(totfee);
	    		$("#total").val(totfee);
	    }else{
	        var tot = Number($("#total1").val());
	    		
	    		alert(tot);
	    		$("#total1").val(tot);
	    		$("#total").val(tot);
	    }
	});
	$("#discountprint").hide();
	$("#discounterOTP").hide();
	
	
	$("#paid").keyup(function(){
		var c = Number($("#total").val()) - $("#paid").val();
		
		$("#cb").val(c);
		$("#cb1").val(c);
	});
	$("#discountv").keyup(function(){
		$("#discountprint").show();
	});
	
	$("#discounterID").keyup(function()
	{
		var discounterID = $("#discounterID").val();
		var discountv=$("#discountv").val();
		$.post("<?php echo site_url("index.php/teacherController/checkIDOTP") ?>",{discounterID : discounterID,discountv : discountv}, function(data){
			$("#rahul").html(data);
		});
		
	});
	$("#discounterOTPv").keyup(function(){
		
		var discounterIDv = $("#discounterOTPv").val();
		var discountv=$("#discountv").val();	
		var total1=$("#total1").val();	
	
		$.post("<?php echo site_url("index.php/teacherController/checkIDOTPc") ?>",{discounterIDv : discounterIDv}, function(data){
			
			var d = jQuery.parseJSON(data)
			if(d.sms == "yes")
		    {	
			    var  totg=Number(total1) - Number(d.dis);
				$("#total1").val(totg);
				$("#tempValue").val(totg);
				$("#total").val(totg);
			}
		});
	});
	
	function skip(id) {
		if(document.getElementById(id).checked) {
			//alert("checked => " + id)
			let skipFieldID = id.split("--")
			let fieldID = skipFieldID[1]
			let fieldValue = parseFloat($(`#${fieldID}`).val())
			let total = parseFloat($("#total").val())
			
			$(`#skipValue--${fieldID}`).val(fieldValue)
			$(`#${fieldID}`).val(0)
			$(`#d${fieldID}`).val(0)
			$("#total").val(total - fieldValue)
			$("#total1").val(total - fieldValue)
			$("#tempValue").val(total - fieldValue)
			$("#paid").val(parseFloat($("#paid").val()) - fieldValue)
			$("#sub_total1").val(parseFloat($("#sub_total1").val()) - fieldValue)
			$("#sub_total").val(parseFloat($("#sub_total").val()) - fieldValue)
			var c = Number($("#total1").val()) - $("#paid").val();
			
			$("#cb").val(c);
			$("#cb1").val(c);
		}
	else {
		// alert("unchecked => " + id)
		let skipFieldID = id.split("--")
		let fieldID = skipFieldID[1]
		let fieldValue = parseFloat($(`#skipValue--${fieldID}`).val())
		let total = parseFloat($("#total").val())
		
		$(`#skipValue--${fieldID}`).val(0)
		
		$(`#${fieldID}`).val(fieldValue)
		$(`#d${fieldID}`).val(fieldValue)
		$("#tempValue").val(total + fieldValue)
		$("#total").val(total + fieldValue)
		$("#total1").val(total + fieldValue)
		$("#paid").val(parseFloat($("#paid").val()) + fieldValue)
		$("#sub_total1").val(parseFloat($("#sub_total1").val()) + fieldValue)
		$("#sub_total").val(parseFloat($("#sub_total").val()) + fieldValue)
		var c = Number($("#total").val()) - $("#paid").val();
		
		$("#cb").val(c);
		$("#cb1").val(c);
	}
		
		
		
	}
	
	
		$("#latefee2").keyup(function(){
		    	let fieldValue = parseFloat($(`#latefee2`).val())
		    	if(fieldValue>0){
		    	    	let total=0;
		    total = parseFloat($("#tempValue").val())
		   // alert(total);
		$("#total").val(total + fieldValue)
		$("#total1").val(total + fieldValue)
		$("#paid").val(fieldValue + total)
		$("#sub_total1").val(fieldValue + total)
		$("#sub_total").val( fieldValue + total )
		    	}else{
		    	    	let total=0;
		    total = parseFloat($("#tempValue").val())
		    //alert(total);
		    fieldValue=0;
		$("#total").val(total + fieldValue)
		$("#total1").val(total + fieldValue)
	$("#paid").val(fieldValue + total)
		$("#sub_total1").val(fieldValue + total)
		$("#sub_total").val( fieldValue + total )
		    	}
	});
	
	</script>                   
	<?php 	}
}?>