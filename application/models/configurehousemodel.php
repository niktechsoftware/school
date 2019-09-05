<?php
class Configurehousemodel extends CI_Model{
	function houseColumnLIst(){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->get("house");
		return $query;
	}
	
	function addHouse($stream){
		$db = array(
				"house_name" => $stream,
				"school_code"=>$this->session->userdata("school_code"),
		);
		if(strlen($stream) > 1){
			$this->db->insert("house",$db);
		}
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->get("house");
		return $query;
	}
	
	public function updateHouse($streamId,$streamName){
		$val = array(
				"house_name" => $streamName,
				"school_code"=>$this->session->userdata("school_code"),
		);
	
		$this->db->where("id",$streamId);
		$query = $this->db->update("house",$val);
		return true;
	}
	
	public function deleteHouse($streamId){
		$this->db->where("id",$streamId);
		//$this->db->where("school_code",$this->session->userdata("school_code"));
		$class=$this->db->get('student_info');
		if($class->num_rows()>0){
		
				 
				echo "<script>alert('you can not delete this stream because this stream is already used in class');</script>";
				return false;
	
	
			
		}else{
		$this->db->where("id",$streamId);
		$query = $this->db->delete("house");
		return $query;
		}
		
	
		 
	
		// $this->db->where("id",$streamId);
		// $query = $this->db->delete("stream");
		// return $query;
	}
	
}