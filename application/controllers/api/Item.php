<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Item extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
       // $db = mysqli_connect ("208.91.198.93", "schoodhe_school", "Rahul!123singh!@", "schoodhe_website");
       //$this->conn = $db;
    }
    

       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
	public function index_get($id)
	{
        if(!empty($id)){
            //$data = $this->db->get_where("employee_info", ['school_code' => $id])->result();
            
                    $this->db->where("status",1);
                    $this->db->where("school_code",$id);
            $data = $this->db->get("employee_info")->result();
        }else{
            $data = $this->db->get("employee_info")->result();
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