<?php
class dayBookControllers extends CI_Controller
{
    	public function __construct(){
		parent::__construct();
			$this->is_login();
	
	}
	
	
		function is_login(){
		$is_login = $this->session->userdata('is_login');
	
		if(($is_login != true)){
			
			redirect("index.php/homeController/index");
		}
	
	}
	
	function fullDetail(){
		$expenditure_name = $this->uri->segment(3);
		 	$date1 = $this->uri->segment(4);
		 	$date2 = $this->uri->segment(5);
		 	
		 	$this->load->model("daybookModel");
		 	$da=$this->daybookModel->fulldetail($expenditure_name,$date1,$date2);
		 	$data['request']=$da->result();
		 	$data['pageTitle'] = 'Expenditure Report';
		 	$data['smallTitle'] = 'Expenditure Report';
		 	$data['mainPage'] = 'Expenditure';
		 	$data['subPage'] = 'Expenditure Report';
		 	$data['title'] = 'Expenditure Report';
		 	$data['headerCss'] = 'headerCss/feeCss';
		 	$data['footerJs'] = 'footerJs/feeJs';
		 	$data['mainContent'] = 'daybookcashper';
		 	$this->load->view("includes/mainContent", $data);
		 
	}
	
	function deleteCashPay(){
	    $school_code = $this->session->userdata("school_code");
		$di = $this->uri->segment(3);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("receipt_no",$di);
		$this->db->delete("cash_payment");
		
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("invoice_no",$di);
		$drowd = $this->db->get("day_book")->row();
		$op1 = $this->db->query("select closing_balance from opening_closing_balance where opening_date='".date('Y-m-d')."' AND school_code='$school_code'")->row();
		$balance = $op1->closing_balance;
		$close1 = $balance + $drowd->amount;
		$bal = array(
				"closing_balance" => $close1
		);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("opening_date",date('Y-m-d'));
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->update("opening_closing_balance",$bal);
		$dayBook = array(
				"paid_to" =>"Return",
				"paid_by" =>$this->session->userdata("username"),
				"reason" => "Wrong by Admin",
				"dabit_cradit" => 1,
				"amount" => $drowd->amount,
				"closing_balance" => $close1,
				"pay_date" => date('Y-m-d'),
				"pay_mode" => "wrong Cash by Admin",
				"school_code"=>$this->session->userdata("school_code")
		);
		$this->db->insert("day_book",$dayBook);
		
		$date1 = $this->uri->segment(4);
		$date2 = $this->uri->segment(5);
		$exname = $this->uri->segment(6);
		redirect("index.php/dayBookControllers/fullDetail/$exname/$date1/$date2");
	}
function daybook()
	{
	    $b=0;
		$school_code = $this->session->userdata("school_code");
		$condition  = $this->input->post("value1");
		$dt1        = $this->input->post("st_date");
		$dt2        = $this->input->post("end_date");
		$q          = $this->input->post("check_list");
	
	echo $q;
		if($q==1){
			$a = $this->db->query("select DISTINCT expenditure_name from cash_payment where date >= '$dt1' AND date <= '$dt2' AND school_code='$school_code'");
			
			$b = $a->num_rows();
			
			$dabit = 0;
			$cradit = 0;
			if($b > 0){
			    //	echo "rahul";
				$data['dt1']=$dt1;
				$data['dt2']=$dt2;
				$data['pageTitle'] = 'Day Book Report';
				$data['smallTitle'] = 'Day Book Report';
				$data['mainPage'] = 'Configuration';
				$data['subPage'] = 'Class, Section, Subject Stream';
				$data['condition'] = $condition;
				
				$this->load->model("configureClassModel");
				$result = $this->configureClassModel->getClassList();
				$data['classList'] = $result->result();
				$data['title'] = 'Configure Class/Section';
				$data['headerCss'] = 'headerCss/daybookCss';
				$data['footerJs'] = 'footerJs/daybookJs';
				$data['mainContent'] = 'dayBookcash';
				$data['a']=$a;
				$data['b']=$b;
				$data['dabit']=0;
				$data['cradit']=0;
				
				$this->load->view("includes/mainContent", $data);
			}
			else{
			    redirect("index.php/login/dayBook/9");
			}
		}
	
	if(($q==2)||($q==3)||($q==4)||($q==5)||($q==6)||($q==7)||($q==8) ||($q==9)){
	        if(($q==2)){
	             $reason = "by salary";
		 }
	          if(($q==4)){
	              $reason = "Diposti to Director";
	          }
	        if(($q==3)){
	            $reason="Diposit To Bank";
	                 }
	         if(($q==2)){
	             $reason="By Salary";
	                   }
	         if(($q==9)){
	              $reason="Recieve From Director";
	                }
	         if(($q==5)){
	               $reason="Fee Deposit";
	                }
	         if(($q==6)){
	              $reason="From sale Stock";
	                 }
	        if(($q==7)){
	             $reason="Receive From Bank";
	                 }
	        if(($q==8)){
	              $reason="Admission Fee + 1 Month Fee";
	              }
	       echo $reason;
	        $a = $this->db->query("select * from day_book where Date(pay_date) >= '$dt1' AND Date(pay_date) <= '$dt2' AND school_code='$school_code' AND reason='$reason'");
			$b = $a->num_rows();
			

			$dabit = 0;
			$cradit = 0;
			if($b > 0){
			    //	echo "rahul";
				$data['dt1']=$dt1;
				$data['dt2']=$dt2;
				$data['pageTitle'] = 'Day Book Report';
				$data['smallTitle'] = 'Day Book Report';
				$data['mainPage'] = 'Configuration';
				$data['subPage'] = 'Class, Section, Subject Stream';
				$data['condition'] = $condition;
				
				$this->load->model("configureClassModel");
				$result = $this->configureClassModel->getClassList();
				$data['classList'] = $result->result();
				$data['title'] = 'Configure Class/Section';
				$data['headerCss'] = 'headerCss/daybookCss';
				$data['footerJs'] = 'footerJs/daybookJs';
				$data['mainContent'] = 'dayBook5';
				$data['a']=$a;
				$data['b']=$b;
				$data['dabit']=0;
				$data['cradit']=0;
				
				$this->load->view("includes/mainContent", $data);
			}
			else{
			    redirect("index.php/login/dayBook/9");
			}
		}
		
		if($q==10){
			$school_code = $this->session->userdata("school_code");
			$a = mysqli_query($this->db->conn_id,"select * from day_book where Date(pay_date) >= '$dt1' AND Date(pay_date) <= '$dt2' AND school_code='$school_code'");
			$b = mysqli_num_rows($a);
			$dabit = 0;
			$cradit =0;
			if($b > 0){
				$data['dt1']=$dt1;
				$data['dt2']=$dt2;
				$data['pageTitle'] = 'Day Book Report';
				$data['smallTitle'] = 'Day Book Report';
				$data['mainPage'] = 'Configuration';
				$data['subPage'] = 'Class, Section, Subject Stream';
				$data['condition'] = $condition;
				$data['title'] = 'Configure Class/Section';
				$data['headerCss'] = 'headerCss/daybookCss';
				$data['footerJs'] = 'footerJs/daybookJs';
				$data['mainContent'] = 'dayBook2';
				$data['a']=$a;
				$data['b']=$b;
				$data['dabit']=0;
				$data['cradit']=0;
				$this->load->view("includes/mainContent", $data);
			}
			else
				redirect("index.php/login/dayBook/9");
		}
		
	}
	
	
	function checkBalance(){
	    $school_code = $this->session->userdata("school_code");
		$scholer_no = $this->input->post('q1');

		$balance1 = $this->db->query("select closing_balance from opening_closing_balance where DATE(opening_date) = '".date('Y-m-d')."' AND school_code='$school_code'")->row();
		// 	$this->db->where("DATE(opening_date)","2019-03-11");
		// 	$this->db->where("school_code",1);
		//	$balance1 =$this->db->get("opening_closing_balance")->row();
		$balance = $balance1->closing_balance;
		if($balance < $scholer_no){
			echo '<font color="#FF0000">There is not enough avilable. Avl bal : Rs.'.$balance.'/-</font>';
		}
		else{
			echo '<font color="#006600">Avilable bal : Rs.'.$balance.'/-</font>';
		}
	}
	function checkBalance1(){
	    $school_code = $this->session->userdata("school_code");
		$scholer_no = $this->input->post('q1');

		$balance1 = $this->db->query("select closing_balance from opening_closing_balance where DATE(opening_date) = '".date('Y-m-d')."' AND school_code='$school_code'")->row();
		// 	$this->db->where("DATE(opening_date)","2019-03-11");
		// 	$this->db->where("school_code",1);
		//	$balance1 =$this->db->get("opening_closing_balance")->row();
		$balance = $balance1->closing_balance;
		if($balance < $scholer_no){
			echo '<font color="#FF0000">There is not enough avilable. Avl bal : Rs.'.$balance.'/-</font>';
		}
		else{
			echo '<font color="#006600">Avilable bal : Rs.'.$balance.'/-</font>';
		}
	}
	function checkBalance3(){
	    $school_code = $this->session->userdata("school_code");
		$scholer_no = $this->input->post('q1');

		$balance1 = $this->db->query("select closing_balance from opening_closing_balance where DATE(opening_date) = '".date('Y-m-d')."' AND school_code='$school_code'")->row();
		// 	$this->db->where("DATE(opening_date)","2019-03-11");
		// 	$this->db->where("school_code",1);
		//	$balance1 =$this->db->get("opening_closing_balance")->row();
		$balance = $balance1->closing_balance;
		if($balance < $scholer_no){
			echo '<font color="#FF0000">There is not enough avilable. Avl bal : Rs.'.$balance.'/-</font>';
		}
		else{
			echo '<font color="#006600">Avilable bal : Rs.'.$balance.'/-</font>';
		}
	}
	function empValidId(){
		$school_code = $this->session->userdata("school_code");
		$stu_id = $this->input->post('q1');
		$streem1 = $this->db->query("select * from employee_info where username='$stu_id' AND school_code='$school_code' ");
		$no = $streem1->num_rows();
		if($no > 0){ 
			$streem = $streem1->row(); ?>
			<table>
		    	<tr>
		        	<td><font color="#006600"><?php echo $streem->name; ?></font></td>
		        </tr>
		    </table>
		<?php 
		}
		else{
		?><font color="#FF0000">Wrong Employee Id</font><?php
		}
	}
	
	function cashPaymentDb(){
	    $this->load->model("smsmodel");
		$this->load->helper("sms");
	    $school_code =  $this->session->userdata("school_code");
        $paydate=$this->input->post('paydate');
        $expenditure=$this->input->post('expenditure');
        $expenditurer=$this->input->post('expenditurer');
		$id_name = $this->input->post('id_name');
		$emp_id = $this->input->post('emp_id');
		$name = $this->input->post('name');
		$phone_no = $this->input->post('phone_no');
		$reason = $this->input->post('reason');
		$amount = $this->input->post('amount');
		$date = date('Y-m-d');
		
		// Calculat and update Invoice serial start
		$school_code=	$this->session->userdata("school_code");
		$this->db->where("school_code",$school_code);
		$invoice = $this->db->get("invoice_serial");
		$invoice1=6000+$invoice->num_rows();
		$invoice_number = $school_code."I19".$invoice1;
		$num1=$invoice_number;
		$invoice = array(
				"invoice_no" =>$num1,
				"reason" => "Cash Payment handover",
				"invoice_date" => $paydate,
				"school_code"=>$school_code
		);
		$this->db->insert("invoice_serial",$invoice);
		// Calculat and update Invoice serial end
		
		if($id_name == 'other'):
			$nm = $name;
		else:
			$nm = $emp_id;
		endif;
		
		$op1 = $this->db->query("select closing_balance from opening_closing_balance where opening_date='".date('Y-m-d')."' AND school_code='$school_code'")->row();
		$balance = $op1->closing_balance;
		
		if($balance < $amount)
		{
			redirect("login/cashPayment/cash/balanceFalse/9");
		}
		else
		{	
			$close1 = $balance - $amount;
			$bal = array(
				"closing_balance" => $close1
			);
			$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("opening_date",date('Y-m-d'));
			$this->db->update("opening_closing_balance",$bal);
			
			$cashPayment = array(
					"expenditure_name"=>$expenditure,
					"exp_depart"=>$expenditurer,
					"id_name" =>$id_name,
					"valid_id" =>$emp_id,
					"name" => $name,
					"phone_no" => $phone_no,
					"reason" => $reason,
					"amount" => $amount,
					"date" => $paydate,
					"receipt_no" => $num1,
					"school_code"=>$this->session->userdata("school_code")
			);
			
			$dayBook = array(
					"paid_to" =>$nm,
					"paid_by" =>$this->session->userdata("username"),
					"reason" => $reason,
					"dabit_cradit" => "Debit",
					"amount" => $amount,
					"closing_balance" => $close1,
					"pay_date" => date('Y-m-d'),
					"pay_mode" => "Cash",
					"invoice_no"=>$num1,
					"school_code"=>$this->session->userdata("school_code")
			);
			
			if($this->db->insert('cash_payment',$cashPayment) && $this->db->insert('day_book',$dayBook)):
			    
	     	$sender1 = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
			$sende_Detail = $sender1->row();
			$this->db->where("id",$this->session->userdata("school_code"));
		    $mobile=$this->db->get("school")->row();
			$msg = "Dear Sir/Ma'am ".$nm.", Cash Amount Rs " . $amount . "/- expend by Admin for expenditure " . $expenditure . " from your Account.";
			if($school_code==8){
		//	sms($mobile->mobile_no,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			}else{
			    sms($mobile->mobile_no,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			}
			if($mobile->id==1){
				$msg = "Dear Sir/Ma'am ".$nm.", Cash Amount Rs " . $amount . "/- expend by Admin for expenditure " . $expenditure . " from your Account.";
			
				  sms(7398863503,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);  
				
			}
				redirect("dayBookControllers/invoiceCashPayment/$num1");
			else:
				redirect("login/cashPayment/cash/balanceFalse");
			endif;
		}
	}
	
	function invoiceCashPayment(){
		$data['pageTitle'] = 'Account Management';
		$data['smallTitle'] = 'Cash Payment';
		$data['mainPage'] = 'Cash Payment';
		$data['subPage'] = 'Cash Invoice';
		
		$data['title'] = 'Accounts Cash Payment';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/transactionJs';
		$data['mainContent'] = 'invoiceCashPayment';
		$this->load->view("includes/mainContent", $data);
	}
	function deletecashinvoice(){
		$invoice_number= $this->uri->segment(3);
   
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("receipt_no",$invoice_number);
	 $feemonth= $this->db->get("cash_payment");
		if($feemonth->num_rows()>0){
			$amount= $feemonth->row()->amount;
		 
			$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("opening_date",date("y-m-d"));
			$closing=$this->db->get("opening_closing_balance");
	 
			$close=$closing->row()->closing_balance;
			$bal=$close + $amount;
			$clos_arr=array(
				 "closing_balance"=>$bal
			);
			$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("opening_date",date("y-m-d"));
			$this->db->update("opening_closing_balance",$clos_arr);
	 
			$this->db->where("invoice_no",$invoice_number);
			$this->db->where("school_code",$this->session->userdata("school_code"));
		 $dfee= $this->db->delete("day_book");
	 
			$this->db->where("receipt_no",$invoice_number);
			$this->db->where("school_code",$this->session->userdata("school_code"));
		 $tfee= $this->db->delete("cash_payment");
    if($tfee && $dfee){
redirect("login/cashPaymentreort");
		}

	}
}
	function bankTransactionDb(){
		$id_name = $this->input->post('id_name');
		$bank_name = $this->input->post('bank_name');
		$account_no = $this->input->post('account_no');
	$school_code=	$this->session->userdata("school_code");
		$amount = $this->input->post('amount');
		$chequeTran_no = $this->input->post('chequeTranNum');
		$remark = $this->input->post('remark');
		$date = date('Y-m-d');
		$this->db->where("school_code",$school_code);
		$invoice = $this->db->get("invoice_serial");
		$invoice1=6000+$invoice->num_rows();
		$invoice_number = $school_code."I19".$invoice1;
		$num1=	$invoice_number;
		$invoice = array(
				"invoice_no" =>$num1,
				"reason" => "Bank Transaction",
				"invoice_date" => date('Y-m-d'),
				"school_code"=>$this->session->userdata("school_code")
		);
		$this->db->insert("invoice_serial",$invoice);
		
		
		$op1 = $this->db->query("select closing_balance from opening_closing_balance where opening_date='".date('Y-m-d')."' AND school_code='$school_code'")->row();
		$balance = $op1->closing_balance;
		
		if($id_name == 'deposite')
		{
			
			if($balance < $amount){
				redirect("login/cashPayment/bank/balanceFalse");
			}
			else{
				$close1 = $balance - $amount;
				$bal = array(
					"closing_balance" => $close1
				);
				$this->db->where("school_code",$this->session->userdata("school_code"));
				$this->db->where("opening_date",date('Y-m-d'));
				$this->db->update("opening_closing_balance",$bal);
				
				$cashPayment = array(
					"id_name" =>$id_name,
					"bank_name" =>$bank_name,
					"account_no" => $account_no,
					"amount" => $amount,
					"date" => date('Y-m-d'),
					"receipt_no" => $num1,
					"chequeTran_no"=>$chequeTran_no,
					"remark"=>$remark,
						"school_code"=>$this->session->userdata("school_code")
				);
				
				$dayBook = array(
						"paid_to" =>$id_name,
						"paid_by" =>$this->session->userdata("username"),
						"reason" => "Diposit To Bank",
						"dabit_cradit" => "Debit",
						"amount" => $amount,
						"closing_balance" => $close1,
						"pay_date" => date('Y-m-d'),
						"invoice_no" => $num1,
						"pay_mode" => "Cash",
						"school_code"=>$this->session->userdata("school_code")
				);
				
				if($this->db->insert('bank_transaction',$cashPayment) && $this->db->insert('day_book',$dayBook)):
					redirect("index.php/login/cashPayment/bank/bankTrue");
				else:
					redirect("index.php/login/cashPayment/bank/bankFalse");
				endif;
			}
		}
		elseif($id_name == 'receive'){
			$close1 = $balance + $amount;
				$bal = array(
					"closing_balance" => $close1
						
				);
				$this->db->where("school_code",$this->session->userdata("school_code"));
				$this->db->where("opening_date",date('Y-m-d'));
				$this->db->update("opening_closing_balance",$bal);
				
				$cashPayment = array(
					"id_name" =>$id_name,
					"bank_name" =>$bank_name,
					"account_no" => $account_no,
					"amount" => $amount,
					"date" => date('Y-m-d'),
					"receipt_no" => $num1,
					"chequeTran_no"=>$chequeTran_no,
					"remark"=>$remark,
						"school_code"=>$this->session->userdata("school_code")
				);
				
				$dayBook = array(
						"paid_to" =>$id_name,
						"paid_by" =>$this->session->userdata("username"),
						"reason" => "Receive From Bank",
						"dabit_cradit" => "Credit",
						"amount" => $amount,
						"closing_balance" => $close1,
						"pay_date" => date('Y-m-d'),
						"invoice_no" => $num1,
						"pay_mode" => "Cash",
						"school_code"=>$this->session->userdata("school_code")
				);
				
				if($this->db->insert('bank_transaction',$cashPayment) && $this->db->insert('day_book',$dayBook)):
					redirect("index.php/login/cashPayment/bankTrue");
				else:
					redirect("index.php/login/cashPayment/bankFalse");
				endif;
		}
	}
	function expenditure_depart(){
		$expenditure_name = $this->input->post("expenditure_name");
		
		$this->db->where("expenditure_name",$expenditure_name);
		$rt = $this->db->get("expenditure");
		?> 
		
		<option value="">-Department-</option>
		<?php 
		if($rt->num_rows()>0){
			foreach($rt->result() as $row):
			?>  <option value="<?php echo $row->exp_depart;?>"><?php echo $row->exp_depart;?> </option>
			 <?php  endforeach;}
			
		
	}
	function directorTransaction(){
		$action_transaction = $this->input->post('action_transaction');
		$amount = $this->input->post('amount');
		$name = $this->input->post('name');
		$disc = $this->input->post('disc');
		$date = date('Y-m-d');
			$school_code=	$this->session->userdata("school_code");
		$this->db->where("school_code",$school_code);
		$invoice = $this->db->get("invoice_serial");
		$invoice1=6000+$invoice->num_rows();
		$invoice_number = $school_code."I19".$invoice1;
		$num1=$invoice_number;
		$invoice = array(
				"invoice_no" =>$num1,
				"reason" => "Director Transaction",
				"invoice_date" => date('Y-m-d'),
				"school_code"=>$this->session->userdata("school_code")
		);
		$this->db->insert("invoice_serial",$invoice);
       $school_code=$this->session->userdata("school_code");
		
		$op1 = $this->db->query("select closing_balance from opening_closing_balance where  opening_date='".date('Y-m-d')."' AND school_code='$school_code'")->row();
		$balance = $op1->closing_balance;
		
				
		
		
			if($action_transaction == 'Diposited'):
			if($balance < $amount){
				redirect("login/cashPayment/director/balanceFalse");
			}
				$close1 = $balance - $amount;
				$cashPayment = array(
						"transaction_mode" =>"Cash Diposit",
						"action" =>$action_transaction,
						"applicant_name" => $name,
						"amount" => $amount,
						"reason"=>$disc,
						"date" => date('Y-m-d'),
						"receipt_no" => $num1,
						"school_code"=>$this->session->userdata("school_code")
				);
				$dayBook = array(
						"paid_to" =>$name,
						"paid_by" =>$this->session->userdata("username"),
						"reason" => "Diposti to Director",
						"dabit_cradit" => "Debit",
						"amount" => $amount,
						"closing_balance" => $close1,
						"pay_date" => date('Y-m-d'),
						"invoice_no" => $num1, 
						"pay_mode" => "Cash",
						"school_code"=>$this->session->userdata("school_code")
				);
			else:
				$close1 = $balance + $amount;
				$cashPayment = array(
						"transaction_mode" =>"Cash Recieve",
						"action" =>$action_transaction,
						"applicant_name" => $name,
						"amount" => $amount,
						"reason"=>$disc,
						"date" => date('Y-m-d'),
						"receipt_no" => $num1,
						"school_code"=>$this->session->userdata("school_code")
				);
				$dayBook = array(
						"paid_to" =>$name,
						"paid_by" =>$this->session->userdata("username"),
						"reason" => "Recieve From Director",
						"dabit_cradit" => "Credit",
						"amount" => $amount,
						"closing_balance" => $close1,
						"pay_date" => date('Y-m-d'),
						"invoice_no" => $num1,
						"pay_mode" => "Cash",
						"school_code"=>$this->session->userdata("school_code")
				);
			endif;
			$bal = array(
					"closing_balance" => $close1
			);
			$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("opening_date",date('Y-m-d'));
			$this->db->update("opening_closing_balance",$bal);
	
					
			if($this->db->insert('director_transaction',$cashPayment) && $this->db->insert('day_book',$dayBook)):
			redirect("index.php/login/cashPayment/director/directorTrue");
			else:
			redirect("index.php/login/cashPayment/director/directorFalse");
			endif;
		
	}
	
	function transactionDetail(){		
		$seg3 = $this->uri->segment(3);
		$seg4 = $this->uri->segment(4);
		
		$data['pageTitle'] = 'Transaction Detail';
		if(($seg3 == "bank") && ($seg4 == "deposit")):
			$data['smallTitle'] = 'Bank Deposit';
			$data['mainPage'] = 'Bank Transation';
			$data['subPage'] = 'Bank Deposit Detail';
			$data['title'] = 'Transaction Detail';
		elseif(($seg3 == "bank") && ($seg4 == "withdrwal")):
			$data['smallTitle'] = 'Bank Withdrwal';
			$data['mainPage'] = 'Bank Transation';
			$data['subPage'] = 'Bank Withdrwal Detail';
			$data['title'] = 'Transaction Detail';
		elseif(($seg3 == "director") && ($seg4 == "deposit")):
			$data['smallTitle'] = 'Withdrwal from Director';
			$data['mainPage'] = 'Withdrwal from Director';
			$data['subPage'] = 'Withdrwal from Director Detail';
			$data['title'] = 'Transaction Detail';
		elseif(($seg3 == "director") && ($seg4 == "withdrwal")):
			$data['smallTitle'] = 'Received from Director';
			$data['mainPage'] = 'Received from Director';
			$data['subPage'] = 'Received from Director Detail';
			$data['title'] = 'Transaction Detail';
		endif;
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/daybookJs';
		$data['mainContent'] = 'transactionDetail';
		$this->load->view("includes/mainContent", $data);
	}
	function createxpe(){
		$exp= $this->input->post('expenditure');
		//print_r($exp);
		$this->load->model('daybookmodel');
		if($exp){
			$explist = $this->daybookmodel->createxpe($exp);
	}else{
		$explist = $this->daybookmodel->createxpee();
	}
		$data['explist'] = $explist;
		$this->load->view("ajax/createxpee",$data);
	}
		
	function updateExp(){
		$expID= $this->input->post('expId');
		$expName= $this->input->post('expName');
		$this->load->model('daybookmodel');
		if($query = $this->daybookmodel->updatexpee($expID,$expName)){ ?>
			<script>
			        $.post("<?php echo base_url('index.php/login/newexpenditure') ?>", function(data){
			            $("#expenditure2").html(data);
					});
			</script>
	<?php	//	$explist = $this->daybookmodel->updatexpee($expID,$expName);
		}

	}
	function creatsubexp(){
		$subexpid= $this->input->post('subexp');
		$expsub= $this->input->post('expsub');
	//	print_r($subexpid);
	//	print_r($expsub);
		$this->load->model('daybookmodel');
		if($subexpid){
			$explist = $this->daybookmodel->creatSubexpe($expsub,$subexpid);
	}else{
		$explist = $this->daybookmodel->creatsubexpee();
	}
		$data['explist'] = $explist;
		$this->load->view("ajax/subExpenceType",$data);
	}
	function updateSubExp(){
		$expID= $this->input->post('expId');
		$expName= $this->input->post('expName');
		$expNameSub= $this->input->post('expNameSub');
		$this->load->model('daybookmodel');
		if($query = $this->daybookmodel->updatSubexpee($expID,$expName,$expNameSub)){ ?>
			<script>
			        $.post("<?php echo base_url('index.php/login/newexpenditure') ?>", function(data){
			            $("#expen").html(data);
					});
			</script>
	<?php	//	$explist = $this->daybookmodel->updatexpee($expID,$expName);
		}

	}
	function deleteExpen(){
		$school_code =$this->session->userdata("school_code");
		$data['expid'] = $this->uri->segment(3);
		$data['pageTitle'] = 'Expenditure Delete';
		$data['smallTitle'] = ' Expenditure';
		$data['mainPage'] = ' Expenditure';
		$data['subPage'] = ' Expenditure';
		$data['title'] = ' Expenditure';
		$data['headerCss'] = 'headerCss/configureClassCss';
		$data['footerJs'] = 'footerJs/transactionJs';
		$data['mainContent'] = 'deleteexpenditure';
		$this->load->view("includes/mainContent", $data);
	}
	function deleteexpotp(){
		    $otp=$this->input->post('otp');
              $mobile=$this->input->post('mobile');
             $this->db->where('school_code',$this->session->userdata('school_code'));
             $this->db->where('mobile_number',$mobile);
             $this->db->where('exam_otp',$otp);
             $row=$this->db->get('common_otp');
             if($row->num_rows()>0) {   
             foreach ($row->result() as  $value) {
             if($value->exam_otp==$otp){
                    ?><br><br>
                     <div class="alert alert-success">
                                <button data-dismiss="alert" class="close">
                                    &times;
                                </button>
                                <?php 
                                       echo "Match Otp!Click On Delete Button to Delete the Expenditure ";?>
                                </div>
                <script>
                  $("#conform").show();
                 </script><?php
                     return true;
                 }
             }
         }
                 else
                 {   ?>
                       <div class="alert alert-danger">
                          <button data-dismiss="alert" class="close"> &times;</button><?php 
                           echo "OTP NOT MATCH";?>
                            </div>
             <script>
                  $("#conform").hide();
                   $("#admin").show();
                  $("#student_id").show();
             </script><?php
             return false;
            }
	}
	public  function Suceesotpdeleteexpby()

          {
               $expid=$this->input->post('exp_id');
               $this->db->where('sno',$expid);
               $this->db->where('school_code',$this->session->userdata('school_code'));
               $delexamname=$this->db->delete('expenditure');
                if($delexamname)   {
                	 ?><br><br>
                     <div class="alert alert-success">
                                <button data-dismiss="alert" class="close">
                                    &times;
                                </button>
                                <?php 
                                       echo "Your Expenditure Detail Successfully Deleted";?>
                              <a href="<?php echo base_url();?>index.php/login/newexpenditure" class="btn btn-red">
                                       <i class="fa fa-arrow-circle-right"></i>Go For Add new Expenditure  </a>
                                </div>
                      <?php
                }
                else
                {
                 ?>    <div class="alert alert-danger">
                                <button data-dismiss="alert" class="close">
                                    &times;
                                </button><?php 
                                       echo "Somthing Wrong!please try after some time";?>
                        </div><?php 
                }  
    }
    function checkIDforadmin(){
			   $mobile = $this->input->post("admin_id");
			    $examid = $this->input->post("exp_id");
			    $this->load->helper('string');
			    $this->load->model("smsmodel");
			   $this->db->where('id',$this->session->userdata('school_code'));
		       $this->db->where('mobile_no',$mobile);
		       $school_name=$this->db->get('school');                 
			  if($school_name->num_rows()>0){
				$mobilenumber=$school_name->row();
				?>
				<div class="alert alert-success">
					<button data-dismiss="alert" class="close">
						&times;</button>
						ADMIN FOUND ! <strong><?php echo $mobilenumber->school_name."". " !OTP SEND ON YOUR MOBILE NUMBER"; ?></strong>
						<?php	$sender = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
				           if($sender->num_rows()>0){
					       $sende_Detail =$sender->row();
					       $otp = rand(1000,99999);
					        $msg="Your Exam Delete OTP is ".$otp." .please share this to delete exam.";
					         sms($mobilenumber->mobile_no,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
							    $data2 = array(
	                             'exam_otp' => $otp,
	                             'exam_id' => $examid,
	                              'mobile_number'=>$mobilenumber->mobile_no,
	                              'date'=>date('Y-m-d H:i:s',time()),
	                              'school_code'=>$this->session->userdata('school_code'),
	                                );
	                             $insert = $this->db->insert('common_otp', $data2);
	                            ?>
							</div>
							<script>
						  <?php if($insert){?>
							$("#b1").show();
							$("#newpassword").show();
						    <?php }?>
							</script>
							<?php 
						}}
					else{
						?>
					<div class="alert alert-danger">
						<button data-dismiss="alert" class="close">
							&times;
						</button>
						Sorry :( <strong><?php echo "Admin Mobile Number Not Found ! Wrong Mobile Number"; ?></strong>
					</div>
					<script>
						$("#b1").hide();
						$("#newpassword").hide();
						</script>
				<?php	}
		
			}
    
}

