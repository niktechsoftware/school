<?php
class feeModel extends CI_Model{
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
		$val = $this->db->get("fee_deposit");
		return $val;
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
		$query1 = $this->db->query("SELECT * FROM fee_deposit WHERE student_id='$data' AND school_code='$school_code' ORDER BY id DESC LIMIT 1");
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
	
	function checkFee($school_code,$class,$section,$fsd){
		$this->db->where("school_code",$school_code);
		$this->db->where("fsd",$fsd);
		$this->db->where("class_id",$class);
		$this->db->where("section",$section);
		$res = $this->db->get("class_fees");
		if($res->num_rows()>0)
		{
		return True;
	}
		else{
			return False;
		}
	}
}
