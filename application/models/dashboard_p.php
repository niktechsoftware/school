<?php 
class Dashboard_p extends CI_Model
{
    public function emp_leave($sc_code)
    {     
        $date=date("Y-m-d");                               
        $this->db->distinct();
        $wh_value= array("a_date"=>$date, "school_code" => $sc_code, "attendance"=>'0');
        $this->db->where( $wh_value);

        return $this->db->get('teacher_attendance');
    }
}

?>