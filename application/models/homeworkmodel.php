
<?php
class homeWorkModel extends CI_Model{
	function submitHomeWork($data){
		$this->db->insert("homework",$data);
		return true;
	}
	function saveHomeWork($data){
		$this->db->insert("homework_name",$data);
		return true;
	}
	function getHomeWorkList(){
	   	$this->db->where("school_code",$this->session->userdata("school_code"));
		$var = $this->db->get("homework_name");
		return $var;
		
	}

	function getHomeWorkDetail(){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("class_id",$this->session->userdata("class_id"));
		$var = $this->db->get("homework_name");
		return $var;
	}
	function getHomeWorkDetailTeacher(){
		$school_code = $this->session->userdata("school_code");
		$var = $this->db->query("SELECT * FROM homework_name WHERE workfor ='teachers' And school_code='$school_code'");
		return $var;
	}
	function getHomeWorkDetailemp(){
		$school_code = $this->session->userdata("school_code");
		$var = $this->db->query("SELECT * FROM homework_name WHERE workfor ='employee' And school_code='$school_code'");
		return $var;
	}
	function getHomeWorkDetailStudent(){
		$school_code = $this->session->userdata("school_code");
		$var = $this->db->query("SELECT * FROM homework_name WHERE workfor ='students' AND school_code='$school_code'");
		return $var;
	}
	function today_getHomeWorkDetailStudent(){
		$school_code =  $this->session->userdata("school_code");
    	$date=Date("Y-m-d");
                    	$this->db->where("workfor",'students');
						$this->db->where("school_code",$school_code);
						$this->db->where("Date(givenWorkDate)",$date);
				$var =  $this->db->get('homework_name');
		return $var;
	}
	function updateHomeWork($data,$sno){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("s_no",$sno);
		$var = $this->db->update("homework",$data);
		return TRUE;
	}
	function getClassWise($classv){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("class1",$classv);
		$var = $this->db->get("homework");
		return $var;
	}
	function getSectionWise($classv,$section){
     //	$this->db->where("school_code",$this->session->userdata("school_code"));
	//	$this->db->where("class_id >",0);
	//	$this->db->where("workfor","students");
	//	$this->db->where("section",$section);
	//	$var = $this->db->get("homework_name");
	$school_code = $this->session->userdata("school_code");
		$var = $this->db->query("SELECT * FROM homework_name WHERE workfor ='students' And school_code='$school_code' And class_id='$section'");
		return $var;
	}
	

}