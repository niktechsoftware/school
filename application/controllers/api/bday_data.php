<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Bday_data extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
    }
    

       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
	public function index_get($fsd)
	{
        if(!empty($fsd)){
            //$data = $this->db->get_where("employee_info", ['school_code' => $id])->result();
            
                    
                    $this->db->where("status",1);
                    $this->db->where("fsd",$fsd);
            $data_r = $this->db->get("student_info");
            // $data = $data_r;
            // // $data;
            if($data_r->num_rows()>0)
            {
                //  $data = $data_r;
                $dt = date('Y-m-d');
                $cd = date('d',strtotime($dt));
                $cm = date('m',strtotime($dt));
                foreach($data_r->result() as $s_data)
                {
                    // $data[] = $s_data->dob;
                    $sdob = $s_data->dob;
                    $sd = date('d',strtotime($sdob));
                    $sm = date('m',strtotime($sdob));
                    // $data[] = $cd."=".$sd."|".$cm."=".$sm."<br>";
                    // $data[] =$sm."hiii".$cm;
                    if(($cd==$sd) && ($cm==$sm))
                    {
                         $data = "khjkj";//$cd."=".$sd."|".$cm."=".$cm;
                        $this->db->where('id',$s_data->class_id);
                        $scl = $this->db->get('class_info')->row();
                        
                        $this->db->where('id',$scl->section);
                        $ss = $this->db->get('class_section')->row();
                        $data = array("stud_name" => $s_data->name,
                                    "class" => $scl->class_name,
                                    "section" => $ss->section);
                       
                                    print_r($data);exit;
                    }
                }
            }
        }else{
            $data= "data not found";
            // $data = $this->db->get("employee_info")->result();
        }
     
        $this->response($data, REST_Controller::HTTP_OK);
	}
      
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
   /* public function index_post()
    {
        $input = $this->input->post();
        $this->db->insert('items',$input);
     
        $this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
    } */
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
   /* public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('items', $input, array('id'=>$id));
     
        $this->response(['Item updated successfully.'], REST_Controller::HTTP_OK);
    }*/
     
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
   /* public function index_delete($id)
    {
        $this->db->delete('items', array('id'=>$id));
       
        $this->response(['Item deleted successfully.'], REST_Controller::HTTP_OK);
    }*/
    	
}