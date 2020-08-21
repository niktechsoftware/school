<?php
class AllFormModel extends CI_Model{
	
	function getfsdWisestudent_id($fsd){
	    if($fsd!=$this->session->userdata("fsd"))
            {
            $this->db->where('fsd',$fsd);
            $data=$this->db->get('old_student_info');
            }else{
            $this->db->select("id as student_id");
            $this->db->where('fsd',$fsd);
            $data=$this->db->get('student_info');
            }
            return $data;
	}
	//get fsd Details
	function getfsddetails($fsdid){
		$this->db->where("id",$fsdid);
		$data = $this->db->get("fsd");
		return $data;
	}
	//end 
            // function for fsdwise record 
        function getfsdwiseStudent($fsd){
            
              if($fsd== $this->session->userdata("fsd")){
                $student= $this->db->query("select DISTINCT(student_info.id) from student_info  where status =1 and fsd ='$fsd' " );
                return 	$student;
           }else{
                $student=	$this->db->query("select DISTINCT(old_student_info.student_id) as id from old_student_info  where fsd ='$fsd' ");
                return 	$student;
                //print_r($student);
           }
           
          		
        }
            // end function for fsdwise record 
            
             // function for fsdwise record 
        function getfsdwiseStudentClassData($fsd,$class_id){
           if($fsd== $this->session->userdata("fsd")){
                $student= $this->db->query("select DISTINCT(student_info.id) from student_info  where status =1 and fsd ='$fsd' and student_info.class_id ='$class_id'" );
                return 	$student;
           }else{
                $student=	$this->db->query("select DISTINCT(old_student_info.student_id) as id from old_student_info  where fsd ='$fsd' and class_id ='$class_id'");
                return 	$student;
                //print_r($student);
           }
           // select student_info.id from student_info join old_student_info where ( ((student_info.fsd =20) and (student_info.class_id =134) and (student_info.status =1)) or ((old_student_info.fsd=20) and (old_student_info.class_id =134) and (student_info.status =1)))
           		
        }
            // end function for fsdwise record 
            
            
            //start function for single student record 
         function getStu_record_fsdSingleid($stu_id){
             $stur = $this->db->query("select * from student_info join guardian_info on student_info.id = guardian_info.student_id where student_info.id='$stu_id'"); 
             return $stur;
         }
         //end single student record
         function getCurrentFsd($school_code){
         	$this->db->where('school_code',$school_code);
         	$fsd = $this->db->get ( 'fsd' );
         	return $fsd;
         }
         
         function getClassInfotoFsd($fsd){
         	$this->db->order_by("class_id","ASC");
         	$this->db->where ('fsd', $fsd );
         	$data = $this->db->get ( 'class_fees' );
         	return $data;
         }
         
         //get class name, section name and stream  and whole row from class_id
         function classDetailsbyId($class_id){
                    $this->db->where("id",$class_id);
                  $classname =   $this->db->get("class_info");
                  if($classname->num_rows()>0){
                  $classinfo['class']=$classname->row()->class_name;
                  $this->db->where("id",$classname->row()->section);
                  $section = $this->db->get("class_section")->row();
                  $classinfo['section']=$section->section;
                   $this->db->where("id",$classname->row()->stream);
                  $stream = $this->db->get("stream")->row();
                  $classinfo['stream']=$stream->stream;
             	return  $classinfo;  
                  }else{
                     $classinfo['class']=0;
                     $classinfo['section']=0;
                     $classinfo['stream']=0;
                  }
         }
         // end 
function getState(){
//$school_code = $this->session->userdata("school_code");
$result = $this->db->query("select DISTINCT state FROM city_state ORDER BY state");
return $result;
}

function getCity($state){
//$school_code = $this->session->userdata("school_code");
$result = $this->db->query("select DISTINCT city FROM city_state WHERE state = '$state' ORDER BY city");
return $result;
}

function getArea($state,$city){
//$school_code = $this->session->userdata("school_code");
$result = $this->db->query("select DISTINCT area FROM city_state WHERE city = '$city' AND state = '$state'  ORDER BY area");
return $result;
}

function updatefsd($fsdid){
    	$fsdid1=array(
     		'fsd_id' =>$fsdid, 
         );
      		
            $this->db->where('fsd',$this->session->userdata("fsd"));
            $result21=$this->db->get('class_fees');
            if($result21->num_rows()>0)
        	{
            	foreach($result21->result() as $value):
            	$this->db->where('fsd',$fsdid);
            	$this->db->where('class_id',$value->class_id);
            	$result=$this->db->get('class_fees');
            	if($result->num_rows()<1){
        		$data=array(
            		'fsd' =>$fsdid, 
            		'class_id'=>$value->class_id,
            		'taken_month'=>$value->taken_month,
            		'fee_head_name'=>$value->fee_head_name,
            		'fee_head_amount'=>$value->fee_head_amount,
            		'update_date'=>date('d-m-y'),
         		);
         			$insert=$this->db->insert('class_fees',$data);
            	}
            endforeach;
        }
		$this->db->WHERE('school_code', $this->session->userdata("school_code"));
		$result=$this->db->update('general_settings',$fsdid1);
		return $result;
	}





	function getPin($state, $city, $area) {
		// $school_code = $this->session->userdata("school_code");
		$result = $this->db->query ( "select DISTINCT pin FROM city_state WHERE city = '$city' AND state = '$state' AND area = '$area'  ORDER BY area LIMIT 1" );
		return $result;
	}
	function getSectionforAttendence() {
		$school_code = $this->session->userdata ( "school_code" );
		$result = $this->db->query ( "select * FROM class_section WHERE school_code='$school_code'" );
		return $result;
	}
	function getSection() {
		$school_code = $this->session->userdata ( "school_code" );
		$result = $this->db->query ( "select DISTINCT * FROM class_info WHERE school_code='$school_code'" );
		
		return $result;
	}
	function getsectionfeereport() {
		$school_code = $this->session->userdata ( "school_code" );
		$result = $this->db->query ( "select distinct section FROM class_info WHERE school_code='$school_code'" );
		return $result;
	}
	function getclass() {
		$school_code = $this->session->userdata ( "school_code" );
		$result = $this->db->query ( "select * FROM class_info WHERE school_code='$school_code'" );
		return $result;
	}
	function getEmployeeID() {
		$school_code = $this->session->userdata ( "school_code" );
		$result = $this->db->query ( "select username FROM employee_info WHERE school_code='$school_code' ORDER BY username DESC LIMIT 1" );
		foreach ( $result->result () as $row ) :
			$id = $row->username;
		endforeach
		;
		return $id;
	}
	function getSectionByClass($className) {
		$school_code = $this->session->userdata ( "school_code" );
		$result = $this->db->query ( "select section FROM class_info WHERE school_code='$school_code' AND class_name = '$className'" );
		return $result;
	}
	function getTransportFee() {
		$school_code = $this->session->userdata ( "school_code" );
		$result = $this->db->query ( "select distinct section FROM class_info WHERE school_code='$school_code'" );
		return $result;
	}
}