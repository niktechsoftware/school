<?php
   
require APPPATH . 'libraries/REST_Controller1.php';
     
class Common_user extends REST_Controller1 {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->model("client_model");
    }
    

       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    
	/*public function index_get($id = 0)
	{ 
	   $conn=mysqli_connect("208.91.198.93", "schoodhe_school", "Rahul!123singh!@");
        $db= mysqli_select_db($conn,"schoodhe_website");
	    $query1 = "select * from demo_user";
         if (mysqli_connect_errno()){
        $data['conn'] = "failed to connect to mysql:".mysqli_connect_error();
         }
        else{
        $data1= mysqli_query($conn,$query1);
        $data['resultu1']=mysqli_fetch_array($data1,MYSQLI_ASSOC);
        }
         //while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
           //  $data['resultu'] =$row;
         //}
        $this->response($data, REST_Controller1::HTTP_OK);
	}*/
      
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
   public function index_post($rtype)
    {
        
         $conn=mysqli_connect("208.91.198.93", "schoodhe_school", "Rahul!123singh!@");
        $db= mysqli_select_db($conn,"schoodhe_website");
         if (mysqli_connect_errno()){
        $data['conn'] = "failed to connect to mysql:".mysqli_connect_error();
         }
        else{
        if($rtype == "student"){
           //for student 
            $input = $this->client_model->get_stu_detail();
            $db = $this->client_model->get_db_detail();
            $username=$input[0]['username'];
            $id=$input[0]['id'];
            $db_name=$db;
            $type="student";
    	    $query1 = "INSERT INTO common_user (username, db_name, type) VALUES ('".$username."', '".$db_name."', '".$type."')";
            $data1= mysqli_query($conn,$query1);
            
            $data['resultu1']=mysqli_fetch_array($data1,MYSQLI_ASSOC);
       }else if($rtype == "admin"){
                //for admin 
            $input = $this->client_model->get_admin_detail();
            $db = $this->client_model->get_db_detail();
            $username=$input[0]['admin_username'];
            //$id=$input[0]['id'];
            $db_name=$db;
            $type="admin";
    	    $query1 = "INSERT INTO common_user (username, db_name, type) VALUES ('".$username."', '".$db_name."', '".$type."')";
            $data1= mysqli_query($conn,$query1);
            $data['resultu1']=mysqli_fetch_array($data1,MYSQLI_ASSOC);
       }else{
          //for employee    
           // $input = $this->input->post();
            $input = $this->client_model->get_emp_detail();
            $db = $this->client_model->get_db_detail();
            $username=$input[0]['username'];
            $db_name=$db;
            $type=$input[0]['job_category'];
            $query1 = "INSERT INTO common_user (username, db_name, type) VALUES ('".$username."', '".$db_name."', '".$type."')";
            $data1= mysqli_query($conn,$query1);
            $data['resultu1']=mysqli_fetch_array($data1,MYSQLI_ASSOC);   
            }
        
        }
       $this->response(['Item created successfully.'], REST_Controller1::HTTP_OK);
       if($rtype == "student"){
            //for student redirect
       redirect(base_url()."index.php/studentController/admissionSuccess/$id");
       }else if($rtype == "admin"){
           //for admin redirect
           redirect(base_url()."index.php/login/");
           }else{
               //for employee redirect
       redirect("index.php/employeeController/employeeProfile/$username"); 
           }
       
      
    } 
     
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