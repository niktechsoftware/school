<?php
class AllFormModel extends CI_Model{

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
      $this->db->where('fsd',$fsdid);
     $result=$this->db->get('class_fees');
    
      if($result->num_rows()>0)
        {
    
        }
         else 
         {

             $this->db->where('fsd',$this->session->userdata("fsd"));
            $result21=$this->db->get('class_fees');
             if($result21->num_rows()>0)
        {
            foreach($result21->result() as $value):
        $data=array(
            'fsd' =>$fsdid, 
            'class_id'=>$value->class_id,
            'taken_month'=>$value->taken_month,
            'fee_head_name'=>$value->fee_head_name,
            'fee_head_amount'=>$value->fee_head_amount,
            'update_date'=>date('d-m-y'),
         );
         $insert=$this->db->insert('class_fees',$data);
            endforeach;
    
        }
            }
        
    

$this->db->WHERE('school_code', $this->session->userdata("school_code"));
$result=$this->db->update('general_settings',$fsdid1);
return $result;
}





function getPin($state,$city,$area){
//$school_code = $this->session->userdata("school_code");
$result = $this->db->query("select DISTINCT pin FROM city_state WHERE city = '$city' AND state = '$state' AND area = '$area'  ORDER BY area LIMIT 1");
return $result;
}

function getSectionforAttendence(){
$school_code = $this->session->userdata("school_code");
$result = $this->db->query("select * FROM class_section WHERE school_code='$school_code'");
return $result;
}

function getSection(){
$school_code = $this->session->userdata("school_code");
$result = $this->db->query("select DISTINCT * FROM class_info WHERE school_code='$school_code'");

return $result;
}
function getsectionfeereport(){
$school_code = $this->session->userdata("school_code");
$result = $this->db->query("select distinct section FROM class_info WHERE school_code='$school_code'");
return $result;
}

function getclass(){
    $school_code = $this->session->userdata("school_code");
    $result = $this->db->query("select * FROM class_info WHERE school_code='$school_code'");
    return $result;
}


function getEmployeeID(){
$school_code = $this->session->userdata("school_code");
$result = $this->db->query("select username FROM employee_info WHERE school_code='$school_code' ORDER BY username DESC LIMIT 1");
foreach($result->result() as $row):
$id = $row->username;
endforeach;
return $id;
}

function getSectionByClass($className){
$school_code = $this->session->userdata("school_code");
$result = $this->db->query("select section FROM class_info WHERE school_code='$school_code' AND class_name = '$className'");
return $result;
}

function getTransportFee(){
$school_code = $this->session->userdata("school_code");
$result = $this->db->query("select distinct section FROM class_info WHERE school_code='$school_code'");
return $result;
}
}