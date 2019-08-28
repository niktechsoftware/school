<?php
class searchController extends CI_Controller{
	public function searchStudent(){
	$keyword = '%'.$this->input->post("keyword").'%';
		$sql = "SELECT * FROM student_info WHERE  school_code='$school_code' AND (name LIKE '$keyword' OR student_id LIKE '$keyword') ORDER BY name ASC LIMIT 0, 10";
		$query = $this->db->query($sql);
		foreach ($query->result() as $rs) {
			// put in bold the written text
			//$country_name = str_replace($this->input->post("keyword"), '<b>'.$this->input->post("keyword").'</b>', $rs->p_name);
			// add new option
		    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs->id." - ".$rs->name).'\')"><a href="#javascript();">'.$rs->id." - ".$rs->name.'</a></li>';
		}
	}
}