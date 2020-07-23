
<?php
class Configureclassmodel extends CI_Model{

	public function addStream($stream){
		$db = array(
			"stream" => $stream,
				"school_code"=>$this->session->userdata("school_code"),
		);
		if(strlen($stream) > 1){
			$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("stream",$stream);
			$checkold = $this->db->get("stream");
			if($checkold->num_rows()<1){
			$this->db->insert("stream",$db);
			}else{?>
				<script>alert("You Can't create Same Name Stream again");</script>
			<?php }
		}
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->get("stream");
		return $query;
	}
//----------------add fee category---------------------//
	public function addfeecategory($stream){
		$db = array(
			"cat_name" => $stream,
				"school_code"=>$this->session->userdata("school_code"),
		);
		if(strlen($stream) > 1){
			$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("cat_name",$stream);
			$checkold = $this->db->get("fee_cat");
			if($checkold->num_rows()<1){
			$insert=$this->db->insert("fee_cat",$db);
			}else{
				?>
				<script>alert("You Can't create Same Name Category again !!!");</script>
			<?php 
			}
		}
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->get("fee_cat");
		return $query;
	}

	
	function updatefeecat($data,$rowId){
//$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("id",$rowId);
			$result = $this->db->update("class_fees",$data);
			return true;
	}
	function updatecat($id,$name){
	
		         $data=array(
         'cat_name'=>$name,

						 );
						$this->db->where("school_code",$this->session->userdata('school_code'));
					$this->db->where("id",$id);
					$result = $this->db->update("fee_cat",$data);
					return $result;
			}
	//-------------------------------------//
	public function addfsd($startdate,$enddate){
		$db = array(
			"finance_start_date"=> $startdate,
			"finance_end_date"=>$enddate,
				"school_code"=>$this->session->userdata("school_code"),
		);
		if(strlen($startdate)&&strlen($enddate)> 1){
			$this->db->where("school_code",$this->session->userdata('school_code'));
			$this->db->where("finance_start_date",$startdate);
			$oldfsd = $this->db->get("fsd");
			if($oldfsd->num_rows()<1){
			$insert=$this->db->insert("fsd",$db);
			echo "FSD Created Successfully !!!";
			
			}else{
				echo "You Can't create two fsd Of Same Start Date";
			}
			
		  }
		  else
		  {
		  	echo "please fill all the field correct!then try again";
		  }
		  $this->db->where("school_code",$this->session->userdata("school_code"));
		  $ret = $this->db->get("fsd");
		  return $ret;
		 
	}
	
	public function updateStream($streamId,$streamName){
		$val = array(
				"stream" => $streamName,
				"school_code"=>$this->session->userdata("school_code"),
		);
		
		$this->db->where("id",$streamId);
		$query = $this->db->update("stream",$val);
		return true;
	}
	
	public function deleteStream($streamId){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		  $class=$this->db->get('class_info')->result();
		foreach ($class as $value)
		   {
		   	  if($value->stream==$streamId)
		   	  {
               
                echo "<script>alert('you can not delete this stream because this stream is already used in class');</script>";
                return false;


		   	  }
		   }
		   	  	$this->db->where("id",$streamId);
		    $query = $this->db->delete("stream");
		    return $query;

		   	 

		// $this->db->where("id",$streamId);
		// $query = $this->db->delete("stream");
		// return $query;
	}
	
	//---------------------------------------- Add Section code Start Here ------------------------------------
	
	public function addSection($section){
		$db = array(
				"section" => $section,
				"school_code"=>$this->session->userdata("school_code")
		);
		if(strlen($section) == 1){
			$this->db->where("school_code",$this->session->userdata('school_code'));
			$this->db->where("section",$section);
			$oldcheck = $this->db->get("class_section");
			if($oldcheck->num_rows<1){
			$this->db->insert("class_section",$db);
			}else{
				?>
				<script>alert("You Can't create Same Name Section again");</script>
				<?php 
			}
		}
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->get("class_section");
		return $query;
	}
	
	public function updateSection($sectionId,$sectionName){
		$val = array(
				"section" => $sectionName,
				"school_code"=>$this->session->userdata("school_code")
		);
		
		$this->db->where("id",$sectionId);
		$query = $this->db->update("class_section",$val);
		return $query;
	}
	
	
    	
	public function deleteSection($sectionId){
			$this->db->where("school_code",$this->session->userdata("school_code"));
		  $class=$this->db->get('class_info')->result();
		foreach ($class as $value)
		   {
		   	  if($value->section==$sectionId)
		   	  {
               
                echo "<script>alert('you can not delete this section because this section is already used in class');</script>";
               
                return false;
               

		   	  }
		   	 }

					$this->db->where("school_code",$this->session->userdata("school_code"));
					$this->db->where("id",$sectionId);
					$query = $this->db->delete("class_section");
					return $query;
					
	
	}
	
	//---------------------------------------- Add Class code Start Here ------------------------------------
	
	public function addClass($classdata){
		if((strlen($this->input->post("className")) > 0) && ($this->input->post("classStream") >0) && ($this->input->post("classSection")> 0)){
		
			
			$a=$this->db->insert("class_info",$classdata);
		
		}
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$query = $this->db->get("class_info")->result();
		
		return $query;
	}
	


public function getsectionforclass($sectionid)
	{
					$this->db->where("school_code",$this->session->userdata("school_code"));
				 	$this->db->where('id',$sectionid);
				 	$row1=$this->db->get('class_section')->row();
				 	return $row1;
	}
	public function getstreamforclass($streamid)
	{
					$this->db->where("school_code",$this->session->userdata("school_code"));
                  	$this->db->where('id',$streamid);
				 	$row2=$this->db->get('stream')->row();
				 	return $row2;
	}
	public function getStramforexam()
	{
			$school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT DISTINCT stream from class_info where school_code='$school_code' ORDER BY id");
		return $query;
	}


	
	public function updateClass($sectionId,$sectionName){
		$val = array(
				"section" => $sectionName
		);
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("id",$sectionId);
		$query = $this->db->update("class_section",$val);
		return $query;
	}
	
	public function deleteClass($sectionId){
		$this->db->where("school_code",$this->session->userdata("school_code"));
		$this->db->where("id",$sectionId);
		$query = $this->db->delete("class_section");
		return $query;
	}
	
	public function getStreamList(){
		$school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT DISTINCT stream from class_info where school_code='$school_code' ORDER BY id");
		return $query;
	}
	
	public function getSectionList(){
		$school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT Distinct section from class_info where school_code='$school_code' ORDER BY id");
		return $query;
	}
	
	public function getClassBySectionStream($streamid,$sectionid){
		$school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT * from class_info where school_code='$school_code' AND section= '$sectionid' AND stream ='$streamid'  ORDER BY id");
		return $query;
	}
	public function getClasslist(){
		$school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT * from class_info where school_code='$school_code' ORDER BY id");
		return $query;
	}

   public function getClasslistBystreamSection($streamid,$sectionid){
		$school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT * from class_info where school_code='$school_code' AND section= '$sectionid' AND stream ='$streamid'  ORDER BY id");
		return $query;
	}
		
	

	public function getStreamByClassName($className){
	    
		$school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT DISTINCT stream FROM class_info WHERE school_code='$school_code' AND class_id = '$className' ");
		return $query;
	}
	public function getSection($streamid){
	    
		$school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT DISTINCT section FROM class_info WHERE school_code='$school_code' AND stream = '$streamid'");
		
		return $query;
	}
	
	
	public function getSectionByClassStream($streamid){
		$school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT DISTINCT section FROM class_info WHERE school_code='$school_code' AND stream ='$streamid'");
		return $query;
	}
	
	//------------------------------------------------- Edit Class Detail -------------------------------
	
	function updateClassDetail($data,$rowId){
		// $teacherId = $this->input->post("teacherId");
		// if(strlen($teacherId) > 2){
		// 	$this->db->where("school_code",$this->session->userdata("school_code"));
		// 	$this->db->where("emp_no",$teacherId);
		// 	$result = $this->db->get("employee_info");
		// 	if($result->num_rows() > 0){
		// 		$this->db->where("school_code",$this->session->userdata("school_code"));
		// 		$this->db->where("id",$rowId);
		// 		$result = $this->db->update("class_info",$data);
		// 		return true;
		// 	}
		// 	else{
		// 		return false;
		// 	}
		// }
		// else{
			$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("id",$rowId);
			$result = $this->db->update("class_info",$data);
			return true;
		//}
	}
	
	function deleteClassDetail($rowId){
		// // $this->db->where("school_code",$this->session->userdata("school_code"));
		// // $this->db->where("status","Active");
		// // $this->db->where("class_id",$classId);
		// // $this->db->where("section",$section);
		// // $result = $this->db->get("student_info");
		// // if($result->num_rows() > 0){
		// // 	return false;
		// // }
		// else{
			$this->db->where("school_code",$this->session->userdata("school_code"));
			$this->db->where("id",$rowId);
			$this->db->delete("class_info");
			return true;
		//}
	}
	public function getClassName(){
		$school_code = $this->session->userdata("school_code");
		$query = $this->db->query("SELECT * from class_info where school_code='$school_code' ORDER BY id asc");
		return $query;
	}
	
}