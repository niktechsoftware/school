<?php
class dayBookControllers extends CI_Controller
{
    	public function __construct(){
		parent::__construct();
			$this->is_login();
			$this->load->model("daybookmodel");
	
	}
		function is_login(){
		$is_login = $this->session->userdata('is_login');
	
		if(($is_login != true)){
			
			redirect("index.php/homeController/index");
		}
	
	}
	function getExamList()
	{
	$fsd=$this->input->post("fsd");
	//echo $fsd;
	$exam = $this->db->query("select * from exam_name where fsd ='$fsd'");
		if($exam->num_rows()>0):
							foreach ($exam->result() as $row):?>
                            <option value="<?php echo $row->id;?>">
                            <?php echo $row->exam_name."[".date('d-m-y',strtotime($row->exam_date))."]";?></option>
                            <?php endforeach;  endif;
	
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
		if($this->session->userdata("school_code")){
	    $school_code = $this->session->userdata("school_code");
		$di = $this->uri->segment(3);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("receipt_no",$di);
		$this->db->delete("cash_payment");
		
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("invoice_no",$di);
		$drowd = $this->db->delete("day_book");
		$date1 = $this->uri->segment(4);
		$date2 = $this->uri->segment(5);
		$exname = $this->uri->segment(6);
		redirect("index.php/dayBookControllers/fullDetail/$exname/$date1/$date2");
	}else{
		echo "<h2>Please Login Again!!!!!</h2>";
	}
	}
function daybook()
	{
	    $b=0;
		$school_code = $this->session->userdata("school_code");
		$condition  = $this->input->post("value1");
		$dt1        = $this->input->post("st_date");
		$dt2        = $this->input->post("end_date");
		$q          = $this->input->post("check_list");
	

		/* if($q==1){
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
		} */
	//echo "t";
	if(($q==1)|| ($q==2)||($q==3)||($q==4)||($q==5)||($q==6)||($q==7) ||($q==9) ||($q==10)){
		
		if(($q==1)){
			$reason = "by salary";
			$heads=8;
			$condition=0;
		}
	        if(($q==2)){
	             $reason = "by salary";
	             $heads=10;
	             $condition=0;
		 }
	          if(($q==4)){
	          
	              $reason = "Diposti to Director";
	             $heads=7;
	             $condition=0;
	          }
	        if(($q==3)){
	            $reason="Diposit To Bank";
	            $heads=6;
	            $condition=0;
	                 }
	       
	         if(($q==9)){
	              $reason="Recieve From Director";
	              $heads=7;
	              $condition=1;
	                }
	         if(($q==5)){
	               $reason="Fee Deposit";
	               $heads=5;
	               $condition=1;
	                }
	         if(($q==6)){
	              $reason="From sale Stock";
	              $heads=3;
	              $condition=1;
	                 }
	        if(($q==7)){
	             $reason="Receive From Bank";
	             $heads=6;
	             $condition=1;
	                 }
	                 
	          if(($q==10)){
	                 	$reason="Receive From Bank";
	                 	$heads=20;
	                 	$condition=2;
	                 	$status =1;
	                 }        
	          
	      $a= $this->daybookmodel->getInvoiceByDate($school_code,$dt1,$dt2,$heads,$condition,1);
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
		
		/* if($q==10){
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
		} */
		
	}
	
	
	function checkBalance(){
	    $school_code = $this->session->userdata("school_code");
		$scholer_no = $this->input->post('q1');

		$cdate =date("Y-m-d");
		$backDate = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $cdate) ) ));
		$openingBalance=$this->daybookmodel->getClosingBalance($backDate);
		$closingBalance = $this->daybookmodel->getClosingBalance($cdate);
		$balance=$closingBalance;
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

		$cdate =date("Y-m-d");
		$backDate = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $cdate) ) ));
		$openingBalance=$this->daybookmodel->getClosingBalance($backDate);
		$closingBalance = $this->daybookmodel->getClosingBalance($cdate);
		$balance=$closingBalance;
		
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

	$cdate =date("Y-m-d");
		$backDate = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $cdate) ) ));
		$openingBalance=$this->daybookmodel->getClosingBalance($backDate);
		$closingBalance = $this->daybookmodel->getClosingBalance($cdate);
		$balance=$closingBalance;
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
        $depart=$this->input->post('expenditurer');
		$id_name = $this->input->post('id_name');
		$emp_id = $this->input->post('emp_id');
		$name = $this->input->post('name');
		$phone_no = $this->input->post('phone_no');
		$reason = $this->input->post('reason');
		$amount = $this->input->post('amount');
		$date = date('Y-m-d');
		// Calculat and update Invoice serial start
		
		$this->db->where("school_code",$school_code);
		$invoice = $this->db->get("invoice_serial");
		$invoice1=6000+$invoice->num_rows();
		$invoice_number = $school_code."I19".$invoice1;
		$num1=$invoice_number;
		$invoice = array(
				"invoice_no" =>$num1,
				"heads" => $this->input->post("heads"),
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
		
		$cdate =date("Y-m-d");
		$backDate = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $cdate) ) ));
		$openingBalance=$this->daybookmodel->getClosingBalance($backDate);
		$closingBalance = $this->daybookmodel->getClosingBalance($cdate);
		$balance=$closingBalance;
		
		if($balance < $amount)
		{
			redirect("login/cashPayment/cash/balanceFalse/9");
		}
		else
		{	
			
			$cashPayment = array(
					"exp_id"=>$expenditure,
					"sub_exp_id"=>$depart,
					"id_name" =>$id_name,
					"valid_id" =>$emp_id,
					"name" => $name,
					"phone_no" => $phone_no,
					"reason" => $reason,
					"receipt_no" => $num1,
					
			);
			
			$dayBook = array(
					"paid_to" =>$nm,
					"paid_by" =>$this->session->userdata("username"),
					"dabit_cradit" => 0,
					"amount" => $amount,
					"pay_date" => date('Y-m-d'),
					"pay_mode" => "Cash",
					"invoice_no"=>$num1,
					"status"=>1,
					"school_code"=>$this->session->userdata("school_code")
			);
			
			if($this->db->insert('cash_payment',$cashPayment) && $this->db->insert('day_book',$dayBook)):
			//code for sms
			$sender1 = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
			$sende_Detail = $sender1->row();
			$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
			$master_id=$max_id->maxid+1;
			$this->db->where("id",$this->session->userdata("school_code"));
		    $mobile=$this->db->get("school")->row();
			$msg ="Dear Sir/Ma'am ".$nm.", Cash Amount Rs " . $amount . "/- expend by Admin for expenditure " . $expenditure . " from your Account.";
			 sms($mobile->mobile_no,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
			 $getv=mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$mobile->mobile_no);
				//echo $getv;
				if($getv){
			 $this->smsmodel->sentmasterRecord($msg,2,$master_id,$getv);
				}
			 // end code for sms
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

function deleteBanTrans(){
	$invoiceid = $this->input->post("invoice_id");
	$this->db->where("invoice_no",$invoiceid);
	$getrow = $this->db->get("day_book");
	if($getrow->num_rows()>0){
		$rowt = $getrow->row();
	$this->db->where("invoice_no",$invoiceid);
	$getrow = $this->db->delete("day_book");
	$this->db->where("receipt_no",$invoiceid);
	$this->db->delete("bank_transaction");
	$this->db->where("receipt_no",$invoiceid);
	$this->db->delete("director_transaction");
	
	echo "Deleted Success";
}

	
	function expenditure_depart(){
		$expenditure_id = $this->input->post("expenditure_id");
		$this->db->where("exp_id",$expenditure_id);
		$rt = $this->db->get("sub_expenditure");

		?> 
		<option value="0">-Department-</option>
		<?php 
		if($rt->num_rows()>0){
			foreach($rt->result() as $row):
			?>  <option value="<?php echo $row->id;?>"><?php echo $row->sub_expenditure_name;?> </option>
			 <?php  endforeach;}
	}
	
	function directorTransaction(){
		$this->load->model("smsmodel");
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
				"heads" => $this->input->post("heads"),
				"invoice_date" => date('Y-m-d'),
				"school_code"=>$this->session->userdata("school_code")
		);
		$this->db->insert("invoice_serial",$invoice);

       $cdate =date("Y-m-d");
       $closingBalance = $this->daybookmodel->getClosingBalance($cdate);
       $balance= $closingBalance ;
		if($action_transaction == 0):

			if($balance < $amount){
				redirect("login/cashPayment/director/balanceFalse");
			}else{
			$dabitCredit = 0;	
			}


			else:
			$dabitCredit = 1;
			endif;
				$cashPayment = array(
						"name" =>$name,
						"reason"=>"Handover to Director ".$disc,
						"receipt_no" => $num1,
				);
				$dayBook = array(
						"paid_to" =>$name,
						"paid_by" =>$this->session->userdata("username"),

						"dabit_cradit" => $dabitCredit,

						"amount" => $amount,
						"pay_date" => date('Y-m-d'),
						"invoice_no" => $num1, 
						"pay_mode" => 1,
						"status"=>1,
						"school_code"=>$this->session->userdata("school_code")
				);
			//code for sms
			if($dabitCredit==0){
				$tran = "Debited";
			}else{
				$tran = "credited";
			}
				$max_id = $this->db->query("SELECT MAX(id) as maxid FROM sent_sms_master")->row();
				$master_id=$max_id->maxid+1;
				$sender1 = $this->smsmodel->getsmssender($this->session->userdata("school_code"));
				$sende_Detail = $sender1->row();
				$this->db->where("id",$this->session->userdata("school_code"));
				$mobile=$this->db->get("school")->row();
				$msg = "School Account is ".$tran.", Cash Amount Rs " . $amount . "/- By Director Name ".$name.".";
				sms($mobile->mobile_no,$msg,$sende_Detail->uname,$sende_Detail->password,$sende_Detail->sender_id);
				$getv=mysms($sende_Detail->auth_key,$msg,$sende_Detail->sender_id,$mobile->mobile_no);
				$this->smsmodel->sentmasterRecord($msg,2,$master_id,$getv);
				// end code for sms
					
			if($this->db->insert('cash_payment',$cashPayment) && $this->db->insert('day_book',$dayBook)):
			redirect("dayBookControllers/invoiceCashPayment/$num1");
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
	
		$this->load->model('daybookmodel');
		if($subexpid>0){
			//id sub me hai
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