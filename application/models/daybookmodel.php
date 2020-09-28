<?php
class daybookModel extends CI_Model{
	
	public function fromStock($stream){
		$query = $this->db->insert("day_book", $stream);
		return $query;
	}
	
	function getDayTranByDate($school_code,$cdate,$head,$contition){
		if($contition==0){
			$res = $this->db->query("SELECT sum(day_book.amount) as totamount FROM day_book join invoice_serial on invoice_serial.invoice_no = day_book.invoice_no WHERE invoice_serial.school_code='$school_code' and heads = '$head' AND dabit_cradit = 0 and DATE(day_book.pay_date)='".$cdate."'");
	 		return $res->row()->totamount;
		}
		if($contition==1){
			$res = $this->db->query("SELECT sum(day_book.amount) as totamount FROM day_book join invoice_serial on invoice_serial.invoice_no = day_book.invoice_no WHERE invoice_serial.school_code='$school_code' and heads = '$head' AND dabit_cradit = 1 and DATE(day_book.pay_date)='".$cdate."'");
			return $res->row()->totamount;
		}
		if($contition==2){
			$resd = $this->db->query("SELECT sum(day_book.amount) as totamount FROM day_book join invoice_serial on invoice_serial.invoice_no = day_book.invoice_no WHERE invoice_serial.school_code='$school_code' and heads = '$head' AND dabit_cradit = 0 and DATE(day_book.pay_date)='".$cdate."'");
			$resdc = $this->db->query("SELECT sum(day_book.amount) as totamount FROM day_book join invoice_serial on invoice_serial.invoice_no = day_book.invoice_no WHERE invoice_serial.school_code='$school_code' and heads = '$head' AND dabit_cradit = 1 and DATE(day_book.pay_date)='".$cdate."'");
			$res =$resdc->row()->totamount-$resd->row()->totamount;
			return $res;
		}
	}
	
	function getInvoiceByDate($school_code,$sdate,$edate,$head,$contition,$status){
		if($contition==0){
			$res = $this->db->query("SELECT invoice_serial.invoice_no, invoice_serial.heads  FROM day_book join invoice_serial on invoice_serial.invoice_no = day_book.invoice_no WHERE day_book.status=1 and invoice_serial.school_code='$school_code' and heads = '$head' AND dabit_cradit = 0 and DATE(day_book.pay_date)>='".$sdate."' and DATE(day_book.pay_date)<='".$edate."'");
			return $res;
		}
		if($contition==1){
			$res = $this->db->query("SELECT invoice_serial.invoice_no, invoice_serial.heads FROM day_book join invoice_serial on invoice_serial.invoice_no = day_book.invoice_no WHERE day_book.status=1 and invoice_serial.school_code='$school_code' and heads = '$head' AND dabit_cradit = 1 and DATE(day_book.pay_date)>='".$sdate."' and DATE(day_book.pay_date)<='".$edate."'");
			return $res;
		}
		if($contition==2){
			$resd = $this->db->query("SELECT invoice_serial.invoice_no, invoice_serial.heads FROM day_book join invoice_serial on invoice_serial.invoice_no = day_book.invoice_no WHERE day_book.status=1 and invoice_serial.school_code='$school_code'  AND (dabit_cradit = 0 or dabit_cradit = 1 )and DATE(day_book.pay_date)>='".$sdate."' and DATE(day_book.pay_date)<='".$edate."'");
			$res =$resd;
			return $res;
		}
	}
	
	function expenditureAmount($date,$school_code){
	$gettot=	$this->db->query("select sum(amount) as exptot from day_book where school_code='$school_code' and DATE(pay_date)='$date' ");
	return $gettot->row()->exptot;
	}
	
	function getExpenditureList($school_code){
		$this->db->where("school_code",$school_code);
		$explist = $this->db->get("expenditure");
		return $explist;
	}
	
	function datewiseCollecttion($date,$school_code){
		$this->db->select_sum("paid");
		$this->db->where('school_code',$school_code);
		$this->db->where('DATE(diposit_date)',$date);
		$stocktotal=$this->db->get('fee_deposit')->row();
		if($stocktotal->paid){
			$resulttotal['feeTotal'] =$stocktotal->paid;
		}
		else{
			$resulttotal['feeTotal']=0;
		}
		
		$this->db->select_sum("sub_total");
		$this->db->where('school_code',$school_code);
		$this->db->where('DATE(date)',$date);
		//	 $this->db->where('dabit_cradit',1);
		$stocktotal=$this->db->get('sale_info')->row();
		if($stocktotal->sub_total){
			$resulttotal['stockTotal']= $stocktotal->sub_total;
		}
		else{
			$resulttotal['stockTotal']=0;
		}
		
		$this->db->select_sum('amount');
		$this->db->where('school_code',$school_code);
		$this->db->where('date(pay_date)',$date);
		$this->db->where('dabit_cradit',0);
		$debit_amount=$this->db->get('day_book')->row();
		if($debit_amount->amount){
			$resulttotal['dabitTotal']=$debit_amount->amount;
		}else{
			$resulttotal['dabitTotal']=0;
		}
		
		
		$this->db->select_sum('amount');
		$this->db->where('school_code',$school_code);
		$this->db->where('date(pay_date)',$date);
		$this->db->where_not_in('dabit_cradit',0);
		// $this->db->or_where('dabit_cradit',2);
		$credit_amount=$this->db->get('day_book')->row();
		if($credit_amount->amount){
			$resulttotal['creditTotal']=$credit_amount->amount;
		}else{
			$resulttotal['creditTotal']=0;
		}
		
		return $resulttotal;
	}
	public function fromStock1($daybook1,$billno){
	    $this->db->where('invoice_no',$billno);
	    $this->db->where('reason',"From sale Stock");
		$query = $this->db->update("day_book", $daybook1);
		return $query;
	}
	function cash_pay($stream){
		$query = $this->db->insert("cash_payment", $stream);
		return $query;
	}
	
	function fulldetail($expenditure_name,$date1,$date2){
		$school_code = $this->session->userdata("school_code");
		$a = $this->db->query("select * from cash_payment where school_code ='$school_code' AND expenditure_name = '$expenditure_name' AND date >= '$date1' AND date <= '$date2'");
		return $a;	
	}
	function createxpe($exp){
		$school_code= $this->session->userdata("school_code");
		$data=array(
			'expenditure_name'=>$exp,
		//	'school_code'=>$school_code
		);
		if(strlen($exp)>1){
			$this->db->insert('expenditure',$data);
		}
		$school_code= $this->session->userdata("school_code");
		//	$this->db->where("school_code",$school_code);
			$query = $this->db->get("expenditure");
			return $query;
	}
		public function createxpee(){
			$school_code= $this->session->userdata("school_code");
		//	$this->db->where("school_code",$school_code);
			$query = $this->db->get("expenditure");
			return $query;
		}
		function updatexpee($expID,$expName){
			$val = array(
				"expenditure_name" => $expName,
				//"school_code"=>$this->session->userdata("school_code"),
		);
		$this->db->where("sno",$expID);
		$query = $this->db->update("expenditure",$val);
		return true;
		}
		function creatSubexpe($expsub,$subexpid){
			$school_code= $this->session->userdata("school_code");
			$data=array(
				'exp_depart'=>$expsub,
				//'school_code'=>$school_code
			);
			if($subexpid>0){
			//	$this->db->where("school_code",$school_code);
				$this->db->where("sno",$subexpid);
				$this->db->update('expenditure',$data);
			}
				$query = $this->db->get("expenditure");
				return $query;
		}
		public function creatsubexpee(){
			$school_code= $this->session->userdata("school_code");
		//	$this->db->where("school_code",$school_code);
			$query = $this->db->get("expenditure");
			return $query;
		}
		function updatSubexpee($expID,$expName,$expNameSub){
			$val = array(
				"exp_depart" => $expName,
				//"school_code"=>$this->session->userdata("school_code"),
		);
		$this->db->where("sno",$expID);
		$this->db->where("expenditure_name",$expName);
		$query = $this->db->update("expenditure",$val);
		return true;
		}
		
		function getClosingBalance($cdate){
			$school_code = $this->session->userdata("school_code");
			$datec = $cdate;
			$totCredit =	$this->db->query("select sum(amount) as totc from day_book where school_code='$school_code' and (dabit_cradit = 1 or dabit_cradit = 2) and DATE(pay_date) <= '$datec'")->row();
			$totDebit =	$this->db->query("select sum(amount) as totd from day_book where school_code='$school_code' and dabit_cradit = 0 and DATE(pay_date) <= '$datec'")->row();
			$actBalance = $totCredit->totc - $totDebit->totd;
			return $actBalance;
		}
		function getClosingBalanceForDaybook($cdate,$id){
			$school_code = $this->session->userdata("school_code");
			$datec = $cdate;
			$totCredit =	$this->db->query("select sum(amount) as totc from day_book where school_code='$school_code' and (dabit_cradit = 1 or dabit_cradit = 2) and DATE(pay_date) <= '$datec' and id <='$id'")->row();
			$totDebit =	$this->db->query("select sum(amount) as totd from day_book where school_code='$school_code' and dabit_cradit = 0 and DATE(pay_date) <= '$datec' and id <='$id'")->row();
			$actBalance = $totCredit->totc - $totDebit->totd;
			return $actBalance;
		}

}
