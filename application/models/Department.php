<?php
class Department extends CI_Model {
	function getDepartment(){
		$this->db->select('*');
		$this->db->from('department');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			//return $query->row()->name;
			return $query->result();
		} else {
			return 0;
		}		
	}

	function getDepartmentById($id){
		$this->db->select('name');
		$this->db->from('department');
		$this->db->where('id', $id);
		
		$query = $this->db->get();
	
		if ($query->num_rows() > 0) {
			return $query->row()->name;
			//return $query->result();
		} else {
			return 0;
		}
	}
	
}
?>