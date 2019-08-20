<?php class feeduemodel extends CI_Model{
	function __construct()
	{
		parent::__construct();
		$school_code = $this->session->userdata("school_code");
	}
	public function getDueDetail(){
		$school_code=$this->session->userdata("school_code");
		$query1 = $this->db->query("select * from feedue where school_code = '$school_code'");
		return $query1;
	}
	
	public function enterDetail($data,$studid){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("student_id",$studid);
		$var=$this->db->get("feedue");
		if($var->num_rows() > 0)
		{
			$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("student_id",$studid);
		$this->db->update("feedue",$data);
		}
		else{
		$var = $this->db->insert("feedue",$data);
		}
		//$this->db->insert("feedue2",$data);
		return $var;
	}
	
	public function checkStock($studentId){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("student_id",$studentId);
		$var=$this->db->get("feedue");
		return $var;
	
	}
	public function checkStock2($studentId){
		//$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("id",$studentId);
		$var1=$this->db->get("student_info");
		return $var1;
		
	}
	
}