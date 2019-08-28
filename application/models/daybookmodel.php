<?php
class daybookModel extends CI_Model{
	
	public function fromStock($stream){
		$query = $this->db->insert("day_book", $stream);
		return $query;
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

}
