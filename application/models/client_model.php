<?php 
class Client_model extends CI_Model {

	var $API ="";
	function __construct() {
		parent::__construct();
			$this->load->library('restclient');
		$this->API="https://niktechsoftware.com/AdminPanel";
	}

	function list_product($cid){
		return json_decode($this->restclient->get1($cid));
	}
	function get_emp_detail(){
	    $query = $this->db->query("SELECT * FROM employee_info ORDER BY id DESC LIMIT 1");
        $result = $query->result_array();
		return $result;
	}

/*	function product($id){
		$params = array('customer_id'=>  $id);
		return json_decode($this->restclient->get($params),true);
	}

	function save($array)
	{
		$this->restclient->post($array);
	}

	function update($array)
	{
		$this->restclient->put($array);
	}

	function delete($id)
	{
		$this->restclient->delete($id);
	}*/
}
?>