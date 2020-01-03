<?php
require APPPATH . 'libraries/REST_Controller.php';

class Staffdata extends REST_Controller {
    
    function __construct(){
        parent :: __construct();
        $this->load->database();
    }
    
    function index_get($school){
        
        if(!empty($school)){
              $data = $this->db->get_where("employee_info", ['school_code' => $school])->result();
        }else{
            $data = $this->db->get("employee_info")->result();
        }
        $this->response($data, REST_Controller::HTTP_OK);
        
    }
    
}


?>