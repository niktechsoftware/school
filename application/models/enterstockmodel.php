<?php
class enterStockModel extends CI_Model{
	
function checkStock($itemNo){
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->order_by('sno');
	$this->db->where("item_no",$itemNo);
	$req = $this->db->get("enter_stock");
	return $req;
}

function enterStock($stockData){
	// $query1 = $this->db->insert("enter_stock",$stockData);
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("item_no",$stockData['item_no']);
	$query = $this->db->get("enter_stock");
	if($query->num_rows() > 0){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("item_no",$stockData['item_no']);
		$query = $this->db->update("enter_stock",$stockData);
		return true;
	}else{
		$query2 = $this->db->insert("enter_stock", $stockData);
		return true;
	}
}

function updateStock($stockData){
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("item_no",$itemNo);
	$query = $this->db->update("enter_stock", $stockData);
	return $query;
}
function getStock(){
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$query = $this->db->get("enter_stock");
	return $query;
}

function getItemName($itemNo){
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("item_no",$itemNo);
	$req = $this->db->get("enter_stock");
	return $req;
}

function saleEntry($data)
{     // $this->db->where("bill_no",$billno);
	$query2 = $this->db->insert("sale_info", $data);
	return $query2;
}
function updatesaleEntry($data,$billno)
{      $this->db->where("bill_no",$billno);
	$query2 = $this->db->update("sale_info", $data);
	return true;
}
	
function getItemName1($data){
	$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("item_no",$data['item_no']);
		$req = $this->db->get("enter_stock");
		return $req;
}
function updateStock1($stockData,$itemno){
	$this->db->where("school_code",$this->session->userdata("school_code"));
	$this->db->where("item_no",$itemno);
	$query = $this->db->update("enter_stock", $stockData);
	return true;
}

function updatebill($data2){
	$query2 = $this->db->insert("sale_info", $data2);
	return true;
}

}