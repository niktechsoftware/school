<?php
class daybookModel extends CI_Model{
	
	public function fromStock($stream){
		$query = $this->db->insert("day_book", $stream);
		return $query;
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

}
