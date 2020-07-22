<?php
class StockAjax extends CI_Controller{
	function editStock(){
		$billNo = $this->input->post("billNo");
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("bill_no",$billNo);
		$bill = $this->db->get("sale_info");

		if($bill->num_rows() > 0){

            $data['count'] =$bill->num_rows();
		     $data['billNo'] = $bill->result();

			$this->load->view("ajax/stockEditSale",$data);
		
		}
		else{
			echo "<font color='red'>Bill Number dose not matched...</font>";
		}
	}
}