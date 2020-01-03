<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Get_fsd extends REST_Controller {
    
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
	public function index_get($s_code)
	{
        if(!empty($s_code)){
            //$data = $this->db->get_where("employee_info", ['school_code' => $id])->result();
            
                    
                    $this->db->where("school_code",$s_code);
            $data_r = $this->db->get("general_settings")->row();
            $data = $data_r->fsd_id;
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